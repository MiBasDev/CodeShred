-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 28, 2024 at 08:36 PM
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
  `user_id_following` int(11) DEFAULT NULL,
  `id_follow` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_like` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Likes del post';

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
(72, 'login', 'El usuario \'Miguel\' accede al sistema.', '2024-04-28 18:32:37', 5);

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
(22, '{\"html\":\"prueba\",\"css\":\"\",\"js\":\"eqweq\"}', '-', 8, 'Otra prueba');

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
(12, 22, 1, 0, 1);

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
(5, 'Miguel', '$2y$10$ytd.B210fUaoaoAxSM1gcuOBuQwI6M3irzZ9SrxpZMVG1NOmp8uF6', 'Miguel', 'Bastos', 'miguelbastosgandara11@gmail.com', 3, '2024-04-28 18:32:37', 'Soy estudiante de DAW y espero que me aprueben :)'),
(6, 'Admin', '$2y$10$9QYWYUb.3c.eK.yfVd5Fo.jigfWs4XpCwDRJOp4sAOAjm/aubQZny', 'admin', 'admin', 'miguelbastosgandara11+admin@gmail.com', 1, '2024-04-21 18:45:29', NULL),
(8, 'Gala', '$2y$10$BWgU1V4CUqKfwSqn.eloDe.Oea1RvJPyda4ZzKNUOVintMmnLgxia', 'Gala', 'Perez', 'galacid00@gmail.com', 3, '2024-04-28 10:36:31', NULL);

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
  MODIFY `id_follow` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id_like` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id_tags` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
