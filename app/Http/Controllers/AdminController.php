<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use App\Models\UserModel;
use App\Models\PendaftaranModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\DetailPendaftaranModel;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Total Users
        $totalUsers = UserModel::count();

        // Users by Role
        $userCounts = UserModel::select('role', DB::raw('COUNT(*) as count'))
            ->groupBy('role')
            ->pluck('count', 'role')
            ->toArray();

        // Ensure all roles are included, even if count is 0
        $roles = ['admin', 'mahasiswa', 'dosen', 'tendik', 'itc'];
        $userCountsByRole = [];
        foreach ($roles as $role) {
            $userCountsByRole[$role] = $userCounts[$role] ?? 0;
        }

        // Monthly Test Registrations (Last 12 Months)
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

        // Verification Status Counts
        $statusCounts = DetailPendaftaranModel::select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // Ensure all statuses are included, even if count is 0
        $statuses = ['menunggu', 'diterima', 'ditolak'];
        $verificationStatusCounts = [];
        foreach ($statuses as $status) {
            $verificationStatusCounts[$status] = $statusCounts[$status] ?? 0;
        }

        return view('dashboard.admin.index', compact(
            'totalUsers',
            'userCountsByRole',
            'labels',
            'data',
            'verificationStatusCounts'
        ));
    }

    public function manage()
    {
        $users = UserModel::with(['admin', 'mahasiswa', 'dosen', 'tendik', 'itc'])->get();
        return view('dashboard.admin.manage.index', compact('users'));
    }

    public function daftarPendaftarSertifikat()
    {
        $pendaftarans = PendaftaranModel::with(['mahasiswa', 'jadwal', 'detailPendaftaran', 'sertifikatStatus'])->get();
        return view('daftar_pendaftar.daftar_pendaftar_sertifikat', compact('pendaftarans'));
    }

    public function daftarPendaftarVerifikasi()
    {
        $pendaftarans = PendaftaranModel::with(['mahasiswa', 'jadwal', 'detailPendaftaran', 'sertifikatStatus'])->get();
        return view('daftar_pendaftar.daftar_pendaftar_verifikasi', compact('pendaftarans'));
    }

    public function verifyPendaftaran(Request $request, $id, $status)
    {
        if (!in_array($status, ['diterima', 'ditolak'])) {
            return redirect()->route('admin.pendaftarVerifikasi')->with('error', 'Status tidak valid.');
        }

        $pendaftaran = PendaftaranModel::with('detail')->findOrFail($id);

        if (!$pendaftaran->detail) {
            $pendaftaran->detail()->create([
                'pendaftaran_id' => $pendaftaran->pendaftaran_id,
                'status' => 'menunggu',
                'catatan' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $pendaftaran->load('detail');
        }

        if ($pendaftaran->detail->status !== 'menunggu') {
            return redirect()->route('admin.pendaftarVerifikasi')->with('error', 'Pendaftaran tidak dapat diverifikasi karena status bukan menunggu.');
        }

        $pendaftaran->detail->update([
            'status' => $status,
            'catatan' => $request->input('catatan', null),
            'updated_at' => now(),
        ]);

        $message = $status === 'diterima' ? 'Pendaftaran berhasil diterima.' : 'Pendaftaran berhasil ditolak.';
        return redirect()->route('admin.pendaftarVerifikasi')->with('success', $message);
    }

    public function editStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diterima,ditolak',
            'catatan' => 'nullable|string|max:255',
        ]);

        $pendaftaran = PendaftaranModel::with('detail')->findOrFail($id);

        if (!$pendaftaran->detail) {
            $pendaftaran->detail()->create([
                'pendaftaran_id' => $pendaftaran->pendaftaran_id,
                'status' => 'menunggu',
                'catatan' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $pendaftaran->load('detail');
        }

        $pendaftaran->detail->update([
            'status' => $request->status,
            'catatan' => $request->catatan,
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.pendaftarVerifikasi')->with('success', 'Registration status updated successfully.');
    }
}