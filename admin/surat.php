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

// Ubah status manual
if (isset($_GET['ubah_status']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $status = $_GET['ubah_status'];

    if (in_array($status, ['Menunggu', 'Disetujui', 'Ditolak', 'Selesai'])) {
        $stmt = $conn->prepare("UPDATE pengajuan_surat SET status=? WHERE id=?");
        $stmt->bind_param("si", $status, $id);
        $stmt->execute();
    }
    header("Location: surat.php");
    exit;
}

// Upload surat dari admin (dokumen balasan)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload_id'])) {
    $id = intval($_POST['upload_id']);

    if (!empty($_FILES['file_lampiran']['name'])) {
        $target_dir = "../uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $allowed_ext = ['pdf', 'doc', 'docx'];
        $file_name = basename($_FILES["file_lampiran"]["name"]);
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if (!in_array($file_ext, $allowed_ext)) {
            echo "<script>alert('Hanya file PDF, DOC, dan DOCX yang diizinkan.');window.location='surat.php';</script>";
            exit;
        }

        $safe_name = time() . "_" . preg_replace('/[^a-zA-Z0-9_.]/', '_', $file_name);
        $target_file = $target_dir . $safe_name;

        if (move_uploaded_file($_FILES["file_lampiran"]["tmp_name"], $target_file)) {
            $stmt = $conn->prepare("UPDATE pengajuan_surat SET file_lampiran=?, status='Selesai' WHERE id=?");
            $stmt->bind_param("si", $target_file, $id);
            $stmt->execute();
        }
    }

    header("Location: surat.php");
    exit;
}

// Ambil data pengajuan
$result = $conn->query("SELECT * FROM pengajuan_surat ORDER BY tanggal_pengajuan DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Surat - Admin Desa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-dark bg-primary">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 h1">Kelola Surat - <?= $_SESSION['role'] ?></span>
        <a href="dashboard.php" class="btn btn-light btn-sm">Kembali</a>
    </div>
</nav>

<div class="container mt-4">
    <h3>Daftar Pengajuan Surat</h3>
    <table class="table table-bordered table-striped mt-3">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Pemohon</th>
                <th>NIK</th>
                <th>Jenis Surat</th>
                <th>Status</th>
                <th>Tgl Pengajuan</th>
                <th>Lampiran Balasan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($result->num_rows > 0): $no = 1; ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($row['nama_pemohon']) ?></td>
                    <td><?= htmlspecialchars($row['nik']) ?></td>
                    <td><?= htmlspecialchars($row['jenis_surat']) ?></td>
                    <td>
                        <span class="badge bg-<?= 
                            $row['status'] == 'Selesai' ? 'primary' :
                            ($row['status'] == 'Disetujui' ? 'success' :
                            ($row['status'] == 'Ditolak' ? 'danger' : 'secondary')) ?>">
                            <?= $row['status'] ?>
                        </span>
                    </td>
                    <td><?= date("d-m-Y", strtotime($row['tanggal_pengajuan'])) ?></td>
                    <td>
                        <?php if (!empty($row['file_lampiran'])): ?>
                            <a href="<?= $row['file_lampiran'] ?>" target="_blank" class="btn btn-sm btn-outline-info">Lihat</a>
                        <?php else: ?>
                            <form method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="upload_id" value="<?= $row['id'] ?>">
                                <input type="file" name="file_lampiran" class="form-control form-control-sm" required accept=".pdf,.doc,.docx">
                                <button type="submit" class="btn btn-sm btn-success mt-1">Upload</button>
                            </form>
                        <?php endif; ?>
                    </td>
                   <td>
                    <div class="d-grid gap-1">
                        <a href="?ubah_status=Disetujui&id=<?= $row['id'] ?>" class="btn btn-sm btn-success">Setujui</a>
                        <a href="?ubah_status=Ditolak&id=<?= $row['id'] ?>" class="btn btn-sm btn-danger">Tolak</a>
                        <a href="?ubah_status=Selesai&id=<?= $row['id'] ?>" class="btn btn-sm btn-primary" onclick="return confirm('Tandai surat ini sebagai selesai?')">Selesai</a>
                    </div>
                </td>

                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="8" class="text-center">Belum ada pengajuan surat.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
