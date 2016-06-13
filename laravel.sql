-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2016 at 06:45 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Đồ Điện Tử', 1, '2016-06-12 19:45:49', '2016-06-12 19:45:49'),
(2, 'Đồ Gia Dụng', 1, '2016-06-12 19:45:57', '2016-06-12 19:45:57'),
(3, 'Đồ Thể Thao', 1, '2016-06-12 20:43:48', '2016-06-12 20:43:48'),
(4, 'Du lịch', 1, '2016-06-12 20:49:30', '2016-06-12 20:49:30');

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
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 2),
('2016_06_08_045137_create_products_table', 2),
('2016_06_08_045148_create_categories_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(10) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `category`, `image`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Sản phẩm 1', 100000, 'Sản phẩm 1', 1, '', 1, '2016-06-12 19:46:16', '2016-06-12 19:49:40'),
(2, 'Đồ Điện Tử', 1232131, '12wqewqe', 1, '', 1, '2016-06-12 19:53:53', '2016-06-12 19:53:53'),
(3, 'dsadsa', 100000, 'adadada', 1, '', 0, '2016-06-12 19:54:44', '2016-06-12 20:44:05'),
(4, 'dsadsadsa', 100000, 'dsa', 2, '1465786575.jpg', 0, '2016-06-12 19:58:03', '2016-06-12 20:44:05'),
(5, 'Quần bơi', 300000, 'Quần nam', 3, '', 1, '2016-06-12 20:44:44', '2016-06-12 20:44:44'),
(6, 'Áo tắm nữ', 700000, '', 3, '', 1, '2016-06-12 20:45:22', '2016-06-12 20:45:22'),
(7, 'Điện thoại sansung', 4000000000, '', 1, '', 1, '2016-06-12 20:45:58', '2016-06-12 20:45:58'),
(8, 'Kính bếp', 650000, '', 2, '', 1, '2016-06-12 20:46:39', '2016-06-12 20:46:39'),
(9, 'Bàn là', 600000, '', 1, '', 1, '2016-06-12 20:46:57', '2016-06-12 20:46:57'),
(10, 'Tủ quần áo', 500898, '', 2, '', 1, '2016-06-12 20:47:27', '2016-06-12 20:47:27'),
(11, 'Điện thoại apple', 4294967295, '', 1, '', 1, '2016-06-12 20:47:47', '2016-06-12 20:47:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(2) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `avatar`, `active`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'admin', 'admin@gmail.com', '$2y$10$UJTDkJGoPISL3kqZ3UCy8uTInNPyf490frr6tazNKBfWQzb4v4XjC', '', 0, 'Lj3DwaNkDYfjePlnKTRq5OywGZWTLiXXDEXclGnD0ErFu8FOrM84y6rpZbw2', '2016-06-06 22:08:59', '2016-06-12 20:42:40'),
(4, 'admin2', 'admin2@gmail.com', '$2y$10$2/8s2hsjKyN4Q8/OA64bWOIZFB7I/7ZXdUsX2qAHv9LPTfxwGBpbm', '1465386501.png', 1, NULL, '2016-06-08 05:17:40', '2016-06-12 09:29:10'),
(5, 'nguyen van a 1', 'nguyena@gmail.com1', '$2y$10$9/ant94jMy.E2GDylhFSy.an/Neatr98WFeuIPBbUHs6pIVHwCUJq', '1465749336.jpg', 0, NULL, '2016-06-12 09:38:46', '2016-06-12 20:42:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
