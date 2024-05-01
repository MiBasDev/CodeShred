-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 01, 2024 at 11:26 PM
-- Server version: 10.6.7-MariaDB-2ubuntu1.1
-- PHP Version: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codeShred`
--

-- --------------------------------------------------------

--
-- Table structure for table `follows`
--

CREATE TABLE `follows` (
  `user_id` int(11) NOT NULL,
  `user_id_following` int(11) NOT NULL,
  `id_follow` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `follows`
--

INSERT INTO `follows` (`user_id`, `user_id_following`, `id_follow`) VALUES
(42, 5, 55),
(42, 8, 58),
(5, 42, 60),
(8, 42, 70),
(8, 5, 71),
(5, 8, 72);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_like` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Likes del post';

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id_post`, `id_user`, `id_like`) VALUES
(28, 42, 33),
(28, 5, 41);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id_log` int(11) NOT NULL,
  `action` varchar(50) NOT NULL,
  `detail` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id_log`, `action`, `detail`, `date`, `user_id`) VALUES
(13, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-04-23 20:39:25', 5),
(14, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-04-24 19:28:01', 5),
(15, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-04-24 19:34:58', 5),
(16, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-04-24 19:42:30', 5),
(17, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-04-24 20:24:11', 5),
(18, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-04-24 20:30:56', 5),
(19, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-04-24 20:35:41', 5),
(20, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-04-24 21:09:59', 5),
(21, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-04-26 17:40:13', 5),
(22, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-04-26 18:04:18', 5),
(23, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-04-26 19:29:34', 5),
(24, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-04-26 19:36:54', 5),
(25, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-04-26 19:37:22', 5),
(26, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-04-26 20:01:12', 5),
(27, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-04-26 20:17:25', 5),
(28, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-04-27 08:24:36', 5),
(29, 'registro', 'El usuario \'Gala\' se ha registrado en el sistema.', '2024-04-27 10:22:51', 8),
(30, 'login', 'El usuario \'Gala\' accede al sistema.', '2024-04-27 10:23:30', 8),
(31, 'login', 'El usuario \'Gala\' accede al sistema.', '2024-04-27 10:24:09', 8),
(32, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-04-27 10:24:56', 5),
(33, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-04-27 20:13:51', 5),
(34, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-04-27 20:20:52', 5),
(35, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-04-28 07:39:31', 5),
(36, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-04-28 08:36:44', 5),
(37, 'insert', 'Nuevo post de Miguel añadido: prueba 2', '2024-04-28 10:19:16', 5),
(38, 'insert', 'Nuevo post de Miguel añadido: prueba 3', '2024-04-28 10:22:31', 5),
(39, 'insert', 'Nuevo post de Miguel añadido: prueba 3', '2024-04-28 10:24:35', 5),
(40, 'insert', 'Nuevo post de Miguel añadido: prueba 3', '2024-04-28 10:27:29', 5),
(41, 'insert', 'Nuevo post de Miguel añadido: prueba 3', '2024-04-28 10:27:51', 5),
(42, 'insert', 'Nuevo post de Miguel añadido: prueba 3', '2024-04-28 10:29:19', 5),
(43, 'insert', 'Nuevo post de Miguel añadido: prueba 3', '2024-04-28 10:29:38', 5),
(44, 'insert', 'Nuevo post de Miguel añadido: prueba 3', '2024-04-28 10:29:57', 5),
(45, 'insert', 'Nuevo post de Miguel añadido: prueba 3', '2024-04-28 10:31:09', 5),
(46, 'insert', 'Nuevo post de Miguel añadido: prueba 3', '2024-04-28 10:31:18', 5),
(47, 'insert', 'Nuevo post de Miguel añadido: prueba 3', '2024-04-28 10:31:41', 5),
(48, 'insert', 'Nuevo post de Miguel añadido: prueba 3', '2024-04-28 10:32:51', 5),
(49, 'insert', 'Nuevo post de Miguel añadido: Prueba 2', '2024-04-28 10:35:00', 5),
(50, 'login', 'El usuario \'Gala\' accede al sistema.', '2024-04-28 10:36:31', 8),
(51, 'insert', 'Nuevo post de Gala añadido: Span', '2024-04-28 10:37:14', 8),
(52, 'insert', 'Nuevo post de Gala añadido: Otra prueba', '2024-04-28 10:37:57', 8),
(53, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-04-28 10:48:35', 5),
(54, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-04-28 11:56:06', 5),
(55, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-04-28 12:06:21', 5),
(56, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-04-28 12:23:44', 5),
(57, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-04-28 12:29:21', 5),
(58, 'insert', 'Nuevo post de Miguel añadido: 123123', '2024-04-28 12:29:47', 5),
(59, 'insert', 'Nuevo post de Miguel añadido: 123123', '2024-04-28 12:29:58', 5),
(60, 'update', 'Post de Miguel actualizado: 123123', '2024-04-28 12:48:42', 5),
(61, 'update', 'Post de Miguel actualizado: 123123', '2024-04-28 12:49:30', 5),
(62, 'update', 'Post de Miguel actualizado: 123123', '2024-04-28 12:49:37', 5),
(63, 'update', 'Post de Miguel actualizado: 123123', '2024-04-28 12:50:08', 5),
(64, 'update', 'Post de Miguel actualizado: 123123', '2024-04-28 12:52:24', 5),
(65, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-04-28 16:26:44', 5),
(67, 'update', 'Post de Miguel actualizado: 123123', '2024-04-28 16:27:20', 5),
(68, 'update', 'Post de Miguel actualizado: 123123', '2024-04-28 16:27:56', 5),
(69, 'insert', 'Nuevo post de Miguel añadido: qweqweq', '2024-04-28 17:27:35', 5),
(70, 'insert', 'Nuevo post de Miguel añadido: eqeqeq', '2024-04-28 17:28:06', 5),
(71, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-04-28 18:17:06', 5),
(72, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-04-28 18:32:37', 5),
(73, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-04-28 18:39:14', 5),
(74, 'insert', 'Nuevo post de Miguel añadido: qweqweqwe', '2024-04-28 18:39:21', 5),
(75, 'update', 'Post de Miguel actualizado: qweqweqwe', '2024-04-28 18:39:27', 5),
(76, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-04-28 18:43:28', 5),
(77, 'login', 'El usuario \'Gala\' accede al sistema.', '2024-04-28 20:44:00', 8),
(78, 'insert', 'Nuevo post de Gala añadido: Hola', '2024-04-28 20:44:45', 8),
(79, 'login', 'El usuario \'Gala\' accede al sistema.', '2024-04-28 20:50:06', 8),
(80, 'login', 'El usuario \'Gala\' accede al sistema.', '2024-04-28 20:51:04', 8),
(81, 'update', 'Post de Gala actualizado: Hola', '2024-04-28 20:51:16', 8),
(82, 'insert', 'Nuevo post de Gala añadido: ', '2024-04-28 20:51:46', 8),
(83, 'update', 'Post de Gala actualizado: dfd', '2024-04-28 20:52:00', 8),
(84, 'insert', 'Nuevo post de Gala añadido: fgjgh', '2024-04-28 20:52:14', 8),
(85, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-04-29 19:48:01', 5),
(86, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-04-29 19:51:27', 5),
(105, 'follow', 'El usuario Miguel ha seguido a Gala.', '2024-04-30 22:02:57', 5),
(106, 'unfollow', 'El usuario Miguel ha dejado de seguir a Gala.', '2024-04-30 22:02:58', 5),
(107, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-05-01 07:40:32', 5),
(108, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-05-01 07:43:18', 5),
(109, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-05-01 08:10:05', 5),
(110, 'like', 'El usuario Miguel ha dado like a 30.', '2024-05-01 08:33:01', 5),
(111, 'unlike', 'El usuario Miguel ha quitado el like a 30.', '2024-05-01 08:33:05', 5),
(112, 'like', 'El usuario Miguel ha dado like a 30.', '2024-05-01 08:33:07', 5),
(113, 'unlike', 'El usuario Miguel ha quitado el like a 30.', '2024-05-01 08:33:08', 5),
(114, 'like', 'El usuario Miguel ha dado like a 30.', '2024-05-01 08:33:31', 5),
(115, 'unlike', 'El usuario Miguel ha quitado el like a 30.', '2024-05-01 08:33:32', 5),
(116, 'like', 'El usuario Miguel ha dado like a 30.', '2024-05-01 08:33:33', 5),
(117, 'unlike', 'El usuario Miguel ha quitado el like a 30.', '2024-05-01 08:33:34', 5),
(118, 'like', 'El usuario Miguel ha dado like a 30.', '2024-05-01 08:33:35', 5),
(119, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 30.', '2024-05-01 08:42:35', 5),
(120, 'like', 'El usuario Miguel ha dado like al post con ID 30.', '2024-05-01 08:42:36', 5),
(121, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 30.', '2024-05-01 08:42:39', 5),
(122, 'like', 'El usuario Miguel ha dado like al post con ID 30.', '2024-05-01 08:42:40', 5),
(123, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 30.', '2024-05-01 08:42:41', 5),
(124, 'like', 'El usuario Miguel ha dado like al post con ID 30.', '2024-05-01 08:42:42', 5),
(125, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 30.', '2024-05-01 08:46:10', 5),
(126, 'like', 'El usuario Miguel ha dado like al post con ID 30.', '2024-05-01 08:46:11', 5),
(127, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 30.', '2024-05-01 08:49:10', 5),
(128, 'like', 'El usuario Miguel ha dado like al post con ID 30.', '2024-05-01 08:49:10', 5),
(129, 'like', 'El usuario Miguel ha dado like al post con ID 29.', '2024-05-01 08:54:44', 5),
(130, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 29.', '2024-05-01 08:54:45', 5),
(131, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 30.', '2024-05-01 09:09:44', 5),
(132, 'like', 'El usuario Miguel ha dado like al post con ID 30.', '2024-05-01 09:09:49', 5),
(133, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 30.', '2024-05-01 09:11:32', 5),
(134, 'like', 'El usuario Miguel ha dado like al post con ID 30.', '2024-05-01 09:11:33', 5),
(135, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 30.', '2024-05-01 09:12:57', 5),
(136, 'like', 'El usuario Miguel ha dado like al post con ID 30.', '2024-05-01 09:12:58', 5),
(137, 'like', 'El usuario Miguel ha dado like al post con ID 28.', '2024-05-01 09:13:41', 5),
(138, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 28.', '2024-05-01 09:13:44', 5),
(139, 'like', 'El usuario Miguel ha dado like al post con ID 29.', '2024-05-01 09:14:36', 5),
(140, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 30.', '2024-05-01 09:14:42', 5),
(141, 'like', 'El usuario Miguel ha dado like al post con ID 30.', '2024-05-01 09:14:43', 5),
(142, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 29.', '2024-05-01 09:14:45', 5),
(143, 'like', 'El usuario Miguel ha dado like al post con ID 29.', '2024-05-01 09:14:46', 5),
(144, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 29.', '2024-05-01 09:14:48', 5),
(145, 'like', 'El usuario Miguel ha dado like al post con ID 29.', '2024-05-01 09:36:30', 5),
(146, 'like', 'El usuario Miguel ha dado like al post con ID 22.', '2024-05-01 09:36:31', 5),
(147, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 22.', '2024-05-01 09:36:32', 5),
(148, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 29.', '2024-05-01 09:36:33', 5),
(149, 'error upating', 'El usuario Miguel ha no actualizado su descripción.', '2024-05-01 09:49:32', 5),
(150, 'error upating', 'El usuario Miguel ha no actualizado su descripción.', '2024-05-01 09:49:36', 5),
(151, 'error upating', 'El usuario Miguel ha no actualizado su descripción.', '2024-05-01 09:49:44', 5),
(152, 'error upating', 'El usuario Miguel ha no actualizado su descripción.', '2024-05-01 09:50:06', 5),
(153, 'updated', 'El usuario Miguel ha actualizado su descripción.', '2024-05-01 09:52:40', 5),
(154, 'updated', 'El usuario Miguel ha actualizado su descripción.', '2024-05-01 09:53:00', 5),
(155, 'updated', 'El usuario Miguel ha actualizado su descripción.', '2024-05-01 09:55:07', 5),
(156, 'updated', 'El usuario Miguel ha actualizado su descripción.', '2024-05-01 09:56:07', 5),
(157, 'updated', 'El usuario Miguel ha actualizado su descripción.', '2024-05-01 09:56:23', 5),
(158, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-05-01 09:57:17', 5),
(159, 'updated', 'El usuario Miguel ha actualizado su descripción.', '2024-05-01 09:57:34', 5),
(160, 'updated', 'El usuario Miguel ha actualizado su descripción.', '2024-05-01 09:57:55', 5),
(161, 'updated', 'El usuario Miguel ha actualizado su descripción.', '2024-05-01 09:58:01', 5),
(162, 'updated', 'El usuario Miguel ha actualizado su descripción.', '2024-05-01 10:00:06', 5),
(163, 'updated', 'El usuario Miguel ha actualizado su descripción.', '2024-05-01 10:00:13', 5),
(164, 'follow', 'El usuario Miguel ha seguido a Gala.', '2024-05-01 10:00:28', 5),
(165, 'like', 'El usuario Miguel ha dado like al post con ID 29.', '2024-05-01 10:01:03', 5),
(166, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 29.', '2024-05-01 10:01:04', 5),
(167, 'like', 'El usuario Miguel ha dado like al post con ID 29.', '2024-05-01 10:01:12', 5),
(168, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 29.', '2024-05-01 10:01:13', 5),
(172, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-05-01 14:17:48', 5),
(174, 'registro', 'El usuario Jorgito69 se ha registrado en el sistema.', '2024-05-01 14:20:48', 42),
(175, 'follow', 'El usuario Jorgito69 ha seguido a Miguel.', '2024-05-01 14:21:47', 42),
(176, 'like', 'El usuario Jorgito69 ha dado like al post con ID 30.', '2024-05-01 14:21:57', 42),
(177, 'unlike', 'El usuario Jorgito69 ha quitado el like al post con ID 30.', '2024-05-01 14:21:58', 42),
(178, 'like', 'El usuario Jorgito69 ha dado like al post con ID 30.', '2024-05-01 14:21:59', 42),
(179, 'follow', 'El usuario Jorgito69 ha seguido a Gala.', '2024-05-01 14:22:14', 42),
(180, 'unfollow', 'El usuario Jorgito69 ha dejado de seguir a Gala.', '2024-05-01 14:40:48', 42),
(181, 'follow', 'El usuario Jorgito69 ha seguido a Gala.', '2024-05-01 14:40:53', 42),
(182, 'unlike', 'El usuario Jorgito69 ha quitado el like al post con ID 30.', '2024-05-01 14:44:15', 42),
(183, 'like', 'El usuario Jorgito69 ha dado like al post con ID 29.', '2024-05-01 14:44:25', 42),
(184, 'unlike', 'El usuario Jorgito69 ha quitado el like al post con ID 29.', '2024-05-01 14:44:30', 42),
(185, 'like', 'El usuario Jorgito69 ha dado like al post con ID 29.', '2024-05-01 14:44:32', 42),
(186, 'unfollow', 'El usuario Jorgito69 ha dejado de seguir a Gala.', '2024-05-01 14:46:26', 42),
(187, 'insert', 'Nuevo post de Jorgito69 añadido: 123123', '2024-05-01 14:57:38', 42),
(188, 'insert', 'Nuevo post de Jorgito69 añadido: 1234', '2024-05-01 14:58:29', 42),
(189, 'follow', 'El usuario Jorgito69 ha seguido a Gala.', '2024-05-01 14:59:41', 42),
(190, 'unlike', 'El usuario Jorgito69 ha quitado el like al post con ID 29.', '2024-05-01 15:01:00', 42),
(191, 'like', 'El usuario Jorgito69 ha dado like al post con ID 30.', '2024-05-01 15:02:45', 42),
(192, 'unlike', 'El usuario Jorgito69 ha quitado el like al post con ID 30.', '2024-05-01 15:02:48', 42),
(193, 'like', 'El usuario Jorgito69 ha dado like al post con ID 30.', '2024-05-01 15:02:50', 42),
(194, 'unlike', 'El usuario Jorgito69 ha quitado el like al post con ID 30.', '2024-05-01 15:02:55', 42),
(195, 'like', 'El usuario Jorgito69 ha dado like al post con ID 30.', '2024-05-01 15:02:56', 42),
(196, 'unlike', 'El usuario Jorgito69 ha quitado el like al post con ID 30.', '2024-05-01 15:05:43', 42),
(197, 'like', 'El usuario Jorgito69 ha dado like al post con ID 30.', '2024-05-01 15:05:44', 42),
(198, 'unlike', 'El usuario Jorgito69 ha quitado el like al post con ID 30.', '2024-05-01 15:05:44', 42),
(199, 'like', 'El usuario Jorgito69 ha dado like al post con ID 30.', '2024-05-01 15:05:44', 42),
(200, 'unlike', 'El usuario Jorgito69 ha quitado el like al post con ID 30.', '2024-05-01 15:05:45', 42),
(201, 'like', 'El usuario Jorgito69 ha dado like al post con ID 30.', '2024-05-01 15:05:45', 42),
(202, 'like', 'El usuario Jorgito69 ha dado like al post con ID 28.', '2024-05-01 15:08:26', 42),
(203, 'unlike', 'El usuario Jorgito69 ha quitado el like al post con ID 30.', '2024-05-01 15:10:02', 42),
(204, 'like', 'El usuario Jorgito69 ha dado like al post con ID 30.', '2024-05-01 15:10:02', 42),
(205, 'unlike', 'El usuario Jorgito69 ha quitado el like al post con ID 30.', '2024-05-01 15:10:03', 42),
(206, 'like', 'El usuario Jorgito69 ha dado like al post con ID 30.', '2024-05-01 15:10:04', 42),
(207, 'unlike', 'El usuario Jorgito69 ha quitado el like al post con ID 30.', '2024-05-01 15:10:05', 42),
(208, 'like', 'El usuario Jorgito69 ha dado like al post con ID 30.', '2024-05-01 15:10:06', 42),
(209, 'unlike', 'El usuario Jorgito69 ha quitado el like al post con ID 30.', '2024-05-01 15:16:04', 42),
(210, 'like', 'El usuario Jorgito69 ha dado like al post con ID 30.', '2024-05-01 15:16:05', 42),
(211, 'unlike', 'El usuario Jorgito69 ha quitado el like al post con ID 30.', '2024-05-01 15:16:05', 42),
(212, 'like', 'El usuario Jorgito69 ha dado like al post con ID 30.', '2024-05-01 15:20:29', 42),
(213, 'like', 'El usuario Jorgito69 ha dado like al post con ID 29.', '2024-05-01 15:24:34', 42),
(214, 'unlike', 'El usuario Jorgito69 ha quitado el like al post con ID 29.', '2024-05-01 15:24:38', 42),
(215, 'insert', 'Nuevo post de Jorgito69 añadido: 123123', '2024-05-01 15:24:52', 42),
(216, 'update', 'Post de Jorgito69 actualizado: 123123', '2024-05-01 15:24:59', 42),
(217, 'update', 'Post de Jorgito69 actualizado: 123123', '2024-05-01 15:25:11', 42),
(218, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-05-01 15:25:46', 5),
(219, 'follow', 'El usuario Miguel ha seguido a Jorgito69.', '2024-05-01 15:25:54', 5),
(220, 'unfollow', 'El usuario Miguel ha dejado de seguir a Jorgito69.', '2024-05-01 15:25:59', 5),
(221, 'follow', 'El usuario Miguel ha seguido a Jorgito69.', '2024-05-01 15:26:22', 5),
(222, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-05-01 19:20:11', 5),
(223, 'updated', 'El usuario Miguel ha actualizado su descripción.', '2024-05-01 19:22:05', 5),
(224, 'updated', 'El usuario Miguel ha actualizado su descripción.', '2024-05-01 19:22:09', 5),
(225, 'login', 'El usuario \'Gala\' accede al sistema.', '2024-05-01 19:59:52', 8),
(226, 'deleted', 'El usuario Gala ha borrado al post con ID 30.', '2024-05-01 20:01:52', 8),
(227, 'deleted', 'El usuario Gala ha borrado al post con ID 29.', '2024-05-01 20:02:00', 8),
(228, 'follow', 'El usuario Gala ha seguido a Miguel.', '2024-05-01 20:19:47', 8),
(229, 'unfollow', 'El usuario Gala ha dejado de seguir a Miguel.', '2024-05-01 20:32:41', 8),
(230, 'follow', 'El usuario Gala ha seguido a Miguel.', '2024-05-01 20:32:42', 8),
(231, 'unfollow', 'El usuario Gala ha dejado de seguir a Miguel.', '2024-05-01 20:32:53', 8),
(232, 'follow', 'El usuario Gala ha seguido a Jorgito69.', '2024-05-01 20:34:36', 8),
(233, 'follow', 'El usuario Gala ha seguido a Miguel.', '2024-05-01 20:34:37', 8),
(234, 'unfollow', 'El usuario Gala ha dejado de seguir a Jorgito69.', '2024-05-01 20:34:49', 8),
(235, 'follow', 'El usuario Gala ha seguido a Jorgito69.', '2024-05-01 20:34:50', 8),
(236, 'unfollow', 'El usuario Gala ha dejado de seguir a Miguel.', '2024-05-01 20:34:51', 8),
(237, 'follow', 'El usuario Gala ha seguido a Miguel.', '2024-05-01 20:34:52', 8),
(238, 'unfollow', 'El usuario Gala ha dejado de seguir a Jorgito69.', '2024-05-01 20:34:52', 8),
(239, 'follow', 'El usuario Gala ha seguido a Jorgito69.', '2024-05-01 20:34:52', 8),
(240, 'unfollow', 'El usuario Gala ha dejado de seguir a Miguel.', '2024-05-01 20:35:19', 8),
(241, 'unfollow', 'El usuario Gala ha dejado de seguir a Jorgito69.', '2024-05-01 20:35:20', 8),
(242, 'follow', 'El usuario Gala ha seguido a Miguel.', '2024-05-01 20:35:21', 8),
(243, 'follow', 'El usuario Gala ha seguido a Jorgito69.', '2024-05-01 20:35:21', 8),
(244, 'unfollow', 'El usuario Gala ha dejado de seguir a Jorgito69.', '2024-05-01 20:35:22', 8),
(245, 'follow', 'El usuario Gala ha seguido a Jorgito69.', '2024-05-01 20:35:25', 8),
(246, 'unfollow', 'El usuario Gala ha dejado de seguir a Miguel.', '2024-05-01 21:05:21', 8),
(247, 'follow', 'El usuario Gala ha seguido a Miguel.', '2024-05-01 21:05:21', 8),
(248, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-05-01 21:08:16', 5),
(249, 'unfollow', 'El usuario Miguel ha dejado de seguir a Gala.', '2024-05-01 21:08:45', 5),
(250, 'follow', 'El usuario Miguel ha seguido a Gala.', '2024-05-01 21:08:46', 5),
(251, 'like', 'El usuario Miguel ha dado like al post con ID 28.', '2024-05-01 21:18:42', 5),
(252, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 28.', '2024-05-01 21:19:29', 5),
(253, 'like', 'El usuario Miguel ha dado like al post con ID 28.', '2024-05-01 21:19:30', 5);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id_post` int(11) NOT NULL,
  `post_code` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `post_img` varchar(255) NOT NULL,
  `post_user_id` int(11) NOT NULL,
  `post_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Fragmentos de código';

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id_post`, `post_code`, `post_img`, `post_user_id`, `post_title`) VALUES
(1, '{\"html\":\"<p>hola<\\/p>\",\"css\":\"p{color:red;}\",\"js\":\"\"}', 'aaa', 5, 'Prueba 1'),
(20, '{\"html\":\"<p>Hola<\\/p>\",\"css\":\"p {background-color:blue;}\",\"js\":\"function adiosJeje(){console.log(\'adios\');}\"}', '-', 5, 'Prueba 2'),
(21, '{\"html\":\"<span>No se que es esto<\\/span>\",\"css\":\"span {color: green;}\",\"js\":\"\"}', '-', 8, 'Span'),
(22, '{\"html\":\"prueba\",\"css\":\"\",\"js\":\"eqweq\"}', '-', 8, 'Otra prueba'),
(28, '{\"html\":\"hola caracola\",\"css\":\"\",\"js\":\"caracola\"}', '-', 8, 'Hola');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id_tags` int(11) NOT NULL,
  `tags_post_id` int(11) NOT NULL,
  `tags_html` tinyint(1) DEFAULT NULL,
  `tags_css` tinyint(1) DEFAULT NULL,
  `tags_js` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tags del post';

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id_tags`, `tags_post_id`, `tags_html`, `tags_css`, `tags_js`) VALUES
(1, 1, 1, 1, 0),
(10, 20, 1, 1, 1),
(11, 21, 1, 1, 0),
(12, 22, 1, 0, 1),
(18, 28, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `user` varchar(20) NOT NULL,
  `user_pass` varchar(100) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `user_surname` varchar(80) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_rol` int(11) NOT NULL,
  `user_last_login` timestamp NULL DEFAULT NULL,
  `user_description` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Usuarios de la pagina';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `user`, `user_pass`, `user_name`, `user_surname`, `user_email`, `user_rol`, `user_last_login`, `user_description`) VALUES
(5, 'Miguel', '$2y$10$ytd.B210fUaoaoAxSM1gcuOBuQwI6M3irzZ9SrxpZMVG1NOmp8uF6', 'Miguel', 'Bastos', 'miguelbastosgandara11@gmail.com', 3, '2024-05-01 21:08:16', 'Soy estudiante de DAW y espero que me aprueben :)'),
(6, 'Admin', '$2y$10$9QYWYUb.3c.eK.yfVd5Fo.jigfWs4XpCwDRJOp4sAOAjm/aubQZny', 'admin', 'admin', 'miguelbastosgandara11+admin@gmail.com', 1, '2024-04-21 18:45:29', NULL),
(8, 'Gala', '$2y$10$BWgU1V4CUqKfwSqn.eloDe.Oea1RvJPyda4ZzKNUOVintMmnLgxia', 'Gala', 'Perez', 'galacid00@gmail.com', 3, '2024-05-01 19:59:52', NULL),
(42, 'Jorgito69', '$2y$10$PXS7bO8s.OZxebESjVUrD.xSxxuPZNLV3KxPh2RhVNBcE1I/XG3j.', 'Jorge', 'Pino Gil', 'jpingil@gmail.com', 3, '2024-05-01 14:20:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

CREATE TABLE `views` (
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `id_view` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Views del post';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`id_follow`),
  ADD KEY `user_follow_FK` (`user_id`),
  ADD KEY `user_following_FK` (`user_id_following`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id_like`),
  ADD KEY `post_likes_FK` (`id_post`),
  ADD KEY `user_likes_FK` (`id_user`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `logs_user_FK` (`user_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `posts_users_FK` (`post_user_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id_tags`),
  ADD KEY `post_tags_FK` (`tags_post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`id_view`),
  ADD KEY `post_views_FK` (`post_id`),
  ADD KEY `user_views_FK` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `follows`
--
ALTER TABLE `follows`
  MODIFY `id_follow` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id_like` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=254;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id_tags` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `views`
--
ALTER TABLE `views`
  MODIFY `id_view` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `follows`
--
ALTER TABLE `follows`
  ADD CONSTRAINT `user_follow_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_following_FK` FOREIGN KEY (`user_id_following`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `post_likes_FK` FOREIGN KEY (`id_post`) REFERENCES `posts` (`id_post`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_likes_FK` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_user_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_users_FK` FOREIGN KEY (`post_user_id`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tags`
--
ALTER TABLE `tags`
  ADD CONSTRAINT `post_tags_FK` FOREIGN KEY (`tags_post_id`) REFERENCES `posts` (`id_post`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `views`
--
ALTER TABLE `views`
  ADD CONSTRAINT `post_views_FK` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id_post`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_views_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
