<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Daftar | Ryuu Book</title>
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
                    Kembali
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
                    <h1 class="font-serif text-3xl font-bold text-slate-900 mb-2">Buat Akun</h1>
                    <p class="text-slate-500 text-sm">Bergabunglah dengan ribuan pembaca setia lainnya</p>
                </div>
                
                <form class="space-y-5" action="/register" method="POST">
                    @csrf

                    @if($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl text-sm font-medium">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    
                    <div>
                        <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap</label>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary-600 transition-colors">person</span>
                            <input type="text" id="name" name="name" class="w-full pl-12 pr-4 py-3 bg-white border border-slate-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all text-slate-700 placeholder-slate-400 shadow-sm" placeholder="Nama Anda" required>
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">Email</label>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary-600 transition-colors">mail</span>
                            <input type="email" id="email" name="email" class="w-full pl-12 pr-4 py-3 bg-white border border-slate-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all text-slate-700 placeholder-slate-400 shadow-sm" placeholder="nama@email.com" required>
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">Kata Sandi</label>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary-600 transition-colors">lock</span>
                            <input type="password" id="password" name="password" class="w-full pl-12 pr-12 py-3 bg-white border border-slate-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all text-slate-700 placeholder-slate-400 shadow-sm" placeholder="••••••••" required>
                        </div>
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-2">Ulangi Kata Sandi</label>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary-600 transition-colors">lock_reset</span>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="w-full pl-12 pr-12 py-3 bg-white border border-slate-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all text-slate-700 placeholder-slate-400 shadow-sm" placeholder="••••••••" required>
                        </div>
                    </div>

                    <div class="flex items-start mt-2">
                        <div class="flex items-center h-5">
                            <input id="terms" type="checkbox" class="w-4 h-4 text-primary-600 bg-white border-slate-300 rounded focus:ring-primary-500 focus:ring-2 cursor-pointer" required>
                        </div>
                        <label for="terms" class="ml-2 text-xs text-slate-500 leading-relaxed cursor-pointer">
                            Saya menyetujui <a href="#" class="text-primary-600 hover:underline">Syarat & Ketentuan</a> serta <a href="#" class="text-primary-600 hover:underline">Kebijakan Privasi</a> Ryuu Book.
                        </label>
                    </div>

                    <button type="submit" class="w-full bg-slate-900 hover:bg-primary-600 text-white font-bold py-3.5 px-4 rounded-xl shadow-lg hover:shadow-primary-500/30 transition-all duration-300 active:scale-[0.98] mt-2">
                        Daftar Sekarang
                    </button>
                </form>

                <p class="mt-8 text-center text-sm text-slate-600">
                    Sudah punya akun? <a href="/login" class="font-bold text-primary-600 hover:text-primary-700 hover:underline transition-all">Masuk di sini</a>
                </p>
            </div>
        </div>
    </main>

    <footer class="bg-white border-t border-slate-200 py-6 text-center text-sm text-slate-500">
        &copy; 2026 Ryuu Book. Keheningan dalam Literasi.
    </footer>
</body>
</html>