<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\DashboardController;

// Rute bawaan halaman utama (Welcome Page)
Route::inertia('/', 'Welcome')->name('home');

// Rute bawaan yang dilindungi password / wajib login
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ========================================================
    // RUTE TUGAS BOOTCAMP: MANAJEMEN PENDUDUK & DESA
    // ========================================================
    Route::resource('penduduk', PendudukController::class);
    Route::resource('desa', DesaController::class);
});

require __DIR__.'/settings.php';