-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2022 at 07:11 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `satibi`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `no_produksi` int(8) NOT NULL,
  `tgl_input` date NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `jumlah_produk` int(255) NOT NULL,
  `expired` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`no_produksi`, `tgl_input`, `nama_produk`, `jumlah_produk`, `expired`) VALUES
(1281926, '2022-12-10', 'DODOLALU', 20, '2022-12-29'),
(1291829, '2022-12-02', 'dodolillili', 13, '2022-12-31'),
(12345678, '2022-12-03', 'DODOLA', 23, '2022-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `kas_satibi`
--

CREATE TABLE `kas_satibi` (
  `id_km` int(11) NOT NULL,
  `tgl_km` date NOT NULL,
  `uraian_km` varchar(200) NOT NULL,
  `produk` varchar(255) NOT NULL,
  `jenis` enum('Masuk','Keluar') NOT NULL,
  `catatan` varchar(255) NOT NULL,
  `masuk` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `keluar` int(11) NOT NULL,
  `total_keluar` int(255) NOT NULL,
  `total_akhir` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kas_satibi`
--

INSERT INTO `kas_satibi` (`id_km`, `tgl_km`, `uraian_km`, `produk`, `jenis`, `catatan`, `masuk`, `cost`, `keluar`, `total_keluar`, `total_akhir`) VALUES
(34, '2022-12-01', '', 'tepung', 'Keluar', '', 0, 50000, 250000, 300000, -300000),
(35, '2022-12-03', 'bekasi', '', 'Masuk', 'ok', 900000, 0, 0, 0, 900000),
(36, '2022-12-03', 'jkt', '', 'Masuk', 'NOTE YA', 100000, 0, 0, 0, 100000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengguna`
--

CREATE TABLE `tb_pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nama_pengguna` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `level` enum('Administrator','Bendahara') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`id_pengguna`, `nama_pengguna`, `username`, `password`, `level`) VALUES
(1, 'Admin satibi', 'admin', 'admin', 'Administrator'),
(2, 'User satibi', 'bendahara', 'bendahara', 'Bendahara'),
(3, 'adelia', 'adelia08', 'adelia', 'Bendahara');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`no_produksi`);

--
-- Indexes for table `kas_satibi`
--
ALTER TABLE `kas_satibi`
  ADD PRIMARY KEY (`id_km`);

--
-- Indexes for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `no_produksi` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12345679;

--
-- AUTO_INCREMENT for table `kas_satibi`
--
ALTER TABLE `kas_satibi`
  MODIFY `id_km` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
