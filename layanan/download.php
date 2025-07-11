<?php
if (!isset($_GET['file'])) {
    die("File tidak ditemukan.");
}

$file = '../uploads/' . basename($_GET['file']);

if (!file_exists($file)) {
    die("File tidak tersedia.");
}

// Menentukan MIME type berdasarkan ekstensi file
$ext = pathinfo($file, PATHINFO_EXTENSION);
$mime_types = [
    'pdf' => 'application/pdf',
    'doc' => 'application/msword',
    'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
];

$mime = isset($mime_types[$ext]) ? $mime_types[$ext] : 'application/octet-stream';

// Header agar browser memaksa unduh
header('Content-Description: File Transfer');
header('Content-Type: ' . $mime);
header('Content-Disposition: attachment; filename="' . basename($file) . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($file));
readfile($file);
exit;
