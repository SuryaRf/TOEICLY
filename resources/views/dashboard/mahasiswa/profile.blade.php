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
            background: linear-gradient(180deg, #5b21b6 0%, #7c3aed 100%);
            color: white;
            min-height: 100vh;
            position: fixed;
            width: 16rem;
            transition: all 0.3s ease;
            box-shadow: 4px 0 12px rgb(123 97 255 / 0.4);
            z-index: 50;
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
