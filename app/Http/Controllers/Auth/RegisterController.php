<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\UserModel;
use App\Models\MahasiswaModel; // Import model terkait jika perlu buat role mahasiswa
use App\Models\AdminModel;
use App\Models\DosenModel;
use App\Models\TendikModel;
use App\Models\ItcModel;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register'); // Buat view ini nanti
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:user,email',
            'username' => 'required|string|max:20|unique:user,username',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:admin,mahasiswa,dosen,tendik,itc',
            // Tambahkan validasi input lain jika perlu
        ]);

        DB::beginTransaction();

        try {
            // Buat data terkait berdasarkan role (misal mahasiswa, dosen, dll)
            $relatedId = null;

            switch ($request->role) {
                case 'admin':
                    $admin = AdminModel::create([
                        'nama' => $request->input('nama') ?? 'Admin Default',
                        'no_telp' => $request->input('no_telp') ?? null,
                    ]);
                    $relatedId = $admin->admin_id;
                    break;

                case 'mahasiswa':
                    $mahasiswa = MahasiswaModel::create([
                        'nama' => $request->input('nama') ?? 'Mahasiswa Default',
                        'nim' => $request->input('nim') ?? null,
                        'nik' => $request->input('nik') ?? null,
                        'alamat_asal' => $request->input('alamat_asal') ?? null,
                        'alamat_sekarang' => $request->input('alamat_sekarang') ?? null,
                        'angkatan' => $request->input('angkatan') ?? null,
                        'no_telp' => $request->input('no_telp') ?? null,
                        'jenis_kelamin' => $request->input('jenis_kelamin') ?? null,
                        'status' => $request->input('status') ?? 'aktif',
                        'keterangan' => $request->input('keterangan') ?? null,
                        'prodi_id' => $request->input('prodi_id') ?? 1,
                    ]);
                    $relatedId = $mahasiswa->mahasiswa_id;
                    break;

                case 'dosen':
                    $dosen = DosenModel::create([
                        'nama' => $request->input('nama') ?? 'Dosen Default',
                        'nidn' => $request->input('nidn') ?? null,
                        'nik' => $request->input('nik') ?? null,
                        'jenis_kelamin' => $request->input('jenis_kelamin') ?? null,
                        'jurusan_id' => $request->input('jurusan_id') ?? 1,
                    ]);
                    $relatedId = $dosen->dosen_id;
                    break;

                case 'tendik':
                    $tendik = TendikModel::create([
                        'nama' => $request->input('nama') ?? 'Tendik Default',
                        'nip' => $request->input('nip') ?? null,
                        'nik' => $request->input('nik') ?? null,
                        'no_telp' => $request->input('no_telp') ?? null,
                        'jenis_kelamin' => $request->input('jenis_kelamin') ?? null,
                        'kampus_id' => $request->input('kampus_id') ?? 1,
                    ]);
                    $relatedId = $tendik->tendik_id;
                    break;

                case 'itc':
                    $itc = ItcModel::create([
                        'nama' => $request->input('nama') ?? 'ITC Default',
                        // isi field lain sesuai struktur itc
                    ]);
                    $relatedId = $itc->itc_id;
                    break;
            }

            // Simpan user
            $user = UserModel::create([
                'email' => $request->email,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'admin_id' => $request->role === 'admin' ? $relatedId : null,
                'mahasiswa_id' => $request->role === 'mahasiswa' ? $relatedId : null,
                'dosen_id' => $request->role === 'dosen' ? $relatedId : null,
                'tendik_id' => $request->role === 'tendik' ? $relatedId : null,
                'itc_id' => $request->role === 'itc' ? $relatedId : null,
            ]);

            DB::commit();

            return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Registrasi gagal: ' . $e->getMessage()])->withInput();
        }
    }
}
