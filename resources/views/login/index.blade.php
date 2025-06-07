<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TOEICLY</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

        body {
            background: linear-gradient(135deg, #5b21b6 0%, #a78bfa 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
            position: relative;
            overflow: hidden;
            perspective: 1000px;
        }

        /* Particle animation */
        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.4);
            border-radius: 50%;
            animation: float 12s infinite ease-in-out;
        }

        @keyframes float {
            0% { transform: translateY(0) translateX(0) scale(0.5); opacity: 0.3; }
            50% { transform: translateY(-50vh) translateX(5vw) scale(1); opacity: 0.7; }
            100% { transform: translateY(-100vh) translateX(10vw) scale(0.5); opacity: 0; }
        }

        /* Login card */
        .login-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(15px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
            border-radius: 1.75rem;
            border: 1px solid rgba(255, 255, 255, 0.25);
            width: 100%;
            max-width: 520px;
            padding: 2.5rem;
            animation: card-appear 1s ease-out;
            z-index: 10;
            position: relative;
            transform-style: preserve-3d;
            transition: transform 0.3s ease;
        }

        .login-card:hover {
            transform: rotateX(2deg) rotateY(2deg);
        }

        @keyframes card-appear {
            0% { opacity: 0; transform: translateY(60px) rotateX(-10deg); }
            100% { opacity: 1; transform: translateY(0) rotateX(0); }
        }

        /* Logo animation */
        .logo {
            animation: logo-pulse 2s infinite ease-in-out;
        }

        @keyframes logo-pulse {
            0%, 100% { filter: drop-shadow(0 0 10px rgba(167, 139, 250, 0.3)); }
            50% { filter: drop-shadow(0 0 20px rgba(167, 139, 250, 0.7)); }
        }

        /* Input group */
        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .input-field {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 0.75rem;
            padding: 0.75rem 2.5rem 0.75rem 2.5rem;
            color: white;
            width: 100%;
            transition: all 0.3s ease;
        }

        .input-field:focus {
            border-color: #a78bfa;
            box-shadow: 0 0 0 4px rgba(167, 139, 250, 0.3);
            background: rgba(255, 255, 255, 0.15);
        }

        .input-field::placeholder {
            color: transparent;
        }

        .input-label {
            position: absolute;
            left: 2.5rem;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.95rem;
            pointer-events: none;
            transition: all 0.3s ease;
        }

        .input-field:focus ~ .input-label,
        .input-field:not(:placeholder-shown) ~ .input-label {
            top: 0;
            font-size: 0.75rem;
            color: #a78bfa;
            transform: translateY(-100%);
            background: transparent;
            padding: 0 0.25rem;
        }

        .input-icon {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.6);
            transition: color 0.3s ease;
        }

        .input-field:focus ~ .input-icon {
            color: #a78bfa;
        }

        /* Password toggle */
        .toggle-password {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: rgba(255, 255, 255, 0.6);
            transition: all 0.3s ease;
        }

        .toggle-password:hover {
            color: #a78bfa;
            transform: translateY(-50%) scale(1.1);
        }

        /* Button styles */
        .btn-purple {
            background: linear-gradient(90deg, #7c3aed, #a78bfa);
            color: white;
            font-weight: 600;
            border-radius: 0.75rem;
            padding: 0.85rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .btn-purple::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.6s ease, height 0.6s ease;
            z-index: -1;
        }

        .btn-purple:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-purple:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(124, 58, 237, 0.6);
        }

        /* Link styles */
        .text-purple-link {
            color: #a78bfa;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .text-purple-link:hover {
            color: #ffffff;
            text-decoration: underline;
            transform: scale(1.05);
        }
        .text-white-link {
            color: #ffffff;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .text-white-link:hover {
            color: #ffffff;
            text-decoration: underline;
            transform: scale(1.05);
        }

        /* Error alert */
        .error-alert {
            background: rgba(239, 68, 68, 0.95);
            backdrop-filter: blur(8px);
            animation: shake 0.4s ease;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-6px); }
            40%, 80% { transform: translateX(6px); }
        }

        /* Responsive adjustments */
        @media (max-width: 640px) {
            .login-card {
                max-width: 95%;
                padding: 1.75rem;
            }

            .logo {
                width: 120px;
            }

            .input-field {
                padding: 0.65rem 2rem;
            }

            .input-label {
                left: 2rem;
            }
        }
    </style>
</head>
<body class="px-4">
    <!-- Particle background -->
    <div class="particles">
        <div class="particle" style="width: 8px; height: 8px; top: 85%; left: 15%; animation-delay: 0s;"></div>
        <div class="particle" style="width: 10px; height: 10px; top: 65%; left: 45%; animation-delay: 1.5s;"></div>
        <div class="particle" style="width: 6px; height: 6px; top: 95%; left: 75%; animation-delay: 3s;"></div>
        <div class="particle" style="width: 12px; height: 12px; top: 55%; left: 25%; animation-delay: 4.5s;"></div>
        <div class="particle" style="width: 7px; height: 7px; top: 75%; left: 85%; animation-delay: 6s;"></div>
    </div>

    <div class="login-card">
        <div class="text-center mb-8">
            <img src="{{ asset('img/logo1.png') }}" alt="TOEICLY Logo" class="logo mx-auto w-36 md:w-44">
            <h2 class="text-3xl md:text-4xl font-bold text-white mt-4">Welcome to TOEICLY</h2>
            <p class="text-base md:text-lg text-gray-300 mt-2">Sign in to your TOEIC dashboard</p>
        </div>

        @if ($errors->any())
            <div class="error-alert text-white p-4 rounded-lg mb-6 shadow-lg">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login.submit') }}" method="POST" class="space-y-6">
            @csrf

            <div class="input-group">
                <i class="fas fa-user input-icon left-3"></i>
                <input type="text" id="username" name="username" required
                       class="input-field" placeholder="Username or Email">
                <label for="username" class="input-label">Username or Email</label>
            </div>

            <div class="input-group">
                <i class="fas fa-lock input-icon left-3"></i>
                <input type="password" id="password" name="password" required
                       class="input-field" placeholder="Password">
                <label for="password" class="input-label">Password</label>
                <i class="fas fa-eye toggle-password" id="toggle-password"></i>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('forgot-password') }}" class="text-sm text-white-link">Forgot password?</a>
            </div>

            <button type="submit" class="w-full btn-purple">
                Sign In
            </button>
        </form>

        <p class="text-base text-gray-300 text-center mt-6">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-white-link font-semibold">Sign Up</a>
        </p>
    </div>

    <script>
        // Show/Hide Password Toggle
        const togglePassword = document.getElementById('toggle-password');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', () => {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            togglePassword.classList.toggle('fa-eye');
            togglePassword.classList.toggle('fa-eye-slash');
        });

        // Input focus animation
        document.addEventListener('DOMContentLoaded', () => {
            const inputs = document.querySelectorAll('.input-field');
            inputs.forEach(input => {
                input.addEventListener('focus', () => {
                    input.parentElement.querySelector('.input-icon').style.color = '#a78bfa';
                });
                input.addEventListener('blur', () => {
                    input.parentElement.querySelector('.input-icon').style.color = 'rgba(255, 255, 255, 0.6)';
                });
            });
        });
    </script>