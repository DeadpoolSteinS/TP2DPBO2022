-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2022 at 03:14 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prak_dpbo_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `bidang_divisi`
--

CREATE TABLE `bidang_divisi` (
  `id_bidang` int(11) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `id_divisi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bidang_divisi`
--

INSERT INTO `bidang_divisi` (`id_bidang`, `jabatan`, `id_divisi`) VALUES
(1, 'Leader', 1),
(2, 'Rusher', 1),
(3, 'Flanker', 1),
(7, 'Support', 1),
(11, 'Main Character', 3),
(18, 'Reserve', 1),
(21, 'Heroine', 3),
(22, 'Imouto', 3),
(23, 'Tomodachi', 3);

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id_divisi` int(11) NOT NULL,
  `nama_divisi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id_divisi`, `nama_divisi`) VALUES
(1, 'JavaShark'),
(3, 'Seishun Buta Yarou');

-- --------------------------------------------------------

--
-- Table structure for table `pengurus`
--

CREATE TABLE `pengurus` (
  `id` int(11) NOT NULL,
  `nim` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `semester` int(11) DEFAULT NULL,
  `id_bidang` int(11) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengurus`
--

INSERT INTO `pengurus` (`id`, `nim`, `nama`, `semester`, `id_bidang`, `image`) VALUES
(5, '2003941', 'Novaldi Sandi Ago', 4, 3, '6252a44b223c2.jpg'),
(11, '7645654', 'D&#039;Riski Maulana', 4, 2, '6252a3bc8ae69.jpg'),
(16, '7374872', 'Alvin Giovani', 4, 7, '6252a3e21d3a6.jpg'),
(19, '7567465', 'Arik Riski Akbar', 4, 18, '6252a40a450b4.jpg'),
(20, '3647384', 'M. Hasta Aditya', 4, 1, 'anonymous.jpg'),
(23, '6485746', 'Sakuta Azusagawa', 5, 11, '6252a7ddbd720.jpg'),
(24, '6456374', 'Sakurajima Mai', 7, 21, '6252ae1d101d7.jpg'),
(25, '8756473', 'Kaede Azusagawa', 1, 22, '6252ae3930c74.jpg'),
(26, '7564756', 'Futaba Rio', 5, 23, '6252ae5b1bcc3.jpg'),
(31, '6485746', 'Sakuta Azusagawa', 5, 11, '6252a7ddbd720.jpg'),
(32, '6456374', 'Sakurajima Mai', 7, 21, '6252ae1d101d7.jpg'),
(33, '8756473', 'Kaede Azusagawa', 1, 22, '6252ae3930c74.jpg'),
(34, '7564756', 'Futaba Rio', 5, 23, '6252ae5b1bcc3.jpg'),
(35, '6485746', 'Sakuta Azusagawa', 5, 11, '6252a7ddbd720.jpg'),
(36, '6456374', 'Sakurajima Mai', 7, 21, '6252ae1d101d7.jpg'),
(37, '8756473', 'Kaede Azusagawa', 1, 22, '6252ae3930c74.jpg'),
(38, '7564756', 'Futaba Rio', 5, 23, '6252ae5b1bcc3.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bidang_divisi`
--
ALTER TABLE `bidang_divisi`
  ADD PRIMARY KEY (`id_bidang`),
  ADD KEY `id_divisi` (`id_divisi`);

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id_divisi`);

--
-- Indexes for table `pengurus`
--
ALTER TABLE `pengurus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_bidang` (`id_bidang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bidang_divisi`
--
ALTER TABLE `bidang_divisi`
  MODIFY `id_bidang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id_divisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pengurus`
--
ALTER TABLE `pengurus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bidang_divisi`
--
ALTER TABLE `bidang_divisi`
  ADD CONSTRAINT `bidang_divisi_ibfk_1` FOREIGN KEY (`id_divisi`) REFERENCES `divisi` (`id_divisi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengurus`
--
ALTER TABLE `pengurus`
  ADD CONSTRAINT `pengurus_ibfk_1` FOREIGN KEY (`id_bidang`) REFERENCES `bidang_divisi` (`id_bidang`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
