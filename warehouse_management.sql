-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 09, 2025 at 05:56 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `warehouse_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `department` varchar(100) DEFAULT NULL,
  `status` enum('present','absent','on leave') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `name`, `email`, `department`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Kayne', 'kayne@gmail.com', 'Food', 'present', '2025-01-09 13:11:45', '2025-01-09 13:11:45');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `status` enum('active','inactive','on leave') NOT NULL,
  `hire_date` date DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `email`, `phone`, `department`, `status`, `hire_date`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Anne', 'anne@gmail.com', '081211112222', 'Food', 'active', '2025-01-07', 'Staff', '2025-01-09 16:55:52', '2025-01-09 16:55:52');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `product` varchar(100) DEFAULT NULL,
  `status` enum('not started','in progress','finished') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `name`, `email`, `category`, `product`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Kayne', 'kayne@gmail.com', 'Drink', 'Milk', 'in progress', '2025-01-09 13:12:34', '2025-01-09 13:12:34'),
(2, 'Jason', 'jason@gmail.com', 'Food', 'Frozen', 'finished', '2025-01-09 13:13:27', '2025-01-09 13:13:27');

-- --------------------------------------------------------

--
-- Table structure for table `product_list`
--

CREATE TABLE `product_list` (
  `id_product` int(11) NOT NULL,
  `name_product` varchar(225) NOT NULL,
  `category_product` varchar(225) NOT NULL,
  `quantity_product` int(8) NOT NULL,
  `restock_product` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_list`
--

INSERT INTO `product_list` (`id_product`, `name_product`, `category_product`, `quantity_product`, `restock_product`) VALUES
(8, 'Meat', 'Food', 20, 'No'),
(9, 'Milk', 'Drink', 10, 'No'),
(10, 'Mineral Water', 'Drink', 20, 'No'),
(11, 'Cheetos', 'Food', 50, 'No'),
(12, 'Rice', 'Food', 30, 'No');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `name`, `password`, `role`) VALUES
('admin_claire', 'Claire', '182e500f562c7b95a2ae0b4dd9f47bb2', 'Admin'),
('manager_steve', 'Steve', 'd69403e2673e611d4cbd3fad6fd1788e', 'Manager'),
('staff_anne', 'Anne', 'e3fb62ebfa4f36acf5cbff6a6ed0f2e0', 'Staff'),
('staff_jason', 'Jason', '2b877b4b825b48a9a0950dd5bd1f264d', 'Staff'),
('staff_kayne', 'Kayne', '0d2504ac0dbec706e7a564f5c5b15700', 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `users_product`
--

CREATE TABLE `users_product` (
  `email` varchar(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_product`
--

INSERT INTO `users_product` (`email`, `name`, `password`) VALUES
('christina@gmail.com', 'Christina', 'e311dd5fd4cdbba780ea0d0062df7788'),
('christoper@gmail.com', 'Christoper', '649d4bbfa63ecc0f9419a89a360266b4'),
('fans@gmail.com', 'Fans', '1ed1645edd706dc379effe13f3edcacf'),
('kai@gmail.com', 'Kai', 'e79fb748c3c8ab532a8fcf2da53ae54d');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`,`email`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`,`email`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`,`email`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `product_list`
--
ALTER TABLE `product_list`
  ADD PRIMARY KEY (`id_product`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `users_product`
--
ALTER TABLE `users_product`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_list`
--
ALTER TABLE `product_list`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
