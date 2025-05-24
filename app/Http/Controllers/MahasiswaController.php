<?php

namespace App\Http\Controllers;

use App\Models\MahasiswaModel;
use App\Models\KampusModel;
use App\Models\JurusanModel;
use App\Models\ProdiModel;
use App\Models\JadwalModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    // Halaman utama (overview)
    public function index()
    {
        $user = Auth::user(); // Ambil user yang login
        $toeicScore = $user->toeicScore; // Ambil data TOEIC via relasi

        return view('dashboard.mahasiswa.overview', compact('toeicScore'));
    }

    public function daftarTes()
    {
        $kampus = KampusModel::all();
        $jurusan = JurusanModel::all();
        $prodi = ProdiModel::all();
        $jadwal = JadwalModel::all();

        // Ambil mahasiswa dari user yang login, eager load prodi
        $mahasiswa = Auth::user()->mahasiswa()->with('prodi')->first();

        return view('pendaftaran.create', compact('kampus', 'jurusan', 'prodi', 'jadwal', 'mahasiswa'));
    }

    public function riwayatUjian()
    {
        return view('dashboard.mahasiswa.riwayat-ujian');
    }

    public function profile()
    {
        $user = Auth::user();

        // Ambil mahasiswa dengan eager loading prodi
        $mahasiswa = $user->mahasiswa()->with('prodi')->first();

        return view('dashboard.mahasiswa.profile', compact('mahasiswa', 'user'));
    }
}
