-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2026 at 09:03 PM
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
-- Database: `campusstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `landmark` varchar(100) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `zip` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`) VALUES
(1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `subcategory` varchar(50) DEFAULT NULL,
  `popular` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `category`, `subcategory`, `popular`) VALUES
(1, 'Wireless Mouse', 599.00, 'mouse.jpg', 'Electronics', 'Computer Accessories', 1),
(2, 'Notebook Set', 299.00, 'notebooks.jpg', 'Stationery', 'Notebooks', 0),
(3, 'Bluetooth Earbuds', 1499.00, 'earbuds.jpg', 'Electronics', 'Audio', 1),
(4, 'Campus Hoodie', 899.00, 'hoodie.jpg', 'Clothing', 'Hoodies', 0),
(5, 'Scientific Calculator', 799.00, 'calculator.jpg', 'Stationery', 'Calculators', 1),
(6, 'Laptop Stand', 999.00, 'laptopstand.jpg', 'Accessories', 'Computer Accessories', 0),
(7, 'Water Bottle', 349.00, 'bottle.jpg', 'Accessories', 'Water Bottles', 0),
(8, 'Backpack', 1299.00, 'backpack.jpg', 'Accessories', 'Bags', 1),
(9, 'Pen Pack', 149.00, 'penpack.jpg', 'Stationery', 'Pens', 0),
(10, 'Sticky Notes', 99.00, 'stickynotes.jpg', 'Stationery', 'Notes', 0),
(11, 'Graphic T-Shirt', 699.00, 'tshirt.jpg', 'Clothing', 'T-Shirts', 1),
(12, 'Power Bank', 1199.00, 'powerbank.jpg', 'Electronics', 'Computer Accessories', 0),
(13, 'Gaming Mouse Pad', 399.00, 'mousepad.jpg', 'Electronics', 'Computer Accessories', 0),
(14, 'USB Keyboard', 899.00, 'keyboard.jpg', 'Electronics', 'Computer Accessories', 0),
(15, 'Tablet Stand', 699.00, 'tabletstand.jpg', 'Electronics', 'Tablet Accessories', 0),
(16, 'Wired Earphones', 499.00, 'earphones.jpg', 'Electronics', 'Audio', 0),
(17, 'Graphic T-Shirt', 699.00, 'tshirt.jpg', 'Clothing', 'T-Shirts', 1),
(18, 'Running Shoes', 1599.00, 'shoes.jpg', 'Clothing', 'Shoes', 0),
(19, 'College Cap', 349.00, 'cap.jpg', 'Clothing', 'Caps', 0),
(20, 'Backpack', 1299.00, 'backpack.jpg', 'Accessories', 'Bags', 1),
(21, 'Steel Water Bottle', 349.00, 'bottle.jpg', 'Accessories', 'Water Bottles', 0),
(22, 'Digital Watch', 999.00, 'watch.jpg', 'Accessories', 'Watches', 0),
(23, 'Pen Pack', 149.00, 'penpack.jpg', 'Stationery', 'Pens', 0),
(24, 'Document File', 99.00, 'file.jpg', 'Stationery', 'Files', 0),
(25, 'Sticky Notes', 89.00, 'stickynotes.jpg', 'Stationery', 'Notes', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'kanika', 'k@gmail.com', 'k123', '2026-03-10 17:48:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
