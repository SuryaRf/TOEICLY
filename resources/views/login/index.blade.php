<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TOEICLY</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/forms"></script>
    <style>
        /* Custom styles to override Tailwind defaults for purple theme */
        body {
            /* Adjusting the background to match your sidebar gradient feel */
            background: linear-gradient(135deg, #a78bfa 0%, #7c3aed 100%);
            min-height: 100vh; /* Ensure it fills the viewport height */
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif; /* Using a more modern font, similar to your dashboard */
        }

        /* Card styling */
        .login-card {
            background-color: rgba(255, 255, 255, 0.95); /* Slightly transparent white for a modern feel */
            backdrop-filter: blur(8px); /* Optional: Adds a subtle blur behind the card */
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15); /* Stronger, softer shadow */
            border-radius: 1.5rem; /* More rounded corners */
            overflow: hidden;
            width: 100%;
            max-width: 480px; /* Slightly wider for better spacing */
            animation: fade-in-down 0.8s ease-out;
        }

        /* Input focus styles */
        input:focus {
            border-color: #8B5CF6; /* Purple-500 */
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.3); /* Purple-500 with transparency */
            transform: scale(1.02); /* Subtle scale on focus */
        }

        /* Button styles */
        .btn-purple {
            background-color: #7c3aed; /* Purple-600 */
            color: white;
            font-weight: 600;
            border-radius: 0.75rem; /* Rounded button */
            transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-purple:hover {
            background-color: #6d28d9; /* Darker purple on hover */
            transform: translateY(-2px); /* Slight lift on hover */
            box-shadow: 0 5px 15px rgba(124, 58, 237, 0.4); /* Shadow on hover */
        }

        /* Link colors (Forgot password, Sign Up) */
        .text-purple-link {
            color: #7c3aed; /* Purple-600 */
            transition: color 0.3s ease;
        }

        .text-purple-link:hover {
            color: #5b21b6; /* Purple-800 on hover */
            text-decoration: underline;
        }

        /* Animation Keyframes */
        @keyframes fade-in-down {
            0% {
                opacity: 0;
                transform: translateY(-30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body class="px-4">

    <div class="login-card">
        <div class="p-8 sm:p-10">

            <h2 class="text-4xl font-bold text-purple-800 mb-3 text-center">Welcome Back</h2>
            <p class="text-lg text-gray-600 mb-8 text-center">Login to your TOEICLY account</p>

            @if ($errors->any())
                <div class="bg-red-100 text-red-800 p-3 rounded-lg mb-6 shadow-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login.submit') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username or Email</label>
                    <input type="text" id="username" name="username" required
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-purple-500 focus:border-purple-500 px-4 py-3 placeholder-gray-400 transition duration-300 ease-in-out">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" id="password" name="password" required
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-purple-500 focus:border-purple-500 px-4 py-3 placeholder-gray-400 transition duration-300 ease-in-out">
                </div>

                <div class="flex justify-end"> {{-- Changed to justify-end to align "Forgot password?" to the right --}}
                    <a href="{{ route('forgot-password') }}" class="text-sm text-purple-link hover:underline">Forgot password?</a>

                </div>

                <button type="submit" class="w-full py-3 px-4 btn-purple">
                    Sign In
                </button>
            </form>

            <p class="text-base text-gray-600 text-center mt-8">
                Don't have an account?
                <a href="#" class="text-purple-link hover:underline font-semibold">Sign Up</a>
            </p>

        </div>
    </div>

</body>
</html>