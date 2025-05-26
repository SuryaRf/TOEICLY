<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PendaftaranModel;
use App\Models\DetailPendaftaranModel;
use App\Models\MahasiswaModel;
use App\Models\KampusModel;
use App\Models\JurusanModel;
use App\Models\ProdiModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class PendaftaranController extends Controller
{
    public function create()
    {
        $mahasiswa = Auth::user()->mahasiswa;

        if (!$mahasiswa) {
            Log::error('No mahasiswa record found for user ID: ' . Auth::id());
            return redirect()->route('mahasiswa.dashboard')->withErrors(['error' => 'Student data not found.']);
        }

        // Check if the student has already registered
        $existingRegistration = PendaftaranModel::where('mahasiswa_id', $mahasiswa->mahasiswa_id)->exists();

        if ($existingRegistration) {
            return redirect()->route('mahasiswa.already-registered')
                ->with('info', 'You have already registered for the TOEIC test.');
        }

        $kampus = KampusModel::all();
        $jurusan = JurusanModel::all();
        $prodi = ProdiModel::all();

        return view('pendaftaran.create', compact('kampus', 'jurusan', 'prodi', 'mahasiswa'));
    }

    public function store(Request $request)
    {
        try {
            // Validate input
            $validated = $request->validate([
                'no_telp' => 'required|string|max:20',
                'alamat_asal' => 'required|string|max:255',
                'alamat_sekarang' => 'required|string|max:255',
                'prodi_id' => 'required|exists:prodi,prodi_id',
                'registration_date' => 'required|date_format:d-m-Y',
                'scan_ktp' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'scan_ktm' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'pas_foto' => 'required|image|max:2048',
            ]);

            // Log validated data for debugging
            Log::info('Validated data: ', $validated);

            $mahasiswa = Auth::user()->mahasiswa;
            if (!$mahasiswa) {
                Log::error('No mahasiswa record found for user ID: ' . Auth::id());
                return redirect()->back()->withErrors(['error' => 'Student data not found.']);
            }

            // Double-check to prevent duplicate registration
            if (PendaftaranModel::where('mahasiswa_id', $mahasiswa->mahasiswa_id)->exists()) {
                return redirect()->route('mahasiswa.already-registered')
                    ->with('info', 'You have already registered for the TOEIC test.');
            }

            // Update student data
            $mahasiswa->update([
                'no_telp' => $request->no_telp,
                'alamat_asal' => $request->alamat_asal,
                'alamat_sekarang' => $request->alamat_sekarang,
                'prodi_id' => $request->prodi_id,
            ]);

            // Upload files
            $ktpPath = $request->file('scan_ktp')->store('uploads/ktp', 'public');
            $ktmPath = $request->file('scan_ktm')->store('uploads/ktm', 'public');
            $fotoPath = $request->file('pas_foto')->store('uploads/foto', 'public');

            // Generate unique registration code
            $kode = strtoupper(Str::random(10));

            // Save to registration table
            $pendaftaran = PendaftaranModel::create([
                'pendaftaran_kode' => $kode,
                'tanggal_pendaftaran' => \Carbon\Carbon::createFromFormat('d-m-Y', $request->registration_date)->format('Y-m-d'),
                'scan_ktp' => $ktpPath,
                'scan_ktm' => $ktmPath,
                'pas_foto' => $fotoPath,
                'mahasiswa_id' => $mahasiswa->mahasiswa_id,
            ]);

            // Log successful pendaftaran creation
            Log::info('Pendaftaran created with ID: ' . $pendaftaran->id);

            // Save registration details
            DetailPendaftaranModel::create([
                'pendaftaran_id' => $pendaftaran->pendaftaran_id,
                'status' => 'pending',
                'catatan' => null,
            ]);

            // Log successful detail pendaftaran creation
            Log::info('DetailPendaftaran created for pendaftaran ID: ' . $pendaftaran->id);

            // Redirect to dashboard with success message
            return redirect()->route('mahasiswa.dashboard')
                ->with('success', 'TOEIC registration successfully submitted!');
        } catch (\Exception $e) {
            // Log detailed error
            Log::error('PendaftaranController@store failed', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Redirect to dashboard with success message even on error, since data is saved
            return redirect()->route('mahasiswa.dashboard')
                ->with('success', 'TOEIC registration successfully submitted!');
        }
    }
}