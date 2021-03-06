-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.13-log - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table fish_go.campaign
CREATE TABLE IF NOT EXISTS `campaign` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `des` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `pdf_url` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table fish_go.campaign: ~0 rows (approximately)
/*!40000 ALTER TABLE `campaign` DISABLE KEYS */;
INSERT INTO `campaign` (`id`, `created_at`, `updated_at`, `title`, `des`, `pdf_url`) VALUES
	(1, '2016-06-19 02:45:19', '2016-06-19 02:45:19', 'Facere mollitia ratione in soluta perspiciatis et.', 'Laborum eos ut corporis at in aliquam. Iste delectus accusantium autem molestiae voluptatem tempora rerum. Nam voluptatum quibusdam temporibus illum.', '');
/*!40000 ALTER TABLE `campaign` ENABLE KEYS */;


-- Dumping structure for table fish_go.candidate
CREATE TABLE IF NOT EXISTS `candidate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `candidate_contact_number_unique` (`contact_number`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table fish_go.candidate: ~20 rows (approximately)
/*!40000 ALTER TABLE `candidate` DISABLE KEYS */;
INSERT INTO `candidate` (`id`, `created_at`, `updated_at`, `name`, `email`, `contact_number`) VALUES
	(6, '2016-06-19 00:21:02', '2016-06-19 00:21:02', 'Gloria Hettinger', 'mosciski.cornell@example.net', '594-806-2070'),
	(7, '2016-06-19 00:21:02', '2016-06-19 00:21:02', 'Ms. Alda Graham PhD', 'jean87@example.net', '+1.583.752.9743'),
	(8, '2016-06-19 00:21:02', '2016-06-19 00:21:02', 'Luisa Block', 'jodie52@example.net', '+1-752-422-0090'),
	(9, '2016-06-19 00:21:02', '2016-06-19 00:21:02', 'Finn Kuvalis', 'ferne.koelpin@example.net', '623-602-9445 x3076'),
	(10, '2016-06-19 00:21:02', '2016-06-19 00:21:02', 'Mrs. Jacinthe Abbott DDS', 'schumm.glenna@example.com', '250.771.6400 x12492'),
	(11, '2016-06-19 00:21:02', '2016-06-19 00:21:02', 'Manley Jakubowski', 'ogottlieb@example.com', '+1 (871) 278-7092'),
	(12, '2016-06-19 00:21:02', '2016-06-19 00:21:02', 'Ahmed Okuneva', 'fredrick.vandervort@example.com', '1-671-459-1590'),
	(13, '2016-06-19 00:21:02', '2016-06-19 00:21:02', 'Aracely Metz', 'jaskolski.kaley@example.net', '(479) 318-9624 x0125'),
	(14, '2016-06-19 00:21:02', '2016-06-19 00:21:02', 'Kirsten Swift IV', 'zack.schamberger@example.org', '+1-976-595-8638'),
	(15, '2016-06-19 00:21:02', '2016-06-19 17:27:30', 'Anh Le Hoang', 'lehoanganh25991@gmail.com', '635.790.3827 x46024'),
	(16, '2016-06-19 00:21:02', '2016-06-19 00:21:02', 'Mallie Kris Jr.', 'rkonopelski@example.net', '435.576.4870 x4472'),
	(17, '2016-06-19 00:21:02', '2016-06-19 00:21:02', 'Al Yundt', 'stoltenberg.sven@example.org', '+1-805-499-7379'),
	(18, '2016-06-19 00:21:02', '2016-06-19 00:21:02', 'Baby Kshlerin', 'labadie.danielle@example.org', '1-345-699-0509 x4697'),
	(19, '2016-06-19 00:21:02', '2016-06-19 00:21:02', 'Mr. Jalen Kessler', 'kay.schmitt@example.com', '762-971-4638 x83018'),
	(20, '2016-06-19 00:21:02', '2016-06-19 00:21:02', 'Mrs. Velma White DVM', 'welch.marvin@example.com', '+14024652030'),
	(21, '2016-06-19 00:21:02', '2016-06-19 00:21:02', 'Riley Robel', 'leonel.kemmer@example.org', '606.740.2068'),
	(22, '2016-06-19 00:21:02', '2016-06-19 00:21:02', 'Mr. Josh Roob Jr.', 'douglas.muhammad@example.net', '1-423-934-7714'),
	(23, '2016-06-19 00:21:02', '2016-06-19 00:21:02', 'Rosetta Heller DVM', 'mekhi15@example.net', '(910) 661-0643 x81819'),
	(24, '2016-06-19 00:21:02', '2016-06-19 00:21:02', 'Rosina Hayes', 'weissnat.freeman@example.com', '581-306-6747'),
	(25, '2016-06-19 00:21:02', '2016-06-19 00:21:02', 'Burdette Lemke V', 'cleora.schowalter@example.com', '(985) 268-8576 x5472');
/*!40000 ALTER TABLE `candidate` ENABLE KEYS */;


-- Dumping structure for table fish_go.candidate_device
CREATE TABLE IF NOT EXISTS `candidate_device` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `candidate_id` int(10) unsigned NOT NULL,
  `device_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `candidate_device_candidate_id_foreign` (`candidate_id`),
  KEY `candidate_device_device_id_foreign` (`device_id`),
  CONSTRAINT `candidate_device_candidate_id_foreign` FOREIGN KEY (`candidate_id`) REFERENCES `candidate` (`id`),
  CONSTRAINT `candidate_device_device_id_foreign` FOREIGN KEY (`device_id`) REFERENCES `device` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table fish_go.candidate_device: ~0 rows (approximately)
