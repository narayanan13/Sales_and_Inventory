-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2021 at 11:52 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sales_inventory_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_list`
--

CREATE TABLE `category_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_list`
--

INSERT INTO `category_list` (`id`, `name`) VALUES
(1, 'Bulb'),
(2, 'Screw'),
(3, 'Nail'),
(4, 'Pipe'),
(5, 'Motor'),
(6, 'Water Tank'),
(7, 'Test'),
(8, 'Water Bottle');

-- --------------------------------------------------------

--
-- Table structure for table `customer_list`
--

CREATE TABLE `customer_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `contact` varchar(30) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_list`
--

INSERT INTO `customer_list` (`id`, `name`, `contact`, `address`) VALUES
(1, 'Suresh', '9087981163', 'tuty');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(30) NOT NULL,
  `product_id` int(30) NOT NULL,
  `qty` int(30) NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1= stockin , 2 = stockout',
  `stock_from` varchar(100) NOT NULL COMMENT 'sales/receiving',
  `form_id` int(30) NOT NULL,
  `other_details` text NOT NULL,
  `remarks` text NOT NULL,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `product_id`, `qty`, `type`, `stock_from`, `form_id`, `other_details`, `remarks`, `date_updated`) VALUES
(1, 1, 100, 1, 'receiving', 1, '{\"price\":\"100\",\"qty\":\"100\"}', 'Stock from Receiving-00000000\n', '2021-09-18 10:46:36'),
(2, 2, 150, 1, 'receiving', 1, '{\"price\":\"15\",\"qty\":\"150\"}', 'Stock from Receiving-00000000\n', '2021-09-18 10:46:36'),
(3, 6, 120, 1, 'receiving', 1, '{\"price\":\"24\",\"qty\":\"120\"}', 'Stock from Receiving-00000000\n', '2021-09-18 10:46:36'),
(4, 3, 200, 1, 'receiving', 1, '{\"price\":\"56.40\",\"qty\":\"200\"}', 'Stock from Receiving-00000000\n', '2021-09-18 10:46:36'),
(5, 4, 500, 1, 'receiving', 1, '{\"price\":\"20\",\"qty\":\"500\"}', 'Stock from Receiving-00000000\n', '2021-09-18 10:46:36'),
(6, 5, 20, 1, 'receiving', 1, '{\"price\":\"5050\",\"qty\":\"20\"}', 'Stock from Receiving-00000000\n', '2021-09-18 10:46:36'),
(7, 7, 30, 1, 'receiving', 1, '{\"price\":\"50\",\"qty\":\"30\"}', 'Stock from Receiving-00000000\n', '2021-09-18 10:46:36'),
(8, 1, 1, 2, 'Sales', 1, '{\"price\":\"450\",\"qty\":\"1\"}', 'Stock out from Sales-00000000\n', '2021-09-18 10:50:32'),
(9, 2, 2, 2, 'Sales', 1, '{\"price\":\"45\",\"qty\":\"2\"}', 'Stock out from Sales-00000000\n', '2021-09-18 10:50:32'),
(10, 6, 1, 2, 'Sales', 1, '{\"price\":\"5000\",\"qty\":\"1\"}', 'Stock out from Sales-00000000\n', '2021-09-18 10:50:32'),
(11, 3, 3, 2, 'Sales', 1, '{\"price\":\"50\",\"qty\":\"3\"}', 'Stock out from Sales-00000000\n', '2021-09-18 10:50:32'),
(12, 2, 2, 2, 'Sales', 2, '{\"price\":\"45\",\"qty\":\"2\"}', 'Stock out from Sales-72596390\n', '2021-09-18 10:53:13'),
(13, 1, 1, 2, 'Sales', 2, '{\"price\":\"450\",\"qty\":\"1\"}', 'Stock out from Sales-72596390\n', '2021-09-18 10:53:13'),
(14, 6, 1, 2, 'Sales', 2, '{\"price\":\"5000\",\"qty\":\"1\"}', 'Stock out from Sales-72596390\n', '2021-09-18 10:53:13'),
(15, 4, 2, 2, 'Sales', 2, '{\"price\":\"65\",\"qty\":\"2\"}', 'Stock out from Sales-72596390\n', '2021-09-18 10:53:13'),
(16, 1, 1, 2, 'Sales', 3, '{\"price\":\"450\",\"qty\":\"1\"}', 'Stock out from Sales-99700787\n', '2021-09-18 10:55:15'),
(17, 6, 2, 2, 'Sales', 4, '{\"price\":\"5000\",\"qty\":\"2\"}', 'Stock out from Sales-42629822\n', '2021-09-18 10:56:15'),
(18, 3, 2, 2, 'Sales', 5, '{\"price\":\"50\",\"qty\":\"2\"}', 'Stock out from Sales-27616544\n', '2021-09-18 10:57:02'),
(19, 4, 3, 2, 'Sales', 6, '{\"price\":\"65\",\"qty\":\"3\"}', 'Stock out from Sales-53599794\n', '2021-09-18 10:57:37'),
(20, 3, 1, 2, 'Sales', 7, '{\"price\":\"50\",\"qty\":\"1\"}', 'Stock out from Sales-33857074\n', '2021-09-18 10:58:28'),
(21, 3, 2, 2, 'Sales', 8, '{\"price\":\"50\",\"qty\":\"2\"}', 'Stock out from Sales-82274199\n', '2021-09-18 11:00:28'),
(22, 2, 2, 2, 'Sales', 9, '{\"price\":\"45\",\"qty\":\"2\"}', 'Stock out from Sales-06903957\n', '2021-09-18 11:03:19'),
(23, 2, 2, 2, 'Sales', 10, '{\"price\":\"45\",\"qty\":\"2\"}', 'Stock out from Sales-78559918\n', '2021-09-18 11:04:13'),
(24, 2, 1, 2, 'Sales', 11, '{\"price\":\"45\",\"qty\":\"1\"}', 'Stock out from Sales-35778015\n', '2021-09-18 11:05:51'),
(25, 2, 3, 2, 'Sales', 12, '{\"price\":\"45\",\"qty\":\"3\"}', 'Stock out from Sales-48500265\n', '2021-09-18 11:06:43'),
(26, 2, 2, 2, 'Sales', 13, '{\"price\":\"45\",\"qty\":\"2\"}', 'Stock out from Sales-49556353\n', '2021-09-18 11:07:45'),
(27, 2, 4, 2, 'Sales', 14, '{\"price\":\"45\",\"qty\":\"4\"}', 'Stock out from Sales-99287721\n', '2021-09-18 11:08:48'),
(28, 2, 2, 2, 'Sales', 15, '{\"price\":\"45\",\"qty\":\"2\"}', 'Stock out from Sales-66364540\n', '2021-09-18 11:09:49'),
(29, 6, 1, 2, 'Sales', 16, '{\"price\":\"5000\",\"qty\":\"1\"}', 'Stock out from Sales-97698376\n', '2021-09-18 11:10:20'),
(30, 2, 1, 2, 'Sales', 17, '{\"price\":\"45\",\"qty\":\"1\"}', 'Stock out from Sales-10392198\n', '2021-09-18 11:12:12'),
(31, 2, 1, 2, 'Sales', 18, '{\"price\":\"45\",\"qty\":\"1\"}', 'Stock out from Sales-81300546\n', '2021-09-18 11:13:01'),
(32, 6, 1, 2, 'Sales', 19, '{\"price\":\"5000\",\"qty\":\"1\"}', 'Stock out from Sales-57884815\n', '2021-09-18 11:14:16'),
(33, 2, 1, 2, 'Sales', 20, '{\"price\":\"45\",\"qty\":\"1\"}', 'Stock out from Sales-91784961\n', '2021-09-18 11:15:10'),
(34, 2, 1, 2, 'Sales', 21, '{\"price\":\"45\",\"qty\":\"1\"}', 'Stock out from Sales-32653139\n', '2021-09-18 11:16:49'),
(35, 2, 1, 2, 'Sales', 22, '{\"price\":\"45\",\"qty\":\"1\"}', 'Stock out from Sales-97631243\n', '2021-09-18 11:18:13'),
(36, 1, 2, 2, 'Sales', 22, '{\"price\":\"450\",\"qty\":\"2\"}', 'Stock out from Sales-97631243\n', '2021-09-18 11:18:13'),
(37, 3, 2, 2, 'Sales', 22, '{\"price\":\"50\",\"qty\":\"2\"}', 'Stock out from Sales-97631243\n', '2021-09-18 11:18:13'),
(38, 2, 2, 2, 'Sales', 23, '{\"price\":\"45\",\"qty\":\"2\"}', 'Stock out from Sales-06399412\n', '2021-09-18 11:18:55'),
(39, 1, 1, 2, 'Sales', 23, '{\"price\":\"450\",\"qty\":\"1\"}', 'Stock out from Sales-06399412\n', '2021-09-18 11:18:55'),
(40, 1, 1, 2, 'Sales', 24, '{\"price\":\"450\",\"qty\":\"1\"}', 'Stock out from Sales-73869897\n', '2021-09-18 11:19:43'),
(41, 2, 2, 2, 'Sales', 24, '{\"price\":\"45\",\"qty\":\"2\"}', 'Stock out from Sales-73869897\n', '2021-09-18 11:19:43'),
(42, 3, 2, 2, 'Sales', 24, '{\"price\":\"50\",\"qty\":\"2\"}', 'Stock out from Sales-73869897\n', '2021-09-18 11:19:43'),
(43, 2, 2, 2, 'Sales', 25, '{\"price\":\"45\",\"qty\":\"2\"}', 'Stock out from Sales-97436565\n', '2021-09-18 11:20:31'),
(44, 6, 1, 2, 'Sales', 25, '{\"price\":\"5000\",\"qty\":\"1\"}', 'Stock out from Sales-97436565\n', '2021-09-18 11:20:31'),
(45, 1, 2, 2, 'Sales', 25, '{\"price\":\"450\",\"qty\":\"2\"}', 'Stock out from Sales-97436565\n', '2021-09-18 11:20:31'),
(46, 2, 1, 2, 'Sales', 26, '{\"price\":\"45\",\"qty\":\"1\"}', 'Stock out from Sales-92313552\n', '2021-09-18 11:21:35'),
(47, 2, 1, 2, 'Sales', 27, '{\"price\":\"45\",\"qty\":\"1\"}', 'Stock out from Sales-59431990\n', '2021-09-18 11:22:58'),
(48, 1, 2, 2, 'Sales', 28, '{\"price\":\"450\",\"qty\":\"2\"}', 'Stock out from Sales-22282864\n', '2021-09-18 11:26:20'),
(49, 2, 1, 2, 'Sales', 29, '{\"price\":\"45\",\"qty\":\"1\"}', 'Stock out from Sales-15614469\n', '2021-09-18 11:28:25'),
(50, 6, 1, 2, 'Sales', 29, '{\"price\":\"5000\",\"qty\":\"1\"}', 'Stock out from Sales-15614469\n', '2021-09-18 11:28:25'),
(51, 1, 2, 2, 'Sales', 30, '{\"price\":\"450\",\"qty\":\"2\"}', 'Stock out from Sales-11743877\n', '2021-09-18 11:29:40'),
(52, 1, 1, 2, 'Sales', 31, '{\"price\":\"450\",\"qty\":\"1\"}', 'Stock out from Sales-92623239\n', '2021-09-18 11:35:34'),
(53, 2, 2, 2, 'Sales', 31, '{\"price\":\"45\",\"qty\":\"2\"}', 'Stock out from Sales-92623239\n', '2021-09-18 11:35:34'),
(54, 1, 1, 2, 'Sales', 32, '{\"price\":\"450\",\"qty\":\"1\"}', 'Stock out from Sales-61914847\n', '2021-09-18 11:36:20'),
(55, 2, 2, 2, 'Sales', 32, '{\"price\":\"45\",\"qty\":\"2\"}', 'Stock out from Sales-61914847\n', '2021-09-18 11:36:20'),
(56, 1, 1, 2, 'Sales', 33, '{\"price\":\"450\",\"qty\":\"1\"}', 'Stock out from Sales-18857111\n', '2021-09-18 11:37:13'),
(57, 2, 1, 2, 'Sales', 33, '{\"price\":\"45\",\"qty\":\"1\"}', 'Stock out from Sales-18857111\n', '2021-09-18 11:37:13'),
(58, 1, 1, 2, 'Sales', 34, '{\"price\":\"450\",\"qty\":\"1\"}', 'Stock out from Sales-90210995\n', '2021-09-18 11:38:00'),
(59, 2, 2, 2, 'Sales', 34, '{\"price\":\"45\",\"qty\":\"2\"}', 'Stock out from Sales-90210995\n', '2021-09-18 11:38:00'),
(60, 1, 1, 2, 'Sales', 35, '{\"price\":\"450\",\"qty\":\"1\"}', 'Stock out from Sales-86866259\n', '2021-09-18 11:39:41'),
(61, 2, 2, 2, 'Sales', 35, '{\"price\":\"45\",\"qty\":\"2\"}', 'Stock out from Sales-86866259\n', '2021-09-18 11:39:41'),
(62, 6, 1, 2, 'Sales', 35, '{\"price\":\"5000\",\"qty\":\"1\"}', 'Stock out from Sales-86866259\n', '2021-09-18 11:39:41'),
(63, 3, 1, 2, 'Sales', 35, '{\"price\":\"50\",\"qty\":\"1\"}', 'Stock out from Sales-86866259\n', '2021-09-18 11:39:41'),
(64, 4, 2, 2, 'Sales', 35, '{\"price\":\"65\",\"qty\":\"2\"}', 'Stock out from Sales-86866259\n', '2021-09-18 11:39:41'),
(65, 5, 1, 2, 'Sales', 35, '{\"price\":\"1200\",\"qty\":\"1\"}', 'Stock out from Sales-86866259\n', '2021-09-18 11:39:41'),
(66, 7, 2, 2, 'Sales', 35, '{\"price\":\"75\",\"qty\":\"2\"}', 'Stock out from Sales-86866259\n', '2021-09-18 11:39:41'),
(67, 2, 1, 2, 'Sales', 36, '{\"price\":\"45\",\"qty\":\"1\"}', 'Stock out from Sales-70383735\n', '2021-09-18 11:41:45'),
(68, 1, 1, 2, 'Sales', 37, '{\"price\":\"450\",\"qty\":\"1\"}', 'Stock out from Sales-55847253\n', '2021-09-18 11:51:28'),
(69, 2, 2, 2, 'Sales', 37, '{\"price\":\"45\",\"qty\":\"2\"}', 'Stock out from Sales-55847253\n', '2021-09-18 11:51:28'),
(70, 6, 3, 2, 'Sales', 37, '{\"price\":\"5000\",\"qty\":\"3\"}', 'Stock out from Sales-55847253\n', '2021-09-18 11:51:28'),
(71, 1, 1, 2, 'Sales', 38, '{\"price\":\"450\",\"qty\":\"1\"}', 'Stock out from Sales-78516457\n', '2021-09-18 11:53:08'),
(72, 2, 1, 2, 'Sales', 39, '{\"price\":\"45\",\"qty\":\"1\"}', 'Stock out from Sales-48743898\n', '2021-09-18 11:54:40'),
(73, 1, 2, 2, 'Sales', 39, '{\"price\":\"450\",\"qty\":\"2\"}', 'Stock out from Sales-48743898\n', '2021-09-18 11:54:40'),
(74, 6, 1, 2, 'Sales', 40, '{\"price\":\"5000\",\"qty\":\"1\"}', 'Stock out from Sales-25324243\n', '2021-09-18 14:20:23'),
(75, 2, 5, 2, 'Sales', 41, '{\"price\":\"45\",\"qty\":\"5\"}', 'Stock out from Sales-61133655\n', '2021-09-18 14:35:22'),
(76, 1, 2, 2, 'Sales', 42, '{\"price\":\"450\",\"qty\":\"2\"}', 'Stock out from Sales-96694959\n', '2021-09-18 14:54:09'),
(77, 2, 2, 2, 'Sales', 43, '{\"price\":\"45\",\"qty\":\"2\"}', 'Stock out from Sales-62863060\n', '2021-09-18 14:57:11'),
(78, 2, 1, 2, 'Sales', 44, '{\"price\":\"45\",\"qty\":\"1\"}', 'Stock out from Sales-23655483\n', '2021-09-18 14:58:49'),
(79, 2, 1, 2, 'Sales', 45, '{\"price\":\"45\",\"qty\":\"1\"}', 'Stock out from Sales-16492108\n', '2021-09-18 15:01:47'),
(80, 2, 1, 2, 'Sales', 46, '{\"price\":\"45\",\"qty\":\"1\"}', 'Stock out from Sales-28004499\n', '2021-09-18 15:03:04'),
(81, 1, 1, 2, 'Sales', 47, '{\"price\":\"450\",\"qty\":\"1\"}', 'Stock out from Sales-17758852\n', '2021-09-18 15:04:28'),
(82, 2, 2, 2, 'Sales', 48, '{\"price\":\"45\",\"qty\":\"2\"}', 'Stock out from Sales-39721967\n', '2021-09-18 15:06:25'),
(83, 1, 1, 2, 'Sales', 49, '{\"price\":\"450\",\"qty\":\"1\"}', 'Stock out from Sales-94095896\n', '2021-09-18 15:07:05'),
(84, 1, 2, 2, 'Sales', 50, '{\"price\":\"450\",\"qty\":\"2\"}', 'Stock out from Sales-47491165\n', '2021-09-18 15:08:23'),
(85, 2, 3, 2, 'Sales', 51, '{\"price\":\"45\",\"qty\":\"3\"}', 'Stock out from Sales-51863986\n', '2021-09-18 15:09:11'),
(86, 1, 1, 2, 'Sales', 52, '{\"price\":\"450\",\"qty\":\"1\"}', 'Stock out from Sales-56703645\n', '2021-09-18 15:10:23'),
(87, 2, 3, 2, 'Sales', 52, '{\"price\":\"45\",\"qty\":\"3\"}', 'Stock out from Sales-56703645\n', '2021-09-18 15:10:23'),
(88, 6, 2, 2, 'Sales', 52, '{\"price\":\"5000\",\"qty\":\"2\"}', 'Stock out from Sales-56703645\n', '2021-09-18 15:10:23'),
(89, 3, 1, 2, 'Sales', 52, '{\"price\":\"50\",\"qty\":\"1\"}', 'Stock out from Sales-56703645\n', '2021-09-18 15:10:23'),
(90, 4, 2, 2, 'Sales', 52, '{\"price\":\"65\",\"qty\":\"2\"}', 'Stock out from Sales-56703645\n', '2021-09-18 15:10:23'),
(91, 5, 1, 2, 'Sales', 52, '{\"price\":\"1200\",\"qty\":\"1\"}', 'Stock out from Sales-56703645\n', '2021-09-18 15:10:23'),
(92, 7, 3, 2, 'Sales', 52, '{\"price\":\"75\",\"qty\":\"3\"}', 'Stock out from Sales-56703645\n', '2021-09-18 15:10:23'),
(93, 1, 1, 2, 'Sales', 53, '{\"price\":\"450\",\"qty\":\"1\"}', 'Stock out from Sales-24282649\n', '2021-09-18 15:16:35'),
(94, 2, 1, 2, 'Sales', 54, '{\"price\":\"45\",\"qty\":\"1\"}', 'Stock out from Sales-98195107\n', '2021-09-18 15:19:25');

-- --------------------------------------------------------

--
-- Table structure for table `product_list`
--

CREATE TABLE `product_list` (
  `id` int(30) NOT NULL,
  `category_id` int(30) NOT NULL,
  `hsn_code` varchar(50) NOT NULL,
  `price` double NOT NULL,
  `name` varchar(150) NOT NULL,
  `gst` int(30) NOT NULL,
  `unit` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_list`
