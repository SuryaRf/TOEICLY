@extends('layouts.app') <!-- jika ada layout -->

@section('content')
<div class="container mx-auto p-4 max-w-3xl">
    <h1 class="text-3xl font-bold mb-6 text-purple-700">Form Pendaftaran TOEIC</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label class="block font-semibold mb-1" for="nama">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" value="{{ old('nama', $mahasiswa->nama ?? '') }}" readonly
                   class="border border-purple-400 rounded px-3 py-2 w-full" />
        </div>

        <div>
            <label class="block font-semibold mb-1" for="nim">NIM</label>
            <input type="text" id="nim" name="nim" value="{{ old('nim', $mahasiswa->nim ?? '') }}" readonly
                   class="border border-purple-400 rounded px-3 py-2 w-full" />
        </div>

        <div>
            <label class="block font-semibold mb-1" for="nik">NIK</label>
            <input type="text" id="nik" name="nik" value="{{ old('nik', $mahasiswa->nik ?? '') }}" readonly
                   class="border border-purple-400 rounded px-3 py-2 w-full" />
        </div>

        <div>
            <label class="block font-semibold mb-1" for="no_telp">No. WA</label>
            <input type="text" id="no_telp" name="no_telp" value="{{ old('no_telp', $mahasiswa->no_telp ?? '') }}" required
                   class="border border-purple-400 rounded px-3 py-2 w-full" />
        </div>

        <div>
            <label class="block font-semibold mb-1" for="alamat_asal">Alamat Asal</label>
            <textarea id="alamat_asal" name="alamat_asal" required
                      class="border border-purple-400 rounded px-3 py-2 w-full">{{ old('alamat_asal', $mahasiswa->alamat_asal ?? '') }}</textarea>
        </div>

        <div>
            <label class="block font-semibold mb-1" for="alamat_sekarang">Alamat Sekarang</label>
            <textarea id="alamat_sekarang" name="alamat_sekarang" required
                      class="border border-purple-400 rounded px-3 py-2 w-full">{{ old('alamat_sekarang', $mahasiswa->alamat_sekarang ?? '') }}</textarea>
        </div>

        <div>
            <label class="block font-semibold mb-1" for="kampus">Pilihan Kampus</label>
            <select id="kampus" name="kampus" required class="border border-purple-400 rounded px-3 py-2 w-full">
                <option value="">-- Pilih Kampus --</option>
                <option value="utama" {{ old('kampus') == 'utama' ? 'selected' : '' }}>Utama</option>
                <option value="kediri" {{ old('kampus') == 'kediri' ? 'selected' : '' }}>PSDKU Kediri</option>
                <option value="lumajang" {{ old('kampus') == 'lumajang' ? 'selected' : '' }}>PSDKU Lumajang</option>
                <option value="pamekasan" {{ old('kampus') == 'pamekasan' ? 'selected' : '' }}>PSDKU Pamekasan</option>
            </select>
        </div>

        <div>
            <label class="block font-semibold mb-1" for="prodi_id">Program Studi</label>
            <select id="prodi_id" name="prodi_id" required class="border border-purple-400 rounded px-3 py-2 w-full">
                <option value="">-- Pilih Program Studi --</option>
                @foreach($prodi as $p)
                    <option value="{{ $p->prodi_id }}" {{ old('prodi_id') == $p->prodi_id ? 'selected' : '' }}>
                        {{ $p->prodi_nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-semibold mb-1" for="jadwal_id">Pilihan Jadwal TOEIC</label>
            <select id="jadwal_id" name="jadwal_id" required class="border border-purple-400 rounded px-3 py-2 w-full">
                <option value="">-- Pilih Jadwal --</option>
                @foreach($jadwal as $j)
                    <option value="{{ $j->jadwal_id }}" {{ old('jadwal_id') == $j->jadwal_id ? 'selected' : '' }}>
                        {{ $j->tanggal_pelaksanaan->format('d-m-Y H:i') }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-semibold mb-1" for="scan_ktp">Upload Scan KTP</label>
            <input type="file" id="scan_ktp" name="scan_ktp" required accept="image/*,application/pdf" class="border border-purple-400 rounded px-3 py-2 w-full" />
        </div>

        <div>
            <label class="block font-semibold mb-1" for="scan_ktm">Upload Scan KTM</label>
            <input type="file" id="scan_ktm" name="scan_ktm" required accept="image/*,application/pdf" class="border border-purple-400 rounded px-3 py-2 w-full" />
        </div>

        <div>
            <label class="block font-semibold mb-1" for="pas_foto">Upload Pas Foto</label>
            <input type="file" id="pas_foto" name="pas_foto" required accept="image/*" class="border border-purple-400 rounded px-3 py-2 w-full" />
        </div>

        <button type="submit" class="btn-modern">Daftar TOEIC</button>
    </form>
</div>
@endsection
