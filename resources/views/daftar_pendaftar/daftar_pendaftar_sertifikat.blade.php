<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>TOEIC Test Applicants - TOEICLY ITC</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
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

        /* Gaya untuk judul utama, konsisten dengan halaman lain */
        .main-title-purple {
            color: #4c1d95; /* Warna ungu gelap */
            font-weight: 800; /* Ekstra tebal */
            font-size: 2.25rem; /* Ukuran besar */
            margin-bottom: 1.5rem; /* Jarak bawah */
        }

        /* Card styling for the table container */
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

        /* Table styling (disesuaikan dengan halaman sebelumnya) */
        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 1rem;
            background: white;
            border-radius: 1rem;
            box-shadow: 0 6px 15px rgb(0 0 0 / 0.08); /* Tetap ada shadow */
            overflow: hidden;
        }

        th,
        td {
            text-align: left;
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #e5e7eb;
        }

        thead th {
            background-color: #f3e8ff; /* Warna header ungu muda */
            color: #7c3aed; /* Warna teks header ungu */
            font-weight: 700;
        }

        tbody tr:hover {
            background-color: #ede9fe; /* Warna hover baris tabel ungu sangat muda */
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

        /* Bootstrap table buttons (tidak perlu diubah jika sudah sesuai) */
        .btn-outline-primary {
            font-weight: 600;
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            border-color: #7c3aed; /* Warna border disamakan dengan tema */
            color: #7c3aed; /* Warna teks disamakan dengan tema */
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background-color: #7c3aed; /* Warna background saat hover */
            color: white; /* Warna teks saat hover */
        }

        .btn-outline-success {
            border-color: #22c55e; /* Green for success */
            color: #22c55e;
            font-weight: 600;
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }

        .btn-outline-success:hover {
            background-color: #22c55e;
            color: white;
        }


        /* Search and filter container */
        .search-filter-container {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
            align-items: center;
        }

        .search-filter-container input,
        .search-filter-container select {
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            box-shadow: 0 2px 8px rgb(0 0 0 / 0.05);
            transition: border-color 0.3s ease;
            color: #4c1d95; /* Warna ungu gelap untuk teks input/select */
        }

        .search-filter-container input::placeholder {
            color: #7c3aed; /* Warna ungu yang lebih terang untuk placeholder */
            opacity: 1;
        }

        .search-filter-container select option {
            color: #4c1d95;
        }


        .search-filter-container input:focus,
        .search-filter-container select:focus {
            outline: none;
            border-color: #7c3aed;
            box-shadow: 0 0 0 3px rgb(124 58 237 / 0.2);
        }

        /* Small form-select styling */
        .form-select-sm {
            padding: 0.25rem 0.75rem; /* Reduced padding */
            font-size: 0.875rem; /* Smaller font size */
            height: auto; /* Adjust height automatically */
            border-radius: 0.5rem; /* Consistent border radius */
            border: 1px solid #d1d5db;
            color: #4c1d95; /* Dark purple text */
            background-color: #ffffff; /* White background */
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-select-sm:focus {
            outline: none;
            border-color: #7c3aed;
            box-shadow: 0 0 0 3px rgb(124 58 237 / 0.2);
        }
    </style>
</head>
<body>
    @include('dashboard.admin.sidebar')

    <main>
        <h1 class="main-title-purple">TOEIC Test Applicants</h1>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <div class="search-filter-container">
            <input type="text" id="searchInput" class="form-control" placeholder="Search by student name..." />
            <select id="statusFilter" class="form-select">
                <option value="">All Certificate Status</option>
                <option value="sudah">Sudah</option>
                <option value="belum">Belum</option>
            </select>
        </div>

        <section class="card">
            <table id="pendaftaranTable">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Registration Code</th>
                        <th>Student Name</th>
                        <th>Phone Number</th>
                        <th>Registration Date</th>
                        <th>ID Card Scan</th>
                        <th>Student Card Scan</th>
                        <th>Photo</th>
                        <th>Certificate Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pendaftarans as $index => $pendaftaran)
                        <tr>
                            <td class="row-number">{{ $index + 1 }}</td>
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
                                    <a href="{{ asset('storage/'.$pendaftaran->pas_foto) }}" target="_blank" class="btn btn-sm btn-outline-primary">Photo</a>
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
                            <td colspan="9" class="no-data">There are no applicants yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchInput');
            const statusFilter = document.getElementById('statusFilter');
            const table = document.getElementById('pendaftaranTable');
            const rows = table.querySelectorAll('tbody tr');

            function filterTable() {
                const searchTerm = searchInput.value.toLowerCase().trim();
                const selectedStatus = statusFilter.value.toLowerCase();

                rows.forEach(row => {
                    const nameCell = row.cells[2].textContent.toLowerCase();
                    const statusCell = row.cells[8].querySelector('select').value.toLowerCase();

                    const matchesSearch = nameCell.includes(searchTerm);
                    const matchesStatus = !selectedStatus || statusCell === selectedStatus;

                    row.style.display = matchesSearch && matchesStatus ? '' : 'none';
                });

                // Update row numbers
                const visibleRows = table.querySelectorAll('tbody tr:not([style="display: none;"])');
                visibleRows.forEach((row, index) => {
                    row.querySelector('.row-number').textContent = index + 1;
                });
            }

            searchInput.addEventListener('input', filterTable);
            statusFilter.addEventListener('change', filterTable);
        });
    </script>
</body>
</html>