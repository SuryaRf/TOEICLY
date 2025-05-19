@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-6 text-purple-700">Daftar Kampus</h1>

    <div class="mb-4">
        <a href="{{ route('kampus.create') }}" class="btn btn-primary">Tambah Kampus</a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-purple-100 text-purple-800 font-semibold">
                <th class="border border-gray-300 px-4 py-2">No.</th>
                <th class="border border-gray-300 px-4 py-2">Kode Kampus</th>
                <th class="border border-gray-300 px-4 py-2">Nama Kampus</th>
                <th class="border border-gray-300 px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($kampus as $index => $k)
                <tr class="hover:bg-purple-50">
                    <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $k->kampus_kode }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $k->kampus_nama }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <a href="{{ route('kampus.edit', $k->kampus_id) }}" 
                           class="btn-action bg-yellow-400 hover:bg-yellow-500 mr-2">Edit</a>
                        <form action="{{ route('kampus.destroy', $k->kampus_id) }}" method="POST" class="inline"
                            onsubmit="return confirm('Yakin ingin menghapus kampus ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action bg-red-500 hover:bg-red-600">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center p-4">Tidak ada data kampus tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@section('styles')
<style>
    .btn-action {
        padding: 0.25rem 0.75rem;
        border-radius: 0.375rem;
        font-weight: 600;
        color: white;
        cursor: pointer;
        transition: background-color 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }
    .btn-action.bg-yellow-400 { background-color: #fbbf24; }
    .btn-action.bg-yellow-400:hover { background-color: #f59e0b; }
    .btn-action.bg-red-500 { background-color: #ef4444; }
    .btn-action.bg-red-500:hover { background-color: #dc2626; }
</style>
@endsection
