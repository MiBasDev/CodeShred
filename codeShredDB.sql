-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 06, 2024 at 11:15 PM
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
(5, 8, 78),
(43, 5, 80),
(43, 8, 81),
(5, 43, 82),
(8, 5, 92),
(8, 43, 93);

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
(58, 5, 74),
(59, 5, 83);

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
(253, 'like', 'El usuario Miguel ha dado like al post con ID 28.', '2024-05-01 21:19:30', 5),
(254, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-05-02 18:40:39', 5),
(255, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-05-02 18:46:27', 5),
(256, 'like', 'El usuario Miguel ha dado like al post con ID 22.', '2024-05-02 18:46:32', 5),
(257, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 22.', '2024-05-02 18:46:33', 5),
(258, 'like', 'El usuario Miguel ha dado like al post con ID 22.', '2024-05-02 18:46:34', 5),
(259, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 22.', '2024-05-02 18:46:35', 5),
(260, 'unfollow', 'El usuario Miguel ha dejado de seguir a Gala.', '2024-05-02 18:46:38', 5),
(261, 'follow', 'El usuario Miguel ha seguido a Gala.', '2024-05-02 18:46:39', 5),
(262, 'unfollow', 'El usuario Miguel ha dejado de seguir a Gala.', '2024-05-02 18:46:40', 5),
(263, 'follow', 'El usuario Miguel ha seguido a Gala.', '2024-05-02 18:46:41', 5),
(264, 'insert', 'Nuevo post de Miguel añadido: qeqeqeq', '2024-05-02 18:47:00', 5),
(265, 'deleted', 'El usuario Miguel ha borrado al post con ID 37.', '2024-05-02 18:47:12', 5),
(266, 'unfollow', 'El usuario Miguel ha dejado de seguir a Jorgito69.', '2024-05-02 18:47:20', 5),
(267, 'follow', 'El usuario Miguel ha seguido a Jorgito69.', '2024-05-02 18:47:21', 5),
(268, 'updated', 'El usuario Miguel ha actualizado su descripción.', '2024-05-02 19:00:51', 5),
(269, 'updated', 'El usuario Miguel ha actualizado su descripción.', '2024-05-02 19:00:58', 5),
(270, 'insert', 'Nuevo post de Miguel añadido: qeqeq', '2024-05-02 19:15:33', 5),
(271, 'deleted', 'El usuario Miguel ha borrado al post con ID 38.', '2024-05-02 19:15:38', 5),
(272, 'like', 'El usuario Miguel ha dado like al post con ID 22.', '2024-05-02 19:21:20', 5),
(273, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 22.', '2024-05-02 19:35:01', 5),
(274, 'like', 'El usuario Miguel ha dado like al post con ID 22.', '2024-05-02 19:35:02', 5),
(275, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 22.', '2024-05-02 19:35:03', 5),
(276, 'like', 'El usuario Miguel ha dado like al post con ID 22.', '2024-05-02 19:35:08', 5),
(277, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 22.', '2024-05-02 19:38:54', 5),
(278, 'unfollow', 'El usuario Miguel ha dejado de seguir a Gala.', '2024-05-02 19:38:56', 5),
(279, 'like', 'El usuario Miguel ha dado like al post con ID 22.', '2024-05-02 19:38:57', 5),
(280, 'follow', 'El usuario Miguel ha seguido a Gala.', '2024-05-02 19:38:58', 5),
(281, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 22.', '2024-05-02 19:40:14', 5),
(282, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 28.', '2024-05-02 19:40:14', 5),
(283, 'unfollow', 'El usuario Miguel ha dejado de seguir a Jorgito69.', '2024-05-02 19:40:49', 5),
(284, 'unfollow', 'El usuario Miguel ha dejado de seguir a Gala.', '2024-05-02 19:40:49', 5),
(285, 'follow', 'El usuario Miguel ha seguido a Jorgito69.', '2024-05-02 19:43:22', 5),
(286, 'unfollow', 'El usuario Miguel ha dejado de seguir a Jorgito69.', '2024-05-02 19:43:23', 5),
(287, 'follow', 'El usuario Miguel ha seguido a Gala.', '2024-05-02 19:43:24', 5),
(288, 'follow', 'El usuario Miguel ha seguido a Jorgito69.', '2024-05-02 19:43:25', 5),
(289, 'like', 'El usuario Miguel ha dado like al post con ID 22.', '2024-05-02 19:43:35', 5),
(290, 'like', 'El usuario Miguel ha dado like al post con ID 28.', '2024-05-02 19:43:35', 5),
(291, 'like', 'El usuario Miguel ha dado like al post con ID 21.', '2024-05-02 19:43:36', 5),
(292, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 21.', '2024-05-02 19:45:27', 5),
(293, 'like', 'El usuario Miguel ha dado like al post con ID 21.', '2024-05-02 19:45:29', 5),
(294, 'registro', 'El usuario Jorge se ha registrado en el sistema.', '2024-05-02 19:48:40', 43),
(295, 'login', 'El usuario \'Jorge\' accede al sistema.', '2024-05-02 19:48:50', 43),
(296, 'follow', 'El usuario Jorge ha seguido a Miguel.', '2024-05-02 19:48:55', 43),
(297, 'follow', 'El usuario Jorge ha seguido a Gala.', '2024-05-02 19:48:56', 43),
(298, 'like', 'El usuario Jorge ha dado like al post con ID 28.', '2024-05-02 19:49:23', 43),
(299, 'like', 'El usuario Jorge ha dado like al post con ID 1.', '2024-05-02 19:49:24', 43),
(300, 'like', 'El usuario Jorge ha dado like al post con ID 22.', '2024-05-02 19:49:25', 43),
(301, 'like', 'El usuario Jorge ha dado like al post con ID 21.', '2024-05-02 19:49:26', 43),
(302, 'like', 'El usuario Jorge ha dado like al post con ID 20.', '2024-05-02 19:49:27', 43),
(303, 'unlike', 'El usuario Jorge ha quitado el like al post con ID 20.', '2024-05-02 19:51:23', 43),
(304, 'like', 'El usuario Jorge ha dado like al post con ID 20.', '2024-05-02 19:51:24', 43),
(305, 'insert', 'Nuevo post de Jorge añadido: qweqweqe', '2024-05-02 19:53:01', 43),
(306, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-05-02 19:58:21', 5),
(307, 'follow', 'El usuario Miguel ha seguido a Jorge.', '2024-05-02 20:00:59', 5),
(308, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-05-03 18:54:02', 5),
(309, 'insert', 'Nuevo post de Miguel añadido: ewqeqeq', '2024-05-03 19:54:28', 5),
(310, 'insert', 'Nuevo post de Miguel añadido: eqeqe', '2024-05-03 19:54:32', 5),
(311, 'deleted', 'El usuario Miguel ha borrado al post con ID 41.', '2024-05-03 19:54:45', 5),
(312, 'deleted', 'El usuario Miguel ha borrado al post con ID 40.', '2024-05-03 19:55:18', 5),
(313, 'insert', 'Nuevo post de Miguel añadido: ewqewqe', '2024-05-03 19:56:34', 5),
(314, 'deleted', 'El usuario Miguel ha borrado al post con ID 42.', '2024-05-03 19:58:52', 5),
(315, 'insert', 'Nuevo post de Miguel añadido: qeqe', '2024-05-03 20:00:46', 5),
(316, 'insert', 'Nuevo post de Miguel añadido: ', '2024-05-03 20:00:48', 5),
(317, 'insert', 'Nuevo post de Miguel añadido: ', '2024-05-03 20:00:51', 5),
(318, 'deleted', 'El usuario Miguel ha borrado al post con ID 45.', '2024-05-03 20:00:57', 5),
(319, 'deleted', 'El usuario Miguel ha borrado al post con ID 44.', '2024-05-03 20:01:10', 5),
(320, 'deleted', 'El usuario Miguel ha borrado al post con ID 43.', '2024-05-03 20:01:24', 5),
(321, 'insert', 'Nuevo post de Miguel añadido: ', '2024-05-03 20:01:32', 5),
(322, 'insert', 'Nuevo post de Miguel añadido: ', '2024-05-03 20:01:38', 5),
(323, 'deleted', 'El usuario Miguel ha borrado al post con ID 47.', '2024-05-03 20:01:41', 5),
(324, 'deleted', 'El usuario Miguel ha borrado al post con ID 46.', '2024-05-03 20:01:43', 5),
(325, 'insert', 'Nuevo post de Miguel añadido: ', '2024-05-03 20:02:06', 5),
(326, 'insert', 'Nuevo post de Miguel añadido: ', '2024-05-03 20:02:08', 5),
(327, 'deleted', 'El usuario Miguel ha borrado al post con ID 49.', '2024-05-03 20:03:27', 5),
(328, 'deleted', 'El usuario Miguel ha borrado al post con ID 48.', '2024-05-03 20:04:21', 5),
(329, 'insert', 'Nuevo post de Miguel añadido: ', '2024-05-03 20:04:29', 5),
(330, 'insert', 'Nuevo post de Miguel añadido: ', '2024-05-03 20:04:31', 5),
(331, 'insert', 'Nuevo post de Miguel añadido: ', '2024-05-03 20:04:33', 5),
(332, 'deleted', 'El usuario Miguel ha borrado al post con ID 52.', '2024-05-03 20:04:37', 5),
(333, 'deleted', 'El usuario Miguel ha borrado al post con ID 51.', '2024-05-03 20:04:58', 5),
(334, 'deleted', 'El usuario Miguel ha borrado al post con ID 50.', '2024-05-03 20:05:01', 5),
(335, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-05-03 20:33:27', 5),
(336, 'updated', 'El usuario Miguel ha actualizado su descripción.', '2024-05-03 20:33:49', 5),
(337, 'insert', 'Nuevo post de Miguel añadido: qeqeq', '2024-05-03 20:33:58', 5),
(338, 'deleted', 'El usuario Miguel ha borrado al post con ID 53.', '2024-05-03 20:34:05', 5),
(339, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-05-04 17:22:45', 5),
(340, 'login', 'El usuario \'Admin\' accede al sistema.', '2024-05-04 17:22:54', 6),
(341, 'unfollow', 'El usuario Admin ha dejado de seguir a Miguel.', '2024-05-04 17:51:04', 6),
(342, 'unfollow', 'El usuario Admin ha dejado de seguir a Miguel.', '2024-05-04 17:51:05', 6),
(343, 'unfollow', 'El usuario Admin ha dejado de seguir a Miguel.', '2024-05-04 17:51:06', 6),
(344, 'unfollow', 'El usuario Admin ha dejado de seguir a Miguel.', '2024-05-04 17:51:07', 6),
(345, 'deleted', 'El usuario Admin ha borrado al post con ID 39.', '2024-05-04 17:56:38', 6),
(346, 'insert', 'Nuevo post de Admin añadido: qeqeq', '2024-05-04 18:31:08', 6),
(347, 'deleted', 'El usuario Admin ha borrado al post con ID 28.', '2024-05-04 18:48:41', 6),
(348, 'deleted', 'El usuario Admin ha borrado al post con ID 22.', '2024-05-04 18:48:43', 6),
(349, 'deleted', 'El usuario Admin ha borrado al post con ID 21.', '2024-05-04 18:48:44', 6),
(350, 'deleted', 'El usuario Admin ha borrado al post con ID 20.', '2024-05-04 18:48:45', 6),
(351, 'deleted', 'El usuario Admin ha borrado al post con ID 1.', '2024-05-04 18:48:47', 6),
(352, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-05-04 18:48:56', 5),
(353, 'insert', 'Nuevo post de Miguel añadido: Lume Image Carousel', '2024-05-04 18:50:06', 5),
(354, 'insert', 'Nuevo post de Miguel añadido: CSS Only Shimmer Button', '2024-05-04 18:50:48', 5),
(355, 'insert', 'Nuevo post de Miguel añadido: Animated Login Form - CSS', '2024-05-04 18:51:37', 5),
(356, 'login', 'El usuario \'Gala\' accede al sistema.', '2024-05-04 18:53:08', 8),
(357, 'insert', 'Nuevo post de Gala añadido: Shimmering animated border gradient effect in CSS', '2024-05-04 18:53:42', 8),
(358, 'insert', 'Nuevo post de Gala añadido: Poppin\' text', '2024-05-04 18:54:43', 8),
(359, 'unfollow', 'El usuario Gala ha dejado de seguir a Miguel.', '2024-05-04 19:09:01', 8),
(360, 'unfollow', 'El usuario Gala ha dejado de seguir a Miguel.', '2024-05-04 19:09:02', 8),
(361, 'unfollow', 'El usuario Gala ha dejado de seguir a Miguel.', '2024-05-04 19:09:04', 8),
(362, 'unfollow', 'El usuario Gala ha dejado de seguir a Miguel.', '2024-05-04 19:09:05', 8),
(363, 'unfollow', 'El usuario Gala ha dejado de seguir a Miguel.', '2024-05-04 19:09:05', 8),
(364, 'unfollow', 'El usuario Gala ha dejado de seguir a Miguel.', '2024-05-04 19:09:06', 8),
(365, 'unfollow', 'El usuario Gala ha dejado de seguir a Miguel.', '2024-05-04 19:09:11', 8),
(366, 'unfollow', 'El usuario Gala ha dejado de seguir a Miguel.', '2024-05-04 19:10:51', 8),
(367, 'unfollow', 'El usuario Gala ha dejado de seguir a Miguel.', '2024-05-04 19:10:52', 8),
(368, 'unfollow', 'El usuario Gala ha dejado de seguir a Miguel.', '2024-05-04 19:10:52', 8),
(369, 'unfollow', 'El usuario Gala ha dejado de seguir a Miguel.', '2024-05-04 19:10:52', 8),
(370, 'unfollow', 'El usuario Gala ha dejado de seguir a Miguel.', '2024-05-04 19:10:52', 8),
(371, 'unfollow', 'El usuario Gala ha dejado de seguir a Miguel.', '2024-05-04 19:11:43', 8),
(372, 'unfollow', 'El usuario Gala ha dejado de seguir a Miguel.', '2024-05-04 19:12:10', 8),
(373, 'unfollow', 'El usuario Gala ha dejado de seguir a Miguel.', '2024-05-04 19:12:26', 8),
(374, 'unfollow', 'El usuario Gala ha dejado de seguir a Miguel.', '2024-05-04 19:12:59', 8),
(375, 'unfollow', 'El usuario Gala ha dejado de seguir a Miguel.', '2024-05-04 19:15:11', 8),
(376, 'unfollow', 'El usuario Gala ha dejado de seguir a Miguel.', '2024-05-04 19:15:13', 8),
(377, 'unfollow', 'El usuario Gala ha dejado de seguir a Miguel.', '2024-05-04 19:15:37', 8),
(378, 'unfollow', 'El usuario Gala ha dejado de seguir a Miguel.', '2024-05-04 19:15:37', 8),
(379, 'unfollow', 'El usuario Gala ha dejado de seguir a Miguel.', '2024-05-04 19:16:29', 8),
(380, 'unfollow', 'El usuario Gala ha dejado de seguir a Miguel.', '2024-05-04 19:16:32', 8),
(381, 'unfollow', 'El usuario Gala ha dejado de seguir a Miguel.', '2024-05-04 19:16:33', 8),
(382, 'unfollow', 'El usuario Gala ha dejado de seguir a Miguel.', '2024-05-04 19:16:35', 8),
(383, 'unfollow', 'El usuario Gala ha dejado de seguir a Miguel.', '2024-05-04 19:17:03', 8),
(384, 'unfollow', 'El usuario Gala ha dejado de seguir a Miguel.', '2024-05-04 19:17:11', 8),
(385, 'unfollow', 'El usuario Gala ha dejado de seguir a Miguel.', '2024-05-04 19:17:12', 8),
(386, 'unfollow', 'El usuario Gala ha dejado de seguir a Miguel.', '2024-05-04 19:17:12', 8),
(387, 'follow', 'El usuario Gala ha seguido a Miguel.', '2024-05-04 19:18:48', 8),
(388, 'unfollow', 'El usuario Gala ha dejado de seguir a Miguel.', '2024-05-04 19:18:49', 8),
(389, 'follow', 'El usuario Gala ha seguido a Miguel.', '2024-05-04 19:18:50', 8),
(390, 'unfollow', 'El usuario Gala ha dejado de seguir a Miguel.', '2024-05-04 19:18:51', 8),
(391, 'follow', 'El usuario Gala ha seguido a Miguel.', '2024-05-04 19:19:24', 8),
(392, 'unfollow', 'El usuario Gala ha dejado de seguir a Miguel.', '2024-05-04 19:19:25', 8),
(393, 'follow', 'El usuario Gala ha seguido a Miguel.', '2024-05-04 19:19:27', 8),
(394, 'unfollow', 'El usuario Gala ha dejado de seguir a Miguel.', '2024-05-04 19:19:29', 8),
(395, 'follow', 'El usuario Gala ha seguido a Miguel.', '2024-05-04 19:19:30', 8),
(396, 'follow', 'El usuario Gala ha seguido a Jorge.', '2024-05-04 19:19:31', 8),
(397, 'login', 'El usuario \'Admin\' accede al sistema.', '2024-05-04 19:27:11', 6),
(398, 'registro', 'El usuario Mod se ha registrado en el sistema.', '2024-05-04 19:41:35', 44),
(399, 'login', 'El usuario \'Mod\' accede al sistema.', '2024-05-04 19:42:14', 44),
(400, 'login', 'El usuario \'Admin\' accede al sistema.', '2024-05-04 19:45:07', 6),
(401, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-05-04 20:09:40', 5),
(402, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 59.', '2024-05-04 20:13:48', 5),
(403, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 59.', '2024-05-04 20:13:50', 5),
(404, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 59.', '2024-05-04 20:13:51', 5),
(405, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 59.', '2024-05-04 20:13:51', 5),
(406, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 59.', '2024-05-04 20:13:51', 5),
(407, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 59.', '2024-05-04 20:13:51', 5),
(408, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 59.', '2024-05-04 20:13:55', 5),
(409, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 58.', '2024-05-04 20:13:58', 5),
(410, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 59.', '2024-05-04 20:13:59', 5),
(411, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 59.', '2024-05-04 20:14:03', 5),
(412, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 59.', '2024-05-04 20:14:07', 5),
(413, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 59.', '2024-05-04 20:21:39', 5),
(414, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 59.', '2024-05-04 20:22:10', 5),
(415, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 59.', '2024-05-04 20:22:11', 5),
(416, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 59.', '2024-05-04 20:22:12', 5),
(417, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 59.', '2024-05-04 20:22:19', 5),
(418, 'like', 'El usuario Miguel ha dado like al post con ID 59.', '2024-05-04 20:24:05', 5),
(419, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 59.', '2024-05-04 20:24:06', 5),
(420, 'like', 'El usuario Miguel ha dado like al post con ID 58.', '2024-05-04 20:24:07', 5),
(421, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 58.', '2024-05-04 20:24:08', 5),
(422, 'like', 'El usuario Miguel ha dado like al post con ID 59.', '2024-05-04 20:24:09', 5),
(423, 'like', 'El usuario Miguel ha dado like al post con ID 58.', '2024-05-04 20:25:16', 5),
(424, 'like', 'El usuario Miguel ha dado like al post con ID 54.', '2024-05-04 20:27:16', 5),
(425, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 54.', '2024-05-04 20:27:18', 5),
(426, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-05-05 08:07:19', 5),
(427, 'login', 'El usuario \'Gala\' accede al sistema.', '2024-05-05 08:18:33', 8),
(428, 'like', 'El usuario Gala ha dado like al post con ID 56.', '2024-05-05 08:18:40', 8),
(429, 'login', 'El usuario \'Gala\' accede al sistema.', '2024-05-05 08:25:24', 8),
(430, 'login', 'El usuario \'Admin\' accede al sistema.', '2024-05-05 08:25:53', 6),
(431, 'login', 'El usuario \'Gala\' accede al sistema.', '2024-05-05 08:26:28', 8),
(432, 'unlike', 'El usuario Gala ha quitado el like al post con ID 56.', '2024-05-05 08:28:13', 8),
(433, 'like', 'El usuario Gala ha dado like al post con ID 56.', '2024-05-05 08:28:16', 8),
(434, 'unlike', 'El usuario Gala ha quitado el like al post con ID 56.', '2024-05-05 08:28:28', 8),
(435, 'like', 'El usuario Gala ha dado like al post con ID 56.', '2024-05-05 08:28:32', 8),
(436, 'unlike', 'El usuario Gala ha quitado el like al post con ID 56.', '2024-05-05 08:29:06', 8),
(437, 'like', 'El usuario Gala ha dado like al post con ID 56.', '2024-05-05 08:29:08', 8),
(438, 'unlike', 'El usuario Gala ha quitado el like al post con ID 56.', '2024-05-05 08:29:09', 8),
(439, 'like', 'El usuario Gala ha dado like al post con ID 56.', '2024-05-05 08:29:29', 8),
(440, 'unlike', 'El usuario Gala ha quitado el like al post con ID 56.', '2024-05-05 08:29:31', 8),
(441, 'like', 'El usuario Gala ha dado like al post con ID 56.', '2024-05-05 08:29:32', 8),
(442, 'unlike', 'El usuario Gala ha quitado el like al post con ID 56.', '2024-05-05 08:29:41', 8),
(443, 'like', 'El usuario Gala ha dado like al post con ID 57.', '2024-05-05 08:29:46', 8),
(444, 'unlike', 'El usuario Gala ha quitado el like al post con ID 57.', '2024-05-05 08:29:47', 8),
(445, 'like', 'El usuario Gala ha dado like al post con ID 55.', '2024-05-05 08:29:49', 8),
(446, 'unlike', 'El usuario Gala ha quitado el like al post con ID 55.', '2024-05-05 08:29:50', 8),
(447, 'like', 'El usuario Gala ha dado like al post con ID 56.', '2024-05-05 08:29:51', 8),
(448, 'unlike', 'El usuario Gala ha quitado el like al post con ID 56.', '2024-05-05 08:29:52', 8),
(449, 'like', 'El usuario Gala ha dado like al post con ID 56.', '2024-05-05 08:29:53', 8),
(450, 'unlike', 'El usuario Gala ha quitado el like al post con ID 56.', '2024-05-05 08:29:55', 8),
(451, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-05-05 08:54:07', 5),
(452, 'insert', 'Nuevo post de Miguel añadido: qeqe', '2024-05-05 09:01:21', 5),
(453, 'deleted', 'El usuario Miguel ha borrado al post con ID 60.', '2024-05-05 09:01:30', 5),
(454, 'updated', 'El usuario Miguel ha actualizado su descripción.', '2024-05-05 09:40:33', 5),
(455, 'updated', 'El usuario Miguel ha actualizado su descripción.', '2024-05-05 09:40:36', 5),
(456, 'updated', 'El usuario Miguel ha actualizado su descripción.', '2024-05-05 09:40:41', 5),
(457, 'login', 'El usuario \'Admin\' accede al sistema.', '2024-05-05 09:40:51', 6),
(458, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-05-05 10:32:32', 5),
(459, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-05-05 18:29:59', 5),
(460, 'insert', 'Nuevo post de Miguel añadido: prueba', '2024-05-05 19:11:23', 5),
(461, 'insert', 'Nuevo post de Miguel añadido: ', '2024-05-05 19:14:16', 5),
(462, 'insert', 'Nuevo post de Miguel añadido: Responsive Image Carousel ( Animation )', '2024-05-05 19:48:49', 5),
(463, 'update', 'Post de Miguel actualizado: Responsive Image Carousel ( Animation )', '2024-05-05 20:16:22', 5),
(464, 'update', 'Post de Miguel actualizado: prueba', '2024-05-05 20:38:30', 5),
(465, 'update', 'Post de Miguel actualizado: Animated Login Form - CSS', '2024-05-05 20:39:23', 5),
(466, 'update', 'Post de Miguel actualizado: CSS Only Shimmer Button', '2024-05-05 20:41:23', 5),
(467, 'update', 'Post de Miguel actualizado: 5-card carousel', '2024-05-05 20:44:16', 5),
(468, 'update', 'Post de Miguel actualizado: CodePen Home Poppin\' text', '2024-05-05 20:45:10', 5),
(469, 'login', 'El usuario \'Gala\' accede al sistema.', '2024-05-05 20:46:13', 8),
(470, 'update', 'Post de Gala actualizado: Neumorphic buttons', '2024-05-05 20:47:06', 8),
(471, 'update', 'Post de Gala actualizado: Always great grid - CSS grid + :has() + view transitions', '2024-05-05 20:48:04', 8),
(472, 'login', 'El usuario \'Admin\' accede al sistema.', '2024-05-05 20:50:44', 6),
(474, 'login', 'El usuario \'Admin\' accede al sistema.', '2024-05-05 21:19:03', 6),
(475, 'deleted', 'El usuario Admin ha borrado al ususario con ID .', '2024-05-05 21:24:42', 6),
(477, 'login', 'El usuario \'Admin\' accede al sistema.', '2024-05-05 21:25:47', 6),
(478, 'deleted', 'El usuario Admin ha borrado al ususario con ID 46.', '2024-05-05 21:25:54', 6),
(481, 'login', 'El usuario \'Admin\' accede al sistema.', '2024-05-05 21:27:09', 6),
(482, 'deleted', 'El usuario Admin ha borrado al ususario con ID 47.', '2024-05-05 21:27:15', 6),
(483, 'login', 'El usuario \'Admin\' accede al sistema.', '2024-05-05 21:27:28', 6),
(484, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-05-05 21:27:59', 5),
(485, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-05-06 17:59:30', 5),
(486, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 58.', '2024-05-06 18:05:42', 5),
(487, 'like', 'El usuario Miguel ha dado like al post con ID 58.', '2024-05-06 18:05:44', 5),
(488, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 59.', '2024-05-06 18:05:47', 5),
(489, 'like', 'El usuario Miguel ha dado like al post con ID 59.', '2024-05-06 18:05:52', 5),
(490, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 59.', '2024-05-06 18:07:18', 5),
(491, 'like', 'El usuario Miguel ha dado like al post con ID 59.', '2024-05-06 18:07:21', 5),
(492, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 59.', '2024-05-06 18:09:47', 5),
(493, 'like', 'El usuario Miguel ha dado like al post con ID 59.', '2024-05-06 18:09:51', 5),
(494, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-05-06 20:05:15', 5),
(495, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 59.', '2024-05-06 20:13:24', 5),
(496, 'like', 'El usuario Miguel ha dado like al post con ID 59.', '2024-05-06 20:13:28', 5),
(497, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 59.', '2024-05-06 20:13:50', 5),
(498, 'like', 'El usuario Miguel ha dado like al post con ID 59.', '2024-05-06 20:13:51', 5),
(499, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 59.', '2024-05-06 20:13:52', 5),
(500, 'like', 'El usuario Miguel ha dado like al post con ID 59.', '2024-05-06 20:13:52', 5),
(501, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 59.', '2024-05-06 20:13:52', 5),
(502, 'like', 'El usuario Miguel ha dado like al post con ID 59.', '2024-05-06 20:13:53', 5),
(503, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 59.', '2024-05-06 20:13:53', 5),
(504, 'like', 'El usuario Miguel ha dado like al post con ID 59.', '2024-05-06 20:13:53', 5),
(505, 'unlike', 'El usuario Miguel ha quitado el like al post con ID 59.', '2024-05-06 20:13:54', 5),
(506, 'like', 'El usuario Miguel ha dado like al post con ID 59.', '2024-05-06 20:13:55', 5),
(509, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-05-06 20:40:03', 5),
(510, 'updated', 'El usuario Miguel ha actualizado su descripción.', '2024-05-06 20:41:20', 5),
(511, 'updated', 'El usuario Miguel ha actualizado su descripción.', '2024-05-06 20:42:47', 5),
(512, 'updated', 'El usuario Miguel ha actualizado su descripción.', '2024-05-06 20:47:37', 5);

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
(54, '{\"html\":\"eqwe\",\"css\":\"qeqe\",\"js\":\"qeqe\"}', '-', 6, 'qeqeq'),
(55, '{\"html\":\"<div class=\'cards-wrapper\'>\\r\\n  <div class=\'cards\'>\\r\\n    <button class=\'card card1\' tabindex=\\\"-1\\\">\\r\\n      <div class=\\\"icon\\\">\\r\\n        <svg xmlns=\\\"http:\\/\\/www.w3.org\\/2000\\/svg\\\" viewBox=\\\"0 0 512 200\\\">\\r\\n    <path d=\\\"M208 80c0-26.5 21.5-48 48-48h64c26.5 0 48 21.5 48 48v64c0 26.5-21.5 48-48 48h-8v40h152c30.9 0 56 25.1 56 56v32h8c26.5 0 48 21.5 48 48v64c0 26.5-21.5 48-48 48h-64c-26.5 0-48-21.5-48-48v-64c0-26.5 21.5-48 48-48h8v-32c0-4.4-3.6-8-8-8H312v40h8c26.5 0 48 21.5 48 48v64c0 26.5-21.5 48-48 48h-64c-26.5 0-48-21.5-48-48v-64c0-26.5 21.5-48 48-48h8v-40H112c-4.4 0-8 3.6-8 8v32h8c26.5 0 48 21.5 48 48v64c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48v-64c0-26.5 21.5-48 48-48h8v-32c0-30.9 25.1-56 56-56h152v-40h-8c-26.5 0-48-21.5-48-48V80z\\\"\\/>\\r\\n  <\\/svg>\\r\\n      <\\/div>\\r\\n      <h2>Card 1<\\/h2>\\r\\n      <h4>Lorem<\\/h4>    \\r\\n    <\\/button>\\r\\n\\r\\n    <button class=\'card card2\' tabindex=\\\"-1\\\">\\r\\n      <div class=\\\"icon\\\">\\r\\n        <svg xmlns=\\\"http:\\/\\/www.w3.org\\/2000\\/svg\\\" viewBox=\\\"0 0 512 200\\\">\\r\\n  <path d=\\\"M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2s-6.3 25.5 4.1 33.7l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7L477.4 348.9c1.7-9.4 2.6-19 2.6-28.9h64c17.7 0 32-14.3 32-32s-14.3-32-32-32h-64.3c-1.1-14.1-5-27.5-11.1-39.5.7-.6 1.4-1.2 2.1-1.9l64-64c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-64 64c-.7.7-1.3 1.4-1.9 2.1-14.3-7.3-30.4-11.4-47.5-11.4H264c-8.3 0-16.3 1-24 2.8L38.8 5.1zM320 0c-53 0-96 43-96 96v3.6c0 15.7 12.7 28.4 28.4 28.4h135.2c15.7 0 28.4-12.7 28.4-28.4V96c0-53-43-96-96-96zM160.3 256H96c-17.7 0-32 14.3-32 32s14.3 32 32 32h64c0 24.6 5.5 47.8 15.4 68.6-2.2 1.3-4.2 2.9-6 4.8l-64 64c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l63.1-63.1a159.2 159.2 0 0 0 90.3 39.6V335.5L166.7 227.3c-3.4 9-5.6 18.7-6.4 28.7zM336 479.2c36.6-3.6 69.7-19.6 94.8-43.8L336 360.7v118.5z\\\"\\/>\\r\\n<\\/svg>\\r\\n      <\\/div>\\r\\n      <h2>Card 2<\\/h2>\\r\\n      <h4>Ipsum<\\/h4>    \\r\\n    <\\/button>\\r\\n\\r\\n    <button class=\'card card3\' tabindex=\\\"-1\\\">\\r\\n      <div class=\\\"icon\\\">\\r\\n        <svg xmlns=\\\"http:\\/\\/www.w3.org\\/2000\\/svg\\\" viewBox=\\\"0 0 512 200\\\">\\r\\n  <path d=\\\"M308.5 135.3a22 22 0 0 0 6.2-25 171 171 0 0 0-7.6-15.5l-3.1-5.4c-3-5-6.3-9.9-9.8-14.6a22 22 0 0 0-24.7-7.1L241.3 77c-10.7-8.8-23-16-36.2-20.9l-6.1-29a21.9 21.9 0 0 0-18.5-17.8c-6.6-.9-13.3-1.3-20.1-1.3h-.7c-6.8 0-13.5.4-20.1 1.2A22 22 0 0 0 121.1 27L115 56.1c-13.3 5-25.5 12.1-36.2 20.9l-28.3-9.2c-9-3-19-.5-24.7 7.1-3.5 4.7-6.8 9.6-9.9 14.6l-3 5.3c-2.8 5-5.3 10.2-7.6 15.6a22.1 22.1 0 0 0 6.2 25l22.2 19.8a128.8 128.8 0 0 0 0 41.7l-22.2 19.8a22 22 0 0 0-6.2 25 187 187 0 0 0 7.6 15.6l3 5.2c3 5.1 6.3 9.9 9.9 14.6a22 22 0 0 0 24.7 7.1l28.2-9.3c10.7 8.8 23 16 36.2 20.9l6.1 29.1a21.9 21.9 0 0 0 18.5 17.8 172 172 0 0 0 40.8 0 22 22 0 0 0 18.5-17.8l6.1-29.1c13.3-5 25.5-12.1 36.2-20.9l28.2 9.3c9 3 19 .5 24.7-7.1 3.5-4.7 6.8-9.5 9.8-14.6l3.1-5.4a171 171 0 0 0 7.6-15.5c3.7-8.7.9-18.6-6.2-25l-22.2-19.8a131 131 0 0 0 0-41.8l22.2-19.8zM112 176a48 48 0 1 1 96 0 48 48 0 1 1-96 0zm392.7 324.5a22 22 0 0 0 25 6.2 171 171 0 0 0 15.5-7.6l5.4-3.1c5-3 9.9-6.3 14.6-9.8a22 22 0 0 0 7.1-24.7l-9.3-28.2c8.8-10.7 16-23 20.9-36.2L613 391a21.9 21.9 0 0 0 17.8-18.5 172 172 0 0 0 0-40.8 22 22 0 0 0-17.8-18.5l-29.1-6.2c-5-13.3-12.1-25.5-20.9-36.2l9.3-28.2c3-9 .5-19-7.1-24.7-4.7-3.5-9.6-6.8-14.6-9.9l-5.3-3c-5-2.8-10.2-5.3-15.6-7.6a22.1 22.1 0 0 0-25 6.2l-19.8 22.2a131 131 0 0 0-41.8 0l-19.8-22.2a22 22 0 0 0-25-6.2 187 187 0 0 0-15.6 7.6l-5.2 3a144 144 0 0 0-14.6 9.9 22 22 0 0 0-7.1 24.7l9.3 28.2c-8.8 10.7-16 23-20.9 36.2l-29.1 6a21.9 21.9 0 0 0-17.8 18.5 172 172 0 0 0 0 40.8 22 22 0 0 0 17.8 18.5l29.1 6.1c5 13.3 12.1 25.5 20.9 36.2l-9.3 28.2c-3 9-.5 19 7.1 24.7 4.7 3.5 9.5 6.8 14.6 9.8l5.4 3.1a171 171 0 0 0 15.5 7.6c8.7 3.7 18.6.9 25-6.2l19.8-22.2a131 131 0 0 0 41.8 0l19.8 22.2zM464 304a48 48 0 1 1 0 96 48 48 0 1 1 0-96z\\\"\\/>\\r\\n<\\/svg>\\r\\n      <\\/div>\\r\\n      <h2>Card 3<\\/h2>\\r\\n      <h4>dolor<\\/h4>    \\r\\n    <\\/button>\\r\\n\\r\\n    <button class=\'card card4\' tabindex=\\\"-1\\\">\\r\\n      <div class=\\\"icon\\\">\\r\\n        <svg xmlns=\\\"http:\\/\\/www.w3.org\\/2000\\/svg\\\" viewBox=\\\"0 0 512 200\\\">\\r\\n  <path d=\\\"M176 24a24 24 0 1 0-48 0v40a64 64 0 0 0-64 64H24a24 24 0 1 0 0 48h40v56H24a24 24 0 1 0 0 48h40v56H24a24 24 0 1 0 0 48h40a64 64 0 0 0 64 64v40a24 24 0 1 0 48 0v-40h56v40a24 24 0 1 0 48 0v-40h56v40a24 24 0 1 0 48 0v-40a64 64 0 0 0 64-64h40a24 24 0 1 0 0-48h-40v-56h40a24 24 0 1 0 0-48h-40v-56h40a24 24 0 1 0 0-48h-40a64 64 0 0 0-64-64V24a24 24 0 1 0-48 0v40h-56V24a24 24 0 1 0-48 0v40h-56V24zm-16 104h192a32 32 0 0 1 32 32v192a32 32 0 0 1-32 32H160a32 32 0 0 1-32-32V160a32 32 0 0 1 32-32zm192 32H160v192h192V160z\\\"\\/>\\r\\n<\\/svg>\\r\\n      <\\/div>\\r\\n      <h2>Card 4<\\/h2>\\r\\n      <h4>sit amet<\\/h4>    \\r\\n    <\\/button>\\r\\n    \\r\\n    <button class=\'card card5\' tabindex=\\\"-1\\\">\\r\\n      <div class=\\\"icon\\\">\\r\\n        <svg xmlns=\\\"http:\\/\\/www.w3.org\\/2000\\/svg\\\" viewBox=\\\"0 0 512 200\\\">\\r\\n  <path d=\\\"M418.4 157.9A80 80 0 1 0 320 77.5l-183.8 73.6a80 80 0 1 0-22.1 129.3l145.6 127.4a80 80 0 1 0 120.9-42.2l37.8-207.7zm-262.1 74.3a78.3 78.3 0 0 0 3.7-21.7L343.8 137c3.6 3.5 7.4 6.7 11.6 9.5l-37.8 207.6a77.8 77.8 0 0 0-15.8 5.5L156.3 232.2z\\\"\\/>\\r\\n<\\/svg>\\r\\n      <\\/div>\\r\\n      <h2>Card 5<\\/h2>\\r\\n      <h4>consectetur<\\/h4>    \\r\\n    <\\/button>\\r\\n\\r\\n  <\\/div>\\r\\n  <button class=\\\"arrow-btn arrow-btn-prev\\\" tabindex=\\\"0\\\">\\r\\n    <svg viewBox=\\\"0 0 256 512\\\">\\r\\n      <path d=\\\"M31.7 239l136-136c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9L127.9 256l96.4 96.4c9.4 9.4 9.4 24.6 0 33.9L201.7 409c-9.4 9.4-24.6 9.4-33.9 0l-136-136c-9.5-9.4-9.5-24.6-.1-34z\\\" \\/>\\r\\n    <\\/svg>\\r\\n  <\\/button>\\r\\n  <button class=\\\"arrow-btn arrow-btn-next\\\" tabindex=\\\"0\\\">\\r\\n    <svg viewBox=\\\"0 0 256 512\\\">\\r\\n      <path d=\\\"M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34z\\\" \\/>\\r\\n    <\\/svg>\\r\\n  <\\/button>\\r\\n<\\/div>\",\"css\":\"@import url(\'https:\\/\\/fonts.googleapis.com\\/css2?family=Open+Sans:wght@300;700&display=swap\');\\r\\n\\r\\nhtml, body {\\r\\n  margin:0;\\r\\n  padding:0;\\r\\n  width:100%;\\r\\n  height:100%;\\r\\n}\\r\\n\\r\\nbody {\\r\\n  display:flex;\\r\\n  align-items:center;\\r\\n  justify-content:center;\\r\\n  flex-direction:column;\\r\\n  background:#eee;\\r\\n}\\r\\n\\r\\n.cards-wrapper {\\r\\n  width:100%;\\r\\n  height:300px;\\r\\n  max-width:1200px;\\r\\n  overflow-x:hidden;\\r\\n  position:relative;\\r\\n}\\r\\n\\r\\n.cards {\\r\\n  position:absolute;\\r\\n  top:15px;\\r\\n  left:50%;\\r\\n  transform:translateX(-110px);\\r\\n  display:flex;\\r\\n  flex-direction:row;\\r\\n  width:1300px;\\r\\n  justify-content:space-between;\\r\\n}\\r\\n\\r\\n.card {\\r\\n  width:220px;\\r\\n  height:260px;\\r\\n  border-radius:14px;\\r\\n  border:none;\\r\\n  font-family: \'Open Sans\', sans-serif;\\r\\n  letter-spacing:0.5px;\\r\\n  display:inline;\\r\\n  cursor:pointer;\\r\\n  box-sizing:border-box;\\r\\n  color:#000;\\r\\n}\\r\\n\\r\\n.card h2 {\\r\\n  font-size:2.6em;\\r\\n  font-weight:300;\\r\\n  margin-top:1.25em;\\r\\n}\\r\\n\\r\\n.card h4 {\\r\\n  text-transform:uppercase;\\r\\n}\\r\\n\\r\\n.icon svg {\\r\\n  overflow:visible;\\r\\n  stroke-width:1.25em;\\r\\n  width:3em;\\r\\n}\\r\\n\\r\\n.cards-wrapper::after {\\r\\n  content:\'\';\\r\\n  display:block;\\r\\n  position:absolute;\\r\\n  top:0;\\r\\n  width:100%;\\r\\n  max-width:1200px;\\r\\n  height:100%;\\r\\n  background:linear-gradient(90deg, #eee 0%, #ffffff00 30%, #ffffff00 70%, #eee 100%);\\r\\n  pointer-events:none;\\r\\n}\\r\\n\\r\\n.arrow-btn {\\r\\n  width:40px;\\r\\n  height:40px;\\r\\n  background:#fff;\\r\\n  border-radius:50%;\\r\\n  border:none;\\r\\n  box-shadow: 0 6px 8px #00000030;\\r\\n  position:absolute;\\r\\n  top:50%;\\r\\n  left:20px;\\r\\n  transform:translateY(-50%);\\r\\n  z-index:1000;\\r\\n  cursor:pointer;\\r\\n}\\r\\n\\r\\n.arrow-btn-next {\\r\\n  left:auto;\\r\\n  right:20px;\\r\\n}\\r\\n\\r\\n.arrow-btn svg {\\r\\n  fill:#333;\\r\\n  position:absolute;\\r\\n  height:80%;  \\r\\n  left:50%;\\r\\n  top:50%;\\r\\n  transform:translate(-60%,-50%);\\r\\n}\\r\\n\\r\\n.arrow-btn-next svg {\\r\\n  transform:translate(-40%,-50%);\\r\\n}\",\"js\":\"const arrowBtns = document.querySelectorAll(\'.arrow-btn\')\\r\\nconst cardBtns = document.querySelectorAll(\'.card\')\\r\\nlet currentCard = 2;\\r\\nlet dir = 1;\\r\\nmoveCards()\\r\\n\\r\\narrowBtns.forEach((btn,i)=>{\\r\\n  btn.onpointerenter = (e)=> gsap.to(btn, {\\r\\n    ease:\'expo\',\\r\\n    \'box-shadow\':\'0 3px 4px #00000050\'\\r\\n  })\\r\\n  \\r\\n  btn.onpointerleave = (e)=> gsap.to(btn, {\\r\\n    ease:\'expo\',\\r\\n    \'box-shadow\':\'0 6px 8px #00000030\'\\r\\n  })\\r\\n  \\r\\n  btn.onclick = (e)=> {\\r\\n    dir = (i==0)? 1:-1\\r\\n    if (i==0) {\\r\\n      currentCard--\\r\\n      currentCard = Math.max(0, currentCard)\\r\\n    }\\r\\n    else {\\r\\n      currentCard++\\r\\n      currentCard = Math.min(4, currentCard)\\r\\n    }\\r\\n    moveCards(0.75)\\r\\n  }\\r\\n})\\r\\n\\r\\ncardBtns.forEach((btn,i)=>{\\r\\n  btn.onpointerenter = (e)=> gsap.to(btn, {\\r\\n    ease:\'power3\',\\r\\n    overwrite:\'auto\',\\r\\n    \'box-shadow\':()=>(i==currentCard)?\'0 6px 11px #00000030\':\'0 6px 11px #00000030\'\\r\\n  })\\r\\n  \\r\\n  btn.onpointerleave = (e)=> gsap.to(btn, {\\r\\n    ease:\'power3\',\\r\\n    overwrite:\'auto\',\\r\\n    \'box-shadow\':()=>(i==currentCard)?\'0 6px 11px #00000030\':\'0 0px 0px #00000030\'\\r\\n  })\\r\\n\\r\\n  btn.onclick = (e)=> {\\r\\n    dir = (i<currentCard)? 1:-1\\r\\n    currentCard = i\\r\\n    moveCards(0.75)\\r\\n  }\\r\\n})\\r\\n\\r\\nfunction moveCards(dur=0){\\r\\n  gsap.timeline({defaults:{ duration:dur, ease:\'power3\', stagger:{each:-0.03*dir} }})\\r\\n    .to(\'.card\', {\\r\\n      x:-270*currentCard,\\r\\n      y:(i)=>(i==currentCard)?0:15,\\r\\n      height:(i)=>(i==currentCard)?270:240,\\r\\n      ease:\'elastic.out(0.4)\'\\r\\n    }, 0)\\r\\n    .to(\'.card\', {\\r\\n      cursor:(i)=>(i==currentCard)?\'default\':\'pointer\',\\r\\n      \'box-shadow\':(i)=>(i==currentCard)?\'0 6px 11px #00000030\':\'0 0px 0px #00000030\',\\r\\n      border:(i)=>(i==currentCard)?\'2px solid #26a\':\'0px solid #fff\',\\r\\n      background:(i)=>(i==currentCard)?\'radial-gradient(100% 100% at top, #fff 0%, #fff 99%)\':\'radial-gradient(100% 100% at top, #fff 20%, #eee 175%)\',\\r\\n      ease:\'expo\'\\r\\n    }, 0)\\r\\n    .to(\'.icon svg\', {\\r\\n      attr:{\\r\\n        stroke:(i)=>(i==currentCard)?\'transparent\':\'#36a\',  \\r\\n        fill:(i)=>(i==currentCard)?\'#36a\':\'transparent\'\\r\\n      }\\r\\n    }, 0)\\r\\n    .to(\'.arrow-btn-prev\', {\\r\\n      autoAlpha:(currentCard==0)?0:1\\r\\n    }, 0)\\r\\n    .to(\'.arrow-btn-next\', {\\r\\n      autoAlpha:(currentCard==4)?0:1\\r\\n    }, 0)\\r\\n    .to(\'.card h4\', {\\r\\n      y:(i)=>(i==currentCard)?0:8,    \\r\\n      opacity:(i)=>(i==currentCard)?1:0,\\r\\n    }, 0)\\r\\n}\"}', '-', 5, '5-card carousel'),
(56, '{\"html\":\"<div class=\\\"popper\\\">\\r\\n Pop it like it\'s hot\\r\\n<\\/div>\",\"css\":\"html {\\r\\n  font-size: 16px;\\r\\n}\\r\\n\\r\\nbody {\\r\\n  background-color: #1c1c1c;\\r\\n  color: white;\\r\\n  font-size: calc(100% + 5vw);\\r\\n  font-family: system-ui, sans-serif;\\r\\n  height: 100vh;\\r\\n  display: flex;\\r\\n  align-items: center;\\r\\n  justify-content: center;\\r\\n}\\r\\n\\r\\n@media (min-width: 768px) {\\r\\n  body {\\r\\n    font-size: calc(100% + 3vw);\\r\\n  }\\r\\n}\\r\\n\\r\\n.pop-char {\\r\\n  opacity: 0;\\r\\n}\\r\\n\\r\\n.static-text span,\\r\\n.animated-text span {\\r\\n  text-shadow: 1px 1px 4px white;\\r\\n}\\r\\n\",\"js\":\"class Popper {\\r\\n  constructor(element) {\\r\\n    this.element = element;\\r\\n    this.originalText = element.innerText;\\r\\n    this.staticSpans = [];\\r\\n    this.spans = [];\\r\\n    this.staticContainer = document.createElement(\\\"div\\\");\\r\\n    this.animationContainer = document.createElement(\\\"div\\\");\\r\\n    this.animationFrames = [];\\r\\n    this.delays = [];\\r\\n    this.emojiEntities = [\\r\\n      \\/\\/ Big smiley\\r\\n      \\\"&#128512;\\\",\\r\\n      \\/\\/ Devil\\r\\n      \\\"&#128520;\\\",\\r\\n      \\/\\/ Heart eyes\\r\\n      \\\"&#128525;\\\",\\r\\n      \\/\\/ Cool guy\\r\\n      \\\"&#128526;\\\",\\r\\n      \\/\\/ Cat\\r\\n      \\\"&#128568;\\\",\\r\\n      \\/\\/ Rocket\\r\\n      \\\"&#128640;\\\"\\r\\n    ];\\r\\n    this.handleResize = this.handleResize.bind(this);\\r\\n    window.addEventListener(\\\"resize\\\", this.debounce(this.handleResize));\\r\\n  }\\r\\n\\r\\n  \\/\\/ Pop it like it\'s hot\\r\\n  popperify() {\\r\\n    this.setupContainers();\\r\\n    this.spanify();\\r\\n    this.spans.forEach((span, index) => {\\r\\n      setTimeout(() => {\\r\\n        this.animateCharacter(span, index);\\r\\n      }, this.delays[index]);\\r\\n    });\\r\\n  }\\r\\n\\r\\n  \\/\\/ Set up\\r\\n  setupContainers() {\\r\\n    this.staticContainer.style.position = \\\"relative\\\";\\r\\n    this.staticContainer.className = \\\"static-text\\\";\\r\\n    this.staticContainer.textContent = this.element.textContent;\\r\\n    this.animationContainer.className = \\\"animated-text\\\";\\r\\n    this.animationContainer.style.position = \\\"absolute\\\";\\r\\n    this.animationContainer.style.top = \\\"0\\\";\\r\\n    this.animationContainer.style.left = \\\"0\\\";\\r\\n    this.animationContainer.style.width = \\\"100%\\\";\\r\\n    this.element.innerHTML = \\\"\\\";\\r\\n    this.element.appendChild(this.staticContainer);\\r\\n    this.element.appendChild(this.animationContainer);\\r\\n  }\\r\\n\\r\\n  spanify() {\\r\\n    const chars = this.staticContainer.textContent.split(\\\"\\\");\\r\\n    this.staticContainer.innerHTML = \\\"\\\";\\r\\n    chars.forEach((char, index) => {\\r\\n      const wrapper = document.createElement(\\\"div\\\");\\r\\n      wrapper.style.display = \\\"inline-block\\\";\\r\\n      const span = document.createElement(\\\"span\\\");\\r\\n      span.textContent = char;\\r\\n      span.style.display = \\\"block\\\";\\r\\n      span.style.whiteSpace = \\\"pre-wrap\\\";\\r\\n      const delay = this.random(2000, 10000);\\r\\n      this.delays.push(delay);\\r\\n\\r\\n      wrapper.appendChild(span);\\r\\n      this.staticContainer.appendChild(wrapper);\\r\\n      const clone = span.cloneNode(true);\\r\\n      clone.className = \\\"pop-char\\\";\\r\\n      clone.style.position = \\\"absolute\\\";\\r\\n\\r\\n      const rect = span.getBoundingClientRect();\\r\\n      clone.style.left = `${rect.left}px`;\\r\\n      clone.style.top = `${rect.top}px`;\\r\\n\\r\\n      this.animationContainer.appendChild(clone);\\r\\n      this.staticSpans.push(span);\\r\\n      this.spans.push(clone);\\r\\n    });\\r\\n  }\\r\\n\\r\\n  \\/\\/ Animations\\r\\n  squishDownAnimation(index, callback) {\\r\\n    let t = 0;\\r\\n    const maxT = 0.25;\\r\\n    const animationFrame = () => {\\r\\n      if (t <= maxT) {\\r\\n        const scale = 1 - 0.15 * Math.sin(t * Math.PI * 2);\\r\\n        this.staticSpans[index].style.transform = `scaleX(${scale.toFixed(\\r\\n          2\\r\\n        )}) scaleY(${(1 \\/ scale).toFixed(2)})`;\\r\\n        t += 0.02;\\r\\n        requestAnimationFrame(animationFrame);\\r\\n      } else {\\r\\n        this.staticSpans[index].style.transform = \\\"\\\";\\r\\n        callback();\\r\\n      }\\r\\n    };\\r\\n    requestAnimationFrame(animationFrame);\\r\\n  }\\r\\n\\r\\n  animateCharacter(span, index) {\\r\\n    const squishAndAnimate = () => {\\r\\n      this.squishDownAnimation(index, () => {\\r\\n        let t = 0;\\r\\n        const maxT = 1;\\r\\n        const initialColor = Math.random() * 360;\\r\\n        let abs = !!Math.round(Math.random());\\r\\n\\r\\n        let randomX2 = abs ? this.random(0, 90) : this.random(-90, 0);\\r\\n        let randomX3 = abs ? this.random(90, 150) : this.random(-150, -90);\\r\\n        let randomX4 = abs ? this.random(150, 200) : this.random(-200, -150);\\r\\n\\r\\n        let randomY2 = this.random(-250, -90);\\r\\n        let randomY3 = this.random(randomY2 - 90, randomY2);\\r\\n\\r\\n        let randomFontSize = this.random(2, 4).toFixed(2);\\r\\n        let font = {\\r\\n          start: randomFontSize,\\r\\n          end: (randomFontSize * this.random(1, 1.2)).toFixed(2)\\r\\n        };\\r\\n        let randomDegree = this.random(0, 360).toFixed(1);\\r\\n        let randomVelocity = this.random(0.25, 1).toFixed(1);\\r\\n\\r\\n        span.style.fontSize = `${font.start}vh`;\\r\\n        const originalHtml = span.innerHTML;\\r\\n\\r\\n        if (parseFloat(this.random(1, 12).toFixed(0)) === 4) {\\r\\n          span.innerHTML = this.emojiEntities[\\r\\n            parseFloat(this.random(0, 5).toFixed(0))\\r\\n          ];\\r\\n        }\\r\\n\\r\\n        const frame = () => {\\r\\n          if (t <= maxT) {\\r\\n            const { x, y } = this.bezier(\\r\\n              t,\\r\\n              { x: 0, y: 0 },\\r\\n              { x: randomX2, y: randomY2 },\\r\\n              { x: randomX3, y: randomY3 },\\r\\n              { x: randomX4, y: 0 }\\r\\n            );\\r\\n            span.style.transform = `translate(${x}px, ${y}px) rotate(${(\\r\\n              randomDegree *\\r\\n              (1 - t)\\r\\n            ).toFixed(0)}deg)`;\\r\\n            span.style.color = `hsl(${\\r\\n              (initialColor + t * 360) % 360\\r\\n            }, 100%, 50%)`;\\r\\n            span.style.opacity = `${1 - t}`;\\r\\n            span.style.fontSize = `calc(100% + ${(font.end * (1 - t)).toFixed(\\r\\n              2\\r\\n            )}vh)`;\\r\\n            t += 0.01;\\r\\n            requestAnimationFrame(frame);\\r\\n          } else {\\r\\n            abs = !!Math.round(Math.random());\\r\\n            randomX2 = abs ? this.random(0, 90) : this.random(-90, 0);\\r\\n            randomX3 = abs ? this.random(90, 150) : this.random(-150, -90);\\r\\n            randomX4 = abs ? this.random(150, 200) : this.random(-200, -150);\\r\\n            randomY2 = this.random(-250, -90);\\r\\n            randomY3 = this.random(randomY2 - 90, randomY2);\\r\\n            randomFontSize = this.random(2, 4).toFixed(2);\\r\\n            font = {\\r\\n              ...font,\\r\\n              end: (randomFontSize * this.random(1, 1.2)).toFixed(2)\\r\\n            };\\r\\n            randomDegree = this.random(0, 360).toFixed(1);\\r\\n            randomVelocity = this.random(0.25, 1).toFixed(1);\\r\\n            span.innerHTML = originalHtml;\\r\\n            setTimeout(() => {\\r\\n              squishAndAnimate();\\r\\n            }, this.random(2000, 10000));\\r\\n          }\\r\\n        };\\r\\n\\r\\n        frame();\\r\\n      });\\r\\n    };\\r\\n    squishAndAnimate();\\r\\n  }\\r\\n\\r\\n  \\/\\/ Utility\\r\\n  debounce(func) {\\r\\n    let timer;\\r\\n    return function (event) {\\r\\n      if (timer) clearTimeout(timer);\\r\\n      timer = setTimeout(func, 100, event);\\r\\n    };\\r\\n  }\\r\\n\\r\\n  updateSpanPositions() {\\r\\n    this.spans.forEach((span, index) => {\\r\\n      const rect = this.staticContainer.children[index].getBoundingClientRect();\\r\\n      span.style.left = `${rect.left}px`;\\r\\n      span.style.top = `${rect.top}px`;\\r\\n    });\\r\\n  }\\r\\n\\r\\n  bezier(t, p0, p1, p2, p3) {\\r\\n    const cx = 3 * (p1.x - p0.x),\\r\\n      bx = 3 * (p2.x - p1.x) - cx,\\r\\n      ax = p3.x - p0.x - cx - bx,\\r\\n      cy = 3 * (p1.y - p0.y),\\r\\n      by = 3 * (p2.y - p1.y) - cy,\\r\\n      ay = p3.y - p0.y - cy - by;\\r\\n    const x = ax * Math.pow(t, 3) + bx * Math.pow(t, 2) + cx * t + p0.x;\\r\\n    const y = ay * Math.pow(t, 3) + by * Math.pow(t, 2) + cy * t + p0.y;\\r\\n    return { x, y };\\r\\n  }\\r\\n\\r\\n  random(min, max) {\\r\\n    return Math.random() * (max - min) + min;\\r\\n  }\\r\\n\\r\\n  handleResize() {\\r\\n    this.updateSpanPositions();\\r\\n  }\\r\\n}\\r\\n\\r\\n\\/\\/ Init\\r\\nconst p = new Popper(document.querySelector(\\\".popper\\\"));\\r\\np.popperify();\\r\\n\"}', '-', 5, 'CodePen Home Poppin\' text'),
(57, '{\"html\":\"<!--ring div starts here-->\\r\\n<div class=\\\"ring\\\"> <i style=\\\"--clr:#00ff0a;\\\"><\\/i> <i style=\\\"--clr:#ff0057;\\\"><\\/i> <i style=\\\"--clr:#fffd44;\\\"><\\/i>\\r\\n    <div class=\\\"login\\\">\\r\\n        <h2>Login<\\/h2>\\r\\n        <div class=\\\"inputBx\\\"> <input type=\\\"text\\\" placeholder=\\\"Username\\\"> <\\/div>\\r\\n        <div class=\\\"inputBx\\\"> <input type=\\\"password\\\" placeholder=\\\"Password\\\"> <\\/div>\\r\\n        <div class=\\\"inputBx\\\"> <input type=\\\"submit\\\" value=\\\"Sign in\\\"> <\\/div>\\r\\n        <div class=\\\"links\\\"> <a href=\\\"#\\\">Forget Password<\\/a> <a href=\\\"#\\\">Signup<\\/a> <\\/div>\\r\\n    <\\/div>\\r\\n<\\/div><!--ring div ends here-->\",\"css\":\"@import url(\\\"https:\\/\\/fonts.googleapis.com\\/css2?family=Quicksand:wght@300&display=swap\\\");\\r\\n\\r\\n* {\\r\\n    margin: 0;\\r\\n    padding: 0;\\r\\n    box-sizing: border-box;\\r\\n    font-family: \\\"Quicksand\\\", sans-serif;\\r\\n}\\r\\n\\r\\nbody {\\r\\n    display: flex;\\r\\n    justify-content: center;\\r\\n    align-items: center;\\r\\n    min-height: 100vh;\\r\\n    background: #111;\\r\\n    width: 100%;\\r\\n    overflow: hidden;\\r\\n}\\r\\n\\r\\n.ring {\\r\\n    position: relative;\\r\\n    width: 500px;\\r\\n    height: 500px;\\r\\n    display: flex;\\r\\n    justify-content: center;\\r\\n    align-items: center;\\r\\n}\\r\\n\\r\\n.ring i {\\r\\n    position: absolute;\\r\\n    inset: 0;\\r\\n    border: 2px solid #fff;\\r\\n    transition: 0.5s;\\r\\n}\\r\\n\\r\\n.ring i:nth-child(1) {\\r\\n    border-radius: 38% 62% 63% 37% \\/ 41% 44% 56% 59%;\\r\\n    animation: animate 6s linear infinite;\\r\\n}\\r\\n\\r\\n.ring i:nth-child(2) {\\r\\n    border-radius: 41% 44% 56% 59%\\/38% 62% 63% 37%;\\r\\n    animation: animate 4s linear infinite;\\r\\n}\\r\\n\\r\\n.ring i:nth-child(3) {\\r\\n    border-radius: 41% 44% 56% 59%\\/38% 62% 63% 37%;\\r\\n    animation: animate2 10s linear infinite;\\r\\n}\\r\\n\\r\\n.ring:hover i {\\r\\n    border: 6px solid var(--clr);\\r\\n    filter: drop-shadow(0 0 20px var(--clr));\\r\\n}\\r\\n\\r\\n@keyframes animate {\\r\\n    0% {\\r\\n        transform: rotate(0deg);\\r\\n    }\\r\\n\\r\\n    100% {\\r\\n        transform: rotate(360deg);\\r\\n    }\\r\\n}\\r\\n\\r\\n@keyframes animate2 {\\r\\n    0% {\\r\\n        transform: rotate(360deg);\\r\\n    }\\r\\n\\r\\n    100% {\\r\\n        transform: rotate(0deg);\\r\\n    }\\r\\n}\\r\\n\\r\\n.login {\\r\\n    position: absolute;\\r\\n    width: 300px;\\r\\n    height: 100%;\\r\\n    display: flex;\\r\\n    justify-content: center;\\r\\n    align-items: center;\\r\\n    flex-direction: column;\\r\\n    gap: 20px;\\r\\n}\\r\\n\\r\\n.login h2 {\\r\\n    font-size: 2em;\\r\\n    color: #fff;\\r\\n}\\r\\n\\r\\n.login .inputBx {\\r\\n    position: relative;\\r\\n    width: 100%;\\r\\n}\\r\\n\\r\\n.login .inputBx input {\\r\\n    position: relative;\\r\\n    width: 100%;\\r\\n    padding: 12px 20px;\\r\\n    background: transparent;\\r\\n    border: 2px solid #fff;\\r\\n    border-radius: 40px;\\r\\n    font-size: 1.2em;\\r\\n    color: #fff;\\r\\n    box-shadow: none;\\r\\n    outline: none;\\r\\n}\\r\\n\\r\\n.login .inputBx input[type=\\\"submit\\\"] {\\r\\n    width: 100%;\\r\\n    background: #0078ff;\\r\\n    background: linear-gradient(45deg, #ff357a, #fff172);\\r\\n    border: none;\\r\\n    cursor: pointer;\\r\\n}\\r\\n\\r\\n.login .inputBx input::placeholder {\\r\\n    color: rgba(255, 255, 255, 0.75);\\r\\n}\\r\\n\\r\\n.login .links {\\r\\n    position: relative;\\r\\n    width: 100%;\\r\\n    display: flex;\\r\\n    align-items: center;\\r\\n    justify-content: space-between;\\r\\n    padding: 0 20px;\\r\\n}\\r\\n\\r\\n.login .links a {\\r\\n    color: #fff;\\r\\n    text-decoration: none;\\r\\n}\",\"js\":\"\"}', '-', 5, 'Animated Login Form - CSS'),
(58, '{\"html\":\"<div class=\\\"container\\\">\\r\\n  <main class=\\\"always-great-grid\\\" id=\\\"grid\\\">\\r\\n    <div class=\\\"box\\\" style=\\\"view-transition-name: b0\\\"><\\/div>\\r\\n    <div class=\\\"box\\\" style=\\\"view-transition-name: b1\\\"><\\/div>\\r\\n    <div class=\\\"box\\\" style=\\\"view-transition-name: b2\\\"><\\/div>\\r\\n    <div class=\\\"box\\\" style=\\\"view-transition-name: b3\\\"><\\/div>\\r\\n    <div class=\\\"box\\\" style=\\\"view-transition-name: b4\\\"><\\/div>\\r\\n    <!-- \\r\\n      view transition names are inline so \\r\\n      they stay attached to the element, \\r\\n      as opposed to using :nth-child() \\r\\n      which means each elements name shifts \\r\\n      when a box is added\\/removed \\r\\n    -->\\r\\n  <\\/main>\\r\\n<\\/div>\\r\\n\\r\\n<footer>\\r\\n  <button onclick=\\\"addBox()\\\">Add a box<\\/button>\\r\\n  <button onclick=\\\"removeBox()\\\" type=\\\"reset\\\">Remove a box<\\/button>\\r\\n<\\/footer>\",\"css\":\"@import \\\"https:\\/\\/unpkg.com\\/open-props\\\" layer(design.system);\\r\\n@import \\\"https:\\/\\/unpkg.com\\/open-props\\/normalize.min.css\\\" layer(demo.support);\\r\\n@import \\\"https:\\/\\/unpkg.com\\/open-props\\/buttons.min.css\\\" layer(demo.support);\\r\\n\\r\\n@layer demo {\\r\\n  .container {\\r\\n    \\/* VERY IMPORTANT this is \\\"size\\\" and not \\\"inline-size\\\" *\\/\\r\\n    \\/* it unlocks container aspect ratio queries *\\/\\r\\n    container: perfect-bento \\/ size;\\r\\n  }\\r\\n  \\r\\n  .always-great-grid {\\r\\n    \\/* these are all the quantity queries *\\/\\r\\n    \\/* how the grid knows the # of boxes *\\/\\r\\n    \\/* some target the grid itself *\\/\\r\\n    \\/* some target the :first-child *\\/\\r\\n    \\r\\n    &:has(> :last-child:nth-child(3)) > :first-child {\\r\\n      grid-column: span 2;\\r\\n    }\\r\\n    \\r\\n    &:has(> :last-child:nth-child(4)) {\\r\\n      grid-template-columns: repeat(2, 1fr);\\r\\n    }\\r\\n    \\r\\n    &:has(> :last-child:nth-child(5)) > :first-child {\\r\\n      grid-column: span 2;\\r\\n    }\\r\\n    \\r\\n    &:has(> :last-child:nth-child(6)) {\\r\\n      grid-template-columns: repeat(2, 1fr);\\r\\n    }\\r\\n    \\r\\n    &:has(> :last-child:nth-child(7)) > :first-child {\\r\\n      grid-column: span 2;\\r\\n      grid-row: span 2;\\r\\n    }\\r\\n    \\r\\n    &:has(> :last-child:nth-child(8)) {\\r\\n      grid-template-columns: repeat(2, 1fr);\\r\\n    }\\r\\n    \\r\\n    &:has(> :last-child:nth-child(9)) {\\r\\n      grid-template-columns: repeat(3, 1fr);\\r\\n    }\\r\\n    \\r\\n    &:has(> :last-child:nth-child(10)) {\\r\\n      grid-template-columns: repeat(2, 1fr);\\r\\n    }\\r\\n    \\r\\n    &:has(> :last-child:nth-child(11)) > :first-child {\\r\\n      grid-column: span 2;\\r\\n      grid-row: span 2;\\r\\n    }\\r\\n    \\r\\n    &:has(> :last-child:nth-child(12)) {\\r\\n      grid-template-columns: repeat(4, 1fr);\\r\\n    }\\r\\n    \\r\\n    \\/* here\'s where the layout is adapted if landscape *\\/\\r\\n    @container perfect-bento (orientation: landscape) {\\r\\n      grid-auto-flow: column;\\r\\n      grid-auto-columns: 1fr;\\r\\n      \\r\\n      &:has(> :last-child:nth-child(3)) {\\r\\n        grid-template-columns: repeat(4, 1fr);\\r\\n      }\\r\\n      \\r\\n      &:has(> :last-child:nth-child(5)) > :first-child {\\r\\n        grid-column: initial;\\r\\n        grid-row: span 2;\\r\\n      }\\r\\n      \\r\\n      &:has(> :last-child:nth-child(6)),\\r\\n      &:has(> :last-child:nth-child(8)),\\r\\n      &:has(> :last-child:nth-child(10)),\\r\\n      &:has(> :last-child:nth-child(12)) {\\r\\n        grid-template-rows: repeat(2, 1fr);\\r\\n      }\\r\\n      \\r\\n      &:has(> :last-child:nth-child(9)) > :first-child {\\r\\n        grid-column: span 2;\\r\\n        grid-row: span 2;\\r\\n      }\\r\\n    }\\r\\n  }\\r\\n}\\r\\n\\r\\n@layer demo.transitions {\\r\\n  \\/* this makes the view transition (VT) pseudo elements not steal clicks *\\/\\r\\n  ::view-transition {\\r\\n    pointer-events: none;\\r\\n  }\\r\\n  \\r\\n  \\/* removes view transition on the page *\\/\\r\\n  \\/* helps isolate the morph effect to the grid *\\/\\r\\n  :root {\\r\\n    view-transition-name: none;\\r\\n  }\\r\\n  \\r\\n  \\/* make all the VT animations springy! *\\/\\r\\n  ::view-transition-group(*) {\\r\\n    animation-timing-function: var(--ease-squish-1);\\r\\n    animation-timing-function: var(--ease-spring-2);\\r\\n    animation-duration: .75s;\\r\\n  }\\r\\n  \\r\\n  \\/* this makes the box shape size morphs better *\\/\\r\\n  ::view-transition-old(*),\\r\\n  ::view-transition-new(*) {\\r\\n    height: 100%;\\r\\n    width: 100%;\\r\\n  }\\r\\n  \\r\\n  @media (prefers-reduced-motion: no-preference) {\\r\\n    \\/* custom animation for new boxes coming in *\\/\\r\\n    \\/* uses Open Props animation and easing props *\\/\\r\\n    \\/* https:\\/\\/open-props.style\\/#animations *\\/\\r\\n    ::view-transition-new(*):only-child {\\r\\n      animation: \\r\\n        var(--animation-slide-in-up) forwards,\\r\\n        var(--animation-fade-in) forwards;\\r\\n      animation-timing-function: var(--ease-squish-1);\\r\\n      animation-timing-function: var(--ease-spring-2);\\r\\n    }\\r\\n\\r\\n    \\/* custom animation for old boxes going out *\\/\\r\\n    ::view-transition-old(*):only-child {\\r\\n      animation: \\r\\n        var(--animation-slide-out-down) forwards,\\r\\n        var(--animation-fade-out) forwards;\\r\\n    }\\r\\n  }\\r\\n}\\r\\n\\r\\n@layer demo.support {\\r\\n  body {\\r\\n    display: grid;\\r\\n    place-content: center;\\r\\n    padding: var(--size-5);\\r\\n    gap: var(--size-5);\\r\\n  }\\r\\n  \\r\\n  footer {\\r\\n    display: flex;\\r\\n    place-content: center;\\r\\n    gap: var(--size-2);\\r\\n  }\\r\\n  \\r\\n  .always-great-grid {\\r\\n    display: grid;\\r\\n    gap: var(--size-3);\\r\\n    padding: var(--size-3);\\r\\n  }\\r\\n  \\r\\n  .box {\\r\\n    background: var(--surface-2);\\r\\n    border-radius: var(--radius-3);\\r\\n  }\\r\\n  \\r\\n  .container {\\r\\n    overflow: hidden;\\r\\n    resize: both;\\r\\n    \\r\\n    display: grid;\\r\\n    block-size: min(var(--size-content-2), 50vw);\\r\\n    inline-size: min(var(--size-content-2), 50vw);\\r\\n    border: 1px solid var(--surface-3);\\r\\n  }\\r\\n}\",\"js\":\"function addBox() {\\r\\n  if (grid.children.length >= 12) return\\r\\n  \\r\\n  const box = document.createElement(\'div\')\\r\\n  box.classList.add(\'box\')\\r\\n  box.style = `view-transition-name: b${grid.children.length}`\\r\\n  \\r\\n  document.startViewTransition\\r\\n    ? document.startViewTransition(() => grid.appendChild(box))\\r\\n    : grid.appendChild(box)\\r\\n}\\r\\n\\r\\nfunction removeBox() {\\r\\n  if (grid.children.length <= 1) return\\r\\n  \\r\\n  const box = grid.querySelector(\':scope > :last-child\')\\r\\n  \\r\\n  document.startViewTransition\\r\\n    ? document.startViewTransition(() => grid.removeChild(box))\\r\\n    : grid.removeChild(box)\\r\\n}\"}', '-', 8, 'Always great grid - CSS grid + :has() + view transitions'),
(59, '{\"html\":\"<h1>Neumorphic buttons<\\/h1>\\r\\n<div class=\\\"buttons\\\">  \\r\\n  <button class=\\\"neumorphic active\\\">\\r\\n    <i class=\\\"fa-light fa-fire\\\"><\\/i>\\r\\n    <span>Button 1<\\/span>\\r\\n  <\\/button>\\r\\n  <button class=\\\"neumorphic\\\">\\r\\n    <i class=\\\"fa-light fa-dna\\\"><\\/i>\\r\\n    <span>Button 2<\\/span>\\r\\n  <\\/button>\\r\\n  <button class=\\\"neumorphic\\\">\\r\\n    <i class=\\\"fa-light fa-chart-mixed\\\"><\\/i>\\r\\n    <span>Button 3<\\/span>\\r\\n  <\\/button>\\r\\n  <button class=\\\"neumorphic\\\">\\r\\n    <i class=\\\"fa-light fa-atom\\\"><\\/i>\\r\\n    <span>Button 4<\\/span>\\r\\n  <\\/button>\\r\\n  <button class=\\\"neumorphic\\\">\\r\\n    <i class=\\\"fa-light fa-seedling\\\"><\\/i>\\r\\n    <span>Button 5<\\/span>\\r\\n  <\\/button>\\r\\n  <button class=\\\"neumorphic\\\">\\r\\n    <i class=\\\"fa-light fa-disease\\\"><\\/i>\\r\\n    <span>Button 6<\\/span>\\r\\n  <\\/button>\\r\\n<\\/div>\",\"css\":\"@import url(\'https:\\/\\/pro.fontawesome.com\\/releases\\/v6.0.0-beta1\\/css\\/all.css\');\\r\\n\\r\\nbutton.neumorphic {\\r\\n  container-type: inline-size;\\r\\n  aspect-ratio: 1\\/1;\\r\\n  border: 0.5rem solid transparent;\\r\\n  border-radius: 1rem;\\r\\n  color: hsl(0 0% 10%);\\r\\n  background: none;\\r\\n  \\r\\n  display: grid;\\r\\n  place-content: center;\\r\\n  gap: 1rem;\\r\\n  \\r\\n  --shadow: \\r\\n    -.5rem -.5rem 1rem hsl(0 0% 100% \\/ .75),\\r\\n    .5rem .5rem 1rem hsl(0 0% 50% \\/ .5);\\r\\n  box-shadow: var(--shadow);\\r\\n  outline: none;  \\r\\n  transition: all 0.1s;\\r\\n  \\r\\n  &:hover, &:focus-visible {\\r\\n    color: hsl(10 80% 50%);\\r\\n    scale: 1.1\\r\\n  }\\r\\n  &:active, &.active{\\r\\n    box-shadow:\\r\\n      var(--shadow),\\r\\n      inset .5rem .5rem 1rem hsl(0 0% 50% \\/ .5),\\r\\n      inset -.5rem -.5rem 1rem hsl(0 0% 100% \\/ .75);\\r\\n    color: hsl(10 80% 50%);\\r\\n    > i { font-size: 28cqi};\\r\\n    > span { font-size: 13cqi};\\r\\n  }\\r\\n\\r\\n  >i {\\r\\n    font-size: 31cqi;\\r\\n  }\\r\\n  > span {\\r\\n    font-family: system-ui, sans-serif;\\r\\n    font-size: 16cqi;\\r\\n  }\\r\\n}\\r\\n\\r\\nbody {\\r\\n  background-color: #e5e9f4;\\r\\n  padding: 2rem;\\r\\n}\\r\\nh1 {\\r\\n  text-align: center;\\r\\n  color: hsl(0 0% 10%);\\r\\n  font-family: system-ui, sans-serif;\\r\\n  font-size: 3rem;\\r\\n}\\r\\n.buttons {\\r\\n  display: grid;\\r\\n  width: min(75rem, 100%);\\r\\n  margin-inline: auto;\\r\\n  grid-template-columns: repeat(auto-fit, minmax(min(8rem, 100%), 1fr));\\r\\n  gap: 2rem;\\r\\n}\",\"js\":\"\"}', '-', 8, 'Neumorphic buttons'),
(61, '{\"html\":\"<p>hola<\\/p>\",\"css\":\".p {\\r\\n    color: blue;\\r\\n}\",\"js\":\"function findSequence(goal) {\\r\\n    function find(start, history) {\\r\\n        if (start == goal)\\r\\n            return history;\\r\\n        else if (start > goal)\\r\\n            return null;\\r\\n        else\\r\\n            return find(start + 5, \\\"(\\\" + history + \\\" + 5)\\\") || find(start * 3, \\\"(\\\" + history + \\\" * 3)\\\");\\r\\n    }\\r\\n    return find(1, \\\"1\\\");\\r\\n}\"}', '-', 5, 'prueba'),
(63, '{\"html\":\"<main>\\r\\n  <ul class=\'slider\'>\\r\\n    <li class=\'item\' style=\\\"background-image: url(\'https:\\/\\/cdn.mos.cms.futurecdn.net\\/dP3N4qnEZ4tCTCLq59iysd.jpg\')\\\">\\r\\n      <div class=\'content\'>\\r\\n        <h2 class=\'title\'>\\\"Lossless Youths\\\"<\\/h2>\\r\\n        <p class=\'description\'> Lorem ipsum, dolor sit amet consectetur\\r\\n        adipisicing elit. Tempore fuga voluptatum, iure corporis inventore\\r\\n        praesentium nisi. Id laboriosam ipsam enim.  <\\/p>\\r\\n        <button>Read More<\\/button>\\r\\n      <\\/div>\\r\\n    <\\/li>\\r\\n    <li class=\'item\' style=\\\"background-image: url(\'https:\\/\\/i.redd.it\\/tc0aqpv92pn21.jpg\')\\\">\\r\\n      <div class=\'content\'>\\r\\n        <h2 class=\'title\'>\\\"Estrange Bond\\\"<\\/h2>\\r\\n        <p class=\'description\'> Lorem ipsum, dolor sit amet consectetur\\r\\n        adipisicing elit. Tempore fuga voluptatum, iure corporis inventore\\r\\n        praesentium nisi. Id laboriosam ipsam enim.  <\\/p>\\r\\n        <button>Read More<\\/button>\\r\\n      <\\/div>\\r\\n    <\\/li>\\r\\n    <li class=\'item\' style=\\\"background-image: url(\'https:\\/\\/wharferj.files.wordpress.com\\/2015\\/11\\/bio_north.jpg\')\\\">\\r\\n      <div class=\'content\'>\\r\\n        <h2 class=\'title\'>\\\"The Gate Keeper\\\"<\\/h2>\\r\\n        <p class=\'description\'> Lorem ipsum, dolor sit amet consectetur\\r\\n        adipisicing elit. Tempore fuga voluptatum, iure corporis inventore\\r\\n        praesentium nisi. Id laboriosam ipsam enim.  <\\/p>\\r\\n        <button>Read More<\\/button>\\r\\n      <\\/div>\\r\\n    <\\/li>\\r\\n    <li class=\'item\' style=\\\"background-image: url(\'https:\\/\\/images7.alphacoders.com\\/878\\/878663.jpg\')\\\">\\r\\n      <div class=\'content\'>\\r\\n        <h2 class=\'title\'>\\\"Last Trace Of Us\\\"<\\/h2>\\r\\n        <p class=\'description\'>\\r\\n          Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tempore fuga voluptatum, iure corporis inventore praesentium nisi. Id laboriosam ipsam enim.\\r\\n        <\\/p>\\r\\n        <button>Read More<\\/button>\\r\\n      <\\/div>\\r\\n    <\\/li>\\r\\n    <li class=\'item\' style=\\\"background-image: url(\'https:\\/\\/theawesomer.com\\/photos\\/2017\\/07\\/simon_stalenhag_the_electric_state_6.jpg\')\\\">\\r\\n      <div class=\'content\'>\\r\\n        <h2 class=\'title\'>\\\"Urban Decay\\\"<\\/h2>\\r\\n        <p class=\'description\'>\\r\\n          Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tempore fuga voluptatum, iure corporis inventore praesentium nisi. Id laboriosam ipsam enim.\\r\\n        <\\/p>\\r\\n        <button>Read More<\\/button>\\r\\n      <\\/div>\\r\\n    <\\/li>\\r\\n    <li class=\'item\' style=\\\"background-image: url(\'https:\\/\\/da.se\\/app\\/uploads\\/2015\\/09\\/simon-december1994.jpg\')\\\">\\r\\n      <div class=\'content\'>\\r\\n        <h2 class=\'title\'>\\\"The Migration\\\"<\\/h2>\\r\\n        <p class=\'description\'> Lorem ipsum, dolor sit amet consectetur\\r\\n        adipisicing elit. Tempore fuga voluptatum, iure corporis inventore\\r\\n        praesentium nisi. Id laboriosam ipsam enim.  <\\/p>\\r\\n        <button>Read More<\\/button>\\r\\n      <\\/div>\\r\\n    <\\/li>\\r\\n  <\\/ul>\\r\\n  <nav class=\'nav\'>\\r\\n    <ion-icon class=\'btn prev\' name=\\\"arrow-back-outline\\\"><\\/ion-icon>\\r\\n    <ion-icon class=\'btn next\' name=\\\"arrow-forward-outline\\\"><\\/ion-icon>\\r\\n  <\\/nav>\\r\\n<\\/main>\\r\\n\\r\\n<script type=\\\"module\\\" src=\\\"https:\\/\\/unpkg.com\\/ionicons@7.1.0\\/dist\\/ionicons\\/ionicons.esm.js\\\"><\\/script>\\r\\n<script nomodule src=\\\"https:\\/\\/unpkg.com\\/ionicons@7.1.0\\/dist\\/ionicons\\/ionicons.js\\\"><\\/script>\",\"css\":\"* {\\r\\n  margin: 0;\\r\\n  padding: 0;\\r\\n  box-sizing: border-box;\\r\\n}\\r\\n\\r\\nbody {\\r\\n  height: 100vh;\\r\\n  display: grid;\\r\\n  place-items: center;\\r\\n  overflow: hidden;\\r\\n}\\r\\n\\r\\nmain {\\r\\n  position: relative;\\r\\n  width: 100%;\\r\\n  height: 100%;\\r\\n  box-shadow: 0 3px 10px rgba(0,0,0,0.3);\\r\\n}\\r\\n\\r\\n.item {\\r\\n  width: 200px;\\r\\n  height: 300px;\\r\\n  list-style-type: none;\\r\\n  position: absolute;\\r\\n  top: 50%;\\r\\n  transform: translateY(-50%);\\r\\n  z-index: 1;\\r\\n  background-position: center;\\r\\n  background-size: cover;\\r\\n  border-radius: 20px;\\r\\n  box-shadow: 0 20px 30px rgba(255,255,255,0.3) inset;\\r\\n  transition: transform 0.1s, left 0.75s, top 0.75s, width 0.75s, height 0.75s;\\r\\n\\r\\n  &:nth-child(1), &:nth-child(2) {\\r\\n    left: 0;\\r\\n    top: 0;\\r\\n    width: 100%;\\r\\n    height: 100%;\\r\\n    transform: none;\\r\\n    border-radius: 0;\\r\\n    box-shadow: none;\\r\\n    opacity: 1;\\r\\n  }\\r\\n\\r\\n  &:nth-child(3) { left: 50%; }\\r\\n  &:nth-child(4) { left: calc(50% + 220px); }\\r\\n  &:nth-child(5) { left: calc(50% + 440px); }\\r\\n  &:nth-child(6) { left: calc(50% + 660px); opacity: 0; }\\r\\n}\\r\\n\\r\\n.content {\\r\\n  width: min(30vw,400px);\\r\\n  position: absolute;\\r\\n  top: 50%;\\r\\n  left: 3rem;\\r\\n  transform: translateY(-50%);\\r\\n  font: 400 0.85rem helvetica,sans-serif;\\r\\n  color: white;\\r\\n  text-shadow: 0 3px 8px rgba(0,0,0,0.5);\\r\\n  opacity: 0;\\r\\n  display: none;\\r\\n\\r\\n  & .title {\\r\\n    font-family: \'arial-black\';\\r\\n    text-transform: uppercase;\\r\\n  }\\r\\n\\r\\n  & .description {\\r\\n    line-height: 1.7;\\r\\n    margin: 1rem 0 1.5rem;\\r\\n    font-size: 0.8rem;\\r\\n  }\\r\\n\\r\\n  & button {\\r\\n    width: fit-content;\\r\\n    background-color: rgba(0,0,0,0.1);\\r\\n    color: white;\\r\\n    border: 2px solid white;\\r\\n    border-radius: 0.25rem;\\r\\n    padding: 0.75rem;\\r\\n    cursor: pointer;\\r\\n  }\\r\\n}\\r\\n\\r\\n.item:nth-of-type(2) .content {\\r\\n  display: block;\\r\\n  animation: show 0.75s ease-in-out 0.3s forwards;\\r\\n}\\r\\n\\r\\n@keyframes show {\\r\\n  0% {\\r\\n    filter: blur(5px);\\r\\n    transform: translateY(calc(-50% + 75px));\\r\\n  }\\r\\n  100% {\\r\\n    opacity: 1;\\r\\n    filter: blur(0);\\r\\n  }\\r\\n}\\r\\n\\r\\n.nav {\\r\\n  position: absolute;\\r\\n  bottom: 2rem;\\r\\n  left: 50%;\\r\\n  transform: translateX(-50%);\\r\\n  z-index: 5;\\r\\n  user-select: none;\\r\\n\\r\\n  & .btn {\\r\\n    background-color: rgba(255,255,255,0.5);\\r\\n    color: rgba(0,0,0,0.7);\\r\\n    border: 2px solid rgba(0,0,0,0.6);\\r\\n    margin: 0 0.25rem;\\r\\n    padding: 0.75rem;\\r\\n    border-radius: 50%;\\r\\n    cursor: pointer;\\r\\n\\r\\n    &:hover {\\r\\n      background-color: rgba(255,255,255,0.3);\\r\\n    }\\r\\n  }\\r\\n}\\r\\n\\r\\n@media (width > 650px) and (width < 900px) {\\r\\n  .content {\\r\\n    & .title        { font-size: 1rem; }\\r\\n    & .description  { font-size: 0.7rem; }\\r\\n    & button        { font-size: 0.7rem; }\\r\\n  }\\r\\n  .item {\\r\\n    width: 160px;\\r\\n    height: 270px;\\r\\n\\r\\n    &:nth-child(3) { left: 50%; }\\r\\n    &:nth-child(4) { left: calc(50% + 170px); }\\r\\n    &:nth-child(5) { left: calc(50% + 340px); }\\r\\n    &:nth-child(6) { left: calc(50% + 510px); opacity: 0; }\\r\\n  }\\r\\n}\\r\\n\\r\\n@media (width < 650px) {\\r\\n  .content {\\r\\n    & .title        { font-size: 0.9rem; }\\r\\n    & .description  { font-size: 0.65rem; }\\r\\n    & button        { font-size: 0.7rem; }\\r\\n  }\\r\\n  .item {\\r\\n    width: 130px;\\r\\n    height: 220px;\\r\\n\\r\\n    &:nth-child(3) { left: 50%; }\\r\\n    &:nth-child(4) { left: calc(50% + 140px); }\\r\\n    &:nth-child(5) { left: calc(50% + 280px); }\\r\\n    &:nth-child(6) { left: calc(50% + 420px); opacity: 0; }\\r\\n  }\\r\\n}\",\"js\":\"const slider = document.querySelector(\'.slider\');\\r\\n\\r\\nfunction activate(e) {\\r\\n  const items = document.querySelectorAll(\'.item\');\\r\\n  e.target.matches(\'.next\') && slider.append(items[0])\\r\\n  e.target.matches(\'.prev\') && slider.prepend(items[items.length-1]);\\r\\n}\\r\\n\\r\\ndocument.addEventListener(\'click\',activate,false);\"}', '-', 5, 'Responsive Image Carousel ( Animation )');

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
(41, 54, 1, 1, 1),
(42, 55, 1, 1, 1),
(43, 56, 1, 1, 1),
(44, 57, 1, 1, 0),
(45, 58, 1, 1, 1),
(46, 59, 1, 1, 0),
(48, 61, 1, 1, 1),
(50, 63, 1, 1, 1);

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
(5, 'Miguel', '$2y$10$ytd.B210fUaoaoAxSM1gcuOBuQwI6M3irzZ9SrxpZMVG1NOmp8uF6', 'Miguel', 'Bastos', 'miguelbastosgandara11@gmail.com', 3, '2024-05-06 20:40:03', 'Soy estudiante de DAW y espero que me aprueben :)'),
(6, 'Admin', '$2y$10$9QYWYUb.3c.eK.yfVd5Fo.jigfWs4XpCwDRJOp4sAOAjm/aubQZny', 'admin', 'admin', 'miguelbastosgandara11+admin@gmail.com', 1, '2024-05-05 21:27:28', NULL),
(8, 'Gala', '$2y$10$BWgU1V4CUqKfwSqn.eloDe.Oea1RvJPyda4ZzKNUOVintMmnLgxia', 'Gala', 'Perez', 'galacid00@gmail.com', 3, '2024-05-05 20:46:13', NULL),
(43, 'Jorge', '$2y$10$OmkW8UWPaK/B84FPV81Z.u8MOZcyn68zZs0aQcMqm85iyQFwKd6iy', 'Jorge', 'Pin Gil', 'jpingil@gmail.com', 3, '2024-05-02 19:48:50', NULL),
(44, 'Mod', '$2y$10$P1K7iB4NWUc64cnXhZ5zyeqL4dtKVqxvDVUSSgl/VgiW5/M7FSxUu', 'Mod', 'Mod', 'mod@codeshred.com', 2, '2024-05-04 19:42:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

CREATE TABLE `views` (
  `view_post_id` int(11) NOT NULL,
  `id_view` int(11) NOT NULL,
  `view_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Views del post';

--
-- Dumping data for table `views`
--

INSERT INTO `views` (`view_post_id`, `id_view`, `view_count`) VALUES
(54, 1, 0),
(55, 2, 0),
(56, 3, 0),
(57, 4, 4),
(58, 5, 1),
(59, 6, 23),
(61, 8, 0),
(63, 10, 1);

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
  ADD KEY `post_views_FK` (`view_post_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `follows`
--
ALTER TABLE `follows`
  MODIFY `id_follow` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id_like` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=513;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id_tags` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `views`
--
ALTER TABLE `views`
  MODIFY `id_view` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  ADD CONSTRAINT `post_views_FK` FOREIGN KEY (`view_post_id`) REFERENCES `posts` (`id_post`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
