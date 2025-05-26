<?php

namespace App\Http\Controllers;

use App\Models\MahasiswaModel;
use App\Models\DetailPendaftaranModel;
use App\Models\KampusModel;
use App\Models\JurusanModel;
use App\Models\ProdiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    // Halaman utama (overview)
    public function index()
    {
        $user = Auth::user(); // ambil user yang login
        $toeicScore = $user->toeicScore; // ambil data TOEIC via relasi

        return view('dashboard.mahasiswa.overview', compact('toeicScore'));
    }

    public function daftarTes()
    {
        $kampus = KampusModel::all();
        $jurusan = JurusanModel::all();
        $prodi = ProdiModel::all();
        $mahasiswa = Auth::user()->mahasiswa;

        return view('pendaftaran.create', compact('kampus', 'jurusan', 'prodi', 'mahasiswa'));
    }

    public function riwayatUjian()
    {
        return view('dashboard.mahasiswa.riwayat-ujian');
    }

    public function profile()
    {
        return view('dashboard.mahasiswa.profile');
    }
}