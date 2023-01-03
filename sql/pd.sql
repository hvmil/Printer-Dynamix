-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2022 at 09:49 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pd`
--

CREATE DATABASE IF NOT EXISTS `pd` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `pd`;

-- --------------------------------------------------------

--
-- Table structure for table `printer`
--

CREATE TABLE `printer` (
  `name` varchar(64) NOT NULL,
  `ip` varchar(16) NOT NULL,
  `status` varchar(64) DEFAULT NULL,
  `location` varchar(64) DEFAULT NULL,
  `make` varchar(64) NOT NULL,
  `model` varchar(64) NOT NULL,
  `bw` tinyint(1) DEFAULT NULL,
  `external_stock` int(4) DEFAULT 0,
  `notes` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `printer`
--

INSERT INTO `printer` (`name`, `ip`, `status`, `location`, `make`, `model`, `bw`, `external_stock`, `notes`) VALUES
('BLI-LJ-602', '137.140.24.130', NULL, 'Bliss', 'HP', '602', 1, 4, 'Toner is low but nobody uses it.'),
('BOU-LJ-602', '137.140.24.131', NULL, 'Bouton', 'HP', '602', 1, 4, 'Needs servicing'),
('CAP-LJ-602', '137.140.24.132', NULL, 'Capen', 'HP', '602', 1, 4, 'Almost EOL\r\n'),
('CAPENEOP-LJ-M608', '137.140.24.177', NULL, 'EOP CAPEN', 'HP', 'M608', 1, 5, 'I wrote this'),
('CH-LJ-602', '137.140.24.133', NULL, 'College Hall', 'HP', '602', 1, 4, NULL),
('CSB118-CLJ-M750', '137.140.24.235', NULL, 'CSB118', 'HP', 'M750', 0, 3, NULL),
('CSB118-LJ-M806', '137.140.24.221', NULL, 'CSB118', 'HP', 'M806', 1, 2, NULL),
('CSB145-LJ-602', '137.140.24.166', NULL, 'CSB145', 'HP', '602', 1, 0, NULL),
('CSB21-LJ-603', '137.140.24.160', NULL, 'CSB21', 'HP', '603', 1, 0, NULL),
('CSB24-LJ-603', '137.140.24.172', NULL, 'CSB24', 'HP', '603', 1, 0, NULL),
('CSB29-LJ-603', '137.140.24.174', NULL, 'CSB29', 'HP', '603', 1, 0, NULL),
('CSB312-LJ-M608', '137.140.24.175', NULL, 'CSB312', 'HP', 'M608', 1, 0, NULL),
('CSB321-LJ-M609', '137.140.24.205', NULL, 'CSB 321', 'HP', 'M609', 1, 0, NULL),
('CT126-CLJ-M750', '137.140.24.245', NULL, 'CT126', 'HP', 'M750', 0, 0, NULL),
('CT126-LJ-602', '137.140.24.243', NULL, 'CT126', 'HP', '602', 1, 0, NULL),
('EIH218 -LJ-M806', '137.140.24.212', NULL, 'EIH218', 'HP', 'M806', 1, 0, NULL),
('EIH218-CLJ-M750', '137.140.24.213', NULL, 'EIH218', 'HP', 'M750', 0, 0, NULL),
('ESO-LJ-602', '137.140.24.123', NULL, 'Esopus', 'HP', '602', 1, 0, NULL),
('FAB225-LJ-M806', '137.140.24.163', NULL, 'FAB225', 'HP', 'M806', 1, 0, NULL),
('GAGE-LJ-602', '137.140.24.124', NULL, 'Gage', 'HP', '602', 1, 0, NULL),
('HAB210-LJ-M608', '137.140.24.192', NULL, 'HAB210 (DRC testing room)', 'HP', 'M608', 1, 0, NULL),
('HONORS-CLJ-M551', '137.140.24.217', NULL, 'CH 113', 'HP', 'M551', 0, 0, NULL),
('HONORS-LJ-4515', '137.140.24.157', NULL, 'CH 113', 'HP', '4515', 1, 0, NULL),
('HUM103-LJ-603', '137.140.24.146', NULL, 'HUM103', 'HP', '603', 1, 0, NULL),
('HUM105-LJ-m507', '137.140.24.158', NULL, 'HUM105', 'HP', 'M507', 1, 0, NULL),
('HUM105B - CLJ-M750', '137.140.24.161', NULL, 'HUM107', 'HP', 'M750', 0, 0, NULL),
('HUM107-LJ- M806', '137.140.24.206', NULL, 'HUM107', 'HP', ' M806', 1, 0, NULL),
('HUM24-LJ-603', '137.140.24.199', NULL, 'HUM24', 'HP', '603', 1, 0, NULL),
('HUM301-LJ-M609', '137.140.24.204', NULL, 'HUM301', 'HP', 'M609', 1, 0, NULL),
('HUM307-CLJ-5550', '137.140.24.178', NULL, 'HUM307', 'HP', '5550', 0, 0, NULL),
('HUM4-LJ-M603', '137.140.24.191', NULL, 'HUM4', 'HP', 'M603', 1, 0, NULL),
('HUMB1-CLJ-M551', '137.140.24.171', NULL, 'HUM B-1', 'HP', 'M551', 0, 0, NULL),
('LC110-LJ-M606', '137.140.24.237', NULL, 'LC110', 'HP', 'M606', 1, 0, NULL),
('LC112-LJ-M606', '137.140.24.189', NULL, 'LC112', 'HP', 'M606', 1, 0, NULL),
('LC120B-CLJ-5550', '137.140.24.240', NULL, 'LC120B', 'HP', '5550', 0, 0, NULL),
('LCLOBBY-LJ-M806', '137.140.24.226', NULL, 'LCLobby', 'HP', 'M806', 1, 0, NULL),
('LEN-LJ-602', '137.140.24.126', NULL, 'Lenape', 'HP', '602', 1, 0, NULL),
('MNH-LJ-601', '137.140.24.129', NULL, 'Minnewaska', 'HP', '601', 1, 0, NULL),
('MOH-LJ-602', '137.140.24.122', NULL, 'Mohonk', 'HP', '602', 1, 0, NULL),
('OIT-CLJ-M750', '137.140.24.152', NULL, 'CH 111', 'HP', 'M750', 0, 0, NULL),
('OM131-LJ-M806', '137.140.24.236', NULL, 'OM131', 'HP', 'M806', 1, 0, NULL),
('OM215-CLJ-5500', '137.140.24.153', NULL, 'OM215 (CMC)', 'HP', '5500', 0, 0, NULL),
('OM215-LJ-M609', '137.140.24.185', NULL, 'OM215 (CMC)', 'HP', 'M609', 1, 0, NULL),
('OMB102-CLJ-M551', '137.140.24.219', NULL, 'OMB102 (Literacy Center)', 'HP', 'M551', 0, 0, NULL),
('OMB102-LJ-4515', '137.140.24.218', NULL, 'OMB102 (Literacy Center)', 'HP', '4515', 1, 0, NULL),
('OMB106-LJ-M606', '137.140.24.151', NULL, 'OMB106', 'HP', 'M606', 1, 0, NULL),
('PDH-CLJ-M750', '137.140.24.145', NULL, 'PDH', 'HP', 'M750', 0, 0, NULL),
('PDH-LJ-M806', '137.140.24.190', NULL, 'PDH', 'HP', 'M806', 1, 0, NULL),
('REH107-LJ-M608', '137.140.24.238', NULL, 'REH107', 'HP', 'M608', 1, 0, NULL),
('REH210-LJ-M609', '137.140.24.184', NULL, 'REH210', 'HP', 'M609', 1, 0, NULL),
('REH211-LJ-M606', '137.140.24.187', NULL, 'REH211', 'HP', 'M606', 1, 0, NULL),
('RVH-LJ-M602', '137.140.24.167', NULL, 'RidgeView Hall ', 'HP', 'M602', 1, 0, NULL),
('SAB100-LJ2-4515', '137.140.24.159', NULL, 'SAB100', 'HP', '4515', 1, 0, NULL),
('SAB210-CLJ-M750', '137.140.24.231', NULL, 'SAB210', 'HP', 'M750', 0, 0, NULL),
('SAB210-LJ-M606', '137.140.24.201', NULL, 'SAB210', 'HP', 'M606', 1, 0, NULL),
('SAB212-CLJ-M750', '137.140.24.225', NULL, 'SAB212', 'HP', 'M750', 0, 0, NULL),
('SAB212-LJ-M606', '137.140.24.202', NULL, 'SAB212', 'HP', 'M606', 1, 0, NULL),
('SCUD-LJ-602', '137.140.24.127', NULL, 'Scudder', 'HP', '602', 1, 0, NULL),
('SH158-LJ-M606', '137.140.24.149', NULL, 'SH158 - Physics', 'HP', 'M606', 1, 0, NULL),
('SH168-LJ-4515', '137.140.24.183', NULL, 'SH168 Math Lab', 'HP', '4515', 1, 0, NULL),
('SH231-CLJ-M750', '137.140.24.162', NULL, 'SH231', 'HP', 'M750', 0, 0, NULL),
('SH231-LJ-9050', '137.140.24.244', NULL, 'SH231', 'HP', '9050', 1, 0, NULL),
('SH259-LJ-M606', '137.140.24.169', NULL, 'SH259 NUCs', 'HP', 'M606', 1, 0, NULL),
('SH271-LJ-M606', '137.140.24.173', NULL, 'SH271 NUCs', 'HP', 'M606', 1, 0, NULL),
('SHA-LJ-602', '137.140.24.128', NULL, 'Shango', 'HP', '602', 1, 0, NULL),
('SHANGOEOP-LJ-M608', '137.140.24.194', NULL, 'SHANGOEOP', 'HP', 'M608', 1, 0, NULL),
('SUB-LJ-M806', '137.140.24.148', NULL, 'SUB ATRIUM', 'HP', 'M806', 1, 0, NULL),
('SUB100-LJ-4515', '137.140.24.239', NULL, 'SUB100S ', 'HP', '4515', 1, 0, NULL),
('SUB39-LJ-M602', '137.140.24.168', NULL, 'SUB39', 'HP', 'M602', 1, 0, NULL),
('SWH-LJ-602', '137.140.24.125', NULL, 'Schawangunk', 'HP', '602', 1, 0, NULL),
('VH113-LJ-9050', '137.140.24.232', NULL, 'VH113', 'HP', '9050', 1, 0, NULL),
('VH115-CLJ-M750', '137.140.24.156', NULL, 'VH115', 'HP', 'M750', 0, 0, NULL),
('VH115-LJ-M806', '137.140.24.155', NULL, 'VH115', 'HP', 'M806', 1, 0, NULL),
('VH208A-LJ-m506', '137.140.24.208', NULL, 'VH208A', 'HP', 'M506', 1, 0, NULL),
('VH208B-LJ-m506', '137.140.24.209', NULL, 'VH208B', 'HP', 'M506', 1, 0, NULL),
('VH221-LJ-M609', '137.140.24.222', NULL, 'VH221', 'HP', 'M609', 1, 0, NULL),
('VHA250A-LJ-m506', '137.140.24.196', NULL, 'VHA-250A', 'HP', 'M506', 1, 0, NULL),
('WH219-LJ-9050', '137.140.24.135', NULL, 'WH219', 'HP', '9050', 1, 0, NULL),
('WH221-LJ-M606', '137.140.24.247', NULL, 'WH221', 'HP', 'M606', 1, 0, NULL),
('WH223-LJ-M606', '137.140.24.246', NULL, 'WH223', 'HP', 'M606', 1, 0, NULL),
('WH335-LJ-M606', '137.140.24.227', NULL, 'WH335', 'HP', 'M606', 1, 0, NULL),
('WH337-CLJ-M750', '137.140.24.229', NULL, 'WH337', 'HP', 'M750', 0, 0, NULL),
('WH337-LJ-M606', '137.140.24.228', NULL, 'WH337', 'HP', 'M606', 1, 0, NULL),
('WHLobby-LJ-M712', '137.140.24.248', NULL, 'WHLobby', 'HP', 'M712', 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `toner_cartridge`
--

CREATE TABLE `toner_cartridge` (
  `serial_number` int(32) UNSIGNED NOT NULL,
  `color` varchar(16) DEFAULT NULL,
  `toner_status` varchar(64) DEFAULT NULL,
  `pages_remaining` int(16) DEFAULT NULL,
  `first_inst_date` date DEFAULT NULL,
  `pages_printed` int(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `toner_map`
--

CREATE TABLE `toner_map` (
  `printer_name` varchar(64) NOT NULL,
  `printer_ip` varchar(16) NOT NULL,
  `toner_serial_number` int(32) UNSIGNED NOT NULL,
  `currently_in_use` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL DEFAULT 0,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(64) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `disabled` tinyint(1) DEFAULT 0,
  `failed_logon_count` int(3) DEFAULT 0,
  `locked` tinyint(1) DEFAULT 0,
  `is_admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `email`, `password`, `username`, `disabled`, `failed_logon_count`, `locked`, `is_admin`) VALUES
