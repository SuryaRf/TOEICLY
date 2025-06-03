<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

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
        position: relative;
        overflow: hidden;
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
        padding: 1.5rem;
    }

    .main-content.collapsed {
        margin-left: 80px;
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
        }

        .main-content.collapsed {
            margin-left: 0;
        }
    }
</style>

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
                <span>PROFILE</span>
            </a>
        </li>
        <li>
            <a href="{{ route('mahasiswa.daftar-tes') }}"
               class="{{ request()->routeIs('mahasiswa.daftar-tes') ? 'active' : '' }}">
                <i class="fas fa-file-alt"></i>
                <span>REGISTER TEST</span>
            </a>
        </li>
        <li>
            <a href="{{ route('mahasiswa.riwayat-ujian') }}"
               class="{{ request()->routeIs('mahasiswa.riwayat-ujian') ? 'active' : '' }}">
                <i class="fas fa-history"></i>
                <span>TEST HISTORY</span>
            </a>
        </li>
        <li>
            <form action="{{ route('mahasiswa.logout') }}" method="POST">
                @csrf
                <button type="submit">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>LOGOUT</span>
                </button>
            </form>
        </li>
    </ul>
</aside>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.querySelector('.main-content');
        sidebar.classList.toggle('active');
        sidebar.classList.toggle('collapsed');
        mainContent.classList.toggle('collapsed');
    }
</script>
