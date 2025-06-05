<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\UserModel;
use App\Models\MahasiswaModel;
use App\Models\AdminModel;
use App\Models\DosenModel;
use App\Models\TendikModel;
use App\Models\ItcModel;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $rules = [
            'email' => 'required|email|unique:user,email',
            'username' => 'required|string|max:20|unique:user,username',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:admin,mahasiswa,dosen,tendik,itc',
        ];

        if ($request->role === 'mahasiswa') {
            $rules['nim'] = 'required|string|max:10|unique:mahasiswa,nim';
            $rules['nama'] = 'required|string|max:100';
            $rules['nik'] = 'required|string|max:16|unique:mahasiswa,nik';
            $rules['angkatan'] = 'required|string|max:4';
            $rules['no_telp'] = 'nullable|string|max:15';
            $rules['jenis_kelamin'] = 'required|in:Laki-laki,Perempuan';
            $rules['status'] = 'required|in:aktif,alumni';
            $rules['keterangan'] = 'required|in:gratis,berbayar';
            $rules['prodi_id'] = 'required|exists:prodi,prodi_id';
        }

        $request->validate($rules);

        DB::beginTransaction();

        try {
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
                        'nim' => $request->input('nim'),
                        'nama' => $request->input('nama'),
                        'nik' => $request->input('nik'),
                        'angkatan' => $request->input('angkatan'),
                        'no_telp' => $request->input('no_telp'),
                        'jenis_kelamin' => $request->input('jenis_kelamin'),
                        'status' => $request->input('status'),
                        'keterangan' => $request->input('keterangan'),
                        'prodi_id' => $request->input('prodi_id'),
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
                        'no_telp' => $request->input('no_telp') ?? null,
                    ]);
                    $relatedId = $itc->itc_id;
                    break;
            }

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