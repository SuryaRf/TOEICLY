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
        /* Gradient background for body */
        body {
            background: linear-gradient(135deg, #eef2ff 0%, #dbeafe 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Sidebar styling */
        .sidebar {
            background: linear-gradient(180deg, #5b21b6 0%, #7c3aed 100%);
            color: white;
            min-height: 100vh;
            position: fixed;
            width: 16rem;
            /* 64 */
            transition: all 0.3s ease;
            box-shadow: 4px 0 12px rgb(123 97 255 / 0.4);
            z-index: 50;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            /* py-3 px-4 */
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
            /* 20px */
            font-size: 1.1rem;
            margin-right: 0.75rem;
            transition: transform 0.3s ease;
        }

        .sidebar a:hover i {
            transform: rotate(10deg) scale(1.2);
            color: #ddd;
        }

        /* Main content spacing to right of fixed sidebar */
        main {
            margin-left: 16rem;
            padding: 2.5rem;
            min-height: 100vh;
            overflow-y: auto;
        }

        /* Card style */
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

        /* Headings */
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p {
            margin: 0;
            padding: 0;
        }

        /* Typography */
        .text-primary {
            color: #7c3aed;
        }

        .text-accent {
            color: #a78bfa;
        }

        /* Buttons */
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

        /* Chart bars */
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

        /* Scrollbar styling */
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

        /* User profile in header */
        .user-profile {
            position: relative;
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

        <!-- Tambahan menu data kampus, jurusan, prodi -->
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
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="sidebar-link">
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
                <div class="flex items-center space-x-2 select-none">
                    <span class="text-gray-700 font-semibold text-lg">Total Star:</span>
                    <span class="text-yellow-400 text-2xl font-extrabold flex items-center gap-1">
                        45 <i class="fas fa-star"></i>
                    </span>
                </div>
                {{-- <div class="user-profile relative" tabindex="0" aria-label="User profile dropdown">
                    <img src="https://via.placeholder.com/40" alt="User" class="w-12 h-12 rounded-full cursor-pointer"
                        id="userAvatar" />
                    <div class="dropdown-menu" id="userDropdown" role="menu" aria-hidden="true">
                        <a href="#" role="menuitem"
                            class="block px-4 py-2 hover:bg-purple-100 hover:text-purple-700">Profile</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit" role="menuitem"
                                class="w-full text-left px-4 py-2 hover:bg-purple-100 hover:text-purple-700 bg-transparent border-0 cursor-pointer">
                                Logout
                            </button>
                        </form>
                    </div>
                </div> --}}


            </div>
        </header>

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Congratulations Card -->
            <section class="card">
                <p class="text-gray-600 font-semibold">Congratulations Admin! 🎉</p>
                <p class="text-4xl font-extrabold mt-3 text-primary">42k</p>
                <p class="text-sm text-gray-500 mt-1">78% of target achieved <i class="fas fa-star text-yellow-400"></i>
                </p>
                <button class="btn-modern mt-5">View Details</button>
            </section>

            <!-- Test Registrations Card -->
            <section class="card">
                <p class="text-gray-600 font-semibold">Test Registrations</p>
                <p class="text-4xl font-extrabold mt-3 text-primary">48.5%</p>
                <p class="text-sm text-green-600 mt-1 font-semibold flex items-center gap-1">
                    Growth this month <i class="fas fa-arrow-up"></i>
                </p>
            </section>

            <!-- Weekly Overview Card -->
            <section class="card lg:col-span-2 flex flex-col">
                <p class="text-gray-600 font-semibold mb-4">Weekly Test Overview</p>
                <div class="flex items-end justify-around flex-grow space-x-6">
                    <div class="chart-bar bg-primary w-12" style="height: 28rem;"></div>
                    <div class="chart-bar bg-primary w-12" style="height: 24rem;"></div>
                    <div class="chart-bar bg-primary w-12" style="height: 20rem;"></div>
                    <div class="chart-bar bg-primary w-12" style="height: 32rem;"></div>
                </div>
                <p class="text-sm text-gray-500 mt-5">45% Test participation is 45% higher than last month</p>
                <button class="btn-modern mt-5 self-start">Details</button>
            </section>

            <!-- Total Revenue Card -->
            <section class="card">
                <p class="text-gray-600 font-semibold">Total Revenue</p>
                <p class="text-4xl font-extrabold mt-3 text-primary">$86.4k</p>
            </section>

            <!-- Profit Card -->
            <section class="card">
                <p class="text-gray-600 font-semibold">Total Profit</p>
                <p class="text-4xl font-extrabold mt-3 text-primary">$25.6k</p>
                <p class="text-sm text-green-600 mt-1 font-semibold flex items-center gap-1">
                    +42% <i class="fas fa-arrow-up"></i>
                </p>
            </section>

            <!-- Test Centers -->
            <section class="card">
                <p class="text-gray-600 font-semibold">Jakarta Center</p>
                <p class="text-4xl font-extrabold mt-3 text-primary">24,985</p>
            </section>
            <section class="card">
                <p class="text-gray-600 font-semibold">Surabaya Center</p>
                <p class="text-4xl font-extrabold mt-3 text-primary">8,650</p>
            </section>
            <section class="card">
                <p class="text-gray-600 font-semibold">Bandung Center</p>
                <p class="text-4xl font-extrabold mt-3 text-primary">1,245</p>
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
                    <div class="chart-bar bg-red-600 w-12 rounded-t" style="height: 24rem;"></div>
                    <div class="chart-bar bg-red-600 w-12 rounded-t" style="height: 20rem;"></div>
                    <div class="chart-bar bg-red-600 w-12 rounded-t" style="height: 28rem;"></div>
                </div>
            </section>

            <!-- Registrations by Region -->
            <section class="card">
                <p class="text-gray-600 font-semibold">Registrations by Region</p>
                <p class="mt-3 text-lg font-semibold">
                    Java <span class="text-green-600 ml-2">8,656</span> <span class="text-green-600 ml-2">+25%</span>
                </p>
                <p class="mt-1 text-lg font-semibold">
                    Sumatra <span class="text-green-600 ml-2">2,475</span> <span
                        class="text-green-600 ml-2">+6.2%</span>
                </p>
            </section>

            <!-- Payments Card -->
            <section class="card">
                <p class="text-gray-600 font-semibold">Payments</p>
                <p class="mt-3 text-lg font-semibold">
                    Bank Transfer <span class="text-green-600 ml-2">+$4,650</span>
                </p>
                <p class="mt-1 text-lg font-semibold">
                    Credit Card <span class="text-green-600 ml-2">+$92,705</span>
                </p>
            </section>

            <!-- Refunds Card -->
            <section class="card">
                <p class="text-gray-600 font-semibold">Refunds</p>
                <p class="mt-3 text-lg font-semibold">
                    Bank Transfer <span class="text-red-600 ml-2">-$145</span>
                </p>
                <p class="mt-1 text-lg font-semibold">
                    Credit Card <span class="text-red-600 ml-2">-$1,870</span>
                </p>
            </section>
        </div>
    </main>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // User profile dropdown toggle
        const userProfile = document.querySelector('.user-profile');
        const dropdownMenu = document.getElementById('userDropdown');

        userProfile.addEventListener('click', (e) => {
            e.stopPropagation(); // cegah event bubble ke document
            dropdownMenu.classList.toggle('active');
            // Update aria-hidden
            const isActive = dropdownMenu.classList.contains('active');
            dropdownMenu.setAttribute('aria-hidden', !isActive);
        });

        document.addEventListener('click', () => {
            if (dropdownMenu.classList.contains('active')) {
                dropdownMenu.classList.remove('active');
                dropdownMenu.setAttribute('aria-hidden', 'true');
            }
        });

    </script>
</body>

</html>