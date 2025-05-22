<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;  // Pastikan model AdminModel sudah ada
use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\PendaftaranModel;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // Pastikan menggunakan middleware auth agar hanya pengguna yang login yang bisa mengakses
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Menampilkan halaman dashboard admin
   public function index()
    {
        // Count total registrants
        $totalRegistrants = PendaftaranModel::count();

        // Fetch data for weekly overview (group by week)
        $registrationsByWeek = PendaftaranModel::selectRaw('WEEK(tanggal_pendaftaran) as week, COUNT(*) as count')
            ->groupBy('week')
            ->orderBy('week')
            ->get();

        $labels = $registrationsByWeek->pluck('week')->map(function ($week) {
            return "Week " . $week;
        })->toArray();

        $data = $registrationsByWeek->pluck('count')->toArray();

        return view('dashboard.admin.index', compact('totalRegistrants', 'labels', 'data'));
    }

    public function manage()
    {
        // Ambil semua user dengan relasi masing-masing role
        $users = UserModel::with(['admin', 'mahasiswa', 'dosen', 'tendik'])->get();

        return view('dashboard.admin.manage.index', compact('users'));
    }

    public function daftarPendaftarSertifikat()
    {
        $pendaftarans = PendaftaranModel::with(['mahasiswa', 'jadwal', 'detail', 'sertifikatStatus'])->get();
        return view('daftar_pendaftar.daftar_pendaftar_sertifikat', compact('pendaftarans'));
    }

    public function dashboard()
{
    // Ambil jumlah pendaftar per bulan selama 12 bulan terakhir
    $pendaftaranPerBulan = PendaftaranModel::select(
            DB::raw("DATE_FORMAT(tanggal_pendaftaran, '%Y-%m') as month"),
            DB::raw("COUNT(*) as total")
        )
        ->where('tanggal_pendaftaran', '>=', now()->subYear())
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    // Siapkan data untuk chart
    $labels = $pendaftaranPerBulan->pluck('month')->map(function($m) {
        return \Carbon\Carbon::createFromFormat('Y-m', $m)->format('M Y');
    });
    $data = $pendaftaranPerBulan->pluck('total');

    return view('dashboard.admin.index', compact('labels', 'data'));
}
}
