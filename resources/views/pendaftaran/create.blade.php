<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>TOEIC Registration Form - TOEICLY</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Sidebar styling */
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
            background: linear-gradient(90deg, #a78bfa, #fff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin: 0;
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

        .sidebar a,
        .sidebar button {
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

        .sidebar a:hover,
        .sidebar button:hover,
        .sidebar a.active,
        .sidebar button.active {
            background: rgba(255, 255, 255, 0.15);
            color: #fff;
            transform: translateX(5px);
            box-shadow: 0 4px 15px rgba(167, 139, 250, 0.3);
        }

        .sidebar i {
            font-size: 1.2rem;
            margin-right: 1rem;
            transition: transform 0.3s ease;
        }

        .sidebar a:hover i,
        .sidebar button:hover i {
            transform: scale(1.2) rotate(5deg);
            color: #a78bfa;
        }

        .sidebar.collapsed a span,
        .sidebar.collapsed button span {
            display: none;
        }

        .sidebar.collapsed a,
        .sidebar.collapsed button {
            justify-content: center;
            padding: 0.75rem;
        }

        .sidebar.collapsed i {
            margin-right: 0;
        }

        /* Main content */
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

        /* Responsive */
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

        /* Form styling */
        .form-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 1.5rem;
            padding: 2rem;
            box-shadow: 0 10px 20px rgba(124, 58, 237, 0.1);
            transition: transform 0.3s ease;
        }

        .form-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(124, 58, 237, 0.2);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        label {
            font-weight: 600;
            color: #5b21b6;
            margin-bottom: 0.3rem;
            display: block;
        }

        input.form-input,
        select.form-input,
        textarea.form-input {
            border: 2px solid #a78bfa;
            border-radius: 0.75rem;
            padding: 0.5rem 1rem;
            width: 100%;
            font-size: 1rem;
            transition: border-color 0.3s ease;
            background-color: white;
        }

        input.form-input:focus,
        select.form-input:focus,
        textarea.form-input:focus {
            outline: none;
            border-color: #7c3aed;
            box-shadow: 0 0 5px #7c3aed;
        }

        textarea.form-input {
            resize: vertical;
            min-height: 96px;
        }

        .error-message {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: block;
        }

        .submit-button {
            background-color: #7c3aed;
            color: white;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            box-shadow: 0 6px 15px rgba(124, 58, 237, 0.4);
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            justify-content: center;
            width: 100%;
            max-width: 320px;
            margin-top: 1.5rem;
        }

        .submit-button:hover {
            background-color: #5b21b6;
        }
        input[readonly] {
            background-color:rgb(231, 222, 236);
            color: #6b7280;
            cursor: not-allowed;
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
                        <i class="fas fa-home"></i><span>OVERVIEW</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('mahasiswa.profile') }}"
                        class="{{ request()->routeIs('mahasiswa.profile') ? 'active' : '' }}">
                        <i class="fas fa-user"></i><span>PROFILE</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('mahasiswa.daftar-tes') }}"
                        class="{{ request()->routeIs('mahasiswa.daftar-tes') ? 'active' : '' }}">
                        <i class="fas fa-file-alt"></i><span>REGISTER TEST</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('mahasiswa.riwayat-ujian') }}"
                        class="{{ request()->routeIs('mahasiswa.riwayat-ujian') ? 'active' : '' }}">
                        <i class="fas fa-history"></i><span>REGISTER HISTORY</span>
                    </a>
                </li>
                <li>
                    <form action="{{ route('mahasiswa.logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit"
                            class="w-full text-left flex items-center gap-3 px-5 py-3 hover:bg-purple-700 rounded-lg">
                            <i class="fas fa-sign-out-alt"></i><span>LOGOUT</span>
                        </button>
                    </form>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="container mx-auto max-w-4xl">
                <h1 class="text-3xl font-bold mb-6 text-purple-800">TOEIC Registration Form</h1>

                <a href="{{ route('mahasiswa.dashboard') }}"
                    class="inline-block mb-6 text-gray-700 hover:text-purple-700 font-semibold flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i> Back to Dashboard
                </a>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-card">
                    <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-6">
                        @csrf
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="nama">Full Name</label>
                                <input type="text" id="nama" name="nama"
                                    value="{{ old('nama', $mahasiswa->nama ?? '') }}" readonly
                                    class="form-input bg-gray-100 cursor-not-allowed" />
                                @error('nama')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nim">Student ID</label>
                                <input type="text" id="nim" name="nim" value="{{ old('nim', $mahasiswa->nim ?? '') }}"
                                    readonly class="form-input bg-gray-100 cursor-not-allowed" />
                                @error('nim')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nik">National ID</label>
                                <input type="text" id="nik" name="nik" value="{{ old('nik', $mahasiswa->nik ?? '') }}"
                                    readonly class="form-input bg-gray-100 cursor-not-allowed" />
                                @error('nik')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="no_telp">WhatsApp Number</label>
                                <input type="text" id="no_telp" name="no_telp"
                                    value="{{ old('no_telp', $mahasiswa->no_telp ?? '') }}" required
                                    class="form-input" />
                                @error('no_telp')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-span-full">
                                <label for="alamat_asal">Home Address</label>
                                <textarea id="alamat_asal" name="alamat_asal" required class="form-input resize-y"
                                    rows="4">{{ old('alamat_asal', $mahasiswa->alamat_asal ?? '') }}</textarea>
                                @error('alamat_asal')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-span-full">
                                <label for="alamat_sekarang">Current Address</label>
                                <textarea id="alamat_sekarang" name="alamat_sekarang" required
                                    class="form-input resize-y"
                                    rows="4">{{ old('alamat_sekarang', $mahasiswa->alamat_sekarang ?? '') }}</textarea>
                                @error('alamat_sekarang')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="kampus">Campus Selection</label>
                                <select id="kampus" name="kampus" required class="form-input">
                                    <option value="">-- Select Campus --</option>
                                    <option value="utama" {{ old('kampus') == 'utama' ? 'selected' : '' }}>
                                        Main Campus
                                    </option>
                                    <option value="kediri" {{ old('kampus') == 'kediri' ? 'selected' : '' }}>
                                        PSDKU Kediri
                                    </option>
                                    <option value="lumajang" {{ old('kampus') == 'lumajang' ? 'selected' : '' }}>
                                        PSDKU Lumajang
                                    </option>
                                    <option value="pamekasan" {{ old('kampus') == 'pamekasan' ? 'selected' : '' }}>
                                        PSDKU Pamekasan
                                    </option>
                                </select>
                                @error('kampus')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="prodi_id">Study Program</label>
                                <select id="prodi_id" name="prodi_id" required class="form-input">
                                    <option value="">-- Select Study Program --</option>
                                    @foreach ($prodi as $p)
                                        <option value="{{ $p->prodi_id }}" {{ old('prodi_id') == $p->prodi_id ? 'selected' : '' }}>
                                            {{ $p->prodi_nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('prodi_id')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="block font-semibold mb-1 text-purple-800"
                                    for="registration_date">Registration Date</label>
                                <input type="text" id="registration_date" name="registration_date"
                                    value="{{ now()->format('d-m-Y') }}" readonly
                                    class="form-input bg-gray-100 cursor-not-allowed" />
                                @error('registration_date')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="scan_ktp">Upload National ID Scan</label>
                                <input type="file" id="scan_ktp" name="scan_ktp" required
                                    accept="image/*,application/pdf" class="form-input" />
                                @error('scan_ktp')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="scan_ktm">Upload Student ID Scan</label>
                                <input type="file" id="scan_ktm" name="scan_ktm" required
                                    accept="image/*,application/pdf" class="form-input" />
                                @error('scan_ktm')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="pas_foto">Upload Passport Photo</label>
                                <input type="file" id="pas_foto" name="pas_foto" required accept="image/*"
                                    class="form-input" />
                                @error('pas_foto')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="submit-button">
                            <i class="fas fa-pen"></i> Register for TOEIC
                        </button>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.querySelector('.main-content');
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('collapsed');
        }
    </script>
</body>

</html>