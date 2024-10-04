-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2024 at 06:48 PM
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
-- Database: `erp`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `check_in` varchar(255) DEFAULT NULL,
  `check_out` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `employee_id`, `date`, `check_in`, `check_out`, `status`, `created_at`, `updated_at`) VALUES
(9, '5', '22/09/2024', '07:34', '18:34', NULL, '2024-09-22 06:34:04', '2024-09-22 06:34:19'),
(10, '5', '23/09/2024', '06:05', '18:05', NULL, '2024-09-22 12:05:46', '2024-09-22 12:05:46'),
(11, '5', '04/10/2024', '08:47', '21:47', NULL, '2024-10-04 09:47:29', '2024-10-04 09:47:29'),
(12, '5', '05/10/2024', '09:51', '19:51', NULL, '2024-10-04 09:52:01', '2024-10-04 09:52:01');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `image`, `email`, `phone`, `created_at`, `updated_at`) VALUES
(3, 'pivu@mailinator.com', 'uploads/customer-images/17166319876651b9b35e20aabmgsc.png', 'badefapopa@mailinator.com', 'fybeve@mailinator.com', '2024-05-25 04:13:07', '2024-05-25 04:13:07'),
(4, 'qalef@mailinator.com', 'uploads/customer-images/17166368586651ccba8c177abmgsc.png', 'sipom@mailinator.com', 'doloho@mailinator.com', '2024-05-25 05:34:18', '2024-05-25 05:34:18'),
(5, 'asdf', 'uploads/customer-images/17169097976655f6e5b1428abmgsc.png', 'asdf@asdf.com', '1241234123', '2024-05-28 09:23:17', '2024-05-28 09:23:17');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `salary` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `image`, `email`, `phone`, `department`, `position`, `salary`, `created_at`, `updated_at`) VALUES
(4, 'Arnob', 'uploads/employee-images/171661705666517f6054d9fabmgsc.png', 'arnob@gmail.com', '01911111111', 'Employee', 'Junior', '5000', '2024-05-25 00:04:16', '2024-05-25 00:04:16'),
(8, 'lipu', 'uploads/employee-images/171665472166521281994c9Screenshot_10.png', 'sepo@mailinator.com', 'cevifepopu@mailinator.com', 'bihefu@mailinator.com', 'mojeberyv@mailinator.com', '100', '2024-05-25 10:32:01', '2024-05-25 10:32:01');

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
(1, '2023_12_16_210736_create_menus_table', 1),
(2, '2024_02_17_063551_create_caterings_table', 2),
(3, '2024_05_18_171447_create_employees_table', 3),
(4, '2024_05_18_180539_create_attendances_table', 4),
(5, '2024_05_18_180748_create_salaries_table', 5),
(6, '2024_05_25_095936_create_customers_table', 6),
(7, '2024_05_25_102741_create_orders_table', 7),
(8, '2024_05_25_125432_create_type_of_raw_materials_table', 8),
(9, '2024_05_25_125324_create_raw_materials_table', 9),
(10, '2014_10_12_000000_create_users_table', 1),
(11, '2014_10_12_100000_create_password_reset_tokens_table', 10),
(12, '2019_08_19_000000_create_failed_jobs_table', 10),
(13, '2019_12_14_000001_create_personal_access_tokens_table', 10),
(14, '2024_09_16_100947_create_products_table', 1),
(15, '2024_09_22_102638_create_products_table', 11),
(16, '2024_09_22_103152_create_product_types_table', 11),
(17, '2024_09_22_110651_create_product_materials_table', 12),
(18, '2024_09_29_161514_create_transactions_table', 13);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `product_type_id` varchar(191) DEFAULT NULL,
  `quantity` varchar(255) NOT NULL,
  `price` varchar(191) DEFAULT '0',
  `delivery_date` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `product_type_id`, `quantity`, `price`, `delivery_date`, `status`, `created_at`, `updated_at`) VALUES
