<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Information - TOEICLY ITC</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <style>
        /* Background and font (Consistent with User Management) */
        body {
            background: linear-gradient(135deg, #eef2ff 0%, #dbeafe 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
        }

        /* Sidebar styles (Consistent with User Management) */
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

        /* Main content area (Consistent with User Management) */
        main {
            margin-left: 16rem;
            padding: 2.5rem;
            min-height: 100vh;
            overflow-y: auto;
        }

        /* Card container (Consistent with User Management) */
        .card {
            background-color: #fff;
            border-radius: 1rem;
            box-shadow: 0 6px 15px rgb(0 0 0 / 0.08);
            padding: 1.5rem;
            transition: transform 0.35s ease, box-shadow 0.35s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            margin-top: 1.5rem;
        }

        /* Main Heading (Consistent with User Management) */
        h1 {
            color: #4c1d95; /* Dark purple for main heading */
            font-weight: 800;
            font-size: 2.25rem;
            margin-bottom: 1.5rem;
        }

        /* Section Title (Consistent with User Management) */
        .section-title-purple {
            color: #7c3aed; /* Purple to match table header */
            font-weight: 700;
            margin-bottom: 1.2rem;
            font-size: 1.4rem;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
            letter-spacing: 0.5px;
        }

        /* Button styles (Consistent with User Management's btn-action) */
        .btn-action {
            background: linear-gradient(90deg, #7c3aed, #a78bfa);
            color: white;
            padding: 0.4rem 0.8rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: background 0.3s ease;
            cursor: pointer;
            border: none;
            text-decoration: none; /* Removed underline */
            display: inline-flex; /* Use flex to align icon and text */
            align-items: center; /* Center items vertically */
            gap: 0.5rem; /* Space between icon and text */
        }

        .btn-action:hover {
            background: linear-gradient(90deg, #a78bfa, #7c3aed);
            transform: scale(1.05); /* Slightly less aggressive scale than btn-modern */
            box-shadow: 0 4px 10px rgb(124 58 237 / 0.5); /* Matching btn-action hover */
        }

        /* Specific style for the "Add New Information" button */
        .btn-add-info {
            padding: 0.5rem 1.5rem; /* Slightly larger padding for a primary button */
            border-radius: 0.75rem; /* More rounded corners for primary button */
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 12px rgb(124 58 237 / 0.4);
        }

        .btn-add-info:hover {
            transform: scale(1.08); /* More aggressive scale on hover for primary button */
            box-shadow: 0 8px 20px rgb(124 58 237 / 0.7);
        }

        /* Table styling (Unified with User Management) */
        table {
            border-collapse: collapse; /* Use collapse for consistent borders and rounded corners */
            width: 100%;
            font-size: 1rem;
            background: white;
            border-radius: 1rem; /* Rounded corners for the entire table */
            box-shadow: 0 6px 15px rgb(0 0 0 / 0.08);
            overflow: hidden; /* Ensures content respects border-radius */
        }

        th,
        td {
            text-align: left;
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #e5e7eb;
        }

        thead th {
            background-color: #f3e8ff; /* Light purple header */
            color: #7c3aed; /* Darker purple text for header from user management */
            font-weight: 700;
        }

        tbody tr:hover {
            background-color: #ede9fe; /* Lighter purple on hover */
        }

        /* Remove bottom border from the last row */
        tbody tr:last-child td {
            border-bottom: none;
        }

        .no-data {
            text-align: center;
            padding: 2rem;
            color: #9ca3af;
            font-style: italic;
        }

        /* Alert styles (Consistent with User Management) */
        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
            box-shadow: 0 2px 8px rgb(34 197 94 / 0.3);
        }

        .alert-danger {
            background-color: #fee2e2;
            color: #dc2626;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
            box-shadow: 0 2px 8px rgb(239 68 68 / 0.3);
        }

        /* Specific styling for the action buttons in the table */
        .table-action-btn {
            background: linear-gradient(90deg, #7c3aed, #a78bfa); /* Same purple gradient as Edit */
            color: white;
            padding: 0.3rem 0.7rem; /* Slightly smaller padding for table buttons */
            border-radius: 0.4rem; /* Slightly smaller border-radius */
            font-weight: 600;
            transition: background 0.3s ease, transform 0.2s ease;
            cursor: pointer;
            border: none;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem; /* Smaller gap */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }

        .table-action-btn:hover {
            background: linear-gradient(90deg, #a78bfa, #7c3aed);
            transform: translateY(-2px); /* Slight lift on hover */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    @include('dashboard.admin.sidebar')

    <main>
        <h1>Manage Information</h1>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert-danger">{{ session('error') }}</div>
        @endif

        <a href="{{ route('informasi.create') }}" class="btn-action btn-add-info">
            <i class="fas fa-plus"></i> Add Info
        </a>

        <section class="card">
            <p class="section-title-purple">List of Current Information</p>
            <table class="table w-full">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Posted By</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($informasis as $index => $informasi)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $informasi->judul }}</td>
                            <td>{{ Str::limit($informasi->isi, 100) }}</td>
                            <td>{{ $informasi->admin->nama ?? 'Unknown' }}</td>
                            <td>{{ optional($informasi->created_at)->format('d-m-Y H:i') ?? '-' }}</td>
                            <td>
                                <a href="{{ route('informasi.edit', $informasi->informasi_id) }}"
                                    class="table-action-btn">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('informasi.destroy', $informasi->informasi_id) }}"
                                      method="POST" class="inline-block ml-2" onsubmit="return confirm('Are you sure you want to delete this information?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="table-action-btn">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="no-data">No information available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>