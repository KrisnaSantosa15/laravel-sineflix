-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 03, 2024 at 02:16 PM
-- Server version: 8.0.35
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sineflix`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `GetAverageRating` (`movieId` INT) RETURNS DECIMAL(3,1) DETERMINISTIC BEGIN
            DECLARE avgRating DECIMAL(3, 1)$$

DELIMITER ;

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
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(2, 'Action', 'action', '2024-05-23 22:55:05', '2024-05-23 22:55:05'),
(4, 'Comedy', 'comedy', '2024-05-25 05:29:48', '2024-05-25 05:29:48'),
(5, 'Adventure', 'adventure', '2024-05-30 04:46:18', '2024-05-30 04:46:18'),
(6, 'Horror', 'horror', '2024-05-30 04:46:32', '2024-05-30 04:46:32'),
(7, 'Thriller', 'thriller', '2024-05-30 04:46:38', '2024-05-30 04:46:38'),
(8, 'Drama', 'drama', '2024-06-03 03:12:46', '2024-06-03 03:12:46'),
(9, 'Documentary', 'documentary', '2024-06-03 03:28:39', '2024-06-03 03:45:25');

--
-- Triggers `genres`
--
DELIMITER $$
CREATE TRIGGER `after_genres_delete` AFTER DELETE ON `genres` FOR EACH ROW BEGIN
                INSERT INTO log_activities (user_id, action, table_affected, description, action_date, created_at, updated_at)
                VALUES (@user_id, "delete", "genres", CONCAT("Deleted row with ID ", OLD.id), NOW(), NOW(), NOW())$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_genres_insert` AFTER INSERT ON `genres` FOR EACH ROW BEGIN
                INSERT INTO log_activities (user_id, action, table_affected, description, action_date, created_at, updated_at)
                VALUES (@user_id, "insert", "genres", CONCAT("Inserted a new row with ID ", NEW.id), NOW(), NOW(), NOW())$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_genres_update` AFTER UPDATE ON `genres` FOR EACH ROW BEGIN
                INSERT INTO log_activities (user_id, action, table_affected, description, action_date, created_at, updated_at)
                VALUES (@user_id, "update", "genres", CONCAT("Updated row with ID ", NEW.id), NOW(), NOW(), NOW())$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `genre_movie`
--

CREATE TABLE `genre_movie` (
  `id` bigint UNSIGNED NOT NULL,
  `movie_id` bigint UNSIGNED NOT NULL,
  `genre_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genre_movie`
--

INSERT INTO `genre_movie` (`id`, `movie_id`, `genre_id`, `created_at`, `updated_at`) VALUES
(3, 3, 2, NULL, NULL),
(5, 1, 2, NULL, NULL),
(6, 1, 4, NULL, NULL),
(7, 5, 2, NULL, NULL),
(8, 6, 4, NULL, NULL),
(9, 6, 7, NULL, NULL),
(11, 5, 5, NULL, NULL);

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
-- Table structure for table `log_activities`
--

CREATE TABLE `log_activities` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_affected` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `action_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `log_activities`
--

INSERT INTO `log_activities` (`id`, `user_id`, `action`, `table_affected`, `description`, `action_date`, `created_at`, `updated_at`) VALUES
(1, 7, 'insert', 'genres', 'Inserted a new row with ID 9', '2024-06-03 10:28:39', '2024-06-03 10:28:39', '2024-06-03 10:28:39'),
(2, 1, 'insert', 'genres', 'Inserted a new row with ID 10', '2024-06-03 10:30:22', '2024-06-03 10:30:22', '2024-06-03 10:30:22'),
(3, 1, 'delete', 'genres', 'Deleted row with ID 10', '2024-06-03 10:44:49', '2024-06-03 10:44:49', '2024-06-03 10:44:49'),
(4, 1, 'update', 'genres', 'Updated row with ID 9', '2024-06-03 10:45:25', '2024-06-03 10:45:25', '2024-06-03 10:45:25'),
(5, 1, 'insert', 'stars', 'Inserted a new row with ID 5', '2024-06-03 10:58:56', '2024-06-03 10:58:56', '2024-06-03 10:58:56'),
(6, 1, 'update', 'stars', 'Updated row with ID 5', '2024-06-03 10:59:18', '2024-06-03 10:59:18', '2024-06-03 10:59:18'),
(7, 1, 'delete', 'stars', 'Deleted row with ID 5', '2024-06-03 10:59:41', '2024-06-03 10:59:41', '2024-06-03 10:59:41'),
(8, 1, 'insert', 'movies', 'Inserted a new row with ID 7', '2024-06-03 11:00:44', '2024-06-03 11:00:44', '2024-06-03 11:00:44'),
(9, 1, 'delete', 'movies', 'Deleted row with ID 7', '2024-06-03 11:06:05', '2024-06-03 11:06:05', '2024-06-03 11:06:05'),
(10, 1, 'update', 'movies', 'Updated row with ID 5', '2024-06-03 11:08:15', '2024-06-03 11:08:15', '2024-06-03 11:08:15'),
(11, 1, 'update', 'users', 'Updated row with ID 5', '2024-06-03 11:09:02', '2024-06-03 11:09:02', '2024-06-03 11:09:02'),
(12, 1, 'delete', 'users', 'Deleted row with ID 5', '2024-06-03 11:09:14', '2024-06-03 11:09:14', '2024-06-03 11:09:14'),
(13, 1, 'insert', 'users', 'Inserted a new row with ID 9', '2024-06-03 11:09:51', '2024-06-03 11:09:51', '2024-06-03 11:09:51');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_05_22_130120_create_movies_table', 1),
(5, '2024_05_22_130134_create_genres_table', 1),
(6, '2024_05_22_130213_create_stars_table', 1),
(7, '2024_05_22_130247_create_watchlists_table', 1),
(8, '2024_05_22_130258_create_reviews_table', 1),
(9, '2024_05_23_124022_create_genre_movie_table', 1),
(10, '2024_05_23_124424_movie_stars', 1),
(11, '2024_06_03_100119_create_log_activities_table', 2),
(12, '2024_06_03_101916_create_triggers_for_genres', 3),
(13, '2024_06_03_104659_create_triggers_for_stars', 4),
(14, '2024_06_03_105101_create_triggers_for_movies', 4),
(15, '2024_06_03_105108_create_triggers_for_users', 4),
(27, '2024_06_03_111234_create_stored_functions', 5),
(28, '2024_06_03_113147_create_stored_views', 5);

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `release_date` date NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `director` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plot_summary` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` decimal(3,1) NOT NULL,
  `poster_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trailer_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `slug`, `release_date`, `type`, `director`, `plot_summary`, `rating`, `poster_url`, `trailer_url`, `created_at`, `updated_at`) VALUES
