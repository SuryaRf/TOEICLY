<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserModel;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index'); // Form login view
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Mencari user berdasarkan username atau email
        $user = UserModel::where('username', $request->username)
                    ->orWhere('email', $request->username)
                    ->first();

        if ($user && password_verify($request->password, $user->password)) {
            // Jika password valid, lakukan login
            Auth::login($user);

            // Redirect berdasarkan peran
            if ($user->role == 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role == 'mahasiswa') {
                return redirect()->route('mahasiswa.dashboard');
            } elseif ($user->role == 'dosen') {
                return redirect()->route('dosen.dashboard');
            } else {
                return redirect()->route('tendik.dashboard');
            }
        }

        return back()->withErrors(['username' => 'The provided credentials are incorrect.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.index');
    }
}

