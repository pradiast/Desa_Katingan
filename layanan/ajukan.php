<?php
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $jenis_surat = $_POST['jenis_surat'];
  $nama_pemohon = $_POST['nama_pemohon'];
  $nik = $_POST['nik'];

  $stmt = $koneksi->prepare("INSERT INTO pengajuan_surat (nama_pemohon, nik, jenis_surat, status, tanggal_pengajuan) VALUES (?, ?, ?, 'Diajukan', NOW())");
  $stmt->bind_param("sss", $nama_pemohon, $nik, $jenis_surat);
  $stmt->execute();

  $sukses = "Surat berhasil diajukan.";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Ajukan Surat</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
      <a class="navbar-brand" href="../index.php">SiDeKa</a>
    </div>
  </nav>

  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-sm p-4">
          <h4 class="mb-3 text-center">Form Pengajuan Surat</h4>

          <?php if (!empty($sukses)): ?>
            <div class="alert alert-success"><?= $sukses ?></div>
          <?php endif; ?>

          <form method="POST">
            <div class="mb-3">
              <label for="nama_pemohon" class="form-label">Nama Pemohon</label>
              <input type="text" class="form-control" id="nama_pemohon" name="nama_pemohon" required>
            </div>
            <div class="mb-3">
              <label for="nik" class="form-label">NIK</label>
              <input type="text" class="form-control" id="nik" name="nik" required>
            </div>
            <div class="mb-3">
              <label for="jenis_surat" class="form-label">Jenis Surat</label>
              <select class="form-select" id="jenis_surat" name="jenis_surat" required>
                <option value="">-- Pilih Jenis Surat --</option>
                <option value="Surat Domisili">Surat Domisili</option>
                <option value="Surat Keterangan Usaha">Surat Keterangan Usaha</option>
                <option value="Surat Keterangan Tidak Mampu">Surat Keterangan Tidak Mampu</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Ajukan Surat</button>
          </form>

        </div>
      </div>
    </div>
  </div>

</body>
</html>
