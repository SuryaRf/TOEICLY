<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOEIC Management System - @yield('title')</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #7367F0;
            --secondary-color: #A8AAAE;
            --success-color: #28C76F;
            --info-color: #00CFE8;
            --warning-color: #FF9F43;
            --danger-color: #EA5455;
            --light-color: #BABFC7;
            --dark-color: #4B4B4B;
            --sidebar-width: 260px;
        }
        
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #F8F7FA;
            margin: 0;
            padding: 0;
        }
        
        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: var(--sidebar-width);
            background-color: #fff;
            box-shadow: 0 4px 24px 0 rgba(34, 41, 47, 0.1);
            z-index: 1000;
            transition: all 0.3s ease;
            overflow-y: auto;
        }
        
        .sidebar-header {
            padding: 1.2rem 1.5rem;
            display: flex;
            align-items: center;
            border-bottom: 1px solid #ebe9f1;
        }
        
        .sidebar-header h3 {
            color: var(--primary-color);
            margin: 0;
            font-weight: 700;
            font-size: 1.5rem;
        }
        
        .sidebar-header img {
            margin-right: 10px;
            height: 30px;
        }

        .sidebar-section {
            padding: 1rem 0;
            border-bottom: 1px solid #ebe9f1;
        }
        
        .sidebar-section-title {
            padding: 0 1.5rem;
            margin-bottom: 0.5rem;
            font-size: 0.85rem;
            color: var(--secondary-color);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 500;
        }
        
        .sidebar-menu {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        
        .sidebar-menu li {
            position: relative;
        }
        
        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            color: var(--dark-color);
            text-decoration: none;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }
        
        .sidebar-menu a:hover {
            background-color: rgba(115, 103, 240, 0.08);
            color: var(--primary-color);
        }
        
        .sidebar-menu a.active {
            background: linear-gradient(118deg, var(--primary-color), var(--primary-color));
            box-shadow: 0 0 10px 1px rgba(115, 103, 240, 0.7);
            color: #fff;
            border-radius: 0 25px 25px 0;
            margin-right: 1rem;
        }
        
        .sidebar-menu i {
            margin-right: 0.75rem;
            font-size: 1.1rem;
            min-width: 20px;
            text-align: center;
        }
        
        .sidebar-menu .badge {
            margin-left: auto;
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 50%;
        }
        
        /* Pro Badge */
        .pro-badge {
            background-color: rgba(115, 103, 240, 0.12);
            color: var(--primary-color);
            font-size: 0.7rem;
            padding: 0.2rem 0.5rem;
            border-radius: 4px;
            margin-left: auto;
        }
        
        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 1rem 2rem 2rem;
            transition: all 0.3s ease;
        }
        
        /* Navbar */
        .navbar {
            padding: 0.75rem 0;
            margin-bottom: 2rem;
            background-color: transparent;
        }
        
        .navbar .search-box {
            max-width: 300px;
            position: relative;
        }
        
        .navbar .search-box input {
            padding-left: 40px;
            background-color: #f8f8f8;
            border: none;
            border-radius: 30px;
            font-size: 0.9rem;
        }
        
        .navbar .search-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--secondary-color);
        }
        
        .navbar .nav-icon {
            font-size: 1.2rem;
            color: var(--secondary-color);
            cursor: pointer;
            padding: 0.5rem;
            transition: all 0.2s ease;
        }
        
        .navbar .nav-icon:hover {
            color: var(--primary-color);
        }
        
        .user-profile {
            display: flex;
            align-items: center;
            cursor: pointer;
        }
        
        .user-profile img {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 10px;
        }
        
        /* Cards */
        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 24px 0 rgba(34, 41, 47, 0.05);
            margin-bottom: 2rem;
        }
        
        .card-header {
            background-color: transparent;
            border-bottom: 1px solid #ebe9f1;
            padding: 1.25rem 1.5rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .card-header h5 {
            margin: 0;
            font-weight: 500;
            font-size: 1.05rem;
        }
        
        .card-header .card-actions {
            display: flex;
            gap: 0.5rem;
        }
        
        .card-header .btn-icon {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            background-color: #f8f8f8;
            color: var(--secondary-color);
            transition: all 0.2s ease;
        }
        
        .card-header .btn-icon:hover {
            background-color: var(--primary-color);
            color: #fff;
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        /* Stats Cards */
        .stats-card {
            display: flex;
            align-items: center;
        }
        
        .stats-card .stats-icon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 1.5rem;
            margin-right: 1rem;
        }
        
        .stats-card .stats-info h3 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }
        
        .stats-card .stats-info p {
            color: var(--secondary-color);
            margin: 0;
            font-size: 0.9rem;
        }
        
        /* Colors */
        .bg-primary-light {
            background-color: rgba(115, 103, 240, 0.12);
            color: var(--primary-color);
        }
        
        .bg-success-light {
            background-color: rgba(40, 199, 111, 0.12);
            color: var(--success-color);
        }
        
        .bg-warning-light {
            background-color: rgba(255, 159, 67, 0.12);
            color: var(--warning-color);
        }
        
        .bg-info-light {
            background-color: rgba(0, 207, 232, 0.12);
            color: var(--info-color);
        }
        
        .bg-danger-light {
            background-color: rgba(234, 84, 85, 0.12);
            color: var(--danger-color);
        }
        
        .text-primary {
            color: var(--primary-color) !important;
        }
        
        .text-success {
            color: var(--success-color) !important;
        }
        
        .text-warning {
            color: var(--warning-color) !important;
        }
        
        .text-info {
            color: var(--info-color) !important;
        }
        
        .text-danger {
            color: var(--danger-color) !important;
        }
        
        /* Buttons */
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: #604dda;
            border-color: #604dda;
        }
        
        /* Badges */
        .badge {
            font-weight: 500;
            padding: 0.35em 0.65em;
            font-size: 0.75em;
        }
        
        .badge-primary {
            background-color: var(--primary-color);
        }
        
        .badge-success {
            background-color: var(--success-color);
        }
        
        .badge-warning {
            background-color: var(--warning-color);
        }
        
        .badge-info {
            background-color: var(--info-color);
        }
        
        .badge-danger {
            background-color: var(--danger-color);
        }
        
        /* Growth arrow indicators */
        .growth-arrow {
            display: inline-flex;
            align-items: center;
            margin-left: 0.5rem;
            font-weight: 500;
            font-size: 0.85rem;
        }
        
        .growth-arrow.up {
            color: var(--success-color);
        }
        
        .growth-arrow.down {
            color: var(--danger-color);
        }
        
        .growth-arrow i {
            margin-right: 0.25rem;
            font-size: 0.85rem;
        }
        
        /* Tables */
        .table {
            color: var(--dark-color);
            margin-bottom: 0;
        }
        
        .table thead th {
            border-top: none;
            border-bottom: 1px solid #ebe9f1;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.75rem;
            color: var(--secondary-color);
            padding: 0.75rem 1.5rem;
        }
        
        .table tbody td {
            vertical-align: middle;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #ebe9f1;
        }
        
        .table tbody tr:last-child td {
            border-bottom: none;
        }
        
        /* Charts */
        .chart-container {
            position: relative;
            height: 350px;
            width: 100%;
        }
        
        /* Utilities */
        .fw-medium {
            font-weight: 500;
        }
        
        .fw-semibold {
            font-weight: 600;
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content.expanded {
                margin-left: 0;
            }
        }
    </style>
    @yield('additional_css')
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <img src="https://cdn-icons-png.flaticon.com/512/3652/3652191.png" alt="Logo">
            <h3>TOEIC System</h3>
        </div>
        
        <div class="sidebar-section">
            <ul class="sidebar-menu">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="sidebar-section">
            <div class="sidebar-section-title">TOEIC Management</div>
            <ul class="sidebar-menu">
                <li>
                    <a href="{{ route('admin.certificates') }}" class="{{ request()->routeIs('admin.certificates*') ? 'active' : '' }}">
                        <i class="fas fa-certificate"></i>
                        <span>Kelola Sertifikat</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.schedule') }}" class="{{ request()->routeIs('admin.schedule*') ? 'active' : '' }}">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Jadwal Pengambilan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.tests') }}" class="{{ request()->routeIs('admin.tests*') ? 'active' : '' }}">
                        <i class="fas fa-tasks"></i>
                        <span>Kelola Tes</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.results') }}" class="{{ request()->routeIs('admin.results*') ? 'active' : '' }}">
                        <i class="fas fa-chart-bar"></i>
                        <span>Hasil Tes</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="sidebar-section">
            <div class="sidebar-section-title">User Management</div>
            <ul class="sidebar-menu">
                <li>
                    <a href="{{ route('admin.users.admin') }}" class="{{ request()->routeIs('admin.users.admin') ? 'active' : '' }}">
                        <i class="fas fa-user-shield"></i>
                        <span>Admin</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users.mahasiswa') }}" class="{{ request()->routeIs('admin.users.mahasiswa') ? 'active' : '' }}">
                        <i class="fas fa-user-graduate"></i>
                        <span>Mahasiswa</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users.dosen') }}" class="{{ request()->routeIs('admin.users.dosen') ? 'active' : '' }}">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <span>Dosen</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users.tendik') }}" class="{{ request()->routeIs('admin.users.tendik') ? 'active' : '' }}">
                        <i class="fas fa-user-tie"></i>
                        <span>Tendik</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="sidebar-section">
            <div class="sidebar-section-title">Settings</div>
            <ul class="sidebar-menu">
                <li>
                    <a href="{{ route('admin.settings') }}" class="{{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Navbar -->
        <nav class="navbar">
            <div class="d-flex align-items-center">
                <button id="sidebar-toggle" class="btn btn-icon d-block d-lg-none me-2">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" class="form-control" placeholder="Search...">
                </div>
            </div>
            <div class="d-flex align-items-center">
                <div class="nav-icon me-4 position-relative">
                    <i class="far fa-bell"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill badge-danger">
                        5+
                    </span>
                </div>
                <div class="nav-icon me-4">
                    <i class="far fa-envelope"></i>
                </div>
                <div class="user-profile">
                    <img src="https://randomuser.me/api/portraits/men/85.jpg" alt="Profile">
                    <span class="d-none d-md-block">Admin</span>
                </div>
            </div>
        </nav>

        <!-- Content -->
        @yield('content')
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Custom JS -->
    <script>
        // Sidebar Toggle
        document.getElementById('sidebar-toggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('show');
            document.querySelector('.main-content').classList.toggle('expanded');
        });

        // If window width is less than 992px, add click event to close sidebar when clicking outside
        if(window.innerWidth < 992) {
            document.querySelector('.main-content').addEventListener('click', function() {
                document.querySelector('.sidebar').classList.remove('show');
                document.querySelector('.main-content').classList.remove('expanded');
            });
        }
    </script>
    @yield('additional_js')
</body>
</html>