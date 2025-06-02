<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tambah Prodi - TOEICLY Admin</title>
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
            max-width: 600px;
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
            cursor: pointer;
        }

        .btn-modern:hover {
            background: linear-gradient(90deg, #a78bfa, #7c3aed);
            transform: scale(1.08);
            box-shadow: 0 8px 20px rgb(124 58 237 / 0.7);
            color: white;
        }

        label {
            font-weight: 600;
        }

        input[type="text"],
        select {
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            padding: 0.5rem 0.75rem;
            width: 100%;
            box-sizing: border-box;
        }

        .error-list {
            list-style-type: disc;
            padding-left: 1.5rem;
            margin: 0 0 1rem 0;
        }

        .alert-danger {
            background-color: #fee2e2;
            color: #991b1b;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
            box-shadow: 0 2px 8px rgb(220 38 38 / 0.3);
        }
    </style>
</head>

<body>
   <aside class="sidebar">
        <div class="title">TOEICLY Admin</div>
        <nav>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a href="{{ route('admin.manage') }}" class="{{ request()->routeIs('admin.manage') ? 'active' : '' }}">
                <i class="fas fa-users"></i> Manajemen Pengguna
            </a>
            <a href="{{ route('jadwal_sertifikat.index') }}" class="{{ request()->routeIs('jadwal_sertifikat.*') ? 'active' : '' }}">
                <i class="fas fa-calendar-alt"></i> Kelola Jadwal Sertifikat
            </a>
            <a href="{{ route('kampus.index') }}" class="{{ request()->routeIs('kampus.*') ? 'active' : '' }}">
                <i class="fas fa-building"></i> Data Kampus
            </a>
            <a href="{{ route('jurusan.index') }}" class="{{ request()->routeIs('jurusan.*') ? 'active' : '' }}">
                <i class="fas fa-book"></i> Data Jurusan
            </a>
            <a href="{{ route('prodi.index') }}" class="{{ request()->routeIs('prodi.*') ? 'active' : '' }}">
                <i class="fas fa-graduation-cap"></i> Data Prodi
            </a>
            <a href="{{ route('profile') }}" class="{{ request()->routeIs('profile') ? 'active' : '' }}">
                <i class="fas fa-user"></i> Profile
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="margin-top: auto;">
                @csrf
                <button type="submit" style="all: unset; cursor:pointer; display:flex; align-items:center; padding: 0.75rem 1rem; font-weight:600; border-radius: 0.5rem; color:white; width: 100%;"
                    onmouseover="this.style.backgroundColor='rgba(255 255 255 / 0.25)'"
                    onmouseout="this.style.backgroundColor='transparent'">
                    <i class="fas fa-sign-out-alt" style="margin-right: 0.75rem;"></i> Logout
                </button>
            </form>
        </nav>
    </aside>

    <main>
        <h1 class="text-4xl font-bold mb-6 text-purple-700">Tambah Program Studi</h1>

        @if ($errors->any())
            <div class="alert-danger">
                <ul class="error-list">
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('prodi.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="prodi_kode">Kode Prodi</label>
                <input type="text" id="prodi_kode" name="prodi_kode" maxlength="20" required value="{{ old('prodi_kode') }}">
            </div>

            <div>
                <label for="prodi_nama">Nama Prodi</label>
                <input type="text" id="prodi_nama" name="prodi_nama" maxlength="50" required value="{{ old('prodi_nama') }}">
            </div>

            <div>
                <label for="jurusan_id">Pilih Jurusan</label>
                <select id="jurusan_id" name="jurusan_id" required>
                    <option value="">-- Pilih Jurusan --</option>
                    @foreach($jurusan as $j)
                        <option value="{{ $j->jurusan_id }}" {{ old('jurusan_id') == $j->jurusan_id ? 'selected' : '' }}>
                            {{ $j->jurusan_nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn-modern">Simpan</button>
            <a href="{{ route('prodi.index') }}" class="btn-modern" style="background: gray;">Batal</a>
        </form>
    </main>
</body>

</html>
