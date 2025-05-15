<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Index - FlexStart Bootstrap Template</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/png">
  <link rel="apple-touch-icon" href="{{ asset('img/apple-touch-icon.png') }}">



  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">


  <!-- Main CSS File -->
  <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.html" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="img-fluid">

        <h1 class="sitename">Toeicly</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home<br></a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#services">Services</a></li>
          <li class="dropdown"><a href="#"><span>Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">Dropdown 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i
                    class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="#">Deep Dropdown 1</a></li>
                  <li><a href="#">Deep Dropdown 2</a></li>
                  <li><a href="#">Deep Dropdown 3</a></li>
                  <li><a href="#">Deep Dropdown 4</a></li>
                  <li><a href="#">Deep Dropdown 5</a></li>
                </ul>
              </li>
              <li><a href="#">Dropdown 2</a></li>
              <li><a href="#">Dropdown 3</a></li>
              <li><a href="#">Dropdown 4</a></li>
            </ul>
          </li>

          <li><a href="#contact">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted flex-md-shrink-0" href="{{ url('/login') }}">Get Started</a>


    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
            <h1 data-aos="fade-up">Welcome to <strong>TOEICLY</strong>, Your Trusted TOEIC Test Management System</h1>
            <p data-aos="fade-up" data-aos-delay="100">
              Simplify your TOEIC test process with modern, reliable, and user-friendly solutions designed to help you
              succeed.
            </p>
            <p data-aos="fade-up" data-aos-delay="150" class="fst-italic text-primary">
              "Empowering Your English Journey, One Test at a Time"
            </p>
            <div class="d-flex flex-column flex-md-row" data-aos="fade-up" data-aos-delay="200">
              <a href="{{ url('/login') }}" class="btn-get-started">Get Started <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
          <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out">
            <img src="http://localhost/toeicly/public/img/hero-img.png" class="img-fluid animated" alt="Hero Image">
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- Values Section -->
    <section id="values" class="values section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Our Values</h2>
        <p>What makes <strong>Toeicly</strong> stand out</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="card">
              <img src="{{ asset('img/values-1.png') }}" class="img-fluid" alt="User Friendly">
              <h3>User Friendly</h3>
              <p>Antarmuka yang intuitif dan mudah digunakan oleh semua kalangan, dari peserta tes hingga administrator.
              </p>
            </div>
          </div><!-- End Card Item -->

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="card">
              <img src="{{ asset('img/values-2.png') }}" class="img-fluid" alt="Fast & Reliable">
              <h3>Fast & Reliable</h3>
              <p>Proses manajemen tes yang cepat dan handal, memastikan kelancaran pelaksanaan TOEIC tanpa hambatan.</p>
            </div>
          </div><!-- End Card Item -->

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
            <div class="card">
              <img src="{{ asset('img/values-3.png') }}" class="img-fluid" alt="Secure & Supportive">
              <h3>Secure & Supportive</h3>
              <p>Keamanan data terjamin dengan sistem enkripsi dan dukungan profesional yang siap membantu kapan saja.
              </p>
            </div>
          </div><!-- End Card Item -->

        </div>

      </div>

    </section><!-- /Values Section -->


    <!-- Stats Section -->
    <section id="stats" class="stats section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-3 col-md-6">
            <div class="stats-item d-flex align-items-center w-100 h-100">
              <i class="bi bi-emoji-smile color-blue flex-shrink-0"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1"
                  class="purecounter"></span>
                <p>Jumlah Mahasiswa</p>
              </div>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item d-flex align-items-center w-100 h-100">
              <i class="bi bi-journal-richtext color-orange flex-shrink-0" style="color: #ee6c20;"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="7" data-purecounter-duration="1"
                  class="purecounter"></span>
                <p>Jurusan</p>
              </div>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item d-flex align-items-center w-100 h-100">
              <i class="bi bi-headset color-green flex-shrink-0" style="color: #15be56;"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="1463" data-purecounter-duration="1"
                  class="purecounter"></span>
                <p>Hours Of Support</p>
              </div>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item d-flex align-items-center w-100 h-100">
              <i class="bi bi-people color-pink flex-shrink-0" style="color: #bb0852;"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="1"
                  class="purecounter"></span>
                <p>Hard Workers</p>
              </div>
            </div>
          </div><!-- End Stats Item -->

        </div>

      </div>

    </section><!-- /Stats Section -->

    <!-- Features Section -->


    <!-- Alt Features Section -->

    <!-- Services Section -->
    <section id="services" class="services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Services</h2>
        <p>Check Our Services<br></p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item item-cyan position-relative">
              <i class="bi bi-pencil-square icon"></i>
              <h3>Pendaftaran TOEIC</h3>
              <p>Memudahkan peserta dalam proses pendaftaran ujian TOEIC secara online dengan cepat dan aman.</p>

            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item item-orange position-relative">
              <i class="bi bi-calendar-event icon"></i>
              <h3>Manajemen Jadwal Ujian</h3>
              <p>Mengelola dan menjadwalkan pelaksanaan ujian TOEIC dengan sistem yang terorganisir dan terintegrasi.
              </p>

            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item item-teal position-relative">
              <i class="bi bi-award icon"></i>
              <h3>Pengelolaan Sertifikat TOEIC</h3>
              <p>Memudahkan proses pembuatan dan pengelolaan sertifikat TOEIC secara digital dan valid.</p>

            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="service-item item-red position-relative">
              <i class="bi bi-people icon"></i>
              <h3>Manajemen Admin UPA Bahasa</h3>
              <p>Mengelola akun dan hak akses admin untuk kelancaran operasional sistem TOEIC secara profesional.</p>

            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
            <div class="service-item item-indigo position-relative">
              <i class="bi bi-bar-chart-line icon"></i>
              <h3>Mengelola Nilai Hasil Ujian</h3>
              <p>Mencatat, mengelola, dan menampilkan hasil nilai TOEIC secara akurat dan transparan.</p>

            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
            <div class="service-item item-pink position-relative">
              <i class="bi bi-journal-text icon"></i>
              <h3>Melihat Riwayat Ujian</h3>
              <p>Memudahkan peserta dan admin melihat histori ujian TOEIC secara lengkap dan mudah diakses.</p>

            </div>
          </div><!-- End Service Item -->

        </div>

      </div>

    </section>


    <!-- Faq Section -->
    <section id="faq" class="faq section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>F.A.Q</h2>
        <p>Frequently Asked Questions</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row">

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">

            <div class="faq-container">

              <div class="faq-item faq-active">
                <h3>Bagaimana cara mendaftar ujian TOEIC melalui Toeicly?</h3>
                <div class="faq-content">
                  <p>Peserta dapat mendaftar ujian TOEIC secara online dengan membuat akun, mengisi formulir
                    pendaftaran, dan memilih jadwal ujian yang tersedia.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>Apakah saya bisa mengubah jadwal ujian setelah mendaftar?</h3>
                <div class="faq-content">
                  <p>Ya, Anda dapat mengubah jadwal ujian melalui akun Anda dengan syarat dan ketentuan yang berlaku,
                    biasanya paling lambat 3 hari sebelum tanggal ujian.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>Bagaimana cara mendapatkan sertifikat TOEIC setelah ujian?</h3>
                <div class="faq-content">
                  <p>Sertifikat TOEIC akan tersedia secara digital di akun peserta setelah hasil ujian diproses,
                    biasanya dalam waktu 2 minggu setelah ujian.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

            </div>

          </div><!-- End Faq Column-->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">

            <div class="faq-container">

              <div class="faq-item">
                <h3>Bagaimana keamanan data pribadi saya di Toeicly?</h3>
                <div class="faq-content">
                  <p>Kami menjaga keamanan data pribadi peserta dengan sistem enkripsi dan protokol keamanan yang ketat
                    sesuai standar internasional.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>Apakah ada dukungan jika mengalami kesulitan menggunakan sistem?</h3>
                <div class="faq-content">
                  <p>Tim support kami siap membantu Anda melalui fitur kontak bantuan di dalam sistem atau melalui email
                    resmi Toeicly.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>Bisakah saya melihat riwayat hasil ujian saya?</h3>
                <div class="faq-content">
                  <p>Ya, peserta dapat mengakses dan melihat riwayat hasil ujian TOEIC yang pernah diikuti melalui
                    dashboard akun mereka.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

            </div>

          </div><!-- End Faq Column-->

        </div>

      </div>

    </section><!-- /Faq Section -->



    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Testimonials</h2>
        <p>What they are saying about us<br></p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="swiper init-swiper">
          <script type="application/json" class="swiper-config">
        {
          "loop": true,
          "speed": 600,
          "autoplay": {
            "delay": 5000
          },
          "slidesPerView": "auto",
          "pagination": {
            "el": ".swiper-pagination",
            "type": "bullets",
            "clickable": true
          },
          "breakpoints": {
            "320": {
              "slidesPerView": 1,
              "spaceBetween": 40
            },
            "1200": {
              "slidesPerView": 3,
              "spaceBetween": 1
            }
          }
        }
      </script>
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  "Toeicly made registering for the TOEIC test so simple and efficient. The interface is very
                  user-friendly and the support team was extremely helpful."
                </p>
                <div class="profile mt-auto">
                  <img src="{{ asset('img/testimonials/testimonials-1.jpg') }}" class="testimonial-img" alt="User 1">

                  <h3>Emily Johnson</h3>
                  <h4>English Language Student</h4>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  "The scheduling system is very reliable and made it easy for me to choose the best test date. Highly
                  recommend Toeicly!"
                </p>
                <div class="profile mt-auto">
                  <img src="{{ asset('img/testimonials/testimonials-2.jpg') }}" class="testimonial-img" alt="User 2">
                  <h3>Michael Smith</h3>
                  <h4>Corporate Trainer</h4>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  "Managing certificates and exam results was never easier. Toeicly’s digital system saved us time and
                  effort."
                </p>
                <div class="profile mt-auto">
                  <img src="{{ asset('img/testimonials/testimonials-3.jpg') }}" class="testimonial-img" alt="User 3">
                  <h3>Sarah Lee</h3>
                  <h4>HR Manager</h4>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  "Excellent platform for organizing TOEIC tests, with seamless navigation and secure data management."
                </p>
                <div class="profile mt-auto">
                  <img src="{{ asset('img/testimonials/testimonials-4.jpg') }}" class="testimonial-img" alt="User 4">
                  <h3>David Kim</h3>
                  <h4>Education Consultant</h4>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  "Toeicly is a game changer for TOEIC test management, making processes smooth for both participants
                  and administrators."
                </p>
                <div class="profile mt-auto">
                  <img src="{{ asset('img/testimonials/testimonials-5.jpg') }}" class="testimonial-img" alt="User 5">
                  <h3>Linda Martinez</h3>
                  <h4>Language Instructor</h4>
                </div>
              </div>
            </div><!-- End testimonial item -->

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>

    </section><!-- /Testimonials Section -->


    <!-- Team Section -->
    <section id="team" class="team section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Team</h2>
        <p>Our hard working team</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="team-member">
              <div class="member-img">
                <img src="{{ asset('img/team/team-1.jpg') }}" class="img-fluid" alt="Team Member">

                <div class="social">
                  <a href="#"><i class="bi bi-twitter"></i></a>
                  <a href="#"><i class="bi bi-facebook"></i></a>
                  <a href="#"><i class="bi bi-instagram"></i></a>
                  <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Surya Rahmat Fatahillah</h4>
                <span>Project Manager</span>
                <p>Memimpin pengembangan dan koordinasi proyek dengan fokus pada hasil dan kolaborasi tim.</p>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
            <div class="team-member">
              <div class="member-img">
                <img src="{{ asset('img/team/team-2.jpg') }}" class="img-fluid" alt="Team Member">
                <div class="social">
                  <a href="#"><i class="bi bi-twitter"></i></a>
                  <a href="#"><i class="bi bi-facebook"></i></a>
                  <a href="#"><i class="bi bi-instagram"></i></a>
                  <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Imel Theresia BR Sembiring</h4>
                <span>Lead Developer</span>
                <p>Memastikan kualitas kode dan inovasi teknologi dalam pengembangan sistem TOEIC.</p>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
            <div class="team-member">
              <div class="member-img">
                <img src="{{ asset('img/team/team-4.jpg') }}" class="img-fluid" alt="Team Member">
                <div class="social">
                  <a href="#"><i class="bi bi-twitter"></i></a>
                  <a href="#"><i class="bi bi-facebook"></i></a>
                  <a href="#"><i class="bi bi-instagram"></i></a>
                  <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Josephine Antonia</h4>
                <span>UI/UX Designer</span>
                <p>Mendesain antarmuka yang menarik dan pengalaman pengguna yang mudah digunakan.</p>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
            <div class="team-member">
              <div class="member-img">
                <img src="{{ asset('img/team/team-3.jpg') }}" class="img-fluid" alt="Team Member">
                <div class="social">
                  <a href="#"><i class="bi bi-twitter"></i></a>
                  <a href="#"><i class="bi bi-facebook"></i></a>
                  <a href="#"><i class="bi bi-instagram"></i></a>
                  <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Mohammad Syifa’ul Faj Ismunir</h4>
                <span>Backend Developer</span>
                <p>Memastikan performa backend yang handal dan aman untuk sistem manajemen TOEIC.</p>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-3 col-md-6 d-flex justify-content-center align-items-center" data-aos="fade-up"
            data-aos-delay="500">
            <div class="team-member">
              <div class="member-img">
                <img src="{{ asset('img/team/team-2.jpg') }}" class="img-fluid" alt="Team Member">
                <div class="social">
                  <a href="#"><i class="bi bi-twitter"></i></a>
                  <a href="#"><i class="bi bi-facebook"></i></a>
                  <a href="#"><i class="bi bi-instagram"></i></a>
                  <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Muhammad Mahdi Arielreza Hafiz</h4>
                <span>Quality Assurance</span>
                <p>Memastikan kualitas dan kestabilan sistem dengan melakukan pengujian yang menyeluruh.</p>
              </div>
            </div>
          </div><!-- End Team Member -->

        </div>

      </div>

    </section>



  </main>

  <footer id="footer" class="footer">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="d-flex align-items-center">
            <span class="sitename">Toeicly</span>
          </a>
          <div class="footer-contact pt-3">
            <p>Jl. Soekarno Hatta No.9, Jatimulyo, Kec. Lowokwaru, Kota Malang, Jawa Timur 65141</p>
            <p>Kec. Lowokwaru, Kota Malang, Jawa Timur 65141</p>
            <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
            <p><strong>Email:</strong> <span>info@example.com</span></p>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">About us</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Services</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Terms of service</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Web Design</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Web Development</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Product Management</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Marketing</a></li>
          </ul>
        </div>

        <div class="col-lg-4 col-md-12">
          <h4>Follow Us</h4>
          <p>Cras fermentum odio eu feugiat lide par naso tierra videa magna derita valies</p>
          <div class="social-links d-flex">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Toeicly</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        Designed by <a href="https://bootstrapmade.com/">Group 1</a> Distributed by <a
          href=“https://themewagon.com>Toeicly
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ asset('vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('vendor/swiper/swiper-bundle.min.js') }}"></script>
  <!-- Main JS File -->
  <script src="{{ asset('js/main.js') }}"></script>

</body>

</html>