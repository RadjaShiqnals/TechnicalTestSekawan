-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2024 at 05:41 AM
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
-- Database: `techsekawan`
--
CREATE DATABASE IF NOT EXISTS `techsekawan` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `techsekawan`;

-- --------------------------------------------------------

--
-- Table structure for table `approval_notes`
--
-- Creation: Sep 05, 2024 at 09:49 AM
-- Last update: Sep 06, 2024 at 03:03 AM
--

DROP TABLE IF EXISTS `approval_notes`;
CREATE TABLE `approval_notes` (
  `id_note` int(11) NOT NULL,
  `id_reservations` int(11) DEFAULT NULL,
  `approver_id` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `approval_notes`:
--   `id_reservations`
--       `reservations` -> `id_reservations`
--

--
-- Dumping data for table `approval_notes`
--

INSERT INTO `approval_notes` (`id_note`, `id_reservations`, `approver_id`, `note`, `created_at`, `updated_at`) VALUES
(1, 4, 4, 'Gg', '2024-09-06 03:03:34', '2024-09-06 03:03:34');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--
-- Creation: Sep 05, 2024 at 01:27 AM
-- Last update: Sep 05, 2024 at 10:11 PM
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `cache`:
--

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--
-- Creation: Sep 05, 2024 at 01:27 AM
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `cache_locks`:
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_reservations`
--
-- Creation: Sep 05, 2024 at 10:44 AM
-- Last update: Sep 06, 2024 at 03:20 AM
--

DROP TABLE IF EXISTS `detail_reservations`;
CREATE TABLE `detail_reservations` (
  `id_detail_reservations` int(11) NOT NULL,
  `id_reservations` int(11) NOT NULL,
  `fuel_consumption` decimal(5,2) NOT NULL,
  `note` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `detail_reservations`:
--   `id_reservations`
--       `reservations` -> `id_reservations`
--

--
-- Dumping data for table `detail_reservations`
--

INSERT INTO `detail_reservations` (`id_detail_reservations`, `id_reservations`, `fuel_consumption`, `note`, `updated_at`, `created_at`) VALUES
(1, 4, 1.40, 'rer', '2024-09-06 03:20:10', '2024-09-06 03:20:10');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--
-- Creation: Sep 05, 2024 at 06:49 AM
-- Last update: Sep 06, 2024 at 03:03 AM
--

DROP TABLE IF EXISTS `drivers`;
CREATE TABLE `drivers` (
  `id_drivers` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` enum('assigned','unassigned','pending') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `drivers`:
--

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id_drivers`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Agustusan', 'pending', '2024-09-06 02:20:09', '2024-09-06 02:20:09'),
(2, 'Robert', 'pending', '2024-09-06 02:20:59', '2024-09-06 02:20:59'),
(3, 'RIzky Anak Sholeh', 'pending', '2024-09-06 02:23:41', '2024-09-06 02:23:41'),
(4, 'Muhammad Yesus', 'assigned', '2024-09-06 03:03:34', '2024-09-06 03:03:34'),
(5, ' Roberto', 'unassigned', '2024-09-06 01:53:16', '2024-09-05 16:48:10'),
(6, 'Maya', 'unassigned', '2024-09-05 16:39:46', '2024-09-05 16:39:46'),
(7, 'Layla', 'unassigned', '2024-09-06 01:53:16', '2024-09-05 17:01:36'),
(8, 'Chala', 'unassigned', '2024-09-05 16:40:42', '2024-09-05 16:40:42');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--
-- Creation: Sep 05, 2024 at 01:27 AM
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `failed_jobs`:
--

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--
-- Creation: Sep 05, 2024 at 01:27 AM
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `jobs`:
--

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--
-- Creation: Sep 05, 2024 at 01:27 AM
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `job_batches`:
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--
-- Creation: Sep 05, 2024 at 01:27 AM
-- Last update: Sep 05, 2024 at 04:27 PM
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `migrations`:
--

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_09_05_012755_create_personal_access_tokens_table', 1),
(5, '2024_09_05_232719_create_permission_tables', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--
-- Creation: Sep 05, 2024 at 04:27 PM
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `model_has_permissions`:
--   `permission_id`
--       `permissions` -> `id`
--

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--
-- Creation: Sep 05, 2024 at 04:27 PM
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `model_has_roles`:
--   `role_id`
--       `roles` -> `id`
--

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--
-- Creation: Sep 05, 2024 at 01:27 AM
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `password_reset_tokens`:
--

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--
-- Creation: Sep 05, 2024 at 04:27 PM
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `permissions`:
--

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--
-- Creation: Sep 05, 2024 at 01:27 AM
-- Last update: Sep 05, 2024 at 04:07 AM
--

DROP TABLE IF EXISTS `personal_access_tokens`;
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

--
-- RELATIONSHIPS FOR TABLE `personal_access_tokens`:
--

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--
-- Creation: Sep 05, 2024 at 04:05 PM
-- Last update: Sep 06, 2024 at 03:03 AM
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE `reservations` (
  `id_reservations` int(11) NOT NULL,
  `id_users` bigint(20) UNSIGNED DEFAULT NULL,
  `id_vehicles` int(11) DEFAULT NULL,
  `id_drivers` int(11) DEFAULT NULL,
  `approver_id` int(11) NOT NULL,
  `start_date` date NOT NULL DEFAULT current_timestamp(),
  `end_date` date NOT NULL DEFAULT current_timestamp(),
  `purpose` text DEFAULT NULL,
  `admin_approval` enum('pending','approved','rejected') DEFAULT NULL,
  `affirmation_approval` enum('pending','approved','rejected') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `reservations`:
--   `id_drivers`
--       `drivers` -> `id_drivers`
--   `id_users`
--       `users` -> `id_users`
--   `id_vehicles`
--       `vehicles` -> `id_vehicles`
--

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id_reservations`, `id_users`, `id_vehicles`, `id_drivers`, `approver_id`, `start_date`, `end_date`, `purpose`, `admin_approval`, `affirmation_approval`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 3, '2024-09-06', '2024-09-08', 'Traveling around city!', 'approved', NULL, '2024-09-06 02:20:09', '2024-09-06 02:20:09'),
(2, 1, 2, 2, 4, '2024-09-06', '2024-09-08', 'Traveling Around!', 'approved', NULL, '2024-09-06 02:20:59', '2024-09-06 02:20:59'),
(3, 1, 3, 3, 3, '2024-09-06', '2024-09-08', 'Tabrak Lari!', 'approved', NULL, '2024-09-06 02:23:41', '2024-09-06 02:23:41'),
(4, 1, 4, 4, 4, '2024-09-06', '2024-09-09', 'Tawuran sesuai nama license', 'approved', 'approved', '2024-09-06 02:24:14', '2024-09-06 03:03:34');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--
-- Creation: Sep 05, 2024 at 04:27 PM
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `roles`:
--

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--
-- Creation: Sep 05, 2024 at 04:27 PM
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `role_has_permissions`:
--   `permission_id`
--       `permissions` -> `id`
--   `role_id`
--       `roles` -> `id`
--

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--
-- Creation: Sep 05, 2024 at 01:27 AM
-- Last update: Sep 06, 2024 at 03:22 AM
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `sessions`:
--

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('vfMu040S3alNShZUbDTIdl77G55FuVIFLA63MXA8', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 OPR/112.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRVpjblp0T1JISXFQd3FFeXNoM2VRV1RkS0pNM3hDQkprNE5mZWs3WiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kZXRhaWxfcmVzZXJ2YXRpb24iO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1725592970);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
-- Creation: Sep 05, 2024 at 01:57 AM
-- Last update: Sep 06, 2024 at 02:17 AM
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id_users` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','approver') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `users`:
--

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'demoadmin', 'demoadmin@gmail.com', NULL, '$2y$12$QF19bNZxaBFLNZk/HxZBAOuoffcYmHg4XVFRETsZdXtmkcLihracq', NULL, '2024-09-06 02:16:24', '2024-09-06 02:16:24', 'admin'),
(2, 'demoadmin1', 'demoadmin1@gmail.com', NULL, '$2y$12$YoeIYyY6Lo9YU4UD.GZq.eMpsnNAkzQwo5xIYO9MhkcRjJYND3gF2', NULL, '2024-09-06 02:16:34', '2024-09-06 02:16:34', 'admin'),
(3, 'demoapprover', 'demoapprover@gmail.com', NULL, '$2y$12$vvz.HqvPu3OfhHDu6.QUQ.//9bbXlkdGhgrA5AwvO94NLT8op6vNu', NULL, '2024-09-06 02:17:01', '2024-09-06 02:17:01', 'approver'),
(4, 'demoapprover1', 'demoapprover1@gmail.com', NULL, '$2y$12$i.18qaKVyd.VHQYdjfRhTugkyW8leWriA9s9AxJYGtK0bOLnRzVTC', NULL, '2024-09-06 02:17:12', '2024-09-06 02:17:12', 'approver');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--
-- Creation: Sep 05, 2024 at 04:54 AM
-- Last update: Sep 06, 2024 at 03:03 AM
--

DROP TABLE IF EXISTS `vehicles`;
CREATE TABLE `vehicles` (
  `id_vehicles` int(11) NOT NULL,
  `plate_number` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `ownership` enum('company','rented') DEFAULT NULL,
  `status` enum('available','in_used','pending') DEFAULT NULL,
  `locations` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `vehicles`:
--

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id_vehicles`, `plate_number`, `model`, `ownership`, `status`, `locations`, `created_at`, `updated_at`) VALUES
(1, 'C 00K H1M', 'Toyota', 'rented', 'pending', 'Portugal', '2024-09-06 02:20:09', '2024-09-06 02:20:09'),
(2, 'C 3KI K0F', 'Honda', 'company', 'pending', 'El Salvador', '2024-09-06 02:20:59', '2024-09-06 02:20:59'),
(3, 'C 3KI K0E', 'Chevrolet', 'rented', 'pending', 'Switzerland', '2024-09-06 02:23:41', '2024-09-06 02:23:41'),
(4, 'G 30S PKI', 'Chevrolet', 'rented', 'in_used', 'Indonesia', '2024-09-06 03:03:34', '2024-09-06 03:03:34'),
(5, 'VU687H', 'Honda', 'company', 'available', 'America', '2024-09-06 01:55:09', '2024-09-05 16:48:10'),
(6, 'FU56R65', 'Lamborghini', 'rented', 'available', 'America', '2024-09-06 01:55:09', '2024-09-05 17:01:36'),
(7, '68GG87', 'Lamborghini', 'company', 'available', 'Indonesia', '2024-09-05 16:42:29', '2024-09-05 16:42:29'),
(8, 'M945SX3', 'Tesla', 'rented', 'available', 'America', '2024-09-05 16:42:29', '2024-09-05 16:42:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approval_notes`
--
ALTER TABLE `approval_notes`
  ADD PRIMARY KEY (`id_note`),
  ADD KEY `fk_approval_notes_reservations` (`id_reservations`);

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
-- Indexes for table `detail_reservations`
--
ALTER TABLE `detail_reservations`
  ADD PRIMARY KEY (`id_detail_reservations`),
  ADD KEY `id_reservations` (`id_reservations`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id_drivers`);

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id_reservations`),
  ADD KEY `fk_reservations_users` (`id_users`),
  ADD KEY `fk_reservations_vehicles` (`id_vehicles`),
  ADD KEY `fk_reservations_drivers` (`id_drivers`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

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
  ADD PRIMARY KEY (`id_users`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id_vehicles`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `approval_notes`
--
ALTER TABLE `approval_notes`
  MODIFY `id_note` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `detail_reservations`
--
ALTER TABLE `detail_reservations`
  MODIFY `id_detail_reservations` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id_drivers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id_reservations` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id_vehicles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `approval_notes`
--
ALTER TABLE `approval_notes`
  ADD CONSTRAINT `fk_approval_notes_reservations` FOREIGN KEY (`id_reservations`) REFERENCES `reservations` (`id_reservations`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_reservations`
--
ALTER TABLE `detail_reservations`
  ADD CONSTRAINT `detail_reservations_ibfk_1` FOREIGN KEY (`id_reservations`) REFERENCES `reservations` (`id_reservations`);

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `fk_reservations_drivers` FOREIGN KEY (`id_drivers`) REFERENCES `drivers` (`id_drivers`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reservations_users` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reservations_vehicles` FOREIGN KEY (`id_vehicles`) REFERENCES `vehicles` (`id_vehicles`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
