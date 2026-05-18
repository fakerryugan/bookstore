@extends('layouts.customer')

@section('content')
    <header class="pt-40 pb-20 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <div class="w-full lg:w-1/2 space-y-8">
                    <h1 class="font-serif text-5xl lg:text-7xl font-bold text-slate-900 leading-tight">
                        RyuuBook: <span class="text-primary-600">Jendela Dunia</span> dalam Genggaman Anda
                    </h1>
                    <p class="text-lg text-slate-600 leading-relaxed max-w-xl">
                        Jelajahi ribuan judul buku dari penulis favorit Anda. Mulai dari mahakarya klasik hingga rilis terbaru yang paling dinanti.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('costumer.buku.index') }}" class="px-8 py-4 bg-primary-600 text-white rounded-xl font-bold hover:bg-primary-700 shadow-lg shadow-primary-500/30 transition-all active:scale-95">Mulai Menjelajah</a>
                    </div>
                </div>
                <div class="w-full lg:w-1/2 relative">
                    <div class="relative z-10 rounded-2xl overflow-hidden shadow-2xl rotate-2 hover:rotate-0 transition-transform duration-500 aspect-[4/3]">
                        <img src="{{ asset('images/hero.jpg') }}" alt="Hero Image" class="w-full h-full object-cover" />
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-transparent to-transparent"></div>
                        <div class="absolute bottom-6 left-6 right-6 text-white">
                            <p class="font-serif text-2xl font-semibold mb-1 shadow-sm">"Membaca adalah terbang."</p>
                            <p class="text-sm text-slate-200 opacity-90">— A. Kiran</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
                <div>
                    <h2 class="font-serif text-3xl md:text-4xl font-bold text-slate-900 mb-4">Pilihan Editor</h2>
                    <p class="text-slate-600 max-w-2xl">Karya-karya sastra fenomenal yang wajib ada di rak buku Anda.</p>
                </div>
                <a href="{{ route('costumer.buku.index') }}" class="inline-flex items-center gap-1 text-primary-600 font-medium hover:text-primary-700 transition-colors group">
                    Lihat Semua <span class="material-symbols-outlined text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($latestBooks as $book)
                <a href="{{ route('costumer.buku.show', $book->id) }}" class="group block">
                    <div class="relative w-full aspect-[2/3] rounded-xl overflow-hidden shadow-md group-hover:shadow-2xl transition-all duration-500 mb-4 bg-slate-100">
                        @if($book->sampul)
                            <img src="{{ asset('storage/' . $book->sampul) }}" alt="{{ $book->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-slate-200">
                                <span class="material-symbols-outlined text-4xl text-slate-400">auto_stories</span>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-slate-900/0 group-hover:bg-slate-900/10 transition-colors duration-300"></div>
                    </div>
                    <div>
                        <p class="text-xs font-semibold tracking-wider text-primary-600 uppercase mb-1">{{ $book->penulis }}</p>
                        <h3 class="font-serif text-xl font-bold text-slate-900 mb-1 group-hover:text-primary-600 transition-colors line-clamp-1">{{ $book->judul }}</h3>
                        <p class="text-lg font-bold text-slate-900">Rp {{ number_format($book->harga, 0, ',', '.') }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection