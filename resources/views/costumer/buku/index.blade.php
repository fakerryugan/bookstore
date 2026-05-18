@extends('layouts.customer')

@section('content')
    <div class="pt-32 pb-10 bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <h1 class="font-serif text-4xl font-bold text-slate-900 mb-2">Katalog Buku</h1>
                    <p class="text-slate-500">Temukan koleksi lengkap mahakarya literasi terbaik kami.</p>
                </div>
                <form action="{{ route('costumer.buku.index') }}" method="GET" class="relative w-full md:w-96">
                    @if(request('kategori'))
                        <input type="hidden" name="kategori" value="{{ request('kategori') }}" />
                    @endif
                    @if(request('min_price'))
                        <input type="hidden" name="min_price" value="{{ request('min_price') }}" />
                    @endif
                    @if(request('max_price'))
                        <input type="hidden" name="max_price" value="{{ request('max_price') }}" />
                    @endif
                    @if(request('rating'))
                        <input type="hidden" name="rating" value="{{ request('rating') }}" />
                    @endif
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">search</span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul, penulis, atau penerbit..." class="w-full pl-12 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:ring-4 focus:ring-primary-500/10 focus:border-primary-500 transition-all" />
                </form>
            </div>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col lg:flex-row gap-12">
            <!-- Sidebar Filter -->
            <aside class="w-full lg:w-64 flex-shrink-0">
                 <form action="{{ route('costumer.buku.index') }}" method="GET" class="space-y-10">
                    @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}" />
                    @endif
                    <!-- Kategori -->
                    <div>
                        <h3 class="font-bold text-slate-900 mb-5 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary-600">category</span>
                            Kategori
                        </h3>
                        <div class="space-y-3">
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" name="kategori" value="" class="w-5 h-5 border-slate-300 text-primary-600 focus:ring-primary-500" {{ !request('kategori') ? 'checked' : '' }} onchange="this.form.submit()" />
                                <span class="text-slate-600 group-hover:text-primary-600 transition-colors">Semua Kategori</span>
                            </label>
                            @foreach(\App\Models\Kategori::all() as $cat)
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" name="kategori" value="{{ $cat->id }}" class="w-5 h-5 border-slate-300 text-primary-600 focus:ring-primary-500" {{ request('kategori') == $cat->id ? 'checked' : '' }} onchange="this.form.submit()" />
                                <span class="text-slate-600 group-hover:text-primary-600 transition-colors">{{ $cat->nama_kategori }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Harga -->
                    <div>
                        <h3 class="font-bold text-slate-900 mb-5 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary-600">payments</span>
                            Rentang Harga
                        </h3>
                        <div class="space-y-4">
                            <div class="grid grid-cols-2 gap-2">
                                <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm outline-none focus:border-primary-500" />
                                <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-sm outline-none focus:border-primary-500" />
                            </div>
                            <button type="submit" class="w-full py-2 bg-slate-100 text-slate-700 text-xs font-bold rounded-lg hover:bg-slate-200 transition-colors">Terapkan Harga</button>
                        </div>
                    </div>

                    <!-- Rating -->
                    <div>
                        <h3 class="font-bold text-slate-900 mb-5 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary-600">star</span>
                            Rating Minimum
                        </h3>
                        <div class="space-y-3">
                            @foreach([5, 4, 3, 2, 1] as $star)
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" name="rating" value="{{ $star }}" class="w-5 h-5 border-slate-300 text-primary-600 focus:ring-primary-500" {{ request('rating') == $star ? 'checked' : '' }} onchange="this.form.submit()" />
                                <div class="flex items-center text-amber-400">
                                    @for($i=1; $i<=5; $i++)
                                        <span class="material-symbols-outlined text-sm" style="{{ $i <= $star ? "font-variation-settings: 'FILL' 1;" : '' }}">star</span>
                                    @endfor
                                    <span class="text-slate-500 text-xs ml-2">{{ $star }}+</span>
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <a href="{{ route('costumer.buku.index') }}" class="block text-center text-xs text-rose-600 font-medium hover:underline">Reset Semua Filter</a>
                </form>
            </aside>

            <!-- Book Grid -->
            <div class="flex-grow">
                @if(request('search'))
                    <div class="mb-8 flex items-center justify-between">
                        <p class="text-slate-600 text-sm">
                            Menampilkan hasil pencarian untuk "<span class="font-bold text-slate-900">{{ request('search') }}</span>"
                        </p>
                        <a href="{{ route('costumer.buku.index') }}" class="text-xs text-rose-600 font-bold hover:underline">Hapus Pencarian</a>
                    </div>
                @endif

                @if($books->isEmpty())
                    <div class="py-20 text-center bg-slate-50 rounded-3xl border border-slate-100/80">
                        <span class="material-symbols-outlined text-6xl text-slate-300 mb-4 block">search_off</span>
                        <h3 class="text-lg font-bold text-slate-800 mb-1">Buku tidak ditemukan</h3>
                        <p class="text-sm text-slate-500 max-w-sm mx-auto">Kami tidak dapat menemukan buku yang sesuai dengan pencarian atau filter Anda. Silakan coba kata kunci lain atau reset filter Anda.</p>
                        <a href="{{ route('costumer.buku.index') }}" class="inline-block mt-6 px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md transition-all active:scale-[0.98]">Reset Pencarian & Filter</a>
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-8">
                        @foreach($books as $book)
                        <div class="group flex flex-col h-full bg-white rounded-2xl p-4 shadow-sm border border-slate-100 hover:shadow-xl hover:border-primary-100 transition-all duration-300">
                            <a href="{{ route('costumer.buku.show', $book->id) }}" class="block relative w-full aspect-[2/3] rounded-xl overflow-hidden mb-5 bg-slate-100">
                                @if($book->sampul)
                                    <img src="{{ asset('storage/' . $book->sampul) }}" alt="{{ $book->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-slate-200">
                                        <span class="material-symbols-outlined text-4xl text-slate-400">auto_stories</span>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-slate-900/0 group-hover:bg-slate-900/10 transition-colors duration-300"></div>
                            </a>
                            <div class="flex flex-col flex-grow">
                                <p class="text-xs font-semibold tracking-wider text-primary-600 uppercase mb-1">{{ $book->penulis }}</p>
                                <a href="{{ route('costumer.buku.show', $book->id) }}">
                                    <h3 class="font-serif text-lg font-bold text-slate-900 mb-1 group-hover:text-primary-600 transition-colors line-clamp-2">{{ $book->judul }}</h3>
                                </a>
                                <div class="flex items-center text-amber-400 text-sm mb-4">
                                    @for($i=1; $i<=5; $i++)
                                        <span class="material-symbols-outlined text-[16px] {{ $i <= $book->rating ? 'fill-current' : '' }}" style="{{ $i <= $book->rating ? "font-variation-settings: 'FILL' 1;" : '' }}">star</span>
                                    @endfor
                                    <span class="text-slate-400 text-xs ml-2">({{ $book->rating }})</span>
                                </div>
                                <div class="mt-auto flex items-center justify-between">
                                    <p class="text-lg font-bold text-slate-800">Rp {{ number_format($book->harga, 0, ',', '.') }}</p>
                                    <form action="{{ route('cart.add', $book->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-10 h-10 rounded-full bg-primary-50 text-primary-600 flex items-center justify-center hover:bg-primary-600 hover:text-white transition-colors">
                                            <span class="material-symbols-outlined text-[20px]">add_shopping_cart</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </main>
@endsection