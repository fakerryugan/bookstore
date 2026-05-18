<aside
  :class="sidebarToggle ? 'translate-x-0 lg:w-[290px]' : '-translate-x-full lg:translate-x-0 lg:w-[90px]'"
  class="fixed left-0 top-0 z-9999 flex h-screen w-[290px] flex-col overflow-y-hidden border-r border-gray-200 bg-white transition-all duration-300 dark:border-gray-800 dark:bg-gray-900 lg:static"
  @mouseenter="sidebarHover = true"
  @mouseleave="sidebarHover = false"
>
  <div class="flex items-center justify-between gap-2 px-6 py-8">
    <a href="/admin" class="flex items-center gap-3">
      <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-brand-500 text-white shadow-lg shadow-brand-500/30">
        <span class="material-symbols-outlined">menu_book</span>
      </span>
      <span x-show="sidebarToggle || sidebarHover" x-cloak class="font-serif text-xl font-bold text-gray-900 dark:text-white">Ryuu<span class="text-brand-500">Book</span></span>
    </a>
  </div>

  <div class="flex flex-col overflow-y-auto no-scrollbar">
    <nav class="px-4 py-4 lg:px-6">
      <div>
        <h3 class="mb-4 text-xs font-semibold uppercase tracking-wider text-gray-400" x-show="sidebarToggle || sidebarHover" x-cloak>
          MENU UTAMA
        </h3>
        <ul class="flex flex-col gap-2">
          <li>
            <a href="/admin" class="menu-item {{ request()->is('admin') ? 'menu-item-active' : 'menu-item-inactive' }}">
              <span class="material-symbols-outlined">dashboard</span>
              <span x-show="sidebarToggle || sidebarHover" x-cloak>Dashboard</span>
            </a>
          </li>
          <li>
            <a href="/admin/buku" class="menu-item {{ request()->is('admin/buku*') ? 'menu-item-active' : 'menu-item-inactive' }}">
              <span class="material-symbols-outlined">book</span>
              <span x-show="sidebarToggle || sidebarHover">Kelola Buku</span>
            </a>
          </li>
          <li>
            <a href="/admin/kategori" class="menu-item {{ request()->is('admin/kategori*') ? 'menu-item-active' : 'menu-item-inactive' }}">
              <span class="material-symbols-outlined">category</span>
              <span x-show="sidebarToggle || sidebarHover">Kategori</span>
            </a>
          </li>
          <li>
            <a href="/admin/transaksi" class="menu-item {{ request()->is('admin/transaksi*') ? 'menu-item-active' : 'menu-item-inactive' }}">
              <span class="material-symbols-outlined">receipt_long</span>
              <span x-show="sidebarToggle || sidebarHover">Transaksi</span>
          <li>
            <a href="{{ route('admin.chat.index') }}" class="menu-item {{ request()->is('admin/chat*') ? 'menu-item-active' : 'menu-item-inactive' }}">
              <span class="material-symbols-outlined">chat</span>
              <span x-show="sidebarToggle || sidebarHover">Chat Pelanggan</span>
              <span class="ml-auto bg-green-500 text-white text-[9px] px-1.5 py-0.5 rounded-full font-bold animate-pulse" x-show="sidebarToggle || sidebarHover">Live</span>
            </a>
          </li>
        </ul>
      </div>

      <div class="mt-8">
        <h3 class="mb-4 text-xs font-semibold uppercase tracking-wider text-gray-400" x-show="sidebarToggle || sidebarHover" x-cloak>
          PENGATURAN
        </h3>
        <ul class="flex flex-col gap-2">
          <li>
            <a href="{{ route('admin.profile.edit') }}" class="menu-item {{ request()->is('admin/profile*') ? 'menu-item-active' : 'menu-item-inactive' }}">
              <span class="material-symbols-outlined">account_circle</span>
              <span x-show="sidebarToggle || sidebarHover">Profil Saya</span>
            </a>
          </li>
          <li>
            <a href="/admin/users" class="menu-item {{ request()->is('admin/users*') ? 'menu-item-active' : 'menu-item-inactive' }}">
              <span class="material-symbols-outlined">group</span>
              <span x-show="sidebarToggle || sidebarHover">Pelanggan</span>
            </a>
          </li>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</aside>
