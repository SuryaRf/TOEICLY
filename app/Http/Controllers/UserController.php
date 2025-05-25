<?php

    namespace App\Http\Controllers;
    use App\Models\UserModel;

    use Illuminate\Http\Request;

    class UserController extends Controller
    {
        // public function index()
        // {
        //     $data = UserModel::all();
        //     return view('user.index', compact('data'));
        // }

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
                'role' => 'required|in:admin,mahasiswa,dosen,tendik,itc',
                // Tambahkan validasi lain sesuai kebutuhan
            ]);

            $user->update($validated);

            return redirect()->route('admin.manage')->with('success', 'Data pengguna berhasil diperbarui.');
        }

        // Hapus user
        public function destroy(UserModel $user)
        {
            $user->delete();

            return redirect()->route('admin.manage')->with('success', 'Data pengguna berhasil dihapus.');
        }
    }