(1, 'Wednesday', 'wednesday', '2024-05-04', 'SERIES', 'Nothing', 'Follows Wednesday Addams\' years as a student, when she attempts to master her emerging psychic ability, thwart a killing spree, and solve the mystery that embroiled her parents.', 5.0, 'https://www.movieposters.com/cdn/shop/files/wednesday.tv_480x.progressive.jpg?v=1689352362', 'https://www.youtube.com/watch?v=Q73UhUTs6y0', '2024-05-23 22:59:51', '2024-05-25 05:31:54'),
(3, 'Lord of the Rings: The Return of the King', 'lord-of-the-rings-the-return-of-the-king', '2024-05-23', 'SERIES', 'Petter Jackson', 'Gandalf and Aragorn lead the World of Men against Sauron\'s army to draw his gaze from Frodo and Sam as they approach Mount Doom with the One Ring.', 2.0, 'https://www.movieposters.com/cdn/shop/products/5c4cac59b5d80a2b31a130ca6b3a1056_5c60dbef-6d2a-4380-ba6f-fac5b8ebc2c8_480x.progressive.jpg?v=1573587255', 'https://www.youtube.com/watch?v=V75dMMIW2B4', '2024-05-23 23:04:08', '2024-05-25 05:42:44'),
(5, 'Demon Slayer', 'demon-slayer', '2024-05-10', 'MOVIE', 'Haruo Sotozaki', 'After his family was brutally murdered and his sister turned into a demon, Tanjiro Kamado\'s journey as a demon slayer began. Tanjiro and his comrades embark on a new mission aboard the Mugen Train, on track to despair.', 4.6, 'https://www.movieposters.com/cdn/shop/files/ItemR80800_jpg_480x.progressive.jpg?v=1711482941', 'https://www.youtube.com/watch?v=VQGCKyvzIM4', '2024-05-27 00:51:38', '2024-06-03 04:08:15'),
(6, 'Decision to Leave', 'decision-to-leave', '2024-05-16', 'K-SERIES', 'Park Chan-wook', 'A detective investigating a man\'s death in the mountains meets the dead man\'s mysterious wife in the course of his dogged sleuthing.', 4.4, 'https://www.movieposters.com/cdn/shop/products/scan005_2d0cc28f-c411-407d-850f-2e59f40e213b_480x.progressive.jpg?v=1675875524', 'https://www.youtube.com/watch?v=v9VkslZ1Wpw', '2024-05-30 04:50:43', '2024-05-30 04:50:43');

--
-- Triggers `movies`
--
DELIMITER $$
CREATE TRIGGER `after_movies_delete` AFTER DELETE ON `movies` FOR EACH ROW BEGIN
                INSERT INTO log_activities (user_id, action, table_affected, description, action_date, created_at, updated_at)
                VALUES (@user_id, "delete", "movies", CONCAT("Deleted row with ID ", OLD.id), NOW(), NOW(), NOW())$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_movies_insert` AFTER INSERT ON `movies` FOR EACH ROW BEGIN
                INSERT INTO log_activities (user_id, action, table_affected, description, action_date, created_at, updated_at)
                VALUES (@user_id, "insert", "movies", CONCAT("Inserted a new row with ID ", NEW.id), NOW(), NOW(), NOW())$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_movies_update` AFTER UPDATE ON `movies` FOR EACH ROW BEGIN
                INSERT INTO log_activities (user_id, action, table_affected, description, action_date, created_at, updated_at)
                VALUES (@user_id, "update", "movies", CONCAT("Updated row with ID ", NEW.id), NOW(), NOW(), NOW())$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `movie_stars`
--

CREATE TABLE `movie_stars` (
  `id` bigint UNSIGNED NOT NULL,
  `movie_id` bigint UNSIGNED NOT NULL,
  `stars_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `movie_stars`
--

INSERT INTO `movie_stars` (`id`, `movie_id`, `stars_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 3, 1, NULL, NULL),
(4, 5, 1, NULL, NULL),
(5, 6, 1, NULL, NULL),
(6, 6, 4, NULL, NULL);

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
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `movie_id` bigint UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` decimal(3,1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `title`, `slug`, `user_id`, `movie_id`, `content`, `rating`, `created_at`, `updated_at`) VALUES
(1, 'Good Movie', 'good-movie', 7, 3, 'This movie good af', 5.0, '2024-06-02 21:01:11', '2024-06-02 21:01:11'),
(2, 'LGTM', 'lgtm', 1, 5, 'So Legit', 4.0, '2024-06-03 05:10:57', '2024-06-03 05:10:57'),
(3, 'Nice', 'nice', 1, 5, 'Oke', 1.0, '2024-06-03 05:11:26', '2024-06-03 05:11:26');

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
('ooo1FcwDrNScfu0qH9gQnvuTJ1XyYlQdthFxjaIP', 1, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibmpNUUpwQ2tPRGNwYXpIUW9qbnJXU3JndmZ0V1RiZk5qc3ZqQUtnbyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1717423091),
('ym9x9KifjXYZnatUJSEmPBN8T8ZJvgq1sMRNopp8', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTWRCREFRMUdJZHVNQWtUb0Q1enFyT2U0MGZwZXBoanRDZ0ZGR2dGciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9tb3ZpZXMvZGVtb24tc2xheWVyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1717423093);

-- --------------------------------------------------------

--
-- Table structure for table `stars`
--

CREATE TABLE `stars` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` date DEFAULT NULL,
  `birth_place` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `biography` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stars`
--

INSERT INTO `stars` (`id`, `name`, `slug`, `birth_date`, `birth_place`, `biography`, `image`, `created_at`, `updated_at`) VALUES
(1, 'oke', 'oke', '2024-05-10', 'oke', 'test', 'eyJpdiI6IklzNlpFUGptLzY4NkFRUXpCUkNPWmc9PSIsInZhbHVlIjoiOVByWXFwYlBkNGYwb2gxNWVwRnFLZz09IiwibWFjIjoiMTU0ODEwYTA1YjNkMzg2NzdkMDhhNjljOTE1MzM4MjA1OWI5YmFkNzUzNWE3N2I0ZTA3ZWJjZjY4YjBkZmVmOCIsInRhZyI6IiJ9.png', '2024-05-23 09:57:20', '2024-05-23 09:58:14'),
(4, 'Aktor 1', 'aktor-1', '2024-05-07', 'Garut', 'hanya biog', NULL, '2024-05-30 04:47:00', '2024-05-30 04:47:00');

--
-- Triggers `stars`
--
DELIMITER $$
CREATE TRIGGER `after_stars_delete` AFTER DELETE ON `stars` FOR EACH ROW BEGIN
                INSERT INTO log_activities (user_id, action, table_affected, description, action_date, created_at, updated_at)
                VALUES (@user_id, "delete", "stars", CONCAT("Deleted row with ID ", OLD.id), NOW(), NOW(), NOW())$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_stars_insert` AFTER INSERT ON `stars` FOR EACH ROW BEGIN
                INSERT INTO log_activities (user_id, action, table_affected, description, action_date, created_at, updated_at)
                VALUES (@user_id, "insert", "stars", CONCAT("Inserted a new row with ID ", NEW.id), NOW(), NOW(), NOW())$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_stars_update` AFTER UPDATE ON `stars` FOR EACH ROW BEGIN
                INSERT INTO log_activities (user_id, action, table_affected, description, action_date, created_at, updated_at)
                VALUES (@user_id, "update", "stars", CONCAT("Updated row with ID ", NEW.id), NOW(), NOW(), NOW())$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'MEMBER',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `role`, `image`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'asd', 'as@asd', 'asd', 'ADMIN', 'eyJpdiI6Ikk3VmJhWlVPYVV0a2NYS29hdU8xNFE9PSIsInZhbHVlIjoiVWZITmRXZUNWaDlZeVBtZnFlTWlVQT09IiwibWFjIjoiZjVjYmExYzlmODRmYjg1MjBjYTNkNzJhMDQ3NGQ2ZjgyZmMwM2FlMzcyMTVlNWI5NGFmZDk4Mzg2ZDVkNDcxMSIsInRhZyI6IiJ9.png', NULL, '$2y$12$pdvcij8oDDK.IQ0XYL..3OnSM5doX9sFkGJ6ap4QTnWdPsyWqcEBe', NULL, '2024-05-23 09:10:30', '2024-05-23 09:10:30'),
(4, 'asd', 'asd@sad', 'asd1', 'MEMBER', NULL, NULL, '$2y$12$40st9U1BQ11AqLLMYbaWW.wwqckQcdlD1TsbOe9xVl.baA/LlogOq', NULL, '2024-05-23 23:08:45', '2024-05-23 23:08:45'),
(6, 'member', 'member@gmail.com', 'member', 'MEMBER', NULL, NULL, '$2y$12$eAL5dWWI26kIQKZo3Oph.uyphv6ZF5RSql9nKDLKmfyR1h0NwP16K', NULL, '2024-05-23 23:13:42', '2024-05-23 23:13:42'),
(7, 'admin', 'admin@gmail.com', 'admin', 'ADMIN', 'eyJpdiI6IkZNYnpoZnp3UFFHWFQvQ0FhUEhNTmc9PSIsInZhbHVlIjoiOW9NcnZVY2pkY3F6MFVsSVJud3JHZz09IiwibWFjIjoiMDRkYjRhNzA5MmU2Y2M3YjRkZmJiNzBhYTIyOGI0YjMxYjc1MDQ3NTA5Mzk4YjRmMTc0ZTE5MWUyMmNmMDUyOCIsInRhZyI6IiJ9.jpg', NULL, '$2y$12$BzXTAS6nKpdHrXy80DYK4uCcINkdD4YcQVfdgWeEpSiqBHKWpSj1G', NULL, '2024-05-23 23:14:00', '2024-06-03 02:41:50'),
(8, 'Krisna', 'krisna@gmail.com', NULL, 'MEMBER', NULL, NULL, '$2y$12$wgefysYkEL6ekUZ2nO.c2uWkalIeU9Kolm5hQ2QJ00OEHkziuj4oW', NULL, '2024-05-24 00:46:21', '2024-05-24 00:46:57'),
(9, 'Admin Krisna', 'adminkrisna@gmail.com', 'adminkrisna', 'ADMIN', NULL, NULL, '$2y$12$BhQHxle1HMh9pteCZTQFJug5h2RyqRnbkyJZiijzKPclTMa0gOC2C', NULL, '2024-06-03 04:09:51', '2024-06-03 04:09:51');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `after_users_delete` AFTER DELETE ON `users` FOR EACH ROW BEGIN
                INSERT INTO log_activities (user_id, action, table_affected, description, action_date, created_at, updated_at)
                VALUES (@user_id, "delete", "users", CONCAT("Deleted row with ID ", OLD.id), NOW(), NOW(), NOW())$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_users_insert` AFTER INSERT ON `users` FOR EACH ROW BEGIN
                INSERT INTO log_activities (user_id, action, table_affected, description, action_date, created_at, updated_at)
                VALUES (@user_id, "insert", "users", CONCAT("Inserted a new row with ID ", NEW.id), NOW(), NOW(), NOW())$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_users_update` AFTER UPDATE ON `users` FOR EACH ROW BEGIN
                INSERT INTO log_activities (user_id, action, table_affected, description, action_date, created_at, updated_at)
                VALUES (@user_id, "update", "users", CONCAT("Updated row with ID ", NEW.id), NOW(), NOW(), NOW())$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `UserWatchlist`
-- (See below for the actual view)
--
CREATE TABLE `UserWatchlist` (
`genres` text
,`id` bigint unsigned
,`movie_id` bigint unsigned
,`poster_url` varchar(255)
,`rating` decimal(3,1)
,`release_date` date
,`slug` varchar(255)
,`title` varchar(255)
,`user_email` varchar(255)
,`user_id` bigint unsigned
,`user_name` varchar(255)
,`watchlist_id` bigint unsigned
);

-- --------------------------------------------------------

--
-- Table structure for table `watchlists`
--

CREATE TABLE `watchlists` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `movie_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `watchlists`
--

