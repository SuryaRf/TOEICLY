<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\TendikController;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Login routes
Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard routes with authentication middleware
Route::middleware(['auth'])->group(function () {

    // Admin dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // TOEIC dashboard for Mahasiswa
Route::prefix('mahasiswa')->group(function () {
    Route::get('/', [MahasiswaController::class, 'index'])->name('mahasiswa.dashboard');
    Route::get('/profile', [MahasiswaController::class, 'profile'])->name('mahasiswa.profile'); // Profil
    Route::get('/daftar-tes', [MahasiswaController::class, 'daftarTes'])->name('mahasiswa.daftar-tes');
    Route::get('/riwayat-ujian', [MahasiswaController::class, 'riwayatUjian'])->name('mahasiswa.riwayat-ujian');
    Route::post('/logout', [LoginController::class, 'logout'])->name('mahasiswa.logout');
});



    // Dosen dashboard
    Route::get('/dosen/dashboard', [DosenController::class, 'index'])->name('dosen.dashboard');

    // Tendik dashboard
    Route::get('/tendik/dashboard', [TendikController::class, 'index'])->name('tendik.dashboard');
});
