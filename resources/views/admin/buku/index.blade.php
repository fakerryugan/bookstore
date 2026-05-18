@extends('layouts.admin')

@section('content')
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-title-sm font-bold text-gray-900 dark:text-white">Kelola Buku</h1>
        </div>
        <a href="/admin/buku/tambah"
            class="inline-flex items-center gap-2 rounded-xl bg-brand-500 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-brand-500/20 hover:bg-brand-600 transition-all">
            <span class="material-symbols-outlined text-lg">add</span>
            Tambah Buku Baru
        </a>
    </div>

    <div class="rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">
        <!-- Filter & Search -->
        <div
            class="flex flex-col gap-4 border-b border-gray-100 p-6 dark:border-gray-800 md:flex-row md:items-center md:justify-between">
            <div class="relative w-full md:w-96">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                    <span class="material-symbols-outlined text-xl">search</span>
                </span>
                <input type="text" placeholder="Cari judul, penulis, atau ISBN..."
                    class="w-full rounded-xl border border-gray-200 bg-gray-50 py-2.5 pl-12 pr-4 text-sm outline-none transition-all focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 dark:border-gray-800 dark:bg-gray-800 dark:text-white" />
            </div>
            <div class="flex items-center gap-3">
                <select
                    class="rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 outline-none dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
                    <option value="">Semua Kategori</option>
                    <option value="fiksi">Fiksi</option>
                    <option value="non-fiksi">Non-Fiksi</option>
                </select>
                <button
                    class="flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-bold text-gray-700 hover:bg-gray-50 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
                    <span class="material-symbols-outlined text-lg">filter_list</span>
                    Filter
                </button>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto p-6">
            <table class="w-full text-left">
                <thead>
                    <tr
                        class="text-xs font-semibold uppercase tracking-wider text-gray-400 border-b border-gray-100 dark:border-gray-800">
                        <th class="pb-4 pr-4">Buku</th>
                        <th class="pb-4 px-4">Kategori</th>
                        <th class="pb-4 px-4">Stok</th>
                        <th class="pb-4 px-4">Harga</th>
                        <th class="pb-4 px-4">Status</th>
                        <th class="pb-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @foreach($data as $book)
                        <tr class="group hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                            <td class="py-4 pr-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="flex h-12 w-10 items-center justify-center rounded-lg bg-brand-50 text-brand-500 overflow-hidden">
                                        @if($book->sampul)
                                            <img src="{{ asset('storage/' . $book->sampul) }}" class="h-full w-full object-cover"
                                                alt="">
                                        @else
                                            <span class="material-symbols-outlined">auto_stories</span>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-900 dark:text-white">{{ $book->judul }}</p>
                                        <p class="text-xs text-gray-500">{{ $book->penulis }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4 text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ $book->kategori->nama_kategori ?? 'Tanpa Kategori' }}</td>
                            <td class="py-4 px-4 text-sm font-medium text-gray-700 dark:text-gray-300">{{ $book->stok }} Eks
                            </td>
                            <td class="py-4 px-4 text-sm font-bold text-gray-900 dark:text-white">Rp
                                {{ number_format($book->harga, 0, ',', '.') }}</td>
                            <td class="py-4 px-4">
                                @if($book->stok > 10)
                                    <span
                                        class="rounded-full bg-success-50 px-3 py-1 text-xs font-bold text-success-600 dark:bg-success-500/10">Tersedia</span>
                                @elseif($book->stok > 0)
                                    <span
                                        class="rounded-full bg-warning-50 px-3 py-1 text-xs font-bold text-warning-600 dark:bg-warning-500/10">Stok
                                        Rendah</span>
                                @else
                                    <span
                                        class="rounded-full bg-error-50 px-3 py-1 text-xs font-bold text-error-600 dark:bg-error-500/10">Habis</span>
                                @endif
                            </td>
                            <td class="py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.buku.edit', $book->id) }}"
                                        class="flex h-9 w-9 items-center justify-center rounded-lg border border-gray-200 bg-white text-gray-500 hover:text-brand-500 dark:border-gray-800 dark:bg-gray-900 transition-colors">
                                        <span class="material-symbols-outlined text-lg">edit</span>
                                    </a>
                                    <form action="{{ route('admin.buku.destroy', $book->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="flex h-9 w-9 items-center justify-center rounded-lg border border-gray-200 bg-white text-gray-500 hover:text-error-500 dark:border-gray-800 dark:bg-gray-900 transition-colors">
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

        <!-- Pagination -->
        <div class="flex items-center justify-between border-t border-gray-100 p-6 dark:border-gray-800">
            <p class="text-sm font-medium text-gray-500">
                @if($data instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    Menampilkan {{ $data->firstItem() ?? 0 }}-{{ $data->lastItem() ?? 0 }} dari {{ $data->total() }} data
                @else
                    Menampilkan {{ $data->count() }} data
                @endif
            </p>
            @if($data instanceof \Illuminate\Pagination\LengthAwarePaginator && $data->hasPages())
                <div class="flex items-center gap-2">
                    {{-- Previous Page Link --}}
                    @if ($data->onFirstPage())
                        <button disabled class="flex h-9 w-9 items-center justify-center rounded-lg border border-gray-200 bg-white text-gray-400 dark:border-gray-800 dark:bg-gray-900 opacity-50 cursor-not-allowed">
                            <span class="material-symbols-outlined text-lg">chevron_left</span>
                        </button>
                    @else
                        <a href="{{ $data->previousPageUrl() }}" class="flex h-9 w-9 items-center justify-center rounded-lg border border-gray-200 bg-white text-gray-500 hover:bg-gray-50 dark:border-gray-800 dark:bg-gray-900 transition-colors">
                            <span class="material-symbols-outlined text-lg">chevron_left</span>
                        </a>
                    @endif

                    {{-- Page Numbers --}}
                    @foreach ($data->getUrlRange(1, $data->lastPage()) as $page => $url)
                        @if ($page == $data->currentPage())
                            <button class="flex h-9 w-9 items-center justify-center rounded-lg bg-brand-500 text-sm font-bold text-white shadow-lg shadow-brand-500/20">{{ $page }}</button>
                        @else
                            <a href="{{ $url }}" class="flex h-9 w-9 items-center justify-center rounded-lg border border-gray-200 bg-white text-sm font-bold text-gray-700 hover:bg-gray-50 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300 transition-colors">{{ $page }}</a>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($data->hasMorePages())
                        <a href="{{ $data->nextPageUrl() }}" class="flex h-9 w-9 items-center justify-center rounded-lg border border-gray-200 bg-white text-gray-500 hover:bg-gray-50 dark:border-gray-800 dark:bg-gray-900 transition-colors">
                            <span class="material-symbols-outlined text-lg">chevron_right</span>
                        </a>
                    @else
                        <button disabled class="flex h-9 w-9 items-center justify-center rounded-lg border border-gray-200 bg-white text-gray-400 dark:border-gray-800 dark:bg-gray-900 opacity-50 cursor-not-allowed">
                            <span class="material-symbols-outlined text-lg">chevron_right</span>
                        </button>
                    @endif
                </div>
            @endif
        </div>
    </div>
@endsection