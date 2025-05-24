<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman profil mahasiswa
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        // Ambil data mahasiswa yang terkait dengan user tersebut (asumsi relasi ada)
        $mahasiswa = $user->mahasiswa;

        // Muat relasi 'prodi' jika ada
        if ($mahasiswa) {
            $mahasiswa->load('prodi');
        }

        return view('dashboard.mahasiswa.profile', compact('user', 'mahasiswa'));
    }

    /**
     * Upload dan simpan avatar mahasiswa
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        /** @var User $user */
        $user = Auth::user();

        // Hapus avatar lama jika ada
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        // Simpan file avatar baru di storage/app/public/avatars
        $path = $request->file('avatar')->store('avatars', 'public');

        $user->avatar = $path;
        $user->save();

        return redirect()->route('mahasiswa.profile')->with('success', 'Avatar berhasil diupload');
    }
}