INSERT INTO `watchlists` (`id`, `user_id`, `movie_id`, `created_at`, `updated_at`) VALUES
(9, 7, 3, '2024-05-30 07:04:41', '2024-05-30 07:04:41'),
(12, 7, 6, '2024-06-02 21:47:14', '2024-06-02 21:47:14'),
(14, 1, 5, '2024-06-03 04:30:23', '2024-06-03 04:30:23');

-- --------------------------------------------------------

--
-- Structure for view `UserWatchlist`
--
DROP TABLE IF EXISTS `UserWatchlist`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `UserWatchlist`  AS SELECT `u`.`id` AS `user_id`, `u`.`name` AS `user_name`, `u`.`email` AS `user_email`, `w`.`id` AS `watchlist_id`, `w`.`movie_id` AS `movie_id`, `m`.`title` AS `title`, `m`.`slug` AS `slug`, `m`.`poster_url` AS `poster_url`, `m`.`rating` AS `rating`, `m`.`release_date` AS `release_date`, `m`.`id` AS `id`, group_concat(`g`.`name` separator ',') AS `genres` FROM ((((`users` `u` join `watchlists` `w` on((`u`.`id` = `w`.`user_id`))) join `movies` `m` on((`w`.`movie_id` = `m`.`id`))) join `genre_movie` `gm` on((`m`.`id` = `gm`.`movie_id`))) join `genres` `g` on((`gm`.`genre_id` = `g`.`id`))) GROUP BY `u`.`id`, `w`.`movie_id`, `w`.`id` ;