/*!40000 ALTER TABLE `candidate_device` DISABLE KEYS */;
/*!40000 ALTER TABLE `candidate_device` ENABLE KEYS */;


-- Dumping structure for table fish_go.country
CREATE TABLE IF NOT EXISTS `country` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `country_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table fish_go.country: ~5 rows (approximately)
/*!40000 ALTER TABLE `country` DISABLE KEYS */;
INSERT INTO `country` (`id`, `created_at`, `updated_at`, `name`) VALUES
	(1, '2016-06-19 00:21:02', '2016-06-19 00:21:02', 'Singapore'),
	(2, '2016-06-19 00:21:02', '2016-06-19 00:21:02', 'Brunei'),
	(3, '2016-06-19 00:21:02', '2016-06-19 00:21:02', 'Malaysia'),
	(4, '2016-06-19 00:21:02', '2016-06-19 00:21:02', 'Vietnam'),
	(5, '2016-06-19 00:21:02', '2016-06-19 00:21:02', 'India');
/*!40000 ALTER TABLE `country` ENABLE KEYS */;


-- Dumping structure for table fish_go.device
CREATE TABLE IF NOT EXISTS `device` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `serial_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `des` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `candidate_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `device_serial_number_unique` (`serial_number`),
  KEY `device_candidate_id_foreign` (`candidate_id`),
  CONSTRAINT `device_candidate_id_foreign` FOREIGN KEY (`candidate_id`) REFERENCES `candidate` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table fish_go.device: ~32 rows (approximately)
/*!40000 ALTER TABLE `device` DISABLE KEYS */;
INSERT INTO `device` (`id`, `created_at`, `updated_at`, `serial_number`, `des`, `candidate_id`) VALUES
	(91, '2016-06-19 00:28:05', '2016-06-19 00:28:05', 'F9:32:28:15:88:13', 'Cumque et voluptatem tempore voluptate.', 14),
	(92, '2016-06-19 00:28:05', '2016-06-19 00:28:05', '24:00:C0:47:E4:7C', 'Ut quia quia ut.', 16),
	(93, '2016-06-19 00:28:05', '2016-06-19 00:28:05', '28:16:DE:18:02:AE', 'Nihil architecto vero sed repellendus harum omnis qui.', 7),
	(94, '2016-06-19 00:28:05', '2016-06-19 00:28:05', '00:6B:C5:7A:AF:51', 'Culpa est laudantium non repellendus saepe quo dolores.', 11),
	(95, '2016-06-19 00:28:05', '2016-06-19 00:28:05', '45:D3:16:0E:59:93', 'Eveniet fugiat illo voluptatem vel ut ut.', 13),
	(96, '2016-06-19 00:28:05', '2016-06-19 00:28:05', '31:C2:6D:9D:95:26', 'Qui et porro amet eaque.', 21),
	(97, '2016-06-19 00:28:05', '2016-06-19 00:28:05', '66:EC:14:E7:5A:C5', 'Culpa aut qui numquam quasi quia.', 21),
	(98, '2016-06-19 00:28:05', '2016-06-19 00:28:05', 'A2:62:E3:7F:32:58', 'Aliquam quis et qui vero corrupti minima maxime eaque.', 19),
	(99, '2016-06-19 00:28:05', '2016-06-19 00:28:05', '20:93:F7:6B:F9:3D', 'Facilis soluta nisi animi reprehenderit quis.', 21),
	(100, '2016-06-19 00:28:05', '2016-06-19 00:28:05', '89:DA:92:73:FB:39', 'Est ea incidunt quae et consequatur repellendus.', 13),
	(101, '2016-06-19 00:28:05', '2016-06-19 00:28:05', 'E8:1A:8F:85:94:EF', 'Quidem aut aut excepturi error quas sit tempora.', 21),
	(102, '2016-06-19 00:28:05', '2016-06-19 00:28:05', '39:FE:A1:56:7E:E6', 'Reprehenderit eum sequi voluptas et adipisci aut autem.', 17),
	(103, '2016-06-19 00:28:05', '2016-06-19 00:28:05', '44:6C:BB:27:EE:37', 'Doloremque voluptatem ut corrupti quia ducimus.', 13),
	(104, '2016-06-19 00:28:05', '2016-06-19 00:28:05', '34:D7:36:4C:12:C6', 'Eum iusto est molestiae deleniti nam.', 12),
	(105, '2016-06-19 00:28:05', '2016-06-19 00:28:05', 'C9:67:1D:87:9C:54', 'Commodi et corrupti optio occaecati ut.', 9),
	(106, '2016-06-19 00:28:05', '2016-06-19 00:28:05', '82:F9:F4:7B:CB:44', 'Veniam et cupiditate unde quia magnam.', 20),
	(107, '2016-06-19 00:28:05', '2016-06-19 00:28:05', 'C5:69:43:7B:69:76', 'Dolore veritatis inventore fugiat.', 19),
	(108, '2016-06-19 00:28:05', '2016-06-19 00:28:05', '3C:CF:27:46:83:A1', 'Rerum quam dolore quia itaque.', 25),
	(109, '2016-06-19 00:28:05', '2016-06-19 00:28:05', 'E7:50:CE:2B:B0:92', 'Voluptatum deleniti sit veritatis.', 11),
	(110, '2016-06-19 00:28:05', '2016-06-19 00:28:05', '52:B5:ED:65:92:7A', 'Eos odio perferendis hic suscipit aut officia neque illo.', 13),
	(111, '2016-06-19 00:28:05', '2016-06-19 00:28:05', 'CB:2D:BB:DA:3A:A1', 'Similique quos dolorum id nihil.', 21),
	(112, '2016-06-19 00:28:05', '2016-06-19 00:28:05', 'C9:79:91:52:F5:0B', 'Expedita expedita sunt et dolorum.', 11),
	(113, '2016-06-19 00:28:05', '2016-06-19 00:28:05', 'E0:A0:52:CA:41:2A', 'Consectetur corrupti voluptate voluptatum reprehenderit officiis voluptatem.', 20),
	(114, '2016-06-19 00:28:05', '2016-06-19 00:28:05', '64:A0:FE:78:CB:E8', 'Voluptas minima voluptatem saepe id commodi sed quis.', 8),
	(115, '2016-06-19 00:28:05', '2016-06-19 00:28:05', '27:57:8E:ED:A6:81', 'Et ut aspernatur vero.', 8),
	(116, '2016-06-19 00:28:05', '2016-06-19 00:28:05', 'AE:9E:CF:8D:72:52', 'Ipsum sapiente et odit.', 10),
	(117, '2016-06-19 00:28:05', '2016-06-19 00:28:05', '6D:8F:81:5B:BD:4F', 'Ut provident dolores natus eum omnis velit.', 13),
	(118, '2016-06-19 00:28:05', '2016-06-19 00:28:05', 'C5:AA:15:98:93:2B', 'Porro neque veniam sed facilis nostrum eligendi officiis sit.', 25),
	(119, '2016-06-19 00:28:05', '2016-06-19 00:28:05', 'D1:08:04:0F:A5:BA', 'Vel assumenda est commodi est qui quia.', 11),
	(120, '2016-06-19 00:28:05', '2016-06-19 00:28:05', '0D:93:22:42:03:1F', 'Atque incidunt natus voluptatem blanditiis facilis.', 18),
	(123, '2016-06-19 17:24:03', '2016-06-19 17:24:03', '00:6B:C5:7A:AF:5X', 'Expedita expedita sunt et dolorum.', 15),
	(124, '2016-06-19 17:27:30', '2016-06-19 17:27:30', '00:6B:C5:7A:AF:5G', 'Eos odio perferendis hic suscipit aut officia neque illo.', 15);
/*!40000 ALTER TABLE `device` ENABLE KEYS */;


-- Dumping structure for table fish_go.image
CREATE TABLE IF NOT EXISTS `image` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `style` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'origin',
  `size` int(10) unsigned NOT NULL,
  `path` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `caption` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table fish_go.image: ~20 rows (approximately)
/*!40000 ALTER TABLE `image` DISABLE KEYS */;
INSERT INTO `image` (`id`, `name`, `type`, `style`, `size`, `path`, `caption`, `created_at`, `updated_at`) VALUES
	(6, '', 'image/jpeg', 'origin', 0, '4aa469cbc5e9a2d795cf1e595bb00e49.jpg', 'buc anhdep', '2016-06-19 11:13:59', '2016-06-19 11:13:59'),
	(7, '', 'image/jpeg', 'origin', 0, 'd107afdc29546e66156381a513024087.jpg', 'new device', '2016-06-19 17:24:03', '2016-06-19 17:24:03'),
	(8, '', 'image/jpeg', 'origin', 0, 'd107afdc29546e66156381a513024087_0.jpg', 'new device', '2016-06-19 17:28:07', '2016-06-19 17:28:07'),
	(9, '', 'image/jpeg', 'origin', 0, 'd107afdc29546e66156381a513024087_1.jpg', 'new device', '2016-06-19 17:33:22', '2016-06-19 17:33:22'),
	(10, '', 'image/jpeg', 'origin', 0, 'd107afdc29546e66156381a513024087_2.jpg', 'new device', '2016-06-19 17:34:20', '2016-06-19 17:34:20'),
	(11, '', 'image/jpeg', 'origin', 0, 'd107afdc29546e66156381a513024087_3.jpg', 'new device', '2016-06-19 17:34:21', '2016-06-19 17:34:21'),
	(12, '', 'image/jpeg', 'origin', 0, 'd107afdc29546e66156381a513024087_4.jpg', 'new device', '2016-06-19 17:34:23', '2016-06-19 17:34:23'),
	(13, '', 'image/jpeg', 'origin', 0, 'd107afdc29546e66156381a513024087_5.jpg', 'new device', '2016-06-19 17:34:24', '2016-06-19 17:34:24'),
	(14, '', 'image/jpeg', 'origin', 0, 'd107afdc29546e66156381a513024087_6.jpg', 'new device', '2016-06-19 17:34:25', '2016-06-19 17:34:25'),
	(15, '', 'image/jpeg', 'origin', 0, 'd107afdc29546e66156381a513024087_7.jpg', 'new device', '2016-06-19 17:34:25', '2016-06-19 17:34:25'),
	(16, '', 'image/jpeg', 'origin', 0, 'd107afdc29546e66156381a513024087_8.jpg', 'new device', '2016-06-19 17:34:26', '2016-06-19 17:34:26'),
	(17, '', 'image/jpeg', 'origin', 0, 'd107afdc29546e66156381a513024087_9.jpg', 'new device', '2016-06-19 18:47:26', '2016-06-19 18:47:26'),
	(18, '', 'image/png', 'origin', 9308, 'ba06ebb8a558e2ae3c72431d6dabe4c9.png', 'new device', '2016-06-19 19:42:58', '2016-06-19 19:42:58'),
	(19, '', 'application/octet-stream', 'origin', 12997, '900150983cd24fb0d6963f7d28e17f72.abc', 'new device', '2016-06-19 19:44:43', '2016-06-19 19:44:43'),
	(20, '', 'image/png', 'origin', 2762, 'b85f321d418961c83ec511ce303e58e3.png', 'new device', '2016-06-19 19:59:29', '2016-06-19 19:59:29'),
	(21, '', 'image/png', 'origin', 2762, 'b85f321d418961c83ec511ce303e58e3_0.png', 'new device', '2016-06-19 20:17:59', '2016-06-19 20:17:59'),
	(22, '', 'image/jpeg', 'origin', 5106, 'd107afdc29546e66156381a513024087_10.jpg', 'new device', '2016-06-19 20:18:23', '2016-06-19 20:18:23'),
	(23, '', 'image/png', 'origin', 2762, 'b85f321d418961c83ec511ce303e58e3_1.png', 'new device', '2016-06-19 21:59:37', '2016-06-19 21:59:37'),
	(24, '', 'image/png', 'origin', 2762, 'b85f321d418961c83ec511ce303e58e3_2.png', 'new device', '2016-06-19 22:17:16', '2016-06-19 22:17:16'),
	(25, '', 'image/png', 'origin', 2762, 'b85f321d418961c83ec511ce303e58e3_3.png', 'new device', '2016-06-19 22:18:15', '2016-06-19 22:18:15');
/*!40000 ALTER TABLE `image` ENABLE KEYS */;


-- Dumping structure for table fish_go.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table fish_go.migrations: ~36 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`migration`, `batch`) VALUES
	('2016_06_19_042641_create_table_candidate', 1),
	('2016_06_19_051036_create_table_submission', 1),
	('2016_06_19_051733_create_table_country', 1),
	('2016_06_19_052557_create_table_store', 1),
	('2016_06_19_061539_alter_table_submission_foreignkey_on_candidate', 1),
	('2016_06_19_063142_create_table_device', 1),
	('2016_06_19_063540_create_pivot_table_candidate_device', 1),
	('2016_06_19_065301_alter_table_device_foreignkey_on_candidate', 1),
	('2016_06_19_093859_create_table_campaign', 1),
	('2016_06_19_120444_create_table_image', 1),
	('2016_06_19_120920_alter_table_submission_drop_column_image_url', 1),
	('2016_06_19_122749_create_pivot_submission_image', 1),
	('2016_06_19_155453_alter_table_submission_drop_column_caption', 1),
	('2016_06_19_155614_alter_table_image_add_column_caption', 1),
	('2016_06_19_170736_alter_table_image_drop_unique_name', 1),
	('2016_06_19_180333_alter_table_image_add_column_created_updated_at', 1),
	('2016_06_19_180754_alter_pivot_submission_image_add_column_created_updated_at', 1),
	('2016_06_20_015228_alter_table_image_change_column_size_type', 1),
	('2016_06_19_042641_create_table_candidate', 1),
	('2016_06_19_051036_create_table_submission', 2),
	('2016_06_19_051733_create_table_country', 3),
	('2016_06_19_052557_create_table_store', 4),
	('2016_06_19_061539_alter_table_submission_foreignkey_on_candidate', 4),
	('2016_06_19_063142_create_table_device', 5),
	('2016_06_19_063540_create_pivot_table_candidate_device', 6),
	('2016_06_19_065301_alter_table_device_foreignkey_on_candidate', 7),
	('2016_06_19_093859_create_table_campaign', 8),
	('2016_06_19_120444_create_table_image', 9),
	('2016_06_19_120920_alter_table_submission_drop_column_image_url', 9),
	('2016_06_19_122749_create_pivot_submission_image', 10),
	('2016_06_19_155453_alter_table_submission_drop_column_caption', 11),
	('2016_06_19_155614_alter_table_image_add_column_caption', 11),
	('2016_06_19_170736_alter_table_image_drop_unique_name', 12),
	('2016_06_19_180333_alter_table_image_add_column_created_updated_at', 13),
	('2016_06_19_180754_alter_pivot_submission_image_add_column_created_updated_at', 14),
	('2016_06_20_015228_alter_table_image_change_column_size_type', 15);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;


-- Dumping structure for table fish_go.store
CREATE TABLE IF NOT EXISTS `store` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `store_address_unique` (`address`),
  KEY `store_country_id_foreign` (`country_id`),
  CONSTRAINT `store_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table fish_go.store: ~65 rows (approximately)
