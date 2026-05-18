@extends('layouts.customer')

@section('content')
    <div class="pt-32 pb-20 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Dashboard -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
                <div>
                    <h1 class="font-serif text-3xl font-bold text-slate-900">Halo, {{ $user->name }}!</h1>
                    <p class="text-slate-500">Selamat datang kembali di dashboard belanja Anda.</p>
                </div>
                <div class="flex items-center gap-3">
                    <span class="px-4 py-2 bg-white rounded-xl border border-slate-200 text-sm font-medium text-slate-600">
                        {{ now()->format('d F Y') }}
                    </span>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-xl bg-primary-50 flex items-center justify-center text-primary-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500 font-medium">Total Belanja</p>
                            <h3 class="text-xl font-bold text-slate-900">Rp
                                {{ number_format($stats['total_spent'], 0, ',', '.') }}
                            </h3>
                        </div>
                    </div>
                    <div class="h-1 w-full bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full bg-primary-500 w-full"></div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center text-amber-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500 font-medium">Total Pesanan</p>
                            <h3 class="text-xl font-bold text-slate-900">{{ $stats['total_orders'] }}</h3>
                        </div>
                    </div>
                    <div class="h-1 w-full bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full bg-amber-500 w-full"></div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500 font-medium">Menunggu Bayar</p>
                            <h3 class="text-xl font-bold text-slate-900">{{ $stats['pending_payments'] }}</h3>
                        </div>
                    </div>
                    <div class="h-1 w-full bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full bg-blue-500 w-1/2"></div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-xl bg-rose-50 flex items-center justify-center text-rose-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                            </svg>

                        </div>
                        <div>
                            <p class="text-sm text-slate-500 font-medium">Gagal</p>
                            <h3 class="text-xl font-bold text-slate-900">{{ $stats['failed_orders'] }}</h3>
                        </div>
                    </div>
                    <div class="h-1 w-full bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full bg-rose-500 w-0"></div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Riwayat Pesanan -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                        <div class="p-8 border-b border-slate-100 flex items-center justify-between">
                            <h2 class="font-serif text-xl font-bold text-slate-900">Riwayat Pesanan</h2>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead>
                                    <tr class="bg-slate-50 text-slate-500 text-xs font-bold uppercase tracking-wider">
                                        <th class="px-8 py-4">Order ID</th>
                                        <th class="px-8 py-4">Buku</th>
                                        <th class="px-8 py-4">Total</th>
                                        <th class="px-8 py-4">Status</th>
                                        <th class="px-8 py-4">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @forelse($transactions as $trx)
                                        <tr>
                                            <td class="px-8 py-5 text-sm font-bold text-slate-700">#{{ $trx->order_id }}</td>
                                            <td class="px-8 py-5">
                                                <div class="flex -space-x-3 overflow-hidden">
                                                    @foreach($trx->items->take(3) as $item)
                                                        <img class="inline-block h-10 w-8 rounded border-2 border-white object-cover"
                                                            src="{{ asset('storage/' . $item->book->sampul) }}" alt="">
                                                    @endforeach
                                                    @if($trx->items->count() > 3)
                                                        <div
                                                            class="flex h-10 w-10 items-center justify-center rounded-full border-2 border-white bg-slate-100 text-xs font-bold text-slate-500">
                                                            +{{ $trx->items->count() - 3 }}</div>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-8 py-5 text-sm font-bold text-slate-900">Rp
                                                {{ number_format($trx->total_amount, 0, ',', '.') }}
                                            </td>
                                            <td class="px-8 py-5">
                                                @if($trx->status == 'success')
                                                    <span
                                                        class="px-3 py-1 rounded-full bg-green-50 text-green-600 text-xs font-bold">Berhasil</span>
                                                @elseif($trx->status == 'pending')
                                                    <span
                                                        class="px-3 py-1 rounded-full bg-amber-50 text-amber-600 text-xs font-bold">Pending</span>
                                                @else
                                                    <span
                                                        class="px-3 py-1 rounded-full bg-rose-50 text-rose-600 text-xs font-bold">Gagal</span>
                                                @endif
                                            </td>
                                            <td class="px-8 py-5">
                                                <a href="{{ route('costumer.transaction.show', $trx->id) }}"
                                                    class="text-primary-600 hover:text-primary-700 font-bold text-sm">Detail</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-8 py-12 text-center text-slate-500">
                                                <span
                                                    class="material-symbols-outlined text-5xl mb-4 block opacity-20">order_approve</span>
                                                Belum ada riwayat pesanan.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Profil & Akun -->
                <div class="space-y-8">
                    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-8 text-center">
                        <div class="relative w-24 h-24 mx-auto mb-6">
                            <img src="{{ $user->photo ? asset('storage/' . $user->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=0D8ABC&color=fff&size=128' }}" alt="Avatar" class="w-full h-full rounded-full border-4 border-slate-50 shadow-sm object-cover" />
                            <a href="{{ route('profile.edit') }}" class="absolute bottom-0 right-0 w-8 h-8 bg-primary-600 text-white rounded-full flex items-center justify-center border-2 border-white shadow-lg">
                                <span class="material-symbols-outlined text-sm">edit</span>
                            </a>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-1">{{ $user->name }}</h3>
                        <p class="text-slate-500 text-sm mb-6">{{ $user->email }}</p>
                        <div class="pt-6 border-t border-slate-50">
                            <a href="{{ route('profile.edit') }}" class="block w-full py-3 bg-slate-900 text-white rounded-xl font-bold hover:bg-slate-800 transition-all mb-3">Edit Profil</a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full py-3 bg-white text-rose-600 border border-rose-100 rounded-xl font-bold hover:bg-rose-50 transition-all text-sm">Keluar
                                    Akun</button>
                            </form>
                        </div>
                    </div>

                    <!-- Alamat Pengiriman Card -->
                    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-8 space-y-6" x-data="{ showAddForm: false }">
                        <div class="flex items-center justify-between">
                            <h3 class="font-bold text-slate-800 flex items-center gap-2">
                                <span class="material-symbols-outlined text-[20px] text-blue-600">location_on</span>
                                Alamat Pengiriman
                            </h3>
                            <button @click="showAddForm = !showAddForm" class="text-blue-600 hover:text-blue-700 font-bold text-xs flex items-center gap-1">
                                <span class="material-symbols-outlined text-[16px]" x-text="showAddForm ? 'close' : 'add'">add</span>
                                <span x-text="showAddForm ? 'Batal' : 'Tambah'">Tambah</span>
                            </button>
                        </div>

                        <!-- Flash Message untuk Alamat -->
                        @if(session('success_address'))
                            <div class="p-3 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-xl text-xs flex items-center gap-2">
                                <span class="material-symbols-outlined text-[16px]">check_circle</span>
                                <span>{{ session('success_address') }}</span>
                            </div>
                        @endif

                        <!-- Form Tambah Alamat Baru -->
                        <div x-show="showAddForm" x-transition class="bg-slate-50 p-4 rounded-2xl border border-slate-100 space-y-3">
                            <h4 class="font-bold text-slate-700 text-xs">Tambah Alamat Baru</h4>
                            <form action="{{ route('costumer.alamat.store') }}" method="POST" class="space-y-3">
                                @csrf
                                <div>
                                    <label class="block text-[9px] font-bold text-slate-500 mb-1">NAMA PENERIMA</label>
                                    <input type="text" name="nama_penerima" required placeholder="cth: John Doe" class="w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs outline-none focus:border-blue-500" />
                                </div>
                                <div>
                                    <label class="block text-[9px] font-bold text-slate-500 mb-1">NOMOR TELEPON</label>
                                    <input type="text" name="telepon" required placeholder="cth: 0812xxxxxxxx" class="w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs outline-none focus:border-blue-500" />
                                </div>
                                <div>
                                    <label class="block text-[9px] font-bold text-slate-500 mb-1">ALAMAT LENGKAP</label>
                                    <textarea name="alamat_lengkap" required rows="2" placeholder="Jalan, No. Rumah, RT/RW, Kecamatan" class="w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs outline-none focus:border-blue-500 resize-none"></textarea>
                                </div>
                                <div class="grid grid-cols-2 gap-2">
                                    <div>
                                        <label class="block text-[9px] font-bold text-slate-500 mb-1">KOTA</label>
                                        <input type="text" name="kota" required placeholder="cth: Bandung" class="w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs outline-none focus:border-blue-500" />
                                    </div>
                                    <div>
                                        <label class="block text-[9px] font-bold text-slate-500 mb-1">KODE POS</label>
                                        <input type="text" name="kode_pos" required placeholder="cth: 40123" class="w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs outline-none focus:border-blue-500" />
                                    </div>
                                </div>
                                <button type="submit" class="w-full py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-xs font-bold transition-all">Simpan Alamat</button>
                            </form>
                        </div>

                        <!-- Daftar Alamat Tersimpan -->
                        <div class="space-y-4">
                            @forelse($addresses as $addr)
                                <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100 space-y-2 relative group/item">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-1.5">
                                            <span class="font-bold text-slate-800 text-xs">{{ $addr->nama_penerima }}</span>
                                            @if($addr->is_default)
                                                <span class="px-2 py-0.5 bg-blue-50 text-blue-600 font-bold text-[8px] rounded uppercase tracking-wider">Utama</span>
                                            @endif
                                        </div>
                                        <div class="flex items-center gap-2">
                                            @if(!$addr->is_default)
                                                <form action="{{ route('costumer.alamat.default', $addr->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="text-slate-400 hover:text-blue-600 text-[10px] font-bold">Set Utama</button>
                                                </form>
                                            @endif
                                            <form action="{{ route('costumer.alamat.destroy', $addr->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus alamat ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-slate-300 hover:text-rose-600">
                                                    <span class="material-symbols-outlined text-[16px]">delete</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="text-[11px] text-slate-500 leading-relaxed">
                                        <p>{{ $addr->alamat_lengkap }}</p>
                                        <p class="text-slate-400 mt-0.5">{{ $addr->kota }}, {{ $addr->kode_pos }}</p>
                                        <p class="text-slate-400 font-medium mt-1 flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[12px]">phone</span>
                                            {{ $addr->telepon }}
                                        </p>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-6 text-slate-400 text-xs">
                                    <span class="material-symbols-outlined text-4xl block opacity-20 mb-2">location_off</span>
                                    Belum ada alamat pengiriman tersimpan.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection