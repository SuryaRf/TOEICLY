<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>TOEIC Test Applicants List - TOEICLY ITC</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Background and font */
        body {
            background: linear-gradient(135deg, #eef2ff 0%, #dbeafe 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
        }

        /* Main content */
        main {
            margin-left: 16rem;
            padding: 2.5rem;
            min-height: 100vh;
            overflow-y: auto;
        }

        /* Card styling */
        .card {
            background-color: #fff;
            border-radius: 1rem;
            box-shadow: 0 6px 15px rgb(0 0 0 / 0.08);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        /* Table styling */
        .table {
            width: 100%;
            margin-bottom: 0;
            background: white;
            border-radius: 0.5rem;
            overflow: hidden;
        }

        .table th {
            background-color: #f3e8ff;
            color: #7c3aed;
            font-weight: 600;
            padding: 1rem;
            border-bottom: 2px solid #e5e7eb;
        }

        .table td {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background-color: #ede9fe;
        }

        /* Button styles */
        .btn-verify {
            padding: 0.375rem 1rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-success {
            background-color: #10b981;
            color: white;
        }

        .btn-danger {
            background-color: #ef4444;
            color: white;
        }

        .btn-custom-purple {
            background: linear-gradient(90deg, #7c3aed, #a78bfa);
            color: white;
            border: none;
            padding: 0.375rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .btn-custom-purple:hover {
            background: linear-gradient(90deg, #6d28d9, #7c3aed);
            transform: translateY(-1px);
        }

        /* Modal styling */
        .modal-content {
            border-radius: 1rem;
            border: none;
        }

        .modal-header {
            background: linear-gradient(90deg, #7c3aed, #a78bfa);
            color: white;
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
            padding: 1rem 1.5rem;
        }

        .modal-title {
            font-weight: 600;
        }

        .modal-body {
            padding: 1.5rem;
        }

        /* Form controls */
        .form-control,
        .form-select {
            border-radius: 0.5rem;
            border: 1px solid #e5e7eb;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #7c3aed;
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.2);
        }

        /* Search and filter */
        .search-filter-container {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .search-filter-container input,
        .search-filter-container select {
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
            min-width: 200px;
        }

        /* Alert styling */
        .alert-success,
        .alert-danger {
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            font-weight: 500;
        }

        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
        }

        .alert-danger {
            background-color: #fee2e2;
            color: #dc2626;
        }

        /* Main title */
        .main-title-purple {
            color: #4c1d95;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        /* Document links */
        .btn-outline-primary {
            color: #7c3aed;
            border-color: #7c3aed;
            padding: 0.25rem 0.75rem;
            border-radius: 0.375rem;
        }

        .btn-outline-primary:hover {
            background-color: #7c3aed;
            color: white;
        }
    </style>
</head>

<body>
    @include('dashboard.admin.sidebar')

    <main>
        <h1 class="main-title-purple">TOEIC Test Applicants List</h1>

        @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
        <div class="alert-danger">{{ session('error') }}</div>
        @endif

        <div class="search-filter-container">
            <input type="text" id="searchInput" placeholder="Search by Student Name" />
            <select id="statusFilter">
                <option value="">All Statuses</option>
                <option value="menunggu">Pending</option>
                <option value="diterima">Accepted</option>
                <option value="ditolak">Rejected</option>
            </select>
        </div>

        <section class="card">
            <table class="table table-bordered table-striped" id="pendaftaranTable">
                <thead class="table-primary">
                    <tr>
                        <th>No.</th>
                        <th>Registration Code</th>
                        <th>Full Name</th>
                        <th>Phone Number</th>
                        <th>Registration Status</th>
                        <th>Registration Date</th>
                        <th>Scan KTP</th>
                        <th>Scan KTM</th>
                        <th>Photo</th>
                        <th>Actions</th>
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
                        <td>
                            @if($pendaftaran->scan_ktp)
                            <a href="{{ asset('storage/' . $pendaftaran->scan_ktp) }}" target="_blank"
                                class="btn btn-sm btn-outline-primary">KTP</a>
                            @else
                            -
                            @endif
                        </td>
                        <td>
                            @if($pendaftaran->scan_ktm)
                            <a href="{{ asset('storage/' . $pendaftaran->scan_ktm) }}" target="_blank"
                                class="btn btn-sm btn-outline-primary">KTM</a>
                            @else
                            -
                            @endif
                        </td>
                        <td>
                            @if($pendaftaran->pas_foto)
                            <a href="{{ asset('storage/' . $pendaftaran->pas_foto) }}" target="_blank"
                                class="btn btn-sm btn-outline-primary">Photo</a>
                            @else
                            -
                            @endif
                        </td>
                        <td>
                            @if($pendaftaran->detail && $pendaftaran->detail->status === 'menunggu')
                            <form
                                action="{{ route('admin.verify', ['id' => $pendaftaran->pendaftaran_id, 'status' => 'diterima']) }}"
                                method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-verify btn-success">Accept</button>
                            </form>
                            <form
                                action="{{ route('admin.verify', ['id' => $pendaftaran->pendaftaran_id, 'status' => 'ditolak']) }}"
                                method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-verify btn-danger">Reject</button>
                            </form>
                            @endif
                            <button class="btn btn-sm btn-custom-purple" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $pendaftaran->pendaftaran_id }}">Edit</button>
                            <button class="btn btn-sm btn-custom-purple" data-bs-toggle="modal"
                                data-bs-target="#detailModal{{ $pendaftaran->pendaftaran_id }}">Detail</button>
                        </td>
                    </tr>

                    <div class="modal fade" id="editModal{{ $pendaftaran->pendaftaran_id }}" tabindex="-1"
                        aria-labelledby="editModalLabel{{ $pendaftaran->pendaftaran_id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel{{ $pendaftaran->pendaftaran_id }}">Edit
                                        Registration Status</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('admin.editStatus', $pendaftaran->pendaftaran_id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="status{{ $pendaftaran->pendaftaran_id }}"
                                                class="form-label">Status</label>
                                            <select class="form-select" id="status{{ $pendaftaran->pendaftaran_id }}"
                                                name="status" required>
                                                <option value="menunggu"
                                                    {{ optional($pendaftaran->detail)->status === 'Pending' ? 'selected' : '' }}>
                                                    Pending</option>
                                                <option value="diterima"
                                                    {{ optional($pendaftaran->detail)->status === 'Accepted' ? 'selected' : '' }}>
                                                    Accepted</option>
                                                <option value="ditolak"
                                                    {{ optional($pendaftaran->detail)->status === 'Rejected' ? 'selected' : '' }}>
                                                    Rejected</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="catatan{{ $pendaftaran->pendaftaran_id }}"
                                                class="form-label">Info</label>
                                            <textarea class="form-control" id="catatan{{ $pendaftaran->pendaftaran_id }}"
                                                name="catatan"
                                                rows="4">{{ optional($pendaftaran->detail)->Info ?? '' }}</textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-modal-action"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-modal-action">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="detailModal{{ $pendaftaran->pendaftaran_id }}" tabindex="-1"
                        aria-labelledby="detailModalLabel{{ $pendaftaran->pendaftaran_id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detailModalLabel{{ $pendaftaran->pendaftaran_id }}">Detail
                                        Registration</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Registration Code:</strong> {{ $pendaftaran->pendaftaran_kode }}</p>
                                    <p><strong>Student Name:</strong> {{ $pendaftaran->mahasiswa->nama ?? '-' }}</p>
                                    <p><strong>NIM:</strong> {{ $pendaftaran->mahasiswa->nim ?? '-' }}</p>
                                    <p><strong>NIK:</strong> {{ $pendaftaran->mahasiswa->nik ?? '-' }}</p>
                                    <p><strong>Batch:</strong> {{ $pendaftaran->mahasiswa->angkatan ?? '-' }}</p>
                                    <p><strong>Phone Number:</strong> {{ $pendaftaran->mahasiswa->no_telp ?? '-' }}</p>
                                    <p><strong>Original Address:</strong> {{ $pendaftaran->mahasiswa->alamat_asal ?? '-' }}</p>
                                    <p><strong>Current Address:</strong>
                                        {{ $pendaftaran->mahasiswa->alamat_sekarang ?? '-' }}</p>
                                    <p><strong>Gender:</strong> {{ $pendaftaran->mahasiswa->jenis_kelamin ?? '-' }}
                                    </p>
                                    <p><strong>Student Status:</strong> {{ $pendaftaran->mahasiswa->status ?? '-' }}</p>
                                    <p><strong>Description:</strong> {{ $pendaftaran->mahasiswa->keterangan ?? '-' }}</p>
                                    <p><strong>Study Program:</strong>
                                        {{ $pendaftaran->mahasiswa->prodi->nama_prodi ?? 'D-IV Business Information Systems' }}</p>
                                    <p><strong>Registration Status:</strong>
                                        {{ ucfirst($pendaftaran->detail->status ?? 'Not available') }}</p>
                                    <p><strong>Registration Date:</strong>
                                        {{ $pendaftaran->tanggal_pendaftaran->format('d-m-Y') }}</p>
                                    <p><strong>Notes:</strong> {{ $pendaftaran->detail->catatan ?? '-' }}</p>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center">No applicants yet.</td>
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
                    const statusCell = row.cells[4].textContent.toLowerCase();

                    const matchesSearch = nameCell.includes(searchTerm);
                    const matchesStatus = !selectedStatus || statusCell === selectedStatus;

                    row.style.display = matchesSearch && matchesStatus ? '' : 'none';
                });

                // Update row numbers
                const visibleRows = table.querySelectorAll('tbody tr:not([style="display: none;"])');
                visibleRows.forEach((row, index) => {
                    row.cells[0].textContent = index + 1;
                });
            }

            searchInput.addEventListener('input', filterTable);
            statusFilter.addEventListener('change', filterTable);
        });
    </script>
</body>

</html>