<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\KategoriController;

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\OrderController;

// ==================================
// PUBLIC ROUTES
// ==================================
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// ==================================
// ADMIN ROUTES
// ==================================
Route::prefix('admin')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {

        Route::get('/dashboard', [AdminController::class, 'index'])
        ->name('admin.dashboard');

        Route::resource('produk', ProdukController::class)
            ->names('admin.produk');

        Route::resource('kategori', KategoriController::class)
            ->names('admin.kategori');

        // Route::get('/konfirmasi', function () { return 'Halaman Konfirmasi Pesanan'; })
        //     ->name('admin.konfirmasi.index');

        Route::get('/pesanan', [AdminController::class, 'pesanan'])
            ->name('admin.pesanan.index');


        Route::get('/transaksi', function () { return 'Halaman Transaksi'; })
            ->name('admin.transaksi.index');
    });

// ==================================
// USER ROUTES
// ==================================
Route::prefix('user')
    ->name('user.')
    ->middleware('auth')
    ->group(function () {

        // DASHBOARD
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

        // =========================
        // CART
        // =========================
        
        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
        Route::post('/cart/add/{id}', [CartController::class, 'store'])->name('cart.add');
        Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
        Route::post('/cart/remove/{id}', [CartController::class, 'destroy'])->name('cart.remove');

        // =========================
        // CHECKOUT
        // =========================
        Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
        Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
        Route::post('/checkout/now/{id}', [CheckoutController::class, 'buyNow'])->name('checkout.now');


        // =========================
        // ORDER
        // =========================
        Route::get('/riwayat', [OrderController::class, 'index'])->name('riwayat');

        // DOWNLOAD STRUK PDF
        Route::get('/struk/{id}', [OrderController::class, 'pdf'])->name('struk');
    });

// ==================================
// TEST ROUTE
// ==================================
Route::get('/test-upload', function () {
    $file = request()->file('foto');
    dd($file);
});
