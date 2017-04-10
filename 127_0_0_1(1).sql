-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2016 at 04:56 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `afrodiasy`
--
CREATE DATABASE IF NOT EXISTS `afrodiasy` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `afrodiasy`;

-- --------------------------------------------------------

--
-- Table structure for table `casting`
--

CREATE TABLE `casting` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `castTitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `castDescription` text COLLATE utf8_unicode_ci NOT NULL,
  `payType` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payDesc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `area` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Daycast` int(11) NOT NULL,
  `Monthcast` int(11) NOT NULL,
  `Yearcast` int(11) NOT NULL,
  `DayExp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `MonthExp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `YearExp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `castImage` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `casting`
--

INSERT INTO `casting` (`id`, `user_id`, `castTitle`, `castDescription`, `payType`, `payDesc`, `location`, `area`, `Daycast`, `Monthcast`, `Yearcast`, `DayExp`, `MonthExp`, `YearExp`, `castImage`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 'o;dnjcnsdjn', 'sfnvljdsfbnvj', 'tfp', 'lksdnlncsjn', 'Ekiti', 'jknblk', 20, 2, 2016, '19', '2', '2016', 'img/castimage/1465055750.jpg', 'activated', '2016-06-04 13:55:50', '2016-06-04 13:55:50'),
(2, 3, 'Another post', 'jdbfjvb dsjbfvjdbfv sdjbvd', 'paid', '15000', 'Kaduna', 'ldfnv dfjbvjdf', 1, 1, 2016, '1', '1', '2016', 'img/castimage/1465164141.png', 'pending', '2016-06-05 20:02:22', '2016-06-05 20:02:22');

-- --------------------------------------------------------

--
-- Table structure for table `casttable`
--

CREATE TABLE `casttable` (
  `id` int(10) UNSIGNED NOT NULL,
  `cast_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `castMethod` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `castRequest` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `castStatus` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `casttable`
--

