<?php

use Illuminate\Support\Facades\Route;
// In your routes/web.php file

use App\Http\Controllers\JadwalController;

// Define the route for uploading berkas pencairan
Route::post('/upload-berkas/{id}', [JadwalController::class, 'uploadBerkas'])->name('upload-berkas');

// Rute untuk menampilkan formulir edit jadwal
Route::get('/jadwals/{id}/edit', [JadwalController::class, 'edit'])->name('jadwals.edit');

// Rute untuk memperbarui jadwal
Route::put('/jadwals/{id}', [JadwalController::class, 'update'])->name('jadwals.update');

// Definisikan rute untuk tindakan share ke WhatsApp
Route::get('jadwals/{jadwal}/share', [JadwalController::class, 'share'])->name('jadwals.share');

// Route::get('/', function () {
//     return view('welcome');
// });

// Route resource untuk jadwals
Route::resource('/jadwals', \App\Http\Controllers\JadwalController::class);