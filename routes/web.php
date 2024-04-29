<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Rute untuk registrasi
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.store');

// Rute untuk login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Middleware 'auth' akan memeriksa apakah pengguna telah login sebelum mengakses halaman utama
Route::middleware(['auth'])->group(function () {
    // Rute untuk halaman utama
    Route::get('/', [JadwalController::class, 'index'])->name('jadwals.index');
});

// Rute untuk mengunggah berkas pencairan
Route::post('/upload-berkas/{id}', [JadwalController::class, 'uploadBerkas'])->name('upload-berkas');

// Rute untuk menampilkan formulir edit jadwal
Route::get('/jadwals/{id}/edit', [JadwalController::class, 'edit'])->name('jadwals.edit');

// Rute untuk memperbarui jadwal
Route::put('/jadwals/{id}', [JadwalController::class, 'update'])->name('jadwals.update');

// Rute untuk tindakan share ke WhatsApp
Route::get('jadwals/{jadwal}/share', [JadwalController::class, 'share'])->name('jadwals.share');

// Route resource untuk jadwals
Route::resource('/jadwals', \App\Http\Controllers\JadwalController::class);