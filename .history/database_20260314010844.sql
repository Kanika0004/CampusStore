-- phpMyAdmin SQL Dump
-- CampusStore Final Database

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `campusstore`;
USE `campusstore`;

-- --------------------------------------------------------
-- Table structure for table `addresses`
-- --------------------------------------------------------

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Table structure for table `cart`
-- --------------------------------------------------------

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`) VALUES
(1,1,1,1);

-- --------------------------------------------------------
-- Table structure for table `orders`
-- --------------------------------------------------------

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Table structure for table `products`
-- --------------------------------------------------------

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `subcategory` varchar(50) DEFAULT NULL,
  `popular` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `products` (`id`,`name`,`price`,`image`,`category`,`subcategory`,`popular`) VALUES
(1,'Wireless Mouse',599,'mouse.jpg','Electronics','Computer Accessories',1),
(2,'Notebook Set',299,'notebooks.jpg','Stationery','Notebooks',0),
(3,'Bluetooth Earbuds',1499,'earbuds.jpg','Electronics','Audio',1),
(4,'Campus Hoodie',899,'hoodie.jpg','Clothing','Hoodies',0),
(5,'Scientific Calculator',799,'calculator.jpg','Stationery','Calculators',1),
(6,'Laptop Stand',999,'laptopstand.jpg','Accessories','Computer Accessories',0),
(7,'Water Bottle',349,'bottle.jpg','Accessories','Water Bottles',0),
(8,'Backpack',1299,'backpack.jpg','Accessories','Bags',1),
(9,'Pen Pack',149,'penpack.jpg','Stationery','Pens',0),
(10,'Sticky Notes',99,'stickynotes.jpg','Stationery','Notes',0),
(11,'Graphic T-Shirt',699,'tshirt.jpg','Clothing','T-Shirts',1),
(12,'Power Bank',1199,'powerbank.jpg','Electronics','Computer Accessories',0),
(13,'Gaming Mouse Pad',399,'mousepad.jpg','Electronics','Computer Accessories',0),
(14,'USB Keyboard',899,'keyboard.jpg','Electronics','Computer Accessories',0),
(15,'Tablet Stand',699,'tabletstand.jpg','Electronics','Tablet Accessories',0),
(16,'Wired Earphones',499,'earphones.jpg','Electronics','Audio',0),
(17,'Running Shoes',1599,'shoes.jpg','Clothing','Shoes',0),
(18,'College Cap',349,'cap.jpg','Clothing','Caps',0),
(19,'Steel Water Bottle',349,'bottle.jpg','Accessories','Water Bottles',0),
(20,'Digital Watch',999,'watch.jpg','Accessories','Watches',0),
(21,'Document File',99,'file.jpg','Stationery','Files',0);

-- --------------------------------------------------------
-- Table structure for table `users`
-- --------------------------------------------------------

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`id`,`name`,`email`,`password`,`role`,`created_at`) VALUES
(1,'kanika','k@gmail.com','k123','user',CURRENT_TIMESTAMP),
(2,'Admin','admin@campusstore.com','admin123','admin',CURRENT_TIMESTAMP);

-- --------------------------------------------------------
-- Table structure for table `wishlist`
-- --------------------------------------------------------

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Table structure for table `enquiries`
-- --------------------------------------------------------

CREATE TABLE `enquiries` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `admin_reply` text DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Indexes
-- --------------------------------------------------------

ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `enquiries`
  ADD PRIMARY KEY (`id`);

-- --------------------------------------------------------
-- AUTO_INCREMENT
-- --------------------------------------------------------

ALTER TABLE `addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `enquiries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

COMMIT;