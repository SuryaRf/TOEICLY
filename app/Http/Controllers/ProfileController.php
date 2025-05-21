<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserModel;

class ProfileController extends Controller
{
      public function index()
    {
        return view('dashboard.admin.profile.index'); // buat view profile/index.blade.php
    }
    public function update(Request $request)
    {
        $user = Auth::user(); // pastikan ini instance UserModel

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
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Profile berhasil diperbarui!');
    }
        public function showProfile()
    {
        $user = Auth::user();
        return view('dashboard.admin.profile.index', compact('user'));
    }
}
