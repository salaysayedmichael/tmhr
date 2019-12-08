-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 08, 2019 at 12:35 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tm_hr`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_title` varchar(100) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`department_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department_title`, `deleted`, `date_added`) VALUES
(7, 'IT', 0, '2018-09-04 04:59:02'),
(6, 'DIGITAL MKTG', 0, '2018-09-04 04:59:02'),
(5, 'ADMIN', 0, '2018-09-04 04:59:02'),
(8, 'OPERATIONS', 0, '2018-09-04 04:59:02'),
(9, 'TRADEMARK', 0, '2018-09-04 04:59:02'),
(10, 'TRADEMARK_CL', 1, '2018-09-04 04:59:02'),
(11, 'TRADEMARK-ASS', 1, '2018-09-04 04:59:02'),
(12, 'TRADEMARK-MGR', 1, '2018-09-04 04:59:02'),
(13, 'TRADEMARK-QA', 1, '2018-09-04 04:59:02'),
(14, 'US LEGAL', 0, '2018-09-04 04:59:02');

-- --------------------------------------------------------

--
-- Table structure for table `department_tree`
--

DROP TABLE IF EXISTS `department_tree`;
CREATE TABLE IF NOT EXISTS `department_tree` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `head` int(11) NOT NULL DEFAULT '0',
  `employee_id` int(11) DEFAULT '0',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=199 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department_tree`
--

INSERT INTO `department_tree` (`id`, `head`, `employee_id`, `date_added`, `deleted`) VALUES
(1, 90, 109, '2018-10-18 07:17:41', 0),
(2, 90, 114, '2018-10-18 07:17:41', 0),
(3, 90, 121, '2018-10-18 07:17:41', 0),
(4, 90, 125, '2018-10-18 07:17:41', 0),
(5, 90, 113, '2018-10-18 07:17:41', 0),
(6, 90, 120, '2018-10-18 07:17:41', 0),
(7, 88, 99, '2018-10-18 07:17:41', 0),
(8, 88, 116, '2018-10-18 07:17:41', 0),
(9, 88, 128, '2018-10-18 07:17:41', 0),
(10, 88, 103, '2018-10-18 07:17:41', 0),
(11, 88, 123, '2018-10-18 07:17:41', 0),
(12, 88, 124, '2018-10-18 07:17:41', 0),
(13, 88, 111, '2018-10-18 07:17:41', 0),
(14, 75, 100, '2018-10-18 07:17:41', 0),
(15, 75, 112, '2018-10-18 07:17:41', 0),
(16, 75, 126, '2018-10-18 07:17:41', 0),
(17, 75, 101, '2018-10-18 07:17:41', 0),
(18, 75, 115, '2018-10-18 07:17:41', 0),
(19, 75, 122, '2018-10-18 07:17:41', 0),
(20, 75, 110, '2018-10-18 07:17:41', 0),
(21, 75, 130, '2018-10-18 07:17:41', 0),
(22, 85, 134, '2018-10-18 07:17:41', 0),
(23, 85, 135, '2018-10-18 07:17:41', 0),
(24, 85, 136, '2018-10-18 07:17:41', 0),
(25, 85, 137, '2018-10-18 07:17:41', 0),
(26, 85, 138, '2018-10-18 07:17:41', 0),
(27, 85, 139, '2018-10-18 07:17:41', 0),
(28, 85, 140, '2018-10-18 07:17:41', 0),
(29, 85, 141, '2018-10-18 07:17:41', 0),
(30, 85, 142, '2018-10-18 07:17:41', 0),
(31, 85, 143, '2018-10-18 07:17:41', 0),
(32, 85, 144, '2018-10-18 07:17:41', 0),
(33, 85, 145, '2018-10-18 07:17:41', 0),
(34, 85, 146, '2018-10-18 07:17:41', 0),
(35, 85, 147, '2018-10-18 07:17:41', 0),
(36, 85, 148, '2018-10-18 07:17:41', 0),
(37, 86, 149, '2018-10-18 07:17:41', 1),
(38, 86, 150, '2018-10-18 07:17:41', 1),
(39, 86, 151, '2018-10-18 07:17:41', 1),
(40, 86, 152, '2018-10-18 07:17:41', 1),
(41, 86, 153, '2018-10-18 07:17:41', 1),
(42, 86, 154, '2018-10-18 07:17:41', 1),
(43, 86, 155, '2018-10-18 07:17:41', 1),
(44, 86, 156, '2018-10-18 07:17:41', 1),
(45, 86, 157, '2018-10-18 07:17:41', 1),
(46, 86, 158, '2018-10-18 07:17:41', 1),
(47, 86, 159, '2018-10-18 07:17:41', 1),
(48, 86, 160, '2018-10-18 07:17:41', 1),
(49, 86, 161, '2018-10-18 07:17:41', 1),
(50, 93, 92, '2018-10-18 07:17:41', 0),
(51, 93, 94, '2018-10-18 07:17:41', 0),
(52, 93, 129, '2018-10-18 07:17:41', 0),
(53, 93, 87, '2018-10-18 07:17:41', 0),
(54, 93, 118, '2018-10-18 07:17:41', 0),
(55, 93, 127, '2018-10-18 07:17:41', 0),
(56, 93, 119, '2018-10-18 07:17:41', 0),
(57, 93, 102, '2018-10-18 07:17:41', 0),
(58, 81, 80, '2018-10-18 07:17:41', 0),
(59, 81, 90, '2018-10-18 07:17:41', 0),
(60, 81, 75, '2018-10-18 07:17:41', 0),
(61, 81, 88, '2018-10-18 07:17:41', 0),
(62, 81, 85, '2018-10-18 07:17:41', 0),
(63, 81, 86, '2018-10-18 07:17:41', 0),
(64, 81, 93, '2018-10-18 07:17:41', 0),
(65, 78, 106, '2018-10-18 07:17:41', 0),
(66, 78, 79, '2018-10-18 07:17:41', 0),
(67, 77, 105, '2018-10-18 07:17:41', 0),
(68, 77, 84, '2018-10-18 07:17:41', 0),
(69, 74, 82, '2018-10-18 07:17:41', 0),
(70, 73, 91, '2018-10-18 07:17:41', 0),
(71, 73, 108, '2018-10-18 07:17:41', 0),
(72, 73, 107, '2018-10-18 07:17:41', 0),
(73, 162, 95, '2018-10-18 07:17:41', 0),
(74, 162, 117, '2018-10-18 07:17:41', 0),
(75, 162, 131, '2018-10-18 07:17:41', 0),
(76, 162, 89, '2018-10-18 07:17:41', 0),
(77, 83, 78, '2018-10-18 07:17:41', 0),
(78, 83, 81, '2018-10-18 07:17:41', 0),
(79, 83, 74, '2018-10-18 07:17:41', 0),
(80, 83, 77, '2018-10-18 07:17:41', 0),
(81, 83, 76, '2018-10-18 07:17:41', 0),
(82, 83, 96, '2018-10-18 07:17:41', 0),
(83, 83, 73, '2018-10-18 07:17:41', 0),
(84, 83, 132, '2018-10-18 07:17:41', 0),
(85, 83, 133, '2018-10-18 07:17:41', 0),
(86, 83, 98, '2018-10-18 07:17:41', 0),
(87, 97, 78, '2018-10-18 07:17:41', 0),
(88, 97, 81, '2018-10-18 07:17:41', 0),
(89, 97, 74, '2018-10-18 07:17:41', 0),
(90, 97, 77, '2018-10-18 07:17:41', 0),
(91, 97, 76, '2018-10-18 07:17:41', 0),
(92, 97, 96, '2018-10-18 07:17:41', 0),
(93, 97, 73, '2018-10-18 07:17:41', 0),
(94, 97, 132, '2018-10-18 07:17:41', 0),
(95, 97, 133, '2018-10-18 07:17:41', 0),
(96, 97, 98, '2018-10-18 07:17:41', 0),
(97, 86, 134, '2018-11-07 07:02:06', 1),
(98, 86, 102, '2018-11-07 07:02:06', 1),
(99, 86, 113, '2018-11-07 07:02:06', 1),
(100, 86, 120, '2018-11-07 07:02:37', 1),
(101, 86, 133, '2018-11-07 07:02:37', 1),
(102, 86, 132, '2018-11-07 07:04:23', 1),
(103, 86, 93, '2018-11-07 07:04:53', 1),
(104, 86, 120, '2018-11-07 07:07:18', 1),
(105, 86, 133, '2018-11-07 07:07:18', 1),
(106, 86, 79, '2018-11-07 07:08:06', 1),
(107, 86, 144, '2018-11-07 07:08:06', 1),
(108, 86, 132, '2018-11-07 07:10:05', 0),
(109, 86, 93, '2018-11-07 07:10:05', 0),
(110, 76, 133, '2018-11-07 07:10:37', 0),
(111, 76, 93, '2018-11-07 07:10:37', 0),
(112, 76, 119, '2018-11-07 07:10:37', 0),
(113, 76, 83, '2018-11-29 04:07:46', 0),
(114, 76, 120, '2018-11-29 04:07:46', 0),
(115, 76, 132, '2018-11-29 04:07:46', 0),
(116, 76, 108, '2018-11-29 04:07:46', 0),
(117, 76, 86, '2018-11-29 04:07:46', 0),
(118, 76, 81, '2018-11-29 04:07:46', 0),
(119, 76, 134, '2018-11-29 04:07:46', 0),
(120, 76, 121, '2018-11-29 04:07:46', 0),
(121, 76, 135, '2018-11-29 04:07:46', 0),
(122, 76, 98, '2018-11-29 04:07:46', 0),
(123, 76, 102, '2018-11-29 04:07:46', 0),
(124, 76, 113, '2018-11-29 04:07:46', 0),
(125, 76, 78, '2018-11-29 04:07:46', 0),
(126, 76, 158, '2018-11-29 04:07:46', 0),
(127, 76, 136, '2018-11-29 04:07:46', 0),
(128, 76, 90, '2018-11-29 04:07:46', 0),
(129, 76, 137, '2018-11-29 04:07:46', 0),
(130, 76, 155, '2018-11-29 04:07:46', 0),
(131, 76, 126, '2018-11-29 04:07:46', 0),
(132, 76, 127, '2018-11-29 04:07:46', 0),
(133, 76, 128, '2018-11-29 04:07:46', 0),
(134, 76, 107, '2018-11-29 04:07:46', 0),
(135, 76, 123, '2018-11-29 04:07:46', 0),
(136, 76, 84, '2018-11-29 04:07:46', 0),
(137, 76, 160, '2018-11-29 04:07:46', 0),
(138, 76, 138, '2018-11-29 04:07:46', 0),
(139, 76, 103, '2018-11-29 04:07:46', 0),
(140, 76, 87, '2018-11-29 04:07:46', 0),
(141, 76, 139, '2018-11-29 04:07:46', 0),
(142, 76, 140, '2018-11-29 04:07:46', 0),
(143, 76, 101, '2018-11-29 04:07:46', 0),
(144, 76, 153, '2018-11-29 04:07:46', 0),
(145, 76, 111, '2018-11-29 04:07:46', 0),
(146, 76, 150, '2018-11-29 04:07:46', 0),
(147, 76, 116, '2018-11-29 04:07:46', 0),
(148, 76, 75, '2018-11-29 04:07:46', 0),
(149, 76, 85, '2018-11-29 04:07:46', 0),
(150, 76, 124, '2018-11-29 04:07:46', 0),
(151, 76, 131, '2018-11-29 04:07:46', 0),
(152, 76, 115, '2018-11-29 04:07:46', 0),
(153, 76, 141, '2018-11-29 04:07:46', 0),
(154, 76, 112, '2018-11-29 04:07:46', 0),
(155, 76, 129, '2018-11-29 04:07:46', 0),
(156, 76, 142, '2018-11-29 04:07:46', 0),
(157, 76, 110, '2018-11-29 04:07:46', 0),
(158, 76, 114, '2018-11-29 04:07:46', 0),
(159, 76, 96, '2018-11-29 04:07:46', 0),
(160, 76, 99, '2018-11-29 04:07:46', 0),
(161, 76, 143, '2018-11-29 04:07:46', 0),
(162, 76, 151, '2018-11-29 04:07:46', 0),
(163, 76, 91, '2018-11-29 04:07:46', 0),
(164, 76, 154, '2018-11-29 04:07:46', 0),
(165, 76, 79, '2018-11-29 04:07:46', 0),
(166, 76, 144, '2018-11-29 04:07:46', 0),
(167, 76, 145, '2018-11-29 04:07:46', 0),
(168, 76, 156, '2018-11-29 04:07:46', 0),
(169, 76, 149, '2018-11-29 04:07:46', 0),
(170, 76, 118, '2018-11-29 04:07:46', 0),
(171, 76, 92, '2018-11-29 04:07:46', 0),
(172, 76, 159, '2018-11-29 04:07:46', 0),
(173, 76, 73, '2018-11-29 04:07:46', 0),
(174, 76, 88, '2018-11-29 04:07:46', 0),
(175, 76, 100, '2018-11-29 04:07:46', 0),
(176, 76, 162, '2018-11-29 04:07:46', 0),
(177, 76, 106, '2018-11-29 04:07:46', 0),
(178, 76, 105, '2018-11-29 04:07:46', 0),
(179, 76, 122, '2018-11-29 04:07:46', 0),
(180, 76, 97, '2018-11-29 04:07:46', 0),
(181, 76, 157, '2018-11-29 04:07:46', 0),
(182, 76, 161, '2018-11-29 04:07:46', 0),
(183, 76, 130, '2018-11-29 04:07:46', 0),
(184, 76, 117, '2018-11-29 04:07:46', 0),
(185, 76, 95, '2018-11-29 04:07:46', 0),
(186, 76, 104, '2018-11-29 04:07:46', 0),
(187, 76, 148, '2018-11-29 04:07:46', 0),
(188, 76, 152, '2018-11-29 04:07:46', 0),
(189, 76, 146, '2018-11-29 04:07:46', 0),
(190, 76, 82, '2018-11-29 04:07:46', 0),
(191, 76, 109, '2018-11-29 04:07:46', 0),
(192, 76, 74, '2018-11-29 04:07:46', 0),
(193, 76, 147, '2018-11-29 04:07:46', 0),
(194, 76, 80, '2018-11-29 04:07:46', 0),
(195, 76, 89, '2018-11-29 04:07:46', 0),
(196, 76, 77, '2018-11-29 04:07:46', 0),
(197, 76, 94, '2018-11-29 04:07:46', 0),
(198, 76, 125, '2018-11-29 04:07:46', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `last_name` varchar(500) NOT NULL,
  `first_name` varchar(500) NOT NULL,
  `middle_name` varchar(500) NOT NULL,
  `birth_date` timestamp NULL DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `address` varchar(1000) DEFAULT NULL,
  `phone_number` varchar(50) DEFAULT NULL,
  `email_address` varchar(100) DEFAULT NULL,
  `bank_account_number` varchar(200) DEFAULT NULL,
  `sss_number` varchar(100) DEFAULT NULL,
  `hdmf_number` varchar(100) DEFAULT NULL,
  `philhealth_number` varchar(100) DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `employee_id` (`employee_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=146 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `employee_id`, `last_name`, `first_name`, `middle_name`, `birth_date`, `gender`, `address`, `phone_number`, `email_address`, `bank_account_number`, `sss_number`, `hdmf_number`, `philhealth_number`, `deleted`) VALUES
