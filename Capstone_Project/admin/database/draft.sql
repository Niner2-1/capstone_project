-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2023 at 12:41 PM
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
-- Database: `draft`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_order`
--

CREATE TABLE `customer_order` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `data_paid` datetime DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `order_status` enum('pending','hold','rejected','successfully','canceled') DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_order`
--

INSERT INTO `customer_order` (`order_id`, `customer_id`, `product_id`, `data_paid`, `quantity`, `order_status`, `create_at`, `modified_at`) VALUES
(1, 1, 1, '2023-06-25 00:00:00', 100, 'pending', '0000-00-00 00:00:00', '2023-07-22 02:29:25'),
(2, 1, 1, '0000-00-00 00:00:00', 0, 'successfully', '0000-00-00 00:00:00', '2023-07-22 02:35:54');

-- --------------------------------------------------------

--
-- Table structure for table `patient_record`
--

CREATE TABLE `patient_record` (
  `record_id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `doctor_name` varchar(50) DEFAULT NULL,
  `record_date` datetime DEFAULT NULL,
  `age` varchar(10) DEFAULT NULL,
  `bp` varchar(100) DEFAULT NULL,
  `oxygen_level` varchar(10) DEFAULT NULL,
  `heart_rate` varchar(10) DEFAULT NULL,
  `weight` varchar(100) DEFAULT NULL,
  `height` varchar(100) DEFAULT NULL,
  `Chief_Complaint` text DEFAULT NULL,
  `diagnosis` text DEFAULT NULL,
  `prescription` text DEFAULT NULL,
  `archive_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_desc` text DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `stock` varchar(255) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `supplier_id`, `brand`, `product_name`, `product_desc`, `category`, `price`, `stock`, `expiry_date`) VALUES
(1, 1, 'pfizer', 'BioNTech', 'Vaccine', 'injection', '950', '1000', '2025-11-23'),
(2, 5, 'BrandY', 'Product B', 'Description for Product B', 'Home & Kitchen', '39.99', '100', '2024-06-30'),
(3, 3, 'BrandX', 'Product C', 'Details of Product C', 'Electronics', '299.50', '20', '2023-09-15'),
(6, 4, 'BrandA', 'Product F', 'Details of Product F', 'Beauty', '15.75', '30', '2023-11-30'),
(1001, 1, 'BrandX', 'Product A', 'This is Product A', 'Electronics', '499.99', '50', '2023-12-31'),
(1004, 3, 'BrandZ', 'Product D', 'Information about Product D', 'Fashion', '19.95', '80', '2025-03-20'),
(1005, 5, 'BrandY', 'Product E', 'Description for Product E', 'Home & Kitchen', '29.99', '60', '2024-12-31'),
(1007, 3, 'BrandZ', 'Product G', 'Information about Product G', 'Fashion', '49.95', '10', '2026-05-25'),
(1008, 4, 'BrandA', 'Product H', 'This is Product H', 'Beauty', '25.00', '25', '2024-08-10'),
(1009, 1, 'BrandX', 'Product I', 'Description for Product I', 'Electronics', '899.00', '15', '2023-10-22'),
(1010, 5, 'BrandY', 'Product J', 'Details of Product J', 'Home & Kitchen', '79.99', '5', '2025-01-05');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(255) DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `number` varchar(20) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_name`, `contact_person`, `number`, `telephone`, `email`) VALUES
(1, 'abc company', 'juan', '09123456789', '797-858', 'abc@gmail.com'),
(2, '[value-2]', '[value-3]', '[value-4]', '[value-5]', '[value-6]'),
(3, 'AA company', 'roiden', '234', '34', '123@asd.csa'),
(4, 'asd', 'roi', '4564', '456', '123@asd.csa'),
(5, 'AA company', 'roi', '456456', '4456546', '123@asd.csa');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_order`
--

CREATE TABLE `supplier_order` (
  `order_id` int(11) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_desc` text DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `order_status` enum('pending','return','rejected','successfully','canceled') DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier_order`
--

INSERT INTO `supplier_order` (`order_id`, `supplier_id`, `brand`, `product_name`, `product_desc`, `category`, `price`, `quantity`, `order_status`, `create_at`, `modified_at`) VALUES
(1, 1, '[value-3]', 'pfizer', 'injection', 'vaccine', '1000', '100', 'pending', '2023-07-21 22:22:27', '2023-07-22 20:50:46'),
(2, 1, '[value-3]', '[value-4]', '[value-5]', '[value-6]', '100', '1000', 'successfully', '2023-07-21 22:21:40', '2023-07-21 22:25:44'),
(3, 1, '[value-3]', '[value-4]', '[value-5]', '[value-6]', '[value-7]', '[value-8]', 'return', '0000-00-00 00:00:00', '2023-07-22 03:02:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `mi` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `number` varchar(20) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_type` enum('super admin','admin','customer') DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fname`, `lname`, `mi`, `birthday`, `number`, `telephone`, `address`, `username`, `password`, `user_type`, `create_at`, `modified_at`) VALUES
(1, 'Roiden', '[value-3]', '[value-4]', '0000-00-00', '', '[value-7]', '[value-8]', 'jiro', 'jiro', 'customer', '0000-00-00 00:00:00', '2023-07-21 23:18:51'),
(5, 'roiden', 'abu', '', '2023-07-22', '321', '123', 'lc', 'admin', 'admin123', 'admin', '2023-07-21 19:31:13', '2023-07-21 23:07:18'),
(7, 'reg', 'reg', '', '2023-07-25', '09215477304', '09095546', 'asdasd st. ', 'reg', 'reg', 'customer', '2023-07-25 07:36:51', '2023-07-25 07:37:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_order`
--
ALTER TABLE `customer_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `patient_record`
--
ALTER TABLE `patient_record`
  ADD PRIMARY KEY (`record_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `supplier_order`
--
ALTER TABLE `supplier_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer_order`
--
ALTER TABLE `customer_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `patient_record`
--
ALTER TABLE `patient_record`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1011;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `supplier_order`
--
ALTER TABLE `supplier_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_order`
--
ALTER TABLE `customer_order`
  ADD CONSTRAINT `customer_order_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `users` (`user_ID`),
  ADD CONSTRAINT `customer_order_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `patient_record`
--
ALTER TABLE `patient_record`
  ADD CONSTRAINT `patient_record_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `users` (`user_ID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`);

--
-- Constraints for table `supplier_order`
--
ALTER TABLE `supplier_order`
  ADD CONSTRAINT `supplier_order_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
