-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 16 Janvier 2018 à 13:17
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
(18, 1, 'ertertryr', NULL, '2018-01-16 11:44:09', NULL, '2018-01-16 12:56:13', 1);

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
(1, 81, 'IMG_1358.JPG', 1989834, 'image/jpeg', '2017-12-18 11:49:29', '2017-12-19 14:46:36', 0, 0),
(2, 81, 'IMG_1359.JPG', 1841707, 'image/jpeg', '2017-12-18 11:49:29', NULL, 0, 1),
(3, 82, 'IMG_1358.JPG', 1989834, 'image/jpeg', '2017-12-18 11:50:12', NULL, 0, 0),
(4, 82, 'IMG_1359.JPG', 1841707, 'image/jpeg', '2017-12-18 11:50:12', NULL, 0, 0),
(5, 82, 'IMG_1360.JPG', 1985031, 'image/jpeg', '2017-12-18 11:50:12', '2017-12-19 15:14:54', 0, 0),
(6, 82, 'intro.jpg', 271831, 'image/jpeg', '2017-12-18 11:50:12', NULL, 0, 0),
(7, 83, 'IMG_1358.JPG', 1989834, 'image/jpeg', '2017-12-18 11:51:55', NULL, 0, 0),
(8, 87, 'IMG_1360.JPG', 1985031, 'image/jpeg', '2017-12-18 14:01:48', NULL, 0, 0),
(9, 87, 'intro.jpg', 271831, 'image/jpeg', '2017-12-18 14:01:48', NULL, 0, 0),
(10, 88, 'IMG_1360.JPG', 1985031, 'image/jpeg', '2017-12-18 14:09:14', NULL, 0, 0),
(11, 88, 'intro.jpg', 271831, 'image/jpeg', '2017-12-18 14:09:14', NULL, 0, 0),
(12, 89, 'IMG_1359.JPG', 1841707, 'image/jpeg', '2018-01-16 09:25:35', NULL, 0, 1),
(13, 89, 'IMG_1360.JPG', 1985031, 'image/jpeg', '2018-01-16 09:25:35', NULL, 0, 1),
(14, 90, 'IMG_1358.JPG', 1989834, 'image/jpeg', '2018-01-16 09:27:31', NULL, 0, 1),
(15, 90, 'IMG_1359.JPG', 1841707, 'image/jpeg', '2018-01-16 09:27:31', NULL, 0, 1),
(16, 90, 'IMG_1360.JPG', 1985031, 'image/jpeg', '2018-01-16 09:27:31', NULL, 0, 1),
(17, 90, 'intro.jpg', 271831, 'image/jpeg', '2018-01-16 09:27:31', NULL, 0, 1);

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
(9, 1, NULL, 'Projet 2', 'description bnah blah', '2018-01-15 16:21:58', NULL, NULL, 0);

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
(1, 'Tache 1', 'Description 1', 1, 2, 1, 1, '2017-10-05 00:00:00', '2017-10-04 16:29:53', 0, NULL, 1, '2017-11-03 10:07:09'),
(2, 'Tache 2', 'Description 2', 1, 2, 1, 0, '2017-11-09 11:35:00', '2017-11-02 11:58:11', 0, NULL, 0, NULL),
(3, 'Tache 3', 'Description 3', 1, 2, 1, 0, '2017-11-08 09:43:00', '2017-11-03 09:43:48', 0, NULL, 0, NULL),
(4, 'Tache 4', 'Description 4', 1, 2, 1, 0, '2017-11-08 09:43:00', '2017-11-03 09:43:53', 0, NULL, 1, '2017-11-03 14:26:50'),
(5, 'Tache 5', 'Description 5', 1, 2, 1, 0, '2017-11-08 09:43:00', '2017-11-03 09:43:55', 0, NULL, 1, '2017-11-03 14:26:52'),
(6, 'Tache 6', 'Description 6', 1, 2, 1, 0, '2017-11-08 09:43:00', '2017-11-03 09:43:57', 0, NULL, 1, '2017-11-03 14:26:54'),
(7, 'Tache 7', 'Description 7', 1, 2, 1, 0, '2017-11-07 09:43:00', '2017-11-03 09:44:52', 0, NULL, 0, NULL),
(8, 'Tache 8', 'Description 8', 1, 2, 2, 0, '2017-11-03 08:45:10', '2017-11-03 09:45:10', 0, NULL, 0, NULL),
(9, 'Tache 9', 'Description 9', 1, 2, 2, 0, '2017-11-03 08:45:17', '2017-11-03 09:45:17', 0, NULL, 0, NULL),
(10, 'Tache 10', 'Description 10', 1, 2, 1, 0, '2017-11-03 08:45:59', '2017-11-03 09:45:59', 0, NULL, 1, '2017-11-03 14:26:56'),
(11, 'Tache 11', 'Description 11', 1, 2, 1, 0, '2017-11-03 08:46:05', '2017-11-03 09:46:05', 0, NULL, 0, NULL),
(12, 'Tache 12', 'Description 12', 1, 2, 1, 0, '2017-11-03 08:49:21', '2017-11-03 09:49:21', 0, NULL, 0, NULL),
(13, 'Tache 13', 'Description 13', 1, 3, 1, 0, '2017-11-17 09:54:00', '2017-11-03 09:54:49', 0, NULL, 1, '2017-11-03 10:14:52'),
(15, 'Tache 15', 'Description 15', 1, 1, 1, 0, NULL, '2017-11-03 10:31:02', 0, NULL, 0, NULL),
(16, 'Tache 16', 'Description 16', 1, 3, 1, 0, NULL, '2017-11-03 11:14:59', 0, NULL, 1, '2017-11-03 10:15:03'),
(17, 'Tache 17', 'Description 17', 1, 3, 1, 0, '2017-11-03 11:13:49', '2017-11-03 11:15:08', 0, NULL, 1, '2017-11-03 10:15:11'),
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
(38, 'Tache 38', 'Description 38', 1, 2, 1, 0, '2017-11-16 15:28:28', '2017-11-03 15:28:42', 0, NULL, 1, '2017-11-03 14:28:45'),
(39, 'Tache 39', 'Description 39', 1, 3, 1, 0, NULL, '2017-11-03 16:11:08', 0, NULL, 1, '2017-11-03 15:11:13'),
(40, 'Tache 40', 'Description 40', 1, 3, 1, 0, '2017-11-15 16:10:58', '2017-11-03 16:11:24', 0, NULL, 1, '2017-11-03 15:22:55'),
(41, 'Tache 41', 'Description 41', 1, 3, 1, 0, NULL, '2017-11-03 16:23:21', 0, NULL, 1, '2017-11-03 15:50:34'),
(42, 'Tache 42', 'Description 42', 1, 3, 1, 0, '2017-11-30 12:00:00', '2017-11-27 11:35:13', 0, NULL, 1, '2017-11-27 12:53:58'),
(43, 'Tache 43', 'Description 43', 1, 3, 1, 0, '2017-11-30 12:00:00', '2017-11-27 11:35:24', 0, NULL, 1, '2017-11-27 12:53:48'),
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
(62, 'Tache 62', 'Description 62', 1, 3, 2, 0, NULL, '2017-11-28 15:17:50', 0, NULL, 0, NULL),
(63, 'Tache 63', 'Description 63', 1, 3, 1, 0, '2017-11-30 21:30:00', '2017-11-28 15:50:30', 0, NULL, 0, NULL),
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
(79, 'Tache 79', 'Description 79', 1, 2, 1, 0, '2017-12-18 10:20:50', '2017-12-18 09:37:06', 0, NULL, 0, NULL),
(80, 'Tache 80', 'Description 80', 1, 2, 1, 0, '2017-12-18 10:42:45', '2017-12-18 09:42:53', 0, NULL, 0, NULL),
(81, 'Tache 81', 'Description 81', 1, 2, 1, 0, '2017-12-18 12:48:19', '2017-12-18 11:49:29', 0, NULL, 0, NULL),
(82, 'Tache 82', 'Description 82', 1, 2, 1, 0, '2017-12-18 12:48:19', '2017-12-18 11:50:12', 0, NULL, 0, NULL),
(83, 'Tache 83', 'Description 83', 1, 2, 1, 0, '2017-12-18 12:51:36', '2017-12-18 11:51:55', 0, NULL, 0, NULL),
(84, 'Tache 84', 'Description 84', 1, 2, 1, 0, '2017-12-18 14:58:39', '2017-12-18 13:59:09', 0, NULL, 1, '2017-12-18 13:02:01'),
(85, 'Tache 85', 'Description 85', 1, 2, 1, 0, '2017-12-18 14:58:39', '2017-12-18 13:59:14', 0, NULL, 1, '2017-12-18 13:43:02'),
(86, 'Tache 86', 'Description 86', 1, 2, 1, 0, '2017-12-18 14:59:17', '2017-12-18 14:00:35', 0, NULL, 1, '2017-12-18 13:43:03'),
(87, 'Tache 87', 'Description 87', 1, 2, 2, 0, '2017-12-18 14:59:17', '2017-12-18 14:01:48', 0, NULL, 1, '2017-12-18 13:43:08'),
(88, 'Tache 88', 'Description 88', 1, 2, 2, 0, '2019-12-18 15:08:51', '2017-12-18 14:09:14', 0, NULL, 0, NULL),
(89, 'titre x', 'desc x', 1, 2, 1, 0, '2018-01-17 10:24:44', '2018-01-16 09:25:35', 0, NULL, 0, NULL),
(90, 'titre x2', 'desc x2', 1, 2, 1, 0, '2018-01-16 10:25:59', '2018-01-16 09:27:31', 0, NULL, 0, NULL);

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
(1, 'John Doe1', 'me@hello1.fr', '1594244d52f2d8c12b142bb61f47bc2eaf503d6d9ca8480cae9fcf112f66e4967dc5e8fa98285e36db8af1b8ffa8b84cb15e0fbcf836c3deb803c13f37659a60', NULL, NULL, NULL, '2017-09-22 16:06:05', '2017-09-22 16:06:05', NULL, 0),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT pour la table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pour la table `preferences`
--
ALTER TABLE `preferences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;
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
