<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    // Halaman utama (overview)
    public function index()
    {
        return view('dashboard.mahasiswa.overview');
    }

    public function daftarTes()
    {
        return view('dashboard.mahasiswa.daftar-tes');
    }

    public function riwayatUjian()
    {
        return view('dashboard.mahasiswa.riwayat-ujian');
    }
    // MahasiswaController.php
public function profile()
{
    return view('dashboard.mahasiswa.profile');
}

}
