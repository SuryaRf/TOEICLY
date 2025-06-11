<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tes - TOEICLY</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
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
            transform: scale(1.02);
            box-shadow: 0 10px 20px rgba(124, 58, 237, 0.2);
        }
        .table-header {
            background: #7c3aed;
            color: #ffffff;
        }
        .table-row:hover {
            background: #f3e8ff;
        }
        .register-button {
            background: #7c3aed;
            transition: background 0.2s ease, transform 0.2s ease;
        }
        .register-button:hover {
            background: #6d28d9;
            transform: translateY(-1px);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-100 via-purple-100 to-pink-100 min-h-screen font-poppins">

<div class="flex h-screen">
    <!-- Sidebar -->
    @include('dashboard.mahasiswa.sidebar')

    <!-- Main Content -->
    <main id="daftar-tes" class="flex-1 p-6 sm:p-10 overflow-auto fade-in">
        <h1 class="text-3xl font-bold text-purple-800 mb-8 flex items-center">
            <i class="fas fa-list-alt mr-2"></i> Daftar Tes
        </h1>
        <div class="bg-white p-6 rounded-xl shadow-lg zoom-card">
            <table class="w-full text-left text-gray-700 border-separate border-spacing-0">
                <thead>
                    <tr class="table-header">
                        <th class="py-4 px-6 rounded-tl-xl">Test Name</th>
                        <th class="py-4 px-6">Date</th>
                        <th class="py-4 px-6 rounded-tr-xl">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table-row bg-gray-50">
                        <td class="py-4 px-6 border-t border-gray-200">TOEIC Practice Test 1</td>
                        <td class="py-4 px-6 border-t border-gray-200">20 May 2025</td>
                        <td class="py-4 px-6 border-t border-gray-200">
                            <a href="{{ route('mahasiswa.daftar_tes') }}"
                               class="register-button text-white px-4 py-2 rounded-lg shadow-md hover:bg-purple-700 flex items-center">
                                <i class="fas fa-check-circle mr-2"></i> Register
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</div>

<script>
    window.addEventListener('load', () => {
        const daftarTes = document.getElementById('daftar-tes');
        setTimeout(() => {
            daftarTes.classList.add('show');
        }, 100);
    });
</script>

</body>
</html>