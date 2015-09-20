-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2015 at 05:28 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_globes`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gallery`
--

CREATE TABLE IF NOT EXISTS `tbl_gallery` (
`id` int(11) NOT NULL,
  `image_path` varchar(225) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jemaah`
--

CREATE TABLE IF NOT EXISTS `tbl_jemaah` (
`idjemaah` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `tempt_lahir` varchar(50) NOT NULL,
  `tgl_lahir` datetime NOT NULL,
  `jnskelamin` varchar(50) NOT NULL,
  `nama_ayah` varchar(125) NOT NULL,
  `no_passpor` varchar(125) NOT NULL,
  `tmpt_passpor` varchar(125) NOT NULL,
  `tgl_passpor` datetime NOT NULL,
  `exp_passpor` datetime NOT NULL,
  `no_telp` varchar(50) NOT NULL,
  `email` varchar(125) NOT NULL,
  `pekerjaan` varchar(125) NOT NULL,
  `pendidikan` varchar(125) NOT NULL,
  `sumber` varchar(50) NOT NULL,
  `riwayat` varchar(50) NOT NULL,
  `idpaket` varchar(100) NOT NULL,
  `create-date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_manifest`
--

CREATE TABLE IF NOT EXISTS `tbl_manifest` (
`idmanifest` int(11) NOT NULL,
  `idjemaah` varchar(100) NOT NULL,
  `no_psp` varchar(125) NOT NULL,
  `date_of_issu` datetime NOT NULL,
  `date_of_exp` datetime NOT NULL,
  `iss_cabang` varchar(100) NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE IF NOT EXISTS `tbl_order` (
`nofaktur` int(11) NOT NULL,
  `idjemaah` varchar(100) NOT NULL,
  `idpaket` int(100) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_paket`
--

CREATE TABLE IF NOT EXISTS `tbl_paket` (
`paket_id` int(11) NOT NULL,
  `nama_paket` varchar(100) NOT NULL,
  `diskripsi` varchar(150) NOT NULL,
  `image_path` varchar(125) NOT NULL,
  `harga` double NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_visa`
--

CREATE TABLE IF NOT EXISTS `tbl_visa` (
`idvisa` int(11) NOT NULL,
  `idjemaah` varchar(100) NOT NULL,
  `no_paspor` varchar(100) NOT NULL,
  `no_visa` varchar(100) NOT NULL,
  `place_issu` varchar(125) NOT NULL,
  `date` datetime NOT NULL,
  `exp` datetime NOT NULL,
  `type` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_gallery`
--
ALTER TABLE `tbl_gallery`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_jemaah`
--
ALTER TABLE `tbl_jemaah`
 ADD PRIMARY KEY (`idjemaah`);

--
-- Indexes for table `tbl_manifest`
--
ALTER TABLE `tbl_manifest`
 ADD PRIMARY KEY (`idmanifest`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
 ADD PRIMARY KEY (`nofaktur`);

--
-- Indexes for table `tbl_paket`
--
ALTER TABLE `tbl_paket`
 ADD PRIMARY KEY (`paket_id`);

--
-- Indexes for table `tbl_visa`
--
ALTER TABLE `tbl_visa`
 ADD PRIMARY KEY (`idvisa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_gallery`
--
ALTER TABLE `tbl_gallery`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_jemaah`
--
ALTER TABLE `tbl_jemaah`
MODIFY `idjemaah` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tbl_manifest`
--
ALTER TABLE `tbl_manifest`
MODIFY `idmanifest` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
MODIFY `nofaktur` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_paket`
--
ALTER TABLE `tbl_paket`
MODIFY `paket_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_visa`
--
ALTER TABLE `tbl_visa`
MODIFY `idvisa` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
