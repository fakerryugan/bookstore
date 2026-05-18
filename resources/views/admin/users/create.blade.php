@extends('layouts.admin')

@section('content')
<div class="p-6 sm:p-10">
    <div class="mb-8">
        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-1 text-slate-500 hover:text-slate-800 transition-colors mb-2 text-sm font-medium">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span> Kembali
        </a>
        <h1 class="text-2xl font-bold text-slate-800">Tambah Pelanggan Baru</h1>
    </div>

    <div class="bg-white rounded-xl border border-slate-100 shadow-sm max-w-2xl">
        <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8 space-y-6">
            @csrf
            
            <div class="space-y-4 text-center pb-6 border-b border-slate-50">
                <div class="relative w-24 h-24 mx-auto">
                    <img id="preview-photo" src="https://ui-avatars.com/api/?name=New+User&background=random&size=128" class="w-full h-full rounded-full object-cover border-4 border-slate-50 shadow-sm">
                    <label for="photo" class="absolute bottom-0 right-0 p-1 bg-slate-800 text-white rounded-full cursor-pointer hover:bg-slate-900 border-2 border-white">
                        <span class="material-symbols-outlined text-sm">photo_camera</span>
                    </label>
                    <input type="file" name="photo" id="photo" class="hidden" accept="image/*" onchange="previewImage(this)">
                </div>
                <p class="text-xs text-slate-500">Pilih foto profil (opsional)</p>
            </div>

            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="name" class="w-full px-4 py-2 border border-slate-200 rounded-lg outline-none focus:border-slate-800" value="{{ old('name') }}" required>
                    @error('name') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Email</label>
                    <input type="email" name="email" class="w-full px-4 py-2 border border-slate-200 rounded-lg outline-none focus:border-slate-800" value="{{ old('email') }}" required>
                    @error('email') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Password</label>
                    <input type="password" name="password" class="w-full px-4 py-2 border border-slate-200 rounded-lg outline-none focus:border-slate-800" required>
                    @error('password') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="pt-6 flex gap-4">
                <button type="submit" class="flex-grow bg-slate-800 text-white py-2.5 rounded-lg font-semibold hover:bg-slate-900 transition-all">Simpan User</button>
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
