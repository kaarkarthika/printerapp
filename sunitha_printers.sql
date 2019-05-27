-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2019 at 07:31 AM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sunitha_printers`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_log`
--

CREATE TABLE `admin_log` (
  `log_id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_center_id` int(11) NOT NULL,
  `action` text NOT NULL,
  `log_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_log`
--

INSERT INTO `admin_log` (`log_id`, `user_id`, `service_center_id`, `action`, `log_timestamp`) VALUES
(1, 1, 0, 'Login Successful', '2019-02-12 11:51:21'),
(2, 1, 0, 'Login Successful', '2019-02-12 11:53:01'),
(3, 1, 0, 'Login Successful', '2019-02-12 11:53:19'),
(4, 1, 0, 'Login Successful', '2019-02-12 12:28:42'),
(5, 1, 0, 'Login Successful', '2019-02-12 12:42:43'),
(6, 1, 0, 'Login Successful', '2019-02-12 12:50:00'),
(7, 1, 0, 'Login Successful', '2019-02-12 12:52:59'),
(8, 1, 0, 'Login Successful', '2019-02-12 13:11:51'),
(9, 1, 0, 'Login Successful', '2019-02-12 13:31:53'),
(10, 1, 0, 'Login Successful', '2019-02-12 14:47:18'),
(11, 1, 0, 'Login Successful', '2019-02-13 08:56:43'),
(12, 1, 0, 'Login Successful', '2019-02-13 09:29:19'),
(13, 1, 0, 'Login Successful', '2019-02-13 09:37:19'),
(14, 1, 0, 'Login Successful', '2019-02-13 09:39:14'),
(15, 1, 0, 'Login Successful', '2019-02-13 09:40:04'),
(16, 1, 0, 'Login Successful', '2019-02-13 09:58:04'),
(17, 1, 0, 'Login Successful', '2019-02-13 12:20:06'),
(18, 1, 0, 'Login Successful', '2019-02-13 12:31:26'),
(19, 1, 0, 'Login Successful', '2019-02-13 13:56:28'),
(20, 1, 0, 'Login Successful', '2019-02-14 07:31:13'),
(21, 1, 0, 'Login Successful', '2019-02-14 09:39:04'),
(22, 1, 0, 'Login Successful', '2019-02-14 09:45:06'),
(23, 1, 0, 'Login Successful', '2019-02-14 12:16:46'),
(24, 1, 0, 'Login Successful', '2019-02-14 12:21:39'),
(25, 1, 0, 'Login Successful', '2019-02-14 14:10:03'),
(26, 1, 0, 'Login Successful', '2019-02-15 04:28:45'),
(27, 1, 0, 'Login Successful', '2019-02-15 06:26:39'),
(28, 1, 0, 'Login Successful', '2019-02-15 06:31:56'),
(29, 1, 0, 'Login Successful', '2019-02-15 06:45:52'),
(30, 1, 0, 'Login Successful', '2019-02-15 09:44:12'),
(31, 1, 0, 'Login Successful', '2019-02-16 04:27:13'),
(32, 1, 0, 'Login Successful', '2019-02-18 05:07:34'),
(33, 1, 0, 'Login Successful', '2019-02-18 07:22:26'),
(34, 1, 0, 'Login Successful', '2019-02-19 07:03:19'),
(35, 1, 0, 'Login Successful', '2019-02-19 07:58:29'),
(36, 1, 0, 'Login Successful', '2019-02-19 08:05:28'),
(37, 1, 0, 'Login Successful', '2019-02-19 08:12:35'),
(38, 1, 0, 'Login Successful', '2019-02-19 08:25:15'),
(39, 1, 0, 'Login Successful', '2019-02-19 08:55:52'),
(40, 1, 0, 'Login Successful', '2019-02-19 08:56:37'),
(41, 4, 0, 'Login Successful', '2019-02-19 09:11:37'),
(42, 1, 0, 'Login Successful', '2019-02-19 09:12:51'),
(43, 1, 0, 'Login Successful', '2019-02-19 09:14:12'),
(44, 1, 0, 'Login Successful', '2019-02-19 09:15:01'),
(45, 4, 0, 'Login Successful', '2019-02-19 09:15:48'),
(46, 1, 0, 'Login Successful', '2019-02-19 09:17:19'),
(47, 4, 0, 'Login Successful', '2019-02-19 09:18:08'),
(48, 1, 0, 'Login Successful', '2019-02-19 10:52:52'),
(49, 1, 0, 'Login Successful', '2019-02-19 11:03:18'),
(50, 1, 0, 'Login Successful', '2019-02-19 11:29:37'),
(51, 1, 0, 'Login Successful', '2019-02-19 11:44:28'),
(52, 1, 0, 'Login Successful', '2019-02-19 12:30:58'),
(53, 1, 0, 'Login Successful', '2019-02-19 12:55:09'),
(54, 1, 0, 'Login Successful', '2019-02-19 13:30:13'),
(55, 1, 0, 'Login Successful', '2019-02-19 13:43:33'),
(56, 4, 0, 'Login Successful', '2019-02-19 14:05:42'),
(57, 1, 0, 'Login Successful', '2019-02-19 14:12:59'),
(58, 1, 0, 'Login Successful', '2019-02-20 04:38:38'),
(59, 1, 0, 'Login Successful', '2019-02-20 06:46:54'),
(60, 1, 0, 'Login Successful', '2019-02-20 06:55:52'),
(61, 1, 0, 'Login Successful', '2019-02-20 07:15:31'),
(62, 1, 0, 'Login Successful', '2019-02-20 10:15:03'),
(63, 1, 0, 'Login Successful', '2019-02-20 10:27:52'),
(64, 1, 0, 'Login Successful', '2019-02-20 10:30:06'),
(65, 1, 0, 'Login Successful', '2019-02-20 13:29:42'),
(66, 1, 0, 'Login Successful', '2019-02-20 13:31:00'),
(67, 1, 0, 'Login Successful', '2019-02-21 03:17:09'),
(68, 1, 0, 'Login Successful', '2019-02-21 05:25:22'),
(69, 1, 0, 'Login Successful', '2019-02-21 05:26:12'),
(70, 1, 0, 'Login Successful', '2019-02-21 09:58:49'),
(71, 1, 0, 'Login Successful', '2019-02-21 11:37:01'),
(72, 1, 0, 'Login Successful', '2019-02-22 04:49:51'),
(73, 1, 0, 'Login Successful', '2019-02-22 05:03:57'),
(74, 4, 0, 'Login Successful', '2019-02-22 10:50:18'),
(75, 4, 0, 'Login Successful', '2019-02-22 11:11:16'),
(76, 4, 0, 'Login Successful', '2019-02-22 11:48:59'),
(77, 4, 0, 'Login Successful', '2019-02-22 11:49:34'),
(78, 1, 0, 'Login Successful', '2019-02-22 11:49:49'),
(79, 4, 0, 'Login Successful', '2019-02-22 11:51:35'),
(80, 1, 0, 'Login Successful', '2019-02-22 11:53:06'),
(81, 1, 0, 'Login Successful', '2019-02-22 11:54:38'),
(82, 1, 0, 'Login Successful', '2019-02-22 12:11:31'),
(83, 4, 0, 'Login Successful', '2019-02-22 12:14:19'),
(84, 1, 0, 'Login Successful', '2019-02-22 12:16:02'),
(85, 1, 0, 'Login Successful', '2019-02-22 12:16:30'),
(86, 1, 0, 'Login Successful', '2019-02-22 12:17:00'),
(87, 1, 0, 'Login Successful', '2019-02-25 05:46:04'),
(88, 1, 0, 'Login Successful', '2019-02-25 08:51:17'),
(89, 1, 0, 'Login Successful', '2019-02-25 09:35:37'),
(90, 1, 0, 'Login Successful', '2019-02-25 10:45:34'),
(91, 1, 0, 'Login Successful', '2019-02-25 11:18:02'),
(92, 1, 0, 'Login Successful', '2019-02-25 13:37:16'),
(93, 1, 0, 'Login Successful', '2019-02-26 05:13:15'),
(94, 1, 0, 'Login Successful', '2019-02-26 10:52:24'),
(95, 1, 0, 'Login Successful', '2019-02-27 05:32:03'),
(96, 1, 0, 'Login Successful', '2019-02-27 07:49:07'),
(97, 1, 0, 'Login Successful', '2019-02-27 08:04:08'),
(98, 1, 0, 'Login Successful', '2019-02-27 14:52:57'),
(99, 1, 0, 'Login Successful', '2019-02-28 05:20:30'),
(100, 1, 0, 'Login Successful', '2019-02-28 05:40:28'),
(101, 1, 0, 'Login Successful', '2019-02-28 06:22:18'),
(102, 1, 0, 'Login Successful', '2019-02-28 09:56:55'),
(103, 1, 0, 'Login Successful', '2019-03-01 03:23:55'),
(104, 1, 0, 'Login Successful', '2019-03-02 04:29:38'),
(105, 1, 0, 'Login Successful', '2019-03-02 08:19:22'),
(106, 1, 0, 'Login Successful', '2019-03-02 11:10:15'),
(107, 1, 0, 'Login Successful', '2019-03-02 11:11:13'),
(108, 1, 0, 'Login Successful', '2019-03-02 11:12:15'),
(109, 4, 0, 'Login Successful', '2019-03-02 11:16:49'),
(110, 4, 0, 'Login Successful', '2019-03-02 11:18:18'),
(111, 4, 0, 'Login Successful', '2019-03-02 11:24:04'),
(112, 4, 0, 'Login Successful', '2019-03-02 11:25:47'),
(113, 4, 0, 'Login Successful', '2019-03-02 11:27:56'),
(114, 4, 0, 'Login Successful', '2019-03-02 11:30:20'),
(115, 4, 0, 'Login Successful', '2019-03-02 11:32:03'),
(116, 4, 0, 'Login Successful', '2019-03-02 11:36:05'),
(117, 4, 0, 'Login Successful', '2019-03-02 11:37:43'),
(118, 4, 0, 'Login Successful', '2019-03-02 11:38:15'),
(119, 4, 0, 'Login Successful', '2019-03-02 11:38:46'),
(120, 4, 0, 'Login Successful', '2019-03-02 11:39:09'),
(121, 1, 0, 'Login Successful', '2019-03-02 11:39:32'),
(122, 4, 0, 'Login Successful', '2019-03-02 11:54:43'),
(123, 1, 0, 'Login Successful', '2019-03-02 12:10:29'),
(124, 4, 0, 'Login Successful', '2019-03-02 12:13:16'),
(125, 1, 0, 'Login Successful', '2019-03-04 06:09:40'),
(126, 1, 0, 'Login Successful', '2019-03-04 06:40:16'),
(127, 1, 0, 'Login Successful', '2019-03-04 06:43:11'),
(128, 1, 0, 'Login Successful', '2019-03-04 08:00:40');

-- --------------------------------------------------------

--
-- Table structure for table `auth_user_role`
--

CREATE TABLE `auth_user_role` (
  `ur_autoid` int(11) NOT NULL,
  `rolename` varchar(250) NOT NULL,
  `rolecode` varchar(250) NOT NULL,
  `sortorder` bigint(20) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_user_role`
--

INSERT INTO `auth_user_role` (`ur_autoid`, `rolename`, `rolecode`, `sortorder`, `timestamp`) VALUES
(7, 'Branch Admin', 'branchadmin', 7, '2017-07-24 13:49:49'),
(12, 'superadmin', 'SUPER', 4, '2019-02-06 14:14:17'),
(16, 'Warehouse Access', 'warehouseaccess', 6, '2017-09-26 15:28:27'),
(18, 'Pharma Staff', 'pharmacy', 7, '2019-02-08 05:11:59'),
(19, 'Lab Technician', 'LAB', 8, '2019-02-06 13:26:23'),
(20, 'Receptionist', 'reception', 9, '2019-02-08 06:21:05'),
(21, 'UCIL', 'UCIL', 10, '2018-08-20 06:30:19');

-- --------------------------------------------------------

--
-- Table structure for table `auto_idtable`
--

CREATE TABLE `auto_idtable` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `number_field` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auto_idtable`
--

INSERT INTO `auto_idtable` (`id`, `name`, `number_field`, `updated_at`) VALUES
(1, 'ESTIMATE', '1', '2019-03-02 10:08:46'),
(2, 'INVOICE', '2', '2019-03-04 10:50:10'),
(3, 'DELIVERY', '2', '2019-03-02 11:55:14');

-- --------------------------------------------------------

--
-- Table structure for table `branch_admin`
--

CREATE TABLE `branch_admin` (
  `ba_autoid` int(11) NOT NULL,
  `ba_branchid` varchar(250) NOT NULL,
  `ba_code` varchar(250) NOT NULL,
  `authUserRole` varchar(250) NOT NULL,
  `auth_key` varchar(32) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `ba_name` varchar(250) NOT NULL,
  `ba_status` enum('A','I','D') NOT NULL,
  `status` smallint(6) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `ba_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ba_createdat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch_admin`
--

INSERT INTO `branch_admin` (`ba_autoid`, `ba_branchid`, `ba_code`, `authUserRole`, `auth_key`, `password_hash`, `ba_name`, `ba_status`, `status`, `password_reset_token`, `ba_timestamp`, `ba_createdat`) VALUES
(26, '17', '', 'SUPER', 'G3gW5BlzOWArowqSC4ab9goRezDXDwDU', '$2y$13$MOpMz8O5hkiSwh5M5UtzSOr0a9FgWSupTXpiXzBJlg5/8NVJ9Ij.S', 'dmc', 'A', 0, '', '2019-02-11 06:37:06', '2019-02-11 12:07:06');

-- --------------------------------------------------------

--
-- Table structure for table `configuration`
--

CREATE TABLE `configuration` (
  `id` int(11) NOT NULL,
  `key_drop` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `create_by` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `configuration`
--

INSERT INTO `configuration` (`id`, `key_drop`, `value`, `create_by`) VALUES
(1, 'street', 'No 24/2, Kovoor Vaidhyanathan Street', '2019-02-21 00:00:00'),
(2, 'area', 'Chintadripet', '2019-02-21 00:00:00'),
(3, 'district', 'Chennai', '2019-02-21 00:00:00'),
(4, 'pincode', '600 002', '2019-02-21 00:00:00'),
(5, 'primary_phno', '044 -2845 1324', '2019-02-21 00:00:00'),
(6, 'secondary_ph_no', '4350 8325', '2019-02-21 00:00:00'),
(7, 'website', 'www.sunithaprinters.com', '2019-02-21 00:00:00'),
(8, 'primary_email', 'sunithaprinters@yahoo.in', '2019-02-21 00:00:00'),
(9, 'secondary_email', 'sunithaprinters1980@gmail.com', '2019-02-21 00:00:00'),
(10, 'gstin', '33AAECS1194C2ZP', '2019-02-21 00:00:00'),
(11, 'STATE CODE', 'TN-33', '2019-02-21 00:00:00'),
(12, 'SAC CODE', '9989', '2019-02-21 00:00:00'),
(13, 'Company Name', 'Sunitha Printers', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `config_year`
--

CREATE TABLE `config_year` (
  `id` int(11) NOT NULL,
  `curr_year` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `config_year`
--

INSERT INTO `config_year` (`id`, `curr_year`) VALUES
(1, '2019');

-- --------------------------------------------------------

--
-- Table structure for table `contact_table`
--

CREATE TABLE `contact_table` (
  `auto_id` int(11) NOT NULL,
  `customer_id` varchar(255) DEFAULT NULL,
  `contact_name` varchar(255) DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `updated_ipaddress` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_table`
--

INSERT INTO `contact_table` (`auto_id`, `customer_id`, `contact_name`, `contact_number`, `updated_ipaddress`, `user_id`, `created_date`, `updated_at`) VALUES
(34, '5', 'DFD', '543', '192.168.1.22', NULL, NULL, '2019-02-15 06:35:03'),
(35, '5', '5555', '5555', '192.168.1.22', NULL, NULL, '2019-02-15 06:35:03'),
(39, '10', 'ASHOK KUMAR', '0000000000', '192.168.1.15', NULL, NULL, '2019-02-18 05:16:46'),
(41, '12', 'Meera', '98765323456787', '192.168.1.30', '1', '2019-02-19 16:36:29', '2019-02-19 11:06:29'),
(42, '11', 'Sai', '9876543210', '192.168.1.30', NULL, NULL, '2019-02-19 11:24:39'),
(45, '15', '', '', '192.168.1.15', '1', '2019-02-19 17:39:17', '2019-02-19 12:09:17'),
(50, '19', 'Geetha', '987123456765', '192.168.1.14', '1', '2019-02-20 11:29:50', '2019-02-20 05:59:50'),
(51, '20', '', '', '192.168.1.15', '1', '2019-02-20 17:19:18', '2019-02-20 11:49:18'),
(56, '22', 't', '562321231312', '192.168.1.20', NULL, NULL, '2019-02-25 06:24:58'),
(61, '23', '151', '511', '192.168.1.20', NULL, NULL, '2019-02-25 13:37:34'),
(62, '23', '232', '232', '192.168.1.20', NULL, NULL, '2019-02-25 13:37:34'),
(66, '25', '', '', '192.168.1.7', NULL, NULL, '2019-02-28 05:38:34'),
(70, '26', 'Wow', '080 2558 566', '192.168.1.3', NULL, NULL, '2019-02-28 12:41:08'),
(71, '26', 'Rainush', '081471 76922', '192.168.1.3', NULL, NULL, '2019-02-28 12:41:08'),
(72, '26', 'Swathi', '081471 76922', '192.168.1.3', NULL, NULL, '2019-02-28 12:41:08'),
(73, '27', 'Kanithan', '151151515151', '192.168.1.7', '1', '2019-03-01 12:58:05', '2019-03-01 07:28:05'),
(74, '27', 'vadivel', '161113311131', '192.168.1.7', '1', '2019-03-01 12:58:06', '2019-03-01 07:28:06'),
(75, '13', 'test', '111111111111', '192.168.1.7', NULL, NULL, '2019-03-01 08:01:45');

-- --------------------------------------------------------

--
-- Table structure for table `customer_master`
--

CREATE TABLE `customer_master` (
  `auto_id` bigint(20) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `phone_no` varchar(255) DEFAULT NULL,
  `address` text,
  `gst` varchar(255) DEFAULT NULL,
  `state_code` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `pincode` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_ipaddress` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_master`
--

INSERT INTO `customer_master` (`auto_id`, `company_name`, `customer_name`, `phone_no`, `address`, `gst`, `state_code`, `city`, `state`, `pincode`, `created_date`, `updated_at`, `updated_ipaddress`, `user_id`) VALUES
(5, 'GHNDN', 'FGBFGB', '4646', '53T54T', '4544', '5445T', '45T45T', '54T45T', '545', '2019-02-13 12:42:30', '2019-02-15 06:35:03', '192.168.1.22', NULL),
(10, 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '0000000000', 'THE RESIDENCY,49,G.N CHETTY ROAD', '33AAECS1194CZZP', 'TN-33', 'TNAGAR', 'CHENNAI', '600017', '2019-02-18 10:46:17', '2019-02-18 05:16:46', '192.168.1.15', NULL),
(11, 'Sai Group of Companies', 'Sai', '9876543210', '', '1234556', '', '', '', '', '2019-02-19 16:33:17', '2019-02-19 11:24:39', '192.168.1.30', NULL),
(12, 'Meera ', 'Meera', '98654568', '', NULL, '', '', '', '', '2019-02-19 16:36:29', '2019-02-20 11:49:22', '192.168.1.14', '1'),
(13, 'lucky vaccines', 'gopal', '1321619651', '4/22, Rutland Gate 4th St, Srirampuram, Thousand Lights West, Thousand Lights', '8888888888888888888', '', 'Chennai', 'TN', '000000', '2019-02-19 17:27:23', '2019-03-01 08:01:45', '192.168.1.7', NULL),
(15, 'surgical ', 'kallil', '9832161635', '', '', '', '', '', '', '2019-02-19 17:39:16', '2019-02-19 12:09:16', '192.168.1.15', '1'),
(19, 'Vidhun Enterprises', 'Geetha', '9876551234', 'test', 'test', '654321', 'city1', 'tamil nadu', '654321', '2019-02-20 11:29:50', '2019-02-20 12:01:28', '192.168.1.15', '1'),
(20, 'communist pvt ltd', 'chanfru', '9863163635', '33,dubai kuruku santhu,vivekanathar street', '12123213', 'TN-33', 'dubai', 'arabia', '2564216', '2019-02-20 17:19:18', '2019-02-20 15:06:44', '192.168.1.15', '1'),
(22, 'tester', 'tester', '5555555555', 'dcd shca ca h', '123132231asdcasdcvasdcvasd', NULL, 'yyyyy', 'bsklbabls', '566666', '2019-02-25 11:50:42', '2019-02-25 06:24:58', '192.168.1.20', NULL),
(23, 'tendulkar', 'ten', '6511111111', 'No.37, Opp Swagat Hotel, Royapetteh High Road', '2316654231132163', NULL, 'Chennai', 'TN', '000000', '2019-02-25 18:44:45', '2019-02-25 13:37:34', '192.168.1.20', NULL),
(25, 'TEAN', 'sdfg bsdnklb', '2123132132', 'as jdkv sh', 'sd fvbsdhfvsdbvsd', NULL, 'sdfvb', 'qsdas ', '626262', '2019-02-28 11:08:19', '2019-02-28 05:38:34', '192.168.1.7', NULL),
(26, 'Hanifa & Co', 'Hani', '9182736450', '181, Commercial Street, Tasker Town, Shivaji Nagar, ', '629347549824', NULL, 'Bengaluru', 'Karnataka', '560001', '2019-02-28 17:36:54', '2019-02-28 12:41:08', '192.168.1.3', NULL),
(27, 'dhoni pvt ltd', 'dhoni', '0000000000', 'No 23, 3rd Floor, Modern Tower, West Cott Road, Royapettah,', 'IOO0000000000000000000', NULL, 'Chennai', 'Tamil Nadu', '600014', '2019-03-01 12:58:05', '2019-03-01 07:28:05', '192.168.1.7', '1');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `id` bigint(20) NOT NULL,
  `convert_status` varchar(255) DEFAULT NULL,
  `convert_id` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `cust_id` varchar(255) DEFAULT NULL,
  `cust_name` varchar(255) DEFAULT NULL,
  `gstin_no` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `state_code` varchar(255) DEFAULT NULL,
  `address` text,
  `delivery_select` varchar(255) DEFAULT NULL,
  `delivery_address` text,
  `bill_no` varchar(255) DEFAULT NULL,
  `bill_date` datetime DEFAULT NULL,
  `tot_qty` float DEFAULT NULL,
  `gst_type` varchar(255) DEFAULT NULL,
  `gst_id` varchar(255) DEFAULT NULL,
  `tot_amt` float DEFAULT NULL,
  `transport` varchar(255) DEFAULT NULL,
  `vehicle_num` varchar(255) DEFAULT NULL,
  `remarks` text,
  `c_date` datetime DEFAULT NULL,
  `u_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` varchar(255) DEFAULT NULL,
  `ipaddrss` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`id`, `convert_status`, `convert_id`, `company_name`, `cust_id`, `cust_name`, `gstin_no`, `state`, `state_code`, `address`, `delivery_select`, `delivery_address`, `bill_no`, `bill_date`, `tot_qty`, `gst_type`, `gst_id`, `tot_amt`, `transport`, `vehicle_num`, `remarks`, `c_date`, `u_date`, `user_id`, `ipaddrss`) VALUES
(1, NULL, NULL, 'GHNDN', '5', 'FGBFGB', '4544', '54T45T', '5445T', '53T54T,45T45T,54T45T-545', NULL, NULL, '100004', '2019-02-16 17:26:43', 3, NULL, NULL, 3, '4', 'test', 'tester', '2019-02-16 17:26:43', '2019-02-16 11:58:06', '1', '192.168.1.29'),
(2, NULL, NULL, 'Novotel Chennai Sipcot', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', 'CHENNAI', 'TN-33', 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, NULL, '100005', '2019-02-18 15:13:36', 19, NULL, NULL, 2600, '0', 'sad sdfv dfv ', 'sdfk  xjhbck  vuhc  kih c', '2019-02-18 15:13:36', '2019-02-18 09:43:36', '1', '192.168.1.15'),
(3, NULL, NULL, 'Sai Group of Companies', '11', 'Sai', '1234556', '', '', ',,-', NULL, NULL, '100006', '2019-02-19 17:05:41', 4, NULL, NULL, 3000, '1', 'sai', '', '2019-02-19 17:05:41', '2019-02-19 11:35:41', '1', '192.168.1.30'),
(4, NULL, NULL, 'Novotel Chennai Sipcot', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', 'CHENNAI', 'TN-33', 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, NULL, '100007', '2019-02-20 19:05:09', 632, 'GST', NULL, 6386, '1', 'asdvj hsd sdfiov sdo', 'ka sfvoisdhsdosdifvsdofsdfsdvsdbo bsd8o', '2019-02-20 19:05:09', '2019-02-20 14:02:44', '1', '192.168.1.15'),
(5, NULL, NULL, 'Novotel Chennai Sipcot', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', 'CHENNAI', 'TN-33', 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, NULL, '100008', '2019-02-20 19:29:11', 1022, 'GST', NULL, 644, '0', 'd sfv sdfvisdvdas', ' asv sduasvoasdvadvasbocsi', '2019-02-20 19:29:11', '2019-02-20 14:01:25', '1', '192.168.1.15'),
(6, NULL, NULL, 'Novotel Chennai Sipcot', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', 'CHENNAI', 'TN-33', 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, NULL, '100009', '2019-02-22 15:37:23', 600, 'GST', NULL, 18000, '2', 'asdv asodvsadv asbiod dovs odivasdoviasdh vasodhdh', 'asdc sadcasbdaskldcbasdcbasdocas', '2019-02-22 15:37:23', '2019-02-22 10:07:23', '1', '192.168.1.15'),
(7, NULL, NULL, 'Novotel Chennai Sipcot', '', 'ASHOK KUMAR', '33AAECS1194CZZP', 'CHENNAI', 'TN-33', 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, NULL, '100010', '2019-02-22 15:37:46', 650, 'GST', NULL, 18050, '2', 'asdv asodvsadv asbiod dovs odivasdoviasdh vasodhdh', 'asdc sadcasbdaskldcbasdcbasdocas', '2019-02-22 15:37:46', '2019-02-22 10:07:46', '1', '192.168.1.15'),
(8, NULL, NULL, 'asvjas', '21', 'sdkfj', '456454656464', '5464', '4', '6545,564,5464-464', NULL, NULL, '100011', '2019-02-22 15:42:42', 1, 'IGST', NULL, 1, '', '', '', '2019-02-22 15:42:42', '2019-02-22 10:12:42', '1', '192.168.1.15'),
(9, NULL, NULL, 'Novotel Chennai Sipcot', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', 'CHENNAI', 'TN-33', 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, NULL, '100012', '2019-02-22 15:45:22', 100, 'GST', NULL, 100, '', '', '', '2019-02-22 15:45:22', '2019-02-22 10:15:22', '1', '192.168.1.15'),
(10, NULL, NULL, 'Vidhun Enterprises', '19', 'Geetha', 'test', 'tamil nadu', '654321', 'test,city1,tamil nadu-654321', NULL, NULL, '100013', '2019-02-22 15:49:39', 11, 'GST', NULL, 1, '4', '1521312', '1231', '2019-02-22 15:49:39', '2019-02-22 10:19:39', '1', '192.168.1.15'),
(11, NULL, NULL, 'Novotel Chennai Sipcot', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', 'CHENNAI', 'TN-33', 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, NULL, '100014', '2019-02-22 15:50:37', 13, 'GST', NULL, 1502, '2', 'sdfg sfovisdfvbsd ofvis dfvsd', '51515', '2019-02-22 15:50:37', '2019-02-22 10:20:37', '1', '192.168.1.15'),
(12, NULL, NULL, 'Novotel Chennai Sipcot', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', 'CHENNAI', 'TN-33', 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, NULL, '100015', '2019-02-22 15:53:00', 2033, 'GST', NULL, 14738, '1', 'jkjasc adbadcbil acbalsicasicbaolh', 'seg sdvsdfvasdfovasiv', '2019-02-22 15:53:00', '2019-02-22 10:23:00', '1', '192.168.1.15'),
(13, NULL, NULL, 'communist pvt ltd', '20', 'chanfru', '12123213', 'arabia', 'TN-33', '33,dubai kuruku santhu,vivekanathar street,dubai,arabia-2564216', NULL, NULL, '100016', '2019-02-22 15:53:24', 1, 'GST', NULL, 1, '', '', '', '2019-02-22 15:53:24', '2019-02-22 10:23:24', '1', '192.168.1.15'),
(14, NULL, NULL, 'communist pvt ltd', '', 'chanfru', '12123213', 'arabia', 'TN-33', '33,dubai kuruku santhu,vivekanathar street,dubai,arabia-2564216', NULL, NULL, '100017', '2019-02-22 15:54:13', 424, 'GST', NULL, 388, '', '', '', '2019-02-22 15:54:13', '2019-02-22 10:24:13', '1', '192.168.1.15'),
(15, NULL, NULL, 'Vidhun Enterprises', '19', 'Geetha', 'test', 'tamil nadu', '654321', 'test,city1,tamil nadu-654321', NULL, NULL, '100018', '2019-02-22 15:57:51', 3, 'GST', NULL, 3, '', '', '', '2019-02-22 15:57:51', '2019-02-22 10:27:51', '1', '192.168.1.15'),
(16, NULL, NULL, 'Vidhun Enterprises', '', 'Geetha', 'test', 'tamil nadu', '654321', 'test,city1,tamil nadu-654321', NULL, NULL, '100019', '2019-02-22 15:59:15', 18, 'GST', NULL, 18, '', '', '', '2019-02-22 15:59:15', '2019-02-22 10:29:15', '1', '192.168.1.15'),
(17, NULL, NULL, 'Novotel Chennai Sipcot', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', 'CHENNAI', 'TN-33', 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, NULL, '100020', '2019-02-22 16:03:37', 2261, 'IGST', NULL, 4335, '2', 'dfv sdfvbasfio', '1500', '2019-02-22 16:03:37', '2019-02-22 10:48:32', '1', '192.168.1.15'),
(18, NULL, NULL, 'Novotel Chennai Sipcot', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', 'CHENNAI', 'TN-33', 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, NULL, '100021', '2019-02-22 16:19:08', 151, 'GST', NULL, 15, '0', 's advsadkvsdhucvsdh', 'bhib', '2019-02-22 16:19:08', '2019-02-22 10:49:08', '1', '192.168.1.15'),
(19, NULL, NULL, 'tendulkar', '23', 'ten', '2316654231132163', NULL, NULL, 'No.37, Opp Swagat Hotel, Royapetteh High Road,Chennai,TN-000000', '8', '4/22, Rutland Gate 4th St, Srirampuram, Thousand Lights West, Thousand Lights', '100022', '2019-02-26 12:11:06', 1650, 'GST', NULL, 1650, '2', '', '', '2019-02-26 12:11:06', '2019-02-26 06:41:06', '1', '192.168.1.20'),
(20, NULL, NULL, 'Novotel Chennai Sipcot', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', NULL, NULL, 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', '', 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', '100023', '2019-02-26 13:19:19', 282, 'GST', NULL, 2274, '2', 'ajcvajk aj', '12152', '2019-02-26 13:19:19', '2019-02-26 07:49:19', '1', '192.168.1.20'),
(21, NULL, NULL, 'Vidhun Enterprises', '19', 'Geetha', 'test', NULL, NULL, 'test,city1,tamil nadu-654321', '', 'test,city1,tamil nadu-654321', '100024', '2019-02-27 20:00:25', 44, 'GST', NULL, 0, '1', 'test vehicle', 'none', '2019-02-27 20:00:25', '2019-02-27 14:30:25', '1', '192.168.1.62'),
(22, NULL, NULL, 'Hanifa & Co', '26', 'Hani', '629347549824', NULL, NULL, '181, Commercial Street, Tasker Town, Shivaji Nagar, ,Bengaluru,Karnataka-560001', '18', '#165, 1st floor, 9th, Sampige Rd, 7th Cross, Vyalikaval, Malleshwaram West,', '100025', '2019-02-28 18:00:28', 870, 'GST', NULL, 0, '1', 'TN 99 TN 9999', 'None', '2019-02-28 18:00:28', '2019-02-28 12:30:28', '1', '192.168.1.3'),
(25, NULL, NULL, 'tendulkar', '23', '', '2316654231132163', NULL, NULL, 'No.37, Opp Swagat Hotel, Royapetteh High Road', 'undefined', '4/22, Rutland Gate 4th St, Srirampuram, Thousand Lights West, Thousand Lights', '100028', '2019-02-28 18:45:00', 10, 'GST', NULL, 10, '2', '1651', '516', '2019-02-28 18:45:00', '2019-02-28 13:15:00', '1', '192.168.1.7'),
(26, NULL, NULL, 'tendulkar', '23', '', '2316654231132163', NULL, NULL, 'No.37, Opp Swagat Hotel, Royapetteh High Road', 'undefined', 'No.37, Opp Swagat Hotel, Royapetteh High Road', '100029', '2019-02-28 19:19:18', 102, 'GST', NULL, 1, '1', 'test', 'test', '2019-02-28 19:19:18', '2019-02-28 13:49:18', '1', '192.168.1.3'),
(27, NULL, NULL, 'tendulkar', '23', '', '2316654231132163', NULL, NULL, 'No.37, Opp Swagat Hotel, Royapetteh High Road', '', 'No.37, Opp Swagat Hotel, Royapetteh High Road', '100030', '2019-02-28 20:23:15', 268, 'GST', NULL, 152, '1', 'test', 'test', '2019-02-28 20:23:15', '2019-02-28 14:53:15', '1', '192.168.1.7'),
(28, NULL, NULL, 'tendulkar', '23', '', '2316654231132163', NULL, NULL, 'No.37, Opp Swagat Hotel, Royapetteh High Road', '', 'No.37, Opp Swagat Hotel, Royapetteh High Road', '100031', '2019-02-28 20:31:18', 268, 'GST', NULL, 152, '1', 'test', 'test', '2019-02-28 20:31:18', '2019-02-28 15:01:18', '1', '192.168.1.7'),
(29, NULL, NULL, 'tendulkar', '23', '', '2316654231132163', NULL, NULL, 'No.37, Opp Swagat Hotel, Royapetteh High Road', '', 'No.37, Opp Swagat Hotel, Royapetteh High Road', '100032', '2019-02-28 20:40:45', 268, 'GST', NULL, 152, '1', 'test', 'test', '2019-02-28 20:40:45', '2019-02-28 15:10:45', '1', '192.168.1.7'),
(30, NULL, NULL, 'tendulkar', '23', '', '2316654231132163', NULL, NULL, 'No.37, Opp Swagat Hotel, Royapetteh High Road', '', 'No.37, Opp Swagat Hotel, Royapetteh High Road', '100033', '2019-02-28 20:41:35', 269, 'GST', NULL, 302, '1', 'test', 'test', '2019-02-28 20:41:35', '2019-02-28 15:11:35', '1', '192.168.1.7'),
(31, NULL, NULL, 'Hanifa & Co', '26', '', '629347549824', NULL, NULL, '181, Commercial Street, Tasker Town, Shivaji Nagar, ', '', '', '100034', '2019-02-28 20:45:23', 2002, 'GST', NULL, 5500, '0', '1515', '15151', '2019-02-28 20:45:23', '2019-02-28 15:15:23', '1', '192.168.1.7'),
(32, NULL, NULL, 'Hanifa & Co', '26', '', '629347549824', NULL, NULL, '181, Commercial Street, Tasker Town, Shivaji Nagar, ', '', '', '100035', '2019-02-28 20:45:53', 2003, 'GST', NULL, 8126, '0', '1515', '15151', '2019-02-28 20:45:53', '2019-02-28 15:15:53', '1', '192.168.1.7'),
(33, 'IV', '28', 'Hanifa & Co', '26', '', '629347549824', NULL, NULL, '181, Commercial Street, Tasker Town, Shivaji Nagar, ', '', '', '100036', '2019-02-28 20:46:13', 2003, 'GST', NULL, 8126, '0', '1515', '15151', '2019-02-28 20:46:13', '2019-03-01 05:44:48', '1', '192.168.1.7'),
(34, NULL, NULL, 'Hanifa & Co', '26', '', '629347549824', NULL, NULL, '181, Commercial Street, Tasker Town, Shivaji Nagar, ', '', '', '100037', '2019-02-28 20:48:07', 2044, 'GST', NULL, 8141, '0', '1515', '15151', '2019-02-28 20:48:07', '2019-02-28 15:18:07', '1', '192.168.1.7'),
(35, NULL, NULL, 'Vidhun Enterprises', '19', '', 'test', NULL, NULL, 'test', '', '', '100038', '2019-02-28 20:49:17', 4, 'GST', NULL, 4015, '', '', '', '2019-02-28 20:49:17', '2019-02-28 15:19:17', '1', '192.168.1.7'),
(36, NULL, NULL, 'Vidhun Enterprises', '19', '', 'test', NULL, NULL, 'test', '', '', '100039', '2019-02-28 20:54:08', 160, 'GST', NULL, 484, '', '', '', '2019-02-28 20:54:08', '2019-02-28 15:24:08', '1', '192.168.1.7'),
(37, NULL, NULL, 'communist pvt ltd', '20', '', '12123213', NULL, NULL, '33,dubai kuruku santhu,vivekanathar street', '', '', '100040', '2019-02-28 20:54:31', 242, 'GST', NULL, 122, '', '', '', '2019-02-28 20:54:31', '2019-02-28 15:24:31', '1', '192.168.1.7'),
(38, NULL, NULL, 'communist pvt ltd', '20', '', '12123213', NULL, NULL, '33,dubai kuruku santhu,vivekanathar street', '', '', '100041', '2019-02-28 20:55:24', 269, 'GST', NULL, 288, '3', 'asfdjvh', 'asd', '2019-02-28 20:55:24', '2019-02-28 15:25:24', '1', '192.168.1.7'),
(39, NULL, NULL, 'Sai Group of Companies', '11', '', '1234556', NULL, NULL, '', '', '', '100042', '2019-02-28 20:56:06', 302, 'IGST', NULL, 16, '', '', '', '2019-02-28 20:56:06', '2019-02-28 15:26:06', '1', '192.168.1.7'),
(40, NULL, NULL, 'tendulkar', '23', '', '2316654231132163', NULL, NULL, 'No.37, Opp Swagat Hotel, Royapetteh High Road', 'undefined', '4/22, Rutland Gate 4th St, Srirampuram, Thousand Lights West, Thousand Lights', '100043', '2019-02-28 20:58:49', 269, 'GST', NULL, 302, '1', 'test', 'test', '2019-02-28 20:58:49', '2019-02-28 15:28:49', '1', '192.168.1.7'),
(41, 'IV', '29', 'GHNDN', '5', '', '4544', NULL, NULL, '53T54T', '', '', '100044', '2019-02-28 21:00:36', 566, 'IGST', NULL, 1556, '', '', '', '2019-02-28 21:00:36', '2019-03-01 05:45:17', '1', '192.168.1.7'),
(42, 'IV', '32', 'dhoni pvt ltd', '27', '', 'IOO0000000000000000000', NULL, NULL, 'No 23, 3rd Floor, Modern Tower, West Cott Road, Royapettah,', 'undefined', 'Ibrahim, West Cott Road, Royapettah,', '100045', '2019-03-01 13:05:47', 16, 'IGST', NULL, 1958, '0', '111', '111', '2019-03-01 13:05:47', '2019-03-01 07:45:03', '1', '192.168.1.7'),
(43, NULL, NULL, 'Novotel Chennai Sipcot', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', NULL, NULL, 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', '', 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', '100046', '2019-03-01 13:08:21', 3048, 'GST', NULL, 288, '0', 'asdvasvj', ' ajksdcva', '2019-03-01 13:08:21', '2019-03-01 07:39:59', '1', '192.168.1.7'),
(44, NULL, NULL, 'lucky vaccines', '13', '', '8888888888888888888', NULL, NULL, '4/22, Rutland Gate 4th St, Srirampuram, Thousand Lights West, Thousand Lights', 'undefined', '4/22, Rutland Gate 4th St, Srirampuram, Thousand Lights West, Thousand Lights', '100047', '2019-03-01 13:32:45', 12, 'IGST', NULL, 14, '4', ' asjdvasjdvcasj', 'asjdvs vsavhasdfvj safvasu vusavsuvsuadfh', '2019-03-01 13:32:45', '2019-03-01 08:02:45', '1', '192.168.1.7'),
(45, NULL, NULL, 'lucky vaccines', '13', '', '8888888888888888888', NULL, NULL, '4/22, Rutland Gate 4th St, Srirampuram, Thousand Lights West, Thousand Lights', '', '4/22, Rutland Gate 4th St, Srirampuram, Thousand Lights West, Thousand Lights', '100048', '2019-03-01 13:33:40', 12, 'IGST', NULL, 14, '4', ' asjdvasjdvcasj', 'asjdvs vsavhasdfvj safvasu vusavsuvsuadfh', '2019-03-01 13:33:40', '2019-03-01 08:03:40', '1', '192.168.1.7'),
(46, NULL, NULL, 'lucky vaccines', '13', '', '8888888888888888888', NULL, NULL, '4/22, Rutland Gate 4th St, Srirampuram, Thousand Lights West, Thousand Lights', '', '4/22, Rutland Gate 4th St, Srirampuram, Thousand Lights West, Thousand Lights', '100049', '2019-03-01 13:37:47', 3, 'IGST', NULL, 3, '4', ' asjdvasjdvcasj', 'asjdvs vsavhasdfvj safvasu vusavsuvsuadfh', '2019-03-01 13:37:47', '2019-03-01 08:08:07', '1', '192.168.1.7'),
(47, NULL, NULL, 'lucky vaccines', '13', '', '8888888888888888888', NULL, NULL, '4/22, Rutland Gate 4th St, Srirampuram, Thousand Lights West, Thousand Lights', '', '4/22, Rutland Gate 4th St, Srirampuram, Thousand Lights West, Thousand Lights', '100050', '2019-03-01 13:40:21', 124, 'IGST', NULL, 15, '4', ' asjdvasjdvcasj', 'asjdvs vsavhasdfvj safvasu vusavsuvsuadfh', '2019-03-01 13:40:21', '2019-03-01 08:10:21', '1', '192.168.1.7'),
(48, NULL, NULL, 'lucky vaccines', '13', '', '8888888888888888888', NULL, NULL, '4/22, Rutland Gate 4th St, Srirampuram, Thousand Lights West, Thousand Lights', '', '4/22, Rutland Gate 4th St, Srirampuram, Thousand Lights West, Thousand Lights', '100051', '2019-03-01 13:42:03', 1639, 'IGST', NULL, 30, '4', ' asjdvasjdvcasj', 'asjdvs vsavhasdfvj safvasu vusavsuvsuadfh', '2019-03-01 13:42:03', '2019-03-01 08:15:51', '1', '192.168.1.7'),
(49, 'IV', '33', 'dhoni pvt ltd', '27', '', 'IOO0000000000000000000', NULL, NULL, 'No 23, 3rd Floor, Modern Tower, West Cott Road, Royapettah,', 'undefined', 'Ibrahim, West Cott Road, Royapettah,', '100052', '2019-03-01 13:46:47', 60, 'GST', NULL, 222, '0', '151', '515151', '2019-03-01 13:46:47', '2019-03-01 08:20:48', '1', '192.168.1.7'),
(51, NULL, NULL, 'tendulkar', '23', 'ten', '2316654231132163', NULL, NULL, 'No.37, Opp Swagat Hotel, Royapetteh High Road,Chennai,TN-000000', '9', '4/22, Rutland Gate 4th St, Srirampuram, Thousand Lights West, Thousand Lights,Chennai,TN,000000', 'DL-2019-100054', '2019-03-02 14:45:42', 151, 'GST', NULL, 151, '1', 'sd fj', 'hidx', '2019-03-02 14:45:42', '2019-03-02 09:15:42', '1', '192.168.1.25'),
(52, NULL, NULL, 'tendulkar', '23', '', '2316654231132163', NULL, NULL, 'No.37, Opp Swagat Hotel, Royapetteh High Road', 'undefined', '4/22, Rutland Gate 4th St, Srirampuram, Thousand Lights West, Thousand Lights', 'DL-2019-0001', '2019-03-02 17:25:14', 4302, 'GST', NULL, 165, '1', ' asdvcuasdu', ' asduicvasudvc cvasud vc', '2019-03-02 17:25:14', '2019-03-02 11:55:14', '4', '192.168.1.25');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_address_master`
--

CREATE TABLE `delivery_address_master` (
  `id` bigint(20) NOT NULL,
  `cust_id` varchar(255) DEFAULT NULL,
  `delivery_address` text,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `pincode` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` varchar(255) DEFAULT NULL,
  `ipaddress` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_address_master`
--

INSERT INTO `delivery_address_master` (`id`, `cust_id`, `delivery_address`, `city`, `state`, `pincode`, `created_date`, `updated_at`, `user_id`, `ipaddress`) VALUES
(7, '23', 'No.37, Opp Swagat Hotel, Royapetteh High Road', 'Chennai', 'TN', '000000', '2019-02-25 19:07:34', '2019-02-25 13:37:34', NULL, '192.168.1.20'),
(8, '23', '4/22, Rutland Gate 4th St, Srirampuram, Thousand Lights West, Thousand Lights', 'Chennai', 'TN', '000000', '2019-02-25 19:07:34', '2019-02-25 13:37:34', NULL, '192.168.1.20'),
(9, '23', '4/22, Rutland Gate 4th St, Srirampuram, Thousand Lights West, Thousand Lights', 'Chennai', 'TN', '000000', '2019-02-25 19:07:34', '2019-02-25 13:37:34', NULL, '192.168.1.20'),
(10, '23', '4/22, Rutland Gate 4th St, Srirampuram, Thousand Lights West, Thousand Lights', 'Chennai', 'TN', '000000', '2019-02-25 19:07:34', '2019-02-25 13:37:34', NULL, '192.168.1.20'),
(11, '24', '121', '23', '023', '023', '2019-02-28 11:02:40', '2019-02-28 05:32:40', '1', '192.168.1.7'),
(12, '9', '4/22, Rutland Gate 4th St, Srirampuram, Thousand Lights West, Thousand Lights', 'Chennai', 'TN', '000000', '2019-02-28 11:07:32', '2019-02-28 05:37:32', NULL, '192.168.1.7'),
(14, '25', 'dfjkvbld', '151', '151', '1', '2019-02-28 11:08:34', '2019-02-28 05:38:34', NULL, '192.168.1.7'),
(15, '25', '4/22, Rutland Gate 4th St, Srirampuram, Thousand Lights West, Thousand Lights', 'Chennai', 'TN', '000000', '2019-02-28 11:08:34', '2019-02-28 05:38:34', NULL, '192.168.1.7'),
(19, '26', ' #1658, First Floor, 27th Main Rd, Sector 2, HSR Layout,', 'Bengaluru', 'Karnataka ', '560102', '2019-02-28 18:11:08', '2019-02-28 12:41:08', NULL, '192.168.1.3'),
(20, '26', '37, Pottery Rd, Richards Town', 'Bengaluru', 'Karnataka ', '560005', '2019-02-28 18:11:08', '2019-02-28 12:41:08', NULL, '192.168.1.3'),
(21, '26', '#165, 1st floor, 9th, Sampige Rd, 7th Cross, Vyalikaval, Malleshwaram West,', 'Bengaluru', 'Karnataka ', '560003', '2019-02-28 18:11:08', '2019-02-28 12:41:08', NULL, '192.168.1.3'),
(22, '27', 'Peters Road, West Cott Road, Royapettah,', 'Chennai', 'Tamil Nadu', '600014', '2019-03-01 12:58:05', '2019-03-01 07:28:05', '1', '192.168.1.7'),
(23, '27', 'Ibrahim, West Cott Road, Royapettah,', 'Chennai', 'Tamil Nadu', '600014', '2019-03-01 12:58:05', '2019-03-01 07:28:05', '1', '192.168.1.7'),
(24, '13', '4/22, Rutland Gate 4th St, Srirampuram, Thousand Lights West, Thousand Lights', 'Chennai', 'TN', '000000', '2019-03-01 13:31:45', '2019-03-01 08:01:45', NULL, '192.168.1.7');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_log`
--

CREATE TABLE `delivery_log` (
  `id` bigint(20) NOT NULL,
  `delivery_id` varchar(255) DEFAULT NULL,
  `cust_id` varchar(255) DEFAULT NULL,
  `cust_name` varchar(255) DEFAULT NULL,
  `gstin_no` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `state_code` varchar(255) DEFAULT NULL,
  `address` text,
  `delivery_select` varchar(255) DEFAULT NULL,
  `delivery_address` text,
  `bill_no` varchar(255) DEFAULT NULL,
  `bill_date` datetime DEFAULT NULL,
  `tot_qty` float DEFAULT NULL,
  `tot_amt` float DEFAULT NULL,
  `transport` varchar(255) DEFAULT NULL,
  `vehicle_num` varchar(255) DEFAULT NULL,
  `remarks` text,
  `c_date` datetime DEFAULT NULL,
  `u_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` varchar(255) DEFAULT NULL,
  `ipaddrss` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_log`
--

INSERT INTO `delivery_log` (`id`, `delivery_id`, `cust_id`, `cust_name`, `gstin_no`, `state`, `state_code`, `address`, `delivery_select`, `delivery_address`, `bill_no`, `bill_date`, `tot_qty`, `tot_amt`, `transport`, `vehicle_num`, `remarks`, `c_date`, `u_date`, `user_id`, `ipaddrss`) VALUES
(1, '1', '5', 'FGBFGB', '4544', '54T45T', '5445T', '53T54T,45T45T,54T45T-545', NULL, NULL, '100004', '2019-02-16 17:26:43', 3, 25, '3', 'dfv', 'sdafv vsdav', '2019-02-16 17:26:43', '2019-02-16 11:56:43', '1', '192.168.1.29'),
(2, '1', '5', 'FGBFGB', '4544', '54T45T', '5445T', '53T54T,45T45T,54T45T-545', NULL, NULL, '100004', '2019-02-16 17:26:43', 3, 3, '4', 'test', 'tester', '2019-02-16 17:28:06', '2019-02-16 11:58:06', '1', '192.168.1.29'),
(3, '1', '5', 'FGBFGB', '4544', '54T45T', '5445T', '53T54T,45T45T,54T45T-545', NULL, NULL, '100004', '2019-02-16 17:26:43', 3, 3, '4', 'test', 'tester', '2019-02-16 18:21:50', '2019-02-16 12:51:50', '1', '192.168.1.29'),
(4, '2', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', 'CHENNAI', 'TN-33', 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, NULL, '100005', '2019-02-18 15:13:36', 19, 2600, '0', 'sad sdfv dfv ', 'sdfk  xjhbck  vuhc  kih c', '2019-02-18 15:13:36', '2019-02-18 09:43:36', '1', '192.168.1.15'),
(5, '3', '11', 'Sai', '1234556', '', '', ',,-', NULL, NULL, '100006', '2019-02-19 17:05:41', 4, 3000, '1', 'sai', '', '2019-02-19 17:05:41', '2019-02-19 11:35:41', '1', '192.168.1.30'),
(6, '4', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', 'CHENNAI', 'TN-33', 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, NULL, '100007', '2019-02-20 19:05:09', 490, 5200, '1', 'asdvj hsd sdfiov sdo', 'ka sfvoisdhsdosdifvsdofsdfsdvsdbo bsd8o', '2019-02-20 19:05:09', '2019-02-20 13:35:09', '1', '192.168.1.15'),
(7, '4', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', 'CHENNAI', 'TN-33', 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, NULL, '100007', '0000-00-00 00:00:00', 740, 6856, '1', 'asdvj hsd sdfiov sdo', 'ka sfvoisdhsdosdifvsdofsdfsdvsdbo bsd8o', '2019-02-20 19:27:11', '2019-02-20 13:57:11', '1', '192.168.1.15'),
(8, '5', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', 'CHENNAI', 'TN-33', 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, NULL, '100008', '2019-02-20 19:29:11', 522, 100, '0', 'd sfv sdfvisdvdas', ' asv sduasvoasdvadvasbocsi', '2019-02-20 19:29:11', '2019-02-20 13:59:11', '1', '192.168.1.15'),
(9, '5', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', 'CHENNAI', 'TN-33', 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, NULL, '100008', '0000-00-00 00:00:00', 1022, 644, '0', 'd sfv sdfvisdvdas', ' asv sduasvoasdvadvasbocsi', '2019-02-20 19:31:25', '2019-02-20 14:01:25', '1', '192.168.1.15'),
(10, '4', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', 'CHENNAI', 'TN-33', 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, NULL, '100007', '0000-00-00 00:00:00', 632, 6386, '1', 'asdvj hsd sdfiov sdo', 'ka sfvoisdhsdosdifvsdofsdfsdvsdbo bsd8o', '2019-02-20 19:32:44', '2019-02-20 14:02:44', '1', '192.168.1.15'),
(11, '6', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', 'CHENNAI', 'TN-33', 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, NULL, '100009', '2019-02-22 15:37:23', 600, 18000, '2', 'asdv asodvsadv asbiod dovs odivasdoviasdh vasodhdh', 'asdc sadcasbdaskldcbasdcbasdocas', '2019-02-22 15:37:23', '2019-02-22 10:07:23', '1', '192.168.1.15'),
(12, '7', '', 'ASHOK KUMAR', '33AAECS1194CZZP', 'CHENNAI', 'TN-33', 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, NULL, '100010', '2019-02-22 15:37:46', 650, 18050, '2', 'asdv asodvsadv asbiod dovs odivasdoviasdh vasodhdh', 'asdc sadcasbdaskldcbasdcbasdocas', '2019-02-22 15:37:46', '2019-02-22 10:07:46', '1', '192.168.1.15'),
(13, '8', '21', 'sdkfj', '456454656464', '5464', '4', '6545,564,5464-464', NULL, NULL, '100011', '2019-02-22 15:42:42', 1, 1, '', '', '', '2019-02-22 15:42:42', '2019-02-22 10:12:42', '1', '192.168.1.15'),
(14, '9', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', 'CHENNAI', 'TN-33', 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, NULL, '100012', '2019-02-22 15:45:22', 100, 100, '', '', '', '2019-02-22 15:45:22', '2019-02-22 10:15:22', '1', '192.168.1.15'),
(15, '10', '19', 'Geetha', 'test', 'tamil nadu', '654321', 'test,city1,tamil nadu-654321', NULL, NULL, '100013', '2019-02-22 15:49:39', 11, 1, '4', '1521312', '1231', '2019-02-22 15:49:39', '2019-02-22 10:19:39', '1', '192.168.1.15'),
(16, '11', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', 'CHENNAI', 'TN-33', 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, NULL, '100014', '2019-02-22 15:50:37', 13, 1502, '2', 'sdfg sfovisdfvbsd ofvis dfvsd', '51515', '2019-02-22 15:50:37', '2019-02-22 10:20:37', '1', '192.168.1.15'),
(17, '12', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', 'CHENNAI', 'TN-33', 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, NULL, '100015', '2019-02-22 15:53:00', 2033, 14738, '1', 'jkjasc adbadcbil acbalsicasicbaolh', 'seg sdvsdfvasdfovasiv', '2019-02-22 15:53:00', '2019-02-22 10:23:00', '1', '192.168.1.15'),
(18, '13', '20', 'chanfru', '12123213', 'arabia', 'TN-33', '33,dubai kuruku santhu,vivekanathar street,dubai,arabia-2564216', NULL, NULL, '100016', '2019-02-22 15:53:24', 1, 1, '', '', '', '2019-02-22 15:53:24', '2019-02-22 10:23:24', '1', '192.168.1.15'),
(19, '14', '', 'chanfru', '12123213', 'arabia', 'TN-33', '33,dubai kuruku santhu,vivekanathar street,dubai,arabia-2564216', NULL, NULL, '100017', '2019-02-22 15:54:14', 424, 388, '', '', '', '2019-02-22 15:54:14', '2019-02-22 10:24:14', '1', '192.168.1.15'),
(20, '15', '19', 'Geetha', 'test', 'tamil nadu', '654321', 'test,city1,tamil nadu-654321', NULL, NULL, '100018', '2019-02-22 15:57:51', 3, 3, '', '', '', '2019-02-22 15:57:51', '2019-02-22 10:27:51', '1', '192.168.1.15'),
(21, '16', '', 'Geetha', 'test', 'tamil nadu', '654321', 'test,city1,tamil nadu-654321', NULL, NULL, '100019', '2019-02-22 15:59:15', 18, 18, '', '', '', '2019-02-22 15:59:15', '2019-02-22 10:29:15', '1', '192.168.1.15'),
(22, '17', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', 'CHENNAI', 'TN-33', 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, NULL, '100020', '2019-02-22 16:03:37', 1661, 660, '2', 'dfv sdfvbasfio', '1500', '2019-02-22 16:03:37', '2019-02-22 10:33:37', '1', '192.168.1.15'),
(23, '17', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', 'CHENNAI', 'TN-33', 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, NULL, '100020', '0000-00-00 00:00:00', 1672, 671, '2', 'dfv sdfvbasfio', '1500', '2019-02-22 16:05:08', '2019-02-22 10:35:08', '1', '192.168.1.15'),
(24, '17', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', 'CHENNAI', 'TN-33', 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, NULL, '100020', '0000-00-00 00:00:00', 1683, 2792, '2', 'dfv sdfvbasfio', '1500', '2019-02-22 16:06:38', '2019-02-22 10:36:38', '1', '192.168.1.15'),
(25, '17', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', 'CHENNAI', 'TN-33', 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, NULL, '100020', '0000-00-00 00:00:00', 2094, 4303, '2', 'dfv sdfvbasfio', '1500', '2019-02-22 16:13:34', '2019-02-22 10:43:34', '1', '192.168.1.15'),
(26, '17', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', 'CHENNAI', 'TN-33', 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, NULL, '100020', '0000-00-00 00:00:00', 2095, 4304, '2', 'dfv sdfvbasfio', '1500', '2019-02-22 16:15:29', '2019-02-22 10:45:29', '1', '192.168.1.15'),
(27, '17', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', 'CHENNAI', 'TN-33', 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, NULL, '100020', '0000-00-00 00:00:00', 2095, 4304, '2', 'dfv sdfvbasfio', '1500', '2019-02-22 16:15:51', '2019-02-22 10:45:51', '1', '192.168.1.15'),
(28, '17', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', 'CHENNAI', 'TN-33', 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, NULL, '100020', '0000-00-00 00:00:00', 2095, 4304, '2', 'dfv sdfvbasfio', '1500', '2019-02-22 16:16:09', '2019-02-22 10:46:09', '1', '192.168.1.15'),
(29, '17', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', 'CHENNAI', 'TN-33', 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, NULL, '100020', '0000-00-00 00:00:00', 2095, 4304, '2', 'dfv sdfvbasfio', '1500', '2019-02-22 16:16:55', '2019-02-22 10:46:55', '1', '192.168.1.15'),
(30, '17', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', 'CHENNAI', 'TN-33', 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, NULL, '100020', '0000-00-00 00:00:00', 2246, 4320, '2', 'dfv sdfvbasfio', '1500', '2019-02-22 16:17:26', '2019-02-22 10:47:26', '1', '192.168.1.15'),
(31, '17', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', 'CHENNAI', 'TN-33', 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, NULL, '100020', '0000-00-00 00:00:00', 2261, 4335, '2', 'dfv sdfvbasfio', '1500', '2019-02-22 16:18:32', '2019-02-22 10:48:32', '1', '192.168.1.15'),
(32, '18', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', 'CHENNAI', 'TN-33', 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, NULL, '100021', '2019-02-22 16:19:08', 151, 15, '0', 's advsadkvsdhucvsdh', 'bhib', '2019-02-22 16:19:08', '2019-02-22 10:49:08', '1', '192.168.1.15'),
(33, '18', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', 'CHENNAI', 'TN-33', 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, NULL, '100021', '0000-00-00 00:00:00', 151, 15, '0', 's advsadkvsdhucvsdh', 'bhib', '2019-02-22 16:19:47', '2019-02-22 10:49:47', '1', '192.168.1.15'),
(34, '19', '23', 'ten', '2316654231132163', NULL, NULL, 'No.37, Opp Swagat Hotel, Royapetteh High Road,Chennai,TN-000000', '8', '4/22, Rutland Gate 4th St, Srirampuram, Thousand Lights West, Thousand Lights', '100022', '2019-02-26 12:11:06', 1650, 1650, '2', '', '', '2019-02-26 12:11:06', '2019-02-26 06:41:06', '1', '192.168.1.20'),
(35, '20', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', NULL, NULL, 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', '', 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', '100023', '2019-02-26 13:19:19', 282, 2274, '2', 'ajcvajk aj', '12152', '2019-02-26 13:19:19', '2019-02-26 07:49:19', '1', '192.168.1.20'),
(36, '20', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', NULL, NULL, 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, NULL, '100023', '0000-00-00 00:00:00', 282, 2274, '2', 'ajcvajk aj', '12152', '2019-02-26 13:20:02', '2019-02-26 07:50:02', '1', '192.168.1.20'),
(37, '20', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', NULL, NULL, 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, NULL, '100023', '0000-00-00 00:00:00', 282, 2274, '2', 'ajcvajk aj', '12152', '2019-02-26 13:21:14', '2019-02-26 07:51:14', '1', '192.168.1.20'),
(38, '20', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', NULL, NULL, 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, NULL, '100023', '0000-00-00 00:00:00', 282, 2274, '2', 'ajcvajk aj', '12152', '2019-02-26 13:24:19', '2019-02-26 07:54:19', '1', '192.168.1.20'),
(39, '20', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', NULL, NULL, 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, NULL, '100023', '0000-00-00 00:00:00', 282, 2274, '2', 'ajcvajk aj', '12152', '2019-02-26 13:24:46', '2019-02-26 07:54:46', '1', '192.168.1.20'),
(40, '20', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', NULL, NULL, 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, NULL, '100023', '0000-00-00 00:00:00', 282, 2274, '2', 'ajcvajk aj', '12152', '2019-02-26 13:25:49', '2019-02-26 07:55:49', '1', '192.168.1.20'),
(41, '20', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', NULL, NULL, 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, NULL, '100023', '0000-00-00 00:00:00', 282, 2274, '2', 'ajcvajk aj', '12152', '2019-02-26 13:27:58', '2019-02-26 07:57:58', '1', '192.168.1.20'),
(42, '20', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', NULL, NULL, 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, NULL, '100023', '0000-00-00 00:00:00', 282, 2274, '2', 'ajcvajk aj', '12152', '2019-02-26 13:29:35', '2019-02-26 07:59:35', '1', '192.168.1.20'),
(43, '20', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', NULL, NULL, 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, NULL, '100023', '0000-00-00 00:00:00', 282, 2274, '2', 'ajcvajk aj', '12152', '2019-02-26 13:30:41', '2019-02-26 08:00:41', '1', '192.168.1.20'),
(44, '20', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', NULL, NULL, 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, NULL, '100023', '0000-00-00 00:00:00', 282, 2274, '2', 'ajcvajk aj', '12152', '2019-02-26 13:33:15', '2019-02-26 08:03:15', '1', '192.168.1.20'),
(45, '20', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', NULL, NULL, 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, NULL, '100023', '0000-00-00 00:00:00', 282, 2274, '2', 'ajcvajk aj', '12152', '2019-02-26 13:33:38', '2019-02-26 08:03:38', '1', '192.168.1.20'),
(46, '20', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', NULL, NULL, 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, NULL, '100023', '0000-00-00 00:00:00', 282, 2274, '2', 'ajcvajk aj', '12152', '2019-02-26 13:33:48', '2019-02-26 08:03:48', '1', '192.168.1.20'),
(47, '20', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', NULL, NULL, 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, NULL, '100023', '0000-00-00 00:00:00', 282, 2274, '2', 'ajcvajk aj', '12152', '2019-02-26 13:34:44', '2019-02-26 08:04:44', '1', '192.168.1.20'),
(48, '20', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', NULL, NULL, 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, NULL, '100023', '0000-00-00 00:00:00', 282, 2274, '2', 'ajcvajk aj', '12152', '2019-02-26 13:35:24', '2019-02-26 08:05:24', '1', '192.168.1.20'),
(49, '20', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', NULL, NULL, 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', '100023', '0000-00-00 00:00:00', 282, 2274, '2', 'ajcvajk aj', '12152', '2019-02-26 13:37:12', '2019-02-26 08:07:12', '1', '192.168.1.20'),
(50, '20', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', NULL, NULL, 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', NULL, 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', '100023', '0000-00-00 00:00:00', 282, 2274, '2', 'ajcvajk aj', '12152', '2019-02-26 13:38:14', '2019-02-26 08:08:14', '1', '192.168.1.20'),
(51, '21', '19', 'Geetha', 'test', NULL, NULL, 'test,city1,tamil nadu-654321', '', 'test,city1,tamil nadu-654321', '100024', '2019-02-27 20:00:25', 44, 0, '1', 'test vehicle', 'none', '2019-02-27 20:00:25', '2019-02-27 14:30:25', '1', '192.168.1.62'),
(52, '22', '26', 'Hani', '629347549824', NULL, NULL, '181, Commercial Street, Tasker Town, Shivaji Nagar, ,Bengaluru,Karnataka-560001', '18', '#165, 1st floor, 9th, Sampige Rd, 7th Cross, Vyalikaval, Malleshwaram West,', '100025', '2019-02-28 18:00:29', 870, 0, '1', 'TN 99 TN 9999', 'None', '2019-02-28 18:00:29', '2019-02-28 12:30:29', '1', '192.168.1.3'),
(53, '23', '26', 'Hani', '629347549824', NULL, NULL, '181, Commercial Street, Tasker Town, Shivaji Nagar, ,Bengaluru,Karnataka-560001', '21', '#165, 1st floor, 9th, Sampige Rd, 7th Cross, Vyalikaval, Malleshwaram West,', '100026', '2019-02-28 18:23:16', 1, 15, '', '', '', '2019-02-28 18:23:16', '2019-02-28 12:53:16', '1', '192.168.1.7'),
(54, '24', '23', '', '2316654231132163', NULL, NULL, 'No.37, Opp Swagat Hotel, Royapetteh High Road', '', '', '100027', '2019-02-28 18:43:08', 11666, 47, '1', 'sadvbjhsk', 'sxcjkvsdkjcvasd asasdcvkasgjd', '2019-02-28 18:43:08', '2019-02-28 13:13:08', '1', '192.168.1.7'),
(55, '25', '23', '', '2316654231132163', NULL, NULL, 'No.37, Opp Swagat Hotel, Royapetteh High Road', 'undefined', '4/22, Rutland Gate 4th St, Srirampuram, Thousand Lights West, Thousand Lights', '100028', '2019-02-28 18:45:00', 10, 10, '2', '1651', '516', '2019-02-28 18:45:00', '2019-02-28 13:15:00', '1', '192.168.1.7'),
(56, '26', '23', '', '2316654231132163', NULL, NULL, 'No.37, Opp Swagat Hotel, Royapetteh High Road', 'undefined', 'No.37, Opp Swagat Hotel, Royapetteh High Road', '100029', '2019-02-28 19:19:18', 102, 1, '1', 'test', 'test', '2019-02-28 19:19:18', '2019-02-28 13:49:18', '1', '192.168.1.3'),
(57, '27', '23', '', '2316654231132163', NULL, NULL, 'No.37, Opp Swagat Hotel, Royapetteh High Road', '', 'No.37, Opp Swagat Hotel, Royapetteh High Road', '100030', '2019-02-28 20:23:15', 268, 152, '1', 'test', 'test', '2019-02-28 20:23:15', '2019-02-28 14:53:15', '1', '192.168.1.7'),
(58, '28', '23', '', '2316654231132163', NULL, NULL, 'No.37, Opp Swagat Hotel, Royapetteh High Road', '', 'No.37, Opp Swagat Hotel, Royapetteh High Road', '100031', '2019-02-28 20:31:18', 268, 152, '1', 'test', 'test', '2019-02-28 20:31:18', '2019-02-28 15:01:18', '1', '192.168.1.7'),
(59, '29', '23', '', '2316654231132163', NULL, NULL, 'No.37, Opp Swagat Hotel, Royapetteh High Road', '', 'No.37, Opp Swagat Hotel, Royapetteh High Road', '100032', '2019-02-28 20:40:45', 268, 152, '1', 'test', 'test', '2019-02-28 20:40:45', '2019-02-28 15:10:45', '1', '192.168.1.7'),
(60, '30', '23', '', '2316654231132163', NULL, NULL, 'No.37, Opp Swagat Hotel, Royapetteh High Road', '', 'No.37, Opp Swagat Hotel, Royapetteh High Road', '100033', '2019-02-28 20:41:35', 269, 302, '1', 'test', 'test', '2019-02-28 20:41:35', '2019-02-28 15:11:35', '1', '192.168.1.7'),
(61, '31', '26', '', '629347549824', NULL, NULL, '181, Commercial Street, Tasker Town, Shivaji Nagar, ', '', '', '100034', '2019-02-28 20:45:24', 2002, 5500, '0', '1515', '15151', '2019-02-28 20:45:24', '2019-02-28 15:15:24', '1', '192.168.1.7'),
(62, '32', '26', '', '629347549824', NULL, NULL, '181, Commercial Street, Tasker Town, Shivaji Nagar, ', '', '', '100035', '2019-02-28 20:45:53', 2003, 8126, '0', '1515', '15151', '2019-02-28 20:45:53', '2019-02-28 15:15:53', '1', '192.168.1.7'),
(63, '33', '26', '', '629347549824', NULL, NULL, '181, Commercial Street, Tasker Town, Shivaji Nagar, ', '', '', '100036', '2019-02-28 20:46:13', 2003, 8126, '0', '1515', '15151', '2019-02-28 20:46:13', '2019-02-28 15:16:13', '1', '192.168.1.7'),
(64, '33', '26', '', '629347549824', NULL, NULL, '181, Commercial Street, Tasker Town, Shivaji Nagar, ', '', '', '100036', '2019-02-28 20:46:13', 2003, 8126, '0', '1515', '15151', '2019-02-28 20:46:31', '2019-02-28 15:16:31', '1', '192.168.1.7'),
(65, '34', '26', '', '629347549824', NULL, NULL, '181, Commercial Street, Tasker Town, Shivaji Nagar, ', '', '', '100037', '2019-02-28 20:48:07', 2044, 8141, '0', '1515', '15151', '2019-02-28 20:48:07', '2019-02-28 15:18:07', '1', '192.168.1.7'),
(66, '35', '19', '', 'test', NULL, NULL, 'test', '', '', '100038', '2019-02-28 20:49:17', 4, 4015, '', '', '', '2019-02-28 20:49:17', '2019-02-28 15:19:17', '1', '192.168.1.7'),
(67, '36', '19', '', 'test', NULL, NULL, 'test', '', '', '100039', '2019-02-28 20:54:08', 160, 484, '', '', '', '2019-02-28 20:54:08', '2019-02-28 15:24:08', '1', '192.168.1.7'),
(68, '37', '20', '', '12123213', NULL, NULL, '33,dubai kuruku santhu,vivekanathar street', '', '', '100040', '2019-02-28 20:54:31', 242, 122, '', '', '', '2019-02-28 20:54:31', '2019-02-28 15:24:31', '1', '192.168.1.7'),
(69, '38', '20', '', '12123213', NULL, NULL, '33,dubai kuruku santhu,vivekanathar street', '', '', '100041', '2019-02-28 20:55:24', 269, 288, '3', 'asfdjvh', 'asd', '2019-02-28 20:55:24', '2019-02-28 15:25:24', '1', '192.168.1.7'),
(70, '39', '11', '', '1234556', NULL, NULL, '', '', '', '100042', '2019-02-28 20:56:06', 302, 16, '', '', '', '2019-02-28 20:56:06', '2019-02-28 15:26:06', '1', '192.168.1.7'),
(71, '40', '23', '', '2316654231132163', NULL, NULL, 'No.37, Opp Swagat Hotel, Royapetteh High Road', 'undefined', '4/22, Rutland Gate 4th St, Srirampuram, Thousand Lights West, Thousand Lights', '100043', '2019-02-28 20:58:49', 269, 302, '1', 'test', 'test', '2019-02-28 20:58:49', '2019-02-28 15:28:49', '1', '192.168.1.7'),
(72, '41', '5', '', '4544', NULL, NULL, '53T54T', '', '', '100044', '2019-02-28 21:00:36', 151, 1541, '', '', '', '2019-02-28 21:00:36', '2019-02-28 15:30:36', '1', '192.168.1.7'),
(73, '41', '5', '', '4544', NULL, NULL, '53T54T', '', '', '100044', '2019-02-28 21:00:36', 566, 1556, '', '', '', '2019-02-28 21:01:08', '2019-02-28 15:31:08', '1', '192.168.1.7'),
(74, '42', '27', '', 'IOO0000000000000000000', NULL, NULL, 'No 23, 3rd Floor, Modern Tower, West Cott Road, Royapettah,', 'undefined', 'Ibrahim, West Cott Road, Royapettah,', '100045', '2019-03-01 13:05:47', 85, 1947, '1', 'tesre', 'sjavxjc ascalscba', '2019-03-01 13:05:47', '2019-03-01 07:35:47', '1', '192.168.1.7'),
(75, '42', '27', '', 'IOO0000000000000000000', NULL, NULL, 'No 23, 3rd Floor, Modern Tower, West Cott Road, Royapettah,', '', 'Ibrahim, West Cott Road, Royapettah,', '100045', '2019-03-01 13:05:47', 16, 1958, '0', '111', '111', '2019-03-01 13:07:15', '2019-03-01 07:37:15', '1', '192.168.1.7'),
(76, '43', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', NULL, NULL, 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', '', 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', '100046', '2019-03-01 13:08:21', 1522, 16, '0', 'asdvasvj', ' ajksdcva', '2019-03-01 13:08:21', '2019-03-01 07:38:21', '1', '192.168.1.7'),
(77, '43', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', NULL, NULL, 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', '', 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', '100046', '2019-03-01 13:08:21', 3037, 167, '0', 'asdvasvj', ' ajksdcva', '2019-03-01 13:08:36', '2019-03-01 07:38:36', '1', '192.168.1.7'),
(78, '43', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', NULL, NULL, 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', '', 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', '100046', '2019-03-01 13:08:21', 3048, 288, '0', 'asdvasvj', ' ajksdcva', '2019-03-01 13:09:59', '2019-03-01 07:39:59', '1', '192.168.1.7'),
(79, '43', '10', 'ASHOK KUMAR', '33AAECS1194CZZP', NULL, NULL, 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', '', 'THE RESIDENCY,49,G.N CHETTY ROAD,TNAGAR,CHENNAI-600017', '100046', '2019-03-01 13:08:21', 3048, 288, '0', 'asdvasvj', ' ajksdcva', '2019-03-01 13:10:08', '2019-03-01 07:40:08', '1', '192.168.1.7'),
(80, '44', '13', '', '8888888888888888888', NULL, NULL, '4/22, Rutland Gate 4th St, Srirampuram, Thousand Lights West, Thousand Lights', 'undefined', '4/22, Rutland Gate 4th St, Srirampuram, Thousand Lights West, Thousand Lights', '100047', '2019-03-01 13:32:45', 12, 14, '4', ' asjdvasjdvcasj', 'asjdvs vsavhasdfvj safvasu vusavsuvsuadfh', '2019-03-01 13:32:45', '2019-03-01 08:02:45', '1', '192.168.1.7'),
(81, '45', '13', '', '8888888888888888888', NULL, NULL, '4/22, Rutland Gate 4th St, Srirampuram, Thousand Lights West, Thousand Lights', '', '4/22, Rutland Gate 4th St, Srirampuram, Thousand Lights West, Thousand Lights', '100048', '2019-03-01 13:33:40', 12, 14, '4', ' asjdvasjdvcasj', 'asjdvs vsavhasdfvj safvasu vusavsuvsuadfh', '2019-03-01 13:33:40', '2019-03-01 08:03:40', '1', '192.168.1.7'),
(82, '46', '13', '', '8888888888888888888', NULL, NULL, '4/22, Rutland Gate 4th St, Srirampuram, Thousand Lights West, Thousand Lights', '', '4/22, Rutland Gate 4th St, Srirampuram, Thousand Lights West, Thousand Lights', '100049', '2019-03-01 13:37:47', 12, 14, '4', ' asjdvasjdvcasj', 'asjdvs vsavhasdfvj safvasu vusavsuvsuadfh', '2019-03-01 13:37:47', '2019-03-01 08:07:47', '1', '192.168.1.7'),
(83, '46', '13', '', '8888888888888888888', NULL, NULL, '4/22, Rutland Gate 4th St, Srirampuram, Thousand Lights West, Thousand Lights', '', '4/22, Rutland Gate 4th St, Srirampuram, Thousand Lights West, Thousand Lights', '100049', '2019-03-01 13:37:47', 3, 3, '4', ' asjdvasjdvcasj', 'asjdvs vsavhasdfvj safvasu vusavsuvsuadfh', '2019-03-01 13:38:07', '2019-03-01 08:08:07', '1', '192.168.1.7'),
(84, '47', '13', '', '8888888888888888888', NULL, NULL, '4/22, Rutland Gate 4th St, Srirampuram, Thousand Lights West, Thousand Lights', '', '4/22, Rutland Gate 4th St, Srirampuram, Thousand Lights West, Thousand Lights', '100050', '2019-03-01 13:40:21', 124, 15, '4', ' asjdvasjdvcasj', 'asjdvs vsavhasdfvj safvasu vusavsuvsuadfh', '2019-03-01 13:40:21', '2019-03-01 08:10:21', '1', '192.168.1.7'),
(85, '48', '13', '', '8888888888888888888', NULL, NULL, '4/22, Rutland Gate 4th St, Srirampuram, Thousand Lights West, Thousand Lights', '', '4/22, Rutland Gate 4th St, Srirampuram, Thousand Lights West, Thousand Lights', '100051', '2019-03-01 13:42:04', 124, 15, '4', ' asjdvasjdvcasj', 'asjdvs vsavhasdfvj safvasu vusavsuvsuadfh', '2019-03-01 13:42:04', '2019-03-01 08:12:04', '1', '192.168.1.7'),
(86, '48', '13', '', '8888888888888888888', NULL, NULL, '4/22, Rutland Gate 4th St, Srirampuram, Thousand Lights West, Thousand Lights', '', '4/22, Rutland Gate 4th St, Srirampuram, Thousand Lights West, Thousand Lights', '100051', '2019-03-01 13:42:03', 1639, 30, '4', ' asjdvasjdvcasj', 'asjdvs vsavhasdfvj safvasu vusavsuvsuadfh', '2019-03-01 13:45:51', '2019-03-01 08:15:51', '1', '192.168.1.7'),
(87, '49', '27', '', 'IOO0000000000000000000', NULL, NULL, 'No 23, 3rd Floor, Modern Tower, West Cott Road, Royapettah,', 'undefined', 'Ibrahim, West Cott Road, Royapettah,', '100052', '2019-03-01 13:46:47', 22, 162, '0', '151', '515151', '2019-03-01 13:46:47', '2019-03-01 08:16:47', '1', '192.168.1.7'),
(88, '49', '27', '', 'IOO0000000000000000000', NULL, NULL, 'No 23, 3rd Floor, Modern Tower, West Cott Road, Royapettah,', '', 'Ibrahim, West Cott Road, Royapettah,', '100052', '2019-03-01 13:46:47', 25, 165, '0', '151', '515151', '2019-03-01 13:47:04', '2019-03-01 08:17:04', '1', '192.168.1.7'),
(89, '49', '27', '', 'IOO0000000000000000000', NULL, NULL, 'No 23, 3rd Floor, Modern Tower, West Cott Road, Royapettah,', '', 'Ibrahim, West Cott Road, Royapettah,', '100052', '2019-03-01 13:46:47', 27, 219, '0', '151', '515151', '2019-03-01 13:47:18', '2019-03-01 08:17:18', '1', '192.168.1.7'),
(90, '49', '27', '', 'IOO0000000000000000000', NULL, NULL, 'No 23, 3rd Floor, Modern Tower, West Cott Road, Royapettah,', '', 'Ibrahim, West Cott Road, Royapettah,', '100052', '2019-03-01 13:46:47', 60, 222, '0', '151', '515151', '2019-03-01 13:47:39', '2019-03-01 08:17:39', '1', '192.168.1.7'),
(91, '50', '23', 'ten', '2316654231132163', NULL, NULL, 'No.37, Opp Swagat Hotel, Royapetteh High Road,Chennai,TN-000000', '9', '4/22, Rutland Gate 4th St, Srirampuram, Thousand Lights West, Thousand Lights,Chennai,TN,000000', '100053', '2019-03-02 11:29:58', 305, 3500, '2', 'asjvjasdfv sadvl aslv asvasiydv asiodvasdvis', 'i wefaoofgvovwow  wqgig fowqvoqwvwvw gvov wsgvio', '2019-03-02 11:29:58', '2019-03-02 05:59:58', '1', '192.168.1.25'),
(92, '51', '23', 'ten', '2316654231132163', NULL, NULL, 'No.37, Opp Swagat Hotel, Royapetteh High Road,Chennai,TN-000000', '9', '4/22, Rutland Gate 4th St, Srirampuram, Thousand Lights West, Thousand Lights,Chennai,TN,000000', 'DL-2019-100054', '2019-03-02 14:45:42', 151, 151, '1', 'sd fj', 'hidx', '2019-03-02 14:45:42', '2019-03-02 09:15:42', '1', '192.168.1.25'),
(93, '52', '23', '', '2316654231132163', NULL, NULL, 'No.37, Opp Swagat Hotel, Royapetteh High Road', 'undefined', '4/22, Rutland Gate 4th St, Srirampuram, Thousand Lights West, Thousand Lights', 'DL-2019-0001', '2019-03-02 17:25:14', 4302, 165, '1', ' asdvcuasdu', ' asduicvasudvc cvasud vc', '2019-03-02 17:25:14', '2019-03-02 11:55:14', '4', '192.168.1.25');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_ref`
--

CREATE TABLE `delivery_ref` (
  `auto_id` bigint(20) NOT NULL,
  `delivery_id` varchar(255) DEFAULT NULL,
  `bill_number` varchar(255) DEFAULT NULL,
  `bill_date` datetime DEFAULT NULL,
  `description` text,
  `qty` float DEFAULT NULL,
  `hsn` varchar(255) DEFAULT NULL,
  `gst_rate` varchar(255) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `c_date` datetime DEFAULT NULL,
  `u_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` varchar(255) DEFAULT NULL,
  `ipaddress` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_ref`
--

INSERT INTO `delivery_ref` (`auto_id`, `delivery_id`, `bill_number`, `bill_date`, `description`, `qty`, `hsn`, `gst_rate`, `amount`, `c_date`, `u_date`, `user_id`, `ipaddress`) VALUES
(5, '1', '100004', '2019-02-16 17:26:43', 'test', 1, '1', '1', 1, '2019-02-16 18:21:50', '2019-02-16 12:51:50', '1', '192.168.1.29'),
(6, '1', '100004', '2019-02-16 17:26:43', 'test 2 ', 2, '2', '5', 2, '2019-02-16 18:21:50', '2019-02-16 12:51:50', '1', '192.168.1.29'),
(7, '2', '100005', '2019-02-18 15:13:36', 'dnkl dkjfnv ijdfv idjf idfv ikdfi', 2, '123', '1', 200, '2019-02-18 15:13:36', '2019-02-18 09:43:36', '1', '192.168.1.15'),
(8, '2', '100005', '2019-02-18 15:13:36', '221 asc casd cascs', 3, '124', '2', 500, '2019-02-18 15:13:36', '2019-02-18 09:43:36', '1', '192.168.1.15'),
(9, '2', '100005', '2019-02-18 15:13:36', 'wsaf sdvs vdvvasdv sdv vds', 4, '125', '3', 600, '2019-02-18 15:13:36', '2019-02-18 09:43:36', '1', '192.168.1.15'),
(10, '2', '100005', '2019-02-18 15:13:36', 'dsfvb fbsdb reg betb beaerg', 5, '162', '4', 600, '2019-02-18 15:13:36', '2019-02-18 09:43:36', '1', '192.168.1.15'),
(11, '2', '100005', '2019-02-18 15:13:36', 'safdv sadcvw wrqfe jytj', 5, '123', '5', 700, '2019-02-18 15:13:36', '2019-02-18 09:43:36', '1', '192.168.1.15'),
(12, '3', '100006', '2019-02-19 17:05:41', 'test', 2, '123', '4', 1000, '2019-02-19 17:05:41', '2019-02-19 11:35:41', '1', '192.168.1.30'),
(13, '3', '100006', '2019-02-19 17:05:41', 'test1', 2, '123', '4', 2000, '2019-02-19 17:05:41', '2019-02-19 11:35:41', '1', '192.168.1.30'),
(21, '5', '100008', '0000-00-00 00:00:00', 'asdvlmas', 22, '22', '1', 50, '2019-02-20 19:31:25', '2019-02-20 14:01:25', '1', '192.168.1.15'),
(22, '5', '100008', '0000-00-00 00:00:00', 'dkfv sdfv dfilvd ilv dbvo sdi vsdivsd asdfjvnadsvibas iofvasdovzxc vasihobv ', 500, '50', '4', 50, '2019-02-20 19:31:25', '2019-02-20 14:01:25', '1', '192.168.1.15'),
(23, '5', '100008', '0000-00-00 00:00:00', 'sdflv sddo;fksdkl;v sdlsduojq', 500, '50', '4', 544, '2019-02-20 19:31:25', '2019-02-20 14:01:25', '1', '192.168.1.15'),
(24, '4', '100007', '0000-00-00 00:00:00', 'sdvl ;sasodv nasopdvn aspdovnasvaspdvnoas dpvasvop asvnasop', 520, '5415', '3', 21, '2019-02-20 19:32:44', '2019-02-20 14:02:44', '1', '192.168.1.15'),
(25, '4', '100007', '0000-00-00 00:00:00', ' dfvl;ksdfp fopbsdfnbpsdofbnsd[bpjsd bmsd sdpbihosd', 52, '2621', '4', 6363, '2019-02-20 19:32:44', '2019-02-20 14:02:44', '1', '192.168.1.15'),
(26, '4', '100007', '0000-00-00 00:00:00', 'dlbdld d;v dobsdb;sdbsdopkj', 60, '63', '4', 2, '2019-02-20 19:32:44', '2019-02-20 14:02:44', '1', '192.168.1.15'),
(27, '6', '100009', '2019-02-22 15:37:23', 'asdc sadnv asnd vasnvas;l vasndlvasdovnasodv asndvasdpnvo asopvnaspdvn npavsno vnasdnv asdvo naspvnasdvasovnasdfopv opasvnp vasnpdv asn dvasdvasnd voaspdvn asopvnasonvasdopv nasdpvn asn aspodv asdopv oas vpasodv', 50, '121', '1', 1500, '2019-02-22 15:37:23', '2019-02-22 10:07:23', '1', '192.168.1.15'),
(28, '6', '100009', '2019-02-22 15:37:23', 'asdv asdvsdbvas ab svsbdv asblv asdvasvi savsa vasdv av saivbhasio vabsovasbdvsio', 500, '50', '1', 15000, '2019-02-22 15:37:23', '2019-02-22 10:07:23', '1', '192.168.1.15'),
(29, '6', '100009', '2019-02-22 15:37:23', 'sdfkjv adfsvdbfvbdfv fpv asdfjvp asfvpasdfvpasvaspv jasdvpasdvp asdvj aspdvasj dvas dvasdvpjasvas vpaspvasdvp asv sapvasv asdvj ioasvasjp vasdiovjp as dvasiopvasiop vasvasjiopbsp vasb dvasiojdv asdio vjioasbdjiov asbdiopv asdviopasdbvj pvjio asbv', 50, '1520', '4', 1500, '2019-02-22 15:37:23', '2019-02-22 10:07:23', '1', '192.168.1.15'),
(30, '7', '100010', '2019-02-22 15:37:46', 'asdc sadnv asnd vasnvas;l vasndlvasdovnasodv asndvasdpnvo asopvnaspdvn npavsno vnasdnv asdvo naspvnasdvasovnasdfopv opasvnp vasnpdv asn dvasdvasnd voaspdvn asopvnasonvasdopv nasdpvn asn aspodv asdopv oas vpasodv', 50, '121', '1', 1500, '2019-02-22 15:37:46', '2019-02-22 10:07:46', '1', '192.168.1.15'),
(31, '7', '100010', '2019-02-22 15:37:46', 'asdv asdvsdbvas ab svsbdv asblv asdvasvi savsa vasdv av saivbhasio vabsovasbdvsio', 500, '50', '1', 15000, '2019-02-22 15:37:46', '2019-02-22 10:07:46', '1', '192.168.1.15'),
(32, '7', '100010', '2019-02-22 15:37:46', 'sdfkjv adfsvdbfvbdfv fpv asdfjvp asfvpasdfvpasvaspv jasdvpasdvp asdvj aspdvasj dvas dvasdvpjasvas vpaspvasdvp asv sapvasv asdvj ioasvasjp vasdiovjp as dvasiopvasiop vasvasjiopbsp vasb dvasiojdv asdio vjioasbdjiov asbdiopv asdviopasdbvj pvjio asbv', 50, '1520', '4', 1500, '2019-02-22 15:37:46', '2019-02-22 10:07:46', '1', '192.168.1.15'),
(33, '7', '100010', '2019-02-22 15:37:46', 'sdc sadncv asdcnasdcp asdcasp dcasp asdcaspdo casdncpoasdc asndpc', 50, '50', '4', 50, '2019-02-22 15:37:46', '2019-02-22 10:07:46', '1', '192.168.1.15'),
(34, '8', '100011', '2019-02-22 15:42:42', 'asdv sdb asdlc asdlbvas bd', 1, '1', '1', 1, '2019-02-22 15:42:42', '2019-02-22 10:12:42', '1', '192.168.1.15'),
(35, '9', '100012', '2019-02-22 15:45:22', 'asdklv savasb asdvjasbdlv asdbv asdbv asdhuv asdu', 100, '10', '3', 100, '2019-02-22 15:45:22', '2019-02-22 10:15:22', '1', '192.168.1.15'),
(36, '10', '100013', '2019-02-22 15:49:39', 'asdklcv asld cbvasd', 11, '1', '3', 1, '2019-02-22 15:49:39', '2019-02-22 10:19:39', '1', '192.168.1.15'),
(37, '11', '100014', '2019-02-22 15:50:37', 'zxdfv dfvdj fvnasdfv asdfpovb asdb', 1, '1', '3', 1, '2019-02-22 15:50:37', '2019-02-22 10:20:37', '1', '192.168.1.15'),
(38, '11', '100014', '2019-02-22 15:50:38', 'ascb asbc ai', 1, '11', '3', 1, '2019-02-22 15:50:38', '2019-02-22 10:20:38', '1', '192.168.1.15'),
(39, '11', '100014', '2019-02-22 15:50:38', 'sduoibh sdofsdfio', 11, '11', '3', 1500, '2019-02-22 15:50:38', '2019-02-22 10:20:38', '1', '192.168.1.15'),
(40, '12', '100015', '2019-02-22 15:53:00', '131', 1321, '13212', '3', 13212, '2019-02-22 15:53:00', '2019-02-22 10:23:00', '1', '192.168.1.15'),
(41, '12', '100015', '2019-02-22 15:53:00', '16161', 561, '61561', '1', 16, '2019-02-22 15:53:00', '2019-02-22 10:23:00', '1', '192.168.1.15'),
(42, '12', '100015', '2019-02-22 15:53:00', 'zsjkv sdfvasdfv iasdbv asvasbdvoibasdvasio dvoasvbiasdlvbas odivuas', 151, '51', '3', 1510, '2019-02-22 15:53:00', '2019-02-22 10:23:00', '1', '192.168.1.15'),
(43, '13', '100016', '2019-02-22 15:53:24', 'asdbckabb', 1, '1', '3', 1, '2019-02-22 15:53:24', '2019-02-22 10:23:24', '1', '192.168.1.15'),
(44, '14', '100017', '2019-02-22 15:54:14', 'asdbckabb', 1, '1', '3', 1, '2019-02-22 15:54:14', '2019-02-22 10:24:14', '1', '192.168.1.15'),
(45, '14', '100017', '2019-02-22 15:54:14', 'asdc nasdcnasd;asd;vnasdvn sdvnsadlvn asdnlvasdvl; asndv asopvnasopvn;asdv', 121, '121', '3', 121, '2019-02-22 15:54:14', '2019-02-22 10:24:14', '1', '192.168.1.15'),
(46, '14', '100017', '2019-02-22 15:54:14', 'df vsfaivasdfviboas dvodivasodivasodvasodbaasvbas asiv asido dvo', 151, '151', '10', 151, '2019-02-22 15:54:14', '2019-02-22 10:24:14', '1', '192.168.1.15'),
(47, '14', '100017', '2019-02-22 15:54:14', 'asvh asidhv awovuwio fhowiauvwbodvw obv awdbv8i', 151, '5151', '10', 115, '2019-02-22 15:54:14', '2019-02-22 10:24:14', '1', '192.168.1.15'),
(48, '15', '100018', '2019-02-22 15:57:51', 'asdcjk ', 1, '1', '3', 1, '2019-02-22 15:57:51', '2019-02-22 10:27:51', '1', '192.168.1.15'),
(49, '15', '100018', '2019-02-22 15:57:52', '2', 2, '2', '3', 2, '2019-02-22 15:57:52', '2019-02-22 10:27:52', '1', '192.168.1.15'),
(50, '16', '100019', '2019-02-22 15:59:15', 'asdcjk ', 1, '1', '3', 1, '2019-02-22 15:59:15', '2019-02-22 10:29:15', '1', '192.168.1.15'),
(51, '16', '100019', '2019-02-22 15:59:15', '2', 2, '2', '3', 2, '2019-02-22 15:59:15', '2019-02-22 10:29:15', '1', '192.168.1.15'),
(52, '16', '100019', '2019-02-22 15:59:15', 'sjkadbc', 15, '15', '10', 15, '2019-02-22 15:59:15', '2019-02-22 10:29:15', '1', '192.168.1.15'),
(98, '17', '100020', '0000-00-00 00:00:00', 'sdfbkl sdfb dfvbdfklvbsd fbsdfivbsd fsdfvbsdfov sdiofv', 1511, '15', '1', 510, '2019-02-22 16:18:33', '2019-02-22 10:48:33', '1', '192.168.1.15'),
(99, '17', '100020', '0000-00-00 00:00:00', 'asdvaslidvbas id va aiwvu asoidvasopd vasdcvasd', 150, '150', '3', 150, '2019-02-22 16:18:33', '2019-02-22 10:48:33', '1', '192.168.1.15'),
(100, '17', '100020', '0000-00-00 00:00:00', 'a sdcasdcasdkcasdkncasdklcnasdkcn asdkc asdlbasdiovasd', 11, '1', '4', 11, '2019-02-22 16:18:33', '2019-02-22 10:48:33', '1', '192.168.1.15'),
(101, '17', '100020', '0000-00-00 00:00:00', 'sdv sadvaskdvl ', 11, '11', '3', 2121, '2019-02-22 16:18:33', '2019-02-22 10:48:33', '1', '192.168.1.15'),
(102, '17', '100020', '0000-00-00 00:00:00', 'asda as aacas asxc asdobs dibasidobsdiocbio asdib asidbv as', 411, '11', '10', 1511, '2019-02-22 16:18:33', '2019-02-22 10:48:33', '1', '192.168.1.15'),
(103, '17', '100020', '0000-00-00 00:00:00', '1', 1, '1', '3', 1, '2019-02-22 16:18:33', '2019-02-22 10:48:33', '1', '192.168.1.15'),
(104, '17', '100020', '0000-00-00 00:00:00', 'asdc', 151, '161', '3', 16, '2019-02-22 16:18:33', '2019-02-22 10:48:33', '1', '192.168.1.15'),
(105, '17', '100020', '0000-00-00 00:00:00', 'asda', 15, '115', '10', 15, '2019-02-22 16:18:33', '2019-02-22 10:48:33', '1', '192.168.1.15'),
(107, '18', '100021', '0000-00-00 00:00:00', 'sadvj asdvasdobvasbdv asdbvasdbv asldvbi asodibdodvasb dvasvbo asbdvas', 151, '151', '3', 15, '2019-02-22 16:19:47', '2019-02-22 10:49:47', '1', '192.168.1.15'),
(108, '19', '100022', '2019-02-26 12:11:06', 'a sdjv sjvasjvbasdjvsdjvbsdj', 150, '150', '1', 150, '2019-02-26 12:11:06', '2019-02-26 06:41:06', '1', '192.168.1.20'),
(109, '19', '100022', '2019-02-26 12:11:06', ' asv asjv sdvsjdvbsajkdvbasjv sajv sidvbsui ', 1500, '1500', '10', 1500, '2019-02-26 12:11:06', '2019-02-26 06:41:06', '1', '192.168.1.20'),
(140, '20', '100023', '0000-00-00 00:00:00', '151', 151, '151', '3', 151, '2019-02-26 13:38:14', '2019-02-26 08:08:14', '1', '192.168.1.20'),
(141, '20', '100023', '0000-00-00 00:00:00', '161', 131, '321', '4', 2123, '2019-02-26 13:38:14', '2019-02-26 08:08:14', '1', '192.168.1.20'),
(142, '21', '100024', '2019-02-27 20:00:25', 'test', 1, '', '3', 0, '2019-02-27 20:00:25', '2019-02-27 14:30:25', '1', '192.168.1.62'),
(143, '21', '100024', '2019-02-27 20:00:25', '2222222222222', 2, '', '3', 0, '2019-02-27 20:00:25', '2019-02-27 14:30:25', '1', '192.168.1.62'),
(144, '21', '100024', '2019-02-27 20:00:25', '3333333333333333333', 3, '', '3', 0, '2019-02-27 20:00:25', '2019-02-27 14:30:25', '1', '192.168.1.62'),
(145, '21', '100024', '2019-02-27 20:00:25', '444444444444444444444', 4, '', '3', 0, '2019-02-27 20:00:25', '2019-02-27 14:30:25', '1', '192.168.1.62'),
(146, '21', '100024', '2019-02-27 20:00:25', '55555555555555555555555', 5, '', '3', 0, '2019-02-27 20:00:25', '2019-02-27 14:30:25', '1', '192.168.1.62'),
(147, '21', '100024', '2019-02-27 20:00:25', '6666666666666666666', 6, '', '3', 0, '2019-02-27 20:00:25', '2019-02-27 14:30:25', '1', '192.168.1.62'),
(148, '21', '100024', '2019-02-27 20:00:25', '77777777777777777777777777777', 7, '', '3', 0, '2019-02-27 20:00:25', '2019-02-27 14:30:25', '1', '192.168.1.62'),
(149, '21', '100024', '2019-02-27 20:00:25', '3333333333333333333333333333', 3, '', '3', 0, '2019-02-27 20:00:25', '2019-02-27 14:30:25', '1', '192.168.1.62'),
(150, '21', '100024', '2019-02-27 20:00:25', '454545454545454', 4, '', '3', 0, '2019-02-27 20:00:25', '2019-02-27 14:30:25', '1', '192.168.1.62'),
(151, '21', '100024', '2019-02-27 20:00:26', '898989898998989898', 8, '', '3', 0, '2019-02-27 20:00:26', '2019-02-27 14:30:26', '1', '192.168.1.62'),
(152, '21', '100024', '2019-02-27 20:00:26', '13131313131313131313131', 1, '', '3', 0, '2019-02-27 20:00:26', '2019-02-27 14:30:26', '1', '192.168.1.62'),
(153, '22', '100025', '2019-02-28 18:00:29', 'Envelop', 300, '', '3', 0, '2019-02-28 18:00:29', '2019-02-28 12:30:29', '1', '192.168.1.3'),
(154, '22', '100025', '2019-02-28 18:00:29', 'Business Cards', 500, '', '3', 0, '2019-02-28 18:00:29', '2019-02-28 12:30:29', '1', '192.168.1.3'),
(155, '22', '100025', '2019-02-28 18:00:29', 'Letter pad', 70, '', '3', 0, '2019-02-28 18:00:29', '2019-02-28 12:30:29', '1', '192.168.1.3'),
(156, '23', '100026', '2019-02-28 18:23:16', '151', 1, '151', '1', 15, '2019-02-28 18:23:16', '2019-02-28 12:53:16', '1', '192.168.1.7'),
(157, '24', '100027', '2019-02-28 18:43:08', 'vjg', 15, '151', '1', 22, '2019-02-28 18:43:08', '2019-02-28 13:13:08', '1', '192.168.1.7'),
(158, '24', '100027', '2019-02-28 18:43:09', '165', 11651, '6511', '1', 25, '2019-02-28 18:43:09', '2019-02-28 13:13:09', '1', '192.168.1.7'),
(159, '25', '100028', '2019-02-28 18:45:00', 'vjg', 5, '5', '1', 5, '2019-02-28 18:45:00', '2019-02-28 13:15:00', '1', '192.168.1.7'),
(160, '25', '100028', '2019-02-28 18:45:00', '5', 5, '5', '3', 5, '2019-02-28 18:45:00', '2019-02-28 13:15:00', '1', '192.168.1.7'),
(161, '26', '100029', '2019-02-28 19:19:18', 'vjg', NULL, '', '1', 1, '2019-02-28 19:19:18', '2019-02-28 13:49:18', '1', '192.168.1.3'),
(162, '26', '100029', '2019-02-28 19:19:18', 'test', 3, '', '3', 0, '2019-02-28 19:19:18', '2019-02-28 13:49:18', '1', '192.168.1.3'),
(163, '26', '100029', '2019-02-28 19:19:18', 'test', 99, '', '3', 0, '2019-02-28 19:19:18', '2019-02-28 13:49:18', '1', '192.168.1.3'),
(164, '27', '100030', '2019-02-28 20:23:15', 'vjg', 15, '', '10', 1, '2019-02-28 20:23:15', '2019-02-28 14:53:15', '1', '192.168.1.7'),
(165, '27', '100030', '2019-02-28 20:23:15', 'test', 3, '', '3', 0, '2019-02-28 20:23:15', '2019-02-28 14:53:15', '1', '192.168.1.7'),
(166, '27', '100030', '2019-02-28 20:23:15', 'test', 99, '', '3', 0, '2019-02-28 20:23:15', '2019-02-28 14:53:15', '1', '192.168.1.7'),
(167, '27', '100030', '2019-02-28 20:23:15', '151', 151, '151', '', 151, '2019-02-28 20:23:15', '2019-02-28 14:53:15', '1', '192.168.1.7'),
(168, '28', '100031', '2019-02-28 20:31:18', 'vjg', 15, '', '10', 1, '2019-02-28 20:31:18', '2019-02-28 15:01:18', '1', '192.168.1.7'),
(169, '28', '100031', '2019-02-28 20:31:18', 'test', 3, '', '3', 0, '2019-02-28 20:31:18', '2019-02-28 15:01:18', '1', '192.168.1.7'),
(170, '28', '100031', '2019-02-28 20:31:18', 'test', 99, '', '3', 0, '2019-02-28 20:31:18', '2019-02-28 15:01:18', '1', '192.168.1.7'),
(171, '28', '100031', '2019-02-28 20:31:18', '151', 151, '151', '', 151, '2019-02-28 20:31:18', '2019-02-28 15:01:18', '1', '192.168.1.7'),
(172, '29', '100032', '2019-02-28 20:40:45', 'vjg', 15, '', '10', 1, '2019-02-28 20:40:45', '2019-02-28 15:10:45', '1', '192.168.1.7'),
(173, '29', '100032', '2019-02-28 20:40:45', 'test', 3, '', '3', 0, '2019-02-28 20:40:45', '2019-02-28 15:10:45', '1', '192.168.1.7'),
(174, '29', '100032', '2019-02-28 20:40:46', 'test', 99, '', '3', 0, '2019-02-28 20:40:46', '2019-02-28 15:10:46', '1', '192.168.1.7'),
(175, '29', '100032', '2019-02-28 20:40:46', '151', 151, '151', '3', 151, '2019-02-28 20:40:46', '2019-02-28 15:10:46', '1', '192.168.1.7'),
(176, '30', '100033', '2019-02-28 20:41:35', 'vjg', 15, '', '10', 1, '2019-02-28 20:41:35', '2019-02-28 15:11:35', '1', '192.168.1.7'),
(177, '30', '100033', '2019-02-28 20:41:35', 'test', 3, '', '3', 0, '2019-02-28 20:41:35', '2019-02-28 15:11:35', '1', '192.168.1.7'),
(178, '30', '100033', '2019-02-28 20:41:35', 'test', 99, '', '3', 0, '2019-02-28 20:41:35', '2019-02-28 15:11:35', '1', '192.168.1.7'),
(179, '30', '100033', '2019-02-28 20:41:35', '151', 151, '151', '3', 151, '2019-02-28 20:41:35', '2019-02-28 15:11:35', '1', '192.168.1.7'),
(180, '30', '100033', '2019-02-28 20:41:35', 'cghcghc', 1, '1', '3', 150, '2019-02-28 20:41:35', '2019-02-28 15:11:35', '1', '192.168.1.7'),
(181, '31', '100034', '2019-02-28 20:45:24', '300 Envelop', 1851, '51', '3', 3000, '2019-02-28 20:45:24', '2019-02-28 15:15:24', '1', '192.168.1.7'),
(182, '31', '100034', '2019-02-28 20:45:24', '500 Business Cards', 151, '5151', '3', 2500, '2019-02-28 20:45:24', '2019-02-28 15:15:24', '1', '192.168.1.7'),
(183, '32', '100035', '2019-02-28 20:45:54', '300 Envelop', 1851, '51', '3', 3000, '2019-02-28 20:45:54', '2019-02-28 15:15:54', '1', '192.168.1.7'),
(184, '32', '100035', '2019-02-28 20:45:54', '500 Business Cards', 151, '5151', '3', 2500, '2019-02-28 20:45:54', '2019-02-28 15:15:54', '1', '192.168.1.7'),
(185, '32', '100035', '2019-02-28 20:45:54', 'testert', 1, '1', '3', 2626, '2019-02-28 20:45:54', '2019-02-28 15:15:54', '1', '192.168.1.7'),
(189, '33', '100036', '2019-02-28 20:46:13', '300 Envelop', 1851, '51', '3', 3000, '2019-02-28 20:46:31', '2019-02-28 15:16:31', '1', '192.168.1.7'),
(190, '33', '100036', '2019-02-28 20:46:13', '500 Business Cards', 151, '5151', '3', 2500, '2019-02-28 20:46:32', '2019-02-28 15:16:32', '1', '192.168.1.7'),
(191, '33', '100036', '2019-02-28 20:46:13', 'testert', 1, '1', '3', 2626, '2019-02-28 20:46:32', '2019-02-28 15:16:32', '1', '192.168.1.7'),
(192, '34', '100037', '2019-02-28 20:48:08', '300 Envelop', 1851, '51', '3', 3000, '2019-02-28 20:48:08', '2019-02-28 15:18:08', '1', '192.168.1.7'),
(193, '34', '100037', '2019-02-28 20:48:08', '500 Business Cards', 151, '5151', '3', 2500, '2019-02-28 20:48:08', '2019-02-28 15:18:08', '1', '192.168.1.7'),
(194, '34', '100037', '2019-02-28 20:48:08', 'testert', 1, '1', '3', 2626, '2019-02-28 20:48:08', '2019-02-28 15:18:08', '1', '192.168.1.7'),
(195, '34', '100037', '2019-02-28 20:48:08', 'sajdc', 41, '', '3', 15, '2019-02-28 20:48:08', '2019-02-28 15:18:08', '1', '192.168.1.7'),
(196, '35', '100038', '2019-02-28 20:49:17', 'dk d vasdklbv kdv abdklv bdklvb', 1, '', '1', 1500, '2019-02-28 20:49:17', '2019-02-28 15:19:17', '1', '192.168.1.7'),
(197, '35', '100038', '2019-02-28 20:49:17', 'sdbd dafv asdkfv askfvaskfvbas kfv ', 1, '', '1', 1500, '2019-02-28 20:49:17', '2019-02-28 15:19:17', '1', '192.168.1.7'),
(198, '35', '100038', '2019-02-28 20:49:18', 'svks ldv', 1, '', '1', 500, '2019-02-28 20:49:18', '2019-02-28 15:19:18', '1', '192.168.1.7'),
(199, '35', '100038', '2019-02-28 20:49:18', ' sdkvs', 1, '', '1', 500, '2019-02-28 20:49:18', '2019-02-28 15:19:18', '1', '192.168.1.7'),
(200, '35', '100038', '2019-02-28 20:49:18', 'asdf,v', NULL, '515', '1', 15, '2019-02-28 20:49:18', '2019-02-28 15:19:18', '1', '192.168.1.7'),
(201, '36', '100039', '2019-02-28 20:54:08', 'test', 1, '2', '3', 111, '2019-02-28 20:54:08', '2019-02-28 15:24:08', '1', '192.168.1.7'),
(202, '36', '100039', '2019-02-28 20:54:08', 'test', 23, '12', '3', 111, '2019-02-28 20:54:08', '2019-02-28 15:24:08', '1', '192.168.1.7'),
(203, '36', '100039', '2019-02-28 20:54:09', 'test', 121, '2', '3', 111, '2019-02-28 20:54:09', '2019-02-28 15:24:09', '1', '192.168.1.7'),
(204, '36', '100039', '2019-02-28 20:54:09', 'sdahcj', 15, '151', '3', 151, '2019-02-28 20:54:09', '2019-02-28 15:24:09', '1', '192.168.1.7'),
(205, '37', '100040', '2019-02-28 20:54:31', '1', 121, '121', '3', 121, '2019-02-28 20:54:31', '2019-02-28 15:24:31', '1', '192.168.1.7'),
(206, '37', '100040', '2019-02-28 20:54:31', '2', 121, '2', '3', 1, '2019-02-28 20:54:31', '2019-02-28 15:24:31', '1', '192.168.1.7'),
(207, '38', '100041', '2019-02-28 20:55:24', '1', 121, '121', '3', 121, '2019-02-28 20:55:24', '2019-02-28 15:25:24', '1', '192.168.1.7'),
(208, '38', '100041', '2019-02-28 20:55:24', '2', 121, '2', '3', 1, '2019-02-28 20:55:24', '2019-02-28 15:25:24', '1', '192.168.1.7'),
(209, '38', '100041', '2019-02-28 20:55:24', 'asd', 12, '151', '10', 15, '2019-02-28 20:55:24', '2019-02-28 15:25:24', '1', '192.168.1.7'),
(210, '38', '100041', '2019-02-28 20:55:25', 'as dvjka', 15, '115', '10', 151, '2019-02-28 20:55:25', '2019-02-28 15:25:25', '1', '192.168.1.7'),
(211, '39', '100042', '2019-02-28 20:56:06', '1', 151, '151', '1', 1, '2019-02-28 20:56:06', '2019-02-28 15:26:06', '1', '192.168.1.7'),
(212, '39', '100042', '2019-02-28 20:56:06', 'dfkj', 151, '15', '10', 15, '2019-02-28 20:56:06', '2019-02-28 15:26:06', '1', '192.168.1.7'),
(213, '40', '100043', '2019-02-28 20:58:49', 'vjg', 15, '', '10', 1, '2019-02-28 20:58:49', '2019-02-28 15:28:49', '1', '192.168.1.7'),
(214, '40', '100043', '2019-02-28 20:58:49', 'test', 3, '', '3', 0, '2019-02-28 20:58:49', '2019-02-28 15:28:49', '1', '192.168.1.7'),
(215, '40', '100043', '2019-02-28 20:58:49', 'test', 99, '', '3', 0, '2019-02-28 20:58:49', '2019-02-28 15:28:49', '1', '192.168.1.7'),
(216, '40', '100043', '2019-02-28 20:58:50', '151', 151, '151', '3', 151, '2019-02-28 20:58:50', '2019-02-28 15:28:50', '1', '192.168.1.7'),
(217, '40', '100043', '2019-02-28 20:58:50', 'cghcghc', 1, '1', '3', 150, '2019-02-28 20:58:50', '2019-02-28 15:28:50', '1', '192.168.1.7'),
(219, '41', '100044', '2019-02-28 21:00:36', 'asd jkv', 151, '', '1', 1541, '2019-02-28 21:01:08', '2019-02-28 15:31:08', '1', '192.168.1.7'),
(220, '41', '100044', '2019-02-28 21:00:36', 'asdfjvaj', 415, '15', '3', 15, '2019-02-28 21:01:08', '2019-02-28 15:31:08', '1', '192.168.1.7'),
(226, '42', '100045', '2019-03-01 13:05:47', 'TEST 10', 1, '11', '3', 1, '2019-03-01 13:07:15', '2019-03-01 07:37:15', '1', '192.168.1.7'),
(227, '42', '100045', '2019-03-01 13:05:47', 'TEST 9', 1, '12', '3', 12, '2019-03-01 13:07:15', '2019-03-01 07:37:15', '1', '192.168.1.7'),
(228, '42', '100045', '2019-03-01 13:05:47', 'TEST 8', 1, '13', '3', 121, '2019-03-01 13:07:15', '2019-03-01 07:37:15', '1', '192.168.1.7'),
(229, '42', '100045', '2019-03-01 13:05:47', 'TEST 7', 1, '14', '3', 262, '2019-03-01 13:07:15', '2019-03-01 07:37:15', '1', '192.168.1.7'),
(230, '42', '100045', '2019-03-01 13:05:47', 'test 6', 1, '15', '1', 1551, '2019-03-01 13:07:16', '2019-03-01 07:37:16', '1', '192.168.1.7'),
(231, '42', '100045', '2019-03-01 13:05:47', 'ttt 11', 11, '22', '3', 11, '2019-03-01 13:07:16', '2019-03-01 07:37:16', '1', '192.168.1.7'),
(241, '43', '100046', '2019-03-01 13:08:21', ' asjd casvjdcvas dcasvjdkcv', 11, '151', '4', 1, '2019-03-01 13:10:08', '2019-03-01 07:40:08', '1', '192.168.1.7'),
(242, '43', '100046', '2019-03-01 13:08:21', 'ashavxasxv asxab', 1511, '15', '10', 15, '2019-03-01 13:10:08', '2019-03-01 07:40:08', '1', '192.168.1.7'),
(243, '43', '100046', '2019-03-01 13:08:21', 'sd jkcvs', 1515, '151', '10', 151, '2019-03-01 13:10:08', '2019-03-01 07:40:08', '1', '192.168.1.7'),
(244, '43', '100046', '2019-03-01 13:08:21', 'teser', 11, '11', '4', 121, '2019-03-01 13:10:08', '2019-03-01 07:40:08', '1', '192.168.1.7'),
(245, '44', '100047', '2019-03-01 13:32:45', '4', 1, '', '4', 1, '2019-03-01 13:32:45', '2019-03-01 08:02:45', '1', '192.168.1.7'),
(246, '44', '100047', '2019-03-01 13:32:45', '4', 2, '', '4', 2, '2019-03-01 13:32:45', '2019-03-01 08:02:45', '1', '192.168.1.7'),
(247, '44', '100047', '2019-03-01 13:32:45', '5', 3, '', '4', 5, '2019-03-01 13:32:45', '2019-03-01 08:02:45', '1', '192.168.1.7'),
(248, '44', '100047', '2019-03-01 13:32:45', '6', 6, '6', '4', 6, '2019-03-01 13:32:45', '2019-03-01 08:02:45', '1', '192.168.1.7'),
(249, '45', '100048', '2019-03-01 13:33:40', '4', 1, '', '4', 1, '2019-03-01 13:33:40', '2019-03-01 08:03:40', '1', '192.168.1.7'),
(250, '45', '100048', '2019-03-01 13:33:40', '4', 2, '', '4', 2, '2019-03-01 13:33:40', '2019-03-01 08:03:40', '1', '192.168.1.7'),
(251, '45', '100048', '2019-03-01 13:33:40', '5', 3, '', '4', 5, '2019-03-01 13:33:40', '2019-03-01 08:03:40', '1', '192.168.1.7'),
(252, '45', '100048', '2019-03-01 13:33:40', '6', 6, '6', '4', 6, '2019-03-01 13:33:40', '2019-03-01 08:03:40', '1', '192.168.1.7'),
(257, '46', '100049', '2019-03-01 13:37:47', '4', 1, '2', '4', 1, '2019-03-01 13:38:08', '2019-03-01 08:08:08', '1', '192.168.1.7'),
(258, '46', '100049', '2019-03-01 13:37:47', '4', 2, '2', '4', 2, '2019-03-01 13:38:08', '2019-03-01 08:08:08', '1', '192.168.1.7'),
(259, '47', '100050', '2019-03-01 13:40:21', '4', 1, '2', '4', 1, '2019-03-01 13:40:21', '2019-03-01 08:10:21', '1', '192.168.1.7'),
(260, '47', '100050', '2019-03-01 13:40:21', '4', 2, '2', '4', 2, '2019-03-01 13:40:21', '2019-03-01 08:10:21', '1', '192.168.1.7'),
(261, '47', '100050', '2019-03-01 13:40:21', '1112', 121, '121', '3', 12, '2019-03-01 13:40:21', '2019-03-01 08:10:21', '1', '192.168.1.7'),
(265, '48', '100051', '2019-03-01 13:42:03', '4', 1, '2', '4', 1, '2019-03-01 13:45:51', '2019-03-01 08:15:51', '1', '192.168.1.7'),
(266, '48', '100051', '2019-03-01 13:42:03', '4', 2, '2', '4', 2, '2019-03-01 13:45:51', '2019-03-01 08:15:51', '1', '192.168.1.7'),
(267, '48', '100051', '2019-03-01 13:42:03', '1112', 121, '121', '3', 12, '2019-03-01 13:45:51', '2019-03-01 08:15:51', '1', '192.168.1.7'),
(268, '48', '100051', '2019-03-01 13:42:03', '1151', 1515, '1151', '1', 15, '2019-03-01 13:45:52', '2019-03-01 08:15:51', '1', '192.168.1.7'),
(278, '49', '100052', '2019-03-01 13:46:47', '151', 11, '11', '1', 151, '2019-03-01 13:47:39', '2019-03-01 08:17:39', '1', '192.168.1.7'),
(279, '49', '100052', '2019-03-01 13:46:47', '11', 11, '11', '3', 11, '2019-03-01 13:47:39', '2019-03-01 08:17:39', '1', '192.168.1.7'),
(280, '49', '100052', '2019-03-01 13:46:47', '33', 3, '3', '1', 3, '2019-03-01 13:47:39', '2019-03-01 08:17:39', '1', '192.168.1.7'),
(281, '49', '100052', '2019-03-01 13:46:47', '22', 2, '2', '1', 54, '2019-03-01 13:47:39', '2019-03-01 08:17:39', '1', '192.168.1.7'),
(282, '49', '100052', '2019-03-01 13:46:47', '33', 33, '3', '1', 3, '2019-03-01 13:47:39', '2019-03-01 08:17:39', '1', '192.168.1.7'),
(283, '50', '100053', '2019-03-02 11:29:58', ' jsdfasdfv fb dafv dfvasdfkv vaklsdfv aksdlfv aklsdfv l', 150, '11111', '3', 1500, '2019-03-02 11:29:58', '2019-03-02 05:59:58', '1', '192.168.1.25'),
(284, '50', '100053', '2019-03-02 11:29:58', 'as jkdhasj dvasvashkl vslvslkfv saklfv asklfvbasklvbas kl vaskl vasbklj asvb skav asvbl svbs vbsvsaklvasklv asvb asklv askfvb asfvb skadfvb sfvbasklbv sak ', 155, '222222', '3', 2000, '2019-03-02 11:29:58', '2019-03-02 05:59:58', '1', '192.168.1.25'),
(285, '51', 'DL-2019-100054', '2019-03-02 14:45:42', 'd fjvbh', 151, '151', '10', 151, '2019-03-02 14:45:42', '2019-03-02 09:15:42', '1', '192.168.1.25'),
(286, '52', 'DL-2019-0001', '2019-03-02 17:25:14', ' dfv dkdl dkdbl', 4151, '151', '1', 150, '2019-03-02 17:25:14', '2019-03-02 11:55:14', '4', '192.168.1.25'),
(287, '52', 'DL-2019-0001', '2019-03-02 17:25:14', 'jvhsk', 151, '151', '3', 15, '2019-03-02 17:25:14', '2019-03-02 11:55:14', '4', '192.168.1.25');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_ref_log`
--

CREATE TABLE `delivery_ref_log` (
  `auto_id` bigint(20) NOT NULL,
  `delivery_id` varchar(255) DEFAULT NULL,
  `delivery_log_tbl_id` varchar(255) DEFAULT NULL,
  `delivery_ref_id` varchar(255) DEFAULT NULL,
  `bill_number` varchar(255) DEFAULT NULL,
  `bill_date` datetime DEFAULT NULL,
  `description` text,
  `qty` float DEFAULT NULL,
  `hsn` varchar(255) DEFAULT NULL,
  `gst_rate` varchar(255) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `c_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `u_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` varchar(255) DEFAULT NULL,
  `ipaddress` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_ref_log`
--

INSERT INTO `delivery_ref_log` (`auto_id`, `delivery_id`, `delivery_log_tbl_id`, `delivery_ref_id`, `bill_number`, `bill_date`, `description`, `qty`, `hsn`, `gst_rate`, `amount`, `c_date`, `u_date`, `user_id`, `ipaddress`) VALUES
(1, '1', '1', '1', '100004', '2019-02-16 17:26:43', 'gf sdvs sd', 1, '1', '1', 12, '2019-02-16 17:26:43', '2019-02-16 11:56:43', '1', '192.168.1.29'),
(2, '1', '1', '2', '100004', '2019-02-16 17:26:43', 'dsf sdfv vsdfa', 2, '1', '2', 13, '2019-02-16 17:26:43', '2019-02-16 11:56:43', '1', '192.168.1.29'),
(3, '1', '2', '3', '100004', '2019-02-16 17:26:43', 'test', 1, '1', '1', 1, '2019-02-16 17:28:06', '2019-02-16 11:58:06', '1', '192.168.1.29'),
(4, '1', '2', '4', '100004', '2019-02-16 17:26:43', 'test 2 ', 2, '2', '5', 2, '2019-02-16 17:28:06', '2019-02-16 11:58:06', '1', '192.168.1.29'),
(5, '1', '3', '5', '100004', '2019-02-16 17:26:43', 'test', 1, '1', '1', 1, '2019-02-16 18:21:50', '2019-02-16 12:51:50', '1', '192.168.1.29'),
(6, '1', '3', '6', '100004', '2019-02-16 17:26:43', 'test 2 ', 2, '2', '5', 2, '2019-02-16 18:21:50', '2019-02-16 12:51:50', '1', '192.168.1.29'),
(7, '2', '4', '7', '100005', '2019-02-18 15:13:36', 'dnkl dkjfnv ijdfv idjf idfv ikdfi', 2, '123', '1', 200, '2019-02-18 15:13:36', '2019-02-18 09:43:36', '1', '192.168.1.15'),
(8, '2', '4', '8', '100005', '2019-02-18 15:13:36', '221 asc casd cascs', 3, '124', '2', 500, '2019-02-18 15:13:36', '2019-02-18 09:43:36', '1', '192.168.1.15'),
(9, '2', '4', '9', '100005', '2019-02-18 15:13:36', 'wsaf sdvs vdvvasdv sdv vds', 4, '125', '3', 600, '2019-02-18 15:13:36', '2019-02-18 09:43:36', '1', '192.168.1.15'),
(10, '2', '4', '10', '100005', '2019-02-18 15:13:36', 'dsfvb fbsdb reg betb beaerg', 5, '162', '4', 600, '2019-02-18 15:13:36', '2019-02-18 09:43:36', '1', '192.168.1.15'),
(11, '2', '4', '11', '100005', '2019-02-18 15:13:36', 'safdv sadcvw wrqfe jytj', 5, '123', '5', 700, '2019-02-18 15:13:36', '2019-02-18 09:43:36', '1', '192.168.1.15'),
(12, '3', '5', '12', '100006', '2019-02-19 17:05:41', 'test', 2, '123', '4', 1000, '2019-02-19 17:05:41', '2019-02-19 11:35:41', '1', '192.168.1.30'),
(13, '3', '5', '13', '100006', '2019-02-19 17:05:42', 'test1', 2, '123', '4', 2000, '2019-02-19 17:05:42', '2019-02-19 11:35:42', '1', '192.168.1.30'),
(14, '4', '6', '14', '100007', '2019-02-20 19:05:09', 'asdv asopasdnvo asdnv asdvo;nasd', 20, '2020', '1', 200, '2019-02-20 19:05:09', '2019-02-20 13:35:09', '1', '192.168.1.15'),
(15, '4', '6', '15', '100007', '2019-02-20 19:05:09', 'sd f lv sdfv;nsdlfvn sdpfvn peofvn efnvpsoefvnwep v', 200, '2000', '3', 2300, '2019-02-20 19:05:09', '2019-02-20 13:35:09', '1', '192.168.1.15'),
(16, '4', '6', '16', '100007', '2019-02-20 19:05:09', ' dfvjsdvj sdpbsdob psdoibsdfpobnsfdgbop sfbnpwrbwr[gio', 20, '200', '3', 200, '2019-02-20 19:05:09', '2019-02-20 13:35:09', '1', '192.168.1.15'),
(17, '4', '6', '17', '100007', '2019-02-20 19:05:09', 'sdfvbsd  opsdbsdpgbo dfgnbp fdfpgbo dfbopsdf bperj9o', 250, '220', '4', 2500, '2019-02-20 19:05:09', '2019-02-20 13:35:09', '1', '192.168.1.15'),
(18, '4', '7', '18', '100007', '0000-00-00 00:00:00', '', 20, '2020', '1', 200, '2019-02-20 19:27:11', '2019-02-20 13:57:11', '1', '192.168.1.15'),
(19, '5', '8', '19', '100008', '2019-02-20 19:29:11', 'asdvlmas', 22, '22', '1', 50, '2019-02-20 19:29:11', '2019-02-20 13:59:11', '1', '192.168.1.15'),
(20, '5', '8', '20', '100008', '2019-02-20 19:29:11', 'dkfv sdfv dfilvd ilv dbvo sdi vsdivsd asdfjvnadsvibas iofvasdovzxc vasihobv ', 500, '50', '4', 50, '2019-02-20 19:29:11', '2019-02-20 13:59:11', '1', '192.168.1.15'),
(21, '5', '9', '21', '100008', '0000-00-00 00:00:00', 'asdvlmas', 22, '22', '1', 50, '2019-02-20 19:31:25', '2019-02-20 14:01:25', '1', '192.168.1.15'),
(22, '5', '9', '22', '100008', '0000-00-00 00:00:00', 'dkfv sdfv dfilvd ilv dbvo sdi vsdivsd asdfjvnadsvibas iofvasdovzxc vasihobv ', 500, '50', '4', 50, '2019-02-20 19:31:25', '2019-02-20 14:01:25', '1', '192.168.1.15'),
(23, '5', '9', '23', '100008', '0000-00-00 00:00:00', 'sdflv sddo;fksdkl;v sdlsduojq', 500, '50', '4', 544, '2019-02-20 19:31:25', '2019-02-20 14:01:25', '1', '192.168.1.15'),
(24, '4', '10', '24', '100007', '0000-00-00 00:00:00', 'sdvl ;sasodv nasopdvn aspdovnasvaspdvnoas dpvasvop asvnasop', 520, '5415', '3', 21, '2019-02-20 19:32:44', '2019-02-20 14:02:44', '1', '192.168.1.15'),
(25, '4', '10', '25', '100007', '0000-00-00 00:00:00', ' dfvl;ksdfp fopbsdfnbpsdofbnsd[bpjsd bmsd sdpbihosd', 52, '2621', '4', 6363, '2019-02-20 19:32:44', '2019-02-20 14:02:44', '1', '192.168.1.15'),
(26, '4', '10', '26', '100007', '0000-00-00 00:00:00', 'dlbdld d;v dobsdb;sdbsdopkj', 60, '63', '4', 2, '2019-02-20 19:32:44', '2019-02-20 14:02:44', '1', '192.168.1.15'),
(27, '6', '11', '27', '100009', '2019-02-22 15:37:23', 'asdc sadnv asnd vasnvas;l vasndlvasdovnasodv asndvasdpnvo asopvnaspdvn npavsno vnasdnv asdvo naspvnasdvasovnasdfopv opasvnp vasnpdv asn dvasdvasnd voaspdvn asopvnasonvasdopv nasdpvn asn aspodv asdopv oas vpasodv', 50, '121', '1', 1500, '2019-02-22 15:37:23', '2019-02-22 10:07:23', '1', '192.168.1.15'),
(28, '6', '11', '28', '100009', '2019-02-22 15:37:23', 'asdv asdvsdbvas ab svsbdv asblv asdvasvi savsa vasdv av saivbhasio vabsovasbdvsio', 500, '50', '1', 15000, '2019-02-22 15:37:23', '2019-02-22 10:07:23', '1', '192.168.1.15'),
(29, '6', '11', '29', '100009', '2019-02-22 15:37:23', 'sdfkjv adfsvdbfvbdfv fpv asdfjvp asfvpasdfvpasvaspv jasdvpasdvp asdvj aspdvasj dvas dvasdvpjasvas vpaspvasdvp asv sapvasv asdvj ioasvasjp vasdiovjp as dvasiopvasiop vasvasjiopbsp vasb dvasiojdv asdio vjioasbdjiov asbdiopv asdviopasdbvj pvjio asbv', 50, '1520', '4', 1500, '2019-02-22 15:37:23', '2019-02-22 10:07:23', '1', '192.168.1.15'),
(30, '7', '12', '30', '100010', '2019-02-22 15:37:46', 'asdc sadnv asnd vasnvas;l vasndlvasdovnasodv asndvasdpnvo asopvnaspdvn npavsno vnasdnv asdvo naspvnasdvasovnasdfopv opasvnp vasnpdv asn dvasdvasnd voaspdvn asopvnasonvasdopv nasdpvn asn aspodv asdopv oas vpasodv', 50, '121', '1', 1500, '2019-02-22 15:37:46', '2019-02-22 10:07:46', '1', '192.168.1.15'),
(31, '7', '12', '31', '100010', '2019-02-22 15:37:46', 'asdv asdvsdbvas ab svsbdv asblv asdvasvi savsa vasdv av saivbhasio vabsovasbdvsio', 500, '50', '1', 15000, '2019-02-22 15:37:46', '2019-02-22 10:07:46', '1', '192.168.1.15'),
(32, '7', '12', '32', '100010', '2019-02-22 15:37:46', 'sdfkjv adfsvdbfvbdfv fpv asdfjvp asfvpasdfvpasvaspv jasdvpasdvp asdvj aspdvasj dvas dvasdvpjasvas vpaspvasdvp asv sapvasv asdvj ioasvasjp vasdiovjp as dvasiopvasiop vasvasjiopbsp vasb dvasiojdv asdio vjioasbdjiov asbdiopv asdviopasdbvj pvjio asbv', 50, '1520', '4', 1500, '2019-02-22 15:37:46', '2019-02-22 10:07:46', '1', '192.168.1.15'),
(33, '7', '12', '33', '100010', '2019-02-22 15:37:46', 'sdc sadncv asdcnasdcp asdcasp dcasp asdcaspdo casdncpoasdc asndpc', 50, '50', '4', 50, '2019-02-22 15:37:46', '2019-02-22 10:07:46', '1', '192.168.1.15'),
(34, '8', '13', '34', '100011', '2019-02-22 15:42:42', 'asdv sdb asdlc asdlbvas bd', 1, '1', '1', 1, '2019-02-22 15:42:42', '2019-02-22 10:12:42', '1', '192.168.1.15'),
(35, '9', '14', '35', '100012', '2019-02-22 15:45:22', 'asdklv savasb asdvjasbdlv asdbv asdbv asdhuv asdu', 100, '10', '3', 100, '2019-02-22 15:45:22', '2019-02-22 10:15:22', '1', '192.168.1.15'),
(36, '10', '15', '36', '100013', '2019-02-22 15:49:39', 'asdklcv asld cbvasd', 11, '1', '3', 1, '2019-02-22 15:49:39', '2019-02-22 10:19:39', '1', '192.168.1.15'),
(37, '11', '16', '37', '100014', '2019-02-22 15:50:38', 'zxdfv dfvdj fvnasdfv asdfpovb asdb', 1, '1', '3', 1, '2019-02-22 15:50:38', '2019-02-22 10:20:38', '1', '192.168.1.15'),
(38, '11', '16', '38', '100014', '2019-02-22 15:50:38', 'ascb asbc ai', 1, '11', '3', 1, '2019-02-22 15:50:38', '2019-02-22 10:20:38', '1', '192.168.1.15'),
(39, '11', '16', '39', '100014', '2019-02-22 15:50:38', 'sduoibh sdofsdfio', 11, '11', '3', 1500, '2019-02-22 15:50:38', '2019-02-22 10:20:38', '1', '192.168.1.15'),
(40, '12', '17', '40', '100015', '2019-02-22 15:53:00', '131', 1321, '13212', '3', 13212, '2019-02-22 15:53:00', '2019-02-22 10:23:00', '1', '192.168.1.15'),
(41, '12', '17', '41', '100015', '2019-02-22 15:53:00', '16161', 561, '61561', '1', 16, '2019-02-22 15:53:00', '2019-02-22 10:23:00', '1', '192.168.1.15'),
(42, '12', '17', '42', '100015', '2019-02-22 15:53:00', 'zsjkv sdfvasdfv iasdbv asvasbdvoibasdvasio dvoasvbiasdlvbas odivuas', 151, '51', '3', 1510, '2019-02-22 15:53:00', '2019-02-22 10:23:00', '1', '192.168.1.15'),
(43, '13', '18', '43', '100016', '2019-02-22 15:53:24', 'asdbckabb', 1, '1', '3', 1, '2019-02-22 15:53:24', '2019-02-22 10:23:24', '1', '192.168.1.15'),
(44, '14', '19', '44', '100017', '2019-02-22 15:54:14', 'asdbckabb', 1, '1', '3', 1, '2019-02-22 15:54:14', '2019-02-22 10:24:14', '1', '192.168.1.15'),
(45, '14', '19', '45', '100017', '2019-02-22 15:54:14', 'asdc nasdcnasd;asd;vnasdvn sdvnsadlvn asdnlvasdvl; asndv asopvnasopvn;asdv', 121, '121', '3', 121, '2019-02-22 15:54:14', '2019-02-22 10:24:14', '1', '192.168.1.15'),
(46, '14', '19', '46', '100017', '2019-02-22 15:54:14', 'df vsfaivasdfviboas dvodivasodivasodvasodbaasvbas asiv asido dvo', 151, '151', '10', 151, '2019-02-22 15:54:14', '2019-02-22 10:24:14', '1', '192.168.1.15'),
(47, '14', '19', '47', '100017', '2019-02-22 15:54:14', 'asvh asidhv awovuwio fhowiauvwbodvw obv awdbv8i', 151, '5151', '10', 115, '2019-02-22 15:54:14', '2019-02-22 10:24:14', '1', '192.168.1.15'),
(48, '15', '20', '48', '100018', '2019-02-22 15:57:51', 'asdcjk ', 1, '1', '3', 1, '2019-02-22 15:57:51', '2019-02-22 10:27:51', '1', '192.168.1.15'),
(49, '15', '20', '49', '100018', '2019-02-22 15:57:52', '2', 2, '2', '3', 2, '2019-02-22 15:57:52', '2019-02-22 10:27:52', '1', '192.168.1.15'),
(50, '16', '21', '50', '100019', '2019-02-22 15:59:15', 'asdcjk ', 1, '1', '3', 1, '2019-02-22 15:59:15', '2019-02-22 10:29:15', '1', '192.168.1.15'),
(51, '16', '21', '51', '100019', '2019-02-22 15:59:15', '2', 2, '2', '3', 2, '2019-02-22 15:59:15', '2019-02-22 10:29:15', '1', '192.168.1.15'),
(52, '16', '21', '52', '100019', '2019-02-22 15:59:15', 'sjkadbc', 15, '15', '10', 15, '2019-02-22 15:59:15', '2019-02-22 10:29:15', '1', '192.168.1.15'),
(53, '17', '22', '53', '100020', '2019-02-22 16:03:37', 'sdfbkl sdfb dfvbdfklvbsd fbsdfivbsd fsdfvbsdfov sdiofv', 1511, '15', '1', 510, '2019-02-22 16:03:37', '2019-02-22 10:33:37', '1', '192.168.1.15'),
(54, '17', '22', '54', '100020', '2019-02-22 16:03:37', 'asdvaslidvbas id va aiwvu asoidvasopd vasdcvasd', 150, '150', '3', 150, '2019-02-22 16:03:37', '2019-02-22 10:33:37', '1', '192.168.1.15'),
(55, '17', '23', '55', '100020', '0000-00-00 00:00:00', 'sdfbkl sdfb dfvbdfklvbsd fbsdfivbsd fsdfvbsdfov sdiofv', 1511, '15', '1', 510, '2019-02-22 16:05:09', '2019-02-22 10:35:09', '1', '192.168.1.15'),
(56, '17', '23', '56', '100020', '0000-00-00 00:00:00', 'asdvaslidvbas id va aiwvu asoidvasopd vasdcvasd', 150, '150', '3', 150, '2019-02-22 16:05:09', '2019-02-22 10:35:09', '1', '192.168.1.15'),
(57, '17', '23', '57', '100020', '0000-00-00 00:00:00', 'a sdcasdcasdkcasdkncasdklcnasdkcn asdkc asdlbasdiovasd', 11, '1', '4', 11, '2019-02-22 16:05:09', '2019-02-22 10:35:09', '1', '192.168.1.15'),
(58, '17', '24', '58', '100020', '0000-00-00 00:00:00', 'sdfbkl sdfb dfvbdfklvbsd fbsdfivbsd fsdfvbsdfov sdiofv', 1511, '15', '1', 510, '2019-02-22 16:06:38', '2019-02-22 10:36:38', '1', '192.168.1.15'),
(59, '17', '24', '59', '100020', '0000-00-00 00:00:00', 'asdvaslidvbas id va aiwvu asoidvasopd vasdcvasd', 150, '150', '3', 150, '2019-02-22 16:06:38', '2019-02-22 10:36:38', '1', '192.168.1.15'),
(60, '17', '24', '60', '100020', '0000-00-00 00:00:00', 'a sdcasdcasdkcasdkncasdklcnasdkcn asdkc asdlbasdiovasd', 11, '1', '4', 11, '2019-02-22 16:06:38', '2019-02-22 10:36:38', '1', '192.168.1.15'),
(61, '17', '24', '61', '100020', '0000-00-00 00:00:00', 'sdv sadvaskdvl ', 11, '11', '3', 2121, '2019-02-22 16:06:38', '2019-02-22 10:36:38', '1', '192.168.1.15'),
(62, '17', '25', '62', '100020', '0000-00-00 00:00:00', 'sdfbkl sdfb dfvbdfklvbsd fbsdfivbsd fsdfvbsdfov sdiofv', 1511, '15', '1', 510, '2019-02-22 16:13:34', '2019-02-22 10:43:34', '1', '192.168.1.15'),
(63, '17', '25', '63', '100020', '0000-00-00 00:00:00', 'asdvaslidvbas id va aiwvu asoidvasopd vasdcvasd', 150, '150', '3', 150, '2019-02-22 16:13:34', '2019-02-22 10:43:34', '1', '192.168.1.15'),
(64, '17', '25', '64', '100020', '0000-00-00 00:00:00', 'a sdcasdcasdkcasdkncasdklcnasdkcn asdkc asdlbasdiovasd', 11, '1', '4', 11, '2019-02-22 16:13:34', '2019-02-22 10:43:34', '1', '192.168.1.15'),
(65, '17', '25', '65', '100020', '0000-00-00 00:00:00', 'sdv sadvaskdvl ', 11, '11', '3', 2121, '2019-02-22 16:13:34', '2019-02-22 10:43:34', '1', '192.168.1.15'),
(66, '17', '25', '66', '100020', '0000-00-00 00:00:00', 'asda as aacas asxc asdobs dibasidobsdiocbio asdib asidbv as', 411, '11', '10', 1511, '2019-02-22 16:13:34', '2019-02-22 10:43:34', '1', '192.168.1.15'),
(67, '17', '26', '67', '100020', '0000-00-00 00:00:00', 'sdfbkl sdfb dfvbdfklvbsd fbsdfivbsd fsdfvbsdfov sdiofv', 1511, '15', '1', 510, '2019-02-22 16:15:29', '2019-02-22 10:45:29', '1', '192.168.1.15'),
(68, '17', '26', '68', '100020', '0000-00-00 00:00:00', 'asdvaslidvbas id va aiwvu asoidvasopd vasdcvasd', 150, '150', '3', 150, '2019-02-22 16:15:29', '2019-02-22 10:45:29', '1', '192.168.1.15'),
(69, '17', '26', '69', '100020', '0000-00-00 00:00:00', 'a sdcasdcasdkcasdkncasdklcnasdkcn asdkc asdlbasdiovasd', 11, '1', '4', 11, '2019-02-22 16:15:29', '2019-02-22 10:45:29', '1', '192.168.1.15'),
(70, '17', '26', '70', '100020', '0000-00-00 00:00:00', 'sdv sadvaskdvl ', 11, '11', '3', 2121, '2019-02-22 16:15:29', '2019-02-22 10:45:29', '1', '192.168.1.15'),
(71, '17', '26', '71', '100020', '0000-00-00 00:00:00', 'asda as aacas asxc asdobs dibasidobsdiocbio asdib asidbv as', 411, '11', '10', 1511, '2019-02-22 16:15:29', '2019-02-22 10:45:29', '1', '192.168.1.15'),
(72, '17', '26', '72', '100020', '0000-00-00 00:00:00', '1', 1, '1', '3', 1, '2019-02-22 16:15:29', '2019-02-22 10:45:29', '1', '192.168.1.15'),
(73, '17', '27', '73', '100020', '0000-00-00 00:00:00', 'sdfbkl sdfb dfvbdfklvbsd fbsdfivbsd fsdfvbsdfov sdiofv', 1511, '15', '1', 510, '2019-02-22 16:15:51', '2019-02-22 10:45:51', '1', '192.168.1.15'),
(74, '17', '27', '74', '100020', '0000-00-00 00:00:00', 'asdvaslidvbas id va aiwvu asoidvasopd vasdcvasd', 150, '150', '3', 150, '2019-02-22 16:15:51', '2019-02-22 10:45:51', '1', '192.168.1.15'),
(75, '17', '27', '75', '100020', '0000-00-00 00:00:00', 'a sdcasdcasdkcasdkncasdklcnasdkcn asdkc asdlbasdiovasd', 11, '1', '4', 11, '2019-02-22 16:15:51', '2019-02-22 10:45:51', '1', '192.168.1.15'),
(76, '17', '27', '76', '100020', '0000-00-00 00:00:00', 'sdv sadvaskdvl ', 11, '11', '3', 2121, '2019-02-22 16:15:51', '2019-02-22 10:45:51', '1', '192.168.1.15'),
(77, '17', '27', '77', '100020', '0000-00-00 00:00:00', 'asda as aacas asxc asdobs dibasidobsdiocbio asdib asidbv as', 411, '11', '10', 1511, '2019-02-22 16:15:51', '2019-02-22 10:45:51', '1', '192.168.1.15'),
(78, '17', '27', '78', '100020', '0000-00-00 00:00:00', '1', 1, '1', '3', 1, '2019-02-22 16:15:51', '2019-02-22 10:45:51', '1', '192.168.1.15'),
(79, '17', '28', '79', '100020', '0000-00-00 00:00:00', 'sdfbkl sdfb dfvbdfklvbsd fbsdfivbsd fsdfvbsdfov sdiofv', 1511, '15', '1', 510, '2019-02-22 16:16:09', '2019-02-22 10:46:09', '1', '192.168.1.15'),
(80, '17', '28', '80', '100020', '0000-00-00 00:00:00', 'asdvaslidvbas id va aiwvu asoidvasopd vasdcvasd', 150, '150', '3', 150, '2019-02-22 16:16:09', '2019-02-22 10:46:09', '1', '192.168.1.15'),
(81, '17', '28', '81', '100020', '0000-00-00 00:00:00', 'a sdcasdcasdkcasdkncasdklcnasdkcn asdkc asdlbasdiovasd', 11, '1', '4', 11, '2019-02-22 16:16:09', '2019-02-22 10:46:09', '1', '192.168.1.15'),
(82, '17', '28', '82', '100020', '0000-00-00 00:00:00', 'sdv sadvaskdvl ', 11, '11', '3', 2121, '2019-02-22 16:16:09', '2019-02-22 10:46:09', '1', '192.168.1.15'),
(83, '17', '28', '83', '100020', '0000-00-00 00:00:00', 'asda as aacas asxc asdobs dibasidobsdiocbio asdib asidbv as', 411, '11', '10', 1511, '2019-02-22 16:16:09', '2019-02-22 10:46:09', '1', '192.168.1.15'),
(84, '17', '28', '84', '100020', '0000-00-00 00:00:00', '1', 1, '1', '3', 1, '2019-02-22 16:16:09', '2019-02-22 10:46:09', '1', '192.168.1.15'),
(85, '17', '29', '85', '100020', '0000-00-00 00:00:00', 'sdfbkl sdfb dfvbdfklvbsd fbsdfivbsd fsdfvbsdfov sdiofv', 1511, '15', '1', 510, '2019-02-22 16:16:55', '2019-02-22 10:46:55', '1', '192.168.1.15'),
(86, '17', '29', '86', '100020', '0000-00-00 00:00:00', 'asdvaslidvbas id va aiwvu asoidvasopd vasdcvasd', 150, '150', '3', 150, '2019-02-22 16:16:55', '2019-02-22 10:46:55', '1', '192.168.1.15'),
(87, '17', '29', '87', '100020', '0000-00-00 00:00:00', 'a sdcasdcasdkcasdkncasdklcnasdkcn asdkc asdlbasdiovasd', 11, '1', '4', 11, '2019-02-22 16:16:55', '2019-02-22 10:46:55', '1', '192.168.1.15'),
(88, '17', '29', '88', '100020', '0000-00-00 00:00:00', 'sdv sadvaskdvl ', 11, '11', '3', 2121, '2019-02-22 16:16:55', '2019-02-22 10:46:55', '1', '192.168.1.15'),
(89, '17', '29', '89', '100020', '0000-00-00 00:00:00', 'asda as aacas asxc asdobs dibasidobsdiocbio asdib asidbv as', 411, '11', '10', 1511, '2019-02-22 16:16:55', '2019-02-22 10:46:55', '1', '192.168.1.15'),
(90, '17', '29', '90', '100020', '0000-00-00 00:00:00', '1', 1, '1', '3', 1, '2019-02-22 16:16:55', '2019-02-22 10:46:55', '1', '192.168.1.15'),
(91, '17', '30', '91', '100020', '0000-00-00 00:00:00', 'sdfbkl sdfb dfvbdfklvbsd fbsdfivbsd fsdfvbsdfov sdiofv', 1511, '15', '1', 510, '2019-02-22 16:17:26', '2019-02-22 10:47:26', '1', '192.168.1.15'),
(92, '17', '30', '92', '100020', '0000-00-00 00:00:00', 'asdvaslidvbas id va aiwvu asoidvasopd vasdcvasd', 150, '150', '3', 150, '2019-02-22 16:17:26', '2019-02-22 10:47:26', '1', '192.168.1.15'),
(93, '17', '30', '93', '100020', '0000-00-00 00:00:00', 'a sdcasdcasdkcasdkncasdklcnasdkcn asdkc asdlbasdiovasd', 11, '1', '4', 11, '2019-02-22 16:17:27', '2019-02-22 10:47:26', '1', '192.168.1.15'),
(94, '17', '30', '94', '100020', '0000-00-00 00:00:00', 'sdv sadvaskdvl ', 11, '11', '3', 2121, '2019-02-22 16:17:27', '2019-02-22 10:47:27', '1', '192.168.1.15'),
(95, '17', '30', '95', '100020', '0000-00-00 00:00:00', 'asda as aacas asxc asdobs dibasidobsdiocbio asdib asidbv as', 411, '11', '10', 1511, '2019-02-22 16:17:27', '2019-02-22 10:47:27', '1', '192.168.1.15'),
(96, '17', '30', '96', '100020', '0000-00-00 00:00:00', '1', 1, '1', '3', 1, '2019-02-22 16:17:27', '2019-02-22 10:47:27', '1', '192.168.1.15'),
(97, '17', '30', '97', '100020', '0000-00-00 00:00:00', 'asdc', 151, '161', '3', 16, '2019-02-22 16:17:27', '2019-02-22 10:47:27', '1', '192.168.1.15'),
(98, '17', '31', '98', '100020', '0000-00-00 00:00:00', 'sdfbkl sdfb dfvbdfklvbsd fbsdfivbsd fsdfvbsdfov sdiofv', 1511, '15', '1', 510, '2019-02-22 16:18:33', '2019-02-22 10:48:33', '1', '192.168.1.15'),
(99, '17', '31', '99', '100020', '0000-00-00 00:00:00', 'asdvaslidvbas id va aiwvu asoidvasopd vasdcvasd', 150, '150', '3', 150, '2019-02-22 16:18:33', '2019-02-22 10:48:33', '1', '192.168.1.15'),
(100, '17', '31', '100', '100020', '0000-00-00 00:00:00', 'a sdcasdcasdkcasdkncasdklcnasdkcn asdkc asdlbasdiovasd', 11, '1', '4', 11, '2019-02-22 16:18:33', '2019-02-22 10:48:33', '1', '192.168.1.15'),
(101, '17', '31', '101', '100020', '0000-00-00 00:00:00', 'sdv sadvaskdvl ', 11, '11', '3', 2121, '2019-02-22 16:18:33', '2019-02-22 10:48:33', '1', '192.168.1.15'),
(102, '17', '31', '102', '100020', '0000-00-00 00:00:00', 'asda as aacas asxc asdobs dibasidobsdiocbio asdib asidbv as', 411, '11', '10', 1511, '2019-02-22 16:18:33', '2019-02-22 10:48:33', '1', '192.168.1.15'),
(103, '17', '31', '103', '100020', '0000-00-00 00:00:00', '1', 1, '1', '3', 1, '2019-02-22 16:18:33', '2019-02-22 10:48:33', '1', '192.168.1.15'),
(104, '17', '31', '104', '100020', '0000-00-00 00:00:00', 'asdc', 151, '161', '3', 16, '2019-02-22 16:18:33', '2019-02-22 10:48:33', '1', '192.168.1.15'),
(105, '17', '31', '105', '100020', '0000-00-00 00:00:00', 'asda', 15, '115', '10', 15, '2019-02-22 16:18:33', '2019-02-22 10:48:33', '1', '192.168.1.15'),
(106, '18', '32', '106', '100021', '2019-02-22 16:19:08', 'sadvj asdvasdobvasbdv asdbvasdbv asldvbi asodibdodvasb dvasvbo asbdvas', 151, '151', '3', 15, '2019-02-22 16:19:08', '2019-02-22 10:49:08', '1', '192.168.1.15'),
(107, '18', '33', '107', '100021', '0000-00-00 00:00:00', 'sadvj asdvasdobvasbdv asdbvasdbv asldvbi asodibdodvasb dvasvbo asbdvas', 151, '151', '3', 15, '2019-02-22 16:19:47', '2019-02-22 10:49:47', '1', '192.168.1.15'),
(108, '19', '34', '108', '100022', '2019-02-26 12:11:06', 'a sdjv sjvasjvbasdjvsdjvbsdj', 150, '150', '1', 150, '2019-02-26 12:11:06', '2019-02-26 06:41:06', '1', '192.168.1.20'),
(109, '19', '34', '109', '100022', '2019-02-26 12:11:06', ' asv asjv sdvsjdvbsajkdvbasjv sajv sidvbsui ', 1500, '1500', '10', 1500, '2019-02-26 12:11:06', '2019-02-26 06:41:06', '1', '192.168.1.20'),
(110, '20', '35', '110', '100023', '2019-02-26 13:19:19', '151', 151, '151', '3', 151, '2019-02-26 13:19:19', '2019-02-26 07:49:19', '1', '192.168.1.20'),
(111, '20', '35', '111', '100023', '2019-02-26 13:19:19', '161', 131, '321', '4', 2123, '2019-02-26 13:19:19', '2019-02-26 07:49:19', '1', '192.168.1.20'),
(112, '20', '36', '112', '100023', '0000-00-00 00:00:00', '151', 151, '151', '3', 151, '2019-02-26 13:20:02', '2019-02-26 07:50:02', '1', '192.168.1.20'),
(113, '20', '36', '113', '100023', '0000-00-00 00:00:00', '161', 131, '321', '4', 2123, '2019-02-26 13:20:02', '2019-02-26 07:50:02', '1', '192.168.1.20'),
(114, '20', '37', '114', '100023', '0000-00-00 00:00:00', '151', 151, '151', '3', 151, '2019-02-26 13:21:14', '2019-02-26 07:51:14', '1', '192.168.1.20'),
(115, '20', '37', '115', '100023', '0000-00-00 00:00:00', '161', 131, '321', '4', 2123, '2019-02-26 13:21:15', '2019-02-26 07:51:15', '1', '192.168.1.20'),
(116, '20', '38', '116', '100023', '0000-00-00 00:00:00', '151', 151, '151', '3', 151, '2019-02-26 13:24:19', '2019-02-26 07:54:19', '1', '192.168.1.20'),
(117, '20', '38', '117', '100023', '0000-00-00 00:00:00', '161', 131, '321', '4', 2123, '2019-02-26 13:24:19', '2019-02-26 07:54:19', '1', '192.168.1.20'),
(118, '20', '39', '118', '100023', '0000-00-00 00:00:00', '151', 151, '151', '3', 151, '2019-02-26 13:24:46', '2019-02-26 07:54:46', '1', '192.168.1.20'),
(119, '20', '39', '119', '100023', '0000-00-00 00:00:00', '161', 131, '321', '4', 2123, '2019-02-26 13:24:46', '2019-02-26 07:54:46', '1', '192.168.1.20'),
(120, '20', '40', '120', '100023', '0000-00-00 00:00:00', '151', 151, '151', '3', 151, '2019-02-26 13:25:49', '2019-02-26 07:55:49', '1', '192.168.1.20'),
(121, '20', '40', '121', '100023', '0000-00-00 00:00:00', '161', 131, '321', '4', 2123, '2019-02-26 13:25:49', '2019-02-26 07:55:49', '1', '192.168.1.20'),
(122, '20', '41', '122', '100023', '0000-00-00 00:00:00', '151', 151, '151', '3', 151, '2019-02-26 13:27:58', '2019-02-26 07:57:58', '1', '192.168.1.20'),
(123, '20', '41', '123', '100023', '0000-00-00 00:00:00', '161', 131, '321', '4', 2123, '2019-02-26 13:27:59', '2019-02-26 07:57:59', '1', '192.168.1.20'),
(124, '20', '42', '124', '100023', '0000-00-00 00:00:00', '151', 151, '151', '3', 151, '2019-02-26 13:29:35', '2019-02-26 07:59:35', '1', '192.168.1.20'),
(125, '20', '42', '125', '100023', '0000-00-00 00:00:00', '161', 131, '321', '4', 2123, '2019-02-26 13:29:36', '2019-02-26 07:59:36', '1', '192.168.1.20'),
(126, '20', '43', '126', '100023', '0000-00-00 00:00:00', '151', 151, '151', '3', 151, '2019-02-26 13:30:41', '2019-02-26 08:00:41', '1', '192.168.1.20'),
(127, '20', '43', '127', '100023', '0000-00-00 00:00:00', '161', 131, '321', '4', 2123, '2019-02-26 13:30:41', '2019-02-26 08:00:41', '1', '192.168.1.20'),
(128, '20', '44', '128', '100023', '0000-00-00 00:00:00', '151', 151, '151', '3', 151, '2019-02-26 13:33:15', '2019-02-26 08:03:15', '1', '192.168.1.20'),
(129, '20', '44', '129', '100023', '0000-00-00 00:00:00', '161', 131, '321', '4', 2123, '2019-02-26 13:33:15', '2019-02-26 08:03:15', '1', '192.168.1.20'),
(130, '20', '45', '130', '100023', '0000-00-00 00:00:00', '151', 151, '151', '3', 151, '2019-02-26 13:33:39', '2019-02-26 08:03:39', '1', '192.168.1.20'),
(131, '20', '45', '131', '100023', '0000-00-00 00:00:00', '161', 131, '321', '4', 2123, '2019-02-26 13:33:39', '2019-02-26 08:03:39', '1', '192.168.1.20'),
(132, '20', '46', '132', '100023', '0000-00-00 00:00:00', '151', 151, '151', '3', 151, '2019-02-26 13:33:48', '2019-02-26 08:03:48', '1', '192.168.1.20'),
(133, '20', '46', '133', '100023', '0000-00-00 00:00:00', '161', 131, '321', '4', 2123, '2019-02-26 13:33:48', '2019-02-26 08:03:48', '1', '192.168.1.20'),
(134, '20', '47', '134', '100023', '0000-00-00 00:00:00', '151', 151, '151', '3', 151, '2019-02-26 13:34:44', '2019-02-26 08:04:44', '1', '192.168.1.20'),
(135, '20', '47', '135', '100023', '0000-00-00 00:00:00', '161', 131, '321', '4', 2123, '2019-02-26 13:34:44', '2019-02-26 08:04:44', '1', '192.168.1.20'),
(136, '20', '48', '136', '100023', '0000-00-00 00:00:00', '151', 151, '151', '3', 151, '2019-02-26 13:35:24', '2019-02-26 08:05:24', '1', '192.168.1.20'),
(137, '20', '48', '137', '100023', '0000-00-00 00:00:00', '161', 131, '321', '4', 2123, '2019-02-26 13:35:24', '2019-02-26 08:05:24', '1', '192.168.1.20'),
(138, '20', '49', '138', '100023', '0000-00-00 00:00:00', '151', 151, '151', '3', 151, '2019-02-26 13:37:12', '2019-02-26 08:07:12', '1', '192.168.1.20'),
(139, '20', '49', '139', '100023', '0000-00-00 00:00:00', '161', 131, '321', '4', 2123, '2019-02-26 13:37:12', '2019-02-26 08:07:12', '1', '192.168.1.20'),
(140, '20', '50', '140', '100023', '0000-00-00 00:00:00', '151', 151, '151', '3', 151, '2019-02-26 13:38:14', '2019-02-26 08:08:14', '1', '192.168.1.20'),
(141, '20', '50', '141', '100023', '0000-00-00 00:00:00', '161', 131, '321', '4', 2123, '2019-02-26 13:38:14', '2019-02-26 08:08:14', '1', '192.168.1.20'),
(142, '21', '51', '142', '100024', '2019-02-27 20:00:25', 'test', 1, '', '3', 0, '2019-02-27 20:00:25', '2019-02-27 14:30:25', '1', '192.168.1.62'),
(143, '21', '51', '143', '100024', '2019-02-27 20:00:25', '2222222222222', 2, '', '3', 0, '2019-02-27 20:00:25', '2019-02-27 14:30:25', '1', '192.168.1.62'),
(144, '21', '51', '144', '100024', '2019-02-27 20:00:25', '3333333333333333333', 3, '', '3', 0, '2019-02-27 20:00:25', '2019-02-27 14:30:25', '1', '192.168.1.62'),
(145, '21', '51', '145', '100024', '2019-02-27 20:00:25', '444444444444444444444', 4, '', '3', 0, '2019-02-27 20:00:25', '2019-02-27 14:30:25', '1', '192.168.1.62'),
(146, '21', '51', '146', '100024', '2019-02-27 20:00:25', '55555555555555555555555', 5, '', '3', 0, '2019-02-27 20:00:25', '2019-02-27 14:30:25', '1', '192.168.1.62'),
(147, '21', '51', '147', '100024', '2019-02-27 20:00:25', '6666666666666666666', 6, '', '3', 0, '2019-02-27 20:00:25', '2019-02-27 14:30:25', '1', '192.168.1.62'),
(148, '21', '51', '148', '100024', '2019-02-27 20:00:25', '77777777777777777777777777777', 7, '', '3', 0, '2019-02-27 20:00:25', '2019-02-27 14:30:25', '1', '192.168.1.62'),
(149, '21', '51', '149', '100024', '2019-02-27 20:00:25', '3333333333333333333333333333', 3, '', '3', 0, '2019-02-27 20:00:25', '2019-02-27 14:30:25', '1', '192.168.1.62'),
(150, '21', '51', '150', '100024', '2019-02-27 20:00:26', '454545454545454', 4, '', '3', 0, '2019-02-27 20:00:26', '2019-02-27 14:30:26', '1', '192.168.1.62'),
(151, '21', '51', '151', '100024', '2019-02-27 20:00:26', '898989898998989898', 8, '', '3', 0, '2019-02-27 20:00:26', '2019-02-27 14:30:26', '1', '192.168.1.62'),
(152, '21', '51', '152', '100024', '2019-02-27 20:00:26', '13131313131313131313131', 1, '', '3', 0, '2019-02-27 20:00:26', '2019-02-27 14:30:26', '1', '192.168.1.62'),
(153, '22', '52', '153', '100025', '2019-02-28 18:00:29', 'Envelop', 300, '', '3', 0, '2019-02-28 18:00:29', '2019-02-28 12:30:29', '1', '192.168.1.3'),
(154, '22', '52', '154', '100025', '2019-02-28 18:00:29', 'Business Cards', 500, '', '3', 0, '2019-02-28 18:00:29', '2019-02-28 12:30:29', '1', '192.168.1.3'),
(155, '22', '52', '155', '100025', '2019-02-28 18:00:29', 'Letter pad', 70, '', '3', 0, '2019-02-28 18:00:29', '2019-02-28 12:30:29', '1', '192.168.1.3'),
(156, '23', '53', '156', '100026', '2019-02-28 18:23:16', '151', 1, '151', '1', 15, '2019-02-28 18:23:16', '2019-02-28 12:53:16', '1', '192.168.1.7'),
(157, '24', '54', '157', '100027', '2019-02-28 18:43:08', 'vjg', 15, '151', '1', 22, '2019-02-28 18:43:08', '2019-02-28 13:13:08', '1', '192.168.1.7'),
(158, '24', '54', '158', '100027', '2019-02-28 18:43:09', '165', 11651, '6511', '1', 25, '2019-02-28 18:43:09', '2019-02-28 13:13:09', '1', '192.168.1.7'),
(159, '25', '55', '159', '100028', '2019-02-28 18:45:00', 'vjg', 5, '5', '1', 5, '2019-02-28 18:45:00', '2019-02-28 13:15:00', '1', '192.168.1.7'),
(160, '25', '55', '160', '100028', '2019-02-28 18:45:00', '5', 5, '5', '3', 5, '2019-02-28 18:45:00', '2019-02-28 13:15:00', '1', '192.168.1.7'),
(161, '26', '56', '161', '100029', '2019-02-28 19:19:18', 'vjg', NULL, '', '1', 1, '2019-02-28 19:19:18', '2019-02-28 13:49:18', '1', '192.168.1.3'),
(162, '26', '56', '162', '100029', '2019-02-28 19:19:18', 'test', 3, '', '3', 0, '2019-02-28 19:19:18', '2019-02-28 13:49:18', '1', '192.168.1.3'),
(163, '26', '56', '163', '100029', '2019-02-28 19:19:18', 'test', 99, '', '3', 0, '2019-02-28 19:19:18', '2019-02-28 13:49:18', '1', '192.168.1.3'),
(164, '27', '57', '164', '100030', '2019-02-28 20:23:15', 'vjg', 15, '', '10', 1, '2019-02-28 20:23:15', '2019-02-28 14:53:15', '1', '192.168.1.7'),
(165, '27', '57', '165', '100030', '2019-02-28 20:23:15', 'test', 3, '', '3', 0, '2019-02-28 20:23:15', '2019-02-28 14:53:15', '1', '192.168.1.7'),
(166, '27', '57', '166', '100030', '2019-02-28 20:23:15', 'test', 99, '', '3', 0, '2019-02-28 20:23:15', '2019-02-28 14:53:15', '1', '192.168.1.7'),
(167, '27', '57', '167', '100030', '2019-02-28 20:23:15', '151', 151, '151', '', 151, '2019-02-28 20:23:15', '2019-02-28 14:53:15', '1', '192.168.1.7'),
(168, '28', '58', '168', '100031', '2019-02-28 20:31:18', 'vjg', 15, '', '10', 1, '2019-02-28 20:31:18', '2019-02-28 15:01:18', '1', '192.168.1.7'),
(169, '28', '58', '169', '100031', '2019-02-28 20:31:18', 'test', 3, '', '3', 0, '2019-02-28 20:31:18', '2019-02-28 15:01:18', '1', '192.168.1.7'),
(170, '28', '58', '170', '100031', '2019-02-28 20:31:18', 'test', 99, '', '3', 0, '2019-02-28 20:31:18', '2019-02-28 15:01:18', '1', '192.168.1.7'),
(171, '28', '58', '171', '100031', '2019-02-28 20:31:18', '151', 151, '151', '', 151, '2019-02-28 20:31:18', '2019-02-28 15:01:18', '1', '192.168.1.7'),
(172, '29', '59', '172', '100032', '2019-02-28 20:40:45', 'vjg', 15, '', '10', 1, '2019-02-28 20:40:45', '2019-02-28 15:10:45', '1', '192.168.1.7'),
(173, '29', '59', '173', '100032', '2019-02-28 20:40:45', 'test', 3, '', '3', 0, '2019-02-28 20:40:45', '2019-02-28 15:10:45', '1', '192.168.1.7'),
(174, '29', '59', '174', '100032', '2019-02-28 20:40:46', 'test', 99, '', '3', 0, '2019-02-28 20:40:46', '2019-02-28 15:10:46', '1', '192.168.1.7'),
(175, '29', '59', '175', '100032', '2019-02-28 20:40:46', '151', 151, '151', '3', 151, '2019-02-28 20:40:46', '2019-02-28 15:10:46', '1', '192.168.1.7'),
(176, '30', '60', '176', '100033', '2019-02-28 20:41:35', 'vjg', 15, '', '10', 1, '2019-02-28 20:41:35', '2019-02-28 15:11:35', '1', '192.168.1.7'),
(177, '30', '60', '177', '100033', '2019-02-28 20:41:35', 'test', 3, '', '3', 0, '2019-02-28 20:41:35', '2019-02-28 15:11:35', '1', '192.168.1.7'),
(178, '30', '60', '178', '100033', '2019-02-28 20:41:35', 'test', 99, '', '3', 0, '2019-02-28 20:41:35', '2019-02-28 15:11:35', '1', '192.168.1.7'),
(179, '30', '60', '179', '100033', '2019-02-28 20:41:35', '151', 151, '151', '3', 151, '2019-02-28 20:41:35', '2019-02-28 15:11:35', '1', '192.168.1.7'),
(180, '30', '60', '180', '100033', '2019-02-28 20:41:35', 'cghcghc', 1, '1', '3', 150, '2019-02-28 20:41:35', '2019-02-28 15:11:35', '1', '192.168.1.7'),
(181, '31', '61', '181', '100034', '2019-02-28 20:45:24', '300 Envelop', 1851, '51', '3', 3000, '2019-02-28 20:45:24', '2019-02-28 15:15:24', '1', '192.168.1.7'),
(182, '31', '61', '182', '100034', '2019-02-28 20:45:24', '500 Business Cards', 151, '5151', '3', 2500, '2019-02-28 20:45:24', '2019-02-28 15:15:24', '1', '192.168.1.7'),
(183, '32', '62', '183', '100035', '2019-02-28 20:45:54', '300 Envelop', 1851, '51', '3', 3000, '2019-02-28 20:45:54', '2019-02-28 15:15:54', '1', '192.168.1.7'),
(184, '32', '62', '184', '100035', '2019-02-28 20:45:54', '500 Business Cards', 151, '5151', '3', 2500, '2019-02-28 20:45:54', '2019-02-28 15:15:54', '1', '192.168.1.7'),
(185, '32', '62', '185', '100035', '2019-02-28 20:45:54', 'testert', 1, '1', '3', 2626, '2019-02-28 20:45:54', '2019-02-28 15:15:54', '1', '192.168.1.7'),
(186, '33', '63', '186', '100036', '2019-02-28 20:46:14', '300 Envelop', 1851, '51', '3', 3000, '2019-02-28 20:46:14', '2019-02-28 15:16:14', '1', '192.168.1.7'),
(187, '33', '63', '187', '100036', '2019-02-28 20:46:14', '500 Business Cards', 151, '5151', '3', 2500, '2019-02-28 20:46:14', '2019-02-28 15:16:14', '1', '192.168.1.7'),
(188, '33', '63', '188', '100036', '2019-02-28 20:46:14', 'testert', 1, '1', '3', 2626, '2019-02-28 20:46:14', '2019-02-28 15:16:14', '1', '192.168.1.7'),
(189, '33', '64', '189', '100036', '2019-02-28 20:46:13', '300 Envelop', 1851, '51', '3', 3000, '2019-02-28 20:46:31', '2019-02-28 15:16:31', '1', '192.168.1.7'),
(190, '33', '64', '190', '100036', '2019-02-28 20:46:13', '500 Business Cards', 151, '5151', '3', 2500, '2019-02-28 20:46:32', '2019-02-28 15:16:32', '1', '192.168.1.7'),
(191, '33', '64', '191', '100036', '2019-02-28 20:46:13', 'testert', 1, '1', '3', 2626, '2019-02-28 20:46:32', '2019-02-28 15:16:32', '1', '192.168.1.7'),
(192, '34', '65', '192', '100037', '2019-02-28 20:48:08', '300 Envelop', 1851, '51', '3', 3000, '2019-02-28 20:48:08', '2019-02-28 15:18:08', '1', '192.168.1.7'),
(193, '34', '65', '193', '100037', '2019-02-28 20:48:08', '500 Business Cards', 151, '5151', '3', 2500, '2019-02-28 20:48:08', '2019-02-28 15:18:08', '1', '192.168.1.7'),
(194, '34', '65', '194', '100037', '2019-02-28 20:48:08', 'testert', 1, '1', '3', 2626, '2019-02-28 20:48:08', '2019-02-28 15:18:08', '1', '192.168.1.7'),
(195, '34', '65', '195', '100037', '2019-02-28 20:48:08', 'sajdc', 41, '', '3', 15, '2019-02-28 20:48:08', '2019-02-28 15:18:08', '1', '192.168.1.7'),
(196, '35', '66', '196', '100038', '2019-02-28 20:49:17', 'dk d vasdklbv kdv abdklv bdklvb', 1, '', '1', 1500, '2019-02-28 20:49:17', '2019-02-28 15:19:17', '1', '192.168.1.7'),
(197, '35', '66', '197', '100038', '2019-02-28 20:49:17', 'sdbd dafv asdkfv askfvaskfvbas kfv ', 1, '', '1', 1500, '2019-02-28 20:49:17', '2019-02-28 15:19:17', '1', '192.168.1.7'),
(198, '35', '66', '198', '100038', '2019-02-28 20:49:18', 'svks ldv', 1, '', '1', 500, '2019-02-28 20:49:18', '2019-02-28 15:19:18', '1', '192.168.1.7'),
(199, '35', '66', '199', '100038', '2019-02-28 20:49:18', ' sdkvs', 1, '', '1', 500, '2019-02-28 20:49:18', '2019-02-28 15:19:18', '1', '192.168.1.7'),
(200, '35', '66', '200', '100038', '2019-02-28 20:49:18', 'asdf,v', NULL, '515', '1', 15, '2019-02-28 20:49:18', '2019-02-28 15:19:18', '1', '192.168.1.7'),
(201, '36', '67', '201', '100039', '2019-02-28 20:54:08', 'test', 1, '2', '3', 111, '2019-02-28 20:54:08', '2019-02-28 15:24:08', '1', '192.168.1.7'),
(202, '36', '67', '202', '100039', '2019-02-28 20:54:09', 'test', 23, '12', '3', 111, '2019-02-28 20:54:09', '2019-02-28 15:24:09', '1', '192.168.1.7'),
(203, '36', '67', '203', '100039', '2019-02-28 20:54:09', 'test', 121, '2', '3', 111, '2019-02-28 20:54:09', '2019-02-28 15:24:09', '1', '192.168.1.7'),
(204, '36', '67', '204', '100039', '2019-02-28 20:54:09', 'sdahcj', 15, '151', '3', 151, '2019-02-28 20:54:09', '2019-02-28 15:24:09', '1', '192.168.1.7'),
(205, '37', '68', '205', '100040', '2019-02-28 20:54:31', '1', 121, '121', '3', 121, '2019-02-28 20:54:31', '2019-02-28 15:24:31', '1', '192.168.1.7'),
(206, '37', '68', '206', '100040', '2019-02-28 20:54:31', '2', 121, '2', '3', 1, '2019-02-28 20:54:31', '2019-02-28 15:24:31', '1', '192.168.1.7'),
(207, '38', '69', '207', '100041', '2019-02-28 20:55:24', '1', 121, '121', '3', 121, '2019-02-28 20:55:24', '2019-02-28 15:25:24', '1', '192.168.1.7'),
(208, '38', '69', '208', '100041', '2019-02-28 20:55:24', '2', 121, '2', '3', 1, '2019-02-28 20:55:24', '2019-02-28 15:25:24', '1', '192.168.1.7'),
(209, '38', '69', '209', '100041', '2019-02-28 20:55:25', 'asd', 12, '151', '10', 15, '2019-02-28 20:55:25', '2019-02-28 15:25:24', '1', '192.168.1.7'),
(210, '38', '69', '210', '100041', '2019-02-28 20:55:25', 'as dvjka', 15, '115', '10', 151, '2019-02-28 20:55:25', '2019-02-28 15:25:25', '1', '192.168.1.7'),
(211, '39', '70', '211', '100042', '2019-02-28 20:56:06', '1', 151, '151', '1', 1, '2019-02-28 20:56:06', '2019-02-28 15:26:06', '1', '192.168.1.7'),
(212, '39', '70', '212', '100042', '2019-02-28 20:56:06', 'dfkj', 151, '15', '10', 15, '2019-02-28 20:56:06', '2019-02-28 15:26:06', '1', '192.168.1.7'),
(213, '40', '71', '213', '100043', '2019-02-28 20:58:49', 'vjg', 15, '', '10', 1, '2019-02-28 20:58:49', '2019-02-28 15:28:49', '1', '192.168.1.7'),
(214, '40', '71', '214', '100043', '2019-02-28 20:58:49', 'test', 3, '', '3', 0, '2019-02-28 20:58:49', '2019-02-28 15:28:49', '1', '192.168.1.7'),
(215, '40', '71', '215', '100043', '2019-02-28 20:58:49', 'test', 99, '', '3', 0, '2019-02-28 20:58:49', '2019-02-28 15:28:49', '1', '192.168.1.7'),
(216, '40', '71', '216', '100043', '2019-02-28 20:58:50', '151', 151, '151', '3', 151, '2019-02-28 20:58:50', '2019-02-28 15:28:50', '1', '192.168.1.7'),
(217, '40', '71', '217', '100043', '2019-02-28 20:58:50', 'cghcghc', 1, '1', '3', 150, '2019-02-28 20:58:50', '2019-02-28 15:28:50', '1', '192.168.1.7'),
(218, '41', '72', '218', '100044', '2019-02-28 21:00:36', 'asd jkv', 151, '', '1', 1541, '2019-02-28 21:00:36', '2019-02-28 15:30:36', '1', '192.168.1.7'),
(219, '41', '73', '219', '100044', '2019-02-28 21:00:36', 'asd jkv', 151, '', '1', 1541, '2019-02-28 21:01:08', '2019-02-28 15:31:08', '1', '192.168.1.7'),
(220, '41', '73', '220', '100044', '2019-02-28 21:00:36', 'asdfjvaj', 415, '15', '3', 15, '2019-02-28 21:01:08', '2019-02-28 15:31:08', '1', '192.168.1.7'),
(221, '42', '74', '221', '100045', '2019-03-01 13:05:47', 'TEST1', 15, '11', '3', 1, '2019-03-01 13:05:47', '2019-03-01 07:35:47', '1', '192.168.1.7'),
(222, '42', '74', '222', '100045', '2019-03-01 13:05:47', 'TEST2', 16, '12', '3', 12, '2019-03-01 13:05:47', '2019-03-01 07:35:47', '1', '192.168.1.7'),
(223, '42', '74', '223', '100045', '2019-03-01 13:05:47', 'TEST3', 17, '13', '3', 121, '2019-03-01 13:05:47', '2019-03-01 07:35:47', '1', '192.168.1.7'),
(224, '42', '74', '224', '100045', '2019-03-01 13:05:47', 'TEST4', 18, '14', '3', 262, '2019-03-01 13:05:47', '2019-03-01 07:35:47', '1', '192.168.1.7'),
(225, '42', '74', '225', '100045', '2019-03-01 13:05:47', 'test 5', 19, '15', '1', 1551, '2019-03-01 13:05:47', '2019-03-01 07:35:47', '1', '192.168.1.7'),
(226, '42', '75', '226', '100045', '2019-03-01 13:05:47', 'TEST 10', 1, '11', '3', 1, '2019-03-01 13:07:15', '2019-03-01 07:37:15', '1', '192.168.1.7'),
(227, '42', '75', '227', '100045', '2019-03-01 13:05:47', 'TEST 9', 1, '12', '3', 12, '2019-03-01 13:07:15', '2019-03-01 07:37:15', '1', '192.168.1.7'),
(228, '42', '75', '228', '100045', '2019-03-01 13:05:47', 'TEST 8', 1, '13', '3', 121, '2019-03-01 13:07:15', '2019-03-01 07:37:15', '1', '192.168.1.7'),
(229, '42', '75', '229', '100045', '2019-03-01 13:05:47', 'TEST 7', 1, '14', '3', 262, '2019-03-01 13:07:16', '2019-03-01 07:37:16', '1', '192.168.1.7'),
(230, '42', '75', '230', '100045', '2019-03-01 13:05:47', 'test 6', 1, '15', '1', 1551, '2019-03-01 13:07:16', '2019-03-01 07:37:16', '1', '192.168.1.7'),
(231, '42', '75', '231', '100045', '2019-03-01 13:05:47', 'ttt 11', 11, '22', '3', 11, '2019-03-01 13:07:16', '2019-03-01 07:37:16', '1', '192.168.1.7'),
(232, '43', '76', '232', '100046', '2019-03-01 13:08:21', ' asjd casvjdcvas dcasvjdkcv', 11, '151', '4', 1, '2019-03-01 13:08:21', '2019-03-01 07:38:21', '1', '192.168.1.7'),
(233, '43', '76', '233', '100046', '2019-03-01 13:08:21', 'ashavxasxv asxab', 1511, '15', '10', 15, '2019-03-01 13:08:21', '2019-03-01 07:38:21', '1', '192.168.1.7'),
(234, '43', '77', '234', '100046', '2019-03-01 13:08:21', ' asjd casvjdcvas dcasvjdkcv', 11, '151', '4', 1, '2019-03-01 13:08:36', '2019-03-01 07:38:36', '1', '192.168.1.7'),
(235, '43', '77', '235', '100046', '2019-03-01 13:08:21', 'ashavxasxv asxab', 1511, '15', '10', 15, '2019-03-01 13:08:36', '2019-03-01 07:38:36', '1', '192.168.1.7'),
(236, '43', '77', '236', '100046', '2019-03-01 13:08:21', 'sd jkcvs', 1515, '151', '10', 151, '2019-03-01 13:08:36', '2019-03-01 07:38:36', '1', '192.168.1.7'),
(237, '43', '78', '237', '100046', '2019-03-01 13:08:21', ' asjd casvjdcvas dcasvjdkcv', 11, '151', '4', 1, '2019-03-01 13:09:59', '2019-03-01 07:39:59', '1', '192.168.1.7'),
(238, '43', '78', '238', '100046', '2019-03-01 13:08:21', 'ashavxasxv asxab', 1511, '15', '10', 15, '2019-03-01 13:09:59', '2019-03-01 07:39:59', '1', '192.168.1.7'),
(239, '43', '78', '239', '100046', '2019-03-01 13:08:21', 'sd jkcvs', 1515, '151', '10', 151, '2019-03-01 13:09:59', '2019-03-01 07:39:59', '1', '192.168.1.7'),
(240, '43', '78', '240', '100046', '2019-03-01 13:08:21', 'teser', 11, '11', '4', 121, '2019-03-01 13:09:59', '2019-03-01 07:39:59', '1', '192.168.1.7'),
(241, '43', '79', '241', '100046', '2019-03-01 13:08:21', ' asjd casvjdcvas dcasvjdkcv', 11, '151', '4', 1, '2019-03-01 13:10:08', '2019-03-01 07:40:08', '1', '192.168.1.7'),
(242, '43', '79', '242', '100046', '2019-03-01 13:08:21', 'ashavxasxv asxab', 1511, '15', '10', 15, '2019-03-01 13:10:08', '2019-03-01 07:40:08', '1', '192.168.1.7'),
(243, '43', '79', '243', '100046', '2019-03-01 13:08:21', 'sd jkcvs', 1515, '151', '10', 151, '2019-03-01 13:10:08', '2019-03-01 07:40:08', '1', '192.168.1.7'),
(244, '43', '79', '244', '100046', '2019-03-01 13:08:21', 'teser', 11, '11', '4', 121, '2019-03-01 13:10:08', '2019-03-01 07:40:08', '1', '192.168.1.7'),
(245, '44', '80', '245', '100047', '2019-03-01 13:32:45', '4', 1, '', '4', 1, '2019-03-01 13:32:45', '2019-03-01 08:02:45', '1', '192.168.1.7'),
(246, '44', '80', '246', '100047', '2019-03-01 13:32:45', '4', 2, '', '4', 2, '2019-03-01 13:32:45', '2019-03-01 08:02:45', '1', '192.168.1.7'),
(247, '44', '80', '247', '100047', '2019-03-01 13:32:45', '5', 3, '', '4', 5, '2019-03-01 13:32:45', '2019-03-01 08:02:45', '1', '192.168.1.7'),
(248, '44', '80', '248', '100047', '2019-03-01 13:32:45', '6', 6, '6', '4', 6, '2019-03-01 13:32:45', '2019-03-01 08:02:45', '1', '192.168.1.7'),
(249, '45', '81', '249', '100048', '2019-03-01 13:33:40', '4', 1, '', '4', 1, '2019-03-01 13:33:40', '2019-03-01 08:03:40', '1', '192.168.1.7'),
(250, '45', '81', '250', '100048', '2019-03-01 13:33:40', '4', 2, '', '4', 2, '2019-03-01 13:33:40', '2019-03-01 08:03:40', '1', '192.168.1.7'),
(251, '45', '81', '251', '100048', '2019-03-01 13:33:40', '5', 3, '', '4', 5, '2019-03-01 13:33:40', '2019-03-01 08:03:40', '1', '192.168.1.7'),
(252, '45', '81', '252', '100048', '2019-03-01 13:33:40', '6', 6, '6', '4', 6, '2019-03-01 13:33:40', '2019-03-01 08:03:40', '1', '192.168.1.7'),
(253, '46', '82', '253', '100049', '2019-03-01 13:37:47', '4', 1, '2', '4', 1, '2019-03-01 13:37:47', '2019-03-01 08:07:47', '1', '192.168.1.7'),
(254, '46', '82', '254', '100049', '2019-03-01 13:37:48', '4', 2, '2', '4', 2, '2019-03-01 13:37:48', '2019-03-01 08:07:48', '1', '192.168.1.7'),
(255, '46', '82', '255', '100049', '2019-03-01 13:37:48', '5', 3, '2', '4', 5, '2019-03-01 13:37:48', '2019-03-01 08:07:48', '1', '192.168.1.7'),
(256, '46', '82', '256', '100049', '2019-03-01 13:37:48', '6', 6, '6', '4', 6, '2019-03-01 13:37:48', '2019-03-01 08:07:48', '1', '192.168.1.7'),
(257, '46', '83', '257', '100049', '2019-03-01 13:37:47', '4', 1, '2', '4', 1, '2019-03-01 13:38:08', '2019-03-01 08:08:08', '1', '192.168.1.7'),
(258, '46', '83', '258', '100049', '2019-03-01 13:37:47', '4', 2, '2', '4', 2, '2019-03-01 13:38:08', '2019-03-01 08:08:08', '1', '192.168.1.7'),
(259, '47', '84', '259', '100050', '2019-03-01 13:40:21', '4', 1, '2', '4', 1, '2019-03-01 13:40:21', '2019-03-01 08:10:21', '1', '192.168.1.7'),
(260, '47', '84', '260', '100050', '2019-03-01 13:40:21', '4', 2, '2', '4', 2, '2019-03-01 13:40:21', '2019-03-01 08:10:21', '1', '192.168.1.7'),
(261, '47', '84', '261', '100050', '2019-03-01 13:40:21', '1112', 121, '121', '3', 12, '2019-03-01 13:40:21', '2019-03-01 08:10:21', '1', '192.168.1.7'),
(262, '48', '85', '262', '100051', '2019-03-01 13:42:04', '4', 1, '2', '4', 1, '2019-03-01 13:42:04', '2019-03-01 08:12:04', '1', '192.168.1.7'),
(263, '48', '85', '263', '100051', '2019-03-01 13:42:04', '4', 2, '2', '4', 2, '2019-03-01 13:42:04', '2019-03-01 08:12:04', '1', '192.168.1.7'),
(264, '48', '85', '264', '100051', '2019-03-01 13:42:04', '1112', 121, '121', '3', 12, '2019-03-01 13:42:04', '2019-03-01 08:12:04', '1', '192.168.1.7'),
(265, '48', '86', '265', '100051', '2019-03-01 13:42:03', '4', 1, '2', '4', 1, '2019-03-01 13:45:51', '2019-03-01 08:15:51', '1', '192.168.1.7'),
(266, '48', '86', '266', '100051', '2019-03-01 13:42:03', '4', 2, '2', '4', 2, '2019-03-01 13:45:51', '2019-03-01 08:15:51', '1', '192.168.1.7'),
(267, '48', '86', '267', '100051', '2019-03-01 13:42:03', '1112', 121, '121', '3', 12, '2019-03-01 13:45:51', '2019-03-01 08:15:51', '1', '192.168.1.7'),
(268, '48', '86', '268', '100051', '2019-03-01 13:42:03', '1151', 1515, '1151', '1', 15, '2019-03-01 13:45:52', '2019-03-01 08:15:52', '1', '192.168.1.7'),
(269, '49', '87', '269', '100052', '2019-03-01 13:46:47', '151', 11, '11', '1', 151, '2019-03-01 13:46:47', '2019-03-01 08:16:47', '1', '192.168.1.7'),
(270, '49', '87', '270', '100052', '2019-03-01 13:46:47', '11', 11, '11', '3', 11, '2019-03-01 13:46:47', '2019-03-01 08:16:47', '1', '192.168.1.7'),
(271, '49', '88', '271', '100052', '2019-03-01 13:46:47', '151', 11, '11', '1', 151, '2019-03-01 13:47:04', '2019-03-01 08:17:04', '1', '192.168.1.7'),
(272, '49', '88', '272', '100052', '2019-03-01 13:46:47', '11', 11, '11', '3', 11, '2019-03-01 13:47:04', '2019-03-01 08:17:04', '1', '192.168.1.7'),
(273, '49', '88', '273', '100052', '2019-03-01 13:46:47', '33', 3, '3', '1', 3, '2019-03-01 13:47:04', '2019-03-01 08:17:04', '1', '192.168.1.7'),
(274, '49', '89', '274', '100052', '2019-03-01 13:46:47', '151', 11, '11', '1', 151, '2019-03-01 13:47:18', '2019-03-01 08:17:18', '1', '192.168.1.7'),
(275, '49', '89', '275', '100052', '2019-03-01 13:46:47', '11', 11, '11', '3', 11, '2019-03-01 13:47:18', '2019-03-01 08:17:18', '1', '192.168.1.7'),
(276, '49', '89', '276', '100052', '2019-03-01 13:46:47', '33', 3, '3', '1', 3, '2019-03-01 13:47:19', '2019-03-01 08:17:19', '1', '192.168.1.7'),
(277, '49', '89', '277', '100052', '2019-03-01 13:46:47', '22', 2, '2', '1', 54, '2019-03-01 13:47:19', '2019-03-01 08:17:19', '1', '192.168.1.7'),
(278, '49', '90', '278', '100052', '2019-03-01 13:46:47', '151', 11, '11', '1', 151, '2019-03-01 13:47:39', '2019-03-01 08:17:39', '1', '192.168.1.7'),
(279, '49', '90', '279', '100052', '2019-03-01 13:46:47', '11', 11, '11', '3', 11, '2019-03-01 13:47:39', '2019-03-01 08:17:39', '1', '192.168.1.7'),
(280, '49', '90', '280', '100052', '2019-03-01 13:46:47', '33', 3, '3', '1', 3, '2019-03-01 13:47:39', '2019-03-01 08:17:39', '1', '192.168.1.7'),
(281, '49', '90', '281', '100052', '2019-03-01 13:46:47', '22', 2, '2', '1', 54, '2019-03-01 13:47:39', '2019-03-01 08:17:39', '1', '192.168.1.7'),
(282, '49', '90', '282', '100052', '2019-03-01 13:46:47', '33', 33, '3', '1', 3, '2019-03-01 13:47:39', '2019-03-01 08:17:39', '1', '192.168.1.7'),
(283, '50', '91', '283', '100053', '2019-03-02 11:29:58', ' jsdfasdfv fb dafv dfvasdfkv vaklsdfv aksdlfv aklsdfv l', 150, '11111', '3', 1500, '2019-03-02 11:29:58', '2019-03-02 05:59:58', '1', '192.168.1.25'),
(284, '50', '91', '284', '100053', '2019-03-02 11:29:58', 'as jkdhasj dvasvashkl vslvslkfv saklfv asklfvbasklvbas kl vaskl vasbklj asvb skav asvbl svbs vbsvsaklvasklv asvb asklv askfvb asfvb skadfvb sfvbasklbv sak ', 155, '222222', '3', 2000, '2019-03-02 11:29:58', '2019-03-02 05:59:58', '1', '192.168.1.25'),
(285, '51', '92', '285', 'DL-2019-100054', '2019-03-02 14:45:42', 'd fjvbh', 151, '151', '10', 151, '2019-03-02 14:45:42', '2019-03-02 09:15:42', '1', '192.168.1.25'),
(286, '52', '93', '286', 'DL-2019-0001', '2019-03-02 17:25:14', ' dfv dkdl dkdbl', 4151, '151', '1', 150, '2019-03-02 17:25:14', '2019-03-02 11:55:14', '4', '192.168.1.25'),
(287, '52', '93', '287', 'DL-2019-0001', '2019-03-02 17:25:14', 'jvhsk', 151, '151', '3', 15, '2019-03-02 17:25:14', '2019-03-02 11:55:14', '4', '192.168.1.25');

-- --------------------------------------------------------

--
-- Table structure for table `estimate`
--

CREATE TABLE `estimate` (
  `auto_id` bigint(20) NOT NULL,
  `est_main_id` varchar(255) DEFAULT NULL,
  `customer_id` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `bill_number` varchar(255) DEFAULT NULL,
  `particular_field` text,
  `amount` float DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` varchar(255) DEFAULT NULL,
  `updated_ipaddress` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `estimate`
--

INSERT INTO `estimate` (`auto_id`, `est_main_id`, `customer_id`, `company_name`, `customer_name`, `bill_number`, `particular_field`, `amount`, `created_at`, `updated_at`, `user_id`, `updated_ipaddress`) VALUES
(15, '3', '1', NULL, NULL, '100007', 'sx', 100, '2019-02-18 12:29:50', '2019-02-18 06:59:50', '1', '192.168.1.15'),
(16, '3', '1', NULL, NULL, '100007', 'asa', 100, '2019-02-18 12:29:50', '2019-02-18 06:59:50', '1', '192.168.1.15'),
(17, '2', '10', NULL, NULL, '100006', 'ADFAS CDA WQE WDCAS WV W QWECW QWCVAWS SDKFVB JKDF  BKDFV', 2500, '2019-02-18 12:34:49', '2019-02-18 07:04:49', '1', '192.168.1.15'),
(18, '2', '10', NULL, NULL, '100006', 'XZ  N   KSF KJS SJDN JSBN AWHAW', 300, '2019-02-18 12:34:49', '2019-02-18 07:04:49', '1', '192.168.1.15'),
(19, '2', '10', NULL, NULL, '100006', 'KBF JSBDF WEO', 250, '2019-02-18 12:34:50', '2019-02-18 07:04:50', '1', '192.168.1.15'),
(20, '2', '10', NULL, NULL, '100006', 'JFVJN JOSFVNN  JFV JBVBJ WUERFH', 300, '2019-02-18 12:34:50', '2019-02-18 07:04:50', '1', '192.168.1.15'),
(21, '2', '10', NULL, NULL, '100006', 'BHFDV JSDFV IOWEIO VSO', 300, '2019-02-18 12:34:50', '2019-02-18 07:04:50', '1', '192.168.1.15'),
(22, '2', '10', NULL, NULL, '100006', 'FMN FVNOO WOEFNNN WL', 300, '2019-02-18 12:34:50', '2019-02-18 07:04:50', '1', '192.168.1.15'),
(25, '4', '10', NULL, NULL, '100008', 'as sfkv  sk aov aovh ouperg sdjfb opgbo oeirg sdnfb', 250, '2019-02-18 16:29:17', '2019-02-18 10:59:17', '1', '192.168.1.15'),
(26, '4', '10', NULL, NULL, '100008', 'sfvsd bdsbsdg bgdsdgbbdfsfb bsdfb', 5500, '2019-02-18 16:29:17', '2019-02-18 10:59:17', '1', '192.168.1.15'),
(27, '4', '10', NULL, NULL, '100008', 'df  rgbrt hthw nemtuj qawef  bwebhwrth etyj sdfvasdfgwth y tejtjt fg', 500, '2019-02-18 16:29:17', '2019-02-18 10:59:17', '1', '192.168.1.15'),
(30, '5', '11', NULL, NULL, '100009', 'test1', 12222, '2019-02-19 16:44:43', '2019-02-19 11:14:43', '1', '192.168.1.30'),
(31, '5', '11', NULL, NULL, '100009', 'test2', 2000, '2019-02-19 16:44:43', '2019-02-19 11:14:43', '1', '192.168.1.30'),
(32, '5', '11', NULL, NULL, '100009', 'twst2', 3000, '2019-02-19 16:44:43', '2019-02-19 11:14:43', '1', '192.168.1.30'),
(33, '8', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100010', 'dfkv', 500, '2019-02-20 11:06:24', '2019-02-20 05:36:24', '1', '192.168.1.15'),
(34, '8', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100010', 'sdfv', 500, '2019-02-20 11:06:24', '2019-02-20 05:36:24', '1', '192.168.1.15'),
(35, '8', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100010', 'fgbk', 500, '2019-02-20 11:06:24', '2019-02-20 05:36:24', '1', '192.168.1.15'),
(36, '9', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100011', 'asdcasd', 500, '2019-02-20 11:09:52', '2019-02-20 05:39:52', '1', '192.168.1.15'),
(37, '9', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100011', 'asvsv', 500, '2019-02-20 11:09:52', '2019-02-20 05:39:52', '1', '192.168.1.15'),
(38, '10', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100012', 'sadfv,', 500, '2019-02-20 11:13:35', '2019-02-20 05:43:35', '1', '192.168.1.15'),
(39, '10', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100012', 'dfvdbfv', 500, '2019-02-20 11:13:36', '2019-02-20 05:43:36', '1', '192.168.1.15'),
(40, '10', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100012', 'sdfgbon', 500, '2019-02-20 11:13:36', '2019-02-20 05:43:36', '1', '192.168.1.15'),
(41, '10', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100012', 'sgjdibdnv', 500, '2019-02-20 11:13:36', '2019-02-20 05:43:36', '1', '192.168.1.15'),
(42, '11', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100013', 'ncl', 500, '2019-02-20 11:21:56', '2019-02-20 05:51:56', '1', '192.168.1.15'),
(43, '11', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100013', 'sdfgb', 500, '2019-02-20 11:21:56', '2019-02-20 05:51:56', '1', '192.168.1.15'),
(44, '11', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100013', 'asdcvas', 500, '2019-02-20 11:21:56', '2019-02-20 05:51:56', '1', '192.168.1.15'),
(48, '12', '19', 'Vidhun Enterprises', 'Geetha', '100014', 'asdcvn;s', 500, '2019-02-20 12:03:57', '2019-02-20 06:33:57', '1', '192.168.1.15'),
(49, '12', '19', 'Vidhun Enterprises', 'Geetha', '100014', 'asdvn', 500, '2019-02-20 12:03:57', '2019-02-20 06:33:57', '1', '192.168.1.15'),
(50, '12', '19', 'Vidhun Enterprises', 'Geetha', '100014', 'doasfvn', 500, '2019-02-20 12:03:57', '2019-02-20 06:33:57', '1', '192.168.1.15'),
(51, '12', '19', 'Vidhun Enterprises', 'Geetha', '100014', 'dfopnv', 500, '2019-02-20 12:03:57', '2019-02-20 06:33:57', '1', '192.168.1.15'),
(52, '13', '19', 'Vidhun Enterprises', 'Geetha', '100015', 'dlfv', 500, '2019-02-20 12:05:08', '2019-02-20 06:35:08', '1', '192.168.1.15'),
(53, '14', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100016', 'sdfvldfvbdld', 500, '2019-02-20 12:08:15', '2019-02-20 06:38:15', '1', '192.168.1.15'),
(54, '14', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100016', 'salvkdbsdv', 500, '2019-02-20 12:08:15', '2019-02-20 06:38:15', '1', '192.168.1.15'),
(60, '15', '19', 'Vidhun Enterprises', 'Geetha', '100017', 'awdklbasbldb sialdvb lsabvlas lasbvas asudvasdpaw asopudgvaspudov lasugpvguasdvasbdvuioasdgv asdfgvas9pva9pwvgqawvb lasdgvpuasdvasbdvbuioasdvbasdfpvbasdfpvasdfvpasvbpa asvag9fvgpasu9vasvb  asopuvsopdvuasv asiodvbasdiobvasdopvbasdvapgwodufgqwp9fvawpvqawvbb asodvaspdawfwo wpfgvuoasdv asiopudgvdgopawdvawdlvawpvuwa awuopvgawdvb', 500, '2019-02-20 12:16:11', '2019-02-20 06:46:11', '1', '192.168.1.15'),
(61, '15', '19', 'Vidhun Enterprises', 'Geetha', '100017', 'sdlfvbsdpf sdioufvpsdfivbsdfvfv baspergvpase9ovpagovwefu[qwpefpwagf vaogvuapsvasldvbaspdugvaw9prfguaw vaosidgvuapwgvfupvqawdboasbdvba aopvagwp awpdvguapw9gvuawpvuaw aspdfuvioapwdvgqwp9fgvqw pawruvaspdvupaw wpr9gvu pgwp9irgpqwru9gvqwr9pvqwrvqw pgv9pwg', 2000, '2019-02-20 12:16:11', '2019-02-20 06:46:11', '1', '192.168.1.15'),
(62, '15', '19', 'Vidhun Enterprises', 'Geetha', '100017', 'asdvcasdv asl;dbovpasdv[aso aposdvbaspdvba apsodbv as[dv aspoduvasudvas aspdfvu asfgvp  apsdfou asp[fb as pasfouv [apsfv posfb pasdb dafvu9pasfp[v paosudfv[asgvasfgv[asv aspfouvas[gvba pasofv[asfgv vapwouv[p0pvabf;vb paosfv', 3000, '2019-02-20 12:16:11', '2019-02-20 06:46:11', '1', '192.168.1.15'),
(66, '17', '19', 'Vidhun Enterprises', 'Geetha', '100019', 'sd sd sd  sd s d sd vs dvs dv ', 500, '2019-02-20 12:48:55', '2019-02-20 07:18:55', '1', '192.168.1.15'),
(67, '17', '19', 'Vidhun Enterprises', 'Geetha', '100019', 'sdc ak sdc  aksd ca sdcakc ak ca akca a ca', 500, '2019-02-20 12:48:55', '2019-02-20 07:18:55', '1', '192.168.1.15'),
(68, '16', '11', 'Sai Group of Companies', 'Sai', '100018', 'P1 shfs c iishfj fewjsfjs   fif josdmfs  aijdi wekiw dmf sjfofpwokf', 1000, '2019-02-20 12:52:38', '2019-02-20 07:22:38', '1', '192.168.1.30'),
(69, '16', '11', 'Sai Group of Companies', 'Sai', '100018', 'P2 lkjhgyuj k lksdjioakl;dkjfhu8oepwfj hbnmklmnvbhaoiuoivopl,kjuoi okj oppoia okaj ipoelv', 2000, '2019-02-20 12:52:38', '2019-02-20 07:22:38', '1', '192.168.1.30'),
(70, '16', '11', 'Sai Group of Companies', 'Sai', '100018', 'P3 jhuoi u ioiuwopoek njvhbh[;fasajiodkjsfkdlddfsfl;s [p;d.eweofklds.,eefojkldm,', 3000, '2019-02-20 12:52:38', '2019-02-20 07:22:38', '1', '192.168.1.30'),
(71, '16', '11', 'Sai Group of Companies', 'Sai', '100018', 'P4 pokjhgfdewqwedfgbnjui poiuytrtghnhu7k, jhgffcvcdefghj', 1000.5, '2019-02-20 12:52:38', '2019-02-20 07:22:38', '1', '192.168.1.30'),
(72, '18', '19', 'Vidhun Enterprises', 'Geetha', '100020', '1 sjfsfjsf ', 2, '2019-02-20 15:46:08', '2019-02-20 10:16:08', '1', '192.168.1.14'),
(73, '18', '19', 'Vidhun Enterprises', 'Geetha', '100020', '2 fsldfnnksfsm ', 22, '2019-02-20 15:46:08', '2019-02-20 10:16:08', '1', '192.168.1.14'),
(74, '18', '19', 'Vidhun Enterprises', 'Geetha', '100020', '3pokmnjijhgv', 23, '2019-02-20 15:46:08', '2019-02-20 10:16:08', '1', '192.168.1.14'),
(93, '26', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100028', '1', 1, '2019-02-21 15:49:27', '2019-02-21 10:19:27', '1', '192.168.1.15'),
(94, '26', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100028', '2', 2, '2019-02-21 15:49:27', '2019-02-21 10:19:27', '1', '192.168.1.15'),
(95, '26', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100028', '3', 3, '2019-02-21 15:49:27', '2019-02-21 10:19:27', '1', '192.168.1.15'),
(96, '27', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100029', 'l', 1, '2019-02-21 15:54:25', '2019-02-21 10:24:25', '1', '192.168.1.15'),
(97, '27', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100029', 'k', 1, '2019-02-21 15:54:25', '2019-02-21 10:24:25', '1', '192.168.1.15'),
(98, '28', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100030', '12', 12, '2019-02-21 15:54:54', '2019-02-21 10:24:54', '1', '192.168.1.15'),
(99, '29', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100031', '1', 1, '2019-02-21 15:55:59', '2019-02-21 10:25:59', '1', '192.168.1.15'),
(100, '29', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100031', '2', 2, '2019-02-21 15:55:59', '2019-02-21 10:25:59', '1', '192.168.1.15'),
(101, '29', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100031', '3', 3, '2019-02-21 15:55:59', '2019-02-21 10:25:59', '1', '192.168.1.15'),
(102, '29', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100031', '4', 4, '2019-02-21 15:55:59', '2019-02-21 10:25:59', '1', '192.168.1.15'),
(103, '30', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100032', '1', 1, '2019-02-21 16:31:57', '2019-02-21 11:01:57', '1', '192.168.1.15'),
(104, '31', '21', 'asvjas', 'sdkfj', '100033', '12', 12, '2019-02-21 16:32:41', '2019-02-21 11:02:41', '1', '192.168.1.15'),
(105, '32', '19', 'Vidhun Enterprises', 'Geetha', '100034', '1', 1, '2019-02-21 16:33:58', '2019-02-21 11:03:58', '1', '192.168.1.15'),
(106, '33', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100035', '1', 21, '2019-02-21 16:34:20', '2019-02-21 11:04:20', '1', '192.168.1.15'),
(107, '34', '13', 'lucky vaccines', 'gopal', '100036', '1', 1, '2019-02-21 16:34:46', '2019-02-21 11:04:46', '1', '192.168.1.15'),
(108, '35', '11', 'Sai Group of Companies', 'Sai', '100037', '1', 1, '2019-02-21 16:34:58', '2019-02-21 11:04:58', '1', '192.168.1.15'),
(109, '36', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100038', '1', 12, '2019-02-21 16:35:33', '2019-02-21 11:05:33', '1', '192.168.1.15'),
(110, '37', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100039', '1', 1, '2019-02-21 16:41:43', '2019-02-21 11:11:43', '1', '192.168.1.15'),
(117, '38', '12', 'Meera ', 'Meera', '100040', 'kl', 1, '2019-02-21 17:50:48', '2019-02-21 12:20:48', '1', '192.168.1.15'),
(118, '38', '12', 'Meera ', 'Meera', '100040', '23', 23, '2019-02-21 17:50:48', '2019-02-21 12:20:48', '1', '192.168.1.15'),
(119, '38', '12', 'Meera ', 'Meera', '100040', '56', 56, '2019-02-21 17:50:48', '2019-02-21 12:20:48', '1', '192.168.1.15'),
(120, '39', '21', 'asvjas', 'sdkfj', '100041', 'yu', 1, '2019-02-21 17:55:10', '2019-02-21 12:25:10', '1', '192.168.1.15'),
(121, '39', '21', 'asvjas', 'sdkfj', '100041', 'ui', 2, '2019-02-21 17:55:10', '2019-02-21 12:25:10', '1', '192.168.1.15'),
(122, '40', '19', 'Vidhun Enterprises', 'Geetha', '100042', '1', 1, '2019-02-21 18:51:42', '2019-02-21 13:21:42', '1', '192.168.1.15'),
(123, '41', '19', 'Vidhun Enterprises', 'Geetha', '100043', '1', 1, '2019-02-21 18:51:44', '2019-02-21 13:21:44', '1', '192.168.1.15'),
(127, '45', '20', 'communist pvt ltd', 'chanfru', '100047', 'u', 1, '2019-02-21 18:56:21', '2019-02-21 13:26:21', '1', '192.168.1.15'),
(128, '46', '8', 'gb', 'sdfg', '100048', 'a', 5, '2019-02-21 19:19:12', '2019-02-21 13:49:12', '1', '192.168.1.15'),
(129, '47', '19', 'Vidhun Enterprises', 'Geetha', '100049', 'a', 1, '2019-02-21 19:20:07', '2019-02-21 13:50:07', '1', '192.168.1.15'),
(130, '48', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100050', 'aa', 4, '2019-02-21 19:23:40', '2019-02-21 13:53:40', '1', '192.168.1.15'),
(131, '49', '8', 'gb', 'sdfg', '100051', 'a', 1, '2019-02-21 19:24:16', '2019-02-21 13:54:16', '1', '192.168.1.15'),
(132, '50', '19', 'Vidhun Enterprises', 'Geetha', '100052', 'a', 1, '2019-02-21 19:24:45', '2019-02-21 13:54:45', '1', '192.168.1.15'),
(133, '51', '19', 'Vidhun Enterprises', 'Geetha', '100053', 'a', 1, '2019-02-21 19:24:49', '2019-02-21 13:54:49', '1', '192.168.1.15'),
(134, '52', '5', 'GHNDN', 'FGBFGB', '100054', 'f', 1, '2019-02-21 19:32:45', '2019-02-21 14:02:45', '1', '192.168.1.15'),
(135, '53', '11', 'Sai Group of Companies', 'Sai', '100055', '1', 1, '2019-02-21 19:41:37', '2019-02-21 14:11:37', '1', '192.168.1.15'),
(136, '54', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100056', '1', 1, '2019-02-21 19:42:29', '2019-02-21 14:12:29', '1', '192.168.1.15'),
(137, '55', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100057', '1', 21, '2019-02-21 19:43:15', '2019-02-21 14:13:15', '1', '192.168.1.15'),
(138, '55', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100057', '2', 2, '2019-02-21 19:43:15', '2019-02-21 14:13:15', '1', '192.168.1.15'),
(139, '56', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100058', '1', 21, '2019-02-21 19:43:30', '2019-02-21 14:13:30', '1', '192.168.1.15'),
(140, '56', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100058', '2', 2, '2019-02-21 19:43:30', '2019-02-21 14:13:30', '1', '192.168.1.15'),
(141, '57', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100059', '1', 1, '2019-02-21 19:43:46', '2019-02-21 14:13:46', '1', '192.168.1.15'),
(142, '58', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100060', '1', 1, '2019-02-21 20:03:39', '2019-02-21 14:33:39', '1', '192.168.1.15'),
(143, '59', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100061', 'a', 1, '2019-02-21 20:32:45', '2019-02-21 15:02:45', '1', '192.168.1.15'),
(144, '60', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100062', 'a', 1, '2019-02-21 20:33:10', '2019-02-21 15:03:10', '1', '192.168.1.15'),
(145, '61', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100063', 'a', 1, '2019-02-21 20:35:05', '2019-02-21 15:05:05', '1', '192.168.1.15'),
(146, '62', '19', 'Vidhun Enterprises', 'Geetha', '100064', '1', 1, '2019-02-21 20:36:58', '2019-02-21 15:06:58', '1', '192.168.1.15'),
(147, '63', '19', 'Vidhun Enterprises', 'Geetha', '100065', '1', 1, '2019-02-21 20:44:57', '2019-02-21 15:14:57', '1', '192.168.1.15'),
(148, '64', '19', 'Vidhun Enterprises', 'Geetha', '100066', '1', 1, '2019-02-21 20:45:53', '2019-02-21 15:15:53', '1', '192.168.1.15'),
(149, '65', '20', 'communist pvt ltd', 'chanfru', '100067', '1', 1, '2019-02-21 20:46:47', '2019-02-21 15:16:47', '1', '192.168.1.15'),
(150, '66', '19', 'Vidhun Enterprises', 'Geetha', '100068', '1', 1, '2019-02-21 20:49:34', '2019-02-21 15:19:34', '1', '192.168.1.15'),
(151, '67', '19', 'Vidhun Enterprises', 'Geetha', '100069', '1', 1, '2019-02-21 20:51:00', '2019-02-21 15:21:00', '1', '192.168.1.15'),
(152, '68', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100070', '1', 1, '2019-02-21 20:56:48', '2019-02-21 15:26:48', '1', '192.168.1.15'),
(153, '69', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100071', '1', 1, '2019-02-21 20:56:52', '2019-02-21 15:26:52', '1', '192.168.1.15'),
(154, '70', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100072', '1', 1, '2019-02-21 21:22:49', '2019-02-21 15:52:49', '1', '192.168.1.15'),
(155, '71', '8', 'gb', 'sdfg', '100073', '1', 1, '2019-02-22 12:35:17', '2019-02-22 07:05:17', '1', '192.168.1.15'),
(156, '71', '8', 'gb', 'sdfg', '100073', '2', 2, '2019-02-22 12:35:17', '2019-02-22 07:05:17', '1', '192.168.1.15'),
(157, '72', '8', 'gb', 'sdfg', '100074', '1', 1, '2019-02-22 12:35:48', '2019-02-22 07:05:48', '1', '192.168.1.15'),
(158, '72', '8', 'gb', 'sdfg', '100074', '2', 2, '2019-02-22 12:35:48', '2019-02-22 07:05:48', '1', '192.168.1.15'),
(161, '75', '19', 'Vidhun Enterprises', 'Geetha', '100077', '1', 1, '2019-02-22 12:37:28', '2019-02-22 07:07:28', '1', '192.168.1.15'),
(162, '76', '19', 'Vidhun Enterprises', 'Geetha', '100078', '1', 1, '2019-02-22 12:37:34', '2019-02-22 07:07:34', '1', '192.168.1.15'),
(163, '77', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100079', '1', 1, '2019-02-22 12:40:08', '2019-02-22 07:10:08', '1', '192.168.1.15'),
(164, '78', '4', 'hkadc`', 'sbdnk', '100080', '1', 1, '2019-02-22 12:40:38', '2019-02-22 07:10:38', '1', '192.168.1.15'),
(165, '79', '11', 'Sai Group of Companies', 'Sai', '100081', '1', 1, '2019-02-22 12:41:00', '2019-02-22 07:11:00', '1', '192.168.1.15'),
(166, '80', '5', 'GHNDN', 'FGBFGB', '100082', '1', 1, '2019-02-22 12:41:15', '2019-02-22 07:11:15', '1', '192.168.1.15'),
(167, '81', '11', 'Sai Group of Companies', 'Sai', '100083', '1', 1, '2019-02-22 12:41:29', '2019-02-22 07:11:29', '1', '192.168.1.15'),
(168, '82', '19', 'Vidhun Enterprises', 'Geetha', '100084', '1', 1, '2019-02-22 12:42:05', '2019-02-22 07:12:05', '1', '192.168.1.15'),
(169, '83', '20', 'communist pvt ltd', 'chanfru', '100085', '1', 1, '2019-02-22 12:44:03', '2019-02-22 07:14:03', '1', '192.168.1.15'),
(170, '83', '20', 'communist pvt ltd', 'chanfru', '100085', '2', 2, '2019-02-22 12:44:03', '2019-02-22 07:14:03', '1', '192.168.1.15'),
(171, '84', '11', 'Sai Group of Companies', 'Sai', '100086', '1', 1, '2019-02-22 12:44:53', '2019-02-22 07:14:53', '1', '192.168.1.15'),
(176, '86', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100088', '1', 1, '2019-02-22 12:57:18', '2019-02-22 07:27:18', '1', '192.168.1.15'),
(177, '86', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100088', '1', 1, '2019-02-22 12:57:18', '2019-02-22 07:27:18', '1', '192.168.1.15'),
(178, '86', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100088', '2', 22, '2019-02-22 12:57:18', '2019-02-22 07:27:18', '1', '192.168.1.15'),
(179, '85', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100087', '1', 1, '2019-02-22 12:57:53', '2019-02-22 07:27:53', '1', '192.168.1.15'),
(180, '85', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100087', '1', 1, '2019-02-22 12:57:53', '2019-02-22 07:27:53', '1', '192.168.1.15'),
(181, '85', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100087', '2', 2, '2019-02-22 12:57:53', '2019-02-22 07:27:53', '1', '192.168.1.15'),
(182, '87', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100089', '1', 1, '2019-02-22 13:03:25', '2019-02-22 07:33:25', '1', '192.168.1.15'),
(183, '88', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100090', 'sl;av asvas \' dvsafvsdkfvdo;sfjvsdbnsdopfbn sdpon asdopfv dofsdnopoasdfj ', 2, '2019-02-22 13:04:26', '2019-02-22 07:34:26', '1', '192.168.1.15'),
(184, '88', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100090', 'asdfv aopvasdfov ', 2, '2019-02-22 13:04:27', '2019-02-22 07:34:27', '1', '192.168.1.15'),
(185, '89', '1', 'asdfasd', 'sdafasdf', '100091', '121', 1, '2019-02-22 13:05:07', '2019-02-22 07:35:07', '1', '192.168.1.15'),
(186, '90', '20', 'communist pvt ltd', 'chanfru', '100092', '12', 12, '2019-02-22 13:05:29', '2019-02-22 07:35:29', '1', '192.168.1.15'),
(187, '91', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100093', '1', 1, '2019-02-22 13:06:10', '2019-02-22 07:36:10', '1', '192.168.1.15'),
(188, '92', '11', 'Sai Group of Companies', 'Sai', '100094', '21231231', 123, '2019-02-22 13:06:42', '2019-02-22 07:36:42', '1', '192.168.1.15'),
(189, '93', '11', 'Sai Group of Companies', 'Sai', '100095', '1', 1, '2019-02-22 13:13:20', '2019-02-22 07:43:20', '1', '192.168.1.15'),
(190, '94', '19', 'Vidhun Enterprises', 'Geetha', '100096', '1', 1, '2019-02-22 13:15:08', '2019-02-22 07:45:08', '1', '192.168.1.15'),
(193, '95', '19', 'Vidhun Enterprises', 'Geetha', '100097', 'dk d vasdklbv kdv abdklv bdklvb', 1500, '2019-02-25 16:20:51', '2019-02-25 10:50:51', '1', '192.168.1.20'),
(194, '95', '19', 'Vidhun Enterprises', 'Geetha', '100097', 'sdbd dafv asdkfv askfvaskfvbas kfv ', 1500, '2019-02-25 16:20:51', '2019-02-25 10:50:51', '1', '192.168.1.20'),
(195, '95', '19', 'Vidhun Enterprises', 'Geetha', '100097', 'svks ldv', 500, '2019-02-25 16:20:51', '2019-02-25 10:50:51', '1', '192.168.1.20'),
(196, '95', '19', 'Vidhun Enterprises', 'Geetha', '100097', ' sdkvs', 500, '2019-02-25 16:20:51', '2019-02-25 10:50:51', '1', '192.168.1.20'),
(200, '96', '19', 'Vidhun Enterprises', 'Geetha', '100098', 'TEST', 1000, '2019-02-28 10:53:30', '2019-02-28 05:23:30', '1', '192.168.1.7'),
(201, '96', '19', 'Vidhun Enterprises', 'Geetha', '100098', 'Test @', 2000, '2019-02-28 10:53:30', '2019-02-28 05:23:30', '1', '192.168.1.7'),
(202, '96', '19', 'Vidhun Enterprises', 'Geetha', '100098', 'Test 3', 3000, '2019-02-28 10:53:30', '2019-02-28 05:23:30', '1', '192.168.1.7'),
(203, '97', '19', 'Vidhun Enterprises', 'Geetha', '100099', 'test', 111, '2019-02-28 11:13:02', '2019-02-28 05:43:02', '1', '192.168.1.3'),
(204, '97', '19', 'Vidhun Enterprises', 'Geetha', '100099', 'test', 111, '2019-02-28 11:13:02', '2019-02-28 05:43:02', '1', '192.168.1.3'),
(205, '97', '19', 'Vidhun Enterprises', 'Geetha', '100099', 'test', 111, '2019-02-28 11:13:02', '2019-02-28 05:43:02', '1', '192.168.1.3'),
(206, '98', '23', 'tendulkar', 'ten', '100100', '16', 16, '2019-02-28 12:11:03', '2019-02-28 06:41:03', '1', '192.168.1.7'),
(207, '98', '23', 'tendulkar', 'ten', '100100', 'bljk', 1516, '2019-02-28 12:11:03', '2019-02-28 06:41:03', '1', '192.168.1.7'),
(210, '99', '26', 'Hanifa & Co', 'Hani', '100101', '300 Envelop', 3000, '2019-02-28 18:19:49', '2019-02-28 12:49:49', '1', '192.168.1.7'),
(211, '99', '26', 'Hanifa & Co', 'Hani', '100101', '500 Business Cards', 2500, '2019-02-28 18:19:49', '2019-02-28 12:49:49', '1', '192.168.1.7'),
(212, '100', '23', 'tendulkar', 'ten', '100102', 'vjg', 1, '2019-02-28 18:20:17', '2019-02-28 12:50:17', '1', '192.168.1.7'),
(213, '101', '5', 'GHNDN', 'FGBFGB', '100103', 'asd jkv', 1541, '2019-02-28 20:59:52', '2019-02-28 15:29:52', '1', '192.168.1.7'),
(217, '102', '27', 'dhoni pvt ltd', 'dhoni', '100104', 'TEST1', 1, '2019-03-01 12:59:37', '2019-03-01 07:29:37', '1', '192.168.1.7'),
(218, '102', '27', 'dhoni pvt ltd', 'dhoni', '100104', 'TEST2', 12, '2019-03-01 12:59:37', '2019-03-01 07:29:37', '1', '192.168.1.7'),
(219, '102', '27', 'dhoni pvt ltd', 'dhoni', '100104', 'TEST3', 121, '2019-03-01 12:59:37', '2019-03-01 07:29:37', '1', '192.168.1.7'),
(220, '102', '27', 'dhoni pvt ltd', 'dhoni', '100104', 'TEST4', 262, '2019-03-01 12:59:37', '2019-03-01 07:29:37', '1', '192.168.1.7'),
(224, '103', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100105', 'sdfjk vsdjkfvasj', 151, '2019-03-01 13:12:43', '2019-03-01 07:42:43', '1', '192.168.1.7'),
(225, '103', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100105', 'as djcvasd', 150, '2019-03-01 13:12:43', '2019-03-01 07:42:43', '1', '192.168.1.7'),
(226, '103', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100105', 'sad cgsv', 151, '2019-03-01 13:12:43', '2019-03-01 07:42:43', '1', '192.168.1.7'),
(231, '104', '13', 'lucky vaccines', 'gopal', '100106', '4', 1, '2019-03-01 13:30:52', '2019-03-01 08:00:52', '1', '192.168.1.7'),
(232, '104', '13', 'lucky vaccines', 'gopal', '100106', '4', 2, '2019-03-01 13:30:52', '2019-03-01 08:00:52', '1', '192.168.1.7'),
(233, '104', '13', 'lucky vaccines', 'gopal', '100106', '5', 5, '2019-03-01 13:30:52', '2019-03-01 08:00:52', '1', '192.168.1.7'),
(234, '105', '27', 'dhoni pvt ltd', 'dhoni', '100107', '151', 151, '2019-03-01 13:46:19', '2019-03-01 08:16:19', '1', '192.168.1.7'),
(235, '106', '23', 'tendulkar', 'ten', '100108', 'tessd;d vsd  sdv sdvl;', 150, '2019-03-02 11:00:29', '2019-03-02 05:30:29', '1', '192.168.1.25'),
(236, '106', '23', 'tendulkar', 'ten', '100108', 'kdsgbj sd;bnsd dbl;b sdlfb sdlfb sd', 151, '2019-03-02 11:00:29', '2019-03-02 05:30:29', '1', '192.168.1.25'),
(237, '107', '23', 'tendulkar', 'ten', 'EST-2019-100109', ' dfv dkdl dkdbl', 150, '2019-03-02 13:57:10', '2019-03-02 08:27:10', '1', '192.168.1.25');

-- --------------------------------------------------------

--
-- Table structure for table `estimate_log`
--

CREATE TABLE `estimate_log` (
  `auto_id` bigint(20) NOT NULL,
  `estimate_main_tbl_log` varchar(255) DEFAULT NULL,
  `estimate_id` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `bill_number` varchar(255) DEFAULT NULL,
  `particular_field` text,
  `amount` float DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` varchar(255) DEFAULT NULL,
  `updated_ipaddress` varchar(255) DEFAULT NULL,
  `customer_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `estimate_log`
--

INSERT INTO `estimate_log` (`auto_id`, `estimate_main_tbl_log`, `estimate_id`, `company_name`, `customer_name`, `bill_number`, `particular_field`, `amount`, `created_at`, `updated_at`, `user_id`, `updated_ipaddress`, `customer_id`) VALUES
(1, '1', '1', NULL, NULL, '100005', 'skcb adba adcbk', 2, '2019-02-16 17:13:17', '2019-02-16 11:43:17', '1', '192.168.1.29', '5'),
(2, '1', '2', NULL, NULL, '100005', 'sdbk', 2, '2019-02-16 17:13:17', '2019-02-16 11:43:17', '1', '192.168.1.29', '5'),
(3, '1', '3', NULL, NULL, '100005', 'dsdcs sfdvsvsdv sdvs', 2, '2019-02-16 17:13:18', '2019-02-16 11:43:17', '1', '192.168.1.29', '5'),
(4, '2', '4', NULL, NULL, '100005', 'sdbk', 2, '2019-02-16 17:14:28', '2019-02-16 11:44:28', '1', '192.168.1.29', '5'),
(5, '3', '5', NULL, NULL, '100006', 'ADFAS CDA WQE WDCAS WV W QWECW QWCVAWS SDKFVB JKDF  BKDFV', 2500, '2019-02-18 10:52:40', '2019-02-18 05:22:40', '1', '192.168.1.15', '10'),
(6, '3', '6', NULL, NULL, '100006', 'XZ  N   KSF KJS SJDN JSBN AWHAW', 300, '2019-02-18 10:52:40', '2019-02-18 05:22:40', '1', '192.168.1.15', '10'),
(7, '3', '7', NULL, NULL, '100006', 'KBF JSBDF WEO', 250, '2019-02-18 10:52:40', '2019-02-18 05:22:40', '1', '192.168.1.15', '10'),
(8, '3', '8', NULL, NULL, '100006', 'JFVJN JOSFVNN  JFV JBVBJ WUERFH', 300, '2019-02-18 10:52:40', '2019-02-18 05:22:40', '1', '192.168.1.15', '10'),
(9, '3', '9', NULL, NULL, '100006', 'BHFDV JSDFV IOWEIO VSO', 300, '2019-02-18 10:52:40', '2019-02-18 05:22:40', '1', '192.168.1.15', '10'),
(10, '3', '10', NULL, NULL, '100006', 'FMN FVNOO WOEFNNN WL', 300, '2019-02-18 10:52:40', '2019-02-18 05:22:40', '1', '192.168.1.15', '10'),
(11, '4', '11', NULL, NULL, '100007', 'sx', 100, '2019-02-18 12:23:08', '2019-02-18 06:53:08', '1', '192.168.1.15', '1'),
(12, '4', '12', NULL, NULL, '100007', 'asa', 100, '2019-02-18 12:23:08', '2019-02-18 06:53:08', '1', '192.168.1.15', '1'),
(13, '5', '13', NULL, NULL, '100007', 'sx', 100, '2019-02-18 12:26:59', '2019-02-18 06:56:59', '1', '192.168.1.15', '1'),
(14, '5', '14', NULL, NULL, '100007', 'asa', 100, '2019-02-18 12:27:00', '2019-02-18 06:57:00', '1', '192.168.1.15', '1'),
(15, '6', '15', NULL, NULL, '100007', 'sx', 100, '2019-02-18 12:29:50', '2019-02-18 06:59:50', '1', '192.168.1.15', '1'),
(16, '6', '16', NULL, NULL, '100007', 'asa', 100, '2019-02-18 12:29:50', '2019-02-18 06:59:50', '1', '192.168.1.15', '1'),
(17, '7', '17', NULL, NULL, '100006', 'ADFAS CDA WQE WDCAS WV W QWECW QWCVAWS SDKFVB JKDF  BKDFV', 2500, '2019-02-18 12:34:49', '2019-02-18 07:04:49', '1', '192.168.1.15', '10'),
(18, '7', '18', NULL, NULL, '100006', 'XZ  N   KSF KJS SJDN JSBN AWHAW', 300, '2019-02-18 12:34:49', '2019-02-18 07:04:49', '1', '192.168.1.15', '10'),
(19, '7', '19', NULL, NULL, '100006', 'KBF JSBDF WEO', 250, '2019-02-18 12:34:50', '2019-02-18 07:04:50', '1', '192.168.1.15', '10'),
(20, '7', '20', NULL, NULL, '100006', 'JFVJN JOSFVNN  JFV JBVBJ WUERFH', 300, '2019-02-18 12:34:50', '2019-02-18 07:04:50', '1', '192.168.1.15', '10'),
(21, '7', '21', NULL, NULL, '100006', 'BHFDV JSDFV IOWEIO VSO', 300, '2019-02-18 12:34:50', '2019-02-18 07:04:50', '1', '192.168.1.15', '10'),
(22, '7', '22', NULL, NULL, '100006', 'FMN FVNOO WOEFNNN WL', 300, '2019-02-18 12:34:50', '2019-02-18 07:04:50', '1', '192.168.1.15', '10'),
(23, '8', '23', NULL, NULL, '100008', 'as sfkv  sk aov aovh ouperg sdjfb opgbo oeirg sdnfb', 250, '2019-02-18 16:17:03', '2019-02-18 10:47:03', '1', '192.168.1.15', '10'),
(24, '8', '24', NULL, NULL, '100008', 'sfvsd bdsbsdg bgdsdgbbdfsfb bsdfb', 5500, '2019-02-18 16:17:03', '2019-02-18 10:47:03', '1', '192.168.1.15', '10'),
(25, '9', '25', NULL, NULL, '100008', 'as sfkv  sk aov aovh ouperg sdjfb opgbo oeirg sdnfb', 250, '2019-02-18 16:29:17', '2019-02-18 10:59:17', '1', '192.168.1.15', '10'),
(26, '9', '26', NULL, NULL, '100008', 'sfvsd bdsbsdg bgdsdgbbdfsfb bsdfb', 5500, '2019-02-18 16:29:17', '2019-02-18 10:59:17', '1', '192.168.1.15', '10'),
(27, '9', '27', NULL, NULL, '100008', 'df  rgbrt hthw nemtuj qawef  bwebhwrth etyj sdfvasdfgwth y tejtjt fg', 500, '2019-02-18 16:29:17', '2019-02-18 10:59:17', '1', '192.168.1.15', '10'),
(28, '10', '28', NULL, NULL, '100009', 'test1', 12222, '2019-02-19 16:41:34', '2019-02-19 11:11:34', '1', '192.168.1.30', '11'),
(29, '10', '29', NULL, NULL, '100009', 'test2', 2000, '2019-02-19 16:41:34', '2019-02-19 11:11:34', '1', '192.168.1.30', '11'),
(30, '11', '30', NULL, NULL, '100009', 'test1', 12222, '2019-02-19 16:44:43', '2019-02-19 11:14:43', '1', '192.168.1.30', '11'),
(31, '11', '31', NULL, NULL, '100009', 'test2', 2000, '2019-02-19 16:44:43', '2019-02-19 11:14:43', '1', '192.168.1.30', '11'),
(32, '11', '32', NULL, NULL, '100009', 'twst2', 3000, '2019-02-19 16:44:43', '2019-02-19 11:14:43', '1', '192.168.1.30', '11'),
(33, '14', '33', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100010', 'dfkv', 500, '2019-02-20 11:06:24', '2019-02-20 05:36:24', '1', '192.168.1.15', '10'),
(34, '14', '34', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100010', 'sdfv', 500, '2019-02-20 11:06:24', '2019-02-20 05:36:24', '1', '192.168.1.15', '10'),
(35, '14', '35', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100010', 'fgbk', 500, '2019-02-20 11:06:24', '2019-02-20 05:36:24', '1', '192.168.1.15', '10'),
(36, '15', '36', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100011', 'asdcasd', 500, '2019-02-20 11:09:52', '2019-02-20 05:39:52', '1', '192.168.1.15', '10'),
(37, '15', '37', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100011', 'asvsv', 500, '2019-02-20 11:09:52', '2019-02-20 05:39:52', '1', '192.168.1.15', '10'),
(38, '16', '38', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100012', 'sadfv,', 500, '2019-02-20 11:13:36', '2019-02-20 05:43:36', '1', '192.168.1.15', '10'),
(39, '16', '39', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100012', 'dfvdbfv', 500, '2019-02-20 11:13:36', '2019-02-20 05:43:36', '1', '192.168.1.15', '10'),
(40, '16', '40', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100012', 'sdfgbon', 500, '2019-02-20 11:13:36', '2019-02-20 05:43:36', '1', '192.168.1.15', '10'),
(41, '16', '41', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100012', 'sgjdibdnv', 500, '2019-02-20 11:13:36', '2019-02-20 05:43:36', '1', '192.168.1.15', '10'),
(42, '17', '42', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100013', 'ncl', 500, '2019-02-20 11:21:56', '2019-02-20 05:51:56', '1', '192.168.1.15', '10'),
(43, '17', '43', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100013', 'sdfgb', 500, '2019-02-20 11:21:56', '2019-02-20 05:51:56', '1', '192.168.1.15', '10'),
(44, '17', '44', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100013', 'asdcvas', 500, '2019-02-20 11:21:56', '2019-02-20 05:51:56', '1', '192.168.1.15', '10'),
(45, '18', '45', 'Vidhun Enterprises', 'Geetha', '100014', 'P1', 1000, '2019-02-20 11:32:46', '2019-02-20 06:02:46', '1', '192.168.1.14', '19'),
(46, '18', '46', 'Vidhun Enterprises', 'Geetha', '100014', 'P2', 2000, '2019-02-20 11:32:46', '2019-02-20 06:02:46', '1', '192.168.1.14', '19'),
(47, '18', '47', 'Vidhun Enterprises', 'Geetha', '100014', 'P3', 3000, '2019-02-20 11:32:46', '2019-02-20 06:02:46', '1', '192.168.1.14', '19'),
(48, '20', '48', 'Vidhun Enterprises', 'Geetha', '100014', 'asdcvn;s', 500, '2019-02-20 12:03:57', '2019-02-20 06:33:57', '1', '192.168.1.15', '19'),
(49, '20', '49', 'Vidhun Enterprises', 'Geetha', '100014', 'asdvn', 500, '2019-02-20 12:03:57', '2019-02-20 06:33:57', '1', '192.168.1.15', '19'),
(50, '20', '50', 'Vidhun Enterprises', 'Geetha', '100014', 'doasfvn', 500, '2019-02-20 12:03:57', '2019-02-20 06:33:57', '1', '192.168.1.15', '19'),
(51, '20', '51', 'Vidhun Enterprises', 'Geetha', '100014', 'dfopnv', 500, '2019-02-20 12:03:57', '2019-02-20 06:33:57', '1', '192.168.1.15', '19'),
(52, '21', '52', 'Vidhun Enterprises', 'Geetha', '100015', 'dlfv', 500, '2019-02-20 12:05:08', '2019-02-20 06:35:08', '1', '192.168.1.15', '19'),
(53, '22', '53', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100016', 'sdfvldfvbdld', 500, '2019-02-20 12:08:15', '2019-02-20 06:38:15', '1', '192.168.1.15', '10'),
(54, '22', '54', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100016', 'salvkdbsdv', 500, '2019-02-20 12:08:15', '2019-02-20 06:38:15', '1', '192.168.1.15', '10'),
(55, '23', '55', 'Vidhun Enterprises', 'Geetha', '100017', 'awdklbasbldb sialdvb lsabvlas lasbvas asudvasdpaw asopudgvaspudov lasugpvguasdvasbdvuioasdgv asdfgvas9pva9pwvgqawvb lasdgvpuasdvasbdvbuioasdvbasdfpvbasdfpvasdfvpasvbpa asvag9fvgpasu9vasvb  asopuvsopdvuasv asiodvbasdiobvasdopvbasdvapgwodufgqwp9fvawpvqawvbb asodvaspdawfwo wpfgvuoasdv asiopudgvdgopawdvawdlvawpvuwa awuopvgawdvb', 500, '2019-02-20 12:15:14', '2019-02-20 06:45:14', '1', '192.168.1.15', '19'),
(56, '23', '56', 'Vidhun Enterprises', 'Geetha', '100017', 'sdlfvbsdpf sdioufvpsdfivbsdfvfv baspergvpase9ovpagovwefu[qwpefpwagf vaogvuapsvasldvbaspdugvaw9prfguaw vaosidgvuapwgvfupvqawdboasbdvba aopvagwp awpdvguapw9gvuawpvuaw aspdfuvioapwdvgqwp9fgvqw pawruvaspdvupaw wpr9gvu pgwp9irgpqwru9gvqwr9pvqwrvqw pgv9pwg', 2000, '2019-02-20 12:15:14', '2019-02-20 06:45:14', '1', '192.168.1.15', '19'),
(57, '24', '57', 'Vidhun Enterprises', 'Geetha', '100017', 'awdklbasbldb sialdvb lsabvlas lasbvas asudvasdpaw asopudgvaspudov lasugpvguasdvasbdvuioasdgv asdfgvas9pva9pwvgqawvb lasdgvpuasdvasbdvbuioasdvbasdfpvbasdfpvasdfvpasvbpa asvag9fvgpasu9vasvb  asopuvsopdvuasv asiodvbasdiobvasdopvbasdvapgwodufgqwp9fvawpvqawvbb asodvaspdawfwo wpfgvuoasdv asiopudgvdgopawdvawdlvawpvuwa awuopvgawdvb', 500, '2019-02-20 12:15:50', '2019-02-20 06:45:50', '1', '192.168.1.15', '19'),
(58, '24', '58', 'Vidhun Enterprises', 'Geetha', '100017', 'sdlfvbsdpf sdioufvpsdfivbsdfvfv baspergvpase9ovpagovwefu[qwpefpwagf vaogvuapsvasldvbaspdugvaw9prfguaw vaosidgvuapwgvfupvqawdboasbdvba aopvagwp awpdvguapw9gvuawpvuaw aspdfuvioapwdvgqwp9fgvqw pawruvaspdvupaw wpr9gvu pgwp9irgpqwru9gvqwr9pvqwrvqw pgv9pwg', 2000, '2019-02-20 12:15:51', '2019-02-20 06:45:51', '1', '192.168.1.15', '19'),
(59, '24', '59', 'Vidhun Enterprises', 'Geetha', '100017', 'asdvcasdv asl;dbovpasdv[aso aposdvbaspdvba apsodbv as[dv aspoduvasudvas aspdfvu asfgvp  apsdfou asp[fb as pasfouv [apsfv posfb pasdb dafvu9pasfp[v paosudfv[asgvasfgv[asv aspfouvas[gvba pasofv[asfgv vapwouv[p0pvabf;vb paosfv', 3000, '2019-02-20 12:15:51', '2019-02-20 06:45:51', '1', '192.168.1.15', '19'),
(60, '25', '60', 'Vidhun Enterprises', 'Geetha', '100017', 'awdklbasbldb sialdvb lsabvlas lasbvas asudvasdpaw asopudgvaspudov lasugpvguasdvasbdvuioasdgv asdfgvas9pva9pwvgqawvb lasdgvpuasdvasbdvbuioasdvbasdfpvbasdfpvasdfvpasvbpa asvag9fvgpasu9vasvb  asopuvsopdvuasv asiodvbasdiobvasdopvbasdvapgwodufgqwp9fvawpvqawvbb asodvaspdawfwo wpfgvuoasdv asiopudgvdgopawdvawdlvawpvuwa awuopvgawdvb', 500, '2019-02-20 12:16:11', '2019-02-20 06:46:11', '1', '192.168.1.15', '19'),
(61, '25', '61', 'Vidhun Enterprises', 'Geetha', '100017', 'sdlfvbsdpf sdioufvpsdfivbsdfvfv baspergvpase9ovpagovwefu[qwpefpwagf vaogvuapsvasldvbaspdugvaw9prfguaw vaosidgvuapwgvfupvqawdboasbdvba aopvagwp awpdvguapw9gvuawpvuaw aspdfuvioapwdvgqwp9fgvqw pawruvaspdvupaw wpr9gvu pgwp9irgpqwru9gvqwr9pvqwrvqw pgv9pwg', 2000, '2019-02-20 12:16:11', '2019-02-20 06:46:11', '1', '192.168.1.15', '19'),
(62, '25', '62', 'Vidhun Enterprises', 'Geetha', '100017', 'asdvcasdv asl;dbovpasdv[aso aposdvbaspdvba apsodbv as[dv aspoduvasudvas aspdfvu asfgvp  apsdfou asp[fb as pasfouv [apsfv posfb pasdb dafvu9pasfp[v paosudfv[asgvasfgv[asv aspfouvas[gvba pasofv[asfgv vapwouv[p0pvabf;vb paosfv', 3000, '2019-02-20 12:16:11', '2019-02-20 06:46:11', '1', '192.168.1.15', '19'),
(63, '26', '63', 'Sai Group of Companies', 'Sai', '100018', 'P1 shfs c iishfj fewjsfjs   fif josdmfs  aijdi wekiw dmf sjfofpwokf', 1000, '2019-02-20 12:48:06', '2019-02-20 07:18:06', '1', '192.168.1.30', '11'),
(64, '26', '64', 'Sai Group of Companies', 'Sai', '100018', 'P2 lkjhgyuj k lksdjioakl;dkjfhu8oepwfj hbnmklmnvbhaoiuoivopl,kjuoi okj oppoia okaj ipoelv', 2000, '2019-02-20 12:48:06', '2019-02-20 07:18:06', '1', '192.168.1.30', '11'),
(65, '26', '65', 'Sai Group of Companies', 'Sai', '100018', 'P3 jhuoi u ioiuwopoek njvhbh[;fasajiodkjsfkdlddfsfl;s [p;d.eweofklds.,eefojkldm,', 3000, '2019-02-20 12:48:06', '2019-02-20 07:18:06', '1', '192.168.1.30', '11'),
(66, '27', '66', 'Vidhun Enterprises', 'Geetha', '100019', 'sd sd sd  sd s d sd vs dvs dv ', 500, '2019-02-20 12:48:55', '2019-02-20 07:18:55', '1', '192.168.1.15', '19'),
(67, '27', '67', 'Vidhun Enterprises', 'Geetha', '100019', 'sdc ak sdc  aksd ca sdcakc ak ca akca a ca', 500, '2019-02-20 12:48:55', '2019-02-20 07:18:55', '1', '192.168.1.15', '19'),
(68, '28', '68', 'Sai Group of Companies', 'Sai', '100018', 'P1 shfs c iishfj fewjsfjs   fif josdmfs  aijdi wekiw dmf sjfofpwokf', 1000, '2019-02-20 12:52:38', '2019-02-20 07:22:38', '1', '192.168.1.30', '11'),
(69, '28', '69', 'Sai Group of Companies', 'Sai', '100018', 'P2 lkjhgyuj k lksdjioakl;dkjfhu8oepwfj hbnmklmnvbhaoiuoivopl,kjuoi okj oppoia okaj ipoelv', 2000, '2019-02-20 12:52:38', '2019-02-20 07:22:38', '1', '192.168.1.30', '11'),
(70, '28', '70', 'Sai Group of Companies', 'Sai', '100018', 'P3 jhuoi u ioiuwopoek njvhbh[;fasajiodkjsfkdlddfsfl;s [p;d.eweofklds.,eefojkldm,', 3000, '2019-02-20 12:52:38', '2019-02-20 07:22:38', '1', '192.168.1.30', '11'),
(71, '28', '71', 'Sai Group of Companies', 'Sai', '100018', 'P4 pokjhgfdewqwedfgbnjui poiuytrtghnhu7k, jhgffcvcdefghj', 1000.5, '2019-02-20 12:52:38', '2019-02-20 07:22:38', '1', '192.168.1.30', '11'),
(72, '29', '72', 'Vidhun Enterprises', 'Geetha', '100020', '1 sjfsfjsf ', 2, '2019-02-20 15:46:08', '2019-02-20 10:16:08', '1', '192.168.1.14', '19'),
(73, '29', '73', 'Vidhun Enterprises', 'Geetha', '100020', '2 fsldfnnksfsm ', 22, '2019-02-20 15:46:08', '2019-02-20 10:16:08', '1', '192.168.1.14', '19'),
(74, '29', '74', 'Vidhun Enterprises', 'Geetha', '100020', '3pokmnjijhgv', 23, '2019-02-20 15:46:08', '2019-02-20 10:16:08', '1', '192.168.1.14', '19'),
(75, '30', '75', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100021', 'a', 1, '2019-02-21 15:43:01', '2019-02-21 10:13:01', '1', '192.168.1.15', '10'),
(76, '30', '76', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100021', '1', 2, '2019-02-21 15:43:01', '2019-02-21 10:13:01', '1', '192.168.1.15', '10'),
(77, '31', '77', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100022', '12', 12, '2019-02-21 15:44:17', '2019-02-21 10:14:17', '1', '192.168.1.15', '10'),
(78, '31', '78', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100022', '13', 13, '2019-02-21 15:44:18', '2019-02-21 10:14:18', '1', '192.168.1.15', '10'),
(79, '31', '79', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100022', '14', 14, '2019-02-21 15:44:18', '2019-02-21 10:14:18', '1', '192.168.1.15', '10'),
(80, '32', '80', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100023', '12', 12, '2019-02-21 15:44:18', '2019-02-21 10:14:18', '1', '192.168.1.15', '10'),
(81, '32', '81', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100023', '13', 13, '2019-02-21 15:44:18', '2019-02-21 10:14:18', '1', '192.168.1.15', '10'),
(82, '32', '82', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100023', '14', 14, '2019-02-21 15:44:18', '2019-02-21 10:14:18', '1', '192.168.1.15', '10'),
(83, '33', '83', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100024', '1', 1, '2019-02-21 15:44:52', '2019-02-21 10:14:52', '1', '192.168.1.15', '10'),
(84, '33', '84', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100024', '1', 2, '2019-02-21 15:44:52', '2019-02-21 10:14:52', '1', '192.168.1.15', '10'),
(85, '34', '85', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100025', '1', 1, '2019-02-21 15:44:55', '2019-02-21 10:14:55', '1', '192.168.1.15', '10'),
(86, '34', '86', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100025', '1', 2, '2019-02-21 15:44:55', '2019-02-21 10:14:55', '1', '192.168.1.15', '10'),
(87, '35', '87', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100026', '1', 1, '2019-02-21 15:46:52', '2019-02-21 10:16:52', '1', '192.168.1.15', '10'),
(88, '35', '88', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100026', '2', 2, '2019-02-21 15:46:52', '2019-02-21 10:16:52', '1', '192.168.1.15', '10'),
(89, '35', '89', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100026', '3', 3, '2019-02-21 15:46:52', '2019-02-21 10:16:52', '1', '192.168.1.15', '10'),
(90, '36', '90', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100027', 'jlnn', 1, '2019-02-21 15:48:49', '2019-02-21 10:18:49', '1', '192.168.1.15', '10'),
(91, '36', '91', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100027', 'jn', 2, '2019-02-21 15:48:49', '2019-02-21 10:18:49', '1', '192.168.1.15', '10'),
(92, '36', '92', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100027', 'jhvb', 3, '2019-02-21 15:48:49', '2019-02-21 10:18:49', '1', '192.168.1.15', '10'),
(93, '37', '93', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100028', '1', 1, '2019-02-21 15:49:27', '2019-02-21 10:19:27', '1', '192.168.1.15', '10'),
(94, '37', '94', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100028', '2', 2, '2019-02-21 15:49:27', '2019-02-21 10:19:27', '1', '192.168.1.15', '10'),
(95, '37', '95', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100028', '3', 3, '2019-02-21 15:49:27', '2019-02-21 10:19:27', '1', '192.168.1.15', '10'),
(96, '38', '96', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100029', 'l', 1, '2019-02-21 15:54:25', '2019-02-21 10:24:25', '1', '192.168.1.15', '10'),
(97, '38', '97', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100029', 'k', 1, '2019-02-21 15:54:25', '2019-02-21 10:24:25', '1', '192.168.1.15', '10'),
(98, '39', '98', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100030', '12', 12, '2019-02-21 15:54:54', '2019-02-21 10:24:54', '1', '192.168.1.15', '10'),
(99, '40', '99', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100031', '1', 1, '2019-02-21 15:55:59', '2019-02-21 10:25:59', '1', '192.168.1.15', '10'),
(100, '40', '100', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100031', '2', 2, '2019-02-21 15:55:59', '2019-02-21 10:25:59', '1', '192.168.1.15', '10'),
(101, '40', '101', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100031', '3', 3, '2019-02-21 15:55:59', '2019-02-21 10:25:59', '1', '192.168.1.15', '10'),
(102, '40', '102', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100031', '4', 4, '2019-02-21 15:55:59', '2019-02-21 10:25:59', '1', '192.168.1.15', '10'),
(103, '41', '103', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100032', '1', 1, '2019-02-21 16:31:57', '2019-02-21 11:01:57', '1', '192.168.1.15', '10'),
(104, '42', '104', 'asvjas', 'sdkfj', '100033', '12', 12, '2019-02-21 16:32:41', '2019-02-21 11:02:41', '1', '192.168.1.15', '21'),
(105, '43', '105', 'Vidhun Enterprises', 'Geetha', '100034', '1', 1, '2019-02-21 16:33:58', '2019-02-21 11:03:58', '1', '192.168.1.15', '19'),
(106, '44', '106', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100035', '1', 21, '2019-02-21 16:34:20', '2019-02-21 11:04:20', '1', '192.168.1.15', '10'),
(107, '45', '107', 'lucky vaccines', 'gopal', '100036', '1', 1, '2019-02-21 16:34:46', '2019-02-21 11:04:46', '1', '192.168.1.15', '13'),
(108, '46', '108', 'Sai Group of Companies', 'Sai', '100037', '1', 1, '2019-02-21 16:34:58', '2019-02-21 11:04:58', '1', '192.168.1.15', '11'),
(109, '47', '109', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100038', '1', 12, '2019-02-21 16:35:33', '2019-02-21 11:05:33', '1', '192.168.1.15', '10'),
(110, '48', '110', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100039', '1', 1, '2019-02-21 16:41:43', '2019-02-21 11:11:43', '1', '192.168.1.15', '10'),
(111, '49', '111', 'Meera ', 'Meera', '100040', 'kl', 1, '2019-02-21 16:42:07', '2019-02-21 11:12:07', '1', '192.168.1.15', '12'),
(112, '50', '112', 'Meera ', 'Meera', '100040', 'kl', 1, '2019-02-21 17:35:15', '2019-02-21 12:05:15', '1', '192.168.1.15', '12'),
(113, '50', '113', 'Meera ', 'Meera', '100040', '23', 23, '2019-02-21 17:35:15', '2019-02-21 12:05:15', '1', '192.168.1.15', '12'),
(114, '51', '114', 'Meera ', 'Meera', '100040', 'kl', 1, '2019-02-21 17:50:15', '2019-02-21 12:20:15', '1', '192.168.1.15', '12'),
(115, '51', '115', 'Meera ', 'Meera', '100040', '23', 23, '2019-02-21 17:50:15', '2019-02-21 12:20:15', '1', '192.168.1.15', '12'),
(116, '51', '116', 'Meera ', 'Meera', '100040', '56', 56, '2019-02-21 17:50:15', '2019-02-21 12:20:15', '1', '192.168.1.15', '12'),
(117, '52', '117', 'Meera ', 'Meera', '100040', 'kl', 1, '2019-02-21 17:50:48', '2019-02-21 12:20:48', '1', '192.168.1.15', '12'),
(118, '52', '118', 'Meera ', 'Meera', '100040', '23', 23, '2019-02-21 17:50:48', '2019-02-21 12:20:48', '1', '192.168.1.15', '12'),
(119, '52', '119', 'Meera ', 'Meera', '100040', '56', 56, '2019-02-21 17:50:48', '2019-02-21 12:20:48', '1', '192.168.1.15', '12'),
(120, '53', '120', 'asvjas', 'sdkfj', '100041', 'yu', 1, '2019-02-21 17:55:10', '2019-02-21 12:25:10', '1', '192.168.1.15', '21'),
(121, '53', '121', 'asvjas', 'sdkfj', '100041', 'ui', 2, '2019-02-21 17:55:10', '2019-02-21 12:25:10', '1', '192.168.1.15', '21'),
(122, '54', '122', 'Vidhun Enterprises', 'Geetha', '100042', '1', 1, '2019-02-21 18:51:42', '2019-02-21 13:21:42', '1', '192.168.1.15', '19'),
(123, '55', '123', 'Vidhun Enterprises', 'Geetha', '100043', '1', 1, '2019-02-21 18:51:44', '2019-02-21 13:21:44', '1', '192.168.1.15', '19'),
(124, '56', '124', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100044', '1', 1, '2019-02-21 18:52:15', '2019-02-21 13:22:15', '1', '192.168.1.15', '10'),
(125, '57', '125', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100045', '1', 1, '2019-02-21 18:52:17', '2019-02-21 13:22:17', '1', '192.168.1.15', '10'),
(126, '58', '126', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100046', '1', 1, '2019-02-21 18:52:18', '2019-02-21 13:22:18', '1', '192.168.1.15', '10'),
(127, '59', '127', 'communist pvt ltd', 'chanfru', '100047', 'u', 1, '2019-02-21 18:56:21', '2019-02-21 13:26:21', '1', '192.168.1.15', '20'),
(128, '60', '128', 'gb', 'sdfg', '100048', 'a', 5, '2019-02-21 19:19:12', '2019-02-21 13:49:12', '1', '192.168.1.15', '8'),
(129, '61', '129', 'Vidhun Enterprises', 'Geetha', '100049', 'a', 1, '2019-02-21 19:20:07', '2019-02-21 13:50:07', '1', '192.168.1.15', '19'),
(130, '62', '130', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100050', 'aa', 4, '2019-02-21 19:23:40', '2019-02-21 13:53:40', '1', '192.168.1.15', '10'),
(131, '63', '131', 'gb', 'sdfg', '100051', 'a', 1, '2019-02-21 19:24:17', '2019-02-21 13:54:17', '1', '192.168.1.15', '8'),
(132, '64', '132', 'Vidhun Enterprises', 'Geetha', '100052', 'a', 1, '2019-02-21 19:24:45', '2019-02-21 13:54:45', '1', '192.168.1.15', '19'),
(133, '65', '133', 'Vidhun Enterprises', 'Geetha', '100053', 'a', 1, '2019-02-21 19:24:49', '2019-02-21 13:54:49', '1', '192.168.1.15', '19'),
(134, '66', '134', 'GHNDN', 'FGBFGB', '100054', 'f', 1, '2019-02-21 19:32:45', '2019-02-21 14:02:45', '1', '192.168.1.15', '5'),
(135, '67', '135', 'Sai Group of Companies', 'Sai', '100055', '1', 1, '2019-02-21 19:41:37', '2019-02-21 14:11:37', '1', '192.168.1.15', '11'),
(136, '68', '136', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100056', '1', 1, '2019-02-21 19:42:29', '2019-02-21 14:12:29', '1', '192.168.1.15', '10'),
(137, '69', '137', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100057', '1', 21, '2019-02-21 19:43:15', '2019-02-21 14:13:15', '1', '192.168.1.15', '10'),
(138, '69', '138', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100057', '2', 2, '2019-02-21 19:43:15', '2019-02-21 14:13:15', '1', '192.168.1.15', '10'),
(139, '70', '139', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100058', '1', 21, '2019-02-21 19:43:30', '2019-02-21 14:13:30', '1', '192.168.1.15', '10'),
(140, '70', '140', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100058', '2', 2, '2019-02-21 19:43:30', '2019-02-21 14:13:30', '1', '192.168.1.15', '10'),
(141, '71', '141', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100059', '1', 1, '2019-02-21 19:43:46', '2019-02-21 14:13:46', '1', '192.168.1.15', '10'),
(142, '72', '142', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100060', '1', 1, '2019-02-21 20:03:39', '2019-02-21 14:33:39', '1', '192.168.1.15', '10'),
(143, '73', '143', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100061', 'a', 1, '2019-02-21 20:32:45', '2019-02-21 15:02:45', '1', '192.168.1.15', '10'),
(144, '74', '144', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100062', 'a', 1, '2019-02-21 20:33:10', '2019-02-21 15:03:10', '1', '192.168.1.15', '10'),
(145, '75', '145', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100063', 'a', 1, '2019-02-21 20:35:05', '2019-02-21 15:05:05', '1', '192.168.1.15', '10'),
(146, '76', '146', 'Vidhun Enterprises', 'Geetha', '100064', '1', 1, '2019-02-21 20:36:58', '2019-02-21 15:06:58', '1', '192.168.1.15', '19'),
(147, '77', '147', 'Vidhun Enterprises', 'Geetha', '100065', '1', 1, '2019-02-21 20:44:57', '2019-02-21 15:14:57', '1', '192.168.1.15', '19'),
(148, '78', '148', 'Vidhun Enterprises', 'Geetha', '100066', '1', 1, '2019-02-21 20:45:53', '2019-02-21 15:15:53', '1', '192.168.1.15', '19'),
(149, '79', '149', 'communist pvt ltd', 'chanfru', '100067', '1', 1, '2019-02-21 20:46:47', '2019-02-21 15:16:47', '1', '192.168.1.15', '20'),
(150, '80', '150', 'Vidhun Enterprises', 'Geetha', '100068', '1', 1, '2019-02-21 20:49:34', '2019-02-21 15:19:34', '1', '192.168.1.15', '19'),
(151, '81', '151', 'Vidhun Enterprises', 'Geetha', '100069', '1', 1, '2019-02-21 20:51:00', '2019-02-21 15:21:00', '1', '192.168.1.15', '19'),
(152, '82', '152', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100070', '1', 1, '2019-02-21 20:56:48', '2019-02-21 15:26:48', '1', '192.168.1.15', '10'),
(153, '83', '153', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100071', '1', 1, '2019-02-21 20:56:52', '2019-02-21 15:26:52', '1', '192.168.1.15', '10'),
(154, '84', '154', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100072', '1', 1, '2019-02-21 21:22:49', '2019-02-21 15:52:49', '1', '192.168.1.15', '10'),
(155, '85', '155', 'gb', 'sdfg', '100073', '1', 1, '2019-02-22 12:35:17', '2019-02-22 07:05:17', '1', '192.168.1.15', '8'),
(156, '85', '156', 'gb', 'sdfg', '100073', '2', 2, '2019-02-22 12:35:17', '2019-02-22 07:05:17', '1', '192.168.1.15', '8'),
(157, '86', '157', 'gb', 'sdfg', '100074', '1', 1, '2019-02-22 12:35:48', '2019-02-22 07:05:48', '1', '192.168.1.15', '8'),
(158, '86', '158', 'gb', 'sdfg', '100074', '2', 2, '2019-02-22 12:35:49', '2019-02-22 07:05:49', '1', '192.168.1.15', '8'),
(159, '87', '159', 'Vidhun Enterprises', 'Geetha', '100075', '1', 1, '2019-02-22 12:36:19', '2019-02-22 07:06:19', '1', '192.168.1.15', '19'),
(160, '88', '160', 'Vidhun Enterprises', 'Geetha', '100076', '1', 1, '2019-02-22 12:36:20', '2019-02-22 07:06:20', '1', '192.168.1.15', '19'),
(161, '89', '161', 'Vidhun Enterprises', 'Geetha', '100077', '1', 1, '2019-02-22 12:37:28', '2019-02-22 07:07:28', '1', '192.168.1.15', '19'),
(162, '90', '162', 'Vidhun Enterprises', 'Geetha', '100078', '1', 1, '2019-02-22 12:37:34', '2019-02-22 07:07:34', '1', '192.168.1.15', '19'),
(163, '91', '163', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100079', '1', 1, '2019-02-22 12:40:08', '2019-02-22 07:10:08', '1', '192.168.1.15', '10'),
(164, '92', '164', 'hkadc`', 'sbdnk', '100080', '1', 1, '2019-02-22 12:40:38', '2019-02-22 07:10:38', '1', '192.168.1.15', '4'),
(165, '93', '165', 'Sai Group of Companies', 'Sai', '100081', '1', 1, '2019-02-22 12:41:00', '2019-02-22 07:11:00', '1', '192.168.1.15', '11'),
(166, '94', '166', 'GHNDN', 'FGBFGB', '100082', '1', 1, '2019-02-22 12:41:15', '2019-02-22 07:11:15', '1', '192.168.1.15', '5'),
(167, '95', '167', 'Sai Group of Companies', 'Sai', '100083', '1', 1, '2019-02-22 12:41:29', '2019-02-22 07:11:29', '1', '192.168.1.15', '11'),
(168, '96', '168', 'Vidhun Enterprises', 'Geetha', '100084', '1', 1, '2019-02-22 12:42:05', '2019-02-22 07:12:05', '1', '192.168.1.15', '19'),
(169, '97', '169', 'communist pvt ltd', 'chanfru', '100085', '1', 1, '2019-02-22 12:44:03', '2019-02-22 07:14:03', '1', '192.168.1.15', '20'),
(170, '97', '170', 'communist pvt ltd', 'chanfru', '100085', '2', 2, '2019-02-22 12:44:03', '2019-02-22 07:14:03', '1', '192.168.1.15', '20'),
(171, '98', '171', 'Sai Group of Companies', 'Sai', '100086', '1', 1, '2019-02-22 12:44:53', '2019-02-22 07:14:53', '1', '192.168.1.15', '11'),
(172, '99', '172', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100087', '1', 1, '2019-02-22 12:47:51', '2019-02-22 07:17:51', '1', '192.168.1.15', '10'),
(173, '100', '173', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100088', '1', 1, '2019-02-22 12:48:16', '2019-02-22 07:18:16', '1', '192.168.1.15', '10'),
(174, '101', '174', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100088', '1', 1, '2019-02-22 12:56:44', '2019-02-22 07:26:44', '1', '192.168.1.15', '10'),
(175, '101', '175', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100088', '1', 1, '2019-02-22 12:56:44', '2019-02-22 07:26:44', '1', '192.168.1.15', '10'),
(176, '102', '176', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100088', '1', 1, '2019-02-22 12:57:18', '2019-02-22 07:27:18', '1', '192.168.1.15', '10'),
(177, '102', '177', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100088', '1', 1, '2019-02-22 12:57:18', '2019-02-22 07:27:18', '1', '192.168.1.15', '10'),
(178, '102', '178', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100088', '2', 22, '2019-02-22 12:57:18', '2019-02-22 07:27:18', '1', '192.168.1.15', '10'),
(179, '103', '179', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100087', '1', 1, '2019-02-22 12:57:53', '2019-02-22 07:27:53', '1', '192.168.1.15', '10'),
(180, '103', '180', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100087', '1', 1, '2019-02-22 12:57:53', '2019-02-22 07:27:53', '1', '192.168.1.15', '10'),
(181, '103', '181', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100087', '2', 2, '2019-02-22 12:57:53', '2019-02-22 07:27:53', '1', '192.168.1.15', '10'),
(182, '104', '182', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100089', '1', 1, '2019-02-22 13:03:25', '2019-02-22 07:33:25', '1', '192.168.1.15', '10'),
(183, '105', '183', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100090', 'sl;av asvas \' dvsafvsdkfvdo;sfjvsdbnsdopfbn sdpon asdopfv dofsdnopoasdfj ', 2, '2019-02-22 13:04:27', '2019-02-22 07:34:27', '1', '192.168.1.15', '10'),
(184, '105', '184', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100090', 'asdfv aopvasdfov ', 2, '2019-02-22 13:04:27', '2019-02-22 07:34:27', '1', '192.168.1.15', '10'),
(185, '106', '185', 'asdfasd', 'sdafasdf', '100091', '121', 1, '2019-02-22 13:05:07', '2019-02-22 07:35:07', '1', '192.168.1.15', '1'),
(186, '107', '186', 'communist pvt ltd', 'chanfru', '100092', '12', 12, '2019-02-22 13:05:29', '2019-02-22 07:35:29', '1', '192.168.1.15', '20'),
(187, '108', '187', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100093', '1', 1, '2019-02-22 13:06:10', '2019-02-22 07:36:10', '1', '192.168.1.15', '10'),
(188, '109', '188', 'Sai Group of Companies', 'Sai', '100094', '21231231', 123, '2019-02-22 13:06:42', '2019-02-22 07:36:42', '1', '192.168.1.15', '11'),
(189, '110', '189', 'Sai Group of Companies', 'Sai', '100095', '1', 1, '2019-02-22 13:13:20', '2019-02-22 07:43:20', '1', '192.168.1.15', '11'),
(190, '111', '190', 'Vidhun Enterprises', 'Geetha', '100096', '1', 1, '2019-02-22 13:15:08', '2019-02-22 07:45:08', '1', '192.168.1.15', '19'),
(191, '112', '191', 'Vidhun Enterprises', 'Geetha', '100097', 'dk d vasdklbv kdv abdklv bdklvb', 1500, '2019-02-25 16:16:08', '2019-02-25 10:46:08', '1', '192.168.1.20', '19'),
(192, '112', '192', 'Vidhun Enterprises', 'Geetha', '100097', 'sdbd dafv asdkfv askfvaskfvbas kfv ', 1500, '2019-02-25 16:16:08', '2019-02-25 10:46:08', '1', '192.168.1.20', '19'),
(193, '113', '193', 'Vidhun Enterprises', 'Geetha', '100097', 'dk d vasdklbv kdv abdklv bdklvb', 1500, '2019-02-25 16:20:51', '2019-02-25 10:50:51', '1', '192.168.1.20', '19'),
(194, '113', '194', 'Vidhun Enterprises', 'Geetha', '100097', 'sdbd dafv asdkfv askfvaskfvbas kfv ', 1500, '2019-02-25 16:20:51', '2019-02-25 10:50:51', '1', '192.168.1.20', '19'),
(195, '113', '195', 'Vidhun Enterprises', 'Geetha', '100097', 'svks ldv', 500, '2019-02-25 16:20:51', '2019-02-25 10:50:51', '1', '192.168.1.20', '19'),
(196, '113', '196', 'Vidhun Enterprises', 'Geetha', '100097', ' sdkvs', 500, '2019-02-25 16:20:51', '2019-02-25 10:50:51', '1', '192.168.1.20', '19'),
(197, '114', '197', 'Vidhun Enterprises', 'Geetha', '100098', 'TEST', 1000, '2019-02-27 19:36:00', '2019-02-27 14:06:00', '1', '192.168.1.62', '19'),
(198, '114', '198', 'Vidhun Enterprises', 'Geetha', '100098', 'Test @', 2000, '2019-02-27 19:36:00', '2019-02-27 14:06:00', '1', '192.168.1.62', '19'),
(199, '114', '199', 'Vidhun Enterprises', 'Geetha', '100098', 'Test 3', 3000, '2019-02-27 19:36:00', '2019-02-27 14:06:00', '1', '192.168.1.62', '19'),
(200, '115', '200', 'Vidhun Enterprises', 'Geetha', '100098', 'TEST', 1000, '2019-02-28 10:53:30', '2019-02-28 05:23:30', '1', '192.168.1.7', '19'),
(201, '115', '201', 'Vidhun Enterprises', 'Geetha', '100098', 'Test @', 2000, '2019-02-28 10:53:30', '2019-02-28 05:23:30', '1', '192.168.1.7', '19'),
(202, '115', '202', 'Vidhun Enterprises', 'Geetha', '100098', 'Test 3', 3000, '2019-02-28 10:53:30', '2019-02-28 05:23:30', '1', '192.168.1.7', '19'),
(203, '116', '203', 'Vidhun Enterprises', 'Geetha', '100099', 'test', 111, '2019-02-28 11:13:02', '2019-02-28 05:43:02', '1', '192.168.1.3', '19'),
(204, '116', '204', 'Vidhun Enterprises', 'Geetha', '100099', 'test', 111, '2019-02-28 11:13:02', '2019-02-28 05:43:02', '1', '192.168.1.3', '19'),
(205, '116', '205', 'Vidhun Enterprises', 'Geetha', '100099', 'test', 111, '2019-02-28 11:13:02', '2019-02-28 05:43:02', '1', '192.168.1.3', '19'),
(206, '117', '206', 'tendulkar', 'ten', '100100', '16', 16, '2019-02-28 12:11:03', '2019-02-28 06:41:03', '1', '192.168.1.7', '23'),
(207, '117', '207', 'tendulkar', 'ten', '100100', 'bljk', 1516, '2019-02-28 12:11:03', '2019-02-28 06:41:03', '1', '192.168.1.7', '23'),
(208, '118', '208', 'Hanifa & Co', 'Hani', '100101', '300 Envelop', 3000, '2019-02-28 17:51:33', '2019-02-28 12:21:33', '1', '192.168.1.3', '26'),
(209, '118', '209', 'Hanifa & Co', 'Hani', '100101', '500 Business Cards', 2500, '2019-02-28 17:51:33', '2019-02-28 12:21:33', '1', '192.168.1.3', '26'),
(210, '119', '210', 'Hanifa & Co', 'Hani', '100101', '300 Envelop', 3000, '2019-02-28 18:19:49', '2019-02-28 12:49:49', '1', '192.168.1.7', '26'),
(211, '119', '211', 'Hanifa & Co', 'Hani', '100101', '500 Business Cards', 2500, '2019-02-28 18:19:49', '2019-02-28 12:49:49', '1', '192.168.1.7', '26'),
(212, '120', '212', 'tendulkar', 'ten', '100102', 'vjg', 1, '2019-02-28 18:20:17', '2019-02-28 12:50:17', '1', '192.168.1.7', '23'),
(213, '121', '213', 'GHNDN', 'FGBFGB', '100103', 'asd jkv', 1541, '2019-02-28 20:59:52', '2019-02-28 15:29:52', '1', '192.168.1.7', '5'),
(214, '122', '214', 'dhoni pvt ltd', 'dhoni', '100104', 'TYTYT', 1, '2019-03-01 12:58:37', '2019-03-01 07:28:37', '1', '192.168.1.7', '27'),
(215, '122', '215', 'dhoni pvt ltd', 'dhoni', '100104', 'WWWW', 12, '2019-03-01 12:58:38', '2019-03-01 07:28:38', '1', '192.168.1.7', '27'),
(216, '122', '216', 'dhoni pvt ltd', 'dhoni', '100104', 'OOOO', 121, '2019-03-01 12:58:38', '2019-03-01 07:28:38', '1', '192.168.1.7', '27'),
(217, '123', '217', 'dhoni pvt ltd', 'dhoni', '100104', 'TEST1', 1, '2019-03-01 12:59:37', '2019-03-01 07:29:37', '1', '192.168.1.7', '27'),
(218, '123', '218', 'dhoni pvt ltd', 'dhoni', '100104', 'TEST2', 12, '2019-03-01 12:59:37', '2019-03-01 07:29:37', '1', '192.168.1.7', '27'),
(219, '123', '219', 'dhoni pvt ltd', 'dhoni', '100104', 'TEST3', 121, '2019-03-01 12:59:37', '2019-03-01 07:29:37', '1', '192.168.1.7', '27'),
(220, '123', '220', 'dhoni pvt ltd', 'dhoni', '100104', 'TEST4', 262, '2019-03-01 12:59:37', '2019-03-01 07:29:37', '1', '192.168.1.7', '27'),
(221, '124', '221', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100105', 'sdfjk vsdjkfvasj', 151, '2019-03-01 13:12:30', '2019-03-01 07:42:30', '1', '192.168.1.7', '10'),
(222, '124', '222', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100105', 'as djcvasd', 150, '2019-03-01 13:12:30', '2019-03-01 07:42:30', '1', '192.168.1.7', '10'),
(223, '124', '223', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100105', 'sad cgsv', 151, '2019-03-01 13:12:30', '2019-03-01 07:42:30', '1', '192.168.1.7', '10'),
(224, '125', '224', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100105', 'sdfjk vsdjkfvasj', 151, '2019-03-01 13:12:43', '2019-03-01 07:42:43', '1', '192.168.1.7', '10'),
(225, '125', '225', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100105', 'as djcvasd', 150, '2019-03-01 13:12:43', '2019-03-01 07:42:43', '1', '192.168.1.7', '10'),
(226, '125', '226', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100105', 'sad cgsv', 151, '2019-03-01 13:12:43', '2019-03-01 07:42:43', '1', '192.168.1.7', '10'),
(227, '126', '227', 'lucky vaccines', 'gopal', '100106', '1', 1, '2019-03-01 13:29:52', '2019-03-01 07:59:52', '1', '192.168.1.7', '13'),
(228, '126', '228', 'lucky vaccines', 'gopal', '100106', '2', 2, '2019-03-01 13:29:52', '2019-03-01 07:59:52', '1', '192.168.1.7', '13'),
(229, '127', '229', 'lucky vaccines', 'gopal', '100106', '3', 1, '2019-03-01 13:30:23', '2019-03-01 08:00:23', '1', '192.168.1.7', '13'),
(230, '127', '230', 'lucky vaccines', 'gopal', '100106', '3', 2, '2019-03-01 13:30:23', '2019-03-01 08:00:23', '1', '192.168.1.7', '13'),
(231, '128', '231', 'lucky vaccines', 'gopal', '100106', '4', 1, '2019-03-01 13:30:52', '2019-03-01 08:00:52', '1', '192.168.1.7', '13'),
(232, '128', '232', 'lucky vaccines', 'gopal', '100106', '4', 2, '2019-03-01 13:30:52', '2019-03-01 08:00:52', '1', '192.168.1.7', '13'),
(233, '128', '233', 'lucky vaccines', 'gopal', '100106', '5', 5, '2019-03-01 13:30:52', '2019-03-01 08:00:52', '1', '192.168.1.7', '13'),
(234, '129', '234', 'dhoni pvt ltd', 'dhoni', '100107', '151', 151, '2019-03-01 13:46:19', '2019-03-01 08:16:19', '1', '192.168.1.7', '27'),
(235, '130', '235', 'tendulkar', 'ten', '100108', 'tessd;d vsd  sdv sdvl;', 150, '2019-03-02 11:00:29', '2019-03-02 05:30:29', '1', '192.168.1.25', '23'),
(236, '130', '236', 'tendulkar', 'ten', '100108', 'kdsgbj sd;bnsd dbl;b sdlfb sdlfb sd', 151, '2019-03-02 11:00:29', '2019-03-02 05:30:29', '1', '192.168.1.25', '23'),
(237, '131', '237', 'tendulkar', 'ten', 'EST-2019-100109', ' dfv dkdl dkdbl', 150, '2019-03-02 13:57:10', '2019-03-02 08:27:10', '1', '192.168.1.25', '23');

-- --------------------------------------------------------

--
-- Table structure for table `estimate_main_tbl`
--

CREATE TABLE `estimate_main_tbl` (
  `id` bigint(20) NOT NULL,
  `convert_status` varchar(255) DEFAULT NULL,
  `convert_delivery_id` varchar(255) DEFAULT NULL,
  `customer_id` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `bill_number` varchar(255) DEFAULT NULL,
  `gst` varchar(255) DEFAULT NULL,
  `gst_type` varchar(255) DEFAULT NULL,
  `gst_percent` float DEFAULT NULL,
  `cgst_percent` float DEFAULT NULL,
  `sgst_percent` float DEFAULT NULL,
  `sac` varchar(255) DEFAULT NULL,
  `total_amount` float DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` varchar(255) DEFAULT NULL,
  `updated_ipaddress` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `estimate_main_tbl`
--

INSERT INTO `estimate_main_tbl` (`id`, `convert_status`, `convert_delivery_id`, `customer_id`, `company_name`, `customer_name`, `bill_number`, `gst`, `gst_type`, `gst_percent`, `cgst_percent`, `sgst_percent`, `sac`, `total_amount`, `created_at`, `updated_at`, `user_id`, `updated_ipaddress`) VALUES
(2, NULL, NULL, '10', NULL, 'Novotel Chennai Sipcot', '100006', '4', NULL, NULL, NULL, NULL, '1234', 3950, '2019-02-18 18:52:40', '2019-02-18 07:04:49', '1', '192.168.1.15'),
(3, NULL, NULL, '1', NULL, 'asdfasd', '100007', '2', NULL, NULL, NULL, NULL, '100202', 200, '2019-02-18 12:23:08', '2019-02-18 06:59:50', '1', '192.168.1.15'),
(4, NULL, NULL, '10', NULL, 'Novotel Chennai Sipcot', '100008', '4', NULL, NULL, NULL, NULL, '2510', 6250, '2019-02-18 16:17:03', '2019-02-18 10:59:17', '1', '192.168.1.15'),
(5, NULL, NULL, '11', NULL, 'Sai Group of Companies', '100009', '3', NULL, NULL, NULL, NULL, 'test', 17222, '2019-02-19 16:41:33', '2019-02-19 11:14:43', '1', '192.168.1.30'),
(6, NULL, NULL, '10', NULL, 'Novotel Chennai Sipcot', '100010', '1', 'GST', 0, 0, 0, '2222222222', 2100, '2019-02-20 10:49:34', '2019-02-20 05:19:34', '1', '192.168.1.15'),
(7, NULL, NULL, '10', NULL, 'Novotel Chennai Sipcot', '100010', '1', 'GST', 0, 0, 0, '2222222222', 2100, '2019-02-20 10:49:42', '2019-02-20 05:19:42', '1', '192.168.1.15'),
(8, NULL, NULL, '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100010', '3', 'GST', 12, 6, 6, '2323232323', 1500, '2019-02-20 11:06:24', '2019-02-20 05:36:24', '1', '192.168.1.15'),
(9, NULL, NULL, '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100011', '3', 'IGST', NULL, NULL, NULL, '2222222222', 1000, '2019-02-20 11:09:52', '2019-02-20 05:39:52', '1', '192.168.1.15'),
(10, NULL, NULL, '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100012', '3', 'IGST', NULL, NULL, NULL, '565611231', 2000, '2019-02-20 11:13:35', '2019-02-20 05:43:35', '1', '192.168.1.15'),
(11, NULL, NULL, '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100013', '3', 'IGST', 12, NULL, NULL, '5522222222', 1500, '2019-02-20 11:21:56', '2019-02-20 05:51:56', '1', '192.168.1.15'),
(12, NULL, NULL, '19', 'Vidhun Enterprises', 'Geetha', '100014', '4', 'IGST', 18, NULL, NULL, '5555555555', 2000, '2019-02-20 11:32:45', '2019-02-20 06:33:57', '1', '192.168.1.15'),
(13, NULL, NULL, '19', 'Vidhun Enterprises', 'Geetha', '100015', '4', 'GST', 18, 9, 9, '0000000000', 500, '2019-02-20 12:05:08', '2019-02-20 06:35:08', '1', '192.168.1.15'),
(14, NULL, NULL, '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100016', '4', 'GST', 18, 9, 9, '0000000000', 1000, '2019-02-20 12:08:15', '2019-02-20 06:38:15', '1', '192.168.1.15'),
(15, NULL, NULL, '19', 'Vidhun Enterprises', 'Geetha', '100017', '4', 'GST', 18, 9, 9, '0000000000', 5500, '2019-02-20 12:15:14', '2019-02-20 06:46:11', '1', '192.168.1.15'),
(16, NULL, NULL, '11', 'Sai Group of Companies', 'Sai', '100018', '4', 'GST', 18, 9, 9, 'test', 7000.5, '2019-02-20 12:48:05', '2019-02-20 07:22:38', '1', '192.168.1.30'),
(17, NULL, NULL, '19', 'Vidhun Enterprises', 'Geetha', '100019', '4', 'GST', 18, 9, 9, '10000000', 1000, '2019-02-20 12:48:55', '2019-02-20 07:18:55', '1', '192.168.1.15'),
(18, NULL, NULL, '19', 'Vidhun Enterprises', 'Geetha', '100020', '3', 'GST', 12, 6, 6, '0987', 47, '2019-02-20 15:46:08', '2019-02-20 10:16:08', '1', '192.168.1.14'),
(26, NULL, NULL, '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100028', '4', 'GST', 18, 9, 9, '9898', 6, '2019-02-21 15:49:27', '2019-02-21 10:19:27', '1', '192.168.1.15'),
(27, NULL, NULL, '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100029', '1', 'GST', 0, 0, 0, '11', 2, '2019-02-21 15:54:24', '2019-02-21 10:24:24', '1', '192.168.1.15'),
(28, NULL, NULL, '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100030', '1', 'GST', 0, 0, 0, '111', 12, '2019-02-21 15:54:54', '2019-02-21 10:24:54', '1', '192.168.1.15'),
(29, NULL, NULL, '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100031', '1', 'IGST', 0, NULL, NULL, '9898', 10, '2019-02-21 15:55:59', '2019-02-21 10:25:59', '1', '192.168.1.15'),
(30, NULL, NULL, '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100032', '1', 'GST', 0, 0, 0, '12', 1, '2019-02-21 16:31:57', '2019-02-21 11:01:57', '1', '192.168.1.15'),
(31, NULL, NULL, '21', 'asvjas', 'sdkfj', '100033', '1', 'GST', 0, 0, 0, '112', 12, '2019-02-21 16:32:41', '2019-02-21 11:02:41', '1', '192.168.1.15'),
(32, NULL, NULL, '19', 'Vidhun Enterprises', 'Geetha', '100034', '3', 'GST', 12, 6, 6, '12', 1, '2019-02-21 16:33:58', '2019-02-21 11:03:58', '1', '192.168.1.15'),
(33, NULL, NULL, '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100035', '1', 'GST', 0, 0, 0, '1', 21, '2019-02-21 16:34:20', '2019-02-21 11:04:20', '1', '192.168.1.15'),
(34, NULL, NULL, '13', 'lucky vaccines', 'gopal', '100036', '1', 'GST', 0, 0, 0, '1', 1, '2019-02-21 16:34:46', '2019-02-21 11:04:46', '1', '192.168.1.15'),
(35, NULL, NULL, '11', 'Sai Group of Companies', 'Sai', '100037', '1', 'GST', 0, 0, 0, '1', 1, '2019-02-21 16:34:58', '2019-02-21 11:04:58', '1', '192.168.1.15'),
(36, NULL, NULL, '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100038', '1', 'GST', 0, 0, 0, '12', 12, '2019-02-21 16:35:33', '2019-02-21 11:05:33', '1', '192.168.1.15'),
(37, NULL, NULL, '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100039', '1', 'GST', 0, 0, 0, '12', 1, '2019-02-21 16:41:43', '2019-02-21 11:11:43', '1', '192.168.1.15'),
(38, NULL, NULL, '12', 'Meera ', 'Meera', '100040', '1', 'IGST', 0, NULL, NULL, '9989', 80, '2019-02-21 16:42:07', '2019-02-21 12:20:14', '1', '192.168.1.15'),
(39, NULL, NULL, '21', 'asvjas', 'sdkfj', '100041', '4', 'GST', 18, 9, 9, '9989', 3, '2019-02-21 17:55:10', '2019-02-21 12:25:10', '1', '192.168.1.15'),
(40, NULL, NULL, '19', 'Vidhun Enterprises', 'Geetha', '100042', '1', 'GST', 0, 0, 0, '9989', 1, '2019-02-21 18:51:42', '2019-02-21 13:21:42', '1', '192.168.1.15'),
(41, NULL, NULL, '19', 'Vidhun Enterprises', 'Geetha', '100043', '1', 'GST', 0, 0, 0, '9989', 1, '2019-02-21 18:51:44', '2019-02-21 13:21:44', '1', '192.168.1.15'),
(45, NULL, NULL, '20', 'communist pvt ltd', 'chanfru', '100047', '1', 'GST', 0, 0, 0, '9989', 1, '2019-02-21 18:56:21', '2019-02-21 13:26:21', '1', '192.168.1.15'),
(46, NULL, NULL, '8', 'gb', 'sdfg', '100048', '1', 'GST', 0, 0, 0, '9989', 5, '2019-02-21 19:19:12', '2019-02-21 13:49:12', '1', '192.168.1.15'),
(47, NULL, NULL, '19', 'Vidhun Enterprises', 'Geetha', '100049', '1', 'GST', 0, 0, 0, '9989', 1, '2019-02-21 19:20:07', '2019-02-21 13:50:07', '1', '192.168.1.15'),
(48, NULL, NULL, '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100050', '1', 'GST', 0, 0, 0, '9989', 4, '2019-02-21 19:23:40', '2019-02-21 13:53:40', '1', '192.168.1.15'),
(49, NULL, NULL, '8', 'gb', 'sdfg', '100051', '1', 'GST', 0, 0, 0, '9989', 1, '2019-02-21 19:24:16', '2019-02-21 13:54:16', '1', '192.168.1.15'),
(50, NULL, NULL, '19', 'Vidhun Enterprises', 'Geetha', '100052', '1', 'GST', 0, 0, 0, '9989', 1, '2019-02-21 19:24:45', '2019-02-21 13:54:45', '1', '192.168.1.15'),
(51, NULL, NULL, '19', 'Vidhun Enterprises', 'Geetha', '100053', '1', 'GST', 0, 0, 0, '9989', 1, '2019-02-21 19:24:49', '2019-02-21 13:54:49', '1', '192.168.1.15'),
(52, NULL, NULL, '5', 'GHNDN', 'FGBFGB', '100054', '1', 'GST', 0, 0, 0, '9989', 1, '2019-02-21 19:32:45', '2019-02-21 14:02:45', '1', '192.168.1.15'),
(53, NULL, NULL, '11', 'Sai Group of Companies', 'Sai', '100055', '1', 'IGST', 0, NULL, NULL, '9989', 1, '2019-02-21 19:41:37', '2019-02-21 14:11:37', '1', '192.168.1.15'),
(54, NULL, NULL, '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100056', '1', 'GST', 0, 0, 0, '9989', 1, '2019-02-21 19:42:28', '2019-02-21 14:12:28', '1', '192.168.1.15'),
(55, NULL, NULL, '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100057', '1', 'GST', 0, 0, 0, '9989', 23, '2019-02-21 19:43:15', '2019-02-21 14:13:15', '1', '192.168.1.15'),
(56, NULL, NULL, '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100058', '1', 'GST', 0, 0, 0, '9989', 23, '2019-02-21 19:43:30', '2019-02-21 14:13:30', '1', '192.168.1.15'),
(57, NULL, NULL, '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100059', '1', 'GST', 0, 0, 0, '9989', 1, '2019-02-21 19:43:46', '2019-02-21 14:13:46', '1', '192.168.1.15'),
(58, NULL, NULL, '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100060', '4', 'GST', 18, 9, 9, '9989', 1, '2019-02-21 20:03:39', '2019-02-21 14:33:39', '1', '192.168.1.15'),
(59, NULL, NULL, '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100061', '3', 'GST', 12, 6, 6, '9989', 1, '2019-02-21 20:32:45', '2019-02-21 15:02:45', '1', '192.168.1.15'),
(60, NULL, NULL, '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100062', '3', 'GST', 12, 6, 6, '9989', 1, '2019-02-21 20:33:10', '2019-02-21 15:03:10', '1', '192.168.1.15'),
(61, NULL, NULL, '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100063', '3', 'GST', 12, 6, 6, '9989', 1, '2019-02-21 20:35:05', '2019-02-21 15:05:05', '1', '192.168.1.15'),
(62, NULL, NULL, '19', 'Vidhun Enterprises', 'Geetha', '100064', '1', 'GST', 0, 0, 0, '9989', 1, '2019-02-21 20:36:58', '2019-02-21 15:06:58', '1', '192.168.1.15'),
(63, NULL, NULL, '19', 'Vidhun Enterprises', 'Geetha', '100065', '1', 'GST', 0, 0, 0, '9989', 1, '2019-02-21 20:44:57', '2019-02-21 15:14:57', '1', '192.168.1.15'),
(64, NULL, NULL, '19', 'Vidhun Enterprises', 'Geetha', '100066', '4', 'GST', 18, 9, 9, '9989', 1, '2019-02-21 20:45:53', '2019-02-21 15:15:53', '1', '192.168.1.15'),
(65, NULL, NULL, '20', 'communist pvt ltd', 'chanfru', '100067', '1', 'GST', 0, 0, 0, '9989', 1, '2019-02-21 20:46:47', '2019-02-21 15:16:47', '1', '192.168.1.15'),
(66, NULL, NULL, '19', 'Vidhun Enterprises', 'Geetha', '100068', '1', 'IGST', 0, NULL, NULL, '9989', 1, '2019-02-21 20:49:34', '2019-02-21 15:19:34', '1', '192.168.1.15'),
(67, NULL, NULL, '19', 'Vidhun Enterprises', 'Geetha', '100069', '1', 'IGST', 0, NULL, NULL, '9989', 1, '2019-02-21 20:50:59', '2019-02-21 15:20:59', '1', '192.168.1.15'),
(68, NULL, NULL, '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100070', '1', 'GST', 0, 0, 0, '9989', 1, '2019-02-21 20:56:48', '2019-02-21 15:26:48', '1', '192.168.1.15'),
(69, NULL, NULL, '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100071', '1', 'GST', 0, 0, 0, '9989', 1, '2019-02-21 20:56:52', '2019-02-21 15:26:52', '1', '192.168.1.15'),
(70, NULL, NULL, '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100072', '1', 'GST', 0, 0, 0, '9989', 1, '2019-02-21 21:22:49', '2019-02-21 15:52:49', '1', '192.168.1.15'),
(71, NULL, NULL, '8', 'gb', 'sdfg', '100073', '1', 'IGST', 0, NULL, NULL, '9989', 3, '2019-02-22 12:35:17', '2019-02-22 07:05:17', '1', '192.168.1.15'),
(72, NULL, NULL, '8', 'gb', 'sdfg', '100074', '1', 'GST', 0, 0, 0, '9989', 3, '2019-02-22 12:35:48', '2019-02-22 07:05:48', '1', '192.168.1.15'),
(75, NULL, NULL, '19', 'Vidhun Enterprises', 'Geetha', '100077', '1', 'GST', 0, 0, 0, '9989', 1, '2019-02-22 12:37:28', '2019-02-22 07:07:28', '1', '192.168.1.15'),
(76, NULL, NULL, '19', 'Vidhun Enterprises', 'Geetha', '100078', '1', 'GST', 0, 0, 0, '9989', 1, '2019-02-22 12:37:33', '2019-02-22 07:07:33', '1', '192.168.1.15'),
(77, NULL, NULL, '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100079', '1', 'GST', 0, 0, 0, '9989', 1, '2019-02-22 12:40:08', '2019-02-22 07:10:08', '1', '192.168.1.15'),
(78, NULL, NULL, '4', 'hkadc`', 'sbdnk', '100080', '1', 'GST', 0, 0, 0, '9989', 1, '2019-02-22 12:40:38', '2019-02-22 07:10:38', '1', '192.168.1.15'),
(79, NULL, NULL, '11', 'Sai Group of Companies', 'Sai', '100081', '1', 'IGST', 0, NULL, NULL, '9989', 1, '2019-02-22 12:41:00', '2019-02-22 07:11:00', '1', '192.168.1.15'),
(80, NULL, NULL, '5', 'GHNDN', 'FGBFGB', '100082', '1', 'IGST', 0, NULL, NULL, '9989', 1, '2019-02-22 12:41:15', '2019-02-22 07:11:15', '1', '192.168.1.15'),
(81, NULL, NULL, '11', 'Sai Group of Companies', 'Sai', '100083', '1', 'GST', 0, 0, 0, '9989', 1, '2019-02-22 12:41:29', '2019-02-22 07:11:29', '1', '192.168.1.15'),
(82, NULL, NULL, '19', 'Vidhun Enterprises', 'Geetha', '100084', '1', 'GST', 0, 0, 0, '9989', 1, '2019-02-22 12:42:05', '2019-02-22 07:12:05', '1', '192.168.1.15'),
(83, 'DC', '38', '20', 'communist pvt ltd', 'chanfru', '100085', '1', 'GST', 0, 0, 0, '9989', 3, '2019-02-22 12:44:03', '2019-02-28 15:25:25', '1', '192.168.1.15'),
(84, 'DC', '39', '11', 'Sai Group of Companies', 'Sai', '100086', '1', 'IGST', 0, NULL, NULL, '9989', 1, '2019-02-22 12:44:52', '2019-02-28 15:26:06', '1', '192.168.1.15'),
(85, NULL, NULL, '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100087', '1', 'GST', 0, 0, 0, '9989', 4, '2019-02-22 12:47:51', '2019-02-22 07:27:53', '1', '192.168.1.15'),
(86, NULL, NULL, '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100088', '1', 'GST', 0, 0, 0, '9989', 24, '2019-02-22 12:48:16', '2019-02-22 07:27:18', '1', '192.168.1.15'),
(87, NULL, NULL, '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100089', '1', 'GST', 0, 0, 0, '9989', 1, '2019-02-22 13:03:25', '2019-02-22 07:33:25', '1', '192.168.1.15'),
(88, NULL, NULL, '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100090', '1', 'GST', 0, 0, 0, '9989', 4, '2019-02-22 13:04:26', '2019-02-22 07:34:26', '1', '192.168.1.15'),
(89, NULL, NULL, '1', 'asdfasd', 'sdafasdf', '100091', '1', 'GST', 0, 0, 0, '9989', 1, '2019-02-22 13:05:07', '2019-02-22 07:35:07', '1', '192.168.1.15'),
(90, NULL, NULL, '20', 'communist pvt ltd', 'chanfru', '100092', '1', 'GST', 0, 0, 0, '9989', 12, '2019-02-22 13:05:28', '2019-02-22 07:35:28', '1', '192.168.1.15'),
(91, NULL, NULL, '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100093', '1', 'GST', 0, 0, 0, '9989', 1, '2019-02-22 13:06:10', '2019-02-22 07:36:10', '1', '192.168.1.15'),
(92, NULL, NULL, '11', 'Sai Group of Companies', 'Sai', '100094', '1', 'GST', 0, 0, 0, '9989', 123, '2019-02-22 13:06:42', '2019-02-22 07:36:42', '1', '192.168.1.15'),
(93, NULL, NULL, '11', 'Sai Group of Companies', 'Sai', '100095', '1', 'GST', 0, 0, 0, '9989', 1, '2019-02-22 13:13:20', '2019-02-22 07:43:20', '1', '192.168.1.15'),
(94, NULL, NULL, '19', 'Vidhun Enterprises', 'Geetha', '100096', '1', 'GST', 0, 0, 0, '9989', 1, '2019-02-22 13:15:08', '2019-02-22 07:45:08', '1', '192.168.1.15'),
(95, 'DC', '35', '19', 'Vidhun Enterprises', 'Geetha', '100097', '1', 'GST', 0, 0, 0, '9989', 4000, '2019-02-25 16:16:08', '2019-02-28 15:19:18', '1', '192.168.1.20'),
(96, NULL, NULL, '19', 'Vidhun Enterprises', 'Geetha', '100098', '3', 'GST', 12, 6, 6, '9989', 6000, '2019-02-27 19:35:59', '2019-02-28 05:23:30', '1', '192.168.1.7'),
(97, 'DC', '36', '19', 'Vidhun Enterprises', 'Geetha', '100099', '3', 'GST', 12, 6, 6, '9989', 333, '2019-02-28 11:13:02', '2019-02-28 15:24:09', '1', '192.168.1.3'),
(98, NULL, NULL, '23', 'tendulkar', 'ten', '100100', '4', 'GST', 18, 9, 9, '9989', 1532, '2019-02-28 12:11:03', '2019-02-28 06:41:03', '1', '192.168.1.7'),
(99, 'DC', '34', '26', 'Hanifa & Co', 'Hani', '100101', '3', 'GST', 12, 6, 6, '9989', 5500, '2019-02-28 17:51:32', '2019-02-28 15:18:08', '1', '192.168.1.7'),
(100, 'DC', '40', '23', 'tendulkar', 'ten', '100102', '1', 'GST', 0, 0, 0, '9989', 1, '2019-02-28 18:20:17', '2019-02-28 15:28:50', '1', '192.168.1.7'),
(101, 'DC', '41', '5', 'GHNDN', 'FGBFGB', '100103', '1', 'IGST', 0, NULL, NULL, '9989', 1541, '2019-02-28 20:59:52', '2019-02-28 15:30:36', '1', '192.168.1.7'),
(102, 'DC', '42', '27', 'dhoni pvt ltd', 'dhoni', '100104', '3', 'IGST', 12, NULL, NULL, '9989', 396, '2019-03-01 12:58:37', '2019-03-01 07:35:47', '1', '192.168.1.7'),
(103, NULL, NULL, '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100105', '4', 'GST', 18, 9, 9, '9989', 452, '2019-03-01 13:12:30', '2019-03-01 07:42:30', '1', '192.168.1.7'),
(104, 'DC', '48', '13', 'lucky vaccines', 'gopal', '100106', '4', 'IGST', 18, NULL, NULL, '9989', 8, '2019-03-01 13:29:52', '2019-03-01 08:12:04', '1', '192.168.1.7'),
(105, 'DC', '49', '27', 'dhoni pvt ltd', 'dhoni', '100107', '1', 'GST', 0, 0, 0, '9989', 151, '2019-03-01 13:46:19', '2019-03-01 08:16:47', '1', '192.168.1.7'),
(106, NULL, NULL, '23', 'tendulkar', 'ten', '100108', '3', 'GST', 12, 6, 6, '9989', 301, '2019-03-02 11:00:29', '2019-03-02 05:30:29', '1', '192.168.1.25'),
(107, 'DC', '52', '23', 'tendulkar', 'ten', 'EST-2019-100109', '1', 'GST', 0, 0, 0, '9989', 150, '2019-03-02 13:57:10', '2019-03-02 11:55:14', '1', '192.168.1.25');

-- --------------------------------------------------------

--
-- Table structure for table `estimate_main_tbl_log`
--

CREATE TABLE `estimate_main_tbl_log` (
  `auto_id` bigint(20) NOT NULL,
  `estimate_main_tbl_id` varchar(255) DEFAULT NULL,
  `customer_id` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `bill_number` varchar(255) DEFAULT NULL,
  `gst` varchar(255) DEFAULT NULL,
  `sac` varchar(255) DEFAULT NULL,
  `total_amount` float DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` varchar(255) DEFAULT NULL,
  `updated_ipaddress` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `estimate_main_tbl_log`
--

INSERT INTO `estimate_main_tbl_log` (`auto_id`, `estimate_main_tbl_id`, `customer_id`, `company_name`, `customer_name`, `bill_number`, `gst`, `sac`, `total_amount`, `created_at`, `updated_at`, `user_id`, `updated_ipaddress`) VALUES
(1, '1', '5', NULL, 'GHNDN', '100005', NULL, NULL, 6, '2019-02-16 17:13:17', '2019-02-16 11:43:17', '1', '192.168.1.29'),
(2, '1', '5', NULL, 'FGBFGB', '100005', NULL, NULL, 2, '2019-02-16 17:14:28', '2019-02-16 11:44:28', '1', '192.168.1.29'),
(3, '2', '10', NULL, 'Novotel Chennai Sipcot', '100006', NULL, NULL, 3950, '2019-02-18 10:52:40', '2019-02-18 05:22:40', '1', '192.168.1.15'),
(4, '3', '1', NULL, 'asdfasd', '100007', '1', '10020', 200, '2019-02-18 12:23:08', '2019-02-18 06:53:08', '1', '192.168.1.15'),
(5, '3', '1', NULL, 'sdafasdf', '100007', NULL, NULL, 200, '2019-02-18 12:26:59', '2019-02-18 06:56:59', '1', '192.168.1.15'),
(6, '3', '1', NULL, 'sdafasdf', '100007', '2', '100202', 200, '2019-02-18 12:29:50', '2019-02-18 06:59:50', '1', '192.168.1.15'),
(7, '2', '10', NULL, 'ASHOK KUMAR', '100006', '4', '1234', 3950, '2019-02-18 12:34:49', '2019-02-18 07:04:49', '1', '192.168.1.15'),
(8, '4', '10', NULL, 'Novotel Chennai Sipcot', '100008', '4', '2510', 5750, '2019-02-18 16:17:03', '2019-02-18 10:47:03', '1', '192.168.1.15'),
(9, '4', '10', NULL, 'ASHOK KUMAR', '100008', '4', '2510', 6250, '2019-02-18 16:29:17', '2019-02-18 10:59:17', '1', '192.168.1.15'),
(10, '5', '11', NULL, 'Sai Group of Companies', '100009', '3', 'test', 14222, '2019-02-19 16:41:34', '2019-02-19 11:11:34', '1', '192.168.1.30'),
(11, '5', '11', NULL, 'Sai', '100009', '3', 'test', 17222, '2019-02-19 16:44:43', '2019-02-19 11:14:43', '1', '192.168.1.30'),
(12, '6', '10', NULL, 'Novotel Chennai Sipcot', '100010', '1', '2222222222', 2100, '2019-02-20 10:49:34', '2019-02-20 05:19:34', '1', '192.168.1.15'),
(13, '7', '10', NULL, 'Novotel Chennai Sipcot', '100010', '1', '2222222222', 2100, '2019-02-20 10:49:42', '2019-02-20 05:19:42', '1', '192.168.1.15'),
(14, '8', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100010', '3', '2323232323', 1500, '2019-02-20 11:06:24', '2019-02-20 05:36:24', '1', '192.168.1.15'),
(15, '9', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100011', '3', '2222222222', 1000, '2019-02-20 11:09:52', '2019-02-20 05:39:52', '1', '192.168.1.15'),
(16, '10', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100012', '3', '565611231', 2000, '2019-02-20 11:13:35', '2019-02-20 05:43:35', '1', '192.168.1.15'),
(17, '11', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100013', '3', '5522222222', 1500, '2019-02-20 11:21:56', '2019-02-20 05:51:56', '1', '192.168.1.15'),
(18, '12', '19', 'Vidhun Enterprises', 'Geetha', '100014', '3', 'test', 6000, '2019-02-20 11:32:46', '2019-02-20 06:02:46', '1', '192.168.1.14'),
(19, '12', '19', NULL, 'Geetha', '100014', '3', 'test', 10000, '2019-02-20 11:35:34', '2019-02-20 06:05:34', '1', '192.168.1.14'),
(20, '12', '19', 'Vidhun Enterprises', 'Geetha', '100014', '4', '5555555555', 2000, '2019-02-20 12:03:57', '2019-02-20 06:33:57', '1', '192.168.1.15'),
(21, '13', '19', 'Vidhun Enterprises', 'Geetha', '100015', '4', '0000000000', 500, '2019-02-20 12:05:08', '2019-02-20 06:35:08', '1', '192.168.1.15'),
(22, '14', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100016', '4', '0000000000', 1000, '2019-02-20 12:08:15', '2019-02-20 06:38:15', '1', '192.168.1.15'),
(23, '15', '19', 'Vidhun Enterprises', 'Geetha', '100017', '1', '50000', 2500, '2019-02-20 12:15:14', '2019-02-20 06:45:14', '1', '192.168.1.15'),
(24, '15', '19', 'Vidhun Enterprises', 'Geetha', '100017', '1', '50000', 5500, '2019-02-20 12:15:50', '2019-02-20 06:45:50', '1', '192.168.1.15'),
(25, '15', '19', 'Vidhun Enterprises', 'Geetha', '100017', '4', '0000000000', 5500, '2019-02-20 12:16:11', '2019-02-20 06:46:11', '1', '192.168.1.15'),
(26, '16', '11', 'Sai Group of Companies', 'Sai', '100018', '4', 'test', 6000, '2019-02-20 12:48:06', '2019-02-20 07:18:06', '1', '192.168.1.30'),
(27, '17', '19', 'Vidhun Enterprises', 'Geetha', '100019', '4', '10000000', 1000, '2019-02-20 12:48:55', '2019-02-20 07:18:55', '1', '192.168.1.15'),
(28, '16', '11', 'Sai Group of Companies', 'Sai', '100018', '4', 'test', 7000.5, '2019-02-20 12:52:38', '2019-02-20 07:22:38', '1', '192.168.1.30'),
(29, '18', '19', 'Vidhun Enterprises', 'Geetha', '100020', '3', '0987', 47, '2019-02-20 15:46:08', '2019-02-20 10:16:08', '1', '192.168.1.14'),
(30, '19', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100021', '1', '989', 3, '2019-02-21 15:43:00', '2019-02-21 10:13:00', '1', '192.168.1.15'),
(31, '20', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100022', '4', '9898', 39, '2019-02-21 15:44:17', '2019-02-21 10:14:17', '1', '192.168.1.15'),
(32, '21', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100023', '4', '9898', 39, '2019-02-21 15:44:18', '2019-02-21 10:14:18', '1', '192.168.1.15'),
(33, '22', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100024', '1', '9898', 3, '2019-02-21 15:44:52', '2019-02-21 10:14:52', '1', '192.168.1.15'),
(34, '23', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100025', '1', '9898', 3, '2019-02-21 15:44:54', '2019-02-21 10:14:54', '1', '192.168.1.15'),
(35, '24', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100026', '4', '9898', 6, '2019-02-21 15:46:52', '2019-02-21 10:16:52', '1', '192.168.1.15'),
(36, '25', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100027', '7', '1', 6, '2019-02-21 15:48:48', '2019-02-21 10:18:48', '1', '192.168.1.15'),
(37, '26', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100028', '4', '9898', 6, '2019-02-21 15:49:27', '2019-02-21 10:19:27', '1', '192.168.1.15'),
(38, '27', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100029', '1', '11', 2, '2019-02-21 15:54:25', '2019-02-21 10:24:24', '1', '192.168.1.15'),
(39, '28', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100030', '1', '111', 12, '2019-02-21 15:54:54', '2019-02-21 10:24:54', '1', '192.168.1.15'),
(40, '29', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100031', '1', '9898', 10, '2019-02-21 15:55:59', '2019-02-21 10:25:59', '1', '192.168.1.15'),
(41, '30', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100032', '1', '12', 1, '2019-02-21 16:31:57', '2019-02-21 11:01:57', '1', '192.168.1.15'),
(42, '31', '21', 'asvjas', 'sdkfj', '100033', '1', '112', 12, '2019-02-21 16:32:41', '2019-02-21 11:02:41', '1', '192.168.1.15'),
(43, '32', '19', 'Vidhun Enterprises', 'Geetha', '100034', '3', '12', 1, '2019-02-21 16:33:58', '2019-02-21 11:03:58', '1', '192.168.1.15'),
(44, '33', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100035', '1', '1', 21, '2019-02-21 16:34:20', '2019-02-21 11:04:20', '1', '192.168.1.15'),
(45, '34', '13', 'lucky vaccines', 'gopal', '100036', '1', '1', 1, '2019-02-21 16:34:46', '2019-02-21 11:04:46', '1', '192.168.1.15'),
(46, '35', '11', 'Sai Group of Companies', 'Sai', '100037', '1', '1', 1, '2019-02-21 16:34:58', '2019-02-21 11:04:58', '1', '192.168.1.15'),
(47, '36', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100038', '1', '12', 12, '2019-02-21 16:35:33', '2019-02-21 11:05:33', '1', '192.168.1.15'),
(48, '37', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100039', '1', '12', 1, '2019-02-21 16:41:43', '2019-02-21 11:11:43', '1', '192.168.1.15'),
(49, '38', '12', 'Meera ', 'Meera', '100040', '1', '12', 1, '2019-02-21 16:42:07', '2019-02-21 11:12:07', '1', '192.168.1.15'),
(50, '38', '12', 'Meera ', 'Meera', '100040', '1', NULL, 24, '2019-02-21 17:35:15', '2019-02-21 12:05:15', '1', '192.168.1.15'),
(51, '38', '12', 'Meera ', 'Meera', '100040', '1', '9989', 80, '2019-02-21 17:50:14', '2019-02-21 12:20:14', '1', '192.168.1.15'),
(52, '38', '12', 'Meera ', 'Meera', '100040', '1', '9989', 80, '2019-02-21 17:50:48', '2019-02-21 12:20:48', '1', '192.168.1.15'),
(53, '39', '21', 'asvjas', 'sdkfj', '100041', '4', '9989', 3, '2019-02-21 17:55:10', '2019-02-21 12:25:10', '1', '192.168.1.15'),
(54, '40', '19', 'Vidhun Enterprises', 'Geetha', '100042', '1', '9989', 1, '2019-02-21 18:51:42', '2019-02-21 13:21:42', '1', '192.168.1.15'),
(55, '41', '19', 'Vidhun Enterprises', 'Geetha', '100043', '1', '9989', 1, '2019-02-21 18:51:44', '2019-02-21 13:21:44', '1', '192.168.1.15'),
(56, '42', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100044', '1', '9989', 1, '2019-02-21 18:52:15', '2019-02-21 13:22:15', '1', '192.168.1.15'),
(57, '43', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100045', '1', '9989', 1, '2019-02-21 18:52:17', '2019-02-21 13:22:17', '1', '192.168.1.15'),
(58, '44', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100046', '1', '9989', 1, '2019-02-21 18:52:18', '2019-02-21 13:22:18', '1', '192.168.1.15'),
(59, '45', '20', 'communist pvt ltd', 'chanfru', '100047', '1', '9989', 1, '2019-02-21 18:56:21', '2019-02-21 13:26:21', '1', '192.168.1.15'),
(60, '46', '8', 'gb', 'sdfg', '100048', '1', '9989', 5, '2019-02-21 19:19:12', '2019-02-21 13:49:12', '1', '192.168.1.15'),
(61, '47', '19', 'Vidhun Enterprises', 'Geetha', '100049', '1', '9989', 1, '2019-02-21 19:20:07', '2019-02-21 13:50:07', '1', '192.168.1.15'),
(62, '48', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100050', '1', '9989', 4, '2019-02-21 19:23:40', '2019-02-21 13:53:40', '1', '192.168.1.15'),
(63, '49', '8', 'gb', 'sdfg', '100051', '1', '9989', 1, '2019-02-21 19:24:16', '2019-02-21 13:54:16', '1', '192.168.1.15'),
(64, '50', '19', 'Vidhun Enterprises', 'Geetha', '100052', '1', '9989', 1, '2019-02-21 19:24:45', '2019-02-21 13:54:45', '1', '192.168.1.15'),
(65, '51', '19', 'Vidhun Enterprises', 'Geetha', '100053', '1', '9989', 1, '2019-02-21 19:24:49', '2019-02-21 13:54:49', '1', '192.168.1.15'),
(66, '52', '5', 'GHNDN', 'FGBFGB', '100054', '1', '9989', 1, '2019-02-21 19:32:45', '2019-02-21 14:02:45', '1', '192.168.1.15'),
(67, '53', '11', 'Sai Group of Companies', 'Sai', '100055', '1', '9989', 1, '2019-02-21 19:41:37', '2019-02-21 14:11:37', '1', '192.168.1.15'),
(68, '54', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100056', '1', '9989', 1, '2019-02-21 19:42:29', '2019-02-21 14:12:29', '1', '192.168.1.15'),
(69, '55', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100057', '1', '9989', 23, '2019-02-21 19:43:15', '2019-02-21 14:13:15', '1', '192.168.1.15'),
(70, '56', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100058', '1', '9989', 23, '2019-02-21 19:43:30', '2019-02-21 14:13:30', '1', '192.168.1.15'),
(71, '57', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100059', '1', '9989', 1, '2019-02-21 19:43:46', '2019-02-21 14:13:46', '1', '192.168.1.15'),
(72, '58', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100060', '4', '9989', 1, '2019-02-21 20:03:39', '2019-02-21 14:33:39', '1', '192.168.1.15'),
(73, '59', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100061', '3', '9989', 1, '2019-02-21 20:32:45', '2019-02-21 15:02:45', '1', '192.168.1.15'),
(74, '60', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100062', '3', '9989', 1, '2019-02-21 20:33:10', '2019-02-21 15:03:10', '1', '192.168.1.15'),
(75, '61', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100063', '3', '9989', 1, '2019-02-21 20:35:05', '2019-02-21 15:05:05', '1', '192.168.1.15'),
(76, '62', '19', 'Vidhun Enterprises', 'Geetha', '100064', '1', '9989', 1, '2019-02-21 20:36:58', '2019-02-21 15:06:58', '1', '192.168.1.15'),
(77, '63', '19', 'Vidhun Enterprises', 'Geetha', '100065', '1', '9989', 1, '2019-02-21 20:44:57', '2019-02-21 15:14:57', '1', '192.168.1.15'),
(78, '64', '19', 'Vidhun Enterprises', 'Geetha', '100066', '4', '9989', 1, '2019-02-21 20:45:53', '2019-02-21 15:15:53', '1', '192.168.1.15'),
(79, '65', '20', 'communist pvt ltd', 'chanfru', '100067', '1', '9989', 1, '2019-02-21 20:46:47', '2019-02-21 15:16:47', '1', '192.168.1.15'),
(80, '66', '19', 'Vidhun Enterprises', 'Geetha', '100068', '1', '9989', 1, '2019-02-21 20:49:34', '2019-02-21 15:19:34', '1', '192.168.1.15'),
(81, '67', '19', 'Vidhun Enterprises', 'Geetha', '100069', '1', '9989', 1, '2019-02-21 20:50:59', '2019-02-21 15:20:59', '1', '192.168.1.15'),
(82, '68', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100070', '1', '9989', 1, '2019-02-21 20:56:48', '2019-02-21 15:26:48', '1', '192.168.1.15'),
(83, '69', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100071', '1', '9989', 1, '2019-02-21 20:56:52', '2019-02-21 15:26:52', '1', '192.168.1.15'),
(84, '70', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100072', '1', '9989', 1, '2019-02-21 21:22:49', '2019-02-21 15:52:49', '1', '192.168.1.15'),
(85, '71', '8', 'gb', 'sdfg', '100073', '1', '9989', 3, '2019-02-22 12:35:17', '2019-02-22 07:05:17', '1', '192.168.1.15'),
(86, '72', '8', 'gb', 'sdfg', '100074', '1', '9989', 3, '2019-02-22 12:35:48', '2019-02-22 07:05:48', '1', '192.168.1.15'),
(87, '73', '19', 'Vidhun Enterprises', 'Geetha', '100075', '1', '9989', 1, '2019-02-22 12:36:19', '2019-02-22 07:06:19', '1', '192.168.1.15'),
(88, '74', '19', 'Vidhun Enterprises', 'Geetha', '100076', '1', '9989', 1, '2019-02-22 12:36:20', '2019-02-22 07:06:20', '1', '192.168.1.15'),
(89, '75', '19', 'Vidhun Enterprises', 'Geetha', '100077', '1', '9989', 1, '2019-02-22 12:37:28', '2019-02-22 07:07:28', '1', '192.168.1.15'),
(90, '76', '19', 'Vidhun Enterprises', 'Geetha', '100078', '1', '9989', 1, '2019-02-22 12:37:33', '2019-02-22 07:07:33', '1', '192.168.1.15'),
(91, '77', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100079', '1', '9989', 1, '2019-02-22 12:40:08', '2019-02-22 07:10:08', '1', '192.168.1.15'),
(92, '78', '4', 'hkadc`', 'sbdnk', '100080', '1', '9989', 1, '2019-02-22 12:40:38', '2019-02-22 07:10:38', '1', '192.168.1.15'),
(93, '79', '11', 'Sai Group of Companies', 'Sai', '100081', '1', '9989', 1, '2019-02-22 12:41:00', '2019-02-22 07:11:00', '1', '192.168.1.15'),
(94, '80', '5', 'GHNDN', 'FGBFGB', '100082', '1', '9989', 1, '2019-02-22 12:41:15', '2019-02-22 07:11:15', '1', '192.168.1.15'),
(95, '81', '11', 'Sai Group of Companies', 'Sai', '100083', '1', '9989', 1, '2019-02-22 12:41:29', '2019-02-22 07:11:29', '1', '192.168.1.15'),
(96, '82', '19', 'Vidhun Enterprises', 'Geetha', '100084', '1', '9989', 1, '2019-02-22 12:42:05', '2019-02-22 07:12:05', '1', '192.168.1.15'),
(97, '83', '20', 'communist pvt ltd', 'chanfru', '100085', '1', '9989', 3, '2019-02-22 12:44:03', '2019-02-22 07:14:03', '1', '192.168.1.15'),
(98, '84', '11', 'Sai Group of Companies', 'Sai', '100086', '1', '9989', 1, '2019-02-22 12:44:53', '2019-02-22 07:14:53', '1', '192.168.1.15'),
(99, '85', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100087', '1', '9989', 1, '2019-02-22 12:47:51', '2019-02-22 07:17:51', '1', '192.168.1.15'),
(100, '86', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100088', '1', '9989', 1, '2019-02-22 12:48:16', '2019-02-22 07:18:16', '1', '192.168.1.15'),
(101, '86', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100088', '1', '9989', 2, '2019-02-22 12:56:44', '2019-02-22 07:26:44', '1', '192.168.1.15'),
(102, '86', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100088', '1', '9989', 24, '2019-02-22 12:57:18', '2019-02-22 07:27:18', '1', '192.168.1.15'),
(103, '85', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100087', '1', '9989', 4, '2019-02-22 12:57:53', '2019-02-22 07:27:53', '1', '192.168.1.15'),
(104, '87', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100089', '1', '9989', 1, '2019-02-22 13:03:25', '2019-02-22 07:33:25', '1', '192.168.1.15'),
(105, '88', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100090', '1', '9989', 4, '2019-02-22 13:04:26', '2019-02-22 07:34:26', '1', '192.168.1.15'),
(106, '89', '1', 'asdfasd', 'sdafasdf', '100091', '1', '9989', 1, '2019-02-22 13:05:07', '2019-02-22 07:35:07', '1', '192.168.1.15'),
(107, '90', '20', 'communist pvt ltd', 'chanfru', '100092', '1', '9989', 12, '2019-02-22 13:05:29', '2019-02-22 07:35:29', '1', '192.168.1.15'),
(108, '91', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100093', '1', '9989', 1, '2019-02-22 13:06:10', '2019-02-22 07:36:10', '1', '192.168.1.15'),
(109, '92', '11', 'Sai Group of Companies', 'Sai', '100094', '1', '9989', 123, '2019-02-22 13:06:42', '2019-02-22 07:36:42', '1', '192.168.1.15'),
(110, '93', '11', 'Sai Group of Companies', 'Sai', '100095', '1', '9989', 1, '2019-02-22 13:13:20', '2019-02-22 07:43:20', '1', '192.168.1.15'),
(111, '94', '19', 'Vidhun Enterprises', 'Geetha', '100096', '1', '9989', 1, '2019-02-22 13:15:08', '2019-02-22 07:45:08', '1', '192.168.1.15'),
(112, '95', '19', 'Vidhun Enterprises', 'Geetha', '100097', '1', '9989', 3000, '2019-02-25 16:16:08', '2019-02-25 10:46:08', '1', '192.168.1.20'),
(113, '95', '19', 'Vidhun Enterprises', 'Geetha', '100097', '1', '9989', 4000, '2019-02-25 16:20:51', '2019-02-25 10:50:51', '1', '192.168.1.20'),
(114, '96', '19', 'Vidhun Enterprises', 'Geetha', '100098', '3', '9989', 6000, '2019-02-27 19:36:00', '2019-02-27 14:06:00', '1', '192.168.1.62'),
(115, '96', '19', 'Vidhun Enterprises', 'Geetha', '100098', '3', '9989', 6000, '2019-02-28 10:53:30', '2019-02-28 05:23:30', '1', '192.168.1.7'),
(116, '97', '19', 'Vidhun Enterprises', 'Geetha', '100099', '3', '9989', 333, '2019-02-28 11:13:02', '2019-02-28 05:43:02', '1', '192.168.1.3'),
(117, '98', '23', 'tendulkar', 'ten', '100100', '4', '9989', 1532, '2019-02-28 12:11:03', '2019-02-28 06:41:03', '1', '192.168.1.7'),
(118, '99', '26', 'Hanifa & Co', 'Hani', '100101', '3', '9989', 5500, '2019-02-28 17:51:33', '2019-02-28 12:21:33', '1', '192.168.1.3'),
(119, '99', '26', 'Hanifa & Co', 'Hani', NULL, '3', '9989', 5500, '2019-02-28 18:19:49', '2019-02-28 12:49:49', '1', '192.168.1.7'),
(120, '100', '23', 'tendulkar', 'ten', '100102', '1', '9989', 1, '2019-02-28 18:20:17', '2019-02-28 12:50:17', '1', '192.168.1.7'),
(121, '101', '5', 'GHNDN', 'FGBFGB', '100103', '1', '9989', 1541, '2019-02-28 20:59:52', '2019-02-28 15:29:52', '1', '192.168.1.7'),
(122, '102', '27', 'dhoni pvt ltd', 'dhoni', '100104', '1', '9989', 134, '2019-03-01 12:58:37', '2019-03-01 07:28:37', '1', '192.168.1.7'),
(123, '102', '27', 'dhoni pvt ltd', 'dhoni', NULL, '3', '9989', 396, '2019-03-01 12:59:37', '2019-03-01 07:29:37', '1', '192.168.1.7'),
(124, '103', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '100105', '4', '9989', 452, '2019-03-01 13:12:30', '2019-03-01 07:42:30', '1', '192.168.1.7'),
(125, '103', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', NULL, '4', '9989', 452, '2019-03-01 13:12:43', '2019-03-01 07:42:43', '1', '192.168.1.7'),
(126, '104', '13', 'lucky vaccines', 'gopal', '100106', '3', '9989', 3, '2019-03-01 13:29:52', '2019-03-01 07:59:52', '1', '192.168.1.7'),
(127, '104', '13', 'lucky vaccines', 'gopal', NULL, '4', '9989', 3, '2019-03-01 13:30:23', '2019-03-01 08:00:23', '1', '192.168.1.7'),
(128, '104', '13', 'lucky vaccines', 'gopal', NULL, '4', '9989', 8, '2019-03-01 13:30:52', '2019-03-01 08:00:52', '1', '192.168.1.7'),
(129, '105', '27', 'dhoni pvt ltd', 'dhoni', '100107', '1', '9989', 151, '2019-03-01 13:46:19', '2019-03-01 08:16:19', '1', '192.168.1.7'),
(130, '106', '23', 'tendulkar', 'ten', '100108', '3', '9989', 301, '2019-03-02 11:00:29', '2019-03-02 05:30:29', '1', '192.168.1.25'),
(131, '107', '23', 'tendulkar', 'ten', '100109', '1', '9989', 150, '2019-03-02 13:57:10', '2019-03-02 08:27:10', '1', '192.168.1.25');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_ref_tbl`
--

CREATE TABLE `invoice_ref_tbl` (
  `id` bigint(20) NOT NULL,
  `invoice_id` varchar(255) DEFAULT NULL,
  `sac_code` varchar(255) DEFAULT NULL,
  `bill_number` varchar(255) DEFAULT NULL,
  `bill_date` datetime DEFAULT NULL,
  `description` text,
  `amount` float DEFAULT NULL,
  `gst_percent` float DEFAULT NULL,
  `cgst_percent` float DEFAULT NULL,
  `sgst_percent` float DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` varchar(255) DEFAULT NULL,
  `updated_ipaddress` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_ref_tbl`
--

INSERT INTO `invoice_ref_tbl` (`id`, `invoice_id`, `sac_code`, `bill_number`, `bill_date`, `description`, `amount`, `gst_percent`, `cgst_percent`, `sgst_percent`, `created_date`, `updated_date`, `user_id`, `updated_ipaddress`) VALUES
(4, '1', 'TEST', '100017', '0000-00-00 00:00:00', 'TEST', 1, 1, NULL, NULL, '2019-02-16 17:20:25', '2019-02-16 11:50:25', '1', '192.168.1.29'),
(5, '1', 'TEST', '100017', '0000-00-00 00:00:00', 'TEST', 2, 2, NULL, NULL, '2019-02-16 17:20:25', '2019-02-16 11:50:25', '1', '192.168.1.29'),
(7, '2', 'test', '100018', '0000-00-00 00:00:00', 'test', 2, 1, NULL, NULL, '2019-02-16 17:24:30', '2019-02-16 11:54:30', '1', '192.168.1.29'),
(14, '4', '1', '100020', '2019-02-18 17:34:34', 'asdkc las dsdl s disa', 100, NULL, NULL, NULL, '2019-02-18 17:34:34', '2019-02-18 12:04:34', '1', '192.168.1.15'),
(15, '4', '2', '100020', '2019-02-18 17:34:34', 'asdjkfv dfl dslf dsl sd isdf sdi ', 200, NULL, NULL, NULL, '2019-02-18 17:34:34', '2019-02-18 12:04:34', '1', '192.168.1.15'),
(16, '4', '3', '100020', '2019-02-18 17:34:34', 'sdjfv  djfvd v l ds idg fgio fg fiogbh ', 300, NULL, NULL, NULL, '2019-02-18 17:34:34', '2019-02-18 12:04:34', '1', '192.168.1.15'),
(17, '5', '1', '100021', '2019-02-18 17:34:43', 'asdkc las dsdl s disa', 100, NULL, NULL, NULL, '2019-02-18 17:34:43', '2019-02-18 12:04:43', '1', '192.168.1.15'),
(18, '5', '2', '100021', '2019-02-18 17:34:44', 'asdjkfv dfl dslf dsl sd isdf sdi ', 200, NULL, NULL, NULL, '2019-02-18 17:34:44', '2019-02-18 12:04:44', '1', '192.168.1.15'),
(19, '5', '3', '100021', '2019-02-18 17:34:44', 'sdjfv  djfvd v l ds idg fgio fg fiogbh ', 300, NULL, NULL, NULL, '2019-02-18 17:34:44', '2019-02-18 12:04:44', '1', '192.168.1.15'),
(24, '6', '3', '100022', '0000-00-00 00:00:00', 'asdfv wfqfw vwqfv vwerv', 200, NULL, NULL, NULL, '2019-02-18 17:40:44', '2019-02-18 12:10:44', '1', '192.168.1.15'),
(25, '6', '4', '100022', '0000-00-00 00:00:00', 'aev bvserbj sdjonb lsdkb l sdib ', 400, NULL, NULL, NULL, '2019-02-18 17:40:44', '2019-02-18 12:10:44', '1', '192.168.1.15'),
(26, '3', '123', '100019', '0000-00-00 00:00:00', 'sdkfvv j hisdfv  sdvb sdhifbh  fvbshi', 500, NULL, NULL, NULL, '2019-02-18 17:41:21', '2019-02-18 12:11:21', '1', '192.168.1.15'),
(27, '3', '124', '100019', '0000-00-00 00:00:00', 'dmn josdfvkn kjlsdfv sdfvuin vd dfvgisdfbedrfvguidv', 500, NULL, NULL, NULL, '2019-02-18 17:41:21', '2019-02-18 12:11:21', '1', '192.168.1.15'),
(28, '3', '125', '100019', '0000-00-00 00:00:00', 'dbhf hsdfv sduifv sdfklvk sdjifvb aw9h', 1000, NULL, NULL, NULL, '2019-02-18 17:41:21', '2019-02-18 12:11:21', '1', '192.168.1.15'),
(29, '3', '126', '100019', '0000-00-00 00:00:00', 'dsfjv sdbj fvjsdb sfvbv sdfvbsdfvsdb fvsdfvbsdfvsdb f sdfj bsdfhv ', 1500, NULL, NULL, NULL, '2019-02-18 17:41:21', '2019-02-18 12:11:21', '1', '192.168.1.15'),
(30, '3', '127', '100019', '0000-00-00 00:00:00', 'sdhf kzsdfv ihsdf cishdfv iuoasdv uisdgv', 2000, NULL, NULL, NULL, '2019-02-18 17:41:22', '2019-02-18 12:11:22', '1', '192.168.1.15'),
(31, '3', '128', '100019', '0000-00-00 00:00:00', 'zxdhb klxcb  isd osudh oshipd  isjdbv ', 3000, NULL, NULL, NULL, '2019-02-18 17:41:22', '2019-02-18 12:11:22', '1', '192.168.1.15'),
(32, '7', '123', '100023', '2019-02-19 16:55:07', 'test', 1000, NULL, NULL, NULL, '2019-02-19 16:55:07', '2019-02-19 11:25:07', '1', '192.168.1.30'),
(33, '8', '1000000', '100024', '2019-02-20 15:00:56', 'jas;c sadbv sa;dvsdo;v aosupdcsa asduopcb s;ao baso;bas duopcvd ', 1000, NULL, NULL, NULL, '2019-02-20 15:00:56', '2019-02-20 09:30:56', '1', '192.168.1.15'),
(41, '9', 'dsflvn sd ', '100025', '0000-00-00 00:00:00', 's;av ;as vas;dvbjopae ovewp vefpvosdvsdp fsdsdpdv sdpfv efpv efvehrwv0phwevp efv9ofp pef9vu', 5000, 12, NULL, NULL, '2019-02-20 17:12:38', '2019-02-20 11:42:38', '1', '192.168.1.15'),
(42, '9', 'asdcasjkdc', '100025', '0000-00-00 00:00:00', 'ilasdbcsdb', 500, 12, NULL, NULL, '2019-02-20 17:12:38', '2019-02-20 11:42:38', '1', '192.168.1.15'),
(43, '9', 'ckl', '100025', '0000-00-00 00:00:00', 'adjbcabpcadc adopcb asdbp  askldxb spdocb s sl', 50, 12, NULL, NULL, '2019-02-20 17:12:39', '2019-02-20 11:42:39', '1', '192.168.1.15'),
(44, '9', 'sdcjs sklj', '100025', '0000-00-00 00:00:00', 'dcbi asd lsdc sio aldc sabid a dsaduio b', 500, 12, NULL, NULL, '2019-02-20 17:12:39', '2019-02-20 11:42:39', '1', '192.168.1.15'),
(50, '10', 'ax c', '100026', '0000-00-00 00:00:00', 'kl;sxc ssopdbdf dfopg osdfg pssdpob sdpsgbio', 500, 18, NULL, NULL, '2019-02-20 17:14:53', '2019-02-20 11:44:53', '1', '192.168.1.15'),
(51, '10', 'asdcbkl ', '100026', '0000-00-00 00:00:00', 'askdlcs siodbsd sdoiwsv eofeofveif vsl spiobs vlefepfvoefvefpeovef vwefpvw pwe', 500, 18, NULL, NULL, '2019-02-20 17:14:53', '2019-02-20 11:44:53', '1', '192.168.1.15'),
(52, '11', 'SAC CODE', '100027', '2019-02-20 17:19:22', 'oiiuyftuikjhbnkigijlkgyujkhguj', 1000, 18, NULL, NULL, '2019-02-20 17:19:22', '2019-02-20 11:49:22', '1', '192.168.1.14'),
(53, '11', 'SAC CODE', '100027', '2019-02-20 17:19:22', 'jhgfdsdfghbddged', 2000, 18, NULL, NULL, '2019-02-20 17:19:22', '2019-02-20 11:49:22', '1', '192.168.1.14'),
(54, '11', 'SAC CODE', '100027', '2019-02-20 17:19:22', 'mnbvcfvbhgdfghgfgnhvghnjh ghjnbvhjjh ghjbhj jhgjk jhghn mnbvcdx ', 3000, 18, NULL, NULL, '2019-02-20 17:19:22', '2019-02-20 11:49:22', '1', '192.168.1.14'),
(55, '12', 'adl m', '100028', '2019-02-20 17:20:12', 'sld;cs sdilfsdf spob fopsdo sdsdo sdo', 500, 18, NULL, NULL, '2019-02-20 17:20:12', '2019-02-20 11:50:12', '1', '192.168.1.15'),
(56, '12', 'asdcb ', '100028', '2019-02-20 17:20:13', ' sdcasonp', 500, 18, NULL, NULL, '2019-02-20 17:20:13', '2019-02-20 11:50:13', '1', '192.168.1.15'),
(57, '12', 'db  pj p', '100028', '2019-02-20 17:20:13', 'ok[ sdfvsd fsdpofvsdopfvbhsd fopbsdbopsdgbsdp[ o', 5000, 18, NULL, NULL, '2019-02-20 17:20:13', '2019-02-20 11:50:13', '1', '192.168.1.15'),
(61, '13', 'SAC CODE', '100029', '0000-00-00 00:00:00', 'test', 1, 12, NULL, NULL, '2019-02-20 17:32:58', '2019-02-20 12:02:58', '1', '192.168.1.15'),
(62, '13', 'SAC CODE', '100029', '0000-00-00 00:00:00', 'test', 2, 12, NULL, NULL, '2019-02-20 17:32:58', '2019-02-20 12:02:58', '1', '192.168.1.15'),
(63, '13', 'SAC CODE', '100029', '0000-00-00 00:00:00', 'test', 3, 12, NULL, NULL, '2019-02-20 17:32:58', '2019-02-20 12:02:58', '1', '192.168.1.15'),
(64, '13', 'SAC CODE', '100029', '0000-00-00 00:00:00', 'test', 2000, 12, NULL, NULL, '2019-02-20 17:32:58', '2019-02-20 12:02:58', '1', '192.168.1.15'),
(65, '13', 'SAC CODE', '100029', '0000-00-00 00:00:00', 'test', 8000, 12, NULL, NULL, '2019-02-20 17:32:59', '2019-02-20 12:02:59', '1', '192.168.1.15'),
(66, '14', 'jksdbcsjkl', '100030', '2019-02-20 20:36:44', 'asdklv blasd asldkvaskldjvn askdvaskdfiv asbvasdiov asbdovia sddiovb', 1000, 0, NULL, NULL, '2019-02-20 20:36:44', '2019-02-20 15:06:44', '1', '192.168.1.15'),
(67, '14', ' sag hia', '100030', '2019-02-20 20:36:44', 'aidcg aiocbasdcbasdic acioabaioscbh aq abscoiasb casiocbqasciob qsc', 1000, 0, NULL, NULL, '2019-02-20 20:36:44', '2019-02-20 15:06:44', '1', '192.168.1.15'),
(68, '14', 'sbn', '100030', '2019-02-20 20:36:44', 'bbkb', 100, 0, NULL, NULL, '2019-02-20 20:36:44', '2019-02-20 15:06:44', '1', '192.168.1.15'),
(69, '15', '1', '100031', '2019-02-20 20:44:18', '1', 1, 18, NULL, NULL, '2019-02-20 20:44:18', '2019-02-20 15:14:18', '1', '192.168.1.15'),
(70, '15', '2', '100031', '2019-02-20 20:44:19', '2', 2, 18, NULL, NULL, '2019-02-20 20:44:19', '2019-02-20 15:14:19', '1', '192.168.1.15'),
(71, '15', '3', '100031', '2019-02-20 20:44:19', '3', 3, 18, NULL, NULL, '2019-02-20 20:44:19', '2019-02-20 15:14:19', '1', '192.168.1.15'),
(72, '15', '4', '100031', '2019-02-20 20:44:19', '4', 4, 18, NULL, NULL, '2019-02-20 20:44:19', '2019-02-20 15:14:19', '1', '192.168.1.15'),
(73, '16', '9989', '100032', '2019-02-21 18:47:31', '1201', 12, 18, NULL, NULL, '2019-02-21 18:47:31', '2019-02-21 13:17:31', '1', '192.168.1.15'),
(74, '16', '9989', '100032', '2019-02-21 18:47:31', '2133', 123, 18, NULL, NULL, '2019-02-21 18:47:31', '2019-02-21 13:17:31', '1', '192.168.1.15'),
(75, '16', '9989', '100032', '2019-02-21 18:47:32', '1', 121, 18, NULL, NULL, '2019-02-21 18:47:32', '2019-02-21 13:17:32', '1', '192.168.1.15'),
(76, '17', '9989', '100033', '2019-02-21 18:51:01', 'jk', 12, 0.1, NULL, NULL, '2019-02-21 18:51:01', '2019-02-21 13:21:01', '1', '192.168.1.15'),
(78, '17', '9989', '100035', '2019-02-22 13:48:56', '1', 1, 0, NULL, NULL, '2019-02-22 13:48:56', '2019-02-22 08:18:56', '1', '192.168.1.15'),
(79, '17', '9989', '100035', '2019-02-22 13:48:56', '2', 2, 0, NULL, NULL, '2019-02-22 13:48:56', '2019-02-22 08:18:56', '1', '192.168.1.15'),
(104, '18', '9989', '100036', '0000-00-00 00:00:00', 'jk', 12, 18, NULL, NULL, '2019-02-22 14:09:32', '2019-02-22 08:39:32', '1', '192.168.1.15'),
(105, '19', '9989', '100037', '2019-02-22 14:10:33', 'awe fklasvsjkdvsba saovashop sav asfvn spadfvo sadfovop asdfnvop asdfovnpsdfvnaspvo wahviop aweovpwhvnsdfvns ovsv opasdfvnasovnsaonvsnvonsdfa', 500, 0, NULL, NULL, '2019-02-22 14:10:33', '2019-02-22 08:40:33', '1', '192.168.1.15'),
(106, '20', '9989', '100037', '2019-02-22 14:10:51', 'awe fklasvsjkdvsba saovashop sav asfvn spadfvo sadfovop asdfnvop asdfovnpsdfvnaspvo wahviop aweovpwhvnsdfvns ovsv opasdfvnasovnsaonvsnvonsdfa', 500, 0, NULL, NULL, '2019-02-22 14:10:51', '2019-02-22 08:40:51', '1', '192.168.1.15'),
(107, '21', '9989', '100037', '2019-02-22 14:11:05', 'awe fklasvsjkdvsba saovashop sav asfvn spadfvo sadfovop asdfnvop asdfovnpsdfvnaspvo wahviop aweovpwhvnsdfvns ovsv opasdfvnasovnsaonvsnvonsdfa', 500, 0, NULL, NULL, '2019-02-22 14:11:05', '2019-02-22 08:41:05', '1', '192.168.1.15'),
(113, '22', '9989', '100037', '0000-00-00 00:00:00', 'awe fklasvsjkdvsba saovashop sav asfvn spadfvo sadfovop asdfnvop asdfovnpsdfvnaspvo wahviop aweovpwhvnsdfvns ovsv opasdfvnasovnsaonvsnvonsdfa', 500, 0, NULL, NULL, '2019-02-22 14:12:41', '2019-02-22 08:42:41', '1', '192.168.1.15'),
(114, '22', '9989', '100037', '0000-00-00 00:00:00', 'av ospovhas odpvnasd opv nasdfvopasdfpvohasdf vpasdvnasdovasdpvj awpef awp9awu9pefu9 wvasjdvas iodvasdfvuashduvasohvasopvhas voasvhasodvpawp9vasdvjksd bvp asopuv asp9uv', 5002, 0, NULL, NULL, '2019-02-22 14:12:41', '2019-02-22 08:42:41', '1', '192.168.1.15'),
(115, '22', '9989', '100037', '0000-00-00 00:00:00', 'ACKL A SDBCASOIDCBASIDASD  ASDV S F VOSDFIVO VSA SDVASBDVPBA SVSB VASBIAVVBASFVSOIBV', 500, 0, NULL, NULL, '2019-02-22 14:12:41', '2019-02-22 08:42:41', '1', '192.168.1.15'),
(116, '22', '9989', '100037', '0000-00-00 00:00:00', 'ASD VJSDVSBDV ASLKDBVS DAVASBDVK', 500, 0, NULL, NULL, '2019-02-22 14:12:41', '2019-02-22 08:42:41', '1', '192.168.1.15'),
(122, '23', '9989', '100038', '0000-00-00 00:00:00', 'dklfb dkfbdkl;fbasd bsdflbn dlfbn dl;', 480, 0, NULL, NULL, '2019-02-25 16:38:25', '2019-02-25 11:08:25', '1', '192.168.1.20'),
(123, '23', '9989', '100038', '0000-00-00 00:00:00', ' bb bd klsbsdo bheepro ebepobhpobdbdb b ', 500, 0, NULL, NULL, '2019-02-25 16:38:25', '2019-02-25 11:08:25', '1', '192.168.1.20'),
(124, '23', '9989', '100038', '0000-00-00 00:00:00', 'dcb ssk avas', 1500, 0, NULL, NULL, '2019-02-25 16:38:25', '2019-02-25 11:08:25', '1', '192.168.1.20'),
(125, '24', '9989', '100039', '2019-02-27 19:45:55', '1 fsjfsjk sjfjsfj jsfjkjfk jsjk \r\n fjsfjsfk;dlskf kdsfk\r\nkl;kl;fklsd;fk klk;sdfaddddddddddddddddddddddddddddddddddd\r\n', 1000, 12, NULL, NULL, '2019-02-27 19:45:55', '2019-02-27 14:15:55', '1', '192.168.1.62'),
(126, '24', '9989', '100039', '2019-02-27 19:45:55', '2jfksjfj jkjfksfjsjfsjfklaj ;;;;;;;;;;;;;;;;;;;;;;;;; p hhhhhhhhhhhhhhhhhhhhhhhhhhhhsdfjsdljflsdjf\r\nsdfklsjfklsjfkldsjfio ji ooiiojfjopak;lkf kpskfopsfiopifopjapjdopkml ', 2000, 12, NULL, NULL, '2019-02-27 19:45:55', '2019-02-27 14:15:55', '1', '192.168.1.62'),
(127, '25', '9989', '100040', '2019-02-27 19:50:29', 'Tests', 111, 18, NULL, NULL, '2019-02-27 19:50:29', '2019-02-27 14:20:29', '1', '192.168.1.62'),
(128, '25', '9989', '100040', '2019-02-27 19:50:29', 'Test 2', 222, 18, NULL, NULL, '2019-02-27 19:50:29', '2019-02-27 14:20:29', '1', '192.168.1.62'),
(129, '26', '9989', '100041', '2019-02-28 11:16:22', 'test', 111, 12, NULL, NULL, '2019-02-28 11:16:22', '2019-02-28 05:46:22', '1', '192.168.1.3'),
(130, '26', '9989', '100041', '2019-02-28 11:16:22', 'test', 111, 12, NULL, NULL, '2019-02-28 11:16:22', '2019-02-28 05:46:22', '1', '192.168.1.3'),
(131, '26', '9989', '100041', '2019-02-28 11:16:22', 'test', 111, 12, NULL, NULL, '2019-02-28 11:16:22', '2019-02-28 05:46:22', '1', '192.168.1.3'),
(132, '26', '9989', '100041', '2019-02-28 11:16:22', 'test', 111, 12, NULL, NULL, '2019-02-28 11:16:22', '2019-02-28 05:46:22', '1', '192.168.1.3'),
(133, '27', '9989', '100042', '2019-02-28 18:09:23', 'Test Particular', 1000, 12, NULL, NULL, '2019-02-28 18:09:23', '2019-02-28 12:39:23', '1', '192.168.1.3'),
(134, '27', '9989', '100042', '2019-02-28 18:09:23', 'Test Particular', 2000, 12, NULL, NULL, '2019-02-28 18:09:23', '2019-02-28 12:39:23', '1', '192.168.1.3'),
(135, '27', '9989', '100042', '2019-02-28 18:09:23', 'Test Particular', 3000, 12, NULL, NULL, '2019-02-28 18:09:23', '2019-02-28 12:39:23', '1', '192.168.1.3'),
(136, '27', '9989', '100042', '2019-02-28 18:09:23', 'Test Particular', 4000, 12, NULL, NULL, '2019-02-28 18:09:23', '2019-02-28 12:39:23', '1', '192.168.1.3'),
(137, '28', '9989', '100043', '2019-03-01 11:14:48', '300 Envelop', 3000, 0, NULL, NULL, '2019-03-01 11:14:48', '2019-03-01 05:44:48', '1', '192.168.1.7'),
(138, '28', '9989', '100043', '2019-03-01 11:14:48', '500 Business Cards', 2500, 0, NULL, NULL, '2019-03-01 11:14:48', '2019-03-01 05:44:48', '1', '192.168.1.7'),
(139, '28', '9989', '100043', '2019-03-01 11:14:48', 'testert', 2626, 0, NULL, NULL, '2019-03-01 11:14:48', '2019-03-01 05:44:48', '1', '192.168.1.7'),
(140, '28', '9989', '100043', '2019-03-01 11:14:48', 'ttt', 1551, 0, NULL, NULL, '2019-03-01 11:14:48', '2019-03-01 05:44:48', '1', '192.168.1.7'),
(148, '29', '9989', '100044', '2019-03-01 11:15:16', 'asd jkv', 1541, 0, NULL, NULL, '2019-03-01 11:55:38', '2019-03-01 06:25:38', '1', '192.168.1.7'),
(149, '29', '9989', '100044', '2019-03-01 11:15:16', 'asdfjvaj', 15, 0, NULL, NULL, '2019-03-01 11:55:38', '2019-03-01 06:25:38', '1', '192.168.1.7'),
(150, '29', '9989', '100044', '2019-03-01 11:15:16', 'ttt', 15000, 0, NULL, NULL, '2019-03-01 11:55:38', '2019-03-01 06:25:38', '1', '192.168.1.7'),
(151, '29', '9989', '100044', '2019-03-01 11:15:16', 'w', 151, 0, NULL, NULL, '2019-03-01 11:55:38', '2019-03-01 06:25:38', '1', '192.168.1.7'),
(152, '29', '9989', '100044', '2019-03-01 11:15:16', 'asjdv', 151111, 0, NULL, NULL, '2019-03-01 11:55:38', '2019-03-01 06:25:38', '1', '192.168.1.7'),
(157, '30', '9989', '100045', '2019-03-01 13:11:19', ' asdasdj', 151, 18, NULL, NULL, '2019-03-01 13:11:48', '2019-03-01 07:41:48', '1', '192.168.1.7'),
(158, '30', '9989', '100045', '2019-03-01 13:11:19', 'widf asioasopd', 2151, 18, NULL, NULL, '2019-03-01 13:11:49', '2019-03-01 07:41:49', '1', '192.168.1.7'),
(159, '30', '9989', '100045', '2019-03-01 13:11:19', ' wqopefqwqwdbp', 151, 18, NULL, NULL, '2019-03-01 13:11:49', '2019-03-01 07:41:49', '1', '192.168.1.7'),
(160, '30', '9989', '100045', '2019-03-01 13:11:19', 'we 9rfg werfawi', 151, 18, NULL, NULL, '2019-03-01 13:11:49', '2019-03-01 07:41:49', '1', '192.168.1.7'),
(161, '30', '9989', '100045', '2019-03-01 13:11:19', ' sajdasjd', 151, 18, NULL, NULL, '2019-03-01 13:11:49', '2019-03-01 07:41:49', '1', '192.168.1.7'),
(164, '31', '9989', '100046', '2019-03-01 13:14:22', ' asdjkfsj', 15, 18, NULL, NULL, '2019-03-01 13:14:42', '2019-03-01 07:44:42', '1', '192.168.1.7'),
(165, '31', '9989', '100046', '2019-03-01 13:14:22', 'sdfjsvk', 4115, 18, NULL, NULL, '2019-03-01 13:14:42', '2019-03-01 07:44:42', '1', '192.168.1.7'),
(166, '32', '9989', '100047', '2019-03-01 13:15:03', 'TEST 10', 1, 0, NULL, NULL, '2019-03-01 13:15:03', '2019-03-01 07:45:03', '1', '192.168.1.7'),
(167, '32', '9989', '100047', '2019-03-01 13:15:03', 'TEST 9', 12, 0, NULL, NULL, '2019-03-01 13:15:03', '2019-03-01 07:45:03', '1', '192.168.1.7'),
(168, '32', '9989', '100047', '2019-03-01 13:15:03', 'TEST 8', 121, 0, NULL, NULL, '2019-03-01 13:15:03', '2019-03-01 07:45:03', '1', '192.168.1.7'),
(169, '32', '9989', '100047', '2019-03-01 13:15:03', 'TEST 7', 262, 0, NULL, NULL, '2019-03-01 13:15:03', '2019-03-01 07:45:03', '1', '192.168.1.7'),
(170, '32', '9989', '100047', '2019-03-01 13:15:03', 'test 6', 1551, 0, NULL, NULL, '2019-03-01 13:15:03', '2019-03-01 07:45:03', '1', '192.168.1.7'),
(171, '32', '9989', '100047', '2019-03-01 13:15:03', 'ttt 11', 11, 0, NULL, NULL, '2019-03-01 13:15:03', '2019-03-01 07:45:03', '1', '192.168.1.7'),
(172, '32', '9989', '100047', '2019-03-01 13:15:03', ' asjdvbk s', 151, 0, NULL, NULL, '2019-03-01 13:15:03', '2019-03-01 07:45:03', '1', '192.168.1.7'),
(186, '33', '9989', '100048', '2019-03-01 13:50:47', '151', 151, 0, NULL, NULL, '2019-03-01 13:52:22', '2019-03-01 08:22:22', '1', '192.168.1.7'),
(187, '33', '9989', '100048', '2019-03-01 13:50:47', '11', 11, 0, NULL, NULL, '2019-03-01 13:52:22', '2019-03-01 08:22:22', '1', '192.168.1.7'),
(188, '33', '9989', '100048', '2019-03-01 13:50:47', '33', 3, 0, NULL, NULL, '2019-03-01 13:52:22', '2019-03-01 08:22:22', '1', '192.168.1.7'),
(189, '33', '9989', '100048', '2019-03-01 13:50:47', '22', 54, 0, NULL, NULL, '2019-03-01 13:52:22', '2019-03-01 08:22:22', '1', '192.168.1.7'),
(190, '33', '9989', '100048', '2019-03-01 13:50:47', '33', 3, 0, NULL, NULL, '2019-03-01 13:52:22', '2019-03-01 08:22:22', '1', '192.168.1.7'),
(191, '33', '9989', '100048', '2019-03-01 13:50:47', '15151', 151, 0, NULL, NULL, '2019-03-01 13:52:23', '2019-03-01 08:22:23', '1', '192.168.1.7'),
(192, '33', '9989', '100048', '2019-03-01 13:50:47', 'yyy', 1, 0, NULL, NULL, '2019-03-01 13:52:23', '2019-03-01 08:22:23', '1', '192.168.1.7'),
(193, '33', '9989', '100048', '2019-03-01 13:50:47', 'ii', 11, 0, NULL, NULL, '2019-03-01 13:52:23', '2019-03-01 08:22:23', '1', '192.168.1.7'),
(194, '34', '9989', '100049', '2019-03-02 11:51:38', ' asdc asdcjvasdjkcasdj kc', 1500, 18, NULL, NULL, '2019-03-02 11:51:38', '2019-03-02 06:21:38', '1', '192.168.1.25'),
(195, '34', '9989', '100049', '2019-03-02 11:51:38', 'd sfkvskdfvkasdfvaskd sadvasdvsbi', 1500, 18, NULL, NULL, '2019-03-02 11:51:38', '2019-03-02 06:21:38', '1', '192.168.1.25'),
(196, '35', '9989', 'IV-2019-100050', '2019-03-02 14:46:12', 'asd cvasdjkv sadjasvdj', 1500, 0, NULL, NULL, '2019-03-02 14:46:12', '2019-03-02 09:16:12', '1', '192.168.1.25'),
(197, '36', '9989', 'INV-2019-0001', '2019-03-04 16:20:10', 'sdcsadcas', 150, 0, NULL, NULL, '2019-03-04 16:20:10', '2019-03-04 10:50:10', '1', '192.168.1.25'),
(198, '36', '9989', 'INV-2019-0001', '2019-03-04 16:20:10', 'dfv sdf bsdf', 1500, 0, NULL, NULL, '2019-03-04 16:20:10', '2019-03-04 10:50:10', '1', '192.168.1.25');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_ref_tbl_log`
--

CREATE TABLE `invoice_ref_tbl_log` (
  `auto_id` bigint(20) NOT NULL,
  `invoice_table_log_id` varchar(255) DEFAULT NULL,
  `invoice_ref_id` varchar(255) DEFAULT NULL,
  `bill_number` varchar(255) DEFAULT NULL,
  `bill_date` datetime DEFAULT NULL,
  `sac_code` varchar(255) DEFAULT NULL,
  `description` text,
  `amount` varchar(255) DEFAULT NULL,
  `gst_percent` float DEFAULT NULL,
  `cgst_percent` float DEFAULT NULL,
  `sgst_percent` float DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` varchar(255) DEFAULT NULL,
  `updated_ipaddress` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_ref_tbl_log`
--

INSERT INTO `invoice_ref_tbl_log` (`auto_id`, `invoice_table_log_id`, `invoice_ref_id`, `bill_number`, `bill_date`, `sac_code`, `description`, `amount`, `gst_percent`, `cgst_percent`, `sgst_percent`, `created_date`, `updated_date`, `user_id`, `updated_ipaddress`) VALUES
(1, '1', '1', '100017', '2019-02-16 17:16:08', '12', '121', '231', 1, NULL, NULL, '2019-02-16 17:16:08', '2019-02-16 11:46:08', '1', '192.168.1.29'),
(2, '1', '2', '100017', '2019-02-16 17:16:08', '12', '1211', '123', 3, NULL, NULL, '2019-02-16 17:16:08', '2019-02-16 11:46:08', '1', '192.168.1.29'),
(3, '1', '3', '100017', '2019-02-16 17:16:08', '123', '123', '1321', 4, NULL, NULL, '2019-02-16 17:16:08', '2019-02-16 11:46:08', '1', '192.168.1.29'),
(4, '2', '4', '100017', '0000-00-00 00:00:00', 'TEST', 'TEST', '1', 1, NULL, NULL, '2019-02-16 17:20:25', '2019-02-16 11:50:25', '1', '192.168.1.29'),
(5, '2', '5', '100017', '0000-00-00 00:00:00', 'TEST', 'TEST', '2', 2, NULL, NULL, '2019-02-16 17:20:25', '2019-02-16 11:50:25', '1', '192.168.1.29'),
(6, '3', '6', '100018', '2019-02-16 17:23:59', '1', '1', '1', 1, NULL, NULL, '2019-02-16 17:23:59', '2019-02-16 11:53:59', '1', '192.168.1.29'),
(7, '4', '7', '100018', '0000-00-00 00:00:00', 'test', 'test', '2', 1, NULL, NULL, '2019-02-16 17:24:30', '2019-02-16 11:54:30', '1', '192.168.1.29'),
(8, '5', '8', '100019', '2019-02-18 15:06:20', '123', 'sdkfvv j hisdfv  sdvb sdhifbh  fvbshi', '500', 1, NULL, NULL, '2019-02-18 15:06:20', '2019-02-18 09:36:20', '1', '192.168.1.15'),
(9, '5', '9', '100019', '2019-02-18 15:06:20', '124', 'dmn josdfvkn kjlsdfv sdfvuin vd dfvgisdfbedrfvguidv', '500', 2, NULL, NULL, '2019-02-18 15:06:20', '2019-02-18 09:36:20', '1', '192.168.1.15'),
(10, '5', '10', '100019', '2019-02-18 15:06:20', '125', 'dbhf hsdfv sduifv sdfklvk sdjifvb aw9h', '1000', 3, NULL, NULL, '2019-02-18 15:06:20', '2019-02-18 09:36:20', '1', '192.168.1.15'),
(11, '5', '11', '100019', '2019-02-18 15:06:20', '126', 'dsfjv sdbj fvjsdb sfvbv sdfvbsdfvsdb fvsdfvbsdfvsdb f sdfj bsdfhv ', '1500', 4, NULL, NULL, '2019-02-18 15:06:20', '2019-02-18 09:36:20', '1', '192.168.1.15'),
(12, '5', '12', '100019', '2019-02-18 15:06:20', '127', 'sdhf kzsdfv ihsdf cishdfv iuoasdv uisdgv', '2000', 5, NULL, NULL, '2019-02-18 15:06:20', '2019-02-18 09:36:20', '1', '192.168.1.15'),
(13, '5', '13', '100019', '2019-02-18 15:06:21', '128', 'zxdhb klxcb  isd osudh oshipd  isjdbv ', '3000', 6, NULL, NULL, '2019-02-18 15:06:21', '2019-02-18 09:36:21', '1', '192.168.1.15'),
(14, '6', '14', '100020', '2019-02-18 17:34:34', '1', 'asdkc las dsdl s disa', '100', NULL, NULL, NULL, '2019-02-18 17:34:34', '2019-02-18 12:04:34', '1', '192.168.1.15'),
(15, '6', '15', '100020', '2019-02-18 17:34:34', '2', 'asdjkfv dfl dslf dsl sd isdf sdi ', '200', NULL, NULL, NULL, '2019-02-18 17:34:34', '2019-02-18 12:04:34', '1', '192.168.1.15'),
(16, '6', '16', '100020', '2019-02-18 17:34:34', '3', 'sdjfv  djfvd v l ds idg fgio fg fiogbh ', '300', NULL, NULL, NULL, '2019-02-18 17:34:34', '2019-02-18 12:04:34', '1', '192.168.1.15'),
(17, '7', '17', '100021', '2019-02-18 17:34:43', '1', 'asdkc las dsdl s disa', '100', NULL, NULL, NULL, '2019-02-18 17:34:43', '2019-02-18 12:04:43', '1', '192.168.1.15'),
(18, '7', '18', '100021', '2019-02-18 17:34:44', '2', 'asdjkfv dfl dslf dsl sd isdf sdi ', '200', NULL, NULL, NULL, '2019-02-18 17:34:44', '2019-02-18 12:04:44', '1', '192.168.1.15'),
(19, '7', '19', '100021', '2019-02-18 17:34:44', '3', 'sdjfv  djfvd v l ds idg fgio fg fiogbh ', '300', NULL, NULL, NULL, '2019-02-18 17:34:44', '2019-02-18 12:04:44', '1', '192.168.1.15'),
(20, '8', '20', '100022', '2019-02-18 17:39:02', '3', 'asdfv wfqfw vwqfv vwerv', '200', NULL, NULL, NULL, '2019-02-18 17:39:02', '2019-02-18 12:09:02', '1', '192.168.1.15'),
(21, '8', '21', '100022', '2019-02-18 17:39:02', '4', 'aev bvserbj sdjonb lsdkb l sdib ', '400', NULL, NULL, NULL, '2019-02-18 17:39:02', '2019-02-18 12:09:02', '1', '192.168.1.15'),
(22, '9', '22', '100022', '0000-00-00 00:00:00', '3', 'asdfv wfqfw vwqfv vwerv', '200', NULL, NULL, NULL, '2019-02-18 17:40:05', '2019-02-18 12:10:05', '1', '192.168.1.15'),
(23, '9', '23', '100022', '0000-00-00 00:00:00', '4', 'aev bvserbj sdjonb lsdkb l sdib ', '400', NULL, NULL, NULL, '2019-02-18 17:40:05', '2019-02-18 12:10:05', '1', '192.168.1.15'),
(24, '10', '24', '100022', '0000-00-00 00:00:00', '3', 'asdfv wfqfw vwqfv vwerv', '200', NULL, NULL, NULL, '2019-02-18 17:40:44', '2019-02-18 12:10:44', '1', '192.168.1.15'),
(25, '10', '25', '100022', '0000-00-00 00:00:00', '4', 'aev bvserbj sdjonb lsdkb l sdib ', '400', NULL, NULL, NULL, '2019-02-18 17:40:44', '2019-02-18 12:10:44', '1', '192.168.1.15'),
(26, '11', '26', '100019', '0000-00-00 00:00:00', '123', 'sdkfvv j hisdfv  sdvb sdhifbh  fvbshi', '500', NULL, NULL, NULL, '2019-02-18 17:41:21', '2019-02-18 12:11:21', '1', '192.168.1.15'),
(27, '11', '27', '100019', '0000-00-00 00:00:00', '124', 'dmn josdfvkn kjlsdfv sdfvuin vd dfvgisdfbedrfvguidv', '500', NULL, NULL, NULL, '2019-02-18 17:41:21', '2019-02-18 12:11:21', '1', '192.168.1.15'),
(28, '11', '28', '100019', '0000-00-00 00:00:00', '125', 'dbhf hsdfv sduifv sdfklvk sdjifvb aw9h', '1000', NULL, NULL, NULL, '2019-02-18 17:41:21', '2019-02-18 12:11:21', '1', '192.168.1.15'),
(29, '11', '29', '100019', '0000-00-00 00:00:00', '126', 'dsfjv sdbj fvjsdb sfvbv sdfvbsdfvsdb fvsdfvbsdfvsdb f sdfj bsdfhv ', '1500', NULL, NULL, NULL, '2019-02-18 17:41:22', '2019-02-18 12:11:22', '1', '192.168.1.15'),
(30, '11', '30', '100019', '0000-00-00 00:00:00', '127', 'sdhf kzsdfv ihsdf cishdfv iuoasdv uisdgv', '2000', NULL, NULL, NULL, '2019-02-18 17:41:22', '2019-02-18 12:11:22', '1', '192.168.1.15'),
(31, '11', '31', '100019', '0000-00-00 00:00:00', '128', 'zxdhb klxcb  isd osudh oshipd  isjdbv ', '3000', NULL, NULL, NULL, '2019-02-18 17:41:22', '2019-02-18 12:11:22', '1', '192.168.1.15'),
(32, '12', '32', '100023', '2019-02-19 16:55:07', '123', 'test', '1000', NULL, NULL, NULL, '2019-02-19 16:55:07', '2019-02-19 11:25:07', '1', '192.168.1.30'),
(33, '13', '33', '100024', '2019-02-20 15:00:56', '1000000', 'jas;c sadbv sa;dvsdo;v aosupdcsa asduopcb s;ao baso;bas duopcvd ', '1000', NULL, NULL, NULL, '2019-02-20 15:00:56', '2019-02-20 09:30:56', '1', '192.168.1.15'),
(34, '14', '34', '100025', '2019-02-20 16:18:10', 'dsflvn sd ', 's;av ;as vas;dvbjopae ovewp vefpvosdvsdp fsdsdpdv sdpfv efpv efvehrwv0phwevp efv9ofp pef9vu', '5000', 12, NULL, NULL, '2019-02-20 16:18:10', '2019-02-20 10:48:10', '1', '192.168.1.15'),
(35, '14', '35', '100025', '2019-02-20 16:18:10', 'asdcasjkdc', 'ilasdbcsdb', '500', 12, NULL, NULL, '2019-02-20 16:18:10', '2019-02-20 10:48:10', '1', '192.168.1.15'),
(36, '14', '36', '100025', '2019-02-20 16:18:10', 'ckl', 'adjbcabpcadc adopcb asdbp  askldxb spdocb s sl', '50', 12, NULL, NULL, '2019-02-20 16:18:10', '2019-02-20 10:48:10', '1', '192.168.1.15'),
(37, '14', '37', '100025', '2019-02-20 16:18:10', 'sdcjs sklj', 'dcbi asd lsdc sio aldc sabid a dsaduio b', '500', 12, NULL, NULL, '2019-02-20 16:18:10', '2019-02-20 10:48:10', '1', '192.168.1.15'),
(38, '15', '38', '100026', '2019-02-20 16:21:53', 'ax c', 'kl;sxc ssopdbdf dfopg osdfg pssdpob sdpsgbio', '500', 18, NULL, NULL, '2019-02-20 16:21:53', '2019-02-20 10:51:53', '1', '192.168.1.15'),
(39, '15', '39', '100026', '2019-02-20 16:21:53', 'asdcbkl ', 'askdlcs siodbsd sdoiwsv eofeofveif vsl spiobs vlefepfvoefvefpeovef vwefpvw pwe', '500', 18, NULL, NULL, '2019-02-20 16:21:53', '2019-02-20 10:51:53', '1', '192.168.1.15'),
(40, '15', '40', '100026', '2019-02-20 16:21:53', 'sdfklvb', 'ofv wep weopbgnbnopgbwpbwnbpw  weivbwe wep wewpbwrpbwr b0bh rwbprwpbh0 we ', '500', 18, NULL, NULL, '2019-02-20 16:21:53', '2019-02-20 10:51:53', '1', '192.168.1.15'),
(41, '16', '41', '100025', '0000-00-00 00:00:00', 'dsflvn sd ', 's;av ;as vas;dvbjopae ovewp vefpvosdvsdp fsdsdpdv sdpfv efpv efvehrwv0phwevp efv9ofp pef9vu', '5000', 12, NULL, NULL, '2019-02-20 17:12:38', '2019-02-20 11:42:38', '1', '192.168.1.15'),
(42, '16', '42', '100025', '0000-00-00 00:00:00', 'asdcasjkdc', 'ilasdbcsdb', '500', 12, NULL, NULL, '2019-02-20 17:12:39', '2019-02-20 11:42:39', '1', '192.168.1.15'),
(43, '16', '43', '100025', '0000-00-00 00:00:00', 'ckl', 'adjbcabpcadc adopcb asdbp  askldxb spdocb s sl', '50', 12, NULL, NULL, '2019-02-20 17:12:39', '2019-02-20 11:42:39', '1', '192.168.1.15'),
(44, '16', '44', '100025', '0000-00-00 00:00:00', 'sdcjs sklj', 'dcbi asd lsdc sio aldc sabid a dsaduio b', '500', 12, NULL, NULL, '2019-02-20 17:12:39', '2019-02-20 11:42:39', '1', '192.168.1.15'),
(45, '17', '45', '100026', '0000-00-00 00:00:00', 'ax c', 'kl;sxc ssopdbdf dfopg osdfg pssdpob sdpsgbio', '500', 18, NULL, NULL, '2019-02-20 17:13:47', '2019-02-20 11:43:47', '1', '192.168.1.15'),
(46, '17', '46', '100026', '0000-00-00 00:00:00', 'asdcbkl ', 'askdlcs siodbsd sdoiwsv eofeofveif vsl spiobs vlefepfvoefvefpeovef vwefpvw pwe', '500', 18, NULL, NULL, '2019-02-20 17:13:47', '2019-02-20 11:43:47', '1', '192.168.1.15'),
(47, '17', '47', '100026', '0000-00-00 00:00:00', 'sdfklvb', 'ofv wep weopbgnbnopgbwpbwnbpw  weivbwe wep wewpbwrpbwr b0bh rwbprwpbh0 we ', '500', 18, NULL, NULL, '2019-02-20 17:13:47', '2019-02-20 11:43:47', '1', '192.168.1.15'),
(48, '18', '48', '100026', '0000-00-00 00:00:00', 'ax c', 'kl;sxc ssopdbdf dfopg osdfg pssdpob sdpsgbio', '500', 18, NULL, NULL, '2019-02-20 17:14:06', '2019-02-20 11:44:06', '1', '192.168.1.15'),
(49, '18', '49', '100026', '0000-00-00 00:00:00', 'asdcbkl ', 'askdlcs siodbsd sdoiwsv eofeofveif vsl spiobs vlefepfvoefvefpeovef vwefpvw pwe', '500', 18, NULL, NULL, '2019-02-20 17:14:06', '2019-02-20 11:44:06', '1', '192.168.1.15'),
(50, '19', '50', '100026', '0000-00-00 00:00:00', 'ax c', 'kl;sxc ssopdbdf dfopg osdfg pssdpob sdpsgbio', '500', 18, NULL, NULL, '2019-02-20 17:14:53', '2019-02-20 11:44:53', '1', '192.168.1.15'),
(51, '19', '51', '100026', '0000-00-00 00:00:00', 'asdcbkl ', 'askdlcs siodbsd sdoiwsv eofeofveif vsl spiobs vlefepfvoefvefpeovef vwefpvw pwe', '500', 18, NULL, NULL, '2019-02-20 17:14:53', '2019-02-20 11:44:53', '1', '192.168.1.15'),
(52, '20', '52', '100027', '2019-02-20 17:19:22', 'SAC CODE', 'oiiuyftuikjhbnkigijlkgyujkhguj', '1000', 18, NULL, NULL, '2019-02-20 17:19:22', '2019-02-20 11:49:22', '1', '192.168.1.14'),
(53, '20', '53', '100027', '2019-02-20 17:19:22', 'SAC CODE', 'jhgfdsdfghbddged', '2000', 18, NULL, NULL, '2019-02-20 17:19:22', '2019-02-20 11:49:22', '1', '192.168.1.14'),
(54, '20', '54', '100027', '2019-02-20 17:19:22', 'SAC CODE', 'mnbvcfvbhgdfghgfgnhvghnjh ghjnbvhjjh ghjbhj jhgjk jhghn mnbvcdx ', '3000', 18, NULL, NULL, '2019-02-20 17:19:22', '2019-02-20 11:49:22', '1', '192.168.1.14'),
(55, '21', '55', '100028', '2019-02-20 17:20:13', 'adl m', 'sld;cs sdilfsdf spob fopsdo sdsdo sdo', '500', 18, NULL, NULL, '2019-02-20 17:20:13', '2019-02-20 11:50:13', '1', '192.168.1.15'),
(56, '21', '56', '100028', '2019-02-20 17:20:13', 'asdcb ', ' sdcasonp', '500', 18, NULL, NULL, '2019-02-20 17:20:13', '2019-02-20 11:50:13', '1', '192.168.1.15'),
(57, '21', '57', '100028', '2019-02-20 17:20:13', 'db  pj p', 'ok[ sdfvsd fsdpofvsdopfvbhsd fopbsdbopsdgbsdp[ o', '5000', 18, NULL, NULL, '2019-02-20 17:20:13', '2019-02-20 11:50:13', '1', '192.168.1.15'),
(58, '22', '58', '100029', '2019-02-20 17:31:28', 'SAC CODE', 'test', '1', 12, NULL, NULL, '2019-02-20 17:31:28', '2019-02-20 12:01:28', '1', '192.168.1.15'),
(59, '22', '59', '100029', '2019-02-20 17:31:28', 'SAC CODE', 'test', '2', 12, NULL, NULL, '2019-02-20 17:31:28', '2019-02-20 12:01:28', '1', '192.168.1.15'),
(60, '22', '60', '100029', '2019-02-20 17:31:29', 'SAC CODE', 'test', '3', 12, NULL, NULL, '2019-02-20 17:31:29', '2019-02-20 12:01:29', '1', '192.168.1.15'),
(61, '23', '61', '100029', '0000-00-00 00:00:00', 'SAC CODE', 'test', '1', 12, NULL, NULL, '2019-02-20 17:32:58', '2019-02-20 12:02:58', '1', '192.168.1.15'),
(62, '23', '62', '100029', '0000-00-00 00:00:00', 'SAC CODE', 'test', '2', 12, NULL, NULL, '2019-02-20 17:32:58', '2019-02-20 12:02:58', '1', '192.168.1.15'),
(63, '23', '63', '100029', '0000-00-00 00:00:00', 'SAC CODE', 'test', '3', 12, NULL, NULL, '2019-02-20 17:32:58', '2019-02-20 12:02:58', '1', '192.168.1.15'),
(64, '23', '64', '100029', '0000-00-00 00:00:00', 'SAC CODE', 'test', '2000', 12, NULL, NULL, '2019-02-20 17:32:58', '2019-02-20 12:02:58', '1', '192.168.1.15'),
(65, '23', '65', '100029', '0000-00-00 00:00:00', 'SAC CODE', 'test', '8000', 12, NULL, NULL, '2019-02-20 17:32:59', '2019-02-20 12:02:59', '1', '192.168.1.15'),
(66, '24', '66', '100030', '2019-02-20 20:36:44', 'jksdbcsjkl', 'asdklv blasd asldkvaskldjvn askdvaskdfiv asbvasdiov asbdovia sddiovb', '1000', 0, NULL, NULL, '2019-02-20 20:36:44', '2019-02-20 15:06:44', '1', '192.168.1.15'),
(67, '24', '67', '100030', '2019-02-20 20:36:44', ' sag hia', 'aidcg aiocbasdcbasdic acioabaioscbh aq abscoiasb casiocbqasciob qsc', '1000', 0, NULL, NULL, '2019-02-20 20:36:44', '2019-02-20 15:06:44', '1', '192.168.1.15'),
(68, '24', '68', '100030', '2019-02-20 20:36:45', 'sbn', 'bbkb', '100', 0, NULL, NULL, '2019-02-20 20:36:45', '2019-02-20 15:06:45', '1', '192.168.1.15'),
(69, '25', '69', '100031', '2019-02-20 20:44:19', '1', '1', '1', 18, NULL, NULL, '2019-02-20 20:44:19', '2019-02-20 15:14:19', '1', '192.168.1.15'),
(70, '25', '70', '100031', '2019-02-20 20:44:19', '2', '2', '2', 18, NULL, NULL, '2019-02-20 20:44:19', '2019-02-20 15:14:19', '1', '192.168.1.15'),
(71, '25', '71', '100031', '2019-02-20 20:44:19', '3', '3', '3', 18, NULL, NULL, '2019-02-20 20:44:19', '2019-02-20 15:14:19', '1', '192.168.1.15'),
(72, '25', '72', '100031', '2019-02-20 20:44:19', '4', '4', '4', 18, NULL, NULL, '2019-02-20 20:44:19', '2019-02-20 15:14:19', '1', '192.168.1.15'),
(73, '26', '73', '100032', '2019-02-21 18:47:31', '9989', '1201', '12', 18, NULL, NULL, '2019-02-21 18:47:31', '2019-02-21 13:17:31', '1', '192.168.1.15'),
(74, '26', '74', '100032', '2019-02-21 18:47:32', '9989', '2133', '123', 18, NULL, NULL, '2019-02-21 18:47:32', '2019-02-21 13:17:32', '1', '192.168.1.15'),
(75, '26', '75', '100032', '2019-02-21 18:47:32', '9989', '1', '121', 18, NULL, NULL, '2019-02-21 18:47:32', '2019-02-21 13:17:32', '1', '192.168.1.15'),
(76, '27', '76', '100033', '2019-02-21 18:51:01', '9989', 'jk', '12', 0.1, NULL, NULL, '2019-02-21 18:51:01', '2019-02-21 13:21:01', '1', '192.168.1.15'),
(77, '28', '77', '100034', '2019-02-21 18:51:04', '9989', 'jk', '12', 0.1, NULL, NULL, '2019-02-21 18:51:04', '2019-02-21 13:21:04', '1', '192.168.1.15'),
(78, '29', '78', '100035', '2019-02-22 13:48:56', '9989', '1', '1', 0, NULL, NULL, '2019-02-22 13:48:56', '2019-02-22 08:18:56', '1', '192.168.1.15'),
(79, '29', '79', '100035', '2019-02-22 13:48:56', '9989', '2', '2', 0, NULL, NULL, '2019-02-22 13:48:56', '2019-02-22 08:18:56', '1', '192.168.1.15'),
(80, '30', '80', '100036', '2019-02-22 13:49:17', '9989', '1', '1', 18, NULL, NULL, '2019-02-22 13:49:17', '2019-02-22 08:19:17', '1', '192.168.1.15'),
(81, '31', '81', '100036', '0000-00-00 00:00:00', '9989', 'jk', '12', 18, NULL, NULL, '2019-02-22 14:05:13', '2019-02-22 08:35:13', '1', '192.168.1.15'),
(82, '31', '82', '100036', '0000-00-00 00:00:00', '9989', '1', '1', 18, NULL, NULL, '2019-02-22 14:05:13', '2019-02-22 08:35:13', '1', '192.168.1.15'),
(83, '31', '83', '100036', '0000-00-00 00:00:00', '9989', 'sdv klsfvsdf vlsdsdfjio sdfob sdfiobsdf bsdoibsdiofb sdobuio', '5000', 18, NULL, NULL, '2019-02-22 14:05:13', '2019-02-22 08:35:13', '1', '192.168.1.15'),
(84, '32', '84', '100036', '0000-00-00 00:00:00', '9989', 'jk', '12', 18, NULL, NULL, '2019-02-22 14:05:32', '2019-02-22 08:35:32', '1', '192.168.1.15'),
(85, '32', '85', '100036', '0000-00-00 00:00:00', '9989', '1', '1', 18, NULL, NULL, '2019-02-22 14:05:32', '2019-02-22 08:35:32', '1', '192.168.1.15'),
(86, '32', '86', '100036', '0000-00-00 00:00:00', '9989', 'sdv klsfvsdf vlsdsdfjio sdfob sdfiobsdf bsdoibsdiofb sdobuio', '5000', 18, NULL, NULL, '2019-02-22 14:05:32', '2019-02-22 08:35:32', '1', '192.168.1.15'),
(87, '32', '87', '100036', '0000-00-00 00:00:00', '9989', 'skldv skv svjskv sivsbv', '500', 18, NULL, NULL, '2019-02-22 14:05:32', '2019-02-22 08:35:32', '1', '192.168.1.15'),
(88, '33', '88', '100036', '0000-00-00 00:00:00', '9989', 'jk', '12', 18, NULL, NULL, '2019-02-22 14:06:10', '2019-02-22 08:36:10', '1', '192.168.1.15'),
(89, '33', '89', '100036', '0000-00-00 00:00:00', '9989', '1', '1', 18, NULL, NULL, '2019-02-22 14:06:11', '2019-02-22 08:36:11', '1', '192.168.1.15'),
(90, '33', '90', '100036', '0000-00-00 00:00:00', '9989', 'sdv klsfvsdf vlsdsdfjio sdfob sdfiobsdf bsdoibsdiofb sdobuio', '5000', 18, NULL, NULL, '2019-02-22 14:06:11', '2019-02-22 08:36:11', '1', '192.168.1.15'),
(91, '33', '91', '100036', '0000-00-00 00:00:00', '9989', 'skldv skv svjskv sivsbv', '500', 18, NULL, NULL, '2019-02-22 14:06:11', '2019-02-22 08:36:11', '1', '192.168.1.15'),
(92, '34', '93', '100036', '0000-00-00 00:00:00', '9989', 'jk', '12', 18, NULL, NULL, '2019-02-22 14:06:16', '2019-02-22 08:36:16', '1', '192.168.1.15'),
(93, '34', '94', '100036', '0000-00-00 00:00:00', '9989', '1', '1', 18, NULL, NULL, '2019-02-22 14:06:16', '2019-02-22 08:36:16', '1', '192.168.1.15'),
(94, '34', '95', '100036', '0000-00-00 00:00:00', '9989', 'sdv klsfvsdf vlsdsdfjio sdfob sdfiobsdf bsdoibsdiofb sdobuio', '5000', 18, NULL, NULL, '2019-02-22 14:06:16', '2019-02-22 08:36:16', '1', '192.168.1.15'),
(95, '34', '96', '100036', '0000-00-00 00:00:00', '9989', 'skldv skv svjskv sivsbv', '500', 18, NULL, NULL, '2019-02-22 14:06:16', '2019-02-22 08:36:16', '1', '192.168.1.15'),
(96, '35', '98', '100036', '0000-00-00 00:00:00', '9989', 'jk', '12', 18, NULL, NULL, '2019-02-22 14:06:38', '2019-02-22 08:36:38', '1', '192.168.1.15'),
(97, '35', '99', '100036', '0000-00-00 00:00:00', '9989', '1', '1', 18, NULL, NULL, '2019-02-22 14:06:38', '2019-02-22 08:36:38', '1', '192.168.1.15'),
(98, '35', '100', '100036', '0000-00-00 00:00:00', '9989', 'sdv klsfvsdf vlsdsdfjio sdfob sdfiobsdf bsdoibsdiofb sdobuio', '5000', 18, NULL, NULL, '2019-02-22 14:06:38', '2019-02-22 08:36:38', '1', '192.168.1.15'),
(99, '35', '101', '100036', '0000-00-00 00:00:00', '9989', 'skldv skv svjskv sivsbv', '500', 18, NULL, NULL, '2019-02-22 14:06:38', '2019-02-22 08:36:38', '1', '192.168.1.15'),
(100, '41', '108', '100037', '2019-02-22 14:11:35', '9989', 'awe fklasvsjkdvsba saovashop sav asfvn spadfvo sadfovop asdfnvop asdfovnpsdfvnaspvo wahviop aweovpwhvnsdfvns ovsv opasdfvnasovnsaonvsnvonsdfa', '500', 0, NULL, NULL, '2019-02-22 14:11:35', '2019-02-22 08:41:35', '1', '192.168.1.15'),
(101, '41', '109', '100037', '2019-02-22 14:11:35', '9989', 'av ospovhas odpvnasd opv nasdfvopasdfpvohasdf vpasdvnasdovasdpvj awpef awp9awu9pefu9 wvasjdvas iodvasdfvuashduvasohvasopvhas voasvhasodvpawp9vasdvjksd bvp asopuv asp9uv', '5002', 0, NULL, NULL, '2019-02-22 14:11:35', '2019-02-22 08:41:35', '1', '192.168.1.15'),
(102, '42', '110', '100037', '0000-00-00 00:00:00', '9989', 'awe fklasvsjkdvsba saovashop sav asfvn spadfvo sadfovop asdfnvop asdfovnpsdfvnaspvo wahviop aweovpwhvnsdfvns ovsv opasdfvnasovnsaonvsnvonsdfa', '500', 0, NULL, NULL, '2019-02-22 14:12:23', '2019-02-22 08:42:23', '1', '192.168.1.15'),
(103, '42', '111', '100037', '0000-00-00 00:00:00', '9989', 'av ospovhas odpvnasd opv nasdfvopasdfpvohasdf vpasdvnasdovasdpvj awpef awp9awu9pefu9 wvasjdvas iodvasdfvuashduvasohvasopvhas voasvhasodvpawp9vasdvjksd bvp asopuv asp9uv', '5002', 0, NULL, NULL, '2019-02-22 14:12:23', '2019-02-22 08:42:23', '1', '192.168.1.15'),
(104, '42', '112', '100037', '0000-00-00 00:00:00', '9989', 'ACKL A SDBCASOIDCBASIDASD  ASDV S F VOSDFIVO VSA SDVASBDVPBA SVSB VASBIAVVBASFVSOIBV', '500', 0, NULL, NULL, '2019-02-22 14:12:23', '2019-02-22 08:42:23', '1', '192.168.1.15'),
(105, '43', '113', '100037', '0000-00-00 00:00:00', '9989', 'awe fklasvsjkdvsba saovashop sav asfvn spadfvo sadfovop asdfnvop asdfovnpsdfvnaspvo wahviop aweovpwhvnsdfvns ovsv opasdfvnasovnsaonvsnvonsdfa', '500', 0, NULL, NULL, '2019-02-22 14:12:41', '2019-02-22 08:42:41', '1', '192.168.1.15'),
(106, '43', '114', '100037', '0000-00-00 00:00:00', '9989', 'av ospovhas odpvnasd opv nasdfvopasdfpvohasdf vpasdvnasdovasdpvj awpef awp9awu9pefu9 wvasjdvas iodvasdfvuashduvasohvasopvhas voasvhasodvpawp9vasdvjksd bvp asopuv asp9uv', '5002', 0, NULL, NULL, '2019-02-22 14:12:41', '2019-02-22 08:42:41', '1', '192.168.1.15'),
(107, '43', '115', '100037', '0000-00-00 00:00:00', '9989', 'ACKL A SDBCASOIDCBASIDASD  ASDV S F VOSDFIVO VSA SDVASBDVPBA SVSB VASBIAVVBASFVSOIBV', '500', 0, NULL, NULL, '2019-02-22 14:12:41', '2019-02-22 08:42:41', '1', '192.168.1.15'),
(108, '43', '116', '100037', '0000-00-00 00:00:00', '9989', 'ASD VJSDVSBDV ASLKDBVS DAVASBDVK', '500', 0, NULL, NULL, '2019-02-22 14:12:41', '2019-02-22 08:42:41', '1', '192.168.1.15'),
(109, '44', '117', '100038', '2019-02-25 16:32:06', '9989', 'dklfb dkfbdkl;fbasd bsdflbn dlfbn dl;', '480', 0, NULL, NULL, '2019-02-25 16:32:06', '2019-02-25 11:02:06', '1', '192.168.1.20'),
(110, '44', '118', '100038', '2019-02-25 16:32:06', '9989', ' bb bd klsbsdo bheepro ebepobhpobdbdb b ', '500', 0, NULL, NULL, '2019-02-25 16:32:06', '2019-02-25 11:02:06', '1', '192.168.1.20'),
(111, '45', '119', '100038', '0000-00-00 00:00:00', '9989', 'dklfb dkfbdkl;fbasd bsdflbn dlfbn dl;', '480', 0, NULL, NULL, '2019-02-25 16:34:56', '2019-02-25 11:04:56', '1', '192.168.1.20'),
(112, '45', '120', '100038', '0000-00-00 00:00:00', '9989', ' bb bd klsbsdo bheepro ebepobhpobdbdb b ', '500', 0, NULL, NULL, '2019-02-25 16:34:56', '2019-02-25 11:04:56', '1', '192.168.1.20'),
(113, '45', '121', '100038', '0000-00-00 00:00:00', '9989', 'dcb ssk avas', '1500', 0, NULL, NULL, '2019-02-25 16:34:56', '2019-02-25 11:04:56', '1', '192.168.1.20'),
(114, '46', '122', '100038', '0000-00-00 00:00:00', '9989', 'dklfb dkfbdkl;fbasd bsdflbn dlfbn dl;', '480', 0, NULL, NULL, '2019-02-25 16:38:25', '2019-02-25 11:08:25', '1', '192.168.1.20'),
(115, '46', '123', '100038', '0000-00-00 00:00:00', '9989', ' bb bd klsbsdo bheepro ebepobhpobdbdb b ', '500', 0, NULL, NULL, '2019-02-25 16:38:25', '2019-02-25 11:08:25', '1', '192.168.1.20'),
(116, '46', '124', '100038', '0000-00-00 00:00:00', '9989', 'dcb ssk avas', '1500', 0, NULL, NULL, '2019-02-25 16:38:25', '2019-02-25 11:08:25', '1', '192.168.1.20'),
(117, '47', '125', '100039', '2019-02-27 19:45:55', '9989', '1 fsjfsjk sjfjsfj jsfjkjfk jsjk \r\n fjsfjsfk;dlskf kdsfk\r\nkl;kl;fklsd;fk klk;sdfaddddddddddddddddddddddddddddddddddd\r\n', '1000', 12, NULL, NULL, '2019-02-27 19:45:55', '2019-02-27 14:15:55', '1', '192.168.1.62'),
(118, '47', '126', '100039', '2019-02-27 19:45:55', '9989', '2jfksjfj jkjfksfjsjfsjfklaj ;;;;;;;;;;;;;;;;;;;;;;;;; p hhhhhhhhhhhhhhhhhhhhhhhhhhhhsdfjsdljflsdjf\r\nsdfklsjfklsjfkldsjfio ji ooiiojfjopak;lkf kpskfopsfiopifopjapjdopkml ', '2000', 12, NULL, NULL, '2019-02-27 19:45:55', '2019-02-27 14:15:55', '1', '192.168.1.62'),
(119, '48', '127', '100040', '2019-02-27 19:50:29', '9989', 'Tests', '111', 18, NULL, NULL, '2019-02-27 19:50:29', '2019-02-27 14:20:29', '1', '192.168.1.62'),
(120, '48', '128', '100040', '2019-02-27 19:50:29', '9989', 'Test 2', '222', 18, NULL, NULL, '2019-02-27 19:50:29', '2019-02-27 14:20:29', '1', '192.168.1.62'),
(121, '49', '129', '100041', '2019-02-28 11:16:22', '9989', 'test', '111', 12, NULL, NULL, '2019-02-28 11:16:22', '2019-02-28 05:46:22', '1', '192.168.1.3'),
(122, '49', '130', '100041', '2019-02-28 11:16:22', '9989', 'test', '111', 12, NULL, NULL, '2019-02-28 11:16:22', '2019-02-28 05:46:22', '1', '192.168.1.3'),
(123, '49', '131', '100041', '2019-02-28 11:16:22', '9989', 'test', '111', 12, NULL, NULL, '2019-02-28 11:16:22', '2019-02-28 05:46:22', '1', '192.168.1.3'),
(124, '49', '132', '100041', '2019-02-28 11:16:22', '9989', 'test', '111', 12, NULL, NULL, '2019-02-28 11:16:22', '2019-02-28 05:46:22', '1', '192.168.1.3'),
(125, '50', '133', '100042', '2019-02-28 18:09:23', '9989', 'Test Particular', '1000', 12, NULL, NULL, '2019-02-28 18:09:23', '2019-02-28 12:39:23', '1', '192.168.1.3'),
(126, '50', '134', '100042', '2019-02-28 18:09:23', '9989', 'Test Particular', '2000', 12, NULL, NULL, '2019-02-28 18:09:23', '2019-02-28 12:39:23', '1', '192.168.1.3'),
(127, '50', '135', '100042', '2019-02-28 18:09:23', '9989', 'Test Particular', '3000', 12, NULL, NULL, '2019-02-28 18:09:23', '2019-02-28 12:39:23', '1', '192.168.1.3'),
(128, '50', '136', '100042', '2019-02-28 18:09:23', '9989', 'Test Particular', '4000', 12, NULL, NULL, '2019-02-28 18:09:23', '2019-02-28 12:39:23', '1', '192.168.1.3'),
(129, '51', '137', '100043', '2019-03-01 11:14:48', '9989', '300 Envelop', '3000', 0, NULL, NULL, '2019-03-01 11:14:48', '2019-03-01 05:44:48', '1', '192.168.1.7'),
(130, '51', '138', '100043', '2019-03-01 11:14:48', '9989', '500 Business Cards', '2500', 0, NULL, NULL, '2019-03-01 11:14:48', '2019-03-01 05:44:48', '1', '192.168.1.7'),
(131, '51', '139', '100043', '2019-03-01 11:14:48', '9989', 'testert', '2626', 0, NULL, NULL, '2019-03-01 11:14:48', '2019-03-01 05:44:48', '1', '192.168.1.7'),
(132, '51', '140', '100043', '2019-03-01 11:14:48', '9989', 'ttt', '1551', 0, NULL, NULL, '2019-03-01 11:14:48', '2019-03-01 05:44:48', '1', '192.168.1.7'),
(133, '52', '141', '100044', '2019-03-01 11:15:16', '9989', 'asd jkv', '1541', 0, NULL, NULL, '2019-03-01 11:15:16', '2019-03-01 05:45:16', '1', '192.168.1.7'),
(134, '52', '142', '100044', '2019-03-01 11:15:16', '9989', 'asdfjvaj', '15', 0, NULL, NULL, '2019-03-01 11:15:16', '2019-03-01 05:45:16', '1', '192.168.1.7'),
(135, '52', '143', '100044', '2019-03-01 11:15:16', '9989', 'ttt', '15000', 0, NULL, NULL, '2019-03-01 11:15:16', '2019-03-01 05:45:16', '1', '192.168.1.7'),
(136, '53', '144', '100044', '2019-03-01 11:15:16', '9989', 'asd jkv', '1541', 0, NULL, NULL, '2019-03-01 11:55:01', '2019-03-01 06:25:01', '1', '192.168.1.7'),
(137, '53', '145', '100044', '2019-03-01 11:15:16', '9989', 'asdfjvaj', '15', 0, NULL, NULL, '2019-03-01 11:55:01', '2019-03-01 06:25:01', '1', '192.168.1.7'),
(138, '53', '146', '100044', '2019-03-01 11:15:16', '9989', 'ttt', '15000', 0, NULL, NULL, '2019-03-01 11:55:01', '2019-03-01 06:25:01', '1', '192.168.1.7'),
(139, '53', '147', '100044', '2019-03-01 11:15:16', '9989', 'w', '151', 0, NULL, NULL, '2019-03-01 11:55:01', '2019-03-01 06:25:01', '1', '192.168.1.7'),
(140, '54', '148', '100044', '2019-03-01 11:15:16', '9989', 'asd jkv', '1541', 0, NULL, NULL, '2019-03-01 11:55:38', '2019-03-01 06:25:38', '1', '192.168.1.7'),
(141, '54', '149', '100044', '2019-03-01 11:15:16', '9989', 'asdfjvaj', '15', 0, NULL, NULL, '2019-03-01 11:55:38', '2019-03-01 06:25:38', '1', '192.168.1.7'),
(142, '54', '150', '100044', '2019-03-01 11:15:16', '9989', 'ttt', '15000', 0, NULL, NULL, '2019-03-01 11:55:38', '2019-03-01 06:25:38', '1', '192.168.1.7'),
(143, '54', '151', '100044', '2019-03-01 11:15:16', '9989', 'w', '151', 0, NULL, NULL, '2019-03-01 11:55:38', '2019-03-01 06:25:38', '1', '192.168.1.7'),
(144, '54', '152', '100044', '2019-03-01 11:15:16', '9989', 'asjdv', '151111', 0, NULL, NULL, '2019-03-01 11:55:38', '2019-03-01 06:25:38', '1', '192.168.1.7'),
(145, '55', '153', '100045', '2019-03-01 13:11:19', '9989', ' asdasdj', '151', 18, NULL, NULL, '2019-03-01 13:11:19', '2019-03-01 07:41:19', '1', '192.168.1.7'),
(146, '55', '154', '100045', '2019-03-01 13:11:20', '9989', 'widf asioasopd', '2151', 18, NULL, NULL, '2019-03-01 13:11:20', '2019-03-01 07:41:20', '1', '192.168.1.7'),
(147, '55', '155', '100045', '2019-03-01 13:11:20', '9989', ' wqopefqwqwdbp', '151', 18, NULL, NULL, '2019-03-01 13:11:20', '2019-03-01 07:41:20', '1', '192.168.1.7'),
(148, '55', '156', '100045', '2019-03-01 13:11:20', '9989', 'we 9rfg werfawi', '151', 18, NULL, NULL, '2019-03-01 13:11:20', '2019-03-01 07:41:20', '1', '192.168.1.7'),
(149, '56', '157', '100045', '2019-03-01 13:11:19', '9989', ' asdasdj', '151', 18, NULL, NULL, '2019-03-01 13:11:49', '2019-03-01 07:41:49', '1', '192.168.1.7'),
(150, '56', '158', '100045', '2019-03-01 13:11:19', '9989', 'widf asioasopd', '2151', 18, NULL, NULL, '2019-03-01 13:11:49', '2019-03-01 07:41:49', '1', '192.168.1.7'),
(151, '56', '159', '100045', '2019-03-01 13:11:19', '9989', ' wqopefqwqwdbp', '151', 18, NULL, NULL, '2019-03-01 13:11:49', '2019-03-01 07:41:49', '1', '192.168.1.7'),
(152, '56', '160', '100045', '2019-03-01 13:11:19', '9989', 'we 9rfg werfawi', '151', 18, NULL, NULL, '2019-03-01 13:11:49', '2019-03-01 07:41:49', '1', '192.168.1.7'),
(153, '56', '161', '100045', '2019-03-01 13:11:19', '9989', ' sajdasjd', '151', 18, NULL, NULL, '2019-03-01 13:11:49', '2019-03-01 07:41:49', '1', '192.168.1.7'),
(154, '57', '162', '100046', '2019-03-01 13:14:22', '9989', ' asdjkfsj', '15', 18, NULL, NULL, '2019-03-01 13:14:22', '2019-03-01 07:44:22', '1', '192.168.1.7'),
(155, '57', '163', '100046', '2019-03-01 13:14:22', '9989', ' a', '11', 18, NULL, NULL, '2019-03-01 13:14:22', '2019-03-01 07:44:22', '1', '192.168.1.7'),
(156, '58', '164', '100046', '2019-03-01 13:14:22', '9989', ' asdjkfsj', '15', 18, NULL, NULL, '2019-03-01 13:14:42', '2019-03-01 07:44:42', '1', '192.168.1.7'),
(157, '58', '165', '100046', '2019-03-01 13:14:22', '9989', 'sdfjsvk', '4115', 18, NULL, NULL, '2019-03-01 13:14:42', '2019-03-01 07:44:42', '1', '192.168.1.7'),
(158, '59', '166', '100047', '2019-03-01 13:15:03', '9989', 'TEST 10', '1', 0, NULL, NULL, '2019-03-01 13:15:03', '2019-03-01 07:45:03', '1', '192.168.1.7'),
(159, '59', '167', '100047', '2019-03-01 13:15:03', '9989', 'TEST 9', '12', 0, NULL, NULL, '2019-03-01 13:15:03', '2019-03-01 07:45:03', '1', '192.168.1.7'),
(160, '59', '168', '100047', '2019-03-01 13:15:03', '9989', 'TEST 8', '121', 0, NULL, NULL, '2019-03-01 13:15:03', '2019-03-01 07:45:03', '1', '192.168.1.7'),
(161, '59', '169', '100047', '2019-03-01 13:15:03', '9989', 'TEST 7', '262', 0, NULL, NULL, '2019-03-01 13:15:03', '2019-03-01 07:45:03', '1', '192.168.1.7'),
(162, '59', '170', '100047', '2019-03-01 13:15:03', '9989', 'test 6', '1551', 0, NULL, NULL, '2019-03-01 13:15:03', '2019-03-01 07:45:03', '1', '192.168.1.7'),
(163, '59', '171', '100047', '2019-03-01 13:15:03', '9989', 'ttt 11', '11', 0, NULL, NULL, '2019-03-01 13:15:03', '2019-03-01 07:45:03', '1', '192.168.1.7'),
(164, '59', '172', '100047', '2019-03-01 13:15:03', '9989', ' asjdvbk s', '151', 0, NULL, NULL, '2019-03-01 13:15:03', '2019-03-01 07:45:03', '1', '192.168.1.7'),
(165, '60', '173', '100048', '2019-03-01 13:50:47', '9989', '151', '151', 0, NULL, NULL, '2019-03-01 13:50:47', '2019-03-01 08:20:47', '1', '192.168.1.7'),
(166, '60', '174', '100048', '2019-03-01 13:50:47', '9989', '11', '11', 0, NULL, NULL, '2019-03-01 13:50:47', '2019-03-01 08:20:47', '1', '192.168.1.7'),
(167, '60', '175', '100048', '2019-03-01 13:50:47', '9989', '33', '3', 0, NULL, NULL, '2019-03-01 13:50:47', '2019-03-01 08:20:47', '1', '192.168.1.7'),
(168, '60', '176', '100048', '2019-03-01 13:50:47', '9989', '22', '54', 0, NULL, NULL, '2019-03-01 13:50:47', '2019-03-01 08:20:47', '1', '192.168.1.7'),
(169, '60', '177', '100048', '2019-03-01 13:50:48', '9989', '33', '3', 0, NULL, NULL, '2019-03-01 13:50:48', '2019-03-01 08:20:48', '1', '192.168.1.7'),
(170, '60', '178', '100048', '2019-03-01 13:50:48', '9989', '15151', '151', 0, NULL, NULL, '2019-03-01 13:50:48', '2019-03-01 08:20:48', '1', '192.168.1.7'),
(171, '61', '179', '100048', '2019-03-01 13:50:47', '9989', '151', '151', 0, NULL, NULL, '2019-03-01 13:51:24', '2019-03-01 08:21:24', '1', '192.168.1.7'),
(172, '61', '180', '100048', '2019-03-01 13:50:47', '9989', '11', '11', 0, NULL, NULL, '2019-03-01 13:51:24', '2019-03-01 08:21:24', '1', '192.168.1.7'),
(173, '61', '181', '100048', '2019-03-01 13:50:47', '9989', '33', '3', 0, NULL, NULL, '2019-03-01 13:51:24', '2019-03-01 08:21:24', '1', '192.168.1.7'),
(174, '61', '182', '100048', '2019-03-01 13:50:47', '9989', '22', '54', 0, NULL, NULL, '2019-03-01 13:51:24', '2019-03-01 08:21:24', '1', '192.168.1.7'),
(175, '61', '183', '100048', '2019-03-01 13:50:47', '9989', '33', '3', 0, NULL, NULL, '2019-03-01 13:51:24', '2019-03-01 08:21:24', '1', '192.168.1.7'),
(176, '61', '184', '100048', '2019-03-01 13:50:47', '9989', '15151', '151', 0, NULL, NULL, '2019-03-01 13:51:24', '2019-03-01 08:21:24', '1', '192.168.1.7'),
(177, '61', '185', '100048', '2019-03-01 13:50:47', '9989', 'yyy', '1', 0, NULL, NULL, '2019-03-01 13:51:24', '2019-03-01 08:21:24', '1', '192.168.1.7'),
(178, '62', '186', '100048', '2019-03-01 13:50:47', '9989', '151', '151', 0, NULL, NULL, '2019-03-01 13:52:22', '2019-03-01 08:22:22', '1', '192.168.1.7'),
(179, '62', '187', '100048', '2019-03-01 13:50:47', '9989', '11', '11', 0, NULL, NULL, '2019-03-01 13:52:22', '2019-03-01 08:22:22', '1', '192.168.1.7'),
(180, '62', '188', '100048', '2019-03-01 13:50:47', '9989', '33', '3', 0, NULL, NULL, '2019-03-01 13:52:22', '2019-03-01 08:22:22', '1', '192.168.1.7'),
(181, '62', '189', '100048', '2019-03-01 13:50:47', '9989', '22', '54', 0, NULL, NULL, '2019-03-01 13:52:22', '2019-03-01 08:22:22', '1', '192.168.1.7'),
(182, '62', '190', '100048', '2019-03-01 13:50:47', '9989', '33', '3', 0, NULL, NULL, '2019-03-01 13:52:22', '2019-03-01 08:22:22', '1', '192.168.1.7'),
(183, '62', '191', '100048', '2019-03-01 13:50:47', '9989', '15151', '151', 0, NULL, NULL, '2019-03-01 13:52:23', '2019-03-01 08:22:23', '1', '192.168.1.7'),
(184, '62', '192', '100048', '2019-03-01 13:50:47', '9989', 'yyy', '1', 0, NULL, NULL, '2019-03-01 13:52:23', '2019-03-01 08:22:23', '1', '192.168.1.7'),
(185, '62', '193', '100048', '2019-03-01 13:50:47', '9989', 'ii', '11', 0, NULL, NULL, '2019-03-01 13:52:23', '2019-03-01 08:22:23', '1', '192.168.1.7'),
(186, '63', '194', '100049', '2019-03-02 11:51:38', '9989', ' asdc asdcjvasdjkcasdj kc', '1500', 18, NULL, NULL, '2019-03-02 11:51:38', '2019-03-02 06:21:38', '1', '192.168.1.25'),
(187, '63', '195', '100049', '2019-03-02 11:51:38', '9989', 'd sfkvskdfvkasdfvaskd sadvasdvsbi', '1500', 18, NULL, NULL, '2019-03-02 11:51:38', '2019-03-02 06:21:38', '1', '192.168.1.25'),
(188, '64', '196', 'IV-2019-100050', '2019-03-02 14:46:12', '9989', 'asd cvasdjkv sadjasvdj', '1500', 0, NULL, NULL, '2019-03-02 14:46:12', '2019-03-02 09:16:12', '1', '192.168.1.25'),
(189, '65', '197', 'INV-2019-0001', '2019-03-04 16:20:10', '9989', 'sdcsadcas', '150', 0, NULL, NULL, '2019-03-04 16:20:10', '2019-03-04 10:50:10', '1', '192.168.1.25'),
(190, '65', '198', 'INV-2019-0001', '2019-03-04 16:20:10', '9989', 'dfv sdf bsdf', '1500', 0, NULL, NULL, '2019-03-04 16:20:10', '2019-03-04 10:50:10', '1', '192.168.1.25');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_table`
--

CREATE TABLE `invoice_table` (
  `id` bigint(20) NOT NULL,
  `bill_number` varchar(255) DEFAULT NULL,
  `bill_date` datetime DEFAULT NULL,
  `company_id` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `gstin_no` varchar(255) DEFAULT NULL,
  `total_ampunt` float DEFAULT NULL,
  `amt_in_words` varchar(255) NOT NULL,
  `tax_type` varchar(255) DEFAULT NULL,
  `tax_id` varchar(255) DEFAULT NULL,
  `total_gst_percent` float DEFAULT NULL,
  `total_cgst_percent` float DEFAULT NULL,
  `total_sgst_percent` float DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` varchar(255) DEFAULT NULL,
  `updated_ipaddress` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_table`
--

INSERT INTO `invoice_table` (`id`, `bill_number`, `bill_date`, `company_id`, `company_name`, `customer_name`, `gstin_no`, `total_ampunt`, `amt_in_words`, `tax_type`, `tax_id`, `total_gst_percent`, `total_cgst_percent`, `total_sgst_percent`, `created_date`, `updated_date`, `user_id`, `updated_ipaddress`) VALUES
(1, '100017', '2019-02-16 17:16:08', '5', 'GHNDN', 'FGBFGB', '4544', 3, '', NULL, NULL, 8, 4, 4, '2019-02-16 17:16:08', '2019-02-16 11:50:25', '1', '192.168.1.29'),
(2, '100018', '2019-02-16 17:23:59', '4', 'hkadc`', 'sbdnk', 'bksbcvk', 2, '', NULL, NULL, 1, 0.5, 0.5, '2019-02-16 17:23:59', '2019-02-16 11:54:29', '1', '192.168.1.29'),
(3, '100019', '2019-02-18 15:06:20', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '33AAECS1194CZZP', 8500, '', 'IGST', '3', 12, NULL, NULL, '2019-02-18 15:06:20', '2019-02-18 12:11:21', '1', '192.168.1.15'),
(4, '100020', '2019-02-18 17:34:34', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '33AAECS1194CZZP', 600, '', 'GST', '5', 28, 14, 14, '2019-02-18 17:34:34', '2019-02-18 12:04:34', '1', '192.168.1.15'),
(5, '100021', '2019-02-18 17:34:43', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '33AAECS1194CZZP', 600, '', 'GST', '5', 28, 14, 14, '2019-02-18 17:34:43', '2019-02-18 12:04:43', '1', '192.168.1.15'),
(6, '100022', '2019-02-18 17:39:02', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '33AAECS1194CZZP', 600, '', 'IGST', '5', 28, NULL, NULL, '2019-02-18 17:39:02', '2019-02-18 12:10:44', '1', '192.168.1.15'),
(7, '100023', '2019-02-19 16:55:07', '11', 'Sai Group of Companies', 'Sai', '1234556', 1000, '', 'GST', '3', 12, 6, 6, '2019-02-19 16:55:07', '2019-02-19 11:25:07', '1', '192.168.1.30'),
(8, '100024', '2019-02-20 15:00:56', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '33AAECS1194CZZP', 1000, '', 'GST', '3', 12, 6, 6, '2019-02-20 15:00:56', '2019-02-20 09:30:56', '1', '192.168.1.15'),
(9, '100025', '2019-02-20 16:18:09', '11', 'Sai Group of Companies', 'Sai', '1234556', 6050, '', 'GST', '3', 12, 6, 6, '2019-02-20 16:18:09', '2019-02-20 11:42:38', '1', '192.168.1.15'),
(10, '100026', '2019-02-20 16:21:52', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '33AAECS1194CZZP', 1000, '', 'IGST', '4', 18, NULL, NULL, '2019-02-20 16:21:52', '2019-02-20 11:44:52', '1', '192.168.1.15'),
(11, '100027', '2019-02-20 17:19:22', '12', 'Meera ', 'Meera', 'Test GST', 6000, '', 'GST', '4', 18, 9, 9, '2019-02-20 17:19:22', '2019-02-20 11:49:22', '1', '192.168.1.14'),
(12, '100028', '2019-02-20 17:20:12', '20', 'communist pvt ltd', 'chanfru', 'asmcaksas2331121112', 6000, '', 'GST', '4', 18, 9, 9, '2019-02-20 17:20:12', '2019-02-20 11:50:12', '1', '192.168.1.15'),
(13, '100029', '2019-02-20 17:31:28', '19', 'Vidhun Enterprises', 'Geetha', 'test', 10006, '', 'GST', '3', 12, 6, 6, '2019-02-20 17:31:28', '2019-02-20 12:02:58', '1', '192.168.1.15'),
(14, '100030', '2019-02-20 20:36:44', '20', 'communist pvt ltd', 'chanfru', '12123213', 2100, '', 'IGST', '1', 0, NULL, NULL, '2019-02-20 20:36:44', '2019-02-20 15:06:44', '1', '192.168.1.15'),
(15, '100031', '2019-02-20 20:44:18', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '33AAECS1194CZZP', 10, '', 'GST', '4', 18, 9, 9, '2019-02-20 20:44:18', '2019-02-20 15:14:18', '1', '192.168.1.15'),
(16, '100032', '2019-02-21 18:47:31', '5', 'GHNDN', 'FGBFGB', '4544', 256, '', 'GST', '4', 18, 9, 9, '2019-02-21 18:47:31', '2019-02-21 13:17:31', '1', '192.168.1.15'),
(17, '100035', '2019-02-22 13:48:56', '19', 'Vidhun Enterprises', 'Geetha', 'test', 3, '', 'GST', '1', 0, 0, 0, '2019-02-22 13:48:56', '2019-02-22 08:18:56', '1', '192.168.1.15'),
(19, '100037', '2019-02-22 14:10:33', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '33AAECS1194CZZP', 5502, '', 'GST', '1', 0, 0, 0, '2019-02-22 14:10:33', '2019-02-22 08:40:33', '1', '192.168.1.15'),
(20, '100037', '2019-02-22 14:10:51', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '33AAECS1194CZZP', 5502, '', 'GST', '1', 0, 0, 0, '2019-02-22 14:10:51', '2019-02-22 08:40:51', '1', '192.168.1.15'),
(21, '100037', '2019-02-22 14:11:05', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '33AAECS1194CZZP', 5502, '', 'GST', '1', 0, 0, 0, '2019-02-22 14:11:05', '2019-02-22 08:41:05', '1', '192.168.1.15'),
(22, '100037', '2019-02-22 14:11:35', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '33AAECS1194CZZP', 6502, '', 'GST', '1', 0, 0, 0, '2019-02-22 14:11:35', '2019-02-22 08:42:41', '1', '192.168.1.15'),
(23, '100038', '2019-02-25 16:32:05', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '33AAECS1194CZZP', 2480, '', 'GST', '1', 0, 0, 0, '2019-02-25 16:32:05', '2019-02-25 11:04:56', '1', '192.168.1.20'),
(24, '100039', '2019-02-27 19:45:55', '19', 'Vidhun Enterprises', 'Geetha', 'test', 3000, '', 'GST', '3', 12, 6, 6, '2019-02-27 19:45:55', '2019-02-27 14:15:55', '1', '192.168.1.62'),
(25, '100040', '2019-02-27 19:50:29', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '33AAECS1194CZZP', 333, '', 'GST', '4', 18, 9, 9, '2019-02-27 19:50:29', '2019-02-27 14:20:29', '1', '192.168.1.62'),
(26, '100041', '2019-02-28 11:16:22', '19', 'Vidhun Enterprises', 'Geetha', 'test', 444, '', 'GST', '3', 12, 6, 6, '2019-02-28 11:16:22', '2019-02-28 05:46:22', '1', '192.168.1.3'),
(27, '100042', '2019-02-28 18:09:23', '26', 'Hanifa & Co', 'Hani', '629347549824', 10000, '', 'GST', '3', 12, 6, 6, '2019-02-28 18:09:23', '2019-02-28 12:39:23', '1', '192.168.1.3'),
(28, '100043', '2019-03-01 11:14:47', '26', 'Hanifa & Co', '', '629347549824', 9677, '', 'GST', '1', 0, 0, 0, '2019-03-01 11:14:47', '2019-03-01 05:44:47', '1', '192.168.1.7'),
(29, '100044', '2019-03-01 11:15:16', '5', 'GHNDN', '', '4544', 167818, '', 'IGST', '1', 0, NULL, NULL, '2019-03-01 11:15:16', '2019-03-01 06:25:37', '1', '192.168.1.7'),
(30, '100045', '2019-03-01 13:11:19', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '33AAECS1194CZZP', 2755, '', 'IGST', '4', 18, NULL, NULL, '2019-03-01 13:11:19', '2019-03-01 07:41:48', '1', '192.168.1.7'),
(31, '100046', '2019-03-01 13:14:22', '10', 'Novotel Chennai Sipcot', 'ASHOK KUMAR', '33AAECS1194CZZP', 4130, '', 'GST', '4', 18, 9, 9, '2019-03-01 13:14:22', '2019-03-01 07:44:42', '1', '192.168.1.7'),
(32, '100047', '2019-03-01 13:15:03', '27', 'dhoni pvt ltd', '', 'IOO0000000000000000000', 2109, '', 'IGST', '1', 0, NULL, NULL, '2019-03-01 13:15:03', '2019-03-01 07:45:03', '1', '192.168.1.7'),
(33, '100048', '2019-03-01 13:50:47', '27', 'dhoni pvt ltd', '', 'IOO0000000000000000000', 385, '', 'GST', '1', 0, 0, 0, '2019-03-01 13:50:47', '2019-03-01 08:22:22', '1', '192.168.1.7'),
(34, '100049', '2019-03-02 11:51:38', '23', 'tendulkar', 'ten', '2316654231132163', 3000, '', 'GST', '4', 18, 9, 9, '2019-03-02 11:51:38', '2019-03-02 06:21:38', '1', '192.168.1.25'),
(35, 'IV-2019-100050', '2019-03-02 14:46:12', '23', 'tendulkar', 'ten', '2316654231132163', 1500, '', 'GST', '1', 0, 0, 0, '2019-03-02 14:46:12', '2019-03-02 09:16:12', '1', '192.168.1.25'),
(36, 'INV-2019-0001', '2019-03-04 16:20:10', '11', 'Sai Group of Companies', 'Sai', '1234556', 1650, '', 'GST', '1', 0, 0, 0, '2019-03-04 16:20:10', '2019-03-04 10:50:10', '1', '192.168.1.25');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_table_log`
--

CREATE TABLE `invoice_table_log` (
  `auto_id` int(11) NOT NULL,
  `invoice_id` varchar(255) DEFAULT NULL,
  `bill_number` varchar(255) DEFAULT NULL,
  `bill_date` datetime DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `gstin_no` varchar(255) NOT NULL,
  `total_ampunt` float DEFAULT NULL,
  `amt_in_words` varchar(255) DEFAULT NULL,
  `tax_type` varchar(255) DEFAULT NULL,
  `tax_id` varchar(255) DEFAULT NULL,
  `total_gst_percent` float DEFAULT NULL,
  `total_cgst_percent` float DEFAULT NULL,
  `total_sgst_percent` float DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` varchar(255) DEFAULT NULL,
  `updated_ipaddress` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_table_log`
--

INSERT INTO `invoice_table_log` (`auto_id`, `invoice_id`, `bill_number`, `bill_date`, `company_name`, `gstin_no`, `total_ampunt`, `amt_in_words`, `tax_type`, `tax_id`, `total_gst_percent`, `total_cgst_percent`, `total_sgst_percent`, `created_date`, `updated_date`, `user_id`, `updated_ipaddress`) VALUES
(1, '1', '100017', '2019-02-16 17:16:08', 'GHNDN', '4544', 1675, NULL, NULL, NULL, NULL, NULL, NULL, '2019-02-16 17:16:08', '2019-02-16 11:46:08', '1', '192.168.1.29'),
(2, '1', '100017', '0000-00-00 00:00:00', 'GHNDN', '4544', 3, NULL, NULL, NULL, NULL, NULL, NULL, '2019-02-16 17:20:25', '2019-02-16 11:50:25', '1', '192.168.1.29'),
(3, '2', '100018', '2019-02-16 17:23:59', 'hkadc`', 'bksbcvk', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2019-02-16 17:23:59', '2019-02-16 11:53:59', '1', '192.168.1.29'),
(4, '2', '100018', '0000-00-00 00:00:00', 'hkadc`', 'bksbcvk', 2, NULL, NULL, NULL, NULL, NULL, NULL, '2019-02-16 17:24:29', '2019-02-16 11:54:29', '1', '192.168.1.29'),
(5, '3', '100019', '2019-02-18 15:06:20', 'Novotel Chennai Sipcot', '33AAECS1194CZZP', 8500, NULL, NULL, NULL, NULL, NULL, NULL, '2019-02-18 15:06:20', '2019-02-18 09:36:20', '1', '192.168.1.15'),
(6, '4', '100020', '2019-02-18 17:34:34', 'Novotel Chennai Sipcot', '33AAECS1194CZZP', 600, NULL, 'GST', '5', 28, 14, 14, '2019-02-18 17:34:34', '2019-02-18 12:04:34', '1', '192.168.1.15'),
(7, '5', '100021', '2019-02-18 17:34:43', 'Novotel Chennai Sipcot', '33AAECS1194CZZP', 600, NULL, 'GST', '5', 28, 14, 14, '2019-02-18 17:34:43', '2019-02-18 12:04:43', '1', '192.168.1.15'),
(8, '6', '100022', '2019-02-18 17:39:02', 'Novotel Chennai Sipcot', '33AAECS1194CZZP', 600, NULL, 'IGST', '5', 28, NULL, NULL, '2019-02-18 17:39:02', '2019-02-18 12:09:02', '1', '192.168.1.15'),
(9, '6', '100022', '0000-00-00 00:00:00', 'Novotel Chennai Sipcot', '33AAECS1194CZZP', 600, NULL, 'GST', '2', 5, 2.5, 2.5, '2019-02-18 17:40:04', '2019-02-18 12:10:04', '1', '192.168.1.15'),
(10, '6', '100022', '0000-00-00 00:00:00', 'Novotel Chennai Sipcot', '33AAECS1194CZZP', 600, NULL, 'IGST', '5', 28, NULL, NULL, '2019-02-18 17:40:44', '2019-02-18 12:10:44', '1', '192.168.1.15'),
(11, '3', '100019', '0000-00-00 00:00:00', 'Novotel Chennai Sipcot', '33AAECS1194CZZP', 8500, NULL, 'IGST', '3', 12, NULL, NULL, '2019-02-18 17:41:21', '2019-02-18 12:11:21', '1', '192.168.1.15'),
(12, '7', '100023', '2019-02-19 16:55:07', 'Sai Group of Companies', '1234556', 1000, NULL, 'GST', '3', 12, 6, 6, '2019-02-19 16:55:07', '2019-02-19 11:25:07', '1', '192.168.1.30'),
(13, '8', '100024', '2019-02-20 15:00:56', 'Novotel Chennai Sipcot', '33AAECS1194CZZP', 1000, NULL, 'GST', '3', 12, 6, 6, '2019-02-20 15:00:56', '2019-02-20 09:30:56', '1', '192.168.1.15'),
(14, '9', '100025', '2019-02-20 16:18:10', 'Sai Group of Companies', '1234556', 0, NULL, 'GST', '3', 12, 6, 6, '2019-02-20 16:18:10', '2019-02-20 10:48:10', '1', '192.168.1.15'),
(15, '10', '100026', '2019-02-20 16:21:52', 'Novotel Chennai Sipcot', '33AAECS1194CZZP', 0, NULL, 'GST', '4', 18, 9, 9, '2019-02-20 16:21:52', '2019-02-20 10:51:52', '1', '192.168.1.15'),
(16, '9', '100025', '0000-00-00 00:00:00', 'Sai Group of Companies', '1234556', 6050, NULL, 'GST', '3', 12, 6, 6, '2019-02-20 17:12:38', '2019-02-20 11:42:38', '1', '192.168.1.15'),
(17, '10', '100026', '0000-00-00 00:00:00', 'Novotel Chennai Sipcot', '33AAECS1194CZZP', 1500, NULL, 'GST', '4', 18, 9, 9, '2019-02-20 17:13:47', '2019-02-20 11:43:47', '1', '192.168.1.15'),
(18, '10', '100026', '0000-00-00 00:00:00', 'Novotel Chennai Sipcot', '33AAECS1194CZZP', 1000, NULL, 'GST', '4', 18, 9, 9, '2019-02-20 17:14:06', '2019-02-20 11:44:06', '1', '192.168.1.15'),
(19, '10', '100026', '0000-00-00 00:00:00', 'Novotel Chennai Sipcot', '33AAECS1194CZZP', 1000, NULL, 'IGST', '4', 18, NULL, NULL, '2019-02-20 17:14:53', '2019-02-20 11:44:53', '1', '192.168.1.15'),
(20, '11', '100027', '2019-02-20 17:19:22', 'Meera ', 'Test GST', 6000, NULL, 'GST', '4', 18, 9, 9, '2019-02-20 17:19:22', '2019-02-20 11:49:22', '1', '192.168.1.14'),
(21, '12', '100028', '2019-02-20 17:20:12', 'communist pvt ltd', 'asmcaksas2331121112', 6000, NULL, 'GST', '4', 18, 9, 9, '2019-02-20 17:20:12', '2019-02-20 11:50:12', '1', '192.168.1.15'),
(22, '13', '100029', '2019-02-20 17:31:28', 'Vidhun Enterprises', 'test', 6, NULL, 'GST', '3', 12, 6, 6, '2019-02-20 17:31:28', '2019-02-20 12:01:28', '1', '192.168.1.15'),
(23, '13', '100029', '0000-00-00 00:00:00', 'Vidhun Enterprises', 'test', 10006, NULL, 'GST', '3', 12, 6, 6, '2019-02-20 17:32:58', '2019-02-20 12:02:58', '1', '192.168.1.15'),
(24, '14', '100030', '2019-02-20 20:36:44', 'communist pvt ltd', '12123213', 2100, NULL, 'IGST', '1', 0, NULL, NULL, '2019-02-20 20:36:44', '2019-02-20 15:06:44', '1', '192.168.1.15'),
(25, '15', '100031', '2019-02-20 20:44:18', 'Novotel Chennai Sipcot', '33AAECS1194CZZP', 10, NULL, 'GST', '4', 18, 9, 9, '2019-02-20 20:44:18', '2019-02-20 15:14:18', '1', '192.168.1.15'),
(26, '16', '100032', '2019-02-21 18:47:31', 'GHNDN', '4544', 256, NULL, 'GST', '4', 18, 9, 9, '2019-02-21 18:47:31', '2019-02-21 13:17:31', '1', '192.168.1.15'),
(27, '17', '100033', '2019-02-21 18:51:01', 'gb', 'sd', 12, NULL, 'GST', '7', 0.1, 0.05, 0.05, '2019-02-21 18:51:01', '2019-02-21 13:21:01', '1', '192.168.1.15'),
(28, '18', '100034', '2019-02-21 18:51:03', 'gb', 'sd', 12, NULL, 'GST', '7', 0.1, 0.05, 0.05, '2019-02-21 18:51:03', '2019-02-21 13:21:03', '1', '192.168.1.15'),
(29, '17', '100035', '2019-02-22 13:48:56', 'Vidhun Enterprises', 'test', 3, NULL, 'GST', '1', 0, 0, 0, '2019-02-22 13:48:56', '2019-02-22 08:18:56', '1', '192.168.1.15'),
(30, '18', '100036', '2019-02-22 13:49:16', 'Novotel Chennai Sipcot', '33AAECS1194CZZP', 1, NULL, 'GST', '4', 18, 9, 9, '2019-02-22 13:49:16', '2019-02-22 08:19:16', '1', '192.168.1.15'),
(31, '18', '100036', '0000-00-00 00:00:00', 'Novotel Chennai Sipcot', '33AAECS1194CZZP', 5013, NULL, 'GST', '4', 18, 9, 9, '2019-02-22 14:05:12', '2019-02-22 08:35:12', '1', '192.168.1.15'),
(32, '18', '100036', '0000-00-00 00:00:00', 'Novotel Chennai Sipcot', '33AAECS1194CZZP', 5513, NULL, 'GST', '4', 18, 9, 9, '2019-02-22 14:05:32', '2019-02-22 08:35:32', '1', '192.168.1.15'),
(33, '18', '100036', '0000-00-00 00:00:00', 'Novotel Chennai Sipcot', '33AAECS1194CZZP', 6013, NULL, 'GST', '4', 18, 9, 9, '2019-02-22 14:06:10', '2019-02-22 08:36:10', '1', '192.168.1.15'),
(34, '18', '100036', '0000-00-00 00:00:00', 'Novotel Chennai Sipcot', '33AAECS1194CZZP', 6013, NULL, 'GST', '4', 18, 9, 9, '2019-02-22 14:06:16', '2019-02-22 08:36:16', '1', '192.168.1.15'),
(35, '18', '100036', '0000-00-00 00:00:00', 'Novotel Chennai Sipcot', '33AAECS1194CZZP', 6013, NULL, 'GST', '4', 18, 9, 9, '2019-02-22 14:06:38', '2019-02-22 08:36:38', '1', '192.168.1.15'),
(36, '18', '100036', '0000-00-00 00:00:00', 'Novotel Chennai Sipcot', '33AAECS1194CZZP', 6013, NULL, 'GST', '4', 18, 9, 9, '2019-02-22 14:09:16', '2019-02-22 08:39:16', '1', '192.168.1.15'),
(37, '18', '100036', '0000-00-00 00:00:00', 'Novotel Chennai Sipcot', '33AAECS1194CZZP', 6013, NULL, 'GST', '4', 18, 9, 9, '2019-02-22 14:09:32', '2019-02-22 08:39:32', '1', '192.168.1.15'),
(38, '19', '100037', '2019-02-22 14:10:33', 'Novotel Chennai Sipcot', '33AAECS1194CZZP', 5502, NULL, 'GST', '1', 0, 0, 0, '2019-02-22 14:10:33', '2019-02-22 08:40:33', '1', '192.168.1.15'),
(39, '20', '100037', '2019-02-22 14:10:51', 'Novotel Chennai Sipcot', '33AAECS1194CZZP', 5502, NULL, 'GST', '1', 0, 0, 0, '2019-02-22 14:10:51', '2019-02-22 08:40:51', '1', '192.168.1.15'),
(40, '21', '100037', '2019-02-22 14:11:05', 'Novotel Chennai Sipcot', '33AAECS1194CZZP', 5502, NULL, 'GST', '1', 0, 0, 0, '2019-02-22 14:11:05', '2019-02-22 08:41:05', '1', '192.168.1.15'),
(41, '22', '100037', '2019-02-22 14:11:35', 'Novotel Chennai Sipcot', '33AAECS1194CZZP', 5502, NULL, 'GST', '1', 0, 0, 0, '2019-02-22 14:11:35', '2019-02-22 08:41:35', '1', '192.168.1.15'),
(42, '22', '100037', '0000-00-00 00:00:00', 'Novotel Chennai Sipcot', '33AAECS1194CZZP', 6002, NULL, 'GST', '1', 0, 0, 0, '2019-02-22 14:12:23', '2019-02-22 08:42:23', '1', '192.168.1.15'),
(43, '22', '100037', '0000-00-00 00:00:00', 'Novotel Chennai Sipcot', '33AAECS1194CZZP', 6502, NULL, 'GST', '1', 0, 0, 0, '2019-02-22 14:12:41', '2019-02-22 08:42:41', '1', '192.168.1.15'),
(44, '23', '100038', '2019-02-25 16:32:05', 'Novotel Chennai Sipcot', '33AAECS1194CZZP', 980, NULL, 'GST', '1', 0, 0, 0, '2019-02-25 16:32:05', '2019-02-25 11:02:05', '1', '192.168.1.20'),
(45, '23', '100038', '0000-00-00 00:00:00', 'Novotel Chennai Sipcot', '33AAECS1194CZZP', 2480, NULL, 'GST', '1', 0, 0, 0, '2019-02-25 16:34:56', '2019-02-25 11:04:56', '1', '192.168.1.20'),
(46, '23', '100038', '0000-00-00 00:00:00', 'Novotel Chennai Sipcot', '33AAECS1194CZZP', 2480, NULL, 'GST', '1', 0, 0, 0, '2019-02-25 16:38:25', '2019-02-25 11:08:25', '1', '192.168.1.20'),
(47, '24', '100039', '2019-02-27 19:45:55', 'Vidhun Enterprises', 'test', 3000, NULL, 'GST', '3', 12, 6, 6, '2019-02-27 19:45:55', '2019-02-27 14:15:55', '1', '192.168.1.62'),
(48, '25', '100040', '2019-02-27 19:50:29', 'Novotel Chennai Sipcot', '33AAECS1194CZZP', 333, NULL, 'GST', '4', 18, 9, 9, '2019-02-27 19:50:29', '2019-02-27 14:20:29', '1', '192.168.1.62'),
(49, '26', '100041', '2019-02-28 11:16:22', 'Vidhun Enterprises', 'test', 444, NULL, 'GST', '3', 12, 6, 6, '2019-02-28 11:16:22', '2019-02-28 05:46:22', '1', '192.168.1.3'),
(50, '27', '100042', '2019-02-28 18:09:23', 'Hanifa & Co', '629347549824', 10000, NULL, 'GST', '3', 12, 6, 6, '2019-02-28 18:09:23', '2019-02-28 12:39:23', '1', '192.168.1.3'),
(51, '28', '100043', '2019-03-01 11:14:47', 'Hanifa & Co', '629347549824', 9677, NULL, 'GST', '1', 0, 0, 0, '2019-03-01 11:14:47', '2019-03-01 05:44:47', '1', '192.168.1.7'),
(52, '29', '100044', '2019-03-01 11:15:16', 'GHNDN', '4544', 16556, NULL, 'IGST', '1', 0, NULL, NULL, '2019-03-01 11:15:16', '2019-03-01 05:45:16', '1', '192.168.1.7'),
(53, '29', '100044', '2019-03-01 11:15:16', 'GHNDN', '4544', 16707, NULL, 'IGST', '1', 0, NULL, NULL, '2019-03-01 11:55:01', '2019-03-01 06:25:01', '1', '192.168.1.7'),
(54, '29', '100044', '2019-03-01 11:15:16', 'GHNDN', '4544', 167818, NULL, 'IGST', '1', 0, NULL, NULL, '2019-03-01 11:55:38', '2019-03-01 06:25:38', '1', '192.168.1.7'),
(55, '30', '100045', '2019-03-01 13:11:19', 'Novotel Chennai Sipcot', '33AAECS1194CZZP', 2604, NULL, 'IGST', '4', 18, NULL, NULL, '2019-03-01 13:11:19', '2019-03-01 07:41:19', '1', '192.168.1.7'),
(56, '30', '100045', '2019-03-01 13:11:19', 'Novotel Chennai Sipcot', '33AAECS1194CZZP', 2755, NULL, 'IGST', '4', 18, NULL, NULL, '2019-03-01 13:11:48', '2019-03-01 07:41:48', '1', '192.168.1.7'),
(57, '31', '100046', '2019-03-01 13:14:22', 'Novotel Chennai Sipcot', '33AAECS1194CZZP', 26, NULL, 'GST', '4', 18, 9, 9, '2019-03-01 13:14:22', '2019-03-01 07:44:22', '1', '192.168.1.7'),
(58, '31', '100046', '2019-03-01 13:14:22', 'Novotel Chennai Sipcot', '33AAECS1194CZZP', 4130, NULL, 'GST', '4', 18, 9, 9, '2019-03-01 13:14:42', '2019-03-01 07:44:42', '1', '192.168.1.7'),
(59, '32', '100047', '2019-03-01 13:15:03', 'dhoni pvt ltd', 'IOO0000000000000000000', 2109, NULL, 'IGST', '1', 0, NULL, NULL, '2019-03-01 13:15:03', '2019-03-01 07:45:03', '1', '192.168.1.7'),
(60, '33', '100048', '2019-03-01 13:50:47', 'dhoni pvt ltd', 'IOO0000000000000000000', 373, NULL, 'GST', '1', 0, 0, 0, '2019-03-01 13:50:47', '2019-03-01 08:20:47', '1', '192.168.1.7'),
(61, '33', '100048', '2019-03-01 13:50:47', 'dhoni pvt ltd', 'IOO0000000000000000000', 374, NULL, 'GST', '1', 0, 0, 0, '2019-03-01 13:51:24', '2019-03-01 08:21:24', '1', '192.168.1.7'),
(62, '33', '100048', '2019-03-01 13:50:47', 'dhoni pvt ltd', 'IOO0000000000000000000', 385, NULL, 'GST', '1', 0, 0, 0, '2019-03-01 13:52:22', '2019-03-01 08:22:22', '1', '192.168.1.7'),
(63, '34', '100049', '2019-03-02 11:51:38', 'tendulkar', '2316654231132163', 3000, NULL, 'GST', '4', 18, 9, 9, '2019-03-02 11:51:38', '2019-03-02 06:21:38', '1', '192.168.1.25'),
(64, '35', 'IV-2019-100050', '2019-03-02 14:46:12', 'tendulkar', '2316654231132163', 1500, NULL, 'GST', '1', 0, 0, 0, '2019-03-02 14:46:12', '2019-03-02 09:16:12', '1', '192.168.1.25'),
(65, '36', 'INV-2019-0001', '2019-03-04 16:20:10', 'Sai Group of Companies', '1234556', 1650, NULL, 'GST', '1', 0, 0, 0, '2019-03-04 16:20:10', '2019-03-04 10:50:10', '1', '192.168.1.25');

-- --------------------------------------------------------

--
-- Table structure for table `serviceuser_login`
--

CREATE TABLE `serviceuser_login` (
  `id` int(100) NOT NULL,
  `auth_role` varchar(2000) NOT NULL,
  `assign_service` varchar(2000) NOT NULL,
  `assign_action` text NOT NULL,
  `status` enum('A','I') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `serviceuser_login`
--

INSERT INTO `serviceuser_login` (`id`, `auth_role`, `assign_service`, `assign_action`, `status`) VALUES
(22, 'branchadmin', '[\"14\",\"15\",\"16\",\"17\",\"18\",\"19\",\"25\",\"26\",\"27\",\"28\",\"29\",\"30\",\"31\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"39\",\"40\",\"41\",\"42\",\"43\",\"44\",\"46\",\"47\",\"48\",\"52\",\"53\",\"56\",\"57\",\"58\",\"59\",\"60\",\"61\",\"62\",\"63\",\"64\",\"66\",\"67\",\"69\",\"70\",\"71\",\"72\",\"79\",\"92\",\"93\",\"98\"]', '{\"14\":\"a,e,v,d,\",\"15\":\"a,e,v,d,\",\"16\":\"a,e,v,d,\",\"17\":\"a,e,v,d,\",\"19\":\"a,e,v,d,\",\"25\":\"a,e,v,d,et,print,\",\"26\":\"a,e,v,d,\",\"27\":\"a,e,v,d,\",\"29\":\"a,e,v,d,\",\"30\":\"a,e,v,d,\",\"32\":\"a,e,v,d,\",\"33\":\"a,e,v,d,\",\"34\":\"a,e,v,d,\",\"35\":\"a,e,v,d,\",\"36\":\"a,e,v,d,et,da,\",\"37\":\"a,e,v,d,\",\"39\":\"a,e,v,d,\",\"42\":\"a,e,v,d,\",\"44\":\"a,e,v,d,\",\"46\":\"a,e,v,d,\",\"47\":\"a,e,v,d,\",\"48\":\"a,e,v,d,\",\"52\":\"a,e,v,d,\",\"53\":\"a,e,v,d,\",\"56\":\"a,e,v,d,\",\"57\":\"a,e,v,d,\",\"59\":\"a,e,v,d,\",\"60\":\"a,e,v,d,\",\"61\":\"a,e,v,d,\",\"62\":\"a,e,v,d,\",\"63\":\"a,e,v,d,\",\"64\":\"a,e,v,d,\",\"66\":\"a,e,v,d,\",\"70\":\"a,e,v,d,\",\"71\":\"a,e,v,d,\",\"72\":\"a,e,v,d,\",\"92\":\"a,e,v,d,\"}', 'A'),
(43, 'Super', '[\"8\",\"10\",\"11\",\"14\",\"15\",\"16\",\"17\",\"18\",\"19\",\"21\",\"22\",\"23\",\"24\",\"25\",\"26\",\"27\",\"28\",\"29\",\"30\",\"31\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"43\",\"44\",\"45\",\"46\",\"47\",\"48\",\"49\",\"52\",\"53\",\"54\",\"55\",\"56\",\"57\",\"58\",\"59\",\"60\",\"61\",\"62\",\"63\",\"64\",\"65\",\"66\",\"67\",\"68\",\"69\",\"70\",\"71\",\"72\",\"73\",\"74\",\"75\",\"76\",\"77\",\"78\",\"79\",\"80\",\"81\",\"82\",\"83\",\"84\",\"85\",\"86\",\"87\",\"89\",\"90\",\"92\",\"93\",\"95\",\"96\",\"97\",\"98\",\"99\",\"100\",\"101\",\"102\",\"103\",\"104\",\"106\",\"107\",\"108\",\"109\",\"110\",\"111\",\"112\",\"113\",\"114\",\"115\",\"117\",\"118\",\"119\",\"120\",\"121\",\"122\",\"124\",\"125\",\"126\",\"127\",\"128\",\"129\",\"130\",\"131\",\"132\",\"133\",\"134\",\"135\",\"136\",\"137\",\"138\",\"139\",\"140\",\"141\",\"142\",\"143\",\"144\",\"145\",\"147\",\"148\",\"149\",\"150\",\"151\",\"152\",\"153\",\"156\",\"157\",\"158\",\"159\",\"160\",\"161\",\"162\",\"163\",\"164\",\"165\",\"166\",\"167\"]', '{\"8\":\"a,e,v,d,\",\"10\":\"a,e,v,d,\",\"11\":\"a,e,v,d,m,\",\"14\":\"a,e,v,d,\",\"15\":\"a,e,v,d,\",\"16\":\"a,e,v,d,\",\"17\":\"a,e,v,d,\",\"19\":\"a,e,v,d,\",\"22\":\"a,e,v,d,\",\"23\":\"a,e,v,d,\",\"24\":\"a,e,v,d,\",\"25\":\"a,e,v,d,et,print,\",\"26\":\"a,e,v,d,\",\"27\":\"a,e,v,d,\",\"29\":\"a,e,v,d,\",\"30\":\"a,e,v,d,\",\"32\":\"a,e,v,d,\",\"33\":\"a,e,v,d,\",\"34\":\"a,e,v,d,\",\"35\":\"a,e,v,d,\",\"36\":\"a,e,v,d,et,da,\",\"37\":\"a,e,v,d,\",\"38\":\"a,e,v,d,\",\"39\":\"a,e,v,d,\",\"42\":\"a,e,v,d,\",\"43\":\"a,e,v,d,\",\"44\":\"a,e,v,d,\",\"45\":\"a,e,v,d,\",\"46\":\"a,e,v,d,\",\"47\":\"a,e,v,d,\",\"48\":\"a,e,v,d,\",\"49\":\"a,e,v,d,\",\"52\":\"v,\",\"53\":\"a,e,v,d,\",\"54\":\"a,e,v,d,\",\"55\":\"a,e,v,d,\",\"56\":\"a,e,v,d,\",\"57\":\"a,e,v,d,\",\"59\":\"a,e,v,d,\",\"60\":\"a,e,v,d,\",\"61\":\"a,e,v,d,\",\"62\":\"a,e,v,d,\",\"63\":\"a,e,v,d,\",\"64\":\"a,e,v,d,\",\"65\":\"a,e,v,d,\",\"66\":\"a,e,v,d,\",\"67\":\"a,e,v,d,\",\"68\":\"a,e,v,d,\",\"70\":\"a,e,v,d,\",\"71\":\"a,e,v,d,\",\"72\":\"a,e,v,d,\",\"73\":\"et,\",\"75\":\"et,\",\"78\":\"pay,refund,print,\",\"80\":\"a,e,v,d,\",\"81\":\"pay,refund,print,\",\"83\":\"pay,refund,print,\",\"84\":\"pay,refund,print,\",\"85\":\"print,\",\"90\":\"a,e,v,d,\",\"92\":\"a,e,v,d,\",\"96\":\"a,e,v,d,\",\"97\":\"a,e,v,d,\",\"104\":\"a,e,v,d,\",\"106\":\"a,e,v,m,da,\",\"107\":\"a,e,v,d,\",\"108\":\"a,e,v,d,\",\"109\":\"a,e,v,d,\",\"156\":\"a,e,v,d,\"}', 'A'),
(44, 'guest', '[\"18\",\"19\",\"25\",\"27\",\"36\",\"37\",\"56\"]', '{\"19\":\"a,e,v,\",\"25\":\"a,e,v,\",\"27\":\"a,e,v,\",\"36\":\"a,e,v,da,\",\"37\":\"a,e,v,\",\"56\":\"a,e,v,\"}', 'A'),
(45, 'warehouseaccess', '[\"14\",\"15\",\"16\",\"17\",\"18\",\"19\",\"25\",\"26\",\"27\",\"28\",\"29\",\"30\",\"33\",\"34\",\"35\",\"36\",\"37\",\"39\",\"49\",\"52\",\"53\",\"56\",\"57\",\"61\",\"62\",\"63\",\"64\",\"65\",\"66\",\"74\",\"75\",\"159\",\"167\"]', '{\"14\":\"a,e,v,\",\"15\":\"a,e,v,\",\"16\":\"a,e,v,\",\"17\":\"a,e,v,\",\"19\":\"a,e,v,\",\"25\":\"a,e,v,\",\"26\":\"a,e,v,\",\"27\":\"a,e,v,\",\"29\":\"a,e,v,\",\"30\":\"a,e,v,\",\"33\":\"a,e,v,\",\"34\":\"a,e,v,\",\"35\":\"a,e,v,d,\",\"36\":\"a,e,v,et,da,\",\"37\":\"a,e,v,\",\"39\":\"a,e,v,\",\"49\":\"a,e,v,\",\"53\":\"a,e,v,\",\"56\":\"a,e,v,\",\"57\":\"a,e,v,\",\"61\":\"a,e,v,\",\"62\":\"a,e,v,\",\"63\":\"a,e,v,\",\"64\":\"a,e,v,\",\"65\":\"a,e,v,\",\"66\":\"a,e,v,d,\",\"75\":\"et,\"}', 'A'),
(46, 'Cashier', '[\"77\",\"78\"]', '{\"78\":\"pay,\"}', 'A'),
(48, 'tester1', '[\"8\",\"10\",\"11\",\"14\",\"15\",\"16\",\"17\",\"18\",\"19\",\"21\",\"22\",\"23\",\"24\",\"25\",\"26\",\"27\",\"28\",\"29\",\"30\",\"31\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"43\",\"44\",\"45\",\"46\",\"47\",\"48\",\"49\",\"52\",\"53\",\"54\",\"55\",\"56\",\"57\",\"58\",\"59\",\"60\",\"61\",\"62\",\"63\",\"64\",\"65\",\"66\",\"67\",\"68\",\"69\",\"70\",\"71\",\"72\",\"73\",\"74\",\"75\",\"76\",\"77\",\"78\",\"79\",\"80\",\"81\",\"82\",\"83\",\"84\",\"85\",\"86\",\"87\",\"88\"]', '{\"8\":\"a,e,v,d,\",\"10\":\"a,e,v,d,\",\"11\":\"a,e,v,d,m,\",\"14\":\"a,e,v,d,\",\"15\":\"a,e,v,d,\",\"16\":\"a,e,v,d,\",\"17\":\"a,e,v,d,\",\"19\":\"a,e,v,d,\",\"22\":\"a,e,v,d,\",\"23\":\"a,e,v,d,\",\"24\":\"a,e,v,d,\",\"25\":\"a,e,v,d,\",\"26\":\"a,e,v,d,\",\"27\":\"a,e,v,d,\",\"29\":\"a,e,v,d,\",\"30\":\"a,e,v,d,\",\"32\":\"a,e,v,d,\",\"33\":\"a,e,v,d,\",\"34\":\"a,e,v,d,\",\"35\":\"a,e,v,d,\",\"36\":\"a,e,v,d,et,da,\",\"37\":\"a,e,v,d,\",\"38\":\"a,e,v,d,\",\"39\":\"a,e,v,d,\",\"42\":\"a,e,v,d,\",\"43\":\"a,e,v,d,\",\"44\":\"a,e,v,d,\",\"45\":\"a,e,v,d,\",\"46\":\"a,e,v,d,\",\"47\":\"a,e,v,d,\",\"48\":\"a,e,v,d,\",\"49\":\"a,e,v,d,\",\"52\":\"a,e,v,d,\",\"53\":\"a,e,v,d,\",\"54\":\"a,e,v,d,\",\"55\":\"a,e,v,d,\",\"56\":\"a,e,v,d,\",\"57\":\"a,e,v,d,\",\"59\":\"a,e,v,d,\",\"60\":\"a,e,v,d,\",\"61\":\"a,e,v,d,\",\"62\":\"a,e,v,d,\",\"63\":\"a,e,v,d,\",\"64\":\"a,e,v,d,\",\"65\":\"a,e,v,d,\",\"66\":\"a,e,v,d,\",\"67\":\"a,e,v,d,\",\"68\":\"a,e,v,d,\",\"70\":\"a,e,v,d,\",\"71\":\"a,e,v,d,\",\"72\":\"a,e,v,d,\",\"73\":\"et,\",\"75\":\"et,\",\"78\":\"pay,refund,print,\",\"80\":\"a,e,v,d,\",\"81\":\"pay,refund,print,\",\"83\":\"pay,refund,print,\",\"84\":\"pay,refund,print,\",\"85\":\"print,\"}', 'A'),
(49, 'pharmacy', '[\"18\",\"19\",\"25\",\"27\",\"31\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"46\",\"47\",\"48\",\"53\",\"56\",\"58\",\"66\",\"68\",\"73\",\"74\",\"75\",\"82\",\"85\",\"86\",\"87\",\"90\",\"93\",\"100\",\"158\",\"167\"]', '{\"19\":\"a,e,v,d,\",\"25\":\"a,e,v,d,et,print,\",\"27\":\"a,e,v,d,\",\"32\":\"a,e,v,d,\",\"33\":\"a,e,v,d,\",\"34\":\"a,e,v,d,\",\"35\":\"a,e,v,d,\",\"36\":\"a,e,v,d,et,da,\",\"37\":\"a,e,v,d,\",\"38\":\"a,e,v,d,\",\"46\":\"a,e,v,d,\",\"47\":\"a,e,v,d,\",\"48\":\"a,e,v,d,\",\"53\":\"a,e,v,d,\",\"56\":\"a,e,v,d,\",\"66\":\"a,e,v,d,\",\"68\":\"a,e,v,d,\",\"73\":\"et,\",\"75\":\"et,\",\"85\":\"print,\",\"90\":\"a,e,v,d,\"}', 'A'),
(50, 'lab', '[\"28\",\"29\",\"30\",\"100\",\"103\",\"104\",\"106\",\"107\",\"108\",\"110\",\"111\",\"112\",\"113\",\"117\",\"118\"]', '{\"29\":\"a,e,v,d,\",\"30\":\"a,e,v,d,\",\"104\":\"a,e,v,d,\",\"106\":\"a,e,v,m,da,\",\"107\":\"a,e,v,d,\",\"108\":\"a,e,v,d,\"}', 'A'),
(51, 'reception', '[\"92\",\"98\",\"101\",\"102\",\"109\"]', '{\"92\":\"a,e,v,d,\",\"109\":\"a,e,v,d,\"}', 'A'),
(52, 'UCIL', '[\"99\",\"114\",\"115\"]', 'null', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `taxmaster`
--

CREATE TABLE `taxmaster` (
  `taxid` bigint(20) NOT NULL,
  `taxvalue` double NOT NULL,
  `taxgroup` varchar(50) NOT NULL,
  `financialyear` varchar(100) NOT NULL,
  `additionaltax` double NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `updated_by` varchar(20) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_ipaddress` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `taxmaster`
--

INSERT INTO `taxmaster` (`taxid`, `taxvalue`, `taxgroup`, `financialyear`, `additionaltax`, `is_active`, `updated_by`, `updated_on`, `updated_ipaddress`) VALUES
(1, 0, '0%', '2018', 0, 1, '1', '2018-07-25 17:09:29', '192.168.1.12'),
(3, 12, '12%', '2018', 0, 1, '1', '2018-07-25 17:09:29', '192.168.1.12'),
(4, 18, '18%', '2018', 0, 1, '1', '2018-07-25 17:09:29', '192.168.1.12'),
(7, 0.1, '0.1%', '2018', 0, 1, '1', '2019-02-18 17:08:25', '192.168.1.15'),
(10, 15, '15', '2017', 15, 1, '1', '2019-02-20 20:12:57', '192.168.1.15');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `name`, `user_type`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'Super Admin', 'S', 'NiuktLbuo2HYZ09kbSQRZqzJEne_UcKi', '$2y$13$/eFHsxIIzyKTQCWpmGuSceLjk4vGh2Sb1LN9OsFHCJqC2jAAT76Cy', NULL, 'admin@gmail.com', '10', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'admin', 'admin', 'A', NULL, '$2y$13$dz39fzUOlkdDwahjA0CWR.Fy2Ujk97MzkZyrWE4ijkqtzKQWhJTsq', NULL, NULL, '10', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_log`
--
ALTER TABLE `admin_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `auth_user_role`
--
ALTER TABLE `auth_user_role`
  ADD PRIMARY KEY (`ur_autoid`);

--
-- Indexes for table `auto_idtable`
--
ALTER TABLE `auto_idtable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branch_admin`
--
ALTER TABLE `branch_admin`
  ADD PRIMARY KEY (`ba_autoid`);

--
-- Indexes for table `configuration`
--
ALTER TABLE `configuration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config_year`
--
ALTER TABLE `config_year`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_table`
--
ALTER TABLE `contact_table`
  ADD PRIMARY KEY (`auto_id`);

--
-- Indexes for table `customer_master`
--
ALTER TABLE `customer_master`
  ADD PRIMARY KEY (`auto_id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_address_master`
--
ALTER TABLE `delivery_address_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_log`
--
ALTER TABLE `delivery_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_ref`
--
ALTER TABLE `delivery_ref`
  ADD PRIMARY KEY (`auto_id`);

--
-- Indexes for table `delivery_ref_log`
--
ALTER TABLE `delivery_ref_log`
  ADD PRIMARY KEY (`auto_id`);

--
-- Indexes for table `estimate`
--
ALTER TABLE `estimate`
  ADD PRIMARY KEY (`auto_id`);

--
-- Indexes for table `estimate_log`
--
ALTER TABLE `estimate_log`
  ADD PRIMARY KEY (`auto_id`);

--
-- Indexes for table `estimate_main_tbl`
--
ALTER TABLE `estimate_main_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `estimate_main_tbl_log`
--
ALTER TABLE `estimate_main_tbl_log`
  ADD PRIMARY KEY (`auto_id`);

--
-- Indexes for table `invoice_ref_tbl`
--
ALTER TABLE `invoice_ref_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_ref_tbl_log`
--
ALTER TABLE `invoice_ref_tbl_log`
  ADD PRIMARY KEY (`auto_id`);

--
-- Indexes for table `invoice_table`
--
ALTER TABLE `invoice_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_table_log`
--
ALTER TABLE `invoice_table_log`
  ADD PRIMARY KEY (`auto_id`);

--
-- Indexes for table `serviceuser_login`
--
ALTER TABLE `serviceuser_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxmaster`
--
ALTER TABLE `taxmaster`
  ADD PRIMARY KEY (`taxid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_log`
--
ALTER TABLE `admin_log`
  MODIFY `log_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `auth_user_role`
--
ALTER TABLE `auth_user_role`
  MODIFY `ur_autoid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `auto_idtable`
--
ALTER TABLE `auto_idtable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `branch_admin`
--
ALTER TABLE `branch_admin`
  MODIFY `ba_autoid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `configuration`
--
ALTER TABLE `configuration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `config_year`
--
ALTER TABLE `config_year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_table`
--
ALTER TABLE `contact_table`
  MODIFY `auto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `customer_master`
--
ALTER TABLE `customer_master`
  MODIFY `auto_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `delivery_address_master`
--
ALTER TABLE `delivery_address_master`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `delivery_log`
--
ALTER TABLE `delivery_log`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `delivery_ref`
--
ALTER TABLE `delivery_ref`
  MODIFY `auto_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=288;

--
-- AUTO_INCREMENT for table `delivery_ref_log`
--
ALTER TABLE `delivery_ref_log`
  MODIFY `auto_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=288;

--
-- AUTO_INCREMENT for table `estimate`
--
ALTER TABLE `estimate`
  MODIFY `auto_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=238;

--
-- AUTO_INCREMENT for table `estimate_log`
--
ALTER TABLE `estimate_log`
  MODIFY `auto_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=238;

--
-- AUTO_INCREMENT for table `estimate_main_tbl`
--
ALTER TABLE `estimate_main_tbl`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `estimate_main_tbl_log`
--
ALTER TABLE `estimate_main_tbl_log`
  MODIFY `auto_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `invoice_ref_tbl`
--
ALTER TABLE `invoice_ref_tbl`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT for table `invoice_ref_tbl_log`
--
ALTER TABLE `invoice_ref_tbl_log`
  MODIFY `auto_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;

--
-- AUTO_INCREMENT for table `invoice_table`
--
ALTER TABLE `invoice_table`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `invoice_table_log`
--
ALTER TABLE `invoice_table_log`
  MODIFY `auto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `serviceuser_login`
--
ALTER TABLE `serviceuser_login`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `taxmaster`
--
ALTER TABLE `taxmaster`
  MODIFY `taxid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
