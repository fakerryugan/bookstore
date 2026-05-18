<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Verifikasi Email | Ryuu Book</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@300,0..1&display=swap" rel="stylesheet"/>
</head>
<body class="font-sans text-slate-800 bg-slate-50 antialiased min-h-screen flex flex-col">

    <main class="flex-grow flex items-center justify-center py-24 relative overflow-hidden">
        <!-- Background Decorations -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10">
            <div class="absolute -top-[20%] -right-[10%] w-[70%] h-[70%] rounded-full bg-gradient-to-br from-primary-100 to-blue-100 blur-3xl opacity-50"></div>
            <div class="absolute -bottom-[20%] -left-[10%] w-[60%] h-[60%] rounded-full bg-gradient-to-tr from-rose-100 to-orange-50 blur-3xl opacity-50"></div>
        </div>

        <div class="w-full max-w-lg mx-auto px-4 sm:px-6 relative z-10">
            <div class="bg-white/80 backdrop-blur-xl border border-white/50 p-8 sm:p-12 rounded-3xl shadow-xl text-center">
                
                <div class="mb-8">
                    <div class="w-20 h-20 bg-primary-50 text-primary-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <span class="material-symbols-outlined text-4xl">mark_email_read</span>
                    </div>
                    <h1 class="font-serif text-3xl font-bold text-slate-900 mb-3">Verifikasi Email Anda</h1>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Terima kasih telah mendaftar! Sebelum memulai, silakan verifikasi alamat email Anda dengan mengeklik tautan yang baru saja kami kirimkan.
                    </p>
                </div>

                @if (session('message'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-100 text-green-600 rounded-xl text-sm font-medium animate-pulse">
                        {{ session('message') }}
                    </div>
                @endif

                <div class="space-y-4">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="w-full bg-slate-900 hover:bg-primary-600 text-white font-bold py-4 px-6 rounded-xl shadow-lg hover:shadow-primary-500/30 transition-all duration-300 flex items-center justify-center gap-2 group">
                            Kirim Ulang Email Verifikasi
                            <span class="material-symbols-outlined text-[20px] group-hover:translate-x-1 transition-transform">send</span>
                        </button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-slate-500 hover:text-slate-800 text-sm font-medium transition-colors">
                            Keluar dari Sesi
                        </button>
                    </form>
                </div>

                <div class="mt-12 pt-8 border-t border-slate-100">
                    <p class="text-xs text-slate-400">
                        Belum menerima email? Periksa folder spam Anda atau klik tombol kirim ulang di atas.
                    </p>
                </div>
            </div>

            <!-- Logo Footer -->
            <div class="mt-8 text-center">
                <a href="/" class="flex items-center justify-center gap-2 opacity-60 grayscale hover:grayscale-0 hover:opacity-100 transition-all">
                    <span class="material-symbols-outlined text-primary-600 text-2xl">menu_book</span>
                    <span class="font-serif text-xl font-bold text-slate-900 tracking-tight">Ryuu<span class="text-primary-600">Book</span></span>
                </a>
            </div>
        </div>
    </main>

</body>
</html>