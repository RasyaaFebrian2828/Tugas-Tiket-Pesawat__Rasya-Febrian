<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PenerbanganController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\User\PembayaranController;
use App\Http\Controllers\User\InvoiceController;
use App\Http\Controllers\Admin\AdminPembayaranController;
use App\Http\Controllers\Admin\AdminPenerbanganController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RoleMiddleware;

/* ================== HOME (PUBLIK & USER) ================== */
Route::get('/', [UserController::class, 'dashboard'])->name('home');

/* ================== AUTH ================== */
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/* ================== USER AREA ================== */
Route::middleware([RoleMiddleware::class . ':user'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

    Route::get('/pemesanan', [PemesananController::class, 'index'])->name('pemesanan.index');
    Route::get('/pesan/{kelas_id}', [PemesananController::class, 'create'])->name('pemesanan.create');
    Route::post('/pesan', [PemesananController::class, 'store'])->name('pemesanan.store');

    Route::get('/pembayaran/{pemesanan_id}/create', [PembayaranController::class, 'create'])->name('pembayaran.create');
    Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');

    Route::get('/invoice/{pemesanan_id}', [InvoiceController::class, 'show'])->name('invoice.show');
});

/* ================== ADMIN AREA ================== */
Route::prefix('admin')->middleware([RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // CRUD penerbangan
    Route::resource('penerbangan', AdminPenerbanganController::class, ['as' => 'admin']);

    // CRUD user
    Route::resource('user', AdminUserController::class, ['as' => 'admin']);

    // Kelas penerbangan
    Route::post('/penerbangan/{id}/kelas', [AdminPenerbanganController::class, 'storeKelas'])->name('admin.penerbangan.kelas.store');

    // Pembayaran admin
    Route::get('/pembayaran', [AdminPembayaranController::class, 'index'])->name('admin.pembayaran.index');
    Route::post('/pembayaran/{id}/update', [AdminPembayaranController::class, 'updateStatus'])->name('admin.pembayaran.update');
});
