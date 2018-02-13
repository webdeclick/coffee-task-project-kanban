-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 13 Février 2018 à 15:21
-- Version du serveur :  5.7.11
-- Version de PHP :  7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `kanban`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `title` text,
  `color` varchar(45) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `project_id`, `title`, `color`, `created_at`, `updated_at`, `deleted_at`, `is_deleted`) VALUES
(1, 1, 'Catégorie 1', NULL, '2017-10-04 15:52:40', NULL, NULL, 0),
(2, 1, 'Catégorie 2', NULL, '2017-10-04 15:52:50', NULL, NULL, 0),
(3, 1, 'Catégorie 3', NULL, '2017-10-04 15:52:57', NULL, NULL, 0),
(9, 3, 'Catégorie 9', NULL, '2017-11-28 09:11:51', NULL, NULL, 0),
(10, 3, 'Catégorie 10', NULL, '2017-11-28 09:11:55', NULL, '2017-11-28 08:14:33', 1),
(11, 3, 'Catégorie 11', NULL, '2017-11-28 09:14:36', NULL, NULL, 0),
(12, 1, '', NULL, '2018-01-16 11:43:25', NULL, '2018-01-16 10:43:56', 1),
(13, 1, 'rty', NULL, '2018-01-16 11:43:51', NULL, '2018-01-16 10:43:59', 1),
(14, 1, '', NULL, '2018-01-16 11:44:03', NULL, '2018-01-16 10:44:14', 1),
(15, 1, 'ertete', NULL, '2018-01-16 11:44:05', NULL, '2018-01-16 10:44:25', 1),
(16, 1, '', NULL, '2018-01-16 11:44:06', NULL, '2018-01-16 10:44:27', 1),
(17, 1, '', NULL, '2018-01-16 11:44:08', NULL, '2018-01-16 10:44:29', 1),
(18, 1, 'ertertryr', NULL, '2018-01-16 11:44:09', NULL, '2018-01-16 12:56:13', 1),
(19, 1, 'hhh', NULL, '2018-01-16 15:20:25', NULL, '2018-01-16 14:20:36', 1),
(20, 9, 'xx', NULL, '2018-01-16 15:30:12', NULL, '2018-01-17 12:42:10', 1),
(21, 1, 'drtet', NULL, '2018-01-16 16:11:42', NULL, '2018-01-18 08:24:11', 1),
(22, 9, 'dfgdgf', NULL, '2018-01-17 13:40:40', NULL, '2018-01-17 12:41:25', 1),
(23, 9, 'dfgdgf', NULL, '2018-01-17 13:40:42', NULL, '2018-01-17 12:41:48', 1),
(24, 9, 'gfg', NULL, '2018-01-17 13:42:18', NULL, '2018-01-17 14:56:17', 1),
(25, 9, '', NULL, '2018-01-17 13:51:58', NULL, '2018-01-17 12:54:59', 1),
(26, 9, '', NULL, '2018-01-17 13:52:05', NULL, '2018-01-17 12:54:49', 1),
(27, 9, '', NULL, '2018-01-17 13:52:05', NULL, '2018-01-17 12:54:45', 1),
(28, 9, '', NULL, '2018-01-17 13:52:05', NULL, '2018-01-17 12:54:43', 1),
(29, 9, '', NULL, '2018-01-17 13:52:07', NULL, '2018-01-17 12:54:47', 1),
(30, 9, '', NULL, '2018-01-17 13:52:12', NULL, '2018-01-17 12:54:51', 1),
(31, 9, '', NULL, '2018-01-17 13:52:12', NULL, '2018-01-17 12:54:57', 1),
(32, 9, '', NULL, '2018-01-17 13:54:55', NULL, '2018-01-17 12:55:01', 1),
(33, 9, 'sdfsdsd', NULL, '2018-01-17 13:55:32', NULL, NULL, 0),
(34, 9, '', NULL, '2018-01-17 13:55:34', NULL, NULL, 0),
(35, 9, '', NULL, '2018-01-17 13:55:35', NULL, '2018-01-17 14:56:07', 1),
(36, 9, '', NULL, '2018-01-17 13:55:41', NULL, '2018-01-17 14:56:12', 1),
(37, 9, 'szer', NULL, '2018-01-17 15:57:07', NULL, '2018-01-17 14:57:14', 1),
(38, 1, '', NULL, '2018-02-13 11:13:29', NULL, '2018-02-13 10:42:23', 1),
(39, 1, '', NULL, '2018-02-13 11:13:31', NULL, '2018-02-13 10:42:25', 1),
(40, 1, '', NULL, '2018-02-13 11:13:32', NULL, '2018-02-13 10:42:28', 1);

-- --------------------------------------------------------

--
-- Structure de la table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `filename` varchar(45) NOT NULL,
  `size` int(11) DEFAULT '0',
  `mimetype` varchar(45) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `is_validate` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'for the tests'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `files`
--

