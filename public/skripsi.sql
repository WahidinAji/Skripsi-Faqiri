-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 03 Jan 2022 pada 08.43
-- Versi server: 5.7.33
-- Versi PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED DEFAULT NULL,
  `price` decimal(16,2) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` bigint(20) DEFAULT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `carts`
--

INSERT INTO `carts` (`id`, `item_id`, `price`, `name`, `total`, `status`, `code`, `created_at`, `updated_at`) VALUES
(1, 2, '18500.00', 'Sampoerna Mild 12', 1, '1', '22000_1648_61c05179d5112', '2021-12-20 09:48:15', '2021-12-20 09:48:15'),
(2, 75, '3500.00', 'Teh Pucuk 350ml', 1, '1', '22000_1648_61c05179d5112', '2021-12-20 09:48:26', '2021-12-20 09:48:26'),
(3, 6, '13500.00', 'Sampoerna Kretek', 1, '1', '16500_1141_61c15ae39076c', '2021-12-21 04:40:14', '2021-12-21 04:40:14'),
(4, 130, '3000.00', 'Lifebuoy', 1, '1', '16500_1141_61c15ae39076c', '2021-12-21 04:40:26', '2021-12-21 04:40:26'),
(5, 130, '3000.00', 'Lifebuoy', 1, '1', '6500_1403_61c41f2ec76c6', '2021-12-23 07:02:29', '2021-12-23 07:02:29'),
(6, 75, '3500.00', 'Teh Pucuk 350ml', 1, '1', '6500_1403_61c41f2ec76c6', '2021-12-23 07:02:42', '2021-12-23 07:02:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(16,2) NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('box','unit') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unit',
  `stock` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `items`
--

INSERT INTO `items` (`id`, `name`, `code`, `price`, `category`, `type`, `stock`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Avolution', '1103', '31000.00', 'Rokok', 'unit', 46, '2021-11-22 04:26:40', '2021-11-23 06:47:27', NULL),
(2, 'Sampoerna Mild 12', '1101', '18500.00', 'Rokok', 'unit', 57, '2021-11-22 04:30:39', '2021-12-20 09:48:15', NULL),
(3, 'Sampoerna Mild 16', '1102', '25000.00', 'Rokok', 'unit', 58, '2021-11-22 04:31:29', '2021-11-28 15:56:27', NULL),
(4, 'Sampoerna Ultra Mild 12', '1104', '16000.00', 'Rokok', 'unit', 50, '2021-11-22 04:32:29', '2021-11-22 04:36:58', NULL),
(5, 'Sampoerna Ultra Mild 16', '1105', '22000.00', 'Rokok', 'unit', 50, '2021-11-22 04:33:03', '2021-11-22 04:37:07', NULL),
(6, 'Sampoerna Kretek', '1106', '13500.00', 'Rokok', 'unit', 49, '2021-11-22 04:33:49', '2021-12-21 04:40:14', NULL),
(7, 'Sampoerna Splash 12', '1107', '16000.00', 'Rokok', 'unit', 49, '2021-11-22 04:34:35', '2021-12-15 23:10:03', NULL),
(8, 'Sampoerna Splash 16', '1108', '22000.00', 'Rokok', 'unit', 49, '2021-11-22 04:35:23', '2021-11-23 04:51:29', NULL),
(9, 'U Mild 12', '1109', '16000.00', 'Rokok', 'unit', 58, '2021-11-22 04:36:06', '2021-12-21 05:09:48', NULL),
(10, 'U Mild 16', '1110', '22000.00', 'Rokok', 'unit', 47, '2021-11-22 04:38:11', '2021-11-23 05:42:43', NULL),
(11, 'Magnum Hitam', '1111', '18000.00', 'Rokok', 'unit', 60, '2021-11-22 04:38:59', '2021-11-22 04:38:59', NULL),
(12, 'Magnum Mild 16', '1112', '21500.00', 'Rokok', 'unit', 50, '2021-11-22 04:39:44', '2021-11-22 20:38:37', NULL),
(13, 'Magnum Mild 20', '1113', '24000.00', 'Rokok', 'unit', 50, '2021-11-22 04:40:13', '2021-11-22 20:38:48', NULL),
(14, 'Malboro Filter 12', '1114', '18000.00', 'Rokok', 'unit', 50, '2021-11-22 04:41:03', '2021-11-22 04:41:03', NULL),
(15, 'Malboro Filter 16', '1115', '23500.00', 'Rokok', 'unit', 60, '2021-11-22 04:41:51', '2021-11-22 04:41:51', NULL),
(16, 'Malboro Filter 20', '1116', '31000.00', 'Rokok', 'unit', 50, '2021-11-22 04:42:18', '2021-11-22 04:42:18', NULL),
(17, 'Malboro Ice', '1117', '31000.00', 'Rokok', 'unit', 60, '2021-11-22 04:45:17', '2021-11-22 04:45:17', NULL),
(18, 'Malboro Red', '1118', '31000.00', 'Rokok', 'unit', 60, '2021-11-22 04:46:09', '2021-11-22 04:46:09', NULL),
(19, 'Malboro Putih', '1119', '31000.00', 'Rokok', 'unit', 60, '2021-11-22 04:46:49', '2021-11-22 04:46:49', NULL),
(20, '234 Kretek 12', '1120', '18000.00', 'Rokok', 'unit', 60, '2021-11-22 04:47:25', '2021-11-22 04:47:25', NULL),
(21, '234 Kretek 16', '1121', '23000.00', 'Rokok', 'unit', 60, '2021-11-22 04:47:52', '2021-11-22 04:47:52', NULL),
(22, '234 Refil', '1122', '20000.00', 'Rokok', 'unit', 60, '2021-11-22 04:48:33', '2021-11-22 04:48:33', NULL),
(23, 'Forza', '1123', '11000.00', 'Rokok', 'unit', 60, '2021-11-22 04:49:02', '2021-11-22 20:40:00', NULL),
(24, 'Bokomas', '1124', '11000.00', 'Rokok', 'unit', 50, '2021-11-22 04:49:36', '2021-11-28 15:56:36', NULL),
(25, 'Bagas', '1125', '6000.00', 'Rokok', 'unit', 50, '2021-11-22 04:49:56', '2021-11-22 04:49:56', NULL),
(26, 'Gudang Garam Filter', '1201', '19500.00', 'Rokok', 'unit', 60, '2021-11-22 20:41:34', '2021-11-22 20:41:34', NULL),
(27, 'Gudang Garam Kretek 12', '1202', '13500.00', 'Rokok', 'unit', 50, '2021-11-22 20:42:25', '2021-11-22 20:42:25', NULL),
(28, 'Gudang Garam Kretek 16', '1203', '16500.00', 'Rokok', 'unit', 50, '2021-11-22 20:42:54', '2021-11-22 20:42:54', NULL),
(29, 'Surya 12', '1204', '19500.00', 'Rokok', 'unit', 60, '2021-11-22 20:43:39', '2021-11-22 20:45:08', NULL),
(30, 'Surya 16', '1205', '25500.00', 'Rokok', 'unit', 60, '2021-11-22 20:44:58', '2021-11-22 20:44:58', NULL),
(31, 'Promild', '1206', '21500.00', 'Rokok', 'unit', 60, '2021-11-22 20:46:39', '2021-11-22 20:46:39', NULL),
(32, 'Promild Profesional', '1207', '21500.00', 'Rokok', 'unit', 60, '2021-11-22 20:47:06', '2021-11-22 20:47:06', NULL),
(33, 'Signatur Hitam', '1208', '17500.00', 'Rokok', 'unit', 60, '2021-11-22 20:47:46', '2021-11-22 20:47:46', NULL),
(34, 'Signatur Mild', '1209', '21000.00', 'Rokok', 'unit', 50, '2021-11-22 20:48:14', '2021-11-22 20:48:14', NULL),
(35, 'GG Halim', '1210', '18000.00', 'Rokok', 'unit', 60, '2021-11-22 20:49:25', '2021-11-22 20:49:25', NULL),
(36, 'GG Patra', '1211', '11000.00', 'Rokok', 'unit', 50, '2021-11-22 20:49:48', '2021-11-22 20:49:48', NULL),
(37, 'GG Move', '1212', '13000.00', 'Rokok', 'unit', 20, '2021-11-22 20:50:22', '2021-11-22 20:50:22', NULL),
(38, 'Jarum Super 12', '1301', '19500.00', 'Rokok', 'unit', 60, '2021-11-22 20:53:15', '2021-11-22 20:53:15', NULL),
(39, 'Jarum Super 16', '1302', '25000.00', 'Rokok', 'unit', 60, '2021-11-22 20:53:45', '2021-11-22 20:53:45', NULL),
(40, 'Jarum 76 12', '1303', '14000.00', 'Rokok', 'unit', 40, '2021-11-22 20:54:51', '2021-11-28 15:56:47', NULL),
(41, 'Jarum 76 16', '1304', '18500.00', 'Rokok', 'unit', 50, '2021-11-22 20:55:42', '2021-11-22 20:55:42', NULL),
(42, 'Jarum 76 Filter', '1305', '18000.00', 'Rokok', 'unit', 30, '2021-11-22 20:56:48', '2021-11-22 20:56:48', NULL),
(43, 'Jarum Black', '1306', '24000.00', 'Rokok', 'unit', 30, '2021-11-22 20:57:54', '2021-11-22 20:57:54', NULL),
(44, 'Jarum Next', '1307', '15500.00', 'Rokok', 'unit', 20, '2021-11-22 20:58:53', '2021-11-22 20:58:53', NULL),
(45, 'Jarum Wave', '1308', '16000.00', 'Rokok', 'unit', 20, '2021-11-22 20:59:31', '2021-11-22 20:59:31', NULL),
(47, 'MLD Hitam 12', '1309', '17000.00', 'Rokok', 'unit', 60, '2021-11-28 15:28:58', '2021-11-28 15:56:53', NULL),
(48, 'MLD Hitam 16', '1310', '24000.00', 'Rokok', 'unit', 60, '2021-11-28 15:30:35', '2021-11-28 15:30:35', NULL),
(49, 'MLD Putih 12', '1311', '16500.00', 'Rokok', 'unit', 50, '2021-11-28 15:31:43', '2021-11-28 15:31:43', NULL),
(50, 'MLD Putih 16', '1312', '27500.00', 'Rokok', 'unit', 60, '2021-11-28 15:32:43', '2021-11-28 15:32:43', NULL),
(51, 'LA 12', '1313', '17500.00', 'Rokok', 'unit', 50, '2021-11-28 15:33:37', '2021-11-28 15:33:37', NULL),
(52, 'LA 16', '1314', '24000.00', 'Rokok', 'unit', 50, '2021-11-28 15:34:15', '2021-11-28 15:34:15', NULL),
(53, 'LA Bold 12', '1315', '17500.00', 'Rokok', 'unit', 40, '2021-11-28 15:35:08', '2021-11-28 15:35:08', NULL),
(54, 'LA Bold 20', '1316', '26000.00', 'Rokok', 'unit', 50, '2021-11-28 15:36:06', '2021-11-28 15:36:06', NULL),
(55, 'Crystal 16', '1317', '16000.00', 'Rokok', 'unit', 40, '2021-11-28 15:37:11', '2021-11-28 15:37:11', NULL),
(56, 'Viper 16', '1318', '15500.00', 'Rokok', 'unit', 40, '2021-11-28 15:38:13', '2021-11-28 15:38:13', NULL),
(57, 'VIP 12', '1319', '12000.00', 'Rokok', 'unit', 30, '2021-11-28 15:38:55', '2021-11-28 15:38:55', NULL),
(58, 'Lucky Strike', '1320', '27000.00', 'Rokok', 'unit', 40, '2021-11-28 15:40:56', '2021-11-28 15:40:56', NULL),
(59, 'Wismilak Filter 12', '1401', '19500.00', 'Rokok', 'unit', 30, '2021-11-28 15:44:34', '2021-11-28 15:44:34', NULL),
(60, 'Wismilak Filter 16', '1402', '24000.00', 'Rokok', 'unit', 30, '2021-11-28 15:45:02', '2021-11-28 15:45:02', NULL),
(61, 'Wismilak Mild', '1403', '17000.00', 'Rokok', 'unit', 20, '2021-11-28 15:45:37', '2021-11-28 15:45:37', NULL),
(62, 'Wismilak Mild Menthol', '1404', '17000.00', 'Rokok', 'unit', 20, '2021-11-28 15:46:12', '2021-11-28 15:57:10', NULL),
(63, 'Wismilak Evo', '1405', '16500.00', 'Rokok', 'unit', 30, '2021-11-28 15:46:50', '2021-11-28 15:46:50', NULL),
(64, 'Dunhil Hitam 12', '1501', '17500.00', 'Rokok', 'unit', 40, '2021-11-28 15:47:45', '2021-11-28 15:47:45', NULL),
(65, 'Dunhil Hitam 16', '1502', '25500.00', 'Rokok', 'unit', 40, '2021-11-28 15:48:21', '2021-11-28 15:48:21', NULL),
(66, 'Dunhil Putih 16', '1503', '25000.00', 'Rokok', 'unit', 40, '2021-11-28 15:48:58', '2021-11-28 15:48:58', NULL),
(67, 'Dunhil Putih 20', '1504', '33000.00', 'Rokok', 'unit', 35, '2021-11-28 15:49:37', '2021-11-28 15:49:37', NULL),
(68, 'Class Mild 12', '1601', '17000.00', 'Rokok', 'unit', 30, '2021-11-28 15:50:59', '2021-11-28 15:50:59', NULL),
(69, 'Class Mild 16', '1602', '23000.00', 'Rokok', 'unit', 30, '2021-11-28 15:51:35', '2021-11-28 15:52:29', NULL),
(70, 'Class Silver', '1603', '20000.00', 'Rokok', 'unit', 20, '2021-11-28 15:52:17', '2021-11-28 15:52:17', NULL),
(71, 'Aroma Bold', '1604', '12000.00', 'Rokok', 'unit', 20, '2021-11-28 15:53:40', '2021-11-28 15:53:40', NULL),
(72, 'Aspro', '1605', '16500.00', 'Rokok', 'unit', 30, '2021-11-28 15:54:13', '2021-11-28 15:54:13', NULL),
(73, 'Camel Ungu', '1606', '15000.00', 'Rokok', 'unit', 20, '2021-11-28 15:54:55', '2021-11-28 15:54:55', NULL),
(74, 'Country', '1607', '20000.00', 'Rokok', 'unit', 20, '2021-11-28 15:55:22', '2021-11-28 15:55:22', NULL),
(75, 'Teh Pucuk 350ml', '2101', '3500.00', 'Minuman', 'unit', 78, '2021-11-28 16:16:05', '2021-12-23 07:02:42', NULL),
(76, 'Aqua 330ml', '2102', '2000.00', 'Minuman', 'unit', 20, '2021-11-28 19:45:44', '2021-11-28 19:45:44', NULL),
(77, 'Aqua 600ml', '2103', '3000.00', 'Minuman', 'unit', 35, '2021-11-28 19:46:32', '2021-11-28 19:46:32', NULL),
(78, 'Aqua 1,5L', '2104', '6000.00', 'Minuman', 'unit', 20, '2021-11-28 19:52:03', '2021-11-28 19:52:03', NULL),
(79, 'Aqua Galon 19L', '2105', '18000.00', 'Minuman', 'unit', 22, '2021-11-28 19:54:24', '2021-11-28 19:54:24', NULL),
(80, 'Aqua Gelas', '2106', '31500.00', 'Minuman', 'box', 5, '2021-11-28 19:55:11', '2021-11-28 23:02:26', NULL),
(81, 'Vit 220ml', '2107', '1000.00', 'Minuman', 'unit', 15, '2021-11-28 19:57:14', '2021-11-28 19:57:14', NULL),
(82, 'Vit 330ml', '2108', '2000.00', 'Minuman', 'unit', 20, '2021-11-28 19:57:56', '2021-11-28 19:57:56', NULL),
(83, 'Vit 600ml', '2109', '3000.00', 'Minuman', 'unit', 19, '2021-11-28 19:58:27', '2021-12-15 23:09:44', NULL),
(84, 'Vit Gelas', '2111', '23500.00', 'Minuman', 'box', 5, '2021-11-28 19:59:44', '2021-11-28 23:02:07', NULL),
(85, 'Le Mineral 220ml', '2112', '2000.00', 'Minuman', 'unit', 15, '2021-11-28 20:00:45', '2021-11-28 20:03:45', NULL),
(86, 'Le Mineral 600ml', '2113', '3000.00', 'Minuman', 'unit', 20, '2021-11-28 20:02:44', '2021-11-28 20:03:35', NULL),
(87, 'Vit 1,5L', '2110', '5000.00', 'Minuman', 'unit', 20, '2021-11-28 20:04:46', '2021-11-28 20:04:46', NULL),
(88, 'Le Mineral Galon', '2114', '19000.00', 'Minuman', 'unit', 5, '2021-11-28 20:06:06', '2021-11-28 20:06:06', NULL),
(89, 'Mizon 500ml', '2115', '5000.00', 'Minuman', 'unit', 20, '2021-11-28 20:07:08', '2021-11-28 20:07:08', NULL),
(90, 'Pocari 350ml', '2116', '6000.00', 'Minuman', 'unit', 20, '2021-11-28 21:49:14', '2021-11-28 21:49:14', NULL),
(91, 'Pocari 500ml', '2117', '7000.00', 'Minuman', 'unit', 20, '2021-11-28 21:50:27', '2021-11-28 21:50:27', NULL),
(92, 'Pocari 2L', '2118', '18000.00', 'Minuman', 'unit', 5, '2021-11-28 21:51:23', '2021-11-28 21:51:23', NULL),
(93, 'Frestea 350ml', '2119', '5000.00', 'Minuman', 'unit', 15, '2021-11-28 21:52:19', '2021-11-28 21:52:19', NULL),
(94, 'Frestea 500ml', '2120', '6000.00', 'Minuman', 'unit', 20, '2021-11-28 21:52:56', '2021-11-28 21:52:56', NULL),
(95, 'Coolant 350ml', '2121', '6000.00', 'Minuman', 'unit', 15, '2021-11-28 21:54:09', '2021-11-28 21:54:09', NULL),
(96, 'Hydrococo 330ml', '2122', '9000.00', 'Minuman', 'unit', 20, '2021-11-28 21:54:52', '2021-11-28 21:54:52', NULL),
(97, 'CocaCola 390ml', '2123', '5000.00', 'Minuman', 'unit', 20, '2021-11-28 21:55:49', '2021-11-28 21:55:49', NULL),
(98, 'CocaCola 1L', '2124', '10000.00', 'Minuman', 'unit', 5, '2021-11-28 21:56:52', '2021-11-28 21:57:51', NULL),
(99, 'Sprite 390ml', '2125', '5000.00', 'Minuman', 'unit', 20, '2021-11-28 21:57:38', '2021-11-28 21:57:38', NULL),
(100, 'Sprite 1L', '2126', '10000.00', 'Minuman', 'unit', 5, '2021-11-28 22:00:02', '2021-11-28 22:00:02', NULL),
(101, 'Kopiko 78°C 240ml', '2127', '6000.00', 'Minuman', 'unit', 20, '2021-11-28 22:02:05', '2021-11-28 22:02:05', NULL),
(102, 'Chocolatos btl 200ml', '2128', '6000.00', 'Minuman', 'unit', 15, '2021-11-28 22:03:31', '2021-11-28 22:29:56', NULL),
(103, 'Cimory Yougurt 250ml', '2129', '8500.00', 'Minuman', 'unit', 10, '2021-11-28 22:04:32', '2021-11-28 22:04:32', NULL),
(104, 'Cimory Yougurt Squeeze 120ml', '2130', '10500.00', 'Minuman', 'unit', 10, '2021-11-28 22:06:38', '2021-11-28 22:06:38', NULL),
(105, 'Yakult 65ml', '2131', '2000.00', 'Minuman', 'unit', 60, '2021-11-28 22:07:24', '2021-11-28 22:07:24', NULL),
(106, 'Yakult 325ml', '2132', '9000.00', 'Minuman', 'box', 5, '2021-11-28 22:07:58', '2021-11-28 22:07:58', NULL),
(107, 'Nescafe 220ml', '2133', '6500.00', 'Minuman', 'unit', 20, '2021-11-28 22:08:34', '2021-11-28 22:08:34', NULL),
(108, 'Larutan Cap Kaki klg 320ml', '2134', '6500.00', 'Minuman', 'unit', 10, '2021-11-28 22:10:49', '2021-11-28 22:10:49', NULL),
(109, 'Larutan Cap Badak btl 200ml', '2135', '4000.00', 'Minuman', 'unit', 10, '2021-11-28 22:12:22', '2021-11-28 22:12:22', NULL),
(110, 'Larutan Cap Badak btl 500ml', '2136', '8000.00', 'Minuman', 'unit', 10, '2021-11-28 22:13:12', '2021-11-28 22:13:12', NULL),
(111, 'Adem Sari klg 320ml', '2137', '6500.00', 'Minuman', 'unit', 10, '2021-11-28 22:14:22', '2021-11-28 22:14:22', NULL),
(112, 'Adem Sari btl 350ml', '2138', '6000.00', 'Minuman', 'unit', 10, '2021-11-28 22:15:19', '2021-11-28 22:15:19', NULL),
(113, 'Bear Brand 189ml', '2139', '10000.00', 'Minuman', 'unit', 10, '2021-11-28 22:16:13', '2021-11-28 22:16:13', NULL),
(114, 'Ultra Sari Kacang Hijau 250ml', '2140', '6000.00', 'Minuman', 'unit', 10, '2021-11-28 22:17:39', '2021-11-28 22:17:39', NULL),
(115, 'Frisian Flag ktk 225ml', '2141', '5500.00', 'Minuman', 'unit', 10, '2021-11-28 22:18:45', '2021-11-28 22:18:45', NULL),
(116, 'Frisian Flag ktk 180ml', '2142', '4500.00', 'Minuman', 'unit', 10, '2021-11-28 22:19:13', '2021-11-28 22:19:13', NULL),
(117, 'Frisian Flag ktk 900ml', '2143', '18000.00', 'Minuman', 'unit', 5, '2021-11-28 22:19:48', '2021-11-28 22:19:48', NULL),
(118, 'Frisian Flag ktk 115ml', '2144', '3000.00', 'Minuman', 'unit', 20, '2021-11-28 22:24:46', '2021-11-28 22:24:46', NULL),
(119, 'Indomilk btl 190ml', '2145', '5000.00', 'Minuman', 'unit', 60, '2021-11-28 22:25:40', '2021-11-28 22:25:40', NULL),
(120, 'Indomilk ktk 115ml', '2146', '3000.00', 'Minuman', 'unit', 20, '2021-11-28 22:26:14', '2021-11-28 22:26:14', NULL),
(121, 'Milo ktk 180ml', '2147', '5500.00', 'Minuman', 'unit', 10, '2021-11-28 22:27:38', '2021-11-28 22:27:38', NULL),
(122, 'Milo ktk 110ml', '2148', '3000.00', 'Minuman', 'unit', 10, '2021-11-28 22:28:34', '2021-11-28 22:28:34', NULL),
(123, 'Chocolatos ktk 190ml', '2149', '5000.00', 'Minuman', 'unit', 10, '2021-11-28 22:29:35', '2021-11-28 22:29:35', NULL),
(124, 'Teh Pucuk 1L', '2150', '12000.00', 'Minuman', 'unit', 5, '2021-11-28 22:55:29', '2021-11-28 22:55:29', NULL),
(125, 'Oramin C Drink 120ml', '2151', '6000.00', 'Minuman', 'unit', 15, '2021-11-28 22:58:28', '2021-11-28 22:58:28', NULL),
(126, 'Kratingdeng 150ml', '2152', '5500.00', 'Minuman', 'unit', 10, '2021-11-28 22:59:03', '2021-11-28 22:59:03', NULL),
(127, 'You C1000 140ml', '2153', '10000.00', 'Minuman', 'unit', 15, '2021-11-28 22:59:40', '2021-11-28 22:59:40', NULL),
(128, 'Kiranti 150ml', '2154', '6500.00', 'Minuman', 'unit', 10, '2021-11-28 23:00:35', '2021-11-28 23:00:35', NULL),
(129, 'Buavita ktk 20ml', '2155', '7000.00', 'Minuman', 'unit', 10, '2021-11-28 23:01:11', '2021-11-28 23:01:11', NULL),
(130, 'Lifebuoy', '3101', '3000.00', 'Sabun', 'unit', 8, '2021-11-29 00:12:56', '2021-12-23 07:02:29', NULL),
(131, 'Citra', '3102', '2500.00', 'Sabun', 'unit', 5, '2021-11-29 00:16:57', '2021-11-29 00:16:57', NULL),
(132, 'Giv', '3103', '2500.00', 'Sabun', 'unit', 5, '2021-11-29 00:17:37', '2021-11-29 00:17:37', NULL),
(133, 'Nuvo', '3104', '2500.00', 'Sabun', 'unit', 5, '2021-11-29 00:18:07', '2021-11-29 00:18:07', NULL),
(134, 'Lux kcl', '3105', '3500.00', 'Sabun', 'unit', 5, '2021-11-29 00:19:05', '2021-11-29 00:19:05', NULL),
(135, 'Lux bsr', '3106', '4500.00', 'Sabun', 'unit', 5, '2021-11-29 00:19:33', '2021-11-29 00:19:33', NULL),
(136, 'Sinzui', '3107', '4500.00', 'Sabun', 'unit', 5, '2021-11-29 00:20:07', '2021-11-29 00:20:07', NULL),
(137, 'Switzal', '3108', '4000.00', 'Sabun', 'unit', 5, '2021-11-29 00:20:31', '2021-11-29 00:20:31', NULL),
(138, 'Asepso', '3109', '7000.00', 'Sabun', 'unit', 5, '2021-11-29 00:21:07', '2021-11-29 00:21:07', NULL),
(139, 'Cusson Baby', '3110', '4000.00', 'Sabun', 'unit', 9, '2021-11-29 00:21:34', '2021-12-21 05:10:15', NULL),
(140, 'Dettol', '3111', '3500.00', 'Sabun', 'unit', 5, '2021-11-29 00:22:04', '2021-11-29 00:22:04', NULL),
(141, 'Tawon kcl', '3112', '5000.00', 'Sabun', 'unit', 5, '2021-11-29 00:22:46', '2021-11-29 00:22:46', NULL),
(142, 'Tawon bsr', '3113', '7000.00', 'Sabun', 'unit', 5, '2021-11-29 00:23:37', '2021-11-29 00:23:37', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_08_06_101125_create_items_table', 1),
(5, '2021_08_12_070512_create_transactions_table', 1),
(6, '2021_08_28_005142_create_carts_table', 1),
(7, '2021_11_23_202046_add_column_to_transactions_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `price_total` decimal(16,2) NOT NULL,
  `paying` decimal(15,2) NOT NULL,
  `refund` decimal(15,2) NOT NULL DEFAULT '0.00',
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`id`, `code`, `date`, `price_total`, `paying`, `refund`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '22000_1648_61c05179d5112', '2021-12-20', '22000.00', '25000.00', '3000.00', 2, '2021-12-20 09:48:41', '2021-12-20 09:48:41'),
(2, '16500_1141_61c15ae39076c', '2021-12-21', '16500.00', '20000.00', '3500.00', 1, '2021-12-21 04:41:07', '2021-12-21 04:41:07'),
(3, '6500_1403_61c41f2ec76c6', '2021-12-23', '6500.00', '10000.00', '3500.00', 1, '2021-12-23 07:03:11', '2021-12-23 07:03:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'kafa3', 'kafa3@gmail.com', '2021-11-19 10:04:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '4qpu3dSx8QGyQkdTDlCQbc5eLnsk474W7YgcnWZcjkptCauBT0OlMxxcAYIH', '2021-11-19 10:04:50', '2021-11-19 10:04:50'),
(2, 'fariqi', 'fariqi@gmail.com', '2021-11-19 10:04:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'OOa2aZArODxC7SRJqJIlql1FLHLj2Nzg0Ph2HJUCVdBizmFplDkm3KpFYwHX', '2021-11-19 10:04:50', '2021-11-19 10:04:50');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_item_id_foreign` (`item_id`);

--
-- Indeks untuk tabel `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
