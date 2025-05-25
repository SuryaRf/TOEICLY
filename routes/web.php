<?php

use Illuminate\Support\Facades\Route;

// Import controller umum
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\TendikController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController; // ProfileController umum
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\KampusController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\JadwalSertifikatController;
use App\Http\Controllers\ItcController;

// Import khusus ProfileController di folder Mahasiswa dengan alias
use App\Http\Controllers\Mahasiswa\ProfileController as MahasiswaProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Route publik
Route::get('/', [WelcomeController::class, 'index']);
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Semua route yang butuh autentikasi
Route::middleware('auth')->group(function () {

    // Admin routes
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/manage', [AdminController::class, 'manage'])->name('admin.manage');
        Route::get('/manage/{user}/edit', [UserController::class, 'edit'])->name('admin.manage.edit');
        Route::put('/manage/{user}', [UserController::class, 'update'])->name('admin.manage.update');
        Route::delete('/manage/{user}', [UserController::class, 'destroy'])->name('admin.manage.destroy');
        Route::get('/pendaftar', [AdminController::class, 'daftarPendaftarSertifikat'])->name('admin.pendaftar');

        // Profile admin (umum)
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::post('/profile/avatar', [ProfileController::class, 'uploadAvatar'])->name('profile.uploadAvatar');
    });

    // Resource routes Kampus, Jurusan, Prodi + list khusus
    Route::get('kampus/list', [KampusController::class, 'list'])->name('kampus.list');
    Route::resource('kampus', KampusController::class);
    Route::get('kampus/{id}/edit_ajax', [KampusController::class, 'editAjax'])->name('kampus.edit_ajax');
    Route::get('kampus/{id}/delete_ajax', [KampusController::class, 'deleteAjax'])->name('kampus.delete_ajax');


    Route::get('jurusan/list', [JurusanController::class, 'list'])->name('jurusan.list');
    Route::resource('jurusan', JurusanController::class);

    Route::get('prodi/list', [ProdiController::class, 'list'])->name('prodi.list');
    Route::resource('prodi', ProdiController::class);

    // Jadwal Sertifikat
    Route::prefix('jadwal-sertifikat')->group(function () {
        Route::get('/', [JadwalSertifikatController::class, 'index'])->name('jadwal_sertifikat.index');
        Route::get('/create', [JadwalSertifikatController::class, 'create'])->name('jadwal_sertifikat.create');
        Route::post('/', [JadwalSertifikatController::class, 'store'])->name('jadwal_sertifikat.store');
        Route::get('/{jadwal_id}/peserta', [JadwalSertifikatController::class, 'peserta'])->name('jadwal_sertifikat.peserta');
    });

    // Pendaftaran
    Route::get('pendaftaran/create', [PendaftaranController::class, 'create'])->name('pendaftaran.create');
    Route::post('pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');

    // Profile umum (admin atau user lain)
    Route::get('profile', [ProfileController::class, 'showProfile'])->name('profile.show');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

    // Mahasiswa routes khusus
    Route::prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        Route::get('/', [MahasiswaController::class, 'index'])->name('dashboard');

        // // Profile mahasiswa menggunakan controller di namespace Mahasiswa
        Route::get('/profile', [MahasiswaController::class, 'profile'])->name('profile');
        // Route::post('/profile/avatar', [MahasiswaProfileController::class, 'uploadAvatar'])->name('profile.uploadAvatar');

        Route::get('/daftar-tes', [MahasiswaController::class, 'daftarTes'])->name('daftar-tes');
        Route::get('/riwayat-ujian', [MahasiswaController::class, 'riwayatUjian'])->name('riwayat-ujian');
        Route::get('/nilai-toeic', [MahasiswaController::class, 'lihatNilai'])->name('nilai-toeic');
        Route::get('/jadwal-sertifikat', [MahasiswaController::class, 'lihatJadwal'])->name('jadwal-sertifikat');

        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    });

    // ITC routes
    Route::prefix('itc')->group(function () {
        Route::get('/dashboard', [ItcController::class, 'index'])->name('itc.dashboard');
        Route::get('/profile', [ItcController::class, 'showProfile'])->name('itc.profile');
        Route::put('/profile', [ItcController::class, 'updateProfile'])->name('itc.profile.update');

        Route::get('/pendaftar', [ItcController::class, 'daftarPendaftar'])->name('itc.pendaftar');
        Route::post('/pendaftar/{pendaftaran}/status-sertifikat', [ItcController::class, 'updateStatusSertifikat'])->name('itc.updateStatusSertifikat');

        Route::get('/upload-nilai', [ItcController::class, 'showUploadNilaiForm'])->name('itc.upload_nilai');
        Route::post('/upload-nilai', [ItcController::class, 'uploadNilai'])->name('itc.upload_nilai.store');
    });

    // Dosen dashboard
    Route::get('dosen/dashboard', [DosenController::class, 'index'])->name('dosen.dashboard');

    // Tendik dashboard
    Route::get('tendik/dashboard', [TendikController::class, 'index'])->name('tendik.dashboard');
});