(5, '4', '2', '12', '0', '22/09/2024', '3', '2024-09-16 04:24:14', '2024-09-22 06:12:29'),
(6, '4', '2', '628', '62800', '04/10/2024', '3', '2024-09-22 06:18:48', '2024-10-04 09:54:00'),
(7, '4', '2', '628', '0', '273', '1', '2024-09-22 06:19:52', '2024-09-22 06:19:52'),
(8, '4', '2', '10', '0', '04/10/2024', '1', '2024-10-04 10:45:51', '2024-10-04 10:45:51');

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_type_id` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_type_id`, `quantity`, `date`, `created_at`, `updated_at`) VALUES
(3, '2', '100', '29/09/2024', '2024-09-29 06:23:09', '2024-09-29 06:23:09'),
(4, '2', '12', '04/10/2024', '2024-10-04 09:53:35', '2024-10-04 09:53:35'),
(5, '3', '500', '04/10/2024', '2024-10-04 10:09:49', '2024-10-04 10:09:49'),
(6, '3', '12', '04/10/2024', '2024-10-04 10:34:00', '2024-10-04 10:34:00');

-- --------------------------------------------------------

--
-- Table structure for table `product_materials`
--

CREATE TABLE `product_materials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `material_id` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_materials`
--

INSERT INTO `product_materials` (`id`, `product_id`, `material_id`, `quantity`, `created_at`, `updated_at`) VALUES
(2, '2', '2', '3', '2024-09-22 05:44:26', '2024-09-22 05:44:26'),
(3, '3', '2', '5', '2024-09-29 06:23:09', '2024-09-29 06:23:09'),
(4, '4', '2', '2', '2024-10-04 09:53:35', '2024-10-04 09:53:35'),
(5, '5', '2', '50', '2024-10-04 10:09:49', '2024-10-04 10:09:49'),
(6, '6', '2', '20', '2024-10-04 10:34:00', '2024-10-04 10:34:00'),
(7, '6', '3', '10', '2024-10-04 10:34:00', '2024-10-04 10:34:00');

-- --------------------------------------------------------

--
-- Table structure for table `product_types`
--

CREATE TABLE `product_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `unit_price` varchar(191) NOT NULL DEFAULT '0',
  `quantity` varchar(191) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_types`
--

INSERT INTO `product_types` (`id`, `name`, `unit_price`, `quantity`, `created_at`, `updated_at`) VALUES
(2, 'High', '100', '112', '2024-09-22 04:43:35', '2024-10-04 09:53:35'),
(3, 'normal', '70', '512', '2024-10-04 10:07:59', '2024-10-04 10:34:00'),
(4, 'flower', '100', '0', '2024-10-04 10:43:57', '2024-10-04 10:43:57');

-- --------------------------------------------------------

--
-- Table structure for table `raw_materials`
--

CREATE TABLE `raw_materials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_id` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `date` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `raw_materials`
--

INSERT INTO `raw_materials` (`id`, `type_id`, `quantity`, `price`, `date`, `created_at`, `updated_at`) VALUES
(5, '2', '38', '23', '29/09/2024', '2024-09-29 06:18:42', '2024-09-29 06:20:49'),
(6, '2', '89', '900', '30/09/2024', '2024-09-29 07:12:14', '2024-09-29 07:12:14'),
(7, '2', '12', '12', '04/10/2024', '2024-10-04 09:55:02', '2024-10-04 09:55:02'),
(8, '3', '110', '90', '04/10/2024', '2024-10-04 10:31:58', '2024-10-04 10:31:58');

-- --------------------------------------------------------

--
-- Table structure for table `rights`
--

CREATE TABLE `rights` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `module` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rights`
--

INSERT INTO `rights` (`id`, `name`, `module`, `created_at`, `updated_at`) VALUES
(128, 'role.view', 'role', '2024-05-18 14:33:28', '2024-05-18 14:33:28'),
(129, 'setting.view', 'setting', '2024-05-18 14:33:28', '2024-05-18 14:33:28'),
(130, 'setting.general', 'setting', '2024-05-18 14:33:28', '2024-05-18 14:33:28'),
(131, 'setting.static-content', 'setting', '2024-05-18 14:33:28', '2024-05-18 14:33:28'),
(132, 'setting.legal-content', 'setting', '2024-05-18 14:33:28', '2024-05-18 14:33:28'),
(133, 'dashboard.view', 'dashboard', '2024-05-18 14:33:28', '2024-05-18 14:33:28'),
(134, 'right.create', 'right', '2024-05-18 14:33:28', '2024-05-18 14:33:28'),
(135, 'role.create', 'role', '2024-05-18 14:33:28', '2024-05-18 14:33:28'),
(136, 'role.edit', 'role', '2024-05-18 14:33:28', '2024-05-18 14:33:28'),
(137, 'role.delete', 'role', '2024-05-18 14:33:28', '2024-05-18 14:33:28'),
(138, 'right.edit', 'right', '2024-05-18 14:33:28', '2024-05-18 14:33:28'),
(139, 'right.delete', 'right', '2024-05-18 14:33:28', '2024-05-18 14:33:28'),
(140, 'employee.edit', 'employee', '2024-05-18 09:09:22', '2024-05-18 09:09:22'),
(141, 'employee.delete', 'employee', '2024-05-18 09:09:27', '2024-05-18 09:09:27'),
(142, 'employee.create', 'employee', '2024-05-18 09:10:12', '2024-05-18 09:10:12'),
(143, 'hr.view', 'hr', '2024-05-18 11:10:41', '2024-05-18 11:10:41'),
(144, 'employee.view', 'employee', '2024-05-18 11:11:53', '2024-05-18 11:11:53'),
(145, 'attendance.view', 'attendance', '2024-05-24 23:38:41', '2024-05-24 23:38:41'),
(146, 'customer.view', 'customer', '2024-05-25 04:06:07', '2024-05-25 04:06:07'),
(147, 'customer.create', 'customer', '2024-05-25 04:06:14', '2024-05-25 04:06:14'),
(148, 'customer.edit', 'customer', '2024-05-25 04:06:21', '2024-05-25 04:06:21'),
(149, 'customer.delete', 'customer', '2024-05-25 04:06:26', '2024-05-25 04:06:26'),
(150, 'order.view', 'order', '2024-05-25 05:29:19', '2024-05-25 05:29:19'),
(151, 'order.create', 'order', '2024-05-25 05:29:29', '2024-05-25 05:29:29'),
(152, 'order.edit', 'order', '2024-05-25 05:29:33', '2024-05-25 05:29:33'),
(153, 'order.delete', 'order', '2024-05-25 05:29:38', '2024-05-25 05:29:38'),
(154, 'typeofrawmaterials.view', 'typeofrawmaterials', '2024-05-25 07:18:45', '2024-05-25 07:18:45'),
(155, 'typeofrawmaterials.create', 'typeofrawmaterials', '2024-05-25 07:18:51', '2024-05-25 07:18:51'),
(156, 'typeofrawmaterials.edit', 'typeofrawmaterials', '2024-05-25 07:18:55', '2024-05-25 07:18:55'),
(157, 'typeofrawmaterials.delete', 'typeofrawmaterials', '2024-05-25 07:18:59', '2024-05-25 07:18:59'),
(158, 'user.view', 'user', '2024-05-25 10:16:28', '2024-05-25 10:16:28');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2023-05-07 11:16:21', '2023-05-07 11:16:21'),
(2, 'Employee', '2023-05-07 11:16:21', '2023-05-07 11:16:21'),
(3, 'Customer', '2023-05-07 11:16:21', '2023-05-07 11:16:21');

-- --------------------------------------------------------

--
-- Table structure for table `role_rights`
--

CREATE TABLE `role_rights` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `right_id` int(11) NOT NULL,
  `permission` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_rights`
--

