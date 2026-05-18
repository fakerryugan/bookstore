<nav class="fixed w-full z-50 bg-white/80 backdrop-blur-md border-b border-gray-100 shadow-sm" id="navbar">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            
            <a href="{{ route('costumer.index') }}" class="flex items-center gap-2 group">
                <span class="material-symbols-outlined text-blue-600 text-3xl group-hover:rotate-12 transition-transform duration-300">menu_book</span>
                <span class="font-serif text-2xl font-bold text-gray-900 tracking-tight">Ryuu<span class="text-blue-600">Book</span></span>
            </a>

            <div class="hidden md:flex space-x-8 items-center">
                <a href="{{ route('costumer.index') }}" 
                   class="{{ Request::is('/') || Request::is('dashboard') ? 'text-blue-600 border-b-2 border-blue-600 pb-1' : 'text-gray-600 hover:text-blue-600' }} font-medium transition-colors">Beranda</a>
                
                <a href="{{ route('costumer.buku.index') }}" 
                   class="{{ Request::is('buku*') ? 'text-blue-600 border-b-2 border-blue-600 pb-1' : 'text-gray-600 hover:text-blue-600' }} font-medium transition-colors">Katalog</a>
                
                <a href="{{ route('costumer.about') }}" 
                   class="{{ Request::is('about-us*') ? 'text-blue-600 border-b-2 border-blue-600 pb-1' : 'text-gray-600 hover:text-blue-600' }} font-medium transition-colors">Tentang Kami</a>
            </div>

            <div class="flex items-center space-x-5">
                
                <a href="{{ route('costumer.keranjang') }}" class="text-gray-600 hover:text-blue-600 transition-colors relative group">
                    <span class="material-symbols-outlined text-2xl group-hover:scale-110 transition-transform">shopping_cart</span>
                    
                    <span class="absolute -top-1 -right-2 bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full shadow-sm">
                        {{ collect(session('cart'))->count() }}
                    </span>
                </a>
                
                <div class="h-6 w-px bg-gray-200"></div>
                
                @auth
                <a href="{{ route('costumer.dashboard') }}" class="flex items-center gap-3 group">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs font-bold text-gray-900 leading-tight">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] text-blue-600 font-medium">Customer Member</p>
                    </div>
                    <div class="w-10 h-10 rounded-full border-2 border-blue-100 p-0.5 group-hover:border-blue-500 transition-colors overflow-hidden">
                        <img src="{{ auth()->user()->photo ? asset('storage/' . auth()->user()->photo) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=0D8ABC&color=fff&size=100' }}" alt="User" class="w-full h-full rounded-full object-cover">
                    </div>
                </a>
                @else
                <a href="/login" class="text-gray-600 hover:text-blue-600 transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined text-2xl">account_circle</span>
                    <span class="text-sm font-medium hidden sm:inline">Masuk</span>
                </a>
                @endauth
                
            </div>
        </div>
    </div>
</nav>