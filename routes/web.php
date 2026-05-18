<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminTransactionController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ChatController;



Route::get('/', [CustomerController::class, 'index'])->name('home');
Route::get('/login', [AuthController::class, 'showlogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showregister']);
Route::post('/register', [AuthController::class, 'register']);

// Email Verification Routes
Route::get('/email/verify', function () {
    return view('auth.verifity');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (\Illuminate\Foundation\Auth\EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (\Illuminate\Http\Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Link verifikasi baru telah dikirim!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/', [CustomerController::class, 'index'])->name('costumer.index');
Route::get('/buku', [CustomerController::class, 'buku'])->name('costumer.buku.index');
Route::get('/buku/{id}', [CustomerController::class, 'show'])->name('costumer.buku.show');
Route::get('/about-us', [CustomerController::class, 'about'])->name('costumer.about');

Route::get('/keranjang', [CartController::class, 'index'])->name('costumer.keranjang');

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware(['verified'])->group(function () {
        Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('costumer.dashboard');
        Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('/add-to-cart/{id}', [CartController::class, 'add'])->name('cart.add');
        Route::patch('/update-cart', [CartController::class, 'update'])->name('cart.update');
        Route::delete('/remove-from-cart', [CartController::class, 'remove'])->name('cart.remove');
        // Chat API
        Route::get('/chat/messages', [ChatController::class, 'getMessages'])->name('chat.messages');
        Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');

        // Transaction Details & Cancellation
        Route::get('/transaksi/{id}', [CustomerController::class, 'showTransaction'])->name('costumer.transaction.show');
        Route::post('/transaksi/{id}/batal', [CustomerController::class, 'cancelTransaction'])->name('costumer.transaction.cancel');

        // Shipping Address Routes
        Route::prefix('alamat')->group(function() {
            Route::post('/tambah', [CustomerController::class, 'storeAlamat'])->name('costumer.alamat.store');
            Route::delete('/{id}/hapus', [CustomerController::class, 'destroyAlamat'])->name('costumer.alamat.destroy');
            Route::post('/{id}/default', [CustomerController::class, 'setDefaultAlamat'])->name('costumer.alamat.default');
        });
    });
});


// Callback Xendit (Luar Prefix Costumer agar mudah diakses)
Route::post('/xendit/callback', [CheckoutController::class, 'callback'])->name('xendit.callback');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    // Kelola Buku
    Route::prefix('buku')->group(function () {
        Route::get('/', [BooksController::class, 'index'])->name('admin.buku.index');
        Route::get('/tambah', [BooksController::class, 'create'])->name('admin.buku.create');
        Route::post('/tambah', [BooksController::class, 'store'])->name('admin.buku.store');
        Route::get('/edit/{books}', [BooksController::class, 'edit'])->name('admin.buku.edit');
        Route::put('/edit/{books}', [BooksController::class, 'update'])->name('admin.buku.update');
        Route::delete('/hapus/{books}', [BooksController::class, 'destroy'])->name('admin.buku.destroy');
    });

    // Kelola Kategori
    Route::prefix('kategori')->group(function () {
        Route::get('/', [KategoriController::class, 'index'])->name('admin.kategori.index');
        Route::get('/tambah', [KategoriController::class, 'create'])->name('admin.kategori.create');
        Route::post('/tambah', [KategoriController::class, 'store'])->name('admin.kategori.store');
        Route::get('/edit/{id}', [KategoriController::class, 'edit'])->name('admin.kategori.edit');
        Route::put('/edit/{id}', [KategoriController::class, 'update'])->name('admin.kategori.update');
        Route::delete('/hapus/{id}', [KategoriController::class, 'destroy'])->name('admin.kategori.destroy');
    });

    // Kelola Transaksi
    Route::prefix('transaksi')->group(function () {
        Route::get('/', [AdminTransactionController::class, 'index'])->name('admin.transaksi.index');
        Route::get('/{id}', [AdminTransactionController::class, 'show'])->name('admin.transaksi.show');
        Route::post('/{id}/confirm', [AdminTransactionController::class, 'confirmPayment'])->name('admin.transaksi.confirm');
        Route::post('/{id}/cancel', [AdminTransactionController::class, 'cancelPayment'])->name('admin.transaksi.cancel');
        Route::post('/{id}/shipping', [AdminTransactionController::class, 'updateShipping'])->name('admin.transaksi.shipping');
    });

    // Kelola Pelanggan (Users)
    Route::prefix('users')->group(function () {
        Route::get('/', [AdminUserController::class, 'index'])->name('admin.users.index');
        Route::get('/tambah', [AdminUserController::class, 'create'])->name('admin.users.create');
        Route::post('/tambah', [AdminUserController::class, 'store'])->name('admin.users.store');
        Route::get('/edit/{user}', [AdminUserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/edit/{user}', [AdminUserController::class, 'update'])->name('admin.users.update');
        Route::delete('/hapus/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
    });

    // Chat Pelanggan
    Route::prefix('chat')->group(function () {
        Route::get('/', [ChatController::class, 'adminIndex'])->name('admin.chat.index');
        Route::get('/users', [ChatController::class, 'adminGetUsers'])->name('admin.chat.users');
        Route::get('/messages/{customerId}', [ChatController::class, 'adminGetMessages'])->name('admin.chat.messages');
        Route::post('/send/{customerId}', [ChatController::class, 'adminSendMessage'])->name('admin.chat.send');
    });
});

