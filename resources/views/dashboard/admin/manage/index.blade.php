<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Manajemen Pengguna - TOEIC Management</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(135deg, #eef2ff 0%, #dbeafe 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .sidebar {
            background: linear-gradient(180deg, #5b21b6 0%, #7c3aed 100%);
            color: white;
            min-height: 100vh;
            position: fixed;
            width: 16rem;
            transition: all 0.3s ease;
            box-shadow: 4px 0 12px rgb(123 97 255 / 0.4);
            z-index: 50;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            font-weight: 600;
            border-radius: 0.5rem;
            transition: background-color 0.3s ease, transform 0.3s ease;
            color: inherit;
            text-decoration: none;
            cursor: pointer;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: rgba(255 255 255 / 0.25);
            transform: translateX(8px);
            box-shadow: 0 4px 15px rgb(124 58 237 / 0.5);
            color: white !important;
        }

        .sidebar i {
            min-width: 1.25rem;
            font-size: 1.1rem;
            margin-right: 0.75rem;
            transition: transform 0.3s ease;
        }

        .sidebar a:hover i {
            transform: rotate(10deg) scale(1.2);
            color: #ddd;
        }

        main {
            margin-left: 16rem;
            padding: 2.5rem;
            min-height: 100vh;
            overflow-y: auto;
        }

        .card {
            background-color: #fff;
            border-radius: 1rem;
            box-shadow: 0 6px 15px rgb(0 0 0 / 0.08);
            padding: 1.5rem;
            transition: transform 0.35s ease, box-shadow 0.35s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        h1 {
            color: #4c1d95;
            font-weight: 800;
            font-size: 2.25rem;
            margin-bottom: 1.5rem;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            text-align: left;
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #e5e7eb;
        }

        th {
            background-color: #f3e8ff;
            color: #7c3aed;
            font-weight: 700;
        }

        tbody tr:hover {
            background-color: #ede9fe;
        }

        .btn-action {
            background: linear-gradient(90deg, #7c3aed, #a78bfa);
            color: white;
            padding: 0.4rem 0.8rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: background 0.3s ease;
            cursor: pointer;
            border: none;
        }

        .btn-action:hover {
            background: linear-gradient(90deg, #a78bfa, #7c3aed);
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <aside class="sidebar flex flex-col">
    <div class="p-6">
        <h2 class="text-4xl font-extrabold tracking-tight select-none">TOEICLY Admin</h2>
    </div>
    <nav class="mt-8 flex flex-col gap-2 px-2">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-home"></i> Dashboard
        </a>
        <a href="{{ route('admin.manage') }}" class="sidebar-link {{ request()->routeIs('admin.manage') ? 'active' : '' }}">
            <i class="fas fa-users"></i> Manajemen Pengguna
        </a>
        <a href="{{ route('jadwal_sertifikat.index') }}" class="sidebar-link {{ request()->routeIs('jadwal_sertifikat.*') ? 'active' : '' }}">
            <i class="fas fa-calendar-alt"></i> Kelola Jadwal Sertifikat
        </a>

        <!-- Tambahan menu data kampus, jurusan, prodi -->
        <a href="{{ route('kampus.index') }}" class="sidebar-link {{ request()->routeIs('kampus.*') ? 'active' : '' }}">
            <i class="fas fa-building"></i> Data Kampus
        </a>
        <a href="{{ route('jurusan.index') }}" class="sidebar-link {{ request()->routeIs('jurusan.*') ? 'active' : '' }}">
            <i class="fas fa-book"></i> Data Jurusan
        </a>
        <a href="{{ route('prodi.index') }}" class="sidebar-link {{ request()->routeIs('prodi.*') ? 'active' : '' }}">
            <i class="fas fa-graduation-cap"></i> Data Prodi
        </a>

        <a href="{{ route('profile') }}" class="sidebar-link {{ request()->routeIs('profile') ? 'active' : '' }}">
            <i class="fas fa-user"></i> Profile
        </a>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="sidebar-link">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </nav>
</aside>

    <!-- Main content -->
    <main>
        <h1>Manajemen Pengguna</h1>

        <section class="card">
            <p class="text-gray-600 mb-4">Daftar User Terdaftar</p>
            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <table>
                <thead>
                    <tr>
                        <th>ID User</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Nama Lengkap</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->user_id }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="capitalize">{{ $user->role }}</td>
                            <td>
                                @if ($user->role === 'admin' && $user->admin)
                                    {{ $user->admin->nama }}
                                @elseif ($user->role === 'mahasiswa' && $user->mahasiswa)
                                    {{ $user->mahasiswa->nama }}
                                @elseif ($user->role === 'dosen' && $user->dosen)
                                    {{ $user->dosen->nama }}
                                @elseif ($user->role === 'tendik' && $user->tendik)
                                    {{ $user->tendik->nama }}
                                @else
                                    -
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('admin.manage.edit', $user->user_id) }}" class="btn-action">Edit</a>

                                <form action="{{ route('admin.manage.destroy', $user->user_id) }}" method="POST"
                                    class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action ml-2 bg-red-500 hover:bg-red-600">Hapus</button>
                                </form>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-gray-500 py-4">Data pengguna tidak tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </section>
    </main>
</body>

</html>