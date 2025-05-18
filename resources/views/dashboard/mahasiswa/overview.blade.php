<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <title>Daftar Tes - TOEICLY</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }
        .fade-in.show {
            opacity: 1;
            transform: translateY(0);
        }
        .zoom-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .zoom-card:hover {
            transform: scale(1.05);
            box-shadow: 0 20px 40px rgba(124, 58, 237, 0.3);
=======
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
>>>>>>> e66727d1e9ccd1ec5dba2160ca0f4708b6904d96
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-100 via-purple-100 to-pink-100 min-h-screen">

<div class="flex h-screen">
    <!-- Sidebar -->
    @include('dashboard.mahasiswa.sidebar')

    <!-- Main Content -->
<<<<<<< HEAD
    <main id="daftar-tes" class="flex-1 p-10 overflow-auto fade-in">
        <h1 class="text-4xl font-bold text-purple-800 mb-6">Daftar Tes</h1>
        <div class="bg-white p-8 rounded-xl shadow-lg zoom-card">
            <table class="w-full text-left text-gray-700">
                <thead>
                    <tr>
                        <th class="py-4 px-6 bg-purple-600 text-white">Test Name</th>
                        <th class="py-4 px-6 bg-purple-600 text-white">Date</th>
                        <th class="py-4 px-6 bg-purple-600 text-white">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-gray-100 hover:bg-purple-50 transition-colors">
                        <td class="py-4 px-6">TOEIC Practice Test 1</td>
                        <td class="py-4 px-6">20 May 2025</td>
                        <td class="py-4 px-6">
                            <button class="bg-purple-600 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-purple-700 transition-colors bounce-on-hover">
                                Register
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
=======
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
>>>>>>> e66727d1e9ccd1ec5dba2160ca0f4708b6904d96
    </main>
</div>

<script>
<<<<<<< HEAD
    // Add fade-in effect on page load
    window.addEventListener('load', () => {
        const daftarTes = document.getElementById('daftar-tes');
        setTimeout(() => {
            daftarTes.classList.add('show');
        }, 100);
=======
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
>>>>>>> e66727d1e9ccd1ec5dba2160ca0f4708b6904d96
    });
</script>

</body>
<<<<<<< HEAD
</html>
=======
</html>
>>>>>>> e66727d1e9ccd1ec5dba2160ca0f4708b6904d96
