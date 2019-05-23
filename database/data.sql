-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.16-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for laravel_test
CREATE DATABASE IF NOT EXISTS `laravel_test` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `laravel_test`;


-- Dumping structure for table laravel_test.activations
CREATE TABLE IF NOT EXISTS `activations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table laravel_test.activations: ~2 rows (approximately)
DELETE FROM `activations`;
/*!40000 ALTER TABLE `activations` DISABLE KEYS */;
INSERT INTO `activations` (`id`, `user_id`, `code`, `completed`, `completed_at`, `created_at`, `updated_at`) VALUES
	(1, 19, 'TXtbRtUXlPpJgDIIHK7OImSey7yCG4rG', 1, '2017-06-19 04:01:00', '2017-06-19 04:01:00', '2017-06-19 04:01:00'),
	(2, 20, 'VZFRgjj1wYJUJWwd8SIrwNR3D0x6vfxD', 1, '2017-06-19 06:57:09', '2017-06-19 06:57:08', '2017-06-19 06:57:09');
/*!40000 ALTER TABLE `activations` ENABLE KEYS */;


-- Dumping structure for table laravel_test.address
CREATE TABLE IF NOT EXISTS `address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `test` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table laravel_test.address: ~0 rows (approximately)
DELETE FROM `address`;
/*!40000 ALTER TABLE `address` DISABLE KEYS */;
INSERT INTO `address` (`id`, `name`, `address`, `test`, `deleted_at`) VALUES
	(1, 'tet', 'hn', 'ttt', NULL);
/*!40000 ALTER TABLE `address` ENABLE KEYS */;


