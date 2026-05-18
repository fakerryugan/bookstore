@extends('layouts.customer')

@section('content')
<main class="pt-32 pb-20 bg-slate-50 min-h-screen">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-10">
            <h1 class="font-serif text-3xl font-bold text-slate-900">Pengaturan Profil</h1>
            <p class="text-slate-500">Kelola informasi akun dan foto profil Anda.</p>
        </div>

        @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl flex items-center gap-3">
            <span class="material-symbols-outlined">check_circle</span>
            {{ session('success') }}
        </div>
        @endif

        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="p-8 sm:p-10 space-y-8">
                @csrf
                @method('PUT')

                <!-- Foto Profil -->
                <div class="flex flex-col sm:flex-row items-center gap-8 pb-8 border-b border-slate-50">
                    <div class="relative w-32 h-32">
                        <img id="preview-photo" src="{{ $user->photo ? asset('storage/' . $user->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=0D8ABC&color=fff&size=256' }}" 
                             alt="Avatar" class="w-full h-full rounded-full border-4 border-white shadow-md object-cover" />
                        <label for="photo-upload" class="absolute bottom-0 right-0 w-10 h-10 bg-primary-600 text-white rounded-full flex items-center justify-center border-4 border-white shadow-lg cursor-pointer hover:bg-primary-700 transition-colors">
                            <span class="material-symbols-outlined text-sm">photo_camera</span>
                        </label>
                        <input type="file" id="photo-upload" name="photo" class="hidden" accept="image/*" onchange="previewImage(this)" />
                    </div>
                    <div class="text-center sm:text-left">
                        <h3 class="text-lg font-bold text-slate-900">Foto Profil</h3>
                        <p class="text-sm text-slate-500 mb-4">Unggah foto baru (Max 2MB). Format: JPG, PNG, GIF.</p>
                        @error('photo') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Informasi Dasar -->
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all" placeholder="Masukkan nama Anda" required>
                        @error('name') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all" placeholder="nama@email.com" required>
                        @error('email') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Password -->
                <div class="pt-8 border-t border-slate-50">
                    <h3 class="text-lg font-bold text-slate-900 mb-4">Ubah Kata Sandi</h3>
                    <p class="text-sm text-slate-500 mb-6">Kosongkan jika tidak ingin mengubah kata sandi.</p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Kata Sandi Baru</label>
                            <input type="password" name="password" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all" placeholder="Minimal 8 karakter">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Konfirmasi Kata Sandi</label>
                            <input type="password" name="password_confirmation" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all" placeholder="Ulangi kata sandi">
                        </div>
                    </div>
                    @error('password') <p class="text-xs text-rose-500 mt-2">{{ $message }}</p> @enderror
                </div>

                <div class="pt-10">
                    <button type="submit" class="w-full sm:w-auto px-8 py-4 bg-primary-600 text-white rounded-xl font-bold hover:bg-primary-700 shadow-lg shadow-primary-500/30 transition-all active:scale-95">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('costumer.dashboard') }}" class="inline-block mt-4 sm:mt-0 sm:ml-4 text-sm font-bold text-slate-500 hover:text-slate-800 transition-colors">Batal</a>
                </div>
            </form>
        </div>
    </div>
</main>

@push('scripts')
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-photo').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
@endsection