INSERT INTO `role_rights` (`id`, `role_id`, `right_id`, `permission`, `created_at`, `updated_at`) VALUES
(431, 1, 128, 1, '2024-05-18 14:38:32', '2024-05-18 14:38:32'),
(432, 1, 129, 1, '2024-05-18 14:38:32', '2024-05-18 14:38:32'),
(433, 1, 130, 1, '2024-05-18 14:38:32', '2024-05-18 14:38:32'),
(434, 1, 131, 1, '2024-05-18 14:38:32', '2024-05-18 14:38:32'),
(435, 1, 132, 1, '2024-05-18 14:38:32', '2024-05-18 14:38:32'),
(436, 1, 133, 1, '2024-05-18 14:38:32', '2024-05-18 14:38:32'),
(437, 1, 134, 1, '2024-05-18 08:42:55', '2024-05-18 08:42:55'),
(439, 1, 135, 1, '2024-05-18 14:38:32', '2024-05-18 14:38:32'),
(440, 1, 136, 1, '2024-05-18 14:38:32', '2024-05-18 14:38:32'),
(441, 1, 137, 1, '2024-05-18 14:38:32', '2024-05-18 14:38:32'),
(442, 1, 138, 1, '2024-05-18 14:38:32', '2024-05-18 14:38:32'),
(443, 1, 139, 1, '2024-05-18 14:38:32', '2024-05-18 14:38:32'),
(444, 1, 140, 1, '2024-05-18 09:09:34', '2024-05-18 09:09:34'),
(445, 1, 141, 1, '2024-05-18 09:09:34', '2024-05-18 09:09:34'),
(446, 1, 142, 1, '2024-05-18 09:10:18', '2024-05-18 09:10:18'),
(447, 1, 143, 1, '2024-05-18 11:10:50', '2024-05-18 11:10:50'),
(448, 1, 144, 1, '2024-05-18 11:12:08', '2024-05-18 11:12:08'),
(449, 1, 145, 1, '2024-05-24 23:39:05', '2024-05-24 23:39:05'),
(450, 1, 146, 1, '2024-05-25 04:06:46', '2024-05-25 04:06:46'),
(451, 1, 147, 1, '2024-05-25 04:06:46', '2024-05-25 04:06:46'),
(452, 1, 148, 1, '2024-05-25 04:06:46', '2024-05-25 04:06:46'),
(453, 1, 149, 1, '2024-05-25 04:06:46', '2024-05-25 04:06:46'),
(454, 1, 150, 1, '2024-05-25 05:29:54', '2024-05-25 05:29:54'),
(455, 1, 151, 1, '2024-05-25 05:29:54', '2024-05-25 05:29:54'),
(456, 1, 152, 1, '2024-05-25 05:29:54', '2024-05-25 05:29:54'),
(457, 1, 153, 1, '2024-05-25 05:29:54', '2024-05-25 05:29:54'),
(458, 1, 154, 1, '2024-05-25 07:19:56', '2024-05-25 07:19:56'),
(459, 1, 155, 1, '2024-05-25 07:19:56', '2024-05-25 07:19:56'),
(460, 1, 156, 1, '2024-05-25 07:19:56', '2024-05-25 07:19:56'),
(461, 1, 157, 1, '2024-05-25 07:19:56', '2024-05-25 07:19:56'),
(462, 1, 158, 1, '2024-05-25 10:17:49', '2024-05-25 10:17:49');

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE `salaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` varchar(255) DEFAULT NULL,
  `month` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `total_hour` varchar(255) DEFAULT NULL,
  `regular_hour` varchar(255) DEFAULT NULL,
  `overtime_hour` varchar(255) DEFAULT NULL,
  `regular_salary` varchar(255) DEFAULT NULL,
  `overtime_salary` varchar(255) DEFAULT NULL,
  `total_salary` varchar(255) DEFAULT NULL,
  `paid` varchar(255) DEFAULT NULL,
  `due` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salaries`
--

INSERT INTO `salaries` (`id`, `employee_id`, `month`, `year`, `total_hour`, `regular_hour`, `overtime_hour`, `regular_salary`, `overtime_salary`, `total_salary`, `paid`, `due`, `created_at`, `updated_at`) VALUES
(1, '5', '9', '2024', '23', NULL, NULL, NULL, NULL, '276', '50', '226', '2024-09-22 07:08:11', '2024-09-22 12:05:55'),
(2, '5', '10', '2024', '23', NULL, NULL, NULL, NULL, '276', '100', '176', '2024-10-04 09:47:36', '2024-10-04 09:57:33');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) NOT NULL,
  `key` varchar(191) NOT NULL,
  `value` text DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'application_name', 'ERP', 1, '2023-05-21 22:34:50', '2024-05-05 01:48:25'),
(2, 'site_logo', 'uploads/settings/171489397766373499427b45553582.png', 1, '2023-05-21 22:59:19', '2024-05-05 01:26:17'),
(3, 'site_favicon', 'uploads/settings/1714893977663734994517a5553582.png', 1, '2023-05-21 23:09:36', '2024-05-05 01:26:17'),
(4, 'application_phone', '+1 (416) 461-3073', 1, '2023-05-21 23:11:44', '2023-12-20 10:38:49'),
(5, 'application_email', 'erp@gmail.com', 1, '2023-05-21 23:12:29', '2024-05-05 01:48:25'),
(6, 'application_toll_free', '+1 (905) 790-4567', 1, '2023-05-21 23:20:49', '2023-11-02 00:02:56'),
(7, 'application_fax', '+1 (905) 790-4567', 1, '2023-05-21 23:20:49', '2023-11-02 00:02:56'),
(8, 'application_address', '484 Danforth Ave Toronto, ON M4K 1P6 Canada', 1, '2023-05-21 23:20:49', '2023-12-20 10:38:49'),
(9, 'about_us', '<h1 style=\"font-size: 1.625em; margin: 0.2em 0px 0.5em; padding: 0px; direction: ltr; font-family: Lato, helvetica, arial, sans-serif; font-weight: bold; text-rendering: optimizelegibility; line-height: 1.4;\"><br></h1>', 1, '2023-05-22 01:14:20', '2023-11-02 22:09:40'),
(13, 'terms_and_conditions', '<p class=\"MsoNormal\"><br></p>', 1, '2023-07-03 01:25:51', '2023-11-02 22:21:47'),
(14, 'privacy_policy', '<p class=\"MsoNormal\"><br></p>', 1, '2023-07-03 01:25:51', '2023-11-02 22:21:47'),
(15, 'return_policy', '<p class=\"MsoNormal\"><br></p>', 1, '2023-07-03 01:25:51', '2023-11-02 22:21:47'),
(16, 'facebook_link', 'https://www.facebook.com', 1, '2023-07-03 05:45:16', '2023-12-20 10:38:49'),
(17, 'twitter_link', '#', 1, '2023-07-03 05:45:16', '2023-11-02 00:02:56'),
(18, 'instagram_link', 'https://www.instagram.com', 1, '2023-07-03 05:45:16', '2023-12-20 10:38:49'),
(19, 'linkedin_link', '#', 1, '2023-07-03 05:45:16', '2023-11-02 00:02:56'),
(20, 'youtube_link', '#', 1, '2023-07-03 05:45:16', '2023-11-02 00:02:56'),
(21, 'current_amount', '62598', 1, '2023-07-03 05:45:16', '2024-10-04 10:31:58');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `employee_id` varchar(255) DEFAULT NULL,
  `raw_material_id` varchar(255) DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `amount`, `order_id`, `employee_id`, `raw_material_id`, `reason`, `status`, `created_at`, `updated_at`) VALUES
(1, '100', '', '5', '', 'salary', '0', '2024-10-04 09:48:07', '2024-10-04 09:48:07'),
(2, '62800', '6', '', '', 'order_completed', '1', '2024-10-04 09:54:00', '2024-10-04 09:54:00'),
(3, '12', '', '', '7', 'raw_material', '0', '2024-10-04 09:55:02', '2024-10-04 09:55:02'),
(4, '90', '', '', '8', 'raw_material', '0', '2024-10-04 10:31:58', '2024-10-04 10:31:58');

-- --------------------------------------------------------

--
-- Table structure for table `type_of_raw_materials`
--

CREATE TABLE `type_of_raw_materials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` varchar(256) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `type_of_raw_materials`
--

INSERT INTO `type_of_raw_materials` (`id`, `name`, `quantity`, `created_at`, `updated_at`) VALUES
(2, 'Bamboo', '62', '2024-05-25 10:12:10', '2024-10-04 10:34:00'),
(3, 'plastic', '100', '2024-10-04 10:31:15', '2024-10-04 10:34:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `first_name` varchar(256) DEFAULT NULL,
  `last_name` varchar(256) DEFAULT NULL,
  `name` varchar(191) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `department` varchar(191) DEFAULT NULL,
  `position` varchar(191) DEFAULT NULL,
  `salary` varchar(191) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `name`, `email`, `phone`, `role`, `profile_image`, `password`, `department`, `position`, `salary`, `created_at`, `updated_at`) VALUES
(1, 'akij', 'group', NULL, 'admin@gmail.com', '01847382920', 1, 'uploads/user-images/17148949676637387733b58portrait-man-laughing.jpg', '$2y$12$K7rMiTEm.yX3wY09/.OI3eq36bSLJb4tma1MkfwfuCQ7LwCK0H2u6', NULL, NULL, NULL, '2023-05-07 11:15:50', '2024-10-04 10:16:31'),
(4, NULL, NULL, 'hymi@mailinator.com', 'user@gmail.com', 'beremo@mailinator.com', 3, 'uploads/customer-images/172647285966e7e29b81396aaaa.jpg', '$2y$12$K7rMiTEm.yX3wY09/.OI3eq36bSLJb4tma1MkfwfuCQ7LwCK0H2u6', NULL, NULL, NULL, '2024-09-16 01:47:39', '2024-09-16 02:40:32'),
(5, NULL, NULL, 'wawo@mailinator.com', 'lowehu@mailinator.com', 'nynuv@mailinator.com', 2, 'uploads/employee-images/172700837766f00e79ce98cmern-stack (1).png', NULL, 'tiwawadif@mailinator.com', 'quvajuqi@mailinator.com', '12', '2024-09-22 06:32:57', '2024-09-22 06:32:57'),
(6, NULL, NULL, 'lipu', 'sunpop12@gmail.com', '0101325231', 3, 'uploads/customer-images/1728058813670015bd29448IMG_8791.JPG', '$2y$12$9EldbqjtMgN.aGLfZY0UeOiTW27SwThgss2WtQvJ9U7sAPTbNvn36', NULL, NULL, NULL, '2024-10-04 10:20:13', '2024-10-04 10:20:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_materials`
--
ALTER TABLE `product_materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_types`
--
ALTER TABLE `product_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `raw_materials`
--
ALTER TABLE `raw_materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rights`
--
ALTER TABLE `rights`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_rights`
--
ALTER TABLE `role_rights`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`,`right_id`),
  ADD KEY `right_id` (`right_id`);

--
-- Indexes for table `salaries`
--
ALTER TABLE `salaries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_of_raw_materials`
--
ALTER TABLE `type_of_raw_materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_materials`
--
ALTER TABLE `product_materials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_types`
--
ALTER TABLE `product_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `raw_materials`
--
ALTER TABLE `raw_materials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `rights`
--
ALTER TABLE `rights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `role_rights`
--
ALTER TABLE `role_rights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=463;

--
-- AUTO_INCREMENT for table `salaries`
--
ALTER TABLE `salaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `type_of_raw_materials`
--
ALTER TABLE `type_of_raw_materials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
