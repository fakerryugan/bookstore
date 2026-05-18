<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tentang Kami | Ryuu Book</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@300,0..1&display=swap" rel="stylesheet" />
</head>
<body class="font-sans text-slate-800 bg-slate-50 antialiased selection:bg-primary-500 selection:text-white">

    <nav class="fixed w-full z-50 glass shadow-sm" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <a href="{{ route('costumer.index') }}" class="flex items-center gap-2 group">
                    <span class="material-symbols-outlined text-primary-600 text-3xl group-hover:rotate-12 transition-transform duration-300">menu_book</span>
                    <span class="font-serif text-2xl font-bold text-slate-900 tracking-tight">Ryuu<span class="text-primary-600">Book</span></span>
                </a>

                <div class="hidden md:flex space-x-8 items-center">
                    <a href="{{ route('costumer.index') }}" class="text-slate-600 hover:text-primary-600 font-medium transition-colors">Beranda</a>
                    <a href="{{ route('costumer.buku.index') }}" class="text-slate-600 hover:text-primary-600 font-medium transition-colors">Katalog</a>
                    <a href="{{ route('costumer.about') }}" class="text-primary-600 font-medium border-b-2 border-primary-600 pb-1">Tentang Kami</a>
                </div>

                <div class="flex items-center space-x-5">
                    <a href="{{ route('costumer.keranjang') }}" class="text-slate-600 hover:text-primary-600 transition-colors relative group">
                        <span class="material-symbols-outlined text-2xl group-hover:scale-110 transition-transform">shopping_cart</span>
                        <span class="absolute -top-1 -right-2 bg-rose-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full shadow-sm">2</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="pt-32 pb-20 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h1 class="font-serif text-4xl md:text-5xl font-bold text-slate-900 mb-6">Tentang Ryuu Book</h1>
                <p class="text-lg text-slate-600 max-w-2xl mx-auto font-light leading-relaxed">
                    Kami percaya bahwa setiap buku adalah jendela menuju dunia baru. Ryuu Book hadir untuk memberikan kurasi terbaik bagi jiwa-jiwa yang haus akan literasi.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center mb-24">
                <div class="relative">
                    <div class="aspect-[4/3] rounded-3xl overflow-hidden shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1507842217343-583bb7270b66?auto=format&fit=crop&w=1200&q=80" alt="Our Library" class="w-full h-full object-cover">
                    </div>
                    <div class="absolute -bottom-6 -right-6 bg-white p-6 rounded-2xl shadow-xl border border-slate-100 hidden md:block">
                        <p class="font-serif text-2xl font-bold text-primary-600">10k+</p>
                        <p class="text-xs text-slate-500 font-medium uppercase tracking-wider">Koleksi Buku</p>
                    </div>
                </div>
                <div>
                    <h2 class="font-serif text-3xl font-bold text-slate-900 mb-6">Misi Kami</h2>
                    <p class="text-slate-600 mb-6 leading-relaxed">
                        Ryuu Book didirikan pada tahun 2024 dengan satu tujuan sederhana: menghidupkan kembali budaya membaca di tengah kebisingan era digital. Kami memilih setiap buku dengan hati, memastikan hanya karya berkualitas yang sampai ke tangan Anda.
                    </p>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary-600">check_circle</span>
                            <span class="text-slate-700 font-medium">Kurasi buku sastra dan fiksi premium.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary-600">check_circle</span>
                            <span class="text-slate-700 font-medium">Pengalaman belanja yang menenangkan dan intuitif.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary-600">check_circle</span>
                            <span class="text-slate-700 font-medium">Mendukung komunitas literasi lokal.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-white border-t border-slate-200 py-12 text-center">
        <p class="text-sm text-slate-500">&copy; 2026 Ryuu Book. Keheningan dalam Literasi.</p>
    </footer>
</body>
</html>
