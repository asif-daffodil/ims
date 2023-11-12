-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2023 at 09:44 AM
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
-- Database: `ims`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--
-- Error reading structure for table ims.brands: #1932 - Table &#039;ims.brands&#039; doesn&#039;t exist in engine
-- Error reading data for table ims.brands: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `ims`.`brands`&#039; at line 1

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--
-- Error reading structure for table ims.clients: #1932 - Table &#039;ims.clients&#039; doesn&#039;t exist in engine
-- Error reading data for table ims.clients: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `ims`.`clients`&#039; at line 1

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--
-- Error reading structure for table ims.orders: #1932 - Table &#039;ims.orders&#039; doesn&#039;t exist in engine
-- Error reading data for table ims.orders: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `ims`.`orders`&#039; at line 1

-- --------------------------------------------------------

--
-- Table structure for table `products`
--
-- Error reading structure for table ims.products: #1932 - Table &#039;ims.products&#039; doesn&#039;t exist in engine
-- Error reading data for table ims.products: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `ims`.`products`&#039; at line 1

-- --------------------------------------------------------

--
-- Table structure for table `types`
--
-- Error reading structure for table ims.types: #1932 - Table &#039;ims.types&#039; doesn&#039;t exist in engine
-- Error reading data for table ims.types: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `ims`.`types`&#039; at line 1

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(160) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `email` varchar(160) NOT NULL,
  `image` varchar(160) NOT NULL,
  `pass` varchar(160) NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `gender`, `email`, `image`, `pass`, `role`, `created_at`) VALUES
(1, 'Roman', 'Male', 'roman@gmail.com', '', '$2y$10$8MebhfmCOrXzyBte.frdYuLvBo.LOk0QOZfOjsA4HDff.09ZID8iS', 'admin', '2023-11-12 08:19:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
