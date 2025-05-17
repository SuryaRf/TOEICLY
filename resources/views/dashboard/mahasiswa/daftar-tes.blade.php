<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tes - TOEICLY</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }
        .fade-in.show {
            opacity: 1;
            transform: translateY(0);
        }
        .zoom-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .zoom-card:hover {
            transform: scale(1.05);
            box-shadow: 0 20px 40px rgba(124, 58, 237, 0.3);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-100 via-purple-100 to-pink-100 min-h-screen">

<div class="flex h-screen">
    <!-- Sidebar -->
    @include('dashboard.mahasiswa.sidebar')

    <!-- Main Content -->
    <main id="daftar-tes" class="flex-1 p-10 overflow-auto fade-in">
        <h1 class="text-4xl font-bold text-purple-800 mb-6">Daftar Tes</h1>
        <div class="bg-white p-8 rounded-xl shadow-lg zoom-card">
            <table class="w-full text-left text-gray-700">
                <thead>
                    <tr>
                        <th class="py-4 px-6 bg-purple-600 text-white">Test Name</th>
                        <th class="py-4 px-6 bg-purple-600 text-white">Date</th>
                        <th class="py-4 px-6 bg-purple-600 text-white">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-gray-100 hover:bg-purple-50 transition-colors">
                        <td class="py-4 px-6">TOEIC Practice Test 1</td>
                        <td class="py-4 px-6">20 May 2025</td>
                        <td class="py-4 px-6">
                            <button class="bg-purple-600 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-purple-700 transition-colors bounce-on-hover">
                                Register
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</div>

<script>
    // Add fade-in effect on page load
    window.addEventListener('load', () => {
        const daftarTes = document.getElementById('daftar-tes');
        setTimeout(() => {
            daftarTes.classList.add('show');
        }, 100);
    });
</script>

</body>
</html>
