<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class AdminTransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user')->latest()->paginate(10);
        return view('admin.transaksi.index', compact('transactions'));
    }

    public function show($id)
    {
        $transaction = Transaction::with(['user', 'items.book'])->findOrFail($id);
        return view('admin.transaksi.show', compact('transaction'));
    }

    public function confirmPayment($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->markAsSuccess();

        return redirect()->back()->with('success', 'Pembayaran manual berhasil dikonfirmasi dan stok buku telah dikurangi.');
    }

    public function cancelPayment($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->update(['status' => 'failed']);

        return redirect()->back()->with('success', 'Transaksi berhasil dibatalkan.');
    }

    public function updateShipping(Request $request, $id)
    {
        $request->validate([
            'status_pengiriman' => 'required|in:menunggu,dikirim'
        ]);

        $transaction = Transaction::findOrFail($id);
        $transaction->update(['status_pengiriman' => $request->status_pengiriman]);

        return redirect()->back()->with('success', 'Status pengiriman berhasil diperbarui.');
    }
}
