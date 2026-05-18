@extends('layouts.customer')

@section('content')
    <div class="pt-32 pb-20 bg-slate-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header/Breadcrumb -->
            <div class="mb-8">
                <a href="{{ route('costumer.dashboard') }}"
                    class="text-sm font-medium text-slate-500 hover:text-primary-600 transition-colors flex items-center gap-2 mb-4 group">
                    <span
                        class="material-symbols-outlined text-[18px] group-hover:-translate-x-1 transition-transform">arrow_back</span>
                    Kembali ke Dashboard
                </a>
                <h1 class="font-serif text-3xl font-bold text-slate-900">Detail Transaksi</h1>
                <p class="text-slate-500 text-sm mt-1">Invoice: #{{ $transaction->order_id }} &bull;
                    {{ $transaction->created_at->format('d F Y, H:i') }} WIB
                </p>
            </div>

            <!-- Flash messages -->
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl flex items-center gap-3">
                    <span class="material-symbols-outlined text-green-600">check_circle</span>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Info Utama Transaksi (Kiri) -->
                <div class="md:col-span-2 space-y-6">
                    <!-- Books List Card -->
                    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden p-8">
                        <h3 class="text-lg font-bold text-slate-900 mb-6">Buku Yang Dibeli</h3>
                        <div class="divide-y divide-slate-100">
                            @foreach ($transaction->items as $item)
                                <div class="flex items-start gap-6 py-4 first:pt-0 last:pb-0">
                                    <img src="{{ $item->book->sampul ? asset('storage/' . $item->book->sampul) : 'https://placehold.co/80x120' }}"
                                        alt="{{ $item->book->judul }}"
                                        class="w-16 h-24 object-cover rounded-xl shadow-sm border border-slate-100 flex-shrink-0">
                                    <div class="flex-grow">
                                        <h4 class="font-bold text-slate-800 text-base line-clamp-2">{{ $item->book->judul }}
                                        </h4>
                                        <p class="text-xs text-slate-400 mt-1">{{ $item->book->penulis }}</p>
                                        <p class="text-sm text-slate-500 font-medium mt-2">{{ $item->quantity }} x Rp
                                            {{ number_format($item->price, 0, ',', '.') }}
                                        </p>
                                    </div>
                                    <div class="text-right flex-shrink-0">
                                        <span class="font-serif text-lg font-bold text-slate-900">Rp
                                            {{ number_format($item->quantity * $item->price, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Alamat Pengiriman Card -->
                    @if($transaction->alamat_pengiriman)
                        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden p-8 mt-6">
                            <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                                <span class="material-symbols-outlined text-[20px] text-blue-600">location_on</span>
                                Alamat Pengiriman
                            </h3>
                            <div
                                class="bg-slate-50 p-5 rounded-2xl border border-slate-100 text-left text-sm text-slate-700 leading-relaxed whitespace-pre-line">
                                {{ $transaction->alamat_pengiriman }}
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Info Status & Ringkasan (Kanan) -->
                <div class="space-y-6">
                    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-8 space-y-6">
                        <!-- Status Badge Area -->
                        <div>
                            <p class="text-xs text-slate-400 uppercase tracking-wider font-bold mb-2">Status Transaksi</p>
                            @if ($transaction->status === 'success')
                                <span
                                    class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-green-50 text-green-600 text-sm font-bold">
                                    <span class="material-symbols-outlined text-[18px]">check_circle</span>
                                    Berhasil
                                </span>
                            @elseif ($transaction->status === 'pending')
                                <span
                                    class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-amber-50 text-amber-600 text-sm font-bold animate-pulse">
                                    <span class="material-symbols-outlined text-[18px]">pending</span>
                                    Menunggu Pembayaran
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-rose-50 text-rose-600 text-sm font-bold">
                                    <span class="material-symbols-outlined text-[18px]">cancel</span>
                                    Gagal / Batal
                                </span>
                            @endif
                        </div>

                        <!-- Ringkasan Rincian -->
                        <div class="border-t border-slate-100 pt-6 space-y-3">
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-slate-500 font-medium">Metode Pembayaran</span>
                                <span class="text-slate-800 font-bold">{{ $transaction->payment_method ?? 'Xendit' }}</span>
                            </div>
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-slate-500 font-medium">Total Item</span>
                                <span class="text-slate-800 font-bold">{{ $transaction->items->sum('quantity') }}
                                    buku</span>
                            </div>
                            <div class="border-t border-slate-50 pt-4 flex justify-between items-center">
                                <span class="font-medium text-slate-800 text-sm">Total Tagihan</span>
                                <span class="text-xl font-extrabold text-slate-900">Rp
                                    {{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        @if ($transaction->status === 'pending')
                            <div class="border-t border-slate-100 pt-6 space-y-3">
                                @if ($invoiceUrl)
                                    <a href="{{ $invoiceUrl }}" target="_blank"
                                        class="w-full py-4 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl font-bold transition-all text-sm flex items-center justify-center gap-2 shadow-lg shadow-blue-500/20 active:scale-[0.98]">
                                        <span class="material-symbols-outlined text-[20px]">credit_card</span>
                                        Bayar Sekarang
                                    </a>
                                @endif
                                <form action="{{ route('costumer.transaction.cancel', $transaction->id) }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin membatalkan transaksi ini?')">
                                    @csrf
                                    <button type="submit"
                                        class="w-full py-3.5 bg-rose-50 text-rose-600 border border-rose-100 rounded-2xl font-bold hover:bg-rose-100 transition-all text-sm flex items-center justify-center gap-2 active:scale-[0.98]">
                                        <span class="material-symbols-outlined text-[20px]">cancel</span>
                                        Batalkan Transaksi
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection