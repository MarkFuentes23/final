-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 15, 2024 at 04:48 AM
-- Server version: 8.0.35
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_requests`
--

DROP TABLE IF EXISTS `account_requests`;
CREATE TABLE IF NOT EXISTS `account_requests` (
  `request_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `reason` text NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(50) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`request_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `account_requests`
--

INSERT INTO `account_requests` (`request_id`, `name`, `email`, `reason`, `status`, `created_at`, `role`) VALUES
(13, 'kupal ako ', 'kupal@gmail.com', 'kupal', 'approved', '2024-10-01 11:43:50', 'logistic1_admin'),
(12, 'Antoy', 'xoyeh20931@rinseart.com', 'asdasd', 'approved', '2024-09-30 07:25:57', 'logistic1_admin');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `last_name` varchar(191) NOT NULL,
  `username` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) DEFAULT 'admin',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `last_name`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'She', 'Velasco', 'valky', 'test@example.com', '$2y$10$ZvaNsgdPLFnfwykvDmjdVuJcX9luWxBJZr0psvUyhsMFbDYpbgV/C', 'admin', '2024-09-23 07:32:08'),
(2, 'Antoy', 'al', 'antoy', 'kupal@gmail.com', '$2y$10$hc1hWZrrowCRnFVE/0hc0eJq7DnfNeDZbganWOL4ALCyTuATbYEje', 'admin', '2024-09-23 08:00:14'),
(3, 'erik', 'lalas', 'erik12', 'erik@gmail.com', '$2y$10$eqVNx/tZKetJ5/QssMaa5eaGo0/AotFCozks8mHT/Ff/g6n38P4zi', 'admin', '2024-09-23 08:03:30'),
(4, 'kasl', 'kasl', 'kasl', 'kier@gmail.com', '$2y$10$OykmgON/IEGb7DaDhtxD/edkEohayeZEZtw1r2cBwo0jRj8Ge2ZjG', 'admin', '2024-09-23 08:11:00'),
(5, 'lakas', 'tama', 'lakas', 'lakas@gmail.com', '$2y$10$5gM3omAvlN8GU0KiAm9pUegTLNRdBrM8BEFDf/TWJWOPiNh0UwwIu', 'admin', '2024-09-23 08:39:05'),
(6, 'ano', 'ano', '123', 'ano@gmail.com', '$2y$10$V3bML3fKoqeSmnZah2PQ.OgKQ7AlZ03ApXr9jWEgH/ZCaXdn1fvmG', 'admin', '2024-09-23 08:39:31'),
(7, 'emar', 'industriya', 'emar', 'emar@gmail.com', '$2y$10$u7XYOdfv2KwEkD6/GbrvBOslgmdVqihmSDXwdGbXH58lyKd42Ab7q', 'admin', '2024-09-24 02:30:01');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

DROP TABLE IF EXISTS `branches`;
CREATE TABLE IF NOT EXISTS `branches` (
  `id` int NOT NULL AUTO_INCREMENT,
  `branch_code` varchar(50) NOT NULL,
  `street` text NOT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `zip_code` varchar(50) NOT NULL,
  `country` text NOT NULL,
  `contact` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `branch_code`, `street`, `city`, `state`, `zip_code`, `country`, `contact`, `date_created`) VALUES
(1, 'vzTL0PqMogyOWhF', 'Branch 1 St., Quiapo', 'Manila', 'Metro Manila', '1001', 'Philippines', '+2 123 455 623', '2020-11-26 11:21:41'),
(3, 'KyIab3mYBgAX71t', 'SAmple', 'Cebu', 'Cebu', '6000', 'Philippines', '+1234567489', '2020-11-26 16:45:05'),
(4, 'dIbUK5mEh96f0Zc', 'Sample', 'Sample', 'Sample', '123456', 'Philippines', '123456', '2020-11-27 13:31:49'),
(5, 'axBM0o26hsV1LTn', '129', 'valenuela', 'kier', '1440', 'philippines', '123454123', '2024-09-08 21:49:25');

-- --------------------------------------------------------

--
-- Table structure for table `branchess`
--

DROP TABLE IF EXISTS `branchess`;
CREATE TABLE IF NOT EXISTS `branchess` (
  `branch_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `branch_name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `manager_id` int DEFAULT NULL,
  PRIMARY KEY (`branch_id`),
  UNIQUE KEY `branch_id` (`branch_id`),
  KEY `fk_manager` (`manager_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `branchess`
--

INSERT INTO `branchess` (`branch_id`, `branch_name`, `location`, `created_at`, `manager_id`) VALUES
(12, 'testingggg', 'fdsfdsfdsf', '2024-09-30 10:29:49', 23);

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

