-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 30, 2018 at 05:56 PM
-- Server version: 5.7.23-0ubuntu0.18.04.1
-- PHP Version: 7.2.7-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_academico3`
--

-- --------------------------------------------------------

--
-- Table structure for table `area_conocimiento`
--

CREATE TABLE `area_conocimiento` (
  `acon_id` bigint(20) NOT NULL,
  `acon_nombre` varchar(200) NOT NULL,
  `acon_descripcion` varchar(500) NOT NULL,
  `acon_estado` varchar(1) NOT NULL,
  `acon_fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `acon_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `acon_estado_logico` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `area_conocimiento`
--

INSERT INTO `area_conocimiento` (`acon_id`, `acon_nombre`, `acon_descripcion`, `acon_estado`, `acon_fecha_creacion`, `acon_fecha_modificacion`, `acon_estado_logico`) VALUES
(1, 'Programas generales', 'Descripción de área de conocimiento', '1', '2018-08-28 19:07:36', NULL, '1'),
(2, 'Educación', 'Descripción de área de conocimiento', '1', '2018-08-28 19:07:36', NULL, '1'),
(3, 'Humanidades y artes', 'Descripción de área de conocimiento', '1', '2018-08-28 19:07:36', NULL, '1'),
(4, 'Ciencias sociales, educación comercial y derecho', 'Descripción de área de conocimiento', '1', '2018-08-28 19:07:36', NULL, '1'),
(5, 'Ciencias', 'Descripción de área de conocimiento', '1', '2018-08-28 19:07:36', NULL, '1'),
(6, 'Ingeniería, industria y construcción', 'Descripción de área de conocimiento', '1', '2018-08-28 19:07:36', NULL, '1'),
(7, 'Agricultura', 'Descripción de área de conocimiento', '1', '2018-08-28 19:07:36', NULL, '1'),
(8, 'Salud y sociales servicios', 'Descripción de área de conocimiento', '1', '2018-08-28 19:07:36', NULL, '1'),
(9, 'Servicios', 'Descripción de área de conocimiento', '1', '2018-08-28 19:07:36', NULL, '1'),
(10, 'Sectores desconocidos no especificados', 'Descripción de área de conocimiento', '1', '2018-08-28 19:07:36', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `asignacion_curso`
--

CREATE TABLE `asignacion_curso` (
  `acur_id` bigint(20) NOT NULL,
  `cur_id` bigint(20) NOT NULL,
  `asp_id` bigint(20) NOT NULL,
  `sins_id` bigint(20) NOT NULL,
  `acur_fecha_asignacion` timestamp NULL DEFAULT NULL,
  `acur_usuario_asignacion` int(11) NOT NULL,
  `acur_usuario_modificacion` int(11) DEFAULT NULL,
  `acur_estado` varchar(1) NOT NULL,
  `acur_fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `acur_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `acur_estado_logico` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `asignacion_curso`
--

INSERT INTO `asignacion_curso` (`acur_id`, `cur_id`, `asp_id`, `sins_id`, `acur_fecha_asignacion`, `acur_usuario_asignacion`, `acur_usuario_modificacion`, `acur_estado`, `acur_fecha_creacion`, `acur_fecha_modificacion`, `acur_estado_logico`) VALUES
(1, 1, 1, 1, '2017-10-11 06:22:45', 1, NULL, '1', '2017-10-11 06:22:45', NULL, '1'),
(2, 1, 2, 2, '2017-10-12 06:22:27', 1, NULL, '1', '2017-10-12 06:22:27', NULL, '1'),
(3, 1, 4, 4, '2017-10-14 02:14:02', 1, NULL, '1', '2017-10-14 02:14:02', NULL, '1'),
(4, 1, 6, 6, '2017-10-15 02:15:17', 1, NULL, '1', '2017-10-15 02:15:17', NULL, '1'),
(5, 1, 5, 5, '2017-10-15 02:23:17', 1, NULL, '1', '2017-10-15 02:23:17', NULL, '1'),
(6, 1, 7, 7, '2017-10-17 08:03:17', 1, NULL, '1', '2017-10-17 08:03:17', NULL, '1'),
(7, 1, 8, 8, '2017-10-18 06:53:23', 1, NULL, '1', '2017-10-18 06:53:23', NULL, '1'),
(8, 1, 9, 9, '2017-10-19 06:16:40', 1, NULL, '1', '2017-10-19 06:16:40', NULL, '1'),
(9, 2, 13, 10, '2017-11-01 05:52:50', 1, NULL, '1', '2017-11-01 05:52:50', NULL, '1'),
(10, 2, 13, 15, '2017-11-11 05:11:47', 1, NULL, '1', '2017-11-11 05:11:47', NULL, '1'),
(11, 2, 9, 13, '2017-11-14 01:37:15', 1, NULL, '1', '2017-11-14 01:37:15', NULL, '1'),
(12, 2, 22, 20, '2017-11-14 07:09:18', 1, NULL, '1', '2017-11-14 07:09:18', NULL, '1'),
(13, 2, 20, 21, '2017-11-19 02:24:30', 1, NULL, '1', '2017-11-19 02:24:30', NULL, '1'),
(14, 2, 24, 22, '2017-11-21 00:15:51', 1, NULL, '1', '2017-11-21 00:15:51', NULL, '1'),
(15, 2, 19, 17, '2017-11-23 03:52:58', 1, NULL, '1', '2017-11-23 03:52:58', NULL, '1'),
(16, 2, 23, 23, '2017-11-29 07:49:32', 1, NULL, '1', '2017-11-29 07:49:32', NULL, '1'),
(17, 2, 17, 16, '2017-11-29 07:52:05', 1, NULL, '1', '2017-11-29 07:52:05', NULL, '1'),
(18, 2, 27, 24, '2017-11-30 00:36:25', 1, NULL, '1', '2017-11-30 00:36:25', NULL, '1'),
(19, 2, 15, 12, '2017-11-30 01:10:45', 1, NULL, '1', '2017-11-30 01:10:45', NULL, '1'),
(20, 2, 17, 14, '2017-11-30 01:11:46', 1, NULL, '1', '2017-11-30 01:11:46', NULL, '1'),
(21, 2, 21, 19, '2017-11-30 01:18:29', 1, NULL, '1', '2017-11-30 01:18:29', NULL, '1'),
(22, 1, 3, 3, '2017-11-30 03:48:09', 1, NULL, '1', '2017-11-30 03:48:09', NULL, '1'),
(23, 3, 28, 28, '2018-01-10 02:14:55', 1, NULL, '1', '2018-01-10 02:14:55', NULL, '1'),
(24, 3, 31, 29, '2018-01-13 06:02:01', 1, NULL, '1', '2018-01-13 06:02:01', NULL, '1'),
(25, 3, 30, 30, '2018-01-14 00:02:10', 1, NULL, '1', '2018-01-14 00:02:10', NULL, '1'),
(26, 3, 36, 33, '2018-01-19 19:02:30', 1, NULL, '1', '2018-01-19 19:02:30', NULL, '1'),
(27, 5, 37, 36, '2018-01-31 02:53:57', 23, NULL, '1', '2018-01-31 02:53:57', NULL, '1'),
(28, 3, 29, 27, '2018-01-31 02:55:40', 23, NULL, '1', '2018-01-31 02:55:40', NULL, '1'),
(29, 3, 27, 26, '2018-01-31 02:55:50', 23, NULL, '1', '2018-01-31 02:55:50', NULL, '1'),
(30, 3, 9, 34, '2018-01-31 02:56:03', 23, NULL, '1', '2018-01-31 02:56:03', NULL, '1'),
(31, 5, 39, 37, '2018-02-06 01:46:15', 23, NULL, '1', '2018-02-06 01:46:15', NULL, '1'),
(32, 5, 38, 35, '2018-02-06 01:46:32', 23, NULL, '1', '2018-02-06 01:46:32', NULL, '1'),
(33, 5, 43, 40, '2018-02-16 21:22:06', 23, NULL, '1', '2018-02-16 21:22:06', NULL, '1'),
(34, 5, 47, 42, '2018-02-17 03:16:02', 23, NULL, '1', '2018-02-17 03:16:02', NULL, '1'),
(35, 5, 40, 39, '2018-02-19 23:35:49', 23, NULL, '1', '2018-02-19 23:35:49', NULL, '1'),
(36, 5, 47, 43, '2018-02-19 23:45:21', 23, NULL, '1', '2018-02-19 23:45:21', NULL, '1'),
(37, 5, 41, 38, '2018-02-20 02:08:38', 23, NULL, '1', '2018-02-20 02:08:38', NULL, '1'),
(38, 5, 36, 45, '2018-02-20 02:26:19', 23, NULL, '1', '2018-02-20 02:26:19', NULL, '1'),
(39, 5, 47, 44, '2018-02-20 21:39:25', 23, NULL, '1', '2018-02-20 21:39:25', NULL, '1'),
(40, 5, 50, 46, '2018-02-21 05:40:19', 23, NULL, '1', '2018-02-21 05:40:19', NULL, '1'),
(41, 5, 42, 41, '2018-02-21 05:43:47', 23, NULL, '1', '2018-02-21 05:43:47', NULL, '1'),
(42, 5, 47, 47, '2018-02-23 21:44:47', 23, NULL, '1', '2018-02-23 21:44:47', NULL, '1'),
(43, 3, 36, 32, '2018-02-24 00:21:41', 23, NULL, '1', '2018-02-24 00:21:41', NULL, '1'),
(44, 7, 9, 11, '2018-02-27 03:06:30', 23, NULL, '1', '2018-02-27 03:06:30', NULL, '1'),
(45, 8, 50, 48, '2018-02-28 19:02:59', 23, NULL, '1', '2018-02-28 19:02:59', NULL, '1'),
(46, 8, 52, 51, '2018-03-05 20:18:58', 23, NULL, '1', '2018-03-05 20:18:58', NULL, '1'),
(47, 8, 52, 50, '2018-03-05 20:20:10', 23, NULL, '1', '2018-03-05 20:20:10', NULL, '1'),
(48, 8, 50, 49, '2018-03-06 19:42:46', 23, NULL, '1', '2018-03-06 19:42:46', NULL, '1'),
(49, 8, 53, 52, '2018-03-06 19:45:29', 23, NULL, '1', '2018-03-06 19:45:29', NULL, '1'),
(50, 8, 55, 54, '2018-03-09 19:40:14', 23, NULL, '1', '2018-03-09 19:40:14', NULL, '1'),
(51, 8, 59, 57, '2018-03-13 00:46:20', 23, NULL, '1', '2018-03-13 00:46:20', NULL, '1'),
(52, 8, 60, 59, '2018-03-13 00:46:37', 23, NULL, '1', '2018-03-13 00:46:37', NULL, '1'),
(53, 8, 54, 58, '2018-03-13 00:47:17', 23, NULL, '1', '2018-03-13 00:47:17', NULL, '1'),
(54, 8, 54, 55, '2018-03-13 19:27:53', 23, NULL, '1', '2018-03-13 19:27:53', NULL, '1'),
(55, 9, 57, 56, '2018-03-15 02:10:31', 23, NULL, '1', '2018-03-15 02:10:31', NULL, '1'),
(56, 8, 56, 53, '2018-03-15 02:12:06', 23, NULL, '1', '2018-03-15 02:12:06', NULL, '1'),
(57, 9, 64, 60, '2018-03-16 21:57:17', 23, NULL, '1', '2018-03-16 21:57:17', NULL, '1'),
(58, 9, 66, 61, '2018-03-16 21:57:38', 23, NULL, '1', '2018-03-16 21:57:38', NULL, '1'),
(59, 9, 65, 63, '2018-03-16 21:58:35', 23, NULL, '1', '2018-03-16 21:58:35', NULL, '1'),
(60, 9, 76, 69, '2018-03-19 19:39:47', 23, NULL, '1', '2018-03-19 19:39:47', NULL, '1'),
(61, 9, 70, 65, '2018-03-19 19:40:25', 23, NULL, '1', '2018-03-19 19:40:25', NULL, '1'),
(62, 9, 71, 68, '2018-03-19 19:40:42', 23, NULL, '1', '2018-03-19 19:40:42', NULL, '1'),
(63, 9, 70, 64, '2018-03-19 19:41:25', 23, NULL, '1', '2018-03-19 19:41:25', NULL, '1'),
(64, 9, 77, 74, '2018-03-20 00:45:54', 23, NULL, '1', '2018-03-20 00:45:54', NULL, '1'),
(65, 9, 73, 70, '2018-03-20 00:52:39', 23, NULL, '1', '2018-03-20 00:52:39', NULL, '1'),
(66, 9, 72, 67, '2018-03-20 01:01:06', 23, NULL, '1', '2018-03-20 01:01:06', NULL, '1'),
(67, 9, 74, 72, '2018-03-20 03:41:50', 23, NULL, '1', '2018-03-20 03:41:50', NULL, '1'),
(68, 9, 75, 73, '2018-03-20 03:41:59', 23, NULL, '1', '2018-03-20 03:41:59', NULL, '1'),
(69, 9, 70, 75, '2018-03-20 19:35:00', 23, NULL, '1', '2018-03-20 19:35:00', NULL, '1'),
(70, 9, 63, 71, '2018-03-20 20:40:57', 23, NULL, '1', '2018-03-20 20:40:57', NULL, '1'),
(71, 9, 78, 77, '2018-03-22 02:43:59', 23, NULL, '1', '2018-03-22 02:43:59', NULL, '1'),
(72, 9, 79, 76, '2018-03-22 02:44:11', 23, NULL, '1', '2018-03-22 02:44:11', NULL, '1'),
(73, 9, 80, 78, '2018-03-22 21:06:26', 23, NULL, '1', '2018-03-22 21:06:26', NULL, '1'),
(74, 9, 81, 79, '2018-03-23 19:07:15', 23, NULL, '1', '2018-03-23 19:07:15', NULL, '1'),
(75, 8, 66, 66, '2018-04-03 03:24:13', 23, NULL, '1', '2018-04-03 03:24:13', NULL, '1'),
(76, 10, 90, 83, '2018-04-07 03:36:50', 23, NULL, '1', '2018-04-07 03:36:50', NULL, '1'),
(77, 11, 86, 89, '2018-04-10 01:11:26', 23, NULL, '1', '2018-04-10 01:11:26', NULL, '1'),
(78, 11, 84, 82, '2018-04-10 01:11:46', 23, NULL, '1', '2018-04-10 01:11:46', NULL, '1'),
(79, 11, 85, 81, '2018-04-10 01:11:58', 23, NULL, '1', '2018-04-10 01:11:58', NULL, '1'),
(80, 11, 83, 80, '2018-04-10 01:12:07', 23, NULL, '1', '2018-04-10 01:12:07', NULL, '1'),
(81, 11, 87, 85, '2018-04-10 19:26:21', 23, NULL, '1', '2018-04-10 19:26:21', NULL, '1'),
(82, 11, 103, 93, '2018-04-11 03:57:37', 23, NULL, '1', '2018-04-11 03:57:37', NULL, '1'),
(83, 11, 103, 94, '2018-04-11 03:57:45', 23, NULL, '1', '2018-04-11 03:57:45', NULL, '1'),
(84, 11, 93, 92, '2018-04-11 03:57:53', 23, NULL, '1', '2018-04-11 03:57:53', NULL, '1'),
(85, 11, 89, 88, '2018-04-11 03:58:01', 23, NULL, '1', '2018-04-11 03:58:01', NULL, '1'),
(86, 11, 88, 86, '2018-04-11 03:58:09', 23, NULL, '1', '2018-04-11 03:58:09', NULL, '1'),
(87, 11, 105, 97, '2018-04-13 05:20:09', 23, NULL, '1', '2018-04-13 05:20:09', NULL, '1'),
(88, 11, 105, 99, '2018-04-13 06:01:34', 23, NULL, '1', '2018-04-13 06:01:34', NULL, '1'),
(89, 11, 103, 95, '2018-04-13 06:01:43', 23, NULL, '1', '2018-04-13 06:01:43', NULL, '1'),
(90, 11, 105, 101, '2018-04-13 06:01:54', 23, NULL, '1', '2018-04-13 06:01:54', NULL, '1'),
(91, 11, 95, 100, '2018-04-13 06:08:30', 23, NULL, '1', '2018-04-13 06:08:30', NULL, '1'),
(92, 11, 105, 98, '2018-04-14 02:40:40', 23, NULL, '1', '2018-04-14 02:40:40', NULL, '1'),
(93, 11, 92, 84, '2018-04-14 02:41:01', 23, NULL, '1', '2018-04-14 02:41:01', NULL, '1'),
(94, 11, 83, 87, '2018-04-16 20:41:41', 23, NULL, '1', '2018-04-16 20:41:41', NULL, '1'),
(95, 11, 105, 102, '2018-04-16 21:01:12', 23, NULL, '1', '2018-04-16 21:01:12', NULL, '1'),
(96, 11, 89, 96, '2018-04-17 02:32:49', 23, NULL, '1', '2018-04-17 02:32:49', NULL, '1'),
(97, 11, 105, 107, '2018-04-18 00:45:07', 23, NULL, '1', '2018-04-18 00:45:07', NULL, '1'),
(98, 11, 109, 106, '2018-04-18 00:45:30', 23, NULL, '1', '2018-04-18 00:45:30', NULL, '1'),
(99, 11, 108, 103, '2018-04-18 00:45:40', 23, NULL, '1', '2018-04-18 00:45:40', NULL, '1'),
(100, 10, 112, 108, '2018-04-18 00:46:01', 23, NULL, '1', '2018-04-18 00:46:01', NULL, '1'),
(101, 11, 108, 105, '2018-04-18 00:46:10', 23, NULL, '1', '2018-04-18 00:46:10', NULL, '1'),
(102, 11, 106, 109, '2018-04-18 00:46:17', 23, NULL, '1', '2018-04-18 00:46:17', NULL, '1'),
(103, 11, 62, 112, '2018-04-18 02:34:41', 23, NULL, '1', '2018-04-18 02:34:41', NULL, '1'),
(104, 11, 105, 111, '2018-04-18 02:34:52', 23, NULL, '1', '2018-04-18 02:34:52', NULL, '1'),
(105, 11, 105, 110, '2018-04-18 02:35:09', 23, NULL, '1', '2018-04-18 02:35:09', NULL, '1'),
(106, 11, 114, 104, '2018-04-18 02:35:40', 23, NULL, '1', '2018-04-18 02:35:40', NULL, '1'),
(107, 11, 118, 114, '2018-04-18 20:06:55', 23, NULL, '1', '2018-04-18 20:06:55', NULL, '1'),
(108, 11, 115, 113, '2018-04-18 20:52:11', 23, NULL, '1', '2018-04-18 20:52:11', NULL, '1'),
(109, 11, 118, 115, '2018-04-19 23:36:44', 23, NULL, '1', '2018-04-19 23:36:44', NULL, '1'),
(110, 11, 119, 117, '2018-04-19 23:46:04', 23, NULL, '1', '2018-04-19 23:46:04', NULL, '1'),
(111, 9, 82, 119, '2018-04-26 02:41:47', 23, NULL, '1', '2018-04-26 02:41:47', NULL, '1'),
(112, 11, 81, 90, '2018-04-26 02:46:10', 23, NULL, '1', '2018-04-26 02:46:10', NULL, '1'),
(113, 11, 61, 62, '2018-04-26 02:46:58', 23, NULL, '1', '2018-04-26 02:46:58', NULL, '1'),
(114, 11, 115, 116, '2018-05-08 02:14:13', 23, NULL, '1', '2018-05-08 02:14:13', NULL, '1'),
(115, 12, 127, 123, '2018-05-10 21:36:09', 23, NULL, '1', '2018-05-10 21:36:09', NULL, '1'),
(116, 12, 124, 121, '2018-05-10 21:36:16', 23, NULL, '1', '2018-05-10 21:36:16', NULL, '1'),
(117, 12, 125, 120, '2018-05-10 21:36:24', 23, NULL, '1', '2018-05-10 21:36:24', NULL, '1'),
(118, 12, 121, 118, '2018-05-14 19:50:35', 23, NULL, '1', '2018-05-14 19:50:35', NULL, '1'),
(119, 12, 126, 122, '2018-05-14 19:50:43', 23, NULL, '1', '2018-05-14 19:50:43', NULL, '1'),
(120, 12, 128, 124, '2018-05-14 19:50:50', 23, NULL, '1', '2018-05-14 19:50:50', NULL, '1'),
(121, 12, 12, 127, '2018-05-14 19:50:57', 23, NULL, '1', '2018-05-14 19:50:57', NULL, '1'),
(122, 12, 129, 125, '2018-05-14 20:34:00', 23, NULL, '1', '2018-05-14 20:34:00', NULL, '1'),
(123, 2, 9, 18, '2018-05-14 21:02:07', 23, NULL, '1', '2018-05-14 21:02:07', NULL, '1'),
(124, 12, 27, 25, '2018-05-14 21:02:23', 23, NULL, '1', '2018-05-14 21:02:23', NULL, '1'),
(125, 12, 122, 129, '2018-05-15 23:48:26', 23, NULL, '1', '2018-05-15 23:48:26', NULL, '1'),
(126, 12, 131, 130, '2018-05-17 02:11:04', 23, NULL, '1', '2018-05-17 02:11:04', NULL, '1'),
(127, 12, 123, 128, '2018-05-17 04:10:52', 23, NULL, '1', '2018-05-17 04:10:52', NULL, '1'),
(128, 12, 132, 131, '2018-05-18 20:48:08', 23, NULL, '1', '2018-05-18 20:48:08', NULL, '1'),
(129, 12, 130, 126, '2018-05-28 20:25:44', 23, NULL, '1', '2018-05-28 20:25:44', NULL, '1'),
(130, 13, 136, 134, '2018-05-31 03:19:50', 23, NULL, '1', '2018-05-31 03:19:50', NULL, '1'),
(131, 13, 138, 137, '2018-06-01 02:12:57', 23, NULL, '1', '2018-06-01 02:12:57', NULL, '1'),
(132, 13, 137, 135, '2018-06-05 19:37:45', 23, NULL, '1', '2018-06-05 19:37:45', NULL, '1'),
(133, 13, 133, 132, '2018-06-05 19:44:30', 23, NULL, '1', '2018-06-05 19:44:30', NULL, '1'),
(134, 13, 143, 142, '2018-06-05 19:49:20', 23, NULL, '1', '2018-06-05 19:49:20', NULL, '1'),
(135, 13, 133, 141, '2018-06-05 19:54:31', 23, NULL, '1', '2018-06-05 19:54:31', NULL, '1'),
(136, 13, 142, 140, '2018-06-05 20:18:11', 23, NULL, '1', '2018-06-05 20:18:11', NULL, '1'),
(137, 13, 142, 138, '2018-06-05 20:29:07', 23, NULL, '1', '2018-06-05 20:29:07', NULL, '1'),
(138, 13, 144, 143, '2018-06-06 01:45:28', 23, NULL, '1', '2018-06-06 01:45:28', NULL, '1'),
(139, 13, 135, 133, '2018-06-08 00:11:39', 23, NULL, '1', '2018-06-08 00:11:39', NULL, '1'),
(140, 13, 142, 139, '2018-06-08 01:40:52', 23, NULL, '1', '2018-06-08 01:40:52', NULL, '1'),
(141, 13, 134, 136, '2018-06-08 02:42:29', 23, NULL, '1', '2018-06-08 02:42:29', NULL, '1'),
(142, 13, 145, 144, '2018-06-08 20:53:56', 23, NULL, '1', '2018-06-08 20:53:56', NULL, '1'),
(143, 13, 149, 146, '2018-06-09 00:53:00', 23, NULL, '1', '2018-06-09 00:53:00', NULL, '1'),
(144, 13, 149, 145, '2018-06-11 20:08:52', 23, NULL, '1', '2018-06-11 20:08:52', NULL, '1'),
(145, 13, 130, 148, '2018-06-11 20:08:58', 23, NULL, '1', '2018-06-11 20:08:58', NULL, '1'),
(146, 13, 150, 149, '2018-06-12 03:33:08', 23, NULL, '1', '2018-06-12 03:33:08', NULL, '1'),
(147, 13, 151, 150, '2018-06-13 02:03:19', 23, NULL, '1', '2018-06-13 02:03:19', NULL, '1'),
(148, 13, 43, 151, '2018-06-13 19:27:53', 23, NULL, '1', '2018-06-13 19:27:53', NULL, '1'),
(149, 13, 149, 147, '2018-06-18 19:41:00', 23, NULL, '1', '2018-06-18 19:41:00', NULL, '1'),
(150, 14, 154, 152, '2018-06-27 22:00:15', 23, NULL, '1', '2018-06-27 22:00:15', NULL, '1'),
(151, 14, 137, 153, '2018-06-27 22:00:23', 23, NULL, '1', '2018-06-27 22:00:23', NULL, '1'),
(152, 14, 158, 154, '2018-06-29 03:35:31', 23, NULL, '1', '2018-06-29 03:35:31', NULL, '1'),
(153, 14, 155, 156, '2018-06-29 03:35:38', 23, NULL, '1', '2018-06-29 03:35:38', NULL, '1'),
(154, 14, 152, 158, '2018-07-04 21:32:06', 23, NULL, '1', '2018-07-04 21:32:06', NULL, '1'),
(155, 14, 126, 155, '2018-07-04 21:32:14', 23, NULL, '1', '2018-07-04 21:32:14', NULL, '1'),
(156, 14, 161, 161, '2018-07-12 21:00:40', 23, NULL, '1', '2018-07-12 21:00:40', NULL, '1'),
(157, 14, 160, 160, '2018-07-14 01:48:33', 23, NULL, '1', '2018-07-14 01:48:33', NULL, '1'),
(158, 14, 199, 164, '2018-07-16 18:56:42', 23, NULL, '1', '2018-07-16 18:56:42', NULL, '1'),
(159, 14, 163, 163, '2018-07-16 18:56:49', 23, NULL, '1', '2018-07-16 18:56:49', NULL, '1'),
(160, 14, 158, 157, '2018-07-16 19:18:41', 23, NULL, '1', '2018-07-16 19:18:41', NULL, '1'),
(161, 15, 196, 166, '2018-07-17 20:39:41', 23, NULL, '1', '2018-07-17 20:39:41', NULL, '1'),
(162, 14, 199, 165, '2018-07-17 20:39:56', 23, NULL, '1', '2018-07-17 20:39:56', NULL, '1'),
(163, 14, 162, 162, '2018-07-18 02:40:31', 23, NULL, '1', '2018-07-18 02:40:31', NULL, '1'),
(164, 14, 199, 168, '2018-07-18 03:04:19', 23, NULL, '1', '2018-07-18 03:04:19', NULL, '1'),
(165, 15, 164, 170, '2018-07-18 03:04:28', 23, NULL, '1', '2018-07-18 03:04:28', NULL, '1'),
(166, 14, 199, 169, '2018-07-18 03:11:34', 23, NULL, '1', '2018-07-18 03:11:34', NULL, '1'),
(167, 15, 199, 171, '2018-07-23 20:44:46', 23, NULL, '1', '2018-07-23 20:44:46', NULL, '1'),
(168, 15, 199, 172, '2018-07-23 20:45:01', 23, NULL, '1', '2018-07-23 20:45:01', NULL, '1'),
(169, 15, 164, 174, '2018-07-23 20:45:13', 23, NULL, '1', '2018-07-23 20:45:13', NULL, '1'),
(170, 15, 199, 175, '2018-07-23 20:45:36', 23, NULL, '1', '2018-07-23 20:45:36', NULL, '1'),
(171, 15, 199, 176, '2018-07-23 20:45:45', 23, NULL, '1', '2018-07-23 20:45:45', NULL, '1'),
(172, 15, 199, 179, '2018-07-23 20:45:53', 23, NULL, '1', '2018-07-23 20:45:53', NULL, '1'),
(173, 15, 196, 180, '2018-07-23 20:46:40', 23, NULL, '1', '2018-07-23 20:46:40', NULL, '1'),
(174, 15, 164, 182, '2018-07-23 20:46:49', 23, NULL, '1', '2018-07-23 20:46:49', NULL, '1'),
(175, 14, 28, 178, '2018-07-23 20:47:06', 23, NULL, '1', '2018-07-23 20:47:06', NULL, '1'),
(176, 14, 199, 181, '2018-07-23 20:58:15', 23, NULL, '1', '2018-07-23 20:58:15', NULL, '1'),
(177, 15, 164, 177, '2018-07-24 00:16:04', 23, NULL, '1', '2018-07-24 00:16:04', NULL, '1'),
(178, 15, 164, 173, '2018-07-24 00:16:16', 23, NULL, '1', '2018-07-24 00:16:16', NULL, '1'),
(179, 14, 93, 91, '2018-07-24 01:34:12', 23, NULL, '1', '2018-07-24 01:34:12', NULL, '1'),
(180, 15, 199, 184, '2018-07-27 00:28:44', 23, NULL, '1', '2018-07-27 00:28:44', NULL, '1'),
(181, 15, 164, 183, '2018-07-27 00:28:52', 23, NULL, '1', '2018-07-27 00:28:52', NULL, '1'),
(182, 15, 197, 185, '2018-07-27 00:28:59', 23, NULL, '1', '2018-07-27 00:28:59', NULL, '1'),
(183, 15, 164, 186, '2018-07-27 00:29:08', 23, NULL, '1', '2018-07-27 00:29:08', NULL, '1'),
(184, 15, 197, 189, '2018-07-27 00:29:16', 23, NULL, '1', '2018-07-27 00:29:16', NULL, '1'),
(185, 15, 197, 190, '2018-07-27 00:29:23', 23, NULL, '1', '2018-07-27 00:29:23', NULL, '1'),
(186, 15, 199, 188, '2018-07-27 00:29:31', 23, NULL, '1', '2018-07-27 00:29:31', NULL, '1'),
(187, 16, 207, 187, '2018-07-30 21:13:07', 23, NULL, '1', '2018-07-30 21:13:07', NULL, '1'),
(188, 15, 164, 191, '2018-07-30 21:13:23', 23, NULL, '1', '2018-07-30 21:13:23', NULL, '1'),
(189, 15, 199, 193, '2018-07-30 21:13:32', 23, NULL, '1', '2018-07-30 21:13:32', NULL, '1'),
(190, 15, 197, 192, '2018-07-30 21:13:40', 23, NULL, '1', '2018-07-30 21:13:40', NULL, '1'),
(191, 15, 199, 194, '2018-07-30 21:13:48', 23, NULL, '1', '2018-07-30 21:13:48', NULL, '1'),
(192, 15, 164, 197, '2018-07-31 22:07:07', 23, NULL, '1', '2018-07-31 22:07:07', NULL, '1'),
(193, 15, 199, 205, '2018-07-31 22:07:14', 23, NULL, '1', '2018-07-31 22:07:14', NULL, '1'),
(194, 15, 197, 208, '2018-07-31 22:07:28', 23, NULL, '1', '2018-07-31 22:07:28', NULL, '1'),
(195, 15, 197, 209, '2018-07-31 22:14:15', 23, NULL, '1', '2018-07-31 22:14:15', NULL, '1'),
(196, 15, 196, 207, '2018-07-31 22:14:22', 23, NULL, '1', '2018-07-31 22:14:22', NULL, '1'),
(197, 15, 164, 210, '2018-07-31 22:14:29', 23, NULL, '1', '2018-07-31 22:14:29', NULL, '1'),
(198, 15, 197, 206, '2018-07-31 22:14:37', 23, NULL, '1', '2018-07-31 22:14:37', NULL, '1'),
(199, 15, 197, 204, '2018-07-31 22:14:45', 23, NULL, '1', '2018-07-31 22:14:45', NULL, '1'),
(200, 15, 197, 202, '2018-07-31 23:20:27', 23, NULL, '1', '2018-07-31 23:20:27', NULL, '1'),
(201, 15, 209, 203, '2018-07-31 23:20:39', 23, NULL, '1', '2018-07-31 23:20:39', NULL, '1'),
(202, 15, 197, 201, '2018-07-31 23:20:49', 23, NULL, '1', '2018-07-31 23:20:49', NULL, '1'),
(203, 15, 164, 200, '2018-07-31 23:20:59', 23, NULL, '1', '2018-07-31 23:20:59', NULL, '1'),
(204, 15, 164, 199, '2018-07-31 23:21:07', 23, NULL, '1', '2018-07-31 23:21:07', NULL, '1'),
(205, 15, 197, 196, '2018-07-31 23:21:16', 23, NULL, '1', '2018-07-31 23:21:16', NULL, '1'),
(206, 15, 197, 198, '2018-07-31 23:21:25', 23, NULL, '1', '2018-07-31 23:21:25', NULL, '1'),
(207, 15, 197, 195, '2018-07-31 23:21:33', 23, NULL, '1', '2018-07-31 23:21:33', NULL, '1'),
(208, 17, 164, 167, '2018-07-31 23:29:02', 23, NULL, '1', '2018-07-31 23:29:02', NULL, '1'),
(209, 16, 212, 212, '2018-08-13 20:59:11', 23, NULL, '1', '2018-08-13 20:59:11', NULL, '1'),
(210, 16, 213, 213, '2018-08-13 20:59:26', 23, NULL, '1', '2018-08-13 20:59:26', NULL, '1'),
(211, 16, 214, 214, '2018-08-15 16:03:13', 23, NULL, '1', '2018-08-15 16:03:13', NULL, '1'),
(212, 16, 215, 215, '2018-08-16 21:20:17', 23, NULL, '1', '2018-08-16 21:20:17', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `asignatura`
--

CREATE TABLE `asignatura` (
  `asi_id` bigint(20) NOT NULL,
  `asi_nombre` varchar(200) NOT NULL,
  `asi_descripcion` varchar(500) NOT NULL,
  `asi_estado_asignatura` varchar(1) NOT NULL,
  `asi_estado` varchar(1) NOT NULL,
  `asi_fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `asi_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `asi_estado_logico` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `asignatura`
--

INSERT INTO `asignatura` (`asi_id`, `asi_nombre`, `asi_descripcion`, `asi_estado_asignatura`, `asi_estado`, `asi_fecha_creacion`, `asi_fecha_modificacion`, `asi_estado_logico`) VALUES
(1, 'Matemáticas - CAN', 'Matemáticas - CAN', '1', '1', '2018-05-09 03:15:37', NULL, '1'),
(2, 'Contabilidad - CAN', 'Contabilidad - CAN', '1', '1', '2018-05-09 03:15:37', NULL, '1'),
(3, 'Técnicas de comunicación oral - CAN', 'Técnicas de comunicación oral - CAN', '1', '1', '2018-05-09 03:16:01', NULL, '1'),
(4, 'Desarrollo del Pensamiento - CAN', 'Desarrollo del Pensamiento - CAN', '1', '1', '2018-05-09 03:16:52', NULL, '1'),
(5, 'Emprendimiento - CAN', 'Emprendimiento - CAN', '1', '1', '2018-05-09 03:16:52', NULL, '1'),
(6, 'Matematicas I', 'Matematicas I', 'A', '1', '2018-05-09 03:17:03', NULL, '1'),
(7, 'Fundamentos Para Softwares Especializados', 'Fundamentos Para Softwares Especializados', 'A', '1', '2018-05-09 03:17:04', NULL, '1'),
(8, 'Fundamentos De Economia', 'Fundamentos De Economia', 'A', '1', '2018-05-09 03:17:15', NULL, '1'),
(9, 'Derecho Constitucional', 'Derecho Constitucional', 'A', '1', '2018-05-09 03:17:18', NULL, '1'),
(10, 'Fundamentos De Administracion', 'Fundamentos De Administracion', 'A', '1', '2018-05-09 03:17:19', NULL, '1'),
(11, 'Tecnicas De Comunicacion Oral Y Escrita', 'Tecnicas De Comunicacion Oral Y Escrita', 'A', '1', '2018-05-09 03:17:40', NULL, '1'),
(12, 'Matematicas II', 'Matematicas II', 'A', '1', '2018-05-09 03:17:41', NULL, '1'),
(13, 'Matematicas Financieras', 'Matematicas Financieras', 'A', '1', '2018-05-09 03:17:41', NULL, '1'),
(14, 'Microeconomia', 'Microeconomia', 'A', '1', '2018-05-09 03:17:42', NULL, '1'),
(15, 'Contabilidad General', 'Contabilidad General', 'A', '1', '2018-05-09 03:17:43', NULL, '1'),
(16, 'Fundamentos De Mercadotecnia', 'Fundamentos De Mercadotecnia', 'A', '1', '2018-05-09 03:17:45', NULL, '1'),
(17, 'Estadisticas I', 'Estadisticas I', 'A', '1', '2018-05-09 03:17:46', NULL, '1'),
(18, 'Actualidad Economica', 'Actualidad Economica', 'A', '1', '2018-05-09 03:17:48', NULL, '1'),
(19, 'Macroeconomia', 'Macroeconomia', 'A', '1', '2018-05-09 03:17:49', NULL, '1'),
(20, 'Legislacion Y Derecho Aduanero', 'Legislacion Y Derecho Aduanero', 'A', '1', '2018-05-09 03:17:49', NULL, '1'),
(21, 'Contabilidad Gerencial', 'Contabilidad Gerencial', 'A', '1', '2018-05-09 03:17:49', NULL, '1'),
(22, 'Etica Profesional', 'Etica Profesional', 'A', '1', '2018-05-09 03:17:50', NULL, '1'),
(23, 'Estadisticas II', 'Estadisticas II', 'A', '1', '2018-05-09 03:31:16', NULL, '1'),
(24, 'Planeacion Y Direccion Estrategica', 'Planeacion Y Direccion Estrategica', 'A', '1', '2018-05-09 03:31:16', NULL, '1'),
(25, 'Epistemologia Del Comercio Exterior', 'Epistemologia Del Comercio Exterior', 'A', '1', '2018-05-09 03:31:17', NULL, '1'),
(26, 'Derecho Internacional', 'Derecho Internacional', 'A', '1', '2018-05-09 03:31:19', NULL, '1'),
(27, 'Finanzas', 'Finanzas', 'A', '1', '2018-05-09 03:31:19', NULL, '1'),
(28, 'Practicas Pre Profesionales I', 'Practicas Pre Profesionales I', 'A', '1', '2018-05-09 03:31:19', NULL, '1'),
(29, 'Investigacion De Operaciones', 'Investigacion De Operaciones', 'A', '1', '2018-05-09 03:31:28', NULL, '1'),
(30, 'Negocios Internacionales', 'Negocios Internacionales', 'A', '1', '2018-05-09 03:31:28', NULL, '1'),
(31, 'Nomenclatura Arancelaria', 'Nomenclatura Arancelaria', 'A', '1', '2018-05-09 03:31:28', NULL, '1'),
(32, 'Presupuesto', 'Presupuesto', 'A', '1', '2018-05-09 03:31:28', NULL, '1'),
(33, 'Finanzas Internacionales', 'Finanzas Internacionales', 'A', '1', '2018-05-09 03:31:28', NULL, '1'),
(34, 'Practicas Pre Profesionales II', 'Practicas Pre Profesionales II', 'A', '1', '2018-05-09 03:31:28', NULL, '1'),
(35, 'Investigacion De Mercados Internacionales', 'Investigacion De Mercados Internacionales', 'A', '1', '2018-05-09 03:31:29', NULL, '1'),
(36, 'Emprendimiento E Innovacion', 'Emprendimiento E Innovacion', 'A', '1', '2018-05-09 03:31:31', NULL, '1'),
(37, 'Gestion Ambiental', 'Gestion Ambiental', 'A', '1', '2018-05-09 03:31:37', NULL, '1'),
(38, 'Valoracion Aduanera', 'Valoracion Aduanera', 'A', '1', '2018-05-09 03:31:39', NULL, '1'),
(39, 'Logistica Y Transporte Internacional', 'Logistica Y Transporte Internacional', 'A', '1', '2018-05-09 03:31:39', NULL, '1'),
(40, 'Metodologia De La Investigacion', 'Metodologia De La Investigacion', 'A', '1', '2018-05-09 03:31:39', NULL, '1'),
(41, 'Oferta Exportable Del Ecuador', 'Oferta Exportable Del Ecuador', 'A', '1', '2018-05-09 03:31:41', NULL, '1'),
(42, 'Formulacion Y Evaluacion De Proyectos', 'Formulacion Y Evaluacion De Proyectos', 'A', '1', '2018-05-09 03:31:41', NULL, '1'),
(43, 'Responsabilidad Social Y Empresarial', 'Responsabilidad Social Y Empresarial', 'A', '1', '2018-05-09 03:31:41', NULL, '1'),
(44, 'Merceologia', 'Merceologia', 'A', '1', '2018-05-09 03:31:43', NULL, '1'),
(45, 'Distribucion Fisica Internacional', 'Distribucion Fisica Internacional', 'A', '1', '2018-05-09 03:31:43', NULL, '1'),
(46, 'Gestion Del Talento Humano', 'Gestion Del Talento Humano', 'A', '1', '2018-05-09 03:31:43', NULL, '1'),
(47, 'Interculturalidad: Culturas Ancestrales Y Generos', 'Interculturalidad: Culturas Ancestrales Y Generos', 'A', '1', '2018-05-09 03:31:46', NULL, '1'),
(48, 'Comercio Electronico', 'Comercio Electronico', 'A', '1', '2018-05-09 03:31:48', NULL, '1'),
(49, 'Diplomacia Internacional', 'Diplomacia Internacional', 'A', '1', '2018-05-09 03:31:50', NULL, '1'),
(50, 'Introduccion Al Trabajo De Titulacion', 'Introduccion Al Trabajo De Titulacion', 'A', '1', '2018-05-09 03:31:50', NULL, '1'),
(51, 'Trabajo De Titulacion I', 'Trabajo De Titulacion I', 'A', '1', '2018-05-09 03:31:52', NULL, '1'),
(52, 'Practicas Pre Profesionales III (VINCULACION)', 'Practicas Pre Profesionales III (VINCULACION)', 'A', '1', '2018-05-09 03:31:54', NULL, '1'),
(53, 'Normas Internacionales De Calidad', 'Normas Internacionales De Calidad', 'A', '1', '2018-05-09 03:31:55', NULL, '1'),
(54, 'Sistemas Aduaneros', 'Sistemas Aduaneros', 'A', '1', '2018-05-09 03:31:55', NULL, '1'),
(55, 'Economia Internacional', 'Economia Internacional', 'A', '1', '2018-05-09 03:31:55', NULL, '1'),
(56, 'Liderazgo Y Habilidades Gerenciales', 'Liderazgo Y Habilidades Gerenciales', 'A', '1', '2018-05-09 03:31:58', NULL, '1'),
(57, 'Marketing Internacional', 'Marketing Internacional', 'A', '1', '2018-05-09 03:32:02', NULL, '1'),
(58, 'Trabajo De Titulacion II', 'Trabajo De Titulacion II', 'A', '1', '2018-05-09 03:32:02', NULL, '1'),
(59, 'Fundamentos Para El Software Especializados', 'Fundamentos Para El Software Especializados', 'A', '1', '2018-05-09 03:32:15', NULL, '1'),
(60, 'Epistemologia De La Economia', 'Epistemologia De La Economia', 'A', '1', '2018-05-09 03:32:20', NULL, '1'),
(61, 'Algebra Lineal', 'Algebra Lineal', 'A', '1', '2018-05-09 03:32:24', NULL, '1'),
(62, 'Microeconomia I', 'Microeconomia I', 'A', '1', '2018-05-09 03:32:25', NULL, '1'),
(63, 'Macroeconomia I', 'Macroeconomia I', 'A', '1', '2018-05-09 03:32:28', NULL, '1'),
(64, 'Microeconomia II', 'Microeconomia II', 'A', '1', '2018-05-09 03:32:32', NULL, '1'),
(65, 'Derecho Laboral', 'Derecho Laboral', 'A', '1', '2018-05-09 03:32:32', NULL, '1'),
(66, 'Administracion Financiera', 'Administracion Financiera', 'A', '1', '2018-05-09 03:32:32', NULL, '1'),
(67, 'Econometria I', 'Econometria I', 'A', '1', '2018-05-09 03:33:41', NULL, '1'),
(68, 'Macroeconomia II', 'Macroeconomia II', 'A', '1', '2018-05-09 03:33:41', NULL, '1'),
(69, 'Metodologia De Investigacion', 'Metodologia De Investigacion', 'A', '1', '2018-05-09 03:33:53', NULL, '1'),
(70, 'Econometria II', 'Econometria II', 'A', '1', '2018-05-09 03:34:01', NULL, '1'),
(71, 'Moneda E Instituciones Financieras', 'Moneda E Instituciones Financieras', 'A', '1', '2018-05-09 03:34:01', NULL, '1'),
(72, 'Historia Economica Y Politica Del Ecuador', 'Historia Economica Y Politica Del Ecuador', 'A', '1', '2018-05-09 03:34:01', NULL, '1'),
(73, 'Teoria Del Desarrollo Economico', 'Teoria Del Desarrollo Economico', 'A', '1', '2018-05-09 03:34:08', NULL, '1'),
(74, 'Gestion De Calidad', 'Gestion De Calidad', 'A', '1', '2018-05-09 03:34:09', NULL, '1'),
(75, 'Economia Ambiental', 'Economia Ambiental', 'A', '1', '2018-05-09 03:34:12', NULL, '1'),
(76, 'Derecho Economico', 'Derecho Economico', 'A', '1', '2018-05-09 03:34:12', NULL, '1'),
(77, 'Teoria Monetaria Internacional', 'Teoria Monetaria Internacional', 'A', '1', '2018-05-09 03:34:15', NULL, '1'),
(78, 'Tributacion', 'Tributacion', 'A', '1', '2018-05-09 03:34:20', NULL, '1'),
(79, 'Finanzas Publicas', 'Finanzas Publicas', 'A', '1', '2018-05-09 03:34:29', NULL, '1'),
(80, 'Interculturalidad. Cultura Ancestrales Y Genero', 'Interculturalidad. Cultura Ancestrales Y Genero', 'A', '1', '2018-05-09 03:34:29', NULL, '1'),
(81, 'Politica Economica Y Fiscal', 'Politica Economica Y Fiscal', 'A', '1', '2018-05-09 03:34:30', NULL, '1'),
(82, 'Modelos Econometricos', 'Modelos Econometricos', 'A', '1', '2018-05-09 03:34:35', NULL, '1'),
(83, 'Public Choice', 'Public Choice', 'A', '1', '2018-05-09 03:34:39', NULL, '1'),
(84, 'Loderazgo Y Habilidades Gerenciales', 'Loderazgo Y Habilidades Gerenciales', 'A', '1', '2018-05-09 03:34:40', NULL, '1'),
(85, 'Fundamentos Para Software Especializados', 'Fundamentos Para Software Especializados', 'A', '1', '2018-05-09 03:35:12', NULL, '1'),
(86, 'Epistemologia De Las Finanzas ', 'Epistemologia De Las Finanzas ', 'A', '1', '2018-05-09 03:35:17', NULL, '1'),
(87, 'Matematicas Financiera', 'Matematicas Financiera', 'A', '1', '2018-05-09 03:35:44', NULL, '1'),
(88, 'Derecho Financiero Y Tributario', 'Derecho Financiero Y Tributario', 'A', '1', '2018-05-09 03:36:10', NULL, '1'),
(89, 'Mercado De Valores', 'Mercado De Valores', 'A', '1', '2018-05-09 03:36:17', NULL, '1'),
(90, 'Finanzas Corporativas I', 'Finanzas Corporativas I', 'A', '1', '2018-05-09 03:36:17', NULL, '1'),
(91, 'Derecho Mercantil', 'Derecho Mercantil', 'A', '1', '2018-05-09 03:36:17', NULL, '1'),
(92, 'Finanzas Corporativas II', 'Finanzas Corporativas II', 'A', '1', '2018-05-09 03:36:18', NULL, '1'),
(93, 'Auditoria', 'Auditoria', 'A', '1', '2018-05-09 03:36:25', NULL, '1'),
(94, 'Adm Del Riesgo', 'Adm Del Riesgo', 'A', '1', '2018-05-09 03:36:32', NULL, '1'),
(95, 'Auditoria Tributaria', 'Auditoria Tributaria', 'A', '1', '2018-05-09 03:36:32', NULL, '1'),
(96, 'Auditoria Financiera', 'Auditoria Financiera', 'A', '1', '2018-05-09 03:36:32', NULL, '1'),
(97, 'Gerencia Financiera', 'Gerencia Financiera', 'A', '1', '2018-05-09 03:36:38', NULL, '1'),
(98, 'Practicas Pre Profesionales III', 'Practicas Pre Profesionales III', 'A', '1', '2018-05-09 03:36:44', NULL, '1'),
(99, 'Simulacion De Negocios', 'Simulacion De Negocios', 'A', '1', '2018-05-09 03:36:45', NULL, '1'),
(100, 'Interculturalidad Culturas Ancestrales Y Genero', 'Interculturalidad Culturas Ancestrales Y Genero', 'A', '1', '2018-05-09 03:36:45', NULL, '1'),
(101, 'Fusiones Y Adquisiciones', 'Fusiones Y Adquisiciones', 'A', '1', '2018-05-09 03:37:18', NULL, '1'),
(102, 'Auditoria De Sistemas', 'Auditoria De Sistemas', 'A', '1', '2018-05-09 03:37:25', NULL, '1'),
(103, 'Liderazgo Y Habilidad Gerenciales', 'Liderazgo Y Habilidad Gerenciales', 'A', '1', '2018-05-09 03:37:25', NULL, '1'),
(104, 'Gestion Practica Y Tributaria', 'Gestion Practica Y Tributaria', 'A', '1', '2018-05-09 03:37:34', NULL, '1'),
(105, 'Epistemologia', 'Epistemologia', 'A', '1', '2018-05-09 03:38:27', NULL, '1'),
(106, 'Estadistica I', 'Estadistica I', 'A', '1', '2018-05-09 03:39:16', NULL, '1'),
(107, 'Marco Legal De La Mercadotecnia', 'Marco Legal De La Mercadotecnia', 'A', '1', '2018-05-09 03:39:16', NULL, '1'),
(108, 'Estadistica II', 'Estadistica II', 'A', '1', '2018-05-09 03:39:17', NULL, '1'),
(109, 'Marketing Estrategico', 'Marketing Estrategico', 'A', '1', '2018-05-09 03:39:17', NULL, '1'),
(110, 'Investigacion De Mercados', 'Investigacion De Mercados', 'A', '1', '2018-05-09 03:39:17', NULL, '1'),
(111, 'Plan De Marketing', 'Plan De Marketing', 'A', '1', '2018-05-09 03:39:18', NULL, '1'),
(112, 'Creatividad E Innovacion', 'Creatividad E Innovacion', 'A', '1', '2018-05-09 03:39:18', NULL, '1'),
(113, 'Comportamiento Del Consumidor', 'Comportamiento Del Consumidor', 'A', '1', '2018-05-09 03:39:18', NULL, '1'),
(114, 'Marketing Digital', 'Marketing Digital', 'A', '1', '2018-05-09 03:39:18', NULL, '1'),
(115, 'Diseno Grafico Publicitario', 'Diseno Grafico Publicitario', 'A', '1', '2018-05-09 03:39:19', NULL, '1'),
(116, 'Politicas De Precio Y Producto', 'Politicas De Precio Y Producto', 'A', '1', '2018-05-09 03:39:19', NULL, '1'),
(117, 'Logistica Y Distribucion', 'Logistica Y Distribucion', 'A', '1', '2018-05-09 03:39:19', NULL, '1'),
(118, 'Publicidad Y Promocion', 'Publicidad Y Promocion', 'A', '1', '2018-05-09 03:39:19', NULL, '1'),
(119, 'Emprendimiento', 'Emprendimiento', 'A', '1', '2018-05-09 03:39:19', NULL, '1'),
(120, 'Marketing De Servicios', 'Marketing De Servicios', 'A', '1', '2018-05-09 03:39:19', NULL, '1'),
(121, 'Practicas Pre Profesionales II (VINCULACION)', 'Practicas Pre Profesionales II (VINCULACION)', 'A', '1', '2018-05-09 03:39:20', NULL, '1'),
(122, 'Retailing', 'Retailing', 'A', '1', '2018-05-09 03:39:20', NULL, '1'),
(123, 'Gerencia De Marketing', 'Gerencia De Marketing', 'A', '1', '2018-05-09 03:39:20', NULL, '1'),
(124, 'Desarrollo Y Administracion De Nuevos Productos', 'Desarrollo Y Administracion De Nuevos Productos', 'A', '1', '2018-05-09 03:39:20', NULL, '1'),
(125, 'Relaciones Publicas Y Marketing Directo', 'Relaciones Publicas Y Marketing Directo', 'A', '1', '2018-05-09 03:39:21', NULL, '1'),
(126, 'Liderazgo Y Habilidad Gerencial', 'Liderazgo Y Habilidad Gerencial', 'A', '1', '2018-05-09 03:39:21', NULL, '1'),
(127, 'Interculturalidad D. Culturas Ancestrales Y Genero', 'Interculturalidad D. Culturas Ancestrales Y Genero', 'A', '1', '2018-05-09 03:39:21', NULL, '1'),
(128, 'Epistemologia Del Turismo', 'Epistemologia Del Turismo', 'A', '1', '2018-05-09 03:40:13', NULL, '1'),
(129, 'Fundamento Para Softwares Especializados', 'Fundamento Para Softwares Especializados', 'A', '1', '2018-05-09 03:40:31', NULL, '1'),
(130, 'Historia Del Ecuador', 'Historia Del Ecuador', 'A', '1', '2018-05-09 03:40:50', NULL, '1'),
(131, 'Psicologia Del Turismo', 'Psicologia Del Turismo', 'A', '1', '2018-05-09 03:41:04', NULL, '1'),
(132, 'Derecho', 'Derecho', 'A', '1', '2018-05-09 03:41:04', NULL, '1'),
(133, 'Geografia Turistica', 'Geografia Turistica', 'A', '1', '2018-05-09 03:41:41', NULL, '1'),
(134, 'Sociologia Del Turismo', 'Sociologia Del Turismo', 'A', '1', '2018-05-09 03:41:41', NULL, '1'),
(135, 'Practicas Pre Profesionales', 'Practicas Pre Profesionales', 'A', '1', '2018-05-09 03:41:52', NULL, '1'),
(136, 'Patrimomio Natural Del Ecuador', 'Patrimomio Natural Del Ecuador', 'A', '1', '2018-05-09 03:42:13', NULL, '1'),
(137, 'Asistencia De Grupos Turisticos', 'Asistencia De Grupos Turisticos', 'A', '1', '2018-05-09 03:42:13', NULL, '1'),
(138, 'Desarrollo De Infraestructura Turistica', 'Desarrollo De Infraestructura Turistica', 'A', '1', '2018-05-09 03:42:26', NULL, '1'),
(139, 'Patrimonio Universal', 'Patrimonio Universal', 'A', '1', '2018-05-09 03:42:37', NULL, '1'),
(140, 'Tecnicas De Operaciones Turisticas', 'Tecnicas De Operaciones Turisticas', 'A', '1', '2018-05-09 03:42:47', NULL, '1'),
(141, 'Legislacion Turistica', 'Legislacion Turistica', 'A', '1', '2018-05-09 03:42:47', NULL, '1'),
(142, 'Responsabilidad Social', 'Responsabilidad Social', 'A', '1', '2018-05-09 03:43:21', NULL, '1'),
(143, 'Gestion Hotelera', 'Gestion Hotelera', 'A', '1', '2018-05-09 03:43:36', NULL, '1'),
(144, 'Agencia De Viajes', 'Agencia De Viajes', 'A', '1', '2018-05-09 03:43:36', NULL, '1'),
(145, 'Tecnicas Culinarias', 'Tecnicas Culinarias', 'A', '1', '2018-05-09 03:43:37', NULL, '1'),
(146, 'Gestion De Restauracion', 'Gestion De Restauracion', 'A', '1', '2018-05-09 03:43:48', NULL, '1'),
(147, 'Turismo Sostenible', 'Turismo Sostenible', 'A', '1', '2018-05-09 03:43:48', NULL, '1'),
(148, 'Gestion De Seguridad', 'Gestion De Seguridad', 'A', '1', '2018-05-09 03:43:48', NULL, '1'),
(149, 'Transporte Turistico', 'Transporte Turistico', 'A', '1', '2018-05-09 03:43:48', NULL, '1'),
(150, 'Gastronomia', 'Gastronomia', 'A', '1', '2018-05-09 03:43:48', NULL, '1'),
(151, 'Planeacion Estrategica Sostenible', 'Planeacion Estrategica Sostenible', 'A', '1', '2018-05-09 03:43:48', NULL, '1'),
(152, 'Evaluacion De Proyectos', 'Evaluacion De Proyectos', 'A', '1', '2018-05-09 03:44:55', NULL, '1'),
(153, 'Tendencias Tecnologicas Del Turismo', 'Tendencias Tecnologicas Del Turismo', 'A', '1', '2018-05-09 03:44:55', NULL, '1'),
(154, 'Trafico Aereo Gds De Reservas', 'Trafico Aereo Gds De Reservas', 'A', '1', '2018-05-09 03:44:56', NULL, '1'),
(155, 'Eventos Y Convenciones', 'Eventos Y Convenciones', 'A', '1', '2018-05-09 03:44:56', NULL, '1'),
(156, 'Fundamentos De La Administracion', 'Fundamentos De La Administracion', 'A', '1', '2018-05-09 03:47:15', NULL, '1'),
(157, 'Contabilidad De Costo', 'Contabilidad De Costo', 'A', '1', '2018-05-09 03:48:11', NULL, '1'),
(158, 'Investigacion De Mercado', 'Investigacion De Mercado', 'A', '1', '2018-05-09 03:48:45', NULL, '1'),
(159, 'Derecho Tributario Y Financiero', 'Derecho Tributario Y Financiero', 'A', '1', '2018-05-09 03:49:11', NULL, '1'),
(160, 'Gestion De La Cadena De Suministros Scm', 'Gestion De La Cadena De Suministros Scm', 'A', '1', '2018-05-09 03:51:07', NULL, '1'),
(161, 'Gerencia De Produccion', 'Gerencia De Produccion', 'A', '1', '2018-05-09 03:51:07', NULL, '1'),
(162, 'Elaboracion Y Evaluacion De Proyectos', 'Elaboracion Y Evaluacion De Proyectos', 'A', '1', '2018-05-09 03:51:39', NULL, '1'),
(163, 'Interculturalidad. Culturas Ancestrales Y Generos', 'Interculturalidad. Culturas Ancestrales Y Generos', 'A', '1', '2018-05-09 03:52:26', NULL, '1'),
(164, 'Sistema De Informacion Gerencial', 'Sistema De Informacion Gerencial', 'A', '1', '2018-05-09 03:52:56', NULL, '1'),
(165, 'Gerencia Del Marketing', 'Gerencia Del Marketing', 'A', '1', '2018-05-09 03:52:56', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `cabecera_malla`
--

CREATE TABLE `cabecera_malla` (
  `cmal_id` bigint(20) NOT NULL,
  `tmal_id` bigint(20) NOT NULL,
  `cmal_nombre` varchar(250) NOT NULL,
  `cmal_descripcion` varchar(500) NOT NULL,
  `cmal_fecha_vigencia_inicio` timestamp NULL DEFAULT NULL,
  `cmal_fecha_vigencia_fin` timestamp NULL DEFAULT NULL,
  `cmal_usuario_ingreso` int(11) NOT NULL,
  `cmal_usuario_modifica` int(11) DEFAULT NULL,
  `cmal_estado` varchar(1) NOT NULL,
  `cmal_fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cmal_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `cmal_estado_logico` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cabecera_malla`
--

INSERT INTO `cabecera_malla` (`cmal_id`, `tmal_id`, `cmal_nombre`, `cmal_descripcion`, `cmal_fecha_vigencia_inicio`, `cmal_fecha_vigencia_fin`, `cmal_usuario_ingreso`, `cmal_usuario_modifica`, `cmal_estado`, `cmal_fecha_creacion`, `cmal_fecha_modificacion`, `cmal_estado_logico`) VALUES
(1, 1, 'Curso de Admisión y Nivelación', 'Malla Can', '2018-01-02 19:26:55', '2023-01-02 19:26:55', 1, NULL, '1', '2018-08-28 19:07:36', NULL, '1'),
(2, 2, 'Licenciatura en Mercadotecnia', 'Malla curricular de Licenciatura en Mercadotecnia', '2018-01-03 19:26:55', '2023-01-03 19:26:55', 1, NULL, '1', '2018-08-28 19:07:36', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `campo_formacion`
--

CREATE TABLE `campo_formacion` (
  `cfor_id` bigint(20) NOT NULL,
  `cfor_codigo` varchar(5) NOT NULL,
  `cfor_nombre` varchar(200) NOT NULL,
  `cfor_descripcion` varchar(500) NOT NULL,
  `cfor_estado` varchar(1) NOT NULL,
  `cfor_fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cfor_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `cfor_estado_logico` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `campo_formacion`
