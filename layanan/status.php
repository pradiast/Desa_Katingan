<?php
include '../includes/db.php';

$status = "";
$data = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nik = $_POST['nik'];

  $stmt = $koneksi->prepare("SELECT * FROM pengajuan_surat WHERE nik = ? ORDER BY tanggal_pengajuan DESC");
  $stmt->bind_param("s", $nik);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $data[] = $row;
    }
  } else {
    $status = "NIK tidak ditemukan atau belum ada pengajuan.";
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Cek Status Surat</title>
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
      <div class="col-md-10">
        <div class="card shadow-sm p-4">
          <h4 class="mb-4 text-center">Cek Status Pengajuan Surat</h4>

          <form method="POST" class="mb-4">
            <div class="input-group">
              <input type="text" name="nik" class="form-control" placeholder="Masukkan NIK Anda" required />
              <button type="submit" class="btn btn-primary">Cek Status</button>
            </div>
          </form>

          <?php if ($status): ?>
            <div class="alert alert-warning"><?= $status ?></div>
          <?php endif; ?>

          <?php if (!empty($data)): ?>
            <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <thead class="table-primary">
                  <tr>
                    <th>Tanggal</th>
                    <th>Jenis Surat</th>
                    <th>Status</th>
                    <th>Catatan</th>
                    <th>File</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($data as $item): ?>
                  <tr>
                    <td><?= date('d-m-Y', strtotime($item['tanggal_pengajuan'])) ?></td>
                    <td><?= htmlspecialchars($item['jenis_surat']) ?></td>
                    <td>
                      <span class="badge bg-<?= $item['status'] == 'Selesai' ? 'success' : ($item['status'] == 'Ditolak' ? 'danger' : 'warning') ?>">
                        <?= $item['status'] ?>
                      </span>
                    </td>
                    <td><?= htmlspecialchars($item['catatan'] ?? '-') ?></td>
                   <td>
                        <?php if ($item['status'] === 'Selesai' && !empty($item['file_lampiran'])): ?>
                            <?php
                            $filepath = $item['file_lampiran'];
                            $filename = basename($filepath);
                            if (file_exists($filepath)):
                            ?>
                            <a href="<?= htmlspecialchars($filepath) ?>" class="btn btn-sm btn-info" target="_blank">Unduh</a>
                            <?php else: ?>
                            <span class="text-danger">File tidak ditemukan</span>
                            <?php endif; ?>
                        <?php else: ?>
                            <span class="text-muted">Tidak tersedia</span>
                        <?php endif; ?>
                        </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          <?php endif; ?>

        </div>
      </div>
    </div>
  </div>

</body>
</html>
