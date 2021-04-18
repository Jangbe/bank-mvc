-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 11, 2021 at 06:44 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `nasabah`
--

DROP TABLE IF EXISTS `nasabah`;
CREATE TABLE `nasabah` (
  `id_nasabah` int(11) NOT NULL,
  `nm_nasabah` varchar(45) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `email` varchar(45) NOT NULL,
  `alamat` text NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nasabah`
--

INSERT INTO `nasabah` (`id_nasabah`, `nm_nasabah`, `jk`, `no_hp`, `email`, `alamat`, `id_user`) VALUES
(13, 'Siti Nurul Laelati', 'P', '89767238742', 'siti@gmail.com', '    Sangegeng Kulon', 8),
(15, 'Iman Ruhiman', 'L', '9029384', 'ads@j.f', 'Suka ', 9),
(17, 'Anita Nuraeni', 'P', '83482734', 'anita@gmail.com', 'Ngamplang', 10);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

DROP TABLE IF EXISTS `pegawai`;
CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nm_pegawai` varchar(45) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `email` varchar(45) NOT NULL,
  `alamat` text NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nm_pegawai`, `jk`, `no_hp`, `email`, `alamat`, `id_user`) VALUES
(11, 'Erwin Anugrah A', 'L', '8979394991', 'erwin@gmail.com', 'Taraju Kulon', 30);

-- --------------------------------------------------------

--
-- Table structure for table `rekening`
--

DROP TABLE IF EXISTS `rekening`;
CREATE TABLE `rekening` (
  `no_rekening` varchar(45) NOT NULL,
  `pin` int(6) NOT NULL,
  `id_nasabah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rekening`
--

INSERT INTO `rekening` (`no_rekening`, `pin`, `id_nasabah`) VALUES
('1262390563', 123456, 13),
('1421178581', 12345, 15);

--
-- Triggers `rekening`
--
DROP TRIGGER IF EXISTS `delete_before_rekening`;
DELIMITER $$
CREATE TRIGGER `delete_before_rekening` BEFORE DELETE ON `rekening` FOR EACH ROW BEGIN 
DELETE FROM saldo WHERE no_rekening=OLD.no_rekening;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `saldo_before_insert`;
DELIMITER $$
CREATE TRIGGER `saldo_before_insert` BEFORE INSERT ON `rekening` FOR EACH ROW BEGIN
INSERT INTO saldo 
SET no_rekening=NEW.no_rekening,
saldo=0;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `saldo`
--

DROP TABLE IF EXISTS `saldo`;
CREATE TABLE `saldo` (
  `id_saldo` int(11) NOT NULL,
  `saldo` float NOT NULL,
  `no_rekening` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `saldo`
--

INSERT INTO `saldo` (`id_saldo`, `saldo`, `no_rekening`) VALUES
(2, 60000, 1262390563),
(4, 100000, 1421178581);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `waktu` datetime NOT NULL DEFAULT current_timestamp(),
  `nominal` int(11) NOT NULL,
  `jns_transaksi` enum('tarik','setor','tf') NOT NULL,
  `no_rekening` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `waktu`, `nominal`, `jns_transaksi`, `no_rekening`) VALUES
(20, '2021-03-30 23:15:53', 50000, 'tf', '111111111'),
(21, '2021-03-30 23:16:19', 5000, 'setor', '111111111'),
(22, '2021-03-30 23:45:11', 100000, 'setor', '1262390563'),
(23, '2021-03-30 23:45:36', 10000, 'tarik', '1262390563'),
(24, '2021-03-30 23:47:51', 20000, 'tf', '1262390563'),
(25, '2021-03-31 03:10:48', 100000, 'setor', '1421178581'),
(26, '2021-03-31 03:11:12', 20000, 'tarik', '1421178581'),
(27, '2021-03-31 03:12:22', 30000, 'tf', '1421178581'),
(28, '2021-03-31 03:12:47', 30000, 'tf', '1421178581'),
(29, '2021-03-31 03:13:54', 100000, 'setor', '1421178581'),
(30, '2021-03-31 03:14:36', 30000, 'tf', '1421178581'),
(31, '2021-03-31 03:15:12', 30000, 'tf', '1421178581'),
(32, '2021-03-31 03:17:42', 50000, 'setor', '1262390563'),
(33, '2021-03-31 04:06:12', 6000, 'setor', '1262390563'),
(34, '2021-04-09 15:19:58', 56000, 'tarik', '1262390563'),
(35, '2021-04-10 10:05:03', 5000, 'tf', '1262390563'),
(36, '2021-04-10 10:09:05', 10000, 'tf', '1421178581'),
(37, '2021-04-10 10:16:15', 50000, 'tf', '1262390563'),
(38, '2021-04-11 13:52:22', 50000, 'tf', '1262390563'),
(39, '2021-04-11 15:29:07', 50000, 'tf', '1421178581');

--
-- Triggers `transaksi`
--
DROP TRIGGER IF EXISTS `update_after_transaksi`;
DELIMITER $$
CREATE TRIGGER `update_after_transaksi` AFTER INSERT ON `transaksi` FOR EACH ROW BEGIN
	IF NEW.jns_transaksi = 'setor' THEN
    	UPDATE saldo SET saldo=saldo+NEW.nominal WHERE no_rekening=NEW.no_rekening;
    ELSE
    	UPDATE saldo SET saldo=saldo-NEW.nominal WHERE no_rekening=NEW.no_rekening;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `transfer`
--

DROP TABLE IF EXISTS `transfer`;
CREATE TABLE `transfer` (
  `id_transfer` int(11) NOT NULL,
  `jns_pembayaran` varchar(10) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `no_rekening` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transfer`
--

INSERT INTO `transfer` (`id_transfer`, `jns_pembayaran`, `keterangan`, `id_transaksi`, `no_rekening`) VALUES
(2, 'spp', 'Bayar spp sekolah', 12, '990043515206'),
(3, 'spp', 'spp', 13, '990043515206'),
(4, 'cicil', 'cicil rumah', 16, '990043515206'),
(5, 'cicil', 'Nyicil Mobil', 17, '990043515206'),
(6, 'spp', 'Membayar SPP Sekolah', 18, '989122383810'),
(7, 'spp', 'spp', 19, '990043515206'),
(10, 'bayar', 'Bayar hutang', 24, '1111111111'),
(11, '3', 'mayar hutang', 31, '1262390563'),
(12, '1', 'nyicil hutang', 35, '1262390563'),
(13, '1', 'sdfs', 36, '1262390563'),
(14, 'cicil', 'sds', 37, '1421178581'),
(15, '2', 'Belanja Online', 38, '1421178581'),
(16, '1', 'Sewa Rumah', 39, '1262390563');

--
-- Triggers `transfer`
--
DROP TRIGGER IF EXISTS `saldo_after_transfer`;
DELIMITER $$
CREATE TRIGGER `saldo_after_transfer` AFTER INSERT ON `transfer` FOR EACH ROW BEGIN
DECLARE nominal_ FLOAT;
SELECT
	nominal
INTO
	nominal_
FROM
	transaksi
WHERE
	id_transaksi=NEW.id_transaksi;
UPDATE saldo SET saldo=saldo+nominal_ WHERE no_rekening=NEW.no_rekening;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `level`) VALUES
(8, 'siti nurul', 'ebb9bc56e402cb007518ea2e0d880947a4423e7a', 'nasabah'),
(9, 'iman', '57c4fa8276b9979b9d337b323160f9f2f0f7dd25', 'nasabah'),
(10, 'anita', 'd56c82a0ab1c536999c31ae5e2c0dab85f47a331', 'nasabah'),
(25, 'ebe', '3871410937c186af355b4ef14b901187be6327a4', 'admin'),
(30, 'erwin', '0c2a6e12a3ee3123563f88831cd6d692c33fb195', 'operator'),
(35, 'pegawai', 'a431ba54c55ae2cb91be1785398ecd595ca96b7a', 'operator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nasabah`
--
ALTER TABLE `nasabah`
  ADD PRIMARY KEY (`id_nasabah`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`no_rekening`),
  ADD KEY `id_nasabah` (`id_nasabah`);

--
-- Indexes for table `saldo`
--
ALTER TABLE `saldo`
  ADD PRIMARY KEY (`id_saldo`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `no_rekening` (`no_rekening`);

--
-- Indexes for table `transfer`
--
ALTER TABLE `transfer`
  ADD PRIMARY KEY (`id_transfer`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `no_rekening` (`no_rekening`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nasabah`
--
ALTER TABLE `nasabah`
  MODIFY `id_nasabah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `saldo`
--
ALTER TABLE `saldo`
  MODIFY `id_saldo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `transfer`
--
ALTER TABLE `transfer`
  MODIFY `id_transfer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
