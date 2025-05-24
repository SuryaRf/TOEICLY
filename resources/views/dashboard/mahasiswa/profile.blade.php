<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Profil - TOEICLY</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fade-in {
            animation: fadeInUp 0.8s ease-out forwards;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-100 via-purple-100 to-pink-100 min-h-screen">

<div class="flex h-screen">
    <!-- Sidebar -->
    @include('dashboard.mahasiswa.sidebar')

    <!-- Main Content -->
    <main class="flex-1 p-10 overflow-auto">
        <div class="bg-white p-10 rounded-3xl shadow-lg animate-fade-in max-w-4xl mx-auto">
            <div class="flex flex-col md:flex-row items-center md:items-start space-y-8 md:space-y-0 md:space-x-8">

                <!-- Avatar Section -->
                <div class="relative w-40 h-40 rounded-full overflow-hidden shadow-lg bg-purple-200 hover:scale-105 transition-transform duration-300">
                    @if($mahasiswa && $mahasiswa->avatar)
                        <img src="{{ asset('storage/avatars/' . $mahasiswa->avatar) }}" alt="Avatar" class="w-full h-full object-cover" />
                    @elseif($user && $user->avatar)
                        <img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="Avatar" class="w-full h-full object-cover" />
                    @else
                        <img src="https://via.placeholder.com/150" alt="Avatar" class="w-full h-full object-cover" />
                    @endif

                    <form action="{{ route('mahasiswa.profile.uploadAvatar') }}" method="POST" enctype="multipart/form-data" 
                          class="absolute bottom-2 right-2 bg-purple-600 p-2 rounded-full cursor-pointer shadow-lg hover:bg-purple-700 transition duration-300 flex items-center justify-center"
                          title="Upload Avatar">
                        @csrf
                        <label for="avatar" class="cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M12 5l7 7-7 7" />
                            </svg>
                        </label>
                        <input type="file" name="avatar" id="avatar" class="hidden" onchange="this.form.submit()" />
                    </form>
                </div>

                <!-- Profile Info Section -->
                <div class="flex-1 text-center md:text-left">
                    <h2 class="text-4xl font-bold text-purple-700 mb-4">{{ $mahasiswa->nama ?? '-' }}</h2>

                    <div class="space-y-2 text-gray-700 text-lg">
                        <p><strong>Email:</strong> {{ $user->email ?? '-' }}</p>
                        <p><strong>NIM:</strong> {{ $mahasiswa->nim ?? '-' }}</p>
                        <p><strong>NIK:</strong> {{ $mahasiswa->nik ?? '-' }}</p>
                        <p><strong>Program Studi:</strong> {{ $mahasiswa->prodi->nama_prodi ?? '-' }}</p>
                    </div>
                </div>

            </div>
        </div>
    </main>
</div>

</body>
</html>
