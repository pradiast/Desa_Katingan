<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>SiDeKa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
    }

    .navbar-brand {
      font-weight: bold;
      letter-spacing: 1px;
    }

    header {
      background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('profil/banner-desa.jpg') center/cover no-repeat;
      color: white;
    }

    header h1 {
      animation: fadeInDown 1s ease;
    }

    .card:hover {
      transform: scale(1.03);
      transition: transform 0.3s ease;
    }

    @keyframes fadeInDown {
      from {
        opacity: 0;
        transform: translateY(-20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    footer {
      font-size: 0.9rem;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="index.php">SiDeKa</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="layanan">Portal Layanan Publik</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Header -->
  <header class="py-5 text-center">
    <div class="container">
      <h1 class="display-4 fw-bold">Selamat Datang di Portal SiDeKa</h1>
      <p class="lead">Menghubungkan warga Desa Katingan dengan layanan publik secara digital</p>
    </div>
  </header>

  <!-- Profil Desa -->
  <section id="profil" class="bg-light py-5">
    <div class="container">
      <h2 class="text-center mb-5 fw-semibold">Profil Desa</h2>
      
      <div class="row mb-4">
        <div class="col-md-6">
          <h5>Informasi Geografis</h5>
          <p>Desa Tumbang Samba terletak di Kabupaten Katingan, Kalimantan Tengah, dengan koordinat <strong>-1.8500, 113.3000</strong>. Luas wilayah desa mencapai <strong>35,50 km<sup>2</sup></strong>.</p>
        </div>
        <div class="col-md-6">
          <h5>Data Demografis</h5>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Jumlah Penduduk: <strong>1.200 Jiwa</strong></li>
            <li class="list-group-item">Jumlah Kepala Keluarga: <strong>350 KK</strong></li>
            <li class="list-group-item">Dominasi Pekerjaan: <strong>Petani, Pengrajin</strong></li>
          </ul>
        </div>
      </div>

      <div class="row mb-4">
        <div class="col-md-6">
          <h5>Potensi Wisata</h5>
          <p><strong>Air Terjun Batu Mahasur</strong> adalah destinasi wisata utama yang cocok untuk ekowisata dan petualangan alam.</p>
        </div>
        <div class="col-md-6">
          <h5>Potensi UMKM</h5>
          <p>UMKM desa meliputi kerajinan rotan, anyaman, makanan lokal seperti keripik singkong, dan produksi madu hutan.</p>
        </div>
      </div>

      <h5 class="mb-3">Galeri Kegiatan</h5>
      <div class="row">
        <div class="col-md-4 mb-4">
          <div class="card shadow-sm h-100 border-0">
            <img src="profil/festival.jpeg" class="card-img-top" alt="Festival Budaya">
            <div class="card-body text-center">
              <p class="card-text fw-semibold">Festival Budaya 2025</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="card shadow-sm h-100 border-0">
            <img src="profil/UMKM.jpeg" class="card-img-top" alt="UMKM">
            <div class="card-body text-center">
              <p class="card-text fw-semibold">Produk UMKM Lokal</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="card shadow-sm h-100 border-0">
            <img src="profil/airterjun.jpeg" class="card-img-top" alt="Air Terjun">
            <div class="card-body text-center">
              <p class="card-text fw-semibold">Air Terjun Batu Mahasur</p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-primary text-white text-center py-3 mt-5">
    <div class="container">
      &copy; 2025 Sistem Informasi Desa Digital - Kabupaten Katingan
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