INSERT INTO `files` (`id`, `task_id`, `filename`, `size`, `mimetype`, `created_at`, `deleted_at`, `is_deleted`, `is_validate`) VALUES
(1, 81, 'IMG_1358.JPG', 1989834, 'image/jpeg', '2017-12-18 11:49:29', '2018-01-16 15:48:15', 1, 0),
(2, 81, 'IMG_1359.JPG', 1841707, 'image/jpeg', '2017-12-18 11:49:29', NULL, 0, 1),
(3, 82, 'IMG_1358.JPG', 1989834, 'image/jpeg', '2017-12-18 11:50:12', NULL, 0, 1),
(4, 82, 'IMG_1359.JPG', 1841707, 'image/jpeg', '2017-12-18 11:50:12', NULL, 0, 1),
(5, 82, 'IMG_1360.JPG', 1985031, 'image/jpeg', '2017-12-18 11:50:12', '2017-12-19 15:14:54', 0, 1),
(6, 82, 'intro.jpg', 271831, 'image/jpeg', '2017-12-18 11:50:12', NULL, 0, 1),
(7, 83, 'IMG_1358.JPG', 1989834, 'image/jpeg', '2017-12-18 11:51:55', NULL, 0, 1),
(8, 87, 'IMG_1360.JPG', 1985031, 'image/jpeg', '2017-12-18 14:01:48', NULL, 0, 0),
(9, 87, 'intro.jpg', 271831, 'image/jpeg', '2017-12-18 14:01:48', NULL, 0, 0),
(10, 88, 'IMG_1360.JPG', 1985031, 'image/jpeg', '2017-12-18 14:09:14', NULL, 0, 1),
(11, 88, 'intro.jpg', 271831, 'image/jpeg', '2017-12-18 14:09:14', NULL, 0, 1),
(12, 89, 'IMG_1359.JPG', 1841707, 'image/jpeg', '2018-01-16 09:25:35', NULL, 0, 1),
(13, 89, 'IMG_1360.JPG', 1985031, 'image/jpeg', '2018-01-16 09:25:35', NULL, 0, 1),
(14, 90, 'IMG_1358.JPG', 1989834, 'image/jpeg', '2018-01-16 09:27:31', NULL, 0, 1),
(15, 90, 'IMG_1359.JPG', 1841707, 'image/jpeg', '2018-01-16 09:27:31', NULL, 0, 1),
(16, 90, 'IMG_1360.JPG', 1985031, 'image/jpeg', '2018-01-16 09:27:31', NULL, 0, 1),
(17, 90, 'intro.jpg', 271831, 'image/jpeg', '2018-01-16 09:27:31', NULL, 0, 1),
(18, 104, 'IMG_1360.JPG', 1985031, 'image/jpeg', '2018-01-17 14:47:17', NULL, 0, 1),
(19, 104, 'intro.jpg', 271831, 'image/jpeg', '2018-01-17 14:47:17', NULL, 0, 1),
(20, 105, 'IMG_1360.JPG', 1985031, 'image/jpeg', '2018-01-17 14:47:23', NULL, 0, 1),
(21, 105, 'intro.jpg', 271831, 'image/jpeg', '2018-01-17 14:47:23', NULL, 0, 1),
(22, 106, 'IMG_1360.JPG', 1985031, 'image/jpeg', '2018-01-17 14:47:26', NULL, 0, 1),
(23, 106, 'intro.jpg', 271831, 'image/jpeg', '2018-01-17 14:47:26', NULL, 0, 1),
(24, 108, 'IMG_1360.JPG', 1985031, 'image/jpeg', '2018-01-17 15:03:19', NULL, 0, 0),
(25, 108, 'intro.jpg', 271831, 'image/jpeg', '2018-01-17 15:03:19', NULL, 0, 0),
(26, 109, 'intro.jpg', 271831, 'image/jpeg', '2018-01-17 15:13:36', '2018-01-17 15:04:22', 1, 0),
(27, 113, 'IMG_1360.JPG', 1985031, 'image/jpeg', '2018-01-17 15:25:11', '2018-01-17 15:04:19', 1, 0),
(28, 113, 'intro.jpg', 271831, 'image/jpeg', '2018-01-17 15:25:11', '2018-01-17 15:04:20', 1, 0),
(29, 114, 'IMG_1360.JPG', 1985031, 'image/jpeg', '2018-01-17 15:25:33', NULL, 0, 1),
(30, 114, 'intro.jpg', 271831, 'image/jpeg', '2018-01-17 15:25:33', NULL, 0, 1),
(31, 115, 'IMG_1360.JPG', 1985031, 'image/jpeg', '2018-01-17 15:26:20', NULL, 0, 1),
(32, 115, 'intro.jpg', 271831, 'image/jpeg', '2018-01-17 15:26:20', NULL, 0, 1),
(33, 116, 'IMG_1358 - Copie - Copie - Copie.JPG', 1989834, 'image/jpeg', '2018-01-17 15:45:26', NULL, 0, 0),
(34, 116, 'IMG_1358 - Copie - Copie (2).JPG', 1989834, 'image/jpeg', '2018-01-17 15:45:26', NULL, 0, 0),
(35, 116, 'IMG_1358 - Copie - Copie.JPG', 1989834, 'image/jpeg', '2018-01-17 15:45:26', NULL, 0, 0),
(36, 116, 'IMG_1358 - Copie (2) - Copie.JPG', 1989834, 'image/jpeg', '2018-01-17 15:45:26', NULL, 0, 0),
(37, 116, 'IMG_1358 - Copie (2).JPG', 1989834, 'image/jpeg', '2018-01-17 15:45:26', NULL, 0, 0),
(38, 116, 'IMG_1358 - Copie (3).JPG', 1989834, 'image/jpeg', '2018-01-17 15:45:26', NULL, 0, 0),
(39, 116, 'IMG_1358 - Copie.JPG', 1989834, 'image/jpeg', '2018-01-17 15:45:26', NULL, 0, 0),
(40, 116, 'IMG_1358.JPG', 1989834, 'image/jpeg', '2018-01-17 15:45:26', NULL, 0, 0),
(41, 116, 'IMG_1359 - Copie - Copie - Copie.JPG', 1841707, 'image/jpeg', '2018-01-17 15:45:26', NULL, 0, 0),
(42, 116, 'IMG_1359 - Copie - Copie (2).JPG', 1841707, 'image/jpeg', '2018-01-17 15:45:26', NULL, 0, 0),
(43, 116, 'IMG_1359 - Copie - Copie.JPG', 1841707, 'image/jpeg', '2018-01-17 15:45:26', NULL, 0, 0),
(44, 116, 'IMG_1359 - Copie (2) - Copie.JPG', 1841707, 'image/jpeg', '2018-01-17 15:45:26', NULL, 0, 0),
(45, 116, 'IMG_1359 - Copie (2).JPG', 1841707, 'image/jpeg', '2018-01-17 15:45:26', NULL, 0, 0),
(46, 116, 'IMG_1359 - Copie (3).JPG', 1841707, 'image/jpeg', '2018-01-17 15:45:27', NULL, 0, 0),
(47, 116, 'IMG_1359 - Copie.JPG', 1841707, 'image/jpeg', '2018-01-17 15:45:27', NULL, 0, 0),
(48, 116, 'IMG_1359.JPG', 1841707, 'image/jpeg', '2018-01-17 15:45:27', NULL, 0, 0),
(49, 116, 'IMG_1360 - Copie - Copie - Copie.JPG', 1985031, 'image/jpeg', '2018-01-17 15:45:27', NULL, 0, 0),
(50, 116, 'IMG_1360 - Copie - Copie (2).JPG', 1985031, 'image/jpeg', '2018-01-17 15:45:27', NULL, 0, 0),
(51, 116, 'IMG_1360 - Copie - Copie.JPG', 1985031, 'image/jpeg', '2018-01-17 15:45:27', NULL, 0, 0),
(52, 116, 'IMG_1360 - Copie (2) - Copie.JPG', 1985031, 'image/jpeg', '2018-01-17 15:45:27', NULL, 0, 0),
(53, 116, 'IMG_1360 - Copie (2).JPG', 1985031, 'image/jpeg', '2018-01-17 15:45:27', NULL, 0, 0),
(54, 116, 'IMG_1360 - Copie (3).JPG', 1985031, 'image/jpeg', '2018-01-17 15:45:27', NULL, 0, 0),
(55, 116, 'IMG_1360 - Copie.JPG', 1985031, 'image/jpeg', '2018-01-17 15:45:27', NULL, 0, 0),
(56, 116, 'IMG_1360.JPG', 1985031, 'image/jpeg', '2018-01-17 15:45:27', NULL, 0, 0),
(57, 117, 'IMG_1358 - Copie - Copie - Copie.JPG', 1989834, 'image/jpeg', '2018-01-17 15:45:50', NULL, 0, 0),
(58, 117, 'IMG_1358 - Copie - Copie (2).JPG', 1989834, 'image/jpeg', '2018-01-17 15:45:50', NULL, 0, 0),
(59, 117, 'IMG_1358 - Copie - Copie.JPG', 1989834, 'image/jpeg', '2018-01-17 15:45:50', NULL, 0, 0),
(60, 117, 'IMG_1358 - Copie (2) - Copie.JPG', 1989834, 'image/jpeg', '2018-01-17 15:45:50', NULL, 0, 0),
(61, 117, 'IMG_1358 - Copie (2).JPG', 1989834, 'image/jpeg', '2018-01-17 15:45:50', NULL, 0, 0),
(62, 117, 'IMG_1358 - Copie (3).JPG', 1989834, 'image/jpeg', '2018-01-17 15:45:50', NULL, 0, 0),
(63, 117, 'IMG_1358 - Copie.JPG', 1989834, 'image/jpeg', '2018-01-17 15:45:50', NULL, 0, 0),
(64, 117, 'IMG_1358.JPG', 1989834, 'image/jpeg', '2018-01-17 15:45:50', NULL, 0, 0),
(65, 117, 'IMG_1359 - Copie - Copie - Copie.JPG', 1841707, 'image/jpeg', '2018-01-17 15:45:50', NULL, 0, 0),
(66, 117, 'IMG_1359 - Copie - Copie (2).JPG', 1841707, 'image/jpeg', '2018-01-17 15:45:50', NULL, 0, 0),
(67, 117, 'IMG_1359 - Copie - Copie.JPG', 1841707, 'image/jpeg', '2018-01-17 15:45:51', NULL, 0, 0),
(68, 117, 'IMG_1359 - Copie (2) - Copie.JPG', 1841707, 'image/jpeg', '2018-01-17 15:45:51', NULL, 0, 0),
(69, 117, 'IMG_1359 - Copie (2).JPG', 1841707, 'image/jpeg', '2018-01-17 15:45:51', NULL, 0, 0),
(70, 117, 'IMG_1359 - Copie (3).JPG', 1841707, 'image/jpeg', '2018-01-17 15:45:51', NULL, 0, 0),
(71, 117, 'IMG_1359 - Copie.JPG', 1841707, 'image/jpeg', '2018-01-17 15:45:51', NULL, 0, 0),
(72, 117, 'IMG_1359.JPG', 1841707, 'image/jpeg', '2018-01-17 15:45:51', NULL, 0, 0),
(73, 117, 'IMG_1360 - Copie - Copie - Copie.JPG', 1985031, 'image/jpeg', '2018-01-17 15:45:51', NULL, 0, 0),
(74, 117, 'IMG_1360 - Copie - Copie (2).JPG', 1985031, 'image/jpeg', '2018-01-17 15:45:51', NULL, 0, 0),
(75, 117, 'IMG_1360 - Copie - Copie.JPG', 1985031, 'image/jpeg', '2018-01-17 15:45:51', NULL, 0, 0),
(76, 117, 'IMG_1360 - Copie (2) - Copie.JPG', 1985031, 'image/jpeg', '2018-01-17 15:45:51', NULL, 0, 0),
(77, 117, 'IMG_1360 - Copie (2).JPG', 1985031, 'image/jpeg', '2018-01-17 15:45:51', NULL, 0, 0),
(78, 117, 'IMG_1360 - Copie (3).JPG', 1985031, 'image/jpeg', '2018-01-17 15:45:51', NULL, 0, 0),
(79, 117, 'IMG_1360 - Copie.JPG', 1985031, 'image/jpeg', '2018-01-17 15:45:51', NULL, 0, 0),
(80, 117, 'IMG_1360.JPG', 1985031, 'image/jpeg', '2018-01-17 15:45:52', NULL, 0, 0),
(81, 118, 'IMG_1358 - Copie - Copie - Copie.JPG', 1989834, 'image/jpeg', '2018-01-17 15:46:13', NULL, 0, 0),
(82, 118, 'IMG_1358 - Copie - Copie (2).JPG', 1989834, 'image/jpeg', '2018-01-17 15:46:13', NULL, 0, 0),
(83, 118, 'IMG_1358 - Copie - Copie.JPG', 1989834, 'image/jpeg', '2018-01-17 15:46:13', NULL, 0, 0),
(84, 118, 'IMG_1358 - Copie (2) - Copie.JPG', 1989834, 'image/jpeg', '2018-01-17 15:46:13', NULL, 0, 0),
(85, 118, 'IMG_1358 - Copie (2).JPG', 1989834, 'image/jpeg', '2018-01-17 15:46:13', NULL, 0, 0),
(86, 118, 'IMG_1358 - Copie (3).JPG', 1989834, 'image/jpeg', '2018-01-17 15:46:13', NULL, 0, 0),
(87, 118, 'IMG_1358 - Copie.JPG', 1989834, 'image/jpeg', '2018-01-17 15:46:13', NULL, 0, 0),
(88, 118, 'IMG_1358.JPG', 1989834, 'image/jpeg', '2018-01-17 15:46:13', NULL, 0, 0),
(89, 118, 'IMG_1359 - Copie - Copie - Copie.JPG', 1841707, 'image/jpeg', '2018-01-17 15:46:13', NULL, 0, 0),
(90, 118, 'IMG_1359 - Copie - Copie (2).JPG', 1841707, 'image/jpeg', '2018-01-17 15:46:13', NULL, 0, 0),
(91, 119, 'IMG_1358 - Copie - Copie - Copie.JPG', 1989834, 'image/jpeg', '2018-01-17 15:46:24', NULL, 0, 1),
(92, 119, 'IMG_1358 - Copie - Copie (2).JPG', 1989834, 'image/jpeg', '2018-01-17 15:46:24', NULL, 0, 1),
(93, 119, 'IMG_1358 - Copie - Copie.JPG', 1989834, 'image/jpeg', '2018-01-17 15:46:24', NULL, 0, 1),
(94, 119, 'IMG_1358 - Copie (2) - Copie.JPG', 1989834, 'image/jpeg', '2018-01-17 15:46:24', NULL, 0, 1),
(95, 119, 'IMG_1358 - Copie (2).JPG', 1989834, 'image/jpeg', '2018-01-17 15:46:24', NULL, 0, 1),
(96, 120, 'IMG_1358 - Copie - Copie - Copie.JPG', 1989834, 'image/jpeg', '2018-01-17 15:47:42', NULL, 0, 0),
(97, 120, 'IMG_1358 - Copie - Copie (2).JPG', 1989834, 'image/jpeg', '2018-01-17 15:47:42', NULL, 0, 1),
(98, 120, 'IMG_1358 - Copie - Copie.JPG', 1989834, 'image/jpeg', '2018-01-17 15:47:42', NULL, 0, 1),
(99, 120, 'IMG_1358 - Copie (2) - Copie.JPG', 1989834, 'image/jpeg', '2018-01-17 15:47:42', NULL, 0, 1),
(100, 120, 'IMG_1358 - Copie (2).JPG', 1989834, 'image/jpeg', '2018-01-17 15:47:42', NULL, 0, 1),
(101, 120, 'IMG_1358 - Copie (3).JPG', 1989834, 'image/jpeg', '2018-01-17 15:47:42', NULL, 0, 1),
(102, 120, 'IMG_1358 - Copie.JPG', 1989834, 'image/jpeg', '2018-01-17 15:47:42', NULL, 0, 1),
(103, 120, 'IMG_1358.JPG', 1989834, 'image/jpeg', '2018-01-17 15:47:43', NULL, 0, 1),
(104, 120, 'IMG_1359 - Copie - Copie - Copie.JPG', 1841707, 'image/jpeg', '2018-01-17 15:47:43', NULL, 0, 1),
(105, 120, 'IMG_1359 - Copie - Copie (2).JPG', 1841707, 'image/jpeg', '2018-01-17 15:47:43', NULL, 0, 1),
(106, 120, 'IMG_1359 - Copie - Copie.JPG', 1841707, 'image/jpeg', '2018-01-17 15:47:43', NULL, 0, 1),
(107, 120, 'IMG_1359 - Copie (2) - Copie.JPG', 1841707, 'image/jpeg', '2018-01-17 15:47:43', NULL, 0, 1),
(108, 120, 'IMG_1359 - Copie (2).JPG', 1841707, 'image/jpeg', '2018-01-17 15:47:43', NULL, 0, 1),
(109, 120, 'IMG_1359 - Copie (3).JPG', 1841707, 'image/jpeg', '2018-01-17 15:47:43', NULL, 0, 1),
(110, 120, 'IMG_1359 - Copie.JPG', 1841707, 'image/jpeg', '2018-01-17 15:47:43', NULL, 0, 1),
(111, 120, 'IMG_1359.JPG', 1841707, 'image/jpeg', '2018-01-17 15:47:43', NULL, 0, 1),
(112, 120, 'IMG_1360 - Copie - Copie - Copie.JPG', 1985031, 'image/jpeg', '2018-01-17 15:47:43', NULL, 0, 1),
(113, 120, 'IMG_1360 - Copie - Copie (2).JPG', 1985031, 'image/jpeg', '2018-01-17 15:47:43', NULL, 0, 1),
(114, 120, 'IMG_1360 - Copie - Copie.JPG', 1985031, 'image/jpeg', '2018-01-17 15:47:43', NULL, 0, 1),
(115, 120, 'IMG_1360 - Copie (2) - Copie.JPG', 1985031, 'image/jpeg', '2018-01-17 15:47:44', NULL, 0, 1),
(116, 120, 'IMG_1360 - Copie (2).JPG', 1985031, 'image/jpeg', '2018-01-17 15:47:44', NULL, 0, 1),
(117, 120, 'IMG_1360 - Copie (3).JPG', 1985031, 'image/jpeg', '2018-01-17 15:47:44', NULL, 0, 1),
(118, 120, 'IMG_1360 - Copie.JPG', 1985031, 'image/jpeg', '2018-01-17 15:47:44', NULL, 0, 0),
(119, 120, 'IMG_1360.JPG', 1985031, 'image/jpeg', '2018-01-17 15:47:44', NULL, 0, 0),
(120, 121, 'IMG_1358 - Copie - Copie - Copie.JPG', 1989834, 'image/jpeg', '2018-01-17 15:49:33', NULL, 0, 0),
(121, 121, 'IMG_1358 - Copie - Copie (2).JPG', 1989834, 'image/jpeg', '2018-01-17 15:49:33', NULL, 0, 0),
(122, 121, 'IMG_1358 - Copie - Copie.JPG', 1989834, 'image/jpeg', '2018-01-17 15:49:33', NULL, 0, 0),
(123, 121, 'IMG_1358 - Copie (2) - Copie.JPG', 1989834, 'image/jpeg', '2018-01-17 15:49:33', NULL, 0, 0),
(124, 121, 'IMG_1358 - Copie (2).JPG', 1989834, 'image/jpeg', '2018-01-17 15:49:33', NULL, 0, 0),
(125, 121, 'IMG_1358 - Copie (3).JPG', 1989834, 'image/jpeg', '2018-01-17 15:49:33', NULL, 0, 0),
(126, 121, 'IMG_1358 - Copie.JPG', 1989834, 'image/jpeg', '2018-01-17 15:49:33', NULL, 0, 0),
(127, 121, 'IMG_1358.JPG', 1989834, 'image/jpeg', '2018-01-17 15:49:33', NULL, 0, 0),
(128, 121, 'IMG_1359 - Copie - Copie - Copie.JPG', 1841707, 'image/jpeg', '2018-01-17 15:49:33', NULL, 0, 0),
(129, 121, 'IMG_1359 - Copie - Copie (2).JPG', 1841707, 'image/jpeg', '2018-01-17 15:49:33', NULL, 0, 0),
(130, 121, 'IMG_1359 - Copie - Copie.JPG', 1841707, 'image/jpeg', '2018-01-17 15:49:33', NULL, 0, 0),
(131, 121, 'IMG_1359 - Copie (2) - Copie.JPG', 1841707, 'image/jpeg', '2018-01-17 15:49:33', NULL, 0, 0),
(132, 121, 'IMG_1359 - Copie (2).JPG', 1841707, 'image/jpeg', '2018-01-17 15:49:34', NULL, 0, 0),
(133, 121, 'IMG_1359 - Copie (3).JPG', 1841707, 'image/jpeg', '2018-01-17 15:49:34', NULL, 0, 0),
(134, 121, 'IMG_1359 - Copie.JPG', 1841707, 'image/jpeg', '2018-01-17 15:49:34', NULL, 0, 0),
(135, 121, 'IMG_1359.JPG', 1841707, 'image/jpeg', '2018-01-17 15:49:34', NULL, 0, 0),
(136, 121, 'IMG_1360 - Copie - Copie - Copie.JPG', 1985031, 'image/jpeg', '2018-01-17 15:49:34', NULL, 0, 0),
(137, 121, 'IMG_1360 - Copie - Copie (2).JPG', 1985031, 'image/jpeg', '2018-01-17 15:49:34', NULL, 0, 0),
(138, 121, 'IMG_1360 - Copie - Copie.JPG', 1985031, 'image/jpeg', '2018-01-17 15:49:34', NULL, 0, 0),
(139, 121, 'IMG_1360 - Copie (2) - Copie.JPG', 1985031, 'image/jpeg', '2018-01-17 15:49:34', NULL, 0, 0),
(140, 121, 'IMG_1360 - Copie (2).JPG', 1985031, 'image/jpeg', '2018-01-17 15:49:34', NULL, 0, 0),
(141, 121, 'IMG_1360 - Copie (3).JPG', 1985031, 'image/jpeg', '2018-01-17 15:49:34', NULL, 0, 0),
(142, 121, 'IMG_1360 - Copie.JPG', 1985031, 'image/jpeg', '2018-01-17 15:49:34', NULL, 0, 0),
(143, 121, 'IMG_1360.JPG', 1985031, 'image/jpeg', '2018-01-17 15:49:34', NULL, 0, 0),
(144, 122, 'IMG_1360.JPG', 1985031, 'image/jpeg', '2018-01-17 16:04:45', '2018-01-17 15:04:58', 1, 0),
(145, 122, 'intro.jpg', 271831, 'image/jpeg', '2018-01-17 16:04:45', NULL, 0, 1),
(146, 123, 'intro.jpg', 271831, 'image/jpeg', '2018-02-12 16:49:35', NULL, 0, 1),
(147, 124, 'jessica.jpg', 130315, 'image/jpeg', '2018-02-13 10:02:45', NULL, 0, 1),
(148, 125, 'jessica.jpg', 130315, 'image/jpeg', '2018-02-13 10:03:11', NULL, 0, 1),
(149, 126, 'jessica.jpg', 130315, 'image/jpeg', '2018-02-13 10:03:44', NULL, 0, 1),
(150, 130, 'intro.jpg', 271831, 'image/jpeg', '2018-02-13 14:33:05', NULL, 0, 1),
(151, 131, 'intro.jpg', 271831, 'image/jpeg', '2018-02-13 14:35:19', NULL, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `preferences`
--

CREATE TABLE `preferences` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tasks_filter` int(11) NOT NULL DEFAULT '0',
  `notifications_tasks_limit` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `linked_admin` int(11) NOT NULL,
  `linked_manager` int(11) DEFAULT NULL,
  `title` text,
  `description` text,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `projects`
--

INSERT INTO `projects` (`id`, `linked_admin`, `linked_manager`, `title`, `description`, `created_at`, `updated_at`, `deleted_at`, `is_deleted`) VALUES
(1, 1, 2, 'projet 1', 'description 1 description 1 description 1 description 1 description 1', '2017-10-04 15:41:38', NULL, '2017-10-30 08:58:49', 0),
(2, 1, 2, 'Projet 2', 'description 2', '2017-10-30 09:58:46', NULL, '2017-10-30 08:58:48', 1),
(3, 1, NULL, 'Projet 3', 'description 3', '2017-10-30 10:00:38', NULL, '2018-01-15 13:39:00', 1),
(4, 1, NULL, '', '', '2017-12-20 16:19:14', NULL, '2018-01-15 15:21:17', 1),
(5, 1, NULL, '', '', '2017-12-20 16:19:16', NULL, '2018-01-15 13:39:06', 1),
(6, 1, NULL, '', '', '2017-12-20 16:19:17', NULL, '2017-12-20 15:40:15', 1),
(7, 1, NULL, '', '', '2018-01-15 14:59:36', NULL, '2018-01-15 15:21:19', 1),
(8, 1, NULL, '', '', '2018-01-15 16:00:43', NULL, '2018-01-15 15:21:20', 1),
(9, 1, NULL, 'Projet 2', 'description bnah blah', '2018-01-15 16:21:58', NULL, NULL, 0),
(10, 1, NULL, '', '', '2018-01-17 16:49:49', NULL, '2018-02-13 13:15:49', 1),
(11, 1, NULL, '', '', '2018-01-18 11:41:49', NULL, '2018-02-13 13:09:14', 1),
(12, 1, NULL, '', '', '2018-02-13 14:16:00', NULL, '2018-02-13 13:16:10', 1),
(13, 1, NULL, '', '', '2018-02-13 14:16:00', NULL, '2018-02-13 13:16:07', 1),
(14, 1, NULL, '', '', '2018-02-13 14:18:40', NULL, '2018-02-13 13:27:10', 1),
(15, 1, NULL, '', '', '2018-02-13 14:20:07', NULL, '2018-02-13 13:27:06', 1),
(16, 1, NULL, '', '', '2018-02-13 14:20:31', NULL, '2018-02-13 13:27:07', 1),
(17, 1, NULL, '', '', '2018-02-13 14:23:36', NULL, '2018-02-13 13:27:09', 1),
(18, 1, NULL, 'ert', '', '2018-02-13 14:25:24', NULL, '2018-02-13 13:27:01', 1),
(19, 1, NULL, 'gdfgdfgdf', 'dgdg', '2018-02-13 14:27:16', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `title` text,
  `description` text,
  `project_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `assigned_to` int(11) NOT NULL,
  `importance` int(11) DEFAULT '0',
  `end_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_completed` tinyint(4) NOT NULL DEFAULT '0',
  `completed_at` datetime DEFAULT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `project_id`, `category_id`, `assigned_to`, `importance`, `end_at`, `created_at`, `is_completed`, `completed_at`, `is_deleted`, `deleted_at`) VALUES
