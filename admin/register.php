<?php
session_start();

// Cek apakah user sudah login (opsional)
if (!isset($_SESSION['username'])) {
    // header("Location: index.php");
    // exit;
}

// Koneksi ke database
$host = "localhost";
$user = "root";
$pass = "";
$db = "desa_katingan";
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$success = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $role     = $_POST['role'];

    // Validasi input sederhana
    if (empty($username) || empty($password) || empty($role)) {
        $error = "Semua field harus diisi.";
    } else {
        // Cek apakah username sudah ada
        $check = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $check->bind_param("s", $username);
        $check->execute();
        $res = $check->get_result();

        if ($res->num_rows > 0) {
            $error = "Username sudah digunakan.";
        } else {
            // Simpan user baru
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $hashed, $role);

            if ($stmt->execute()) {
                $success = "User berhasil didaftarkan.";
            } else {
                $error = "Gagal menambahkan user.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi User Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="text-center mb-4">Registrasi User Baru</h3>

                        <?php if ($success): ?>
                            <div class="alert alert-success"><?= $success ?></div>
                        <?php elseif ($error): ?>
                            <div class="alert alert-danger"><?= $error ?></div>
                        <?php endif; ?>

                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Role</label>
                                <select name="role" class="form-select" required>
                                    <option value="">-- Pilih Role --</option>
                                    <option value="Kepala Desa">Kepala Desa</option>
                                    <option value="Sekretaris">Sekretaris</option>
                                    <option value="Kaur">Kaur</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Daftarkan</button>
                        </form>

                        <a href="dashboard.php" class="btn btn-link mt-3 d-block text-center">← Kembali ke Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
