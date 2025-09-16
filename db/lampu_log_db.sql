-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2025 at 10:02 AM
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
-- Database: `lampu_log_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `esp32_devices`
--

CREATE TABLE `esp32_devices` (
  `id` int(11) NOT NULL,
  `device_name` varchar(50) NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `last_seen` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `esp32_devices`
--

INSERT INTO `esp32_devices` (`id`, `device_name`, `ip_address`, `last_seen`) VALUES
(4, 'ESP32-101', '192.168.20.233', '2025-09-16 04:45:43');

-- --------------------------------------------------------

--
-- Table structure for table `lampu_log`
--

CREATE TABLE `lampu_log` (
  `nomor_log` int(11) NOT NULL,
  `status_lampu` varchar(10) NOT NULL,
  `sumber` varchar(50) NOT NULL,
  `waktu_menyala` datetime NOT NULL,
  `waktu_padam` datetime NOT NULL,
  `lama_menyala_detik` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lampu_log`
--

INSERT INTO `lampu_log` (`nomor_log`, `status_lampu`, `sumber`, `waktu_menyala`, `waktu_padam`, `lama_menyala_detik`) VALUES
(4, 'OFF', 'Android', '2025-09-16 13:44:34', '2025-09-16 13:44:37', 2),
(5, 'OFF', 'Android', '2025-09-16 14:31:32', '2025-09-16 14:31:33', 1),
(6, 'OFF', 'Android', '2025-09-16 13:45:12', '2025-09-16 14:31:35', 2783),
(7, 'OFF', 'Android', '2025-09-16 14:40:38', '2025-09-16 14:40:40', 1),
(8, 'OFF', 'Android', '2025-09-16 14:53:33', '2025-09-16 14:53:35', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `esp32_devices`
--
ALTER TABLE `esp32_devices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lampu_log`
--
ALTER TABLE `lampu_log`
  ADD PRIMARY KEY (`nomor_log`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `esp32_devices`
--
ALTER TABLE `esp32_devices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lampu_log`
--
ALTER TABLE `lampu_log`
  MODIFY `nomor_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
