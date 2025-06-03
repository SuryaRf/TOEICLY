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
    .sidebar {
            background: linear-gradient(180deg, #4c1d95 0%, #7c3aed 100%);
            color: white;
            min-height: 100vh;
            width: 260px;
            position: fixed;
            top: 0;
            left: 0;
            transition: width 0.3s ease, transform 0.3s ease;
            box-shadow: 4px 0 20px rgba(124, 58, 237, 0.3);
            z-index: 1000;
            font-family: 'Poppins', sans-serif;
            overflow-y: auto;
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar .brand {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }

        .sidebar .brand h2 {
            font-size: 1.8rem;
            font-weight: 700;
            letter-spacing: 2px;
            background: linear-gradient(90deg, #a78bfa, #ffffff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .sidebar .toggle-btn {
            display: none;
            position: absolute;
            top: 1.5rem;
            right: -1.5rem;
            background: #7c3aed;
            color: white;
            border: none;
            border-radius: 50%;
            width: 2rem;
            height: 2rem;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            z-index: 1001;
        }

        .sidebar ul {
            padding: 1.5rem 0;
            margin: 0;
            list-style: none;
        }

        .sidebar li {
            margin: 0.5rem 0;
        }

        .sidebar a,
        .sidebar button {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.25rem;
            font-size: 0.95rem;
            font-weight: 600;
            color: #e2e8f0;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
        }

        .sidebar a:hover,
        .sidebar button:hover,
        .sidebar a.active,
        .sidebar button.active {
            background: rgba(255, 255, 255, 0.15);
            color: #ffffff;
            transform: translateX(5px);
            box-shadow: 0 4px 15px rgba(167, 139, 250, 0.3);
        }

        .sidebar i {
            font-size: 1.2rem;
            margin-right: 1rem;
            transition: transform 0.3s ease;
        }

        .sidebar a:hover i,
        .sidebar button:hover i {
            transform: scale(1.2) rotate(5deg);
            color: #a78bfa;
        }

        .sidebar.collapsed a span,
        .sidebar.collapsed button span {
            display: none;
        }

        .sidebar.collapsed a,
        .sidebar.collapsed button {
            justify-content: center;
            padding: 0.75rem;
        }

        .sidebar.collapsed i {
            margin-right: 0;
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
