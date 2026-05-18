<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Kategori;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;

class CustomerController extends Controller
{
    public function index()
    {
        $latestBooks = Books::with('kategori')->latest()->take(8)->get();
        return view('costumer.index', compact('latestBooks'));
    }

    public function buku(Request $request)
    {
        $query = Books::with('kategori');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', '%' . $search . '%')
                  ->orWhere('penulis', 'like', '%' . $search . '%')
                  ->orWhere('penerbit', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('kategori')) {
            $query->where('kategori_id', $request->kategori);
        }

        if ($request->filled('min_price')) {
            $query->where('harga', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('harga', '<=', $request->max_price);
        }

        if ($request->filled('rating')) {
            $query->where('rating', '>=', $request->rating);
        }

        $books = $query->latest()->get();
        return view('costumer.buku.index', compact('books'));
    }

    public function show(string $id)
    {
        $book = Books::with('kategori')->findOrFail($id);
        $relatedBooks = Books::where('kategori_id', $book->kategori_id)
            ->where('id', '!=', $id)
            ->take(4)
            ->get();
        return view('costumer.buku.show', compact('book', 'relatedBooks'));
    }

    public function about()
    {
        return view('costumer.about');
    }

    public function keranjang()
    {
        return view('costumer.keranjang');
    }

    public function dashboard()
    {
        $user = Auth::user();
        
        $config = new Configuration();
        $config->setApiKey(config('services.xendit.secret_key'));
        $apiInstance = new InvoiceApi(null, $config);

        $pendingTransactions = Transaction::where('user_id', $user->id)
            ->where('status', 'pending')
            ->get();

        $errorMsg = null;
        foreach ($pendingTransactions as $trx) {
            try {
                $invoices = $apiInstance->getInvoices(null, $trx->order_id);
                
                if (!empty($invoices) && isset($invoices[0])) {
                    $xenditStatus = $invoices[0]['status'];
                    
                    if ($xenditStatus === 'PAID' || $xenditStatus === 'SETTLED') {
                        $trx->markAsSuccess();
                    } elseif ($xenditStatus === 'EXPIRED') {
                        $trx->update(['status' => 'failed']);
                    }
                }
            } catch (\Exception $e) {
                $errorMsg = 'Gagal sinkronisasi status pembayaran Xendit (' . $trx->order_id . '): ' . $e->getMessage();
            }
        }

        $transactions = Transaction::where('user_id', $user->id)
            ->with('items.book')
            ->latest()
            ->get();

        $stats = [
            'total_spent' => $transactions->where('status', 'success')->sum('total_amount'),
            'total_orders' => $transactions->count(),
            'pending_payments' => $transactions->where('status', 'pending')->count(),
            'failed_orders' => $transactions->where('status', 'failed')->count(),
        ];

        $addresses = $user->addresses()->latest()->get();

        return view('costumer.dashboard', compact('user', 'transactions', 'stats', 'addresses', 'errorMsg'));
    }

    public function showTransaction(string $id)
    {
        $transaction = Transaction::where('user_id', Auth::id())
            ->with('items.book')
            ->findOrFail($id);

        $invoiceUrl = null;
        $errorMsg = null;
        if ($transaction->status === 'pending') {
            try {
                $config = new Configuration();
                $config->setApiKey(config('services.xendit.secret_key'));
                $apiInstance = new InvoiceApi(null, $config);

                $invoices = $apiInstance->getInvoices(null, $transaction->order_id);
                if (!empty($invoices) && isset($invoices[0])) {
                    $invoiceUrl = $invoices[0]['invoice_url'];
                }
            } catch (\Exception $e) {
                $errorMsg = 'Gagal memuat detail invoice Xendit: ' . $e->getMessage();
            }
        }

        return view('costumer.transaksi.show', compact('transaction', 'invoiceUrl', 'errorMsg'));
    }

    public function cancelTransaction(string $id)
    {
        $transaction = Transaction::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->findOrFail($id);

        $transaction->update(['status' => 'failed']);

        return redirect()->back()->with('success', 'Transaksi berhasil dibatalkan.');
    }

    public function storeAlamat(Request $request)
    {
        $request->validate([
            'nama_penerima' => 'required|string|max:255',
            'telepon' => 'required|string|max:20',
            'alamat_lengkap' => 'required|string',
            'kota' => 'required|string|max:255',
            'kode_pos' => 'required|string|max:10',
        ]);

        $user = Auth::user();
        $isFirst = $user->addresses()->count() === 0;

       Address::create([
            'user_id' => $user->id,
            'nama_penerima' => $request->nama_penerima,
            'telepon' => $request->telepon,
            'alamat_lengkap' => $request->alamat_lengkap,
            'kota' => $request->kota,
            'kode_pos' => $request->kode_pos,
            'is_default' => $isFirst
        ]);

        return redirect()->back()->with('success_address', 'Alamat pengiriman berhasil ditambahkan!');
    }

    public function destroyAlamat(string $id)
    {
        $address = Address::where('user_id', Auth::id())->findOrFail($id);
        $wasDefault = $address->is_default;
        $address->delete();

        if ($wasDefault) {
            $user = Auth::user();
            $nextAddress = $user->addresses()->first();
            if ($nextAddress) {
                $nextAddress->update(['is_default' => true]);
            }
        }

        return redirect()->back()->with('success_address', 'Alamat pengiriman berhasil dihapus.');
    }

    public function setDefaultAlamat(string $id)
    {
        $user = Auth::user();
        $user->addresses()->update(['is_default' => false]);
        
        $address = Address::where('user_id', Auth::id())->findOrFail($id);
        $address->update(['is_default' => true]);

        return redirect()->back()->with('success_address', 'Alamat utama berhasil diperbarui!');
    }
}