INSERT INTO `casttable` (`id`, `cast_id`, `user_id`, `castMethod`, `castRequest`, `castStatus`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 2, 2, '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Body Parts', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Plus Size', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Fashion', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Real Life', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'High Fashion', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Senior', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `catinput`
--

CREATE TABLE `catinput` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `cat_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2016_05_28_174940_create_users_table', 1),
('2016_05_29_181648_create_models_table', 1),
('2016_05_31_015134_create_categories_table', 1),
('2016_05_31_190536_create_catInput_table', 1),
('2016_06_01_190534_create_photoupload_tables', 2),
('2016_06_03_150117_create_others_tables', 3),
('2016_06_04_005232_create_casting_tables', 4),
('2016_06_04_213444_create_castTable_tables', 5);

-- --------------------------------------------------------

--
-- Table structure for table `models`
--

CREATE TABLE `models` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `firstName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `displayName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Age` smallint(6) NOT NULL,
  `Height` smallint(6) NOT NULL,
  `about` text COLLATE utf8_unicode_ci NOT NULL,
  `DayofBirth` int(11) NOT NULL,
  `MonthOfBirth` int(11) NOT NULL,
  `YearofBirth` int(11) NOT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `town` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `models`
--

INSERT INTO `models` (`id`, `user_id`, `firstName`, `lastName`, `displayName`, `gender`, `country`, `email`, `phone`, `Age`, `Height`, `about`, `DayofBirth`, `MonthOfBirth`, `YearofBirth`, `location`, `town`, `created_at`, `updated_at`) VALUES
(1, 1, 'uche', 'ebere', 'uchebliss', 'male', '', '', '90900909', 0, 209, 'skmfldm dlkx', 1, 1, 1954, 'Edo', 'portharcourt', '2016-06-01 22:52:45', '2016-06-01 22:52:45');

-- --------------------------------------------------------

--
-- Table structure for table `others`
--

CREATE TABLE `others` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `agentName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `CAC` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Website` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `landline` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `chairmantel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `chairmanemail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `chairmanname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `aboutus` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `others`
--

INSERT INTO `others` (`id`, `user_id`, `agentName`, `CAC`, `Website`, `address`, `telephone`, `landline`, `chairmantel`, `chairmanemail`, `chairmanname`, `aboutus`, `created_at`, `updated_at`) VALUES
(1, 3, 'uche ebere', '9888768', 'ilughuiyg', 'iutu8giuygyutfv', '98867', 'hjvhgcvg ', 'kjbhjb', 'knkjbn', 'lkhukhjn', 'jkbl jbjkluhbn', '2016-06-03 22:05:30', '2016-06-03 22:05:30');

-- --------------------------------------------------------

--
-- Table structure for table `photoupload`
--

CREATE TABLE `photoupload` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `image_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `imagename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_desc` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `photoupload`
--

INSERT INTO `photoupload` (`id`, `user_id`, `image_type`, `imagename`, `image_desc`, `created_at`, `updated_at`) VALUES
(1, 1, 'profileImage', 'img/profile/1464882754.jpg', 'ojihuijn', '2016-06-02 13:52:35', '2016-06-02 13:52:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `user_type`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'juniorbliss49@yahoo.com', '$2y$10$6Ka5Tc3zQWqEsKF651nrBeQmAHKIeJh5xk6ZhZQNAU2lYg.3GIsRC', 'proModel', 'nOmAwNNuotBzinci2BijR1ryqIPWrU8gycICtzDqh51ZMrW6S8SSFsDbqvHD', '2016-06-01 13:41:46', '2016-06-02 14:30:50'),
(2, 'ucheeberechukwu@gmail.com', '$2y$10$Qp/sRJtdhZAFhX/3x/GBk.7qmkSo.2lKynk.aZdniRN8ZVqg.EWcG', 'agent', '7rVdQcb66Jnv4p9wYbo3NVcYLXeBDn4dzCpa3FU9wLtQcjPNEl3EFacRTLo2', '2016-06-01 13:55:31', '2016-06-01 17:28:00'),
(3, 'uchebliss49@gmail.com', '$2y$10$NkPcaRiyBAI3uzRC8xTPQONcmowceKYPnhK4owcMNxKRMcj0c5QEi', 'photo', NULL, '2016-06-03 21:46:28', '2016-06-03 21:46:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `casting`
--
ALTER TABLE `casting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `casting_user_id_foreign` (`user_id`);

--
-- Indexes for table `casttable`
--
ALTER TABLE `casttable`
  ADD PRIMARY KEY (`id`),
  ADD KEY `casttable_cast_id_foreign` (`cast_id`),
  ADD KEY `casttable_user_id_foreign` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `catinput`
--
ALTER TABLE `catinput`
  ADD PRIMARY KEY (`id`),
  ADD KEY `catinput_user_id_foreign` (`user_id`),
  ADD KEY `catinput_cat_id_foreign` (`cat_id`);

--
-- Indexes for table `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`id`),
  ADD KEY `models_user_id_foreign` (`user_id`);

--
-- Indexes for table `others`
--
ALTER TABLE `others`
  ADD PRIMARY KEY (`id`),
  ADD KEY `others_user_id_foreign` (`user_id`);

--
-- Indexes for table `photoupload`
--
ALTER TABLE `photoupload`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photoupload_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `casting`
--
ALTER TABLE `casting`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `casttable`
--
ALTER TABLE `casttable`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `catinput`
--
ALTER TABLE `catinput`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `models`
--
ALTER TABLE `models`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `others`
--
ALTER TABLE `others`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `photoupload`
--
ALTER TABLE `photoupload`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `casting`
--
ALTER TABLE `casting`
  ADD CONSTRAINT `casting_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `casttable`
--
ALTER TABLE `casttable`
  ADD CONSTRAINT `casttable_cast_id_foreign` FOREIGN KEY (`cast_id`) REFERENCES `casting` (`id`),
  ADD CONSTRAINT `casttable_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `catinput`
--
ALTER TABLE `catinput`
  ADD CONSTRAINT `catinput_cat_id_foreign` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `catinput_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `models`
--
ALTER TABLE `models`
  ADD CONSTRAINT `models_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `others`
--
ALTER TABLE `others`
  ADD CONSTRAINT `others_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `photoupload`
--
ALTER TABLE `photoupload`
  ADD CONSTRAINT `photoupload_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
