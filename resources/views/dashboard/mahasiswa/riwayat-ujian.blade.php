<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Ujian - TOEICLY</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .flip-in {
            opacity: 0;
            transform: rotateX(-90deg);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }
        .flip-in.show {
            opacity: 1;
            transform: rotateX(0);
        }
        .hover-glow {
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }
        .hover-glow:hover {
            box-shadow: 0 20px 40px rgba(58, 88, 237, 0.3);
            transform: translateY(-5px);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-100 via-purple-100 to-pink-100 min-h-screen">

<div class="flex h-screen">
    <!-- Sidebar -->
    @include('dashboard.mahasiswa.sidebar')

    <!-- Main Content -->
    <main id="riwayat-ujian" class="flex-1 p-10 overflow-auto flip-in">
        <h1 class="text-4xl font-bold text-purple-800 mb-6">Riwayat Ujian</h1>
        <div class="bg-white p-8 rounded-xl shadow-lg hover-glow">
            <table class="w-full text-left text-gray-700">
                <thead>
                    <tr>
                        <th class="py-4 px-6 bg-purple-600 text-white">Test Name</th>
                        <th class="py-4 px-6 bg-purple-600 text-white">Date</th>
                        <th class="py-4 px-6 bg-purple-600 text-white">Score</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-gray-100 hover:bg-purple-50 transition-colors">
                        <td class="py-4 px-6">TOEIC Practice Test 1</td>
                        <td class="py-4 px-6">20 May 2025</td>
                        <td class="py-4 px-6">945</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</div>

<script>
    // Add flip-in effect on page load
    window.addEventListener('load', () => {
        const riwayatUjian = document.getElementById('riwayat-ujian');
        setTimeout(() => {
            riwayatUjian.classList.add('show');
        }, 100);
    });
</script>

</body>
</html>
