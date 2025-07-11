<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

$host = "localhost";
$user = "root";
$pass = "";
$db = "desa_katingan";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data statistik
$totalPenduduk = $conn->query("SELECT COUNT(*) as total FROM penduduk")->fetch_assoc()['total'];
$jumlahSurat = $conn->query("SELECT COUNT(*) as total FROM surat")->fetch_assoc()['total'];
$pendudukL = $conn->query("SELECT COUNT(*) as total FROM penduduk WHERE jenis_kelamin='Laki-laki'")->fetch_assoc()['total'];
$pendudukP = $conn->query("SELECT COUNT(*) as total FROM penduduk WHERE jenis_kelamin='Perempuan'")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin Desa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-dark bg-primary">
  <div class="container-fluid">
    <span class="navbar-brand mb-0 h1">Dashboard Admin - <?= $_SESSION['role'] ?></span>
    <a href="logout.php" class="btn btn-light btn-sm">Logout</a>
  </div>
</nav>

<div class="container mt-4">
    <h3>Selamat datang, <?= $_SESSION['username']; ?>!</h3>

    <!-- Overview -->
    <div class="row my-4">
        <div class="col-md-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5>Total Penduduk</h5>
                    <h3><?= $totalPenduduk ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5>Laki-laki</h5>
                    <h3><?= $pendudukL ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5>Perempuan</h5>
                    <h3><?= $pendudukP ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5>Surat Masuk</h5>
                    <h3><?= $jumlahSurat ?></h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Manajemen Data Warga -->
    <div class="card mb-4">
        <div class="card-header bg-secondary text-white">Manajemen Data Warga</div>
        <div class="card-body">
            <a href="penduduk.php" class="btn btn-outline-primary">Kelola Data Warga</a>
        </div>
    </div>

    <!-- Surat Menyurat -->
    <div class="card mb-4">
        <div class="card-header bg-secondary text-white">Surat Menyurat Digital</div>
        <div class="card-body">
            <a href="surat.php" class="btn btn-outline-success">Kelola Surat</a>
        </div>
    </div>
</div>
</body>
</html>