-- Dumping structure for table laravel_test.articles
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table laravel_test.articles: ~5 rows (approximately)
DELETE FROM `articles`;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` (`id`, `name`, `author`, `created_at`, `updated_at`) VALUES
	(1, 'ThinhNH', 'Tac Gia', '2017-03-29 07:56:52', '2017-03-29 07:56:52'),
	(2, 'Test2', 'Test2Author', '2017-03-29 07:56:55', '2017-03-29 07:56:55'),
	(3, 'tes', 'tet', '2017-03-29 08:22:06', '2017-03-29 08:22:06'),
	(4, 'test', 'test', '2017-03-29 00:00:00', '2017-03-29 08:28:28'),
	(5, 'test2', 'test3', '2017-03-29 00:00:00', '2017-03-29 08:29:51');
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;


-- Dumping structure for table laravel_test.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) DEFAULT NULL,
  `title` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table laravel_test.category: ~0 rows (approximately)
DELETE FROM `category`;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
/*!40000 ALTER TABLE `category` ENABLE KEYS */;


-- Dumping structure for table laravel_test.customers
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `age` int(11) NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table laravel_test.customers: ~50 rows (approximately)
DELETE FROM `customers`;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` (`id`, `name`, `age`, `phone`, `created_at`, `updated_at`) VALUES
	(1, 'Maia Boyle', 21, '489-618-0344 x3153', '2017-06-19 16:35:09', '2017-06-19 16:35:09'),
	(2, 'Marianna Kozey', 68, '207.572.0287 x5165', '2017-03-29 10:13:45', '2017-03-29 10:13:45'),
	(3, 'Justen Sipes Sr.', 28, '718.913.8775 x49029', '2017-03-29 10:13:45', '2017-03-29 10:13:45'),
	(4, 'Adolfo Bosco DVM', 57, '1-878-547-3496 x23147', '2017-03-29 10:13:45', '2017-03-29 10:13:45'),
	(5, 'Miss Thea Rau', 71, '1-952-593-7866 x817', '2017-03-29 10:13:45', '2017-03-29 10:13:45'),
	(6, 'Miss Lauretta Dickens MD', 19, '(371) 574-0606 x918', '2017-03-29 10:13:45', '2017-03-29 10:13:45'),
	(7, 'Fabiola Hane', 46, '675-498-9233 x1027', '2017-03-29 10:13:45', '2017-03-29 10:13:45'),
	(8, 'Mollie Klocko', 77, '215-719-3624 x272', '2017-03-29 10:13:45', '2017-03-29 10:13:45'),
	(9, 'Cedrick Medhurst I', 82, '864.590.3276 x92321', '2017-03-29 10:13:45', '2017-03-29 10:13:45'),
	(10, 'Abby Botsford MD', 83, '992-916-7121 x02425', '2017-03-29 10:13:45', '2017-03-29 10:13:45'),
	(11, 'Mrs. Maximillia Kuhlman', 2, '(524) 927-2918', '2017-03-29 10:13:45', '2017-03-29 10:13:45'),
	(12, 'Emiliano Ziemann', 81, '(613) 297-8629', '2017-03-29 10:13:45', '2017-03-29 10:13:45'),
	(13, 'Miss Brooklyn Bernier', 8, '(718) 765-2777 x694', '2017-03-29 10:13:45', '2017-03-29 10:13:45'),
	(14, 'Mr. Enos Crist', 74, '(423) 477-6168', '2017-03-29 10:13:45', '2017-03-29 10:13:45'),
	(15, 'Jerrell King', 68, '501.306.5455 x0304', '2017-03-29 10:13:45', '2017-03-29 10:13:45'),
	(16, 'Abigale Bahringer', 32, '+15848789546', '2017-03-29 10:13:45', '2017-03-29 10:13:45'),
	(17, 'Oscar Nicolas', 76, '942.930.0646', '2017-03-29 10:13:45', '2017-03-29 10:13:45'),
	(18, 'Lexie Stehr', 68, '(920) 352-2273', '2017-03-29 10:13:45', '2017-03-29 10:13:45'),
	(19, 'Marcelino Schultz', 5, '1-760-394-2794', '2017-03-29 10:13:45', '2017-03-29 10:13:45'),
	(20, 'Dovie Schultz', 9, '789.751.4001', '2017-03-29 10:13:45', '2017-03-29 10:13:45'),
	(21, 'Prof. Sophia Fahey', 21, '(558) 624-1406 x557', '2017-03-29 10:13:45', '2017-03-29 10:13:45'),
	(22, 'Elwin Baumbach', 22, '1-975-777-2334 x23187', '2017-03-29 10:13:45', '2017-03-29 10:13:45'),
	(23, 'Marjorie Prosacco', 18, '465-384-1845', '2017-03-29 10:13:45', '2017-03-29 10:13:45'),
	(24, 'Nasir Block DVM', 61, '+1 (643) 218-3367', '2017-03-29 10:13:46', '2017-03-29 10:13:46'),
	(25, 'Cristian Jenkins', 62, '(915) 946-0762', '2017-03-29 10:13:46', '2017-03-29 10:13:46'),
	(26, 'Nyah Bogisich', 66, '439.408.9303', '2017-03-29 10:13:46', '2017-03-29 10:13:46'),
	(27, 'Aisha Lakin', 26, '487-965-7634', '2017-03-29 10:13:46', '2017-03-29 10:13:46'),
	(28, 'Emerald Konopelski', 21, '+1-573-284-7052', '2017-03-29 10:13:46', '2017-03-29 10:13:46'),
	(29, 'Prof. Emanuel Rutherford', 37, '(429) 520-7628', '2017-03-29 10:13:46', '2017-03-29 10:13:46'),
	(30, 'Rafaela Swift', 72, '473-594-9214 x45723', '2017-03-29 10:13:46', '2017-03-29 10:13:46'),
	(31, 'Roosevelt Smith', 58, '907-924-4371', '2017-03-29 10:13:46', '2017-03-29 10:13:46'),
	(32, 'Anibal Paucek', 86, '(703) 750-4479 x139', '2017-03-29 10:13:46', '2017-03-29 10:13:46'),
	(33, 'Lolita Veum', 18, '1-663-839-7170 x8347', '2017-03-29 10:13:46', '2017-03-29 10:13:46'),
	(34, 'Prof. Francisca Sporer', 86, '+18652928700', '2017-03-29 10:13:46', '2017-03-29 10:13:46'),
	(35, 'Miss Bette Parisian V', 30, '647.300.8580', '2017-03-29 10:13:46', '2017-03-29 10:13:46'),
	(36, 'Chelsey Roberts', 12, '+1.405.513.9651', '2017-03-29 10:13:46', '2017-03-29 10:13:46'),
	(37, 'Maximo Rempel', 47, '918-940-1090 x203', '2017-03-29 10:13:46', '2017-03-29 10:13:46'),
	(38, 'Alysson Kuhlman', 59, '+1.521.413.3418', '2017-03-29 10:13:46', '2017-03-29 10:13:46'),
	(39, 'Mrs. Lynn Rempel', 19, '1-593-842-8670 x6403', '2017-03-29 10:13:46', '2017-03-29 10:13:46'),
	(40, 'Kelly Gottlieb', 17, '(297) 368-4757 x59443', '2017-03-29 10:13:46', '2017-03-29 10:13:46'),
	(41, 'Prof. Karolann Harber Sr.', 77, '+1 (201) 747-8742', '2017-03-29 10:13:46', '2017-03-29 10:13:46'),
	(42, 'Bertram Thiel', 2, '1-312-944-0043 x60925', '2017-03-29 10:13:46', '2017-03-29 10:13:46'),
	(43, 'America Gislason', 86, '(932) 969-2710', '2017-03-29 10:13:46', '2017-03-29 10:13:46'),
	(44, 'Ms. Ona West Sr.', 75, '1-480-937-1927', '2017-03-29 10:13:46', '2017-03-29 10:13:46'),
	(45, 'Duncan Dooley', 26, '(425) 651-0156', '2017-03-29 10:13:46', '2017-03-29 10:13:46'),
	(46, 'Edwin Trantow', 6, '(442) 841-1797', '2017-03-29 10:13:46', '2017-03-29 10:13:46'),
	(47, 'Christopher Franecki', 8, '+1-882-213-1768', '2017-03-29 10:13:46', '2017-03-29 10:13:46'),
	(48, 'Prof. Merlin O\'Hara', 99, '416-436-5336', '2017-03-29 10:13:46', '2017-03-29 10:13:46'),
	(49, 'Darius Davis', 40, '+16192194590', '2017-03-29 10:13:46', '2017-03-29 10:13:46'),
	(50, 'Adolfo Moore II', 0, '(642) 968-1574 x8669', '2017-03-29 10:13:46', '2017-03-29 10:13:46');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;


-- Dumping structure for table laravel_test.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table laravel_test.migrations: ~0 rows (approximately)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_07_02_230147_migration_cartalyst_sentinel', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;


-- Dumping structure for table laravel_test.oauth_access_tokens
CREATE TABLE IF NOT EXISTS `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel_test.oauth_access_tokens: ~5 rows (approximately)
DELETE FROM `oauth_access_tokens`;
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
	('51f0ea604cf616af920afacf44f91a445c37dc3362d329670cf93b94ffb7a7ed02411898fad4dbb5', 19, 4, NULL, '[]', 0, '2017-06-19 04:55:56', '2017-06-19 04:55:56', '2017-06-19 05:00:56'),
	('a1a43b7e15c874470458bbd68bbd7dcb56517f3442bdf2f0bfe591fe3232dba4f9030abb3e24ea51', 1, 4, NULL, '[]', 0, '2017-06-16 09:07:04', '2017-06-16 09:07:04', '2017-06-16 09:12:04'),
	('ce36449fb7e99ab1b6510ca11294d9bb5c5a1f93d479bb19ac0aa136f1f658fc0e974c5a62941828', 1, 4, NULL, '[]', 0, '2017-06-16 09:09:43', '2017-06-16 09:09:43', '2017-06-16 09:14:43'),
	('f28d82dbf795335e931d0bd9ae0443dbaaef825ac5ee12d8f0b01fccabfb6c3fd79e3f524e488d74', 1, 4, NULL, '[]', 0, '2017-06-19 01:37:59', '2017-06-19 01:37:59', '2017-06-19 01:42:59'),
	('f980ecc94656ccaceb0eaecd7fa550f8e5b8373518a8df0953b57000bee52d706fe65e268cf86350', 1, 4, NULL, '[]', 0, '2017-06-16 09:25:24', '2017-06-16 09:25:24', '2017-06-16 09:30:24');
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;


-- Dumping structure for table laravel_test.oauth_auth_codes
CREATE TABLE IF NOT EXISTS `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel_test.oauth_auth_codes: ~0 rows (approximately)
DELETE FROM `oauth_auth_codes`;
/*!40000 ALTER TABLE `oauth_auth_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_auth_codes` ENABLE KEYS */;


-- Dumping structure for table laravel_test.oauth_clients
CREATE TABLE IF NOT EXISTS `oauth_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel_test.oauth_clients: ~4 rows (approximately)
DELETE FROM `oauth_clients`;
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
	(1, NULL, 'Laravel Personal Access Client', 'nFssyZ5Rf6lfDXyHJmazS4z97EsS0nlMq1jrc9ay', 'http://localhost', 1, 0, 0, '2017-06-16 07:40:23', '2017-06-16 07:40:23'),
	(2, NULL, 'Laravel Password Grant Client', 'w5ktVh4fhnDidK7UpqstShcaaiCnH041qSX2Ncwq', 'http://localhost', 0, 1, 0, '2017-06-16 07:40:24', '2017-06-16 07:40:24'),
	(3, 1, 'thinhnh1', 'AXYA4oB3CVYGby91zaQS3FEJUrKFOIOHHH6LcOzY', 'http://admin.base.laravel.com/callback', 0, 0, 0, '2017-06-16 07:52:15', '2017-06-16 07:52:15'),
	(4, NULL, 'thinhnh2', 'PgOi6qxxRSAEWcY4RXKmf6YkBnI11GbFjDhIkKbG', 'http://localhost', 0, 1, 0, '2017-06-16 08:33:10', '2017-06-16 08:33:10');
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;


-- Dumping structure for table laravel_test.oauth_personal_access_clients
CREATE TABLE IF NOT EXISTS `oauth_personal_access_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel_test.oauth_personal_access_clients: ~0 rows (approximately)
DELETE FROM `oauth_personal_access_clients`;
/*!40000 ALTER TABLE `oauth_personal_access_clients` DISABLE KEYS */;
INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
	(1, 1, '2017-06-16 07:40:24', '2017-06-16 07:40:24');
/*!40000 ALTER TABLE `oauth_personal_access_clients` ENABLE KEYS */;


