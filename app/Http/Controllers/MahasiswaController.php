<?php

  namespace App\Http\Controllers;

  use App\Models\MahasiswaModel;
  use App\Models\DetailPendaftaranModel;
  use App\Models\KampusModel;
  use App\Models\JurusanModel;
  use App\Models\ProdiModel;
  use App\Models\InformasiModel;
  use App\Models\JadwalSertifikatModel;
  use App\Models\NilaiToeicModel;
  use App\Models\PendaftaranModel;
  use Illuminate\Http\Request;
  use Illuminate\Support\Facades\Auth;
  use Illuminate\Support\Facades\Storage;
  use Illuminate\Support\Facades\Log;
    use App\Models\CertificateRequest;

  class MahasiswaController extends Controller
  {
      public function __construct()
      {
          $this->middleware(['auth', 'role:mahasiswa']);
      }

      public function index()
      {
          $user = Auth::user();
          $toeicScore = $user->toeicScore ?? null;
          $jadwals = JadwalSertifikatModel::orderBy('tanggal', 'desc')->get();
          $informasis = InformasiModel::with('admin')->latest()->take(3)->get();
          $nilaiToeics = NilaiToeicModel::with('itc')->latest()->get();

          return view('dashboard.mahasiswa.overview', compact('toeicScore', 'jadwals', 'informasis', 'nilaiToeics'));
      }

      public function viewPdf($filename, Request $request)
      {
          $path = 'jadwal_pdf/' . $filename;

          if (!Storage::disk('public')->exists($path)) {
              abort(404, "File not found.");
          }

          $fileContent = Storage::disk('public')->get($path);
          $mimeType = Storage::disk('public')->mimeType($path);

          $disposition = $request->query('download') ? 'attachment' : 'inline';

          return response($fileContent, 200)
              ->header('Content-Type', $mimeType)
              ->header('Content-Disposition', "$disposition; filename=\"$filename\"");
      }

      public function daftarTes()
      {
          try {
              $user = Auth::user();
              $mahasiswa = $user->mahasiswa;

              Log::info('Attempting to load daftarTes for user ID: ' . $user->id, [
                  'has_mahasiswa' => !is_null($mahasiswa),
                  'mahasiswa_id' => $mahasiswa?->mahasiswa_id,
                  'user_role' => $user->role,
              ]);

              if (!$mahasiswa) {
                  Log::warning('No mahasiswa record found for user ID: ' . $user->id);
                  return redirect()->route('mahasiswa.dashboard')->with('error', 'Student profile not found. Please contact the administrator.');
              }

              $existingRegistration = PendaftaranModel::where('mahasiswa_id', $mahasiswa->mahasiswa_id)->exists();

              Log::info('Registration check for mahasiswa_id: ' . $mahasiswa->mahasiswa_id, [
                  'registration_exists' => $existingRegistration,
              ]);

              if ($existingRegistration) {
                  return redirect()->route('mahasiswa.already-registered')->with('info', 'You have already registered for a TOEIC test.');
              }

              $kampus = KampusModel::all();
              $jurusan = JurusanModel::all();
              $prodi = ProdiModel::all();

              return view('pendaftaran.create', compact('kampus', 'jurusan', 'prodi', 'mahasiswa'));
          } catch (\Exception $e) {
              Log::error('Failed to load daftarTes: ' . $e->getMessage(), ['exception' => $e]);
              return redirect()->route('mahasiswa.dashboard')->with('error', 'Failed to load test registration page. Please try again.');
          }
      }

    public function riwayatUjian()
    {
        $user = auth()->user();
        $mahasiswa = $user->mahasiswa;

          if (!$mahasiswa) {
              return view('dashboard.mahasiswa.riwayat-ujian', [
                  'registrations' => collect()
              ]);
          }

          $registrations = PendaftaranModel::where('mahasiswa_id', $mahasiswa->mahasiswa_id)
              ->with(['jadwal', 'detailPendaftaran'])
              ->orderBy('tanggal_pendaftaran', 'desc')
              ->get();

          return view('dashboard.mahasiswa.riwayat-ujian', [
              'registrations' => $registrations
          ]);
      }

      public function profile()
      {
          $user = Auth::user();
          $mahasiswa = $user->mahasiswa()->with('prodi')->first();
          return view('dashboard.mahasiswa.profile', compact('user', 'mahasiswa'));
      }

    public function alreadyRegistered()
    {
        return view('dashboard.mahasiswa.already_registered');
    }

    public function lihatNilai()
    {
        return view('dashboard.mahasiswa.nilai-toeic');
    }

      public function lihatJadwal()
      {
          return view('dashboard.mahasiswa.jadwal-sertifikat');
      }

      public function updateAvatar(Request $request)
      {
          $request->validate([
              'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
          ]);

          $user = Auth::user();

          if ($request->hasFile('avatar')) {
              $file = $request->file('avatar');
              $path = $file->store('avatars', 'public');

              $user->profile = $path;
              $user->save();

              return redirect()->route('mahasiswa.profile')->with('success', 'Avatar updated successfully.');
          }

          return redirect()->route('mahasiswa.profile')->with('error', 'Failed to upload avatar.');
      }

      public function showRequestCertificate()
      {
          $user = Auth::user();
          $mahasiswa = $user->mahasiswa;

          if (!$mahasiswa) {
              return redirect()->route('mahasiswa.dashboard')->with('error', 'Student profile not found.');
          }

          $registrations = PendaftaranModel::where('mahasiswa_id', $mahasiswa->mahasiswa_id)
              ->with(['jadwal', 'detailPendaftaran'])
              ->orderBy('tanggal_pendaftaran', 'desc')
              ->get();

          return view('dashboard.mahasiswa.request_certificate', compact('registrations'));
      }

       public function requestCertificate(Request $request, $pendaftaran_id)
    {
        $pendaftaran = PendaftaranModel::where('pendaftaran_id', $pendaftaran_id)->firstOrFail();

        if ($pendaftaran->mahasiswa_id !== Auth::user()->mahasiswa->mahasiswa_id) {
            return redirect()->back()->with('error', 'Unauthorized request.');
        }

        $existingRequest = CertificateRequest::where('pendaftaran_id', $pendaftaran_id)->first();
        if ($existingRequest) {
            return redirect()->back()->with('error', 'A request for this registration already exists.');
        }

        CertificateRequest::create([
            'pendaftaran_id' => $pendaftaran_id,
            'status' => 'pending',
        ]);

        Log::info('Certificate request submitted', [
            'mahasiswa_id' => Auth::user()->mahasiswa->mahasiswa_id,
            'pendaftaran_id' => $pendaftaran_id,
            'timestamp' => now(),
        ]);

        return redirect()->route('mahasiswa.request_certificate')->with('success', 'Your certificate request has been submitted. An admin will process it via email.');
    }

      public function showSampleCertificate()
      {
          $filePath = 'surat_keterangan/Contoh_Surat Keterangan Ujian TOEIC 2x_UPA Bahasa.docx.pdf';
          if (!Storage::disk('public')->exists($filePath)) {
              abort(404, "File not found.");
          }

          $fileContent = Storage::disk('public')->get($filePath);
          $mimeType = Storage::disk('public')->mimeType($filePath);

          $disposition = request()->query('download') ? 'attachment' : 'inline';

          return response($fileContent, 200)
              ->header('Content-Type', $mimeType)
              ->header('Content-Disposition', "$disposition; filename=\"Contoh_Surat Keterangan Ujian TOEIC 2x_UPA Bahasa.docx.pdf\"");
      }
  }