(1, 'Tache 1', 'Description 1', 1, 2, 1, 1, '2017-10-05 00:00:00', '2017-10-04 16:29:53', 1, '2018-02-12 07:48:44', 1, '2017-11-03 10:07:09'),
(2, 'Tache 2', 'Description 2', 1, 2, 1, 0, '2017-11-09 11:35:00', '2017-11-02 11:58:11', 1, '2018-02-12 07:48:44', 0, NULL),
(3, 'Tache 3', 'Description 3', 1, 2, 1, 0, '2017-11-08 09:43:00', '2017-11-03 09:43:48', 1, '2018-02-12 07:48:44', 0, NULL),
(4, 'Tache 4', 'Description 4', 1, 2, 1, 0, '2017-11-08 09:43:00', '2017-11-03 09:43:53', 1, '2018-02-12 07:48:44', 1, '2017-11-03 14:26:50'),
(5, 'Tache 5', 'Description 5', 1, 2, 1, 0, '2017-11-08 09:43:00', '2017-11-03 09:43:55', 1, '2018-02-12 07:48:44', 1, '2017-11-03 14:26:52'),
(6, 'Tache 6', 'Description 6', 1, 2, 1, 0, '2017-11-08 09:43:00', '2017-11-03 09:43:57', 1, '2018-02-12 07:48:44', 1, '2017-11-03 14:26:54'),
(7, 'Tache 7', 'Description 7', 1, 2, 1, 0, '2017-11-07 09:43:00', '2017-11-03 09:44:52', 1, '2018-02-12 07:48:44', 0, NULL),
(8, 'Tache 8', 'Description 8', 1, 2, 2, 0, '2017-11-03 08:45:10', '2017-11-03 09:45:10', 1, '2018-02-12 07:48:44', 0, NULL),
(9, 'Tache 9', 'Description 9', 1, 2, 2, 0, '2017-11-03 08:45:17', '2017-11-03 09:45:17', 1, '2018-02-12 07:48:44', 0, NULL),
(10, 'Tache 10', 'Description 10', 1, 2, 1, 0, '2017-11-03 08:45:59', '2017-11-03 09:45:59', 1, '2018-02-12 07:48:44', 1, '2017-11-03 14:26:56'),
(11, 'Tache 11', 'Description 11', 1, 2, 1, 0, '2017-11-03 08:46:05', '2017-11-03 09:46:05', 1, '2018-02-12 07:48:44', 0, NULL),
(12, 'Tache 12', 'Description 12', 1, 2, 1, 0, '2017-11-03 08:49:21', '2017-11-03 09:49:21', 1, '2018-02-12 07:48:44', 0, NULL),
(13, 'Tache 13', 'Description 13', 1, 3, 1, 0, '2017-11-17 09:54:00', '2017-11-03 09:54:49', 1, '2018-02-12 07:48:44', 1, '2017-11-03 10:14:52'),
(15, 'Tache 15', 'Description 15', 1, 1, 1, 0, NULL, '2017-11-03 10:31:02', 0, NULL, 1, '2018-02-13 12:39:46'),
(16, 'Tache 16', 'Description 16', 1, 3, 1, 0, NULL, '2017-11-03 11:14:59', 0, NULL, 1, '2017-11-03 10:15:03'),
(17, 'Tache 17', 'Description 17', 1, 3, 1, 0, '2017-11-03 11:13:49', '2017-11-03 11:15:08', 1, '2018-02-12 07:48:44', 1, '2017-11-03 10:15:11'),
(18, 'Tache 18', 'Description 18', 1, 1, 1, 0, NULL, '2017-11-03 11:34:42', 0, NULL, 1, '2017-11-03 10:57:49'),
(19, 'Tache 19', 'Description 19', 1, 3, 2, 0, NULL, '2017-11-03 11:35:24', 0, NULL, 1, '2017-11-28 14:14:19'),
(20, 'Tache 20', 'Description 20', 1, 1, 1, 0, NULL, '2017-11-03 11:57:02', 0, NULL, 1, '2017-11-03 10:57:51'),
(21, 'Tache 21', 'Description 21', 1, 1, 1, 0, NULL, '2017-11-03 11:57:08', 0, NULL, 1, '2017-11-03 10:57:52'),
(22, 'Tache 22', 'Description 22', 1, 1, 1, 0, NULL, '2017-11-03 11:57:56', 0, NULL, 1, '2017-11-03 14:26:59'),
(23, 'Tache 23', 'Description 23', 1, 1, 1, 0, NULL, '2017-11-03 11:58:50', 0, NULL, 0, NULL),
(24, 'Tache 24', 'Description 24', 1, 3, 1, 0, NULL, '2017-11-03 13:37:12', 0, NULL, 1, '2017-11-03 12:38:27'),
(25, 'Tache 25', 'Description 25', 1, 3, 1, 0, NULL, '2017-11-03 13:37:23', 0, NULL, 1, '2017-11-03 12:37:34'),
(26, 'Tache 26', 'Description 26', 1, 3, 1, 0, NULL, '2017-11-03 13:37:31', 0, NULL, 1, '2017-11-03 12:38:28'),
(27, 'Tache 27', 'Description 27', 1, 3, 2, 0, NULL, '2017-11-03 13:37:38', 1, '2017-11-29 07:55:35', 0, NULL),
(28, 'Tache 28', 'Description 28', 1, 3, 1, 0, NULL, '2017-11-03 13:38:24', 0, NULL, 1, '2017-11-03 12:39:13'),
(29, 'Tache 29', 'Description 29', 1, 3, 1, 0, NULL, '2017-11-03 13:38:56', 0, NULL, 1, '2017-11-03 12:39:14'),
(30, 'Tache 30', 'Description 30', 1, 3, 1, 0, NULL, '2017-11-03 13:38:56', 0, NULL, 1, '2017-11-03 12:39:15'),
(31, 'Tache 31', 'Description 31', 1, 3, 1, 0, NULL, '2017-11-03 13:38:56', 0, NULL, 1, '2017-11-03 12:39:15'),
(32, 'Tache 32', 'Description 32', 1, 3, 1, 0, NULL, '2017-11-03 13:38:56', 0, NULL, 1, '2017-11-03 12:39:16'),
(33, 'Tache 33', 'Description 33', 1, 3, 1, 0, NULL, '2017-11-03 13:39:18', 0, NULL, 1, '2017-11-03 12:39:24'),
(34, 'Tache 34', 'Description 34', 1, 3, 1, 0, NULL, '2017-11-03 13:39:22', 0, NULL, 1, '2017-11-03 12:39:26'),
(35, 'Tache 35', 'Description 35', 1, 1, 1, 0, NULL, '2017-11-03 15:27:03', 0, NULL, 1, '2017-11-03 14:27:08'),
(36, 'Tache 36', 'Description 36', 1, 1, 1, 0, NULL, '2017-11-03 15:27:06', 0, NULL, 0, NULL),
(37, 'Tache 37', 'Description 37', 1, 2, 1, 0, NULL, '2017-11-03 15:28:38', 0, NULL, 1, '2017-11-03 14:28:47'),
(38, 'Tache 38', 'Description 38', 1, 2, 1, 0, '2017-11-16 15:28:28', '2017-11-03 15:28:42', 1, '2018-02-12 07:48:44', 1, '2017-11-03 14:28:45'),
(39, 'Tache 39', 'Description 39', 1, 3, 1, 0, NULL, '2017-11-03 16:11:08', 0, NULL, 1, '2017-11-03 15:11:13'),
(40, 'Tache 40', 'Description 40', 1, 3, 1, 0, '2017-11-15 16:10:58', '2017-11-03 16:11:24', 1, '2018-02-12 07:48:44', 1, '2017-11-03 15:22:55'),
(41, 'Tache 41', 'Description 41', 1, 3, 1, 0, NULL, '2017-11-03 16:23:21', 0, NULL, 1, '2017-11-03 15:50:34'),
(42, 'Tache 42', 'Description 42', 1, 3, 1, 0, '2017-11-30 12:00:00', '2017-11-27 11:35:13', 1, '2018-02-12 07:48:44', 1, '2017-11-27 12:53:58'),
(43, 'Tache 43', 'Description 43', 1, 3, 1, 0, '2017-11-30 12:00:00', '2017-11-27 11:35:24', 1, '2018-02-12 07:48:44', 1, '2017-11-27 12:53:48'),
(44, 'Tache 44', 'Description 44', 1, 3, 1, 0, NULL, '2017-11-27 13:54:03', 0, NULL, 1, '2017-11-27 12:54:06'),
(45, 'Tache 45', 'Description 45', 1, 3, 1, 0, NULL, '2017-11-27 16:52:48', 0, NULL, 1, '2017-11-27 15:53:01'),
(46, 'Tache 46', 'Description 46', 1, 3, 1, 0, NULL, '2017-11-27 16:52:52', 0, NULL, 1, '2017-11-27 15:53:02'),
(47, 'Tache 47', 'Description 47', 1, 3, 2, 0, NULL, '2017-11-27 16:52:58', 1, '2017-11-28 15:43:39', 0, NULL),
(48, 'Tache 48', 'Description 48', 3, 10, 1, 0, NULL, '2017-11-28 09:12:02', 0, NULL, 1, '2017-11-28 08:14:31'),
(49, 'Tache 49', 'Description 49', 3, 10, 1, 0, NULL, '2017-11-28 09:14:25', 0, NULL, 1, '2017-11-28 08:14:29'),
(50, 'Tache 50', 'Description 50', 3, 11, 1, 0, '2017-11-29 09:15:00', '2017-11-28 09:15:10', 1, '2017-11-29 07:56:02', 0, NULL),
(51, 'Tache 51', 'Description 51', 3, 11, 1, 0, '2017-11-29 09:15:00', '2017-11-28 09:15:17', 0, NULL, 0, NULL),
(52, 'Tache 52', 'Description 52', 1, 3, 1, 0, NULL, '2017-11-28 11:53:21', 0, NULL, 1, '2017-11-28 10:53:24'),
(53, 'Tache 53', 'Description 53', 1, 3, 2, 0, NULL, '2017-11-28 14:43:31', 1, '2018-01-16 12:46:22', 0, NULL),
(54, 'Tache 54', 'Description 54', 1, 3, 2, 0, NULL, '2017-11-28 14:43:48', 0, NULL, 0, NULL),
(55, 'Tache 55', 'Description 55', 1, 3, 2, 0, NULL, '2017-11-28 14:44:56', 0, NULL, 0, NULL),
(56, 'Tache 56', 'Description 56', 1, 3, 1, 0, NULL, '2017-11-28 14:45:05', 0, NULL, 1, '2017-11-28 13:45:32'),
(57, 'Tache 57', 'Description 57', 1, 3, 2, 0, NULL, '2017-11-28 14:45:09', 0, NULL, 0, NULL),
(58, 'Tache 58', 'Description 58', 1, 3, 1, 0, NULL, '2017-11-28 14:45:26', 0, NULL, 1, '2017-11-28 13:45:33'),
(59, 'Tache 59', 'Description 59', 1, 3, 2, 0, NULL, '2017-11-28 14:45:38', 0, NULL, 0, NULL),
(60, 'Tache 60', 'Description 60', 1, 3, 2, 0, NULL, '2017-11-28 14:46:41', 0, NULL, 0, NULL),
(61, 'Tache 61', 'Description 61', 1, 3, 1, 0, NULL, '2017-11-28 15:17:40', 0, NULL, 0, NULL),
(62, 'Tache 62', 'Description 62', 1, 3, 2, 0, NULL, '2017-11-28 15:17:50', 1, '2018-02-12 08:10:17', 0, NULL),
(63, 'Tache 63', 'Description 63', 1, 3, 1, 0, '2017-11-30 21:30:00', '2017-11-28 15:50:30', 1, '2018-02-12 07:48:44', 0, NULL),
(64, 'Tache 64', 'Description 64', 1, 2, 1, 0, NULL, '2017-11-29 15:29:54', 1, '2017-11-29 14:30:40', 0, NULL),
(65, 'Tache 65', 'Description 65', 1, 2, 1, 0, NULL, '2017-11-29 15:30:13', 1, '2017-11-29 14:30:41', 0, NULL),
(66, 'Tache 66', 'Description 66', 1, 2, 1, 0, NULL, '2017-11-29 15:31:06', 1, '2017-11-29 14:31:41', 0, NULL),
(67, 'Tache 67', 'Description 67', 1, 2, 1, 0, NULL, '2017-11-29 15:31:55', 0, NULL, 1, '2017-11-29 14:37:31'),
(68, 'Tache 68', 'Description 68', 1, 2, 1, 0, NULL, '2017-11-29 15:34:12', 1, '2017-11-29 14:41:15', 0, NULL),
(69, 'Tache 69', 'Description 69', 1, 2, 1, 0, NULL, '2017-11-29 15:35:37', 0, NULL, 1, '2017-12-18 13:01:59'),
(70, 'Tache 70', 'Description 70', 1, 2, 1, 0, NULL, '2017-11-29 15:37:45', 0, NULL, 1, '2017-11-29 14:41:20'),
(71, 'Tache 71', 'Description 71', 3, 11, 1, 0, NULL, '2017-12-01 14:38:46', 0, NULL, 1, '2017-12-01 13:39:36'),
(72, 'Tache 72', 'Description 72', 3, 11, 1, 0, NULL, '2017-12-01 14:39:03', 0, NULL, 1, '2017-12-01 13:39:33'),
(73, 'Tache 73', 'Description 73', 3, 11, 1, 0, NULL, '2017-12-01 14:48:40', 0, NULL, 1, '2017-12-01 13:49:09'),
(74, 'Tache 74', 'Description 74', 3, 11, 1, 0, NULL, '2017-12-01 14:49:10', 1, '2017-12-01 13:50:50', 0, NULL),
(75, 'Tache 75', 'Description 75', 3, 11, 1, 0, NULL, '2017-12-01 14:50:07', 0, NULL, 0, NULL),
(76, 'Tache 76', 'Description 76', 3, 11, 1, 0, NULL, '2017-12-01 14:50:12', 0, NULL, 0, NULL),
(77, 'Tache 77', 'Description 77', 3, 11, 1, 0, NULL, '2017-12-01 14:50:41', 0, NULL, 0, NULL),
(78, 'Tache 78', 'Description 78', 3, 11, 1, 0, NULL, '2017-12-01 14:52:44', 0, NULL, 0, NULL),
(79, 'Tache 79', 'Description 79', 1, 2, 1, 0, '2017-12-18 10:20:50', '2017-12-18 09:37:06', 1, '2018-02-12 07:48:44', 0, NULL),
(80, 'Tache 80', 'Description 80', 1, 2, 1, 0, '2017-12-18 10:42:45', '2017-12-18 09:42:53', 1, '2018-02-12 07:48:44', 0, NULL),
(81, 'Tache 81', 'Description 81', 1, 2, 1, 0, '2017-12-18 12:48:19', '2017-12-18 11:49:29', 1, '2018-02-12 07:48:44', 0, NULL),
(82, 'Tache 82', 'Description 82', 1, 2, 1, 0, '2017-12-18 12:48:19', '2017-12-18 11:50:12', 1, NULL, 0, NULL),
(83, 'Tache 83', 'Description 83', 1, 2, 1, 0, '2017-12-18 12:51:36', '2017-12-18 11:51:55', 1, '2018-02-12 07:48:44', 0, NULL),
(84, 'Tache 84', 'Description 84', 1, 2, 1, 0, '2017-12-18 14:58:39', '2017-12-18 13:59:09', 1, '2018-02-12 07:48:44', 1, '2017-12-18 13:02:01'),
(85, 'Tache 85', 'Description 85', 1, 2, 1, 0, '2017-12-18 14:58:39', '2017-12-18 13:59:14', 1, '2018-02-12 07:48:44', 1, '2017-12-18 13:43:02'),
(86, 'Tache 86', 'Description 86', 1, 2, 1, 0, '2017-12-18 14:59:17', '2017-12-18 14:00:35', 1, '2018-02-12 07:48:44', 1, '2017-12-18 13:43:03'),
(87, 'Tache 87', 'Description 87', 1, 2, 2, 0, '2017-12-18 14:59:17', '2017-12-18 14:01:48', 1, '2018-02-12 07:48:44', 1, '2017-12-18 13:43:08'),
(88, 'Tache 88', 'Description 88', 1, 2, 2, 0, '2019-12-18 15:08:51', '2017-12-18 14:09:14', 1, '2018-02-12 08:13:36', 0, NULL),
(89, 'titre x', 'desc x', 1, 2, 1, 0, '2018-01-17 10:24:44', '2018-01-16 09:25:35', 1, '2018-02-12 07:48:44', 0, NULL),
(90, 'titre x2', 'desc x2', 1, 2, 1, 0, '2018-01-16 10:25:59', '2018-01-16 09:27:31', 1, '2018-02-12 07:48:44', 0, NULL),
(91, 'dfgdgf', 'dfgdg', 9, 20, 1, 0, '2018-01-17 14:39:58', '2018-01-17 13:40:07', 1, '2018-02-13 12:36:33', 0, NULL),
(92, 'dfgdgf', 'dfgdg', 9, 20, 1, 0, '2018-01-17 14:39:58', '2018-01-17 13:40:10', 1, '2018-02-13 12:36:33', 0, NULL),
(93, '', '', 9, 24, 1, 0, '2018-01-17 14:42:13', '2018-01-17 13:42:46', 1, '2018-02-13 12:36:33', 0, NULL),
(94, '', '', 9, 24, 1, 0, '2018-01-17 14:42:13', '2018-01-17 13:42:48', 1, '2018-02-13 12:36:33', 0, NULL),
(95, '', '', 9, 24, 1, 0, '2018-01-17 14:42:13', '2018-01-17 13:42:50', 1, '2018-02-13 12:36:33', 0, NULL),
(96, '', '', 9, 24, 1, 0, '2018-01-17 14:42:13', '2018-01-17 13:42:52', 1, '2018-02-13 12:36:33', 0, NULL),
(97, '', '', 9, 24, 1, 0, '2018-01-17 14:42:13', '2018-01-17 13:42:54', 1, '2018-02-13 12:36:33', 0, NULL),
(98, '', '', 9, 24, 1, 0, '2018-01-17 14:42:13', '2018-01-17 13:42:57', 1, '2018-02-13 12:36:33', 0, NULL),
(99, '', '', 9, 24, 1, 0, '2018-01-17 14:42:13', '2018-01-17 13:42:59', 1, '2018-02-13 12:36:33', 0, NULL),
(100, '', '', 9, 24, 1, 0, '2018-01-17 14:42:13', '2018-01-17 13:43:03', 1, '2018-02-13 12:36:33', 0, NULL),
(101, '', '', 9, 24, 1, 0, '2018-01-17 14:42:13', '2018-01-17 13:43:04', 1, '2018-02-13 12:36:33', 0, NULL),
(102, '', '', 9, 33, 1, 0, '2018-01-17 15:04:09', '2018-01-17 14:04:36', 1, '2018-02-13 12:36:33', 0, NULL),
(103, '', '', 9, 33, 1, 0, '2018-01-17 15:04:09', '2018-01-17 14:04:38', 1, '2018-02-13 12:36:33', 0, NULL),
(104, 'ok title 2 "\' xxxx', 'xx', 1, 21, 1, 0, '2018-01-17 15:46:42', '2018-01-17 14:47:17', 1, '2018-02-12 07:48:44', 0, NULL),
(105, 'ok title 2 "\' xxxx2', 'xx', 1, 21, 1, 0, '2018-01-17 15:46:42', '2018-01-17 14:47:23', 1, '2018-02-12 07:48:44', 0, NULL),
(106, 'ok title 2 "\' xxxx2', 'xx', 1, 21, 1, 0, '2018-01-17 15:46:42', '2018-01-17 14:47:26', 1, '2018-02-12 07:48:44', 0, NULL),
(107, 'EXPIRE', '', 9, 34, 1, 0, '2018-01-18 16:02:06', '2018-01-17 15:02:21', 1, '2018-02-13 12:36:33', 1, '2018-01-17 14:03:13'),
(108, 'EXPIRE2', '', 9, 34, 1, 0, '2018-01-18 16:02:06', '2018-01-17 15:03:19', 1, '2018-02-13 12:36:33', 0, NULL),
(109, 'gfdfggdfgdf', 'dfgdfgdfgdfgd', 1, 2, 1, 0, '2018-01-17 16:13:28', '2018-01-17 15:13:35', 1, '2018-02-12 07:48:44', 0, NULL),
(110, '', '', 1, 2, 1, 0, NULL, '2018-01-17 15:21:06', 0, NULL, 0, NULL),
(111, 'erterert', 'terterter', 1, 2, 1, 0, '2018-01-24 16:20:44', '2018-01-17 15:21:14', 1, '2018-02-12 07:48:44', 0, NULL),
(112, '', '', 1, 2, 1, 0, NULL, '2018-01-17 15:21:17', 0, NULL, 0, NULL),
(113, '', '', 1, 2, 1, 0, NULL, '2018-01-17 15:25:11', 0, NULL, 0, NULL),
(114, '', '', 1, 2, 1, 0, NULL, '2018-01-17 15:25:33', 0, NULL, 0, NULL),
(115, '', '', 1, 2, 1, 0, NULL, '2018-01-17 15:26:20', 1, '2018-02-12 07:50:28', 0, NULL),
(116, 'sefsef', 'zrzezer', 9, 34, 1, 0, NULL, '2018-01-17 15:45:26', 0, NULL, 0, NULL),
(117, 'xxx', '', 9, 34, 1, 0, NULL, '2018-01-17 15:45:50', 0, NULL, 0, NULL),
(118, '', '', 9, 34, 1, 0, NULL, '2018-01-17 15:46:12', 0, NULL, 0, NULL),
(119, '', '', 9, 34, 1, 0, NULL, '2018-01-17 15:46:24', 0, NULL, 0, NULL),
(120, '', '', 9, 34, 1, 0, NULL, '2018-01-17 15:47:42', 0, NULL, 0, NULL),
(121, '', '', 9, 34, 1, 0, NULL, '2018-01-17 15:49:33', 0, NULL, 0, NULL),
(122, 'XXX1', '', 1, 1, 1, 0, NULL, '2018-01-17 16:04:45', 0, NULL, 0, NULL),
(123, 'aaaa', 'aa', 1, 2, 1, 0, NULL, '2018-02-12 16:49:35', 0, NULL, 0, NULL),
(124, 'ert', 'ert', 1, 2, 1, 0, NULL, '2018-02-13 10:02:45', 0, NULL, 0, NULL),
(125, 'sdfsdf', 'sdf', 1, 2, 1, 0, NULL, '2018-02-13 10:03:11', 0, NULL, 0, NULL),
(126, 'zer', 'zer', 1, 2, 1, 0, NULL, '2018-02-13 10:03:44', 0, NULL, 0, NULL),
(127, 'Tâche exemple', 'Description de la tâche. Fin.', 1, 38, 1, 0, NULL, '2018-02-13 11:17:45', 1, '2018-02-13 10:18:12', 0, NULL),
(128, 'ser', 'zer', 1, 1, 1, 0, NULL, '2018-02-13 13:44:07', 0, NULL, 0, NULL),
(129, 'aa', 'aa', 1, 1, 1, 0, NULL, '2018-02-13 13:44:35', 0, NULL, 0, NULL),
(130, 'dfsffsffsdsd', 'sdfsdfsd', 1, 2, 1, 0, NULL, '2018-02-13 14:33:05', 0, NULL, 0, NULL),
(131, 'sdfsdsdsdf', 'sdfs', 1, 2, 1, 0, NULL, '2018-02-13 14:35:19', 0, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(150) NOT NULL,
  `address` text,
  `phone_number` int(11) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `address`, `phone_number`, `age`, `last_login`, `created_at`, `deleted_at`, `is_deleted`) VALUES
