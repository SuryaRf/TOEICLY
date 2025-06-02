<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Register - TOEICLY</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <style>
        /* Styling seragam dengan login */
        body {
            background: linear-gradient(135deg, #a78bfa 0%, #7c3aed 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }
        .register-card {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(8px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            border-radius: 1.5rem;
            width: 100%;
            max-width: 480px;
            padding: 2rem;
            animation: fade-in-down 0.8s ease-out;
        }
        input:focus {
            border-color: #8B5CF6;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.3);
            transform: scale(1.02);
        }
        .btn-purple {
            background-color: #7c3aed;
            color: white;
            font-weight: 600;
            border-radius: 0.75rem;
            padding: 0.75rem 1.5rem;
            width: 100%;
            border: none;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .btn-purple:hover {
            background-color: #6d28d9;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(124, 58, 237, 0.4);
        }
        @keyframes fade-in-down {
            0% {opacity: 0; transform: translateY(-30px);}
            100% {opacity: 1; transform: translateY(0);}
        }
    </style>
</head>
<body class="px-4">

    <div class="register-card">
        <h2 class="text-4xl font-bold text-purple-800 mb-4 text-center">Create Your Account</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-3 rounded-lg mb-6 shadow-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.submit') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="email" class="block font-semibold mb-1 text-gray-700">Email</label>
                <input type="email" name="email" id="email" required
                    class="block w-full rounded-md border-gray-300 shadow-sm px-4 py-3 placeholder-gray-400 focus:ring-purple-500 focus:border-purple-500 transition duration-300 ease-in-out" value="{{ old('email') }}">
            </div>

            <div>
                <label for="username" class="block font-semibold mb-1 text-gray-700">Username</label>
                <input type="text" name="username" id="username" maxlength="20" required
                    class="block w-full rounded-md border-gray-300 shadow-sm px-4 py-3 placeholder-gray-400 focus:ring-purple-500 focus:border-purple-500 transition duration-300 ease-in-out" value="{{ old('username') }}">
            </div>

            <div>
                <label for="password" class="block font-semibold mb-1 text-gray-700">Password</label>
                <input type="password" name="password" id="password" required
                    class="block w-full rounded-md border-gray-300 shadow-sm px-4 py-3 placeholder-gray-400 focus:ring-purple-500 focus:border-purple-500 transition duration-300 ease-in-out">
            </div>

            <div>
                <label for="password_confirmation" class="block font-semibold mb-1 text-gray-700">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                    class="block w-full rounded-md border-gray-300 shadow-sm px-4 py-3 placeholder-gray-400 focus:ring-purple-500 focus:border-purple-500 transition duration-300 ease-in-out">
            </div>

            <div>
                <label for="role" class="block font-semibold mb-1 text-gray-700">Role</label>
                <select name="role" id="role" required
                    class="block w-full rounded-md border-gray-300 shadow-sm px-4 py-3 placeholder-gray-400 focus:ring-purple-500 focus:border-purple-500 transition duration-300 ease-in-out">
                    <option value="">-- Select Role --</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="mahasiswa" {{ old('role') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                    <option value="dosen" {{ old('role') == 'dosen' ? 'selected' : '' }}>Dosen</option>
                    <option value="tendik" {{ old('role') == 'tendik' ? 'selected' : '' }}>Tendik</option>
                    <option value="itc" {{ old('role') == 'itc' ? 'selected' : '' }}>ITC</option>
                </select>
            </div>

            {{-- Optional fields for related tables (add if you want more fields per role) --}}

            <button type="submit" class="btn-purple">Register</button>

        </form>
        <p class="text-center mt-6 text-gray-600">
            Already have an account?
            <a href="{{ route('login') }}" class="text-purple-link font-semibold hover:underline">Login here</a>
        </p>
    </div>

</body>
</html>
