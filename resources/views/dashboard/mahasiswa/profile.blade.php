<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Profil Mahasiswa - TOEICLY</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(135deg, #eef2ff 0%, #dbeafe 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
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
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
        }

        .sidebar a:hover,
        .sidebar button:hover,
        .sidebar a.active,
        .sidebar button.active {
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
        main {
            margin-left: 16rem;
            padding: 3rem 2rem;
            min-height: 100vh;
            overflow-y: auto;
            font-family: 'Poppins', sans-serif;
        }
        h1 {
            color: #4c1d95;
            font-weight: 800;
            font-size: 2.5rem;
            margin-bottom: 2rem;
        }
        .card {
            background-color: #fff;
            border-radius: 1rem;
            box-shadow: 0 6px 15px rgb(0 0 0 / 0.08);
            padding: 2rem;
            max-width: 800px;
            margin: auto;
        }
        .profile-info {
            display: flex;
            flex-direction: column;
        }
        label {
            font-weight: 600;
            color: #5b21b6;
            display: block;
            margin-top: 1rem;
            margin-bottom: 0.5rem;
        }
        input[readonly] {
            background-color: rgb(231, 222, 236);
            color: #6b7280;
            cursor: not-allowed;
        }
        input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #a78bfa;
            border-radius: 0.5rem;
            font-size: 1rem;
            color: #333;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        input:focus {
            outline: none;
            border-color: #7c3aed;
            box-shadow: 0 0 5px #7c3aed;
        }
        button.btn-modern {
            margin-top: 1.5rem;
            background: linear-gradient(90deg, #7c3aed, #a78bfa);
            border: none;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            color: white;
            box-shadow: 0 4px 12px rgb(124 58 237 / 0.4);
            transition: all 0.3s ease;
            cursor: pointer;
            max-width: 200px;
        }
        button.btn-modern:hover {
            background: linear-gradient(90deg, #a78bfa, #7c3aed);
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgb(124 58 237 / 0.7);
        }
    </style>
</head>
<body>
    @include('dashboard.mahasiswa.sidebar')

    <main>
        <h1>Profil Saya</h1>

        <section class="card">
            <form class="profile-info" action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}" readonly>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>

                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama', $mahasiswa->nama ?? '') }}" required>

                <label for="nim">NIM</label>
                <input type="text" id="nim" name="nim" value="{{ old('nim', $mahasiswa->nim ?? '') }}" readonly>

                <label for="nik">NIK</label>
                <input type="text" id="nik" name="nik" value="{{ old('nik', $mahasiswa->nik ?? '') }}" readonly>

                <label for="no_telp">No. Telepon</label>
                <input type="text" id="no_telp" name="no_telp" value="{{ old('no_telp', $mahasiswa->no_telp ?? '') }}" required>

                <label for="jenis_kelamin">Jenis Kelamin</label>
                <input type="text" id="jenis_kelamin" name="jenis_kelamin" value="{{ old('jenis_kelamin', $mahasiswa->jenis_kelamin ?? '') }}" readonly>

                <label for="keterangan">Keterangan</label>
                <input type="text" id="keterangan" name="keterangan" value="{{ old('keterangan', $mahasiswa->keterangan ?? '') }}" readonly>

                <label for="prodi">Program Studi</label>
                <input type="text" id="prodi" name="prodi" value="{{ old('prodi', $mahasiswa->prodi->prodi_nama ?? '') }}" readonly>

                <button type="submit" class="btn-modern">Update Profile</button>
            </form>
        </section>
    </main>
</body>
</html>
