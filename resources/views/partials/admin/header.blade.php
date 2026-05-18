<header class="sticky top-0 z-999 flex w-full border-b border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">
  <div class="flex grow items-center justify-between px-4 py-4 md:px-6 2xl:px-11">
    <div class="flex items-center gap-2 sm:gap-4 lg:hidden">
      <button
        class="z-99999 block rounded-lg border border-gray-200 bg-white p-1.5 shadow-sm dark:border-gray-800 dark:bg-gray-900"
        @click.stop="sidebarToggle = !sidebarToggle"
      >
        <span class="material-symbols-outlined block">menu</span>
      </button>
    </div>

    <div class="hidden sm:block">
      <form action="#" method="POST">
        <div class="relative">
          <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
            <span class="material-symbols-outlined text-xl">search</span>
          </span>
          <input
            type="text"
            placeholder="Cari sesuatu..."
            class="w-full rounded-xl border border-gray-200 bg-gray-50 py-2.5 pl-12 pr-4 text-sm outline-none transition-all focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 dark:border-gray-800 dark:bg-gray-800 dark:text-white xl:w-[400px]"
          />
        </div>
      </form>
    </div>

    <div class="flex items-center gap-3 2xsm:gap-7">
      <div class="flex gap-2">
        <button class="relative flex h-10 w-10 items-center justify-center rounded-full border border-gray-200 bg-gray-50 text-gray-500 hover:text-brand-500 dark:border-gray-800 dark:bg-gray-800">
          <span class="material-symbols-outlined text-xl">notifications</span>
          <span class="absolute right-2 top-2 h-2 w-2 rounded-full bg-error-500"></span>
        </button>
        <button @click="darkMode = !darkMode" class="flex h-10 w-10 items-center justify-center rounded-full border border-gray-200 bg-gray-50 text-gray-500 hover:text-brand-500 dark:border-gray-800 dark:bg-gray-800">
          <span class="material-symbols-outlined text-xl" x-show="!darkMode">dark_mode</span>
          <span class="material-symbols-outlined text-xl" x-show="darkMode">light_mode</span>
        </button>
      </div>

      <div class="relative" x-data="{ userOpen: false }" @click.outside="userOpen = false">
        <button @click="userOpen = !userOpen" class="flex items-center gap-3 text-left">
          <span class="hidden text-right lg:block">
            <span class="block text-sm font-semibold text-gray-900 dark:text-white">Admin Bookstore</span>
            <span class="block text-xs text-gray-500">Administrator</span>
          </span>
          <span class="h-10 w-10 rounded-full bg-brand-100 flex items-center justify-center text-brand-600 font-bold">
            A
          </span>
          <span class="material-symbols-outlined text-gray-400 transition-transform" :class="userOpen ? 'rotate-180' : ''">expand_more</span>
        </button>

        <div x-show="userOpen" class="absolute right-0 mt-4 w-56 rounded-2xl border border-gray-200 bg-white p-2 shadow-theme-lg dark:border-gray-800 dark:bg-gray-900">
          <a href="#" class="flex items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-white/5">
            <span class="material-symbols-outlined text-xl text-gray-400">person</span>
            Profil Saya
          </a>
          <a href="#" class="flex items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-white/5">
            <span class="material-symbols-outlined text-xl text-gray-400">settings</span>
            Pengaturan Akun
          </a>
          <hr class="my-2 border-gray-100 dark:border-gray-800" />
          <form action="/logout" method="POST">
            @csrf
            <button type="submit" class="flex w-full items-center gap-3 rounded-xl px-4 py-2.5 text-sm font-medium text-error-600 hover:bg-error-50 dark:hover:bg-error-500/10">
              <span class="material-symbols-outlined text-xl">logout</span>
              Keluar
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</header>
