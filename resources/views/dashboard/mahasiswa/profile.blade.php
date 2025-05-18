<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - TOEICLY</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-100 via-purple-100 to-pink-100 min-h-screen">

<div class="flex h-screen">
    <!-- Sidebar -->
    @include('dashboard.mahasiswa.sidebar')

    <!-- Main Content -->
    <main class="flex-1 p-10 overflow-auto">
        <div class="bg-white p-10 rounded-3xl shadow-lg transition-transform duration-300 hover:-translate-y-1 hover:shadow-2xl">
            <div class="flex items-center space-x-8">
                <!-- Avatar Slot -->
                <div class="relative">
                    <div class="w-40 h-40 bg-purple-200 rounded-full overflow-hidden shadow-lg hover:scale-105 transition-transform duration-300">
                        <img src="https://via.placeholder.com/150" alt="Avatar" class="w-full h-full object-cover">
                    </div>
                    <label for="avatar" class="absolute bottom-0 right-0 bg-purple-600 text-white p-2 rounded-full cursor-pointer shadow-lg hover:bg-purple-700 transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm0 2h12v3.586l-3.293-3.293a1 1 0 00-1.414 0L10 8.586 7.707 6.293a1 1 0 00-1.414 0L4 8.586V5zm0 5.414L6.293 8.707a1 1 0 011.414 0L10 11.414l2.293-2.293a1 1 0 011.414 0L16 10.414V15H4v-4.586z" />
                        </svg>
                    </label>
                    <input type="file" id="avatar" class="hidden">
                </div>

                <!-- Profile Info -->
                <div>
                    <h2 class="text-4xl font-bold text-purple-700 mb-4">Mahasiswa Name</h2>
                    <p class="text-lg text-gray-600 mb-2">Email: mahasiswa@example.com</p>
                    <p class="text-lg text-gray-600 mb-2">NIM: 12345678</p>
                    <p class="text-lg text-gray-600 mb-2">Program Studi: Teknik Informatika</p>
                    <button class="mt-6 bg-purple-600 text-white px-6 py-3 rounded-lg shadow-lg hover:bg-purple-700 transition duration-300">
                        Edit Profile
                    </button>
                </div>
            </div>
        </div>
    </main>
</div>

</body>
</html>