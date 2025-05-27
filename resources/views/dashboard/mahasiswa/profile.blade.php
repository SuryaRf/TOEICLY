<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - TOEICLY</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

        /* Sidebar Styles (unchanged from your original) */
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
            padding: 2rem;
            background: linear-gradient(135deg, #f3e8ff 0%, #e0f2fe 100%);
            min-height: 100vh;
            width: calc(100% - 260px);
            box-sizing: border-box;
        }

        .main-content.collapsed {
            margin-left: 80px;
            width: calc(100% - 80px);
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
                width: 100%;
            }

            .main-content.collapsed {
                margin-left: 0;
                width: 100%;
            }
        }

        /* Profile Card Styles */
        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .profile-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .profile-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(124, 58, 237, 0.2);
        }

        @media (max-width: 640px) {
            .profile-card .flex {
                flex-direction: column;
                align-items: center;
                text-align: center;
                gap: 2rem;
            }

            .profile-card .avatar-upload {
                margin-bottom: 1rem;
            }

            .profile-card button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="flex min-h-screen">
        <!-- Sidebar -->
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
                        <span>PROFIL</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('mahasiswa.daftar-tes') }}"
                       class="{{ request()->routeIs('mahasiswa.daftar-tes') ? 'active' : '' }}">
                        <i class="fas fa-file-alt"></i>
                        <span>DAFTAR TES</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('mahasiswa.riwayat-ujian') }}"
                       class="{{ request()->routeIs('mahasiswa.riwayat-ujian') ? 'active' : '' }}">
                        <i class="fas fa-history"></i>
                        <span>RIWAYAT UJIAN</span>
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

        <!-- Main Content -->
        <main class="main-content">
            <div class="profile-card p-8 rounded-3xl animate-fade-in w-full max-w-5xl mx-auto">
                <div class="flex items-center space-x-8">
                    <!-- Avatar Slot -->
                    <div class="avatar-upload relative">
                        <div class="w-40 h-40 bg-purple-200 rounded-full overflow-hidden shadow-lg hover:scale-105 transition-transform duration-300">
                            <img src="{{ $user->profile ? asset('storage/' . $user->profile) : 'https://via.placeholder.com/150' }}" alt="Avatar" class="w-full h-full object-cover">
                        </div>
                        <form action="{{ route('mahasiswa.update-avatar') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label for="avatar" class="absolute bottom-0 right-0 bg-purple-600 text-white p-3 rounded-full cursor-pointer shadow-lg hover:bg-purple-700 transition duration-300">
                                <i class="fas fa-camera"></i>
                            </label>
                            <input type="file" id="avatar" name="avatar" class="hidden" accept="image/*">
                        </form>
                    </div>

                    <!-- Profile Info -->
                    <div class="flex-1">
                        <h2 class="text-4xl font-bold text-purple-800 mb-4">{{ $user->username ?? 'Mahasiswa Name' }}</h2>
                        <p class="text-lg text-gray-600 mb-2">
                            <span class="font-semibold text-purple-800">Nama:</span> {{ $mahasiswa ? $mahasiswa->nama : '12345678' }}
                        </p>
                        <p class="text-lg text-gray-600 mb-2">
                            <span class="font-semibold text-purple-800">Email:</span> {{ $user->email ?? 'mahasiswa@example.com' }}
                        </p>
                        <p class="text-lg text-gray-600 mb-2">
                            <span class="font-semibold text-purple-800">NIM:</span> {{ $mahasiswa ? $mahasiswa->nim : '12345678' }}
                        </p>
                        <p class="text-lg text-gray-600 mb-2">
                            <span class="font-semibold text-purple-800">NIK:</span> {{ $mahasiswa ? $mahasiswa->nik : 'Tidak tersedia' }}
                        </p>
                        <p class="text-lg text-gray-600 mb-2">
                            <span class="font-semibold text-purple-800">No. Telepon:</span> {{ $mahasiswa ? $mahasiswa->no_telp : 'Tidak tersedia' }}
                        </p>
                        <p class="text-lg text-gray-600 mb-2">
                            <span class="font-semibold text-purple-800">Jenis Kelamin:</span> {{ $mahasiswa ? $mahasiswa->jenis_kelamin : 'Tidak tersedia' }}
                        </p>
                        <p class="text-lg text-gray-600 mb-2">
                            <span class="font-semibold text-purple-800">Keterangan:</span> {{ $mahasiswa ? $mahasiswa->keterangan : 'Tidak tersedia' }}
                        </p>
                        <p class="text-lg text-gray-600 mb-2">
                            <span class="font-semibold text-purple-800">Program Studi:</span> {{ $mahasiswa && $mahasiswa->prodi ? $mahasiswa->prodi->prodi_nama : 'Teknik Informatika' }}
                        </p>
                        <button class="mt-6 bg-purple-600 text-white px-6 py-3 rounded-lg shadow-lg hover:bg-purple-700 transition duration-300">
                            Edit Profile
                        </button>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.querySelector('.main-content');
            sidebar.classList.toggle('active');
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('collapsed');
        }

        // Handle Avatar Upload Preview
        document.getElementById('avatar').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector('.avatar-upload img').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>