DROP TABLE IF EXISTS `drivers`;
CREATE TABLE IF NOT EXISTS `drivers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `middle_initial` varchar(20) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `license_number` varchar(50) DEFAULT NULL,
  `license_expiry` date DEFAULT NULL,
  `license_type` varchar(50) DEFAULT NULL,
  `vehicle_id` varchar(50) DEFAULT NULL,
  `vehicle_type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `vehicle_id` (`vehicle_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id`, `first_name`, `middle_initial`, `last_name`, `phone`, `email`, `license_number`, `license_expiry`, `license_type`, `vehicle_id`, `vehicle_type`) VALUES
(31, 'Mark', 'A', 'fuentes', '09876543224', 'mark@driver', '21341234', '2031-06-11', 'a-b', '321322', 'van'),
(35, 'John Robert', 'O', 'Oclo', '78979798', 'register110220@gmail.com', '565656', '2024-10-13', 'a-b', '32135', 'truck'),
(36, 'Randolph ', 'M.', 'Gutierrez', '78979798', 'Randolph@driver', '21341234', '2024-10-14', 'Professional License', '343431111', 'van'),
(37, 'Hazel', 'M', 'Baldon', '09876543224', 'hazel@driver', '23542354', '2024-11-28', 'a-b', '5435643', 'van');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `employee_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) DEFAULT NULL,
  `branch_id` int DEFAULT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`employee_id`),
  UNIQUE KEY `employee_id` (`employee_id`),
  UNIQUE KEY `email` (`email`),
  KEY `branch_id` (`branch_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

DROP TABLE IF EXISTS `inventory`;
CREATE TABLE IF NOT EXISTS `inventory` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) NOT NULL,
  `stock_level` int NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`ID`, `item_name`, `stock_level`) VALUES
(1, 'Food & Beverages', -40),
(2, 'Cleaning Supplies', -10),
(3, 'Kitchen Equipment', 2);

-- --------------------------------------------------------

--
-- Table structure for table `milestones`
--

DROP TABLE IF EXISTS `milestones`;
CREATE TABLE IF NOT EXISTS `milestones` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `milestone_description` varchar(255) NOT NULL,
  `milestone_date` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_tracks`
--

DROP TABLE IF EXISTS `order_tracks`;
CREATE TABLE IF NOT EXISTS `order_tracks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parcel_id` int NOT NULL,
  `status` int NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_tracks`
--

INSERT INTO `order_tracks` (`id`, `parcel_id`, `status`, `date_created`) VALUES
(1, 2, 1, '2020-11-27 09:53:27'),
(2, 3, 1, '2020-11-27 09:55:17'),
(3, 1, 1, '2020-11-27 10:28:01'),
(4, 1, 2, '2020-11-27 10:28:10'),
(5, 1, 3, '2020-11-27 10:28:16'),
(6, 1, 4, '2020-11-27 11:05:03'),
(7, 1, 5, '2020-11-27 11:05:17'),
(8, 1, 7, '2020-11-27 11:05:26'),
(9, 3, 2, '2020-11-27 11:05:41'),
(10, 6, 1, '2020-11-27 14:06:57'),
(11, 6, 3, '2024-09-08 21:51:22'),
(12, 9, 1, '2024-09-22 16:25:03'),
(13, 9, 3, '2024-09-22 16:25:12'),
(14, 9, 7, '2024-09-22 16:25:22'),
(15, 10, 2, '2024-10-08 14:45:29');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires_at` int NOT NULL,
  `expire_at` datetime NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `expires_at`, `expire_at`) VALUES
('123@gmail.com', '05ae06534bea8b2076423df449c87029259a280465f0901764017f5acaf0f220', 2024, '0000-00-00 00:00:00'),
('kasl.54370906@gmail.com', '869d36da2fc2f59e155dee0d16b198573e4d9ee7d2f253c611bab4008480c0b081534a335e36397e0441110f0586be09eced', 2024, '2024-09-27 04:27:32'),
('valkyrievee00@gmail.com', 'f1dd80d1826f5b846819a12689f2b6624ea96a4138337543a923ec9be57df8a03e0d890dea2678b5af07e05aeb6901873c84', 0, '2024-09-27 05:10:42');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `permission_id` int NOT NULL AUTO_INCREMENT,
  `role_id` int NOT NULL,
  `permission` varchar(100) NOT NULL,
  PRIMARY KEY (`permission_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`permission_id`, `role_id`, `permission`) VALUES
