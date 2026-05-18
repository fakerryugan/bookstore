@extends('layouts.admin')

@section('content')
<div class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-title-sm font-bold text-gray-900 dark:text-white">Edit Buku</h1>
        <nav class="mt-1">
            <ol class="flex items-center gap-2 text-sm font-medium text-gray-500">
                <li><a href="/admin" class="hover:text-brand-500 transition-colors">Home</a></li>
                <li><span class="material-symbols-outlined text-sm">chevron_right</span></li>
                <li><a href="/admin/buku" class="hover:text-brand-500 transition-colors">Kelola Buku</a></li>
                <li><span class="material-symbols-outlined text-sm">chevron_right</span></li>
                <li class="text-brand-500">Edit</li>
            </ol>
        </nav>
    </div>
    <a href="/admin/buku" class="inline-flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300 transition-all">
        <span class="material-symbols-outlined text-lg">arrow_back</span>
        Batal
    </a>
</div>

@if($errors->any())
<div class="mb-6 rounded-2xl bg-error-50 p-4 text-sm font-medium text-error-600 dark:bg-error-500/10">
    <ul class="list-disc list-inside">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('admin.buku.update', $books->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @method('PUT')
    <!-- Section 1: Deskripsi -->
    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-800 dark:bg-gray-900 md:p-8">
        <h3 class="mb-6 text-lg font-bold text-gray-900 dark:text-white">Informasi Buku</h3>
        
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div class="md:col-span-2">
                <label class="mb-2.5 block font-semibold text-gray-700 dark:text-white">Judul Buku</label>
                <input type="text" name="judul" value="{{ old('judul', $books->judul) }}" class="w-full rounded-xl border border-gray-200 bg-transparent px-5 py-3 text-sm outline-none transition-all focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 dark:border-gray-800 dark:bg-gray-800 dark:text-white" required />
            </div>

            <div>
                <label class="mb-2.5 block font-semibold text-gray-700 dark:text-white">Penulis</label>
                <input type="text" name="penulis" value="{{ old('penulis', $books->penulis) }}" class="w-full rounded-xl border border-gray-200 bg-transparent px-5 py-3 text-sm outline-none transition-all focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 dark:border-gray-800 dark:bg-gray-800 dark:text-white" required />
            </div>

            <div>
                <label class="mb-2.5 block font-semibold text-gray-700 dark:text-white">Kategori</label>
                <select name="kategori_id" class="w-full rounded-xl border border-gray-200 bg-transparent px-5 py-3 text-sm outline-none transition-all focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 dark:border-gray-800 dark:bg-gray-800 dark:text-white" required>
                    <option value="">Pilih Kategori</option>
                    @foreach($kategori as $item)
                        <option value="{{ $item->id }}" {{ old('kategori_id', $books->kategori_id) == $item->id ? 'selected' : '' }}>{{ $item->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="mb-2.5 block font-semibold text-gray-700 dark:text-white">Penerbit</label>
                <input type="text" name="penerbit" value="{{ old('penerbit', $books->penerbit) }}" class="w-full rounded-xl border border-gray-200 bg-transparent px-5 py-3 text-sm outline-none transition-all focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 dark:border-gray-800 dark:bg-gray-800 dark:text-white" required />
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="mb-2.5 block font-semibold text-gray-700 dark:text-white text-xs">Stok</label>
                    <input type="number" name="stok" value="{{ old('stok', $books->stok) }}" class="w-full rounded-xl border border-gray-200 bg-transparent px-5 py-3 text-sm outline-none transition-all focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 dark:border-gray-800 dark:bg-gray-800 dark:text-white" required />
                </div>
                <div>
                    <label class="mb-2.5 block font-semibold text-gray-700 dark:text-white text-xs">Harga (Rp)</label>
                    <input type="number" name="harga" value="{{ old('harga', $books->harga) }}" class="w-full rounded-xl border border-gray-200 bg-transparent px-5 py-3 text-sm outline-none transition-all focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 dark:border-gray-800 dark:bg-gray-800 dark:text-white" required />
                </div>
            </div>

            <div class="md:col-span-2">
                <label class="mb-2.5 block font-semibold text-gray-700 dark:text-white">Deskripsi Buku</label>
                <textarea name="deskripsi" rows="4" placeholder="Tuliskan deskripsi lengkap buku..." class="w-full rounded-xl border border-gray-200 bg-transparent px-5 py-3 text-sm outline-none transition-all focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 dark:border-gray-800 dark:bg-gray-800 dark:text-white resize-none" required>{{ old('deskripsi', $books->deskripsi) }}</textarea>
            </div>
        </div>
    </div>

    <!-- Section 2: Sampul -->
    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-800 dark:bg-gray-900 md:p-8">
        <h3 class="mb-6 text-lg font-bold text-gray-900 dark:text-white">Sampul Buku</h3>
        
        <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 ml-2 sm:col-span-4 md:mr-3">
            <input type="file" name="sampul" class="hidden" x-ref="photo" x-on:change="
                photoName = $refs.photo.files[0].name;
                const reader = new FileReader();
                reader.onload = (e) => {
                    photoPreview = e.target.result;
                };
                reader.readAsDataURL($refs.photo.files[0]);
            ">

            <div class="flex flex-col items-center justify-center rounded-2xl border-2 border-dashed border-gray-200 py-12 dark:border-gray-800" x-show="!photoPreview">
                @if($books->sampul)
                    <div class="relative inline-block h-64 w-44 rounded-xl shadow-lg overflow-hidden border border-gray-200">
                        <img src="{{ asset('storage/' . $books->sampul) }}" class="h-full w-full object-cover">
                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity">
                            <button type="button" class="bg-white text-gray-900 px-4 py-2 rounded-lg font-bold text-xs" x-on:click.prevent="$refs.photo.click()">Ubah Sampul</button>
                        </div>
                    </div>
                @else
                    <div class="flex h-16 w-16 items-center justify-center rounded-full bg-brand-50 text-brand-500 dark:bg-brand-500/10">
                        <span class="material-symbols-outlined text-3xl">upload</span>
                    </div>
                    <div class="mt-4 text-center">
                        <p class="text-sm font-bold text-gray-900 dark:text-white">
                            <button type="button" class="text-brand-500 hover:underline" x-on:click.prevent="$refs.photo.click()">Klik untuk ganti sampul</button>
                        </p>
                    </div>
                @endif
            </div>

            <div class="mt-2 text-center" x-show="photoPreview" style="display: none;">
                <div class="relative inline-block h-64 w-44 rounded-xl shadow-lg overflow-hidden border border-gray-200">
                    <img :src="photoPreview" class="h-full w-full object-cover">
                    <button type="button" class="absolute top-2 right-2 flex h-8 w-8 items-center justify-center rounded-full bg-error-500 text-white shadow-lg" x-on:click="photoPreview = null; photoName = null">
                        <span class="material-symbols-outlined text-sm">close</span>
                    </button>
                </div>
                <p class="mt-2 text-sm text-gray-500" x-text="photoName"></p>
            </div>
        </div>
    </div>

    <div class="flex justify-end gap-4">
        <button type="button" onclick="history.back()" class="rounded-xl border border-gray-200 px-10 py-3 text-sm font-bold text-gray-700 transition-all hover:bg-gray-50 dark:border-gray-800 dark:text-gray-300 dark:hover:bg-gray-800">
            Batalkan
        </button>
        <button type="submit" class="rounded-xl bg-brand-500 px-12 py-3 text-sm font-bold text-white shadow-lg shadow-brand-500/20 transition-all hover:bg-brand-600">
            Simpan Perubahan
        </button>
    </div>
</form>
@endsection
