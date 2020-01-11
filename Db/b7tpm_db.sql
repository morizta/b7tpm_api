-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2020 at 01:10 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `b7tpm_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `Id` bigint(20) NOT NULL,
  `GroupName` varchar(50) NOT NULL,
  `IsActive` tinyint(1) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `CraetedBy` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`Id`, `GroupName`, `IsActive`, `CreatedDate`, `CraetedBy`) VALUES
(1, 'Admin', 1, '2019-11-26 00:00:00', ''),
(2, 'SPV', 1, '2019-11-26 00:00:00', ''),
(3, 'User', 1, '2019-12-09 00:00:00', 'System');

-- --------------------------------------------------------

--
-- Table structure for table `info_mesin`
--

CREATE TABLE `info_mesin` (
  `Id` bigint(20) NOT NULL,
  `NoAsset` varchar(150) NOT NULL,
  `NoMesin` varchar(150) NOT NULL,
  `Barcode` varchar(500) NOT NULL,
  `TglMulaiOperasi` datetime NOT NULL,
  `Ruang` varchar(150) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `CreatedBy` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `info_mesin`
--

INSERT INTO `info_mesin` (`Id`, `NoAsset`, `NoMesin`, `Barcode`, `TglMulaiOperasi`, `Ruang`, `CreatedDate`, `CreatedBy`) VALUES
(1, '123456', '12412516', '8992775709085', '2019-12-12 00:00:00', '125256', '2019-12-11 00:00:00', 'system');

-- --------------------------------------------------------

--
-- Table structure for table `tpm_redtag`
--

CREATE TABLE `tpm_redtag` (
  `Id` bigint(20) NOT NULL,
  `NoKontrol` varchar(25) DEFAULT NULL,
  `BagianMesin` varchar(150) DEFAULT NULL,
  `DipasangOleh` varchar(150) DEFAULT NULL,
  `TanggalPemasangan` datetime DEFAULT NULL,
  `Deskripsi` text DEFAULT NULL,
  `NoWorkRequest` varchar(150) DEFAULT NULL,
  `PICFollowUp` varchar(150) DEFAULT NULL,
  `DueDate` datetime DEFAULT NULL,
  `Status` varchar(25) DEFAULT NULL,
  `Penanggulangan` text DEFAULT NULL,
  `FileName` varchar(500) NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` varchar(150) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tpm_redtag`
--

INSERT INTO `tpm_redtag` (`Id`, `NoKontrol`, `BagianMesin`, `DipasangOleh`, `TanggalPemasangan`, `Deskripsi`, `NoWorkRequest`, `PICFollowUp`, `DueDate`, `Status`, `Penanggulangan`, `FileName`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`) VALUES
(9, '123123', '123123', '123213', '2020-01-09 00:00:00', '123123', '124', '124124', '2020-01-09 00:00:00', 'Open', '123123', '', '2020-01-09 08:01:00', '', NULL, NULL),
(10, '123123123', '123123', '123123', '2020-01-09 00:00:00', '123123', '123123', '123123', '2020-01-09 00:00:00', 'Open', '12313', 'download.jpg', '2020-01-09 08:01:00', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tpm_whitetag`
--

CREATE TABLE `tpm_whitetag` (
  `Id` bigint(20) NOT NULL,
  `NoKontrol` varchar(25) DEFAULT NULL,
  `BagianMesin` varchar(150) DEFAULT NULL,
  `DipasangOleh` varchar(150) DEFAULT NULL,
  `TanggalPemasangan` datetime DEFAULT NULL,
  `Deskripsi` text DEFAULT NULL,
  `DueDate` datetime DEFAULT NULL,
  `Status` varchar(25) DEFAULT NULL,
  `Penanggulangan` text NOT NULL,
  `CreatedDate` datetime DEFAULT NULL,
  `CreatedBy` varchar(150) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tpm_whitetag`
--

INSERT INTO `tpm_whitetag` (`Id`, `NoKontrol`, `BagianMesin`, `DipasangOleh`, `TanggalPemasangan`, `Deskripsi`, `DueDate`, `Status`, `Penanggulangan`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`) VALUES
(1, 'tesNo Kontrol', '12345', 'riska', '0000-00-00 00:00:00', 'deskripsi', '0000-00-00 00:00:00', 'Close', 'Penanggulangan', '2019-12-09 05:12:00', 'Created', NULL, NULL),
(2, 'NoWork1234', 'mesin1234', '', '2019-12-16 00:00:00', 'Deskripsi', '2019-12-16 00:00:00', 'Open', '12345', '2019-12-15 06:12:00', '', NULL, NULL),
(3, '123123', '', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 'Open', '', '2020-01-09 08:01:00', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Id` bigint(20) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` text NOT NULL,
  `FullName` varchar(150) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `NIK` varchar(20) NOT NULL,
  `GroupId` bigint(20) NOT NULL,
  `IsActive` tinyint(1) NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `CreatedBy` varchar(150) NOT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Id`, `UserName`, `Password`, `FullName`, `Email`, `NIK`, `GroupId`, `IsActive`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`) VALUES
(1, 'motaufiq', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'Admin Full', 'mrizky.taufiqh@gmail.com', '', 1, 1, '2019-11-26 00:00:00', 'System', '0000-00-00 00:00:00', ''),
(2, 'spv', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'USER SPV', 'tes@gmail.com', '124124', 2, 1, '2019-12-09 00:00:00', 'System', NULL, NULL),
(3, 'user', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'User Biasa ', 'UserBiasa@gmail.com', '123451', 3, 1, '2019-12-22 00:00:00', 'system', NULL, NULL),
(4, 'rzonyx', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', '', '', '123451', 3, 1, '0000-00-00 00:00:00', 'system', NULL, NULL),
(5, 'rzonyxx', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', '', '', '123451', 3, 1, '0000-00-00 00:00:00', 'system', NULL, NULL),
(6, 'rzony2xx', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', '', '', '123451', 3, 1, '2019-12-08 06:12:00', 'system', NULL, NULL),
(7, 'kiky', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', '', 'mrizky@gmail.com', '12345', 3, 1, '2019-12-08 07:12:00', 'system', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `info_mesin`
--
ALTER TABLE `info_mesin`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tpm_redtag`
--
ALTER TABLE `tpm_redtag`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tpm_whitetag`
--
ALTER TABLE `tpm_whitetag`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `GroupId` (`GroupId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `info_mesin`
--
ALTER TABLE `info_mesin`
  MODIFY `Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tpm_redtag`
--
ALTER TABLE `tpm_redtag`
  MODIFY `Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tpm_whitetag`
--
ALTER TABLE `tpm_whitetag`
  MODIFY `Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `Id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
