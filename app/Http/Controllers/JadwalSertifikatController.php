<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalSertifikatModel;
use App\Models\PendaftaranModel;

class JadwalSertifikatController extends Controller
{
    public function index()
    {
        $jadwals = JadwalSertifikatModel::all();
        return view('jadwal_sertifikat.index', compact('jadwals'));
    }

    // Form upload jadwal baru
    public function create()
    {
        return view('jadwal_sertifikat.create');
    }

    // Simpan jadwal baru beserta upload file PDF
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:100',
            'tanggal' => 'required|date', // validasi input tanggal
            'file_pdf' => 'required|file|mimes:pdf|max:5120', // max 5MB
        ]);

        $filePath = $request->file('file_pdf')->store('jadwal_pdf', 'public');

        JadwalSertifikatModel::create([
            'judul' => $request->judul,
             'tanggal' => $request->tanggal,  // simpan tanggal jadwal
            'file_pdf' => $filePath,
        ]);

        return redirect()->route('jadwal_sertifikat.index')->with('success', 'Jadwal berhasil diupload');
    }

    // Tampilkan peserta yang sudah daftar untuk jadwal tertentu
    public function peserta($jadwal_id)
    {
        $jadwal = JadwalSertifikatModel::findOrFail($jadwal_id);

        $pesertas = PendaftaranModel::with('mahasiswa')
            ->where('jadwal_id', $jadwal_id)
            ->get();

        return view('jadwal_sertifikat.peserta', compact('jadwal', 'pesertas'));
    }
}
