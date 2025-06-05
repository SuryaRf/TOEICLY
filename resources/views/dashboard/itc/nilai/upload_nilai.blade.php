<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Upload PDF Nilai TOEIC - TOEICLY ITC</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
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

        h1 {
            color: #4c1d95;
            font-weight: 800;
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
        }

        .card {
            background-color: #fff;
            border-radius: 1rem;
            box-shadow: 0 6px 15px rgb(0 0 0 / 0.08);
            padding: 2rem;
            transition: transform 0.35s ease, box-shadow 0.35s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            max-width: 600px;
            margin: auto;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgb(124 58 237 / 0.25);
            cursor: pointer;
        }

        label {
            font-weight: 600;
            color: #5b21b6;
            margin-top: 1rem;
        }

        input[type="file"], input[type="text"] {
            width: 100%;
            margin-top: 0.25rem;
            padding: 0.5rem;
            border: 1px solid #a78bfa;
            border-radius: 0.5rem;
            font-size: 1rem;
            color: #333;
        }

        input[type="file"]:focus, input[type="text"]:focus {
            outline: none;
            border-color: #7c3aed;
            box-shadow: 0 0 5px #7c3aed;
        }

        .btn-modern {
            margin-top: 1.5rem;
            background: linear-gradient(90deg, #7c3aed, #a78bfa);
            border: none;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            color: white;
            box-shadow: 0 4px 12px rgb(124 58 237 / 0.4);
            transition: all 0.3s ease;
            cursor: pointer;
            max-width: 200px;
            margin-left: auto;
            display: block;
        }

        .btn-modern:hover {
            background: linear-gradient(90deg, #a78bfa, #7c3aed);
            transform: scale(1.08);
            box-shadow: 0 8px 20px rgb(124 58 237 / 0.7);
            text-decoration: none;
            color: white;
        }

        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
            box-shadow: 0 2px 8px rgb(34 197 94 / 0.3);
            max-width: 600px;
            margin-left: auto;
        }

        .error-message {
            color: #dc2626;
            font-weight: 600;
            margin-top: 0.5rem;
            max-width: 600px;
            margin-left: auto;
        }
    </style>
</head>
<body>
    <aside class="sidebar flex flex-col">
        <div class="p-6">
            <h2 class="text-4xl font-extrabold tracking-tight select-none">TOEICLY ITC</h2>
        </div>
        <nav class="mt-8 flex flex-col gap-2 px-2">
            <a href="{{ route('itc.dashboard') }}" class="sidebar-link {{ request()->routeIs('itc.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a href="{{ route('itc.pendaftar') }}" class="sidebar-link {{ request()->routeIs('itc.pendaftar') ? 'active' : '' }}">
                <i class="fas fa-calendar-alt"></i> Data Pendaftar Tes
            </a>
            <a href="{{ route('itc.upload_nilai') }}" class="sidebar-link {{ request()->routeIs('itc.upload_nilai') ? 'active' : '' }}">
                <i class="fas fa-file-pdf"></i> Upload Nilai TOEIC
            </a>
            <a href="{{ route('itc.profile') }}" class="sidebar-link {{ request()->routeIs('itc.profile') ? 'active' : '' }}">
                <i class="fas fa-user"></i> Profile
            </a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="sidebar-link">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                @csrf
            </form>
        </nav>
    </aside>

    <main>
        <h1>Upload PDF Nilai TOEIC</h1>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('itc.upload_nilai.store') }}" method="POST" enctype="multipart/form-data" class="card">
            @csrf
            <label for="judul">Judul Dokumen</label>
            <input type="text" name="judul" id="judul" value="{{ old('judul') }}" placeholder="e.g., TOEIC Score Report">
            @error('judul')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <label for="nilai_pdf">Pilih File PDF Nilai TOEIC</label>
            <input type="file" name="nilai_pdf" id="nilai_pdf" accept="application/pdf" required>
            @error('nilai_pdf')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn-modern">Upload</button>
        </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>