<?php
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $nama = $_POST['nama'];
  $nik = $_POST['nik'];
  $jk = $_POST['jenis_kelamin'];
  $umur = $_POST['umur'];

  $stmt = $koneksi->prepare("INSERT INTO penduduk (nama, nik, jenis_kelamin, umur) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("sssi", $nama, $nik, $jk, $umur);
  $stmt->execute();

  header("Location: penduduk.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Penduduk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
  <h3>Tambah Penduduk</h3>

  <form action="" method="POST" class="mt-3">
    <div class="mb-2">
      <label>Nama</label>
      <input type="text" name="nama" class="form-control" required>
    </div>
    <div class="mb-2">
      <label>NIK</label>
      <input type="text" name="nik" class="form-control" required>
    </div>
    <div class="mb-2">
      <label>Jenis Kelamin</label>
      <select name="jenis_kelamin" class="form-control" required>
        <option value="">-- Pilih --</option>
        <option value="Laki-laki">Laki-laki</option>
        <option value="Perempuan">Perempuan</option>
      </select>
    </div>
    <div class="mb-2">
      <label>Umur</label>
      <input type="number" name="umur" class="form-control" required>
    </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    <a href="penduduk.php" class="btn btn-secondary">Kembali</a>
  </form>
</body>
</html>
