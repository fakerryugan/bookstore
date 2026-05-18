@extends('layouts.admin')

@section('content')
<div class="p-6 sm:p-10">
    <div class="mb-10">
        <h1 class="text-2xl font-bold text-slate-800">Pengaturan Profil Admin</h1>
        <p class="text-slate-500">Kelola informasi akun administrator.</p>
    </div>

    @if(session('success'))
    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg flex items-center gap-3">
        <span class="material-symbols-outlined">check_circle</span>
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-slate-100 max-w-4xl">
        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-10 space-y-10">
            @csrf
            @method('PUT')

            <div class="flex flex-col md:flex-row gap-10">
                <!-- Foto -->
                <div class="flex-shrink-0 text-center">
                    <div class="relative w-40 h-40 mx-auto mb-4">
                        <img id="preview-photo" src="{{ $user->photo ? asset('storage/' . $user->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=1e293b&color=fff&size=256' }}" 
                             alt="Avatar" class="w-full h-full rounded-2xl shadow-md object-cover border-4 border-slate-50" />
                        <label for="photo-upload" class="absolute -bottom-2 -right-2 w-10 h-10 bg-slate-800 text-white rounded-lg flex items-center justify-center border-2 border-white shadow-lg cursor-pointer hover:bg-slate-900 transition-colors">
                            <span class="material-symbols-outlined text-sm">edit</span>
                        </label>
                        <input type="file" id="photo-upload" name="photo" class="hidden" accept="image/*" onchange="previewImage(this)" />
                    </div>
                    @error('photo') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Form -->
                <div class="flex-grow space-y-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Admin</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:border-slate-800 focus:ring-1 focus:ring-slate-800 outline-none transition-all" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:border-slate-800 focus:ring-1 focus:ring-slate-800 outline-none transition-all" required>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-slate-50">
                        <h3 class="font-bold text-slate-800 mb-4">Ganti Password</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Password Baru</label>
                                <input type="password" name="password" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:border-slate-800 focus:ring-1 focus:ring-slate-800 outline-none transition-all">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:border-slate-800 focus:ring-1 focus:ring-slate-800 outline-none transition-all">
                            </div>
                        </div>
                        @error('password') <p class="text-xs text-rose-500 mt-2">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-4 pt-6 border-t border-slate-50">
                <a href="/admin" class="px-6 py-2 border border-slate-200 text-slate-600 rounded-lg hover:bg-slate-50 font-semibold transition-all">Batal</a>
                <button type="submit" class="px-6 py-2 bg-slate-800 text-white rounded-lg hover:bg-slate-900 font-semibold shadow-md transition-all active:scale-95">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

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
@endsection