(1, 'sdtfsdfsdfsdsdfsd', 'me@hello1.fr', '1594244d52f2d8c12b142bb61f47bc2eaf503d6d9ca8480cae9fcf112f66e4967dc5e8fa98285e36db8af1b8ffa8b84cb15e0fbcf836c3deb803c13f37659a60', NULL, NULL, NULL, '2017-09-22 16:06:05', '2017-09-22 16:06:05', NULL, 0),
(2, 'John Doe2', 'me@hello.fr2', '1594244d52f2d8c12b142bb61f47bc2eaf503d6d9ca8480cae9fcf112f66e4967dc5e8fa98285e36db8af1b8ffa8b84cb15e0fbcf836c3deb803c13f37659a60', NULL, NULL, NULL, NULL, '2017-11-02 09:39:13', NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `users_has_projects`
--

CREATE TABLE `users_has_projects` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users_has_projects`
--

INSERT INTO `users_has_projects` (`id`, `user_id`, `project_id`, `created_at`, `deleted_at`, `is_deleted`) VALUES
(1, 1, 1, '2017-10-30 10:00:38', NULL, 0),
(2, 2, 1, '2017-11-02 09:40:32', NULL, 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`,`project_id`),
  ADD KEY `fk_categories_projects1_idx` (`project_id`);

