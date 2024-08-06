-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 22, 2024 at 09:33 PM
-- Server version: 8.0.30-0ubuntu0.20.04.2
-- PHP Version: 8.2.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `anilock`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` bigint UNSIGNED NOT NULL,
  `device_id` bigint UNSIGNED NOT NULL,
  `username` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `action` tinyint NOT NULL DEFAULT '1',
  `start_at` datetime DEFAULT NULL,
  `end_at` datetime DEFAULT NULL,
  `server_side` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `device_id`, `username`, `password`, `action`, `start_at`, `end_at`, `server_side`, `created_at`, `updated_at`) VALUES
(1, 1, 'username', 'password', 0, '2024-05-15 10:59:07', NULL, 1, NULL, NULL),
(9, 1, 'usss', 'psss', 1, '2024-05-27 00:38:00', '2024-06-11 00:38:00', 1, '2024-05-31 16:41:13', '2024-05-31 16:41:13'),
(10, 2, 'peeeee', 'weeeee', 1, '2024-06-01 00:55:00', '2024-06-12 00:55:00', 1, '2024-05-31 16:57:51', '2024-05-31 16:57:51'),
(11, 1, 'peeeee', 'weeeee', 1, '2024-06-01 00:55:00', '2024-06-12 00:55:00', 1, '2024-05-31 16:57:51', '2024-05-31 16:57:51'),
(12, 1, 'testuser', 'testpass', 1, NULL, NULL, 1, '2024-06-16 10:28:30', '2024-06-16 10:28:30');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ssid` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `imei` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ups_status` tinyint(1) NOT NULL DEFAULT '0',
  `door_status` tinyint(1) NOT NULL DEFAULT '0',
  `relay_module` tinyint(1) NOT NULL DEFAULT '0',
  `relay_module_terminal` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `lock_status1` tinyint(1) DEFAULT NULL,
  `lock_status2` tinyint(1) DEFAULT NULL,
  `bat_status` int NOT NULL,
  `rssi` int NOT NULL,
  `alarm_status` tinyint(1) NOT NULL,
  `temperature` float NOT NULL DEFAULT '25',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `alive_at` datetime DEFAULT '1970-01-01 00:00:00',
  `door_status_updated` tinyint(1) DEFAULT '0',
  `alarm_status_updated` tinyint(1) DEFAULT '0',
  `terminal1_title` char(255) COLLATE utf8mb4_unicode_ci DEFAULT 'ماژول 1',
  `terminal2_title` char(255) COLLATE utf8mb4_unicode_ci DEFAULT 'ماژول 2',
  `terminal3_title` char(255) COLLATE utf8mb4_unicode_ci DEFAULT 'ماژول 3',
  `terminal4_title` char(255) COLLATE utf8mb4_unicode_ci DEFAULT 'ماژول 4',
  `terminal5_title` char(255) COLLATE utf8mb4_unicode_ci DEFAULT 'ماژول 5',
  `terminal6_title` char(255) COLLATE utf8mb4_unicode_ci DEFAULT 'ماژول 6',
  `terminal7_title` char(255) COLLATE utf8mb4_unicode_ci DEFAULT 'ماژول 7',
  `terminal8_title` char(255) COLLATE utf8mb4_unicode_ci DEFAULT 'ماژول 8'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id`, `user_id`, `status`, `name`, `ssid`, `password`, `imei`, `ups_status`, `door_status`, `relay_module`, `relay_module_terminal`, `lock_status1`, `lock_status2`, `bat_status`, `rssi`, `alarm_status`, `temperature`, `created_at`, `updated_at`, `alive_at`, `door_status_updated`, `alarm_status_updated`, `terminal1_title`, `terminal2_title`, `terminal3_title`, `terminal4_title`, `terminal5_title`, `terminal6_title`, `terminal7_title`, `terminal8_title`) VALUES
(1, 1, 1, 'sajad', '123456', 'pass85', 'imei', 0, 0, 1, 61, 0, 0, 3, 21, 0, 25, NULL, '2024-06-22 14:32:57', '2024-06-22 19:02:57', 1, 0, 'ماژول 1', 'ماژول 85', 'ماژول 3', 'ماژول 69', 'ماژول 5', 'ماژول 6', 'ماژول 7', 'ماژول 8'),
(2, 1, 0, '-', '0', '', 'aaaa', 0, 0, 0, 0, 0, 0, 0, 0, 0, 25, '2024-05-24 14:52:15', '2024-05-24 14:52:15', '1970-01-01 00:00:00', 0, 0, 'ماژول 1', 'ماژول 2', 'ماژول 3', 'ماژول 4', 'ماژول 5', 'ماژول 6', 'ماژول 7', 'ماژول 8');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` bigint UNSIGNED NOT NULL,
  `device_id` bigint UNSIGNED NOT NULL,
  `organization_id` bigint UNSIGNED DEFAULT NULL,
  `username` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `field` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `server_side` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `alerted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `device_id`, `organization_id`, `username`, `field`, `value`, `server_side`, `created_at`, `updated_at`, `alerted`) VALUES
(1, 1, 1, 'admin', 'door_status', 'فعال', 1, '2024-05-30 07:05:33', '2024-06-06 16:27:53', 1),
(2, 1, 1, 'admin', 'lock_status2', 'غیرفعال', 1, '2024-06-06 05:20:22', '2024-06-06 16:27:53', 1),
(6, 1, 1, 'username', 'alarm_status', 'فعال', 0, '2024-06-06 09:27:08', '2024-06-06 16:27:53', 1),
(7, 1, 1, 'admin', 'door_status', 'غیرفعال', 1, '2024-06-06 13:14:38', '2024-06-06 16:27:53', 1),
(8, 1, 1, 'admin', 'lock_status1', 'غیرفعال', 1, '2024-06-06 15:52:20', '2024-06-06 16:27:53', 1),
(9, 1, 1, 'admin', 'ups_status', 'غیرفعال', 1, '2024-06-06 15:52:22', '2024-06-06 16:27:53', 1),
(10, 1, 1, 'admin', 'door_status', 'فعال', 1, '2024-06-06 15:52:24', '2024-06-06 16:27:53', 1),
(11, 1, 1, 'admin', 'ups_status', 'فعال', 1, '2024-06-06 15:53:06', '2024-06-06 16:27:53', 1),
(12, 1, 1, 'admin', 'door_status', 'غیرفعال', 1, '2024-06-06 15:53:07', '2024-06-06 16:27:53', 1),
(13, 1, 1, 'admin', 'relay_module_terminal8', 'غیرفعال', 1, '2024-06-06 15:53:34', '2024-06-06 16:27:53', 1),
(14, 1, 1, 'admin', 'relay_module_terminal1', 'غیرفعال', 1, '2024-06-06 15:53:36', '2024-06-06 16:27:53', 1),
(15, 1, 1, 'admin', 'relay_module_terminal2', 'غیرفعال', 1, '2024-06-06 15:54:08', '2024-06-06 16:27:53', 1),
(16, 1, 1, 'admin', 'relay_module_terminal4', 'غیرفعال', 1, '2024-06-06 15:58:04', '2024-06-06 16:27:53', 1),
(17, 1, 1, 'admin', 'relay_module_terminal1', 'فعال', 1, '2024-06-06 15:58:08', '2024-06-06 16:27:53', 1),
(18, 1, 1, 'admin', 'relay_module_terminal4', 'غیرفعال', 1, '2024-06-06 15:58:10', '2024-06-06 16:27:53', 1),
(19, 1, 1, 'admin', 'relay_module_terminal1', 'فعال', 1, '2024-06-06 16:02:23', '2024-06-06 16:27:53', 1),
(20, 1, 1, 'admin', 'alarm_status', 'غیرفعال', 1, '2024-06-06 16:02:30', '2024-06-06 16:27:53', 1),
(21, 1, 1, 'admin', 'relay_module_terminal2', 'فعال', 1, '2024-06-06 16:04:33', '2024-06-06 16:27:53', 1),
(22, 1, 1, 'admin', 'relay_module_terminal4', 'فعال', 1, '2024-06-06 16:04:35', '2024-06-06 16:27:53', 1),
(23, 1, 1, 'admin', 'relay_module', 'غیرفعال', 1, '2024-06-15 13:51:58', '2024-06-15 14:10:41', 1),
(24, 1, 1, 'admin', 'relay_module', 'فعال', 1, '2024-06-15 13:52:00', '2024-06-15 14:10:41', 1),
(25, 1, 1, 'admin', 'relay_module', 'غیرفعال', 1, '2024-06-16 07:33:26', '2024-06-16 07:42:49', 1),
(26, 1, 1, 'admin', 'relay_module', 'فعال', 1, '2024-06-16 07:33:30', '2024-06-16 07:42:49', 1),
(27, 1, 1, 'admin', 'terminal2_title', 'ماژول', 1, '2024-06-16 08:06:18', '2024-06-16 08:07:47', 1),
(28, 1, 1, 'admin', 'ssid', '12345', 1, '2024-06-16 08:06:25', '2024-06-16 08:07:47', 1),
(29, 1, 1, 'admin', 'door_status', 'فعال', 1, '2024-06-16 08:07:57', '2024-06-16 08:08:31', 1),
(30, 1, 1, 'admin', 'ssid', '1234567', 1, '2024-06-16 08:08:07', '2024-06-16 08:08:31', 1),
(31, 1, 1, 'admin', 'ssid', '12345', 1, '2024-06-16 08:08:11', '2024-06-16 08:08:31', 1),
(32, 1, 1, 'admin', 'ssid', '123456', 1, '2024-06-16 08:08:16', '2024-06-16 08:08:31', 1),
(33, 1, 1, 'admin', 'terminal2_title', 'ماژول 85', 1, '2024-06-16 08:08:29', '2024-06-16 08:08:31', 1),
(34, 1, 1, 'admin', 'relay_module_terminal2', 'غیرفعال', 1, '2024-06-16 08:10:43', '2024-06-16 08:10:45', 1),
(35, 1, 1, 'admin', 'افزودن کاربر', 'یوزرنیم testuser', 1, '2024-06-16 10:28:30', '2024-06-17 15:37:11', 1),
(36, 1, 1, 'admin', 'relay_module_terminal4', 'غیرفعال', 1, '2024-06-20 03:50:25', '2024-06-21 03:08:09', 1),
(37, 1, 1, 'admin', 'relay_module_terminal4', 'فعال', 1, '2024-06-20 03:50:26', '2024-06-21 03:08:09', 1),
(38, 1, 1, 'admin', 'terminal4_title', 'ماژول 69', 1, '2024-06-20 03:50:34', '2024-06-21 03:08:09', 1),
(39, 1, 1, 'admin', 'door_status', 'غیرفعال', 1, '2024-06-20 03:50:36', '2024-06-21 03:08:09', 1),
(40, 1, 1, 'admin', 'ups_status', 'غیرفعال', 1, '2024-06-20 03:50:43', '2024-06-21 03:08:09', 1),
(41, 1, 1, 'admin', 'ups_status', 'فعال', 1, '2024-06-22 11:51:33', '2024-06-22 11:52:29', 1),
(42, 1, 1, 'admin', 'ups_status', 'غیرفعال', 1, '2024-06-22 11:51:33', '2024-06-22 11:52:29', 1),
(43, 1, 1, 'admin', 'relay_module', 'غیرفعال', 1, '2024-06-22 11:52:50', '2024-06-22 11:53:45', 1),
(44, 1, 1, 'admin', 'relay_module', 'فعال', 1, '2024-06-22 11:52:53', '2024-06-22 11:53:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '2024_05_01_041847_create_organizations_table', 1),
(4, '2024_05_01_041848_create_users_table', 1),
(5, '2024_05_04_062627_create_devices_table', 1),
(6, '2024_05_04_090119_create_personal_access_tokens_table', 1),
(7, '2024_05_08_081030_create_accounts_table', 1),
(9, '2024_05_30_105729_create_logs_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE `organizations` (
  `id` bigint UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `keyname` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`id`, `title`, `keyname`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', NULL, '2024-06-06 05:05:57');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('eXNM0EhAH2uJAP4LrcqMaVmCasgEwrvp6R9Ic8Ch', 8, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 Edg/126.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiODI2ckJOYVlxQ1I2N3BLZ2k4OVhlakRCYk5Yb1FtN1FlcFZ6ZXZ5SiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9ob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6ODt9', 1719082978);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `organization_id` bigint UNSIGNED DEFAULT NULL,
  `user_access` tinyint(1) NOT NULL DEFAULT '0',
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `organization_id`, `user_access`, `admin`, `username`, `password`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'admin', '$2y$12$JGOP4vUT4EFR0WYT94e17O9qFThziHsbsMzeBrheHyjd.rwaaf9v.', NULL, NULL, NULL, '2024-06-06 05:06:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accounts_device_id_foreign` (`device_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `devices_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `logs_device_id_foreign` (`device_id`),
  ADD KEY `logs_organization_id_foreign` (`organization_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organizations`
--
ALTER TABLE `organizations`
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
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_organization_id_foreign` (`organization_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `organizations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_device_id_foreign` FOREIGN KEY (`device_id`) REFERENCES `devices` (`id`);

--
-- Constraints for table `devices`
--
ALTER TABLE `devices`
  ADD CONSTRAINT `devices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_device_id_foreign` FOREIGN KEY (`device_id`) REFERENCES `devices` (`id`),
  ADD CONSTRAINT `logs_organization_id_foreign` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_organization_id_foreign` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
