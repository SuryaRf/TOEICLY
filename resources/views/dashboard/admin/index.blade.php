<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Dashboard - TOEIC Management</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(135deg, #eef2ff 0%, #dbeafe 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
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
            cursor: default;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgb(124 58 237 / 0.25);
            cursor: pointer;
        }

        .text-primary {
            color: #7c3aed;
        }

        .text-accent {
            color: #a78bfa;
        }

        .btn-modern {
            background: linear-gradient(90deg, #7c3aed, #a78bfa);
            border: none;
            font-weight: 600;
            padding: 0.5rem 1.5rem;
            border-radius: 0.75rem;
            color: white;
            box-shadow: 0 4px 12px rgb(124 58 237 / 0.4);
            transition: all 0.3s ease;
            align-self: flex-start;
        }

        .btn-modern:hover {
            background: linear-gradient(90deg, #a78bfa, #7c3aed);
            transform: scale(1.08);
            box-shadow: 0 8px 20px rgb(124 58 237 / 0.7);
            text-decoration: none;
            color: white;
        }

        .chart-bar {
            border-radius: 0.5rem 0.5rem 0 0;
            transition: height 0.5s ease, background-color 0.3s ease;
            cursor: pointer;
            box-shadow: inset 0 -4px 8px rgb(0 0 0 / 0.1);
        }

        .chart-bar:hover {
            height: 120% !important;
            background-color: #9333ea;
            box-shadow: 0 0 10px #9333ea;
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

        .user-profile img {
            border: 2px solid #7c3aed;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .user-profile img:hover {
            transform: scale(1.1);
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
            transition: opacity 0.3s ease;
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
            transition: background-color 0.3s ease;
        }

        .dropdown-menu a:hover {
            background-color: #f3e8ff;
            color: #7c3aed;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar flex flex-col">
        <div class="p-6">
            <h2 class="text-4xl font-extrabold tracking-tight select-none">TOEICLY Admin</h2>
        </div>
        <nav class="mt-8 flex flex-col gap-2 px-2">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a href="{{ route('admin.manage') }}" class="sidebar-link {{ request()->routeIs('admin.manage') ? 'active' : '' }}">
                <i class="fas fa-users"></i> Manajemen Pengguna
            </a>
            <a href="{{ route('jadwal_sertifikat.index') }}" class="sidebar-link {{ request()->routeIs('jadwal_sertifikat.*') ? 'active' : '' }}">
                <i class="fas fa-calendar-alt"></i> Kelola Jadwal Sertifikat
            </a>
            <a href="{{ route('admin.pendaftar') }}" class="sidebar-link {{ request()->routeIs('admin.pendaftar') ? 'active' : '' }}">
                <i class="fas fa-users"></i> Kelola Pendaftar Sertifikat
            </a>
            <a href="{{ route('kampus.index') }}" class="sidebar-link {{ request()->routeIs('kampus.*') ? 'active' : '' }}">
                <i class="fas fa-building"></i> Data Kampus
            </a>
            <a href="{{ route('jurusan.index') }}" class="sidebar-link {{ request()->routeIs('jurusan.*') ? 'active' : '' }}">
                <i class="fas fa-book"></i> Data Jurusan
            </a>
            <a href="{{ route('prodi.index') }}" class="sidebar-link {{ request()->routeIs('prodi.*') ? 'active' : '' }}">
                <i class="fas fa-graduation-cap"></i> Data Prodi
            </a>
            <a href="{{ route('profile') }}" class="sidebar-link {{ request()->routeIs('profile') ? 'active' : '' }}">
                <i class="fas fa-user"></i> Profile
            </a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="sidebar-link">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </nav>
    </aside>

    <!-- Main content -->
    <main>
        <header class="flex justify-between items-center mb-12">
            <h1 class="text-5xl font-extrabold text-gray-900 tracking-tight">Dashboard</h1>
            <div class="flex items-center space-x-6">
                <div class="user-profile relative">
                    <img src="https://via.placeholder.com/40" alt="User" class="w-10 h-10 rounded-full">
                    <div id="userDropdown" class="dropdown-menu" aria-hidden="true">
                        <a href="{{ route('profile') }}">Profile</a>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    </div>
                </div>
            </div>
        </header>

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Total Users Card -->
            <section class="card">
                <p class="text-gray-600 font-semibold">Total Users! 🎉</p>
                <p class="text-4xl font-extrabold mt-3 text-primary">{{ $totalUsers }}</p>
                <p class="text-sm text-gray-500 mt-1">78% of target achieved <i class="fas fa-star text-yellow-400"></i></p>
                <a href="{{ route('admin.manage') }}" class="btn-modern mt-5 text-white">View Details</a>
            </section>

            <!-- Monthly Test Registrations Chart Card -->
            <section class="card lg:col-span-2 flex flex-col">
                <p class="text-gray-600 font-semibold mb-4">Test Registrations (Last 12 Months)</p>
                <div class="w-full h-64">
                    <canvas id="monthlyChart"></canvas>
                </div>
            </section>

            <!-- Profit Card -->
            <section class="card">
                <p class="text-gray-600 font-semibold">Total Profit</p>
                <p class="text-4xl font-extrabold mt-3 text-primary">$25.6k</p>
                <p class="text-sm text-green-600 mt-1 font-semibold flex items-center gap-1">
                    +42% <i class="fas fa-arrow-up"></i>
                </p>
            </section>

            <!-- New Registrations Card -->
            <section class="card">
                <p class="text-gray-600 font-semibold">New Registrations</p>
                <p class="text-4xl font-extrabold mt-3 text-primary">862</p>
                <p class="text-sm text-red-600 mt-1 font-semibold flex items-center gap-1">
                    -18% <i class="fas fa-arrow-down"></i>
                </p>
            </section>

            <!-- Active Sessions Card -->
            <section class="card">
                <p class="text-gray-600 font-semibold mb-4">Active Sessions</p>
                <div class="flex items-end justify-around space-x-4 h-28">
                    <div class="chart-bar bg-red-600 w-12 rounded-t" style="height: 85%;"></div>
                    <div class="chart-bar bg-red-600 w-12 rounded-t" style="height: 70%;"></div>
                    <div class="chart-bar bg-red-600 w-12 rounded-t" style="height: 100%;"></div>
                </div>
            </section>

            <!-- Registrations by Region -->
            <section class="card">
                <p class="text-gray-600 font-semibold">Registrations by Region</p>
                <p class="mt-3 text-lg font-semibold">
                    Java <span class="text-green-600 ml-2">8,656</span> <span class="text-green-600 ml-2">+25%</span>
                </p>
                <p class="mt-1 text-lg font-semibold">
                    Sumatra <span class="text-green-600 ml-2">2,475</span> <span class="text-green-600 ml-2">+6.2%</span>
                </p>
            </section>
        </div>
    </main>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // User profile dropdown toggle
        const userProfile = document.querySelector('.user-profile');
        const dropdownMenu = document.getElementById('userDropdown');

        userProfile.addEventListener('click', (e) => {
            e.stopPropagation();
            dropdownMenu.classList.toggle('active');
            dropdownMenu.setAttribute('aria-hidden', !dropdownMenu.classList.contains('active'));
        });

        document.addEventListener('click', () => {
            if (dropdownMenu.classList.contains('active')) {
                dropdownMenu.classList.remove('active');
                dropdownMenu.setAttribute('aria-hidden', 'true');
            }
        });

        // Chart.js configuration for monthly data
        const ctx = document.getElementById('monthlyChart').getContext('2d');
        const monthlyChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'Total Registrations',
                    data: @json($data),
                    backgroundColor: 'rgba(124, 58, 237, 0.6)',
                    borderColor: 'rgba(124, 58, 237, 1)',
                    borderWidth: 1,
                    borderRadius: 5,
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
                    },
                    title: {
                        display: true,
                        text: 'Monthly Test Registrations (Last 12 Months)'
                    }
                }
            }
        });
    </script>
</body>
</html>