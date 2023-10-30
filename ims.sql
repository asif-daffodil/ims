-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2023 at 09:50 AM
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

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cerated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `cerated_at`) VALUES
(1, 'Square', '2023-10-21 12:52:08'),
(2, 'Popular', '2023-10-21 12:52:16'),
(3, 'Alcet', '2023-10-22 06:54:47'),
(4, 'Vifas', '2023-10-22 06:55:16'),
(5, 'Syndol', '2023-10-22 06:55:30'),
(6, 'Bondrova', '2023-10-22 06:55:44'),
(7, 'Ferisen', '2023-10-22 06:56:02'),
(8, 'Clacido', '2023-10-22 06:56:16'),
(9, 'Rozith', '2023-10-22 06:56:42'),
(10, 'Opal', '2023-10-22 06:57:42'),
(11, 'Sergel', '2023-10-22 06:57:54'),
(12, 'Clonatril', '2023-10-22 06:58:05'),
(13, 'Adapel', '2023-10-22 06:58:16'),
(14, 'Moxivin', '2023-10-22 06:58:40'),
(15, 'Incepta Pharmaceutical Ltd', '2023-10-22 07:02:52'),
(16, 'Beximco Pharmaceuticals Ltd', '2023-10-22 07:04:35'),
(17, 'Renata Ltd', '2023-10-22 07:05:48');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `mobile`, `address`, `created_at`) VALUES
(1, 'Aslam Mia', '01845165994', 'KA-59/4, Nadda Baridhara, Gulshan', '2023-10-21 13:12:58');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `client_id`, `product_id`, `quantity`, `price`, `total`, `status`, `created_at`) VALUES
(11, 1, 1, '5', 1200, 6000, 'Canceled', '2023-10-30 08:24:53'),
(12, 1, 1, '2', 1200, 2400, 'Canceled', '2023-10-30 08:27:26'),
(13, 1, 1, '5', 1200, 6000, 'Pending', '2023-10-30 08:37:56');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `description` longtext NOT NULL,
  `price` varchar(255) NOT NULL,
  `stock` varchar(255) NOT NULL,
  `shelf_no` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `type_id`, `brand_id`, `description`, `price`, `stock`, `shelf_no`, `created_at`) VALUES
(1, 'ORSaline-N', 2, 1, '&lt;p&gt;&lt;strong&gt;ORSaline-N&lt;/strong&gt;&lt;/p&gt;', '1200', '1868', '2', '2023-10-21 12:56:11'),
(3, 'Capsul', 1, 1, '&lt;p&gt;&lt;strong&gt;Square Pharmaceuticals Ltd&lt;/strong&gt;.&lt;/p&gt;', '10', '1000', '3', '2023-10-22 07:01:23'),
(4, 'Eye Drops', 10, 15, '&lt;p&gt;&lt;strong&gt;Incepta Pharmaceutical Ltd&lt;/strong&gt;&lt;/p&gt;', '15', '145', '2', '2023-10-22 07:02:52'),
(5, 'Sachet', 7, 16, '&lt;p&gt;&lt;strong&gt;Beximco Pharmaceuticals Ltd&lt;/strong&gt;&lt;/p&gt;', '50', '1245', '1230', '2023-10-22 07:04:35'),
(6, 'Cream', 8, 17, '&lt;p&gt;&lt;strong&gt;Renata Ltd&lt;/strong&gt;&lt;/p&gt;', '30', '452', '23', '2023-10-22 07:05:48');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `name`, `created_at`) VALUES
(1, 'Capsul', '2023-10-21 12:54:12'),
(2, 'Powder', '2023-10-21 12:54:26'),
(3, 'Tablet', '2023-10-22 06:48:05'),
(4, 'Saline', '2023-10-22 06:48:53'),
(5, 'Dry Syrup', '2023-10-22 06:50:20'),
(6, 'Syrup', '2023-10-22 06:50:32'),
(7, 'Injection', '2023-10-22 06:50:46'),
(8, 'Cream', '2023-10-22 06:51:05'),
(9, 'Ointment', '2023-10-22 06:51:16'),
(10, 'Eye Drops', '2023-10-22 06:51:28'),
(11, 'Sachet', '2023-10-22 06:51:58'),
(12, 'Intramuscular', '2023-10-22 06:52:36'),
(13, 'Powder for Suspension', '2023-10-22 06:52:55'),
(14, 'Effervescent Tablet', '2023-10-22 06:54:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
