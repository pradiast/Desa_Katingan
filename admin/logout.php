<?php
session_start();

// Hapus semua data sesi
session_unset();
session_destroy();

// Redirect ke halaman login (index.php di folder admin)
header("Location: index.php");
exit;
