-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2024 at 12:27 PM
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
-- Database: `backend_tsm`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_09_02_094846_create_tasks_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(2, 'App\\Models\\User', 3, 'MyApp', '077d680894739da46b1ef7321ee38b2e7cca56c73f80cead218c989287915c07', '[\"*\"]', '2024-09-06 04:24:48', '2024-09-06 04:04:21', '2024-09-06 04:24:48');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(191) NOT NULL,
  `due_date` date NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('Pending','In Progress','Completed') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `title`, `due_date`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Web Development', '2024-09-06', '<p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eu interdum dui. Sed eget nisl sed magna efficitur egestas. Pellentesque vitae augue nec elit gravida sagittis et non est. Nulla eu tortor maximus, pellentesque risus id, vehicula felis. Sed in semper ex. Nullam eget sollicitudin augue. Ut ultricies, justo eget mollis feugiat, eros velit ultricies libero, in egestas tortor ligula a est. Fusce luctus diam id ex dapibus, at pretium velit finibus. Cras facilisis tortor ipsum, sed pulvinar dolor pretium in. Duis et gravida turpis, rutrum placerat metus.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px;\">Suspendisse molestie turpis consequat augue congue, vitae semper nibh hendrerit. Vestibulum vehicula, erat non mattis blandit, nisi quam iaculis arcu, non aliquam augue lorem sit amet tellus. Proin fermentum blandit ligula, sed lobortis turpis semper eu. Proin non tellus laoreet, mollis mi sed, varius libero. Pellentesque hendrerit lectus non venenatis venenatis. Mauris interdum turpis a ex malesuada bibendum. Aliquam tincidunt elit eu gravida semper. Curabitur et mi rutrum, tincidunt urna vitae, euismod dui. Cras molestie nibh lorem, at vehicula leo vulputate et. Maecenas elementum, nisi et finibus vehicula, diam ante imperdiet ante, eu tristique nibh leo ac nisl. Vestibulum eu varius metus, at molestie orci. Nulla facilisi.</p>', 'Completed', '2024-09-06 03:32:55', '2024-09-06 03:33:46'),
(2, 1, 'Web Design', '2024-09-07', '<p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eu interdum dui. Sed eget nisl sed magna efficitur egestas. Pellentesque vitae augue nec elit gravida sagittis et non est. Nulla eu tortor maximus, pellentesque risus id, vehicula felis. Sed in semper ex. Nullam eget sollicitudin augue. Ut ultricies, justo eget mollis feugiat, eros velit ultricies libero, in egestas tortor ligula a est. Fusce luctus diam id ex dapibus, at pretium velit finibus. Cras facilisis tortor ipsum, sed pulvinar dolor pretium in. Duis et gravida turpis, rutrum placerat metus.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px;\">Suspendisse molestie turpis consequat augue congue, vitae semper nibh hendrerit. Vestibulum vehicula, erat non mattis blandit, nisi quam iaculis arcu, non aliquam augue lorem sit amet tellus. Proin fermentum blandit ligula, sed lobortis turpis semper eu. Proin non tellus laoreet, mollis mi sed, varius libero. Pellentesque hendrerit lectus non venenatis venenatis. Mauris interdum turpis a ex malesuada bibendum. Aliquam tincidunt elit eu gravida semper. Curabitur et mi rutrum, tincidunt urna vitae, euismod dui. Cras molestie nibh lorem, at vehicula leo vulputate et. Maecenas elementum, nisi et finibus vehicula, diam ante imperdiet ante, eu tristique nibh leo ac nisl. Vestibulum eu varius metus, at molestie orci. Nulla facilisi.</p>', 'Pending', '2024-09-06 03:33:16', '2024-09-06 03:33:41'),
(3, 3, 'Mobile App Development', '2024-09-08', NULL, 'Pending', '2024-09-06 04:04:46', '2024-09-06 04:04:46'),
(4, 3, 'Mobile App Development Two', '2024-09-10', NULL, 'Pending', '2024-09-06 04:12:22', '2024-09-06 04:24:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `role` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `image` varchar(191) DEFAULT 'defaults/profile.png',
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `email`, `phone`, `email_verified_at`, `password`, `image`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', 'admin@gmail.com', NULL, NULL, '$2y$10$yu845Jdwj5l9cGtS/KnaZ.gDjXwxPKcYRgDmfUPvcDUyFJuPJfvBK', 'defaults/profile.png', 'Active', NULL, NULL, NULL),
(3, 'AL Ekram', 'user', 'ekramhossainekram28@gmail.com', NULL, NULL, '$2y$10$1SbK2/KEy2bBW5HlNvxoWesIN7HhWCsq2K1CHzLZUubEw9OYv4oGu', 'defaults/profile.png', 'Active', NULL, '2024-09-06 03:40:06', '2024-09-06 03:40:06');

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tasks_title_unique` (`title`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
