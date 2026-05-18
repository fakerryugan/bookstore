@extends('layouts.customer')

@section('content')
    <div class="pt-32 pb-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="mb-12">
                <ol class="flex items-center gap-2 text-sm text-slate-500 font-medium">
                    <li><a href="{{ route('costumer.index') }}" class="hover:text-primary-600 transition-colors">Beranda</a></li>
                    <li><span class="material-symbols-outlined text-[16px]">chevron_right</span></li>
                    <li><a href="{{ route('costumer.buku.index') }}" class="hover:text-primary-600 transition-colors">Katalog</a></li>
                    <li><span class="material-symbols-outlined text-[16px]">chevron_right</span></li>
                    <li><span class="text-slate-800 font-medium">{{ $book->judul }}</span></li>
                </ol>
            </nav>

            <div class="flex flex-col lg:flex-row gap-16">
                <!-- Book Image -->
                <div class="w-full lg:w-5/12 xl:w-1/3 flex-shrink-0">
                    <div class="sticky top-28">
                        <div class="relative rounded-2xl overflow-hidden shadow-2xl shadow-slate-300 border border-slate-100 aspect-[2/3] group">
                            @if($book->sampul)
                                <img src="{{ asset('storage/' . $book->sampul) }}" alt="{{ $book->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-slate-200">
                                    <span class="material-symbols-outlined text-6xl text-slate-400">auto_stories</span>
                                </div>
                            @endif
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4 mt-6">
                            <div class="bg-slate-50 rounded-xl p-4 flex flex-col items-center justify-center border border-slate-100">
                                <span class="material-symbols-outlined text-primary-600 text-3xl mb-1">inventory_2</span>
                                <span class="text-sm text-slate-500 font-medium uppercase tracking-wider">Stok</span>
                                <span class="text-lg font-bold text-slate-900">{{ $book->stok }}</span>
                            </div>
                            <div class="bg-slate-50 rounded-xl p-4 flex flex-col items-center justify-center border border-slate-100">
                                <span class="material-symbols-outlined text-amber-500 text-3xl mb-1" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="text-sm text-slate-500 font-medium uppercase tracking-wider">Rating</span>
                                <span class="text-lg font-bold text-slate-900">4.8</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Book Info -->
                <div class="w-full lg:w-7/12 xl:w-2/3 flex flex-col">
                    <p class="text-sm font-bold tracking-widest text-primary-600 uppercase mb-2">{{ $book->penulis }}</p>
                    <h1 class="font-serif text-4xl lg:text-5xl font-bold text-slate-900 mb-4 leading-tight">{{ $book->judul }}</h1>
                    
                    <div class="flex flex-wrap items-center gap-4 mb-6 text-sm text-slate-600">
                        <div class="flex items-center text-amber-400">
                            <span class="material-symbols-outlined text-[18px] fill-current" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined text-[18px] fill-current" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined text-[18px] fill-current" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined text-[18px] fill-current" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined text-[18px] fill-current" style="font-variation-settings: 'FILL' 1;">star_half</span>
                        </div>
                        <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                        <span class="text-green-600 font-medium flex items-center gap-1">
                            <span class="material-symbols-outlined text-[16px]">check_circle</span> 
                            {{ $book->stok > 0 ? 'Stok Tersedia' : 'Stok Habis' }}
                        </span>
                    </div>

                    <div class="mb-8">
                        <span class="text-3xl font-bold text-slate-900">Rp {{ number_format($book->harga, 0, ',', '.') }}</span>
                    </div>

                    <p class="text-lg text-slate-700 leading-relaxed font-light mb-8">
                        {{ $book->deskripsi }}
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 mb-12">
                        <form action="{{ route('cart.add', $book->id) }}" method="POST" class="flex-1">
                            @csrf
                            <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white py-4 px-8 rounded-xl font-bold text-lg shadow-lg shadow-primary-500/30 transition-all active:scale-95 flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined">add_shopping_cart</span>
                                Tambah ke Keranjang
                            </button>
                        </form>
                    </div>

                    <div class="mt-4 bg-slate-50 rounded-2xl p-6 md:p-8 border border-slate-100">
                        <h3 class="font-serif text-xl font-bold text-slate-900 mb-6">Detail Buku</h3>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                            <div>
                                <p class="text-sm text-slate-500 uppercase tracking-wider mb-1">Penerbit</p>
                                <p class="font-medium text-slate-900">{{ $book->penerbit }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-slate-500 uppercase tracking-wider mb-1">Kategori</p>
                                <p class="font-medium text-slate-900">{{ $book->kategori->nama_kategori ?? 'Umum' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-slate-500 uppercase tracking-wider mb-1">ID Buku</p>
                                <p class="font-medium text-slate-900">#BK-{{ str_pad($book->id, 4, '0', STR_PAD_LEFT) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection