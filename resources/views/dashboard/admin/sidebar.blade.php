<!-- filepath: d:\laragon\www\TOEICLY\resources\views\dashboard\admin\sidebar.blade.php -->

<style>
    .sidebar {
        background: linear-gradient(180deg, #5b21b6 0%, #7c3aed 100%);
        color: white;
        min-height: 100vh;
        position: fixed;
        width: 15.5rem;
        /* Lebar sedikit lebih besar */
        transition: all 0.3s ease;
        box-shadow: 4px 0 12px rgb(123 97 255 / 0.4);
        z-index: 50;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 0;
    }

    .sidebar .sidebar-header {
        padding: 1.3rem 1.3rem 0.9rem 1.3rem;
        margin-bottom: 0.2rem;
    }

    .sidebar h2 {
        font-size: 1.35rem;
        font-weight: 800;
        letter-spacing: 1px;
        margin: 0;
        line-height: 1.1;
    }

    .sidebar nav {
        flex: 1 1 auto;
        display: flex;
        flex-direction: column;
        gap: 0.1rem;
        padding: 0 0.6rem;
    }

    .sidebar .sidebar-bottom {
        display: flex;
        flex-direction: column;
        gap: 0.1rem;
        padding: 0 0.6rem 1.2rem 0.6rem;
    }

    .sidebar a {
        display: flex;
        align-items: center;
        padding: 0.85rem 1.1rem;
        font-size: 1.08rem;
        font-weight: 500;
        border-radius: 0.45rem;
        transition: background-color 0.2s, transform 0.2s;
        color: inherit;
        text-decoration: none;
        cursor: pointer;
        margin-bottom: 0.1rem;
        min-height: 2.5rem;
    }

    .sidebar a:hover,
    .sidebar a.active {
        background-color: rgba(255, 255, 255, 0.18);
        transform: translateX(5px);
        color: #fff !important;
    }

    .sidebar i {
        min-width: 1.2rem;
        font-size: 1.13rem;
        margin-right: 0.7rem;
        transition: transform 0.2s;
    }

    .sidebar a:hover i {
        transform: rotate(8deg) scale(1.08);
        color: #e0e7ff;
    }
</style>

<aside class="sidebar">
    <div>
        <div class="sidebar-header">
            <h2>TOEICLY Admin</h2>
        </div>
        <nav>
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
            <a href="{{ route('admin.send_email') }}"
                class="sidebar-link {{ request()->routeIs('admin.send_email') ? 'active' : '' }}">
                <i class="fas fa-envelope"></i> Send Email
            </a>
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
        </nav>
    </div>
    <div class="sidebar-bottom">
        <a href="{{ route('profile') }}" class="sidebar-link {{ request()->routeIs('profile') ? 'active' : '' }}">
            <i class="fas fa-user"></i> Profile
        </a>
        <a href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="sidebar-link">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</aside>