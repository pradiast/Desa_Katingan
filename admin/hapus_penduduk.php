<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

$host = "localhost";
$user = "root";
$pass = "";
$db   = "desa_katingan";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil ID penduduk dari parameter GET
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Hapus data jika ID valid
if ($id > 0) {
    $stmt = $conn->prepare("DELETE FROM penduduk WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "<script>alert('Data penduduk berhasil dihapus.'); window.location.href='penduduk.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data penduduk.'); window.location.href='penduduk.php';</script>";
    }
} else {
    echo "<script>alert('ID tidak valid.'); window.location.href='penduduk.php';</script>";
}
?>
