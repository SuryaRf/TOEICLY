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
    // Existing methods
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
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa()->with('prodi')->first();
        return view('dashboard.mahasiswa.profile', compact('user', 'mahasiswa'));
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

    // New method for avatar upload
    public function updateAvatar(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
        ]);

        $user = Auth::user();

        if ($request->hasFile('avatar')) {
            // Store the file in storage/app/public/avatars
            $file = $request->file('avatar');
            $path = $file->store('avatars', 'public');

            // Update the user's profile field with the file path
            $user->profile = $path;
            $user->save();

            return redirect()->route('dashboard.mahasiswa.profile')->with('success', 'Avatar updated successfully.');
        }

        return redirect()->route('dashboard.mahasiswa.profile')->with('error', 'Failed to upload avatar.');
    }
}