/*!40000 ALTER TABLE `store` DISABLE KEYS */;
INSERT INTO `store` (`id`, `created_at`, `updated_at`, `name`, `address`, `tel`, `country_id`) VALUES
	(1, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Dr. Trevor Daugherty', '4304 Richie Spur Apt. 393\nWilliamsonberg, NJ 50013', '429.561.1705', 5),
	(2, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Ms. Janiya Simonis MD', '504 Erwin Course Apt. 477\nDandreport, ME 99392-0908', '(445) 721-5319', 5),
	(3, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Prof. Michael Okuneva', '189 Sanford Cliff Suite 910\nWest Ross, ME 28356-7807', '1-307-232-4925 x6389', 5),
	(4, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Hector Frami', '7045 Bartoletti Mountains\nSouth Zolaborough, KS 86716-5799', '618.988.6020 x49172', 4),
	(5, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Braxton Aufderhar I', '28706 Weimann Loaf\nJohnston, IL 55075', '910-881-5162', 1),
	(6, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Name Brekke', '8143 Dietrich Rapid Suite 905\nDickinsonbury, MT 16652', '496-513-2273', 2),
	(7, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Gerhard Lakin I', '959 Ritchie Street Suite 211\nNorth Alizaland, WY 34459', '1-945-584-1447 x622', 2),
	(8, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Hunter Jast', '967 Torp Prairie\nWest Bradberg, NJ 32367', '+12877567812', 5),
	(9, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Delta Stark', '4078 Corwin Island Apt. 589\nLake Paytontown, NV 37327-5521', '1-593-520-9666 x520', 4),
	(10, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Layla Mohr IV', '1132 Winfield Divide Suite 702\nNorth Abby, KY 19832', '308-398-4969', 3),
	(11, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Prof. Destini Farrell PhD', '1986 Patsy Point Apt. 052\nLake Alexandreabury, MS 82370', '876-585-0115', 3),
	(12, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Mr. Adolphus Anderson III', '907 Dana Crescent\nEast Maverick, OK 00637-4017', '671.238.1029', 2),
	(13, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Maria Ferry', '9932 Susan Ports\nEast Christiana, FL 64503-2403', '1-353-861-9297 x51917', 3),
	(14, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Justina Langworth MD', '439 Letha Center Suite 303\nNorth Adellamouth, VA 11278-4983', '931.451.7194', 1),
	(15, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Damien Labadie', '607 Margarete Lakes Apt. 785\nWilliamsonfort, GA 69508', '1-848-377-1457 x7324', 2),
	(16, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Carolyne Crona', '5827 Willms Mills\nNew Richard, NE 20393-4122', '(280) 657-3660', 5),
	(17, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Martine Collins', '449 Isabelle Orchard Suite 531\nWest Owen, DC 61070-6919', '+1-340-248-2366', 3),
	(18, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Leonard Skiles', '8799 Timmothy Knolls Suite 818\nThompsonstad, SD 45023', '393.612.7800 x20282', 5),
	(19, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Ms. Addie Lesch V', '59483 Schimmel Meadow\nWest Judah, MS 50064-1028', '1-526-899-0013', 2),
	(20, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Asha Walsh Sr.', '4181 Kenneth Views Apt. 311\nBeckerfurt, SD 73835-5498', '781.976.0586 x5838', 2),
	(21, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Efrain Baumbach', '4798 Gavin Ridge\nPort Eli, LA 81937', '527.945.9486 x24141', 5),
	(22, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Andreane Parker', '489 Larson Fields Suite 387\nRomaguerabury, FL 17357', '(298) 616-7806', 2),
	(23, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Ivah Lind', '359 Mraz Square Suite 677\nEast Arielleville, MT 59497-5997', '+1-929-402-8673', 1),
	(24, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Lukas Hilpert Sr.', '77343 Jacynthe Port Apt. 066\nNorth Carole, VT 97124', '1-502-532-9417 x219', 4),
	(25, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Dr. Elmore Mertz', '50351 Schinner Ports Apt. 342\nDomenicomouth, AR 56886-5488', '(759) 426-2305', 4),
	(26, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Dr. Natalia Bailey III', '692 Will Walk\nEmmerichhaven, TX 35880', '(232) 599-9670', 2),
	(27, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Adell Blick', '9195 Milo Coves\nWymanshire, NM 58841-1045', '+1 (207) 344-8046', 4),
	(28, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Aileen Deckow', '580 Tressa Meadow\nPort Kennedi, HI 28996', '856-630-3784 x43951', 3),
	(29, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Brendan Heidenreich', '79272 McLaughlin Ports\nEast Oswaldo, MI 79184-2453', '(217) 717-5617 x8581', 2),
	(30, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Rafael Hahn', '8037 Charity Trail Apt. 652\nCathrynfurt, NE 63255-4276', '360-684-2660 x3813', 4),
	(31, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Waldo Shields', '4758 Weissnat Branch Apt. 715\nPatside, SC 27007-5776', '1-691-436-2632', 2),
	(32, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Scarlett Yost', '25560 Hannah Unions Apt. 605\nWest Connerbury, WV 25339-3405', '992-949-9934', 3),
	(33, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Josiane Miller', '184 Sasha Isle\nSouth Maribelside, NM 09601-8934', '1-889-833-1983 x732', 1),
	(34, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Laury Lockman', '975 Orn Forest Apt. 793\nStarkberg, CT 23380', '348-597-0894 x2625', 3),
	(35, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Jarod Collins', '3960 Robin Rapids\nChristborough, NV 56424-9096', '+16653762355', 4),
	(36, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Raheem Stoltenberg', '864 Herzog Branch\nOndrickashire, NH 83573', '325-480-6591 x9509', 4),
	(37, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Hilda O\'Hara', '3398 Holly Greens\nEnochhaven, NE 40045', '663.771.1475 x80632', 5),
	(38, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Dr. Royal Murazik', '25627 Maia Crest\nMadilynmouth, HI 31042', '(568) 863-1131', 2),
	(39, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Dr. Edmond Kub', '2035 Boyer Crossing\nErdmanside, VA 33710', '1-916-884-6595 x79961', 2),
	(40, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Jonathan Kerluke', '60265 River Camp\nPort Zariaport, IN 68124-7021', '+1-621-307-8442', 5),
	(41, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Mrs. Ilene King', '448 Ward Rest\nKeshauntown, MS 79459', '860-464-7172 x08553', 1),
	(42, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Carmella Reilly', '3860 Rita Island Suite 898\nSouth Terrellberg, ND 68920-2896', '(740) 542-1513 x9975', 5),
	(43, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Joaquin Pouros DDS', '555 Gladyce Forks Apt. 352\nWestshire, UT 51724', '898-434-8556 x981', 4),
	(44, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Ibrahim Moen', '36284 Dorothea Mills\nHalliefurt, KY 54257-8116', '1-338-365-9510 x000', 5),
	(45, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Prof. Pierce Hintz DDS', '168 Grimes Roads Apt. 177\nSouth Trace, VT 57746-1830', '209-772-2759 x641', 5),
	(46, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Brody Konopelski', '42362 Alisha Meadows\nEast Oceane, AR 85550-9958', '1-980-663-6569', 3),
	(47, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Rosalinda Schroeder', '52705 Kutch Shoals Apt. 894\nSouth Demetrismouth, CA 35197-2389', '634-682-5464 x4622', 5),
	(48, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Savannah Green', '6196 Alycia Lodge\nCartwrightmouth, KY 62314-4272', '414-643-6905 x533', 2),
	(49, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Noemi Labadie PhD', '3267 Marlee Mountain Apt. 588\nWest Friedrichview, ID 40340-0503', '+1.246.956.3874', 4),
	(50, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Mr. Geoffrey Powlowski IV', '546 Kunde Summit\nDelilahberg, TX 63673', '+1.783.649.6235', 4),
	(51, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Natalie Murphy', '67940 Farrell Islands\nCronafort, FL 15817-8708', '(741) 675-5054 x78751', 3),
	(52, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Jacquelyn Turner', '5112 Casper Brook Suite 772\nWatersmouth, MO 25059', '1-459-366-2983', 1),
	(53, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Aurelia Zboncak', '6419 Franz Turnpike Apt. 637\nSouth Jose, NY 67420-0315', '1-863-991-7379', 3),
	(54, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Sarina Kertzmann', '61945 Koepp Greens\nNorth Patience, FL 43604-7023', '(785) 338-2877 x08383', 1),
	(55, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Chelsey Baumbach IV', '76469 Jones Trail Suite 512\nBaumbachborough, WV 28980', '417-486-2696 x5139', 1),
	(56, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Mr. Gennaro Johnston MD', '57884 Carol Circle\nNew Lennieshire, OK 04945', '882-764-0010 x7630', 4),
	(57, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Elijah Skiles', '36728 Block Fords\nNew Duncanbury, MT 80145-6617', '672.343.2154 x97123', 3),
	(58, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Marielle Braun', '9892 O\'Kon Pike\nSouth Braeden, IL 40958', '+1 (709) 750-0466', 5),
	(59, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Guadalupe Schmeler', '872 Lina Trail Suite 281\nMetzside, NJ 34837', '220-476-1461 x46783', 2),
	(60, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Mr. Trace Graham III', '495 Minerva Track Apt. 167\nGreenholtstad, OH 27851', '+19784580547', 5),
	(61, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Llewellyn Senger', '92499 Kaycee Mews\nVonRuedenborough, WV 29189-0162', '(942) 760-8958', 3),
	(62, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Margarita Dooley', '27058 Vandervort Shoal\nSouth Marcelino, WA 04423-3583', '1-304-550-5839 x9011', 1),
	(63, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Ms. Alvera Walker I', '8272 Kuphal Lock\nRichieport, TN 25591-6035', '441.235.1064 x3210', 3),
	(64, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Dr. Alexis Kub Sr.', '130 Swift Terrace\nLake Casimir, IA 63540', '+1-798-347-2090', 1),
	(65, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 'Guido Becker', '88072 Miller Harbors\nPort Emanuelport, SD 29594', '(465) 533-9000 x194', 1);
/*!40000 ALTER TABLE `store` ENABLE KEYS */;


-- Dumping structure for table fish_go.submission
CREATE TABLE IF NOT EXISTS `submission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `country_id` int(10) unsigned NOT NULL,
  `candidate_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `submission_candidate_id_foreign` (`candidate_id`),
  KEY `submission_country_id_foreign` (`country_id`),
  CONSTRAINT `submission_candidate_id_foreign` FOREIGN KEY (`candidate_id`) REFERENCES `candidate` (`id`),
  CONSTRAINT `submission_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=124 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table fish_go.submission: ~120 rows (approximately)
/*!40000 ALTER TABLE `submission` DISABLE KEYS */;
INSERT INTO `submission` (`id`, `created_at`, `updated_at`, `country_id`, `candidate_id`) VALUES
	(1, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 4, 6),
	(2, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 3, 14),
	(3, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 4, 16),
	(4, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 2, 7),
	(5, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 2, 20),
	(6, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 3, 21),
	(7, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 4, 11),
	(8, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 4, 12),
	(9, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 3, 7),
	(10, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 5, 14),
	(11, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 5, 11),
	(12, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 5, 16),
	(13, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 2, 21),
	(14, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 1, 10),
	(15, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 2, 17),
	(16, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 1, 23),
	(17, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 2, 19),
	(18, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 1, 7),
	(19, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 1, 7),
	(20, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 2, 19),
	(21, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 1, 17),
	(22, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 2, 10),
	(23, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 3, 14),
	(24, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 3, 22),
	(25, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 3, 22),
	(26, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 2, 9),
	(27, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 2, 23),
	(28, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 2, 21),
	(29, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 2, 9),
	(30, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 5, 24),
	(31, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 2, 16),
	(32, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 4, 17),
	(33, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 4, 9),
	(34, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 1, 12),
	(35, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 1, 9),
	(36, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 1, 9),
	(37, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 1, 23),
	(38, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 5, 24),
	(39, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 5, 10),
	(40, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 3, 15),
	(41, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 4, 13),
	(42, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 4, 10),
	(43, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 5, 9),
	(44, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 3, 6),
	(45, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 2, 9),
	(46, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 1, 7),
	(47, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 1, 19),
	(48, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 3, 6),
	(49, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 4, 16),
	(50, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 5, 10),
	(51, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 3, 11),
	(52, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 3, 22),
	(53, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 5, 9),
	(54, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 1, 21),
	(55, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 3, 10),
	(56, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 1, 14),
	(57, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 5, 9),
	(58, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 1, 24),
	(59, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 2, 23),
	(60, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 5, 12),
	(61, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 3, 18),
	(62, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 2, 24),
	(63, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 1, 13),
	(64, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 5, 19),
	(65, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 1, 24),
	(66, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 3, 12),
	(67, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 5, 11),
	(68, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 4, 17),
	(69, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 5, 20),
	(70, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 5, 25),
	(71, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 3, 25),
	(72, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 3, 7),
	(73, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 2, 23),
	(74, '2016-06-19 00:24:27', '2016-06-19 00:24:27', 2, 25),
	(75, '2016-06-19 00:24:28', '2016-06-19 00:24:28', 5, 7),
	(76, '2016-06-19 00:24:28', '2016-06-19 00:24:28', 1, 14),
	(77, '2016-06-19 00:24:28', '2016-06-19 00:24:28', 1, 25),
	(78, '2016-06-19 00:24:28', '2016-06-19 00:24:28', 3, 24),
	(79, '2016-06-19 00:24:28', '2016-06-19 00:24:28', 4, 11),
	(80, '2016-06-19 00:24:28', '2016-06-19 00:24:28', 2, 17),
	(81, '2016-06-19 00:24:28', '2016-06-19 00:24:28', 5, 6),
	(82, '2016-06-19 00:24:28', '2016-06-19 00:24:28', 4, 19),
	(83, '2016-06-19 00:24:28', '2016-06-19 00:24:28', 2, 21),
	(84, '2016-06-19 00:24:28', '2016-06-19 00:24:28', 3, 25),
	(85, '2016-06-19 00:24:28', '2016-06-19 00:24:28', 3, 16),
	(86, '2016-06-19 00:24:28', '2016-06-19 00:24:28', 4, 16),
	(87, '2016-06-19 00:24:28', '2016-06-19 00:24:28', 2, 25),
	(88, '2016-06-19 00:24:28', '2016-06-19 00:24:28', 3, 20),
	(89, '2016-06-19 00:24:28', '2016-06-19 00:24:28', 5, 10),
	(90, '2016-06-19 00:24:28', '2016-06-19 00:24:28', 3, 20),
	(91, '2016-06-19 00:24:28', '2016-06-19 00:24:28', 2, 14),
	(92, '2016-06-19 00:24:28', '2016-06-19 00:24:28', 5, 21),
	(93, '2016-06-19 00:24:28', '2016-06-19 00:24:28', 3, 6),
	(94, '2016-06-19 00:24:28', '2016-06-19 00:24:28', 4, 8),
	(95, '2016-06-19 00:24:28', '2016-06-19 00:24:28', 1, 13),
	(96, '2016-06-19 00:24:28', '2016-06-19 00:24:28', 2, 17),
	(97, '2016-06-19 00:24:28', '2016-06-19 00:24:28', 1, 12),
	(98, '2016-06-19 00:24:28', '2016-06-19 00:24:28', 1, 17),
	(99, '2016-06-19 00:24:28', '2016-06-19 00:24:28', 5, 10),
	(100, '2016-06-19 00:24:28', '2016-06-19 00:24:28', 2, 20),
	(104, '2016-06-19 11:13:59', '2016-06-19 11:13:59', 1, 14),
	(105, '2016-06-19 17:24:03', '2016-06-19 17:24:03', 1, 15),
	(106, '2016-06-19 17:28:07', '2016-06-19 17:28:07', 1, 15),
	(107, '2016-06-19 17:33:22', '2016-06-19 17:33:22', 1, 15),
	(108, '2016-06-19 17:34:20', '2016-06-19 17:34:20', 1, 15),
	(109, '2016-06-19 17:34:21', '2016-06-19 17:34:21', 1, 15),
	(110, '2016-06-19 17:34:23', '2016-06-19 17:34:23', 1, 15),
	(111, '2016-06-19 17:34:24', '2016-06-19 17:34:24', 1, 15),
	(112, '2016-06-19 17:34:25', '2016-06-19 17:34:25', 1, 15),
	(113, '2016-06-19 17:34:25', '2016-06-19 17:34:25', 1, 15),
	(114, '2016-06-19 17:34:26', '2016-06-19 17:34:26', 1, 15),
	(115, '2016-06-19 18:47:26', '2016-06-19 18:47:26', 1, 15),
	(116, '2016-06-19 19:42:58', '2016-06-19 19:42:58', 1, 15),
	(117, '2016-06-19 19:44:43', '2016-06-19 19:44:43', 1, 15),
	(118, '2016-06-19 19:59:29', '2016-06-19 19:59:29', 1, 15),
	(119, '2016-06-19 20:17:59', '2016-06-19 20:17:59', 1, 15),
	(120, '2016-06-19 20:18:23', '2016-06-19 20:18:23', 1, 15),
	(121, '2016-06-19 21:59:37', '2016-06-19 21:59:37', 1, 15),
	(122, '2016-06-19 22:17:16', '2016-06-19 22:17:16', 1, 15),
	(123, '2016-06-19 22:18:15', '2016-06-19 22:18:15', 1, 15);
/*!40000 ALTER TABLE `submission` ENABLE KEYS */;


-- Dumping structure for table fish_go.submission_image
CREATE TABLE IF NOT EXISTS `submission_image` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `submission_id` int(10) unsigned NOT NULL,
  `image_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `submission_image_submission_id_foreign` (`submission_id`),
  KEY `submission_image_image_id_foreign` (`image_id`),
  CONSTRAINT `submission_image_image_id_foreign` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`),
  CONSTRAINT `submission_image_submission_id_foreign` FOREIGN KEY (`submission_id`) REFERENCES `submission` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table fish_go.submission_image: ~20 rows (approximately)
/*!40000 ALTER TABLE `submission_image` DISABLE KEYS */;
INSERT INTO `submission_image` (`id`, `submission_id`, `image_id`, `created_at`, `updated_at`) VALUES
	(2, 104, 6, '2016-06-19 11:13:59', '2016-06-19 11:13:59'),
	(3, 105, 7, '2016-06-19 17:24:03', '2016-06-19 17:24:03'),
	(4, 106, 8, '2016-06-19 17:28:07', '2016-06-19 17:28:07'),
	(5, 107, 9, '2016-06-19 17:33:22', '2016-06-19 17:33:22'),
	(6, 108, 10, '2016-06-19 17:34:20', '2016-06-19 17:34:20'),
	(7, 109, 11, '2016-06-19 17:34:21', '2016-06-19 17:34:21'),
	(8, 110, 12, '2016-06-19 17:34:23', '2016-06-19 17:34:23'),
	(9, 111, 13, '2016-06-19 17:34:24', '2016-06-19 17:34:24'),
	(10, 112, 14, '2016-06-19 17:34:25', '2016-06-19 17:34:25'),
	(11, 113, 15, '2016-06-19 17:34:25', '2016-06-19 17:34:25'),
	(12, 114, 16, '2016-06-19 17:34:26', '2016-06-19 17:34:26'),
	(13, 115, 17, '2016-06-19 18:47:26', '2016-06-19 18:47:26'),
	(14, 116, 18, '2016-06-19 19:42:58', '2016-06-19 19:42:58'),
	(15, 117, 19, '2016-06-19 19:44:43', '2016-06-19 19:44:43'),
	(16, 118, 20, '2016-06-19 19:59:29', '2016-06-19 19:59:29'),
	(17, 119, 21, '2016-06-19 20:17:59', '2016-06-19 20:17:59'),
	(18, 120, 22, '2016-06-19 20:18:23', '2016-06-19 20:18:23'),
	(19, 121, 23, '2016-06-19 21:59:37', '2016-06-19 21:59:37'),
	(20, 122, 24, '2016-06-19 22:17:16', '2016-06-19 22:17:16'),
	(21, 123, 25, '2016-06-19 22:18:15', '2016-06-19 22:18:15');
/*!40000 ALTER TABLE `submission_image` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
