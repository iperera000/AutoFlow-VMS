-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2026 at 05:01 AM
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
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
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
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `full_name`, `email`, `nic`, `phone`, `address`, `username`, `password`, `registered_at`) VALUES
(1, 'ishini perera', 'privateacc4ish@gmail.com', '200412345678', '0713889186', 'Colombo 10, Sri Lanka', 'rliperera', '$2y$10$MegmwkbHUluJSaVpX1Yz6.reVK3QHjsC5jSniHA5Ph7Lzu8OzJQR6', '2026-02-21 03:41:30');

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `assignment_date` datetime DEFAULT current_timestamp(),
  `status` enum('active','completed') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `driver_id`, `vehicle_id`, `assignment_date`, `status`) VALUES
(1, 1, 1011, '2026-02-21 12:13:11', 'active');

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

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `vehicle_id` int(11) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `year` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `engine_cc` int(11) NOT NULL,
  `fuel_type` varchar(50) NOT NULL,
  `transmission` varchar(50) NOT NULL,
  `image` varchar(255) DEFAULT 'default-car.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`vehicle_id`, `brand`, `model`, `year`, `type`, `engine_cc`, `fuel_type`, `transmission`, `image`) VALUES
(1, 'Brand', 'Model', 0, 'Type', 0, 'FuelType', '          Transmission', ''),
(1011, 'Toyota', 'Corolla', 2020, 'Sedan', 1800, 'Petrol', 'Automatic', ''),
(1012, 'Honda', 'Civic', 2019, 'Sedan', 1500, 'Petrol', 'Automatic', ''),
(1013, 'Ford', 'Focus', 2018, 'Hatchback', 2000, 'Diesel', 'Manual', ''),
(1014, 'BMW', '320i', 2021, 'Sedan', 2000, 'Petrol', 'Automatic', 'BMW-320i.jpg'),
(1015, 'Audi', 'A4', 2020, 'Sedan', 2000, 'Petrol', 'Automatic', 'audi-a4-2020.avif'),
(1016, 'Mercedes Benz', 'C200', 2022, 'Sedan', 2000, 'Petrol', 'Automatic', '2022-mercedes-benz-c200.webp'),
(1017, 'Tesla', 'Model 3', 2023, 'EV', 0, 'Electric', 'Automatic', ''),
(1018, 'Nissan', 'Leaf', 2022, 'EV', 0, 'Electric', 'Automatic', 'nissan-leaf-2022.avif'),
(1019, 'Hyundai', 'Elantra', 2021, 'Sedan', 1600, 'Petrol', 'Automatic', '2021-hyundai-elantra.avif'),
(10100, 'Volvo', 'Model100', 2021, 'Van', 3000, 'Diesel', 'Automatic', ''),
(10110, 'Kia', 'Cerato', 2020, 'Sedan', 1600, 'Petrol', 'Manual', ''),
(10111, 'Toyota', 'Land Cruiser', 2022, 'SUV', 3500, 'Diesel', 'Automatic', 'toyotalandcruiser-2022.jpg'),
(10112, 'Ford', 'Ranger', 2021, 'Truck', 3200, 'Diesel', 'Manual', ''),
(10113, 'Chevrolet', 'Silverado', 2020, 'Truck', 5300, 'Petrol', 'Automatic', 'chevrolet-silverado-2020.webp'),
(10114, 'Jeep', 'Wrangler', 2022, 'SUV', 3600, 'Petrol', 'Manual', '2022-jeep-wrangler.avif'),
(10115, 'Subaru', 'Forester', 2021, 'SUV', 2500, 'Petrol', 'Automatic', ''),
(10116, 'Mazda', 'CX-5', 2020, 'SUV', 2200, 'Diesel', 'Automatic', ''),
(10117, 'Volkswagen', 'Golf', 2019, 'Hatchback', 1400, 'Petrol', 'Manual', ''),
(10118, 'Peugeot', '208', 2020, 'Hatchback', 1200, 'Petrol', 'Manual', ''),
(10119, 'Renault', 'Clio', 2021, 'Hatchback', 1000, 'Petrol', 'Manual', ''),
(10120, 'Skoda', 'Octavia', 2022, 'Sedan', 2000, 'Diesel', 'Automatic', ''),
(10121, 'Volvo', 'XC90', 2022, 'SUV', 2000, 'Hybrid', 'Automatic', ''),
(10122, 'Jaguar', 'F-Pace', 2021, 'SUV', 2000, 'Diesel', 'Automatic', '2021-jaguar-f-pace.jpg'),
(10123, 'Porsche', 'Macan', 2023, 'SUV', 2900, 'Petrol', 'Automatic', 'porsche-macan-2023.webp'),
(10124, 'Lexus', 'RX350', 2022, 'SUV', 3500, 'Petrol', 'Automatic', 'lexus-rx-350.jpg'),
(10125, 'Mitsubishi', 'Outlander', 2020, 'SUV', 2400, 'Petrol', 'Automatic', ''),
(10126, 'Toyota', 'Hiace', 2021, 'Van', 2800, 'Diesel', 'Manual', ''),
(10127, 'Nissan', 'Caravan', 2020, 'Van', 2500, 'Diesel', 'Manual', ''),
(10128, 'Ford', 'Transit', 2022, 'Van', 2200, 'Diesel', 'Manual', ''),
(10129, 'Kia', 'Sportage', 2021, 'SUV', 2000, 'Diesel', 'Automatic', ''),
(10130, 'Hyundai', 'Tucson', 2022, 'SUV', 2000, 'Petrol', 'Automatic', ''),
(10131, 'Toyota', 'Model31', 2018, 'Sedan', 1000, 'Petrol', 'Manual', ''),
(10132, 'Honda', 'Model32', 2019, 'SUV', 1500, 'Diesel', 'Automatic', ''),
(10133, 'Nissan', 'Model33', 2020, 'Hatchback', 2000, 'Hybrid', 'Manual', ''),
(10134, 'Hyundai', 'Model34', 2021, 'Truck', 2500, 'Electric', 'Automatic', ''),
(10135, 'Kia', 'Model35', 2022, 'Van', 3000, 'Petrol', 'Manual', ''),
(10136, 'Mazda', 'Model36', 2023, 'Sedan', 1000, 'Diesel', 'Automatic', ''),
(10137, 'Subaru', 'Model37', 2018, 'SUV', 1500, 'Hybrid', 'Manual', ''),
(10138, 'Volkswagen', 'Model38', 2019, 'Hatchback', 2000, 'Electric', 'Automatic', ''),
(10139, 'Skoda', 'Model39', 2020, 'Truck', 2500, 'Petrol', 'Manual', ''),
(10140, 'Volvo', 'Model40', 2021, 'Van', 3000, 'Diesel', 'Automatic', ''),
(10141, 'Toyota', 'Model41', 2022, 'Sedan', 1000, 'Hybrid', 'Manual', ''),
(10142, 'Honda', 'Model42', 2023, 'SUV', 1500, 'Electric', 'Automatic', ''),
(10143, 'Nissan', 'Model43', 2018, 'Hatchback', 2000, 'Petrol', 'Manual', 'nissan-hatchback-2018.webp'),
(10144, 'Hyundai', 'Model44', 2019, 'Truck', 2500, 'Diesel', 'Automatic', ''),
(10145, 'Kia', 'Model45', 2020, 'Van', 3000, 'Hybrid', 'Manual', ''),
(10146, 'Mazda', 'Model46', 2021, 'Sedan', 1000, 'Electric', 'Automatic', ''),
(10147, 'Subaru', 'Model47', 2022, 'SUV', 1500, 'Petrol', 'Manual', ''),
(10148, 'Volkswagen', 'Model48', 2023, 'Hatchback', 2000, 'Diesel', 'Automatic', ''),
(10149, 'Skoda', 'Model49', 2018, 'Truck', 2500, 'Hybrid', 'Manual', ''),
(10150, 'Volvo', 'Model50', 2019, 'Van', 3000, 'Electric', 'Automatic', ''),
(10151, 'Toyota', 'Model51', 2020, 'Sedan', 1000, 'Petrol', 'Manual', ''),
(10152, 'Honda', 'Model52', 2021, 'SUV', 1500, 'Diesel', 'Automatic', ''),
(10153, 'Nissan', 'Model53', 2022, 'Hatchback', 2000, 'Hybrid', 'Manual', ''),
(10154, 'Hyundai', 'Model54', 2023, 'Truck', 2500, 'Electric', 'Automatic', ''),
(10155, 'Kia', 'Model55', 2018, 'Van', 3000, 'Petrol', 'Manual', ''),
(10156, 'Mazda', 'Model56', 2019, 'Sedan', 1000, 'Diesel', 'Automatic', ''),
(10157, 'Subaru', 'Model57', 2020, 'SUV', 1500, 'Hybrid', 'Manual', ''),
(10158, 'Volkswagen', 'Model58', 2021, 'Hatchback', 2000, 'Electric', 'Automatic', ''),
(10159, 'Skoda', 'Model59', 2022, 'Truck', 2500, 'Petrol', 'Manual', ''),
(10160, 'Volvo', 'Model60', 2023, 'Van', 3000, 'Diesel', 'Automatic', ''),
(10161, 'Toyota', 'Model61', 2018, 'Sedan', 1000, 'Hybrid', 'Manual', ''),
(10162, 'Honda', 'Model62', 2019, 'SUV', 1500, 'Electric', 'Automatic', ''),
(10163, 'Nissan', 'Model63', 2020, 'Hatchback', 2000, 'Petrol', 'Manual', ''),
(10164, 'Hyundai', 'Model64', 2021, 'Truck', 2500, 'Diesel', 'Automatic', ''),
(10165, 'Kia', 'Model65', 2022, 'Van', 3000, 'Hybrid', 'Manual', ''),
(10166, 'Mazda', 'Model66', 2023, 'Sedan', 1000, 'Electric', 'Automatic', ''),
(10167, 'Subaru', 'Model67', 2018, 'SUV', 1500, 'Petrol', 'Manual', ''),
(10168, 'Volkswagen', 'Model68', 2019, 'Hatchback', 2000, 'Diesel', 'Automatic', ''),
(10169, 'Skoda', 'Model69', 2020, 'Truck', 2500, 'Hybrid', 'Manual', ''),
(10170, 'Volvo', 'Model70', 2021, 'Van', 3000, 'Electric', 'Automatic', ''),
(10171, 'Toyota', 'Model71', 2022, 'Sedan', 1000, 'Petrol', 'Manual', ''),
(10172, 'Honda', 'Model72', 2023, 'SUV', 1500, 'Diesel', 'Automatic', ''),
(10173, 'Nissan', 'Model73', 2018, 'Hatchback', 2000, 'Hybrid', 'Manual', ''),
(10174, 'Hyundai', 'Model74', 2019, 'Truck', 2500, 'Electric', 'Automatic', ''),
(10175, 'Kia', 'Model75', 2020, 'Van', 3000, 'Petrol', 'Manual', ''),
(10176, 'Mazda', 'Model76', 2021, 'Sedan', 1000, 'Diesel', 'Automatic', ''),
(10177, 'Subaru', 'Model77', 2022, 'SUV', 1500, 'Hybrid', 'Manual', ''),
(10178, 'Volkswagen', 'Model78', 2023, 'Hatchback', 2000, 'Electric', 'Automatic', ''),
(10179, 'Skoda', 'Model79', 2018, 'Truck', 2500, 'Petrol', 'Manual', ''),
(10180, 'Volvo', 'Model80', 2019, 'Van', 3000, 'Diesel', 'Automatic', ''),
(10181, 'Toyota', 'Model81', 2020, 'Sedan', 1000, 'Hybrid', 'Manual', ''),
(10182, 'Honda', 'Model82', 2021, 'SUV', 1500, 'Electric', 'Automatic', ''),
(10183, 'Nissan', 'Model83', 2022, 'Hatchback', 2000, 'Petrol', 'Manual', ''),
(10184, 'Hyundai', 'Model84', 2023, 'Truck', 2500, 'Diesel', 'Automatic', ''),
(10185, 'Kia', 'Model85', 2018, 'Van', 3000, 'Hybrid', 'Manual', ''),
(10186, 'Mazda', 'Model86', 2019, 'Sedan', 1000, 'Electric', 'Automatic', ''),
(10187, 'Subaru', 'Model87', 2020, 'SUV', 1500, 'Petrol', 'Manual', ''),
(10188, 'Volkswagen', 'Model88', 2021, 'Hatchback', 2000, 'Diesel', 'Automatic', ''),
(10189, 'Skoda', 'Model89', 2022, 'Truck', 2500, 'Hybrid', 'Manual', ''),
(10190, 'Volvo', 'Model90', 2023, 'Van', 3000, 'Electric', 'Automatic', ''),
(10191, 'Toyota', 'Model91', 2018, 'Sedan', 1000, 'Petrol', 'Manual', ''),
(10192, 'Honda', 'Model92', 2019, 'SUV', 1500, 'Diesel', 'Automatic', ''),
(10193, 'Nissan', 'Model93', 2020, 'Hatchback', 2000, 'Hybrid', 'Manual', ''),
(10194, 'Hyundai', 'Model94', 2021, 'Truck', 2500, 'Electric', 'Automatic', ''),
(10195, 'Kia', 'Model95', 2022, 'Van', 3000, 'Petrol', 'Manual', ''),
(10196, 'Mazda', 'Model96', 2023, 'Sedan', 1000, 'Diesel', 'Automatic', ''),
(10197, 'Subaru', 'Model97', 2018, 'SUV', 1500, 'Hybrid', 'Manual', ''),
(10198, 'Volkswagen', 'Model98', 2019, 'Hatchback', 2000, 'Electric', 'Automatic', ''),
(10199, 'Skoda', 'Model99', 2020, 'Truck', 2500, 'Petrol', 'Manual', ''),
(10200, 'Ford', 'Mustang', 2019, 'Sedan', 1900, 'Petrol', 'Automatic', 'vehicle_69998a07857479.75259683.webp');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nic` (`nic`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `driver_id` (`driver_id`),
  ADD KEY `vehicle_id` (`vehicle_id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nic` (`nic`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`vehicle_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10201;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `assignments_ibfk_1` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assignments_ibfk_2` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`vehicle_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
