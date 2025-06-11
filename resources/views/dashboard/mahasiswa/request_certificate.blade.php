<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Certificate Request - TOEICLY</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            background: #ffffff;
            color: #1f2937;
            min-height: 100vh;
            margin: 0;
            font-family: 'Montserrat', sans-serif;
        }
        .main-content {
            margin-left: 15.5rem;
            padding: 2rem 3rem;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }
        .card {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(124, 58, 237, 0.2);
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(124, 58, 237, 0.1);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .btn-modern {
            background: linear-gradient(90deg, #6b21a8, #a78bfa);
            color: #ffffff;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(107, 33, 168, 0.3);
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        .btn-modern:hover {
            background: linear-gradient(90deg, #5b1890, #8b5cf6);
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(107, 33, 168, 0.4);
        }
        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            font-weight: 500;
        }
        .pdf-iframe {
            width: 100%;
            min-height: 600px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 1rem;
        }
        .download-btn {
            display: inline-block;
            margin-top: 0.5rem;
            padding: 0.5rem 1rem;
            background-color: #7c3aed;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }
        .download-btn:hover {
            background-color: #6b21a8;
        }
    </style>
</head>
<body>
    @include('dashboard.mahasiswa.sidebar')

    <main class="main-content">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Certificate Request</h1>

        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <section class="card rounded-xl p-8 mb-8 full-width">
            <h2 class="text-2xl font-semibold text-purple-800 mb-6">Sample Certificate Letter</h2>
            <iframe
                src="{{ route('mahasiswa.request_certificate.sample') }}#toolbar=0&navpanes=0&scrollbar=0"
                class="pdf-iframe" title="Sample Certificate Letter">
                <p class="text-gray-600">
                    Your browser does not support PDFs or the file failed to load.
                    <a href="{{ route('mahasiswa.request_certificate.sample') }}"
                       class="text-blue-600 hover:underline" target="_blank">
                        View PDF instead.
                    </a>
                </p>
            </iframe>
            <a href="{{ route('mahasiswa.request_certificate.sample') }}?download=1"
               class="download-btn">
                Download Sample PDF
            </a>
        </section>

        @if($registrations->isEmpty())
            <p class="text-gray-600">No registrations available to request a certificate.</p>
        @else
            @foreach($registrations as $registration)
                <div class="card">
                    <h2 class="text-xl font-semibold text-gray-700 mb-2">{{ $registration->jadwal->judul ?? 'No Schedule' }}</h2>
                    <p class="text-gray-600 mb-2">Registration Date: {{ \Carbon\Carbon::parse($registration->tanggal_pendaftaran)->format('d-m-Y') }}</p>
                    <p class="text-gray-600 mb-2">Note: The certificate letter will be provided after admin approval.</p>
                    <form action="{{ route('mahasiswa.requestCertificate', $registration->pendaftaran_id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn-modern">Request Certificate Letter</button>
                    </form>
                </div>
            @endforeach
        @endif
    </main>
</body>
</html>