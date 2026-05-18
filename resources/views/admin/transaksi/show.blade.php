@extends('layouts.admin')

@section('content')
    <div class="p-6 sm:p-10">
        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-xl flex items-center gap-3 text-sm font-semibold">
                <span class="material-symbols-outlined">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <a href="{{ route('admin.transaksi.index') }}"
                    class="inline-flex items-center gap-2 text-slate-500 hover:text-slate-800 transition-colors mb-2 text-sm font-medium">
                    <span class="material-symbols-outlined text-[18px]">arrow_back</span> Kembali ke Daftar
                </a>
                <h1 class="text-2xl font-bold text-slate-800">Detail Transaksi #{{ $transaction->order_id }}</h1>
            </div>
            <div class="flex items-center gap-3">
                @if($transaction->status === 'success')
                    <span
                        class="px-4 py-1.5 rounded-lg bg-emerald-50 text-emerald-600 text-sm font-bold border border-emerald-100 flex items-center gap-2">
                        <span class="material-symbols-outlined">check_circle</span> PEMBAYARAN BERHASIL
                    </span>
                    @if($transaction->status_pengiriman === 'dikirim')
                        <span
                            class="px-4 py-1.5 rounded-lg bg-blue-50 text-blue-600 text-sm font-bold border border-blue-100 flex items-center gap-2">
                            <span class="material-symbols-outlined">local_shipping</span> SUDAH DIKIRIM
                        </span>
                    @else
                        <span
                            class="px-4 py-1.5 rounded-lg bg-amber-50 text-amber-600 text-sm font-bold border border-amber-100 flex items-center gap-2">
                            <span class="material-symbols-outlined">pending</span> MENUNGGU PENGIRIMAN
                        </span>
                    @endif
                @elseif($transaction->status === 'pending')
                    <span
                        class="px-4 py-1.5 rounded-lg bg-amber-50 text-amber-600 text-sm font-bold border border-amber-100 flex items-center gap-2">
                        <span class="material-symbols-outlined">pending</span> MENUNGGU PEMBAYARAN
                    </span>
                @else
                    <span
                        class="px-4 py-1.5 rounded-lg bg-rose-50 text-rose-600 text-sm font-bold border border-rose-100 flex items-center gap-2">
                        <span class="material-symbols-outlined">cancel</span> TRANSAKSI GAGAL
                    </span>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Informasi Transaksi & Item -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Rincian Produk -->
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-slate-50">
                        <h3 class="font-bold text-slate-800 flex items-center gap-2">
                            <span class="material-symbols-outlined text-slate-400">shopping_bag</span>
                            Daftar Buku yang Dibeli
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-6">
                            @foreach($transaction->items as $item)
                                <div class="flex gap-4">
                                    <div class="w-20 h-28 flex-shrink-0 bg-slate-100 rounded-lg overflow-hidden shadow-sm">
                                        <img src="{{ asset('storage/' . $item->book->sampul) }}" alt="{{ $item->book->judul }}"
                                            class="w-full h-full object-cover" />
                                    </div>
                                    <div class="flex-grow flex flex-col justify-between py-1">
                                        <div>
                                            <h4 class="font-bold text-slate-900 line-clamp-1">{{ $item->book->judul }}</h4>
                                            <p class="text-xs text-slate-500 mb-1">{{ $item->book->penulis }}</p>
                                            <p class="text-sm font-medium text-slate-600">
                                                {{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}
                                            </p>
                                        </div>
                                        <p class="font-bold text-slate-900">
                                            Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                                @if(!$loop->last)
                                <hr class="border-slate-50" /> @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="p-6 bg-slate-50 border-t border-slate-100">
                        <div class="flex justify-between items-center">
                            <span class="text-slate-600 font-medium">Total Pembayaran</span>
                            <span class="text-xl font-bold text-primary-600">Rp
                                {{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Informasi -->
            <div class="space-y-8">
                <!-- Informasi Pelanggan -->
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
                    <h3 class="font-bold text-slate-800 mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined text-slate-400">person</span>
                        Informasi Pelanggan
                    </h3>
                    <div class="space-y-4">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center overflow-hidden">
                                <img src="{{ $transaction->user->photo ? asset('storage/' . $transaction->user->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($transaction->user->name) }}"
                                    alt="" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <p class="font-bold text-slate-900 leading-tight">{{ $transaction->user->name }}</p>
                                <p class="text-xs text-slate-500">{{ $transaction->user->email }}</p>
                            </div>
                        </div>
                        <div class="pt-4 border-t border-slate-50 space-y-3">
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-500">ID Pelanggan</span>
                                <span class="font-medium text-slate-900">#USER-{{ $transaction->user->id }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-500">Tanggal Daftar</span>
                                <span
                                    class="font-medium text-slate-900">{{ $transaction->user->created_at->format('d M Y') }}</span>
                            </div>
                            
                            @if($transaction->alamat_pengiriman)
                                <div class="pt-3 border-t border-slate-50 space-y-1.5 text-xs text-left">
                                    <span class="font-bold text-slate-500 block uppercase tracking-wider text-[9px]">Alamat Pengiriman</span>
                                    <div class="bg-slate-50 border border-slate-100 p-3 rounded-xl text-slate-700 leading-relaxed font-medium whitespace-pre-line">
                                        {{ $transaction->alamat_pengiriman }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Detail Pembayaran -->
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
                    <h3 class="font-bold text-slate-800 mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined text-slate-400">info</span>
                        Info Pembayaran
                    </h3>
                    <div class="space-y-4">
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Metode</span>
                            <span class="font-bold text-slate-900">{{ $transaction->payment_method }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Waktu Transaksi</span>
                            <span
                                class="font-medium text-slate-900">{{ $transaction->created_at->format('d M Y, H:i') }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">ID Invoice</span>
                            <span
                                class="font-mono text-xs font-bold text-primary-600 bg-primary-50 px-2 py-0.5 rounded">{{ $transaction->order_id }}</span>
                        </div>
                    </div>
                </div>

                <!-- Panel Aksi Admin -->
                @if($transaction->status === 'pending' && $transaction->payment_method === 'Manual')
                    <div class="bg-white rounded-2xl border border-amber-200 shadow-sm p-6 bg-amber-50/30">
                        <h3 class="font-bold text-amber-800 mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-amber-600">payments</span>
                            Verifikasi Transfer Manual
                        </h3>
                        <p class="text-xs text-slate-500 mb-6 leading-relaxed">
                            Pelanggan memilih pembayaran transfer manual. Pastikan uang transfer masuk ke rekening BCA RyuuBook sebelum menyetujui.
                        </p>
                        <div class="space-y-3">
                            <form action="{{ route('admin.transaksi.confirm', $transaction->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-sm font-bold shadow-lg shadow-emerald-500/20 transition-all">
                                    Setujui & Kurangi Stok
                                </button>
                            </form>
                            <form action="{{ route('admin.transaksi.cancel', $transaction->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan transaksi ini?')">
                                @csrf
                                <button type="submit" class="w-full py-2.5 bg-white border border-rose-200 hover:bg-rose-50 text-rose-600 rounded-xl text-sm font-bold transition-all">
                                    Tolak & Batalkan Transaksi
                                </button>
                            </form>
                        </div>
                    </div>
                @endif

                @if($transaction->status === 'success')
                    <div class="bg-white rounded-2xl border border-blue-100 shadow-sm p-6 bg-blue-50/20">
                        <h3 class="font-bold text-blue-800 mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-blue-600">local_shipping</span>
                            Kelola Pengiriman
                        </h3>
                        
                        <div class="mb-5">
                            <span class="text-xs font-semibold text-slate-400 block uppercase tracking-wider mb-1">Status Saat Ini</span>
                            @if($transaction->status_pengiriman === 'dikirim')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-xs font-bold border border-blue-100">
                                    <span class="material-symbols-outlined text-[14px]">local_shipping</span>
                                    Sudah Dikirim
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-50 text-amber-600 text-xs font-bold border border-amber-100">
                                    <span class="material-symbols-outlined text-[14px]">pending</span>
                                    Menunggu Pengiriman
                                </span>
                            @endif
                        </div>

                        <form action="{{ route('admin.transaksi.shipping', $transaction->id) }}" method="POST">
                            @csrf
                            @if($transaction->status_pengiriman === 'dikirim')
                                <input type="hidden" name="status_pengiriman" value="menunggu" />
                                <button type="submit" class="w-full py-2.5 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 rounded-xl text-sm font-bold transition-all flex items-center justify-center gap-2">
                                    <span class="material-symbols-outlined text-[18px]">query_builder</span>
                                    Tandai Menunggu Pengiriman
                                </button>
                            @else
                                <input type="hidden" name="status_pengiriman" value="dikirim" />
                                <button type="submit" class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-bold shadow-lg shadow-blue-500/20 transition-all flex items-center justify-center gap-2">
                                    <span class="material-symbols-outlined text-[18px]">local_shipping</span>
                                    Kirim Pesanan (Sudah Dikirim)
                                </button>
                            @endif
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection