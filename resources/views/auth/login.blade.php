<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Masuk | Ryuu Book</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@300,0..1&display=swap" rel="stylesheet"/>
</head>
<body class="font-sans text-slate-800 bg-slate-50 antialiased selection:bg-primary-500 selection:text-white min-h-screen flex flex-col">

    <nav class="w-full z-50 glass shadow-sm absolute top-0" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <a href="{{ route('costumer.index') }}" class="flex items-center gap-2 group">
                    <span class="material-symbols-outlined text-primary-600 text-3xl group-hover:rotate-12 transition-transform duration-300">menu_book</span>
                    <span class="font-serif text-2xl font-bold text-slate-900 tracking-tight">Ryuu<span class="text-primary-600">Book</span></span>
                </a>
                <a href="{{ route('costumer.index') }}" class="text-slate-500 hover:text-primary-600 font-medium transition-colors flex items-center gap-1">
                    <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </nav>

    <main class="flex-grow flex items-center justify-center py-24 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10">
            <div class="absolute -top-[20%] -right-[10%] w-[70%] h-[70%] rounded-full bg-gradient-to-br from-primary-100 to-blue-100 blur-3xl opacity-50"></div>
            <div class="absolute -bottom-[20%] -left-[10%] w-[60%] h-[60%] rounded-full bg-gradient-to-tr from-rose-100 to-orange-50 blur-3xl opacity-50"></div>
        </div>

        <div class="w-full max-w-md mx-auto px-4 sm:px-6 relative z-10">
            <div class="bg-white/80 backdrop-blur-xl border border-white/50 p-8 sm:p-10 rounded-3xl shadow-xl">
                <div class="text-center mb-8">
                    <h1 class="font-serif text-3xl font-bold text-slate-900 mb-2">Selamat Datang</h1>
                    <p class="text-slate-500 text-sm">Masuk untuk melanjutkan perjalanan literasi Anda</p>
                </div>
                
                <form class="space-y-6" action="/login" method="POST">
                    @csrf
                    
                    @if($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl text-sm font-medium">
                        {{ $errors->first() }}
                    </div>
                    @endif
                    
                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">Email</label>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary-600 transition-colors">mail</span>
                            <input type="email" id="email" name="email" class="w-full pl-12 pr-4 py-3 bg-white border border-slate-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all text-slate-700 placeholder-slate-400 shadow-sm" placeholder="nama@email.com" required>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label for="password" class="block text-sm font-semibold text-slate-700">Kata Sandi</label>
                            <a href="#" class="text-xs font-semibold text-primary-600 hover:text-primary-700 transition-colors">Lupa sandi?</a>
                        </div>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary-600 transition-colors">lock</span>
                            <input type="password" id="password" name="password" class="w-full pl-12 pr-12 py-3 bg-white border border-slate-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all text-slate-700 placeholder-slate-400 shadow-sm" placeholder="••••••••" required>
                            <button type="button" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition-colors focus:outline-none">
                                <span class="material-symbols-outlined text-[20px]">visibility</span>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember" class="w-4 h-4 text-primary-600 bg-white border-slate-300 rounded focus:ring-primary-500 focus:ring-2 cursor-pointer">
                        <label for="remember" class="ml-2 text-sm text-slate-600 cursor-pointer">Ingat saya</label>
                    </div>

                    <button type="submit" class="w-full bg-slate-900 hover:bg-primary-600 text-white font-bold py-3.5 px-4 rounded-xl shadow-lg hover:shadow-primary-500/30 transition-all duration-300 active:scale-[0.98] flex items-center justify-center gap-2 group">
                        Masuk Sekarang
                        <span class="material-symbols-outlined text-[18px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </button>
                </form>

                <p class="mt-8 text-center text-sm text-slate-600">
                    Belum punya akun? <a href="/register" class="font-bold text-primary-600 hover:text-primary-700 hover:underline transition-all">Daftar di sini</a>
                </p>
            </div>
        </div>
    </main>

    <footer class="bg-white border-t border-slate-200 py-6 text-center text-sm text-slate-500">
        &copy; 2026 Ryuu Book. Keheningan dalam Literasi.
    </footer>
</body>
</html>