<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\TendikController;
use App\Http\Controllers\UserController; // Add this line

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [WelcomeController::class, 'index']);
// Route::get('login', [LoginController::class, 'index']);
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    // Admin dashboard route
    // Admin dashboard route
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // User management routes
    Route::get('/admin/manage', [AdminController::class, 'manage'])->name('admin.manage'); // Add this line

       // Edit user
    Route::get('/admin/manage/{user}/edit', [UserController::class, 'edit'])->name('admin.manage.edit');
    Route::put('/admin/manage/{user}', [UserController::class, 'update'])->name('admin.manage.update');

    // Hapus user
    Route::delete('/admin/manage/{user}', [UserController::class, 'destroy'])->name('admin.manage.destroy');

    

    // Mahasiswa dashboard route
    Route::get('/mahasiswa/dashboard', [MahasiswaController::class, 'index'])->name('mahasiswa.dashboard');

    // Dosen dashboard route
    Route::get('/dosen/dashboard', [DosenController::class, 'index'])->name('dosen.dashboard');

    // Tendik dashboard route
    Route::get('/tendik/dashboard', [TendikController::class, 'index'])->name('tendik.dashboard');
});
