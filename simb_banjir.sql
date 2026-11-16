-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2026 at 03:04 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simb_banjir`
--

-- --------------------------------------------------------

--
-- Table structure for table `kejadian`
--

CREATE TABLE `kejadian` (
  `id` int(11) NOT NULL,
  `lokasi` varchar(150) NOT NULL,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `tanggal` date NOT NULL,
  `tinggi_air` int(11) DEFAULT NULL,
  `cuaca` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kejadian`
--

INSERT INTO `kejadian` (`id`, `lokasi`, `lat`, `lng`, `tanggal`, `tinggi_air`, `cuaca`, `status`) VALUES
(1, 'Kabupaten Bantul (Sungai Celeng & Wukirsari, Imogiri)', -7.9255, 110.3833, '2025-03-28', 60, 'Hujan Intensitas Tinggi', 'Surut'),
(2, 'Kabupaten Kulon Progo (Perum Bumi Progo, Pengasih)', -7.8344, 110.1558, '2025-03-28', 150, 'Hujan Lebat', 'Surut'),
(3, 'Kabupaten Gunungkidul (Kec. Wonosari, Playen)', -7.962, 110.5976, '2025-03-28', 70, 'Hujan Deras', 'Surut');

-- --------------------------------------------------------

--
-- Table structure for table `orang`
--

CREATE TABLE `orang` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `usia` tinyint(4) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT 'L',
  `alamat` varchar(255) DEFAULT NULL,
  `ciri` text DEFAULT NULL,
  `kontak` varchar(60) DEFAULT NULL,
  `lokasi_terakhir` varchar(255) DEFAULT NULL,
  `status` enum('hilang','ditemukan','mengungsi','dirawat') DEFAULT 'hilang',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orang`
--

INSERT INTO `orang` (`id`, `nama`, `usia`, `jenis_kelamin`, `alamat`, `ciri`, `kontak`, `lokasi_terakhir`, `status`, `created_at`) VALUES
(1, 'budi', 34, 'P', 'kledokan', 'cowok', '098754', 'jogja', 'hilang', '2026-11-13 11:45:42');

-- --------------------------------------------------------

--
-- Table structure for table `pantau`
--

CREATE TABLE `pantau` (
  `id` int(11) NOT NULL,
  `lokasi` varchar(150) NOT NULL,
  `tanggal` date NOT NULL,
  `tinggi_cm` int(11) DEFAULT NULL,
  `cuaca` varchar(40) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Aman',
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `sumber` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rawan`
--

CREATE TABLE `rawan` (
  `id` int(11) NOT NULL,
  `wilayah` varchar(150) NOT NULL,
  `tingkat` varchar(20) DEFAULT NULL,
  `penyebab` text DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `sumber` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stasiun`
--

CREATE TABLE `stasiun` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kategori` varchar(30) DEFAULT NULL,
  `aliran` varchar(60) DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `batas_siaga` int(11) DEFAULT NULL,
  `batas_awas` int(11) DEFAULT NULL,
  `sumber` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tma`
--

CREATE TABLE `tma` (
  `id` int(11) NOT NULL,
  `stasiun_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `cuaca` varchar(30) DEFAULT NULL,
  `tinggi` int(11) NOT NULL,
  `sumber` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kejadian`
--
ALTER TABLE `kejadian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orang`
--
ALTER TABLE `orang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pantau`
--
ALTER TABLE `pantau`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rawan`
--
ALTER TABLE `rawan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stasiun`
--
ALTER TABLE `stasiun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tma`
--
ALTER TABLE `tma`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kejadian`
--
ALTER TABLE `kejadian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orang`
--
ALTER TABLE `orang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pantau`
--
ALTER TABLE `pantau`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rawan`
--
ALTER TABLE `rawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stasiun`
--
ALTER TABLE `stasiun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tma`
--
ALTER TABLE `tma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
