@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-6">Jadwal Sertifikat</h1>

    <a href="{{ route('jadwal_sertifikat.create') }}" class="btn-modern bg-purple-600 hover:bg-purple-700 px-4 py-2 rounded text-white font-semibold mb-4 inline-block">Tambah Jadwal Baru</a>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
    @endif

    <table class="min-w-full border border-gray-300 rounded overflow-hidden">
        <thead class="bg-purple-100 text-purple-800 font-semibold">
            <tr>
                <th class="border border-gray-300 px-4 py-2">No.</th>
                <th class="border border-gray-300 px-4 py-2">Judul Jadwal</th>
                <th class="border border-gray-300 px-4 py-2">File PDF</th>
                <th class="border border-gray-300 px-4 py-2">Peserta Terdaftar</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($jadwals as $index => $jadwal)
                <tr class="hover:bg-purple-50">
                    <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $jadwal->judul }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        @if($jadwal->file_pdf)
                            <a href="{{ asset('storage/'.$jadwal->file_pdf) }}" target="_blank" class="text-blue-600 underline">Lihat PDF</a>
                        @else
                            Tidak ada file
                        @endif
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        <a href="{{ route('jadwal_sertifikat.peserta', $jadwal->jadwal_id) }}" class="btn-modern bg-indigo-600 hover:bg-indigo-700 px-4 py-1 rounded text-white font-semibold">Lihat Peserta</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center p-4">Tidak ada jadwal tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