-- Dumping structure for table laravel_test.oauth_refresh_tokens
CREATE TABLE IF NOT EXISTS `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel_test.oauth_refresh_tokens: ~5 rows (approximately)
DELETE FROM `oauth_refresh_tokens`;
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
INSERT INTO `oauth_refresh_tokens` (`id`, `access_token_id`, `revoked`, `expires_at`) VALUES
	('874416b8feb5ac65c1efada1ea19d3ba59cc822767e03dd5d56e1e0f479017bd195b44e29e5e1f0f', 'ce36449fb7e99ab1b6510ca11294d9bb5c5a1f93d479bb19ac0aa136f1f658fc0e974c5a62941828', 0, '2017-06-16 09:19:43'),
	('912364df09c4e120d2752c04f2a1d48cad9b0198a79898a26edfebcce9e3ba0df2b3fcc663b3df01', 'f980ecc94656ccaceb0eaecd7fa550f8e5b8373518a8df0953b57000bee52d706fe65e268cf86350', 0, '2017-06-16 09:35:24'),
	('a85f10dfec39ba020439c957d336a34215239ee567af4a61b451c2f665aa096a72f2d7ad19591060', 'a1a43b7e15c874470458bbd68bbd7dcb56517f3442bdf2f0bfe591fe3232dba4f9030abb3e24ea51', 0, '2017-06-16 09:17:04'),
	('b96d88ff6623bcf801fdf4eaf21c81c018411ce85d214aef96c2d460656295ea368149c88581d446', 'f28d82dbf795335e931d0bd9ae0443dbaaef825ac5ee12d8f0b01fccabfb6c3fd79e3f524e488d74', 0, '2017-06-19 01:47:59'),
	('cb7c64351593633494c2c95bfeaecb10e971a7156176e6eab4ed6fa2cd5d8b548db236a08220d863', '51f0ea604cf616af920afacf44f91a445c37dc3362d329670cf93b94ffb7a7ed02411898fad4dbb5', 0, '2017-06-19 05:05:56');
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;


-- Dumping structure for table laravel_test.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table laravel_test.password_resets: ~0 rows (approximately)
DELETE FROM `password_resets`;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;


-- Dumping structure for table laravel_test.persistences
CREATE TABLE IF NOT EXISTS `persistences` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `persistences_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table laravel_test.persistences: ~32 rows (approximately)
DELETE FROM `persistences`;
/*!40000 ALTER TABLE `persistences` DISABLE KEYS */;
INSERT INTO `persistences` (`id`, `user_id`, `code`, `created_at`, `updated_at`) VALUES
	(1, 19, 'edClV0DmddSRwp2clCxlz4YJ7SIAtnij', '2017-06-19 04:01:00', '2017-06-19 04:01:00'),
	(2, 19, 'iO1l00cWxKQzUzAoq8jUBTV3Okr3oVGD', '2017-06-19 04:01:23', '2017-06-19 04:01:23'),
	(3, 19, '338pzpD4KgsQyo9Sy8X4pRNnLIz4rlnH', '2017-06-19 04:01:36', '2017-06-19 04:01:36'),
	(4, 19, 'auO4i5btcDsQwuEmrePRNPPiyWRyclHC', '2017-06-19 04:01:42', '2017-06-19 04:01:42'),
	(5, 19, 'JqfVKnXYgLWd160rEHmLezzJ8oe9Jz5I', '2017-06-19 04:04:03', '2017-06-19 04:04:03'),
	(6, 19, '1zARLgFkBRtA1pibIZS5WA5sjbAhKHtl', '2017-06-19 04:04:38', '2017-06-19 04:04:38'),
	(7, 19, 'lSfH9mxsMn2GP6Byv5YhzAMtoTOcoknx', '2017-06-19 04:05:06', '2017-06-19 04:05:06'),
	(8, 19, 'znZh7S8lIaZ6Tt5a3fw0nBXM8MlBlwmq', '2017-06-19 04:05:25', '2017-06-19 04:05:25'),
	(9, 19, 'C1wYMp94Banui8mzHjiO4PfYNVqjgCfW', '2017-06-19 04:06:18', '2017-06-19 04:06:18'),
	(10, 19, 'c5YNRzp10JVKMzmoG8QNTvPf3pKmuXsd', '2017-06-19 04:18:31', '2017-06-19 04:18:31'),
	(11, 19, 'rbpSl61zNIrgUhEjKOTBic4TTAXE6Ne8', '2017-06-19 04:27:10', '2017-06-19 04:27:10'),
	(12, 19, 'ktLe29RihGMJ1NXcD6dkVppMp0GpnTFP', '2017-06-19 04:31:27', '2017-06-19 04:31:27'),
	(13, 19, 'u5hSi5p0q7mc0NBL4lA8YDCqeTPJdjf3', '2017-06-19 04:36:59', '2017-06-19 04:36:59'),
	(14, 19, 'eaMXNh2Lp7d6qT7BuUcuiarR7IPQbhlj', '2017-06-19 04:39:43', '2017-06-19 04:39:43'),
	(15, 19, 'vxvLjdtY2xV1teYXgxMYOcekn2keHlwb', '2017-06-19 04:39:48', '2017-06-19 04:39:48'),
	(16, 19, 'WSe1qpHUwKoUAksL3kROOvfq0NzGI1Yu', '2017-06-19 04:40:20', '2017-06-19 04:40:20'),
	(17, 19, 'EvHpspgeEqjLjNyQkkhREsLT6epoe584', '2017-06-19 04:42:19', '2017-06-19 04:42:19'),
	(18, 19, 'KZbHu95zPZ3QCx6t7xuvH77RyZheodzS', '2017-06-19 05:22:36', '2017-06-19 05:22:36'),
	(19, 19, 'nElGkXff5BswMUTYWu4oqZZJgKGOGoTO', '2017-06-19 06:07:22', '2017-06-19 06:07:22'),
	(20, 19, '9u5LxYgXjOtpWNfLsOLlC6Cra677x4Lg', '2017-06-19 06:10:23', '2017-06-19 06:10:23'),
	(21, 19, 'iU8qr4fHfLrsT0nXyVRjnePbbC5KfA51', '2017-06-19 06:14:25', '2017-06-19 06:14:25'),
	(22, 19, 'av6QFZAnRzMBKfIQvhSwb0AiJUxJ844N', '2017-06-19 06:14:43', '2017-06-19 06:14:43'),
	(23, 19, 'vgV5mCLe8ZrtVXSKLYErXOP1krjmHC6J', '2017-06-19 06:16:45', '2017-06-19 06:16:45'),
	(24, 19, 'tXNRLRnw6VZKamzAj3ESb1fXN51FKOR4', '2017-06-19 07:33:03', '2017-06-19 07:33:03'),
	(25, 19, 'VfY5E9eQQoXFBszDZfaVHZcS5dGemAr6', '2017-06-19 07:34:02', '2017-06-19 07:34:02'),
	(26, 19, 'PDahwAjntJf9YUOmND9kAfHsMySCqzx8', '2017-06-19 07:34:02', '2017-06-19 07:34:02'),
	(27, 19, 'qnGQ82RZryCABOwKAzOcrA5PaSXDyBL7', '2017-06-19 07:37:46', '2017-06-19 07:37:46'),
	(28, 19, 'GuPOuyryijP2C4czzIw7wrOxUMbQ1UqG', '2017-06-19 07:37:46', '2017-06-19 07:37:46'),
	(29, 19, 'XHEgJlZEwkJwdLNwyeDprUGdMUcrkDJi', '2017-06-19 07:38:14', '2017-06-19 07:38:14'),
	(30, 19, 'M9TTKk0d9DfZrw1VWTFXvMN5Sf3QDICH', '2017-06-19 07:47:50', '2017-06-19 07:47:50'),
	(31, 19, 'K9Am7KeNLOeg6IqYG08cMhLcNKlGyKI4', '2017-06-19 07:51:27', '2017-06-19 07:51:27'),
	(34, 19, 'uc5fW8hY2zGzmP58Acdv0SXBGSyb2Xwe', '2017-06-19 07:51:53', '2017-06-19 07:51:53'),
	(35, 19, 'Lo4EewtbO7A03nk1YSKcLY0IjdOOTZbX', '2017-06-19 07:51:53', '2017-06-19 07:51:53'),
	(36, 19, 'r3zKQTu7mc5vHgNWz9Z0epto4gTw3utq', '2017-06-19 08:33:56', '2017-06-19 08:33:56'),
	(37, 19, 'RtEAwOnyg23ylVH6k7oK3UOzcUyAK9ha', '2017-06-19 08:43:53', '2017-06-19 08:43:53');