(1, 1, 'edit_all_profiles'),
(2, 2, 'edit_own_profile'),
(3, 3, 'manage_branch_inventory');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reference_number` varchar(50) DEFAULT NULL,
  `pickup_location` varchar(255) NOT NULL,
  `delivery_location` varchar(255) NOT NULL,
  `delivery_date` date NOT NULL,
  `vehicle_type` enum('van','truck','l300') DEFAULT NULL,
  `contact_number` varchar(15) NOT NULL,
  `driver` int DEFAULT NULL,
  `linens` text,
  `towels` text,
  `cleaning` text,
  `guest_amenities` text,
  `laundry` text,
  `prices` text,
  `status_updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `driver_id` (`driver`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `reference_number`, `pickup_location`, `delivery_location`, `delivery_date`, `vehicle_type`, `contact_number`, `driver`, `linens`, `towels`, `cleaning`, `guest_amenities`, `laundry`, `prices`, `status_updated_at`, `status`) VALUES
(7, NULL, 'randolph', 'oclo', '2024-10-10', 'van', '42342323', NULL, '[\"Yes, yes\"]', '[\"Yes\"]', '[\"Yes\"]', '[\"Yes\"]', '[\"63456345653456\"]', '[\"9,000\"]', '2024-10-11 11:53:11', 2),
(10, NULL, 'sdfasd ', 'asdfasd ', '2024-10-10', 'truck', '32432432', NULL, '[\"234, asdfasdf 234.afasdfasd 2343.asdfasdf\"]', '[\"asdf 234234 asdfasdf \"]', '[\"24saf asdf 23 asdf asdf\"]', '[\"234 asdfa sdf 23\"]', '[\"43s asdf asd 2\"]', '[\"2343434 fasdf\"]', '2024-10-11 11:53:11', 2),
(11, NULL, 'asdf', 'asdfasdf', '2024-10-10', 'l300', '4535435', NULL, '[\"asdf 23423 \"]', '[\"asdf asdf 23423 a\"]', '[\"asfd 2342 \"]', '[\"sdf 234234\"]', '[\"asdf 234 23 4\"]', '[\"234324\"]', '2024-10-11 11:53:11', 1),
(18, NULL, 'yes ', 'yes', '2024-10-01', 'l300', '09999099', NULL, '[\"yes\"]', '[\"yes\"]', '[\"yes\"]', '[\"yes\"]', '[\"yes\"]', '[\"123131\"]', '2024-10-11 11:53:11', 5),
(38, '202410102531', 'main branch', 'main branch', '2024-10-10', 'van', '2344234', NULL, '[\"main branch\"]', '[\"main branch\"]', '[\"main branch\"]', '[\"main branch\"]', '[\"main branch\"]', '[\"23434\"]', '2024-10-11 11:53:11', 1),
(41, '202410107742', 'branch 2', 'branch 1', '2024-10-01', 'van', '09090846463', NULL, '[\"aas fasd23 \"]', '[\"asdf \"]', '[\"asdf \"]', '[\"sadfasdf\"]', '[\"asdf\"]', '[\"234234\"]', '2024-10-11 11:53:11', 6),
(42, '202410106197', 'branch 1', 'branch 2', '2024-10-11', 'l300', '09090846463', NULL, '[\"23432asdfasdf\"]', '[\"234234asdfasdf\"]', '[\"234234asdfasd\"]', '[\" 234  asfd as df\"]', '[\"234234asdfasdf\"]', '[\"2342343\"]', '2024-10-11 11:53:11', 3),
(43, '202410104989', 'main branch', 'asdfasdf', '2024-10-11', 'truck', '09090846463', NULL, '[\"25 beds, 25 beds, 25 beds, 25 beds, 25 beds, 25 beds, 25 beds, 25 beds, 25 beds\"]', '[\", 25 beds, 25 beds, 25 beds, 25 beds, 25 beds, 25 beds, 25 beds, 25 beds, 25 beds, 25 beds\"]', '[\", 25 beds, 25 beds, 25 beds, 25 beds, 25 beds, 25 beds, 25 beds, 25 beds\"]', '[\", 25 beds, 25 beds, 25 beds, 25 beds, 25 beds, 25 beds, 25 beds, 25 beds\"]', '[\", 25 beds, 25 beds, 25 beds, 25 beds, 25 beds, 25 beds, 25 beds, 25 beds, 25 beds, 25 beds\"]', '[\"2342343\"]', '2024-10-11 11:53:11', 7),
(44, '202410105312', 'yes', 'yes', '2024-10-11', 'van', '42342323', NULL, '[\"yes\"]', '[\"yes\"]', '[\"yes\"]', '[\"yes\"]', '[\"yes\"]', '[\"23423423\"]', '2024-10-11 11:53:11', 5),
(45, '202410111122', 'branch 2', 'branch 1', '2024-10-11', 'van', '09090846463', NULL, '[\"25 asdfas 25 asdfgasdf\"]', '[\"234  asfd asd f\"]', '[\"234234 asdf asdf \"]', '[\"234234 asdfasdfasdf\"]', '[\"23423 asdfasdfsadf\"]', '[\"432,423\"]', '2024-10-11 11:53:11', 6),
(46, '202410119834', 'main branchasdf', 'branch 1', '2024-10-11', 'van', '09999099555', NULL, '[\"25 asdfas 25 asdfgasdf\"]', '[\"234  asfd asd f\"]', '[\"234234 asdf asdf \"]', '[\" 234  asfd as df\"]', '[\"23 saf as d\"]', '[\"12323\"]', '2024-10-11 11:53:11', 6),
(47, '202410112445', 'main branch', 'branch 1', '2024-10-11', 'l300', '09090846463', NULL, '[\"White Bedsheet (Queen Size) Duvet Cover (Double Bed) Pillowcases (Set of 4)\"]', '[\"Large Bath Towels (Set of 2) Hand Towels (Set of 4) Bathrobes (Cotton, 2)\"]', '[\"All-Purpose Cleaner (1 Gallon) Disinfectant Wipes (50 Pack) Glass Cleaner (Spray Bottle)\"]', '[\"Soap Bars (5 Pack) Shampoo (200 ml Bottles, 4) Toothbrush Kit (5 Sets)\"]', '[\"Laundry Detergent (5 kg) Fabric Softener (2 Liters) Stain Remover Spray (500 ml)\"]', '[\"432,423\"]', '2024-10-11 11:53:11', 2),
(52, '202410123393', 'manila', 'manila', '2024-10-12', 'truck', '234324324', 31, '[\"asdf 23423 \"]', '[\"asdf asdf 23423 a\"]', '[\"asdfasdf\"]', '[\"asdfasdf\"]', '[\"asdf 234 23 4\"]', '[\"234234\"]', '2024-10-14 16:15:20', 5),
(58, '202410128514', 'yes', 'yes', '2024-10-12', 'truck', '42342323', 31, '[\"25 sapin\",\"25 sapin\"]', '[\"25 sapin\",\"25 sapin\"]', '[\"25 sapin\",\"25 sapin\"]', '[\"25 sapin\",\"25 sapin\"]', '[\"25 sapin\",\"25 sapin\"]', '[\"1\",\"2\"]', '2024-10-13 13:33:55', 3),
(59, '202410123837', 'yes', 'yes', '2024-10-01', 'truck', '1223444', 31, '[\"(25) banig , (25) banig, (25) banig, (25) banig ,(25) banig\"]', '[\"(25) banig , (25) banig, (25) banig, (25) banig ,(25) banig\"]', '[\"(25) banig , (25) banig, (25) banig, (25) banig ,(25) banig\"]', '[\"(25) banig , (25) banig, (25) banig, (25) banig ,(25) banig\"]', '[\"(25) banig , (25) banig, (25) banig, (25) banig ,(25) banig\"]', '[\"9,000\"]', '2024-10-13 16:05:05', 3),
(60, '202410126241', 'yes', 'yes', '2024-10-01', 'truck', '1223444', 31, '[\"(25) banig , (25) banig, (25) banig, (25) banig ,(25) banig\"]', '[\"(25) banig , (25) banig, (25) banig, (25) banig ,(25) banig\"]', '[\"(25) banig , (25) banig, (25) banig, (25) banig ,(25) banig\"]', '[\"(25) banig , (25) banig, (25) banig, (25) banig ,(25) banig\"]', '[\"(25) banig , (25) banig, (25) banig, (25) banig ,(25) banig\"]', '[\"9,000\"]', '2024-10-12 03:56:14', 1),
(61, '202410125104', 'yes', 'yes', '2024-10-01', 'van', '1223444', 31, '[\"25 sapin\"]', '[\"25 sapin\"]', '[\"25 sapin\"]', '[\"25 sapin\"]', '[\"25 sapin\"]', '[\"9,000\"]', '2024-10-14 07:06:56', 1),
(66, '202410131030', ' paradise hotel morato main branchh', 'paradise hotel morato ', '2024-10-31', 'truck', '09876565678', 31, '[\"banig (25), banig (25), banig (25), banig (25), banig (25), banig (25), banig (25), banig (25), banig (25), banig (25), banig (25), \"]', '[\"banig (25), banig (25), banig (25), banig (25), banig (25), banig (25), banig (25), banig (25), banig (25), banig (25), banig (25), \"]', '[\"banig (25), banig (25), banig (25), banig (25), banig (25), banig (25), banig (25), banig (25), banig (25), banig (25), \"]', '[\"banig (25), banig (25), banig (25), banig (25), banig (25), banig (25), banig (25), banig (25), banig (25), \"]', '[\"banig (25), banig (25), banig (25), banig (25), banig (25), banig (25), banig (25), banig (25), banig (25), \\r\\nbanig (25), \"]', '[\"10,000\"]', '2024-10-13 13:33:47', 3),
(75, '202410132095', 'branch 2', 'branch 1', '2024-10-14', 'truck', '09999099555', 31, '[\"yes (25),yes (25)yes (25)yes (25)yes (25)yes (25)yes (25)yes (25)yes (25)\"]', '[\"yes (25)yes (25)yes (25)yes (25)yes (25)yes (25)yes (25)yes (25)yes (25)yes (25)yes (25)yes (25)yes (25)yes (25)\"]', '[\"yes (25)yes (25)yes (25)yes (25)yes (25)yes (25)yes (25)yes (25)yes (25)yes (25)yes (25)yes (25)yes (25)yes (25)\"]', '[\"yes (25)yes (25)yes (25)yes (25)yes (25)yes (25)yes (25)yes (25)yes (25)yes (25)yes (25)\"]', '[\"yes (25)yes (25)yes (25)yes (25)yes (25)yes (25)yes (25)yes (25)yes (25)yes (25)yes (25)yes (25)\"]', '[\"123444\"]', '2024-10-14 06:04:00', 3),
(77, '202410141537', 'branch 2', 'branch 2', '2024-10-14', 'l300', '09999099555', 36, '[\"banig (25)\"]', '[\"banig (25)\"]', '[\"banig (25)\"]', '[\"banig (25)\"]', '[\"banig (25)\"]', '[\"234234\"]', '2024-10-14 15:12:15', 3),
(78, '202410148071', 'branch 2', 'branch 1', '2024-10-24', 'truck', '09999099555', 37, '[\"banig (25), sapin (30)\"]', '[\"banig (25), sapin (30)\"]', '[\"banig (25), sapin (30)\"]', '[\"banig (25), sapin (30)\"]', '[\"banig (25), sapin (30)\"]', '[\"24,234\"]', '2024-10-14 15:33:10', 3);

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

