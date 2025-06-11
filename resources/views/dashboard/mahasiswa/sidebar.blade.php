<!-- filepath: d:\laragon\www\TOEICLY\resources\views\dashboard\mahasiswa\sidebar.blade.php -->

<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@700;900&display=swap');

    .sidebar {
        background: linear-gradient(180deg, #4c1d95 0%, #7c3aed 100%);
        color: white;
        min-height: 100vh;
        position: fixed;
        width: 15.5rem;
        transition: all 0.3s ease;
        box-shadow: 4px 0 12px rgb(123 97 255 / 0.4);
        z-index: 50;
        display: flex;
        flex-direction: column;
        padding: 0;
        font-family: 'Montserrat', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .sidebar .sidebar-header {
        padding: 2.1rem 1.3rem 1.2rem 1.3rem;
        margin-bottom: 0.2rem;
        text-align: left;
    }

    .sidebar h2 {
        font-size: 2rem;
        font-weight: 900;
        letter-spacing: 1px;
        margin: 0;
        line-height: 1.1;
        text-shadow: 0 2px 8px rgba(60,0,120,0.12);
        font-family: 'Montserrat', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .sidebar nav {
        flex: 1 1 auto;
        display: flex;
        flex-direction: column;
        gap: 0.1rem;
        padding: 0 0.6rem 1.2rem 0.6rem;
    }

    .sidebar a, .sidebar button {
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
        background: none;
        border: none;
        width: 100%;
        text-align: left;
        font-family: 'Montserrat', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .sidebar a:hover,
    .sidebar a.active,
    .sidebar button:hover {
        background-color: rgba(255,255,255,0.18);
        transform: translateX(5px);
        color: #fff !important;
    }

    .sidebar i {
        min-width: 1.2rem;
        font-size: 1.13rem;
        margin-right: 0.7rem;
        transition: transform 0.2s;
    }

    .sidebar a:hover i,
    .sidebar button:hover i {
        transform: rotate(8deg) scale(1.08);
        color: #e0e7ff;
    }
</style>

<aside class="sidebar">
    <div class="sidebar-header">
        <h2>TOEICLY</h2>
    </div>
    <nav>
        <a href="{{ route('mahasiswa.dashboard') }}"
            class="{{ request()->routeIs('mahasiswa.dashboard') ? 'active sidebar-link' : 'sidebar-link' }}">
            <i class="fas fa-home"></i> Overview
        </a>
        <a href="{{ route('mahasiswa.profile') }}"
            class="{{ request()->routeIs('mahasiswa.profile') ? 'active sidebar-link' : 'sidebar-link' }}">
            <i class="fas fa-user"></i> Profile
        </a>
        <a href="{{ route('mahasiswa.daftar-tes') }}"
            class="{{ request()->routeIs('mahasiswa.daftar-tes') ? 'active sidebar-link' : 'sidebar-link' }}">
            <i class="fas fa-file-alt"></i> Register Test
        </a>
        <a href="{{ route('mahasiswa.riwayat-ujian') }}"
            class="{{ request()->routeIs('mahasiswa.riwayat-ujian') ? 'active sidebar-link' : 'sidebar-link' }}">
            <i class="fas fa-history"></i> Register History
        </a>
        <a href="{{ route('mahasiswa.request_certificate') }}"
            class="{{ request()->routeIs('mahasiswa.request_certificate') ? 'active sidebar-link' : 'sidebar-link' }}">
            <i class="fas fa-certificate"></i> Certificate Request
        </a>
        <form action="{{ route('mahasiswa.logout') }}" method="POST" style="margin:0;">
            @csrf
            <button type="submit" class="sidebar-link">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </nav>
</aside>