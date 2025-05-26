@extends('layouts.app') <!-- If there is a layout -->

@section('content')
    <div class="container mx-auto p-4 max-w-3xl">
        <h1 class="text-3xl font-bold mb-6 text-purple-700">TOEIC Registration Form</h1>

        {{-- Back button to student dashboard --}}
        <a href="{{ route('mahasiswa.dashboard') }}"
            class="inline-block mb-6 px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded text-gray-700 font-semibold transition duration-200">
            « Back to Dashboard
        </a>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label class="block font-semibold mb-1" for="nama">Full Name</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama', $mahasiswa->nama ?? '') }}" readonly
                    class="border border-purple-400 rounded px-3 py-2 w-full" />
                @error('nama')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1" for="nim">Student ID</label>
                <input type="text" id="nim" name="nim" value="{{ old('nim', $mahasiswa->nim ?? '') }}" readonly
                    class="border border-purple-400 rounded px-3 py-2 w-full" />
                @error('nim')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1" for="nik">National ID</label>
                <input type="text" id="nik" name="nik" value="{{ old('nik', $mahasiswa->nik ?? '') }}" readonly
                    class="border border-purple-400 rounded px-3 py-2 w-full" />
                @error('nik')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1" for="no_telp">WhatsApp Number</label>
                <input type="text" id="no_telp" name="no_telp" value="{{ old('no_telp', $mahasiswa->no_telp ?? '') }}"
                    required class="border border-purple-400 rounded px-3 py-2 w-full" />
                @error('no_telp')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1" for="alamat_asal">Home Address</label>
                <textarea id="alamat_asal" name="alamat_asal" required
                    class="border border-purple-400 rounded px-3 py-2 w-full">{{ old('alamat_asal', $mahasiswa->alamat_asal ?? '') }}</textarea>
                @error('alamat_asal')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1" for="alamat_sekarang">Current Address</label>
                <textarea id="alamat_sekarang" name="alamat_sekarang" required
                    class="border border-purple-400 rounded px-3 py-2 w-full">{{ old('alamat_sekarang', $mahasiswa->alamat_sekarang ?? '') }}</textarea>
                @error('alamat_sekarang')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1" for="kampus">Campus Selection</label>
                <select id="kampus" name="kampus" required class="border border-purple-400 rounded px-3 py-2 w-full">
                    <option value="">-- Select Campus --</option>
                    <option value="utama" {{ old('kampus') == 'utama' ? 'selected' : '' }}>Main Campus</option>
                    <option value="kediri" {{ old('kampus') == 'kediri' ? 'selected' : '' }}>PSDKU Kediri</option>
                    <option value="lumajang" {{ old('kampus') == 'lumajang' ? 'selected' : '' }}>PSDKU Lumajang</option>
                    <option value="pamekasan" {{ old('kampus') == 'pamekasan' ? 'selected' : '' }}>PSDKU Pamekasan</option>
                </select>
                @error('kampus')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1" for="prodi_id">Study Program</label>
                <select id="prodi_id" name="prodi_id" required class="border border-purple-400 rounded px-3 py-2 w-full">
                    <option value="">-- Select Study Program --</option>
                    @foreach($prodi as $p)
                        <option value="{{ $p->prodi_id }}" {{ old('prodi_id') == $p->prodi_id ? 'selected' : '' }}>
                            {{ $p->prodi_nama }}
                        </option>
                    @endforeach
                </select>
                @error('prodi_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1" for="registration_date">Registration Date</label>
                <input type="text" id="registration_date" name="registration_date" value="{{ date('d-m-Y') }}" readonly
                    class="border border-purple-400 rounded px-3 py-2 w-full bg-gray-100 cursor-not-allowed">
                @error('registration_date')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1" for="scan_ktp">Upload National ID Scan</label>
                <input type="file" id="scan_ktp" name="scan_ktp" required accept="image/*,application/pdf"
                    class="border border-purple-400 rounded px-3 py-2 w-full" />
                @error('scan_ktp')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1" for="scan_ktm">Upload Student ID Scan</label>
                <input type="file" id="scan_ktm" name="scan_ktm" required accept="image/*,application/pdf"
                    class="border border-purple-400 rounded px-3 py-2 w-full" />
                @error('scan_ktm')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block font-semibold mb-1" for="pas_foto">Upload Passport Photo</label>
                <input type="file" id="pas_foto" name="pas_foto" required accept="image/*"
                    class="border border-purple-400 rounded px-3 py-2 w-full" />
                @error('pas_foto')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit"
                class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md flex items-center gap-2 transition duration-300">
                ✍️ Register for TOEIC
            </button>
        </form>
    </div>
@endsection