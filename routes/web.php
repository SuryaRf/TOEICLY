<?php

use Illuminate\Support\Facades\Route;

// Import controllers
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\TendikController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\KampusController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\JadwalSertifikatController;
use App\Http\Controllers\ItcController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Mahasiswa\ProfileController as MahasiswaProfileController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\EmailController; // New controller
use App\Http\Controllers\AdminEmailController; // New controller for admin email

// Route publik
Route::get('/', [WelcomeController::class, 'index']);
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('forgot-password');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

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
        Route::get('/pendaftar/verifikasi', [AdminController::class, 'daftarPendaftarVerifikasi'])->name('admin.pendaftarVerifikasi');
        Route::post('/pendaftar/verify/{id}/{status}', [AdminController::class, 'verifyPendaftaran'])->name('admin.verify');
        Route::patch('/pendaftar/edit/{id}', [AdminController::class, 'editStatus'])->name('admin.editStatus');

        // Informasi Routes
        Route::get('/informasi', [InformasiController::class, 'index'])->name('informasi.index');
        Route::get('/informasi/create', [InformasiController::class, 'create'])->name('informasi.create');
        Route::post('/informasi', [InformasiController::class, 'store'])->name('informasi.store');
        Route::get('/informasi/{id}/edit', [InformasiController::class, 'edit'])->name('informasi.edit');
        Route::put('/informasi/{id}', [InformasiController::class, 'update'])->name('informasi.update');
        Route::delete('/informasi/{id}', [InformasiController::class, 'destroy'])->name('informasi.destroy');

        // Email Sending Routes
        Route::get('/send-email', [AdminEmailController::class, 'create'])->name('admin.send_email');
        Route::post('/send-email', [AdminEmailController::class, 'send'])->name('admin.send_email.submit');
        
        Route::get('/admin/certificate-requests', [AdminController::class, 'certificateRequests'])->name('admin.certificate_requests');
        Route::get('/admin/certificate-requests/{id}/approve', [AdminController::class, 'approveCertificate'])->name('admin.approve_certificate');
        Route::get('/admin/certificate-requests/{id}/reject', [AdminController::class, 'rejectCertificate'])->name('admin.reject_certificate');
        Route::get('/admin/certificate-requests/{id}/download', [AdminController::class, 'downloadCertificate'])->name('admin.download_certificate');
        // Profile admin
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::post('/profile/avatar', [ProfileController::class, 'uploadAvatar'])->name('profile.uploadAvatar');
    });

    // Resource routes Kampus, Jurusan, Prodi
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
        Route::get('/{jadwal_id}/edit', [JadwalSertifikatController::class, 'edit'])->name('jadwal_sertifikat.edit');
        Route::put('/{jadwal_id}', [JadwalSertifikatController::class, 'update'])->name('jadwal_sertifikat.update');
        Route::delete('/{jadwal_id}', [JadwalSertifikatController::class, 'destroy'])->name('jadwal_sertifikat.destroy');
    });

    // Pendaftaran
    Route::get('pendaftaran/create', [PendaftaranController::class, 'create'])->name('pendaftaran.create');
    Route::post('pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');

    // Profile umum
    Route::get('profile', [ProfileController::class, 'showProfile'])->name('profile.show');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

    // Mahasiswa routes
    // Mahasiswa routes
    Route::prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        Route::get('/', [MahasiswaController::class, 'index'])->name('dashboard');
        Route::get('/certificate/view/{filename}', [MahasiswaController::class, 'viewPdf'])->name('certificate.view');

        Route::get('/profile', [MahasiswaController::class, 'profile'])->name('profile');
        Route::get('/certificate/view/{filename}', [CertificateController::class, 'viewPdf'])->name('certificate.view');

        Route::get('/daftar-tes', [MahasiswaController::class, 'daftarTes'])->name('daftar-tes');
        Route::get('/riwayat-ujian', [MahasiswaController::class, 'riwayatUjian'])->name('riwayat-ujian');
        Route::get('/nilai-toeic', [MahasiswaController::class, 'lihatNilai'])->name('nilai-toeic');
        Route::get('/jadwal-sertifikat', [MahasiswaController::class, 'lihatJadwal'])->name('jadwal-sertifikat');
        Route::get('/already-registered', [MahasiswaController::class, 'alreadyRegistered'])->name('already-registered');
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
        Route::post('/profile/avatar', [MahasiswaController::class, 'updateAvatar'])->name('update-avatar');
        Route::get('/request-certificate', [MahasiswaController::class, 'showRequestCertificate'])->name('request_certificate');
        Route::post('/request-certificate/{pendaftaran_id}', [MahasiswaController::class, 'requestCertificate'])->name('requestCertificate');
        Route::get('/request-certificate/sample', [MahasiswaController::class, 'showSampleCertificate'])->name('request_certificate.sample');
    });

    // ITC routes
    Route::prefix('itc')->group(function () {
        Route::get('/dashboard', [ItcController::class, 'index'])->name('itc.dashboard');
        Route::get('/profile', [ItcController::class, 'showProfile'])->name('itc.profile');
        Route::put('/profile', [ItcController::class, 'updateProfile'])->name('itc.profile.update');

        Route::get('/pendaftar', [ItcController::class, 'daftarPendaftar'])->name('itc.pendaftar');
        Route::post('/pendaftar/{pendaftaran}/status-sertifikat', [ItcController::class, 'updateStatusSertifikat'])->name('itc.updateStatusSertifikat');

        // Upload Nilai TOEIC
        Route::get('/upload-nilai', [ItcController::class, 'showUploadNilaiForm'])->name('itc.upload_nilai');
        Route::post('/upload-nilai', [ItcController::class, 'uploadNilai'])->name('itc.upload_nilai.store');
        Route::delete('/upload-nilai/{id}', [ItcController::class, 'deleteNilai'])->name('itc.upload_nilai.destroy'); // <--- Tambahkan ini
        Route::get('/nilai/view/{filename}', [ItcController::class, 'viewNilaiPdf'])->name('itc.nilai.view');
    });
    // Dosen dashboard
    Route::get('dosen/dashboard', [DosenController::class, 'index'])->name('dosen.dashboard');

    // Tendik dashboard
    Route::get('tendik/dashboard', [TendikController::class, 'index'])->name('tendik.dashboard');
});