--

INSERT INTO `campo_formacion` (`cfor_id`, `cfor_codigo`, `cfor_nombre`, `cfor_descripcion`, `cfor_estado`, `cfor_fecha_creacion`, `cfor_fecha_modificacion`, `cfor_estado_logico`) VALUES
(1, 'FT', 'Fundamentos Teóricos', 'Fundamentos Teóricos', '1', '2018-08-28 19:07:35', NULL, '1'),
(2, 'PP', 'Praxis Profesional', 'Praxis Profesional', '1', '2018-08-28 19:07:35', NULL, '1'),
(3, 'EMI', 'Epistemología y Metodología de la Investigación', 'Epistemología y Metodología de la Investigación', '1', '2018-08-28 19:07:35', NULL, '1'),
(4, 'ISSC', 'Integración de Saberes, Contexto y Cultura', 'Integración de Saberes, Contexto y Cultura', '1', '2018-08-28 19:07:35', NULL, '1'),
(5, 'CL', 'Comunicación y Lenguaje', 'Comunicación y Lenguaje', '1', '2018-08-28 19:07:35', NULL, '1'),
(6, 'CN', 'Can', 'Can', '1', '2018-08-28 19:07:35', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `carrera`
--

CREATE TABLE `carrera` (
  `car_id` bigint(20) NOT NULL,
  `car_nombre` varchar(200) NOT NULL,
  `car_descripcion` varchar(500) NOT NULL,
  `car_alias` varchar(200) NOT NULL,
  `car_total_asignatura` int(11) DEFAULT NULL,
  `car_duracion_anio` int(11) DEFAULT NULL,
  `car_estado_carrera` varchar(2) NOT NULL,
  `car_estado` varchar(1) NOT NULL,
  `car_fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `car_fecha_aprobacion` timestamp NULL DEFAULT NULL,
  `car_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `car_estado_logico` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `carrera`
--

INSERT INTO `carrera` (`car_id`, `car_nombre`, `car_descripcion`, `car_alias`, `car_total_asignatura`, `car_duracion_anio`, `car_estado_carrera`, `car_estado`, `car_fecha_creacion`, `car_fecha_aprobacion`, `car_fecha_modificacion`, `car_estado_logico`) VALUES
(1, 'Licenciatura en Comercio Exterior', 'Licenciatura en Comercio Exterior', 'licenciatura_en_comercio_exterior', NULL, NULL, 'A', '1', '2018-08-28 19:07:35', NULL, NULL, '1'),
(2, 'Economía', 'Economía', 'economía', NULL, NULL, 'A', '1', '2018-08-28 19:07:35', NULL, NULL, '1'),
(3, 'Licenciatura en Finanzas', ' Licenciatura en Finanzas', 'licenciatura_en_finanzas', NULL, NULL, 'A', '1', '2018-08-28 19:07:35', NULL, NULL, '1'),
(4, 'Licenciatura en Mercadotecnia', ' Licenciatura en Mercadotecnia', 'licenciatura_en_mercadotecnia', NULL, NULL, 'A', '1', '2018-08-28 19:07:35', NULL, NULL, '1'),
(5, 'Licenciatura en Turismo', 'Licenciatura en Turismo', 'licenciatura_en_turismo', NULL, NULL, 'A', '1', '2018-08-28 19:07:35', NULL, NULL, '1'),
(6, 'Licenciatura en Administracion de Empresas', 'Licenciatura en Administración de Empresas', 'licenciatura_en_administración_de_empresas', NULL, NULL, 'A', '1', '2018-08-28 19:07:35', NULL, NULL, '1'),
(7, 'Ingenieria en Software', 'Ingenieria En Software', 'ingenieria_en_software', NULL, NULL, 'A', '1', '2018-08-28 19:07:35', NULL, NULL, '1'),
(8, 'Ingenieria en Telecomunicaciones', 'Ingenieria en Telecomunicaciones', 'ingenieria_en_telecomunicaciones', NULL, NULL, 'A', '1', '2018-08-28 19:07:35', NULL, NULL, '1'),
(9, 'Licenciatura en Contabilidad y Auditoria', 'Licenciatura en Contabilidad y Auditoria', 'licenciatura_en_contabilidad_y_auditoria', NULL, NULL, 'A', '1', '2018-08-28 19:07:35', NULL, NULL, '1'),
(10, 'Ingenieria en Tecnologias De La Informacion', 'Ingenieria en Tecnologias De La Informacion', 'ingenieria_en_tecnologias_de_la_informacion', NULL, NULL, 'A', '1', '2018-08-28 19:07:35', NULL, NULL, '1'),
(11, 'Ingenieria en Logística y Transporte', 'Ingenieria en Logística y Transporte', 'ingenieria_en_logística_y_transporte', NULL, NULL, 'A', '1', '2018-08-28 19:07:35', NULL, NULL, '1'),
(12, 'Licenciatura en Comunicación', 'Licenciatura en Comunicación', 'licenciatura_en_comunicación', NULL, NULL, 'A', '1', '2018-08-28 19:07:35', NULL, NULL, '1'),
(13, 'Licenciatura en Gestión y Talento Humano', 'Licenciatura en Gestión y Talento Humano', 'licenciatura_en_gestión y_talento_humano', NULL, NULL, 'A', '1', '2018-08-28 19:07:35', NULL, NULL, '1'),
(14, 'Licenciatura en Administración Portuaria y Aduanera', 'Licenciatura en  administración Portuaria y Aduanera', 'licenciatura_en_administración_portuaria_y_aduanera', NULL, NULL, 'A', '1', '2018-08-28 19:07:35', NULL, NULL, '1'),
(15, 'Administración de Empresas', 'Administración de Empresas', 'administración_de_empresas', NULL, NULL, 'A', '1', '2018-08-28 19:07:35', NULL, NULL, '1'),
(16, 'Finanzas', 'Finanzas', 'finanzas', NULL, NULL, 'A', '1', '2018-08-28 19:07:35', NULL, NULL, '1'),
(17, 'Marketing', 'Marketing', 'marketing', NULL, NULL, 'A', '1', '2018-08-28 19:07:35', NULL, NULL, '1'),
(18, 'Sistema de Información Gerencial', 'Sistema de Información Gerencial', 'sistema_de_información_gerencial', NULL, NULL, 'A', '1', '2018-08-28 19:07:35', NULL, NULL, '1'),
(19, 'Turismo', 'Turismo', 'turismo', NULL, NULL, 'A', '1', '2018-08-28 19:07:35', NULL, NULL, '1'),
(20, 'Talento Humano', 'Talento Humano', 'talento_humano', NULL, NULL, 'A', '1', '2018-08-28 19:07:35', NULL, NULL, '1'),
(21, 'Empresas Familiares', 'Empresas Familiares', 'empresas_familiares', NULL, NULL, 'A', '1', '2018-08-28 19:07:35', NULL, NULL, '1'),
(22, 'Investigación', 'Investigación', 'investigación', NULL, NULL, 'A', '1', '2018-08-28 19:07:35', NULL, NULL, '1'),
(23, 'Bourdeaux UTEG', 'Bourdeaux UTEG', 'bourdeaux_uteg', NULL, NULL, 'A', '1', '2018-08-28 19:07:35', NULL, NULL, '1'),
(24, 'Emprendimiento y Ventas', 'Emprendimiento y Ventas', 'emprendimiento_y_ventas', NULL, NULL, 'A', '1', '2018-08-28 19:07:35', NULL, NULL, '1'),
(25, 'Excel Avanzado', 'Excel Avanzado', 'excel_avanzado', NULL, NULL, 'A', '1', '2018-08-28 19:07:35', NULL, NULL, '1'),
(26, 'Fotografía', 'Fotografía', 'fotografía', NULL, NULL, 'A', '1', '2018-08-28 19:07:35', NULL, NULL, '1'),
(27, 'Event Planner', 'Event Planner', 'event_planner', NULL, NULL, 'A', '1', '2018-08-28 19:07:35', NULL, NULL, '1'),
(28, 'Programa Gerencia Estratégica del TH (4 módulos)', 'Programa Gerencia Estratégica del TH (4 módulos)', 'programa_gerencia_estratégica_del_th_(4 _módulos)', NULL, NULL, 'A', '1', '2018-08-28 19:07:35', NULL, NULL, '1'),
(29, 'Pedagogía', 'Pedagogía', 'pedagogía', NULL, NULL, 'A', '1', '2018-08-28 19:07:35', NULL, NULL, '1'),
(30, 'Redacción Científica', 'Redacción Científica', 'redacción_científica', NULL, NULL, 'A', '1', '2018-08-28 19:07:35', NULL, NULL, '1'),
(31, 'Desarrollo Habilidades Comerciales para Retail', 'Desarrollo Habilidades Comerciales para Retail', 'desarrollo_habilidades_comerciales_para_retail', NULL, NULL, 'A', '1', '2018-08-28 19:07:35', NULL, NULL, '1'),
(32, 'Idioma Inglés, Francés', 'Idioma Inglés, Francés', 'idioma_inglés,_francés', NULL, NULL, 'A', '1', '2018-08-28 19:07:35', NULL, NULL, '1'),
(33, 'Cursos Online', 'Cursos Online', 'cursos_online', NULL, NULL, 'A', '1', '2018-08-28 19:07:35', NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `carrera_asignatura`
--

CREATE TABLE `carrera_asignatura` (
  `casi_id` bigint(20) NOT NULL,
  `car_id` bigint(20) NOT NULL,
  `asi_id` bigint(20) NOT NULL,
  `naca_id` bigint(20) NOT NULL,
  `cfor_id` bigint(20) DEFAULT NULL,
  `casi_codigo_legal` varchar(200) DEFAULT NULL,
  `casi_hora_duracion` int(11) NOT NULL,
  `casi_credito` int(11) NOT NULL,
  `casi_estado` varchar(1) NOT NULL,
  `casi_fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `casi_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `casi_estado_logico` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `carrera_asignatura`
--

INSERT INTO `carrera_asignatura` (`casi_id`, `car_id`, `asi_id`, `naca_id`, `cfor_id`, `casi_codigo_legal`, `casi_hora_duracion`, `casi_credito`, `casi_estado`, `casi_fecha_creacion`, `casi_fecha_modificacion`, `casi_estado_logico`) VALUES
(1, 6, 1, 1, 1, 'GRA-O-CMX-001', 160, 4, '1', '2018-05-04 02:40:40', NULL, '1'),
(2, 6, 2, 1, 5, 'GRA-O-CMX-002', 80, 2, '1', '2018-05-04 02:40:48', NULL, '1'),
(3, 6, 3, 1, 1, 'GRA-O-CMX-003', 160, 4, '1', '2018-05-04 02:41:50', NULL, '1'),
(4, 6, 4, 1, 1, 'GRA-O-CMX-004', 80, 2, '1', '2018-05-04 02:46:33', NULL, '1'),
(5, 6, 5, 1, 1, 'GRA-O-CMX-005', 160, 4, '1', '2018-05-04 02:46:36', NULL, '1'),
(6, 6, 6, 1, 5, 'GRA-O-CMX-006', 160, 4, '1', '2018-05-04 02:46:38', NULL, '1'),
(7, 6, 7, 2, 1, 'GRA-O-CMX-007', 160, 4, '1', '2018-05-04 02:46:40', NULL, '1'),
(8, 6, 8, 2, 1, 'GRA-O-CMX-008', 160, 4, '1', '2018-05-04 02:46:41', NULL, '1'),
(9, 6, 9, 2, 1, 'GRA-O-CMX-009', 160, 4, '1', '2018-05-04 02:46:57', NULL, '1'),
(10, 6, 10, 2, 1, 'GRA-O-CMX-010', 160, 4, '1', '2018-05-04 02:46:57', NULL, '1'),
(11, 6, 11, 2, 1, 'GRA-O-CMX-011', 160, 4, '1', '2018-05-04 02:47:51', NULL, '1'),
(12, 6, 12, 3, 3, 'GRA-O-CMX-012', 160, 4, '1', '2018-05-04 02:51:54', NULL, '1'),
(13, 6, 13, 3, 2, 'GRA-O-CMX-013', 80, 2, '1', '2018-05-04 02:52:13', NULL, '1'),
(14, 6, 14, 3, 1, 'GRA-O-CMX-014', 160, 4, '1', '2018-05-04 02:52:33', NULL, '1'),
(15, 6, 15, 3, 2, 'GRA-O-CMX-015', 160, 4, '1', '2018-05-04 02:52:34', NULL, '1'),
(16, 6, 16, 3, 1, 'GRA-O-CMX-016', 160, 4, '1', '2018-05-04 02:52:34', NULL, '1'),
(17, 6, 17, 3, 4, 'GRA-O-CMX-017', 80, 2, '1', '2018-05-04 02:52:34', NULL, '1'),
(18, 6, 18, 4, 3, 'GRA-O-CMX-018', 160, 4, '1', '2018-05-04 02:53:02', NULL, '1'),
(19, 6, 19, 4, 2, 'GRA-O-CMX-019', 160, 4, '1', '2018-05-04 02:53:02', NULL, '1'),
(20, 6, 20, 4, 3, 'GRA-O-CMX-020', 160, 4, '1', '2018-05-04 02:53:02', NULL, '1'),
(21, 6, 21, 4, 2, 'GRA-O-CMX-021', 80, 2, '1', '2018-05-04 02:53:17', NULL, '1'),
(22, 6, 22, 4, 1, 'GRA-O-CMX-022', 160, 4, '1', '2018-05-04 02:53:17', NULL, '1'),
(23, 6, 23, 4, 2, 'GRA-O-CMX-023', 80, 2, '1', '2018-05-04 02:53:18', NULL, '1'),
(24, 6, 24, 5, 2, 'GRA-O-CMX-024', 160, 4, '1', '2018-05-04 02:53:39', NULL, '1'),
(25, 6, 25, 5, 2, 'GRA-O-CMX-025', 80, 2, '1', '2018-05-04 02:53:40', NULL, '1'),
(26, 6, 26, 5, 2, 'GRA-O-CMX-026', 160, 4, '1', '2018-05-04 02:53:41', NULL, '1'),
(27, 6, 27, 5, 2, 'GRA-O-CMX-027', 160, 4, '1', '2018-05-04 02:53:41', NULL, '1'),
(28, 6, 28, 5, 2, 'GRA-O-CMX-028', 80, 2, '1', '2018-05-04 02:53:41', NULL, '1'),
(29, 6, 29, 5, 2, 'GRA-O-CMX-029', 160, 4, '1', '2018-05-04 02:53:42', NULL, '1'),
(30, 6, 30, 6, 3, 'GRA-O-CMX-030', 160, 4, '1', '2018-05-04 02:53:42', NULL, '1'),
(31, 6, 31, 6, 2, 'GRA-O-CMX-031', 80, 2, '1', '2018-05-04 02:54:09', NULL, '1'),
(32, 6, 32, 6, 4, 'GRA-O-CMX-032', 80, 2, '1', '2018-05-04 02:54:20', NULL, '1'),
(33, 6, 33, 6, 2, 'GRA-O-CMX-033', 160, 4, '1', '2018-05-04 02:54:53', NULL, '1'),
(34, 6, 34, 6, 2, 'GRA-O-CMX-034', 160, 4, '1', '2018-05-04 02:54:53', NULL, '1'),
(35, 6, 35, 6, 3, 'GRA-O-CMX-035', 160, 4, '1', '2018-05-04 02:54:53', NULL, '1'),
(36, 6, 36, 7, 2, 'GRA-O-CMX-036', 160, 4, '1', '2018-05-04 02:55:20', NULL, '1'),
(37, 6, 37, 7, 2, 'GRA-O-CMX-037', 160, 4, '1', '2018-05-04 02:55:20', NULL, '1'),
(38, 6, 38, 7, 4, 'GRA-O-CMX-038', 80, 2, '1', '2018-05-04 02:55:21', NULL, '1'),
(39, 6, 39, 7, 2, 'GRA-O-CMX-039', 80, 2, '1', '2018-05-04 02:55:55', NULL, '1'),
(40, 6, 40, 7, 2, 'GRA-O-CMX-040', 160, 4, '1', '2018-05-04 02:55:55', NULL, '1'),
(41, 6, 41, 7, 2, 'GRA-O-CMX-041', 160, 4, '1', '2018-05-04 02:55:56', NULL, '1'),
(42, 6, 42, 8, 4, 'GRA-O-CMX-042', 160, 4, '1', '2018-05-04 02:56:05', NULL, '1'),
(43, 6, 43, 8, 2, 'GRA-O-CMX-043', 80, 2, '1', '2018-05-04 02:56:54', NULL, '1'),
(44, 6, 44, 8, 2, 'GRA-O-CMX-044', 160, 4, '1', '2018-05-04 02:57:26', NULL, '1'),
(45, 6, 45, 8, 3, 'GRA-O-CMX-045', 80, 2, '1', '2018-05-04 02:57:27', NULL, '1'),
(46, 6, 46, 8, 3, 'GRA-O-CMX-046', 160, 4, '1', '2018-05-04 02:57:42', NULL, '1'),
(47, 6, 47, 8, 2, 'GRA-O-CMX-047', 160, 4, '1', '2018-05-04 02:58:08', NULL, '1'),
(48, 6, 48, 9, 2, 'GRA-O-CMX-048', 80, 2, '1', '2018-05-04 02:58:08', NULL, '1'),
(49, 6, 25, 9, 2, 'GRA-O-CMX-049', 80, 2, '1', '2018-05-04 02:58:09', NULL, '1'),
(50, 6, 49, 9, 2, 'GRA-O-CMX-050', 160, 4, '1', '2018-05-04 02:58:09', NULL, '1'),
(51, 6, 50, 9, 2, 'GRA-O-CMX-051', 80, 2, '1', '2018-05-04 02:58:09', NULL, '1'),
(52, 6, 51, 9, 5, 'GRA-O-CMX-052', 80, 2, '1', '2018-05-04 02:58:27', NULL, '1'),
(53, 6, 52, 9, 2, 'GRA-O-CMX-053', 160, 4, '1', '2018-05-04 02:58:55', NULL, '1'),
(54, 6, 53, 9, 3, 'GRA-O-CMX-054', 160, 4, '1', '2018-05-04 02:58:55', NULL, '1'),
(55, 27, 1, 1, 1, 'GRA-O-ECO-001', 160, 4, '1', '2018-05-04 02:58:56', NULL, '1'),
(56, 27, 3, 1, 1, 'GRA-O-ECO-002', 160, 4, '1', '2018-05-04 02:59:20', NULL, '1'),
(57, 27, 6, 1, 5, 'GRA-O-ECO-003', 160, 4, '1', '2018-05-04 03:00:10', NULL, '1'),
(58, 27, 5, 1, 1, 'GRA-O-ECO-004', 160, 4, '1', '2018-05-04 03:00:49', NULL, '1'),
(59, 27, 54, 1, 1, 'GRA-O-ECO-005', 80, 2, '1', '2018-05-04 03:01:49', NULL, '1'),
(60, 27, 55, 1, 3, 'GRA-O-ECO-006', 80, 2, '1', '2018-05-04 03:03:04', NULL, '1'),
(61, 27, 7, 2, 1, 'GRA-O-ECO-007', 160, 4, '1', '2018-05-04 03:05:50', NULL, '1'),
(62, 27, 56, 2, 1, 'GRA-O-ECO-008', 160, 4, '1', '2018-05-04 03:05:51', NULL, '1'),
(63, 27, 57, 2, 1, 'GRA-O-ECO-009', 160, 4, '1', '2018-05-04 03:05:51', NULL, '1'),
(64, 27, 4, 2, 1, 'GRA-O-ECO-010', 80, 2, '1', '2018-05-04 03:05:51', NULL, '1'),
(65, 27, 17, 2, 1, 'GRA-O-ECO-011', 80, 2, '1', '2018-05-04 03:05:51', NULL, '1'),
(66, 27, 10, 2, 1, 'GRA-O-ECO-012', 160, 4, '1', '2018-05-04 03:06:21', NULL, '1'),
(67, 27, 12, 3, 3, 'GRA-O-ECO-013', 160, 4, '1', '2018-05-04 03:06:21', NULL, '1'),
(68, 27, 8, 3, 1, 'GRA-O-ECO-014', 160, 4, '1', '2018-05-04 03:06:21', NULL, '1'),
(69, 27, 58, 3, 1, 'GRA-O-ECO-015', 160, 4, '1', '2018-05-04 03:06:21', NULL, '1'),
(70, 27, 11, 3, 1, 'GRA-O-ECO-016', 160, 4, '1', '2018-05-04 03:06:21', NULL, '1'),
(71, 27, 16, 3, 2, 'GRA-O-ECO-017', 160, 4, '1', '2018-05-04 03:06:21', NULL, '1'),
(72, 27, 18, 4, 3, 'GRA-O-ECO-018', 160, 4, '1', '2018-05-04 03:06:21', NULL, '1'),
(73, 27, 13, 4, 1, 'GRA-O-ECO-019', 80, 2, '1', '2018-05-04 03:06:21', NULL, '1'),
(74, 27, 59, 4, 2, 'GRA-O-ECO-020', 160, 4, '1', '2018-05-04 03:06:26', NULL, '1'),
(75, 27, 60, 4, 2, 'GRA-O-ECO-021', 80, 2, '1', '2018-05-04 03:06:26', NULL, '1'),
(76, 27, 32, 4, 4, 'GRA-O-ECO-022', 80, 2, '1', '2018-05-04 03:06:26', NULL, '1'),
(77, 27, 61, 4, 2, 'GRA-O-ECO-023', 160, 4, '1', '2018-05-04 03:06:26', NULL, '1'),
(78, 27, 23, 4, 2, 'GRA-O-ECO-024', 80, 2, '1', '2018-05-04 03:06:29', NULL, '1'),
(79, 27, 62, 5, 2, 'GRA-O-ECO-025', 160, 4, '1', '2018-05-04 03:06:29', NULL, '1'),
(80, 27, 63, 5, 2, 'GRA-O-ECO-026', 160, 4, '1', '2018-05-04 03:06:30', NULL, '1'),
(81, 27, 19, 5, 2, 'GRA-O-ECO-027', 160, 4, '1', '2018-05-04 03:06:30', NULL, '1'),
(82, 27, 27, 5, 2, 'GRA-O-ECO-028', 160, 4, '1', '2018-05-04 03:06:35', NULL, '1'),
(83, 27, 64, 5, 3, 'GRA-O-ECO-029', 160, 4, '1', '2018-05-04 03:07:16', NULL, '1'),
(84, 27, 65, 6, 2, 'GRA-O-ECO-030', 160, 4, '1', '2018-05-04 03:07:21', NULL, '1'),
(85, 27, 66, 6, 2, 'GRA-O-ECO-031', 160, 4, '1', '2018-05-04 03:07:21', NULL, '1'),
(86, 27, 67, 6, 2, 'GRA-O-ECO-032', 160, 4, '1', '2018-05-04 03:07:21', NULL, '1'),
(87, 27, 31, 6, 2, 'GRA-O-ECO-033', 80, 2, '1', '2018-05-04 03:07:21', NULL, '1'),
(88, 27, 68, 6, 2, 'GRA-O-ECO-034', 160, 4, '1', '2018-05-04 03:07:40', NULL, '1'),
(89, 27, 38, 6, 4, 'GRA-O-ECO-035', 80, 2, '1', '2018-05-04 03:07:40', NULL, '1'),
(90, 27, 69, 7, 2, 'GRA-O-ECO-036', 160, 4, '1', '2018-05-04 03:10:14', NULL, '1'),
(91, 27, 70, 7, 2, 'GRA-O-ECO-037', 80, 2, '1', '2018-05-04 03:10:51', NULL, '1'),
(92, 27, 71, 7, 2, 'GRA-O-ECO-038', 80, 2, '1', '2018-05-04 03:10:51', NULL, '1'),
(93, 27, 72, 7, 2, 'GRA-O-ECO-039', 160, 4, '1', '2018-05-04 03:11:06', NULL, '1'),
(94, 27, 73, 7, 2, 'GRA-O-ECO-040', 160, 4, '1', '2018-05-04 03:11:17', NULL, '1'),
(95, 27, 29, 7, 2, 'GRA-O-ECO-041', 160, 4, '1', '2018-05-04 03:16:28', NULL, '1'),
(96, 27, 74, 8, 2, 'GRA-O-ECO-042', 80, 2, '1', '2018-05-04 03:16:28', NULL, '1'),
(97, 27, 75, 8, 4, 'GRA-O-ECO-043', 80, 2, '1', '2018-05-04 03:16:28', NULL, '1'),
(98, 27, 76, 8, 2, 'GRA-O-ECO-044', 160, 4, '1', '2018-05-04 03:16:28', NULL, '1'),
(99, 27, 37, 8, 2, 'GRA-O-ECO-045', 80, 2, '1', '2018-05-04 03:16:28', NULL, '1'),
(100, 27, 45, 8, 3, 'GRA-O-ECO-046', 80, 2, '1', '2018-05-04 03:16:28', NULL, '1'),
(101, 27, 46, 8, 3, 'GRA-O-ECO-047', 160, 4, '1', '2018-05-04 03:16:29', NULL, '1'),
(102, 27, 47, 8, 2, 'GRA-O-ECO-048', 160, 4, '1', '2018-05-04 03:18:54', NULL, '1'),
(103, 27, 77, 9, 2, 'GRA-O-ECO-049', 160, 4, '1', '2018-05-04 03:18:55', NULL, '1'),
(104, 27, 50, 9, 2, 'GRA-O-ECO-050', 160, 4, '1', '2018-05-04 03:18:55', NULL, '1'),
(105, 27, 28, 9, 2, 'GRA-O-ECO-051', 160, 4, '1', '2018-05-04 03:18:55', NULL, '1'),
(106, 27, 78, 9, 2, 'GRA-O-ECO-052', 80, 2, '1', '2018-05-04 03:19:19', NULL, '1'),
(107, 27, 79, 9, 5, 'GRA-O-ECO-053', 80, 2, '1', '2018-05-04 03:19:19', NULL, '1'),
(108, 27, 53, 9, 3, 'GRA-O-ECO-054', 160, 4, '1', '2018-05-04 03:19:24', NULL, '1'),
(109, 28, 6, 1, 5, 'GRA-O-FIN-001', 160, 4, '1', '2018-05-04 03:19:24', NULL, '1'),
(110, 28, 1, 1, 1, 'GRA-O-FIN-002', 160, 4, '1', '2018-05-04 03:24:03', NULL, '1'),
(111, 28, 3, 1, 1, 'GRA-O-FIN-003', 160, 4, '1', '2018-05-04 03:24:54', NULL, '1'),
(112, 28, 4, 1, 1, 'GRA-O-FIN-004', 80, 2, '1', '2018-05-04 03:25:03', NULL, '1'),
(113, 28, 17, 1, 1, 'GRA-O-FIN-005', 80, 2, '1', '2018-05-04 03:26:29', NULL, '1'),
(114, 28, 80, 1, 1, 'GRA-O-FIN-006', 80, 2, '1', '2018-05-04 03:27:44', NULL, '1'),
(115, 28, 81, 1, 3, 'GRA-O-FIN-007', 80, 2, '1', '2018-05-04 03:35:00', NULL, '1'),
(116, 28, 7, 2, 1, 'GRA-O-FIN-008', 160, 4, '1', '2018-05-04 03:35:19', NULL, '1'),
(117, 28, 56, 2, 1, 'GRA-O-FIN-009', 160, 4, '1', '2018-05-04 03:35:19', NULL, '1'),
(118, 28, 9, 2, 1, 'GRA-O-FIN-010', 160, 4, '1', '2018-05-04 03:44:05', NULL, '1'),
(119, 28, 5, 2, 1, 'GRA-O-FIN-011', 160, 4, '1', '2018-05-04 03:44:06', NULL, '1'),
(120, 28, 10, 2, 1, 'GRA-O-FIN-012', 160, 4, '1', '2018-05-04 03:44:12', NULL, '1'),
(121, 28, 12, 3, 3, 'GRA-O-FIN-013', 160, 4, '1', '2018-05-04 03:44:12', NULL, '1'),
(122, 28, 82, 3, 1, 'GRA-O-FIN-014', 160, 4, '1', '2018-05-04 03:44:12', NULL, '1'),
(123, 28, 14, 3, 1, 'GRA-O-FIN-015', 160, 4, '1', '2018-05-04 03:44:18', NULL, '1'),
(124, 28, 11, 3, 1, 'GRA-O-FIN-016', 160, 4, '1', '2018-05-04 03:44:18', NULL, '1'),
(125, 28, 16, 3, 2, 'GRA-O-FIN-017', 160, 4, '1', '2018-05-04 03:44:19', NULL, '1'),
(126, 28, 18, 4, 3, 'GRA-O-FIN-018', 160, 4, '1', '2018-05-04 03:44:19', NULL, '1'),
(127, 28, 66, 4, 2, 'GRA-O-FIN-019', 160, 4, '1', '2018-05-04 03:44:19', NULL, '1'),
(128, 28, 13, 4, 2, 'GRA-O-FIN-020', 80, 2, '1', '2018-05-04 03:44:19', NULL, '1'),
(129, 28, 83, 4, 2, 'GRA-O-FIN-021', 80, 2, '1', '2018-05-04 03:45:05', NULL, '1'),
(130, 28, 32, 4, 4, 'GRA-O-FIN-022', 80, 2, '1', '2018-05-04 03:45:05', NULL, '1'),
(131, 28, 61, 4, 2, 'GRA-O-FIN-023', 160, 4, '1', '2018-05-04 03:45:05', NULL, '1'),
(132, 28, 23, 4, 2, 'GRA-O-FIN-024', 80, 2, '1', '2018-05-04 03:45:05', NULL, '1'),
(133, 28, 84, 5, 2, 'GRA-O-FIN-025', 80, 2, '1', '2018-05-04 03:46:07', NULL, '1'),
(134, 28, 85, 5, 2, 'GRA-O-FIN-026', 160, 4, '1', '2018-05-04 03:46:07', NULL, '1'),
(135, 28, 19, 5, 2, 'GRA-O-FIN-027', 160, 4, '1', '2018-05-04 03:46:07', NULL, '1'),
(136, 28, 86, 5, 1, 'GRA-O-FIN-028', 80, 2, '1', '2018-05-04 03:46:07', NULL, '1'),
(137, 28, 27, 5, 2, 'GRA-O-FIN-029', 160, 4, '1', '2018-05-04 03:46:07', NULL, '1'),
(138, 28, 29, 5, 2, 'GRA-O-FIN-030', 160, 4, '1', '2018-05-04 03:46:07', NULL, '1'),
(139, 28, 24, 6, 2, 'GRA-O-FIN-031', 160, 4, '1', '2018-05-04 03:46:07', NULL, '1'),
(140, 28, 87, 6, 2, 'GRA-O-FIN-032', 160, 4, '1', '2018-05-04 03:46:07', NULL, '1'),
(141, 28, 31, 6, 2, 'GRA-O-FIN-033', 160, 4, '1', '2018-05-04 03:46:07', NULL, '1'),
(142, 28, 88, 6, 2, 'GRA-O-FIN-034', 80, 2, '1', '2018-05-04 03:49:00', NULL, '1'),
(143, 28, 38, 6, 4, 'GRA-O-FIN-035', 80, 2, '1', '2018-05-04 03:49:00', NULL, '1'),
(144, 28, 89, 6, 2, 'GRA-O-FIN-036', 160, 4, '1', '2018-05-04 03:49:16', NULL, '1'),
(145, 28, 69, 7, 2, 'GRA-O-FIN-037', 160, 4, '1', '2018-05-04 03:49:16', NULL, '1'),
(146, 28, 90, 7, 2, 'GRA-O-FIN-038', 80, 2, '1', '2018-05-04 03:49:16', NULL, '1'),
(147, 28, 91, 7, 2, 'GRA-O-FIN-039', 80, 2, '1', '2018-05-04 03:49:16', NULL, '1'),
(148, 28, 41, 7, 2, 'GRA-O-FIN-040', 160, 4, '1', '2018-05-04 03:49:16', NULL, '1'),
(149, 28, 92, 7, 2, 'GRA-O-FIN-041', 160, 4, '1', '2018-05-04 03:49:19', NULL, '1'),
(150, 28, 93, 7, 2, 'GRA-O-FIN-042', 160, 4, '1', '2018-05-04 03:49:36', NULL, '1'),
(151, 28, 94, 8, 2, 'GRA-O-FIN-043', 160, 4, '1', '2018-05-04 03:49:36', NULL, '1'),
(152, 28, 95, 8, 4, 'GRA-O-FIN-044', 80, 2, '1', '2018-05-04 03:49:37', NULL, '1'),
(153, 28, 37, 8, 2, 'GRA-O-FIN-045', 160, 4, '1', '2018-05-04 03:50:18', NULL, '1'),
(154, 28, 45, 8, 3, 'GRA-O-FIN-046', 80, 2, '1', '2018-05-04 03:50:30', NULL, '1'),
(155, 28, 46, 8, 3, 'GRA-O-FIN-047', 160, 4, '1', '2018-05-04 03:50:46', NULL, '1'),
(156, 28, 64, 8, 3, 'GRA-O-FIN-048', 160, 4, '1', '2018-05-04 03:50:46', NULL, '1'),
(157, 28, 28, 9, 2, 'GRA-O-FIN-049', 160, 4, '1', '2018-05-04 03:51:08', NULL, '1'),
(158, 28, 96, 9, 2, 'GRA-O-FIN-050', 80, 2, '1', '2018-05-04 03:51:08', NULL, '1'),
(159, 28, 97, 9, 2, 'GRA-O-FIN-051', 160, 4, '1', '2018-05-04 03:51:26', NULL, '1'),
(160, 28, 98, 9, 5, 'GRA-O-FIN-052', 80, 2, '1', '2018-05-04 03:51:26', NULL, '1'),
(161, 28, 99, 9, 2, 'GRA-O-FIN-053', 160, 4, '1', '2018-05-04 03:51:55', NULL, '1'),
(162, 28, 53, 9, 3, 'GRA-O-FIN-054', 160, 4, '1', '2018-05-04 03:51:55', NULL, '1'),
(163, 29, 6, 1, 5, 'GRA-O-MKT-001', 160, 4, '1', '2018-05-04 03:51:55', NULL, '1'),
(164, 29, 1, 1, 1, 'GRA-O-MKT-002', 160, 4, '1', '2018-05-04 03:52:58', NULL, '1'),
(165, 29, 3, 1, 1, 'GRA-O-MKT-003', 160, 4, '1', '2018-05-04 03:53:35', NULL, '1'),
(166, 29, 4, 1, 1, 'GRA-O-MKT-004', 80, 2, '1', '2018-05-04 03:54:40', NULL, '1'),
(167, 29, 17, 1, 2, 'GRA-O-MKT-005', 80, 2, '1', '2018-05-04 03:56:37', NULL, '1'),
(168, 29, 80, 1, 5, 'GRA-O-MKT-006', 80, 2, '1', '2018-05-04 03:56:49', NULL, '1'),
(169, 29, 100, 1, 3, 'GRA-O-MKT-007', 80, 2, '1', '2018-05-04 03:57:56', NULL, '1'),
(170, 29, 5, 2, 1, 'GRA-O-MKT-008', 160, 4, '1', '2018-05-04 03:58:16', NULL, '1'),
(171, 29, 7, 2, 1, 'GRA-O-MKT-009', 160, 4, '1', '2018-05-04 03:58:33', NULL, '1'),
(172, 29, 9, 2, 1, 'GRA-O-MKT-010', 160, 4, '1', '2018-05-04 03:58:33', NULL, '1'),
(173, 29, 11, 2, 1, 'GRA-O-MKT-011', 160, 4, '1', '2018-05-04 03:58:33', NULL, '1'),
(174, 29, 10, 2, 1, 'GRA-O-MKT-012', 160, 4, '1', '2018-05-04 04:00:50', NULL, '1'),
(175, 29, 101, 3, 3, 'GRA-O-MKT-013', 160, 4, '1', '2018-05-04 04:01:03', NULL, '1'),
(176, 29, 8, 3, 1, 'GRA-O-MKT-014', 160, 4, '1', '2018-05-04 04:01:03', NULL, '1'),
(177, 29, 14, 3, 1, 'GRA-O-MKT-015', 160, 4, '1', '2018-05-04 04:01:03', NULL, '1'),
(178, 29, 102, 3, 2, 'GRA-O-MKT-016', 80, 2, '1', '2018-05-04 04:01:03', NULL, '1'),
(179, 29, 19, 3, 1, 'GRA-O-MKT-017', 80, 2, '1', '2018-05-04 04:01:03', NULL, '1'),
(180, 29, 16, 3, 1, 'GRA-O-MKT-018', 160, 4, '1', '2018-05-04 04:01:03', NULL, '1'),
(181, 29, 103, 4, 3, 'GRA-O-MKT-019', 160, 4, '1', '2018-05-04 04:01:03', NULL, '1'),
(182, 29, 32, 4, 4, 'GRA-O-MKT-020', 160, 4, '1', '2018-05-04 04:01:03', NULL, '1'),
(183, 29, 13, 4, 1, 'GRA-O-MKT-021', 80, 2, '1', '2018-05-04 04:01:03', NULL, '1'),
(184, 29, 104, 4, 2, 'GRA-O-MKT-022', 160, 4, '1', '2018-05-04 04:01:04', NULL, '1'),
(185, 29, 61, 4, 1, 'GRA-O-MKT-023', 160, 4, '1', '2018-05-04 04:01:04', NULL, '1'),
(186, 29, 23, 4, 2, 'GRA-O-MKT-024', 80, 2, '1', '2018-05-04 04:01:04', NULL, '1'),
(187, 29, 24, 5, 2, 'GRA-O-MKT-025', 160, 4, '1', '2018-05-04 04:01:04', NULL, '1'),
(188, 29, 105, 5, 2, 'GRA-O-MKT-026', 160, 4, '1', '2018-05-04 04:01:04', NULL, '1'),
(189, 29, 106, 5, 2, 'GRA-O-MKT-027', 160, 4, '1', '2018-05-04 04:01:04', NULL, '1'),
(190, 29, 43, 5, 2, 'GRA-O-MKT-028', 80, 2, '1', '2018-05-04 04:01:04', NULL, '1'),
(191, 29, 27, 5, 1, 'GRA-O-MKT-029', 160, 4, '1', '2018-05-04 04:01:04', NULL, '1'),
(192, 29, 41, 5, 1, 'GRA-O-MKT-030', 80, 2, '1', '2018-05-04 04:01:04', NULL, '1'),
(193, 29, 107, 6, 4, 'GRA-O-MKT-031', 80, 2, '1', '2018-05-04 04:01:05', NULL, '1'),
(194, 29, 108, 6, 2, 'GRA-O-MKT-032', 160, 4, '1', '2018-05-04 04:01:05', NULL, '1'),
(195, 29, 109, 6, 2, 'GRA-O-MKT-033', 160, 4, '1', '2018-05-04 04:01:05', NULL, '1'),
(196, 29, 110, 6, 2, 'GRA-O-MKT-034', 160, 4, '1', '2018-05-04 04:01:05', NULL, '1'),
(197, 29, 111, 6, 2, 'GRA-O-MKT-035', 160, 4, '1', '2018-05-04 04:01:05', NULL, '1'),
(198, 29, 38, 6, 4, 'GRA-O-MKT-036', 80, 2, '1', '2018-05-04 04:01:05', NULL, '1'),
(199, 29, 112, 7, 2, 'GRA-O-MKT-037', 160, 4, '1', '2018-05-04 04:01:05', NULL, '1'),
(200, 29, 113, 7, 2, 'GRA-O-MKT-038', 160, 4, '1', '2018-05-04 04:01:05', NULL, '1'),
(201, 29, 114, 7, 2, 'GRA-O-MKT-039', 80, 2, '1', '2018-05-04 04:01:05', NULL, '1'),
(202, 29, 115, 7, 2, 'GRA-O-MKT-040', 80, 2, '1', '2018-05-04 04:01:06', NULL, '1'),
(203, 29, 64, 7, 3, 'GRA-O-MKT-041', 160, 4, '1', '2018-05-04 04:01:06', NULL, '1'),
(204, 29, 116, 7, 2, 'GRA-O-MKT-042', 160, 4, '1', '2018-05-04 04:01:06', NULL, '1'),
(205, 29, 117, 8, 2, 'GRA-O-MKT-043', 80, 2, '1', '2018-05-04 04:01:06', NULL, '1'),
(206, 29, 45, 8, 3, 'GRA-O-MKT-044', 80, 2, '1', '2018-05-04 04:01:06', NULL, '1'),
(207, 29, 37, 8, 2, 'GRA-O-MKT-045', 160, 4, '1', '2018-05-04 04:01:06', NULL, '1'),
(208, 29, 118, 8, 2, 'GRA-O-MKT-046', 160, 4, '1', '2018-05-04 04:01:06', NULL, '1'),
(209, 29, 46, 8, 3, 'GRA-O-MKT-047', 160, 4, '1', '2018-05-04 04:01:06', NULL, '1'),
(210, 29, 93, 8, 2, 'GRA-O-MKT-048', 160, 4, '1', '2018-05-04 04:01:06', NULL, '1'),
(211, 29, 119, 9, 2, 'GRA-O-MKT-049', 160, 4, '1', '2018-05-04 04:01:06', NULL, '1'),
(212, 29, 120, 9, 2, 'GRA-O-MKT-050', 80, 2, '1', '2018-05-04 04:01:06', NULL, '1'),
(213, 29, 52, 9, 2, 'GRA-O-MKT-051', 160, 4, '1', '2018-05-04 04:01:06', NULL, '1'),
(214, 29, 121, 9, 1, 'GRA-O-MKT-052', 80, 2, '1', '2018-05-04 04:01:07', NULL, '1'),
(215, 29, 122, 9, 4, 'GRA-O-MKT-053', 160, 4, '1', '2018-05-04 04:01:07', NULL, '1'),
(216, 29, 53, 9, 3, 'GRA-O-MKT-054', 160, 4, '1', '2018-05-04 04:04:54', NULL, '1'),
(217, 2, 1, 1, 1, 'GRA-O-TUR-001', 160, 4, '1', '2018-05-04 04:04:55', NULL, '1'),
(218, 2, 6, 1, 5, 'GRA-O-TUR-002', 160, 4, '1', '2018-05-04 04:05:18', NULL, '1'),
(219, 2, 3, 1, 1, 'GRA-O-TUR-003', 160, 4, '1', '2018-05-04 04:06:34', NULL, '1'),
(220, 2, 123, 1, 3, 'GRA-O-TUR-004', 160, 4, '1', '2018-05-04 04:06:55', NULL, '1'),
(221, 2, 17, 1, 5, 'GRA-O-TUR-005', 80, 2, '1', '2018-05-04 04:07:38', NULL, '1'),
(222, 2, 124, 1, 5, 'GRA-O-TUR-006', 80, 2, '1', '2018-05-04 04:09:04', NULL, '1'),
(223, 2, 101, 2, 3, 'GRA-O-TUR-007', 160, 4, '1', '2018-05-04 04:09:32', NULL, '1'),
(224, 2, 125, 2, 1, 'GRA-O-TUR-008', 160, 4, '1', '2018-05-04 04:10:02', NULL, '1'),
(225, 2, 126, 2, 1, 'GRA-O-TUR-009', 80, 2, '1', '2018-05-04 04:10:14', NULL, '1'),
(226, 2, 127, 2, 1, 'GRA-O-TUR-010', 80, 2, '1', '2018-05-04 04:10:14', NULL, '1'),
(227, 2, 10, 2, 1, 'GRA-O-TUR-011', 160, 4, '1', '2018-05-04 04:10:23', NULL, '1'),
(228, 2, 5, 2, 1, 'GRA-O-TUR-012', 160, 4, '1', '2018-05-04 04:10:47', NULL, '1'),
(229, 2, 18, 3, 3, 'GRA-O-TUR-013', 160, 4, '1', '2018-05-04 04:10:55', NULL, '1'),
(230, 2, 128, 3, 1, 'GRA-O-TUR-014', 160, 4, '1', '2018-05-04 04:10:55', NULL, '1'),
(231, 2, 9, 3, 1, 'GRA-O-TUR-015', 160, 4, '1', '2018-05-04 04:10:55', NULL, '1'),
(232, 2, 129, 3, 1, 'GRA-O-TUR-016', 80, 2, '1', '2018-05-04 04:10:55', NULL, '1'),
(233, 2, 16, 3, 2, 'GRA-O-TUR-017', 160, 4, '1', '2018-05-04 04:11:23', NULL, '1'),
(234, 2, 130, 3, 2, 'GRA-O-TUR-018', 80, 2, '1', '2018-05-04 04:11:23', NULL, '1'),
(235, 2, 11, 4, 2, 'GRA-O-TUR-019', 160, 4, '1', '2018-05-04 04:11:38', NULL, '1'),
(236, 2, 131, 4, 4, 'GRA-O-TUR-020', 80, 2, '1', '2018-05-04 04:11:57', NULL, '1'),
(237, 2, 14, 4, 1, 'GRA-O-TUR-021', 160, 4, '1', '2018-05-04 04:11:57', NULL, '1'),
(238, 2, 132, 4, 2, 'GRA-O-TUR-022', 80, 2, '1', '2018-05-04 04:11:57', NULL, '1'),
(239, 2, 61, 4, 2, 'GRA-O-TUR-023', 160, 4, '1', '2018-05-04 04:11:57', NULL, '1'),
(240, 2, 35, 4, 3, 'GRA-O-TUR-024', 160, 4, '1', '2018-05-04 04:11:57', NULL, '1'),
(241, 2, 133, 5, 2, 'GRA-O-TUR-025', 160, 4, '1', '2018-05-04 04:12:46', NULL, '1'),
(242, 2, 134, 5, 2, 'GRA-O-TUR-026', 160, 4, '1', '2018-05-04 04:12:56', NULL, '1'),
(243, 2, 69, 5, 2, 'GRA-O-TUR-027', 160, 4, '1', '2018-05-04 04:12:56', NULL, '1'),
(244, 2, 135, 5, 2, 'GRA-O-TUR-028', 80, 2, '1', '2018-05-04 04:13:07', NULL, '1'),
(245, 2, 136, 5, 2, 'GRA-O-TUR-029', 80, 2, '1', '2018-05-04 04:13:07', NULL, '1'),
(246, 2, 27, 5, 2, 'GRA-O-TUR-030', 80, 2, '1', '2018-05-04 04:13:22', NULL, '1'),
(247, 2, 137, 5, 4, 'GRA-O-TUR-031', 80, 2, '1', '2018-05-04 04:13:22', NULL, '1'),
(248, 2, 31, 6, 2, 'GRA-O-TUR-032', 80, 2, '1', '2018-05-04 04:13:22', NULL, '1'),
(249, 2, 138, 6, 2, 'GRA-O-TUR-033', 160, 4, '1', '2018-05-04 04:13:51', NULL, '1'),
(250, 2, 139, 6, 2, 'GRA-O-TUR-034', 160, 4, '1', '2018-05-04 04:13:52', NULL, '1'),
(251, 2, 32, 6, 4, 'GRA-O-TUR-035', 80, 2, '1', '2018-05-04 04:13:52', NULL, '1'),
(252, 2, 140, 6, 2, 'GRA-O-TUR-036', 160, 4, '1', '2018-05-04 04:13:52', NULL, '1'),
(253, 2, 29, 6, 2, 'GRA-O-TUR-037', 160, 4, '1', '2018-05-04 04:14:07', NULL, '1'),
(254, 2, 141, 7, 2, 'GRA-O-TUR-038', 160, 4, '1', '2018-05-04 04:14:08', NULL, '1'),
(255, 2, 142, 7, 2, 'GRA-O-TUR-039', 160, 4, '1', '2018-05-04 04:14:08', NULL, '1'),
(256, 2, 143, 7, 2, 'GRA-O-TUR-040', 80, 2, '1', '2018-05-04 04:14:08', NULL, '1'),
(257, 2, 144, 7, 2, 'GRA-O-TUR-041', 80, 2, '1', '2018-05-04 04:14:08', NULL, '1'),
(258, 2, 41, 7, 2, 'GRA-O-TUR-042', 160, 4, '1', '2018-05-04 04:14:08', NULL, '1'),
(259, 2, 145, 7, 2, 'GRA-O-TUR-043', 160, 4, '1', '2018-05-04 04:14:08', NULL, '1'),
(260, 2, 146, 8, 2, 'GRA-O-TUR-044', 160, 4, '1', '2018-05-04 04:14:08', NULL, '1'),
(261, 2, 42, 8, 4, 'GRA-O-TUR-045', 160, 4, '1', '2018-05-04 04:14:08', NULL, '1'),
(262, 2, 98, 8, 2, 'GRA-O-TUR-046', 80, 2, '1', '2018-05-04 04:14:24', NULL, '1'),
(263, 2, 45, 8, 3, 'GRA-O-TUR-047', 80, 2, '1', '2018-05-04 04:15:03', NULL, '1'),
(264, 2, 46, 8, 3, 'GRA-O-TUR-048', 160, 4, '1', '2018-05-04 04:15:58', NULL, '1'),
(265, 2, 47, 8, 2, 'GRA-O-TUR-049', 160, 4, '1', '2018-05-04 04:16:09', NULL, '1'),
(266, 2, 147, 9, 2, 'GRA-O-TUR-050', 160, 4, '1', '2018-05-04 04:16:09', NULL, '1'),
(267, 2, 148, 9, 5, 'GRA-O-TUR-051', 80, 2, '1', '2018-05-04 04:16:10', NULL, '1'),
(268, 2, 149, 9, 2, 'GRA-O-TUR-052', 160, 4, '1', '2018-05-04 04:16:10', NULL, '1'),
(269, 2, 150, 9, 2, 'GRA-O-TUR-053', 160, 4, '1', '2018-05-04 04:16:10', NULL, '1'),
(270, 2, 53, 9, 3, 'GRA-O-TUR-054', 240, 6, '1', '2018-05-04 04:16:10', NULL, '1'),
(271, 5, 6, 1, 5, 'GRA-O-ADM-001', 160, 4, '1', '2018-05-04 04:16:10', NULL, '1'),
(272, 5, 1, 1, 1, 'GRA-O-ADM-002', 160, 4, '1', '2018-05-04 04:19:28', NULL, '1'),
(273, 5, 3, 1, 1, 'GRA-O-ADM-003', 160, 4, '1', '2018-05-04 04:21:08', NULL, '1'),
(274, 5, 4, 1, 1, 'GRA-O-ADM-004', 80, 2, '1', '2018-05-04 04:24:22', NULL, '1'),
(275, 5, 17, 1, 1, 'GRA-O-ADM-005', 80, 2, '1', '2018-05-04 04:24:38', NULL, '1'),
(276, 5, 54, 1, 1, 'GRA-O-ADM-006', 80, 2, '1', '2018-05-04 04:25:04', NULL, '1'),
(277, 5, 100, 1, 3, 'GRA-O-ADM-007', 80, 2, '1', '2018-05-04 04:27:05', NULL, '1'),
(278, 5, 7, 2, 1, 'GRA-O-ADM-008', 160, 4, '1', '2018-05-04 04:27:34', NULL, '1'),
(279, 5, 56, 2, 1, 'GRA-O-ADM-009', 160, 4, '1', '2018-05-04 04:27:34', NULL, '1'),
(280, 5, 9, 2, 1, 'GRA-O-ADM-010', 160, 4, '1', '2018-05-04 04:29:41', NULL, '1'),
(281, 5, 151, 2, 1, 'GRA-O-ADM-011', 160, 4, '1', '2018-05-04 04:30:41', NULL, '1'),
(282, 5, 10, 2, 1, 'GRA-O-ADM-012', 160, 4, '1', '2018-05-04 04:30:51', NULL, '1'),
(283, 5, 12, 3, 3, 'GRA-O-ADM-013', 160, 4, '1', '2018-05-04 04:30:52', NULL, '1'),
(284, 5, 82, 3, 1, 'GRA-O-ADM-014', 160, 4, '1', '2018-05-04 04:30:52', NULL, '1'),
(285, 5, 14, 3, 1, 'GRA-O-ADM-015', 160, 4, '1', '2018-05-04 04:31:32', NULL, '1'),
(286, 5, 11, 3, 1, 'GRA-O-ADM-016', 160, 4, '1', '2018-05-04 04:31:32', NULL, '1'),
(287, 5, 16, 3, 2, 'GRA-O-ADM-017', 160, 4, '1', '2018-05-04 04:31:32', NULL, '1'),
(288, 5, 103, 4, 3, 'GRA-O-ADM-018', 160, 4, '1', '2018-05-04 04:31:32', NULL, '1'),
(289, 5, 152, 4, 2, 'GRA-O-ADM-019', 80, 2, '1', '2018-05-04 04:31:32', NULL, '1'),
(290, 5, 13, 4, 2, 'GRA-O-ADM-020', 160, 4, '1', '2018-05-04 04:31:32', NULL, '1'),
(291, 5, 60, 4, 1, 'GRA-O-ADM-021', 80, 2, '1', '2018-05-04 04:31:51', NULL, '1'),
(292, 5, 32, 4, 4, 'GRA-O-ADM-022', 80, 2, '1', '2018-05-04 04:31:51', NULL, '1'),
(293, 5, 61, 4, 2, 'GRA-O-ADM-023', 160, 4, '1', '2018-05-04 04:31:51', NULL, '1'),
(294, 5, 23, 4, 2, 'GRA-O-ADM-024', 80, 2, '1', '2018-05-04 04:31:51', NULL, '1'),
(295, 5, 153, 5, 3, 'GRA-O-ADM-025', 160, 4, '1', '2018-05-04 04:32:04', NULL, '1'),
(296, 5, 19, 5, 2, 'GRA-O-ADM-026', 160, 4, '1', '2018-05-04 04:33:14', NULL, '1'),
(297, 5, 154, 5, 2, 'GRA-O-ADM-027', 160, 4, '1', '2018-05-04 04:33:28', NULL, '1'),
(298, 5, 27, 5, 2, 'GRA-O-ADM-028', 160, 4, '1', '2018-05-04 04:33:29', NULL, '1'),
(299, 5, 29, 5, 2, 'GRA-O-ADM-029', 160, 4, '1', '2018-05-04 04:33:29', NULL, '1'),
(300, 5, 24, 6, 3, 'GRA-O-ADM-030', 160, 4, '1', '2018-05-04 04:33:29', NULL, '1'),
(301, 5, 69, 6, 2, 'GRA-O-ADM-031', 160, 4, '1', '2018-05-04 04:33:29', NULL, '1'),
(302, 5, 31, 6, 2, 'GRA-O-ADM-032', 80, 2, '1', '2018-05-04 04:33:49', NULL, '1'),
(303, 5, 25, 6, 2, 'GRA-O-ADM-033', 80, 2, '1', '2018-05-04 04:34:46', NULL, '1'),
(304, 5, 43, 6, 2, 'GRA-O-ADM-034', 80, 2, '1', '2018-05-04 04:37:52', NULL, '1'),
(305, 5, 73, 6, 2, 'GRA-O-ADM-035', 160, 4, '1', '2018-05-04 04:38:11', NULL, '1'),
(306, 5, 38, 6, 4, 'GRA-O-ADM-036', 80, 2, '1', '2018-05-04 04:38:11', NULL, '1'),
(307, 5, 155, 7, 2, 'GRA-O-ADM-037', 160, 4, '1', '2018-05-04 04:40:05', NULL, '1'),
(308, 5, 156, 7, 2, 'GRA-O-ADM-038', 160, 4, '1', '2018-05-04 04:40:05', NULL, '1'),
(309, 5, 41, 7, 2, 'GRA-O-ADM-039', 160, 4, '1', '2018-05-04 04:40:24', NULL, '1'),
(310, 5, 50, 7, 2, 'GRA-O-ADM-040', 80, 2, '1', '2018-05-04 04:40:24', NULL, '1'),
(311, 5, 98, 7, 2, 'GRA-O-ADM-041', 80, 2, '1', '2018-05-04 04:40:24', NULL, '1'),
(312, 5, 47, 7, 2, 'GRA-O-ADM-042', 160, 4, '1', '2018-05-04 04:40:40', NULL, '1'),
(313, 5, 94, 8, 2, 'GRA-O-ADM-043', 80, 2, '1', '2018-05-04 04:40:40', NULL, '1'),
(314, 5, 157, 8, 2, 'GRA-O-ADM-044', 160, 4, '1', '2018-05-04 04:40:40', NULL, '1'),
(315, 5, 45, 8, 3, 'GRA-O-ADM-045', 80, 2, '1', '2018-05-04 04:41:01', NULL, '1'),
(316, 5, 46, 8, 3, 'GRA-O-ADM-046', 160, 4, '1', '2018-05-04 04:41:13', NULL, '1'),
(317, 5, 158, 8, 4, 'GRA-O-ADM-047', 160, 4, '1', '2018-05-04 04:41:43', NULL, '1'),
(318, 5, 64, 8, 3, 'GRA-O-ADM-048', 160, 4, '1', '2018-05-04 04:42:37', NULL, '1'),
(319, 5, 159, 9, 2, 'GRA-O-ADM-049', 160, 4, '1', '2018-05-04 04:43:29', NULL, '1'),
(320, 5, 52, 9, 2, 'GRA-O-ADM-050', 80, 2, '1', '2018-05-04 04:43:29', NULL, '1'),
(321, 5, 119, 9, 2, 'GRA-O-ADM-051', 160, 4, '1', '2018-05-04 04:43:30', NULL, '1'),
(322, 5, 84, 9, 2, 'GRA-O-ADM-052', 80, 2, '1', '2018-05-04 04:43:30', NULL, '1'),
(323, 5, 160, 9, 2, 'GRA-O-ADM-053', 160, 4, '1', '2018-05-04 04:43:30', NULL, '1'),
(324, 5, 53, 9, 3, 'GRA-O-ADM-054', 160, 4, '1', '2018-05-04 04:43:30', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `carrera_malla`
--

CREATE TABLE `carrera_malla` (
  `cmal_id` bigint(20) NOT NULL,
  `car_id` bigint(20) NOT NULL,
  `fac_id` bigint(20) NOT NULL,
  `tica_id` bigint(20) NOT NULL,
  `mod_id` bigint(20) NOT NULL,
  `car_codigo` varchar(100) NOT NULL,
  `cmal_nivel` varchar(100) DEFAULT NULL,
  `cmal_grado_academico` varchar(100) DEFAULT NULL,
  `cmal_unidad_seguimiento` varchar(100) DEFAULT NULL,
  `cmal_centro_apoyo` varchar(100) DEFAULT NULL,
  `cmal_perspectiva` varchar(100) DEFAULT NULL,
  `cmal_total_asignatura` int(11) DEFAULT NULL,
  `cmal_duracion_anio` int(11) DEFAULT NULL,
  `cmal_costo_anual` double DEFAULT NULL,
  `cmal_titulo_academico` varchar(150) DEFAULT NULL,
  `cmal_numero_colegiado` varchar(150) DEFAULT NULL,
  `cmal_numero_conesup` varchar(150) DEFAULT NULL,
  `cmal_valor_arancel` double DEFAULT NULL,
  `cmal_pra_preprofesion` varchar(150) DEFAULT NULL,
  `cmal_proyecto_titulacion` varchar(2) DEFAULT NULL,
  `cmal_estado_carrera` varchar(2) NOT NULL,
  `cmal_estado` varchar(1) NOT NULL,
  `cmal_fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cmal_fecha_aprobacion` timestamp NULL DEFAULT NULL,
  `cmal_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `cmal_estado_logico` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `carrera_malla`
--

INSERT INTO `carrera_malla` (`cmal_id`, `car_id`, `fac_id`, `tica_id`, `mod_id`, `car_codigo`, `cmal_nivel`, `cmal_grado_academico`, `cmal_unidad_seguimiento`, `cmal_centro_apoyo`, `cmal_perspectiva`, `cmal_total_asignatura`, `cmal_duracion_anio`, `cmal_costo_anual`, `cmal_titulo_academico`, `cmal_numero_colegiado`, `cmal_numero_conesup`, `cmal_valor_arancel`, `cmal_pra_preprofesion`, `cmal_proyecto_titulacion`, `cmal_estado_carrera`, `cmal_estado`, `cmal_fecha_creacion`, `cmal_fecha_aprobacion`, `cmal_fecha_modificacion`, `cmal_estado_logico`) VALUES
(1, 1, 1, 1, 1, 'GRA-O-CMX-001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', '1', '2018-05-09 03:17:02', NULL, NULL, '1'),
(2, 1, 2, 1, 1, 'GRA-O-CMX-001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', '1', '2018-05-09 03:19:32', NULL, NULL, '1'),
(3, 2, 1, 1, 1, 'GRA-O-ECO-001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', '1', '2018-05-09 03:32:02', NULL, NULL, '1'),
(4, 3, 1, 1, 1, 'GRA-O-FIN-001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', '1', '2018-05-09 03:34:46', NULL, NULL, '1'),
(5, 4, 1, 1, 1, 'GRA-O-MKT-001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', '1', '2018-05-09 03:37:35', NULL, NULL, '1'),
(6, 5, 1, 1, 1, 'GRA-O-TUR-001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', '1', '2018-05-09 03:39:29', NULL, NULL, '1'),
(7, 6, 1, 1, 1, 'GRA-O-ADM-001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', '1', '2018-05-09 03:44:56', NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `curso`
--

CREATE TABLE `curso` (
  `cur_id` bigint(20) NOT NULL,
  `pmin_id` bigint(20) NOT NULL,
  `cur_descripcion` varchar(500) NOT NULL,
  `cur_num_cupo` int(11) DEFAULT NULL,
  `cur_num_inscritos` int(11) DEFAULT NULL,
  `cur_usuario_ingreso` int(11) NOT NULL,
  `cur_usuario_modifica` int(11) DEFAULT NULL,
  `cur_estado` varchar(1) NOT NULL,
  `cur_fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cur_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `cur_estado_logico` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `curso`
--

INSERT INTO `curso` (`cur_id`, `pmin_id`, `cur_descripcion`, `cur_num_cupo`, `cur_num_inscritos`, `cur_usuario_ingreso`, `cur_usuario_modifica`, `cur_estado`, `cur_fecha_creacion`, `cur_fecha_modificacion`, `cur_estado_logico`) VALUES
(1, 1, '0001', 25, 8, 1, NULL, '1', '2018-01-23 04:59:53', NULL, '1'),
(2, 2, '0001', 25, 13, 1, NULL, '1', '2018-01-23 04:59:53', NULL, '1'),
(3, 3, '0001', 25, 5, 1, NULL, '1', '2018-01-23 04:59:53', NULL, '1'),
(4, 4, '001', 20, NULL, 124, NULL, '1', '2018-01-23 20:31:56', NULL, '1'),
(5, 5, '001', 20, NULL, 124, NULL, '1', '2018-01-31 02:53:42', NULL, '1'),
(6, 6, 'Exa0118', 5, NULL, 124, NULL, '1', '2018-02-27 02:53:05', NULL, '1'),
(7, 6, '001', 5, NULL, 124, NULL, '1', '2018-02-27 03:06:08', NULL, '1'),
(8, 7, '001', 10, NULL, 124, NULL, '1', '2018-02-28 19:02:46', NULL, '1'),
(9, 7, '002', 10, NULL, 124, NULL, '1', '2018-03-15 02:10:12', NULL, '1'),
(10, 8, '001', 10, NULL, 124, NULL, '1', '2018-04-07 03:36:25', NULL, '1'),
(11, 9, '001', 20, NULL, 124, NULL, '1', '2018-04-10 01:10:47', NULL, '1'),
(12, 10, '001', 50, NULL, 124, NULL, '1', '2018-05-10 21:35:56', NULL, '1'),
(13, 11, '001', 30, NULL, 124, NULL, '1', '2018-05-31 03:19:37', NULL, '1'),
(14, 12, '001', 40, NULL, 124, NULL, '1', '2018-06-27 22:00:02', NULL, '1'),
(15, 13, '001', 10, NULL, 124, NULL, '1', '2018-07-17 20:36:10', NULL, '1'),
(16, 14, '001', 30, NULL, 124, NULL, '1', '2018-07-30 21:12:54', NULL, '1'),
(17, 15, '001', 10, NULL, 124, NULL, '1', '2018-07-31 23:27:30', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `detalle_malla`
--

CREATE TABLE `detalle_malla` (
  `dmal_numero` bigint(20) NOT NULL,
  `cmal_id` bigint(20) NOT NULL,
  `casi_id` bigint(20) NOT NULL,
  `dmal_usuario_ingreso` int(11) NOT NULL,
  `dmal_usuario_modifica` int(11) DEFAULT NULL,
  `dmal_estado` varchar(1) NOT NULL,
  `dmal_fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dmal_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `dmal_estado_logico` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `detalle_malla`
--

INSERT INTO `detalle_malla` (`dmal_numero`, `cmal_id`, `casi_id`, `dmal_usuario_ingreso`, `dmal_usuario_modifica`, `dmal_estado`, `dmal_fecha_creacion`, `dmal_fecha_modificacion`, `dmal_estado_logico`) VALUES
(1, 2, 1, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(2, 2, 2, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(3, 2, 3, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(4, 2, 4, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(5, 2, 5, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(6, 2, 6, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(7, 2, 7, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(8, 2, 8, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(9, 2, 9, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(10, 2, 10, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(11, 2, 11, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(12, 2, 12, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(13, 2, 13, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(14, 2, 14, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(15, 2, 15, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(16, 2, 16, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(17, 2, 17, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(18, 2, 18, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(19, 2, 19, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(20, 2, 20, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(21, 2, 21, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(22, 2, 22, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(23, 2, 23, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(24, 2, 24, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(25, 2, 25, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(26, 2, 26, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(27, 2, 27, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(28, 2, 28, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(29, 2, 29, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(30, 2, 30, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(31, 2, 31, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(32, 2, 32, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(33, 2, 33, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(34, 2, 34, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(35, 2, 35, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(36, 2, 36, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(37, 2, 37, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(38, 2, 38, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(39, 2, 39, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(40, 2, 40, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(41, 2, 41, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(42, 2, 42, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(43, 2, 43, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(44, 2, 44, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(45, 2, 45, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(46, 2, 46, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(47, 2, 47, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(48, 2, 48, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(49, 2, 49, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(50, 2, 50, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(51, 2, 51, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(52, 2, 52, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(53, 2, 53, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(54, 2, 54, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(55, 2, 55, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(56, 1, 56, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(57, 1, 57, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(58, 1, 58, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(59, 1, 59, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1'),
(60, 1, 60, 1, NULL, '1', '2018-08-28 19:07:37', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `facultad`
--

CREATE TABLE `facultad` (
  `fac_id` bigint(20) NOT NULL,
  `nint_id` bigint(20) NOT NULL,
  `fac_nombre` varchar(500) NOT NULL,
  `fac_descripcion` varchar(500) NOT NULL,
  `fac_estado` varchar(1) NOT NULL,
  `fac_fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fac_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `fac_estado_logico` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `facultad`
--

INSERT INTO `facultad` (`fac_id`, `nint_id`, `fac_nombre`, `fac_descripcion`, `fac_estado`, `fac_fecha_creacion`, `fac_fecha_modificacion`, `fac_estado_logico`) VALUES
(1, 1, 'Estudios Online', 'Estudios Online', '1', '2018-08-28 19:07:35', NULL, '1'),
(2, 1, 'Estudios Presencial', 'Estudios Presencial', '1', '2018-08-28 19:07:35', NULL, '1'),
(3, 1, 'Estudios Semipresencial', 'Estudios Semipresencial', '1', '2018-08-28 19:07:35', NULL, '1'),
(4, 1, 'Estudios a Distancia', 'Estudios a Distancia', '1', '2018-08-28 19:07:35', NULL, '1'),
(5, 2, 'Estudios Posgrado', 'Estudios Posgrado', '1', '2018-08-28 19:07:35', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `modalidad`
--

CREATE TABLE `modalidad` (
  `mod_id` bigint(20) NOT NULL,
  `mod_nombre` varchar(200) NOT NULL,
  `mod_descripcion` varchar(500) NOT NULL,
  `mod_nivel_grado` bigint(20) DEFAULT NULL,
  `mod_nivel_posgrado` bigint(20) DEFAULT NULL,
  `mod_nivel_educacion` bigint(20) DEFAULT NULL,
  `mod_estado` varchar(1) NOT NULL,
  `mod_fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mod_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `mod_estado_logico` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `modalidad`
--

INSERT INTO `modalidad` (`mod_id`, `mod_nombre`, `mod_descripcion`, `mod_nivel_grado`, `mod_nivel_posgrado`, `mod_nivel_educacion`, `mod_estado`, `mod_fecha_creacion`, `mod_fecha_modificacion`, `mod_estado_logico`) VALUES
(1, 'Online', 'Online', 1, NULL, 3, '1', '2018-08-28 19:07:35', NULL, '1'),
(2, 'Presencial', 'Presencial', 1, NULL, 3, '1', '2018-08-28 19:07:35', NULL, '1'),
(3, 'Semipresencial', 'Semipresencial', 1, 2, NULL, '1', '2018-08-28 19:07:35', NULL, '1'),
(4, 'Distancia', 'Distancia', 1, NULL, NULL, '1', '2018-08-28 19:07:35', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `modalidad_carrera_nivel`
--

CREATE TABLE `modalidad_carrera_nivel` (
  `mcni_id` bigint(20) NOT NULL,
  `nint_id` bigint(20) NOT NULL,
  `mod_id` bigint(20) NOT NULL,
  `car_id` bigint(20) NOT NULL,
  `mcni_estado` varchar(1) NOT NULL,
  `mcni_fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mcni_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `mcni_estado_logico` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `modalidad_carrera_nivel`
--

INSERT INTO `modalidad_carrera_nivel` (`mcni_id`, `nint_id`, `mod_id`, `car_id`, `mcni_estado`, `mcni_fecha_creacion`, `mcni_fecha_modificacion`, `mcni_estado_logico`) VALUES
(1, 1, 1, 1, '1', '2018-08-28 19:07:35', NULL, '1'),
(2, 1, 1, 2, '1', '2018-08-28 19:07:35', NULL, '1'),
(3, 1, 1, 3, '1', '2018-08-28 19:07:35', NULL, '1'),
(4, 1, 1, 4, '1', '2018-08-28 19:07:35', NULL, '1'),
(5, 1, 1, 5, '1', '2018-08-28 19:07:35', NULL, '1'),
(6, 1, 1, 6, '1', '2018-08-28 19:07:35', NULL, '1'),
(7, 1, 2, 11, '1', '2018-08-28 19:07:35', NULL, '1'),
(8, 1, 2, 8, '1', '2018-08-28 19:07:35', NULL, '1'),
(9, 1, 2, 7, '1', '2018-08-28 19:07:35', NULL, '1'),
(10, 1, 2, 10, '1', '2018-08-28 19:07:35', NULL, '1'),
(11, 1, 2, 1, '1', '2018-08-28 19:07:35', NULL, '1'),
(12, 1, 2, 5, '1', '2018-08-28 19:07:35', NULL, '1'),
(13, 1, 2, 3, '1', '2018-08-28 19:07:35', NULL, '1'),
(14, 1, 2, 9, '1', '2018-08-28 19:07:35', NULL, '1'),
(15, 1, 2, 13, '1', '2018-08-28 19:07:35', NULL, '1'),
(16, 1, 2, 6, '1', '2018-08-28 19:07:35', NULL, '1'),
(17, 1, 2, 4, '1', '2018-08-28 19:07:35', NULL, '1'),
(18, 1, 2, 14, '1', '2018-08-28 19:07:35', NULL, '1'),
(19, 1, 2, 2, '1', '2018-08-28 19:07:35', NULL, '1'),
(20, 1, 3, 12, '1', '2018-08-28 19:07:35', NULL, '1'),
(21, 1, 4, 1, '1', '2018-08-28 19:07:35', NULL, '1'),
(22, 1, 4, 3, '1', '2018-08-28 19:07:35', NULL, '1'),
(23, 1, 4, 9, '1', '2018-08-28 19:07:35', NULL, '1'),
(24, 1, 4, 13, '1', '2018-08-28 19:07:35', NULL, '1'),
(25, 1, 4, 6, '1', '2018-08-28 19:07:35', NULL, '1'),
(26, 1, 4, 4, '1', '2018-08-28 19:07:35', NULL, '1'),
(27, 2, 3, 15, '1', '2018-08-28 19:07:35', NULL, '1'),
(28, 2, 3, 16, '1', '2018-08-28 19:07:35', NULL, '1'),
(29, 2, 3, 17, '1', '2018-08-28 19:07:35', NULL, '1'),
(30, 2, 3, 18, '1', '2018-08-28 19:07:35', NULL, '1'),
(31, 2, 3, 19, '1', '2018-08-28 19:07:35', NULL, '1'),
(32, 2, 3, 20, '1', '2018-08-28 19:07:35', NULL, '1'),
(33, 2, 3, 21, '1', '2018-08-28 19:07:35', NULL, '1'),
(34, 2, 3, 22, '1', '2018-08-28 19:07:35', NULL, '1'),
(35, 2, 3, 23, '1', '2018-08-28 19:07:35', NULL, '1'),
(36, 3, 2, 24, '1', '2018-08-28 19:07:35', NULL, '1'),
(37, 3, 2, 25, '1', '2018-08-28 19:07:35', NULL, '1'),
(38, 3, 2, 26, '1', '2018-08-28 19:07:35', NULL, '1'),
(39, 3, 2, 27, '1', '2018-08-28 19:07:35', NULL, '1'),
(40, 3, 2, 28, '1', '2018-08-28 19:07:35', NULL, '1'),
(41, 3, 2, 29, '1', '2018-08-28 19:07:35', NULL, '1'),
(42, 3, 2, 30, '1', '2018-08-28 19:07:35', NULL, '1'),
(43, 3, 2, 31, '1', '2018-08-28 19:07:35', NULL, '1'),
(44, 3, 2, 32, '1', '2018-08-28 19:07:35', NULL, '1'),
(45, 3, 1, 33, '1', '2018-08-28 19:07:35', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `nivel_academico`
--

CREATE TABLE `nivel_academico` (
  `naca_id` bigint(20) NOT NULL,
  `uni_id` bigint(20) NOT NULL,
  `naca_nombre` varchar(150) DEFAULT NULL,
  `naca_descripcion` varchar(500) DEFAULT NULL,
  `naca_semestre` varchar(100) DEFAULT NULL,
  `naca_estado` varchar(1) NOT NULL,
  `naca_fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `naca_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `naca_estado_logico` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nivel_academico`
--

INSERT INTO `nivel_academico` (`naca_id`, `uni_id`, `naca_nombre`, `naca_descripcion`, `naca_semestre`, `naca_estado`, `naca_fecha_creacion`, `naca_fecha_modificacion`, `naca_estado_logico`) VALUES
(1, 1, 'Nivel 0', 'Nivel 0 PreAcadémico', 'Cero', '1', '2018-08-28 19:07:35', NULL, '1'),
(2, 2, '1', 'Nivel 1', 'Primero', '1', '2018-08-28 19:07:35', NULL, '1'),
(3, 2, '2', 'Nivel 2', 'Segundo', '1', '2018-08-28 19:07:35', NULL, '1'),
(4, 2, '3', 'Nivel 3', 'Tercero', '1', '2018-08-28 19:07:35', NULL, '1'),
(5, 3, '4', 'Nivel 4', 'Cuarto', '1', '2018-08-28 19:07:35', NULL, '1'),
(6, 3, '5', 'Nivel 5', 'Quinto', '1', '2018-08-28 19:07:35', NULL, '1'),
(7, 3, '6', 'Nivel 6', 'Sexto', '1', '2018-08-28 19:07:35', NULL, '1'),
(8, 3, '7', 'Nivel 7', 'Septimo', '1', '2018-08-28 19:07:35', NULL, '1'),
(9, 4, '8', 'Nivel 8', 'Octavo', '1', '2018-08-28 19:07:35', NULL, '1'),
(10, 4, '9', 'Nivel 9', 'Noveno', '1', '2018-08-28 19:07:35', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `nivel_instruccion`
--

CREATE TABLE `nivel_instruccion` (
  `nins_id` bigint(20) NOT NULL,
  `nins_nombre` varchar(250) DEFAULT NULL,
  `nins_descripcion` varchar(500) DEFAULT NULL,
  `nins_estado` varchar(1) NOT NULL,
  `nins_fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nins_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `nins_estado_logico` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nivel_instruccion`
--

INSERT INTO `nivel_instruccion` (`nins_id`, `nins_nombre`, `nins_descripcion`, `nins_estado`, `nins_fecha_creacion`, `nins_fecha_modificacion`, `nins_estado_logico`) VALUES
(1, 'Sin estudios ', 'Sin estudios ', '1', '2018-08-28 19:07:34', NULL, '1'),
(2, 'Primarios', 'Primarios', '1', '2018-08-28 19:07:34', NULL, '1'),
(3, 'Secundarios', 'Secundarios', '1', '2018-08-28 19:07:34', NULL, '1'),
(4, 'Tercer Nivel', 'Tercer Nivel', '1', '2018-08-28 19:07:34', NULL, '1'),
(5, 'Cuarto Nivel', 'Cuarto Nivel', '1', '2018-08-28 19:07:34', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `periodo_metodo_ingreso`
--

CREATE TABLE `periodo_metodo_ingreso` (
  `pmin_id` bigint(20) NOT NULL,
  `pmin_anio` int(11) NOT NULL,
  `pmin_mes` int(11) NOT NULL,
  `nint_id` bigint(20) NOT NULL,
  `mod_id` bigint(20) NOT NULL,
  `ming_id` bigint(20) NOT NULL,
  `pmin_codigo` varchar(10) NOT NULL,
  `pmin_descripcion` varchar(100) NOT NULL,
  `pmin_fecha_desde` timestamp NULL DEFAULT NULL,
  `pmin_fecha_hasta` timestamp NULL DEFAULT NULL,
  `pmin_usuario_ingreso` int(11) NOT NULL,
  `pmin_usuario_modifica` int(11) DEFAULT NULL,
  `pmin_estado` varchar(1) NOT NULL,
  `pmin_fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pmin_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `pmin_estado_logico` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `periodo_metodo_ingreso`
--

INSERT INTO `periodo_metodo_ingreso` (`pmin_id`, `pmin_anio`, `pmin_mes`, `nint_id`, `mod_id`, `ming_id`, `pmin_codigo`, `pmin_descripcion`, `pmin_fecha_desde`, `pmin_fecha_hasta`, `pmin_usuario_ingreso`, `pmin_usuario_modifica`, `pmin_estado`, `pmin_fecha_creacion`, `pmin_fecha_modificacion`, `pmin_estado_logico`) VALUES
(1, 2017, 10, 1, 1, 1, 'CAN1017', 'Curso Admisión y Nivelación octubre 2017', '2017-10-17 10:00:00', '2017-12-08 10:00:00', 1, NULL, '1', '2018-01-23 04:59:53', NULL, '1'),
(2, 2017, 11, 1, 1, 1, 'CAN1117', 'Curso Admisión y Nivelación noviembre 2017', '2017-12-13 10:00:00', '2018-01-05 10:00:00', 1, NULL, '1', '2018-01-23 04:59:53', NULL, '1'),
(3, 2018, 1, 1, 1, 1, 'CAN0118', 'Curso Admisión y Nivelación enero 2018', '2018-01-15 10:00:00', '2018-03-09 10:00:00', 1, NULL, '1', '2018-01-23 04:59:53', NULL, '1'),
(4, 2018, 2, 1, 1, 2, 'EXA0218', 'Examen De Admisión Enero 2018', '2018-02-19 10:00:00', '2018-02-19 10:00:00', 1, 124, '1', '2018-01-23 04:59:53', '2018-01-23 20:31:20', '1'),
(5, 2018, 2, 1, 1, 1, 'CAN0218', 'Can0218', '2018-02-19 10:00:00', '2018-04-15 10:00:00', 124, NULL, '1', '2018-01-31 02:52:48', NULL, '1'),
(6, 2018, 1, 1, 1, 2, 'EXA0118', '001', '2018-01-31 10:00:00', '2018-01-01 10:00:00', 124, 124, '1', '2018-02-27 02:52:46', '2018-02-27 02:53:42', '1'),
(7, 2018, 3, 1, 1, 1, 'CAN0318', 'Can0318', '2018-03-05 10:00:00', '2018-04-01 10:00:00', 124, NULL, '1', '2018-02-28 19:02:24', NULL, '1'),
(8, 2018, 4, 1, 1, 2, 'EXA0418', 'Exa0418', '2018-04-06 10:00:00', '2018-04-30 10:00:00', 124, NULL, '1', '2018-04-07 03:36:01', NULL, '1'),
(9, 2018, 4, 1, 1, 1, 'CAN0418', 'Can0418', '2018-04-01 10:00:00', '2018-04-30 10:00:00', 124, NULL, '1', '2018-04-10 01:10:29', NULL, '1'),
(10, 2018, 5, 1, 1, 1, 'CAN0518', 'Can0518', '2018-05-01 10:00:00', '2018-05-31 10:00:00', 124, NULL, '1', '2018-05-10 20:47:23', NULL, '1'),
(11, 2018, 6, 1, 1, 1, 'CAN0618', '001', '2018-05-01 10:00:00', '2018-06-03 10:00:00', 124, NULL, '1', '2018-05-31 03:19:06', NULL, '1'),
(12, 2018, 7, 1, 1, 1, 'CAN0718', 'Can0618', '2018-06-18 10:00:00', '2018-07-23 10:00:00', 124, NULL, '1', '2018-06-27 21:59:27', NULL, '1'),
(13, 2018, 8, 1, 1, 2, 'EXA0818', 'Icf0818', '2018-08-06 10:00:00', '2018-08-06 10:00:00', 124, 124, '1', '2018-07-17 20:35:57', '2018-07-17 20:41:03', '1'),
(14, 2018, 8, 1, 1, 1, 'CAN0818', 'Can0818', '2018-07-28 10:00:00', '2018-08-13 10:00:00', 124, NULL, '1', '2018-07-30 21:12:32', NULL, '1'),
(15, 2018, 7, 1, 1, 2, 'EXA0718', 'Exa0718', '2018-07-01 10:00:00', '2018-07-31 10:00:00', 124, 124, '1', '2018-07-31 23:26:43', '2018-07-31 23:26:59', '1');

-- --------------------------------------------------------

--
-- Table structure for table `requisito`
--

CREATE TABLE `requisito` (
  `req_id` bigint(20) NOT NULL,
  `casi_id` bigint(20) NOT NULL,
  `asi_id` bigint(20) DEFAULT NULL,
  `req_comentario` varchar(200) DEFAULT NULL,
  `req_estado` varchar(1) NOT NULL,
  `req_fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `req_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `req_estado_logico` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `requisito`
--

INSERT INTO `requisito` (`req_id`, `casi_id`, `asi_id`, `req_comentario`, `req_estado`, `req_fecha_creacion`, `req_fecha_modificacion`, `req_estado_logico`) VALUES
(1, 1, NULL, '', '1', '2018-05-09 03:17:03', NULL, '1'),
(2, 2, NULL, '', '1', '2018-05-09 03:17:04', NULL, '1'),
(3, 3, NULL, '', '1', '2018-05-09 03:17:15', NULL, '1'),
(4, 4, NULL, '', '1', '2018-05-09 03:17:18', NULL, '1'),
(5, 5, NULL, '', '1', '2018-05-09 03:17:19', NULL, '1'),
(6, 6, NULL, '', '1', '2018-05-09 03:17:40', NULL, '1'),
(7, 7, 6, 'GRA-O-CMX-001', '1', '2018-05-09 03:17:41', NULL, '1'),
(8, 8, NULL, '', '1', '2018-05-09 03:17:41', NULL, '1'),
(9, 9, 8, 'GRA-O-CMX-003', '1', '2018-05-09 03:17:42', NULL, '1'),
(10, 10, NULL, '', '1', '2018-05-09 03:17:43', NULL, '1'),
(11, 11, NULL, '', '1', '2018-05-09 03:17:45', NULL, '1'),
(12, 12, NULL, '', '1', '2018-05-09 03:17:46', NULL, '1'),
(13, 13, NULL, '', '1', '2018-05-09 03:17:48', NULL, '1'),
(14, 14, 14, 'GRA-O-CMX-009', '1', '2018-05-09 03:17:49', NULL, '1'),
(15, 15, 9, 'GRA-O-CMX-004', '1', '2018-05-09 03:17:49', NULL, '1'),
(16, 16, 15, 'GRA-O-CMX-010', '1', '2018-05-09 03:17:49', NULL, '1'),
(17, 17, NULL, '', '1', '2018-05-09 03:17:50', NULL, '1'),
(18, 18, 17, 'GRA-O-CMX-012', '1', '2018-05-09 03:31:16', NULL, '1'),
(19, 19, 18, 'GRA-O-CMX-013', '1', '2018-05-09 03:31:16', NULL, '1'),
(20, 20, NULL, '', '1', '2018-05-09 03:31:17', NULL, '1'),
(21, 21, 20, 'GRA-O-CMX-015', '1', '2018-05-09 03:31:19', NULL, '1'),
(22, 22, 21, 'GRA-O-CMX-016', '1', '2018-05-09 03:31:19', NULL, '1'),
(23, 23, NULL, '', '1', '2018-05-09 03:31:19', NULL, '1'),
(24, 24, 23, 'GRA-O-CMX-018', '1', '2018-05-09 03:31:28', NULL, '1'),
(25, 25, 25, 'GRA-O-CMX-020', '1', '2018-05-09 03:31:28', NULL, '1'),
(26, 26, 26, 'GRA-O-CMX-021', '1', '2018-05-09 03:31:28', NULL, '1'),
(27, 27, 27, 'GRA-O-CMX-022', '1', '2018-05-09 03:31:28', NULL, '1'),
(28, 28, 27, 'GRA-O-CMX-022', '1', '2018-05-09 03:31:28', NULL, '1'),
(29, 29, 28, 'GRA-O-CMX-023', '1', '2018-05-09 03:31:29', NULL, '1'),
(30, 30, NULL, '', '1', '2018-05-09 03:31:29', NULL, '1'),
(31, 31, NULL, '', '1', '2018-05-09 03:31:31', NULL, '1'),
(32, 32, NULL, '', '1', '2018-05-09 03:31:37', NULL, '1'),
(33, 33, 31, 'GRA-O-CMX-026', '1', '2018-05-09 03:31:39', NULL, '1'),
(34, 34, 32, 'GRA-O-CMX-027', '1', '2018-05-09 03:31:39', NULL, '1'),
(35, 35, NULL, '', '1', '2018-05-09 03:31:39', NULL, '1'),
(36, 36, 30, 'GRA-O-CMX-025', '1', '2018-05-09 03:31:41', NULL, '1'),
(37, 37, 24, 'GRA-O-CMX-019', '1', '2018-05-09 03:31:41', NULL, '1'),
(38, 38, NULL, '', '1', '2018-05-09 03:31:41', NULL, '1'),
(39, 39, 38, 'GRA-O-CMX-033', '1', '2018-05-09 03:31:43', NULL, '1'),
(40, 40, 39, 'GRA-O-CMX-034', '1', '2018-05-09 03:31:43', NULL, '1'),
(41, 41, NULL, '', '1', '2018-05-09 03:31:44', NULL, '1'),
(42, 42, NULL, '', '1', '2018-05-09 03:31:46', NULL, '1'),
(43, 43, NULL, '', '1', '2018-05-09 03:31:48', NULL, '1'),
(44, 44, 43, 'GRA-O-CMX-038', '1', '2018-05-09 03:31:50', NULL, '1'),
(45, 45, NULL, '', '1', '2018-05-09 03:31:50', NULL, '1'),
(46, 46, NULL, '', '1', '2018-05-09 03:31:52', NULL, '1'),
(47, 47, 34, 'GRA-O-CMX-029', '1', '2018-05-09 03:31:54', NULL, '1'),
(48, 48, 48, 'GRA-O-CMX-043', '1', '2018-05-09 03:31:55', NULL, '1'),
(49, 49, 49, 'GRA-O-CMX-044', '1', '2018-05-09 03:31:55', NULL, '1'),
(50, 50, 31, 'GRA-O-CMX-026', '1', '2018-05-09 03:31:55', NULL, '1'),
(51, 51, NULL, '', '1', '2018-05-09 03:31:55', NULL, '1'),
(52, 52, NULL, '', '1', '2018-05-09 03:31:58', NULL, '1'),
(53, 53, 44, 'GRA-O-CMX-039', '1', '2018-05-09 03:32:02', NULL, '1'),
(54, 54, 51, 'GRA-O-CMX-046', '1', '2018-05-09 03:32:02', NULL, '1'),
(55, 55, NULL, '', '1', '2018-05-09 03:32:02', NULL, '1'),
(56, 56, NULL, '', '1', '2018-05-09 03:32:05', NULL, '1'),
(57, 57, NULL, '', '1', '2018-05-09 03:32:08', NULL, '1'),
(58, 58, NULL, '', '1', '2018-05-09 03:32:12', NULL, '1'),
(59, 59, NULL, '', '1', '2018-05-09 03:32:15', NULL, '1'),
(60, 60, NULL, '', '1', '2018-05-09 03:32:20', NULL, '1'),
(61, 61, 6, 'GRA-O-ECO-001', '1', '2018-05-09 03:32:24', NULL, '1'),
(62, 62, 6, 'GRA-O-ECO-001', '1', '2018-05-09 03:32:25', NULL, '1'),
(63, 63, 8, 'GRA-O-ECO-002', '1', '2018-05-09 03:32:25', NULL, '1'),
(64, 64, 10, 'GRA-O-ECO-004', '1', '2018-05-09 03:32:25', NULL, '1'),
(65, 65, NULL, '', '1', '2018-05-09 03:32:25', NULL, '1'),
(66, 66, 60, 'GRA-O-ECO-006', '1', '2018-05-09 03:32:28', NULL, '1'),
(67, 67, 12, 'GRA-O-ECO-007', '1', '2018-05-09 03:32:28', NULL, '1'),
(68, 68, 61, 'GRA-O-ECO-008', '1', '2018-05-09 03:32:28', NULL, '1'),
(69, 69, 62, 'GRA-O-ECO-009', '1', '2018-05-09 03:32:28', NULL, '1'),
(70, 70, 59, 'GRA-O-ECO-005', '1', '2018-05-09 03:32:28', NULL, '1'),
(71, 71, 15, 'GRA-O-ECO-012', '1', '2018-05-09 03:32:28', NULL, '1'),
(72, 72, 17, 'GRA-O-ECO-013', '1', '2018-05-09 03:32:28', NULL, '1'),
(73, 73, NULL, '', '1', '2018-05-09 03:32:29', NULL, '1'),
(74, 74, 62, 'GRA-O-ECO-009', '1', '2018-05-09 03:32:32', NULL, '1'),
(75, 75, 9, 'GRA-O-ECO-010', '1', '2018-05-09 03:32:32', NULL, '1'),
(76, 76, 60, 'GRA-O-ECO-006', '1', '2018-05-09 03:32:32', NULL, '1'),
(77, 77, NULL, '', '1', '2018-05-09 03:32:33', NULL, '1'),
(78, 78, 16, 'GRA-O-ECO-016', '1', '2018-05-09 03:33:41', NULL, '1'),
(79, 79, 23, 'GRA-O-ECO-018', '1', '2018-05-09 03:33:41', NULL, '1'),
(80, 80, 63, 'GRA-O-ECO-015', '1', '2018-05-09 03:33:41', NULL, '1'),
(81, 81, NULL, '', '1', '2018-05-09 03:33:41', NULL, '1'),
(82, 82, NULL, '', '1', '2018-05-09 03:33:45', NULL, '1'),
(83, 83, NULL, '', '1', '2018-05-09 03:33:53', NULL, '1'),
(84, 84, 67, 'GRA-O-ECO-025', '1', '2018-05-09 03:34:01', NULL, '1'),
(85, 85, 67, 'GRA-O-ECO-025', '1', '2018-05-09 03:34:01', NULL, '1'),
(86, 86, 68, 'GRA-O-ECO-026', '1', '2018-05-09 03:34:01', NULL, '1'),
(87, 87, NULL, '', '1', '2018-05-09 03:34:01', NULL, '1'),
(88, 88, 68, 'GRA-O-ECO-026', '1', '2018-05-09 03:34:08', NULL, '1'),
(89, 89, NULL, '', '1', '2018-05-09 03:34:08', NULL, '1'),
(90, 90, NULL, '', '1', '2018-05-09 03:34:09', NULL, '1'),
(91, 91, 72, 'GRA-O-ECO-032', '1', '2018-05-09 03:34:12', NULL, '1'),
(92, 92, NULL, '', '1', '2018-05-09 03:34:12', NULL, '1'),
(93, 93, NULL, '', '1', '2018-05-09 03:34:15', NULL, '1'),
(94, 94, NULL, '', '1', '2018-05-09 03:34:20', NULL, '1'),
(95, 95, 28, 'GRA-O-ECO-024', '1', '2018-05-09 03:34:29', NULL, '1'),
(96, 96, 70, 'GRA-O-ECO-030', '1', '2018-05-09 03:34:29', NULL, '1'),
(97, 97, 69, 'GRA-O-ECO-029', '1', '2018-05-09 03:34:30', NULL, '1'),
(98, 98, 37, 'GRA-O-ECO-022', '1', '2018-05-09 03:34:30', NULL, '1'),
(99, 99, 24, 'GRA-O-ECO-027', '1', '2018-05-09 03:34:30', NULL, '1'),
(100, 100, 69, 'GRA-O-ECO-029', '1', '2018-05-09 03:34:30', NULL, '1'),
(101, 101, NULL, '', '1', '2018-05-09 03:34:30', NULL, '1'),
(102, 102, 34, 'GRA-O-ECO-041', '1', '2018-05-09 03:34:35', NULL, '1'),
(103, 103, 79, 'GRA-O-ECO-042', '1', '2018-05-09 03:34:35', NULL, '1'),
(104, 104, 81, 'GRA-O-ECO-044', '1', '2018-05-09 03:34:35', NULL, '1'),
(105, 105, NULL, '', '1', '2018-05-09 03:34:35', NULL, '1'),
(106, 106, 33, 'GRA-O-ECO-051', '1', '2018-05-09 03:34:40', NULL, '1'),
(107, 107, NULL, '', '1', '2018-05-09 03:34:40', NULL, '1'),
(108, 108, 51, 'GRA-O-ECO-047', '1', '2018-05-09 03:34:46', NULL, '1'),
(109, 109, NULL, '', '1', '2018-05-09 03:34:46', NULL, '1'),
(110, 110, NULL, '', '1', '2018-05-09 03:34:51', NULL, '1'),
(111, 111, NULL, '', '1', '2018-05-09 03:34:56', NULL, '1'),
(112, 112, NULL, '', '1', '2018-05-09 03:35:02', NULL, '1'),
(113, 113, NULL, '', '1', '2018-05-09 03:35:07', NULL, '1'),
(114, 114, NULL, '', '1', '2018-05-09 03:35:12', NULL, '1'),
(115, 115, NULL, '', '1', '2018-05-09 03:35:17', NULL, '1'),
(116, 116, 6, 'GRA-O-FIN-002', '1', '2018-05-09 03:35:27', NULL, '1'),
(117, 117, NULL, '', '1', '2018-05-09 03:35:27', NULL, '1'),
(118, 118, 8, 'GRA-O-FIN-003', '1', '2018-05-09 03:35:35', NULL, '1'),
(119, 119, NULL, '', '1', '2018-05-09 03:35:35', NULL, '1'),
(120, 120, 86, 'GRA-O-FIN-007', '1', '2018-05-09 03:35:44', NULL, '1'),
(121, 121, 12, 'GRA-O-FIN-008', '1', '2018-05-09 03:35:44', NULL, '1'),
(122, 122, NULL, '', '1', '2018-05-09 03:35:44', NULL, '1'),
(123, 123, 14, 'GRA-O-FIN-010', '1', '2018-05-09 03:35:59', NULL, '1'),
(124, 124, 10, 'GRA-O-FIN-011', '1', '2018-05-09 03:36:00', NULL, '1'),
(125, 125, 15, 'GRA-O-FIN-012', '1', '2018-05-09 03:36:00', NULL, '1'),
(126, 126, 17, 'GRA-O-FIN-013', '1', '2018-05-09 03:36:00', NULL, '1'),
(127, 127, 19, 'GRA-O-FIN-015', '1', '2018-05-09 03:36:00', NULL, '1'),
(128, 128, NULL, '', '1', '2018-05-09 03:36:00', NULL, '1'),
(129, 129, 9, 'GRA-O-FIN-004', '1', '2018-05-09 03:36:10', NULL, '1'),
(130, 130, 16, 'GRA-O-FIN-016', '1', '2018-05-09 03:36:10', NULL, '1'),
(131, 131, 21, 'GRA-O-FIN-017', '1', '2018-05-09 03:36:10', NULL, '1'),
(132, 132, NULL, '', '1', '2018-05-09 03:36:10', NULL, '1'),
(133, 133, 71, 'GRA-O-FIN-019', '1', '2018-05-09 03:36:17', NULL, '1'),
(134, 134, 23, 'GRA-O-FIN-018', '1', '2018-05-09 03:36:17', NULL, '1'),
(135, 135, 23, 'GRA-O-FIN-018', '1', '2018-05-09 03:36:17', NULL, '1'),
(136, 136, 9, 'GRA-O-FIN-004', '1', '2018-05-09 03:36:17', NULL, '1'),
(137, 137, 66, 'GRA-O-FIN-023', '1', '2018-05-09 03:36:18', NULL, '1'),
(138, 138, 28, 'GRA-O-FIN-024', '1', '2018-05-09 03:36:18', NULL, '1'),
(139, 139, 89, 'GRA-O-FIN-025', '1', '2018-05-09 03:36:18', NULL, '1'),
(140, 140, 90, 'GRA-O-FIN-026', '1', '2018-05-09 03:36:18', NULL, '1'),
(141, 141, NULL, '', '1', '2018-05-09 03:36:18', NULL, '1'),
(142, 142, 91, 'GRA-O-FIN-028', '1', '2018-05-09 03:36:25', NULL, '1'),
(143, 143, NULL, '', '1', '2018-05-09 03:36:25', NULL, '1'),
(144, 144, 32, 'GRA-O-FIN-029', '1', '2018-05-09 03:36:32', NULL, '1'),
(145, 145, 92, 'GRA-O-FIN-032', '1', '2018-05-09 03:36:32', NULL, '1'),
(146, 146, 93, 'GRA-O-FIN-034', '1', '2018-05-09 03:36:32', NULL, '1'),
(147, 147, 93, 'GRA-O-FIN-034', '1', '2018-05-09 03:36:32', NULL, '1'),
(148, 148, NULL, '', '1', '2018-05-09 03:36:32', NULL, '1'),
(149, 149, NULL, '', '1', '2018-05-09 03:36:39', NULL, '1'),
(150, 150, 34, 'GRA-O-FIN-030', '1', '2018-05-09 03:36:44', NULL, '1'),
(151, 151, 97, 'GRA-O-FIN-041', '1', '2018-05-09 03:36:45', NULL, '1'),
(152, 152, NULL, '', '1', '2018-05-09 03:36:45', NULL, '1'),
(153, 153, NULL, '', '1', '2018-05-09 03:36:51', NULL, '1'),
(154, 154, NULL, '', '1', '2018-05-09 03:36:59', NULL, '1'),
(155, 155, 50, 'GRA-O-FIN-046', '1', '2018-05-09 03:37:07', NULL, '1'),
(156, 156, NULL, '', '1', '2018-05-09 03:37:07', NULL, '1'),
(157, 157, 96, 'GRA-O-FIN-039', '1', '2018-05-09 03:37:18', NULL, '1'),
(158, 158, NULL, '', '1', '2018-05-09 03:37:18', NULL, '1'),
(159, 159, 95, 'GRA-O-FIN-038', '1', '2018-05-09 03:37:25', NULL, '1'),
(160, 160, NULL, '', '1', '2018-05-09 03:37:25', NULL, '1'),
(161, 161, 97, 'GRA-O-FIN-041', '1', '2018-05-09 03:37:34', NULL, '1'),
(162, 162, 51, 'GRA-O-FIN-047', '1', '2018-05-09 03:37:35', NULL, '1'),
(163, 163, NULL, '', '1', '2018-05-09 03:37:35', NULL, '1'),
(164, 164, NULL, '', '1', '2018-05-09 03:37:43', NULL, '1'),
(165, 165, NULL, '', '1', '2018-05-09 03:37:50', NULL, '1'),
(166, 166, NULL, '', '1', '2018-05-09 03:38:04', NULL, '1'),
(167, 167, NULL, '', '1', '2018-05-09 03:38:11', NULL, '1'),
(168, 168, NULL, '', '1', '2018-05-09 03:38:19', NULL, '1'),
(169, 169, NULL, '', '1', '2018-05-09 03:38:27', NULL, '1'),
(170, 170, NULL, '', '1', '2018-05-09 03:38:35', NULL, '1'),
(171, 171, 6, 'GRA-O-MKT-002', '1', '2018-05-09 03:38:42', NULL, '1'),
(172, 172, 8, 'GRA-O-MKT-003', '1', '2018-05-09 03:38:42', NULL, '1'),
(173, 173, NULL, '', '1', '2018-05-09 03:38:42', NULL, '1'),
(174, 174, NULL, '', '1', '2018-05-09 03:39:02', NULL, '1'),
(175, 175, 12, 'GRA-O-MKT-009', '1', '2018-05-09 03:39:16', NULL, '1'),
(176, 176, 12, 'GRA-O-MKT-009', '1', '2018-05-09 03:39:16', NULL, '1'),
(177, 177, 14, 'GRA-O-MKT-010', '1', '2018-05-09 03:39:16', NULL, '1'),
(178, 178, 9, 'GRA-O-MKT-004', '1', '2018-05-09 03:39:16', NULL, '1'),
(179, 179, 10, 'GRA-O-MKT-008', '1', '2018-05-09 03:39:16', NULL, '1'),
(180, 180, 15, 'GRA-O-MKT-012', '1', '2018-05-09 03:39:17', NULL, '1'),
(181, 181, 106, 'GRA-O-MKT-013', '1', '2018-05-09 03:39:17', NULL, '1'),
(182, 182, 10, 'GRA-O-MKT-008', '1', '2018-05-09 03:39:17', NULL, '1'),
(183, 183, 19, 'GRA-O-MKT-015', '1', '2018-05-09 03:39:17', NULL, '1'),
(184, 184, 16, 'GRA-O-MKT-011', '1', '2018-05-09 03:39:17', NULL, '1'),
(185, 185, 21, 'GRA-O-MKT-018', '1', '2018-05-09 03:39:17', NULL, '1'),
(186, 186, 16, 'GRA-O-MKT-011', '1', '2018-05-09 03:39:17', NULL, '1'),
(187, 187, 108, 'GRA-O-MKT-019', '1', '2018-05-09 03:39:17', NULL, '1'),
(188, 188, 16, 'GRA-O-MKT-011', '1', '2018-05-09 03:39:17', NULL, '1'),
(189, 189, 109, 'GRA-O-MKT-022', '1', '2018-05-09 03:39:18', NULL, '1'),
(190, 190, 16, 'GRA-O-MKT-011', '1', '2018-05-09 03:39:18', NULL, '1'),
(191, 191, 66, 'GRA-O-MKT-023', '1', '2018-05-09 03:39:18', NULL, '1'),
(192, 192, 10, 'GRA-O-MKT-008', '1', '2018-05-09 03:39:18', NULL, '1'),
(193, 193, 109, 'GRA-O-MKT-022', '1', '2018-05-09 03:39:18', NULL, '1'),
(194, 194, 16, 'GRA-O-MKT-011', '1', '2018-05-09 03:39:18', NULL, '1'),
(195, 195, 109, 'GRA-O-MKT-022', '1', '2018-05-09 03:39:19', NULL, '1'),
(196, 196, 16, 'GRA-O-MKT-011', '1', '2018-05-09 03:39:19', NULL, '1'),
(197, 197, 109, 'GRA-O-MKT-022', '1', '2018-05-09 03:39:19', NULL, '1'),
(198, 198, 46, 'GRA-O-MKT-030', '1', '2018-05-09 03:39:19', NULL, '1'),
(199, 199, 29, 'GRA-O-MKT-025', '1', '2018-05-09 03:39:19', NULL, '1'),
(200, 200, 112, 'GRA-O-MKT-031', '1', '2018-05-09 03:39:19', NULL, '1'),
(201, 201, 112, 'GRA-O-MKT-031', '1', '2018-05-09 03:39:19', NULL, '1'),
(202, 202, 109, 'GRA-O-MKT-022', '1', '2018-05-09 03:39:19', NULL, '1'),
(203, 203, 105, 'GRA-O-MKT-007', '1', '2018-05-09 03:39:20', NULL, '1'),
(204, 204, 28, 'GRA-O-MKT-024', '1', '2018-05-09 03:39:20', NULL, '1'),
(205, 205, 109, 'GRA-O-MKT-022', '1', '2018-05-09 03:39:20', NULL, '1'),
(206, 206, 69, 'GRA-O-MKT-041', '1', '2018-05-09 03:39:20', NULL, '1'),
(207, 207, 119, 'GRA-O-MKT-039', '1', '2018-05-09 03:39:20', NULL, '1'),
(208, 208, 116, 'GRA-O-MKT-035', '1', '2018-05-09 03:39:20', NULL, '1'),
(209, 209, 50, 'GRA-O-MKT-044', '1', '2018-05-09 03:39:20', NULL, '1'),
(210, 210, 121, 'GRA-O-MKT-042', '1', '2018-05-09 03:39:20', NULL, '1'),
(211, 211, 123, 'GRA-O-MKT-046', '1', '2018-05-09 03:39:20', NULL, '1'),
(212, 212, 118, 'GRA-O-MKT-038', '1', '2018-05-09 03:39:21', NULL, '1'),
(213, 213, 109, 'GRA-O-MKT-022', '1', '2018-05-09 03:39:21', NULL, '1'),
(214, 214, 43, 'GRA-O-MKT-036', '1', '2018-05-09 03:39:21', NULL, '1'),
(215, 215, NULL, '', '1', '2018-05-09 03:39:21', NULL, '1'),
(216, 216, 51, 'GRA-O-MKT-047', '1', '2018-05-09 03:39:29', NULL, '1'),
(217, 217, NULL, '', '1', '2018-05-09 03:39:30', NULL, '1'),
(218, 218, NULL, '', '1', '2018-05-09 03:39:53', NULL, '1'),
(219, 219, NULL, '', '1', '2018-05-09 03:40:04', NULL, '1'),
(220, 220, NULL, '', '1', '2018-05-09 03:40:13', NULL, '1'),
(221, 221, NULL, '', '1', '2018-05-09 03:40:23', NULL, '1'),
(222, 222, NULL, '', '1', '2018-05-09 03:40:31', NULL, '1'),
(223, 223, NULL, '', '1', '2018-05-09 03:40:41', NULL, '1'),
(224, 224, NULL, '', '1', '2018-05-09 03:40:50', NULL, '1'),
(225, 225, 128, 'GRA-O-TUR-004', '1', '2018-05-09 03:41:04', NULL, '1'),
(226, 226, NULL, '', '1', '2018-05-09 03:41:04', NULL, '1'),
(227, 227, NULL, '', '1', '2018-05-09 03:41:19', NULL, '1'),
(228, 228, NULL, '', '1', '2018-05-09 03:41:32', NULL, '1'),
(229, 229, 106, 'GRA-O-TUR-007', '1', '2018-05-09 03:41:41', NULL, '1'),
(230, 230, 130, 'GRA-O-TUR-008', '1', '2018-05-09 03:41:41', NULL, '1'),
(231, 231, 8, 'GRA-O-TUR-003', '1', '2018-05-09 03:41:41', NULL, '1'),
(232, 232, NULL, '', '1', '2018-05-09 03:41:41', NULL, '1'),
(233, 233, 15, 'GRA-O-TUR-011', '1', '2018-05-09 03:41:52', NULL, '1'),
(234, 234, NULL, '', '1', '2018-05-09 03:41:52', NULL, '1'),
(235, 235, NULL, '', '1', '2018-05-09 03:42:02', NULL, '1'),
(236, 236, 133, 'GRA-O-TUR-014', '1', '2018-05-09 03:42:13', NULL, '1'),
(237, 237, 14, 'GRA-O-TUR-015', '1', '2018-05-09 03:42:13', NULL, '1'),
(238, 238, 134, 'GRA-O-TUR-016', '1', '2018-05-09 03:42:14', NULL, '1'),
(239, 239, 21, 'GRA-O-TUR-017', '1', '2018-05-09 03:42:14', NULL, '1'),
(240, 240, NULL, '', '1', '2018-05-09 03:42:14', NULL, '1'),
(241, 241, NULL, '', '1', '2018-05-09 03:42:26', NULL, '1'),
(242, 242, 137, 'GRA-O-TUR-022', '1', '2018-05-09 03:42:37', NULL, '1'),
(243, 243, NULL, '', '1', '2018-05-09 03:42:37', NULL, '1'),
(244, 244, 137, 'GRA-O-TUR-022', '1', '2018-05-09 03:42:47', NULL, '1'),
(245, 245, NULL, '', '1', '2018-05-09 03:42:47', NULL, '1'),
(246, 246, 66, 'GRA-O-TUR-023', '1', '2018-05-09 03:43:21', NULL, '1'),
(247, 247, 22, 'GRA-O-TUR-005', '1', '2018-05-09 03:43:21', NULL, '1'),
(248, 248, NULL, '', '1', '2018-05-09 03:43:21', NULL, '1'),
(249, 249, 74, 'GRA-O-TUR-027', '1', '2018-05-09 03:43:36', NULL, '1'),
(250, 250, 140, 'GRA-O-TUR-028', '1', '2018-05-09 03:43:36', NULL, '1'),
(251, 251, 141, 'GRA-O-TUR-029', '1', '2018-05-09 03:43:36', NULL, '1'),
(252, 252, NULL, '', '1', '2018-05-09 03:43:37', NULL, '1'),
(253, 253, 135, 'GRA-O-TUR-018', '1', '2018-05-09 03:43:48', NULL, '1'),
(254, 254, 37, 'GRA-O-TUR-035', '1', '2018-05-09 03:43:48', NULL, '1'),
(255, 255, 136, 'GRA-O-TUR-020', '1', '2018-05-09 03:43:48', NULL, '1'),
(256, 256, 74, 'GRA-O-TUR-027', '1', '2018-05-09 03:43:48', NULL, '1'),
(257, 257, 144, 'GRA-O-TUR-034', '1', '2018-05-09 03:43:48', NULL, '1'),
(258, 258, 10, 'GRA-O-TUR-012', '1', '2018-05-09 03:43:48', NULL, '1'),
(259, 259, 145, 'GRA-O-TUR-036', '1', '2018-05-09 03:43:48', NULL, '1'),
(260, 260, 37, 'GRA-O-TUR-035', '1', '2018-05-09 03:43:48', NULL, '1'),
(261, 261, NULL, '', '1', '2018-05-09 03:43:49', NULL, '1'),
(262, 262, NULL, '', '1', '2018-05-09 03:44:01', NULL, '1'),
(263, 263, NULL, '', '1', '2018-05-09 03:44:32', NULL, '1'),
(264, 264, NULL, '', '1', '2018-05-09 03:44:44', NULL, '1'),
(265, 265, 34, 'GRA-O-TUR-037', '1', '2018-05-09 03:44:55', NULL, '1'),
(266, 266, 151, 'GRA-O-TUR-044', '1', '2018-05-09 03:44:55', NULL, '1'),
(267, 267, 148, 'GRA-O-TUR-040', '1', '2018-05-09 03:44:56', NULL, '1'),
(268, 268, 144, 'GRA-O-TUR-034', '1', '2018-05-09 03:44:56', NULL, '1'),
(269, 269, 150, 'GRA-O-TUR-043', '1', '2018-05-09 03:44:56', NULL, '1'),
(270, 270, 51, 'GRA-O-TUR-048', '1', '2018-05-09 03:44:56', NULL, '1'),
(271, 271, NULL, '', '1', '2018-05-09 03:44:56', NULL, '1'),
(272, 272, NULL, '', '1', '2018-05-09 03:45:12', NULL, '1'),
(273, 273, NULL, '', '1', '2018-05-09 03:45:25', NULL, '1'),
(274, 274, NULL, '', '1', '2018-05-09 03:45:37', NULL, '1'),
(275, 275, NULL, '', '1', '2018-05-09 03:46:00', NULL, '1'),
(276, 276, NULL, '', '1', '2018-05-09 03:46:12', NULL, '1'),
(277, 277, NULL, '', '1', '2018-05-09 03:46:31', NULL, '1'),
(278, 278, 6, 'GRA-O-ADM-002', '1', '2018-05-09 03:46:42', NULL, '1'),
(279, 279, NULL, '', '1', '2018-05-09 03:46:42', NULL, '1'),
(280, 280, NULL, '', '1', '2018-05-09 03:47:00', NULL, '1'),
(281, 281, NULL, '', '1', '2018-05-09 03:47:15', NULL, '1'),
(282, 282, 105, 'GRA-O-ADM-007', '1', '2018-05-09 03:47:27', NULL, '1'),
(283, 283, 12, 'GRA-O-ADM-008', '1', '2018-05-09 03:47:27', NULL, '1'),
(284, 284, NULL, '', '1', '2018-05-09 03:47:27', NULL, '1'),
(285, 285, 14, 'GRA-O-ADM-010', '1', '2018-05-09 03:48:11', NULL, '1'),
(286, 286, 156, 'GRA-O-ADM-011', '1', '2018-05-09 03:48:11', NULL, '1'),
(287, 287, 15, 'GRA-O-ADM-012', '1', '2018-05-09 03:48:11', NULL, '1'),
(288, 288, 17, 'GRA-O-ADM-013', '1', '2018-05-09 03:48:11', NULL, '1'),
(289, 289, 87, 'GRA-O-ADM-014', '1', '2018-05-09 03:48:11', NULL, '1'),
(290, 290, NULL, '', '1', '2018-05-09 03:48:11', NULL, '1'),
(291, 291, 9, 'GRA-O-ADM-004', '1', '2018-05-09 03:48:31', NULL, '1'),
(292, 292, 16, 'GRA-O-ADM-016', '1', '2018-05-09 03:48:31', NULL, '1'),
(293, 293, 15, 'GRA-O-ADM-012', '1', '2018-05-09 03:48:31', NULL, '1'),
(294, 294, NULL, '', '1', '2018-05-09 03:48:31', NULL, '1'),
(295, 295, NULL, '', '1', '2018-05-09 03:48:45', NULL, '1'),
(296, 296, NULL, '', '1', '2018-05-09 03:48:58', NULL, '1'),
(297, 297, 66, 'GRA-O-ADM-023', '1', '2018-05-09 03:49:11', NULL, '1'),
(298, 298, 66, 'GRA-O-ADM-023', '1', '2018-05-09 03:49:12', NULL, '1'),
(299, 299, 28, 'GRA-O-ADM-024', '1', '2018-05-09 03:49:12', NULL, '1'),
(300, 300, 108, 'GRA-O-ADM-018', '1', '2018-05-09 03:49:12', NULL, '1'),
(301, 301, NULL, '', '1', '2018-05-09 03:49:12', NULL, '1'),
(302, 302, NULL, '', '1', '2018-05-09 03:49:28', NULL, '1'),
(303, 303, NULL, '', '1', '2018-05-09 03:49:44', NULL, '1'),
(304, 304, NULL, '', '1', '2018-05-09 03:50:14', NULL, '1'),
(305, 305, 32, 'GRA-O-ADM-028', '1', '2018-05-09 03:50:39', NULL, '1'),
(306, 306, NULL, '', '1', '2018-05-09 03:50:39', NULL, '1'),
(307, 307, 29, 'GRA-O-ADM-030', '1', '2018-05-09 03:51:07', NULL, '1'),
(308, 308, NULL, '', '1', '2018-05-09 03:51:07', NULL, '1'),
(309, 309, 74, 'GRA-O-ADM-031', '1', '2018-05-09 03:51:22', NULL, '1'),
(310, 310, 30, 'GRA-O-ADM-033', '1', '2018-05-09 03:51:22', NULL, '1'),
(311, 311, NULL, '', '1', '2018-05-09 03:51:22', NULL, '1'),
(312, 312, 34, 'GRA-O-ADM-029', '1', '2018-05-09 03:51:38', NULL, '1'),
(313, 313, 160, 'GRA-O-ADM-037', '1', '2018-05-09 03:51:39', NULL, '1'),
(314, 314, NULL, '', '1', '2018-05-09 03:51:39', NULL, '1'),
(315, 315, NULL, '', '1', '2018-05-09 03:51:52', NULL, '1'),
(316, 316, NULL, '', '1', '2018-05-09 03:52:05', NULL, '1'),
(317, 317, NULL, '', '1', '2018-05-09 03:52:26', NULL, '1'),
(318, 318, NULL, '', '1', '2018-05-09 03:52:42', NULL, '1'),
(319, 319, 99, 'GRA-O-ADM-043', '1', '2018-05-09 03:52:56', NULL, '1'),
(320, 320, 48, 'GRA-O-ADM-034', '1', '2018-05-09 03:52:56', NULL, '1'),
(321, 321, 160, 'GRA-O-ADM-037', '1', '2018-05-09 03:52:56', NULL, '1'),
(322, 322, 55, 'GRA-O-ADM-040', '1', '2018-05-09 03:52:56', NULL, '1'),
(323, 323, 161, 'GRA-O-ADM-038', '1', '2018-05-09 03:52:56', NULL, '1'),
(324, 324, 51, 'GRA-O-ADM-046', '1', '2018-05-09 03:52:57', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `subarea_conocimiento`
--

CREATE TABLE `subarea_conocimiento` (
  `scon_id` bigint(20) NOT NULL,
  `acon_id` bigint(20) NOT NULL,
  `scon_nombre` varchar(200) NOT NULL,
  `scon_descripcion` varchar(500) NOT NULL,
  `scon_estado` varchar(1) NOT NULL,
  `scon_fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `scon_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `scon_estado_logico` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subarea_conocimiento`
--

INSERT INTO `subarea_conocimiento` (`scon_id`, `acon_id`, `scon_nombre`, `scon_descripcion`, `scon_estado`, `scon_fecha_creacion`, `scon_fecha_modificacion`, `scon_estado_logico`) VALUES
(1, 1, 'Programas básicos', 'Descripción de subárea de conocimiento', '1', '2018-08-28 19:07:36', NULL, '1'),
(2, 1, 'Programas de alfabetización y de aritmética', 'Descripción de subárea de conocimiento', '1', '2018-08-28 19:07:36', NULL, '1'),
(3, 1, 'Desarrollo personal', 'Descripción de subárea de conocimiento', '1', '2018-08-28 19:07:36', NULL, '1'),
(4, 2, 'Formación de personal docente y ciencias de la educación', 'Descripción de subárea de conocimiento', '1', '2018-08-28 19:07:36', NULL, '1'),
(5, 3, 'Artes', 'Descripción de subárea de conocimiento', '1', '2018-08-28 19:07:36', NULL, '1'),
(6, 3, 'Humanidades', 'Descripción de subárea de conocimiento', '1', '2018-08-28 19:07:36', NULL, '1'),
(7, 4, 'Ciencias sociales y del comportamiento', 'Descripción de subárea de conocimiento', '1', '2018-08-28 19:07:36', NULL, '1'),
(8, 4, 'Periodismo e información', 'Descripción de subárea de conocimiento', '1', '2018-08-28 19:07:36', NULL, '1'),
(9, 4, 'Educación comercial y administración', 'Descripción de subárea de conocimiento', '1', '2018-08-28 19:07:36', NULL, '1'),
(10, 4, 'Derecho', 'Descripción de subárea de conocimiento', '1', '2018-08-28 19:07:36', NULL, '1'),
(11, 5, 'Ciencias de la vida', 'Descripción de subárea de conocimiento', '1', '2018-08-28 19:07:36', NULL, '1'),
(12, 5, 'Ciencias físicas', 'Descripción de subárea de conocimiento', '1', '2018-08-28 19:07:36', NULL, '1'),
(13, 5, 'Matemáticas y estadística', 'Descripción de subárea de conocimiento', '1', '2018-08-28 19:07:36', NULL, '1'),
(14, 5, 'Informática', 'Descripción de subárea de conocimiento', '1', '2018-08-28 19:07:36', NULL, '1'),
(15, 6, 'Ingeniería y profesiones afines', 'Descripción de subárea de conocimiento', '1', '2018-08-28 19:07:36', NULL, '1'),
(16, 6, 'Industria y producción', 'Descripción de subárea de conocimiento', '1', '2018-08-28 19:07:36', NULL, '1'),
(17, 6, 'Arquitectura y construcción', 'Descripción de subárea de conocimiento', '1', '2018-08-28 19:07:36', NULL, '1'),
(18, 7, 'Agricultura, silvicultura y pesca', 'Descripción de subárea de conocimiento', '1', '2018-08-28 19:07:36', NULL, '1'),
(19, 7, 'Veterinaria', 'Descripción de subárea de conocimiento', '1', '2018-08-28 19:07:36', NULL, '1'),
(20, 8, 'Medicina', 'Descripción de subárea de conocimiento', '1', '2018-08-28 19:07:36', NULL, '1'),
(21, 8, 'Servicios sociales', 'Descripción de subárea de conocimiento', '1', '2018-08-28 19:07:36', NULL, '1'),
(22, 9, 'Servicios personales', 'Descripción de subárea de conocimiento', '1', '2018-08-28 19:07:36', NULL, '1'),
(23, 9, 'Servicios de transporte', 'Descripción de subárea de conocimiento', '1', '2018-08-28 19:07:36', NULL, '1'),
(24, 9, 'Protección del medio ambiente', 'Descripción de subárea de conocimiento', '1', '2018-08-28 19:07:36', NULL, '1'),
(25, 9, 'Servicios de seguridad', 'Descripción de subárea de conocimiento', '1', '2018-08-28 19:07:36', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `sub_conoc_asignatura`
--

CREATE TABLE `sub_conoc_asignatura` (
  `scas_id` bigint(20) NOT NULL,
  `scon_id` bigint(20) NOT NULL,
  `asi_id` bigint(20) NOT NULL,
  `scas_estado` varchar(1) NOT NULL,
  `scas_fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `scas_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `scas_estado_logico` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sub_conoc_asignatura`
--

INSERT INTO `sub_conoc_asignatura` (`scas_id`, `scon_id`, `asi_id`, `scas_estado`, `scas_fecha_creacion`, `scas_fecha_modificacion`, `scas_estado_logico`) VALUES
(1, 1, 1, '1', '2018-08-28 19:07:36', NULL, '1'),
(2, 1, 2, '1', '2018-08-28 19:07:36', NULL, '1'),
(3, 1, 3, '1', '2018-08-28 19:07:36', NULL, '1'),
(4, 1, 4, '1', '2018-08-28 19:07:36', NULL, '1'),
(5, 1, 5, '1', '2018-08-28 19:07:36', NULL, '1'),
(6, 1, 6, '1', '2018-08-28 19:07:36', NULL, '1'),
(7, 1, 7, '1', '2018-08-28 19:07:36', NULL, '1'),
(8, 1, 8, '1', '2018-08-28 19:07:36', NULL, '1'),
(9, 2, 9, '1', '2018-08-28 19:07:36', NULL, '1'),
(10, 2, 10, '1', '2018-08-28 19:07:36', NULL, '1'),
(11, 2, 11, '1', '2018-08-28 19:07:36', NULL, '1'),
(12, 2, 12, '1', '2018-08-28 19:07:36', NULL, '1'),
(13, 2, 13, '1', '2018-08-28 19:07:36', NULL, '1'),
(14, 3, 14, '1', '2018-08-28 19:07:36', NULL, '1'),
(15, 3, 15, '1', '2018-08-28 19:07:36', NULL, '1'),
(16, 3, 16, '1', '2018-08-28 19:07:36', NULL, '1'),
(17, 3, 17, '1', '2018-08-28 19:07:36', NULL, '1'),
(18, 3, 18, '1', '2018-08-28 19:07:36', NULL, '1'),
(19, 3, 19, '1', '2018-08-28 19:07:36', NULL, '1'),
(20, 3, 20, '1', '2018-08-28 19:07:36', NULL, '1'),
(21, 3, 21, '1', '2018-08-28 19:07:36', NULL, '1'),
(22, 3, 22, '1', '2018-08-28 19:07:36', NULL, '1'),
(23, 3, 23, '1', '2018-08-28 19:07:36', NULL, '1'),
(24, 4, 24, '1', '2018-08-28 19:07:36', NULL, '1'),
(25, 4, 25, '1', '2018-08-28 19:07:36', NULL, '1'),
(26, 4, 26, '1', '2018-08-28 19:07:36', NULL, '1'),
(27, 4, 27, '1', '2018-08-28 19:07:36', NULL, '1'),
(28, 4, 28, '1', '2018-08-28 19:07:36', NULL, '1'),
(29, 4, 29, '1', '2018-08-28 19:07:36', NULL, '1'),
(30, 4, 30, '1', '2018-08-28 19:07:36', NULL, '1'),
(31, 4, 31, '1', '2018-08-28 19:07:36', NULL, '1'),
(32, 4, 32, '1', '2018-08-28 19:07:36', NULL, '1'),
(33, 5, 33, '1', '2018-08-28 19:07:36', NULL, '1'),
(34, 5, 34, '1', '2018-08-28 19:07:36', NULL, '1'),
(35, 5, 35, '1', '2018-08-28 19:07:36', NULL, '1'),
(36, 5, 36, '1', '2018-08-28 19:07:36', NULL, '1'),
(37, 5, 37, '1', '2018-08-28 19:07:36', NULL, '1'),
(38, 5, 38, '1', '2018-08-28 19:07:36', NULL, '1'),
(39, 6, 39, '1', '2018-08-28 19:07:36', NULL, '1'),
(40, 6, 40, '1', '2018-08-28 19:07:36', NULL, '1'),
(41, 6, 41, '1', '2018-08-28 19:07:36', NULL, '1'),
(42, 6, 42, '1', '2018-08-28 19:07:36', NULL, '1'),
(43, 7, 43, '1', '2018-08-28 19:07:36', NULL, '1'),
(44, 7, 44, '1', '2018-08-28 19:07:36', NULL, '1'),
(45, 7, 45, '1', '2018-08-28 19:07:36', NULL, '1'),
(46, 8, 46, '1', '2018-08-28 19:07:36', NULL, '1'),
(47, 8, 47, '1', '2018-08-28 19:07:36', NULL, '1'),
(48, 8, 48, '1', '2018-08-28 19:07:36', NULL, '1'),
(49, 8, 49, '1', '2018-08-28 19:07:36', NULL, '1'),
(50, 8, 50, '1', '2018-08-28 19:07:36', NULL, '1'),
(51, 8, 51, '1', '2018-08-28 19:07:36', NULL, '1'),
(52, 8, 52, '1', '2018-08-28 19:07:36', NULL, '1'),
(53, 8, 53, '1', '2018-08-28 19:07:36', NULL, '1'),
(54, 8, 54, '1', '2018-08-28 19:07:36', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_carrera`
--

CREATE TABLE `tipo_carrera` (
  `tica_id` bigint(20) NOT NULL,
  `tica_nombre` varchar(250) DEFAULT NULL,
  `tica_descripcion` varchar(500) DEFAULT NULL,
  `tica_estado` varchar(1) NOT NULL,
  `tica_fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tica_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `tica_estado_logico` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipo_carrera`
--

INSERT INTO `tipo_carrera` (`tica_id`, `tica_nombre`, `tica_descripcion`, `tica_estado`, `tica_fecha_creacion`, `tica_fecha_modificacion`, `tica_estado_logico`) VALUES
(1, 'Carrera', 'Carrera', '1', '2018-08-28 19:07:35', NULL, '1'),
(2, 'Programa', 'Programa', '1', '2018-08-28 19:07:35', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_institucion_aca`
--

CREATE TABLE `tipo_institucion_aca` (
  `tiac_id` bigint(20) NOT NULL,
  `tiac_nombre` varchar(250) DEFAULT NULL,
  `tiac_descripcion` varchar(500) DEFAULT NULL,
  `tiac_estado` varchar(1) NOT NULL,
  `tiac_fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tiac_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `tiac_estado_logico` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipo_institucion_aca`
--

INSERT INTO `tipo_institucion_aca` (`tiac_id`, `tiac_nombre`, `tiac_descripcion`, `tiac_estado`, `tiac_fecha_creacion`, `tiac_fecha_modificacion`, `tiac_estado_logico`) VALUES
(1, 'Pública', 'Pública', '1', '2018-08-28 19:07:34', NULL, '1'),
(2, 'Privada', 'Privada', '1', '2018-08-28 19:07:34', NULL, '1'),
(3, 'Fiscomisional', 'Fiscomisional', '1', '2018-08-28 19:07:34', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_malla`
--

CREATE TABLE `tipo_malla` (
  `tmal_id` bigint(20) NOT NULL,
  `tmal_nombre` varchar(250) NOT NULL,
  `tmal_descripcion` varchar(500) NOT NULL,
  `tmal_estado` varchar(1) NOT NULL,
  `tmal_fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tmal_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `tmal_estado_logico` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipo_malla`
--

INSERT INTO `tipo_malla` (`tmal_id`, `tmal_nombre`, `tmal_descripcion`, `tmal_estado`, `tmal_fecha_creacion`, `tmal_fecha_modificacion`, `tmal_estado_logico`) VALUES
(1, 'Can', 'Curso de Admisión y Nivelación', '1', '2018-08-28 19:07:36', NULL, '1'),
(2, 'Formacion Profesional', 'Formacion Profesional', '1', '2018-08-28 19:07:36', NULL, '1'),
(3, 'Ingles', 'Ingles', '1', '2018-08-28 19:07:36', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_nivel_estudio`
--

CREATE TABLE `tipo_nivel_estudio` (
  `tnes_id` bigint(20) NOT NULL,
  `tnes_nombre` varchar(300) NOT NULL,
  `tnes_descripcion` varchar(500) NOT NULL,
  `tnes_estado` varchar(1) NOT NULL,
  `tnes_fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tnes_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `tnes_estado_logico` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipo_nivel_estudio`
--

INSERT INTO `tipo_nivel_estudio` (`tnes_id`, `tnes_nombre`, `tnes_descripcion`, `tnes_estado`, `tnes_fecha_creacion`, `tnes_fecha_modificacion`, `tnes_estado_logico`) VALUES
(1, 'Medio', 'Medio', '1', '2018-08-28 19:07:34', NULL, '1'),
(2, 'Tercer', 'Tercer', '1', '2018-08-28 19:07:34', NULL, '1'),
(3, 'Cuarto', 'Cuarto', '1', '2018-08-28 19:07:34', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `unidad`
--

CREATE TABLE `unidad` (
  `uni_id` bigint(20) NOT NULL,
  `uni_nombre` varchar(200) NOT NULL,
  `uni_descripcion` varchar(500) NOT NULL,
  `uni_estado` varchar(1) NOT NULL,
  `uni_fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `uni_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `uni_estado_logico` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `unidad`
--

INSERT INTO `unidad` (`uni_id`, `uni_nombre`, `uni_descripcion`, `uni_estado`, `uni_fecha_creacion`, `uni_fecha_modificacion`, `uni_estado_logico`) VALUES
(1, 'Ingreso', 'Ingreso', '1', '2018-08-28 19:07:35', NULL, '1'),
(2, 'Básica', 'Básica', '1', '2018-08-28 19:07:35', NULL, '1'),
(3, 'Profesional', 'Profesional', '1', '2018-08-28 19:07:35', NULL, '1'),
(4, 'Titulación', 'Titulación', '1', '2018-08-28 19:07:35', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `unidad_academica`
--

CREATE TABLE `unidad_academica` (
  `uaca_id` bigint(20) NOT NULL,
  `uaca_nombre` varchar(300) NOT NULL,
  `uaca_descripcion` varchar(500) NOT NULL,
  `uaca_estado` varchar(1) NOT NULL,
  `uaca_fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `uaca_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `uaca_estado_logico` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `unidad_academica`
--

INSERT INTO `unidad_academica` (`uaca_id`, `uaca_nombre`, `uaca_descripcion`, `uaca_estado`, `uaca_fecha_creacion`, `uaca_fecha_modificacion`, `uaca_estado_logico`) VALUES
(1, 'Grado', 'Grado', '1', '2018-08-28 19:07:34', NULL, '1'),
(2, 'Posgrado', 'Posgrado', '1', '2018-08-28 19:07:34', NULL, '1'),
(3, 'Educación Continua', 'Educación Continua', '0', '2018-08-28 19:07:34', NULL, '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area_conocimiento`
--
ALTER TABLE `area_conocimiento`
  ADD PRIMARY KEY (`acon_id`);

--
-- Indexes for table `asignacion_curso`
--
ALTER TABLE `asignacion_curso`
  ADD PRIMARY KEY (`acur_id`),
  ADD KEY `cur_id` (`cur_id`);

--
-- Indexes for table `asignatura`
--
ALTER TABLE `asignatura`
  ADD PRIMARY KEY (`asi_id`);

--
-- Indexes for table `cabecera_malla`
--
ALTER TABLE `cabecera_malla`
  ADD PRIMARY KEY (`cmal_id`),
  ADD KEY `tmal_id` (`tmal_id`);

--
-- Indexes for table `campo_formacion`
--
ALTER TABLE `campo_formacion`
  ADD PRIMARY KEY (`cfor_id`);

--
-- Indexes for table `carrera`
--
ALTER TABLE `carrera`
  ADD PRIMARY KEY (`car_id`);

--
-- Indexes for table `carrera_asignatura`
--
ALTER TABLE `carrera_asignatura`
  ADD PRIMARY KEY (`casi_id`),
  ADD KEY `asi_id` (`asi_id`),
  ADD KEY `naca_id` (`naca_id`),
  ADD KEY `cfor_id` (`cfor_id`);

--
-- Indexes for table `carrera_malla`
--
ALTER TABLE `carrera_malla`
  ADD PRIMARY KEY (`cmal_id`),
  ADD KEY `fac_id` (`fac_id`),
  ADD KEY `tica_id` (`tica_id`),
  ADD KEY `mod_id` (`mod_id`);

--
-- Indexes for table `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`cur_id`),
  ADD KEY `pmin_id` (`pmin_id`);

--
-- Indexes for table `detalle_malla`
--
ALTER TABLE `detalle_malla`
  ADD PRIMARY KEY (`dmal_numero`),
  ADD KEY `cmal_id` (`cmal_id`),
  ADD KEY `casi_id` (`casi_id`);

--
-- Indexes for table `facultad`
--
ALTER TABLE `facultad`
  ADD PRIMARY KEY (`fac_id`);

--
-- Indexes for table `modalidad`
--
ALTER TABLE `modalidad`
  ADD PRIMARY KEY (`mod_id`);

--
-- Indexes for table `modalidad_carrera_nivel`
--
ALTER TABLE `modalidad_carrera_nivel`
  ADD PRIMARY KEY (`mcni_id`);

--
-- Indexes for table `nivel_academico`
--
ALTER TABLE `nivel_academico`
  ADD PRIMARY KEY (`naca_id`),
  ADD KEY `uni_id` (`uni_id`);

--
-- Indexes for table `nivel_instruccion`
--
ALTER TABLE `nivel_instruccion`
  ADD PRIMARY KEY (`nins_id`);

--
-- Indexes for table `periodo_metodo_ingreso`
--
ALTER TABLE `periodo_metodo_ingreso`
  ADD PRIMARY KEY (`pmin_id`),
  ADD KEY `mod_id` (`mod_id`);

--
-- Indexes for table `requisito`
--
ALTER TABLE `requisito`
  ADD PRIMARY KEY (`req_id`),
  ADD KEY `casi_id` (`casi_id`),
  ADD KEY `asi_id` (`asi_id`);

--
-- Indexes for table `subarea_conocimiento`
--
ALTER TABLE `subarea_conocimiento`
  ADD PRIMARY KEY (`scon_id`),
  ADD KEY `acon_id` (`acon_id`);

--
-- Indexes for table `sub_conoc_asignatura`
--
ALTER TABLE `sub_conoc_asignatura`
  ADD PRIMARY KEY (`scas_id`),
  ADD KEY `scon_id` (`scon_id`),
  ADD KEY `asi_id` (`asi_id`);

--
-- Indexes for table `tipo_carrera`
--
ALTER TABLE `tipo_carrera`
  ADD PRIMARY KEY (`tica_id`);

--
-- Indexes for table `tipo_institucion_aca`
--
ALTER TABLE `tipo_institucion_aca`
  ADD PRIMARY KEY (`tiac_id`);

--
-- Indexes for table `tipo_malla`
--
ALTER TABLE `tipo_malla`
  ADD PRIMARY KEY (`tmal_id`);

--
-- Indexes for table `tipo_nivel_estudio`
--
ALTER TABLE `tipo_nivel_estudio`
  ADD PRIMARY KEY (`tnes_id`);

--
-- Indexes for table `unidad`
--
ALTER TABLE `unidad`
  ADD PRIMARY KEY (`uni_id`);

--
-- Indexes for table `unidad_academica`
--
ALTER TABLE `unidad_academica`
  ADD PRIMARY KEY (`uaca_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area_conocimiento`
--
ALTER TABLE `area_conocimiento`
  MODIFY `acon_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `asignacion_curso`
--
ALTER TABLE `asignacion_curso`
  MODIFY `acur_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;
--
-- AUTO_INCREMENT for table `asignatura`
--
ALTER TABLE `asignatura`
  MODIFY `asi_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;
--
-- AUTO_INCREMENT for table `cabecera_malla`
--
ALTER TABLE `cabecera_malla`
  MODIFY `cmal_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `campo_formacion`
--
ALTER TABLE `campo_formacion`
  MODIFY `cfor_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `carrera`
--
ALTER TABLE `carrera`
  MODIFY `car_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `carrera_asignatura`
--
ALTER TABLE `carrera_asignatura`
  MODIFY `casi_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=325;
--
-- AUTO_INCREMENT for table `carrera_malla`
--
ALTER TABLE `carrera_malla`
  MODIFY `cmal_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `curso`
--
ALTER TABLE `curso`
  MODIFY `cur_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `detalle_malla`
--
ALTER TABLE `detalle_malla`
  MODIFY `dmal_numero` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `facultad`
--
ALTER TABLE `facultad`
  MODIFY `fac_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `modalidad`
--
ALTER TABLE `modalidad`
  MODIFY `mod_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `modalidad_carrera_nivel`
--
ALTER TABLE `modalidad_carrera_nivel`
  MODIFY `mcni_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `nivel_academico`
--
ALTER TABLE `nivel_academico`
  MODIFY `naca_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `nivel_instruccion`
--
ALTER TABLE `nivel_instruccion`
  MODIFY `nins_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `periodo_metodo_ingreso`
--
ALTER TABLE `periodo_metodo_ingreso`
  MODIFY `pmin_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `requisito`
--
ALTER TABLE `requisito`
  MODIFY `req_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=325;
--
-- AUTO_INCREMENT for table `subarea_conocimiento`
--
ALTER TABLE `subarea_conocimiento`
  MODIFY `scon_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `sub_conoc_asignatura`
--
ALTER TABLE `sub_conoc_asignatura`
  MODIFY `scas_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `tipo_carrera`
--
ALTER TABLE `tipo_carrera`
  MODIFY `tica_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tipo_institucion_aca`
--
ALTER TABLE `tipo_institucion_aca`
  MODIFY `tiac_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tipo_malla`
--
ALTER TABLE `tipo_malla`
  MODIFY `tmal_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tipo_nivel_estudio`
--
ALTER TABLE `tipo_nivel_estudio`
  MODIFY `tnes_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `unidad`
--
ALTER TABLE `unidad`
  MODIFY `uni_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `unidad_academica`
--
ALTER TABLE `unidad_academica`
  MODIFY `uaca_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `asignacion_curso`
--
ALTER TABLE `asignacion_curso`
  ADD CONSTRAINT `asignacion_curso_ibfk_1` FOREIGN KEY (`cur_id`) REFERENCES `curso` (`cur_id`);

--
-- Constraints for table `cabecera_malla`
--
ALTER TABLE `cabecera_malla`
  ADD CONSTRAINT `cabecera_malla_ibfk_1` FOREIGN KEY (`tmal_id`) REFERENCES `tipo_malla` (`tmal_id`);

--
-- Constraints for table `carrera_asignatura`
--
ALTER TABLE `carrera_asignatura`
  ADD CONSTRAINT `carrera_asignatura_ibfk_1` FOREIGN KEY (`asi_id`) REFERENCES `asignatura` (`asi_id`),
  ADD CONSTRAINT `carrera_asignatura_ibfk_2` FOREIGN KEY (`naca_id`) REFERENCES `nivel_academico` (`naca_id`),
  ADD CONSTRAINT `carrera_asignatura_ibfk_3` FOREIGN KEY (`cfor_id`) REFERENCES `campo_formacion` (`cfor_id`);

--
-- Constraints for table `carrera_malla`
--
ALTER TABLE `carrera_malla`
  ADD CONSTRAINT `carrera_malla_ibfk_1` FOREIGN KEY (`fac_id`) REFERENCES `facultad` (`fac_id`),
  ADD CONSTRAINT `carrera_malla_ibfk_2` FOREIGN KEY (`tica_id`) REFERENCES `tipo_carrera` (`tica_id`),
  ADD CONSTRAINT `carrera_malla_ibfk_3` FOREIGN KEY (`mod_id`) REFERENCES `modalidad` (`mod_id`);

--
-- Constraints for table `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `curso_ibfk_1` FOREIGN KEY (`pmin_id`) REFERENCES `periodo_metodo_ingreso` (`pmin_id`);

--
-- Constraints for table `detalle_malla`
--
ALTER TABLE `detalle_malla`
  ADD CONSTRAINT `detalle_malla_ibfk_1` FOREIGN KEY (`cmal_id`) REFERENCES `cabecera_malla` (`cmal_id`),
  ADD CONSTRAINT `detalle_malla_ibfk_2` FOREIGN KEY (`casi_id`) REFERENCES `carrera_asignatura` (`casi_id`);

--
-- Constraints for table `nivel_academico`
--
ALTER TABLE `nivel_academico`
  ADD CONSTRAINT `nivel_academico_ibfk_1` FOREIGN KEY (`uni_id`) REFERENCES `unidad` (`uni_id`);

--
-- Constraints for table `periodo_metodo_ingreso`
--
ALTER TABLE `periodo_metodo_ingreso`
  ADD CONSTRAINT `periodo_metodo_ingreso_ibfk_1` FOREIGN KEY (`mod_id`) REFERENCES `modalidad` (`mod_id`);

--
-- Constraints for table `requisito`
--
ALTER TABLE `requisito`
  ADD CONSTRAINT `requisito_ibfk_1` FOREIGN KEY (`casi_id`) REFERENCES `carrera_asignatura` (`casi_id`),
  ADD CONSTRAINT `requisito_ibfk_2` FOREIGN KEY (`asi_id`) REFERENCES `asignatura` (`asi_id`);

--
-- Constraints for table `subarea_conocimiento`
--
ALTER TABLE `subarea_conocimiento`
  ADD CONSTRAINT `subarea_conocimiento_ibfk_1` FOREIGN KEY (`acon_id`) REFERENCES `area_conocimiento` (`acon_id`);

--
-- Constraints for table `sub_conoc_asignatura`
--
ALTER TABLE `sub_conoc_asignatura`
  ADD CONSTRAINT `sub_conoc_asignatura_ibfk_1` FOREIGN KEY (`scon_id`) REFERENCES `subarea_conocimiento` (`scon_id`),
  ADD CONSTRAINT `sub_conoc_asignatura_ibfk_2` FOREIGN KEY (`asi_id`) REFERENCES `asignatura` (`asi_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
