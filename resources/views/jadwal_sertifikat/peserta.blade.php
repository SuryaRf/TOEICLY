@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-6">Peserta Jadwal: {{ $jadwal->judul }}</h1>

    <a href="{{ route('jadwal_sertifikat.index') }}" class="btn-modern bg-gray-600 hover:bg-gray-700 px-4 py-1 rounded text-white font-semibold mb-4 inline-block">Kembali</a>

    <table class="min-w-full border border-gray-300 rounded overflow-hidden">
        <thead class="bg-purple-100 text-purple-800 font-semibold">
            <tr>
                <th class="border border-gray-300 px-4 py-2">No.</th>
                <th class="border border-gray-300 px-4 py-2">Kode Pendaftaran</th>
                <th class="border border-gray-300 px-4 py-2">Nama Mahasiswa</th>
                <th class="border border-gray-300 px-4 py-2">Tanggal Daftar</th>
                <th class="border border-gray-300 px-4 py-2">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pesertas as $index => $peserta)
                <tr class="hover:bg-purple-50">
                    <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $peserta->pendaftaran_kode }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $peserta->mahasiswa->nama ?? '-' }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $peserta->tanggal_pendaftaran->format('d-m-Y') }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        {{ optional($peserta->detail)->status ?? 'menunggu' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center p-4">Belum ada peserta terdaftar.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
