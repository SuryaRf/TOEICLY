<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Dashboard - TOEIC Management</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
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
            transition: all 0.3s ease;
            color: inherit;
            text-decoration: none;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .sidebar a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.5s;
        }

        .sidebar a:hover::before {
            left: 100%;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: rgba(255, 255, 255, 0.3);
            transform: translateX(8px);
            box-shadow: 0 4px 15px rgb(139 92 246 / 0.5);
            color: white !important;
        }

        .sidebar i {
            min-width: 1.25rem;
            font-size: 1.2rem;
            margin-right: 0.75rem;
            transition: transform 0.3s ease;
        }

        .sidebar a:hover i {
            transform: rotate(15deg) scale(1.3);
            color: #e0e7ff;
        }

        main {
            margin-left: 16rem;
            padding: 2.5rem;
            min-height: 100vh;
            overflow-y: auto;
            position: relative;
        }

        .welcome-message {
            background: linear-gradient(90deg, #7c3aed, #a78bfa);
            color: white;
            padding: 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 6px 15px rgb(124 58 237 / 0.3);
            margin-bottom: 2rem;
            animation: slideIn 1s ease-out;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .welcome-message h2 {
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0;
        }

        .welcome-message p {
            margin: 0.5rem 0 0;
            font-size: 1rem;
            opacity: 0.9;
        }

        .welcome-message .icon {
            font-size: 2rem;
            animation: pulse 2s infinite;
        }

        .card {
            background-color: #fff;
            border-radius: 1rem;
            box-shadow: 0 6px 15px rgb(0 0 0 / 0.08);
            padding: 1.5rem;
            transition: all 0.4s ease;
            cursor: default;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            animation: fadeInUp 0.8s ease-out;
        }

        .card:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 12px 25px rgb(124 58 237 / 0.3);
            cursor: pointer;
        }

        .text-primary {
            color: #7c3aed;
        }

        .text-accent {
            color: #a78bfa;
        }

        .btn-moderns {
            background: linear-gradient(90deg, #7c3aed, #a78bfa);
            border: none;
            font-weight: 600;
            padding: 0.75rem 1.75rem;
            border-radius: 0.75rem;
            color: white;
            box-shadow: 0 4px 12px rgb(124 58 237 / 0.4);
            transition: all 0.3s ease;
            align-self: flex-start;
            position: relative;
            overflow: hidden;
        }

        .btn-moderns::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: 0.5s;
        }

        .btn-moderns:hover::before {
            left: 100%;
        }

        .btn-moderns:hover {
            background: linear-gradient(90deg, #a78bfa, #7c3aed);
            transform: scale(1.1);
            box-shadow: 0 8px 20px rgb(124 58 237 / 0.7);
            color: white;
        }

        .chart-bar {
            border-radius: 0.5rem 0.5rem 0 0;
            transition: all 0.5s ease;
            cursor: pointer;
            box-shadow: inset 0 -4px 8px rgb(0 0 0 / 0.1);
        }

        .chart-bar:hover {
            height: 130% !important;
            background-color: #8b5cf6;
            box-shadow: 0 0 12px #8b5cf6;
        }

        main::-webkit-scrollbar {
            width: 8px;
        }

        main::-webkit-scrollbar-track {
            background: transparent;
        }

        main::-webkit-scrollbar-thumb {
            background: #a78bfa;
            border-radius: 10px;
        }

        .dropdown-menu {
            position: absolute;
            top: 120%;
            right: 0;
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 8px 20px rgb(0 0 0 / 0.15);
            width: 12rem;
            opacity: 0;
            pointer-events: none;
            transition: all 0.3s ease;
            z-index: 100;
        }

        .dropdown-menu.active {
            opacity: 1;
            pointer-events: auto;
        }

        .dropdown-menu a {
            display: block;
            padding: 0.75rem 1rem;
            font-weight: 600;
            color: #4b5563;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .dropdown-menu a:hover {
            background-color: #f3e8ff;
            color: #7c3aed;
        }

        .btn-modern {
            background: linear-gradient(90deg, #ffffff, #e0e7ff);
            border: none;
            font-weight: 600;
            padding: 0.5rem 1.5rem;
            border-radius: 0.75rem;
            color: #7c3aed;
            box-shadow: 0 4px 12px rgb(124 58 237 / 0.4);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-modern:hover {
            background: linear-gradient(90deg, #e0e7ff, #ffffff);
            transform: scale(1.08);
            box-shadow: 0 8px 20px rgb(124 58 237 / 0.7);
            color: #6d28d9;
        }

        .btn-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: 0.5s;
        }

        .btn-modern:hover::before {
            left: 100%;
        }

        @keyframes slideIn {
            from {
                transform: translateX(-100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.2);
            }
            100% {
                transform: scale(1);
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    @include('dashboard.admin.sidebar')

    <!-- Main content -->
    <main>
        <!-- Welcome Message -->
        <div class="welcome-message">
            <div>
                <h2>Welcome, {{ Auth::user()->name }}! 🚀</h2>
                <p>Ready to manage your TOEIC platform? Let's make today productive!</p>
            </div>
            <i class="fas fa-rocket icon"></i>
        </div>

        <!-- Header -->
        <header class="flex justify-between items-center mb-12 bg-gradient-to-r from-purple-600 to-indigo-600 text-white p-6 rounded-xl shadow-lg transform transition-all duration-500 hover:shadow-2xl">
            <div class="flex flex-col">
                <h1 class="text-5xl font-extrabold tracking-tight animate-fadeInDown">Admin Dashboard</h1>
                <p class="text-lg font-medium mt-2 opacity-90 animate-fadeInUp">Manage your TOEIC platform with ease</p>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-sm font-semibold bg-white text-purple-600 px-3 py-1 rounded-full shadow-md">
                    {{ now()->format('M d, Y') }}
                </span>
                <button class="btn-modern flex items-center space-x-2">
                    <i class="fas fa-sync-alt"></i>
                    <span>Refresh Data</span>
                </button>
            </div>
        </header>

        <!-- User Statistics Section -->
        <div class="mb-12">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900 tracking-tight animate-fadeInDown">User Statistics</h2>
                <p class="text-gray-600 mt-2">Key metrics to monitor user engagement</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Total Users Card -->
                <section class="card">
                    <p class="text-gray-600 font-semibold">Total Users! 🎉</p>
                    <p class="text-4xl font-extrabold mt-3 text-primary">{{ $totalUsers }}</p>
                    <p class="text-sm text-gray-500 mt-1">All registered users</p>
                    <a href="{{ route('admin.manage') }}" class="btn-moderns mt-5 text-white">View Details</a>
                </section>

                <!-- Admin Users Card -->
                <section class="card">
                    <p class="text-gray-600 font-semibold"><i class="fas fa-user-shield mr-2"></i>Admin Users</p>
                    <p class="text-4xl font-extrabold mt-3 text-primary">{{ $userCountsByRole['admin'] }}</p>
                    <p class="text-sm text-gray-500 mt-1">System administrators</p>
                    <a href="{{ route('admin.manage') }}" class="btn-moderns mt-5 text-white">View Details</a>
                </section>

                <!-- Mahasiswa Users Card -->
                <section class="card">
                    <p class="text-gray-600 font-semibold"><i class="fas fa-user-graduate mr-2"></i>Mahasiswa Users</p>
                    <p class="text-4xl font-extrabold mt-3 text-primary">{{ $userCountsByRole['mahasiswa'] }}</p>
                    <p class="text-sm text-gray-500 mt-1">Student users</p>
                    <a href="{{ route('admin.manage') }}" class="btn-moderns mt-5 text-white">View Details</a>
                </section>

                <!-- Dosen Users Card -->
                <section class="card">
                    <p class="text-gray-600 font-semibold"><i class="fas fa-chalkboard-teacher mr-2"></i>Dosen Users</p>
                    <p class="text-4xl font-extrabold mt-3 text-primary">{{ $userCountsByRole['dosen'] }}</p>
                    <p class="text-sm text-gray-500 mt-1">Lecturer users</p>
                    <a href="{{ route('admin.manage') }}" class="btn-moderns mt-5 text-white">View Details</a>
                </section>

                <!-- Tendik Users Card -->
                <section class="card">
                    <p class="text-gray-600 font-semibold"><i class="fas fa-user-tie mr-2"></i>Tendik Users</p>
                    <p class="text-4xl font-extrabold mt-3 text-primary">{{ $userCountsByRole['tendik'] }}</p>
                    <p class="text-sm text-gray-500 mt-1">Staff users</p>
                    <a href="{{ route('admin.manage') }}" class="btn-moderns mt-5 text-white">View Details</a>
                </section>

                <!-- ITC Users Card -->
                <section class="card">
                    <p class="text-gray-600 font-semibold"><i class="fas fa-user-cog mr-2"></i>ITC Users</p>
                    <p class="text-4xl font-extrabold mt-3 text-primary">{{ $userCountsByRole['itc'] }}</p>
                    <p class="text-sm text-gray-500 mt-1">ITC staff users</p>
                    <a href="{{ route('admin.manage') }}" class="btn-moderns mt-5 text-white">View Details</a>
                </section>
            </div>
        </div>

        <!-- Test Statistics Section -->
        <div class="mb-12">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900 tracking-tight animate-fadeInDown">Test Statistics</h2>
                <p class="text-gray-600 mt-2">Key metrics to monitor test registrations</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Monthly Test Registrations Chart Card -->
                <section class="card flex flex-col">
                    <p class="text-gray-600 font-semibold mb-4">Test Registrations (Last 12 Months)</p>
                    <div class="w-full h-64">
                        <canvas id="monthlyChart"></canvas>
                    </div>
                </section>

                <!-- Verification Status Pie Chart Card -->
                <section class="card flex flex-col">
                    <p class="text-gray-600 font-semibold mb-4">Verification Status Distribution</p>
                    <div class="w-full h-64">
                        <canvas id="statusPieChart"></canvas>
                    </div>
                </section>
            </div>
        </div>
    </main>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Monthly Registrations Bar Chart
        const ctxMonthly = document.getElementById('monthlyChart').getContext('2d');
        const monthlyChart = new Chart(ctxMonthly, {
            type: 'bar',
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'Total Registrations',
                    data: @json($data),
                    backgroundColor: 'rgba(124, 58, 237, 0.7)',
                    borderColor: 'rgba(124, 58, 237, 1)',
                    borderWidth: 1,
                    borderRadius: 8,
                    hoverBackgroundColor: 'rgba(139, 92, 246, 0.9)',
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                size: 14,
                                weight: 'bold'
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Monthly Test Registrations (Last 12 Months)',
                        font: {
                            size: 18,
                            weight: 'bold'
                        },
                        padding: {
                            top: 10,
                            bottom: 20
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(124, 58, 237, 0.9)',
                        titleFont: { size: 14 },
                        bodyFont: { size: 12 },
                        cornerRadius: 8
                    }
                },
                animation: {
                    duration: 1500,
                    easing: 'easeOutBounce'
                }
            }
        });

        // Verification Status Pie Chart
        const ctxStatus = document.getElementById('statusPieChart').getContext('2d');
        const statusPieChart = new Chart(ctxStatus, {
            type: 'pie',
            data: {
                labels: ['Diterima', 'Ditolak'],
                datasets: [{
                    label: 'Verification Status',
                    data: [
                        // @json($verificationStatusCounts['menunggu']),
                        @json($verificationStatusCounts['diterima']),
                        @json($verificationStatusCounts['ditolak'])
                    ],
                    backgroundColor: [
                        
                        'rgba(75, 192, 192, 0.7)', // Diterima (Teal)
                        'rgba(255, 99, 132, 0.7)'  // Ditolak (Red)
                    ],
                    borderColor: [
                        
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                size: 14,
                                weight: 'bold'
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Verification Status Distribution',
                        font: {
                            size: 18,
                            weight: 'bold'
                        },
                        padding: {
                            top: 10,
                            bottom: 20
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(124, 58, 237, 0.9)',
                        titleFont: { size: 14 },
                        bodyFont: { size: 12 },
                        cornerRadius: 8
                    }
                },
                animation: {
                    duration: 1500,
                    easing: 'easeOutBounce'
                }
            }
        });
    </script>
</body>
</html>