<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Data Jurusan - TOEIC Management</title>
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
            padding: 1.5rem 1rem;
            display: flex;
            flex-direction: column;
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
            margin-bottom: 0.5rem;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: rgba(255 255 255 / 0.25);
            transform: translateX(8px);
            box-shadow: 0 4px 15px rgb(124 58 237 / 0.5);
            color: white !important;
        }

        .sidebar a i {
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
            cursor: default;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgb(124 58 237 / 0.25);
        }

        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 1rem;
        }

        th,
        td {
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

        .btn-modern {
            background: linear-gradient(90deg, #7c3aed, #a78bfa);
            border: none;
            font-weight: 600;
            padding: 0.5rem 1.5rem;
            border-radius: 0.75rem;
            color: white;
            box-shadow: 0 4px 12px rgb(124 58 237 / 0.4);
            transition: all 0.3s ease;
            align-self: flex-start;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .btn-modern:hover {
            background: linear-gradient(90deg, #a78bfa, #7c3aed);
            transform: scale(1.08);
            box-shadow: 0 8px 20px rgb(124 58 237 / 0.7);
            color: white;
        }

        .btn-action {
            padding: 0.375rem 0.75rem;
            border-radius: 0.375rem;
            font-weight: 600;
            color: white;
            cursor: pointer;
            border: none;
            transition: background-color 0.3s ease;
            text-decoration: none;
            margin-right: 0.5rem;
            display: inline-block;
        }

        .btn-action.edit {
            background-color: #fbbf24;
        }

        .btn-action.edit:hover {
            background-color: #f59e0b;
        }

        .btn-action.delete {
            background-color: #ef4444;
        }

        .btn-action.delete:hover {
            background-color: #dc2626;
        }
    </style>
</head>

<body>
    <aside class="sidebar">
        <h2 class="text-4xl font-extrabold tracking-tight select-none mb-6">TOEICLY Admin</h2>
        <nav>
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a href="{{ route('admin.manage') }}" class="sidebar-link">
                <i class="fas fa-users"></i> Manajemen Pengguna
            </a>
            <a href="{{ route('kampus.index') }}" class="sidebar-link">
                <i class="fas fa-building"></i> Data Kampus
            </a>
            <a href="{{ route('jurusan.index') }}" class="sidebar-link active">
                <i class="fas fa-book"></i> Data Jurusan
            </a>
            <a href="{{ route('prodi.index') }}" class="sidebar-link">
                <i class="fas fa-graduation-cap"></i> Data Prodi
            </a>
            <a href="{{ route('profile') }}" class="sidebar-link">
                <i class="fas fa-user"></i> Profile
            </a>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="sidebar-link">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                @csrf
            </form>
        </nav>
    </aside>

    <main>
        <h1 class="text-5xl font-extrabold text-gray-900 tracking-tight mb-8">Daftar Jurusan</h1>

        <a href="{{ route('jurusan.create') }}" class="btn-modern">Tambah Jurusan</a>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded shadow">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kode Jurusan</th>
                        <th>Nama Jurusan</th>
                        <th>Kampus</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $index => $jurusan)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $jurusan->jurusan_kode }}</td>
                            <td>{{ $jurusan->jurusan_nama }}</td>
                            <td>{{ $jurusan->kampus ? $jurusan->kampus->kampus_nama : '-' }}</td>
                            <td>
                                <a href="{{ route('jurusan.edit', $jurusan->jurusan_id) }}" class="btn-action edit">Edit</a>
                                <form action="{{ route('jurusan.destroy', $jurusan->jurusan_id) }}" method="POST" class="inline-block"
                                    onsubmit="return confirm('Yakin ingin menghapus jurusan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action delete">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center p-4 text-gray-500">Tidak ada data jurusan tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
