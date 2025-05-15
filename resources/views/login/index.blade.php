<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Your App</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/forms"></script>
</head>
<body class="bg-gradient-to-br from-blue-200 via-blue-300 to-blue-400 min-h-screen flex items-center justify-center px-4">

    <div class="bg-white shadow-xl rounded-xl overflow-hidden w-full max-w-md animate-fade-in-down">
        <div class="p-8">

            <!-- Title -->
            <h2 class="text-3xl font-semibold text-gray-800 mb-2 text-center">Welcome Back</h2>
            <p class="text-sm text-gray-500 mb-6 text-center">Login to your account</p>

            <!-- Display Errors if any -->
            @if ($errors->any())
                <div class="bg-red-100 text-red-800 p-2 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Login Form -->
            <form action="{{ route('login.submit') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- NIM Input -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Username or Email</label>
                    <input type="text" name="username" required class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 px-4 py-3 placeholder-gray-400 transition duration-300 ease-in-out focus:scale-105">
                </div>

                <!-- Password Input -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" required class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500 px-4 py-3 placeholder-gray-400 transition duration-300 ease-in-out focus:scale-105">
                </div>

                <!-- Remember Me and Forgot Password -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center text-sm text-gray-600">
                        <input type="checkbox" name="remember" class="form-checkbox">
                        <span class="ml-2">Remember me</span>
                    </label>
                    <a href="#" class="text-sm text-teal-500 hover:underline">Forgot password?</a>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition duration-300 ease-in-out transform hover:scale-105">
                    Sign In
                </button>
            </form>

            <!-- Sign Up Link -->
            <p class="text-sm text-gray-500 text-center mt-6">
                Don't have an account? 
                <a href="#" class="text-teal-600 hover:underline">Sign Up</a>
            </p>

        </div>
    </div>

    <!-- Animations for Fade In -->
    <style>
        @keyframes fade-in-down {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fade-in-down {
            animation: fade-in-down 0.8s ease-out;
        }
    </style>

</body>
</html>
