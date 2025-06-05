<!-- resources/views/dashboard/admin/sidebar.blade.php -->

<style>
    /* Gradient background */
    body {
        background: linear-gradient(135deg, #eef2ff 0%, #dbeafe 100%);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
    }

    /* Sidebar */
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
        display: flex;
        flex-direction: column;
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
</style>

<aside class="sidebar flex flex-col">
    <div class="p-6">
        <h2 class="text-4xl font-extrabold tracking-tight select-none">TOEICLY Admin</h2>
    </div>
    <nav class="mt-8 flex flex-col gap-2 px-2 flex-grow">
        <a href="{{ route('admin.dashboard') }}"
            class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-home"></i> Dashboard
        </a>
        <a href="{{ route('admin.manage') }}"
            class="sidebar-link {{ request()->routeIs('admin.manage') ? 'active' : '' }}">
            <i class="fas fa-users"></i> User Management
        </a>
        <a href="{{ route('jadwal_sertifikat.index') }}"
            class="sidebar-link {{ request()->routeIs('jadwal_sertifikat.*') ? 'active' : '' }}">
            <i class="fas fa-calendar-alt"></i> Manage Certificate Schedule
        </a>
        <a href="{{ route('admin.pendaftar') }}"
            class="sidebar-link {{ request()->routeIs('admin.pendaftar') ? 'active' : '' }}">
            <i class="fas fa-users"></i> Manage Certificate Registrants
        </a>
        <a href="{{ route('admin.pendaftarVerifikasi') }}"
            class="sidebar-link {{ request()->routeIs('admin.pendaftarVerifikasi') ? 'active' : '' }}">
            <i class="fas fa-users"></i> Manage Verification
        </a>
                <a href="{{ route('informasi.index') }}"
            class="sidebar-link {{ request()->routeIs('informasi.*') ? 'active' : '' }}">
            <i class="fas fa-bullhorn"></i> Manage Information
        </a>
        <!-- Additional menu for campus, department, program study -->
        <a href="{{ route('kampus.index') }}"
            class="sidebar-link {{ request()->routeIs('kampus.*') ? 'active' : '' }}">
            <i class="fas fa-building"></i> Campus Data
        </a>
        <a href="{{ route('jurusan.index') }}"
            class="sidebar-link {{ request()->routeIs('jurusan.*') ? 'active' : '' }}">
            <i class="fas fa-book"></i> Department Data
        </a>
        <a href="{{ route('prodi.index') }}"
            class="sidebar-link {{ request()->routeIs('prodi.*') ? 'active' : '' }}">
            <i class="fas fa-graduation-cap"></i> Program Study Data
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
