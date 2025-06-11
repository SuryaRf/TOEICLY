@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-br from-blue-100 via-purple-100 to-pink-100 min-h-screen flex">
    <!-- Sidebar -->
    @include('dashboard.mahasiswa.sidebar')

    <!-- Main Content -->
    <main class="flex-1 flex items-center justify-center min-h-screen">
        <div class="w-full max-w-xl px-4">
            <div class="glass-card animate-in">
                <h1 class="text-4xl font-bold text-purple-800 mb-8 text-center">
                    <i class="fas fa-info-circle mr-3 text-purple-700"></i>
                    Registration Status
                </h1>

                @if(session('info'))
                    <div class="alert mb-8 flex items-center">
                        <i class="fas fa-check-circle mr-3 text-blue-600 text-lg"></i>
                        <span class="text-blue-800 text-sm font-medium">{{ session('info') }}</span>
                    </div>
                @endif

                <p class="text-gray-600 mb-8 text-base leading-relaxed text-center">
                    You have already registered for the TOEIC test. For further details, please check your registration status on the dashboard or contact the administrator. Visit ITC Indonesia for more information about TOEIC certifications.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <a href="{{ route('mahasiswa.dashboard') }}"
                       class="primary-button flex items-center justify-center">
                        <i class="fas fa-arrow-left mr-2 icon-animate"></i> Back to Dashboard
                    </a>
                    <a href="https://itc-indonesia.com/"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="secondary-button flex items-center justify-center">
                        <i class="fas fa-globe mr-2 icon-animate"></i> Visit ITC Indonesia
                    </a>
                </div>
            </div>
        </div>
    </main>
</div>

<style>
    body {
        background: #ffffff;
        color: #1f2937;
        min-height: 100vh;
        margin: 0;
        font-family: 'Montserrat', sans-serif;
    }
    .main-content {
        margin-left: 260px; /* Changed from 55.5rem */
        padding: 2rem;
        min-height: 100vh;
        transition: margin-left 0.3s ease;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .animate-in {
        opacity: 0;
        transform: translateY(20px);
        animation: slideIn 0.6s ease-out forwards;
    }
    .animate-in:nth-child(1) { animation-delay: 0.2s; }
    .animate-in:nth-child(2) { animation-delay: 0.4s; }
    .animate-in:nth-child(3) { animation-delay: 0.6s; }
    @keyframes slideIn {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .glass-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(124, 58, 237, 0.2);
        border-radius: 1.5rem;
        box-shadow: 0 8px 32px rgba(124, 58, 237, 0.15);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        padding: 2.5rem;
        width: 100%;
        max-width: 36rem;
        margin: 0 auto;
    }
    .glass-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 40px rgba(124, 58, 237, 0.2);
    }
    .primary-button {
        background: linear-gradient(90deg, #6b21a8, #a78bfa);
        color: #ffffff;
        padding: 0.75rem 1.5rem;
        border-radius: 0.75rem;
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(107, 33, 168, 0.3);
        transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.3s ease;
        position: relative;
        overflow: hidden;
        width: 100%;
        text-align: center;
    }
    .primary-button:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 16px rgba(107, 33, 168, 0.4);
        background: linear-gradient(90deg, #5b1890, #8b5cf6);
    }
    .secondary-button {
        background: transparent;
        border: 2px solid #a78bfa;
        color: #6b21a8;
        padding: 0.75rem 1.5rem;
        border-radius: 0.75rem;
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(107, 33, 168, 0.1);
        transition: transform 0.2s ease, background 0.3s ease, box-shadow 0.3s ease;
        width: 100%;
        text-align: center;
    }
    .secondary-button:hover {
        background: rgba(167, 139, 250, 0.1);
        transform: scale(1.05);
        box-shadow: 0 6px 16px rgba(107, 33, 168, 0.2);
    }
    .alert {
        background: rgba(59, 130, 246, 0.1);
        border-left: 4px solid #3b82f6;
        border-radius: 0.75rem;
        padding: 1rem;
        box-shadow: 0 2px 8px rgba(59, 130, 246, 0.1);
        animation: alertSlide 0.5s ease-out;
        color: #1f2937;
    }
    @keyframes alertSlide {
        from {
            opacity: 0;
            transform: translateX(-10px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    .icon-animate {
        transition: transform 0.3s ease, color 0.3s ease;
    }
    .primary-button:hover .icon-animate,
    .secondary-button:hover .icon-animate {
        transform: scale(1.2);
        color: #e0e7ff;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const elements = document.querySelectorAll('.animate-in');
        elements.forEach((el, index) => {
            setTimeout(() => el.style.animationPlayState = 'running', index * 200);
        });
    });
</script>
@endsection