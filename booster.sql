-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2019 at 06:55 PM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `booster`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE IF NOT EXISTS `activities` (
  `id` int(10) unsigned NOT NULL,
  `client_id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `activity` text COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `control_panel`
--

CREATE TABLE IF NOT EXISTS `control_panel` (
  `traffic_exchange` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `manual_exchange` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `social_exchange` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `media_exchange` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `referral` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paypal` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `stripe` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `points` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `control_panel`
--

INSERT INTO `control_panel` (`traffic_exchange`, `manual_exchange`, `social_exchange`, `media_exchange`, `referral`, `paypal`, `stripe`, `points`) VALUES
('enable', 'enable', 'enable', 'enable', 'enable', 'enable', 'enable', 'enable');

-- --------------------------------------------------------

--
-- Table structure for table `counts`
--

CREATE TABLE IF NOT EXISTS `counts` (
  `id` int(10) unsigned NOT NULL,
  `points` int(11) NOT NULL DEFAULT '0',
  `hits` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE IF NOT EXISTS `links` (
  `id` int(10) unsigned NOT NULL,
  `client_id` int(11) NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `points` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `memberships`
--

CREATE TABLE IF NOT EXISTS `memberships` (
  `id` int(10) unsigned NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `memberships`
--

INSERT INTO `memberships` (`id`, `amount`, `created_at`, `updated_at`) VALUES
(2, 30, '2015-11-18 12:40:33', '2015-11-18 12:40:33');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2015_11_04_120119_create_websites_table', 1),
('2015_11_06_192136_create_counts_table', 2),
('2015_11_06_195555_update_counts', 3),
('2015_11_08_092213_add_cashier_columns', 4),
('2015_11_08_200446_create_supports_table', 5),
('2015_11_09_201626_admin', 6),
('2015_11_18_174929_create_memberships_table', 7),
('2015_11_18_174939_create_points_table', 7),
('2015_11_21_074603_create_links_table', 8),
('2015_11_29_143722_add_ip_to_users', 9),
('2015_12_03_095151_create_systems_table', 10),
('2015_12_03_181215_create_withdrawals_table', 11),
('2015_12_09_102109_create_videos_table', 12),
('2016_02_02_101700_add_method_to_links', 13),
('2016_04_08_102754_add_enable_to_sites', 14),
('2016_04_08_103008_add_enable_to_links', 14),
('2016_04_08_103041_add_enable_to_videos', 14),
('2016_07_12_134248_update_websites', 15),
('2017_03_09_092608_billing_table', 16),
('2017_03_09_092645_orders_table', 16),
('2018_03_01_090032_control_panel', 17),
('2018_09_03_172915_create_transfers', 18),
('2018_09_03_172925_create_activities', 18),
('2018_09_03_172946_add_share_limit_to_settings', 18),
('2018_09_03_173530_create_shared_count', 18);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `points`
--

CREATE TABLE IF NOT EXISTS `points` (
  `id` int(10) unsigned NOT NULL,
  `amount` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `points`
--

INSERT INTO `points` (`id`, `amount`, `points`, `type`, `created_at`, `updated_at`) VALUES
(2, 10, 10000, 'basic', '2015-11-18 13:03:35', '2015-11-18 13:03:35'),
(3, 30, 35000, 'professional', '2015-11-18 14:34:38', '2015-11-18 14:34:38'),
(4, 75, 105000, 'premium', '2015-11-18 14:35:03', '2015-11-18 14:35:03'),
(5, 200, 300000, 'gold', '2015-11-18 14:35:29', '2015-11-18 14:35:29');

-- --------------------------------------------------------

--
-- Table structure for table `share_count`
--

CREATE TABLE IF NOT EXISTS `share_count` (
  `id` int(10) unsigned NOT NULL,
  `client_id` int(11) NOT NULL,
  `shared_link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `end_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supports`
--

CREATE TABLE IF NOT EXISTS `supports` (
  `id` int(10) unsigned NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `systems`
--

CREATE TABLE IF NOT EXISTS `systems` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `point_value` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `share_limit` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `systems`
--

INSERT INTO `systems` (`id`, `name`, `logo`, `meta`, `point_value`, `created_at`, `updated_at`, `share_limit`) VALUES
(1, 'Booster', 'logo.png', 'traffic', 0.0001, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 100);

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

CREATE TABLE IF NOT EXISTS `transfers` (
  `id` int(10) unsigned NOT NULL,
  `from` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `to` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `confirmation_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `points` int(11) NOT NULL DEFAULT '100',
  `status` int(11) NOT NULL DEFAULT '0',
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'client',
  `membership` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'free',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `stripe_active` tinyint(4) NOT NULL DEFAULT '0',
  `stripe_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stripe_subscription` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stripe_plan` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_four` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `subscription_ends_at` timestamp NULL DEFAULT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `confirmation_code`, `points`, `status`, `role`, `membership`, `remember_token`, `created_at`, `updated_at`, `stripe_active`, `stripe_id`, `stripe_subscription`, `stripe_plan`, `last_four`, `trial_ends_at`, `subscription_ends_at`, `ip`) VALUES
(3, '', 'admin@mail.com', '$2y$10$w34LOyO9QrOhciZeSlNUx.ZOYJti5GT8IQtRl4FU0qazHZJTryPFG', '', 180, 1, 'admin', 'free', 'waOlQP6RJFml3fwNSTdEBm4DrS2lcNqeoQAjfhcjRZpK1lSr1faXrSoQtv3v', '2015-11-09 14:52:02', '2018-09-03 12:33:52', 0, NULL, NULL, NULL, NULL, NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE IF NOT EXISTS `videos` (
  `id` int(10) unsigned NOT NULL,
  `client_id` int(11) NOT NULL,
  `embed_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `points` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `websites`
--

CREATE TABLE IF NOT EXISTS `websites` (
  `id` int(10) unsigned NOT NULL,
  `client_id` int(11) NOT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short_link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE IF NOT EXISTS `withdrawals` (
  `id` int(10) unsigned NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paypal_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `points` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Unpaid',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `counts`
--
ALTER TABLE `counts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `memberships`
--
ALTER TABLE `memberships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `points`
--
ALTER TABLE `points`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `share_count`
--
ALTER TABLE `share_count`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supports`
--
ALTER TABLE `supports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `systems`
--
ALTER TABLE `systems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `websites`
--
ALTER TABLE `websites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `counts`
--
ALTER TABLE `counts`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `memberships`
--
ALTER TABLE `memberships`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `points`
--
ALTER TABLE `points`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `share_count`
--
ALTER TABLE `share_count`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `supports`
--
ALTER TABLE `supports`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `systems`
--
ALTER TABLE `systems`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `transfers`
--
ALTER TABLE `transfers`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `websites`
--
ALTER TABLE `websites`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
