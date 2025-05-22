<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOEIC Dashboard - Overview</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
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
    </style>
</head>
<body class="bg-gradient-to-br from-blue-100 via-purple-100 to-pink-100 min-h-screen">

<div class="flex h-screen">
    <!-- Sidebar -->
    @include('dashboard.mahasiswa.sidebar')

    <!-- Main Content -->
    <main id="overview" class="flex-1 p-10 overflow-auto fade-slide">
        <h1 class="text-4xl font-bold text-purple-800 mb-6">Welcome to TOEIC Dashboard!</h1>
        <p class="text-lg text-gray-700 mb-10">Your TOEIC test overview and performance charts.</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
            <div class="bg-white rounded-xl shadow-lg p-6 hover:-translate-y-2 transition-transform duration-300">
                <h3 class="text-xl font-semibold text-purple-700 mb-2">Total Tests Taken</h3>
                <p class="text-4xl font-bold text-gray-800">5</p>
                <p class="text-sm text-gray-500 mt-1">Tests completed</p>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6 hover:-translate-y-2 transition-transform duration-300">
                <h3 class="text-xl font-semibold text-purple-700 mb-2">Highest Score</h3>
                <p class="text-4xl font-bold text-green-600">945</p>
                <p class="text-sm text-gray-500 mt-1">Best TOEIC score</p>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6 hover:-translate-y-2 transition-transform duration-300">
                <h3 class="text-xl font-semibold text-purple-700 mb-2">Next Test Date</h3>
                <p class="text-4xl font-bold text-red-600">20 May 2025</p>
                <p class="text-sm text-gray-500 mt-1">Mark your calendar!</p>
            </div>
        </div>

        <section class="bg-white p-8 rounded-xl shadow-lg hover:scale-105 transition-transform duration-300">
            <h2 class="text-2xl font-semibold text-purple-700 mb-6">Score Trends</h2>
            <canvas id="scoresChart" class="w-full h-64 bounce"></canvas>
        </section>

        <!-- Tambahan: Informasi TOEIC dan Sertifikat -->
        <section class="bg-white mt-10 p-8 rounded-xl shadow-lg hover:scale-105 transition-transform duration-300">
            <h2 class="text-2xl font-semibold text-purple-700 mb-6">Informasi TOEIC Anda</h2>

            @if ($toeicScore)
                <div class="space-y-4 text-gray-700">
                    <div>
                        <span class="font-semibold text-purple-800">Skor Terakhir:</span>
                        <span class="text-2xl font-bold text-green-600">{{ $toeicScore->score }}</span>
                    </div>
                    <div>
                        <span class="font-semibold text-purple-800">Tanggal Sertifikat:</span>
                        <span>{{ \Carbon\Carbon::parse($toeicScore->certificate_date)->translatedFormat('d F Y') }}</span>
                    </div>
                    <div>
                        <span class="font-semibold text-purple-800">Sertifikat PDF:</span>
                        @if ($toeicScore->certificate_pdf)
                            <a href="{{ asset('storage/' . $toeicScore->certificate_pdf) }}"
                               class="text-blue-600 underline hover:text-blue-800" target="_blank">Lihat Sertifikat</a>
                        @else
                            <span class="text-red-500">Belum tersedia</span>
                        @endif
                    </div>
                </div>
            @else
                <p class="text-red-600">Belum ada data TOEIC yang tersedia untuk ditampilkan.</p>
            @endif
        </section>
    </main>
</div>

<script>
    // Add fade-slide effect on page load
    window.addEventListener('load', () => {
        const overview = document.getElementById('overview');
        setTimeout(() => {
            overview.classList.add('show');
        }, 100);

        // Chart.js setup
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