(53, 78, 'berenguel', 'mae', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(33, 1, 'administrator', 'administrator', 'administrator', '1988-08-04 16:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(59, 84, 'cuerda', 'renemae', 'm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(58, 83, 'achache', 'patrick', '', '2018-09-04 16:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(57, 82, 'tabañag', 'hazel', 'f', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(56, 81, 'arnaiz', 'jessica', 'g', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(55, 80, 'teopiz', 'rosanne lorell', 'd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(54, 79, 'nabong', 'maxim dominique', 'a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(50, 75, 'gonzales', 'matt', 'g', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(51, 76, 'biera', 'joenaniña', 'o', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(52, 77, 'tuastuman', 'mae lizza', 'j', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(48, 73, 'paradela', 'charity may', 'm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(49, 74, 'tanga-an', 'ma. aurora faye', 'e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(60, 85, 'hermosisima', 'john christian', 'd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(61, 86, 'apostol', 'elrhey', 'a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(62, 87, 'demol', 'john rey', 'r', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(63, 88, 'paragoso', 'jay harvey', 's', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(64, 89, 'tolentino', 'john michael', 'b', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(65, 90, 'cabalhug', 'jaia leah', 's', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(66, 91, 'misa', 'kent victor', 'c', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(67, 92, 'panes', 'lelaine', 'c', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(68, 93, 'amiler', 'jenifer', 'e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(69, 94, 'tural', 'cyrus jay', 'm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(70, 95, 'salaysay', 'ed michael', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(71, 96, 'mari', 'yvonne  grace', 'g', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(72, 97, 'reiter', 'anna', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(73, 98, 'baguio', 'jassel', 'd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(74, 99, 'martinito', 'vincent khy nhel', 'c', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(75, 100, 'pati-on ', 'angelie', 'a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(76, 101, 'eugenio', 'jenny', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(77, 102, 'balbuena', 'trishia mae', 'b', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(78, 103, 'dela torre', 'mario', 's', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(79, 104, 'saurio', 'janry', 'e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(80, 105, 'pugata', 'angelie', 'c', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(81, 106, 'plata', 'glenmar', 'g', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(82, 107, 'carreon', 'sulpicio jr', 'e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(83, 108, 'anni', 'wedz-ar', 'j', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(84, 109, 'tabar', 'mark francis', 'c', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(85, 110, 'maglasang', 'mark vicent', 's', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(86, 111, 'gagani', 'grethel', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(87, 112, 'laurente', 'rowena', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(88, 113, 'bawa-an', 'ma. riam', 'b', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(89, 114, 'magsalay', 'rhelyn', 'a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(90, 115, 'lastimoso', 'joanne', 'j', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(91, 116, 'gilos', 'rudney', 'g', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(92, 117, 'salas', 'job', 'c', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(93, 118, 'ortega', 'daryll', 'b', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(94, 119, 'angot', 'calvin', 'm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(95, 120, 'alama', 'catherine kie', 'b', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(96, 121, 'bacus', 'charisse marie', 's', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(97, 122, 'ramirez', 'sanjey', 'g', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(98, 123, 'cerelegia', 'mary joy', 'v', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(99, 124, 'idol', 'jelly mae', 'h', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(100, 125, 'ybañez', 'elnalyn', 'v', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(101, 126, 'capilitan', 'roselle', 'e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(102, 127, 'caraca', 'jenny', 'r', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(103, 128, 'carillo', 'julie ann', 'l', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(104, 129, 'loquinario', 'melony', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(105, 130, 'romaguera', 'raquel', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(106, 131, 'labajo', 'joe june jr', 'm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(107, 132, 'almonia', 'lourdes regina', 'p', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(108, 133, 'alchivar', 'iraida', 'c', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(137, 162, 'perino', 'ben', ' ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(109, 134, 'aro', 'avegail ', 'maris', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(110, 135, 'baguid', 'rizza mae', ' ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(111, 136, 'bobier', 'cyra', ' ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(112, 137, 'calupas', 'edgar', ' ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(113, 138, 'dela conception', 'jadenessa', ' ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(114, 139, 'dole', 'josalyn', ' ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(115, 140, 'encabo', 'maria jane', ' ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(116, 141, 'laude', 'david', ' ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(117, 142, 'maggallanes', 'errah', ' ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(118, 143, 'mascardo', 'jeizel', ' ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(119, 144, 'narit', 'angelina', ' ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(120, 145, 'oliva', 'rica', ' ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(121, 146, 'suerte', 'mary ann', ' ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(122, 147, 'templa', 'thonjay', ' ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(123, 148, 'servande', 'joellah', ' ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(124, 149, 'omandam', 'john dave', ' ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(125, 150, 'getutua', 'dona', ' ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(126, 151, 'melgar', 'maria crysteal', ' ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(127, 152, 'soroño', 'chareen', ' ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(128, 153, 'fuentes', 'justine nicole', ' ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(129, 154, 'mondares', 'john rey', ' ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(130, 155, 'campesao', 'charlotte', ' ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(131, 156, 'olivo', 'kimberly', ' ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(132, 157, 'repollo', 'charmayne', ' ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(133, 158, 'boaquin', 'verner', ' ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(134, 159, 'papellero', 'christhel', ' ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(135, 160, 'cuizon', 'gerlie gay', ' ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(136, 161, 'requinto', 'evangeline', ' ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(138, 163, 'asdfadsfasd', 'fdasfads', 'fasdfasdfsdaf', '0000-00-00 00:00:00', 'Male', 'fdasfdsaf', '213213', 'dsfsdfsadfs@fdsafasdf.gfdsgdsfg', 'dsfsdfsdf', 'sdafdsaf', 'adsfasdfsda', 'dsfdsafdsf', 0),
(139, 164, 'asdfadsfasdfdfdf', 'fdasfadsfdfdf', 'fasdfasdfsdafdfdf', '0000-00-00 00:00:00', 'Male', 'fdasfdsaf', '213213', 'dsfsdfsadfs@fdsafasdf.gfdsgdsfg', 'dsfsdfsdf', 'sdafdsaf', 'adsfasdfsda', 'dsfdsafdsf', 0),
(140, 165, 'asdfadsfasdfdfdfdfdffd', 'fdasfadsfdfdffdfd', 'fasdfasdfsdafdfdffdfdf', '0000-00-00 00:00:00', 'Male', 'fdasfdsaf', '213213', 'dsfsdfsadfs@fdsafasdf.gfdsgdsfg', 'dsfsdfsdf', 'sdafdsaf', 'adsfasdfsda', 'dsfdsafdsf', 0),
(141, 166, 'Doe', 'John', 'NA', '0000-00-00 00:00:00', 'Male', 'California', '01789354', 'johndoe@email.com', NULL, NULL, NULL, NULL, 0),
(142, 167, 'Doe', 'John Doe', 'NA', '0000-00-00 00:00:00', 'Male', 'Arkansas', '0123489', 'johndoe@email.com', '893923', '23213', NULL, NULL, 0),
(143, 168, 'fdfdfdf', 'fdfd', 'fdfdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(144, 169, 'dfdfd', 'fdfdfd', 'fdfdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(145, 170, 'User', 'Sample', 'NA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(500) NOT NULL,
  `middle_name` varchar(500) NOT NULL,
  `last_name` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `first_name`, `middle_name`, `last_name`) VALUES
(1, 'job', 'c', 'salas'),
(2, 'joe', 'j', 'labajo');

-- --------------------------------------------------------

--
-- Table structure for table `employee_details`
--

DROP TABLE IF EXISTS `employee_details`;
CREATE TABLE IF NOT EXISTS `employee_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `field` varchar(500) NOT NULL,
  `value` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_details`
--

INSERT INTO `employee_details` (`id`, `employee_id`, `field`, `value`) VALUES
(1, 1, 'contact_number', '123456'),
(2, 1, 'email', 'jcs@gmail.com'),
(3, 1, 'address', 'toledo city'),
(4, 1, 'address', 'toledo city'),
(5, 1, 'marital_status', 'married'),
(6, 2, 'address', 'tisa, labangon'),
(7, 2, 'marital_status', 'it\'s complicated');

-- --------------------------------------------------------

--
-- Table structure for table `employee_shift`
--

DROP TABLE IF EXISTS `employee_shift`;
CREATE TABLE IF NOT EXISTS `employee_shift` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `shift_code` int(11) NOT NULL,
  `shift_details` varchar(200) NOT NULL,
  `time_in` time(6) NOT NULL,
  `time_out` time(6) NOT NULL,
  `break_in` time(6) DEFAULT NULL,
  `break_out` time(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_shift`
--

INSERT INTO `employee_shift` (`id`, `employee_id`, `shift_code`, `shift_details`, `time_in`, `time_out`, `break_in`, `break_out`) VALUES
(51, 76, 3, 'The quick brown fox jumps over the lazy dog near the bank of the river', '07:00:00.000000', '16:00:00.000000', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employment_information`
--

DROP TABLE IF EXISTS `employment_information`;
CREATE TABLE IF NOT EXISTS `employment_information` (
  `empinfo_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `field_name` varchar(500) NOT NULL,
  `field_value` varchar(1000) NOT NULL,
  `effectivity_date` date NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`empinfo_id`)
) ENGINE=MyISAM AUTO_INCREMENT=240 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employment_information`
--

INSERT INTO `employment_information` (`empinfo_id`, `employee_id`, `field_name`, `field_value`, `effectivity_date`, `date_added`, `deleted`) VALUES
(1, 73, 'department', '7', '2018-09-04', '2018-09-04 08:12:41', 0),
(2, 74, 'department', '14', '2018-09-04', '2018-09-04 08:12:41', 0),
(3, 75, 'department', '9', '2018-09-04', '2018-09-04 08:12:41', 0),
(4, 76, 'department', '5', '2018-09-04', '2018-09-04 08:12:41', 0),
(5, 77, 'department', '6', '2018-09-04', '2018-09-04 08:12:41', 0),
(6, 78, 'department', '9', '2018-09-04', '2018-09-04 08:12:41', 0),
(7, 79, 'department', '9', '2018-09-04', '2018-09-04 08:12:41', 0),
(8, 80, 'department', '9', '2018-09-04', '2018-09-04 08:12:41', 0),
(9, 81, 'department', '9', '2018-09-04', '2018-09-04 08:12:41', 0),
(10, 82, 'department', '14', '2018-09-04', '2018-09-04 08:12:41', 0),
(11, 83, 'department', '8', '2018-09-04', '2018-09-04 08:12:41', 0),
(12, 84, 'department', '6', '2018-09-04', '2018-09-04 08:12:41', 0),
(13, 85, 'department', '9', '2018-09-04', '2018-09-04 08:12:41', 0),
(14, 86, 'department', '9', '2018-09-04', '2018-09-04 08:12:41', 0),
(15, 87, 'department', '9', '2018-09-04', '2018-09-04 08:12:41', 0),
(16, 88, 'department', '9', '2018-09-04', '2018-09-04 08:12:41', 0),
(17, 89, 'department', '7', '2018-09-04', '2018-09-04 08:12:41', 0),
(18, 90, 'department', '9', '2018-09-04', '2018-09-04 08:12:41', 0),
(19, 91, 'department', '7', '2018-09-04', '2018-09-04 08:12:41', 0),
(20, 92, 'department', '9', '2018-09-04', '2018-09-04 08:12:41', 0),
(21, 93, 'department', '9', '2018-09-04', '2018-09-04 08:12:41', 0),
(22, 94, 'department', '9', '2018-09-04', '2018-09-04 08:12:41', 0),
(23, 95, 'department', '7', '2018-09-04', '2018-09-04 08:12:41', 0),
(24, 96, 'department', '5', '2018-09-04', '2018-09-04 08:12:41', 0),
(25, 97, 'department', '8', '2018-09-04', '2018-09-04 08:12:41', 0),
(26, 98, 'department', '5', '2018-09-04', '2018-09-04 08:12:41', 0),
(27, 99, 'department', '9', '2018-09-04', '2018-09-04 08:12:41', 0),
(28, 100, 'department', '9', '2018-09-04', '2018-09-04 08:12:41', 0),
(29, 101, 'department', '9', '2018-09-04', '2018-09-04 08:12:41', 0),
(30, 102, 'department', '9', '2018-09-04', '2018-09-04 08:12:41', 0),
(31, 103, 'department', '9', '2018-09-04', '2018-09-04 08:12:41', 0),
(32, 104, 'department', '9', '2018-09-04', '2018-09-04 08:12:41', 0),
(33, 105, 'department', '6', '2018-09-04', '2018-09-04 08:12:41', 0),
(34, 106, 'department', '9', '2018-09-04', '2018-09-04 08:12:41', 0),
(35, 107, 'department', '7', '2018-09-04', '2018-09-04 08:12:41', 0),
(36, 108, 'department', '7', '2018-09-04', '2018-09-04 08:12:41', 0),
(37, 109, 'department', '9', '2018-09-04', '2018-09-04 08:12:41', 0),
(38, 110, 'department', '9', '2018-09-04', '2018-09-04 08:12:41', 0),
(39, 111, 'department', '9', '2018-09-04', '2018-09-04 08:12:41', 0),
(40, 112, 'department', '9', '2018-09-04', '2018-09-04 08:12:41', 0),
(41, 113, 'department', '9', '2018-09-04', '2018-09-04 08:12:41', 0),
(42, 114, 'department', '9', '2018-09-04', '2018-09-04 08:12:41', 0),
(43, 115, 'department', '9', '2018-09-04', '2018-09-04 08:12:41', 0),
(44, 116, 'department', '9', '2018-09-04', '2018-09-04 08:12:41', 0),
(45, 117, 'department', '7', '2018-09-04', '2018-09-04 08:12:41', 0),
(46, 118, 'department', '9', '2018-09-04', '2018-09-04 08:12:41', 0),
(47, 119, 'department', '9', '2018-09-04', '2018-09-04 08:12:41', 0),
(48, 120, 'department', '9', '2018-09-04', '2018-09-04 08:12:41', 0),
(49, 121, 'department', '9', '2018-09-04', '2018-09-04 08:12:41', 0),
(50, 122, 'department', '9', '2018-09-04', '2018-09-04 08:12:41', 0),
(51, 123, 'department', '9', '2018-09-04', '2018-09-04 08:12:41', 0),
(52, 124, 'department', '9', '2018-09-04', '2018-09-04 08:12:41', 0),
(53, 125, 'department', '9', '2018-09-04', '2018-09-04 08:12:41', 0),
(54, 126, 'department', '9', '2018-09-04', '2018-09-04 08:12:41', 0),
(55, 127, 'department', '9', '2018-09-04', '2018-09-04 08:12:41', 0),
(56, 128, 'department', '9', '2018-09-04', '2018-09-04 08:12:41', 0),
(57, 129, 'department', '9', '2018-09-04', '2018-09-04 08:12:41', 0),
(58, 130, 'department', '9', '2018-09-04', '2018-09-04 08:12:41', 0),
(59, 131, 'department', '7', '2018-09-04', '2018-09-04 08:12:41', 0),
(60, 132, 'department', '8', '2018-09-04', '2018-09-04 08:12:41', 0),
(61, 133, 'department', '8', '2018-09-04', '2018-09-04 08:12:41', 0),
(62, 73, 'type', 'Department Head', '2018-09-04', '2018-09-04 08:19:59', 0),
(63, 81, 'type', 'Department Head', '2018-09-04', '2018-09-04 08:19:59', 0),
(64, 74, 'type', 'Department Head', '2018-09-04', '2018-09-04 08:19:59', 0),
(65, 78, 'type', 'Department Head', '2018-09-04', '2018-09-04 08:19:59', 0),
(66, 71, 'type', 'Department Head', '2018-09-04', '2018-09-04 08:19:59', 0),
(67, 77, 'type', 'Department Head', '2018-09-04', '2018-09-04 08:19:59', 0),
(68, 76, 'type', 'Department Head', '2018-09-04', '2018-09-04 08:19:59', 0),
(129, 83, 'department', '8', '2018-09-04', '2018-09-04 08:12:41', 0),
(70, 90, 'type', 'Department Head', '2018-09-04', '2018-09-04 08:19:59', 0),
(71, 134, 'level', 'employee', '2018-10-18', '2018-10-18 07:27:56', 0),
(72, 134, 'department', '9', '2018-10-18', '2018-10-18 07:27:56', 0),
(73, 135, 'level', 'employee', '2018-10-18', '2018-10-18 07:29:27', 0),
(74, 135, 'department', '9', '2018-10-18', '2018-10-18 07:29:27', 0),
(75, 136, 'level', 'employee', '2018-10-18', '2018-10-18 07:30:39', 0),
(76, 136, 'department', '9', '2018-10-18', '2018-10-18 07:30:39', 0),
(77, 137, 'level', 'employee', '2018-10-18', '2018-10-18 07:31:38', 0),
(78, 137, 'department', '9', '2018-10-18', '2018-10-18 07:31:38', 0),
(79, 138, 'level', 'employee', '2018-10-18', '2018-10-18 07:32:30', 0),
(80, 139, 'level', 'employee', '2018-10-18', '2018-10-18 07:33:12', 0),
(81, 139, 'department', '9', '2018-10-18', '2018-10-18 07:33:12', 0),
(82, 140, 'level', 'employee', '2018-10-18', '2018-10-18 07:34:08', 0),
(83, 140, 'department', '9', '2018-10-18', '2018-10-18 07:34:08', 0),
(84, 141, 'level', 'employee', '2018-10-18', '2018-10-18 07:35:23', 0),
(85, 141, 'department', '9', '2018-10-18', '2018-10-18 07:35:23', 0),
(86, 142, 'level', 'employee', '2018-10-18', '2018-10-18 07:36:17', 0),
(87, 142, 'department', '9', '2018-10-18', '2018-10-18 07:36:17', 0),
(88, 143, 'level', 'employee', '2018-10-18', '2018-10-18 07:37:09', 0),
(89, 143, 'department', '9', '2018-10-18', '2018-10-18 07:37:09', 0),
(90, 144, 'level', 'employee', '2018-10-18', '2018-10-18 07:37:57', 0),
(91, 144, 'department', '9', '2018-10-18', '2018-10-18 07:37:57', 0),
(92, 145, 'level', 'employee', '2018-10-18', '2018-10-18 07:38:37', 0),
(93, 145, 'department', '9', '2018-10-18', '2018-10-18 07:38:37', 0),
(94, 146, 'level', 'employee', '2018-10-18', '2018-10-18 07:39:34', 0),
(95, 146, 'department', '9', '2018-10-18', '2018-10-18 07:39:34', 0),
(96, 147, 'level', 'employee', '2018-10-18', '2018-10-18 07:40:56', 0),
(97, 147, 'department', '9', '2018-10-18', '2018-10-18 07:40:56', 0),
(98, 148, 'level', 'employee', '2018-10-18', '2018-10-18 07:41:59', 0),
(99, 148, 'department', '9', '2018-10-18', '2018-10-18 07:41:59', 0),
(100, 149, 'level', 'employee', '2018-10-18', '2018-10-18 07:43:36', 0),
(101, 149, 'department', '9', '2018-10-18', '2018-10-18 07:43:36', 0),
(102, 150, 'level', 'employee', '2018-10-18', '2018-10-18 07:44:20', 0),
(103, 150, 'department', '9', '2018-10-18', '2018-10-18 07:44:20', 0),
(104, 151, 'level', 'employee', '2018-10-18', '2018-10-18 07:45:08', 0),
(105, 151, 'department', '9', '2018-10-18', '2018-10-18 07:45:08', 0),
(106, 152, 'level', 'employee', '2018-10-18', '2018-10-18 07:45:58', 0),
(107, 152, 'department', '9', '2018-10-18', '2018-10-18 07:45:58', 0),
(108, 153, 'level', 'employee', '2018-10-18', '2018-10-18 07:46:52', 0),
(109, 153, 'department', '9', '2018-10-18', '2018-10-18 07:46:52', 0),
(110, 154, 'level', 'employee', '2018-10-18', '2018-10-18 07:47:43', 0),
(111, 154, 'department', '9', '2018-10-18', '2018-10-18 07:47:43', 0),
(112, 155, 'level', 'employee', '2018-10-18', '2018-10-18 07:48:35', 0),
(113, 155, 'department', '9', '2018-10-18', '2018-10-18 07:48:35', 0),
(114, 156, 'level', 'employee', '2018-10-18', '2018-10-18 07:49:44', 0),
(115, 156, 'department', '9', '2018-10-18', '2018-10-18 07:49:44', 0),
(116, 157, 'level', 'employee', '2018-10-18', '2018-10-18 07:50:22', 0),
(117, 157, 'department', '9', '2018-10-18', '2018-10-18 07:50:22', 0),
(118, 158, 'level', 'employee', '2018-10-18', '2018-10-18 07:51:13', 0),
(119, 158, 'department', '9', '2018-10-18', '2018-10-18 07:51:13', 0),
(120, 159, 'level', 'employee', '2018-10-18', '2018-10-18 07:55:32', 0),
(121, 159, 'department', '9', '2018-10-18', '2018-10-18 07:55:32', 0),
(122, 160, 'level', 'employee', '2018-10-18', '2018-10-18 07:56:21', 0),
(123, 160, 'department', '9', '2018-10-18', '2018-10-18 07:56:21', 0),
(124, 161, 'level', 'employee', '2018-10-18', '2018-10-18 07:57:08', 0),
(125, 161, 'department', '9', '2018-10-18', '2018-10-18 07:57:08', 0),
(126, 162, 'type', 'Department Head', '2018-10-18', '2018-10-18 08:08:54', 0),
(127, 162, 'department', '7', '2018-10-18', '2018-10-18 08:08:54', 0),
(128, 162, 'type', 'Department Head', '2018-09-04', '2018-09-04 08:19:59', 0),
(130, 97, 'department', '8', '2018-09-04', '2018-09-04 08:12:41', 0),
(131, 97, 'type', 'Department Head', '2018-09-04', '2018-09-04 08:19:59', 0),
(132, 83, 'type', 'Department Head', '2018-09-04', '2018-09-04 08:19:59', 0),
(133, 90, 'type', 'Department Head', '2018-09-04', '2018-09-04 08:19:59', 0),
(134, 88, 'type', 'Department Head', '2018-09-04', '2018-09-04 08:19:59', 0),
(135, 75, 'type', 'Department Head', '2018-09-04', '2018-09-04 08:19:59', 0),
(136, 85, 'type', 'Department Head', '2018-09-04', '2018-09-04 08:19:59', 0),
(137, 86, 'type', 'Department Head', '2018-09-04', '2018-09-04 08:19:59', 0),
(138, 93, 'type', 'Department Head', '2018-09-04', '2018-09-04 08:19:59', 0),
(139, 165, 'date_hired', '11/12/2019', '2019-11-12', '2019-11-12 12:19:27', 0),
(140, 165, 'position', '3', '2019-11-12', '2019-11-12 12:19:27', 0),
(141, 165, 'level', 'employee', '2019-11-12', '2019-11-12 12:19:27', 0),
(142, 165, 'department', '5', '2019-11-12', '2019-11-12 12:19:27', 0),
(143, 165, 'employment_status', 'Probationary', '2019-11-12', '2019-11-12 12:19:27', 0),
(144, 165, 'positionfd', '1', '2019-11-12', '2019-11-12 12:19:27', 0),
(145, 165, 'salary', '200000', '2019-11-12', '2019-11-12 12:19:27', 0),
(222, 73, 'employment_status', 'Regular', '2019-11-12', '2019-11-12 12:34:21', 0),
(223, 166, 'date_hired', '12/08/2019', '2019-12-08', '2019-12-08 09:17:17', 0),
(224, 166, 'level', 'employee', '2019-12-08', '2019-12-08 09:17:17', 0),
(225, 167, 'date_hired', '12/08/2019', '2019-12-08', '2019-12-08 10:21:52', 0),
(226, 167, 'position', '3', '2019-12-08', '2019-12-08 10:21:52', 0),
(227, 167, 'level', 'employee', '2019-12-08', '2019-12-08 10:21:52', 0),
(228, 167, 'department', '7', '2019-12-08', '2019-12-08 10:21:52', 0),
(229, 167, 'employment_status', 'Probationary', '2019-12-08', '2019-12-08 10:21:52', 0),
(230, 167, 'marital_status', 'Single', '2019-12-08', '2019-12-08 10:21:52', 0),
(231, 167, 'salary', '500000', '2019-12-08', '2019-12-08 10:21:52', 0),
(232, 168, 'level', 'employee', '2019-12-08', '2019-12-08 10:29:45', 0),
(233, 169, 'date_hired', '12/08/2019', '2019-12-08', '2019-12-08 10:35:59', 0),
(234, 169, 'level', 'employee', '2019-12-08', '2019-12-08 10:35:59', 0),
(235, 170, 'date_hired', '12/08/2019', '2019-12-08', '2019-12-08 10:40:42', 0),
(236, 170, 'position', '13', '2019-12-08', '2019-12-08 10:40:42', 0),
(237, 170, 'level', 'employee', '2019-12-08', '2019-12-08 10:40:42', 0),
(238, 170, 'department', '7', '2019-12-08', '2019-12-08 10:40:42', 0),
(239, 170, 'employment_status', 'Probationary', '2019-12-08', '2019-12-08 10:40:42', 0);

-- --------------------------------------------------------

--
-- Table structure for table `evaluation`
--

DROP TABLE IF EXISTS `evaluation`;
CREATE TABLE IF NOT EXISTS `evaluation` (
  `evaluation_id` int(11) NOT NULL AUTO_INCREMENT,
  `attribute_id` int(11) NOT NULL DEFAULT '0',
  `position` int(11) NOT NULL DEFAULT '0',
  `rating` varchar(100) NOT NULL,
  `rating_value` decimal(10,0) NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`evaluation_id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `evaluation`
--

INSERT INTO `evaluation` (`evaluation_id`, `attribute_id`, `position`, `rating`, `rating_value`, `comment`) VALUES
(1, 1, 1, 'POOR', '5', 'Has made frequent errors that are harmful to business operations.<br/>\r\nThe supervisor/department head has received numerous complaints about the quality of work.<br/>\r\nThe quality of work produced is unacceptable.'),
(2, 1, 2, 'Needs Improvement', '10', 'Is not as careful in checking work product for errors as he/she could be.<br/>\r\nTends to miss small errors in work product.'),
(3, 1, 3, 'Meets Requirements', '15', 'Does not require constant supervision.<br/>\r\nError rate is acceptable, and all work is completed timely.'),
(4, 1, 4, 'Exceeds Requirements', '20', 'Managers and co-workers have commented on high levels of accuracy.<br/>\r\nTakes pride in work and strives to improve work performance.<br/>\r\nAll memos, reports, forms and correspondence are completed on time with no errors.'),
(5, 1, 5, 'Outstanding', '25', 'Has less than a 1% error rate on work product.<br/>\r\nAccuracy is excellent.'),
(6, 2, 1, 'POOR', '5', 'Incomplete reports.<br/>\r\nInaccurate reports.'),
(7, 2, 2, 'Needs Improvement', '10', 'Required paperwork is completed late or is only partially complete.'),
(8, 2, 3, 'Meets Requirements', '15', 'Does not require constant supervision.<br/>\r\nForms and required paperwork are completed on time with minimal errors.'),
(9, 2, 4, 'Exceeds Requirements', '20', 'Managers and co-workers have commented on high levels of work productivity.<br/>Takes pride in work and strives to improve work performance.<br/>All memos, reports, forms and correspondence are completed on time with no errors.'),
(10, 2, 5, 'Outstanding', '25', 'Quantity of work produced is outstanding or error free reports.'),
(11, 3, 1, 'POOR', '1', 'Reports, forms, memos and correspondence are often completed late or not at all.<br/>\r\nUses a condescending tone when talking to others in the office.'),
(12, 3, 2, 'Needs Improvement', '2', 'The supervisor/department head has received a few complaints about contradictory or bad information being given out by the employee.<br/>\r\nPhone messages are often unclear or incomplete.'),
(13, 3, 3, 'Meets Requirements', '4', 'Takes messages, writes correspondence, deals with customers and coworkers with sufficient attention to detail.<br/>\r\nReports are accurate and well written using proper grammar and punctuation.'),
(14, 3, 4, 'Exceeds Requirements', '6', 'Students and coworkers feel comfortable coming to this employee with questions and comments.<br/>\r\nComes to supervisor/department head with any questions that employee does not know off-hand.'),
(15, 3, 5, 'Outstanding', '8', 'Always asks questions and seeks guidance when not sure of what to do.<br/>\r\nDemonstrates excellent oral and written communication skills.'),
(16, 4, 1, 'POOR', '1', 'Frequently comes to the wrong conclusions and assumes things.<br/>\r\nDid not make sure that all subordinates were productive at all times, which is a daily requirement of this job.'),
(17, 4, 2, 'Needs Improvement', '3', 'Needs to develop analytical skills necessary to weigh options and choose the best way to deal with situations.<br/>\r\nSpends too much time focusing on less important aspects of daily job.'),
(18, 4, 3, 'Meets Requirements', '5', 'Often offers workable solutions to problems.<br/>\r\nUses good judgment in solving problems and working with others.<br/>\r\nUses PPR ratings in making decisions related to new hires, promotions and merit increases.'),
(19, 4, 4, 'Exceeds Requirements', '7', 'Can zero in on the cause of problems and offer creative solutions.<br/>\r\nDisplays strong analytical skills.'),
(20, 4, 5, 'Outstanding', '9', 'Always offers ideas to solve problems based on good information and sound judgment.<br/>\r\nDisplays initiative and enthusiasm during everyday work.<br/>\r\nConducts research or seeks counsel of experts to gather information needed in making actual decisions.'),
(21, 5, 1, 'POOR', '1', 'Work projects have suffered from lack of follow-through.<br/>\r\nImportant documentation for projects has been lost or destroyed erroneously.<br/>\r\nDoes not plan ahead to meet work deadlines.'),
(22, 5, 2, 'Needs Improvement', '3', 'Does not keep supervisor informed of potential problems as they arise.<br/>\r\nProject plans are poorly designed.<br/>\r\nProject plans are not carried out as assigned or on time.'),
(23, 5, 3, 'Meets Requirements', '5', 'Prepares project plans on time and in sufficient detail.<br/>\r\nEnd of year statements are complete and accurate.<br/>\r\nMaintains and monitors progress of project plan in order to stay on target.'),
(24, 5, 4, 'Exceeds Requirements', '7', 'Gets the most out of scarce resources.<br/>\r\nProjects normally are within budget and are well planned.'),
(25, 5, 5, 'Outstanding', '9', 'Anticipates problems before they occur.<br/>\r\nProvides meaningful information to decision makers that helps in the preparation and implementation of projects.<br/>\r\nPlans projects and carries them out so that projects are completed ahead of schedule and under budget.'),
(26, 6, 1, 'POOR', '1', 'Often calls in to work without prior approval, resulting in excessive unscheduled absences.<br/>\r\nLeaves the work area unattended to run personal errands.<br/>\r\nIs frequently late to work.<br/>\r\nFrequently leaves work early.'),
(27, 6, 2, 'Needs Improvement', '3', 'Occasionally calls in to work without prior approval, resulting in unscheduled absences.<br/>\r\nOccasionally arrives late to work.<br/>\r\nSometimes does not make sure all work is completed before leaving for the day.<br/>\r\nOccasionally leaves work early.'),
(28, 6, 3, 'Meets Requirements', '5', 'Consistently arrives to work on time.<br/>\r\nMakes sure work area is covered at all times.<br/>\r\nHas had no unscheduled absences, except for documented emergencies.'),
(29, 6, 4, 'Exceeds Requirements', '7', 'Has a good attendance record.<br/>\r\nCan always be counted on to work overtime when necessary without complaint.'),
(30, 6, 5, 'Outstanding', '9', 'Always at work and on time.<br/>\r\nNever misses work without prior approval and appropriate notification.<br/>\r\nHas had no unscheduled absences during the rating period.'),
(31, 7, 1, 'POOR', '1', ''),
(32, 7, 2, 'Needs Improvement', '2', ''),
(33, 7, 3, 'Meets Requirements', '3', ''),
(34, 7, 4, 'Exceeds Expectations', '4', ''),
(35, 7, 5, 'OutStanding', '5', ''),
(36, 8, 1, 'POOR', '1', ''),
(37, 8, 2, 'Needs Improvement', '2', ''),
(38, 8, 3, 'Meets Requirements', '3', ''),
(39, 8, 4, 'Exceeds Expectations', '4', ''),
(40, 8, 5, 'Outstanding', '5', ''),
(41, 9, 1, 'POOR', '1', ''),
(42, 9, 2, 'Needs Improvement', '2', ''),
(43, 9, 3, 'Meets Requirements', '3', ''),
(44, 9, 4, 'Exceeds Expectations', '4', ''),
(45, 9, 5, 'Outstanding', '5', '');

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_attribute`
--

DROP TABLE IF EXISTS `evaluation_attribute`;
CREATE TABLE IF NOT EXISTS `evaluation_attribute` (
  `attr_id` int(11) NOT NULL AUTO_INCREMENT,
  `attr_title` varchar(500) NOT NULL,
  `position` int(11) NOT NULL,
  `attr_comment` text NOT NULL,
  PRIMARY KEY (`attr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `evaluation_attribute`
--

INSERT INTO `evaluation_attribute` (`attr_id`, `attr_title`, `position`, `attr_comment`) VALUES
(1, 'QUALITY', 1, 'The quality of work produced by the employee.'),
(2, 'QUANTITY', 2, 'The quantity of work produced by the employee.'),
(3, 'COMMUNICATION - giving and receiving information', 3, 'Self-management'),
(4, 'DAILY DECISION MAKING/ PROBLEM SOLVING', 4, 'Self-management'),
(5, 'PROJECT PLANNING AND IMPLEMENTATION', 5, 'Self-management'),
(6, 'DEPENDABILITY - Being where he/she should be doing what he/she is supposed to do.', 6, 'Self-management'),
(7, 'RELATIONSHIP W/ IMMEDIATE SUPERIOR', 7, 'Working Relationships'),
(8, 'RELATIONSHIP W/ CO-WORKERS', 8, 'Working Relationships'),
(9, 'CUSTOMER SERVICE', 9, 'Working relationship');

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_general`
--

DROP TABLE IF EXISTS `evaluation_general`;
CREATE TABLE IF NOT EXISTS `evaluation_general` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `el_id` int(11) NOT NULL,
  `column` varchar(100) NOT NULL,
  `value` text NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `evaluation_general`
--

INSERT INTO `evaluation_general` (`id`, `el_id`, `column`, `value`, `date_added`, `deleted`) VALUES
(1, 12, 'strength', 'test', '2018-11-29 04:09:26', 0),
(2, 12, 'weakness', 'test', '2018-11-29 04:09:26', 0),
(3, 12, 'improvement', 'test', '2018-11-29 04:09:26', 0),
(4, 12, 'development', 'test', '2018-11-29 04:09:26', 0),
(5, 12, 'overall_recommendation', 'test', '2018-11-29 04:09:26', 0),
(6, 10, 'strength', 's', '2018-12-17 08:53:48', 0),
(7, 10, 'weakness', 'w', '2018-12-17 08:53:48', 0),
(8, 10, 'improvement', 'p', '2018-12-17 08:53:48', 0),
(9, 10, 'development', 't', '2018-12-17 08:53:48', 0),
(10, 10, 'overall_recommendation', 'o', '2018-12-17 08:53:48', 0),
(11, 13, 'strength', '', '2018-12-21 10:35:24', 0),
(12, 13, 'weakness', '', '2018-12-21 10:35:24', 0),
(13, 13, 'improvement', '', '2018-12-21 10:35:24', 0),
(14, 13, 'development', '', '2018-12-21 10:35:24', 0),
(15, 13, 'overall_recommendation', '', '2018-12-21 10:35:24', 0),
(16, 11, 'strength', '', '2019-01-04 09:36:54', 0),
(17, 11, 'weakness', '', '2019-01-04 09:36:54', 0),
(18, 11, 'improvement', '', '2019-01-04 09:36:54', 0),
(19, 11, 'development', '', '2019-01-04 09:36:54', 0),
(20, 11, 'overall_recommendation', '', '2019-01-04 09:36:54', 0),
(21, 17, 'strength', 'Strength', '2019-12-08 10:48:37', 0),
(22, 17, 'weakness', 'Weakness', '2019-12-08 10:48:37', 0),
(23, 17, 'improvement', 'Plan for Improvement', '2019-12-08 10:48:37', 0),
(24, 17, 'development', 'Training', '2019-12-08 10:48:37', 0),
(25, 17, 'overall_recommendation', 'Overall', '2019-12-08 10:48:37', 0);

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_list`
--

DROP TABLE IF EXISTS `evaluation_list`;
CREATE TABLE IF NOT EXISTS `evaluation_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department` int(11) NOT NULL DEFAULT '0',
  `evaluator` int(11) DEFAULT '0',
  `evaluated` int(11) NOT NULL DEFAULT '0',
  `status` smallint(6) NOT NULL DEFAULT '0',
  `expiry_date` date DEFAULT NULL,
  `evaluation_type` varchar(100) NOT NULL,
  `type` varchar(200) DEFAULT NULL,
  `overall_recommendation` text,
  `overall_comment` text,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `evaluation_list`
--

INSERT INTO `evaluation_list` (`id`, `department`, `evaluator`, `evaluated`, `status`, `expiry_date`, `evaluation_type`, `type`, `overall_recommendation`, `overall_comment`, `date_created`, `deleted`) VALUES
(2, 7, 162, 95, 1, NULL, 'Department Head To Employee', '', NULL, NULL, '2018-10-18 09:24:15', 0),
(3, 7, 162, 117, 1, NULL, 'Department Head To Employee', '', 'no recommendations', '', '2018-10-18 09:32:41', 0),
(4, 8, 97, 73, 1, NULL, 'Department Head To Employee', '', NULL, NULL, '2018-10-18 09:41:53', 0),
(5, 7, 162, 117, 1, NULL, 'Department Head To Employee', '', 'my overall recommendation', 'my overall comment', '2018-11-06 03:29:06', 0),
(6, 7, 162, 131, 1, NULL, 'Department Head To Employee', '', '', 'my comment', '2018-11-06 04:11:37', 0),
(7, 5, 76, 133, 1, NULL, 'Department Head To Employee', '', NULL, NULL, '2018-11-16 04:26:48', 0),
(8, 5, 76, 119, 1, NULL, 'Department Head To Employee', '', NULL, NULL, '2018-11-19 04:39:29', 0),
(9, 5, 76, 93, 1, NULL, 'Department Head To Employee', '', NULL, NULL, '2018-11-19 05:00:22', 0),
(10, 5, 76, 93, 1, NULL, 'Department Head To Employee', '', NULL, NULL, '2018-11-28 02:50:33', 0),
(11, 5, 76, 117, 1, NULL, 'Department Head To Employee', '', NULL, NULL, '2018-11-29 04:08:00', 0),
(12, 5, 76, 119, 1, NULL, 'Department Head To Employee', '', NULL, NULL, '2018-11-29 04:08:10', 0),
(13, 5, 76, 149, 1, NULL, 'Department Head To Employee', '', NULL, NULL, '2018-12-21 10:34:24', 0),
(14, 7, 162, 131, 0, '2019-11-15', 'Department Head To Employee', 'regularization', NULL, NULL, '2019-11-11 20:54:04', 1),
(15, 7, 73, 108, 0, NULL, 'Department Head To Employee', '', NULL, NULL, '2019-12-08 10:41:26', 1),
(16, 7, 162, 117, 0, NULL, 'Department Head To Employee', '', NULL, NULL, '2019-12-08 10:42:16', 0),
(17, 5, 76, 149, 1, NULL, 'Department Head To Employee', '', NULL, NULL, '2019-12-08 10:44:15', 0),
(18, 5, 76, 101, 0, NULL, 'Department Head To Employee', '', NULL, NULL, '2019-12-08 11:00:03', 0);

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_result`
--

DROP TABLE IF EXISTS `evaluation_result`;
CREATE TABLE IF NOT EXISTS `evaluation_result` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `evaluation_list_id` int(11) NOT NULL,
  `evaluation_id` int(11) NOT NULL,
  `evaluator_comments` text,
  `evaluator_recommendations` text,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=118 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `evaluation_result`
--

INSERT INTO `evaluation_result` (`id`, `evaluation_list_id`, `evaluation_id`, `evaluator_comments`, `evaluator_recommendations`, `date_created`, `deleted`) VALUES
(1, 2, 4, '', '', '2018-10-18 09:25:33', 0),
(2, 2, 10, 'yeah', 'year2', '2018-10-18 09:25:33', 0),
(3, 2, 14, 'waley', 'lodi', '2018-10-18 09:25:33', 0),
(4, 2, 19, 'wew', 'wewewew', '2018-10-18 09:25:33', 0),
(5, 2, 25, 'wawa', 'haha', '2018-10-18 09:25:33', 0),
(6, 2, 30, 'test', 'test12', '2018-10-18 09:25:33', 0),
(7, 2, 35, 'wa', 'we', '2018-10-18 09:25:33', 0),
(8, 2, 40, 'we', 'wo', '2018-10-18 09:25:33', 0),
(9, 2, 45, 'wu', 'ta', '2018-10-18 09:25:33', 0),
(10, 4, 5, '', '', '2018-10-18 09:42:41', 0),
(11, 4, 10, '', '', '2018-10-18 09:42:41', 0),
(12, 4, 15, '', '', '2018-10-18 09:42:41', 0),
(13, 4, 20, '', '', '2018-10-18 09:42:41', 0),
(14, 4, 25, '', '', '2018-10-18 09:42:41', 0),
(15, 4, 30, '', '', '2018-10-18 09:42:41', 0),
(16, 4, 35, '', '', '2018-10-18 09:42:41', 0),
(17, 4, 40, '', '', '2018-10-18 09:42:41', 0),
(18, 4, 44, '', '', '2018-10-18 09:42:41', 0),
(19, 5, 5, '', '', '2018-11-06 04:08:59', 0),
(20, 5, 10, '', '', '2018-11-06 04:08:59', 0),
(21, 5, 15, '', '', '2018-11-06 04:08:59', 0),
(22, 5, 20, '', '', '2018-11-06 04:08:59', 0),
(23, 5, 25, '', '', '2018-11-06 04:08:59', 0),
(24, 5, 30, '', '', '2018-11-06 04:08:59', 0),
(25, 5, 35, '', '', '2018-11-06 04:08:59', 0),
(26, 5, 40, '', '', '2018-11-06 04:08:59', 0),
(27, 5, 45, '', '', '2018-11-06 04:08:59', 0),
(28, 3, 1, '', '', '2018-11-06 04:10:18', 0),
(29, 3, 10, '', '', '2018-11-06 04:10:18', 0),
(30, 3, 15, '', '', '2018-11-06 04:10:18', 0),
(31, 3, 20, '', '', '2018-11-06 04:10:18', 0),
(32, 3, 25, '', '', '2018-11-06 04:10:18', 0),
(33, 3, 30, '', '', '2018-11-06 04:10:18', 0),
(34, 3, 35, '', '', '2018-11-06 04:10:18', 0),
(35, 3, 40, '', '', '2018-11-06 04:10:18', 0),
(36, 3, 44, '', '', '2018-11-06 04:10:18', 0),
(37, 6, 5, '', '', '2018-11-06 04:12:13', 0),
(38, 6, 10, '', '', '2018-11-06 04:12:13', 0),
(39, 6, 15, '', '', '2018-11-06 04:12:13', 0),
(40, 6, 20, '', '', '2018-11-06 04:12:13', 0),
(41, 6, 25, '', '', '2018-11-06 04:12:13', 0),
(42, 6, 30, '', '', '2018-11-06 04:12:13', 0),
(43, 6, 35, '', '', '2018-11-06 04:12:13', 0),
(44, 6, 40, '', '', '2018-11-06 04:12:13', 0),
(45, 6, 45, '', '', '2018-11-06 04:12:13', 0),
(46, 7, 5, '', '', '2018-11-19 04:09:42', 0),
(47, 7, 10, '', '', '2018-11-19 04:09:42', 0),
(48, 7, 15, '', '', '2018-11-19 04:09:42', 0),
(49, 7, 20, '', '', '2018-11-19 04:09:42', 0),
(50, 7, 25, '', '', '2018-11-19 04:09:42', 0),
(51, 7, 30, '', '', '2018-11-19 04:09:42', 0),
(52, 7, 35, '', '', '2018-11-19 04:09:42', 0),
(53, 7, 40, '', '', '2018-11-19 04:09:42', 0),
(54, 7, 45, NULL, NULL, '2018-11-19 04:09:42', 0),
(55, 8, 5, '', '', '2018-11-19 04:59:37', 0),
(56, 8, 10, '', '', '2018-11-19 04:59:37', 0),
(57, 8, 15, '', '', '2018-11-19 04:59:37', 0),
(58, 8, 20, '', '', '2018-11-19 04:59:37', 0),
(59, 8, 25, '', '', '2018-11-19 04:59:37', 0),
(60, 8, 30, '', '', '2018-11-19 04:59:37', 0),
(61, 8, 35, 'test', 'tset1`', '2018-11-19 04:59:37', 0),
(62, 8, 40, '', '', '2018-11-19 04:59:37', 0),
(63, 8, 45, NULL, NULL, '2018-11-19 04:59:37', 0),
(64, 9, 4, 'qc', 'qr', '2018-11-19 05:02:00', 0),
(65, 9, 10, 'qtc', 'qtr', '2018-11-19 05:02:00', 0),
(66, 9, 14, 'cc', 'cr', '2018-11-19 05:02:00', 0),
(67, 9, 19, 'dc', 'dr', '2018-11-19 05:02:00', 0),
(68, 9, 24, 'pc', 'pr', '2018-11-19 05:02:00', 0),
(69, 9, 29, 'dc', 'dr', '2018-11-19 05:02:00', 0),
(70, 9, 35, 'asdf', 'asdff', '2018-11-19 05:02:00', 0),
(71, 9, 39, 'qwer', 'qwerr', '2018-11-19 05:02:00', 0),
(72, 9, 44, NULL, NULL, '2018-11-19 05:02:00', 0),
(73, 12, 1, 'tes', 'test', '2018-11-29 04:09:26', 0),
(74, 12, 6, 'test', 'test', '2018-11-29 04:09:26', 0),
(75, 12, 15, 'test', 'test', '2018-11-29 04:09:26', 0),
(76, 12, 20, 'test', 'test', '2018-11-29 04:09:26', 0),
(77, 12, 25, 'test', 'test', '2018-11-29 04:09:26', 0),
(78, 12, 30, 'test', 'test', '2018-11-29 04:09:26', 0),
(79, 12, 35, 'tset', 'test', '2018-11-29 04:09:26', 0),
(80, 12, 40, 'test', 'test', '2018-11-29 04:09:26', 0),
(81, 12, 45, NULL, NULL, '2018-11-29 04:09:26', 0),
(82, 10, 4, 'qc', 'qr', '2018-12-17 08:53:48', 0),
(83, 10, 9, 'qtc', 'qtr', '2018-12-17 08:53:48', 0),
(84, 10, 15, 'cc', 'cr', '2018-12-17 08:53:48', 0),
(85, 10, 20, 'dc', 'dr', '2018-12-17 08:53:48', 0),
(86, 10, 25, 'pc', 'pr', '2018-12-17 08:53:48', 0),
(87, 10, 30, 'dpc', 'dpr', '2018-12-17 08:53:48', 0),
(88, 10, 35, 'r1', 'r2', '2018-12-17 08:53:48', 0),
(89, 10, 40, 'r3', 'r4', '2018-12-17 08:53:48', 0),
(90, 10, 45, NULL, NULL, '2018-12-17 08:53:48', 0),
(91, 13, 1, '', '', '2018-12-21 10:35:24', 0),
(92, 13, 6, '', '', '2018-12-21 10:35:24', 0),
(93, 13, 11, '', '', '2018-12-21 10:35:24', 0),
(94, 13, 20, '', '', '2018-12-21 10:35:24', 0),
(95, 13, 21, '', '', '2018-12-21 10:35:24', 0),
(96, 13, 26, '', '', '2018-12-21 10:35:24', 0),
(97, 13, 31, '', '', '2018-12-21 10:35:24', 0),
(98, 13, 40, '', '', '2018-12-21 10:35:24', 0),
(99, 13, 45, NULL, NULL, '2018-12-21 10:35:24', 0),
(100, 11, 5, '', '', '2019-01-04 09:36:54', 0),
(101, 11, 9, '', '', '2019-01-04 09:36:54', 0),
(102, 11, 14, '', '', '2019-01-04 09:36:54', 0),
(103, 11, 19, '', '', '2019-01-04 09:36:54', 0),
(104, 11, 23, '', '', '2019-01-04 09:36:54', 0),
(105, 11, 28, '', '', '2019-01-04 09:36:54', 0),
(106, 11, 34, '', '', '2019-01-04 09:36:54', 0),
(107, 11, 39, '', '', '2019-01-04 09:36:54', 0),
(108, 11, 43, NULL, NULL, '2019-01-04 09:36:54', 0),
(109, 17, 5, '', '', '2019-12-08 10:48:37', 0),
(110, 17, 10, '', '', '2019-12-08 10:48:37', 0),
(111, 17, 15, '', '', '2019-12-08 10:48:37', 0),
(112, 17, 20, '', '', '2019-12-08 10:48:37', 0),
(113, 17, 25, '', '', '2019-12-08 10:48:37', 0),
(114, 17, 30, '', '', '2019-12-08 10:48:37', 0),
(115, 17, 35, '', '', '2019-12-08 10:48:37', 0),
(116, 17, 40, '', '', '2019-12-08 10:48:37', 0),
(117, 17, 45, NULL, NULL, '2019-12-08 10:48:37', 0);

-- --------------------------------------------------------

--
-- Table structure for table `nop`
--

DROP TABLE IF EXISTS `nop`;
CREATE TABLE IF NOT EXISTS `nop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL DEFAULT '0',
  `reason` text NOT NULL,
  `recommended_by` int(11) NOT NULL DEFAULT '0',
  `submission_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nte`
--

DROP TABLE IF EXISTS `nte`;
CREATE TABLE IF NOT EXISTS `nte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `manager` int(11) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `level` varchar(100) DEFAULT NULL,
  `occurence` varchar(50) DEFAULT NULL,
  `further_infraction` varchar(1000) DEFAULT NULL,
  `improvement_plan` varchar(1000) DEFAULT NULL,
  `commission_manner` varchar(1000) DEFAULT NULL,
  `sanction_progression` varchar(1000) DEFAULT NULL,
  `details` varchar(1000) DEFAULT NULL,
  `sanction` int(11) DEFAULT NULL,
  `date_incurred` timestamp NULL DEFAULT NULL,
  `infraction_place` varchar(1000) DEFAULT NULL,
  `date_added` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `employee_id_idx` (`employee_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nte`
--

INSERT INTO `nte` (`id`, `employee_id`, `manager`, `category`, `level`, `occurence`, `further_infraction`, `improvement_plan`, `commission_manner`, `sanction_progression`, `details`, `sanction`, `date_incurred`, `infraction_place`, `date_added`, `deleted`) VALUES
(1, 86, 77, 'Protection and Property', 'Minor B', '4th', '', '', 'test', 'Final Written Reprimand', 'test', NULL, '0000-00-00 00:00:00', '', '2018-11-26 10:52:41', 0),
(2, 86, 85, 'Health, Safety and Physical Security', 'Serious', '', '', '', '', '', 'test', NULL, '0000-00-00 00:00:00', '', '2018-11-26 10:53:33', 0),
(3, 117, 0, 'Health, Safety and Physical Security', 'Minor B', '', '', '', '', '', 'test', NULL, '0000-00-00 00:00:00', '', '2018-11-26 10:53:45', 0),
(4, 94, 81, 'Health, Safety and Physical Security', 'Serious', '', '', '', '', '', 'testest', NULL, '0000-00-00 00:00:00', '', '2018-11-26 10:54:07', 0);

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

DROP TABLE IF EXISTS `positions`;
CREATE TABLE IF NOT EXISTS `positions` (
  `position_id` int(11) NOT NULL AUTO_INCREMENT,
  `position_title` varchar(100) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`position_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`position_id`, `position_title`, `deleted`, `date_added`) VALUES
(1, 'researcher', 0, '2018-08-08 10:21:56'),
(2, 'quality assurance', 0, '2018-08-08 10:21:56'),
(3, 'developer', 0, '2018-08-15 04:22:00'),
(4, 'staff', 0, '2018-08-15 04:22:09'),
(5, 'Campaign Lead', 0, '2019-11-12 13:47:22'),
(6, 'Senior Researcher', 0, '2019-11-12 13:47:22'),
(7, 'Senior QA', 0, '2019-11-12 13:47:22'),
(8, 'Software Tester', 0, '2019-11-12 13:47:22'),
(9, 'Designer', 0, '2019-11-12 13:47:22'),
(10, 'IT Support', 0, '2019-11-12 13:47:22'),
(11, 'Movie Verifier', 0, '2019-11-12 13:47:22'),
(12, 'Assistant', 0, '2019-11-12 13:47:22'),
(13, 'OJT', 0, '2019-11-12 13:47:22');

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

DROP TABLE IF EXISTS `shifts`;
CREATE TABLE IF NOT EXISTS `shifts` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `shift_name` varchar(50) NOT NULL,
  `shift_details` varchar(100) NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL,
  `break_in` time DEFAULT NULL,
  `break_out` time DEFAULT NULL,
  `deleted` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`sid`),
  UNIQUE KEY `shift_name` (`shift_name`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shifts`
--

INSERT INTO `shifts` (`sid`, `shift_name`, `shift_details`, `time_in`, `time_out`, `break_in`, `break_out`, `deleted`) VALUES
(3, 'Morning', 'Morning', '07:00:00', '16:00:00', NULL, NULL, 0),
(5, 'Afternoon', '', '16:00:00', '01:00:00', '00:00:00', '00:00:00', 1),
(6, 'Night', 'Graveyard', '20:00:00', '05:00:00', '00:00:00', '00:00:00', 0),
(7, 'Swings', '', '17:00:00', '02:00:00', '00:00:00', '00:00:00', 0),
(8, 'Flex', '', '00:00:00', '08:00:00', '00:00:00', '00:00:00', 1),
(9, 'Flexible', '', '00:12:00', '08:09:00', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `shift_info`
--

DROP TABLE IF EXISTS `shift_info`;
CREATE TABLE IF NOT EXISTS `shift_info` (
  `shift_code` int(11) NOT NULL,
  `shift_desc` varchar(100) NOT NULL,
  `shift_in` time(6) NOT NULL,
  `shift_out` time(6) NOT NULL,
  PRIMARY KEY (`shift_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shift_info`
--

INSERT INTO `shift_info` (`shift_code`, `shift_desc`, `shift_in`, `shift_out`) VALUES
(1, 'Morning', '07:00:00.000000', '16:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `type` varchar(100) NOT NULL DEFAULT 'employee',
  `deleted` int(11) NOT NULL DEFAULT '0',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=171 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `type`, `deleted`, `date_added`) VALUES
(1, 'admin', '22D9DCACB1CB85294180922F3D7D7C7D', 'administrator', 0, '2018-08-08 10:22:20'),
(82, 'htabañag ', 'ff88b316d7b0ec79cc493fc58be7287f', 'employee', 0, '2018-09-04 07:17:01'),
(81, 'jarnaiz', '76afa05ebb9aa55fe2cc765a243d8f70', 'employee', 0, '2018-09-04 07:17:01'),
(80, 'rteopiz', '8a52fba762bad925647800009383c5ee', 'employee', 0, '2018-09-04 07:17:01'),
(79, 'mnabong', '646ad8c688ce0726581a06bb0ba4a828', 'employee', 0, '2018-09-04 07:17:01'),
(78, 'mberenguel', '51c5733a6e571ecbc445f68a54473a26', 'employee', 0, '2018-09-04 07:17:01'),
(77, 'mtuastumban', 'acee16ee3915d6237f56c0f440c429f6', 'employee', 0, '2018-09-04 07:17:01'),
(76, 'jbiera', 'c8e4a16facd4f419b43f35d2706c6df9', 'employee', 0, '2018-09-04 07:17:01'),
(75, 'mgonzales', 'd0aca842154427b7f037c9c76c4e3641', 'employee', 0, '2018-09-04 07:17:01'),
(73, 'cparadela', '7b9b86528504ff94c87bfdc2b139de23', 'employee', 0, '2018-09-04 07:17:01'),
(74, 'mtanga-an', '42ae8f16164fff3d40b6efaea419acec', 'employee', 0, '2018-09-04 07:17:01'),
(83, 'pachache ', '53bc492d98a1ce0663e13bafa62dcb75', 'employee', 1, '2018-09-04 07:17:01'),
(84, 'rcuerda', 'ab58ff426a428158544c527c6df86512', 'employee', 0, '2018-09-04 07:17:01'),
(85, 'jhermosisima ', 'ea7aa97e48b96a8a8d0127a98a0e63d0', 'employee', 0, '2018-09-04 07:17:01'),
(86, 'eapostol ', '0d0244509f848be5a23db84dfa082e07', 'employee', 0, '2018-09-04 07:17:01'),
(87, 'jdemol', '1b1f1d14d19c8d15f3ef0eeb3450ba3d', 'employee', 0, '2018-09-04 07:17:01'),
(88, 'jparagoso', 'f48b02d7a46f0b98f3aaa8f5444c71bf', 'employee', 0, '2018-09-04 07:17:01'),
(89, 'jtolentino', '8bcbc584c751befe2f3170f1605ef822', 'employee', 0, '2018-09-04 07:17:01'),
(90, 'jcabalhug', '1c664f84d972fe195c2b0197eba58c90', 'employee', 0, '2018-09-04 07:17:01'),
(91, 'kmisa', '317254b608f8ed29c143adbd404e6aa4', 'employee', 0, '2018-09-04 07:17:01'),
(92, 'lpanes', '4160c2f35cde8d6ce29d5ca26b143cf3', 'employee', 0, '2018-09-04 07:17:01'),
(93, 'jamiler', '86fc2d8847627e25bb9eef038c4c212a', 'employee', 0, '2018-09-04 07:17:01'),
(94, 'ctural', '5fe846c58a106313aa74e024cc22f2ee', 'employee', 0, '2018-09-04 07:17:01'),
(95, 'esalaysay', '3eecfbfd2082ca43883c56df9128d1d6', 'employee', 0, '2018-09-04 07:17:01'),
(96, 'ymari', '80d4d6b3278192dc35377b2dbc7d0ae4', 'employee', 0, '2018-09-04 07:17:01'),
(97, 'areiter', '0fcb06542044fe5b6ec1343fe7b07cd1', 'employee', 0, '2018-09-04 07:17:01'),
(98, 'jbaguio', '20903582a1d9ea49da2b90cfde6cf1cc', 'employee', 0, '2018-09-04 07:17:01'),
(99, 'vmartinito', 'b91ae329a8f53905c33853dec6db6918', 'employee', 0, '2018-09-04 07:17:01'),
(100, 'apati-on ', 'fc9615779c1679ddc14205e629153f4a', 'employee', 0, '2018-09-04 07:17:01'),
(101, 'jeugenio ', '4cca81a5c4c1d6cd43bdb94eb4a443a6', 'employee', 0, '2018-09-04 07:17:01'),
(102, 'tbalbuena', '192cb53df977bcff16f3014bc881ced6', 'employee', 0, '2018-09-04 07:17:01'),
(103, 'mdela torre', 'c29d3385cb58d08ec9a536cd24f62c76', 'employee', 0, '2018-09-04 07:17:01'),
(104, 'jsaurio', '9c9d1c0f1cfb7a8ad3067ab3d8d90735', 'employee', 0, '2018-09-04 07:17:01'),
(105, 'apugata', '03edd88b7001a1efe05bc844f061668e', 'employee', 0, '2018-09-04 07:17:01'),
(106, 'gplata', '2a5d526ccf9b77a3c00acfb568f107c8', 'employee', 0, '2018-09-04 07:17:01'),
(107, 'scarreon ', 'a77c86bb9dcc9f41a64d85d66774b841', 'employee', 0, '2018-09-04 07:17:01'),
(108, 'wanni', 'd9993e276f86b9bc05b14c7d0a946e11', 'employee', 0, '2018-09-04 07:17:01'),
(109, 'mtabar', '1058862bb81e4a8b123285114a18b028', 'employee', 0, '2018-09-04 07:17:01'),
(110, 'mmaglasang', '47ae88b82e6d43e7847982354fb57914', 'employee', 0, '2018-09-04 07:17:01'),
(111, 'ggagani', '879b34a0f2e63fb9be03497875b7b673', 'employee', 0, '2018-09-04 07:17:01'),
(112, 'rlaurente', 'c105aa3b80dece6ed922723dae2dd992', 'employee', 0, '2018-09-04 07:17:01'),
(113, 'mbawa-an ', 'e675f524b815f8d80b9a20394d86bbfe', 'employee', 0, '2018-09-04 07:17:01'),
(114, 'rmagsalay', '117b7bc300222710a22c51a3b4a75d87', 'employee', 0, '2018-09-04 07:17:01'),
(115, 'jlastimoso', 'cd32849ae8f2911b7eb669492b13e1ff', 'employee', 0, '2018-09-04 07:17:01'),
(116, 'rgilos', '51bbb37d86f9de76fd9fc5cedddef5f4', 'employee', 0, '2018-09-04 07:17:01'),
(117, 'jsalas', '385ae5a7dfd8d4ac4597e9016fe625e7', 'employee', 0, '2018-09-04 07:17:01'),
(118, 'dortega', 'd25cd29afb000d17e63abd3196e520bf', 'employee', 0, '2018-09-04 07:17:01'),
(119, 'cangot', '572ac2019ebda4d6915e4d1099f5e5a0', 'employee', 0, '2018-09-04 07:17:01'),
(120, 'calama', '7cd44357355573b31eed49c04f2dd80c', 'employee', 1, '2018-09-04 07:17:01'),
(121, 'cbacus', 'fa809ace9a9e5d8da798226c1d5ee4ba', 'employee', 0, '2018-09-04 07:17:01'),
(122, 'sramirez ', '8db0f64c94abe69672c0781893f73cab', 'employee', 0, '2018-09-04 07:17:01'),
(123, 'mcerelegia', '5a1a186debc85b6d7c7d164e5bcfade1', 'employee', 0, '2018-09-04 07:17:01'),
(124, 'jidol', '018824f85c1543fcbf5156617a7678aa', 'employee', 0, '2018-09-04 07:17:01'),
(125, 'eybañez', '6116e5f0d69abcb5ea6b16659bef96df', 'employee', 0, '2018-09-04 07:17:01'),
(126, 'rcapilitan', '96c94d04e97ae80dded93a765a735d76', 'employee', 0, '2018-09-04 07:17:01'),
(127, 'jcaraca', 'bf95d2c22fbd1588b07b8de3a8c53c3d', 'employee', 0, '2018-09-04 07:17:01'),
(128, 'jcarillo ', 'f1bf77a0410e98746abc16661d8b1e72', 'employee', 0, '2018-09-04 07:17:01'),
(129, 'mloquinario', 'eb4944c87f7017a9f134e04e44f7b337', 'employee', 0, '2018-09-04 07:17:01'),
(130, 'rromaguera', 'bd3dbf5f1ee76f5afdb48d567df18d74', 'employee', 0, '2018-09-04 07:17:01'),
(131, 'jlabajo', '21d95e18afb28aa084685fcc38c96f62', 'employee', 0, '2018-09-04 07:17:01'),
(132, 'lalmonia ', 'd227b9824af23141d54dc9d731382122', 'employee', 0, '2018-09-04 07:17:01'),
(133, 'ialchivar', '1a7d227966d0a22a45518c04760e23d5', 'employee', 1, '2018-09-04 07:17:01'),
(134, 'aaro', 'ae58799a740892bbfc9a6d81e696e527', 'employee', 0, '2018-10-18 07:27:56'),
(135, 'rbaguid', '37449fbddac13cbecbe4efff57cd0075', 'employee', 0, '2018-10-18 07:29:27'),
(136, 'cbobier', '50ce3dc681a41df74f0c6e833369b067', 'employee', 0, '2018-10-18 07:30:39'),
(137, 'ecalupas', '95d5a3b7b12dd04ca9b8a26d9b898325', 'employee', 0, '2018-10-18 07:31:38'),
(138, 'jdelaconception', '1c102941045087d863a4d5beb5281dbe', 'employee', 0, '2018-10-18 07:32:30'),
(139, 'jdole', 'e628fb5280ad2e74db5783d4050993e4', 'employee', 0, '2018-10-18 07:33:12'),
(140, 'mencabo', 'ba1cc374018e11257156b870ae6522fa', 'employee', 0, '2018-10-18 07:34:08'),
(141, 'dlaude', 'a60489b13da06caa3704030420cedf6d', 'employee', 0, '2018-10-18 07:35:23'),
(142, 'emaggallanes', '93bcdbed21c9c8e1495438fdc21e7b96', 'employee', 0, '2018-10-18 07:36:17'),
(143, 'jmascardo', '0551a1fbeb6449c4f3e46fc955273547', 'employee', 0, '2018-10-18 07:37:09'),
(144, 'anarit', '3f4ae975169f982081f57e9854d6f49e', 'employee', 0, '2018-10-18 07:37:57'),
(145, 'roliva', 'c7f2ee823f4cc201dd3970a20fa6379e', 'employee', 0, '2018-10-18 07:38:37'),
(146, 'msuerte', '13a97715872e59c7feb13d5c9bbcef96', 'employee', 0, '2018-10-18 07:39:34'),
(147, 'ttempla', 'f4ed8c036fc577155a12a8e5d95296cc', 'employee', 0, '2018-10-18 07:40:56'),
(148, 'jservande', '90e0f9db55e540b844dda9a750b7ed28', 'employee', 0, '2018-10-18 07:41:59'),
(149, 'jdomandam', '474851b360c0c7e92bfdbb4f3acf93cf', 'employee', 0, '2018-10-18 07:43:36'),
(150, 'dgetutua', '7e2416ffa6a4cb14d59be57096da403e', 'employee', 0, '2018-10-18 07:44:20'),
(151, 'mmelgar', 'c8f728490dbadf587516d9534d79e715', 'employee', 0, '2018-10-18 07:45:08'),
(152, 'csoroño', '6c458524ff7162de14c3917f99d9b8c8', 'employee', 0, '2018-10-18 07:45:58'),
(153, 'jfuentes', '2828304c04a2b3fe26a0a50c46628f80', 'employee', 0, '2018-10-18 07:46:52'),
(154, 'jmondares', 'f6c0778ead61cf84e16c38885bb2d7c0', 'employee', 0, '2018-10-18 07:47:43'),
(155, 'ccampesao', 'b82de8456ee422bd89b211367bdd5649', 'employee', 0, '2018-10-18 07:48:35'),
(156, 'kolivo', 'b9e001e15db301cfed7c4d7c00e3c04a', 'employee', 0, '2018-10-18 07:49:44'),
(157, 'crepollo', '025ad90f886dbf31edc7bdead917046f', 'employee', 0, '2018-10-18 07:50:22'),
(158, 'vboaquin', 'c103d39909918bf7ace7b181c2d50894', 'employee', 0, '2018-10-18 07:51:13'),
(159, 'cpapellero', 'db53a05904b8fa69832a39d3798ed6ca', 'employee', 0, '2018-10-18 07:55:32'),
(160, 'gcuizon', '12a0522aaf94dc8b553734c497a9eb94', 'employee', 0, '2018-10-18 07:56:21'),
(161, 'erequinto', 'eb5795611d27cb4759884dc5df7bf39b', 'employee', 0, '2018-10-18 07:57:08'),
(162, 'bperino', '6b96de29fb0fe9891f5eb430869ca14b', 'employee', 0, '2018-10-18 08:08:54'),
(163, 'fasdfadsfasd', '3fdd49ef116fc2a054015a5d8f1da072', 'employee', 0, '2019-11-12 12:15:26'),
(164, 'fasdfadsfasdfdfdf', '971c118fc630f6de6200766ca50fe14b', 'employee', 0, '2019-11-12 12:18:51'),
(165, 'fasdfadsfasdfdfdfdfdffd', '8cc3fc987ae6796805924741ea420faf', 'employee', 0, '2019-11-12 12:19:27'),
(166, 'JDoe', '58f33deb532d7c138d9834e30aa32137', 'employee', 0, '2019-12-08 09:17:17'),
(167, 'JDoef', '58f33deb532d7c138d9834e30aa32137', 'employee', 0, '2019-12-08 10:21:52'),
(168, 'ffdfdfdf', 'ea1d6702732b1e27f884f680430c0018', 'employee', 0, '2019-12-08 10:29:45'),
(169, 'fdfdfd', '1d283bf95ee42cd40c6da74b7196a049', 'employee', 0, '2019-12-08 10:35:59'),
(170, 'SUser', '035105ea53ee091f57adbcf6b801feac', 'employee', 0, '2019-12-08 10:40:42');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
