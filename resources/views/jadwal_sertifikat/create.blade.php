@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-6">Upload Jadwal Sertifikat</h1>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('jadwal_sertifikat.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 max-w-md">
        @csrf
        <div>
            <label for="judul" class="block mb-1 font-semibold">Judul Jadwal</label>
            <input type="text" id="judul" name="judul" class="border border-gray-300 rounded w-full px-3 py-2" required>
        </div>

        <div>
            <label for="file_pdf" class="block mb-1 font-semibold">Upload File PDF</label>
            <input type="file" id="file_pdf" name="file_pdf" accept=".pdf" required>
        </div>

        <button type="submit" class="btn-modern bg-purple-600 hover:bg-purple-700 px-6 py-2 rounded text-white font-semibold">Upload</button>
    </form>
</div>
@endsection
