@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-100">
    <!-- Sidebar (copy from index for consistency) -->
    <aside class="sidebar flex flex-col fixed top-0 left-0 w-64 h-full bg-gradient-to-b from-purple-700 to-purple-900 text-white shadow-lg z-50">
        <div class="p-6">
            <h2 class="text-4xl font-extrabold tracking-tight select-none">TOEICLY Admin</h2>
        </div>
        <nav class="mt-8 flex flex-col gap-2 px-4">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }} flex items-center py-2 px-3 rounded hover:bg-purple-600">
                <i class="fas fa-home mr-3"></i> Dashboard
            </a>
            <a href="{{ route('admin.manage') }}" class="sidebar-link {{ request()->routeIs('admin.manage') ? 'active' : '' }} flex items-center py-2 px-3 rounded hover:bg-purple-600">
                <i class="fas fa-users mr-3"></i> Manajemen Pengguna
            </a>
            <a href="{{ route('jadwal_sertifikat.index') }}" class="sidebar-link {{ request()->routeIs('jadwal_sertifikat.*') ? 'active' : '' }} flex items-center py-2 px-3 rounded bg-purple-800">
                <i class="fas fa-calendar-alt mr-3"></i> Kelola Jadwal Sertifikat
            </a>
            <a href="{{ route('kampus.index') }}" class="sidebar-link {{ request()->routeIs('kampus.*') ? 'active' : '' }} flex items-center py-2 px-3 rounded hover:bg-purple-600">
                <i class="fas fa-building mr-3"></i> Data Kampus
            </a>
            <a href="{{ route('jurusan.index') }}" class="sidebar-link {{ request()->routeIs('jurusan.*') ? 'active' : '' }} flex items-center py-2 px-3 rounded hover:bg-purple-600">
                <i class="fas fa-book mr-3"></i> Data Jurusan
            </a>
            <a href="{{ route('prodi.index') }}" class="sidebar-link {{ request()->routeIs('prodi.*') ? 'active' : '' }} flex items-center py-2 px-3 rounded hover:bg-purple-600">
                <i class="fas fa-graduation-cap mr-3"></i> Data Prodi
            </a>
            <a href="{{ route('profile') }}" class="sidebar-link {{ request()->routeIs('profile') ? 'active' : '' }} flex items-center py-2 px-3 rounded hover:bg-purple-600 mt-auto">
                <i class="fas fa-user mr-3"></i> Profile
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="mt-2 px-3">
                @csrf
                <button type="submit" class="w-full flex items-center py-2 px-3 rounded hover:bg-purple-600 text-left">
                    <i class="fas fa-sign-out-alt mr-3"></i> Logout
                </button>
            </form>
        </nav>
    </aside>

    <main class="flex-1 ml-64 p-8 max-w-lg">
        <h1 class="text-4xl font-bold mb-6 text-purple-700">Upload Jadwal Sertifikat</h1>

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('jadwal_sertifikat.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div>
                <label for="judul" class="block mb-2 font-semibold">Judul Jadwal</label>
                <input type="text" id="judul" name="judul" class="border border-gray-300 rounded w-full px-3 py-2" required value="{{ old('judul') }}">
            </div>

            <div>
                <label for="file_pdf" class="block mb-2 font-semibold">Upload File PDF</label>
                <input type="file" id="file_pdf" name="file_pdf" accept="application/pdf" required>
            </div>

            <button type="submit" class="btn-modern bg-purple-600 hover:bg-purple-700 px-6 py-2 rounded text-white font-semibold">Upload</button>
        </form>
    </main>
</div>

<style>
        /* Gradient background */
        body {
            background: linear-gradient(135deg, #eef2ff 0%, #dbeafe 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
        }

        /* Sidebar */
        .sidebar {
            background: linear-gradient(180deg, #5b21b6 0%, #7c3aed 100%);
            color: white;
            min-height: 100vh;
            position: fixed;
            width: 16rem;
            /* 64 */
            transition: all 0.3s ease;
            box-shadow: 4px 0 12px rgb(123 97 255 / 0.4);
            z-index: 50;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            /* py-3 px-4 */
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
            /* 20px */
            font-size: 1.1rem;
            margin-right: 0.75rem;
            transition: transform 0.3s ease;
        }

        .sidebar a:hover i {
            transform: rotate(10deg) scale(1.2);
            color: #ddd;
        }

        /* Main content */
        main {
            margin-left: 16rem;
            padding: 2.5rem;
            min-height: 100vh;
            overflow-y: auto;
        }

        /* Card style */
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

        /* Buttons */
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
        }

        .btn-modern:hover {
            background: linear-gradient(90deg, #a78bfa, #7c3aed);
            transform: scale(1.08);
            box-shadow: 0 8px 20px rgb(124 58 237 / 0.7);
            color: white;
        }

        /* Table */
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

        /* Action buttons */
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
@endsection
