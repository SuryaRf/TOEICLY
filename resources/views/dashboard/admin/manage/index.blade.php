<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Manajemen Pengguna - TOEIC Management</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(135deg, #eef2ff 0%, #dbeafe 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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

        h1 {
            color: #4c1d95;
            font-weight: 800;
            font-size: 2.25rem;
            margin-bottom: 1.5rem;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 1rem;
            background: white;
            border-radius: 1rem;
            overflow: hidden;
        }

        th,
        td {
            text-align: left;
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #e5e7eb;
        }

        th {
            background-color: #f3e8ff;
            color: #7c3aed;
            font-weight: 700;
        }

        tbody tr:hover {
            background-color: #ede9fe;
        }

        .btn-action {
            background: linear-gradient(90deg, #7c3aed, #a78bfa);
            color: white;
            padding: 0.4rem 0.8rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: background 0.3s ease;
            cursor: pointer;
            border: none;
            text-decoration: none;
            display: inline-block;
        }

        .btn-action:hover {
            background: linear-gradient(90deg, #a78bfa, #7c3aed);
        }

        .btn-action.bg-red-500:hover {
            background: linear-gradient(90deg, #ef4444, #dc2626);
        }

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
        }

        .search-filter-container input:focus,
        .search-filter-container select:focus {
            outline: none;
            border-color: #7c3aed;
            box-shadow: 0 0 0 3px rgb(124 58 237 / 0.2);
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
    <!-- Sidebar -->
    @include('dashboard.admin.sidebar')

    <!-- Main content -->
    <main>
        <h1>User Management</h1>

        <section class="card">
            <p class="text-gray-600 mb-4">List of registered users</p>
            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            <!-- Search and Filter Controls -->
            <div class="search-filter-container">
                <input type="text" id="searchInput" class="form-control" placeholder="Search by name..." />
                <select id="roleFilter" class="form-select">
                    <option value="">All Role</option>
                    <option value="admin">Admin</option>
                    <option value="mahasiswa">Mahasiswa</option>
                    <option value="dosen">Dosen</option>
                    <option value="tendik">Tendik</option>
                    <option value="itc">ITC</option>
                </select>
            </div>

            <table id="usersTable">
                <thead>
                    <tr>
                        <th>ID User</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Nama Lengkap</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->user_id }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="capitalize">{{ $user->role }}</td>
                            <td>
                                @if ($user->role === 'admin' && $user->admin)
                                    {{ $user->admin->nama }}
                                @elseif ($user->role === 'mahasiswa' && $user->mahasiswa)
                                    {{ $user->mahasiswa->nama }}
                                @elseif ($user->role === 'dosen' && $user->dosen)
                                    {{ $user->dosen->nama }}
                                @elseif ($user->role === 'tendik' && $user->tendik)
                                    {{ $user->tendik->nama }}
                                @elseif ($user->role === 'itc' && $user->itc)
                                    {{ $user->itc->nama }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.manage.edit', $user->user_id) }}" class="btn-action">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.manage.destroy', $user->user_id) }}" method="POST"
                                    class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action ml-2 bg-red-500 hover:bg-red-600">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-gray-500 py-4">Data pengguna tidak tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchInput');
            const roleFilter = document.getElementById('roleFilter');
            const table = document.getElementById('usersTable');
            const rows = table.querySelectorAll('tbody tr');

            function filterTable() {
                const searchTerm = searchInput.value.toLowerCase().trim();
                const selectedRole = roleFilter.value.toLowerCase();

                rows.forEach(row => {
                    const nameCell = row.cells[4].textContent.toLowerCase();
                    const roleCell = row.cells[3].textContent.toLowerCase();

                    const matchesSearch = nameCell.includes(searchTerm);
                    const matchesRole = !selectedRole || roleCell === selectedRole;

                    row.style.display = matchesSearch && matchesRole ? '' : 'none';
                });
            }

            searchInput.addEventListener('input', filterTable);
            roleFilter.addEventListener('change', filterTable);
        });
    </script>
</body>
</html>