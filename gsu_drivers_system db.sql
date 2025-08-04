-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2025 at 08:01 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gsu_drivers_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Super Admin','Manager','Scheduler') DEFAULT 'Manager',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(2, 'admin', 'admin@example.com', '$2y$10$53UZX0JUyywecBSc0lq2O.MQItjdUQ02Q7dl4QIyLOH0A3Nd8QCH6', 'Super Admin', '2025-02-16 22:54:23');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `role` enum('Chief Driver','Junior Driver','Car Driver','Bus Driver') NOT NULL,
  `grade_level` varchar(20) NOT NULL,
  `license_number` varchar(50) NOT NULL,
  `vehicle_assigned` varchar(100) DEFAULT NULL,
  `route_assigned` varchar(100) DEFAULT NULL,
  `kilometers_traveled` decimal(10,2) DEFAULT 0.00,
  `salary` decimal(10,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id`, `name`, `email`, `phone`, `role`, `grade_level`, `license_number`, `vehicle_assigned`, `route_assigned`, `kilometers_traveled`, `salary`, `created_at`) VALUES
(17, 'MUSA SULAIMAN', 'mubrak20@gmail.com', '09097867572', 'Chief Driver', '2', '5', NULL, NULL, 0.00, 0.00, '2025-02-17 18:21:28'),
(18, 'Hamza Sani', 'HAMZA12@GMAIL.COM', '0809298955', 'Junior Driver', '3', '56', NULL, NULL, 0.00, 930.00, '2025-02-17 18:21:44'),
(19, 'AHMAD MUSA', 'AHMAD12@GMAIL.COM', '08092989897', 'Car Driver', '6', '49', NULL, NULL, 0.00, 860.00, '2025-02-17 18:22:16'),
(20, 'Yusuf Musa', 'yusufmusa@gmail.com', '09097867566', 'Bus Driver', '5', '45', NULL, NULL, 0.00, 1280.00, '2025-02-17 18:22:38');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `driver_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `kilometers_traveled` decimal(10,2) DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `report_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `driver_name`, `email`, `phone`, `kilometers_traveled`, `salary`, `report_date`) VALUES
(1, 'AHMAD IBRAHIM', 'HAMZA12@GMAIL.COM', '09097867572', 50.00, 41280.00, '2025-02-17 18:07:38'),
(2, 'MUSA SULAIMAN', 'HAMZA162@GMAIL.COM', '0809298957', 47.00, 41860.00, '2025-02-17 18:07:38'),
(3, 'AHMAD MUSA', 'mubaraak20@gmail.com', '09097866767', 53.00, 43680.00, '2025-02-17 18:07:38'),
(4, 'Yusuf Musa', 'yusufmusa@gmail.com', '08089987798', 58.00, 46720.00, '2025-02-17 18:07:38'),
(5, 'Hamza Abubakar', 'hamzaabubakar@gmail.com', '07083976565', 33.00, 34300.00, '2025-02-17 18:07:38'),
(6, 'Sani Musa', 'sanimusa@gmail.com', '070564343465', 0.00, 0.00, '2025-02-17 18:07:38'),
(7, 'Hamza Sani', 'hamzasani@gmail.com', '07088767564', 0.00, 0.00, '2025-02-17 18:07:38'),
(8, 'AHMAD IBRAHIM', 'HAMZA12@GMAIL.COM', '09097867572', 50.00, 41280.00, '2025-02-17 18:08:57'),
(9, 'MUSA SULAIMAN', 'HAMZA162@GMAIL.COM', '0809298957', 47.00, 41860.00, '2025-02-17 18:08:58'),
(10, 'AHMAD MUSA', 'mubaraak20@gmail.com', '09097866767', 53.00, 43680.00, '2025-02-17 18:08:58'),
(11, 'Yusuf Musa', 'yusufmusa@gmail.com', '08089987798', 58.00, 46720.00, '2025-02-17 18:08:58'),
(12, 'Hamza Abubakar', 'hamzaabubakar@gmail.com', '07083976565', 33.00, 34300.00, '2025-02-17 18:08:58'),
(13, 'Sani Musa', 'sanimusa@gmail.com', '070564343465', 0.00, 0.00, '2025-02-17 18:08:58'),
(14, 'Hamza Sani', 'hamzasani@gmail.com', '07088767564', 0.00, 0.00, '2025-02-17 18:08:58');

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `id` int(11) NOT NULL,
  `route_name` varchar(100) NOT NULL,
  `distance_km` decimal(5,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`id`, `route_name`, `distance_km`, `created_at`) VALUES
(1, 'Gombe State University to Pantami', 10.50, '2025-02-16 21:06:00'),
(2, 'Gombe State University to Tumfure', 12.80, '2025-02-16 21:06:00'),
(3, 'Gombe State University to Nasarawa', 8.60, '2025-02-16 21:06:00'),
(4, 'Gombe State University to New GRA', 9.30, '2025-02-16 21:06:00'),
(5, 'Gombe State University to Yalan Gurusa', 15.20, '2025-02-16 21:06:00'),
(8, 'Gombe State University To Kumo', 30.00, '2025-02-17 12:53:33'),
(9, 'Gombe State University To Kashere', 27.00, '2025-02-17 12:53:53'),
(10, 'Gombe State University To Pindiga', 29.00, '2025-02-17 12:54:52');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL,
  `week_start_date` date NOT NULL,
  `distance_km` int(11) NOT NULL,
  `pay_amount` decimal(10,2) NOT NULL,
  `schedule_date` date NOT NULL,
  `status` enum('Scheduled','Completed') DEFAULT 'Scheduled',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `week_end_date` date NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `driver_id`, `vehicle_id`, `route_id`, `week_start_date`, `distance_km`, `pay_amount`, `schedule_date`, `status`, `created_at`, `week_end_date`, `completed`) VALUES
(112, 18, 15, 4, '2025-02-10', 0, 0.00, '2025-02-10', 'Completed', '2025-02-17 18:24:27', '2025-02-16', 1),
(113, 19, 16, 3, '2025-02-10', 0, 0.00, '2025-02-10', 'Completed', '2025-02-17 18:24:27', '2025-02-16', 1),
(114, 20, 15, 2, '2025-02-10', 0, 0.00, '2025-02-10', 'Completed', '2025-02-17 18:24:27', '2025-02-16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL,
  `vehicle_name` varchar(100) NOT NULL,
  `vehicle_type` enum('Car','Bus','Truck','Van','SUV') NOT NULL DEFAULT 'Car',
  `plate_number` varchar(20) NOT NULL,
  `capacity` int(11) NOT NULL,
  `status` enum('Available','In Use','Maintenance') NOT NULL DEFAULT 'Available',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `vehicle_name`, `vehicle_type`, `plate_number`, `capacity`, `status`, `created_at`) VALUES
(12, 'MAIN BUS', 'Bus', '87', 29, 'Maintenance', '2025-02-17 11:49:40'),
(13, 'GSU Bus 101', 'Bus', '345', 30, 'Available', '2025-02-17 12:29:51'),
(14, 'GSU Bus 201', 'Bus', '343', 20, 'Available', '2025-02-17 12:30:27'),
(15, 'GSU Bus 102', 'Bus', '232', 25, 'Available', '2025-02-17 12:30:57'),
(16, 'GSU Sedan 101', 'Car', '67', 18, 'Available', '2025-02-17 12:31:16'),
(17, 'GSU SUV 102', 'Car', '89', 5, 'Available', '2025-02-17 12:31:51'),
(18, 'GSU Emergency Van 701', 'Truck', '35', 7, 'Available', '2025-02-17 12:32:23'),
(19, 'GSU Cargo Truck 601', 'Truck', '78', 7, 'Available', '2025-02-17 12:32:57'),
(20, 'SMALL BUS', 'Bus', '79', 7, 'Maintenance', '2025-02-17 12:33:14'),
(21, 'GSU Bus 501', 'Bus', '778', 15, 'In Use', '2025-02-17 12:33:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `license_number` (`license_number`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `driver_id` (`driver_id`),
  ADD KEY `vehicle_id` (`vehicle_id`),
  ADD KEY `route_id` (`route_id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `plate_number` (`plate_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_ibfk_1` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `schedules_ibfk_2` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `schedules_ibfk_3` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
