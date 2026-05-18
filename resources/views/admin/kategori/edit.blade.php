@extends('layouts.admin')

@section('content')
<div class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-title-sm font-bold text-gray-900 dark:text-white">Edit Kategori</h1>
        <p class="text-sm font-medium text-gray-500">Perbarui informasi kategori buku Anda.</p>
    </div>
    <a href="/admin/kategori" class="inline-flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
        <span class="material-symbols-outlined text-lg">arrow_back</span>
        Kembali
    </a>
</div>

<div class="max-w-2xl">
    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-800 dark:bg-gray-900 md:p-8">
        <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label class="mb-2.5 block font-semibold text-gray-700 dark:text-white">Nama Kategori</label>
                <input type="text" name="nama_kategori" value="{{ $kategori->nama_kategori }}" class="w-full rounded-xl border border-gray-200 bg-transparent px-5 py-3 text-sm outline-none transition-all focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 dark:border-gray-800 dark:bg-gray-800 dark:text-white" required />
            </div>

            <div>
                <label class="mb-2.5 block font-semibold text-gray-700 dark:text-white">Deskripsi Kategori</label>
                <textarea rows="4" name="deskripsi" class="w-full rounded-xl border border-gray-200 bg-transparent px-5 py-3 text-sm outline-none transition-all focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 dark:border-gray-800 dark:bg-gray-800 dark:text-white" required>{{ $kategori->deskripsi }}</textarea>
            </div>

            <div class="flex justify-end gap-4 pt-4">
                <button type="button" class="rounded-xl border border-gray-200 px-8 py-3 text-sm font-bold text-gray-700 transition-all hover:bg-gray-50 dark:border-gray-800 dark:text-gray-300 dark:hover:bg-gray-800">
                    Batalkan
                </button>
                <button type="submit" class="rounded-xl bg-brand-500 px-10 py-3 text-sm font-bold text-white shadow-lg shadow-brand-500/20 transition-all hover:bg-brand-600">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
