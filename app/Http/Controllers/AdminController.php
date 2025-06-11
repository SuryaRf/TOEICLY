<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use App\Models\UserModel;
use App\Models\PendaftaranModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\DetailPendaftaranModel;
  use App\Mail\CertificateEmail;
  use Illuminate\Support\Facades\Mail;
use App\Models\CertificateRequest;
  use Illuminate\Support\Facades\Storage;
  

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

     public function certificateRequests()
      {
          $requests = CertificateRequest::with(['pendaftaran.mahasiswa', 'pendaftaran.jadwal'])->get();
          return view('dashboard.admin.certificate_requests', compact('requests'));
      }

      public function approveCertificate($id)
      {
          $request = CertificateRequest::findOrFail($id);
          if ($request->status !== 'pending') {
              return redirect()->route('admin.certificate_requests')->with('error', 'Request is not pending.');
          }

          // Generate PDF menggunakan template LaTeX
          $pdfPath = $this->generateCertificatePdf($request);

          $request->update([
              'status' => 'approved',
              'file_path' => $pdfPath,
          ]);

          // Kirim email
          $this->sendCertificateEmail($request);

          return redirect()->route('admin.certificate_requests')->with('success', 'Certificate approved and email sent.');
      }

      public function rejectCertificate($id)
      {
          $request = CertificateRequest::findOrFail($id);
          if ($request->status !== 'pending') {
              return redirect()->route('admin.certificate_requests')->with('error', 'Request is not pending.');
          }

          $request->update(['status' => 'rejected', 'notes' => request()->input('notes', 'No reason provided')]);

          // Kirim email pemberitahuan penolakan
          $this->sendRejectionEmail($request);

          return redirect()->route('admin.certificate_requests')->with('success', 'Certificate request rejected and email sent.');
      }

      public function downloadCertificate($id)
      {
          $request = CertificateRequest::findOrFail($id);
          if (!$request->file_path || !Storage::disk('public')->exists($request->file_path)) {
              abort(404, 'File not found.');
          }

          return Storage::disk('public')->download($request->file_path);
      }

      private function generateCertificatePdf($request)
      {
          $mahasiswa = $request->pendaftaran->mahasiswa;
          $latexContent = $this->generateLatexContent($mahasiswa, $request->pendaftaran);

          $tempFile = tempnam(sys_get_temp_dir(), 'certificate_') . '.tex';
          file_put_contents($tempFile, $latexContent);

          $pdfPath = 'certificates/' . uniqid() . '_certificate.pdf';
          exec("latexmk -pdf -output-directory=" . sys_get_temp_dir() . " $tempFile");
          $pdfTemp = glob(sys_get_temp_dir() . '/*.pdf')[0];
          Storage::disk('public')->put($pdfPath, file_get_contents($pdfTemp));

          // Bersihkan file sementara
          unlink($tempFile);
          array_map('unlink', glob(sys_get_temp_dir() . '/*.aux'));
          array_map('unlink', glob(sys_get_temp_dir() . '/*.log'));
          unlink($pdfTemp);

          return $pdfPath;
      }

      private function generateLatexContent($mahasiswa, $pendaftaran)
      {
          return <<<LATEX
\documentclass[a4paper,12pt]{article}
\usepackage[utf8]{inputenc}
\usepackage[T1]{fontenc}
\usepackage{geometry}
\geometry{a4paper, margin=1in}
\usepackage{times}
\usepackage{setspace}
\onehalfspacing
\usepackage{fancyhdr}
\pagestyle{fancy}
\fancyhf{}
\rhead{KEMENTERIAN PENDIDIKAN TINGGI, SAINS, DAN TEKNOLOGI}
\lhead{UNIT PENUNJANG AKADEMIK BAHASA POLITEKNIK NEGERI MALANG}
\rfoot{\thepage}

\begin{document}

\begin{center}
\textbf{KEMENTERIAN PENDIDIKAN TINGGI, SAINS, DAN TEKNOLOGI} \\
\textbf{UNIT PENUNJANG AKADEMIK BAHASA POLITEKNIK NEGERI MALANG} \\
J. Soekarno Hatta No. 9 Malang 65141 \\
Telp (0341) 404424 - 404425 Fax (0341) 404420 \\
Laman: http://www.polinema.ac.id \\
\vspace{1cm}
\textbf{SURAT KETERANGAN SUDAH MENGIKUTI TOEIC} \\
Nomor: \underline{\hspace{3cm}}/PL2.UPA BHS/\underline{\hspace{2cm}}2025
\end{center}

\vspace{0.5cm}

Yang bertanda tangan di bawah ini,

\begin{tabular}{l l}
1. Nama                & : Atiqah Nurul Asri, S.Pd., M.Pd. \\
2. NIP                 & : 197606252005012001 \\
3. Pangkat, Golongan, Ruang & : Penata Tingkat 1/ III D \\
4. Jabatan             & : Kepala UPA Bahasa \\
\end{tabular}

dengan ini menyatakan dengan sesungguhnya bahwa:

\begin{tabular}{l l}
5. Nama                & : $mahasiswa->nama \\
6. NIM                 & : $mahasiswa->nim \\
7. Program Studi/Jurusan & : $mahasiswa->prodi->nama_prodi \\
8. Tempat, Tanggal Lahir & : $mahasiswa->tempat_lahir, $mahasiswa->tanggal_lahir \\
9. Alamat              & : $mahasiswa->alamat \\
\end{tabular}

telah mengikuti ujian TOEIC dan mendapat sertifikat yang diterbitkan oleh ETS sebanyak dua kali dengan nilai di bawah 400 untuk Program D-III dan 450 untuk Program D-IV dengan bukti sertifikat terlampir (dua berkas).

Demikian surat keterangan ini dibuat sebagai pengganti syarat pengambilan ijazah dan agar dapat dipergunakan sebagaimana mestinya.

\vspace{2cm}

\begin{flushright}
Kepala UPA Bahasa, \\
\vspace{1cm}
Atiqah Nurul Asri, S.Pd., M.Pd. \\
NIP. 197606252005012001
\end{flushright}

Lampiran: \\
Salinan 2 sertifikat TOEIC yang diterbitkan oleh ETS dan masih berlaku.

\end{document}
LATEX;
      }

      private function sendCertificateEmail($request)
      {
          $mahasiswa = $request->pendaftaran->mahasiswa;
          $pdfPath = $request->file_path;
          Mail::to($mahasiswa->email)->send(new CertificateEmail($mahasiswa->nama, 'Your certificate is ready', 'Your certificate has been generated and is attached.', $pdfPath));
      }

      private function sendRejectionEmail($request)
      {
          $mahasiswa = $request->pendaftaran->mahasiswa;
          Mail::to($mahasiswa->email)->send(new CertificateEmail($mahasiswa->nama, 'Certificate Request Rejected', 'Your certificate request has been rejected. Reason: ' . ($request->notes ?? 'No reason provided')));
      }
}