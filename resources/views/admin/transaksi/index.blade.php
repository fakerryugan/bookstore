@extends('layouts.admin')

@section('content')
<div class="p-6 sm:p-10">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-800">Riwayat Transaksi</h1>
        <p class="text-slate-500 text-sm">Pantau semua pesanan dan status pembayaran dari pelanggan.</p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-6 overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-xs font-semibold uppercase tracking-wider text-slate-400 border-b border-slate-100">
                        <th class="pb-4 px-4">Tanggal</th>
                        <th class="pb-4 px-4">Order ID</th>
                        <th class="pb-4 px-4">Pelanggan</th>
                        <th class="pb-4 px-4">Total</th>
                        <th class="pb-4 px-4">Metode</th>
                        <th class="pb-4 px-4">Status Bayar</th>
                        <th class="pb-4 px-4">Status Kirim</th>
                        <th class="pb-4 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($transactions as $trx)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="py-4 px-4 text-sm text-slate-600">
                            {{ $trx->created_at->format('d M Y, H:i') }}
                        </td>
                        <td class="py-4 px-4">
                            <span class="font-bold text-slate-900">{{ $trx->order_id }}</span>
                        </td>
                        <td class="py-4 px-4">
                            <div class="flex flex-col">
                                <span class="text-sm font-bold text-slate-800">{{ $trx->user->name }}</span>
                                <span class="text-xs text-slate-500">{{ $trx->user->email }}</span>
                            </div>
                        </td>
                        <td class="py-4 px-4 font-bold text-slate-900">
                            Rp {{ number_format($trx->total_amount, 0, ',', '.') }}
                        </td>
                        <td class="py-4 px-4 text-sm text-slate-600">
                            {{ $trx->payment_method }}
                        </td>
                        <td class="py-4 px-4">
                            @if($trx->status === 'success')
                                <span class="px-3 py-1 rounded-full bg-emerald-50 text-emerald-600 text-xs font-bold border border-emerald-100 flex items-center gap-1 w-fit">
                                    <span class="material-symbols-outlined text-[14px]">check_circle</span> Success
                                </span>
                            @elseif($trx->status === 'pending')
                                <span class="px-3 py-1 rounded-full bg-amber-50 text-amber-600 text-xs font-bold border border-amber-100 flex items-center gap-1 w-fit">
                                    <span class="material-symbols-outlined text-[14px]">pending</span> Pending
                                </span>
                            @else
                                <span class="px-3 py-1 rounded-full bg-rose-50 text-rose-600 text-xs font-bold border border-rose-100 flex items-center gap-1 w-fit">
                                    <span class="material-symbols-outlined text-[14px]">cancel</span> Failed
                                </span>
                            @endif
                        </td>
                        <td class="py-4 px-4">
                            @if($trx->status === 'success')
                                @if($trx->status_pengiriman === 'dikirim')
                                    <span class="px-2.5 py-1 rounded-full bg-blue-50 text-blue-600 text-[11px] font-bold border border-blue-100 flex items-center gap-1 w-fit">
                                        <span class="material-symbols-outlined text-[12px]">local_shipping</span> Shipped
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full bg-amber-50 text-amber-600 text-[11px] font-bold border border-amber-100 flex items-center gap-1 w-fit">
                                        <span class="material-symbols-outlined text-[12px]">pending</span> Pending Shipping
                                    </span>
                                @endif
                            @else
                                <span class="text-slate-400 text-xs font-semibold">—</span>
                            @endif
                        </td>
                        <td class="py-4 px-4 text-right">
                            <a href="{{ route('admin.transaksi.show', $trx->id) }}" class="inline-flex items-center gap-1 text-primary-600 hover:text-primary-700 font-bold text-sm transition-colors">
                                Detail <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="py-12 text-center">
                            <div class="flex flex-col items-center gap-2">
                                <span class="material-symbols-outlined text-4xl text-slate-200">receipt_long</span>
                                <p class="text-slate-500">Belum ada transaksi yang tercatat.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($transactions->hasPages())
        <div class="p-6 bg-slate-50 border-t border-slate-100">
            {{ $transactions->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