(1, 'admin', 'admin', 'adminadmin@admin', 'AB396222F19C0A2802902FABC91A46A49E337D243B0397F9AF4C2EC653980860', 'admin', 0, 0, 0, 1),
(20, 'yon', 'yonson', 'yonderson@yonson.yon', 'e6c3da5b206634d7f3f3586d747ffdb36b5c675757b380c6a5fe5c570c714349', 'user1', 0, 0, 0, 1),
(21, 'john', 'johnson', 'john@john.son', '1ba3d16e9881959f8c9a9762854f72c6e6321cdd44358a10a4e939033117eab9', 'user2', 0, 0, 0, 0),
(22, 'george', 'jetson', 'george@sprockets.com', 'a417b5dc3d06d15d91c6687e27fc1705ebc56b3b2d813abe03066e5643fe4e74', 'user4', 0, 0, 0, 0),
(23, 'Test', 'Testerson', 'test@test.com', '0eeac8171768d0cdef3a20fee6db4362d019c91e10662a6b55186336e1a42778', 'user5', 0, 0, 0, 0),
(24, 'George', 'Jetson', 'g@jetson.com', '2590d18604c282ff195459db33d0ae2caab98b14d4cbfdfd4dc3ed4923bf31b8', 'user77', 0, 0, 0, 0),
(1, 'admin', 'admin', 'adminadmin@admin', 'AB396222F19C0A2802902FABC91A46A49E337D243B0397F9AF4C2EC653980860', 'admin', 0, 0, 0, 0),
(20, 'yon', 'yonson', 'yonderson@yonson.yon', 'e6c3da5b206634d7f3f3586d747ffdb36b5c675757b380c6a5fe5c570c714349', 'user1', 0, 0, 0, 0),
(21, 'john', 'johnson', 'john@john.son', '1ba3d16e9881959f8c9a9762854f72c6e6321cdd44358a10a4e939033117eab9', 'user2', 0, 0, 0, 0),
(22, 'george', 'jetson', 'george@sprockets.com', 'a417b5dc3d06d15d91c6687e27fc1705ebc56b3b2d813abe03066e5643fe4e74', 'user4', 0, 0, 0, 0),
(23, 'Test', 'Testerson', 'test@test.com', '0eeac8171768d0cdef3a20fee6db4362d019c91e10662a6b55186336e1a42778', 'user5', 0, 0, 0, 0),
(24, 'George', 'Jetson', 'g@jetson.com', '2590d18604c282ff195459db33d0ae2caab98b14d4cbfdfd4dc3ed4923bf31b8', 'user77', 0, 0, 0, 0),
(1, 'admin', 'admin', 'adminadmin@admin', 'AB396222F19C0A2802902FABC91A46A49E337D243B0397F9AF4C2EC653980860', 'admin', 0, 0, 0, 0),
(20, 'yon', 'yonson', 'yonderson@yonson.yon', 'e6c3da5b206634d7f3f3586d747ffdb36b5c675757b380c6a5fe5c570c714349', 'user1', 0, 0, 0, 0),
(21, 'john', 'johnson', 'john@john.son', '1ba3d16e9881959f8c9a9762854f72c6e6321cdd44358a10a4e939033117eab9', 'user2', 0, 0, 0, 0),
(22, 'george', 'jetson', 'george@sprockets.com', 'a417b5dc3d06d15d91c6687e27fc1705ebc56b3b2d813abe03066e5643fe4e74', 'user4', 0, 0, 0, 0),
(23, 'Test', 'Testerson', 'test@test.com', '0eeac8171768d0cdef3a20fee6db4362d019c91e10662a6b55186336e1a42778', 'user5', 0, 0, 0, 0),
(24, 'George', 'Jetson', 'g@jetson.com', '2590d18604c282ff195459db33d0ae2caab98b14d4cbfdfd4dc3ed4923bf31b8', 'user77', 0, 0, 0, 0),
(1, 'admin', 'admin', 'adminadmin@admin', 'AB396222F19C0A2802902FABC91A46A49E337D243B0397F9AF4C2EC653980860', 'admin', 0, 0, 0, 0),
(20, 'yon', 'yonson', 'yonderson@yonson.yon', 'e6c3da5b206634d7f3f3586d747ffdb36b5c675757b380c6a5fe5c570c714349', 'user1', 0, 0, 0, 0),
(21, 'john', 'johnson', 'john@john.son', '1ba3d16e9881959f8c9a9762854f72c6e6321cdd44358a10a4e939033117eab9', 'user2', 0, 0, 0, 0),
(22, 'george', 'jetson', 'george@sprockets.com', 'a417b5dc3d06d15d91c6687e27fc1705ebc56b3b2d813abe03066e5643fe4e74', 'user4', 0, 0, 0, 0),
(23, 'Test', 'Testerson', 'test@test.com', '0eeac8171768d0cdef3a20fee6db4362d019c91e10662a6b55186336e1a42778', 'user5', 0, 0, 0, 0),
(24, 'George', 'Jetson', 'g@jetson.com', '2590d18604c282ff195459db33d0ae2caab98b14d4cbfdfd4dc3ed4923bf31b8', 'user77', 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `printer`
--
ALTER TABLE `printer`
  ADD PRIMARY KEY (`name`,`ip`);

--
-- Indexes for table `toner_cartridge`
--
ALTER TABLE `toner_cartridge`
  ADD PRIMARY KEY (`serial_number`);

--
-- Indexes for table `toner_map`
--
ALTER TABLE `toner_map`
  ADD PRIMARY KEY (`printer_ip`,`printer_name`,`toner_serial_number`),
  ADD KEY `printer_name` (`printer_name`,`printer_ip`),
  ADD KEY `toner_map_cartridgefk` (`toner_serial_number`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `toner_map`
--
ALTER TABLE `toner_map`
  ADD CONSTRAINT `toner_map_cartridgefk` FOREIGN KEY (`toner_serial_number`) REFERENCES `toner_cartridge` (`serial_number`),
  ADD CONSTRAINT `toner_map_printerfk` FOREIGN KEY (`printer_name`,`printer_ip`) REFERENCES `printer` (`name`, `ip`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
