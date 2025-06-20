<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Test Applicants Data - TOEICLY ITC</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" />
    <style>
        /* Background and font */
        body {
            background: linear-gradient(135deg, #eef2ff 0%, #dbeafe 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
        }

        /* Sidebar styles */
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

        /* Main content */
        main {
            margin-left: 16rem;
            padding: 2.5rem;
            min-height: 100vh;
            overflow-y: auto;
        }

        /* Styles for the main heading */
        h1 {
            color: #4c1d95; /* This sets the text color to a deep purple. */
            font-weight: 800; /* This makes the text extra bold. */
            font-size: 2.5rem; /* This sets the text size to 2.5 times the root font size. */
            margin-bottom: 1.5rem; /* This adds space below the heading. */
        }

        /* Button styles */
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

        /* Table styling */
        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 1rem;
            background: white;
            border-radius: 1rem;
            box-shadow: 0 6px 15px rgb(0 0 0 / 0.08);
            overflow: hidden;
        }

        th,
        td {
            text-align: left;
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #e5e7eb;
        }

        thead th {
            background-color: #a78bfa;
            color:rgb(181, 175, 192);
            font-weight: 700;
        }

        tbody tr:hover {
            background-color: #ddd6fe;
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

        /* Bootstrap table buttons */
        .btn-outline-primary {
            font-weight: 600;
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
    </style>
</head>

<body>

    <aside class="sidebar flex flex-col">
        <div class="p-6">
            <h2 class="text-4xl font-extrabold tracking-tight select-none">TOEICLY ITC</h2>
        </div>
        <nav class="mt-8 flex flex-col gap-2 px-2">
            <a href="{{ route('itc.dashboard') }}"
                class="sidebar-link {{ request()->routeIs('itc.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a href="{{ route('itc.pendaftar') }}"
                class="sidebar-link {{ request()->routeIs('itc.pendaftar') ? 'active' : '' }}">
                <i class="fas fa-calendar-alt"></i> Test Applicants Data
            </a>
            <a href="{{ route('itc.upload_nilai') }}"
                class="sidebar-link {{ request()->routeIs('itc.upload_nilai') ? 'active' : '' }}">
                <i class="fas fa-file-pdf"></i> Upload Score TOEIC
            </a>
            <a href="{{ route('itc.profile') }}"
                class="sidebar-link {{ request()->routeIs('itc.profile') ? 'active' : '' }}">
                <i class="fas fa-user"></i> Profile
            </a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="sidebar-link">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                @csrf
            </form>
        </nav>
    </aside>

    <main>
        <h1>TOEIC Test Applicants List</h1>

        @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped">
            <thead class="table-primary">
                <tr>
                    <th>No.</th>
                    <th>Registration Code</th>
                    <th>Student Name</th>
                    <th>Phone Number</th>
                    <th>Registration Status</th>
                    <th>Registration Date</th>
                    </tr>
            </thead>
            <tbody>
                @forelse ($pendaftarans as $index => $pendaftaran)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pendaftaran->pendaftaran_kode }}</td>
                    <td>{{ $pendaftaran->mahasiswa->nama ?? '-' }}</td>
                    <td>
                        @if($pendaftaran->mahasiswa->no_telp)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $pendaftaran->mahasiswa->no_telp) }}"
                            target="_blank" class="btn btn-sm btn-outline-success">
                            {{ $pendaftaran->mahasiswa->no_telp }}
                        </a>
                        @else
                        -
                        @endif
                    </td>
                    <td>{{ ucfirst($pendaftaran->detail->status ?? 'belum ada') }}</td>
                    <td>{{ $pendaftaran->tanggal_pendaftaran->format('d-m-Y') }}</td>
                    </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada pendaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>