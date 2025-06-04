<?php

namespace App\Http\Controllers;

use App\Models\MahasiswaModel;
use App\Models\DetailPendaftaranModel;
use App\Models\KampusModel;
use App\Models\JurusanModel;
use App\Models\ProdiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JadwalSertifikat;
use App\Models\JadwalSertifikatModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use App\Models\PendaftaranModel;

class MahasiswaController extends Controller
{
    // Existing methods
public function index()
{
    $user = Auth::user();
    $toeicScore = $user->toeicScore;

    $jadwals = JadwalSertifikatModel::orderBy('tanggal', 'desc')->get();

    return view('dashboard.mahasiswa.overview', compact('toeicScore', 'jadwals'));
}

  public function viewPdf($filename)
    {
        $path = 'jadwal_pdf/' . $filename;

        if (!Storage::disk('public')->exists($path)) {
            abort(404, "File not found.");
        }

        $fileContent = Storage::disk('public')->get($path);
        $mimeType = Storage::disk('public')->mimeType($path);

        return response($fileContent, 200)
            ->header('Content-Type', $mimeType)
            ->header('Content-Disposition', 'inline; filename="'.$filename.'"');
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
    $user = auth()->user();
    $mahasiswa = $user->mahasiswa;
    
    if (!$mahasiswa) {
        return view('dashboard.mahasiswa.riwayat-ujian', [
            'registrations' => collect()
        ]);
    }

    // Gunakan relasi yang sudah diperbaiki
    $registrations = PendaftaranModel::where('mahasiswa_id', $mahasiswa->mahasiswa_id)
        ->with(['jadwal', 'detailPendaftaran']) // Eager load jadwal dan detail
        ->orderBy('tanggal_pendaftaran', 'desc')
        ->get();

    return view('dashboard.mahasiswa.riwayat-ujian', [
        'registrations' => $registrations
    ]);
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
