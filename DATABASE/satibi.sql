-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2022 at 04:58 AM
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
  `tgl_input` datetime NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `expired` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kas_satibi`
--

CREATE TABLE `kas_satibi` (
  `id_km` int(11) NOT NULL,
  `tgl_km` date NOT NULL,
  `uraian_km` varchar(200) NOT NULL,
  `catatan` varchar(255) NOT NULL,
  `masuk` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `keluar` int(11) NOT NULL,
  `jenis` enum('Masuk','Keluar') NOT NULL,
  `produk` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kas_satibi`
--

INSERT INTO `kas_satibi` (`id_km`, `tgl_km`, `uraian_km`, `catatan`, `masuk`, `cost`, `keluar`, `jenis`, `produk`) VALUES
(6, '2022-11-03', 'bekasi', 'test note', 200088, 0, 0, 'Masuk', ''),
(7, '2022-11-05', 'bekasi', 'test note ini', 20008866, 0, 0, 'Masuk', ''),
(9, '2022-11-08', 'bogor', 'tolong dicrosscheckkss', 20000, 2000, 0, 'Masuk', ''),
(10, '2022-11-02', '', '', 0, 0, 200000, 'Keluar', 'gula'),
(11, '2022-11-12', 'bekasi', 'ok', 0, 0, 30000, '', 'Masuk'),
(12, '2022-11-05', 'jkt', 'ok', 30000, 0, 0, 'Masuk', ''),
(13, '2022-11-05', '', '', 0, 0, 0, '', 'Keluar'),
(16, '2022-11-10', '', '', 0, 0, 250000, 'Keluar', 'plastik'),
(17, '2022-02-03', '', '', 0, 0, 1300000, 'Keluar', 'gula'),
(19, '2022-11-06', '', '', 0, 20000, 260000, 'Keluar', 'gula'),
(20, '2022-11-07', 'jkt', 'tolong dicek ya', 600000, 0, 0, 'Masuk', ''),
(23, '2022-11-25', 'JAKARTA RAYA', 'NOTE YA', 100000, 40000, 0, 'Masuk', ''),
(24, '0000-00-00', '', '', 0, 0, 0, 'Masuk', '');

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
  MODIFY `no_produksi` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kas_satibi`
--
ALTER TABLE `kas_satibi`
  MODIFY `id_km` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;