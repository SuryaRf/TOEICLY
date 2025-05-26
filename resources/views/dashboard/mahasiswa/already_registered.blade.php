@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4 max-w-3xl">
        <h1 class="text-3xl font-bold mb-6 text-purple-700">Registration Status</h1>

        @if(session('info'))
            <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mb-4">
                {{ session('info') }}
            </div>
        @endif

        <p class="text-gray-700 mb-4">
            You have already registered for the TOEIC test. Please check your registration status or contact the administrator for further details.
        </p>

        <a href="{{ route('mahasiswa.dashboard') }}"
           class="inline-block px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg shadow-md transition duration-300">
            Back to Dashboard
        </a>
    </div>
@endsection