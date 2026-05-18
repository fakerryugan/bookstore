@extends('layouts.admin')

@section('content')
<div class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="text-title-sm font-bold text-gray-900 dark:text-white">Dashboard Overview</h1>
        <p class="text-sm font-medium text-gray-500">Selamat datang kembali, {{ auth()->user()->name }}.</p>
    </div>
    <div class="flex items-center gap-3">
        <div class="inline-flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm dark:border-gray-800 dark:bg-gray-900 dark:text-gray-300">
            <span class="material-symbols-outlined text-lg text-brand-500">calendar_today</span>
            {{ now()->translatedFormat('F Y') }}
        </div>
        <a href="{{ route('admin.buku.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-brand-500 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-brand-500/20 hover:bg-brand-600 transition-all">
            <span class="material-symbols-outlined text-lg">add</span>
            Tambah Buku
        </a>
    </div>
</div>

<div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7.5">
    <!-- Total Buku -->
    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-800 dark:bg-gray-900">
        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-brand-50 text-brand-500 dark:bg-brand-500/10">
            <span class="material-symbols-outlined">menu_book</span>
        </div>
        <div class="mt-4">
            <h4 class="text-title-md font-bold text-gray-900 dark:text-white">{{ number_format($totalBooks) }}</h4>
            <p class="text-sm font-medium text-gray-500">Total Judul Buku</p>
        </div>
    </div>

    <!-- Total Transaksi -->
    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-800 dark:bg-gray-900">
        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-success-50 text-success-500 dark:bg-success-500/10">
            <span class="material-symbols-outlined">payments</span>
        </div>
        <div class="mt-4">
            <h4 class="text-title-md font-bold text-gray-900 dark:text-white">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h4>
            <p class="text-sm font-medium text-gray-500">Total Pendapatan</p>
        </div>
    </div>

    <!-- Stok Menipis -->
    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-800 dark:bg-gray-900">
        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-error-50 text-error-500 dark:bg-error-500/10">
            <span class="material-symbols-outlined">warning</span>
        </div>
        <div class="mt-4">
            <h4 class="text-title-md font-bold text-gray-900 dark:text-white">{{ $lowStockCount }}</h4>
            <p class="text-sm font-medium text-gray-500">Buku Stok Rendah</p>
        </div>
    </div>

    <!-- Pelanggan Baru -->
    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-800 dark:bg-gray-900">
        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-orange-50 text-orange-500 dark:bg-orange-500/10">
            <span class="material-symbols-outlined">group</span>
        </div>
        <div class="mt-4">
            <h4 class="text-title-md font-bold text-gray-900 dark:text-white">{{ $totalCustomers }}</h4>
            <p class="text-sm font-medium text-gray-500">Total Pelanggan</p>
        </div>
    </div>
</div>

<div class="mt-6 grid grid-cols-1 gap-6 xl:grid-cols-3">
    <!-- Aktivitas Terbaru -->
    <div class="rounded-2xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">
        <div class="border-b border-gray-100 px-6 py-5 dark:border-gray-800">
            <h3 class="font-bold text-gray-900 dark:text-white">Transaksi Terbaru</h3>
        </div>
        <div class="p-6 space-y-6">
            @forelse($recentActivities as $activity)
            <div class="flex gap-4">
                <div class="relative flex h-10 w-10 shrink-0 items-center justify-center rounded-full {{ $activity->status == 'success' ? 'bg-success-50 text-success-500' : ($activity->status == 'pending' ? 'bg-orange-50 text-orange-500' : 'bg-error-50 text-error-500') }} dark:bg-brand-500/10">
                    <span class="material-symbols-outlined text-xl">
                        {{ $activity->status == 'success' ? 'check_circle' : ($activity->status == 'pending' ? 'pending' : 'cancel') }}
                    </span>
                </div>
                <div class="flex-grow">
                    <div class="flex justify-between">
                        <p class="text-sm font-bold text-gray-900 dark:text-white">{{ $activity->order_id }}</p>
                        <span class="text-[10px] font-bold uppercase {{ $activity->status == 'success' ? 'text-success-600' : ($activity->status == 'pending' ? 'text-orange-600' : 'text-error-600') }}">
                            {{ $activity->status }}
                        </span>
                    </div>
                    <p class="text-xs text-gray-500">{{ $activity->user->name }} • Rp {{ number_format($activity->total_amount, 0, ',', '.') }}</p>
                    <p class="mt-1 text-[10px] text-gray-400">{{ $activity->created_at->diffForHumans() }}</p>
                </div>
            </div>
            @empty
            <div class="py-8 text-center text-gray-500 text-sm">Belum ada aktivitas.</div>
            @endforelse
        </div>
        <div class="p-6 pt-0">
            <a href="/admin/transaksi" class="flex w-full items-center justify-center gap-2 rounded-xl border border-gray-200 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-all">
                Lihat Semua Transaksi
            </a>
        </div>
    </div>
</div>
@endsection
