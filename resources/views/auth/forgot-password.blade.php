<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Forgot Password - TOEICLY</title>
  <!-- Tailwind CSS -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" />
  <style>
    body {
      background: linear-gradient(135deg, #a78bfa 0%, #7c3aed 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
    }

    .card {
      background-color: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(8px);
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
      border-radius: 1.5rem;
      padding: 2.5rem;
      width: 100%;
      max-width: 480px;
      text-align: center;
      animation: fade-in-down 0.8s ease-out;
    }

    h1 {
      color: #5b21b6;
      font-weight: 900;
      margin-bottom: 1rem;
      font-size: 2.25rem;
    }

    p {
      color: #4b5563;
      font-size: 1.125rem;
      margin-bottom: 2rem;
    }

    a.btn-back {
      display: inline-block;
      background: linear-gradient(90deg, #7c3aed, #a78bfa);
      color: white;
      font-weight: 600;
      padding: 0.75rem 2rem;
      border-radius: 0.75rem;
      text-decoration: none;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    a.btn-back:hover {
      background: linear-gradient(90deg, #a78bfa, #7c3aed);
      transform: scale(1.05);
      box-shadow: 0 8px 20px rgb(124 58 237 / 0.7);
    }

    @keyframes fade-in-down {
      0% {
        opacity: 0;
        transform: translateY(-30px);
      }

      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>

<body>

  <div class="card">
    <h1>Password Reset</h1>
    <p>Silahkan hubungi ruang admin untuk melakukan restart password Anda.</p>
    <a href="{{ route('login') }}" class="btn-back">Back to Login</a>
  </div>

</body>

</html>
