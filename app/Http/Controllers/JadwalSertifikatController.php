<?php

namespace App\Http\Controllers;

use App\Models\JadwalSertifikatModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class JadwalSertifikatController extends Controller
{
    public function index()
    {
        $jadwals = JadwalSertifikatModel::orderBy('tanggal', 'desc')->get();
        return view('jadwal_sertifikat.index', compact('jadwals'));
    }

    public function create()
    {
        return view('jadwal_sertifikat.create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'file_pdf' => 'required|file|mimes:pdf|max:2048', // Max 2MB
        ]);

        try {
            // Handle the file upload
            if ($request->hasFile('file_pdf')) {
                // Store the file in storage/app/public/jadwal_pdf/
                $file = $request->file('file_pdf');
                $filename = $file->hashName(); // Generates a random filename like cn9ZUXHawGyS5KJmyWDkcx7OO2gEdPoIxqUBdPsY.pdf
                $path = $file->storeAs('jadwal_pdf', $filename, 'public');

                // Create a new JadwalSertifikat record
                JadwalSertifikatModel::create([
                    'judul' => $request->judul,
                    'tanggal' => $request->tanggal,
                    'file_pdf' => $path, // Store the relative path (e.g., jadwal_pdf/cn9ZUXHawGyS5KJmyWDkcx7OO2gEdPoIxqUBdPsY.pdf)
                ]);

                return redirect()->route('jadwal_sertifikat.index')->with('success', 'Jadwal uploaded successfully.');
            }

            return redirect()->back()->withErrors(['file_pdf' => 'File upload failed.']);
        } catch (\Exception $e) {
            Log::error('Error uploading jadwal: ' . $e->getMessage());
            return redirect()->back()->withErrors(['file_pdf' => 'An error occurred while uploading the file.']);
        }
    }

    public function peserta($jadwal_id)
    {
        // Logic for showing participants (if needed)
        return view('jadwal_sertifikat.peserta', compact('jadwal_id'));
    }
}