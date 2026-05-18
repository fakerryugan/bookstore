@extends('layouts.customer')

@section('content')
    <main class="pt-32 pb-20 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="font-serif text-3xl md:text-4xl font-bold text-slate-900 mb-8 border-b border-slate-200 pb-4">
                Keranjang Belanja
            </h1>

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl flex items-center gap-3">
                    <span class="material-symbols-outlined">check_circle</span>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-700 rounded-xl flex items-center gap-3">
                    <span class="material-symbols-outlined">error</span>
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-700 rounded-xl space-y-1">
                    <div class="flex items-center gap-3 font-bold mb-1">
                        <span class="material-symbols-outlined text-rose-600">error</span>
                        <span>Ada kesalahan dalam pengisian formulir:</span>
                    </div>
                    <ul class="list-disc list-inside text-xs pl-6 space-y-0.5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                <!-- Daftar Barang -->
                <div class="lg:col-span-8">
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                        <div class="p-6 sm:p-8 space-y-8">
                            @forelse($cart as $id => $details)
                                <div class="flex flex-col sm:flex-row gap-6 relative group" data-id="{{ $id }}">
                                    <div
                                        class="w-32 sm:w-40 flex-shrink-0 aspect-[2/3] rounded-xl overflow-hidden shadow-md bg-slate-100">
                                        <img src="{{ asset('storage/' . $details['sampul']) }}" alt="{{ $details['judul'] }}"
                                            class="w-full h-full object-cover" />
                                    </div>
                                    <div class="flex flex-col flex-grow justify-between">
                                        <div>
                                            <div class="flex justify-between items-start mb-1">
                                                <h3 class="font-serif text-xl font-bold text-slate-900">{{ $details['judul'] }}
                                                </h3>
                                                <button
                                                    class="text-slate-400 hover:text-rose-500 transition-colors remove-from-cart"
                                                    title="Hapus item">
                                                    <span class="material-symbols-outlined">delete</span>
                                                </button>
                                            </div>
                                            <p class="text-sm text-primary-600 font-medium mb-3">{{ $details['penulis'] }}</p>
                                            <p class="font-bold text-lg text-slate-800">Rp
                                                {{ number_format($details['price'], 0, ',', '.') }}</p>
                                        </div>

                                        <div class="flex items-center justify-between mt-4 sm:mt-0">
                                            <div class="flex items-center bg-slate-50 border border-slate-200 rounded-lg p-1">
                                                <button
                                                    class="w-8 h-8 flex items-center justify-center rounded-md text-slate-500 hover:bg-white hover:shadow-sm hover:text-slate-800 transition-all update-cart"
                                                    data-type="minus">
                                                    <span class="material-symbols-outlined text-sm">remove</span>
                                                </button>
                                                <input type="number" value="{{ $details['quantity'] }}"
                                                    class="w-10 text-center font-semibold text-slate-800 bg-transparent border-none focus:ring-0 quantity"
                                                    readonly>
                                                <button
                                                    class="w-8 h-8 flex items-center justify-center rounded-md text-slate-500 hover:bg-white hover:shadow-sm hover:text-slate-800 transition-all update-cart"
                                                    data-type="plus">
                                                    <span class="material-symbols-outlined text-sm">add</span>
                                                </button>
                                            </div>
                                            <p class="font-bold text-primary-600">Rp
                                                {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                </div>
                                @if(!$loop->last)
                                <hr class="border-slate-100" /> @endif
                            @empty
                                <div class="text-center py-12">
                                    <span class="material-symbols-outlined text-6xl text-slate-200 mb-4">shopping_basket</span>
                                    <p class="text-slate-500 text-lg">Keranjang Anda masih kosong.</p>
                                    <a href="{{ route('costumer.buku.index') }}"
                                        class="inline-block mt-6 px-8 py-3 bg-primary-600 text-white rounded-xl font-bold hover:bg-primary-700 transition-colors">Cari
                                        Buku Sekarang</a>
                                </div>
                            @endforelse
                        </div>

                        <div class="bg-slate-50 p-4 border-t border-slate-100 text-center sm:text-left">
                            <a href="{{ route('costumer.buku.index') }}"
                                class="inline-flex items-center gap-2 text-primary-600 font-medium hover:text-primary-700 transition-colors">
                                <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                                Lanjutkan Belanja
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Ringkasan -->
                <div class="lg:col-span-4">
                    <div class="sticky top-28 bg-white rounded-2xl shadow-sm border border-slate-100 p-6 sm:p-8">
                        <h2 class="font-serif text-2xl font-bold text-slate-900 mb-6">Ringkasan Pesanan</h2>

                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between text-slate-600">
                                <span>Subtotal</span>
                                <span class="font-medium text-slate-900">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-slate-600">
                                <span>Estimasi Pengiriman</span>
                                <span class="font-medium text-slate-900">Gratis</span>
                            </div>
                        </div>

                        <div class="border-t border-slate-200 pt-4 mb-6">
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-lg font-bold text-slate-900">Total</span>
                                <span class="text-2xl font-bold text-primary-600">Rp
                                    {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        @auth
                        <form action="{{ route('checkout.process') }}" method="POST" class="space-y-6" x-data="{ 
                            hasAddresses: {{ Auth::user()->addresses()->count() > 0 ? 'true' : 'false' }},
                            addressSelection: '{{ Auth::user()->addresses()->count() > 0 ? 'existing' : 'new' }}'
                        }">
                            @csrf
                            
                            <!-- 1. Shipping Address Section -->
                            <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100 text-left space-y-4">
                                <h3 class="text-sm font-bold text-slate-800 flex items-center gap-1.5 border-b border-slate-200/60 pb-2">
                                    <span class="material-symbols-outlined text-[18px] text-blue-600">location_on</span>
                                    Alamat Pengiriman
                                </h3>

                                @if(Auth::user()->addresses()->count() > 0)
                                    <!-- Toggle existing vs new -->
                                    <div class="flex items-center gap-4 text-xs font-semibold mb-2">
                                        <label class="flex items-center gap-1.5 cursor-pointer">
                                            <input type="radio" name="address_selection" value="existing" x-model="addressSelection" class="w-4 h-4 text-blue-600 focus:ring-blue-500" />
                                            <span>Gunakan Alamat Tersimpan</span>
                                        </label>
                                        <label class="flex items-center gap-1.5 cursor-pointer">
                                            <input type="radio" name="address_selection" value="new" x-model="addressSelection" class="w-4 h-4 text-blue-600 focus:ring-blue-500" />
                                            <span>Tambah Alamat Baru</span>
                                        </label>
                                    </div>

                                    <!-- List of existing addresses -->
                                    <div x-show="addressSelection === 'existing'" class="space-y-3">
                                        @foreach(Auth::user()->addresses as $addr)
                                            <label class="block cursor-pointer group p-3 bg-white border border-slate-200 rounded-xl hover:border-blue-500 transition-colors {{ $addr->is_default ? 'ring-2 ring-blue-100 border-blue-500' : '' }}">
                                                <div class="flex items-start gap-3">
                                                    <input type="radio" name="address_id" value="{{ $addr->id }}" {{ $addr->is_default ? 'checked' : '' }} class="mt-1 w-4 h-4 text-blue-600 focus:ring-blue-500" />
                                                    <div class="text-xs">
                                                        <div class="flex items-center gap-2 mb-1">
                                                            <span class="font-bold text-slate-800">{{ $addr->nama_penerima }}</span>
                                                            <span class="text-slate-400 font-medium">| {{ $addr->telepon }}</span>
                                                            @if($addr->is_default)
                                                                <span class="px-2 py-0.5 bg-blue-50 text-blue-600 font-bold text-[9px] rounded uppercase tracking-wider">Utama</span>
                                                            @endif
                                                        </div>
                                                        <p class="text-slate-500 leading-relaxed">{{ $addr->alamat_lengkap }}</p>
                                                        <p class="text-slate-400 mt-0.5">{{ $addr->kota }}, {{ $addr->kode_pos }}</p>
                                                    </div>
                                                </div>
                                            </label>
                                        @endforeach
                                    </div>
                                @else
                                    <!-- No saved address state -->
                                    <input type="hidden" name="address_selection" value="new" />
                                    <div class="bg-amber-50 border border-amber-100 text-amber-700 p-3 rounded-xl text-xs flex items-start gap-2">
                                        <span class="material-symbols-outlined text-[16px] mt-0.5">warning</span>
                                        <span>Anda belum memiliki alamat pengiriman tersimpan. Silakan isi alamat pengiriman di bawah untuk menyelesaikan pesanan Anda.</span>
                                    </div>
                                @endif

                                <!-- New Address Form Fields -->
                                <div x-show="addressSelection === 'new'" class="space-y-3 pt-2">
                                    <div class="grid grid-cols-2 gap-3">
                                        <div>
                                            <label class="block text-[10px] font-bold text-slate-500 mb-1">NAMA PENERIMA</label>
                                            <input type="text" name="nama_penerima" placeholder="cth: John Doe" class="w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs outline-none focus:border-blue-500" />
                                        </div>
                                        <div>
                                            <label class="block text-[10px] font-bold text-slate-500 mb-1">NOMOR TELEPON</label>
                                            <input type="text" name="telepon" placeholder="cth: 0812xxxxxxxx" class="w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs outline-none focus:border-blue-500" />
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-bold text-slate-500 mb-1">ALAMAT LENGKAP</label>
                                        <textarea name="alamat_lengkap" rows="2" placeholder="Nama jalan, nomor rumah, RT/RW, kelurahan/kecamatan" class="w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs outline-none focus:border-blue-500 resize-none"></textarea>
                                    </div>
                                    <div class="grid grid-cols-2 gap-3">
                                        <div>
                                            <label class="block text-[10px] font-bold text-slate-500 mb-1">KOTA</label>
                                            <input type="text" name="kota" placeholder="cth: Jakarta Barat" class="w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs outline-none focus:border-blue-500" />
                                        </div>
                                        <div>
                                            <label class="block text-[10px] font-bold text-slate-500 mb-1">KODE POS</label>
                                            <input type="text" name="kode_pos" placeholder="cth: 11520" class="w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs outline-none focus:border-blue-500" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 2. Payment Method Section -->
                            <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100 text-left space-y-3">
                                <h3 class="text-sm font-bold text-slate-800 flex items-center gap-1.5 border-b border-slate-200/60 pb-2">
                                    <span class="material-symbols-outlined text-[18px] text-blue-600">payments</span>
                                    Metode Pembayaran
                                </h3>
                                
                                <label class="flex items-start gap-3 cursor-pointer group p-3 bg-white border border-slate-200 rounded-xl hover:border-blue-500 transition-colors">
                                    <input type="radio" name="payment_method" value="Xendit" checked class="mt-1 w-4 h-4 text-blue-600 border-slate-300 focus:ring-blue-500" />
                                    <div>
                                        <span class="text-slate-800 font-bold text-xs block">Instant Payment (Gateway)</span>
                                        <span class="text-slate-400 text-[10px] leading-tight block">Bayar instan otomatis via BCA Virtual Account, QRIS, DANA, OVO, dll.</span>
                                    </div>
                                </label>
                                
                                <label class="flex items-start gap-3 cursor-pointer group p-3 bg-white border border-slate-200 rounded-xl hover:border-blue-500 transition-colors">
                                    <input type="radio" name="payment_method" value="Manual" class="mt-1 w-4 h-4 text-blue-600 border-slate-300 focus:ring-blue-500" />
                                    <div>
                                        <span class="text-slate-800 font-bold text-xs block">Bayar Sebelum Dikirim</span>
                                        <span class="text-slate-400 text-[10px] leading-tight block">Transfer bank manual ke rekening BCA RyuuBook sebelum buku diproses dan dikirim.</span>
                                    </div>
                                </label>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-xl font-bold text-lg shadow-lg shadow-blue-500/20 transition-all active:scale-[0.98] {{ count($cart) == 0 ? 'opacity-50 cursor-not-allowed' : '' }}" {{ count($cart) == 0 ? 'disabled' : '' }}>
                                Buat Pesanan & Bayar
                            </button>
                        </form>
                        @else
                        <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100 text-center space-y-4">
                            <span class="material-symbols-outlined text-4xl text-blue-600">lock</span>
                            <h3 class="text-sm font-bold text-slate-800">Login untuk Melanjutkan</h3>
                            <p class="text-xs text-slate-500">Anda harus login terlebih dahulu untuk dapat menyelesaikan pesanan Anda.</p>
                            <a href="{{ route('login') }}" class="inline-block w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-bold text-sm shadow-md transition-all">
                                Login Sekarang
                            </a>
                        </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </main>

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript">
            $(".update-cart").click(function (e) {
                e.preventDefault();
                var ele = $(this);
                var id = ele.closest(".group").data("id");
                var quantityInput = ele.closest(".group").find(".quantity");
                var currentQty = parseInt(quantityInput.val());
                var type = ele.data("type");
                var newQty = type === 'plus' ? currentQty + 1 : (currentQty > 1 ? currentQty - 1 : 1);

                $.ajax({
                    url: '{{ route('cart.update') }}',
                    method: "patch",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        quantity: newQty
                    },
                    success: function (response) {
                        window.location.reload();
                    }
                });
            });

            $(".remove-from-cart").click(function (e) {
                e.preventDefault();
                var ele = $(this);
                if (confirm("Apakah Anda yakin ingin menghapus buku ini?")) {
                    $.ajax({
                        url: '{{ route('cart.remove') }}',
                        method: "DELETE",
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: ele.closest(".group").data("id")
                        },
                        success: function (response) {
                            window.location.reload();
                        }
                    });
                }
            });
        </script>
    @endpush
@endsection