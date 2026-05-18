<footer
    class="border-t border-slate-200/80 p-6 bg-white md:p-8 lg:p-10 dark:bg-slate-900 dark:border-slate-800 transition-colors duration-200">
    <div class="mx-auto max-w-screen-xl text-center">
        <ul
            class="flex flex-wrap justify-center items-center mb-6 text-slate-700 dark:text-slate-300 font-medium text-sm gap-y-2">
            <li>
                <a href="{{ route('costumer.index') }}"
                    class="mr-4 hover:text-blue-600 dark:hover:text-blue-400 transition-colors md:mr-6">Beranda</a>
            </li>
            <li>
                <a href="{{ route('costumer.buku.index') }}"
                    class="mr-4 hover:text-blue-600 dark:hover:text-blue-400 transition-colors md:mr-6">Katalog
                    Buku</a>
            </li>
            <li>
                <a href="{{ route('costumer.about') }}"
                    class="mr-4 hover:text-blue-600 dark:hover:text-blue-400 transition-colors md:mr-6">Tentang
                    Kami</a>
            </li>
            <li>
                <a href="{{ route('costumer.keranjang') }}"
                    class="mr-4 hover:text-blue-600 dark:hover:text-blue-400 transition-colors md:mr-6">Keranjang</a>
            </li>
        </ul>
        <span class="text-xs text-slate-400 dark:text-slate-500 block">
            &copy; 2026
            <a href="{{ route('costumer.index') }}"
                class="hover:underline font-bold text-blue-600 dark:text-blue-400">RyuuBook Bookstore</a>.
            All Rights Reserved.
        </span>
    </div>
</footer>