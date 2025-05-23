<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;  // Pastikan model AdminModel sudah ada
use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\PendaftaranModel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
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
        // Count total registrants (current year only for relevance)
        $currentYear = Carbon::now()->year;
        $totalRegistrants = PendaftaranModel::whereYear('tanggal_pendaftaran', $currentYear)->count();

        // Count total users
        $totalUsers = UserModel::count();

        // Fetch data for monthly overview (last 12 months)
        $registrationsByMonth = PendaftaranModel::select(
            DB::raw("DATE_FORMAT(tanggal_pendaftaran, '%Y-%m') as month"),
            DB::raw("COUNT(*) as total")
        )
        ->where('tanggal_pendaftaran', '>=', now()->subYear())
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        $labels = $registrationsByMonth->pluck('month')->map(function ($m) {
            return Carbon::createFromFormat('Y-m', $m)->format('M Y');
        })->toArray();

        $data = $registrationsByMonth->pluck('total')->toArray();

        // Pass all variables to the view
        return view('dashboard.admin.index', compact('totalRegistrants', 'totalUsers', 'labels', 'data'));
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
