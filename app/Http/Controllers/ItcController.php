<?php

namespace App\Http\Controllers;

use App\Models\ItcModel;
use App\Models\NilaiToeicModel;
use App\Models\UserModel;
use App\Models\PendaftaranModel;
use App\Models\SertifikatStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
        $totalUsers = UserModel::count();

        $monthlyData = PendaftaranModel::select(
            DB::raw("DATE_FORMAT(tanggal_pendaftaran, '%Y-%m') as month"),
            DB::raw('COUNT(*) as total')
        )
            ->where('tanggal_pendaftaran', '>=', now()->subYear())
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $labels = [];
        $data = [];
        $months = collect(range(11, 0))->map(function ($i) {
            return now()->subMonths($i)->format('Y-m');
        });

        foreach ($months as $month) {
            $labels[] = Carbon::createFromFormat('Y-m', $month)->format('M Y');
            $record = $monthlyData->firstWhere('month', $month);
            $data[] = $record ? $record->total : 0;
        }

        return view('dashboard.itc.index', compact('totalUsers', 'labels', 'data'));
    }

    public function daftarPendaftar()
    {
        $pendaftarans = PendaftaranModel::with(['mahasiswa', 'jadwal', 'detailPendaftaran'])->get();
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

    // Tampilkan form upload + daftar PDF
    public function showUploadNilaiForm()
    {
        $pdfs = NilaiToeicModel::latest()->get();
        return view('dashboard.itc.nilai.upload_nilai', compact('pdfs'));
    }

    // Proses upload PDF
    public function uploadNilai(Request $request)
    {
        $request->validate([
            'nilai_pdf' => 'required|file|mimes:pdf|max:5120', // max 5MB
            'judul' => 'nullable|string|max:100',
        ], [
            'nilai_pdf.required' => 'Please select a PDF file.',
            'nilai_pdf.file' => 'The uploaded file must be a valid file.',
            'nilai_pdf.mimes' => 'The file must be a PDF.',
            'nilai_pdf.max' => 'The PDF file size must not exceed 5MB.',
            'judul.max' => 'The title must not exceed 100 characters.'
        ]);

        $file = $request->file('nilai_pdf');
        $filename = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/nilai_toeic', $filename);

        NilaiToeicModel::create([
            'file_path' => 'nilai_toeic/' . $filename,
            'itc_id' => Auth::user()->itc->itc_id ?? null,
            'judul' => $request->judul ?: 'TOEIC Score Report',
        ]);

        return redirect()->route('itc.upload_nilai')
            ->with('success', 'TOEIC Score PDF has been uploaded successfully.');
    }

    // Hapus PDF
    public function deleteNilai($id)
    {
        $pdf = NilaiToeicModel::findOrFail($id);

        // Delete physical file from storage
        if ($pdf->file_path && Storage::disk('public')->exists($pdf->file_path)) {
            Storage::disk('public')->delete($pdf->file_path);
        }

        // Delete database record 
        $pdf->delete();

        return redirect()->route('itc.upload_nilai')
            ->with('success', 'TOEIC Score PDF has been deleted successfully.');
    }

    // View PDF (opsional)
    public function viewNilaiPdf($filename, Request $request)
    {
        $path = 'nilai_toeic/' . $filename;

        if (!Storage::disk('public')->exists($path)) {
            abort(404, 'File not found.');
        }

        $fileContent = Storage::disk('public')->get($path);
        $mimeType = Storage::disk('public')->mimeType($path);

        $disposition = $request->query('download') ? 'attachment' : 'inline';

        return response($fileContent, 200)
            ->header('Content-Type', $mimeType)
            ->header('Content-Disposition', "$disposition; filename=\"$filename\"");
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

        if ($request->ajax()) {
            return response()->json(['success' => true, 'status' => $status->status]);
        }

        return redirect()->back()->with('success', 'Status sertifikat berhasil diperbarui.');
    }
}