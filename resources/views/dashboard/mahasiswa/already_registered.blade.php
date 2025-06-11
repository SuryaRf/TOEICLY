<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Status - TOEICLY</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            background: #ffffff;
            color: #1f2937;
            min-height: 100vh;
            margin: 0;
            font-family: 'Montserrat', sans-serif;
        }
        .main-content {
            margin-left: 55.5rem; /* Match sidebar width */
            padding: 2rem 3rem;
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
            padding: 2rem;
            max-width: 28rem;
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
        .primary-button::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.3s ease, height 0.3s ease;
        }
        .primary-button:active::after {
            width: 200px;
            height: 200px;
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
</head>
<body>
<div class="flex h-screen">
    <!-- Sidebar -->
    @include('dashboard.mahasiswa.sidebar')

    <!-- Main Content -->
    <main class="main-content">
        <div class="flex items-center justify-center min-h-full">
            <div>
                <h1 class="text-4xl font-bold text-gray-800 mb-10 flex items-center animate-in">
                    <i class="fas fa-info-circle mr-3 text-purple-700 text-3xl icon-animate"></i> Registration Status
                </h1>
                <div class="glass-card animate-in">
                    @if(session('info'))
                        <div class="alert mb-8 flex items-center">
                            <i class="fas fa-check-circle mr-3 text-blue-600 text-lg"></i>
                            <span class="text-blue-800 text-sm font-medium">{{ session('info') }}</span>
                        </div>
                    @endif

                    <p class="text-gray-600 mb-8 text-base leading-relaxed">
                        You have already registered for the TOEIC test. For further details, please check your registration status on the dashboard or contact the administrator. Visit ITC Indonesia for more information about TOEIC certifications.
                    </p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 animate-in">
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
        </div>
    </main>
</div>
        <p class="text-gray-700 mb-4">
            You have already registered for the TOEIC test. Please check your registration status or contact the administrator for further details.
        </p>

        <a href="{{ route('mahasiswa.dashboard') }}"
           class="inline-block px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg shadow-md transition duration-300">
            Back to Dashboard
        </a>
        <a href="https://itc-indonesia.com/?gad_campaignid=22363183331" target="_blank"
           class="inline-block px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg shadow-md transition duration-300">
            GO TO ITC
        </a>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const elements = document.querySelectorAll('.animate-in');
        elements.forEach((el, index) => {
            setTimeout(() => el.style.animationPlayState = 'running', index * 200);
        });
    });
</script>
</body>
</html>