--

INSERT INTO `product_list` (`id`, `category_id`, `hsn_code`, `price`, `name`, `gst`, `unit`) VALUES
(1, 1, '123', 450, 'Led Havells10w ', 5, 8),
(2, 3, '456', 45, 'Nail1', 3, 1),
(3, 4, '458', 50, 'pvc', 5, 2),
(4, 2, '258', 65, 'Screw', 3, 1),
(5, 6, '741', 1200, 'Tank', 28, 8),
(6, 5, '639', 5000, 'Onfnbb', 6, 10),
(7, 8, '153790', 75, 'Tupperware', 3, 8);

-- --------------------------------------------------------

--
-- Table structure for table `receiving_list`
--

CREATE TABLE `receiving_list` (
  `id` int(30) NOT NULL,
  `ref_no` varchar(100) NOT NULL,
  `supplier_id` int(30) NOT NULL,
  `total_amount` double NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `receiving_list`
--

INSERT INTO `receiving_list` (`id`, `ref_no`, `supplier_id`, `total_amount`, `date_added`) VALUES
(1, '00000000\n', 1, 138910, '2021-09-18 10:46:36');

-- --------------------------------------------------------

--
-- Table structure for table `sales_list`
--

CREATE TABLE `sales_list` (
  `id` int(30) NOT NULL,
  `ref_no` varchar(30) NOT NULL,
  `customer_id` int(30) NOT NULL,
  `total_amount` double NOT NULL,
  `amount_tendered` double NOT NULL,
  `amount_change` double NOT NULL,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_list`
--

INSERT INTO `sales_list` (`id`, `ref_no`, `customer_id`, `total_amount`, `amount_tendered`, `amount_change`, `date_updated`) VALUES
(1, '00000000\n', 1, 5690, 0, 0, '2021-09-18 10:50:32'),
(2, '72596390\n', 1, 5670, 0, 0, '2021-09-18 10:53:13'),
(3, '99700787\n', 0, 450, 0, 0, '2021-09-18 10:55:15'),
(4, '42629822\n', 0, 10000, 0, 0, '2021-09-18 10:56:15'),
(5, '27616544\n', 0, 100, 0, 0, '2021-09-18 10:57:02'),
(6, '53599794\n', 0, 195, 0, 0, '2021-09-18 10:57:37'),
(7, '33857074\n', 0, 50, 0, 0, '2021-09-18 10:58:28'),
(8, '82274199\n', 0, 100, 0, 0, '2021-09-18 11:00:28'),
(9, '06903957\n', 0, 90, 0, 0, '2021-09-18 11:03:19'),
(10, '78559918\n', 0, 90, 0, 0, '2021-09-18 11:04:13'),
(11, '35778015\n', 0, 45, 0, 0, '2021-09-18 11:05:51'),
(12, '48500265\n', 0, 135, 0, 0, '2021-09-18 11:06:43'),
(13, '49556353\n', 0, 90, 0, 0, '2021-09-18 11:07:45'),
(14, '99287721\n', 0, 180, 0, 0, '2021-09-18 11:08:48'),
(15, '66364540\n', 0, 90, 0, 0, '2021-09-18 11:09:49'),
(16, '97698376\n', 0, 5000, 0, 0, '2021-09-18 11:10:20'),
(17, '10392198\n', 0, 45, 0, 0, '2021-09-18 11:12:12'),
(18, '81300546\n', 0, 45, 0, 0, '2021-09-18 11:13:01'),
(19, '57884815\n', 0, 5000, 0, 0, '2021-09-18 11:14:16'),
(20, '91784961\n', 0, 45, 0, 0, '2021-09-18 11:15:10'),
(21, '32653139\n', 0, 45, 0, 0, '2021-09-18 11:16:49'),
(22, '97631243\n', 0, 1045, 0, 0, '2021-09-18 11:18:13'),
(23, '06399412\n', 0, 540, 0, 0, '2021-09-18 11:18:55'),
(24, '73869897\n', 0, 640, 0, 0, '2021-09-18 11:19:43'),
(25, '97436565\n', 0, 5990, 0, 0, '2021-09-18 11:20:31'),
(26, '92313552\n', 0, 45, 0, 0, '2021-09-18 11:21:35'),
(27, '59431990\n', 0, 45, 0, 0, '2021-09-18 11:22:58'),
(28, '22282864\n', 0, 900, 0, 0, '2021-09-18 11:26:20'),
(29, '15614469\n', 0, 5045, 0, 0, '2021-09-18 11:28:25'),
(30, '11743877\n', 0, 900, 0, 0, '2021-09-18 11:29:40'),
(31, '92623239\n', 0, 540, 0, 0, '2021-09-18 11:35:34'),
(32, '61914847\n', 0, 540, 0, 0, '2021-09-18 11:36:20'),
(33, '18857111\n', 0, 495, 0, 0, '2021-09-18 11:37:13'),
(34, '90210995\n', 0, 540, 0, 0, '2021-09-18 11:38:00'),
(35, '86866259\n', 0, 7070, 0, 0, '2021-09-18 11:39:41'),
(36, '70383735\n', 0, 45, 0, 0, '2021-09-18 11:41:45'),
(37, '55847253\n', 0, 15540, 0, 0, '2021-09-18 11:51:28'),
(38, '78516457\n', 0, 450, 0, 0, '2021-09-18 11:53:08'),
(39, '48743898\n', 0, 945, 0, 0, '2021-09-18 11:54:40'),
(40, '25324243\n', 1, 5000, 0, 0, '2021-09-18 14:20:23'),
(41, '61133655\n', 0, 225, 0, 0, '2021-09-18 14:35:22'),
(42, '96694959\n', 0, 900, 0, 0, '2021-09-18 14:54:09'),
(43, '62863060\n', 0, 90, 0, 0, '2021-09-18 14:57:11'),
(44, '23655483\n', 0, 45, 0, 0, '2021-09-18 14:58:49'),
(45, '16492108\n', 0, 45, 0, 0, '2021-09-18 15:01:47'),
(46, '28004499\n', 0, 45, 0, 0, '2021-09-18 15:03:04'),
(47, '17758852\n', 0, 450, 0, 0, '2021-09-18 15:04:28'),
(48, '39721967\n', 0, 90, 0, 0, '2021-09-18 15:06:25'),
(49, '94095896\n', 0, 450, 0, 0, '2021-09-18 15:07:05'),
(50, '47491165\n', 0, 900, 0, 0, '2021-09-18 15:08:23'),
(51, '51863986\n', 0, 135, 0, 0, '2021-09-18 15:09:11'),
(52, '56703645\n', 1, 12190, 0, 0, '2021-09-18 15:10:23'),
(53, '24282649\n', 0, 450, 0, 0, '2021-09-18 15:16:35'),
(54, '98195107\n', 0, 45, 0, 0, '2021-09-18 15:19:25');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_list`
--

CREATE TABLE `supplier_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `contactno` varchar(30) NOT NULL,
  `address1` text NOT NULL,
  `shopname` varchar(200) NOT NULL,
  `address2` text NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(50) NOT NULL,
  `gstin` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier_list`
--

INSERT INTO `supplier_list` (`id`, `name`, `contactno`, `address1`, `shopname`, `address2`, `city`, `state`, `gstin`) VALUES
(1, 'Suresh', '61881112333', '564', 'Iconx Hardwares', 'ghhhhtn', 'tirunelveli', 'tamilnadu', '33fgguhgunb'),
(2, 'Thirupathy', '88821151111', 'jdbhnunbu', 'Hhnyj', 'bnubun', 'thoothukudi', 'tn', '21518551'),
(3, 'Nnnn', '8461651518241', 'ngnnn', 'Nnhh', 'nnhmtrthngbg', 'nagercoil', 'tn', '335448541211');

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `cover_img` text NOT NULL,
  `about_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `name`, `email`, `contact`, `cover_img`, `about_content`) VALUES
(1, 'Sample', 'info@sample.com', '8124399880', '1600654680_photo-1504674900247-0877df9cc836.jpg', '&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;span style=&quot;font-size:28px;background: transparent; position: relative;&quot;&gt;ABOUT US&lt;/span&gt;&lt;/b&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;span style=&quot;background: transparent; position: relative; font-size: 14px;&quot;&gt;&lt;span style=&quot;font-size:28px;background: transparent; position: relative;&quot;&gt;&lt;b style=&quot;margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; text-align: justify;&quot;&gt;Lorem Ipsum&lt;/b&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-weight: 400; text-align: justify;&quot;&gt;&amp;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&amp;#x2019;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/span&gt;&lt;br&gt;&lt;/span&gt;&lt;/b&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;span style=&quot;background: transparent; position: relative; font-size: 14px;&quot;&gt;&lt;span style=&quot;font-size:28px;background: transparent; position: relative;&quot;&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-weight: 400; text-align: justify;&quot;&gt;&lt;br&gt;&lt;/span&gt;&lt;/b&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;span style=&quot;background: transparent; position: relative; font-size: 14px;&quot;&gt;&lt;span style=&quot;font-size:28px;background: transparent; position: relative;&quot;&gt;&lt;h2 style=&quot;font-size:28px;background: transparent; position: relative;&quot;&gt;Where does it come from?&lt;/h2&gt;&lt;p style=&quot;text-align: center; margin-bottom: 15px; padding: 0px; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-weight: 400;&quot;&gt;Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.&lt;/p&gt;&lt;/span&gt;&lt;/b&gt;&lt;/span&gt;&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `unit_list`
--

CREATE TABLE `unit_list` (
  `id` int(30) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `unit_list`
--

INSERT INTO `unit_list` (`id`, `name`) VALUES
(1, 'kgs'),
(2, 'meter'),
(3, 'pack'),
(4, 'dozen'),
(5, 'cm'),
(6, 'mm'),
(7, 'ltr'),
(8, 'pcs'),
(9, 'pack'),
(10, 'item');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `name` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1=admin , 2 = cashier'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `type`) VALUES
(1, 'Administrator', 'admin', '123', 1),
(3, 'Suresh', 'suresh', '123', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category_list`
--
ALTER TABLE `category_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_list`
--
ALTER TABLE `customer_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_list`
--
ALTER TABLE `product_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receiving_list`
--
ALTER TABLE `receiving_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_list`
--
ALTER TABLE `sales_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier_list`
--
ALTER TABLE `supplier_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit_list`
--
ALTER TABLE `unit_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category_list`
--
ALTER TABLE `category_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customer_list`
--
ALTER TABLE `customer_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `product_list`
--
ALTER TABLE `product_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `receiving_list`
--
ALTER TABLE `receiving_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales_list`
--
ALTER TABLE `sales_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `supplier_list`
--
ALTER TABLE `supplier_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `unit_list`
--
ALTER TABLE `unit_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
