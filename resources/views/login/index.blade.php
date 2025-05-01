<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Your App</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/forms"></script>
</head>
<body class="bg-gradient-to-br from-blue-500 to-indigo-700 min-h-screen flex items-center justify-center px-4">
    <div class="bg-white shadow-xl rounded-xl overflow-hidden w-full max-w-md animate-fade-in-down">
        <div class="p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-1 text-center">Welcome Back</h2>
            <p class="text-sm text-gray-500 mb-6 text-center">Login to your account</p>

            <form action="#" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700">NIM</label>
                    <input type="text" name="nim" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-3 py-2">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 px-3 py-2">
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center text-sm text-gray-600">
                        <input type="checkbox" name="remember" class="form-checkbox">
                        <span class="ml-2">Remember me</span>
                    </label>
                    <a href="#" class="text-sm text-indigo-500 hover:underline">Forgot password?</a>
                </div>

                <button type="submit" class="w-full py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition duration-300">
                    Sign In
                </button>
            </form>

            <p class="text-sm text-gray-500 text-center mt-6">
                Don't have an account?
                <a href="#" class="text-indigo-600 hover:underline">Sign Up</a>
            </p>
        </div>
    </div>

    <style>
        @keyframes fade-in-down {
            0% {
                opacity: 0;
                transform: translateY(-10px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fade-in-down {
            animation: fade-in-down 0.6s ease-out;
        }
    </style>
</body>
</html>
