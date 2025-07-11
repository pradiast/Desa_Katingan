-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2025 at 08:33 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `desa_katingan`
--

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id` int(11) NOT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `file_foto` varchar(255) DEFAULT NULL,
  `tanggal_upload` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id`, `judul`, `deskripsi`, `file_foto`, `tanggal_upload`) VALUES
(1, 'Festival Budaya Desa', 'Kegiatan tahunan untuk mempromosikan budaya lokal.', 'festival2025.jpg', '2025-06-01');

-- --------------------------------------------------------

--
-- Table structure for table `penduduk`
--

CREATE TABLE `penduduk` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `nik` varchar(16) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `umur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penduduk`
--

INSERT INTO `penduduk` (`id`, `nama`, `nik`, `jenis_kelamin`, `umur`) VALUES
(15, 'bima', '6211030577777777', 'Laki-laki', 11),
(16, 'gita', '6234175362138', 'Perempuan', 23);

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_surat`
--

CREATE TABLE `pengajuan_surat` (
  `id` int(11) NOT NULL,
  `nama_pemohon` varchar(100) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `jenis_surat` varchar(100) NOT NULL,
  `status` enum('Diajukan','Diproses','Selesai','Ditolak') DEFAULT 'Diajukan',
  `tanggal_pengajuan` datetime DEFAULT current_timestamp(),
  `file_lampiran` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengajuan_surat`
--

INSERT INTO `pengajuan_surat` (`id`, `nama_pemohon`, `nik`, `jenis_surat`, `status`, `tanggal_pengajuan`, `file_lampiran`) VALUES
(1, 'bima', '6211030577777777', 'Surat Keterangan Tidak Mampu', 'Selesai', '2025-07-11 10:53:11', '../uploads/1752207716_dokumen.pdf'),
(2, 'gita', '6234175362138', 'Surat Keterangan Usaha', 'Selesai', '2025-07-11 11:51:44', '../uploads/1752209532_dokumen.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `profil_desa`
--

CREATE TABLE `profil_desa` (
  `id` int(11) NOT NULL,
  `nama_desa` varchar(100) DEFAULT NULL,
  `jumlah_penduduk` int(11) DEFAULT NULL,
  `luas_wilayah` decimal(10,2) DEFAULT NULL,
  `potensi_umkm` text DEFAULT NULL,
  `potensi_wisata` text DEFAULT NULL,
  `geo_info` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profil_desa`
--

INSERT INTO `profil_desa` (`id`, `nama_desa`, `jumlah_penduduk`, `luas_wilayah`, `potensi_umkm`, `potensi_wisata`, `geo_info`) VALUES
(1, 'Desa Tumbang Samba', 1200, 35.50, 'Kerajinan Rotan, Anyaman', 'Air Terjun Batu Mahasur', 'Koordinat: -1.8500, 113.3000');

-- --------------------------------------------------------

--
-- Table structure for table `surat`
--

CREATE TABLE `surat` (
  `id` int(11) NOT NULL,
  `jenis_surat` varchar(100) DEFAULT NULL,
  `nama_pemohon` varchar(100) DEFAULT NULL,
  `tanggal_permohonan` date DEFAULT NULL,
  `status` enum('Diproses','Selesai') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('kepala_desa','sekretaris','kaur') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin_kades', 'admin123', 'kepala_desa'),
(2, 'sekretaris_desa', 'sekre123', 'sekretaris'),
(3, 'kaur_umum', 'kaur123', 'kaur'),
(4, 'kepaladesa', '$2y$10$QQQsrt6nE.DqSpsfYDmMLuSkbbyp61ajAw/v704frNCmsDwxLx5EC', '');

-- --------------------------------------------------------

--
-- Table structure for table `warga`
--

CREATE TABLE `warga` (
  `id` int(11) NOT NULL,
  `nik` char(16) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `pekerjaan` varchar(100) DEFAULT NULL,
  `status_perkawinan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `warga`
--

INSERT INTO `warga` (`id`, `nik`, `nama`, `alamat`, `tanggal_lahir`, `jenis_kelamin`, `pekerjaan`, `status_perkawinan`) VALUES
(1, '6201010101010001', 'Budi Santoso', 'Desa Tumbang Samba', '1990-05-21', 'Laki-laki', 'Petani', 'Menikah'),
(2, '6201010101010002', 'Siti Aminah', 'Desa Tumbang Samba', '1995-08-15', 'Perempuan', 'Ibu Rumah Tangga', 'Menikah');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengajuan_surat`
--
ALTER TABLE `pengajuan_surat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profil_desa`
--
ALTER TABLE `profil_desa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat`
--
ALTER TABLE `surat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warga`
--
ALTER TABLE `warga`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `penduduk`
--
ALTER TABLE `penduduk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pengajuan_surat`
--
ALTER TABLE `pengajuan_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `profil_desa`
--
ALTER TABLE `profil_desa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `surat`
--
ALTER TABLE `surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `warga`
--
ALTER TABLE `warga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
