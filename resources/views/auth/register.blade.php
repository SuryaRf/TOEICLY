<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Register - TOEICLY</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(135deg, #a78bfa 0%, #7c3aed 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }
        .register-card {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(8px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            border-radius: 1.5rem;
            width: 100%;
            max-width: 480px;
            padding: 2rem;
            animation: fade-in-down 0.8s ease-out;
        }
        input:focus, select:focus {
            border-color: #8B5CF6;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.3);
            transform: scale(1.02);
        }
        .btn-purple {
            background-color: #7c3aed;
            color: white;
            font-weight: 600;
            border-radius: 0.75rem;
            padding: 0.75rem 1.5rem;
            width: 100%;
            border: none;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .btn-purple:hover {
            background-color: #6d28d9;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(124, 58, 237, 0.4);
        }
        @keyframes fade-in-down {
            0% { opacity: 0; transform: translateY(-30px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .hidden { display: none; }
    </style>
</head>
<body class="px-4">
    <div class="register-card">
        <h2 class="text-4xl font-bold text-purple-800 mb-4 text-center">Create Your Account</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-3 rounded-lg mb-6 shadow-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.submit') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="email" class="block font-semibold mb-1 text-gray-700">Email</label>
                <input type="email" name="email" id="email" required
                       class="block w-full rounded-md border-gray-300 shadow-sm px-4 py-3 placeholder-gray-400 focus:ring-purple-500 focus:border-purple-500 transition duration-300 ease-in-out" value="{{ old('email') }}">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="username" class="block font-semibold mb-1 text-gray-700">Username</label>
                <input type="text" name="username" id="username" maxlength="20" required
                       class="block w-full rounded-md border-gray-300 shadow-sm px-4 py-3 placeholder-gray-400 focus:ring-purple-500 focus:border-purple-500 transition duration-300 ease-in-out" value="{{ old('username') }}">
                @error('username')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block font-semibold mb-1 text-gray-700">Password</label>
                <input type="password" name="password" id="password" required
                       class="block w-full rounded-md border-gray-300 shadow-sm px-4 py-3 placeholder-gray-400 focus:ring-purple-500 focus:border-purple-500 transition duration-300 ease-in-out">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block font-semibold mb-1 text-gray-700">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                       class="block w-full rounded-md border-gray-300 shadow-sm px-4 py-3 placeholder-gray-400 focus:ring-purple-500 focus:border-purple-500 transition duration-300 ease-in-out">
                @error('password_confirmation')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="role" class="block font-semibold mb-1 text-gray-700">Role</label>
                <select name="role" id="role" required
                        class="block w-full rounded-md border-gray-300 shadow-sm px-4 py-3 placeholder-gray-400 focus:ring-purple-500 focus:border-purple-500 transition duration-300 ease-in-out">
                    <option value="">-- Select Role --</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="mahasiswa" {{ old('role') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                    <option value="dosen" {{ old('role') == 'dosen' ? 'selected' : '' }}>Dosen</option>
                    <option value="tendik" {{ old('role') == 'tendik' ? 'selected' : '' }}>Tendik</option>
                    <option value="itc" {{ old('role') == 'itc' ? 'selected' : '' }}>ITC</option>
                </select>
                @error('role')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Mahasiswa-specific fields -->
            <div id="mahasiswa-fields" class="hidden space-y-6">
                <div>
                    <label for="nim" class="block font-semibold mb-1 text-gray-700">NIM</label>
                    <input type="text" name="nim" id="nim" maxlength="10" required
                           class="block w-full rounded-md border-gray-300 shadow-sm px-4 py-3 placeholder-gray-400 focus:ring-purple-500 focus:border-purple-500 transition duration-300 ease-in-out" value="{{ old('nim') }}">
                    @error('nim')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="nama" class="block font-semibold mb-1 text-gray-700">Nama</label>
                    <input type="text" name="nama" id="nama" maxlength="100" required
                           class="block w-full rounded-md border-gray-300 shadow-sm px-4 py-3 placeholder-gray-400 focus:ring-purple-500 focus:border-purple-500 transition duration-300 ease-in-out" value="{{ old('nama') }}">
                    @error('nama')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="nik" class="block font-semibold mb-1 text-gray-700">NIK</label>
                    <input type="text" name="nik" id="nik" maxlength="16" required
                           class="block w-full rounded-md border-gray-300 shadow-sm px-4 py-3 placeholder-gray-400 focus:ring-purple-500 focus:border-purple-500 transition duration-300 ease-in-out" value="{{ old('nik') }}">
                    @error('nik')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="angkatan" class="block font-semibold mb-1 text-gray-700">Angkatan</label>
                    <input type="text" name="angkatan" id="angkatan" maxlength="4" required
                           class="block w-full rounded-md border-gray-300 shadow-sm px-4 py-3 placeholder-gray-400 focus:ring-purple-500 focus:border-purple-500 transition duration-300 ease-in-out" value="{{ old('angkatan') }}">
                    @error('angkatan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="no_telp" class="block font-semibold mb-1 text-gray-700">No. Telepon</label>
                    <input type="text" name="no_telp" id="no_telp" maxlength="15"
                           class="block w-full rounded-md border-gray-300 shadow-sm px-4 py-3 placeholder-gray-400 focus:ring-purple-500 focus:border-purple-500 transition duration-300 ease-in-out" value="{{ old('no_telp') }}">
                    @error('no_telp')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="jenis_kelamin" class="block font-semibold mb-1 text-gray-700">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" required
                            class="block w-full rounded-md border-gray-300 shadow-sm px-4 py-3 placeholder-gray-400 focus:ring-purple-500 focus:border-purple-500 transition duration-300 ease-in-out">
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="status" class="block font-semibold mb-1 text-gray-700">Status</label>
                    <select name="status" id="status" required
                            class="block w-full rounded-md border-gray-300 shadow-sm px-4 py-3 placeholder-gray-400 focus:ring-purple-500 focus:border-purple-500 transition duration-300 ease-in-out">
                        <option value="">-- Pilih Status --</option>
                        <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="alumni" {{ old('status') == 'alumni' ? 'selected' : '' }}>Alumni</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="keterangan" class="block font-semibold mb-1 text-gray-700">Keterangan</label>
                    <select name="keterangan" id="keterangan" required
                            class="block w-full rounded-md border-gray-300 shadow-sm px-4 py-3 placeholder-gray-400 focus:ring-purple-500 focus:border-purple-500 transition duration-300 ease-in-out">
                        <option value="">-- Pilih Keterangan --</option>
                        <option value="gratis" {{ old('keterangan') == 'gratis' ? 'selected' : '' }}>Gratis</option>
                        <option value="berbayar" {{ old('keterangan') == 'berbayar' ? 'selected' : '' }}>Berbayar</option>
                    </select>
                    @error('keterangan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="prodi_id" class="block font-semibold mb-1 text-gray-700">Program Studi</label>
                    <select name="prodi_id" id="prodi_id" required
                            class="block w-full rounded-md border-gray-300 shadow-sm px-4 py-3 placeholder-gray-400 focus:ring-purple-500 focus:border-purple-500 transition duration-300 ease-in-out">
                        <option value="">-- Pilih Program Studi --</option>
                        @foreach (\App\Models\ProdiModel::all() as $prodi)
                            <option value="{{ $prodi->prodi_id }}" {{ old('prodi_id') == $prodi->prodi_id ? 'selected' : '' }}>{{ $prodi->nama_prodi }}</option>
                        @endforeach
                    </select>
                    @error('prodi_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn-purple">Register</button>
        </form>

        <p class="text-center mt-6 text-gray-600">
            Already have an account?
            <a href="{{ route('login') }}" class="text-purple-600 font-semibold hover:underline">Login here</a>
        </p>
    </div>

    <script>
        document.getElementById('role').addEventListener('change', function () {
            const mahasiswaFields = document.getElementById('mahasiswa-fields');
            if (this.value === 'mahasiswa') {
                mahasiswaFields.classList.remove('hidden');
            } else {
                mahasiswaFields.classList.add('hidden');
            }
        });
    </script>
</body>
</html>