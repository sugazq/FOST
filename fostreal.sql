-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 16, 2024 at 03:39 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fostreal`
--

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` char(16) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(32) NOT NULL,
  `tlpn` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama`, `username`, `password`, `tlpn`) VALUES
('123', 'Aina', 'N', 'd79c8788088c2193f0244d8f1f36d2db', '123'),
('1237050001', 'ridho ahmad saputra', 'xion', 'a26132066568c76e57a5356816c66c0d', '082380726786'),
('1237050004', 'dione', 'dione', '785b1acb864ea0134efa806b8702482c', '085840952151'),
('1237050009', 'rizal', 'jalu', '0b0176c84dfb4641757bd0ec6f068d8c', '085295081643'),
('123705001', 'romi', 'romi', '910b6c78a8482033b971116f02441ce4', '085840952151'),
('1237050012', 'jekson', 'burcok', '6bc1e6936349fbb513a798fb0009294b', '085134228644'),
('1237050031', 'agus', 'agus', 'fdf169558242ee051cca1479770ebac3', '082113425288'),
('1237050032', 'Joko', 'joko', '202cb962ac59075b964b07152d234b70', '089646494949'),
('1237050033', 'agus', 'riram', 'e10adc3949ba59abbe56e057f20f883e', '08953657898'),
('1237050036', 'annisa', 'annisa', 'c9d2cce909ea37234be8af1a1f958805', '085134228644'),
('1237050037', 'Ireh', 'Ireh', '202cb962ac59075b964b07152d234b70', '08583253653'),
('1237050068', 'Alfianadzt', 'Alfian', 'e10adc3949ba59abbe56e057f20f883e', '085840952151'),
('1237050070', 'ridho ahmad syahputra', 'idho', 'ab0962f458bd6aeb58237907b65ecfe9', '085840952151'),
('1237050127', 'Annisa', 'Nurhaliza', '81dc9bdb52d04dc20036dbd8313ed055', '083896140240'),
('127', 'Annisa', 'N', '74b87337454200d4d33f80c4663dc5e5', '083896140240');

-- --------------------------------------------------------

--
-- Table structure for table `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id_pengaduan` int NOT NULL,
  `tgl_pengaduan` datetime DEFAULT CURRENT_TIMESTAMP,
  `nim` char(16) NOT NULL,
  `isi_laporan` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `status` enum('menunggu','proses','selesai') NOT NULL,
  `jenis` varchar(50) DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `kordinat` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `kategori` varchar(255) DEFAULT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `warna` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengaduan`
--

