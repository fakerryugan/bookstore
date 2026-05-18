@extends('layouts.admin')

@section('content')
<div class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-title-sm font-bold text-gray-900 dark:text-white">Kelola Kategori</h1>
        <p class="text-sm font-medium text-gray-500">Total {{ $kategori->count() }} kategori buku tersedia.</p>
    </div>
    <a href="/admin/kategori/tambah" class="inline-flex items-center gap-2 rounded-xl bg-brand-500 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-brand-500/20 hover:bg-brand-600 transition-all">
        <span class="material-symbols-outlined text-lg">add</span>
        Tambah Kategori Baru
    </a>
</div>

<div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
    <!-- List Kategori -->
    <div class="lg:col-span-3 rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">
        <div class="p-6 overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-xs font-semibold uppercase tracking-wider text-gray-400 border-b border-gray-100 dark:border-gray-800">
                        <th class="pb-4 pr-4">Nama Kategori</th>
                        <th class="pb-4 px-4 text-center">Jumlah Buku</th>
                        <th class="pb-4 px-4">Deskripsi</th>
                        <th class="pb-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @foreach($kategori as $item)
                    <tr class="group hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                        <td class="py-4 pr-4">
                            <div class="flex items-center gap-3">
                                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-brand-50 text-brand-500">
                                    <span class="material-symbols-outlined">category</span>
                                </div>
                                <p class="text-sm font-bold text-gray-900 dark:text-white">{{ $item->nama_kategori }}</p>
                            </div>
                        </td>
                        <td class="py-4 px-4 text-center text-sm font-medium text-gray-700 dark:text-gray-300">{{ $item->books->count() }} Buku</td>
                        <td class="py-4 px-4 text-sm text-gray-500 max-w-xs truncate">{{ $item->deskripsi }}</td>
                        <td class="py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.kategori.edit', $item->id) }}" class="flex h-9 w-9 items-center justify-center rounded-lg border border-gray-200 bg-white text-gray-500 hover:text-brand-500 dark:border-gray-800 dark:bg-gray-900 transition-colors">
                                    <span class="material-symbols-outlined text-lg">edit</span>
                                </a>
                                <form action="{{ route('admin.kategori.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="flex h-9 w-9 items-center justify-center rounded-lg border border-gray-200 bg-white text-gray-500 hover:text-error-500 dark:border-gray-800 dark:bg-gray-900 transition-colors">
                                        <span class="material-symbols-outlined text-lg">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
