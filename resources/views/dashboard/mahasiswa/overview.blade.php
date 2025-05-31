<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOEIC Dashboard - Overview</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

        /* Sidebar Styles */
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

        /* Apply these styles consistently to both links and buttons */
        .sidebar a, .sidebar button {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.25rem;
            font-size: 0.95rem;
            font-weight: 600;
            color: #e2e8f0;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            position: relative; /* Crucial for the extend effect */
            overflow: hidden; /* Crucial for the extend effect */
            background: none; /* Reset button default background */
            border: none; /* Reset button default border */
            width: 100%; /* Make button take full width of its parent li */
            text-align: left; /* Align text to the left for consistency */
            cursor: pointer; /* Indicate it's clickable */
        }

        .sidebar a:hover, .sidebar button:hover, .sidebar a.active, .sidebar button.active {
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

        .sidebar a:hover i, .sidebar button:hover i {
            transform: scale(1.2) rotate(5deg);
            color: #a78bfa;
        }

        .sidebar.collapsed a span, .sidebar.collapsed button span {
            display: none;
        }

        .sidebar.collapsed a, .sidebar.collapsed button {
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
            width: calc(100% - 260px); /* Ensure main-content takes remaining width */
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

        /* Additional Dashboard Styles */
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

        /* Ensure grid and sections stretch to full width */
        .full-width {
            width: 100%;
            max-width: 100%;
        }
    </style>
</head>
<body>
    <div class="flex min-h-screen">
        <aside class="sidebar" id="sidebar">
            <button class="toggle-btn" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            <div class="brand">
                <h2>TOEICLY</h2>
            </div>
            <ul>
                <li>
                    <a href="{{ route('mahasiswa.dashboard') }}"
                       class="{{ request()->routeIs('mahasiswa.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home"></i>
                        <span>OVERVIEW</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('mahasiswa.profile') }}"
                       class="{{ request()->routeIs('mahasiswa.profile') ? 'active' : '' }}">
                        <i class="fas fa-user"></i>
                        <span>PROFIL</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('mahasiswa.daftar-tes') }}"
                       class="{{ request()->routeIs('mahasiswa.daftar-tes') ? 'active' : '' }}">
                        <i class="fas fa-file-alt"></i>
                        <span>DAFTAR TES</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('mahasiswa.riwayat-ujian') }}"
                       class="{{ request()->routeIs('mahasiswa.riwayat-ujian') ? 'active' : '' }}">
                        <i class="fas fa-history"></i>
                        <span>RIWAYAT UJIAN</span>
                    </a>
                </li>
                <li>
                    <form action="{{ route('mahasiswa.logout') }}" method="POST">
                        @csrf
                        {{-- The button now explicitly gets the same styling as 'a' tags --}}
                        <button type="submit">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>LOGOUT</span>
                        </button>
                    </form>
                </li>
            </ul>
        </aside>

        <main id="overview" class="main-content fade-slide">
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg shadow-lg full-width">
                    {{ session('success') }}
                </div>
            @endif

            <h1 class="text-4xl font-bold text-purple-900 mb-4">Welcome to TOEIC Dashboard!</h1>
            <p class="text-lg text-gray-600 mb-8">Track your TOEIC test performance and upcoming schedules.</p>

            <section class="card rounded-xl p-8 mb-8 full-width">
                <h2 class="text-2xl font-semibold text-purple-800 mb-6">Your TOEIC Information</h2>
                @if ($toeicScore)
                    <div class="space-y-4 text-gray-700">
                        <div>
                            <span class="font-semibold text-purple-800">Latest Score:</span>
                            <span class="text-2xl font-bold text-green-600">{{ $toeicScore->score }}</span>
                        </div>
                        <div>
                            <span class="font-semibold text-purple-800">Certificate Date:</span>
                            <span>{{ \Carbon\Carbon::parse($toeicScore->certificate_date)->translatedFormat('d F Y') }}</span>
                        </div>
                        <div>
                            <span class="font-semibold text-purple-800">Certificate PDF:</span>
                            @if ($toeicScore->certificate_pdf)
                                <a href="{{ asset('storage/' . $toeicScore->certificate_pdf) }}"
                                   class="text-blue-600 underline hover:text-blue-800" target="_blank">View Certificate</a>
                            @else
                                <span class="text-red-500">Not available</span>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="space-y-4 text-gray-700">
                        <p class="text-lg text-purple-700 font-semibold mb-2">No past TOEIC data available yet. Here's what you need to know:</p>
                        <div>
                            <span class="font-semibold text-purple-800">Latest Test Score:</span>
                            <span>Awaiting result for your most recent test.</span>
                        </div>
                        <div>
                            <span class="font-semibold text-purple-800">Next Certificate Collection:</span>
                            <span class="text-green-600">Available from June 15, 2025 (9:00 AM - 4:00 PM)</span>
                        </div>
                        <div>
                            <span class="font-semibold text-purple-800">Collection Location:</span>
                            <span>Main Office, Building A, Room 101</span>
                        </div>
                        <p class="text-sm text-gray-500 mt-2">Please ensure you bring your ID for certificate collection.</p>
                    </div>
                @endif
            </section>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8 full-width">
                <div class="card rounded-xl p-6">
                    <h3 class="text-xl font-semibold text-purple-800 mb-2">Total Tests Taken</h3>
                    <p class="text-4xl font-bold text-gray-900">5</p>
                    <p class="text-sm text-gray-500 mt-1">Tests completed</p>
                </div>
                <div class="card rounded-xl p-6">
                    <h3 class="text-xl font-semibold text-purple-800 mb-2">Highest Score</h3>
                    <p class="text-4xl font-bold text-green-600">945</p>
                    <p class="text-sm text-gray-500 mt-1">Best TOEIC score</p>
                </div>
                <div class="card rounded-xl p-6">
                    <h3 class="text-xl font-semibold text-purple-800 mb-2">Next Test Date</h3>
                    <p class="text-4xl font-bold text-red-600">20 May 2025</p>
                    <p class="text-sm text-gray-500 mt-1">Mark your calendar!</p>
                </div>
            </div>

            <section class="card rounded-xl p-8 mb-8 full-width">
                <h2 class="text-2xl font-semibold text-purple-800 mb-6">Score Trends</h2>
                <canvas id="scoresChart" class="w-full h-64 bounce"></canvas>
            </section>
        </main>
    </div>

    <script>
        // Sidebar Toggle
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.querySelector('.main-content');
            sidebar.classList.toggle('active');
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('collapsed');
        }

        // Fade-Slide Animation on Load
        window.addEventListener('load', () => {
            const overview = document.getElementById('overview');
            setTimeout(() => {
                overview.classList.add('show');
            }, 100);

            // Chart.js Setup
            const ctx = document.getElementById('scoresChart').getContext('2d');
            const scoresChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
                    datasets: [{
                        label: 'TOEIC Scores',
                        data: [880, 900, 920, 930, 945],
                        fill: true,
                        backgroundColor: 'rgba(124, 58, 237, 0.2)',
                        borderColor: 'rgba(124, 58, 237, 1)',
                        tension: 0.3,
                        pointBackgroundColor: 'rgba(124, 58, 237, 1)',
                        pointRadius: 5,
                        borderWidth: 3,
                        borderRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: false,
                            min: 800,
                            max: 1000,
                            ticks: {
                                stepSize: 50
                            }
                        }
                    },
                    animation: {
                        duration: 1200,
                        easing: 'easeOutQuart'
                    },
                    plugins: {
                        legend: {
                            labels: {
                                font: {
                                    size: 14,
                                    weight: 'bold'
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>