<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;  // Pastikan model AdminModel sudah ada
use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\PendaftaranModel;

class AdminController extends Controller
{
    // Pastikan menggunakan middleware auth agar hanya pengguna yang login yang bisa mengakses
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Menampilkan halaman dashboard admin
    public function index()
    {
        // Mendapatkan data admin
        $data = AdminModel::all();  // Menyesuaikan dengan data yang ingin ditampilkan

        // Mengirim data ke view
        return view('dashboard.admin.index', compact('data'));
    }
    public function manage()
    {
        // Ambil semua user dengan relasi masing-masing role
        $users = UserModel::with(['admin', 'mahasiswa', 'dosen', 'tendik'])->get();

        return view('dashboard.admin.manage.index', compact('users'));
    }

    public function daftarPendaftarSertifikat()
    {
        $pendaftarans = PendaftaranModel::with(['mahasiswa', 'jadwal', 'detail', 'sertifikatStatus'])->get();
        return view('daftar_pendaftar.daftar_pendaftar_sertifikat', compact('pendaftarans'));
    }
}
