-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2023 at 10:04 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project-krushal-vataliya`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('available','unavailable') NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `parent_id`, `name`, `status`, `description`, `created_at`, `updated_at`) VALUES
(1, NULL, 'main', 'available', 'main', '2023-03-01 09:05:04', NULL),
(6, NULL, 'main 2', 'available', 'main 2', '2023-03-01 09:06:13', NULL),
(18, 1, 'b', 'available', 'b', '2023-03-02 07:15:32', '2023-03-02 08:20:09'),
(71, 18, 'c', 'available', 'c', '2023-03-11 11:15:21', NULL),
(114, 6, 'ssq', 'available', 'ssq', '2023-03-11 12:37:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `status` enum('available','unavailable') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `first_name`, `last_name`, `email`, `gender`, `mobile`, `status`, `created_at`, `updated_at`) VALUES
(3351, 'krushal', 'vataliya', 'krushalvataliya24@gmail.com', 'male', '06353319278', 'available', '2023-03-09 02:16:44', '2023-03-09 02:18:53'),
(3352, 'krushal v', 'vataliya', 'krushalvataliya24@gmail.com', 'male', '2147483647', 'available', '2023-03-09 02:16:52', '2023-03-10 08:21:05'),
(3364, 'krushal', 'vataliya', 'krushalvataliya24@gmail.com', 'male', '1221', 'available', '2023-03-13 03:48:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE `customer_address` (
  `address_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `zip_code` int(6) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_address`
--

INSERT INTO `customer_address` (`address_id`, `address`, `city`, `state`, `country`, `zip_code`, `created_at`, `updated_at`, `customer_id`) VALUES
(1, 'plot no.76/B', 'jamnagar', 'gujarat', 'in', 361008, '2023-03-09 07:46:44', '2023-03-09 09:53:56', 3351),
(2, 'plot no.76/B,', 'jamnagar', 'gujarat', 'Indiaa', 361008, '2023-03-09 07:46:52', NULL, 3352),
(136, 'plot no.76/B,', 'jamnagar', 'gujarat', 'India', 361008, '2023-03-13 09:18:15', NULL, 3364);

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `media_id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `img` varchar(255) NOT NULL,
  `thumbnail` tinyint(4) DEFAULT 0,
  `base` tinyint(4) DEFAULT 0,
  `midium` tinyint(4) DEFAULT 0,
  `large` tinyint(4) DEFAULT 0,
  `small` tinyint(4) DEFAULT 0,
  `gallary` tinyint(4) DEFAULT 0,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`media_id`, `filename`, `created_at`, `updated_at`, `img`, `thumbnail`, `base`, `midium`, `large`, `small`, `gallary`, `product_id`) VALUES
(12, 'aa', '2023-03-13 13:39:30', '2023-03-13 08:57:00', '13090930i.png', 1, 0, 1, 1, 1, 1, 2264);

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `payment_method_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('available','unavailable') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`payment_method_id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'cash', 'available', '2023-02-11 16:21:48', '2023-03-13 04:27:33'),
(40, 'upi', 'available', '2023-03-02 04:56:24', '2023-03-13 04:27:31');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `cost` int(5) NOT NULL,
  `price` int(5) NOT NULL,
  `quantity` int(5) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` enum('available','unavailable') NOT NULL,
  `color` enum('red','green','blue') NOT NULL,
  `material` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `sku`, `cost`, `price`, `quantity`, `description`, `status`, `color`, `material`, `created_at`, `updated_at`) VALUES
(2264, 'nokia 1100', 1100, 1100, 1100, 'nokia 1100', 'available', 'red', 'nokia 1100', '2023-03-13 13:32:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `salesman_address`
--

CREATE TABLE `salesman_address` (
  `address_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `zip_code` int(6) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `salesman_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salesman_address`
--

INSERT INTO `salesman_address` (`address_id`, `address`, `city`, `state`, `country`, `zip_code`, `created_at`, `updated_at`, `salesman_id`) VALUES
(1, 'plot no.76/B,', 'jamnagar', 'gujarat', 'India', 361008, '2023-03-09 07:36:20', '2023-03-09 09:55:39', 35),
(2, 'plot no.76/B,', 'jamnagar', 'gujarat', 'India', 361008, '2023-03-09 07:37:20', NULL, 36),
(6, 'plot no.76/B,', 'jamnagar', 'gujarat', 'India', 361008, '2023-03-12 09:26:11', NULL, 42);

-- --------------------------------------------------------

--
-- Table structure for table `salesman_price`
--

