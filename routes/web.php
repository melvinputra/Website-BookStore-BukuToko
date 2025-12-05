<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\BukuController as AdminBukuController;
use App\Http\Controllers\Admin\PesananController as AdminPesananController;
use App\Http\Controllers\User\DashboardController as UserDashboard;
use App\Http\Controllers\User\BukuController as UserBukuController;
use App\Http\Controllers\User\KeranjangController;
use App\Http\Controllers\User\PesananController as UserPesananController;
use App\Http\Controllers\User\ProfilController;
use Illuminate\Support\Facades\Route;

// Landing Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Login
Route::get('/admin/login', [AuthController::class, 'showAdminLogin'])->name('admin.login');

// Admin Routes (Protected)
Route::prefix('admin')->middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    Route::get('/users', [AdminDashboard::class, 'users'])->name('users');
    
    // Kategori CRUD
    Route::resource('kategori', KategoriController::class);
    
    // Buku CRUD
    Route::resource('buku', AdminBukuController::class);
    
    // Pesanan Management
    Route::get('/pesanan', [AdminPesananController::class, 'index'])->name('pesanan.index');
    Route::get('/pesanan/{pesanan}', [AdminPesananController::class, 'show'])->name('pesanan.show');
    Route::post('/pesanan/{pesanan}/konfirmasi', [AdminPesananController::class, 'konfirmasi'])->name('pesanan.konfirmasi');
    Route::post('/pesanan/{pesanan}/proses', [AdminPesananController::class, 'proses'])->name('pesanan.proses');
    Route::post('/pesanan/{pesanan}/kirim', [AdminPesananController::class, 'kirim'])->name('pesanan.kirim');
    Route::post('/pesanan/{pesanan}/selesai', [AdminPesananController::class, 'selesai'])->name('pesanan.selesai');
    Route::post('/pesanan/{pesanan}/batal', [AdminPesananController::class, 'batal'])->name('pesanan.batal');
});

// User Routes (Protected)
Route::prefix('user')->middleware(['auth', 'role:user'])->name('user.')->group(function () {
    Route::get('/dashboard', [UserDashboard::class, 'index'])->name('dashboard');
    
    // Buku Catalog
    Route::get('/buku', [UserBukuController::class, 'index'])->name('buku.index');
    Route::get('/buku/{buku}', [UserBukuController::class, 'show'])->name('buku.show');
    
    // Keranjang
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
    Route::post('/keranjang/{buku}', [KeranjangController::class, 'store'])->name('keranjang.store');
    Route::patch('/keranjang/{keranjang}', [KeranjangController::class, 'update'])->name('keranjang.update');
    Route::delete('/keranjang/{keranjang}', [KeranjangController::class, 'destroy'])->name('keranjang.destroy');
    
    // Pesanan
    Route::get('/pesanan', [UserPesananController::class, 'index'])->name('pesanan.index');
    Route::get('/checkout', [UserPesananController::class, 'showCheckout'])->name('pesanan.checkout.show');
    Route::post('/checkout', [UserPesananController::class, 'checkout'])->name('pesanan.checkout');
    Route::get('/beli-sekarang/{buku}', [UserPesananController::class, 'showCheckoutBuyNow'])->name('pesanan.buynow.show');
    Route::post('/beli-sekarang', [UserPesananController::class, 'checkoutBuyNow'])->name('pesanan.buynow');
    Route::get('/pesanan/{pesanan}', [UserPesananController::class, 'show'])->name('pesanan.show');
    Route::post('/pesanan/{pesanan}/upload-bukti', [UserPesananController::class, 'uploadBukti'])->name('pesanan.upload');
    Route::post('/pesanan/{pesanan}/batal', [UserPesananController::class, 'batal'])->name('pesanan.batal');
    Route::post('/pesanan/{pesanan}/selesai', [UserPesananController::class, 'selesai'])->name('pesanan.selesai');
    
    // Profil
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
    Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');
    Route::put('/profil/password', [ProfilController::class, 'updatePassword'])->name('profil.password');
});
