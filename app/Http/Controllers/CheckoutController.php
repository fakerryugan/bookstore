<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;
use Xendit\Invoice\CreateInvoiceRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Keranjang Anda kosong!');
        }

        $user = Auth::user();

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // 1. Process / Verify Shipping Address
        $alamatText = '';
        if ($request->input('address_selection') === 'existing') {
            $request->validate([
                'address_id' => 'required|exists:addresses,id,user_id,' . $user->id,
            ], [
                'address_id.required' => 'Silakan pilih salah satu alamat pengiriman.'
            ]);
            
            $address = \App\Models\Address::findOrFail($request->address_id);
            $alamatText = "Penerima: {$address->nama_penerima} | Telp: {$address->telepon}\nAlamat: {$address->alamat_lengkap}, {$address->kota}, {$address->kode_pos}";
        } else {
            $request->validate([
                'nama_penerima' => 'required|string|max:255',
                'telepon' => 'required|string|max:20',
                'alamat_lengkap' => 'required|string',
                'kota' => 'required|string|max:255',
                'kode_pos' => 'required|string|max:10',
            ], [
                'nama_penerima.required' => 'Nama penerima wajib diisi.',
                'telepon.required' => 'Nomor telepon wajib diisi.',
                'alamat_lengkap.required' => 'Alamat lengkap wajib diisi.',
                'kota.required' => 'Kota wajib diisi.',
                'kode_pos.required' => 'Kode pos wajib diisi.',
            ]);

            $address = \App\Models\Address::create([
                'user_id' => $user->id,
                'nama_penerima' => $request->nama_penerima,
                'telepon' => $request->telepon,
                'alamat_lengkap' => $request->alamat_lengkap,
                'kota' => $request->kota,
                'kode_pos' => $request->kode_pos,
                'is_default' => $user->addresses()->count() === 0 
            ]);

            $alamatText = "Penerima: {$address->nama_penerima} | Telp: {$address->telepon}\nAlamat: {$address->alamat_lengkap}, {$address->kota}, {$address->kode_pos}";
        }

        // 2. Determine Payment Method
        $paymentMethod = $request->input('payment_method', 'Xendit');

        $orderId = 'INV-' . Str::upper(Str::random(10));
        $transaction = Transaction::create([
            'order_id' => $orderId,
            'user_id' => $user->id,
            'total_amount' => $total,
            'status' => 'pending',
            'payment_method' => $paymentMethod === 'Manual' ? 'Bayar Sebelum Dikirim' : 'Xendit',
            'alamat_pengiriman' => $alamatText
        ]);

        foreach ($cart as $id => $details) {
            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'book_id' => $id,
                'quantity' => $details['quantity'],
                'price' => $details['price']
            ]);
        }

        if ($paymentMethod === 'Manual') {
            $request->session()->forget('cart'); 
            return redirect()->route('costumer.transaction.show', $transaction->id)->with('success', 'Pesanan berhasil dibuat! Silakan ikuti instruksi pembayaran manual di bawah.');
        }

        // 3. Xendit Invoice Flow
        $config = new Configuration();
        $config->setApiKey(config('services.xendit.secret_key'));
        
        $apiInstance = new InvoiceApi(null, $config);

        $create_invoice_request = new CreateInvoiceRequest([
            'external_id' => $orderId,
            'amount' => $total,
            'payer_email' => $user->email, 
            'description' => 'Pembayaran Buku Ryuu Book - ' . $orderId,
            'invoice_duration' => 86400,
            'success_redirect_url' => route('costumer.dashboard'),
            'failure_redirect_url' => route('costumer.keranjang'),
            'currency' => 'IDR',
        ]);

        try {
            $result = $apiInstance->createInvoice($create_invoice_request);
            $request->session()->forget('cart'); 

            return redirect($result['invoice_url']);
        } catch (\Xendit\XenditSdkException $e) {
            \Illuminate\Support\Facades\Log::error('Xendit checkout invoice creation failed: ' . $e->getMessage(), [
                'order_id' => $orderId,
                'total' => $total,
                'exception' => $e
            ]);
            return redirect()->back()->with('error', 'Gagal membuat pembayaran: ' . $e->getMessage());
        }
    }

    public function callback(Request $request)
    {
        $external_id = $request->external_id;
        $status = $request->status;

        $transaction = Transaction::where('order_id', $external_id)->first();

        if ($transaction) {
            if ($status === 'PAID' || $status === 'SETTLED') {
                $transaction->markAsSuccess();
            } elseif ($status === 'EXPIRED' || $status === 'FAILED') {
                $transaction->update(['status' => 'failed']);
            }
        }

        return response()->json(['status' => 'success']);
    }
}