<?php

namespace App\Http\Controllers;

use App\Models\ItcModel;
use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Auth;
use App\Models\PendaftaranModel;
use App\Models\SertifikatStatus;


use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ItcController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

   public function index()
    {
        // Count total users
        $totalUsers = UserModel::count();

        // Fetch data for monthly test registrations (last 12 months)
        $monthlyData = PendaftaranModel::select(
            DB::raw("DATE_FORMAT(tanggal_pendaftaran, '%Y-%m') as month"),
            DB::raw('COUNT(*) as total')
        )
            ->where('tanggal_pendaftaran', '>=', now()->subYear())
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Initialize arrays for Chart.js
        $labels = [];
        $data = [];
        $months = collect(range(11, 0))->map(function ($i) {
            return now()->subMonths($i)->format('Y-m');
        });

        // Fill data for the last 12 months
        foreach ($months as $month) {
            $labels[] = Carbon::createFromFormat('Y-m', $month)->format('M Y');
            $record = $monthlyData->firstWhere('month', $month);
            $data[] = $record ? $record->total : 0;
        }

        return view('dashboard.itc.index', compact('totalUsers', 'labels', 'data'));
    }
    public function daftarPendaftar()
    {
        $pendaftarans = PendaftaranModel::with(['mahasiswa', 'jadwal', 'detail'])->get();
        return view('daftar_pendaftar.daftar_pendaftar', compact('pendaftarans'));
    }

    // Tampilkan halaman profil (GET)
    public function showProfile()
    {
        $user = Auth::user();
        return view('dashboard.itc.profile.index', compact('user'));
    }

    // Update profil (POST/PUT)
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        if (!$user instanceof UserModel) {
            abort(500, "User model tidak sesuai.");
        }

        $request->validate([
            'email' => 'required|email|unique:user,email,' . $user->user_id . ',user_id',
            'name' => 'required|string|max:255',
        ]);

        $user->email = $request->email;

        switch ($user->role) {
            case 'admin':
                if ($admin = $user->admin) {
                    $admin->nama = $request->name;
                    $admin->save();
                }
                break;
            case 'mahasiswa':
                if ($mahasiswa = $user->mahasiswa) {
                    $mahasiswa->nama = $request->name;
                    $mahasiswa->save();
                }
                break;
            case 'dosen':
                if ($dosen = $user->dosen) {
                    $dosen->nama = $request->name;
                    $dosen->save();
                }
                break;
            case 'tendik':
                if ($tendik = $user->tendik) {
                    $tendik->nama = $request->name;
                    $tendik->save();
                }
                break;
            case 'itc':
                if ($itc = $user->itc) {
                    $itc->nama = $request->name;
                    $itc->save();
                }
                break;
        }

        $user->save();

        return redirect()->route('itc.profile')->with('success', 'Profile berhasil diperbarui!');
    }
    public function showUploadNilaiForm()
    {
        return view('dashboard.itc.nilai.upload_nilai'); // Buat view di resources/views/itc/upload_nilai.blade.php
    }

    public function uploadNilai(Request $request)
    {
        $request->validate([
            'nilai_pdf' => 'required|file|mimes:pdf|max:5120', // max 5MB
        ]);

        // Simpan file PDF ke storage public/nilai_toeic
        $path = $request->file('nilai_pdf')->store('nilai_toeic', 'public');

        // Simpan info file ke database sesuai kebutuhan (opsional)
        // Contoh:
        // NilaiToeicModel::create(['file_path' => $path, 'uploaded_by' => Auth::id()]);

        return redirect()->route('itc.upload_nilai')->with('success', 'File PDF nilai TOEIC berhasil diupload.');
    }
    public function updateStatusSertifikat(Request $request, $pendaftaran_id)
    {
        $request->validate([
            'status' => 'required|in:sudah,belum',
        ]);

        $status = SertifikatStatus::updateOrCreate(
            ['pendaftaran_id' => $pendaftaran_id],
            ['status' => $request->status]
        );

        if($request->ajax()) {
            return response()->json(['success' => true, 'status' => $status->status]);
        }

        return redirect()->back()->with('success', 'Status sertifikat berhasil diperbarui.');
    }
}
