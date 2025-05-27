<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Riwayat Ujian - TOEICLY</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

    body {
      font-family: 'Poppins', sans-serif;
    }

    .main-content {
      margin-left: 260px; /* disesuaikan dengan sidebar */
      transition: margin-left 0.3s ease;
      padding: 2rem;
    }

    .main-content.collapsed {
      margin-left: 80px;
    }

    @media (max-width: 768px) {
      .main-content {
        margin-left: 0;
      }
    }

    /* Animasi fadeInUp */
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

  <!-- Sidebar -->
  @include('dashboard.mahasiswa.sidebar')

  <!-- Main Content -->
  <main id="riwayat-ujian" class="main-content">
    <h1 class="text-4xl font-bold text-purple-800 mb-6">Riwayat Ujian</h1>

    <div class="card-content animate-fade-in bg-white p-8 rounded-xl shadow-lg hover-glow overflow-x-auto">
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

</body>
</html>
