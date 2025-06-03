<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Data Pendaftar Tes - TOEICLY ITC</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
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

        /* Bootstrap table buttons */
        .btn-outline-primary {
            font-weight: 600;
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
    </style>
</head>

<body>

       @include('dashboard.admin.sidebar')

    <main>
        <h1 class="text-4xl font-bold mb-6 text-purple-700">Daftar Pendaftar Tes TOEIC</h1>

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
<th>Registration Date</th>
<th>ID Card Scan</th>
<th>Student Card Scan</th>
<th>Passport Photo</th>
<th>Certificate Status</th>

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
                        <td>{{ $pendaftaran->tanggal_pendaftaran->format('d-m-Y') }}</td>
                        <td>
                            @if($pendaftaran->scan_ktp)
                                <a href="{{ asset('storage/'.$pendaftaran->scan_ktp) }}" target="_blank" class="btn btn-sm btn-outline-primary">KTP</a>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if($pendaftaran->scan_ktm)
                                <a href="{{ asset('storage/'.$pendaftaran->scan_ktm) }}" target="_blank" class="btn btn-sm btn-outline-primary">KTM</a>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if($pendaftaran->pas_foto)
                                <a href="{{ asset('storage/'.$pendaftaran->pas_foto) }}" target="_blank" class="btn btn-sm btn-outline-primary">Foto</a>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('itc.updateStatusSertifikat', $pendaftaran->pendaftaran_id) }}" method="POST" class="d-inline-block">
                                @csrf
                                <select name="status" onchange="this.form.submit()" class="form-select form-select-sm">
                                    <option value="belum" {{ optional($pendaftaran->sertifikatStatus)->status === 'belum' ? 'selected' : '' }}>Belum</option>
                                    <option value="sudah" {{ optional($pendaftaran->sertifikatStatus)->status === 'sudah' ? 'selected' : '' }}>Sudah</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">There are no applicants yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>