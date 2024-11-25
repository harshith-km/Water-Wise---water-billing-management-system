-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2024 at 07:36 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `billing_transactions`
--

INSERT INTO `billing_transactions` (`bill_id`, `email`, `billing_date`, `usage_cost`, `due`, `net_amount`, `payment_status`, `payment_date`) VALUES
(11, 'harsha@gmail.com', '2024-06-20', 200.00, 0.00, 200.00, 'pending', '2024-06-30 13:48:36'),
(12, 'harsha@gmail.com', '2024-05-20', 213.00, 0.00, 213.00, 'paid', '2024-07-06 09:16:20'),
(13, 'harsha@gmail.com', '2024-04-20', 320.00, 120.00, 320.00, 'paid', '2024-07-06 09:00:59');

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `callback_request`
--

INSERT INTO `callback_request` (`id`, `email`, `problem`, `description`, `name`, `phone_no`, `status`, `createdon`) VALUES
(4, 'user@gmail.com', 'ghi', 'dascdas', 'scds', 2147483647, 'pending', '2024-06-26 09:14:28'),
(5, 'harsha@gmail.com', 'ghi', 'ssfsdfs', 'sdfsdfsd', 2147483647, 'pending', '2024-06-28 03:17:27'),
(6, 'harsha@gmail.com', 'jkl', 'safjjnasf', 'shufsdf', 2147483647, 'pending', '2024-06-28 08:04:54'),
(7, 'harsha@gmail.com', 'jkl', 'hfh', 'dfghdf', 2147483647, 'pending', '2024-06-29 19:50:50'),
(8, 'harsha@gmail.com', 'jkl', 'gyyjjy', 'ytuty', 2147483647, 'pending', '2024-06-29 20:04:46'),
(9, 'harsha@gmail.com', 'pqr', 'xxfbdf', 'fdhdfh', 5464564, 'pending', '2024-06-29 20:11:57'),
(10, 'harsha@gmail.com', 'jkl', 'dfbdfh', 'dfhdfh', 34543545, 'pending', '2024-06-29 20:12:30'),
(11, 'harsha@gmail.com', 'mno', 'tyutyu', 'yuty', 546456, 'pending', '2024-06-29 20:15:06'),
(12, 'harsha@gmail.com', 'jkl', 'ghghj', 'ffj', 4645546, 'pending', '2024-06-29 20:15:50'),
(13, 'harsha@gmail.com', 'mno', 'ghjghj', 'jghj', 55555, 'pending', '2024-06-29 20:16:03'),
(14, 'harsha@gmail.com', 'mno', 'ytdtc', 'hyff', 2147483647, 'pending', '2024-06-29 20:17:29'),
(15, 'harsha@gmail.com', 'ghi', 'asdsad', 'jasgd', 2147483647, 'pending', '2024-07-01 15:49:18'),
(16, 'harsha@gmail.com', 'jkl', 'sfsf', 'saffe', 2147483647, 'pending', '2024-07-01 15:56:41'),
(17, 'harsha@gmail.com', 'mno', 'sfwf', 'ssjkf', 2147483647, 'pending', '2024-07-01 15:58:34'),
(18, 'harsha@gmail.com', 'jkl', 'i have problems with water pipe connections', 'Harshith KM', 2147483647, 'pending', '2024-07-02 19:40:54');

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `password`, `address`, `regdate`) VALUES
(1, 'Harshith', 'Km', 'harsha@gmail.com', 'dc647eb65e6711e155375218212b3964', 'SIT 7th cross', '2024-06-28 02:53:36'),
(15, 'Nandi', 'Hm', 'nandi@gmail.com', 'dc647eb65e6711e155375218212b3964', 'sit 9th cross link road', '2024-06-30 10:00:52'),
(16, 'Hemanth', 'Mm', 'hemanth@gmail.com', 'dc647eb65e6711e155375218212b3964', 'Tumkur', '2024-07-02 19:33:52');

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
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`id`, `email`, `credit`, `debit`, `wallet_bal`, `added_on`) VALUES
(1, 'harsha@gmail.com', 0.00, 0.00, 0, '2024-06-30 08:33:32'),
(69, 'harsha@gmail.com', 200.00, 0.00, 200, '2024-06-30 08:34:39'),
(70, 'harsha@gmail.com', 0.00, 200.00, 0, '2024-06-30 09:35:21'),
(71, 'nandi@gmail.com', 0.00, 0.00, 0, '2024-06-30 10:00:52'),
(72, 'nandi@gmail.com', 500.00, 0.00, 500, '2024-06-30 10:17:46'),
(73, 'harsha@gmail.com', 0.00, 0.00, 0, '2024-06-30 13:41:01'),
(74, 'harsha@gmail.com', 500.00, 0.00, 500, '2024-06-30 13:47:29'),
(75, 'harsha@gmail.com', 0.00, 200.00, 300, '2024-06-30 13:48:27'),
(76, 'harsha@gmail.com', 0.00, 200.00, 100, '2024-06-30 13:48:36'),
(77, 'harsha@gmail.com', 0.00, 0.00, 100, '2024-06-30 15:58:45'),
(78, 'harsha@gmail.com', 500.00, 0.00, 600, '2024-07-01 04:46:10'),
(79, 'harsha@gmail.com', 0.00, 320.00, 280, '2024-07-01 04:46:21'),
(80, 'harsha@gmail.com', 500.00, 0.00, 780, '2024-07-01 13:47:24'),
(81, 'harsha@gmail.com', 0.00, 320.00, 460, '2024-07-01 13:47:32'),
(82, 'harsha@gmail.com', 0.00, 320.00, 140, '2024-07-01 15:48:29'),
(83, 'harsha@gmail.com', 500.00, 0.00, 640, '2024-07-01 15:50:25'),
(84, 'harsha@gmail.com', 0.00, 320.00, 320, '2024-07-01 15:50:31'),
(85, 'harsha@gmail.com', 0.00, 320.00, 0, '2024-07-01 15:53:32'),
(86, 'harsha@gmail.com', 500.00, 0.00, 500, '2024-07-01 15:54:08'),
(87, 'harsha@gmail.com', 0.00, 320.00, 180, '2024-07-01 15:54:14'),
(88, 'hemanth@gmail.com', 0.00, 0.00, 0, '2024-07-02 19:33:52'),
(89, 'harsha@gmail.com', 500.00, 0.00, 680, '2024-07-02 19:37:33'),
(90, 'harsha@gmail.com', 0.00, 320.00, 360, '2024-07-02 19:37:54'),
(91, 'harsha@gmail.com', 0.00, 320.00, 40, '2024-07-04 15:49:38'),
(92, 'harsha@gmail.com', 100.00, 0.00, 140, '2024-07-04 18:34:04'),
(93, 'harsha@gmail.com', 200.00, 0.00, 340, '2024-07-05 08:38:44'),
(94, 'harsha@gmail.com', 1000.00, 0.00, 1340, '2024-07-05 09:07:40'),
(95, 'harsha@gmail.com', 0.00, 320.00, 1020, '2024-07-05 09:08:28'),
(96, 'harsha@gmail.com', 0.00, 320.00, 700, '2024-07-05 09:09:31'),
(97, 'harsha@gmail.com', 0.00, 320.00, 380, '2024-07-05 09:09:39'),
(98, 'nandi@gmail.com', 500.00, 0.00, 1000, '2024-07-05 17:42:59'),
(99, 'harsha@gmail.com', 0.00, 320.00, 60, '2024-07-06 08:21:49'),
(100, 'harsha@gmail.com', 500.00, 0.00, 560, '2024-07-06 08:47:21'),
(101, 'harsha@gmail.com', 0.00, 320.00, 240, '2024-07-06 08:47:28'),
(102, 'harsha@gmail.com', 5000.00, 0.00, 5240, '2024-07-06 08:47:50'),
(103, 'harsha@gmail.com', 0.00, 320.00, 4920, '2024-07-06 08:48:04'),
(104, 'harsha@gmail.com', 0.00, 320.00, 4600, '2024-07-06 08:48:21'),
(105, 'harsha@gmail.com', 0.00, 320.00, 4280, '2024-07-06 08:49:01'),
(106, 'harsha@gmail.com', 0.00, 320.00, 3960, '2024-07-06 08:49:07'),
(107, 'harsha@gmail.com', 0.00, 320.00, 3640, '2024-07-06 08:53:01'),
(108, 'harsha@gmail.com', 0.00, 320.00, 3320, '2024-07-06 08:53:09'),
(109, 'harsha@gmail.com', 0.00, 320.00, 3000, '2024-07-06 08:53:50'),
(110, 'harsha@gmail.com', 0.00, 320.00, 2680, '2024-07-06 08:55:41'),
(111, 'harsha@gmail.com', 0.00, 320.00, 2360, '2024-07-06 08:56:42'),
(112, 'harsha@gmail.com', 0.00, 320.00, 2040, '2024-07-06 08:58:33'),
(113, 'harsha@gmail.com', 0.00, 320.00, 1720, '2024-07-06 08:58:59'),
(114, 'harsha@gmail.com', 0.00, 320.00, 1400, '2024-07-06 09:00:59'),
(115, 'harsha@gmail.com', 0.00, 213.00, 1187, '2024-07-06 09:09:24'),
(116, 'harsha@gmail.com', 0.00, 213.00, 974, '2024-07-06 09:16:20');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `water_usage`
--

INSERT INTO `water_usage` (`usage_id`, `email`, `water_used`, `usage_type`, `billing_date`) VALUES
(6, 'harsha@gmail.com', 30000, ' moderate', '2024-06-20'),
(7, 'harsha@gmail.com', 33500, ' moderate', '2024-05-20'),
(8, 'harsha@gmail.com', 43340, 'high', '2024-04-20'),
(9, 'harsha@gmail.com', 25000, 'normal', '2024-03-20');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
