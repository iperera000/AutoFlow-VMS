-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2026 at 02:01 PM
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
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`vehicle_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10201;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
