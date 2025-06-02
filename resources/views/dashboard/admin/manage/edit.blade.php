<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Edit User - TOEIC Management</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-100 p-10 font-sans">
  <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-6">Edit Pengguna: {{ $user->username }}</h1>

    @if ($errors->any())
    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
      <ul>
      @foreach ($errors->all() as $error)
      <li>- {{ $error }}</li>
    @endforeach
      </ul>
    </div>
  @endif

    <form action="{{ route('admin.manage.update', $user->user_id) }}" method="POST">
      @csrf
      @method('PUT')

      {{-- Data User --}}
      <label for="username" class="block mb-2 font-semibold">Username</label>
      <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}" required
        class="w-full p-2 border rounded mb-4" />

      <label for="email" class="block mb-2 font-semibold">Email</label>
      <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
        class="w-full p-2 border rounded mb-4" />

      <label for="password" class="block mb-2 font-semibold">Password (Kosongkan jika tidak diubah)</label>
      <input type="password" name="password" id="password" class="w-full p-2 border rounded mb-4"
        placeholder="Isi password baru jika ingin mengganti" autocomplete="new-password" />

      <label for="role" class="block mb-2 font-semibold">Role</label>
      <select name="role" id="role" required class="w-full p-2 border rounded mb-6">
        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
        <option value="mahasiswa" {{ old('role', $user->role) == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
        <option value="dosen" {{ old('role', $user->role) == 'dosen' ? 'selected' : '' }}>Dosen</option>
        <option value="tendik" {{ old('role', $user->role) == 'tendik' ? 'selected' : '' }}>Tendik</option>
        <option value="itc" {{ old('role', $user->role) == 'itc' ? 'selected' : '' }}>ITC</option>
      </select>
      
      {{-- Data Admin --}}
      @if($user->admin)
      <h3 class="text-lg font-semibold mb-2">Data Admin</h3>
      <label for="admin_nama" class="block mb-2 font-semibold">Nama Admin</label>
      <input type="text" id="admin_nama" name="admin[nama]" value="{{ old('admin.nama', $user->admin->nama) }}"
      class="w-full p-2 border rounded mb-4" />

      <label for="admin_no_telp" class="block mb-2 font-semibold">No. Telp Admin</label>
      <input type="text" id="admin_no_telp" name="admin[no_telp]"
      value="{{ old('admin.no_telp', $user->admin->no_telp) }}" class="w-full p-2 border rounded mb-6" />
    @endif

      {{-- Data Mahasiswa --}}
      @if($user->mahasiswa)
      <h3 class="text-lg font-semibold mb-2">Data Mahasiswa</h3>
      <label for="mahasiswa_nama" class="block mb-2 font-semibold">Nama Mahasiswa</label>
      <input type="text" id="mahasiswa_nama" name="mahasiswa[nama]"
      value="{{ old('mahasiswa.nama', $user->mahasiswa->nama) }}" class="w-full p-2 border rounded mb-4" />
      {{-- Tambahkan field lain sesuai tabel mahasiswa --}}
    @endif

      {{-- Data Dosen --}}
      @if($user->dosen)
      <h3 class="text-lg font-semibold mb-2">Data Dosen</h3>
      <label for="dosen_nama" class="block mb-2 font-semibold">Nama Dosen</label>
      <input type="text" id="dosen_nama" name="dosen[nama]" value="{{ old('dosen.nama', $user->dosen->nama) }}"
      class="w-full p-2 border rounded mb-4" />
      {{-- Tambahkan field lain sesuai tabel dosen --}}
    @endif

      {{-- Data Tendik --}}
      @if($user->tendik)
      <h3 class="text-lg font-semibold mb-2">Data Tendik</h3>
      <label for="tendik_nama" class="block mb-2 font-semibold">Nama Tendik</label>
      <input type="text" id="tendik_nama" name="tendik[nama]" value="{{ old('tendik.nama', $user->tendik->nama) }}"
      class="w-full p-2 border rounded mb-4" />
      {{-- Tambahkan field lain sesuai tabel tendik --}}
    @endif

      {{-- Data ITC --}}
      @if($user->itc)
      <h3 class="text-lg font-semibold mb-2">Data ITC</h3>
      <label for="itc_nama" class="block mb-2 font-semibold">Nama ITC</label>
      <input type="text" id="itc_nama" name="itc[nama]" value="{{ old('itc.nama', $user->itc->nama) }}"
      class="w-full p-2 border rounded mb-4" />
      {{-- Tambahkan field lain sesuai tabel itc --}}
    @endif

      <button type="submit" class="bg-purple-600 text-white px-5 py-2 rounded hover:bg-purple-700 transition">
        Update
      </button>
      <a href="{{ route('admin.manage') }}" class="ml-4 text-purple-600 hover:underline">Batal</a>
    </form>

  </div>
</body>

</html>