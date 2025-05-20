<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Daftar Jadwal Sertifikat - TOEICLY Admin</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(135deg, #eef2ff 0%, #dbeafe 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
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
            display: flex;
            flex-direction: column;
        }

        .sidebar .title {
            padding: 1.5rem 1rem;
            font-size: 1.75rem;
            font-weight: 800;
            user-select: none;
        }

        .sidebar nav {
            margin-top: 2rem;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            padding: 0 1rem;
            flex-grow: 1;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            font-weight: 600;
            border-radius: 0.5rem;
            color: inherit;
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.3s ease;
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

        .btn-modern {
            background: linear-gradient(90deg, #7c3aed, #a78bfa);
            border: none;
            font-weight: 600;
            padding: 0.5rem 1.5rem;
            border-radius: 0.75rem;
            color: white;
            box-shadow: 0 4px 12px rgb(124 58 237 / 0.4);
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 1.5rem;
        }

        .btn-modern:hover {
            background: linear-gradient(90deg, #a78bfa, #7c3aed);
            transform: scale(1.08);
            box-shadow: 0 8px 20px rgb(124 58 237 / 0.7);
            color: white;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 1rem;
            background: white;
            border-radius: 1rem;
            box-shadow: 0 6px 15px rgb(0 0 0 / 0.08);
            overflow: hidden;
        }

        th, td {
            text-align: left;
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #e5e7eb;
        }

        thead th {
            background-color: #f3e8ff;
            color: #7c3aed;
            font-weight: 700;
        }

        tbody tr:hover {
            background-color: #ede9fe;
        }

        .no-data {
            text-align: center;
            padding: 2rem;
            color: #9ca3af;
            font-style: italic;
        }

        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
            box-shadow: 0 2px 8px rgb(34 197 94 / 0.3);
        }
    </style>
</head>
<body>

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
          <a href="{{ route('jadwal_sertifikat.index') }}" class="{{ request()->routeIs('jadwal_sertifikat.*') ? 'active' : '' }}">
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

    <main>
        <h1 class="text-5xl font-extrabold text-gray-900 tracking-tight mb-8">Daftar Jadwal Sertifikat</h1>

        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('jadwal_sertifikat.create') }}" class="btn-modern">Tambah Jadwal Baru</a>

        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Judul Jadwal</th>
                    <th>File PDF</th>
                    <th>Tanggal Dibuat</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($jadwals as $index => $jadwal)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $jadwal->judul }}</td>
                        <td>
                            @if($jadwal->file_pdf)
                                <a href="{{ asset('storage/' . $jadwal->file_pdf) }}" target="_blank" class="text-blue-600 underline">Lihat PDF</a>
                            @else
                                Tidak ada file
                            @endif
                        </td>
                        <td>{{ $jadwal->created_at->format('d-m-Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="no-data">Tidak ada jadwal tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