--
-- Indexes for dumped tables
--

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
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `genres_name_unique` (`name`),
  ADD UNIQUE KEY `genres_slug_unique` (`slug`);

--
-- Indexes for table `genre_movie`
--
ALTER TABLE `genre_movie`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `genre_movie_movie_id_genre_id_unique` (`movie_id`,`genre_id`),
  ADD KEY `genre_movie_genre_id_foreign` (`genre_id`);

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
-- Indexes for table `log_activities`
--
ALTER TABLE `log_activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `movies_slug_unique` (`slug`);

--
-- Indexes for table `movie_stars`
--
ALTER TABLE `movie_stars`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `movie_stars_movie_id_stars_id_unique` (`movie_id`,`stars_id`),
  ADD KEY `movie_stars_stars_id_foreign` (`stars_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reviews_slug_unique` (`slug`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_movie_id_foreign` (`movie_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `stars`
--
ALTER TABLE `stars`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `stars_slug_unique` (`slug`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Indexes for table `watchlists`
--
ALTER TABLE `watchlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `watchlists_user_id_foreign` (`user_id`),
  ADD KEY `watchlists_movie_id_foreign` (`movie_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `genre_movie`
--
ALTER TABLE `genre_movie`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_activities`
--
ALTER TABLE `log_activities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `movie_stars`
--
ALTER TABLE `movie_stars`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stars`
--
ALTER TABLE `stars`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `watchlists`
--
ALTER TABLE `watchlists`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `genre_movie`
--
ALTER TABLE `genre_movie`
  ADD CONSTRAINT `genre_movie_genre_id_foreign` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `genre_movie_movie_id_foreign` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `movie_stars`
--
ALTER TABLE `movie_stars`
  ADD CONSTRAINT `movie_stars_movie_id_foreign` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `movie_stars_stars_id_foreign` FOREIGN KEY (`stars_id`) REFERENCES `stars` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_movie_id_foreign` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `watchlists`
--
ALTER TABLE `watchlists`
  ADD CONSTRAINT `watchlists_movie_id_foreign` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `watchlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
