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

      <label class="block mb-2 font-semibold" for="username">Username</label>
      <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}" required
        class="w-full p-2 border rounded mb-4" />

      <label class="block mb-2 font-semibold" for="email">Email</label>
      <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
        class="w-full p-2 border rounded mb-4" />

      <label class="block mb-2 font-semibold" for="role">Role</label>
      <select name="role" id="role" required class="w-full p-2 border rounded mb-6">
        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
        <option value="mahasiswa" {{ old('role', $user->role) == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
        <option value="dosen" {{ old('role', $user->role) == 'dosen' ? 'selected' : '' }}>Dosen</option>
        <option value="tendik" {{ old('role', $user->role) == 'tendik' ? 'selected' : '' }}>Tendik</option>
      </select>

      <button type="submit" class="bg-purple-600 text-white px-5 py-2 rounded hover:bg-purple-700 transition">Update</button>
      <a href="{{ route('admin.manage') }}" class="ml-4 text-purple-600 hover:underline">Batal</a>
    </form>
  </div>
</body>
</html>
