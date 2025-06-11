<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Upload TOEIC Score PDF - TOEICLY ITC</title>
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
            max-width: 900px;
            margin: 2rem auto 0 auto;
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
            margin-left: 0;
            display: block;
        }
        .btn-modern:hover {
            background: linear-gradient(90deg, #a78bfa, #7c3aed);
            transform: scale(1.08);
            box-shadow: 0 8px 20px rgb(124 58 237 / 0.7);
            text-decoration: none;
            color: white;
        }
        /* Notification Animation Styles */
        .alert-success {
            animation: fadeInOut 4s ease-in-out forwards;
            position: fixed;
            top: 2rem;
            right: 2rem;
            z-index: 1000;
            background-color: #ecfdf5;
            color: #065f46;
            padding: 1rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            box-shadow: 0 8px 20px rgba(34, 197, 94, 0.2);
            max-width: 400px;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            border: 1px solid #6ee7b7;
        }

        .alert-success::before {
            content: '✓';
            background-color: #10b981;
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.875rem;
        }

        @keyframes fadeInOut {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            15% {
                opacity: 1;
                transform: translateY(0);
            }
            85% {
                opacity: 1;
                transform: translateY(0);
            }
            100% {
                opacity: 0;
                transform: translateY(-20px);
            }
        }
        .error-message {
            color: #dc2626;
            font-weight: 600;
            margin-top: 0.5rem;
            max-width: 900px;
            margin-left: auto;
        }
        /* Modal custom */
        .modal-header {
            border-bottom: none;
        }
        .modal-content {
            border-radius: 1rem;
        }
        .modal-footer {
            border-top: none;
            padding: 1rem 1.5rem;
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
        }
        .modal-footer .btn-modern {
            margin-top: 0;
        }
        .modal-footer button[data-bs-dismiss="modal"] {
            background: linear-gradient(90deg, #6b7280, #9ca3af);
        }
        .modal-footer button[data-bs-dismiss="modal"]:hover {
            background: linear-gradient(90deg, #4b5563, #6b7280);
        }
        .center-container {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            width: 100%;
        }
        .pdf-dropdown-btn[aria-expanded="true"] .fa-chevron-down {
            transform: rotate(180deg);
            transition: transform 0.2s;
        }
        .pdf-dropdown-btn .fa-chevron-down {
            transition: transform 0.2s;
        }
        /* Responsive iframe */
        .pdf-preview-frame {
            width: 100%;
            min-width: 350px;
            height: 650px;
            border-radius: 0.5rem;
            border: 1px solid #a78bfa;
            background: #fff;
        }
        @media (max-width: 1000px) {
            .card, .alert-success, .error-message { max-width: 100%; }
            .pdf-preview-frame { height: 400px; }
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
                <i class="fas fa-calendar-alt"></i> Test Registrant Data
            </a>
            <a href="{{ route('itc.upload_nilai') }}" class="sidebar-link {{ request()->routeIs('itc.upload_nilai') ? 'active' : '' }}">
                <i class="fas fa-file-pdf"></i> Upload TOEIC Score
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
    <h1>Upload TOEIC Score PDF</h1>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <div style="margin-left: 0; margin-bottom: 1.5rem;">
        <button type="button" class="btn-modern" data-bs-toggle="modal" data-bs-target="#uploadModal" style="margin-left:0;">
            <i class="fas fa-plus mr-2"></i> Upload New PDF
        </button>
    </div>

    <div class="center-container">
        @if(isset($pdfs) && count($pdfs) > 0)
            <div class="card mb-4 w-full">
                <h2 class="text-xl font-bold mb-3">TOEIC Score PDF List</h2>
                <ul style="list-style:none; padding:0;">
                    @foreach($pdfs as $pdf)
                        <li class="mb-2">
                            <button class="w-full flex items-center gap-2 font-semibold text-indigo-800 px-3 py-2 rounded-lg pdf-dropdown-btn"
                                style="background:#f6f3ff; box-shadow:0 2px 8px rgb(124 58 237 / 0.07); border:none; text-align:left;"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapsePdf{{ $pdf->nilai_toeic_id }}"
                                aria-expanded="false"
                                aria-controls="collapsePdf{{ $pdf->nilai_toeic_id }}">
                                <i class="fas fa-file-pdf text-purple-600"></i>
                                <span>{{ $pdf->judul }}</span>
                                <i class="fas fa-chevron-down ml-auto"></i>
                            </button>
                            <div class="collapse" id="collapsePdf{{ $pdf->nilai_toeic_id }}">
                                <div class="p-3">
                                    <iframe src="{{ asset('storage/' . $pdf->file_path) }}" class="pdf-preview-frame"></iframe>
                                    <form action="{{ route('itc.upload_nilai.destroy', $pdf->nilai_toeic_id) }}" 
                                        method="POST" 
                                        class="mt-3" 
                                        onsubmit="return confirm('Are you sure you want to delete this TOEIC Score PDF file?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" style="border-radius:0.3rem; font-size:0.95rem; padding:0.3rem 1rem;">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    {{-- Upload Modal --}}
    <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('itc.upload_nilai.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="uploadModalLabel">Upload TOEIC Score PDF</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="judul">Document Title</label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul') }}" placeholder="e.g., TOEIC Score Report">
                        @error('judul')
                            <div class="error-message">{{ $message }}</div>
                        @enderror

                        <label for="nilai_pdf" class="mt-3">Choose TOEIC Score PDF File</label>
                        <input type="file" name="nilai_pdf" id="nilai_pdf" accept="application/pdf" required>
                        @error('nilai_pdf')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-modern" style="background: #6b7280;" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn-modern">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@if ($errors->any())
<script>
    var uploadModal = new bootstrap.Modal(document.getElementById('uploadModal'));
    uploadModal.show();
</script>
@endif
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle success alerts
        const alerts = document.querySelectorAll('.alert-success');
        alerts.forEach(alert => {
            // Remove the alert from DOM after animation
            setTimeout(() => {
                alert.remove();
            }, 4000); // Match this with animation duration (4s)
        });
    });
</script>
</body>
</html>