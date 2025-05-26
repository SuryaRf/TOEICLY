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
        $user = Auth::user();
        $toeicScore = $user->toeicScore;

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

    public function alreadyRegistered()
    {
        return view('dashboard.mahasiswa.already_registered');
    }

    public function lihatNilai()
    {
        return view('dashboard.mahasiswa.nilai-toeic');
    }

    public function lihatJadwal()
    {
        return view('dashboard.mahasiswa.jadwal-sertifikat');
    }
}