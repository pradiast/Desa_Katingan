<?php
session_start();
include '../includes/db.php';

$result = $koneksi->query("SELECT * FROM penduduk");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kelola Penduduk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

  <h3 class="mb-3">Kelola Penduduk</h3>

  <a href="tambah_penduduk.php" class="btn btn-primary mb-3">+ Tambah Penduduk</a>

  <table class="table table-bordered table-hover">
    <thead class="table-light">
      <tr>
        <th>No</th>
        <th>NIK</th>
        <th>Nama</th>
        <th>Jenis Kelamin</th>
        <th>Umur</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      while ($row = $result->fetch_assoc()):
      ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= $row['nik'] ?></td>
        <td><?= $row['nama'] ?></td>
        <td><?= $row['jenis_kelamin'] ?></td>
        <td><?= $row['umur'] ?></td>
        <td>
          <a href="hapus_penduduk.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-danger btn-sm">Hapus</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</body>
</html>
