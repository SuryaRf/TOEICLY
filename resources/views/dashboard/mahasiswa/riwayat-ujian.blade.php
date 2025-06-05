{{-- filepath: d:\laragon\www\TOEICLY\resources\views\dashboard\mahasiswa\riwayat-ujian.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Test Registration History - TOEICLY</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

    body {
      font-family: 'Poppins', sans-serif;
    }

    .main-content {
      margin-left: 260px;
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
    
    .badge {
      display: inline-block;
      padding: 0.25rem 0.75rem;
      border-radius: 9999px;
      font-size: 0.75rem;
      font-weight: 600;
      text-align: center;
    }
    .badge-pending {
      background-color: #fef3c7;
      color: #d97706;
    }
    .badge-approved {
      background-color: #d1fae5;
      color: #059669;
    }
    .badge-rejected {
      background-color: #fee2e2;
      color: #dc2626;
    }
    
    .table-container {
      overflow-x: auto;
      border-radius: 0.75rem;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .table-header {
      background-color: #7c3aed;
      color: white;
    }
    .table-row:nth-child(even) {
      background-color: #f3f4f6;
    }
    .table-row:hover {
      background-color: #ede9fe;
    }
  </style>
</head>
<body class="bg-gradient-to-br from-blue-100 via-purple-100 to-pink-100 min-h-screen">

  <!-- Sidebar -->
  @include('dashboard.mahasiswa.sidebar')

  <!-- Main Content -->
  <main id="riwayat-ujian" class="main-content">
    <h1 class="text-4xl font-bold text-purple-800 mb-6">Test Registration History</h1>

    <div class="card-content animate-fade-in bg-white p-8 rounded-xl shadow-lg hover-glow">
      @if($registrations->isEmpty())
        <div class="text-center py-12">
          <i class="fas fa-history text-5xl text-purple-400 mb-4"></i>
          <h3 class="text-2xl font-semibold text-gray-700">No test registration history</h3>
          <p class="text-gray-500 mt-2">You have not registered for any TOEIC test yet.</p>
        </div>
      @else
        <div class="table-container">
          <table class="w-full text-left text-gray-700">
            <thead>
              <tr>
                <th class="py-4 px-6 table-header">Registration Code</th>
                <th class="py-4 px-6 table-header">Registration Date</th>
                <th class="py-4 px-6 table-header">Status</th>
              </tr>
            </thead>
<tbody>
  @foreach ($registrations as $registration)
  <tr class="table-row">
    <td class="py-4 px-6 font-medium">
      {{ $registration->pendaftaran_kode }}
    </td>
    <td class="py-4 px-6">
      {{ $registration->tanggal_pendaftaran->format('d M Y') }}
    </td>
    <td class="py-4 px-6">
      @if($registration->detailPendaftaran)
        @if($registration->detailPendaftaran->status == 'approved')
          <span class="badge badge-approved">Approved</span>
        @elseif($registration->detailPendaftaran->status == 'pending')
          <span class="badge badge-pending">Pending</span>
        @else
          <span class="badge badge-rejected">{{ ucfirst($registration->detailPendaftaran->status) }}</span>
        @endif
      @else
        <span class="badge badge-rejected">Status Not Available</span>
      @endif
    </td>
  </tr>
  @endforeach
</tbody>
          </table>
        </div>
      @endif
    </div>
  </main>

</body>
</html>