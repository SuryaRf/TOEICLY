<?php

namespace App\Http\Controllers;

use App\Models\JadwalSertifikatModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class JadwalSertifikatController extends Controller
{
    public function index()
    {
        // Ambil semua jadwal, pastikan id, judul, tanggal, file_pdf ada
        $jadwals = JadwalSertifikatModel::orderBy('tanggal', 'desc')->get();
        return view('jadwal_sertifikat.index', compact('jadwals'));
    }

    public function create()
    {
        return view('jadwal_sertifikat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'file_pdf' => 'required|file|mimes:pdf|max:2048',
        ]);

        try {
            if ($request->hasFile('file_pdf')) {
                $file = $request->file('file_pdf');
                $filename = $file->hashName();
                $path = $file->storeAs('jadwal_pdf', $filename, 'public');

                JadwalSertifikatModel::create([
                    'judul' => $request->judul,
                    'tanggal' => $request->tanggal,
                    'file_pdf' => $path,
                ]);

                return redirect()->route('jadwal_sertifikat.index')->with('success', 'Jadwal uploaded successfully.');
            }

            return redirect()->back()->withErrors(['file_pdf' => 'File upload failed.']);
        } catch (\Exception $e) {
            Log::error('Error uploading jadwal: ' . $e->getMessage());
            return redirect()->back()->withErrors(['file_pdf' => 'An error occurred while uploading the file.']);
        }
    }

    public function edit($jadwal_id)
    {
        $jadwal = JadwalSertifikatModel::findOrFail($jadwal_id);
        return view('jadwal_sertifikat.edit', compact('jadwal'));
    }

    public function update(Request $request, $jadwal_id)
    {
        $jadwal = JadwalSertifikatModel::findOrFail($jadwal_id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'file_pdf' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        try {
            $data = [
                'judul' => $request->judul,
                'tanggal' => $request->tanggal,
            ];

            if ($request->hasFile('file_pdf')) {
                // Delete old file if exists
                if ($jadwal->file_pdf && Storage::disk('public')->exists($jadwal->file_pdf)) {
                    Storage::disk('public')->delete($jadwal->file_pdf);
                }
                $file = $request->file('file_pdf');
                $filename = $file->hashName();
                $path = $file->storeAs('jadwal_pdf', $filename, 'public');
                $data['file_pdf'] = $path;
            }

            $jadwal->update($data);

            return redirect()->route('jadwal_sertifikat.index')->with('success', 'Jadwal updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating jadwal: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the jadwal.']);
        }
    }

    public function destroy($jadwal_id)
    {
        try {
            $jadwal = JadwalSertifikatModel::findOrFail($jadwal_id);
            if ($jadwal->file_pdf && Storage::disk('public')->exists($jadwal->file_pdf)) {
                Storage::disk('public')->delete($jadwal->file_pdf);
            }
            $jadwal->delete();

            return redirect()->route('jadwal_sertifikat.index')->with('success', 'Jadwal deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting jadwal: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred while deleting the jadwal.']);
        }
    }

    public function peserta($jadwal_id)
    {
        return view('jadwal_sertifikat.peserta', compact('jadwal_id'));
    }

    public function destroy($jadwal_id)
    {
        $jadwal = JadwalSertifikatModel::findOrFail($jadwal_id);

        // Hapus file PDF dari storage jika ada
        if ($jadwal->file_pdf && Storage::disk('public')->exists($jadwal->file_pdf)) {
            Storage::disk('public')->delete($jadwal->file_pdf);
        }

        $jadwal->delete();

        return redirect()->route('jadwal_sertifikat.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}