CREATE TABLE `salesman_price` (
  `entity_id` int(11) NOT NULL,
  `salesman_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `salesman_price` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salesman_price`
--

INSERT INTO `salesman_price` (`entity_id`, `salesman_id`, `product_id`, `salesman_price`, `updated_at`) VALUES
(58, 35, 2264, 12, '2023-03-13 09:02:11');

-- --------------------------------------------------------

--
-- Table structure for table `salesmen`
--

CREATE TABLE `salesmen` (
  `salesman_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `status` enum('available','unavailable') NOT NULL,
  `company` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salesmen`
--

INSERT INTO `salesmen` (`salesman_id`, `first_name`, `last_name`, `email`, `gender`, `mobile`, `status`, `company`, `created_at`, `updated_at`) VALUES
(35, 'krushal', 'vataliya', 'krushalvataliya24@gmail.com', 'male', '06353319278', 'available', 'cc', '2023-03-09 07:36:20', '2023-03-09 09:55:15'),
(36, 'kv', 'vataliya', 'krushalvataliya24@gmail.com', 'male', '06353319278', 'available', 'ww', '2023-03-09 07:37:20', NULL),
(42, 'krushalaa', 'vataliya', 'krushalvataliya24@gmail.com', 'male', '06353319278', 'available', 'aa', '2023-03-12 09:26:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shiping_methods`
--

CREATE TABLE `shiping_methods` (
  `shiping_method_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` enum('available','unavailable') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shiping_methods`
--

INSERT INTO `shiping_methods` (`shiping_method_id`, `name`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 'xxja', 6555, 'available', '2023-02-11 12:01:39', '2023-03-09 04:25:59'),
(3, 'hha', 65, 'available', '2023-02-11 15:29:06', '2023-03-07 06:53:37');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `vendor_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `status` enum('available','unavailable') NOT NULL,
  `company` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`vendor_id`, `first_name`, `last_name`, `email`, `gender`, `mobile`, `status`, `company`, `created_at`, `updated_at`) VALUES
(352, 'kvva', 'vataliya', 'krushalvataliya24@gmail.com', 'male', '06353319278', 'available', 'cc', '2023-03-09 07:54:54', '2023-03-10 14:02:07'),
(357, 'krushal', 'vataliya', 'krushalvataliya24@gmail.com', 'male', '06353319278', 'available', 'ss', '2023-03-11 21:07:36', NULL),
(358, 'krushal', 'vataliya', 'krushalvataliya24@gmail.com', 'male', '06353319278', 'available', 'cca', '2023-03-13 09:35:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendor_address`
--

CREATE TABLE `vendor_address` (
  `address_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `zip_code` int(6) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `vendor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendor_address`
--

INSERT INTO `vendor_address` (`address_id`, `address`, `city`, `state`, `country`, `zip_code`, `created_at`, `updated_at`, `vendor_id`) VALUES
(2, 'plot no.76/B', 'jamnagar', 'gujarat', 'India', 361008, '2023-03-09 07:54:54', '2023-03-09 09:54:57', 352),
(5, 'plot no.76/B,', 'jamnagar', 'gujarat', 'India', 361008, '2023-03-11 21:07:36', NULL, 357),
(6, 'plot no.76/B,', 'jamnagar', 'gujarat', 'India', 361008, '2023-03-13 09:35:10', NULL, 358);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `parent -id` (`parent_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `customer_id` (`customer_id`);

--
-- Indexes for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`media_id`),
  ADD KEY `product-id` (`product_id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`payment_method_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `salesman_address`
--
ALTER TABLE `salesman_address`
  ADD PRIMARY KEY (`address_id`),
  ADD UNIQUE KEY `salesman_id` (`salesman_id`);

--
-- Indexes for table `salesman_price`
--
ALTER TABLE `salesman_price`
  ADD PRIMARY KEY (`entity_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `salesman_id` (`salesman_id`);

--
-- Indexes for table `salesmen`
--
ALTER TABLE `salesmen`
  ADD PRIMARY KEY (`salesman_id`);

--
-- Indexes for table `shiping_methods`
--
ALTER TABLE `shiping_methods`
  ADD PRIMARY KEY (`shiping_method_id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`vendor_id`);

--
-- Indexes for table `vendor_address`
--
ALTER TABLE `vendor_address`
  ADD PRIMARY KEY (`address_id`),
  ADD UNIQUE KEY `vendor_id` (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3367;

--
-- AUTO_INCREMENT for table `customer_address`
--
ALTER TABLE `customer_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `media_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `payment_method_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=443;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2265;

--
-- AUTO_INCREMENT for table `salesman_address`
--
ALTER TABLE `salesman_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `salesman_price`
--
ALTER TABLE `salesman_price`
  MODIFY `entity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `salesmen`
--
ALTER TABLE `salesmen`
  MODIFY `salesman_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `shiping_methods`
--
ALTER TABLE `shiping_methods`
  MODIFY `shiping_method_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=333;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=359;

--
-- AUTO_INCREMENT for table `vendor_address`
--
ALTER TABLE `vendor_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `parent -id` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD CONSTRAINT `customer-id` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `product-id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `salesman_address`
--
ALTER TABLE `salesman_address`
  ADD CONSTRAINT `salesman_id` FOREIGN KEY (`salesman_id`) REFERENCES `salesmen` (`salesman_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `salesman_price`
--
ALTER TABLE `salesman_price`
  ADD CONSTRAINT `salesman_price_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `salesman_price_ibfk_2` FOREIGN KEY (`salesman_id`) REFERENCES `salesmen` (`salesman_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vendor_address`
--
ALTER TABLE `vendor_address`
  ADD CONSTRAINT `vendor-id` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`vendor_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
