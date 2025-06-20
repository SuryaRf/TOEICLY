<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOEIC Dashboard - Overview</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

        .sidebar {
            background: linear-gradient(180deg, #4c1d95 0%, #7c3aed 100%);
            color: white;
            min-height: 100vh;
            width: 260px;
            position: fixed;
            top: 0;
            left: 0;
            transition: width 0.3s ease, transform 0.3s ease;
            box-shadow: 4px 0 20px rgba(124, 58, 237, 0.3);
            z-index: 1000;
            font-family: 'Poppins', sans-serif;
            overflow-y: auto;
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar .brand {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }

        .sidebar .brand h2 {
            font-size: 1.8rem;
            font-weight: 700;
            letter-spacing: 2px;
            background: linear-gradient(90deg, #a78bfa, #ffffff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .sidebar .toggle-btn {
            display: none;
            position: absolute;
            top: 1.5rem;
            right: -1.5rem;
            background: #7c3aed;
            color: white;
            border: none;
            border-radius: 50%;
            width: 2rem;
            height: 2rem;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            z-index: 1001;
        }

        .sidebar ul {
            padding: 1.5rem 0;
            margin: 0;
            list-style: none;
        }

        .sidebar li {
            margin: 0.5rem 0;
        }

        .sidebar a,
        .sidebar button {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.25rem;
            font-size: 0.95rem;
            font-weight: 600;
            color: #e2e8f0;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
        }

        .sidebar a:hover,
        .sidebar button:hover,
        .sidebar a.active,
        .sidebar button.active {
            background: rgba(255, 255, 255, 0.15);
            color: #ffffff;
            transform: translateX(5px);
            box-shadow: 0 4px 15px rgba(167, 139, 250, 0.3);
        }

        .sidebar i {
            font-size: 1.2rem;
            margin-right: 1rem;
            transition: transform 0.3s ease;
        }

        .sidebar a:hover i,
        .sidebar button:hover i {
            transform: scale(1.2) rotate(5deg);
            color: #a78bfa;
        }

        .sidebar.collapsed a span,
        .sidebar.collapsed button span {
            display: none;
        }

        .sidebar.collapsed a,
        .sidebar.collapsed button {
            justify-content: center;
            padding: 0.75rem;
        }

        .sidebar.collapsed i {
            margin-right: 0;
        }

        .main-content {
            margin-left: 260px;
            transition: margin-left 0.3s ease;
            padding: 2rem;
            background: linear-gradient(135deg, #f3e8ff 0%, #e0f2fe 100%);
            min-height: 100vh;
            width: calc(100% - 260px);
            box-sizing: border-box;
        }

        .main-content.collapsed {
            margin-left: 80px;
            width: calc(100% - 80px);
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-260px);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .sidebar .toggle-btn {
                display: block;
            }

            .main-content {
                margin-left: 0;
                width: 100%;
            }

            .main-content.collapsed {
                margin-left: 0;
                width: 100%;
            }
        }

        .fade-slide {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }

        .fade-slide.show {
            opacity: 1;
            transform: translateY(0);
        }

        .bounce {
            animation: bounce 1s ease infinite;
        }

        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        .card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(124, 58, 237, 0.2);
        }

        .full-width {
            width: 100%;
            max-width: 100%;
        }

        .pdf-iframe {
            width: 100%;
            min-height: 600px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
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
    <div class="flex min-h-screen">
        @include('dashboard.mahasiswa.sidebar')

        <main id="overview" class="main-content fade-slide">
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg shadow-lg full-width">
                    {{ session('success') }}
                </div>
            @endif

            <h1 class="text-4xl font-bold text-purple-900 mb-4">Welcome to TOEIC Dashboard!</h1>
            <p class="text-lg text-gray-600 mb-8">Track your TOEIC test performance and upcoming schedules.</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8 full-width">
                @for ($i = 0; $i < 3; $i++)
                    @if (isset($informasis[$i]))
                        <div class="card rounded-xl p-6">
                            <h3 class="text-xl font-semibold text-purple-800 mb-2">{{ $informasis[$i]->judul }}</h3>
                            <p class="text-lg text-gray-900">{{ Str::limit($informasis[$i]->isi, 50) }}</p>
                            <p class="text-sm text-gray-500 mt-1">Posted on {{ optional($informasis[$i]->created_at)->format('d M Y') ?? '-' }}</p>
                        </div>
                    @else
                        <div class="card rounded-xl p-6">
                            <h3 class="text-xl font-semibold text-purple-800 mb-2">No Information</h3>
                            <p class="text-lg text-gray-900">-</p>
                            <p class="text-sm text-gray-500 mt-1">-</p>
                        </div>
                    @endif
                @endfor
            </div>

            <section class="card rounded-xl p-8 mb-8 full-width">
                <h2 class="text-2xl font-semibold text-purple-800 mb-6">Available Certificate Schedules</h2>
                @if(isset($jadwals) && $jadwals->isNotEmpty())
                    <ul>
                        @foreach ($jadwals as $jadwal)
                            <li class="mb-6">
                                <h3 class="text-xl font-semibold text-purple-800">{{ $jadwal->judul }}</h3>
                                <p class="text-gray-600">{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d M Y') }}</p>
                                @if($jadwal->file_pdf)
                                    <iframe
                                        src="{{ route('mahasiswa.certificate.view', ['filename' => basename($jadwal->file_pdf)]) }}#toolbar=0&navpanes=0&scrollbar=0"
                                        class="pdf-iframe" title="PDF Schedule: {{ $jadwal->judul }}">
                                        <p class="text-gray-600">
                                            Your browser does not support PDFs or the file failed to load.
                                            <a href="{{ route('mahasiswa.certificate.view', ['filename' => basename($jadwal->file_pdf)]) }}"
                                                class="text-blue-600 hover:underline" target="_blank">
                                                View PDF instead.
                                            </a>
                                        </p>
                                    </iframe>
                                    <a href="{{ route('mahasiswa.certificate.view', ['filename' => basename($jadwal->file_pdf)]) }}?download=1"
                                        class="download-btn">
                                        Download PDF
                                    </a>
                                @else
                                    <p class="text-gray-500">No PDF uploaded.</p>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500">No schedules available.</p>
                @endif
            </section>

            <section class="card rounded-xl p-8 mb-8 full-width">
                <h2 class="text-2xl font-semibold text-purple-800 mb-6">TOEIC Score Reports</h2>
                @if(isset($nilaiToeics) && $nilaiToeics->isNotEmpty())
                    <ul>
                        @foreach ($nilaiToeics as $nilai)
                            <li class="mb-6">
                                <h3 class="text-xl font-semibold text-purple-800">{{ $nilai->judul }}</h3>
                                <p class="text-gray-600">Uploaded on {{ optional($nilai->created_at)->format('d M Y') ?? '-' }}</p>
                                @if($nilai->file_path)
                                    <iframe
                                        src="{{ route('itc.nilai.view', ['filename' => basename($nilai->file_path)]) }}#toolbar=0&navpanes=0&scrollbar=0"
                                        class="pdf-iframe" title="PDF TOEIC Score: {{ $nilai->judul }}">
                                        <p class="text-gray-600">
                                            Your browser does not support PDFs or the file failed to load.
                                            <a href="{{ route('itc.nilai.view', ['filename' => basename($nilai->file_path)]) }}"
                                                class="text-blue-600 hover:underline" target="_blank">
                                                View PDF instead.
                                            </a>
                                        </p>
                                    </iframe>
                                    <a href="{{ route('itc.nilai.view', ['filename' => basename($nilai->file_path)]) }}?download=1"
                                        class="download-btn">
                                        Download PDF
                                    </a>
                                @else
                                    <p class="text-gray-500">No PDF uploaded.</p>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500">No TOEIC score reports available.</p>
                @endif
            </section>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.querySelector('.main-content');
            sidebar.classList.toggle('active');
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('collapsed');
        }

        window.addEventListener('load', () => {
            const overview = document.getElementById('overview');
            setTimeout(() => {
                overview.classList.add('show');
            }, 100);
        });
    </script>
</body>
</html>