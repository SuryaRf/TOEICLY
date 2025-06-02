<?php

namespace App\Http\Controllers;

use App\Models\UserModel;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        $users = UserModel::with(['admin', 'mahasiswa', 'dosen', 'tendik', 'itc'])->get();
        return view('manage.index', compact('users'));
    }

    public function admin()
    {
        return view('user.admin', ['activeMenu' => 'user-admin']);
    }

    public function mahasiswa()
    {
        return view('user.mahasiswa', ['activeMenu' => 'user-mahasiswa']);
    }

    public function dosen()
    {
        return view('user.dosen', ['activeMenu' => 'user-dosen']);
    }

    public function tendik()
    {
        return view('user.tendik', ['activeMenu' => 'user-tendik']);
    }
    public function itc()
    {
        return view('user.itc', ['activeMenu' => 'user-itc']);
    }

    // Form edit user
    public function edit(UserModel $user)
    {
        return view('dashboard.admin.manage.edit', compact('user'));
    }

    // Update user data
    public function update(Request $request, UserModel $user)
{
    $validated = $request->validate([
        'username' => 'required|string|max:20|unique:user,username,' . $user->user_id . ',user_id',
        'email' => 'required|email|unique:user,email,' . $user->user_id . ',user_id',
        'password' => 'nullable|string|min:6',  // Pastikan validasi ada untuk password, bisa juga tambah confirmed jika pakai konfirmasi
        'role' => 'required|in:admin,mahasiswa,dosen,tendik,itc',
        // Validasi lainnya...
    ]);

    $user->username = $validated['username'];
    $user->email = $validated['email'];
    $user->role = $validated['role'];

    // Jika password tidak kosong, update password dengan hash
    if (!empty($validated['password'])) {
        $user->password = Hash::make($validated['password']);
    }

    $user->save();

    // Update data relasi seperti admin, mahasiswa, dsb.
    if ($user->admin && isset($validated['admin'])) {
        $user->admin->update($validated['admin']);
    }
    if ($user->mahasiswa && isset($validated['mahasiswa'])) {
        $user->mahasiswa->update($validated['mahasiswa']);
    }
    if ($user->dosen && isset($validated['dosen'])) {
        $user->dosen->update($validated['dosen']);
    }
    if ($user->tendik && isset($validated['tendik'])) {
        $user->tendik->update($validated['tendik']);
    }
    if ($user->itc && isset($validated['itc'])) {
        $user->itc->update($validated['itc']);
    }

    return redirect()->route('admin.manage')->with('success', 'Data pengguna berhasil diperbarui.');
}
}
