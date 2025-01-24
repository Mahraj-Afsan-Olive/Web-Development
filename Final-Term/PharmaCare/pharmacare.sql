-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2025 at 07:14 AM
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
-- Database: `pharmacare`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountant_users`
--

CREATE TABLE `accountant_users` (
  `accountant_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(50) DEFAULT 'Accountant',
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accountant_users`
--

INSERT INTO `accountant_users` (`accountant_id`, `username`, `password`, `email`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Invincible', '$2y$10$R8lv4Ne7S6vFNAGkB3HuJe/auWcpwg5b8CPHEdBu9SrYngfzRpNEO', 'invinciblegamer2023@gmail.com', 'accountant', 'active', '2025-01-21 12:15:05', '2025-01-21 12:15:05'),
(2, 'account', '$2y$10$1qq2M9AeP/M3aazCauq8X.cINS1zgvoGQi9685BExGbqF7dAgHyni', 'account@gmail.com', 'accountant', 'active', '2025-01-22 05:19:43', '2025-01-22 05:19:43');

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(50) DEFAULT 'Admin',
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`admin_id`, `username`, `password`, `email`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Olive', '$2y$10$3q8s7uIkiwqZcfwIwQ2M6.tYaRJRi3sB3cUUolM0s7c5D/dSZ4.sO', 'olive@gmail.com', 'admin', 'active', '2025-01-22 03:50:26', '2025-01-22 03:50:26'),
(2, 'Talha', '$2y$10$HV0MM8m2Gz/MR6AahZLXVeByXP9JCOOg5PNxAJrKjsW0bfIoSJ8Im', 'talha@gmail.com', 'admin', 'active', '2025-01-22 04:37:45', '2025-01-22 04:37:45'),
(3, 'Imtiaz', '$2y$10$vcCcAlo3/ObS8hBA9phZk.2kOI6UmE/gicz7/b74W2Oky2R3hJz8a', 'imi@gmail.com', 'admin', 'active', '2025-01-22 05:58:53', '2025-01-22 05:58:53');

-- --------------------------------------------------------

--
-- Table structure for table `employee_users`
--

CREATE TABLE `employee_users` (
  `employee_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(50) DEFAULT 'Employee',
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_users`
--

INSERT INTO `employee_users` (`employee_id`, `username`, `password`, `email`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1, 'olive', '$2y$10$24GQtrBBgopiHMXFwHqTwuPifRA21SFzCd.O6qt/Cf9sy3By.B/be', 'oliveshikder2018@gmail.com', 'employee', 'active', '2025-01-21 11:10:11', '2025-01-21 11:10:11'),
(2, 'fahad', '$2y$10$i11SIonOunedbBiz2g07PO82dDRZ850Wakd4pvKuWoiOX4yQWrad.', 'fahad@gmail.com', 'employee', 'active', '2025-01-21 12:23:43', '2025-01-21 12:23:43'),
(3, 'Mila', '$2y$10$GMpm3JSHimqgc5zw9//dm.LxEfQ4eX6xvsoRmkJ0Z0tccV.4t.6Xa', 'mila@gmail.com', 'employee', 'active', '2025-01-22 04:53:24', '2025-01-22 04:53:24');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productID` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `manufactureDate` date NOT NULL,
  `expirationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productID`, `name`, `category`, `quantity`, `price`, `manufactureDate`, `expirationDate`) VALUES
('205819', 'Matro', 'Digestive Health', 50, 500.00, '2025-01-24', '2025-01-30'),
('477688', 'Nape', 'Antidiabetic', 10, 120.00, '2025-01-23', '2025-01-31'),
('733278', 'Deflex', 'Digestive Health', 50, 100.00, '2025-01-23', '2025-02-01'),
('747884', 'Napa', 'Antibiotics', 100, 60.00, '2025-01-21', '2025-01-31'),
('974224', 'Adovas', 'Respiratory', 50, 50.00, '2025-01-22', '2025-01-23');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `team_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `researcher_users`
--

CREATE TABLE `researcher_users` (
  `researcher_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(50) DEFAULT 'Researcher',
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `researcher_users`
--

INSERT INTO `researcher_users` (`researcher_id`, `username`, `password`, `email`, `role`, `status`, `created_at`, `updated_at`) VALUES
(2, 'asdf', '$2y$10$frQmoBFb03RKlWqZpBETtuTMyz/5HV8vcm0kOAzIWltZmfkbcliRS', 'asdf@gmail.com', 'researcher', 'active', '2025-01-21 11:21:22', '2025-01-21 11:21:22'),
(3, 'Invincible', '$2y$10$oPaLDKEmdx8ag4oRAtNRKeSlEjdZBPTLPBDmNCVGV0uOKqXEXgzA6', 'invinciblegamer2023@gmail.com', 'researcher', 'active', '2025-01-21 11:58:19', '2025-01-21 11:58:19');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `team_name` varchar(255) NOT NULL,
  `members` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accountant_users`
--
ALTER TABLE `accountant_users`
  ADD PRIMARY KEY (`accountant_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `employee_users`
--
ALTER TABLE `employee_users`
  ADD PRIMARY KEY (`employee_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `researcher_users`
--
ALTER TABLE `researcher_users`
  ADD PRIMARY KEY (`researcher_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accountant_users`
--
ALTER TABLE `accountant_users`
  MODIFY `accountant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee_users`
--
ALTER TABLE `employee_users`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `researcher_users`
--
ALTER TABLE `researcher_users`
  MODIFY `researcher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
