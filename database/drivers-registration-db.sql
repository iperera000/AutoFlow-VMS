-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2026 at 02:32 PM
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
-- Database: `autoflow`
--

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nic` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `registered_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id`, `full_name`, `email`, `nic`, `phone`, `address`, `username`, `password`, `registered_at`) VALUES
(1, 'Dasun Shanaka', 'dshanaka@gmail.com', '199512345678', '0712445832', 'Colombo 2, Sri Lanka', 'dshanaka', '$2y$10$KYLGcuLI5BxGNxtS44DR4OvociqXJ2av76iQNGQXBuOaXlCd9tt7.', '2026-02-21 04:04:05'),
(2, 'samantha dissanayake', 'sdissanayake@gmail.com', '199712345678', '0773092876', '124, Kirulapana, Sri Lanka', 'sdissanayake', '$2y$10$cQYMkxCmG1tk1hUi5UtQCunxqwOBTPCCEwXfFqUlhzbcisZDOOnBG', '2026-02-21 13:23:23'),
(3, 'pawani perera', 'pperera@gmail.com', '200212345678', '0701236758', '23, Nugegoda, Sri Lanka', 'pperera', '$2y$10$OHP9VGP/qFvWGLyFfaytFuGE5JQf998WzR3J75Mdy./6ebfVXB0eC', '2026-02-21 13:24:51'),
(4, 'Nimashi Weerathunga', 'nweerathunga@gmail.com', '200312345678', '0712348905', '56, Navam street, Colombo', 'nweerathunga', '$2y$10$YoiZGeUiLiOU3.LoffTY7O7kuWIJcqrm3Asu4NwcTjTUVdbAI4q1a', '2026-02-21 13:28:31'),
(5, 'amal jayasiri', 'ajayasiri@gmail.com', '198912345678', '0775982736', '33, Kurunagala, Sri Lanka', 'ajayasiri', '$2y$10$7fID/LBnWNcM2YM7IrHzGuFtrLriYtfNbw10yoLQkA50kAcFfRc2K', '2026-02-21 13:30:00'),
(6, 'kamal hettige', 'khettige@gmail.com', '198512345678', '0778945637', '124, Pitipana, Homagama', 'khettige', '$2y$10$Y5EeMJAvatCdk9s1XyMyK.YMgcCaVAN0gTRODKK/d4rQ1dvbCl0zO', '2026-02-21 13:31:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nic` (`nic`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
