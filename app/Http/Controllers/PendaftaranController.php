<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PendaftaranModel;
use App\Models\DetailPendaftaranModel;
use App\Models\MahasiswaModel;
use App\Models\KampusModel;
use App\Models\JurusanModel;
use App\Models\ProdiModel;
use App\Models\JadwalModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PendaftaranController extends Controller
{
    public function create()
    {
        $kampus = KampusModel::all();
        $jurusan = JurusanModel::all();
        $prodi = ProdiModel::all();
        $jadwal = JadwalModel::all();

        $mahasiswa = Auth::user()->mahasiswa;

        return view('pendaftaran.create', compact('kampus', 'jurusan', 'prodi', 'jadwal', 'mahasiswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_telp' => 'required|string|max:20',
            'alamat_asal' => 'required|string|max:255',
            'alamat_sekarang' => 'required|string|max:255',
            'prodi_id' => 'required|exists:prodi,prodi_id',
            'jadwal_id' => 'required|exists:jadwal,jadwal_id',
            'scan_ktp' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'scan_ktm' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'pas_foto' => 'required|image|max:2048',
        ]);

        $mahasiswa = Auth::user()->mahasiswa;
        if (!$mahasiswa) {
            return redirect()->back()->withErrors('Data mahasiswa tidak ditemukan.');
        }

        // Update data mahasiswa
        $mahasiswa->update([
            'no_telp' => $request->no_telp,
            'alamat_asal' => $request->alamat_asal,
            'alamat_sekarang' => $request->alamat_sekarang,
            'prodi_id' => $request->prodi_id,
        ]);

        // Upload file
        $ktpPath = $request->file('scan_ktp')->store('uploads/ktp', 'public');
        $ktmPath = $request->file('scan_ktm')->store('uploads/ktm', 'public');
        $fotoPath = $request->file('pas_foto')->store('uploads/foto', 'public');

        // Buat kode pendaftaran unik
        $kode = strtoupper(Str::random(10));

        // Simpan ke tabel pendaftaran
        $pendaftaran = PendaftaranModel::create([
            'pendaftaran_kode' => $kode,
            'tanggal_pendaftaran' => now(),
            'scan_ktp' => $ktpPath,
            'scan_ktm' => $ktmPath,
            'pas_foto' => $fotoPath,
            'mahasiswa_id' => $mahasiswa->mahasiswa_id,
            'jadwal_id' => $request->jadwal_id,
        ]);

        // Simpan detail pendaftaran
        DetailPendaftaranModel::create([
            'pendaftaran_id' => $pendaftaran->pendaftaran_id,
            'status' => 'menunggu',
            'catatan' => null,
        ]);

        // Redirect ke dashboard overview mahasiswa
return redirect()->route('mahasiswa.dashboard')
                 ->with('success', 'Pendaftaran TOEIC berhasil diajukan!');
    }
}
