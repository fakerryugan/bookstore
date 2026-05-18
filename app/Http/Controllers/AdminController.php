<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Transaction;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $totalBooks = Books::count();
        $totalRevenue = Transaction::where('status', 'success')->sum('total_amount');
        $lowStockCount = Books::where('stok', '<', 10)->count();
        $totalCustomers = User::where('role', 'customer')->count();
        $recentActivities = Transaction::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.index', compact(
            'totalBooks', 
            'totalRevenue', 
            'lowStockCount', 
            'totalCustomers',
            'recentActivities'
        ));
    }
}
