<?php

namespace App\Http\Controllers;

use App\Models\MahasiswaModel;
use App\Models\DetailPendaftaranModel;
use App\Models\KampusModel;
use App\Models\JurusanModel;
use App\Models\ProdiModel;
use App\Models\InformasiModel;
use App\Models\JadwalSertifikatModel;
use App\Models\NilaiToeicModel;
use App\Models\PendaftaranModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:mahasiswa']);
    }

    public function index()
    {
        $user = Auth::user();
        $toeicScore = $user->toeicScore ?? null;
        $jadwals = JadwalSertifikatModel::orderBy('tanggal', 'desc')->get();
        $informasis = InformasiModel::with('admin')->latest()->take(3)->get();
        $nilaiToeics = NilaiToeicModel::with('itc')->latest()->get();

        return view('dashboard.mahasiswa.overview', compact('toeicScore', 'jadwals', 'informasis', 'nilaiToeics'));
    }

    public function viewPdf($filename, Request $request)
    {
        $path = 'jadwal_pdf/' . $filename;

        if (!Storage::disk('public')->exists($path)) {
            abort(404, "File not found.");
        }

        $fileContent = Storage::disk('public')->get($path);
        $mimeType = Storage::disk('public')->mimeType($path);

        $disposition = $request->query('download') ? 'attachment' : 'inline';

        return response($fileContent, 200)
            ->header('Content-Type', $mimeType)
            ->header('Content-Disposition', "$disposition; filename=\"$filename\"");
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

        $registrations = PendaftaranModel::where('mahasiswa_id', $mahasiswa->mahasiswa_id)
            ->with(['jadwal', 'detailPendaftaran'])
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
    
   public function createMahasiswa()
    {
        $user = Auth::user();
        $registered = MahasiswaModel::where('pengguna_id', $user->pengguna_id)->first();

        return view('peserta.daftar', ['registered' => $registered]);
    }
    

    public function lihatNilai()
    {
        return view('dashboard.mahasiswa.nilai-toeic');
    }

    public function lihatJadwal()
    {
        return view('dashboard.mahasiswa.jadwal-sertifikat');
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $path = $file->store('avatars', 'public');

            $user->profile = $path;
            $user->save();

            return redirect()->route('mahasiswa.profile')->with('success', 'Avatar updated successfully.');
        }

        return redirect()->route('mahasiswa.profile')->with('error', 'Failed to upload avatar.');
    }
}