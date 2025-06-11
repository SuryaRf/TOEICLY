<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Certificate Schedule - TOEICLY Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
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

        .main-title-purple {
            color: #4c1d95;
            font-weight: 800;
            font-size: 2.25rem;
            margin-bottom: 1.5rem;
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
        }

        .btn-modern:hover {
            background: linear-gradient(90deg, #a78bfa, #7c3aed);
            transform: scale(1.08);
            box-shadow: 0 8px 20px rgb(124 58 237 / 0.7);
            color: white;
        }

        .form-container {
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 6px 15px rgb(0 0 0 / 0.08);
            max-width: 28rem;
            margin: 0 auto;
        }

        .form-label {
            font-weight: 600;
            color: #4b5563;
            margin-bottom: 0.25rem;
        }

        .form-control {
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-control:focus {
            border-color: #7c3aed;
            box-shadow: 0 0 8px rgb(124 58 237 / 0.2);
            outline: none;
        }

        .alert {
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .alert-danger {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }
    </style>
</head>
<body>
    @include('dashboard.admin.sidebar')

    <main>
        <h1 class="main-title-purple">Edit Certificate Schedule</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-container">
            <form action="{{ route('jadwal_sertifikat.update', $jadwal->jadwal_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="judul" class="form-label">Schedule Name</label>
                    <input type="text" name="judul" id="judul" class="form-control w-full" value="{{ old('judul', $jadwal->judul) }}" required>
                </div>
                <div class="mb-4">
                    <label for="tanggal" class="form-label">Date</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control w-full" value="{{ old('tanggal', $jadwal->tanggal) }}" required>
                </div>
                <div class="mb-4">
                    <label for="file_pdf" class="form-label">PDF File (optional)</label>
                    <input type="file" name="file_pdf" id="file_pdf" class="form-control w-full">
                    @if($jadwal->file_pdf)
                        <p class="text-muted mt-1">Current file: <a href="{{ asset('storage/' . $jadwal->file_pdf) }}" target="_blank" class="text-blue-600">{{ basename($jadwal->file_pdf) }}</a></p>
                    @endif
                </div>
                <button type="submit" class="btn-modern w-full">Update Schedule</button>
            </form>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>