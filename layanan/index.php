<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Layanan Publik - Desa Digital</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
      <a class="navbar-brand" href="../index.php">SiDeKa</a>
    </div>
  </nav>

  <!-- Header -->
  <header class="py-5 text-center bg-white shadow-sm">
    <div class="container">
      <h1 class="fw-bold">Layanan Publik Desa</h1>
      <p class="lead">Ajukan surat, pantau status, dan unduh dokumen resmi secara online</p>
    </div>
  </header>

  <!-- Menu Layanan -->
<section class="py-5 text-center">
  <div class="container">
    <div class="row g-4 justify-content-center">

      <!-- Ajukan Surat -->
      <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-body text-center">
            <h5 class="card-title mb-3">Pengajuan Surat Online</h5>
            <p class="card-text">Ajukan surat domisili, usaha, atau keterangan lain dengan cepat.</p>
            <a href="ajukan.php" class="btn btn-outline-primary w-100">Ajukan Sekarang</a>
          </div>
        </div>
      </div>

      <!-- Tracking Status -->
      <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-body text-center">
            <h5 class="card-title mb-3">Status Pengajuan</h5>
            <p class="card-text">Lihat progres pengajuan surat Anda secara real-time.</p>
            <a href="status.php" class="btn btn-outline-success w-100">Cek Status</a>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>


  <!-- Footer -->
  <footer class="bg-primary text-white text-center py-3 mt-auto">
    <div class="container">
      &copy; 2025 Sistem Informasi Desa Digital - Kabupaten Katingan
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