--
-- Index pour la table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`,`task_id`),
  ADD KEY `fk_files_tasks1_idx` (`task_id`);

--
-- Index pour la table `preferences`
--
ALTER TABLE `preferences`
  ADD PRIMARY KEY (`id`,`user_id`),
  ADD KEY `fk_preferences_users1_idx` (`user_id`);

--
-- Index pour la table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_projects_users1_idx` (`linked_admin`),
  ADD KEY `fk_projects_users2_idx` (`linked_manager`);

--
-- Index pour la table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`,`project_id`,`category_id`,`assigned_to`),
  ADD KEY `fk_tasks_users1_idx` (`assigned_to`),
  ADD KEY `fk_tasks_categories1_idx` (`category_id`),
  ADD KEY `fk_tasks_projects1_idx` (`project_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users_has_projects`
--
ALTER TABLE `users_has_projects`
  ADD PRIMARY KEY (`id`,`user_id`,`project_id`),
  ADD KEY `fk_users_has_projects_projects1_idx` (`project_id`),
  ADD KEY `fk_users_has_projects_users_idx` (`user_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT pour la table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;
--
-- AUTO_INCREMENT pour la table `preferences`
--
ALTER TABLE `preferences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT pour la table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `users_has_projects`
--
ALTER TABLE `users_has_projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `fk_categories_projects1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `fk_files_tasks1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `preferences`
--
ALTER TABLE `preferences`
  ADD CONSTRAINT `fk_preferences_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `fk_projects_users1` FOREIGN KEY (`linked_admin`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_projects_users2` FOREIGN KEY (`linked_manager`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `fk_tasks_categories1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tasks_projects1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tasks_users1` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `users_has_projects`
--
ALTER TABLE `users_has_projects`
  ADD CONSTRAINT `fk_users_has_projects_projects1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_has_projects_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
