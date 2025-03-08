-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2025 at 04:20 AM
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
-- Database: `fastgamingv2`
--

-- --------------------------------------------------------

--
-- Table structure for table `antrian_proses`
--

CREATE TABLE `antrian_proses` (
  `no` int(11) NOT NULL,
  `order_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `auth_activation_attempts`
--

INSERT INTO `auth_activation_attempts` (`id`, `ip_address`, `user_agent`, `token`, `created_at`) VALUES
(1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', 'be9b4b1f362c40cbf612bba857a77ea1', '2022-07-13 22:30:24'),
(2, '180.244.160.193', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '0455b996ca6749d337c172150f95afc6', '2022-07-31 23:41:58'),
(3, '103.81.195.202', 'Mozilla/5.0 (Linux; Android 10; RMX1911) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Mobile Safari/537.36', '8e8e3544fa2dd44d50d52a46f5c10d83', '2022-08-02 03:11:21'),
(4, '180.244.160.193', 'Mozilla/5.0 (Linux; Android 12; M2007J3SY) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.0.0 Mobile Safari/537.36', '7de4d68da18cafc1fd14299e4f51a20f', '2022-08-02 04:11:53'),
(5, '114.4.4.196', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '7de4d68da18cafc1fd14299e4f51a20f', '2022-08-02 07:54:40'),
(6, '103.111.102.53', 'Mozilla/5.0 (Linux; Android 11; RMX3263) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Mobile Safari/537.36', '49e904dacc6907d3106c0d4c758266f4', '2022-08-02 08:53:26'),
(7, '111.94.79.137', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '901901ab69ae80d02a3fb3b0d7e9f2f7', '2022-08-02 11:10:53'),
(8, '114.4.4.135', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '901901ab69ae80d02a3fb3b0d7e9f2f7', '2022-08-02 15:14:48');

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Site Administrator'),
(2, 'user', 'Regular user');

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `auth_groups_permissions`
--

INSERT INTO `auth_groups_permissions` (`group_id`, `permission_id`) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`group_id`, `user_id`) VALUES
(1, 7),
(1, 19),
(2, 14),
(2, 15),
(2, 16),
(2, 17),
(2, 18),
(2, 20);

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'oakwoak@gmail.coakwoa', 5, '2022-03-19 20:12:12', 1),
(2, '::1', 'oakwoak@gmail.coakwoa', NULL, '2022-03-19 20:12:30', 0),
(3, '::1', 'oakwoak@gmail.coakwoa', 5, '2022-03-19 20:28:01', 1),
(4, '::1', 'oakwoak@gmail.coakwoa', 5, '2022-03-19 20:36:17', 1),
(5, '::1', 'oakwoak@gmail.coakwoa', 5, '2022-03-19 20:55:07', 1),
(6, '::1', 'oakwoak@gmail.coakwoa', 5, '2022-03-19 20:59:04', 1),
(7, '::1', 'oakwoak@gmail.coakwoa', 5, '2022-03-19 20:59:48', 1),
(8, '::1', 'pooyutreari@gmail.com', 6, '2022-03-19 21:06:32', 1),
(9, '::1', 'admin@fastgamingstore.com', 7, '2022-03-19 21:54:01', 1),
(10, '::1', 'userfast@fastgamingstore.com', 9, '2022-03-19 21:55:26', 1),
(11, '::1', 'userfast@fastgamingstore.com', 9, '2022-03-19 22:07:48', 1),
(12, '::1', 'admin@fastgamingstore.com', 7, '2022-03-19 22:12:36', 1),
(13, '::1', 'admin@fastgamingstore.com', 7, '2022-03-22 21:53:40', 1),
(14, '::1', 'admin@fastgamingstore.com', 7, '2022-03-23 21:18:23', 1),
(15, '::1', 'admin@fastgamingstore.com', 7, '2022-03-24 08:24:22', 1),
(16, '::1', 'fastadmin', NULL, '2022-03-24 09:13:37', 0),
(17, '::1', 'admin@fastgamingstore.com', 7, '2022-03-24 09:13:43', 1),
(18, '::1', 'admin@fastgamingstore.com', 7, '2022-03-25 04:48:46', 1),
(19, '::1', 'admin@fastgamingstore.com', 7, '2022-03-25 19:41:21', 1),
(20, '::1', 'fastadmin', NULL, '2022-03-25 09:40:13', 0),
(21, '::1', 'admin@fastgamingstore.com', 7, '2022-03-25 09:40:23', 1),
(22, '::1', 'admin@fastgamingstore.com', 7, '2022-03-29 22:37:59', 1),
(23, '::1', 'admin@fastgamingstore.com', 7, '2022-04-01 04:41:51', 1),
(24, '::1', 'admin@fastgamingstore.com', 7, '2022-04-03 01:32:30', 1),
(25, '::1', 'admin@fastgamingstore.com', 7, '2022-04-04 00:09:53', 1),
(26, '::1', 'admin@fastgamingstore.com', 7, '2022-04-04 01:43:14', 1),
(27, '::1', 'admin@fastgamingstore.com', 7, '2022-04-04 21:04:43', 1),
(28, '::1', 'admin@fastgamingstore.com', 7, '2022-04-04 23:30:59', 1),
(29, '::1', 'admin@fastgamingstore.com', 7, '2022-04-14 08:51:54', 1),
(30, '::1', 'admin@fastgamingstore.com', 7, '2022-04-14 09:29:45', 1),
(31, '::1', 'admin@fastgamingstore.com', 7, '2022-04-21 04:31:16', 1),
(32, '::1', 'admin@fastgamingstore.com', 7, '2022-04-21 07:59:11', 1),
(33, '::1', 'admin@fastgamingstore.com', 7, '2022-04-21 08:54:43', 1),
(34, '::1', 'admin@fastgamingstore.com', 7, '2022-04-21 09:04:03', 1),
(35, '::1', 'admin@fastgamingstore.com', 7, '2022-04-21 20:56:35', 1),
(36, '::1', 'admin@fastgamingstore.com', 7, '2022-04-22 19:31:58', 1),
(37, '::1', 'admin@fastgamingstore.com', 7, '2022-04-23 22:32:18', 1),
(38, '::1', 'fastadmin', NULL, '2022-05-07 01:31:12', 0),
(39, '::1', 'admin@fastgamingstore.com', 7, '2022-05-07 01:31:17', 1),
(40, '::1', 'admin@fastgamingstore.com', 7, '2022-05-07 01:45:51', 1),
(41, '::1', 'admin@fastgamingstore.com', 7, '2022-05-15 22:55:36', 1),
(42, '::1', 'admin@fastgamingstore.com', 7, '2022-05-17 21:19:14', 1),
(43, '::1', 'admin@fastgamingstore.com', 7, '2022-05-18 21:49:46', 1),
(44, '::1', 'admin@fastgamingstore.com', 7, '2022-05-23 09:26:27', 1),
(45, '::1', 'admin@fastgamingstore.com', 7, '2022-05-22 21:27:33', 1),
(46, '::1', 'admin@fastgamingstore.com', 7, '2022-05-22 22:46:03', 1),
(47, '::1', 'admin@fastgamingstore.com', 7, '2022-05-24 08:31:27', 1),
(48, '::1', 'admin@fastgamingstore.com', 7, '2022-05-25 10:15:15', 1),
(49, '::1', 'admin@fastgamingstore.com', 7, '2022-05-24 23:56:46', 1),
(50, '::1', 'admin@fastgamingstore.com', 7, '2022-05-26 10:53:14', 1),
(51, '::1', 'admin@fastgamingstore.com', 7, '2022-05-25 23:13:52', 1),
(52, '::1', 'admin@fastgamingstore.com', 7, '2022-05-26 20:42:16', 1),
(53, '::1', 'admin@fastgamingstore.com', 7, '2022-05-28 09:22:09', 1),
(54, '::1', 'admin@fastgamingstore.com', 7, '2022-05-28 16:38:34', 1),
(55, '::1', 'admin@fastgamingstore.com', 7, '2022-05-29 10:17:28', 1),
(56, '::1', 'admin@fastgamingstore.com', 7, '2022-05-28 23:40:30', 1),
(57, '::1', 'admin@fastgamingstore.com', 7, '2022-05-29 22:01:56', 1),
(58, '::1', 'admin@fastgamingstore.com', 7, '2022-05-30 20:58:54', 1),
(59, '::1', 'admin@fastgamingstore.com', 7, '2022-05-30 21:42:26', 1),
(60, '::1', 'userfast@fastgamingstore.com', 9, '2022-05-30 22:00:47', 1),
(61, '::1', 'admin@fastgamingstore.com', 7, '2022-05-30 22:23:43', 1),
(62, '::1', 'userfast@fastgamingstore.com', 9, '2022-05-30 22:31:49', 1),
(63, '::1', 'admin@fastgamingstore.com', 7, '2022-05-30 22:40:46', 1),
(64, '::1', 'admin@fastgamingstore.com', 7, '2022-06-02 00:50:35', 1),
(65, '::1', 'admin@fastgamingstore.com', 7, '2022-06-02 20:09:33', 1),
(66, '::1', 'admin@fastgamingstore.com', 7, '2022-06-03 09:52:38', 1),
(67, '::1', 'userfast@fastgamingstore.com', 9, '2022-06-02 23:36:13', 1),
(68, '::1', 'adminfast', NULL, '2022-06-02 23:37:24', 0),
(69, '::1', 'admin@fastgamingstore.com', 7, '2022-06-02 23:37:31', 1),
(70, '::1', 'admin@fastgamingstore.com', 7, '2022-06-03 20:40:25', 1),
(71, '::1', 'admin@fastgamingstore.com', 7, '2022-06-04 22:17:04', 1),
(72, '::1', 'admin@fastgamingstore.com', 7, '2022-06-06 21:42:56', 1),
(73, '::1', 'admin@fastgamingstore.com', 7, '2022-06-08 09:07:32', 1),
(74, '::1', 'admin@fastgamingstore.com', 7, '2022-06-09 08:39:33', 1),
(75, '::1', 'admin@fastgamingstore.com', 7, '2022-06-09 20:29:58', 1),
(76, '::1', 'admin@fastgamingstore.com', 7, '2022-06-11 09:34:15', 1),
(77, '::1', 'admin@fastgamingstore.com', 7, '2022-06-12 09:50:52', 1),
(78, '::1', 'admin@fastgamingstore.com', 7, '2022-06-12 19:37:06', 1),
(79, '::1', 'admin@fastgamingstore.com', 7, '2022-06-13 08:46:56', 1),
(80, '::1', 'admin@fastgamingstore.com', 7, '2022-06-14 09:54:45', 1),
(81, '::1', 'admin@fastgamingstore.com', 7, '2022-06-15 09:39:47', 1),
(82, '::1', 'admin@fastgamingstore.com', 7, '2022-06-16 09:32:05', 1),
(83, '::1', 'admin@fastgamingstore.com', 7, '2022-06-16 18:24:22', 1),
(84, '::1', 'admin@fastgamingstore.com', 7, '2022-06-18 21:27:24', 1),
(85, '::1', 'admin@fastgamingstore.com', 7, '2022-06-20 08:30:24', 1),
(86, '::1', 'admin@fastgamingstore.com', 7, '2022-06-23 07:59:55', 1),
(87, '::1', 'admin@fastgamingstore.com', 7, '2022-06-23 08:28:15', 1),
(88, '::1', 'admin@fastgamingstore.com', 7, '2022-06-24 10:22:24', 1),
(89, '::1', 'admin@fastgamingstore.com', 7, '2022-06-25 08:18:09', 1),
(90, '::1', 'admin@fastgamingstore.com', 7, '2022-07-05 09:43:47', 1),
(91, '::1', 'fastadmin', NULL, '2022-07-04 22:58:44', 0),
(92, '::1', 'admin@fastgamingstore.com', 7, '2022-07-04 22:58:49', 1),
(93, '::1', 'admin@fastgamingstore.com', 7, '2022-07-04 22:59:04', 1),
(94, '::1', 'userfast@fastgamingstore.com', 9, '2022-07-04 22:59:33', 1),
(95, '::1', 'admin@fastgamingstore.com', 7, '2022-07-04 23:02:56', 1),
(96, '::1', 'admin@fastgamingstore.com', 7, '2022-07-05 19:02:11', 1),
(97, '::1', 'admin@fastgamingstore.com', 7, '2022-07-05 07:24:54', 1),
(98, '::1', 'admin@fastgamingstore.com', 7, '2022-07-05 21:28:53', 1),
(99, '::1', 'admin@fastgamingstore.com', 7, '2022-07-07 09:50:57', 1),
(100, '::1', 'admin@fastgamingstore.com', 7, '2022-07-08 08:28:22', 1),
(101, '::1', 'admin@fastgamingstore.com', 7, '2022-07-07 20:28:58', 1),
(102, '::1', 'admin@fastgamingstore.com', 7, '2022-07-08 01:08:30', 1),
(103, '::1', 'admin@fastgamingstore.com', 7, '2022-07-08 19:39:02', 1),
(104, '::1', 'admin@fastgamingstore.com', 7, '2022-07-09 10:22:13', 1),
(105, '::1', 'admin@fastgamingstore.com', 7, '2022-07-11 08:58:02', 1),
(106, '::1', 'fastadmin', NULL, '2022-07-11 05:08:15', 0),
(107, '::1', 'admin@fastgamingstore.com', 7, '2022-07-11 05:08:20', 1),
(108, '::1', 'admin@fastgamingstore.com', 7, '2022-07-12 09:39:23', 1),
(109, '::1', 'admin@fastgamingstore.com', 7, '2022-07-12 16:25:24', 1),
(110, '::1', 'admin@fastgamingstore.com', 7, '2022-07-13 10:01:58', 1),
(111, '::1', 'user', NULL, '2022-07-12 22:03:53', 0),
(112, '::1', 'userfast', NULL, '2022-07-12 22:04:02', 0),
(113, '::1', 'userfast@fastgamingstore.com', 9, '2022-07-12 22:04:10', 1),
(114, '::1', 'adminfast', NULL, '2022-07-12 22:05:16', 0),
(115, '::1', 'userfast@fastgamingstore.com', 9, '2022-07-12 22:05:16', 1),
(116, '::1', 'fastadmin', NULL, '2022-07-12 22:05:38', 0),
(117, '::1', 'admin@fastgamingstore.com', 7, '2022-07-12 22:06:00', 1),
(118, '::1', 'admin@fastgamingstore.com', 7, '2022-07-12 22:06:06', 1),
(119, '::1', 'userfast@fastgamingstore.com', 9, '2022-07-12 22:06:28', 1),
(120, '::1', 'userfast@fastgamingstore.com', 9, '2022-07-12 23:15:32', 1),
(121, '::1', 'userfast@gmail.com', 10, '2022-07-13 02:07:46', 1),
(122, '::1', 'userfast@gmail.com', 11, '2022-07-13 02:09:52', 1),
(123, '::1', 'userfast', NULL, '2022-07-13 02:13:51', 0),
(124, '::1', 'userfast@gmail.com', 12, '2022-07-13 02:14:57', 1),
(125, '::1', 'userfast@gmail.com', 12, '2022-07-13 02:16:55', 1),
(126, '::1', 'fguser01', 13, '2022-07-13 22:00:51', 0),
(127, '::1', 'fguser01', 13, '2022-07-13 22:14:24', 0),
(128, '::1', 'fguser01', 13, '2022-07-13 22:29:51', 0),
(129, '::1', 'mail.fastgamingstore@gmail.com', 13, '2022-07-13 22:35:17', 1),
(130, '::1', 'mail.fastgamingstore@gmail.com', 13, '2022-07-13 23:08:21', 1),
(131, '180.244.164.148', 'adminfast', NULL, '2022-07-15 03:10:29', 0),
(132, '180.244.164.148', 'fastadmin', NULL, '2022-07-15 03:10:36', 0),
(133, '180.244.164.148', 'admin@fastgamingstore.com', 7, '2022-07-15 03:11:51', 1),
(134, '180.244.164.148', 'admin@fastgamingstore.com', 7, '2022-07-15 03:12:35', 1),
(135, '180.244.164.148', 'fastadmin', NULL, '2022-07-15 03:34:26', 0),
(136, '180.244.164.148', 'admin@fastgamingstore.com', 7, '2022-07-15 03:34:40', 1),
(137, '180.244.164.148', 'fastadmin', NULL, '2022-07-15 22:58:13', 0),
(138, '180.244.164.148', 'admin@fastgamingstore.com', 7, '2022-07-15 22:58:18', 1),
(139, '180.244.164.148', 'admin@fastgamingstore.com', 7, '2022-07-17 07:28:45', 1),
(140, '180.244.164.148', 'admin@fastgamingstore.com', 7, '2022-07-18 13:24:09', 1),
(141, '8.25.96.9', 'fastadmin', NULL, '2022-07-20 08:23:51', 0),
(142, '8.25.96.9', 'admin@fastgamingstore.com', 7, '2022-07-20 08:23:57', 1),
(143, '8.30.234.23', 'fastadmin', NULL, '2022-07-26 02:00:01', 0),
(144, '8.30.234.23', 'admin@fastgamingstore.com', 7, '2022-07-26 02:00:09', 1),
(145, '125.160.131.148', 'admin@fastgamingstore.com', 7, '2022-07-26 07:48:21', 1),
(146, '180.244.161.7', 'adminfast', NULL, '2022-07-29 23:11:36', 0),
(147, '180.244.161.7', 'admin@fastgamingstore.com', 7, '2022-07-29 23:11:41', 1),
(148, '180.244.160.193', 'admin@fastgamingstore.com', 7, '2022-07-31 22:04:39', 1),
(149, '180.244.160.193', 'mail.fastgamingstore@gmail.com', 14, '2022-07-31 23:42:11', 1),
(150, '180.244.160.193', 'admin@fastgamingstore.com', 7, '2022-08-01 08:04:03', 1),
(151, '180.244.160.193', 'admin@fastgamingstore.com', 7, '2022-08-01 09:31:43', 1),
(152, '180.244.160.193', 'admin@fastgamingstore.com', 7, '2022-08-02 05:41:36', 1),
(153, '180.244.160.193', 'admin@fastgamingstore.com', 7, '2022-08-02 05:42:01', 1),
(154, '103.81.195.202', 'naswanasifah08@gmail.com', 15, '2022-08-02 03:10:10', 0),
(155, '103.81.195.202', 'naswanasifah08@gmail.com', 15, '2022-08-02 03:12:00', 1),
(156, '180.244.160.193', 'admin@fastgamingstore.com', 7, '2022-08-02 15:58:59', 1),
(157, '180.244.160.193', 'admin@fastgamingstore.com', 7, '2022-08-02 03:59:03', 1),
(158, '118.99.124.120', 'admin', NULL, '2022-08-02 04:03:43', 0),
(159, '114.79.2.95', 'dlillynx@gmail.com', 16, '2022-08-02 04:12:25', 1),
(160, '103.111.102.53', 'Farhan Bayu', 17, '2022-08-02 08:52:30', 0),
(161, '103.111.102.53', 'Farhan Bayu', 17, '2022-08-02 08:52:49', 0),
(162, '103.111.102.53', 'Farhan Bayu', 17, '2022-08-02 08:53:10', 0),
(163, '103.111.102.53', 'farhanbayu002@gmail.com', 17, '2022-08-02 08:53:32', 1),
(164, '111.94.79.137', 'tutupbotol', 18, '2022-08-02 11:10:32', 0),
(165, '111.94.79.137', 'aanidyanovita12@gmail.com', 18, '2022-08-02 11:10:55', 1),
(166, '180.252.114.170', 'adminfast', NULL, '2022-08-09 17:16:33', 0),
(167, '180.252.114.170', 'admin@fastgamingstore.com', 7, '2022-08-09 17:16:44', 1),
(168, '::1', 'admin@admin.com', 19, '2025-03-07 20:24:44', 1),
(169, '::1', 'admin@admin.com', 19, '2025-03-07 20:45:21', 1),
(170, '::1', 'user@user.com', 20, '2025-03-07 21:12:28', 1),
(171, '::1', 'admin@admin.com', 19, '2025-03-07 21:17:18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `auth_permissions`
--

INSERT INTO `auth_permissions` (`id`, `name`, `description`) VALUES
(1, 'manage-site', 'Manage all site'),
(2, 'manage-profile', 'Manage user\'s profile');

-- --------------------------------------------------------

--
-- Table structure for table `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `auth_reset_attempts`
--

INSERT INTO `auth_reset_attempts` (`id`, `email`, `ip_address`, `user_agent`, `token`, `created_at`) VALUES
(1, 'mail.fastgamingstore@gmail.com', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', 'b00e3be79bf683979c8ecdf939cc042e', '2022-07-13 22:34:35'),
(2, 'mail.fastgamingstore@gmail.com', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', 'b00e3be79bf683979c8ecdf939cc042e', '2022-07-13 22:34:51'),
(3, 'mail.fastgamingstore@gmail.com', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', 'b00e3be79bf683979c8ecdf939cc042e', '2022-07-13 22:35:05'),
(4, 'mail.fastgamingstore@gmail.com', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', 'c25c4a4958f4a2ab0c0e442329c27b77', '2022-07-13 23:08:13'),
(5, 'aanidyanovita12@gmail.com', '111.94.79.137', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '', '2022-08-02 11:12:06'),
(6, 'aanidyanovita12@gmail.com', '111.94.79.137', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '12', '2022-08-02 11:12:10');

-- --------------------------------------------------------

--
-- Table structure for table `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `auth_tokens`
--

INSERT INTO `auth_tokens` (`id`, `selector`, `hashedValidator`, `user_id`, `expires`) VALUES
(35, '49423c2a0aa49259bfa12439', 'ecf1ba08e340cda6ce2fb1a9033bbdee62b858f3e8f5d11ef5e03b9ab621244c', 7, '2022-08-03 03:59:03'),
(36, '394d7e4cbfbb5784b3f59cc7', 'cc838c0bbce840f54e9c1fb25d19140355b0ea75b9bd8ff8929a596739024e68', 15, '2022-08-03 03:12:00'),
(37, '4c48cb37701e1ba7cc511206', '8eab16aeeb2f5da39e87bb28fc10435752849754bb990b0503080dc62b683079', 17, '2022-08-03 08:53:32'),
(38, '02cc1ae7a298481bdc610be8', '46d7f5ae793c4a25870f00aadb7c217b2e9c68d8844a0b7de38e773b83390d91', 7, '2022-08-10 17:16:44'),
(39, 'b717c994aac2fadb67e038e4', '082374b6cc206147fdee7bbf7cf697eb1464edb0523b8ba27190b4efd5bc2190', 19, '2025-04-06 21:24:44'),
(40, '6be5db3955fbf505988b1e80', 'ec186f6a64b07918d65b0e069d39bedb3c139f994079eb224f838185594af2aa', 19, '2025-04-06 21:45:21'),
(41, '380a56176f95a14e69745fad', 'acc7090a3f0f852abf7c913c0ba7f587daffc89bd1bd0575fa4495c89af705bf', 20, '2025-04-06 22:12:29');

-- --------------------------------------------------------

--
-- Table structure for table `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `daftar_game`
--

CREATE TABLE `daftar_game` (
  `urutan` int(16) NOT NULL,
  `kode_game` varchar(64) NOT NULL,
  `nama_game` varchar(64) NOT NULL,
  `slug` varchar(64) NOT NULL,
  `ikon_matauang` varchar(255) NOT NULL,
  `ikon_game` varchar(255) NOT NULL,
  `cari_id` varchar(255) NOT NULL,
  `status` set('enabled','disabled') NOT NULL DEFAULT 'enabled',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daftar_game`
--

INSERT INTO `daftar_game` (`urutan`, `kode_game`, `nama_game`, `slug`, `ikon_matauang`, `ikon_game`, `cari_id`, `status`, `created_at`, `updated_at`) VALUES
(27, '3', 'Kouta 3', 'kouta_3', 'hLvrwGooNRCoXm7l0WBbWf3cWaPnjZZ48ZPADNciiu9Ct9Z7PoT46LQVSuQJ0HWt.png', '1645176930_799b1fb080c6f7776f6d.jpg', '1641894281_e5570451640282adce75.jpg', 'enabled', '2022-02-17 22:17:47', '2022-02-18 03:36:17'),
(9, 'aov', 'Arena of  Valor', 'arena_of_valor', '1642741488_4a96210fb52bfde38c7d.png', '1642741357_f3ad15f63e834cb162a4.jpg', '1643882669_961bb476549f37299aa8.png', 'enabled', '2022-01-22 13:53:14', '2022-02-14 11:03:24'),
(22, 'bulletangel', 'Bullet Angel', 'bullet_angel', '1643780640_a16ecc8c8239c02cb338.png', '1643780569_9473ac611cd08121c642.jpg', '1641894281_e5570451640282adce75.jpg', 'disabled', '2022-02-01 23:47:25', '2022-02-01 23:47:25'),
(4, 'codm', 'Call of Duty', 'call_of_duty', '1642582428_50c02969cf04774c247b.png', '1642581640_c6d0f65d6b6de408ce91.jpg', '1643880283_da93dcff908916e4ab5c.png', 'enabled', '2022-01-19 02:47:29', '2022-02-11 23:14:36'),
(17, 'dra', 'Dragon Raja', 'dragon_raja', '1643622545_d8a06efed636340daea7.png', '1643622578_6c178d86c840d2d2b5ff.jpg', '1644863596_251c4650d54e3c4cce68.png', 'enabled', '2022-01-31 03:54:56', '2022-02-14 12:34:13'),
(2, 'ff', 'Free Fire', 'free_fire', 'hLvrwGooNRCoXm7l0WBbWf3cWaPnjZZ48ZPADNciiu9Ct9Z7PoT46LQVSuQJ0HWt.png', '1642650601_908f974d66ea47271475.jpg', '1641894281_e5570451640282adce75.jpg', 'enabled', '2022-01-12 23:04:17', '2022-02-05 07:58:00'),
(25, 'GarenaSpeed', 'Speed Drifters', 'speed_drifters', 'hLvrwGooNRCoXm7l0WBbWf3cWaPnjZZ48ZPADNciiu9Ct9Z7PoT46LQVSuQJ0HWt.png', '1643795814_985781a131ea514a22ee.jpg', '1641894281_e5570451640282adce75.jpg', 'disabled', '2022-02-02 03:59:59', '2022-02-02 03:59:59'),
(6, 'genshin', 'Genshin Impact', 'genshin_impact', '1642650750_149f490bb1c6c7d40398.png', '1642650450_c3efd91db88f7c43e5a3.jpg', '1643882558_4aad42d049d0121cbaaa.png', 'enabled', '2022-01-19 21:53:43', '2022-02-12 17:22:48'),
(12, 'honkai', 'Honkai Impact 3', 'honkai_impact_3', '1643136287_7c773554f44a9e649b87.png', '1643136342_be30a34a1bc6efdc7bc1.png', '1643880964_46f5db08e656c57200ff.png', 'enabled', '2022-01-25 12:46:43', '2022-02-14 11:23:25'),
(11, 'la', 'Life After', 'life_after', '1643090133_da85d2f7e946d571f16a.png', '1643091600_19db5b7699c6bd101561.jpg', '1643881111_2e6dd2967e33dc1585d9.png', 'enabled', '2022-01-25 00:23:04', '2022-02-14 11:09:46'),
(26, 'LordsMobile', 'Lords Mobile', 'lords_mobile', '1643796776_e34a7d0589ddf179f806.png', '1643796802_7fd4316af2e5bc20ccae.jpg', '1645156940_e620ede51493a783a9df.png', 'enabled', '2022-02-02 04:14:28', '2022-02-17 22:04:07'),
(21, 'ls', 'Lost Saga', 'lost_saga', 'hLvrwGooNRCoXm7l0WBbWf3cWaPnjZZ48ZPADNciiu9Ct9Z7PoT46LQVSuQJ0HWt.png', '1643094800_38dbf6cfe0e2661c87d7.jpg', '1644867117_399800bbd905f97db768.jpg', 'enabled', '2022-01-25 01:22:08', '2022-02-14 13:32:15'),
(24, 'marvelsw', 'Marvel Super War', 'marvel_super_war', 'hLvrwGooNRCoXm7l0WBbWf3cWaPnjZZ48ZPADNciiu9Ct9Z7PoT46LQVSuQJ0HWt.png', '1643789172_6663d5754f266c7e2910.png', '1645107344_6d911fc1c01cc4e21914.png', 'enabled', '2022-02-02 02:23:54', '2022-02-17 08:16:18'),
(1, 'ml', 'Mobile Legends', 'mobile_legends', 'hLvrwGooNRCoXm7l0WBbWf3cWaPnjZZ48ZPADNciiu9Ct9Z7PoT46LQVSuQJ0HWt.png', 'ml.png', '1643880283_da93dcff908916e4ab5c.png', 'enabled', '2022-01-13 00:12:55', '2022-07-15 15:38:56'),
(16, 'MLA', 'MlBB Adventure', 'mlbb_adventure', 'hLvrwGooNRCoXm7l0WBbWf3cWaPnjZZ48ZPADNciiu9Ct9Z7PoT46LQVSuQJ0HWt.png', '1643140573_8fc14030c1598497c18f.jpg', '1644863397_7d5a28f43bb397b217ab.png', 'enabled', '2022-01-25 13:57:25', '2022-02-14 12:31:12'),
(10, 'netflix', 'Netflix', 'netflix', 'hLvrwGooNRCoXm7l0WBbWf3cWaPnjZZ48ZPADNciiu9Ct9Z7PoT46LQVSuQJ0HWt.png', '1642882092_63dcef7c8e2b2b9ebc29.png', '1641894281_e5570451640282adce75.jpg', 'enabled', '2022-01-22 14:08:48', '2022-02-14 11:07:36'),
(14, 'pb', 'Point Blank', 'point_blank', '1643090133_da85d2f7e946d571f16a.png', '1643090185_e338404ff6403a52c2a5.jpg', '1643881445_f6333a3bd5e3558a936b.png', 'enabled', '2022-01-24 23:57:44', '2022-02-14 12:19:40'),
(13, 'pes', 'PES 2022 ', 'pes_2022', '1643716800_d62b905605b346c365f2.png', '1643716868_30456e3999bf7509cc16.jpg', '1641894281_e5570451640282adce75.jpg', 'enabled', '2022-02-01 06:02:49', '2022-02-14 00:45:49'),
(15, 'ps', 'PSN PlayStaion', 'psn_playstaion', '1643703726_d8d12fe5d518e811a290.png', '1643782855_2fa484932dc0c6319df1.jpg', '1641894281_e5570451640282adce75.jpg', 'enabled', '2022-02-01 02:24:45', '2022-02-14 12:26:33'),
(3, 'pubg', 'PUBG', 'pubg', '1642141847_2aa6dea620f79b2c62b7.png', '1642141767_2f0234ee57a10a85d5cf.jpg', '1643880673_8e13c45320858c09b419.png', 'enabled', '2022-01-14 00:31:30', '2022-02-11 23:13:01'),
(20, 'rom', 'Ragnarok M', 'ragnarok_m', '1643138934_62d283f4d4256c405e9b.png', '1643139000_fee29bc8f048ce347612.jpg', '1644865854_c29cc47d64993777cbc3.png', 'enabled', '2022-01-25 13:31:03', '2022-02-14 13:11:27'),
(19, 'rox', 'Ragnarok X', 'ragnarok_x', '1643093016_f2c1a3e9dbf80925b01a.png', '1643093038_c4b98192cb03682cb745.jpg', '1644864315_86525a50ca1fa8a1eb7b.png', 'enabled', '2022-01-25 00:44:46', '2022-02-14 12:45:43'),
(18, 'sausage', 'Sausage Man', 'sausage_man', '1643141276_c20b6b547627925c9a28.png', '1643141308_2d376b3fc91682b3cdc2.png', '1644863926_14a05ef1c3b341d4bd76.jpeg', 'enabled', '2022-01-25 14:09:58', '2022-02-14 12:39:10'),
(99999, 'tgame', 'Jangan Di Delete !', 'jangan_di_delete_!', '1642141847_2aa6dea620f79b2c62b7.png', 'ml.png', '1641894281_e5570451640282adce75.jpg', 'disabled', '2022-07-11 11:00:53', '2022-07-13 10:02:19'),
(8, 'valo', 'Valorant', 'valorant', '1642741537_fa5563c10fe39e95889a.png', '1642878852_8dfb8dba7a9ab255b8eb.png', '1643880813_f17074747a0e8abc3aa2.png', 'enabled', '2022-01-22 13:16:05', '2022-02-14 10:51:15'),
(7, 'wildrift', 'LOL:Wild Rift', 'lolwild_rift', '1642741142_69b1f70d36d4bf2739f1.png', '1642741380_14455fe5e12111824630.jpg', '1643881233_73181db3b6d448c6a3aa.png', 'enabled', '2022-01-20 23:07:18', '2022-02-14 10:42:09'),
(5, 'yt', 'YT Premium', 'yt_premium', '1642584922_d3e4c75a0bfe546704a7.png', '1642638941_1fcfccf170f596112f44.png', '1641894281_e5570451640282adce75.jpg', 'enabled', '2022-01-19 03:10:10', '2022-02-11 23:16:20'),
(23, 'Zepeto', 'Zepeto', 'zepeto', '1643780640_a16ecc8c8239c02cb338.png', '1643783016_69881e7e8b0823c4509f.jpg', '1645107138_b7ce8f30207b8daf797b.png', 'enabled', '2022-02-02 00:25:38', '2022-02-17 08:13:12');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_harga`
--

CREATE TABLE `daftar_harga` (
  `kode_harga` int(11) NOT NULL,
  `urutan` int(11) NOT NULL,
  `kode_paket` int(16) NOT NULL,
  `nominal` varchar(255) NOT NULL,
  `harga_basic` int(11) NOT NULL,
  `harga_promo` int(11) NOT NULL,
  `ukuran` set('3','4','6','12') NOT NULL,
  `template` set('curency-text','text-curency','text','divider') NOT NULL DEFAULT 'curency-text',
  `c_matauang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daftar_harga`
--

INSERT INTO `daftar_harga` (`kode_harga`, `urutan`, `kode_paket`, `nominal`, `harga_basic`, `harga_promo`, `ukuran`, `template`, `c_matauang`) VALUES
(11, 5, 12, '86', 20000, 22000, '6', 'curency-text', ''),
(12, 4, 12, '172', 40000, 0, '6', 'curency-text', ''),
(13, 6, 12, '257', 60000, 0, '6', 'curency-text', ''),
(14, 7, 12, '344', 80000, 0, '6', 'curency-text', ''),
(15, 8, 12, '429', 100000, 0, '6', 'curency-text', ''),
(16, 9, 12, '514', 120000, 0, '6', 'curency-text', ''),
(17, 10, 12, '600', 140000, 0, '6', 'curency-text', ''),
(18, 11, 12, '706', 160000, 0, '6', 'curency-text', ''),
(19, 12, 12, '878', 200000, 0, '6', 'curency-text', ''),
(20, 13, 12, '963', 220000, 0, '6', 'curency-text', ''),
(21, 14, 12, '1050', 240000, 0, '6', 'curency-text', ''),
(22, 15, 12, '1412', 320000, 0, '6', 'curency-text', ''),
(23, 16, 12, '1669', 380000, 0, '6', 'curency-text', ''),
(24, 17, 12, '2195', 475000, 0, '6', 'curency-text', ''),
(25, 18, 12, '2539', 555000, 0, '6', 'curency-text', ''),
(26, 19, 12, '3073', 675000, 0, '6', 'curency-text', ''),
(27, 20, 12, '3688', 800000, 0, '6', 'curency-text', ''),
(28, 21, 12, '4031', 880000, 0, '6', 'curency-text', ''),
(29, 22, 12, '4566', 1000000, 0, '6', 'curency-text', ''),
(30, 23, 12, '5532', 1200000, 0, '6', 'curency-text', ''),
(31, 24, 12, '6238', 1360000, 0, '6', 'curency-text', ''),
(32, 25, 12, '7727', 1675000, 0, '6', 'curency-text', ''),
(33, 26, 12, '9288', 2000000, 0, '6', 'curency-text', ''),
(34, 27, 12, '10700', 2320000, 0, '6', 'curency-text', ''),
(35, 28, 12, '12189', 2635000, 2640000, '6', 'curency-text', ''),
(36, 29, 12, '15077', 3260000, 0, '6', 'curency-text', ''),
(37, 30, 12, '18576', 4000000, 0, '6', 'curency-text', ''),
(43, 3, 17, '113', 27000, 0, '6', 'curency-text', ''),
(44, 2, 17, '168', 39000, 0, '6', 'curency-text', ''),
(45, 3, 17, '226', 54000, 0, '6', 'curency-text', ''),
(46, 4, 17, '336', 78000, 0, '6', 'curency-text', ''),
(47, 5, 17, '460', 105000, 0, '6', 'curency-text', ''),
(48, 6, 17, '573', 130000, 0, '6', 'curency-text', ''),
(49, 7, 17, '628', 143000, 0, '6', 'curency-text', ''),
(50, 8, 17, '741', 170000, 0, '6', 'curency-text', ''),
(51, 9, 17, '920', 210000, 0, '6', 'curency-text', ''),
(52, 10, 17, '1088', 250000, 0, '6', 'curency-text', ''),
(53, 11, 17, '1427', 320000, 0, '6', 'curency-text', ''),
(54, 12, 17, '1887', 425000, 0, '6', 'curency-text', ''),
(55, 13, 17, '2000', 450000, 0, '6', 'curency-text', ''),
(56, 14, 17, '2398', 530000, 0, '6', 'curency-text', ''),
(57, 15, 17, '2856', 630000, 0, '6', 'curency-text', ''),
(58, 16, 17, '3026', 670000, 0, '6', 'curency-text', ''),
(59, 17, 17, '3596', 770000, 0, '6', 'curency-text', ''),
(60, 18, 17, '4056', 870000, 0, '6', 'curency-text', ''),
(61, 19, 17, '4516', 980000, 0, '6', 'curency-text', ''),
(62, 20, 17, '5023', 1080000, 0, '6', 'curency-text', ''),
(63, 21, 17, '5483', 1180000, 0, '6', 'curency-text', ''),
(64, 22, 17, '6038', 1300000, 0, '6', 'curency-text', ''),
(65, 23, 17, '7465', 1600000, 0, '6', 'curency-text', ''),
(66, 24, 17, '8436', 1800000, 0, '6', 'curency-text', ''),
(67, 25, 17, '9643', 2050000, 0, '6', 'curency-text', ''),
(68, 26, 17, '12076', 2550000, 0, '6', 'curency-text', ''),
(69, 27, 17, '15672', 3300000, 0, '6', 'curency-text', ''),
(70, 31, 17, '18114', 3800000, 0, '6', 'curency-text', ''),
(71, 32, 17, '24152', 5080000, 0, '6', 'curency-text', ''),
(72, 33, 17, '30190', 6300000, 0, '6', 'curency-text', ''),
(73, 2, 16, '39', 9000, 0, '6', 'curency-text', ''),
(74, 2, 16, '65', 18000, 0, '6', 'curency-text', ''),
(75, 3, 16, '92', 22000, 0, '6', 'curency-text', ''),
(76, 4, 16, '133', 33000, 0, '6', 'curency-text', ''),
(77, 5, 16, '266', 62000, 0, '6', 'curency-text', ''),
(78, 6, 16, '305', 70000, 0, '6', 'curency-text', ''),
(79, 7, 16, '400', 95000, 0, '6', 'curency-text', ''),
(80, 8, 16, '534', 123000, 0, '6', 'curency-text', ''),
(81, 9, 16, '670', 145000, 0, '6', 'curency-text', ''),
(83, 10, 16, '735', 163000, 0, '6', 'curency-text', ''),
(84, 11, 16, '803', 170000, 0, '6', 'curency-text', ''),
(85, 12, 16, '963', 211000, 0, '6', 'curency-text', ''),
(86, 13, 16, '1070', 230000, 0, '6', 'curency-text', ''),
(87, 14, 16, '1342', 310000, 0, '6', 'curency-text', ''),
(88, 15, 16, '1608', 365000, 0, '6', 'curency-text', ''),
(89, 16, 16, '1876', 420000, 0, '6', 'curency-text', ''),
(90, 17, 16, '2012', 450000, 0, '6', 'curency-text', ''),
(91, 18, 16, '2278', 515000, 0, '6', 'curency-text', ''),
(92, 19, 16, '2412', 545000, 0, '6', 'curency-text', ''),
(93, 20, 16, '2700', 600000, 0, '6', 'curency-text', ''),
(94, 21, 16, '3100', 700000, 0, '6', 'curency-text', ''),
(95, 22, 16, '3254', 735000, 0, '6', 'curency-text', ''),
(96, 23, 16, '3924', 875000, 0, '6', 'curency-text', ''),
(97, 24, 16, '4150', 895000, 0, '6', 'curency-text', ''),
(98, 25, 16, '5492', 1205000, 0, '6', 'curency-text', ''),
(99, 26, 16, '6026', 1320000, 0, '6', 'curency-text', ''),
(100, 27, 16, '7060', 1525000, 0, '6', 'curency-text', ''),
(101, 2, 18, '42', 11000, 0, '6', 'curency-text', ''),
(102, 2, 18, '70', 17000, 0, '6', 'curency-text', ''),
(103, 3, 18, '140', 33000, 0, '6', 'curency-text', ''),
(104, 4, 18, '284', 68000, 0, '6', 'curency-text', ''),
(105, 5, 18, '355', 85000, 0, '6', 'curency-text', ''),
(106, 6, 18, '716', 163000, 0, '6', 'curency-text', ''),
(107, 7, 18, '856', 195000, 0, '6', 'curency-text', ''),
(108, 8, 18, '1071', 225000, 0, '6', 'curency-text', ''),
(109, 9, 18, '1446', 310000, 0, '6', 'curency-text', ''),
(110, 10, 18, '2162', 445000, 0, '6', 'curency-text', ''),
(111, 11, 18, '2517', 525000, 0, '6', 'curency-text', ''),
(112, 12, 18, '2976', 615000, 0, '6', 'curency-text', ''),
(113, 13, 18, '3692', 735000, 0, '6', 'curency-text', ''),
(114, 14, 18, '4408', 850000, 0, '6', 'curency-text', ''),
(115, 15, 18, '7502', 1500000, 0, '6', 'curency-text', ''),
(139, 1, 14, '5', 1000, 0, '6', 'curency-text', ''),
(140, 2, 14, '10', 2000, 0, '6', 'curency-text', ''),
(141, 3, 14, '20', 4000, 0, '6', 'curency-text', ''),
(142, 4, 14, '50', 8000, 0, '6', 'curency-text', ''),
(143, 5, 14, '70', 10000, 0, '6', 'curency-text', ''),
(144, 6, 14, '100', 15000, 0, '6', 'curency-text', ''),
(145, 7, 14, '140', 19000, 0, '6', 'curency-text', ''),
(146, 8, 14, '150', 21000, 0, '6', 'curency-text', ''),
(147, 9, 14, '210', 28000, 0, '6', 'curency-text', ''),
(148, 10, 14, '355', 47000, 0, '6', 'curency-text', ''),
(149, 11, 14, '425', 56000, 0, '6', 'curency-text', ''),
(150, 12, 14, '500', 66000, 0, '6', 'curency-text', ''),
(151, 13, 14, '720', 93000, 0, '6', 'curency-text', ''),
(152, 14, 14, '860', 111000, 0, '6', 'curency-text', ''),
(153, 15, 14, '1000', 130000, 0, '6', 'curency-text', ''),
(154, 16, 14, '1075', 140000, 0, '6', 'curency-text', ''),
(155, 17, 14, '1440', 185000, 0, '6', 'curency-text', ''),
(156, 18, 14, '2000', 253000, 0, '6', 'curency-text', ''),
(157, 19, 14, '2720', 345000, 0, '6', 'curency-text', ''),
(158, 20, 14, '4000', 505000, 0, '6', 'curency-text', ''),
(159, 21, 14, '5000', 635000, 0, '6', 'curency-text', ''),
(160, 22, 14, '7290', 935000, 0, '6', 'curency-text', ''),
(164, 1, 19, '112', 17000, 0, '6', 'curency-text', ''),
(165, 1, 20, 'YT Premium Permanen', 30000, 0, '6', 'curency-text', ''),
(166, 1, 21, '105', 20000, 0, '6', 'curency-text', ''),
(167, 2, 21, '131', 25000, 0, '6', 'curency-text', ''),
(168, 3, 21, '263', 50000, 0, '6', 'curency-text', ''),
(169, 4, 21, '368', 65000, 0, '6', 'curency-text', ''),
(170, 5, 21, '530', 92000, 0, '6', 'curency-text', ''),
(171, 6, 21, '661', 115000, 0, '6', 'curency-text', ''),
(172, 7, 21, '825', 138000, 0, '6', 'curency-text', ''),
(173, 8, 21, '956', 163000, 0, '6', 'curency-text', ''),
(174, 9, 21, '1100', 185000, 0, '6', 'curency-text', ''),
(175, 10, 21, '1925', 320000, 0, '6', 'curency-text', ''),
(176, 11, 21, '2200', 365000, 0, '6', 'curency-text', ''),
(177, 11, 21, '2200', 365000, 0, '6', 'curency-text', ''),
(178, 12, 21, '2463', 410000, 0, '6', 'curency-text', ''),
(179, 13, 21, '3025', 505000, 0, '6', 'curency-text', ''),
(180, 14, 21, '3563', 590000, 0, '6', 'curency-text', ''),
(181, 15, 21, '4125', 685000, 0, '6', 'curency-text', ''),
(182, 16, 21, '4400', 720000, 0, '6', 'curency-text', ''),
(183, 17, 21, '4930', 805000, 0, '6', 'curency-text', ''),
(184, 18, 21, '5500', 895000, 0, '6', 'curency-text', ''),
(185, 19, 21, '6600', 1075000, 0, '6', 'curency-text', ''),
(186, 20, 21, '7700', 1250000, 0, '6', 'curency-text', ''),
(187, 21, 21, '8800', 1450000, 0, '6', 'curency-text', ''),
(188, 22, 21, '9900', 1650000, 0, '6', 'curency-text', ''),
(189, 23, 21, '10005', 1750000, 0, '6', 'curency-text', ''),
(190, 1, 23, '2455', 385000, 0, '6', 'curency-text', ''),
(191, 2, 23, '2586', 405000, 0, '6', 'curency-text', ''),
(192, 3, 23, '3045', 465000, 0, '6', 'curency-text', ''),
(193, 4, 23, '3559', 550000, 0, '6', 'curency-text', ''),
(194, 5, 23, '4026', 600000, 0, '6', 'curency-text', ''),
(195, 6, 23, '4200', 635000, 0, '6', 'curency-text', ''),
(196, 7, 23, '5740', 845000, 0, '6', 'curency-text', ''),
(197, 8, 23, '5961', 875000, 0, '6', 'curency-text', ''),
(198, 9, 23, '6213', 895000, 0, '6', 'curency-text', ''),
(199, 10, 23, '6983', 1050000, 0, '6', 'curency-text', ''),
(200, 11, 23, '7245', 1075000, 0, '6', 'curency-text', ''),
(201, 12, 23, '7759', 1155000, 0, '6', 'curency-text', ''),
(202, 13, 23, '8750', 1220000, 1230000, '6', 'curency-text', ''),
(207, 1, 25, 'Blessings', 70000, 0, '6', 'text', ''),
(208, 2, 25, '60', 15000, 0, '6', 'curency-text', ''),
(211, 3, 25, '120', 30000, 0, '6', 'curency-text', ''),
(212, 4, 25, '330', 70000, 0, '6', 'curency-text', ''),
(213, 5, 25, '660', 140000, 0, '6', 'curency-text', ''),
(214, 6, 25, '1090', 220000, 0, '6', 'curency-text', ''),
(215, 7, 25, '1420', 290000, 0, '6', 'curency-text', ''),
(216, 8, 25, '2240', 430000, 0, '6', 'curency-text', ''),
(217, 9, 25, '2570', 500000, 0, '6', 'curency-text', ''),
(218, 10, 25, '3330', 650000, 0, '6', 'curency-text', ''),
(219, 11, 25, '3880', 720000, 0, '6', 'curency-text', ''),
(220, 12, 25, '4210', 790000, 0, '6', 'curency-text', ''),
(221, 13, 25, '4970', 940000, 0, '6', 'curency-text', ''),
(222, 14, 25, '7760', 1395000, 0, '6', 'curency-text', ''),
(223, 1, 26, 'Starlight Fast Bonus 8/12', 95000, 0, '12', 'text-curency', ''),
(224, 2, 26, 'Starlight Member Plus+', 250000, 0, '12', 'text', ''),
(225, 1, 27, 'Skin Normal > 269', 55000, 0, '12', 'text-curency', ''),
(226, 2, 27, 'Skin Elite > 399', 70000, 0, '12', 'text-curency', ''),
(228, 3, 27, 'Skin Elite  > 599', 100000, 0, '12', 'text-curency', ''),
(229, 1, 28, '125', 15000, 0, '6', 'curency-text', ''),
(231, 1, 30, '125', 15000, 0, '6', 'curency-text', ''),
(232, 2, 30, '250', 30000, 0, '6', 'curency-text', ''),
(233, 3, 30, '420', 49000, 0, '6', 'curency-text', ''),
(234, 4, 30, '545', 64000, 0, '6', 'curency-text', ''),
(235, 5, 30, '700', 78000, 0, '6', 'curency-text', ''),
(236, 6, 30, '840', 98000, 0, '6', 'curency-text', ''),
(237, 7, 30, '1120', 126000, 0, '6', 'curency-text', ''),
(238, 8, 30, '1375', 145000, 0, '6', 'curency-text', ''),
(239, 9, 30, '1795', 193000, 0, '6', 'curency-text', ''),
(240, 10, 30, '2075', 222000, 0, '6', 'curency-text', ''),
(241, 11, 30, '2400', 241000, 0, '6', 'curency-text', ''),
(242, 12, 30, '2820', 290000, 0, '6', 'curency-text', ''),
(243, 13, 30, '3100', 319000, 0, '6', 'curency-text', ''),
(244, 14, 30, '4000', 385000, 0, '6', 'curency-text', ''),
(245, 15, 30, '4420', 434000, 0, '6', 'curency-text', ''),
(246, 16, 30, '4700', 462000, 0, '6', 'curency-text', ''),
(247, 17, 30, '5375', 529000, 0, '6', 'curency-text', ''),
(248, 18, 30, '8150', 785000, 0, '6', 'curency-text', ''),
(249, 1, 31, '40', 10000, 0, '6', 'curency-text', ''),
(250, 2, 31, '90', 19000, 0, '6', 'curency-text', ''),
(251, 3, 31, '130', 28000, 0, '6', 'curency-text', ''),
(252, 4, 31, '180', 37000, 0, '6', 'curency-text', ''),
(253, 5, 31, '230', 46000, 0, '6', 'curency-text', ''),
(254, 6, 31, '270', 55000, 0, '6', 'curency-text', ''),
(255, 7, 31, '320', 63000, 0, '6', 'curency-text', ''),
(256, 8, 31, '360', 72000, 0, '6', 'curency-text', ''),
(257, 9, 31, '410', 81000, 0, '6', 'curency-text', ''),
(258, 10, 31, '470', 90000, 0, '6', 'curency-text', ''),
(259, 11, 31, '510', 99000, 0, '6', 'curency-text', ''),
(260, 12, 31, '560', 108000, 0, '6', 'curency-text', ''),
(261, 13, 31, '600', 117000, 0, '6', 'curency-text', ''),
(262, 14, 31, '650', 126000, 0, '6', 'curency-text', ''),
(263, 15, 31, '700', 135000, 0, '6', 'curency-text', ''),
(264, 16, 31, '740', 144000, 0, '6', 'curency-text', ''),
(265, 17, 31, '790', 152000, 0, '6', 'curency-text', ''),
(266, 18, 31, '830', 161000, 0, '6', 'curency-text', ''),
(267, 19, 31, '880', 170000, 0, '6', 'curency-text', ''),
(268, 20, 31, '950', 179000, 0, '6', 'curency-text', ''),
(269, 21, 31, '1180', 224000, 0, '6', 'curency-text', ''),
(270, 22, 31, '1420', 268000, 0, '6', 'curency-text', ''),
(271, 23, 31, '1650', 313000, 0, '6', 'curency-text', ''),
(272, 24, 31, '1900', 357000, 0, '6', 'curency-text', ''),
(273, 25, 31, '2850', 535000, 0, '6', 'curency-text', ''),
(274, 26, 31, '3800', 713000, 0, '6', 'curency-text', ''),
(275, 27, 31, '4750', 891000, 0, '6', 'curency-text', ''),
(276, 1, 32, 'Netflix 1 Bulan 5 Perangkat', 140000, 0, '6', 'text', ''),
(278, 1, 34, '1200 ', 10000, 0, '6', 'curency-text', ''),
(279, 2, 34, '2400', 20000, 0, '6', 'curency-text', ''),
(280, 3, 34, '4800', 40000, 0, '6', 'curency-text', ''),
(281, 4, 34, '6000', 50000, 0, '6', 'curency-text', ''),
(282, 5, 34, '7200', 60000, 0, '6', 'curency-text', ''),
(283, 6, 34, '12000', 100000, 0, '6', 'curency-text', ''),
(284, 7, 34, '24000', 200000, 0, '6', 'curency-text', ''),
(285, 8, 34, '36000', 300000, 0, '6', 'curency-text', ''),
(286, 9, 34, '600000', 500000, 0, '6', 'curency-text', ''),
(287, 1, 35, '65 SunCoin', 14000, 0, '6', 'text', ''),
(288, 2, 35, '130 SunCoin', 28000, 0, '6', 'text', ''),
(289, 3, 35, '330 SunCoin', 68000, 0, '6', 'text', ''),
(290, 4, 35, '395 SunCoin', 81000, 0, '6', 'text', ''),
(291, 5, 35, '558 SunCoin', 110000, 0, '6', 'text', ''),
(292, 6, 35, '1108 SunCoin', 185000, 0, '6', 'text', ''),
(293, 7, 35, '2268 SunCoin', 370000, 0, '6', 'text', ''),
(294, 8, 35, '2468 SunCoin', 580000, 0, '6', 'text', ''),
(295, 9, 35, '5768 SunCoin', 925000, 0, '6', 'text', ''),
(296, 10, 35, '7768 SunCoin', 1235000, 0, '6', 'text', ''),
(297, 1, 37, '2450', 68000, 0, '6', 'curency-text', ''),
(298, 2, 37, '5190', 145000, 0, '6', 'curency-text', ''),
(299, 3, 37, '7640', 210000, 0, '6', 'curency-text', ''),
(300, 4, 37, '10860', 295000, 0, '6', 'curency-text', ''),
(301, 5, 37, '13310', 365000, 0, '6', 'curency-text', ''),
(302, 6, 37, '16760', 450000, 0, '6', 'curency-text', ''),
(303, 7, 37, '21950', 595000, 0, '6', 'curency-text', ''),
(304, 8, 37, '27620', 750000, 0, '6', 'curency-text', ''),
(305, 9, 37, '34810', 890000, 0, '6', 'curency-text', ''),
(306, 10, 37, '400000', 1020000, 0, '6', 'curency-text', ''),
(307, 11, 37, '45670', 1199000, 0, '6', 'curency-text', ''),
(308, 12, 37, '51570', 1350000, 0, '6', 'curency-text', ''),
(309, 13, 37, '69620', 1780000, 0, '6', 'curency-text', ''),
(310, 1, 38, '15000 GOLD', 22000, 0, '6', 'text', ''),
(311, 2, 38, '30000 GOLD', 42000, 0, '6', 'text', ''),
(312, 3, 38, '50000 GOLD', 72000, 0, '6', 'text', ''),
(313, 4, 38, '100000 GOLD', 135000, 0, '6', 'text', ''),
(314, 5, 38, '200000 GOLD', 260000, 0, '6', 'text', ''),
(315, 6, 38, '300000 GOLD', 385000, 0, '6', 'text', ''),
(317, 2, 39, '130', 28000, 0, '6', 'curency-text', ''),
(318, 1, 40, '6', 150000, 0, '6', 'curency-text', ''),
(319, 2, 40, '12', 30000, 0, '6', 'curency-text', ''),
(320, 3, 40, '18', 42000, 0, '6', 'curency-text', ''),
(321, 4, 40, '24', 57000, 0, '6', 'curency-text', ''),
(322, 5, 40, '48', 110000, 0, '6', 'curency-text', ''),
(323, 6, 40, '72', 140000, 0, '6', 'curency-text', ''),
(324, 7, 40, '108', 210000, 0, '6', 'curency-text', ''),
(325, 8, 40, '145', 275000, 0, '6', 'curency-text', ''),
(326, 9, 40, '181', 350000, 0, '6', 'curency-text', ''),
(327, 10, 40, '290', 565000, 0, '6', 'curency-text', ''),
(328, 11, 40, '373', 710000, 0, '6', 'curency-text', ''),
(329, 12, 40, '518', 999000, 0, '6', 'curency-text', ''),
(330, 13, 40, '746', 1375000, 0, '6', 'curency-text', ''),
(331, 1, 41, '132 M-Cash', 18000, 0, '6', 'text', ''),
(332, 2, 41, '264 M-Cash', 36000, 0, '6', 'text', ''),
(333, 3, 41, '411 M-Cash', 55000, 0, '6', 'text', ''),
(334, 4, 41, '665 M-Cash', 87000, 0, '6', 'text', ''),
(335, 5, 41, '1076 M-Cash', 139000, 0, '6', 'text', ''),
(336, 6, 41, '1676 M-Cash', 220000, 0, '6', 'text', ''),
(337, 7, 41, '2087 M-Cash', 275000, 0, '6', 'text', ''),
(338, 8, 41, '2341 M-Cash', 310000, 0, '6', 'text', ''),
(339, 9, 41, '3352 M-Cash', 445000, 0, '6', 'text', ''),
(340, 1, 42, '60', 16000, 0, '6', 'curency-text', ''),
(341, 2, 42, '120', 32000, 0, '6', 'curency-text', ''),
(342, 3, 42, '180', 48000, 0, '6', 'curency-text', ''),
(343, 4, 42, '316', 72000, 0, '6', 'curency-text', ''),
(344, 5, 42, '496', 115000, 0, '6', 'curency-text', ''),
(345, 6, 42, '718', 140000, 0, '6', 'curency-text', ''),
(346, 7, 42, '1034', 205000, 0, '6', 'curency-text', ''),
(347, 8, 42, '1368', 275000, 0, '6', 'curency-text', ''),
(348, 9, 42, '1752', 345000, 0, '6', 'curency-text', ''),
(349, 10, 42, '2118', 445000, 0, '6', 'curency-text', ''),
(350, 11, 42, '2872', 550000, 0, '6', 'curency-text', ''),
(351, 12, 42, '3548', 680000, 0, '6', 'curency-text', ''),
(352, 13, 42, '4916', 950000, 0, '6', 'curency-text', ''),
(353, 14, 42, '5666', 1100000, 0, '6', 'curency-text', ''),
(354, 15, 42, '7048', 1350000, 0, '6', 'curency-text', ''),
(357, 4, 27, 'Skin Special > 749 ', 120000, 0, '12', 'text-curency', ''),
(358, 5, 27, 'Skin EPIC > 899', 145000, 0, '12', 'text-curency', ''),
(359, 3, 39, '330', 67000, 0, '6', 'curency-text', ''),
(360, 1, 39, 'Monthly Card', 69000, 0, '6', 'text', ''),
(361, 4, 39, '710', 129000, 0, '6', 'curency-text', ''),
(362, 5, 39, '1040', 199000, 0, '6', 'curency-text', ''),
(363, 6, 39, '1430', 265000, 0, '6', 'curency-text', ''),
(364, 7, 39, '22140', 399000, 0, '6', 'curency-text', ''),
(365, 8, 39, '2860', 535000, 0, '6', 'curency-text', ''),
(366, 9, 39, '3860', 659000, 0, '6', 'curency-text', ''),
(367, 10, 39, '4570', 789000, 0, '6', 'curency-text', ''),
(368, 11, 39, '5290', 925000, 0, '6', 'curency-text', ''),
(369, 12, 39, '7720', 1315000, 0, '6', 'curency-text', ''),
(370, 13, 39, '65', 14000, 0, '6', 'curency-text', '1643136310_d766f4662077a990382b.png'),
(371, 14, 39, '130', 27000, 0, '6', 'curency-text', '1643136310_d766f4662077a990382b.png'),
(372, 15, 39, '330', 67000, 0, '6', 'curency-text', '1643136310_d766f4662077a990382b.png'),
(373, 16, 39, '660', 134000, 0, '6', 'curency-text', '1643136310_d766f4662077a990382b.png'),
(374, 17, 39, '990', 199000, 0, '6', 'curency-text', '1643136310_d766f4662077a990382b.png'),
(375, 18, 39, '1320', 269000, 0, '6', 'curency-text', '1643136310_d766f4662077a990382b.png'),
(376, 19, 39, '1980', 389000, 0, '6', 'curency-text', '1643136310_d766f4662077a990382b.png'),
(377, 20, 39, '3300', 659000, 0, '6', 'curency-text', '1643136310_d766f4662077a990382b.png'),
(378, 21, 39, '4620', 925000, 0, '6', 'curency-text', '1643136310_d766f4662077a990382b.png'),
(379, 22, 39, '6600', 1325000, 0, '6', 'curency-text', '1643136310_d766f4662077a990382b.png'),
(380, 1, 44, '90', 19000, 0, '6', 'curency-text', ''),
(381, 2, 44, '180', 37000, 0, '6', 'curency-text', ''),
(382, 3, 44, '270', 55000, 0, '6', 'curency-text', ''),
(383, 4, 44, '337', 68000, 0, '6', 'curency-text', ''),
(384, 5, 44, '427', 87000, 0, '6', 'curency-text', ''),
(385, 6, 44, '517', 106000, 0, '6', 'curency-text', ''),
(386, 7, 44, '607', 125000, 0, '6', 'curency-text', ''),
(387, 8, 44, '988', 175000, 0, '6', 'curency-text', ''),
(388, 9, 44, '2533', 430000, 0, '6', 'curency-text', ''),
(389, 10, 44, '3589', 595000, 0, '6', 'curency-text', ''),
(390, 11, 44, '7549', 1300000, 0, '6', 'curency-text', ''),
(391, 12, 44, '15092', 2560000, 0, '6', 'curency-text', ''),
(392, 13, 44, 'Invesment Fund', 190000, 0, '6', 'curency-text', ''),
(393, 14, 44, 'Invesment Fund 2', 275000, 0, '6', 'curency-text', ''),
(395, 1, 45, 'Voucher PSN 300.000 IDR', 275000, 0, '6', 'curency-text', ''),
(396, 0, 27, 'Gift Skin', 0, 0, '12', 'divider', ''),
(399, 8, 27, 'Gift Item', 0, 0, '12', 'divider', ''),
(400, 1, 46, '100', 15000, 0, '6', 'curency-text', ''),
(401, 2, 46, '310', 44000, 0, '6', 'curency-text', ''),
(402, 3, 46, '1050', 140000, 0, '6', 'curency-text', ''),
(403, 4, 46, '2150', 280000, 0, '6', 'curency-text', ''),
(404, 5, 46, '3300', 400000, 0, '6', 'curency-text', ''),
(405, 6, 46, '5800', 680000, 0, '6', 'curency-text', ''),
(406, 6, 27, 'Skin Lightborn > 1089', 160000, 0, '12', 'text-curency', ''),
(407, 9, 27, 'Ganti Nickname', 45000, 0, '12', 'text', ''),
(408, 10, 27, 'Ganti Nama Squad', 60000, 0, '12', 'text', ''),
(409, 11, 27, 'Ganti Bendera', 155000, 0, '12', 'text', ''),
(410, 3, 26, 'Starlight Gift Card', 90000, 0, '12', 'text-curency', '1643741628_3b3ba70dc4e766686a4c.png'),
(411, 12, 27, 'Starlight Gift Card', 90000, 0, '12', 'text-curency', '1643741628_3b3ba70dc4e766686a4c.png'),
(415, 2, 47, '10 Layla\'s Chocolate > 80', 16000, 0, '12', 'text-curency', ''),
(416, 1, 47, 'Charisma > 20', 6000, 0, '12', 'text-curency', ''),
(417, 3, 47, '10 Nana\'s Paw > 200', 38000, 0, '12', 'text-curency', ''),
(418, 4, 47, '10 Angela\'s Doll > 200', 38000, 0, '12', 'text-curency', ''),
(419, 5, 47, '10 Blessing Lantern > 200', 38000, 0, '12', 'text-curency', ''),
(420, 6, 47, '10 Lucky Straw Doll > 200', 38000, 0, '12', 'text-curency', ''),
(421, 7, 47, '10 Adorable Smilodon > 200', 38000, 0, '12', 'text-curency', ''),
(422, 8, 47, '10 Harley\'s Magic Hat > 200', 38000, 0, '12', 'text-curency', ''),
(423, 9, 47, '10 Diggie\'s Colored Egg > 200', 38000, 0, '12', 'text-curency', ''),
(424, 10, 47, '10 Kagura\'s Seimei Umbrella > 200', 38000, 0, '12', 'text-curency', ''),
(425, 11, 47, 'Angel Ark > 499', 80000, 0, '12', 'text-curency', ''),
(426, 12, 47, 'Paradise Island > 499', 80000, 0, '12', 'text-curency', ''),
(427, 13, 47, 'Goldmoon Lantern > 999', 155000, 0, '12', 'text-curency', ''),
(428, 9, 47, '10 Haunted Doll\'s Candy > 200', 38000, 0, '12', 'text-curency', ''),
(429, 1, 48, '110', 15000, 0, '6', 'curency-text', ''),
(430, 2, 48, '146', 19000, 0, '6', 'curency-text', ''),
(431, 3, 48, '220', 28000, 0, '6', 'curency-text', ''),
(432, 4, 48, '330', 42000, 0, '6', 'curency-text', ''),
(433, 5, 48, '669', 82000, 0, '6', 'curency-text', ''),
(434, 6, 48, '990', 125000, 0, '6', 'curency-text', ''),
(435, 7, 48, '1320', 165000, 0, '6', 'curency-text', ''),
(436, 8, 48, '2200', 275000, 0, '6', 'curency-text', ''),
(437, 9, 48, '2860', 350000, 0, '6', 'curency-text', ''),
(438, 10, 48, '3666', 450000, 0, '6', 'curency-text', ''),
(439, 11, 48, '4326', 540000, 0, '6', 'curency-text', ''),
(440, 12, 48, '4400', 550000, 0, '6', 'curency-text', ''),
(441, 13, 48, '5886', 735000, 0, '6', 'curency-text', ''),
(442, 14, 48, '6600', 820000, 0, '6', 'curency-text', ''),
(443, 15, 48, '8899', 1050000, 0, '6', 'curency-text', ''),
(444, 16, 48, '10266', 1250000, 0, '6', 'curency-text', ''),
(445, 17, 48, '13200', 1590000, 0, '6', 'curency-text', ''),
(446, 1, 49, '29 ZEM', 28000, 0, '6', 'curency-text', ''),
(447, 2, 49, '60 ZEM', 55000, 0, '6', 'curency-text', ''),
(448, 3, 49, '89 ZEM', 80000, 0, '6', 'curency-text', ''),
(449, 4, 49, '125 ZEM', 110000, 0, '6', 'curency-text', ''),
(450, 5, 49, '196 ZEM', 160000, 0, '6', 'curency-text', ''),
(451, 6, 49, '392 ZEM', 325000, 0, '6', 'curency-text', ''),
(452, 7, 49, '770 ZEM', 620000, 0, '6', 'curency-text', ''),
(453, 8, 49, '966 ZEM', 795000, 0, '6', 'curency-text', ''),
(454, 9, 49, '1540 ZEM', 1250000, 0, '6', 'curency-text', ''),
(455, 10, 49, '10200 COIN', 28000, 0, '6', 'curency-text', '1643783835_33dd894b7411666d4b4a.png'),
(456, 11, 49, '21000 COIN', 55000, 0, '6', 'curency-text', '1643783835_33dd894b7411666d4b4a.png'),
(457, 12, 49, '38900 COIN', 100000, 0, '6', 'curency-text', '1643783835_33dd894b7411666d4b4a.png'),
(458, 13, 49, '62800 COIN', 155000, 0, '6', 'curency-text', '1643783835_33dd894b7411666d4b4a.png'),
(459, 14, 49, '125600 COIN', 310000, 0, '6', 'curency-text', '1643783835_33dd894b7411666d4b4a.png'),
(460, 15, 49, '234000 COIN', 535000, 0, '6', 'curency-text', '1643783835_33dd894b7411666d4b4a.png'),
(461, 16, 49, '296800 COIN', 695000, 0, '6', 'curency-text', '1643783835_33dd894b7411666d4b4a.png'),
(462, 17, 49, '468000 COIN', 1050000, 0, '6', 'curency-text', '1643783835_33dd894b7411666d4b4a.png'),
(463, 1, 50, '55 Credits', 14000, 0, '6', 'text', ''),
(464, 2, 50, '275 Credits', 70000, 0, '6', 'text', ''),
(465, 3, 50, '565 Credits', 140000, 0, '6', 'text', ''),
(466, 4, 50, '1155 Credits', 270000, 0, '6', 'text', ''),
(467, 5, 50, '1765 Credits', 400000, 0, '6', 'text', ''),
(468, 6, 50, '2950 Credits', 650000, 0, '6', 'text', ''),
(469, 7, 50, '6000 Credits', 1280000, 0, '6', 'text', ''),
(470, 1, 51, '112', 20000, 0, '6', 'curency-text', ''),
(471, 2, 51, '168', 29000, 0, '6', 'curency-text', ''),
(472, 3, 51, '224', 38000, 0, '6', 'curency-text', ''),
(473, 4, 51, '282', 47000, 0, '6', 'curency-text', ''),
(474, 5, 51, '338', 56000, 0, '6', 'curency-text', ''),
(475, 6, 51, '394', 65000, 0, '6', 'curency-text', ''),
(476, 7, 51, '579', 92000, 0, '6', 'curency-text', ''),
(477, 8, 51, '861', 137000, 0, '6', 'curency-text', ''),
(478, 9, 51, '1158', 182000, 0, '6', 'curency-text', ''),
(479, 1, 52, '134', 20000, 0, '6', 'curency-text', ''),
(480, 2, 52, '268', 38000, 0, '6', 'curency-text', ''),
(481, 3, 52, '335', 47000, 0, '6', 'curency-text', ''),
(482, 4, 52, '402', 56000, 0, '6', 'curency-text', ''),
(483, 5, 52, '469', 65000, 0, '6', 'curency-text', ''),
(484, 6, 52, '670', 92000, 0, '6', 'curency-text', ''),
(485, 7, 52, '804', 110000, 0, '6', 'curency-text', ''),
(486, 8, 52, '1005', 137000, 0, '6', 'curency-text', ''),
(487, 9, 52, '1340', 182000, 0, '6', 'curency-text', ''),
(488, 10, 52, '2011', 272000, 0, '6', 'curency-text', ''),
(489, 11, 52, '2346', 317000, 0, '6', 'curency-text', ''),
(490, 12, 52, '2681', 362000, 0, '6', 'curency-text', ''),
(491, 13, 52, '4022', 542000, 0, '6', 'curency-text', ''),
(494, 1, 55, '33Gb (1Bulan)', 55000, 0, '6', 'text', ''),
(523, 2, 99999, '1', 1, 2, '6', 'text', 'hLvrwGooNRCoXm7l0WBbWf3cWaPnjZZ48ZPADNciiu9Ct9Z7PoT46LQVSuQJ0HWt.png'),
(525, 3, 99999, '99', 0, 0, '12', 'divider', ''),
(526, 1, 99999, '100', 100, 101, '6', 'curency-text', '');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_paket`
--

CREATE TABLE `daftar_paket` (
  `urutan` int(11) NOT NULL,
  `kode_paket` int(16) NOT NULL,
  `nama_paket` varchar(64) NOT NULL,
  `slug_game` varchar(64) NOT NULL,
  `slug_paket` varchar(64) NOT NULL,
  `deskripsi_paket` text NOT NULL,
  `ikon_paket` varchar(255) NOT NULL,
  `banner_paket` varchar(255) NOT NULL,
  `game-id` set('enabled','disabled') NOT NULL,
  `game-id_placeholder` varchar(64) DEFAULT NULL,
  `game-id_type` set('text','number','email') NOT NULL DEFAULT 'text',
  `game-server` set('enabled','disabled') NOT NULL,
  `game-server_placeholder` varchar(64) DEFAULT NULL,
  `game-server_type` set('text','number','password','select') NOT NULL DEFAULT 'number',
  `game-server_select-value` varchar(255) DEFAULT NULL,
  `note` set('enabled','disabled') NOT NULL DEFAULT 'enabled',
  `note_placeholder` varchar(255) DEFAULT NULL,
  `game-nickname` set('manual','auto','disabled') NOT NULL DEFAULT 'manual',
  `game-nickname_placeholder` varchar(255) DEFAULT NULL,
  `petunjuk` set('enabled','disabled') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `status` set('enabled','disabled') NOT NULL DEFAULT 'enabled',
  `sub1` varchar(64) NOT NULL,
  `sub2` varchar(64) NOT NULL,
  `sub3` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daftar_paket`
--

INSERT INTO `daftar_paket` (`urutan`, `kode_paket`, `nama_paket`, `slug_game`, `slug_paket`, `deskripsi_paket`, `ikon_paket`, `banner_paket`, `game-id`, `game-id_placeholder`, `game-id_type`, `game-server`, `game-server_placeholder`, `game-server_type`, `game-server_select-value`, `note`, `note_placeholder`, `game-nickname`, `game-nickname_placeholder`, `petunjuk`, `created_at`, `updated_at`, `status`, `sub1`, `sub2`, `sub3`) VALUES
(1, 12, 'Paket Fast Royal', 'mobile_legends', 'paket_fast_royal', 'Proses 1-4 Menit, Maksimal 20 Menit', '1642488418_75f69c7ca6f4f7f1c68d.jpg', '1642030577_271627498aff10779ed0.jpg', 'enabled', 'Masukan ID', 'number', 'enabled', 'Server ', 'number', '', 'disabled', '', 'auto', '', 'enabled', '2022-01-12 17:36:47', '2022-07-11 17:50:37', 'enabled', '', '', ''),
(1, 14, 'Paket Diamond Murah', 'free_fire', 'paket_diamond_murah', 'Proses 1-10 Menit', 'ff.jpg', '1642141650_70936d8b07fdcd151b94.jpg', 'enabled', 'Masukan ID FreeFire', 'number', 'disabled', '', 'text', '', 'disabled', '', 'auto', '', 'enabled', '2022-01-13 20:44:16', '2022-07-09 13:30:01', 'enabled', '', '', ''),
(2, 16, 'Paket Fast Murah', 'mobile_legends', 'paket_fast_murah', 'Proses Fast 1-10 menit, Maximal 20 menit', '1642488418_75f69c7ca6f4f7f1c68d.jpg', '1642383164_d146338a16013c9a451d.jpg', 'enabled', 'Masukan ID', 'number', 'enabled', 'Server', 'number', '', 'disabled', '', 'auto', '', 'enabled', '2022-01-16 19:36:54', '2022-07-11 17:50:37', 'enabled', '', '', ''),
(3, 17, 'Paket Semi Fast', 'mobile_legends', 'paket_semi_fast', 'Paket semi fast buka dari jam 09:00 sampai 18:30 WIB.<br /><br />\r\n Proses 1-20 menit, maksimal 120 menit.', '1642488418_75f69c7ca6f4f7f1c68d.jpg', '1642030577_271627498aff10779ed0.jpg', 'enabled', 'Masukan ID', 'number', 'enabled', 'Server', 'number', '', 'disabled', '', 'auto', '', 'enabled', '2022-01-18 01:40:08', '2022-03-04 02:12:00', 'enabled', '', '', ''),
(4, 18, 'Paket Fast Hemat', 'mobile_legends', 'paket_fast_hemat', 'Proses 1-30 menit, Maksimal 120 menit.', '1642488418_75f69c7ca6f4f7f1c68d.jpg', '1642498669_e22c682315357b31652b.jpg', 'enabled', 'Masukan ID', 'number', 'enabled', 'Server', 'number', '', 'disabled', '', 'auto', '', 'enabled', '2022-01-18 03:39:13', '2022-07-09 13:31:13', 'enabled', '', '', ''),
(1, 19, 'Cp CODM Murah', 'call_of_duty', 'cp_codm_murah', 'Bind FB via OPENID, Bind Garena via login FB. OPENID berada di menu Setting >> Legal & Privacy. Proses 1-15 menit', '1642581640_c6d0f65d6b6de408ce91.jpg', '1642585411_eafbdc6f7776525ebba4.jpg', 'enabled', 'Masukan ID', 'text', 'disabled', '', 'text', '', 'disabled', '', 'manual', 'Nickname', 'enabled', '2022-01-19 02:49:36', '2022-02-12 07:06:06', 'enabled', '', '', ''),
(1, 20, 'Youtube dan Youtube Music Premium', 'yt_premium', 'youtube_dan_youtube_music_premium', 'YT Premium Permanen', '1642488418_75f69c7ca6f4f7f1c68d.jpg', '1642583367_1e655e1da6320fcebfc9.jpg', 'disabled', '', 'text', 'disabled', '', 'text', '', 'disabled', '', 'manual', '', 'enabled', '2022-01-19 03:14:32', '2022-02-12 19:43:01', 'enabled', '', '', ''),
(3, 21, 'UC Murah Indo', 'pubg', 'uc_murah_indo', 'UC PUBG Khusus Region Indonesia (WAJIB). Proses 1-15 menit<br />', '1642141767_2f0234ee57a10a85d5cf.jpg', '1642501891_2e8399882d0eddbd2ca9.jpg', 'enabled', 'Masukan ID', 'text', 'disabled', '', 'text', '', 'disabled', '', 'manual', 'Nickname', 'enabled', '2022-01-19 04:12:40', '2022-02-11 23:36:12', 'enabled', '', '', ''),
(2, 23, 'UC Semi Indo', 'pubg', 'uc_semi_indo', 'UC PUBG Khusus Region Indonesia.Hanya Via ID dan Nickname.Proses 1-120 menit.', '1642141767_2f0234ee57a10a85d5cf.jpg', '1642588123_d30cdf4a7d6e9fd8a0a6.jpg', 'disabled', '', '', '', '', '', '', 'disabled', '', 'manual', '', 'enabled', '2022-01-19 04:31:21', '2022-01-19 04:31:21', 'enabled', '', '', ''),
(3, 24, 'UC Reg Luar', 'pubg', 'uc_reg_luar', 'UC PUBG khusus Region Luar Negeri.Hanya Via ID dan Nickname.Proses 20-120 menit\r\n\r\nPUBG Korea & Taipei Bisa', '1642141767_2f0234ee57a10a85d5cf.jpg', '1642589031_b07890f0af55fdac1f7a.jpg', 'disabled', '', 'text', 'disabled', '', 'text', '', 'disabled', '', 'manual', '', 'enabled', '2022-01-19 04:45:51', '2022-01-19 04:45:51', 'enabled', '', '', ''),
(1, 25, 'Genshin Impact', 'genshin_impact', 'genshin_impact', 'Hanya Via ID dan Server.Proses 1-30 menit', '1642650450_c3efd91db88f7c43e5a3.jpg', '1645173789_11f38725f72f126d890f.jpg', 'enabled', 'Masukan ID', 'number', 'enabled', '', 'select', 'Asia;America;Europe;TW, HK, MO', 'disabled', '', 'manual', 'Nickname', 'enabled', '2022-01-19 21:55:51', '2022-02-18 02:45:37', 'enabled', '', '', ''),
(5, 26, 'Starlight Murah', 'mobile_legends', 'starlight_murah', 'Starlight Fast bonus  8/12 Diamond,<br />\nStarlight + langsung level 30', '1642671881_172f674044bf4ee55bdd.png', '1643741231_54beb002bc63e191cb0a.jpg', 'enabled', 'Masukan ID', 'text', 'enabled', ' Server', 'number', '', 'disabled', '', 'auto', '', 'enabled', '2022-01-20 03:51:16', '2022-07-09 13:31:44', 'enabled', '', 'PILIH PAKET', ''),
(6, 27, 'Gift Skin', 'mobile_legends', 'gift_skin', 'Dikirim berupa skin langsung bukan Diamond.Wajib berteman dulu 7 hari', '1642673017_188653cb6ea5f0df5c8d.png', '1642673057_a322e1c210181f196bdc.jpg', 'enabled', 'Masukan ID', 'number', 'enabled', 'Server', 'number', '', 'enabled', 'Contoh : Order Skin EPIC Lunox', 'auto', '', 'enabled', '2022-01-20 04:04:55', '2022-07-09 13:32:12', 'enabled', '', 'PILIH TIPE SKIN', ''),
(1, 28, 'LOL', 'lolwild_rift', 'lol', 'Proses 1-30 menit.', '1642741380_14455fe5e12111824630.jpg', '1642741754_41eaaf6825aebeea678f.jpg', 'enabled', 'Masukan RIOT ID', 'number', 'disabled', '', 'text', '', 'disabled', '', 'manual', 'Masukan Username Riot', 'enabled', '2022-01-20 23:11:59', '2022-02-14 10:47:46', 'enabled', '', '', ''),
(1, 30, 'Valorant', 'valorant', 'valorant', 'Via ID Riot Game<br />\nProses 1-15 menit<br />\n<br />\nLink Download Valorant PC:<a href=\"https://playvalorant.com/id-id/download/\" target=\"_blank\" style=\"text-decoration:none;\"><br />\nDOWNLOAD DISINI</a>', '1642741324_6540b023f836d45785ec.png', '1642741727_a2bff347c72e9044ea70.jpg', 'enabled', 'Masukan ID ', 'number', 'disabled', '', 'text', '', 'disabled', '', 'manual', 'Nickname', 'enabled', '2022-01-22 13:21:42', '2022-02-14 11:01:52', 'enabled', '', '', ''),
(1, 31, 'AOV', 'arena_of_valor', 'aov', 'Hanya untuk akun bind FB. <br /><br />\r\nProses cukup Via ID dan Nickname. Proses 1-30 menit sesuai antrian', '1642741357_f3ad15f63e834cb162a4.jpg', '1642741461_37cff3b154f002be3d41.jpg', 'enabled', 'Masukan ID', 'text', 'disabled', '', 'text', '', 'disabled', '', 'manual', 'Nickname', 'enabled', '2022-01-22 13:54:59', '2022-02-14 11:06:39', 'enabled', '', '', ''),
(1, 32, 'Netflix ', 'netflix', 'netflix', 'Netflix paket 1 bulan bisa login maksimal 5 Device', '1642878852_8dfb8dba7a9ab255b8eb.png', '1642882057_e896c2a533af6e7b4e8d.jpg', 'disabled', '', 'text', 'disabled', '', 'text', '', 'disabled', '', 'manual', '', 'enabled', '2022-01-22 14:10:52', '2022-02-14 11:09:00', 'enabled', '', 'PAKET NETFLIX', ''),
(1, 34, 'Cash PB Murah', 'point_blank', 'cash_pb_murah', 'Via ID PB Zepetto<br />\r\nProses 1-15 menit<br />\r\n<br />\r\nLink Download Point Blank PC:<br />\r\n<a href=\"https://www.pointblank.id/game/download/\" target=\"_blank\" style=\"text-decoration:none;\">DOWNLOAD DISINI</a>', '1643090185_e338404ff6403a52c2a5.jpg', '1643090159_184f84f25ee37f56ded9.jpg', 'enabled', 'Masukan ID', 'number', 'disabled', '', 'text', '', 'disabled', '', 'manual', 'Nickname', 'enabled', '2022-01-24 23:59:23', '2022-02-14 12:25:17', 'enabled', '', '', ''),
(1, 35, 'La Credit Murah', 'life_after', 'la_credit_murah', 'Hanya Via ID dan Server, Proses 1-15 menit sesuai antrian', '1643091600_19db5b7699c6bd101561.jpg', '1643091560_d061933cd1069efa3da3.jpg', 'enabled', 'Masukan ID', 'number', 'enabled', '', 'select', 'Miska Town;Sand Castle;Mouth Swamp;Redwood Town;Obelisk;Chaos Outpost;Iron Stride;Fall Forest;Mount Snow;Nancy City;Charles Town;Snow Highlands;Santopany;Levin City;Chaos City;Twin Islands;Hope Wall;New Land;Mile Stone', 'disabled', '', 'manual', 'Nickname', 'enabled', '2022-01-25 00:25:09', '2022-02-14 11:22:15', 'enabled', '', '', ''),
(1, 37, 'Diamonds Murah', 'ragnarok_x', 'diamonds_murah', 'Hanya Via ID, Proses 1-15 menit sesuai antrian', '1643093038_c4b98192cb03682cb745.jpg', '1643092999_92858ffac4d547dc39eb.jpg', 'enabled', 'Masukan ID', 'number', 'enabled', '', 'select', 'Opera Phantom;Wings of Blessing;Royal;Instrument;Valhalla;Gungnir;Central Plains;Dark Lord;Temple of Dawn;Golden Lava;Highland;Demon\'s Castle;Sealed Island;Sipera;Silent Slip;Golden Route;Sapir;Rose Red;Kingdom of Freedom;Nicola;Crystal Waterfall;Bifrost', 'disabled', '', 'manual', 'Nickname', 'enabled', '2022-01-25 00:47:57', '2022-02-14 13:08:38', 'enabled', '', '', ''),
(1, 38, 'GOLD Murah', 'lost_saga', 'gold_murah', 'Via ID Lost Saga Origin<br />\r\nProses 1-15 menit<br />\r\n<br /><br />\r\nLink Download Lost Saga Origin PC:href=\"https://lostsaga.gnjoy.id/download/\" target=\"_blank\" style=\"text-decoration:none;\">DOWNLOAD DISINI</a>', '1643094800_38dbf6cfe0e2661c87d7.jpg', '1643094924_eb6f013843375242ecc0.jpg', 'enabled', '', 'text', 'enabled', '', 'text', '', 'disabled', '', 'manual', 'Masukan ID Lost Saga', 'enabled', '2022-01-25 01:31:01', '2022-02-14 13:35:22', 'enabled', '', '', ''),
(1, 39, 'Crystal Murahh', 'honkai_impact_3', 'crystal_murahh', 'Hanya Via ID dan Server, Proses 1-30 menit sesuai antrian', '1643136342_be30a34a1bc6efdc7bc1.png', '1643135984_b0de3bf2d9b69d4dddd5.jpg', 'enabled', 'Masukan ID', 'number', 'disabled', '', 'text', '', 'disabled', '', 'manual', 'Nickname', 'enabled', '2022-01-25 12:50:05', '2022-02-14 12:03:11', 'enabled', '', '', ''),
(1, 40, 'Ragnarok M', 'ragnarok_m', 'ragnarok_m', 'Hanya Via ID, Proses 1-15 menit sesuai antrian', '1643139000_fee29bc8f048ce347612.jpg', '1643138970_75ac9262a77db717b6ee.jpg', 'enabled', 'Masukan ID', 'number', 'enabled', '', 'select', 'Eternal Love;Midnight Party;Memory of Faith', 'disabled', '', 'manual', 'Nickname', 'enabled', '2022-01-25 13:32:28', '2022-02-14 13:14:06', 'enabled', '', '', ''),
(1, 41, 'M-Cash Murah', 'mlbb_adventure', 'm-cash_murah', 'Via ID dan Server.Proses 1-15 menit sesuai antrian', '1643140573_8fc14030c1598497c18f.jpg', '1643140542_0fa93d650d69a0d4bb91.jpg', 'enabled', 'Masukan ID', 'number', 'disabled', '', 'text', '', 'disabled', '', 'manual', 'Nickname', 'enabled', '2022-01-25 13:59:14', '2022-02-14 12:32:04', 'enabled', '', '', ''),
(1, 42, 'Candy Murah', 'sausage_man', 'candy_murah', 'Hanya Via ID dan Nickname.Proses 1-15 menit sesuai antrian', '1643141308_2d376b3fc91682b3cdc2.png', '1643141346_4e0a792a89baa593517f.jpg', 'enabled', 'Masukan ID', 'number', 'disabled', '', 'text', '', 'disabled', '', 'manual', 'Nickname', 'enabled', '2022-01-25 14:11:54', '2022-02-14 12:40:35', 'enabled', '', '', ''),
(1, 44, 'Dragon Raja', 'dragon_raja', 'dragon_raja', 'Hanya Via ID. Proses 1 - 15 Menit.', '1643622578_6c178d86c840d2d2b5ff.jpg', '1643622783_e0c65bfe0a40e2761861.jpg', 'enabled', 'Masukan ID', 'number', 'disabled', '', 'text', '', 'disabled', '', 'manual', 'Nickname', 'enabled', '2022-01-31 03:56:22', '2022-02-14 12:42:48', 'enabled', '', '', ''),
(1, 45, 'Voucher PlayStation Store', 'psn_playstaion', 'voucher_playstation_store', 'Berisi Voucher PlayStation Store Senilai: 300.000 IDR', '1643703628_a5a7ab0a790ad98425b1.png', '1643703656_b2a9a542ee9012e1b5df.jpg', 'disabled', '', 'text', 'disabled', '', 'text', '', 'disabled', '', 'manual', '', 'enabled', '2022-02-01 02:26:45', '2022-02-14 12:27:32', 'enabled', '', '', ''),
(1, 46, 'COIN PES MURAH', 'pes_2022', 'coin_pes_murah', 'Proses Via Login 5 - 30 Menit.', '1643716868_30456e3999bf7509cc16.jpg', '1643716827_4476932a725aceb3c749.jpg', 'enabled', 'Masukan Email Konami', 'email', 'disabled', '', 'text', '', 'disabled', '', 'manual', 'Masukan Password Konami', 'enabled', '2022-02-01 06:04:05', '2022-02-14 13:06:32', 'enabled', '', '', ''),
(7, 47, 'Gift Charisma', 'mobile_legends', 'gift_charisma', 'Langsung dikirim Charisma, Proses 1-15 menit.', '1643742386_793992b5936ccb1c53a5.png', '1643742458_f823402b99f970a60239.jpg', 'enabled', 'Masukan ID', 'number', 'enabled', 'Server', 'number', '', 'enabled', 'Contoh: Order Charisma Goldmoon 10x', 'auto', '', 'enabled', '2022-02-01 13:11:22', '2022-07-09 13:32:21', 'enabled', '', 'PILIH CHARISMA', ''),
(1, 48, 'Gems Murah', 'bullet_angel', 'gems_murah', 'Via ID dan Nickname, Proses 1-15 menit.', '1643780569_9473ac611cd08121c642.jpg', '1643780703_ba57ae7a59caaae61ed2.jpg', 'disabled', '', 'text', 'disabled', '', 'text', '', 'disabled', '', 'manual', '', 'enabled', '2022-02-01 23:51:44', '2022-02-01 23:51:44', 'enabled', '', '', ''),
(1, 49, 'Zem & Coin Murah', 'zepeto', 'zem_coin_murah', 'Via ID/KODE dan Nickname, Proses 1-15 menit ', '1643783016_69881e7e8b0823c4509f.jpg', '1643783066_9053e19d7e2a854aa001.jpg', 'enabled', 'Kode Zepeto', 'text', 'disabled', '', 'text', '', 'disabled', '', 'manual', 'Nickname', 'enabled', '2022-02-02 00:28:44', '2022-02-17 08:14:19', 'enabled', '', '', ''),
(1, 50, 'Credit Murah', 'marvel_super_war', 'credit_murah', 'Hanya Via ID dan Nickname, Proses 1-15 menit sesuai antrian.', '1643789172_6663d5754f266c7e2910.png', '1643789215_9e9a6f9ba472a16679a1.jpg', 'enabled', 'Masukan ID', 'number', 'disabled', '', 'text', '', 'disabled', '', 'manual', 'Nickname', 'enabled', '2022-02-02 02:26:22', '2022-02-17 08:18:18', 'enabled', '', '', ''),
(1, 51, 'Garena Speed Drifters', 'speed_drifters', 'garena_speed_drifters', 'Hanya Via ID, Proses 1-15 menit.', '1643795814_985781a131ea514a22ee.jpg', '1643795846_aa78ad978b263784f13f.jpg', 'disabled', '', 'text', 'disabled', '', 'text', '', 'disabled', '', 'manual', '', 'enabled', '2022-02-02 04:01:16', '2022-02-02 04:01:16', 'enabled', '', '', ''),
(1, 52, 'Lords Mobile', 'lords_mobile', 'lords_mobile', 'Hanya Via IGG ID, Proses 1-15 menit sesuai antrian', '1643796802_7fd4316af2e5bc20ccae.jpg', '1643796826_8d089adc4cb2cf3824d6.jpg', 'enabled', 'Masukan ID', 'number', 'disabled', '', 'text', '', 'disabled', '', 'manual', 'Nickname', 'enabled', '2022-02-02 04:17:48', '2022-02-17 22:03:40', 'enabled', '', '', ''),
(1, 55, 'PAKET DATA', 'kouta_3', 'paket_data', 'Masa Aktif 30 Hari<br /><br /><br /><br /><br />\r\nFull 24 Jam', 'ml.png', '1645157707_41f750b19cb42662a3fc.jpg', 'enabled', 'Masukan nomor HP', 'number', 'disabled', '', 'text', '', 'disabled', '', 'auto', 'Massukan No Handphone', 'disabled', '2022-02-18 08:14:35', '2022-02-18 08:50:50', 'enabled', '', '', ''),
(99999, 99999, 'Default Promocode', 'jangan_di_delete_!', '', 'test', 'ml.png', '1642030577_271627498aff10779ed0.jpg', 'enabled', '', 'text', 'enabled', '', 'number', '', 'enabled', '', 'manual', '', 'enabled', '2022-07-11 11:01:13', '2022-07-12 10:26:00', 'enabled', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_pesanan`
--

CREATE TABLE `daftar_pesanan` (
  `order_id` int(10) NOT NULL,
  `owner` varchar(16) NOT NULL,
  `paket` varchar(64) NOT NULL,
  `nominal` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `username` varchar(64) NOT NULL,
  `promocode` varchar(64) NOT NULL,
  `note` varchar(255) NOT NULL,
  `email_notif` varchar(64) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `status` set('pending','settlement','cancel','expire','failure','process','finish') NOT NULL,
  `pay_at` datetime DEFAULT NULL,
  `process_time` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daftar_pesanan`
--

INSERT INTO `daftar_pesanan` (`order_id`, `owner`, `paket`, `nominal`, `userid`, `username`, `promocode`, `note`, `email_notif`, `total_harga`, `status`, `pay_at`, `process_time`, `created_at`, `updated_at`) VALUES
(1657872796, '7', 'Mobile Legends - Paket Fast Royal', '86', '124046192 (2616)', 'Sand.', '', '', '', 20000, 'finish', '2022-07-15 15:13:33', NULL, '2022-07-15 08:37:10', '2022-07-15 15:37:10'),
(1657874622, '', 'Mobile Legends - Paket Fast Royal', '12189', '167487442 (2850)', 'fastgamingstore.com', '', '', '', 2635000, 'pending', NULL, NULL, '2022-07-15 08:43:46', '2022-07-15 15:43:46'),
(1657875190, '', 'Mobile Legends - Paket Fast Murah', '7060', '167487442 (2850)', 'fastgamingstore.com', '', '', '', 1525000, 'settlement', '2022-07-15 15:53:25', NULL, '2022-07-15 08:53:54', '2022-07-15 15:53:54'),
(1657942345, '', 'Mobile Legends - Paket Fast Hemat', '42', '167487442 (2850)', 'fastgamingstore.com', '', '', 'aditamadeden@gmail.com', 11000, 'expire', '0000-00-00 00:00:00', NULL, '2022-07-17 03:33:10', '2022-07-17 10:33:10'),
(1658323474, '7', 'Mobile Legends - Paket Fast Royal', '86', '124046192 (2616)', 'Sand.', '', '', '', 20000, 'settlement', '2022-07-20 20:24:42', NULL, '2022-07-20 13:24:56', '2022-07-20 20:24:56'),
(1658818295, '', 'Mobile Legends - Paket Fast Royal', '86', '124046192 (2616)', 'Sand.', '', '', '', 20000, 'pending', NULL, NULL, '2022-07-26 06:51:37', '2022-07-26 13:51:37'),
(1659358206, '', 'PUBG - UC Murah Indo', '263', '123', '123', '', '', 'a@a.com', 50000, 'settlement', '2022-08-01 21:34:28', NULL, '2022-08-01 14:36:59', '2022-08-01 21:36:59'),
(1659358574, '', 'PUBG - UC Semi Indo', '2455', '', '123', '', '', 'a@a.com', 385000, 'settlement', '2022-08-01 21:32:59', NULL, '2022-08-01 14:33:11', '2022-08-01 21:33:11'),
(1659364669, '7', 'PUBG - UC Murah Indo', '105', '123', '123', '', '', '123@123.com', 20000, 'pending', NULL, NULL, '2022-08-01 14:37:51', '2022-08-01 21:37:51'),
(1659499703, '', 'Mobile Legends - Paket Fast Royal', '257', '66333838 (2115)', '#$kipLos$1379-', '', '', 'wahyuandriyant989@gmail.com', 60000, 'expire', '0000-00-00 00:00:00', NULL, '2022-08-04 04:09:00', '2022-08-04 11:09:00'),
(1660216149, '', 'Mobile Legends - Paket Semi Fast', '168', '66333838 (2115)', '#$kipLos$1379-', '', '', 'wahyuandriyant989@gmail.com', 39000, 'expire', '0000-00-00 00:00:00', NULL, '2022-08-12 11:10:07', '2022-08-12 18:10:07'),
(1660216227, '', 'Mobile Legends - Paket Semi Fast', '460', '66333838 (2115)', '#$kipLos$1379-', '', '', 'wahyuandriyant989@gmail.com', 105000, 'expire', '0000-00-00 00:00:00', NULL, '2022-08-12 11:10:38', '2022-08-12 18:10:38'),
(1660217197, '', 'Mobile Legends - Paket Fast Murah', '400', '66333838 (2115)', '#$kipLos$1379-', '', '', 'wahyuandriyant989@gmail.com', 95000, 'expire', '0000-00-00 00:00:00', NULL, '2022-08-12 11:27:43', '2022-08-12 18:27:43'),
(1660217237, '', 'Mobile Legends - Paket Fast Murah', '400', '66333838 (2115)', '#$kipLos$1379-', '', '', 'wahyuandriyant989@gmail.com', 95000, 'expire', '0000-00-00 00:00:00', NULL, '2022-08-12 11:27:44', '2022-08-12 18:27:44');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1647670239, 1);

-- --------------------------------------------------------

--
-- Table structure for table `promo_code`
--

CREATE TABLE `promo_code` (
  `id` int(11) NOT NULL,
  `code` varchar(16) NOT NULL,
  `paket` int(16) DEFAULT 99999,
  `disc` double NOT NULL,
  `min` int(16) NOT NULL DEFAULT 0,
  `max` int(16) NOT NULL DEFAULT 0,
  `expired` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `promo_code`
--

INSERT INTO `promo_code` (`id`, `code`, `paket`, `disc`, `min`, `max`, `expired`) VALUES
(12, 'TESTING', 19, 0.1, 1000, 1000, '2022-07-29 17:07:00'),
(13, 'DISC1000', 99999, 10000, 10000, 10000, '2022-07-30 17:08:00');

-- --------------------------------------------------------

--
-- Table structure for table `semua_files`
--

CREATE TABLE `semua_files` (
  `id` int(11) NOT NULL,
  `tipe_files` set('matauang','ikon','banner_home','banner_game','pembayaran','cari_id') NOT NULL,
  `nama_files` varchar(255) NOT NULL,
  `catatan` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semua_files`
--

INSERT INTO `semua_files` (`id`, `tipe_files`, `nama_files`, `catatan`, `created_at`, `updated_at`) VALUES
(2, 'ikon', 'ml.png', 'ikon ML', '2022-01-08 11:32:48', '2022-01-08 11:32:48'),
(3, 'ikon', 'ff.jpg', 'ikon FF', '2022-01-08 11:38:11', '2022-01-08 11:38:11'),
(19, 'pembayaran', '1641777397_61435629a5ee3e87a998.png', 'Alfamart', '2022-01-09 19:16:37', '2022-01-09 19:16:37'),
(20, 'pembayaran', '1641781697_283a3bf2e82152b62561.png', 'Indomart', '2022-01-09 20:28:17', '2022-01-09 20:28:17'),
(22, 'cari_id', '1641894281_e5570451640282adce75.jpg', 'Cari ID FF', '2022-01-11 03:44:41', '2022-01-11 03:44:41'),
(23, 'pembayaran', '1642029895_65b2b1ba933fcf88fc69.png', 'BCA', '2022-01-12 17:24:55', '2022-01-12 17:24:55'),
(24, 'pembayaran', '1642029923_a462d3196c658144f37f.png', 'Dana', '2022-01-12 17:25:23', '2022-01-12 17:25:23'),
(25, 'pembayaran', '1642029939_bfe9552f7b36b2e7c436.png', 'Go-Pay', '2022-01-12 17:25:39', '2022-01-12 17:25:39'),
(27, 'pembayaran', '1642029964_4ed6565556228c255c02.png', 'Shopee', '2022-01-12 17:26:04', '2022-01-12 17:26:04'),
(29, 'banner_game', '1642030577_271627498aff10779ed0.jpg', 'Banner Paket Fast ML', '2022-01-12 17:36:17', '2022-01-12 17:36:17'),
(30, 'banner_game', '1642141650_70936d8b07fdcd151b94.jpg', 'Banner FF 1', '2022-01-14 00:27:30', '2022-01-14 00:27:30'),
(31, 'ikon', '1642141767_2f0234ee57a10a85d5cf.jpg', 'Ikon PUBG', '2022-01-14 00:29:27', '2022-01-14 00:29:27'),
(32, 'matauang', '1642141847_2aa6dea620f79b2c62b7.png', 'UC PUBG', '2022-01-14 00:30:47', '2022-01-14 00:30:47'),
(35, 'banner_game', '1642383164_d146338a16013c9a451d.jpg', 'guinkof.jpg', '2022-01-16 19:32:44', '2022-01-16 19:32:44'),
(36, 'ikon', '1642488418_75f69c7ca6f4f7f1c68d.jpg', 'prosesfast.jpg', '2022-01-18 00:46:58', '2022-01-18 00:46:58'),
(37, 'banner_game', '1642488543_116f3bad6cfba151eea2.jpg', 'tws', '2022-01-18 00:49:03', '2022-01-18 00:49:03'),
(39, 'banner_game', '1642491340_57b9304348aec61c1178.jpg', 'alulegend.jpg', '2022-01-18 01:35:40', '2022-01-18 01:35:40'),
(40, 'banner_game', '1642491521_336d044d3ed3420b0ae5.jpg', 'kagurastar.jpg', '2022-01-18 01:38:41', '2022-01-18 01:38:41'),
(41, 'banner_game', '1642498669_e22c682315357b31652b.jpg', 'edith.jpg', '2022-01-18 03:37:50', '2022-01-18 03:37:50'),
(42, 'banner_game', '1642501891_2e8399882d0eddbd2ca9.jpg', 'pubgterjun.jpg', '2022-01-18 04:31:31', '2022-01-18 04:31:31'),
(43, 'ikon', '1642581640_c6d0f65d6b6de408ce91.jpg', 'codmlogo', '2022-01-19 02:40:40', '2022-01-19 02:40:40'),
(45, 'matauang', '1642582428_50c02969cf04774c247b.png', 'cpcodm2', '2022-01-19 02:53:48', '2022-01-19 02:53:48'),
(46, 'matauang', '1642583330_f8eb91d8a34a26211146.png', 'ytmatauang.png', '2022-01-19 03:08:50', '2022-01-19 03:08:50'),
(47, 'banner_game', '1642583367_1e655e1da6320fcebfc9.jpg', 'ytbanner.jpg', '2022-01-19 03:09:27', '2022-01-19 03:09:27'),
(48, 'matauang', '1642584922_d3e4c75a0bfe546704a7.png', 'ytmatauang2.png', '2022-01-19 03:35:22', '2022-01-19 03:35:22'),
(49, 'banner_game', '1642585411_eafbdc6f7776525ebba4.jpg', 'codmbanner.jpg', '2022-01-19 03:43:31', '2022-01-19 03:43:31'),
(50, 'ikon', '1642585913_e057983bd1e893815d0a.png', 'royalepass.png', '2022-01-19 03:51:53', '2022-01-19 03:51:53'),
(51, 'banner_game', '1642588123_d30cdf4a7d6e9fd8a0a6.jpg', 'semipubgbanner.jpg', '2022-01-19 04:28:44', '2022-01-19 04:28:44'),
(52, 'banner_game', '1642589031_b07890f0af55fdac1f7a.jpg', 'flaregunbannerpubg', '2022-01-19 04:43:52', '2022-01-19 04:43:52'),
(53, 'banner_game', '1642589462_743fa003c21d9bccbaef.png', 'ikonyt', '2022-01-19 04:51:02', '2022-01-19 04:51:02'),
(54, 'ikon', '1642589548_ded72d2cf935ec85ab4f.png', 'ikonyt', '2022-01-19 04:52:28', '2022-01-19 04:52:28'),
(55, 'ikon', '1642589664_7a27eee97a9d2deb9cdd.png', 'ytikon2', '2022-01-19 04:54:24', '2022-01-19 04:54:24'),
(57, 'ikon', '1642638941_1fcfccf170f596112f44.png', 'YT', '2022-01-19 18:35:41', '2022-01-19 18:35:41'),
(58, 'ikon', '1642650422_1cb519618b7b7fb5f2eb.jpg', 'aovicon.jpg', '2022-01-19 21:47:02', '2022-01-19 21:47:02'),
(59, 'ikon', '1642650450_c3efd91db88f7c43e5a3.jpg', 'genshinicon.jpg', '2022-01-19 21:47:30', '2022-01-19 21:47:30'),
(60, 'banner_game', '1642650500_f9cb3c33774a1cd75bca.jpg', 'genshinbanner.jpg', '2022-01-19 21:48:20', '2022-01-19 21:48:20'),
(61, 'ikon', '1642650601_908f974d66ea47271475.jpg', 'newfficon.jpg', '2022-01-19 21:50:01', '2022-01-19 21:50:01'),
(62, 'matauang', '1642650750_149f490bb1c6c7d40398.png', 'matauanggenshin.png', '2022-01-19 21:52:30', '2022-01-19 21:52:30'),
(63, 'ikon', '1642671881_172f674044bf4ee55bdd.png', 'slicon.png', '2022-01-20 03:44:41', '2022-01-20 03:44:41'),
(64, 'banner_game', '1642671989_b01af4c7b5350842a972.jpg', 'sljan.jpg', '2022-01-20 03:46:29', '2022-01-20 03:46:29'),
(65, 'ikon', '1642673017_188653cb6ea5f0df5c8d.png', 'giftskinicon.png', '2022-01-20 04:03:37', '2022-01-20 04:03:37'),
(66, 'banner_game', '1642673057_a322e1c210181f196bdc.jpg', 'giftskinbanner.jpg', '2022-01-20 04:04:17', '2022-01-20 04:04:17'),
(68, 'matauang', '1642741142_69b1f70d36d4bf2739f1.png', 'matauanglol.png', '2022-01-20 22:59:02', '2022-01-20 22:59:02'),
(72, 'ikon', '1642741324_6540b023f836d45785ec.png', 'valoranticon.png', '2022-01-20 23:02:04', '2022-01-20 23:02:04'),
(73, 'ikon', '1642741357_f3ad15f63e834cb162a4.jpg', 'aovicon.jpg', '2022-01-20 23:02:37', '2022-01-20 23:02:37'),
(74, 'ikon', '1642741380_14455fe5e12111824630.jpg', 'lolicon.jpg', '2022-01-20 23:03:00', '2022-01-20 23:03:00'),
(75, 'banner_game', '1642741403_69d80c70742ab72156b0.jpg', 'aovbanner.jpg', '2022-01-20 23:03:24', '2022-01-20 23:03:24'),
(76, 'banner_game', '1642741461_37cff3b154f002be3d41.jpg', 'aovbanner.jpg', '2022-01-20 23:04:22', '2022-01-20 23:04:22'),
(77, 'matauang', '1642741488_4a96210fb52bfde38c7d.png', 'matauangaov.png', '2022-01-20 23:04:48', '2022-01-20 23:04:48'),
(78, 'matauang', '1642741537_fa5563c10fe39e95889a.png', 'matauangvalorant.png', '2022-01-20 23:05:37', '2022-01-20 23:05:37'),
(79, 'banner_game', '1642741727_a2bff347c72e9044ea70.jpg', 'valorantbanner.jpg', '2022-01-20 23:08:47', '2022-01-20 23:08:47'),
(80, 'banner_game', '1642741754_41eaaf6825aebeea678f.jpg', 'lolbanner.jpg', '2022-01-20 23:09:14', '2022-01-20 23:09:14'),
(82, 'ikon', '1642878852_8dfb8dba7a9ab255b8eb.png', 'ikonvaorant.png', '2022-01-22 13:14:12', '2022-01-22 13:14:12'),
(83, 'banner_game', '1642878914_912cb617ec44e653eb26.jpg', 'bannervalorant.jpg', '2022-01-22 13:15:14', '2022-01-22 13:15:14'),
(84, 'ikon', '1642880183_dcb1fb7986a2ff3a839e.png', 'ikonvalorant2', '2022-01-22 13:36:23', '2022-01-22 13:36:23'),
(86, 'ikon', '1642880939_326e0da2ecc24445bcd4.jpg', 'Valorant V Ikon.jpg', '2022-01-22 13:48:59', '2022-01-22 13:48:59'),
(87, 'banner_game', '1642882057_e896c2a533af6e7b4e8d.jpg', 'Netflixbanner.jpg', '2022-01-22 14:07:37', '2022-01-22 14:07:37'),
(88, 'ikon', '1642882092_63dcef7c8e2b2b9ebc29.png', 'netflixikon.png', '2022-01-22 14:08:12', '2022-01-22 14:08:12'),
(89, 'pembayaran', '1643017487_8675d74d78f2f79bc35d.png', 'Pulsa Telkomsel', '2022-01-24 03:44:47', '2022-01-24 03:44:47'),
(90, 'pembayaran', '1643020377_1c14f08d46c43a3fba6f.png', 'QRIS', '2022-01-24 04:32:57', '2022-01-24 04:32:57'),
(94, 'matauang', '1643090133_da85d2f7e946d571f16a.png', 'pbmatauang.png', '2022-01-24 23:55:33', '2022-01-24 23:55:33'),
(95, 'banner_game', '1643090159_184f84f25ee37f56ded9.jpg', 'bannerpb.jpg', '2022-01-24 23:55:59', '2022-01-24 23:55:59'),
(96, 'ikon', '1643090185_e338404ff6403a52c2a5.jpg', 'pbikon.jpg', '2022-01-24 23:56:25', '2022-01-24 23:56:25'),
(97, 'banner_game', '1643091560_d061933cd1069efa3da3.jpg', 'labanner.jpg', '2022-01-25 00:19:20', '2022-01-25 00:19:20'),
(98, 'ikon', '1643091600_19db5b7699c6bd101561.jpg', 'laikon.jpg', '2022-01-25 00:20:00', '2022-01-25 00:20:00'),
(99, 'banner_game', '1643092999_92858ffac4d547dc39eb.jpg', 'ragnarokbanner.jpg', '2022-01-25 00:43:19', '2022-01-25 00:43:19'),
(100, 'matauang', '1643093016_f2c1a3e9dbf80925b01a.png', 'ragnarokmatauang.png', '2022-01-25 00:43:36', '2022-01-25 00:43:36'),
(101, 'ikon', '1643093038_c4b98192cb03682cb745.jpg', 'ragnaarokikon.jpg', '2022-01-25 00:43:58', '2022-01-25 00:43:58'),
(102, 'ikon', '1643094800_38dbf6cfe0e2661c87d7.jpg', 'lostsagaikon.jpg', '2022-01-25 01:13:20', '2022-01-25 01:13:20'),
(103, 'banner_game', '1643094924_eb6f013843375242ecc0.jpg', 'lostsagabanner.jpg', '2022-01-25 01:15:24', '2022-01-25 01:15:24'),
(104, 'banner_game', '1643135984_b0de3bf2d9b69d4dddd5.jpg', 'honkaibanner1.jpg', '2022-01-25 12:39:44', '2022-01-25 12:39:44'),
(106, 'matauang', '1643136287_7c773554f44a9e649b87.png', 'honnkaidiamond.png', '2022-01-25 12:44:47', '2022-01-25 12:44:47'),
(107, 'matauang', '1643136310_d766f4662077a990382b.png', 'honkaibchip.png', '2022-01-25 12:45:10', '2022-01-25 12:45:10'),
(108, 'ikon', '1643136342_be30a34a1bc6efdc7bc1.png', 'honkaiikon.png', '2022-01-25 12:45:42', '2022-01-25 12:45:42'),
(109, 'matauang', '1643138934_62d283f4d4256c405e9b.png', 'ragnarokMMMatauang.png', '2022-01-25 13:28:54', '2022-01-25 13:28:54'),
(110, 'banner_game', '1643138970_75ac9262a77db717b6ee.jpg', 'ragnarokMMMBaner.jpg', '2022-01-25 13:29:30', '2022-01-25 13:29:30'),
(111, 'ikon', '1643139000_fee29bc8f048ce347612.jpg', 'ragnarokMMMikon.jpg', '2022-01-25 13:30:00', '2022-01-25 13:30:00'),
(112, 'banner_game', '1643140542_0fa93d650d69a0d4bb91.jpg', 'MLABanner.jpg', '2022-01-25 13:55:42', '2022-01-25 13:55:42'),
(113, 'ikon', '1643140573_8fc14030c1598497c18f.jpg', 'MLAikon.jpg', '2022-01-25 13:56:13', '2022-01-25 13:56:13'),
(114, 'matauang', '1643141276_c20b6b547627925c9a28.png', 'sausagemanmatauang.png', '2022-01-25 14:07:56', '2022-01-25 14:07:56'),
(115, 'ikon', '1643141308_2d376b3fc91682b3cdc2.png', 'sausagemanikon.png', '2022-01-25 14:08:28', '2022-01-25 14:08:28'),
(116, 'banner_game', '1643141346_4e0a792a89baa593517f.jpg', 'sausagemanbanner.jpg', '2022-01-25 14:09:06', '2022-01-25 14:09:06'),
(120, 'matauang', '1643622545_d8a06efed636340daea7.png', 'dragonrajacurrency', '2022-01-31 03:49:05', '2022-01-31 03:49:05'),
(121, 'ikon', '1643622578_6c178d86c840d2d2b5ff.jpg', 'dragonrajaicon', '2022-01-31 03:49:38', '2022-01-31 03:49:38'),
(122, 'banner_game', '1643622783_e0c65bfe0a40e2761861.jpg', 'dragonrajabanner.jpg', '2022-01-31 03:53:03', '2022-01-31 03:53:03'),
(123, 'pembayaran', '1643625230_2e2df07d76fe7c4c23ea.png', 'OVO', '2022-01-31 04:33:50', '2022-01-31 04:33:50'),
(124, 'pembayaran', '1643625379_0a00e5b534a0859ba938.png', 'BRI 3', '2022-01-31 04:36:19', '2022-01-31 04:36:19'),
(125, 'pembayaran', '1643625505_3161d201ef17a6503846.png', 'Mandiri', '2022-01-31 04:38:25', '2022-01-31 04:38:25'),
(126, 'pembayaran', '1643625775_dc25a2e9311a0df840f2.png', 'qris', '2022-01-31 04:42:55', '2022-01-31 04:42:55'),
(127, 'ikon', '1643703628_a5a7ab0a790ad98425b1.png', 'PlayStationIKON.png', '2022-02-01 02:20:28', '2022-02-01 02:20:28'),
(128, 'banner_game', '1643703656_b2a9a542ee9012e1b5df.jpg', 'PlastasionStore Banner.jpg', '2022-02-01 02:20:56', '2022-02-01 02:20:56'),
(129, 'matauang', '1643703726_d8d12fe5d518e811a290.png', 'playstationmatauang.png', '2022-02-01 02:22:06', '2022-02-01 02:22:06'),
(131, 'matauang', '1643716800_d62b905605b346c365f2.png', 'pes2021coin.png', '2022-02-01 06:00:00', '2022-02-01 06:00:00'),
(132, 'banner_game', '1643716827_4476932a725aceb3c749.jpg', 'pes2021banner.jpg', '2022-02-01 06:00:27', '2022-02-01 06:00:27'),
(133, 'ikon', '1643716868_30456e3999bf7509cc16.jpg', 'pes2021ikon', '2022-02-01 06:01:08', '2022-02-01 06:01:08'),
(134, 'banner_game', '1643741231_54beb002bc63e191cb0a.jpg', 'slfeb2022.jpg', '2022-02-01 12:47:11', '2022-02-01 12:47:11'),
(135, 'matauang', '1643741628_3b3ba70dc4e766686a4c.png', 'giftcardstarlight.png', '2022-02-01 12:53:48', '2022-02-01 12:53:48'),
(136, 'ikon', '1643742386_793992b5936ccb1c53a5.png', 'giftcharissmaikon.png', '2022-02-01 13:06:26', '2022-02-01 13:06:26'),
(137, 'banner_game', '1643742458_f823402b99f970a60239.jpg', 'charismabanner.jpg', '2022-02-01 13:07:38', '2022-02-01 13:07:38'),
(138, 'ikon', '1643780569_9473ac611cd08121c642.jpg', 'bulletangelikon.jpg', '2022-02-01 23:42:49', '2022-02-01 23:42:49'),
(139, 'matauang', '1643780640_a16ecc8c8239c02cb338.png', 'diamondpink.png', '2022-02-01 23:44:00', '2022-02-01 23:44:00'),
(140, 'banner_game', '1643780703_ba57ae7a59caaae61ed2.jpg', 'bulletangelbanner.jpg', '2022-02-01 23:45:03', '2022-02-01 23:45:03'),
(141, 'ikon', '1643782855_2fa484932dc0c6319df1.jpg', 'psnikon2.jpg', '2022-02-02 00:20:55', '2022-02-02 00:20:55'),
(142, 'ikon', '1643783016_69881e7e8b0823c4509f.jpg', 'zepetoikon.jpg', '2022-02-02 00:23:36', '2022-02-02 00:23:36'),
(143, 'banner_game', '1643783066_9053e19d7e2a854aa001.jpg', 'zepetobanner.jpg', '2022-02-02 00:24:26', '2022-02-02 00:24:26'),
(144, 'matauang', '1643783835_33dd894b7411666d4b4a.png', 'zepetocoinCURRENCY.png', '2022-02-02 00:37:15', '2022-02-02 00:37:15'),
(145, 'ikon', '1643789172_6663d5754f266c7e2910.png', 'marvelsuperwarikon.png', '2022-02-02 02:06:12', '2022-02-02 02:06:12'),
(146, 'banner_game', '1643789215_9e9a6f9ba472a16679a1.jpg', 'marvelsuperwarbbanner.jpg', '2022-02-02 02:06:55', '2022-02-02 02:06:55'),
(148, 'ikon', '1643795814_985781a131ea514a22ee.jpg', 'garenaspeedikon.jpg', '2022-02-02 03:56:54', '2022-02-02 03:56:54'),
(149, 'banner_game', '1643795846_aa78ad978b263784f13f.jpg', 'garenaspeedBanner.jpg', '2022-02-02 03:57:26', '2022-02-02 03:57:26'),
(150, 'matauang', '1643796776_e34a7d0589ddf179f806.png', 'LordsMobileMatauang.png', '2022-02-02 04:12:56', '2022-02-02 04:12:56'),
(151, 'ikon', '1643796802_7fd4316af2e5bc20ccae.jpg', 'lordsMobileikon.jpg', '2022-02-02 04:13:22', '2022-02-02 04:13:22'),
(152, 'banner_game', '1643796826_8d089adc4cb2cf3824d6.jpg', 'lordsMobilebanner.jpg', '2022-02-02 04:13:46', '2022-02-02 04:13:46'),
(153, 'cari_id', '1643880283_da93dcff908916e4ab5c.png', 'ID CODM', '2022-02-03 03:24:43', '2022-02-03 03:24:43'),
(154, 'cari_id', '1643880496_d50da87533ee3426fbbb.png', 'ID PUBG', '2022-02-03 03:28:16', '2022-02-03 03:28:16'),
(155, 'cari_id', '1643880673_8e13c45320858c09b419.png', 'ID PUBG', '2022-02-03 03:31:13', '2022-02-03 03:31:13'),
(156, 'cari_id', '1643880813_f17074747a0e8abc3aa2.png', 'ID VALORANT.png', '2022-02-03 03:33:33', '2022-02-03 03:33:33'),
(157, 'cari_id', '1643880964_46f5db08e656c57200ff.png', 'ID HONKAI IMPACT.png', '2022-02-03 03:36:04', '2022-02-03 03:36:04'),
(158, 'cari_id', '1643881111_2e6dd2967e33dc1585d9.png', 'ID LIFE AFTER.png', '2022-02-03 03:38:31', '2022-02-03 03:38:31'),
(159, 'cari_id', '1643881233_73181db3b6d448c6a3aa.png', 'ID LOL WILD RIFT.png', '2022-02-03 03:40:33', '2022-02-03 03:40:33'),
(160, 'cari_id', '1643881445_f6333a3bd5e3558a936b.png', 'ID POINT BLANK.png', '2022-02-03 03:44:05', '2022-02-03 03:44:05'),
(161, 'cari_id', '1643882558_4aad42d049d0121cbaaa.png', 'ID GENSHIN IMPACT.png', '2022-02-03 04:02:38', '2022-02-03 04:02:38'),
(162, 'cari_id', '1643882669_961bb476549f37299aa8.png', 'ID AOV.png', '2022-02-03 04:04:29', '2022-02-03 04:04:29'),
(163, 'cari_id', '1644863397_7d5a28f43bb397b217ab.png', 'MLA Petunjuk.png', '2022-02-14 12:29:57', '2022-02-14 12:29:57'),
(164, 'cari_id', '1644863596_251c4650d54e3c4cce68.png', 'Dragon raja petunuk.png', '2022-02-14 12:33:16', '2022-02-14 12:33:16'),
(165, 'cari_id', '1644863926_14a05ef1c3b341d4bd76.jpeg', 'ID SausageMan.jpeg', '2022-02-14 12:38:46', '2022-02-14 12:38:46'),
(166, 'cari_id', '1644864315_86525a50ca1fa8a1eb7b.png', 'ID RAGNAROK X.png', '2022-02-14 12:45:15', '2022-02-14 12:45:15'),
(167, 'cari_id', '1644865854_c29cc47d64993777cbc3.png', 'ID RAGNAROK M.png', '2022-02-14 13:10:54', '2022-02-14 13:10:54'),
(168, 'cari_id', '1644867117_399800bbd905f97db768.jpg', 'ID LOST SAGA PETUNJUK', '2022-02-14 13:31:57', '2022-02-14 13:31:57'),
(169, 'cari_id', '1645107138_b7ce8f30207b8daf797b.png', 'ID PETUNJUK ZEPETO.png', '2022-02-17 08:12:18', '2022-02-17 08:12:18'),
(170, 'cari_id', '1645107344_6d911fc1c01cc4e21914.png', 'ID PETUNJUK MARVEL SW.png', '2022-02-17 08:15:44', '2022-02-17 08:15:44'),
(171, 'cari_id', '1645156940_e620ede51493a783a9df.png', 'ID PETUNJUK LORDS MOBILE.png', '2022-02-17 22:02:20', '2022-02-17 22:02:20'),
(172, 'banner_game', '1645157707_41f750b19cb42662a3fc.jpg', 'Banner Kouta 3.JPG', '2022-02-17 22:15:07', '2022-02-17 22:15:07'),
(176, 'banner_game', '1645173789_11f38725f72f126d890f.jpg', 'BANNER GENSHIN NEW.JPG', '2022-02-18 02:43:09', '2022-02-18 02:43:09'),
(177, 'ikon', '1645176930_799b1fb080c6f7776f6d.jpg', 'Tri', '2022-02-18 03:35:30', '2022-02-18 03:35:30'),
(178, 'ikon', '1645319119_697bf33dbd4b886d3fed.png', 'Ikon 6000 dm.png', '2022-02-19 19:05:19', '2022-02-19 19:05:19'),
(179, 'banner_home', '1646103025_e1ca3e16899ad297e60d.jpg', 'Banner 0', '2022-02-28 20:50:26', '2022-02-28 20:50:26'),
(183, 'banner_home', '1646470179_b34e4afefdcd9361ec67.jpg', 'Banner 1', '2022-03-05 02:49:40', '2022-03-05 02:49:40'),
(185, 'matauang', 'hLvrwGooNRCoXm7l0WBbWf3cWaPnjZZ48ZPADNciiu9Ct9Z7PoT46LQVSuQJ0HWt.png', 'New ML Diamonds', '2022-06-25 10:55:49', '2022-06-25 10:55:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `user_image` varchar(255) NOT NULL DEFAULT 'default.svg',
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `fullname`, `user_image`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(7, 'admin@fastgamingstore.com', 'fastadmin', NULL, 'default.svg', '$2y$10$1f4nRTHjox1m/jxY94rPDe.Eg1HPqodCyZI8Vl0m.J4H1lnJ46a1C', '25e091970fdcb5b8d04960f8944df9e4', NULL, '2022-07-31 22:48:33', NULL, NULL, NULL, 1, 0, '2022-03-19 21:14:12', '2022-07-31 21:48:33', NULL),
(14, 'mail.fastgamingstore@gmail.com', 'userfast', NULL, 'default.svg', '$2y$10$TR/gdqGhP7AHX6eg.JWo1OzOBUR3rmBskdshJqoSIPDycJewDN76e', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2022-07-31 23:41:48', '2022-07-31 23:41:58', NULL),
(15, 'naswanasifah08@gmail.com', 'Nasywa Nafisah', NULL, 'default.svg', '$2y$10$5C9aZ5NKvMQD2kYoN4vusOK.fLj1RXBtuc/v5ru9FyQH6llw88WvC', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2022-08-02 03:09:30', '2022-08-02 03:11:21', NULL),
(16, 'dlillynx@gmail.com', 'testAcc', NULL, 'default.svg', '$2y$10$Nk50s0DxvuVUqVzH4dcFaOK/VMTd8CqCNcPvAHlXJT2Yz7w6PS/xa', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2022-08-02 04:11:35', '2022-08-02 04:11:53', NULL),
(17, 'farhanbayu002@gmail.com', 'Farhan Bayu', NULL, 'default.svg', '$2y$10$lHp61E7kEIelN36p2u8x7eqlYmFyytxKrsHsYYZyJUUEhgvCOSXxK', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2022-08-02 08:52:17', '2022-08-02 08:53:26', NULL),
(18, 'aanidyanovita12@gmail.com', 'tutupbotol', NULL, 'default.svg', '$2y$10$KBwc31EGEV/DhhllhBpFIOgnCrq4Or2xUcLUmOGxqauNsdLZBSUmi', 'b80782026835cc72465415535112dada', NULL, '2022-08-02 12:11:37', NULL, NULL, NULL, 1, 0, '2022-08-02 11:10:17', '2022-08-02 11:11:37', NULL),
(19, 'admin@admin.com', 'admin', NULL, 'default.svg', '$2y$10$t8N0TpGOrw1YHJNVTi74q.GYOH0zOfXPconnR4ivr97kX0u3/OtLa', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2025-03-07 20:24:35', '2025-03-07 20:24:35', NULL),
(20, 'user@user.com', 'username', NULL, 'default.svg', '$2y$10$lLREoTJUrGAgXdsyCrAOaekunMXFAW2/824OZHeyQj4HuKjH9s2Pi', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2025-03-07 21:12:20', '2025-03-07 21:12:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_access`
--

CREATE TABLE `user_access` (
  `id` int(12) NOT NULL,
  `id_user` varchar(64) NOT NULL,
  `game_id` varchar(64) DEFAULT NULL,
  `paket_id` int(16) DEFAULT NULL,
  `times` int(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_access`
--

INSERT INTO `user_access` (`id`, `id_user`, `game_id`, `paket_id`, `times`) VALUES
(77, '6734a18186460ac0301b48d9ca321f5d', 'mobile_legends', 0, 4),
(78, 'fastadmin', 'mobile_legends', 0, 4),
(79, 'cafa441bf5b0fab2fc73861ae17a24fb', 'mobile_legends', 0, 7),
(80, 'cafa441bf5b0fab2fc73861ae17a24fb', 'lords_mobile', 0, 1),
(81, 'cafa441bf5b0fab2fc73861ae17a24fb', 'marvel_super_war', 0, 1),
(82, 'cafa441bf5b0fab2fc73861ae17a24fb', 'psn_playstaion', 0, 1),
(83, 'fastadmin', 'psn_playstaion', 0, 1),
(84, 'a0d6e4c36e4a71fbfe0e1e9596226f44', 'mobile_legends', 0, 2),
(85, '5cf77ca3b385e46bb2d9867596fef1aa', 'mobile_legends', 0, 1),
(86, '8eed3b1d3c1dbf147abb048d110765ca', 'mobile_legends', 0, 1),
(87, '7c0461ea5276deb77c09bd894fc546a4', 'mobile_legends', 0, 2),
(88, 'c51c6ebec623730ca867ebaf3fe96a53', 'mobile_legends', 0, 2),
(89, '9f91118af29c7905b82315fe0dec0a4f', 'mobile_legends', 0, 2),
(90, 'f0740d8e07b9383a0f95b7623e6188f6', 'mobile_legends', 0, 1),
(91, 'f0740d8e07b9383a0f95b7623e6188f6', 'pubg', 0, 5),
(92, 'fastadmin', 'pubg', 0, 2),
(93, '37726176c0fc5fab2486f8616921a7fc', 'psn_playstaion', 0, 1),
(94, '37726176c0fc5fab2486f8616921a7fc', 'mobile_legends', 0, 1),
(95, '37726176c0fc5fab2486f8616921a7fc', 'genshin_impact', 0, 1),
(96, 'b9ba099f42fac9b2ced4b7092ca9c25b', 'kouta_3', 0, 2),
(97, '405f00cfb0994d6f8f8ce110880df386', 'mobile_legends', 0, 1),
(98, 'e098e460fedcb7d2851fc988d2cae1bf', 'mobile_legends', 0, 1),
(99, '516e1b904eb53fe36fdc22f033620dec', 'mobile_legends', 0, 2),
(100, 'ffbaebaf1fffcf140f1aef8cba6dce07', 'mobile_legends', 0, 3),
(101, 'a5d76087f3fdbe662e37172e087d9597', 'marvel_super_war', 0, 1),
(102, 'testAcc', 'marvel_super_war', 0, 1),
(103, 'b0b38c0ab0615812d9efcc5076e592b7', 'lost_saga', 0, 1),
(104, '3105e99ce996eaa56496e88ebff41d83', 'mobile_legends', 0, 1),
(105, '22cccb149f93782d17d0cc2bcdf6ec6b', 'mobile_legends', 0, 1),
(106, '8e440ff532bc72aebb5b3a8568f610d2', 'yt_premium', 0, 1),
(107, '798fe6ddfacab22bbe2a6e3c467672ad', 'mobile_legends', 0, 1),
(108, '8e440ff532bc72aebb5b3a8568f610d2', 'mobile_legends', 0, 1),
(109, '7a0a16855fb6cfb40b85648f95acd079', 'mobile_legends', 0, 3),
(110, '5d115a282036ff3948c4b4fdcb2fb7ab', 'zepeto', 0, 1),
(111, '5d115a282036ff3948c4b4fdcb2fb7ab', 'valorant', 0, 1),
(112, 'f2f4af88fa05e57cb01074f233b66929', 'mobile_legends', 0, 3),
(113, 'f2f4af88fa05e57cb01074f233b66929', 'pes_2022', 0, 1),
(114, 'f2f4af88fa05e57cb01074f233b66929', 'pubg', 0, 2),
(115, 'a19dfcd4d198d41c5d1079f62b213eb6', 'psn_playstaion', 0, 1),
(116, 'c7ecfe1906d3ce9d5e3bf919cf86c755', 'mobile_legends', 0, 1),
(117, '20920d1a30ca2fbf693de8eb5920d872', 'mobile_legends', 0, 1),
(118, '1dff01aa8ad49078e1a52cc3544f0e84', 'mobile_legends', 0, 1),
(119, '0c3275194e0aaee69c397e51a0cec909', 'mobile_legends', 0, 3),
(120, '0c3275194e0aaee69c397e51a0cec909', 'kouta_3', 0, 1),
(121, '9ab9db62f85ac65808edb73b5ac92cdb', 'netflix', 0, 1),
(122, '5ca26b3d480a9685d814f983df1a8d0a', 'kouta_3', 0, 1),
(123, '5ca26b3d480a9685d814f983df1a8d0a', 'mobile_legends', 0, 1),
(124, 'e036754686b8c97ea383cf9e3d8426ca', 'mobile_legends', 0, 1),
(125, '1ae9da1743a7874ae500606a7e380e95', 'mobile_legends', 0, 1),
(126, '5b344945005b1b3de5577751f02a753f', 'mobile_legends', 0, 2),
(127, '97b288e8257cfda74358a70b297909b0', 'mobile_legends', 0, 1),
(128, '6178a51c43702c7c454d0f6ac960bcd9', 'mobile_legends', 0, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `antrian_proses`
--
ALTER TABLE `antrian_proses`
  ADD PRIMARY KEY (`no`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indexes for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`),
  ADD KEY `group_id_user_id` (`group_id`,`user_id`);

--
-- Indexes for table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indexes for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

--
-- Indexes for table `daftar_game`
--
ALTER TABLE `daftar_game`
  ADD PRIMARY KEY (`kode_game`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `cari_id` (`cari_id`),
  ADD KEY `ikon_matauang` (`ikon_matauang`),
  ADD KEY `ikon_game` (`ikon_game`);

--
-- Indexes for table `daftar_harga`
--
ALTER TABLE `daftar_harga`
  ADD PRIMARY KEY (`kode_harga`),
  ADD KEY `kode_paket` (`kode_paket`),
  ADD KEY `c_matauang` (`c_matauang`);

--
-- Indexes for table `daftar_paket`
--
ALTER TABLE `daftar_paket`
  ADD PRIMARY KEY (`kode_paket`),
  ADD KEY `slug_game` (`slug_game`),
  ADD KEY `ikon_paket` (`ikon_paket`),
  ADD KEY `banner_paket` (`banner_paket`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `daftar_pesanan`
--
ALTER TABLE `daftar_pesanan`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promo_code`
--
ALTER TABLE `promo_code`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paket` (`paket`);

--
-- Indexes for table `semua_files`
--
ALTER TABLE `semua_files`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_files` (`nama_files`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_access`
--
ALTER TABLE `user_access`
  ADD PRIMARY KEY (`id`),
  ADD KEY `game_id` (`game_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `antrian_proses`
--
ALTER TABLE `antrian_proses`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `daftar_harga`
--
ALTER TABLE `daftar_harga`
  MODIFY `kode_harga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=527;

--
-- AUTO_INCREMENT for table `daftar_paket`
--
ALTER TABLE `daftar_paket`
  MODIFY `kode_paket` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100001;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `promo_code`
--
ALTER TABLE `promo_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `semua_files`
--
ALTER TABLE `semua_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user_access`
--
ALTER TABLE `user_access`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `antrian_proses`
--
ALTER TABLE `antrian_proses`
  ADD CONSTRAINT `antrian_proses_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `daftar_pesanan` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `daftar_game`
--
ALTER TABLE `daftar_game`
  ADD CONSTRAINT `daftar_game_ibfk_1` FOREIGN KEY (`cari_id`) REFERENCES `semua_files` (`nama_files`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `daftar_game_ibfk_2` FOREIGN KEY (`ikon_game`) REFERENCES `semua_files` (`nama_files`) ON UPDATE CASCADE,
  ADD CONSTRAINT `daftar_game_ibfk_3` FOREIGN KEY (`ikon_matauang`) REFERENCES `semua_files` (`nama_files`) ON UPDATE CASCADE;

--
-- Constraints for table `daftar_harga`
--
ALTER TABLE `daftar_harga`
  ADD CONSTRAINT `daftar_harga_ibfk_1` FOREIGN KEY (`kode_paket`) REFERENCES `daftar_paket` (`kode_paket`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `daftar_paket`
--
ALTER TABLE `daftar_paket`
  ADD CONSTRAINT `daftar_paket_ibfk_1` FOREIGN KEY (`slug_game`) REFERENCES `daftar_game` (`slug`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `daftar_paket_ibfk_2` FOREIGN KEY (`ikon_paket`) REFERENCES `semua_files` (`nama_files`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `daftar_paket_ibfk_3` FOREIGN KEY (`banner_paket`) REFERENCES `semua_files` (`nama_files`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `promo_code`
--
ALTER TABLE `promo_code`
  ADD CONSTRAINT `promo_code_ibfk_1` FOREIGN KEY (`paket`) REFERENCES `daftar_paket` (`kode_paket`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_access`
--
ALTER TABLE `user_access`
  ADD CONSTRAINT `user_access_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `daftar_game` (`slug`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