/*!40000 ALTER TABLE `persistences` ENABLE KEYS */;


-- Dumping structure for table laravel_test.reminders
CREATE TABLE IF NOT EXISTS `reminders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table laravel_test.reminders: ~0 rows (approximately)
DELETE FROM `reminders`;
/*!40000 ALTER TABLE `reminders` DISABLE KEYS */;
/*!40000 ALTER TABLE `reminders` ENABLE KEYS */;


-- Dumping structure for table laravel_test.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table laravel_test.roles: ~2 rows (approximately)
DELETE FROM `roles`;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `slug`, `name`, `permissions`, `created_at`, `updated_at`) VALUES
	(1, 'administrator', 'Administrator', '', '2017-06-19 06:49:17', '2017-06-19 09:46:25'),
	(2, 'viewer', 'Viewer', '{"admin.roles.view":true,"admin.user.view":true}', '2017-06-19 06:50:55', '2017-06-19 06:50:55');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;


-- Dumping structure for table laravel_test.role_users
CREATE TABLE IF NOT EXISTS `role_users` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`,`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table laravel_test.role_users: ~2 rows (approximately)
DELETE FROM `role_users`;
/*!40000 ALTER TABLE `role_users` DISABLE KEYS */;
INSERT INTO `role_users` (`user_id`, `role_id`, `created_at`, `updated_at`) VALUES
	(6, 2, '2017-06-19 06:57:09', '2017-06-19 07:12:51'),
	(19, 1, '2017-06-19 06:57:09', '2017-06-19 07:09:33');
/*!40000 ALTER TABLE `role_users` ENABLE KEYS */;


-- Dumping structure for table laravel_test.throttle
CREATE TABLE IF NOT EXISTS `throttle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `throttle_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table laravel_test.throttle: ~9 rows (approximately)
DELETE FROM `throttle`;
/*!40000 ALTER TABLE `throttle` DISABLE KEYS */;
INSERT INTO `throttle` (`id`, `user_id`, `type`, `ip`, `created_at`, `updated_at`) VALUES
	(48, NULL, 'global', NULL, '2017-06-19 04:03:39', '2017-06-19 04:03:39'),
	(49, NULL, 'ip', '127.0.0.1', '2017-06-19 04:03:39', '2017-06-19 04:03:39'),
	(50, 19, 'user', NULL, '2017-06-19 04:03:39', '2017-06-19 04:03:39'),
	(51, NULL, 'global', NULL, '2017-06-19 04:05:02', '2017-06-19 04:05:02'),
	(52, NULL, 'ip', '127.0.0.1', '2017-06-19 04:05:02', '2017-06-19 04:05:02'),
	(53, 19, 'user', NULL, '2017-06-19 04:05:02', '2017-06-19 04:05:02'),
	(54, NULL, 'global', NULL, '2017-06-19 04:05:21', '2017-06-19 04:05:21'),
	(55, NULL, 'ip', '127.0.0.1', '2017-06-19 04:05:21', '2017-06-19 04:05:21'),
	(56, 19, 'user', NULL, '2017-06-19 04:05:21', '2017-06-19 04:05:21');
/*!40000 ALTER TABLE `throttle` ENABLE KEYS */;


-- Dumping structure for table laravel_test.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `last_login` timestamp NULL DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table laravel_test.users: ~3 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `email`, `password`, `permissions`, `last_login`, `first_name`, `last_name`, `created_at`, `updated_at`) VALUES
	(6, 'admin@gdcvn.com', '$2y$10$.gPsCDItEtjSbVQviXDS.uWzzEgNFPvgY42GezEh9RUBFdVhspW1a', NULL, '2017-06-19 10:40:13', 'GDC', 'VIP DAY', '2017-05-17 16:55:42', '2017-06-19 07:08:39'),
	(19, 'thinhnh@gdcvn.com', '$2y$10$TPaR2rnOSXG6BCzwPjk76OQPYfDboq9Z.aPOrSAyHhsjNsai3UuRW', NULL, '2017-06-19 08:43:53', 'Hữu', 'Thịnh', '2017-06-19 04:01:00', '2017-06-19 08:43:53');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
