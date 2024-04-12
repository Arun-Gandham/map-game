-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2024 at 10:33 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `map_game`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `max_time` int(11) NOT NULL,
  `image` text DEFAULT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `name`, `max_time`, `image`, `description`, `created_at`, `updated_at`) VALUES
(10, 'Theo game testing', 200, 'a:1:{i:0;s:62:\"uploads/games/10/1709919720_1_wallpaperflare.com_wallpaper.jpg\";}', 'testing theo gametesting theo gametesting theo gametesting theo gametesting theo gametesting theo gametesting theo gametesting theo gametesting theo game', '2024-03-08 12:12:00', '2024-03-08 12:12:00'),
(11, 'testing', 234, 'a:1:{i:0;s:44:\"uploads/games/11/1709964077_1_BEN0289414.jpg\";}', 'asdfasfd', '2024-03-09 00:31:17', '2024-03-09 00:31:17');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `game_id` bigint(20) NOT NULL,
  `p_count` int(11) NOT NULL,
  `date` date NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `game_id`, `p_count`, `date`, `description`, `created_at`, `updated_at`) VALUES
(3, 'Test group', 1, 3, '2024-02-15', 'Test description', '2024-02-10 08:44:25', '2024-02-10 08:44:25'),
(4, 'gowtham', 2, 2, '2024-02-20', 'asdfghjk', '2024-02-10 12:32:15', '2024-02-10 12:32:15');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(52, '2014_10_12_000000_create_users_table', 1),
(53, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(54, '2019_08_19_000000_create_failed_jobs_table', 1),
(55, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(56, '2024_02_10_155249_create_types_table', 1),
(58, '2024_02_10_211406_create_games_table', 2),
(59, '2024_03_01_114402_create_games_table', 3),
(60, '2024_03_02_085941_create_points_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `points`
--

CREATE TABLE `points` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(200) NOT NULL,
  `game_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `lat_long` varchar(100) NOT NULL,
  `distance` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `question` text NOT NULL,
  `question_des` text NOT NULL,
  `options` text NOT NULL,
  `answer` int(11) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `points`
--

INSERT INTO `points` (`id`, `title`, `game_id`, `type`, `lat_long`, `distance`, `image`, `description`, `created_at`, `updated_at`, `question`, `question_des`, `options`, `answer`, `score`) VALUES
(1, '243', 0, 6, '1234123', 41234123, NULL, 'tsesers', '2024-03-02 05:35:00', '2024-03-02 05:35:00', 'tsesers', 'tsesers', '', 0, 0),
(2, '', 0, 6, '1234123', 41234123, NULL, 'tsesers', '2024-03-02 05:35:14', '2024-03-02 05:35:14', 'tsesers', 'tsesers', '', 0, 0),
(3, 'sadfasd', 2, 5, '234423,234243', 234234, NULL, 'tests', '2024-03-02 05:39:55', '2024-03-02 05:39:55', 'tests', 'tests', '', 0, 0),
(4, 'fasdfasd', 2, 6, '23423234', 324234, NULL, '24234234', '2024-03-02 05:40:41', '2024-03-02 05:40:41', '24234234', '24234234', '', 0, 0),
(5, 'test', 2, 6, '234234', 2342, NULL, 'asdfasdf', '2024-03-02 06:12:29', '2024-03-02 06:12:29', 'asdfasdf', 'asdfasdf', '', 0, 0),
(6, 'sdfgsdfg', 2, 5, 'g345345', 435345, NULL, 'sdgfsdf', '2024-03-02 06:41:25', '2024-03-02 06:41:25', 'fasfdas', 'asdfasdf', 'a:4:{i:0;s:16:\"asdfasdfasdfasdf\";i:1;s:10:\"fasdffasdf\";i:2;s:18:\"fasdfasdf asdf asd\";i:3;s:18:\"fasdfasf asdf asfd\";}', 0, 0),
(7, 'test', 4, 5, '2342,234', 234, NULL, '32424', '2024-03-02 09:31:14', '2024-03-02 09:31:14', 'rqerqwr', 'rqwerq werqwer', 'a:1:{i:0;s:8:\"rqwerqwr\";}', 0, 0),
(8, '2341', 4, 5, '123412341234,12341234', 412341, NULL, 'qwfqsdfsd', '2024-03-02 09:31:46', '2024-03-02 09:31:46', 'fasdfafadf', 'as fasfasdf asdf asdf', 'a:2:{i:0;s:15:\"asdfasdfas fasf\";i:1;s:14:\"a sdfasdf asdf\";}', 0, 0),
(9, 'Kondapur Point', 7, 6, '17.467579,78.692345', 100, 'uploads/points/9/1709880799_wallpaperflare.com_wallpaper.jpg', 'Missing unserialize() Function: In the @foreach loop, you\'re using unserialize($game->image). Ensure that $game->image is serialized data and that the unserialize() function is available if it\'s custom functionality.\r\n\r\nDuplicate ID Usage: Ensure that the IDs used for HTML elements are unique within the document. You have used map as an ID for a <div> and also as a JavaScript variable name. Make sure they don\'t conflict.\r\n\r\nDisabling and Enabling Form Elements: You\'re disabling and enabling form elements based on geolocation availability. Ensure that these elements are properly initialized and handled within your application\'s logic.', '2024-03-05 10:57:22', '2024-03-08 01:53:31', 'test quetion 123', 'test quesiton123', 'a:5:{i:0;s:8:\"option 1\";i:1;s:8:\"option 2\";i:2;s:8:\"option 3\";i:3;s:9:\"option  4\";i:4;s:19:\"Options 66666666666\";}', 0, 0),
(10, 'Jblihils point', 7, 6, '17.4295,78.4127', 100000, 'uploads/points/10/1709879222_image.png', 'Missing unserialize() Function: In the @foreach loop, you\'re using unserialize($game->image). Ensure that $game->image is serialized data and that the unserialize() function is available if it\'s custom functionality.\r\n\r\nDuplicate ID Usage: Ensure that the IDs used for HTML elements are unique within the document. You have used map as an ID for a <div> and also as a JavaScript variable name. Make sure they don\'t conflict.\r\n\r\nDisabling and Enabling Form Elements: You\'re disabling and enabling form elements based on geolocation availability. Ensure that these elements are properly initialized and handled within your application\'s logic.', '2024-03-05 11:00:41', '2024-03-08 07:37:39', 'jubli hills test point', 'jubli hills tet desc', 'a:5:{i:0;s:11:\"jb option 1\";i:1;s:11:\"jb option 2\";i:2;s:11:\"jb option 3\";i:3;s:11:\"jb option 4\";i:4;s:18:\"Option 55555555555\";}', 2, 0),
(11, 'aefasdf', 7, 5, '234423,234243', 234, NULL, 'sdfasdf', '2024-03-07 22:48:31', '2024-03-08 05:09:22', 'fasdf', 'fadfdasf', 'a:3:{i:0;s:8:\"sadfasdf\";i:1;s:6:\"fasdfa\";i:2;s:8:\"fasdfasf\";}', 4, 0),
(12, 'sdfgsdfg', 7, 5, '234423,234243', 345, 'uploads/points/12/1709893169_BEN0289414.jpg', 'gsdgfsdg', '2024-03-08 04:49:29', '2024-03-08 04:49:29', 'gsdfgsd', 'sdfgsdfg', 'a:2:{i:0;s:8:\"sgdfsdfg\";i:1;s:7:\"gsdgsdf\";}', 3, 0),
(13, 'car point', 8, 9, '17.507598,78.396131', 2000, 'uploads/points/13/1709910297_image (1).png', 'NCR Voyix, the NCR Voyix logo, and associated marks are trademarks owned by NCR Voyix Corporation.\r\nNCR Atleos, the NCR Atleos logo, and associated marks are trademark owned by NCR Atleos Corporation.NCR Voyix, the NCR Voyix logo, and associated marks are trademarks owned by NCR Voyix Corporation.\r\nNCR Atleos, the NCR Atleos logo, and associated marks are trademark owned by NCR Atleos Corporation.', '2024-03-08 09:34:57', '2024-03-08 09:34:57', 'What is the car color to your right', 'What is the car color to your right What is the car color to your right What is the car color to your right What is the car color to your right What is the car color to your right What is the car color to your right', 'a:4:{i:0;s:3:\"red\";i:1;s:5:\"Green\";i:2;s:6:\"Yellow\";i:3;s:5:\"Brown\";}', 2, 0),
(14, 'Green car', 8, 10, '17.494944,78.399734', 10000, 'uploads/points/14/1709910548_image.png', 'greenc ar testing sitegreenc ar testing sitegreenc ar testing sitegreenc ar testing sitegreenc ar testing sitegreenc ar testing sitegreenc ar testing sitegreenc ar testing sitegreenc ar testing sitegreenc ar testing sitegreenc ar testing sitegreenc ar testing sitegreenc ar testing sitegreenc ar testing sitegreenc ar testing sitegreenc ar testing site', '2024-03-08 09:39:08', '2024-03-08 09:39:08', 'what is the green color name', 'what is the green color namewhat is the green color namewhat is the green color namewhat is the green color name', 'a:4:{i:0;s:5:\"green\";i:1;s:3:\"red\";i:2;s:5:\"brown\";i:3;s:6:\"orange\";}', 3, 0),
(15, 'Red car door detect', 10, 9, '17.517681, 78.395255', 13000000, 'uploads/points/15/1709919838_image (1).png', 'testing desctesting desctesting desctesting desctesting desctesting desctesting desctesting desctesting desctesting desctesting desc', '2024-03-08 12:13:58', '2024-03-25 02:02:59', 'Get me the door color of red car', 'Find the car door color and select the correct answer', 'a:4:{i:0;s:11:\"Brown Color\";i:1;s:10:\"Gray Color\";i:2;s:11:\"Green Color\";i:3;s:7:\"No Door\";}', 2, 342),
(16, 'Green tree find', 10, 10, '17.510764, 78.443250', 500000000, 'uploads/points/16/1709919930_wallpaperflare.com_wallpaper.jpg', 'testign point testign point testign point testign point testign point testign point testign point testign point testign point testign point testign point testign point testign point testign point testign point', '2024-03-08 12:15:30', '2024-03-25 02:03:10', 'Give me branchs count for the tree', 'Give me branchs count for the tree', 'a:6:{i:0;s:1:\"2\";i:1;s:1:\"4\";i:2;s:1:\"6\";i:3;s:1:\"7\";i:4;s:1:\"1\";i:5;s:1:\"0\";}', 3, 34),
(17, 'Madhapur location', 11, 9, '17.448294,78.391487', 100000, 'uploads/points/17/1709968077_BEN01258.jpg', 'testing', '2024-03-09 01:37:57', '2024-03-09 01:37:57', 'test', 'test', 'a:5:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";i:3;s:1:\"4\";i:4;s:1:\"5\";}', 3, 10);

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `team_name` varchar(200) NOT NULL,
  `score` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `game_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `game_id`, `created_at`, `updated_at`) VALUES
(1, 'testing name', 7, '2024-03-08 07:30:16', '2024-03-08 07:30:16'),
(2, 'hello world game', 7, '2024-03-08 07:36:57', '2024-03-08 07:36:57'),
(3, 'Arun sai', 8, '2024-03-08 09:35:19', '2024-03-08 09:35:19'),
(4, 'test', 8, '2024-03-08 09:39:35', '2024-03-08 09:39:35'),
(5, 'test', 7, '2024-03-08 10:04:48', '2024-03-08 10:04:48'),
(6, 'Dev testing', 10, '2024-03-08 12:16:09', '2024-03-08 12:16:09'),
(7, 'test', 11, '2024-03-09 01:02:59', '2024-03-09 01:02:59'),
(8, 'test', 11, '2024-03-09 01:04:55', '2024-03-09 01:04:55'),
(9, 'test', 11, '2024-03-09 01:36:17', '2024-03-09 01:36:17'),
(10, 'test', 11, '2024-03-22 12:47:57', '2024-03-22 12:47:57'),
(11, 'asdfg', 11, '2024-03-24 11:29:23', '2024-03-24 11:29:23'),
(12, 'new test game', 11, '2024-03-25 01:29:09', '2024-03-25 01:29:09'),
(13, 'test', 10, '2024-03-25 01:58:38', '2024-03-25 01:58:38'),
(14, 'tset', 10, '2024-03-25 02:00:00', '2024-03-25 02:00:00'),
(15, 'test', 10, '2024-03-25 02:06:04', '2024-03-25 02:06:04'),
(16, 'mee', 11, '2024-03-25 02:06:29', '2024-03-25 02:06:29'),
(17, 'asfsdf', 10, '2024-03-25 02:06:43', '2024-03-25 02:06:43');

-- --------------------------------------------------------

--
-- Table structure for table `team_points`
--

CREATE TABLE `team_points` (
  `id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `point_id` int(11) NOT NULL,
  `selected_option` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team_points`
--

INSERT INTO `team_points` (`id`, `team_id`, `point_id`, `selected_option`, `created_at`, `updated_at`) VALUES
(1, 2, 10, 2, '2024-03-08 07:45:59', '2024-03-08 07:45:59'),
(2, 3, 13, 1, '2024-03-08 09:35:58', '2024-03-08 09:35:58'),
(3, 5, 10, 1, '2024-03-08 10:05:12', '2024-03-08 10:05:12'),
(4, 5, 10, 1, '2024-03-08 10:07:41', '2024-03-08 10:07:41'),
(5, 5, 10, 3, '2024-03-08 10:08:21', '2024-03-08 10:08:21'),
(6, 5, 10, 2, '2024-03-08 10:09:46', '2024-03-08 10:09:46'),
(7, 6, 15, 2, '2024-03-08 12:17:48', '2024-03-08 12:17:48'),
(8, 9, 17, 2, '2024-03-09 01:38:09', '2024-03-09 01:38:09'),
(9, 9, 17, 3, '2024-03-09 01:38:22', '2024-03-09 01:38:22'),
(10, 9, 17, 5, '2024-03-09 01:38:32', '2024-03-09 01:38:32'),
(11, 9, 17, 3, '2024-03-09 01:44:56', '2024-03-09 01:44:56'),
(12, 9, 17, 1, '2024-03-09 01:45:42', '2024-03-09 01:45:42'),
(13, 9, 17, 2, '2024-03-09 01:47:22', '2024-03-09 01:47:22'),
(14, 9, 17, 4, '2024-03-09 01:49:19', '2024-03-09 01:49:19'),
(15, 17, 16, 3, '2024-03-25 02:07:09', '2024-03-25 02:07:09'),
(16, 17, 15, 2, '2024-03-25 02:07:35', '2024-03-25 02:07:35'),
(17, 17, 16, 3, '2024-03-25 02:08:36', '2024-03-25 02:08:36'),
(18, 17, 15, 3, '2024-03-25 02:09:02', '2024-03-25 02:09:02');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `color` varchar(255) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `name`, `color`, `description`, `created_at`, `updated_at`) VALUES
(5, 'sdfghjkl', '#ea5455', 'dfghjkl;', '2024-02-27 11:21:47', '2024-02-27 11:21:47'),
(6, 'test', '#ea5455', 'wetw', '2024-03-02 05:25:19', '2024-03-02 05:25:19'),
(7, 'test', '#fd7e14', 'test', '2024-03-02 07:38:54', '2024-03-02 07:38:54'),
(8, 'qqqqqqqq', '#0011ff', 'test', '2024-03-02 07:39:37', '2024-03-02 07:40:58'),
(9, 'red', '#ff0000', 'test desc', '2024-03-08 09:30:19', '2024-03-08 09:30:19'),
(10, 'Green', '#00ff04', 'test desc', '2024-03-08 09:30:44', '2024-03-08 09:30:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$12$AJfF9Afw0k.xPsPP/Uy0ieV/jFfWd2hmWjrAz0328rT84w4LZ8wIq', NULL, '2024-02-12 07:12:28', '2024-02-12 07:12:28'),
(3, 'gowtham', 'gowthamnandipati7@gmail.com', NULL, '$2y$12$f.bz3WoB2h3rHs1HCuWa0.kjVNH3Vd5iow7hmRdzgI6VuAZLwfceK', NULL, '2024-02-27 07:23:20', '2024-02-27 07:23:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `points`
--
ALTER TABLE `points`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team_points`
--
ALTER TABLE `team_points`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `points`
--
ALTER TABLE `points`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `team_points`
--
ALTER TABLE `team_points`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