DROP TABLE IF EXISTS `resources`;
CREATE TABLE IF NOT EXISTS `resources` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `resources_type` varchar(255) NOT NULL,
  `resources_description` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` int NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'admin'),
(2, 'user'),
(3, 'branch_manager');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `task_name` varchar(255) NOT NULL,
  `task_status` enum('IN-PROGRESS','PENDING','COMPLETED','') NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'employee',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `first_name` varchar(191) NOT NULL,
  `last_name` varchar(191) NOT NULL,
  `otp` varchar(6) DEFAULT NULL,
  `otp_expiration` timestamp NULL DEFAULT NULL,
  `branch_id` bigint UNSIGNED DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password_hash`, `role`, `created_at`, `first_name`, `last_name`, `otp`, `otp_expiration`, `branch_id`, `profile_pic`, `contact_number`, `address`) VALUES
(44, 'mark@admin', 'marktayamora124@gmail.com', '$2y$10$yA34KQbXMtFhFUn1cKyK6e1B4EgitkmRIGSteL8kCknqx/360GSRO', 'admin', '2024-10-02 07:12:05', 'Mark', 'fuentess', '135718', '2024-10-13 08:04:34', 12, NULL, '0999909', '129 A Mahabang parang bignay'),
(52, 'mark@user', 'markufakufaku@gmail.com', '$2y$10$By4Epht1yYPbsplujQmU/u0fO0QxGFxHxp3ciI1fOWcCe1ljjOWS2', 'user', '2024-10-13 08:43:38', 'mark', 'cute', NULL, NULL, NULL, NULL, '098767675456', '123 st. mapulang saging'),
(53, 'Oclo@Manager', 'register110220@gmail.com', '$2y$10$eLPYYvlN5D2TFx6Ml0Wgsu5YCN.c8010gADWCzrn/.6Y728DMotYO', 'logistic1_admin', '2024-10-13 09:12:27', 'John Robert', 'Oclo', NULL, NULL, NULL, NULL, '09876545678', 'Quezon CIty');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`driver`) REFERENCES `drivers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