INSERT INTO `pengaduan` (`id_pengaduan`, `tgl_pengaduan`, `nim`, `isi_laporan`, `foto`, `status`, `jenis`, `lokasi`, `kordinat`, `username`, `kategori`, `nama_barang`, `warna`) VALUES
(34, '2024-12-07 14:19:12', '1237050004', 'kehilangan dompet', '44-dompet.jpeg', 'menunggu', 'Kehilangan', 'parkiran kujang', NULL, 'dione', 'Aksesoris', NULL, NULL),
(39, '2024-12-07 19:46:21', '1237050036', 'telah kehilangan kalung emas dengan motif permata di area fst ', '158-kalung.jpeg', 'menunggu', 'Kehilangan', '3.14', NULL, 'annisa', 'Perhiasan', NULL, NULL),
(40, '2024-12-07 22:17:37', '1237050012', 'telah hilang helm bermerek kyt dengan corak hitam warna merah motif seperti ada gigi', '513-helm.jpeg', 'menunggu', 'Kehilangan', 'Lt 3.14', NULL, 'burcok', 'Aksesoris', NULL, NULL),
(41, '2024-12-08 20:00:01', '1237050009', 'telah hilang cincin emas 2 pasang terakhir kali ingat di parkiran syarkum', '446-cincin.jpeg', 'menunggu', 'Kehilangan', 'parkiran kujang', NULL, 'jalu', 'Perhiasan', NULL, NULL),
(42, '2024-12-08 21:25:24', '1237050031', 'menemukan uang 100rb 5 lembar', '567-uang.jpeg', 'menunggu', 'Menemukan', 'lt 4.12', NULL, 'agus', 'Perhiasan', NULL, NULL),
(46, '2024-12-09 07:39:38', '1237050031', 'menemukan jam tangan bermerek martin warna hitam dengan stiker dibelakang bertuliskan sasageyo', '704-jam.jpeg', 'menunggu', 'Menemukan', 'lt 1.12', NULL, 'agus', 'Aksesoris', NULL, NULL),
(48, '2024-12-09 09:26:28', '1237050031', 'menemukan casan bertipe C warna putih dengan merek xiaomi', '60-casan.jpeg', 'menunggu', 'Menemukan', 'lt 4.12', NULL, 'agus', 'Elektronik', NULL, NULL),
(49, '2024-12-09 09:53:07', '1237050031', 'Kehilangan motor beat jenis karbu warna hitam dengan stiker Gundam didepan dan juga motif joknya seperti sarang laba laba spiderman', '199-beat.jpeg', 'menunggu', 'Kehilangan', 'Parkiran Kujang', NULL, 'agus', 'Kendaraan', NULL, NULL),
(51, '2024-12-09 13:17:26', '1237050031', 'saya menemukan jam tangan hitam', '866-jam.jpeg', 'menunggu', 'Menemukan', 'lt  2.13', NULL, 'agus', 'Aksesoris', NULL, NULL),
(55, '2024-12-16 10:33:54', '1237050001', 'kehilangan speaker merek thinkpluss warna hitam dengan gantungan spongebob dan stiker anime perempuan rambut biru', '677-speaker.jpeg', 'proses', 'Kehilangan', 'lt 4.12', NULL, 'xion', 'Elektronik', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int NOT NULL,
  `nama_petugas` varchar(35) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(32) NOT NULL,
  `telp` varchar(13) NOT NULL,
  `level` enum('admin','petugas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama_petugas`, `username`, `password`, `telp`, `level`) VALUES
(1, 'Ahmad', 'admin', '21232f297a57a5a743894a0e4a801fc3', '08583253653', 'admin'),
(2, 'Asep', 'petugas', 'afb91ef692fd08c445e8cb1bab2ccf9c', '08583253653', 'petugas');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat`
--

CREATE TABLE `riwayat` (
  `id_riwayat` int NOT NULL,
  `nim` varchar(20) NOT NULL,
  `isi_laporan` text NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `tgl_pengaduan` datetime DEFAULT CURRENT_TIMESTAMP,
  `foto` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Selesai'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `riwayat`
--

INSERT INTO `riwayat` (`id_riwayat`, `nim`, `isi_laporan`, `lokasi`, `jenis`, `kategori`, `tgl_pengaduan`, `foto`, `status`) VALUES
(1, '1237050031', 'asdasdas', 'dsadfasdas', 'Kehilangan', 'Perhiasan', '2024-12-16 10:15:47', '595-w.PNG', 'selesai'),
(2, '1237050001', 'telah menemukan tumbler  warna hitam dengan tutup warna biru merek tupperware', 'lt  2.13', 'Menemukan', 'Peralatan', '2024-12-16 10:36:18', '914-tumbler.jpeg', 'selesai');

-- --------------------------------------------------------

--
-- Table structure for table `tanggapan`
--

CREATE TABLE `tanggapan` (
  `id_tanggapan` int NOT NULL,
  `id_pengaduan` int NOT NULL,
  `tgl_tanggapan` date NOT NULL,
  `tanggapan` text NOT NULL,
  `nim` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tanggapan`
--

INSERT INTO `tanggapan` (`id_tanggapan`, `id_pengaduan`, `tgl_tanggapan`, `tanggapan`, `nim`) VALUES
(1, 0, '2024-12-07', 'ditemukan', '1237050004'),
(2, 0, '2024-12-07', 'saya menemukannya', '1237050004'),
(3, 37, '2024-12-07', 'saya menemukannya', '1237050031'),
(4, 37, '2024-12-07', 'saya menemukannya', '1237050031'),
(5, 37, '2024-12-07', 'saya menemukannya', '1237050031'),
(6, 37, '2024-12-07', 'aaaa', '1237050031');

-- --------------------------------------------------------

--
-- Table structure for table `tanggapan_pengaduan`
--

CREATE TABLE `tanggapan_pengaduan` (
  `id_tanggapan` int NOT NULL,
  `id_pengaduan` int NOT NULL,
  `nim_penanggap` varchar(20) NOT NULL,
  `tanggapan` text NOT NULL,
  `tgl_tanggapan` datetime NOT NULL,
  `status` enum('menunggu','proses','selesai') DEFAULT 'menunggu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id_pengaduan`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `riwayat`
--
ALTER TABLE `riwayat`
  ADD PRIMARY KEY (`id_riwayat`);

--
-- Indexes for table `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD PRIMARY KEY (`id_tanggapan`);

--
-- Indexes for table `tanggapan_pengaduan`
--
ALTER TABLE `tanggapan_pengaduan`
  ADD PRIMARY KEY (`id_tanggapan`),
  ADD KEY `id_pengaduan` (`id_pengaduan`),
  ADD KEY `nim_penanggap` (`nim_penanggap`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id_pengaduan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `riwayat`
--
ALTER TABLE `riwayat`
  MODIFY `id_riwayat` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tanggapan`
--
ALTER TABLE `tanggapan`
  MODIFY `id_tanggapan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tanggapan_pengaduan`
--
ALTER TABLE `tanggapan_pengaduan`
  MODIFY `id_tanggapan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tanggapan_pengaduan`
--
ALTER TABLE `tanggapan_pengaduan`
  ADD CONSTRAINT `tanggapan_pengaduan_ibfk_1` FOREIGN KEY (`id_pengaduan`) REFERENCES `pengaduan` (`id_pengaduan`) ON DELETE CASCADE,
  ADD CONSTRAINT `tanggapan_pengaduan_ibfk_2` FOREIGN KEY (`nim_penanggap`) REFERENCES `mahasiswa` (`nim`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
