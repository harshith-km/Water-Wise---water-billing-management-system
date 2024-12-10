-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2024 at 04:44 AM
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
-- Database: `wbms`
--
CREATE DATABASE IF NOT EXISTS `wbms` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `wbms`;

-- --------------------------------------------------------

--
-- Table structure for table `billing_transactions`
--

CREATE TABLE IF NOT EXISTS `billing_transactions` (
  `bill_id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `billing_date` date DEFAULT NULL,
  `usage_cost` decimal(10,2) NOT NULL,
  `due` decimal(10,2) NOT NULL,
  `net_amount` decimal(10,2) NOT NULL,
  `payment_status` enum('paid','pending') NOT NULL,
  `payment_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`bill_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `billing_transactions`
--

INSERT INTO `billing_transactions` (`bill_id`, `email`, `billing_date`, `usage_cost`, `due`, `net_amount`, `payment_status`, `payment_date`) VALUES
(11, 'harsha@gmail.com', '2024-06-20', 200.00, 0.00, 200.00, 'paid', '2024-07-29 08:02:02'),
(12, 'harsha@gmail.com', '2024-05-20', 213.00, 0.00, 213.00, 'paid', '2024-07-06 09:16:20'),
(13, 'harsha@gmail.com', '2024-04-20', 320.00, 0.00, 320.00, 'pending', '2024-07-29 08:27:24'),
(15, 'nandi@gmail.com', '2024-08-13', 187.50, 0.00, 187.00, 'pending', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `callback_request`
--

CREATE TABLE IF NOT EXISTS `callback_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `problem` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone_no` int(10) NOT NULL,
  `status` enum('pending','processing','solved','') NOT NULL DEFAULT 'pending',
  `createdon` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `callback_request`
--

INSERT INTO `callback_request` (`id`, `email`, `problem`, `description`, `name`, `phone_no`, `status`, `createdon`) VALUES
(19, '', 'jkl', 'water', 'Harsha', 2147483647, 'pending', '2024-08-13 02:39:21'),
(20, '', 'jkl', 'water', 'Harsha', 2147483647, 'pending', '2024-08-13 02:40:40'),
(21, 'harsha@gmail.com', 'ghi', 'dsdg', 'zvfdf', 832472384, 'pending', '2024-08-13 02:42:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `address` varchar(250) NOT NULL,
  `regdate` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `password`, `address`, `regdate`) VALUES
(1, 'Harshith', 'Km', 'harsha@gmail.com', 'dc647eb65e6711e155375218212b3964', 'SIT 7th cross', '2024-06-28 02:53:36'),
(28, 'Nandish', 'HM', 'nandi@gmail.com', 'dc647eb65e6711e155375218212b3964', 'Tumkur', '2024-08-13 02:10:40');

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE IF NOT EXISTS `wallet` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `credit` decimal(10,2) NOT NULL DEFAULT 0.00,
  `debit` decimal(10,2) NOT NULL DEFAULT 0.00,
  `wallet_bal` decimal(10,0) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`id`, `email`, `credit`, `debit`, `wallet_bal`, `added_on`) VALUES
(1, 'harsha@gmail.com', 0.00, 0.00, 0, '2024-06-30 08:33:32');

-- --------------------------------------------------------

--
-- Table structure for table `water_usage`
--

CREATE TABLE IF NOT EXISTS `water_usage` (
  `usage_id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `water_used` decimal(15,0) NOT NULL,
  `usage_type` enum('normal',' moderate','high') NOT NULL,
  `billing_date` date NOT NULL,
  PRIMARY KEY (`usage_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `water_usage`
--

INSERT INTO `water_usage` (`usage_id`, `email`, `water_used`, `usage_type`, `billing_date`) VALUES
(6, 'harsha@gmail.com', 30000, ' moderate', '2024-06-20'),
(7, 'harsha@gmail.com', 33500, ' moderate', '2024-05-20'),
(8, 'harsha@gmail.com', 43340, 'high', '2024-04-20'),
(9, 'harsha@gmail.com', 25000, 'normal', '2024-03-20'),
(10, 'nandi@gmail.com', 25000, 'normal', '2024-08-13');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
