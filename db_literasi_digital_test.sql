-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 20, 2025 at 04:50 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_literasi_digital_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_tes1|127.0.0.1', 'i:2;', 1752986073),
('laravel_cache_tes1|127.0.0.1:timer', 'i:1752986073;', 1752986073);

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
-- Table structure for table `domain_kognitif`
--

CREATE TABLE `domain_kognitif` (
  `id` int NOT NULL,
  `keterangan` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `domain_kognitif`
--

INSERT INTO `domain_kognitif` (`id`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Knowing (Pengetahuan)', '2025-07-18 00:23:16', '2025-07-18 00:23:16'),
(2, 'Applying (Penerapan)', '2025-07-18 00:23:30', '2025-07-18 00:23:30'),
(3, 'Reasoning (Penalaran)', '2025-07-18 00:23:41', '2025-07-18 00:23:41');

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
-- Table structure for table `indikator_literasi`
--

CREATE TABLE `indikator_literasi` (
  `id` int NOT NULL,
  `keterangan` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `indikator_literasi`
--

INSERT INTO `indikator_literasi` (`id`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Memahami fenomena sains', '2025-07-18 00:37:03', '2025-07-18 00:37:03'),
(2, 'Memberikan contoh fakta sains', '2025-07-18 00:37:12', '2025-07-18 00:37:12'),
(3, 'Memahami dampak negatif fenomena sains', '2025-07-18 00:37:21', '2025-07-18 00:37:21'),
(4, 'Memecahkan masalah praktis', '2025-07-18 00:37:29', '2025-07-18 00:37:29'),
(5, 'Mengelompokkan objek/materi', '2025-07-18 00:37:38', '2025-07-18 00:37:38'),
(6, 'Menghasilkan penejelasan ilmiah', '2025-07-18 00:37:47', '2025-07-18 00:37:47'),
(7, 'Menghubungkan konsep ilmu pengetahuan dengan konteks tertentu', '2025-07-18 00:37:58', '2025-07-18 00:37:58'),
(8, 'Menganalisis data', '2025-07-18 00:38:06', '2025-07-18 00:38:06'),
(9, 'Membuat simpulan', '2025-07-18 00:38:13', '2025-07-18 00:38:13'),
(10, 'Merumuskan dan menerapkan pengetahua n sains untuk menyelesaikan masalah', '2025-07-19 00:47:13', '2025-07-19 00:47:26'),
(11, 'Menyebutkan fakta ilmiah', '2025-07-19 00:48:17', '2025-07-19 00:48:17'),
(12, 'Mengenali fenomena sains', '2025-07-19 00:49:37', '2025-07-19 00:49:37');

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
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id` int NOT NULL,
  `id_soal` int NOT NULL,
  `id_siswa` int NOT NULL,
  `jawaban` varchar(10) NOT NULL,
  `nilai` int NOT NULL,
  `percobaan` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id`, `id_soal`, `id_siswa`, `jawaban`, `nilai`, `percobaan`, `created_at`, `updated_at`) VALUES
(5, 1, 7, '', 0, 1, '2025-07-19 20:18:16', '2025-07-19 20:18:16'),
(6, 2, 7, '', 1, 1, '2025-07-19 20:18:25', '2025-07-19 20:18:25'),
(7, 3, 7, '', 0, 1, '2025-07-19 20:18:30', '2025-07-19 20:18:30'),
(8, 4, 7, '', 1, 1, '2025-07-19 20:18:38', '2025-07-19 20:18:38'),
(9, 5, 7, '', 0, 1, '2025-07-19 20:18:42', '2025-07-19 20:18:42'),
(10, 6, 7, '', 0, 1, '2025-07-19 20:18:47', '2025-07-19 20:18:47'),
(11, 7, 7, '', 0, 1, '2025-07-19 20:18:52', '2025-07-19 20:18:52'),
(12, 8, 7, '', 1, 1, '2025-07-19 20:18:56', '2025-07-19 20:18:56'),
(13, 9, 7, '', 0, 1, '2025-07-19 20:19:00', '2025-07-19 20:19:00'),
(14, 10, 7, '', 0, 1, '2025-07-19 20:19:04', '2025-07-19 20:19:04'),
(15, 11, 7, '', 0, 1, '2025-07-19 20:19:10', '2025-07-19 20:19:10'),
(16, 12, 7, '', 0, 1, '2025-07-19 20:19:14', '2025-07-19 20:19:14'),
(17, 13, 7, '', 1, 1, '2025-07-19 20:19:19', '2025-07-19 20:19:19'),
(18, 14, 7, '', 0, 1, '2025-07-19 20:19:23', '2025-07-19 20:19:23'),
(19, 15, 7, '', 0, 1, '2025-07-19 20:19:27', '2025-07-19 20:19:27'),
(20, 16, 7, '', 0, 1, '2025-07-19 20:19:31', '2025-07-19 20:19:31'),
(21, 17, 7, '', 0, 1, '2025-07-19 20:19:59', '2025-07-19 20:19:59'),
(22, 18, 7, '', 0, 1, '2025-07-19 20:20:04', '2025-07-19 20:20:04'),
(23, 19, 7, '', 0, 1, '2025-07-19 20:20:08', '2025-07-19 20:20:08'),
(24, 20, 7, '', 0, 1, '2025-07-19 20:20:12', '2025-07-19 20:20:12'),
(25, 21, 7, '', 0, 1, '2025-07-19 20:20:16', '2025-07-19 20:20:16'),
(26, 22, 7, '', 0, 1, '2025-07-19 20:20:23', '2025-07-19 20:20:23'),
(27, 23, 7, '', 0, 1, '2025-07-19 20:20:26', '2025-07-19 20:20:26'),
(28, 24, 7, '', 0, 1, '2025-07-19 20:20:31', '2025-07-19 20:20:31'),
(29, 25, 7, '', 0, 1, '2025-07-19 20:20:35', '2025-07-19 20:20:35'),
(30, 26, 7, '', 0, 1, '2025-07-19 20:20:39', '2025-07-19 20:20:39'),
(31, 27, 7, '', 1, 1, '2025-07-19 20:20:44', '2025-07-19 20:20:44'),
(32, 28, 7, '', 0, 1, '2025-07-19 20:20:48', '2025-07-19 20:20:48'),
(33, 29, 7, '', 0, 1, '2025-07-19 20:20:52', '2025-07-19 20:20:52'),
(34, 30, 7, '', 0, 1, '2025-07-19 20:21:37', '2025-07-19 20:21:37'),
(35, 1, 7, '', 0, 2, '2025-07-19 21:07:46', '2025-07-19 21:07:46'),
(36, 2, 7, '', 0, 2, '2025-07-19 21:08:15', '2025-07-19 21:08:15'),
(37, 3, 7, 'b', 0, 2, '2025-07-19 21:13:51', '2025-07-19 21:13:51'),
(38, 4, 7, 'b', 0, 2, '2025-07-19 21:13:58', '2025-07-19 21:13:58'),
(39, 5, 7, 'c', 0, 2, '2025-07-19 21:14:03', '2025-07-19 21:14:03'),
(40, 6, 7, 'b', 0, 2, '2025-07-19 21:14:09', '2025-07-19 21:14:09'),
(41, 7, 7, 'a', 0, 2, '2025-07-19 21:14:15', '2025-07-19 21:14:15'),
(42, 8, 7, 'b', 0, 2, '2025-07-19 21:14:25', '2025-07-19 21:14:25'),
(43, 9, 7, 'b', 0, 2, '2025-07-19 21:14:36', '2025-07-19 21:14:36'),
(44, 10, 7, 'c', 0, 2, '2025-07-19 21:14:43', '2025-07-19 21:14:43'),
(45, 11, 7, 'b', 0, 2, '2025-07-19 21:14:50', '2025-07-19 21:14:50'),
(46, 12, 7, 'b', 0, 2, '2025-07-19 21:14:56', '2025-07-19 21:14:56'),
(47, 13, 7, 'b', 0, 2, '2025-07-19 21:15:01', '2025-07-19 21:15:01'),
(48, 14, 7, 'a', 0, 2, '2025-07-19 21:15:06', '2025-07-19 21:15:06'),
(49, 15, 7, 'c', 0, 2, '2025-07-19 21:15:12', '2025-07-19 21:15:12'),
(50, 16, 7, 'a', 0, 2, '2025-07-19 21:15:17', '2025-07-19 21:15:17'),
(51, 17, 7, 'a', 0, 2, '2025-07-19 21:15:22', '2025-07-19 21:15:22'),
(52, 18, 7, 'b', 0, 2, '2025-07-19 21:15:26', '2025-07-19 21:15:26'),
(53, 19, 7, 'a', 0, 2, '2025-07-19 21:15:32', '2025-07-19 21:15:32'),
(54, 20, 7, 'a', 0, 2, '2025-07-19 21:15:38', '2025-07-19 21:15:38'),
(55, 21, 7, 'a', 0, 2, '2025-07-19 21:15:44', '2025-07-19 21:15:44'),
(56, 22, 7, 'a', 0, 2, '2025-07-19 21:15:48', '2025-07-19 21:15:48'),
(57, 23, 7, 'a', 0, 2, '2025-07-19 21:15:53', '2025-07-19 21:15:53'),
(58, 24, 7, 'a', 1, 2, '2025-07-19 21:15:57', '2025-07-19 21:15:57'),
(59, 25, 7, 'd', 1, 2, '2025-07-19 21:16:02', '2025-07-19 21:16:02'),
(60, 26, 7, 'c', 1, 2, '2025-07-19 21:16:06', '2025-07-19 21:16:06'),
(61, 27, 7, 'b', 1, 2, '2025-07-19 21:16:11', '2025-07-19 21:16:11'),
(62, 28, 7, 'c', 0, 2, '2025-07-19 21:16:15', '2025-07-19 21:16:15'),
(63, 29, 7, 'a', 0, 2, '2025-07-19 21:16:20', '2025-07-19 21:16:20'),
(64, 30, 7, 'b', 1, 2, '2025-07-19 21:16:26', '2025-07-19 21:16:26'),
(65, 1, 7, 'a', 0, 3, '2025-07-20 04:27:32', '2025-07-20 04:27:32'),
(66, 2, 7, 'b', 1, 3, '2025-07-20 04:27:38', '2025-07-20 04:27:38'),
(67, 30, 7, 'a', 0, 3, '2025-07-20 04:27:50', '2025-07-20 04:27:50');

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
-- Table structure for table `petunjuk`
--

CREATE TABLE `petunjuk` (
  `id` bigint UNSIGNED NOT NULL,
  `petunjuk` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petunjuk`
--

INSERT INTO `petunjuk` (`id`, `petunjuk`, `created_at`, `updated_at`) VALUES
(1, '<h3><strong>Tema</strong>: 8. Bumiku Sayang, Bumiku Malang</h3><p><strong>Subtema</strong>:</p><ol><li>Bumi Berubah</li><li>Oh, Lingkungan Jadi Rusak</li><li>Permasalahan Lingkungan Mengancam Kehidupan</li></ol><h3><strong>Tujuan Pembelajaran</strong>:</h3><ol><li>Mencari hubungan faktor alam dan perbuatan manusia dengan perubahan kondisi alam di permukaan bumi.</li><li>Mengidentifikasi pola hidup yang menyebabkan terjadinya permasalahan lingkungan.</li><li>Memprediksi dampak permasalahan lingkungan terhadap kondisi sosial, kemasyarakatan, dan ekonomi.</li></ol><h3><strong>Refinement Literasi Sains</strong></h3><p>Refinement literasi sains adalah upaya perbaikan pemahaman, penerapan, dan penalaran siswa terhadap sains.</p><p><strong>Langkah-langkah refinement untuk meningkatkan literasi sains</strong>:</p><ol><li>Membaca wacana/bacaan/teks secara cermat.</li><li>Membaca soal atau pertanyaan terkait bacaan.</li><li>Menandai kata kunci yang sesuai dengan soal.</li><li>Mengaitkan bacaan dengan materi pelajaran.</li></ol><h3><strong>Refinement Domain Kognitif Literasi Sains (berdasarkan TIMSS)</strong></h3><p><strong>1. Domain Knowing (Pengetahuan)</strong> mencakup:</p><ul><li>Memahami fenomena sains</li><li>Memberikan contoh fakta sains</li><li>Memahami dampak negatif dari fenomena sains</li></ul><p><strong>2. Domain Applying (Penerapan)</strong> mencakup:</p><ul><li>Memecahkan masalah praktis</li><li>Mengelompokkan objek atau materi</li><li>Menghasilkan penjelasan ilmiah</li><li>Menghubungkan konsep ilmu pengetahuan dengan konteks tertentu</li></ul><p><strong>3. Domain Reasoning (Penalaran)</strong> mencakup:</p><ul><li>Menganalisis data</li><li>Membuat simpulan</li></ul>', '2025-07-18 21:32:14', '2025-07-18 21:32:14');

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
('mv4ArSW0S5coxuaYiUnNiwP7iDtn3uck6BF8XPOy', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWVNadk1GS2M3eExrbmxORkN1OWZuc1oySE1MY0xYQ2ZLMGx3WTAyZyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MztzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3NTI5ODY5ODY7fX0=', 1752986986);

-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

CREATE TABLE `soal` (
  `id` int NOT NULL,
  `indikator_soal` text,
  `soal` text,
  `pilihan_a` text,
  `pilihan_b` text,
  `pilihan_c` text,
  `pilihan_d` text,
  `kunci_jawaban` varchar(1) DEFAULT NULL,
  `pembahasan` text,
  `domain_kognitif` int DEFAULT NULL,
  `indikator_literasi` int DEFAULT NULL,
  `teslet` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `soal`
--

INSERT INTO `soal` (`id`, `indikator_soal`, `soal`, `pilihan_a`, `pilihan_b`, `pilihan_c`, `pilihan_d`, `kunci_jawaban`, `pembahasan`, `domain_kognitif`, `indikator_literasi`, `teslet`, `created_at`, `updated_at`) VALUES
(1, 'Siswa mampu memahami peristiwa gunung meletus dengan tepat', 'Berdasarkan teks wacana di atas, penjelasan tentang gunung meletus yang tepat adalah….', 'gunung meletus merupakan peristiwa alam yang disebabkan oleh tanah longsor', 'gunung meletus merupakan peristiwa alam yang disebabkan oleh perbuatan manusia', 'gunung meletus merupakan peristiwa alam yang disebabkan oleh terdorongnya endapan magma dalam perut bumi menuju ke luar', 'gunung meletus merupakan peristiwa alam yang disebabkan oleh adanya angin topan', 'C', 'Secara teori dan penjelasan yang ada di dalam wacana, jawaban yang benar adalah C', 1, 1, 1, '2025-07-18 01:10:01', '2025-07-18 01:10:01'),
(2, 'Siswa mampu memberikan contoh material yang keluar saat terjadi peristiwa gunung meletus', 'Selain endapan magma, material lain yang biasanya keluar terdorong pada peristiwa gunung meletus yaitu….', 'tanah', 'batu', 'air', 'arang', 'B', 'Dari wacana diperoleh informasi bahwa yang keluar bersama magma ketika gunung meletus adalah abu dan batu. Oleh sebab itu jawaban yang benar adalah B.', 1, 2, 1, '2025-07-18 21:06:51', '2025-07-18 21:06:51'),
(3, 'Siswa mampu memahami dampak negatif yang ditimbulkan oleh peristiwa gunung meletus', 'Dampak negatif yang ditimbulkan dari adanya peristiwa gunung meletus yaitu….', 'lahan di sekitar menjadi subur', 'tumbuhan yang tumbuh menghijau', 'suhu di sekitar gunung menjadi sangat panas', 'suhu di sekitar gunung menjadi sangat dingin', 'C', 'Dari wacana diperoleh informasi bahwa suhu di sekitar gunung yang meletus menjadi sangat panas. Dengan demikian jawaban yang benar adalah C', 1, 3, 1, '2025-07-19 00:37:43', '2025-07-19 00:37:43'),
(4, 'Siswa mampu memahami faktor penyebab dan bukan faktor penyebab terjadinya tsunami', 'Berdasarkan teks artikel di atas, yang bukan merupakan penyebab terjadinya tsunami adalah….', 'gempa bumi', 'gunung meletus', 'banjir bandang', 'asteroid jatuh', 'C', 'Di wacana menginformasikan bahwa Tsunami juga dapat disebabkan oleh longsor, aktivitas gunung api, serta asteroid dan komet yang menabrak atau meledak di atas laut. Dari pilihan jawaban yang tidak termasuk penyebab tsunami adalah banjir\r\nbandang, Jadi jawaban yang benar adalah C.', 1, 1, 2, '2025-07-19 00:39:17', '2025-07-19 00:39:17'),
(5, 'Siswa mampu menghubung- kan pengetahu- an yang dimili- kinya dalam konteks faktor penyebab air laut surut sementara setelah	aktivitas seismik', 'Faktor yang menyebabkan timbulnya gejala awal tsunami yaitu air laut menjadi surut sementara waktu, karena adanya aktivitas ….', 'bom di laut yang mengakibatkan ledakan', 'seismik di tengah laut yang mengakibatkan patahan', 'hewan laut yang menyebabkan benturan', 'manusia yang membuat ledakan', 'B', 'Di wacana mengin-formasikan bahwa umumnya tsunami terjadi akibat ada-nya aktivitas seis-mik di tengah laut. Saat terjadi hal tersebut maka patahan akan membuat air laut menjadi surut sementara waktu. Jawaban yang benar adalah B', 2, 7, 2, '2025-07-19 00:41:03', '2025-07-19 00:41:03'),
(6, 'Siswa mampu memecahkan masalah praktis ketika air laut surut secara tiba-tiba', 'Apa langkah mitigasi yang bisa kita lakukan saat melihat air laut surut secara tiba-tiba setelah aktivitas tektonik?', 'mencari tahu penyebab air laut surut secara tiba-tiba', 'berkeliling di tepi pantai karena air laut surut', 'berlari menyelamatkan diri ke tempat yang lebih tinggi', 'mencari kerang di tepi pantai karena air laut surut', 'C', 'Ketika melihat air laut surut setelah aktivitas tektonik, sebaiknya segera menyelamatkan diri dengan mencari tempat yang lebih tinggi. Jawaban yang benar adalah C', 2, 4, 2, '2025-07-19 00:42:30', '2025-07-19 00:42:30'),
(7, 'Siswa mampu memahami peristiwa angin topan dengan tepat', 'Berdasarkan teks wacana di atas, penjelasan yang tepat terkait angin topan adalah peristiwa ….', 'biasa yang tidak merugikan kehidupan manusia', 'alam yang menyebabkan perubahan kondisi alam', 'bencana yang disebabkan oleh perbuatan manusia', 'bencana alam yang kejadiannya dapat dicegah', 'B', 'Pada wacana tertera bahwa angin topan merupakan bencana yang disebabkan oleh faktor alam yang bisa  menyebabkan  perubahan\r\nkondisi alam di permukaan bumi. Jawaban yang benar adalah B', 1, 1, 3, '2025-07-19 00:44:30', '2025-07-19 00:44:30'),
(8, 'Siswa mampu menerapkan pengetahuan sains untuk menyelesaikan masalah', 'Saat angin topan terjadi, berikut ini merupakan tindakan yang perlu dilakukan, kecuali….', 'berlindung pada bangunan yang kokoh', 'menghindari bangunan yang tinggi', 'menghindari kendaraan umum', 'mengindari tiang listrik', 'C', 'Informasi yang ada di wacana, saat angin topan terjadi, perlu dilakukan tindakan siaga bencana, seperti berlindung pada bangunan yang kokoh, hindari bangunan yang tinggi, seperti pohon, tiang listrik, pamflet, dan sejenisnya. Jadi jawaban yang benar adalah C', 2, 10, 3, '2025-07-19 00:46:45', '2025-07-19 00:50:42'),
(9, 'Siswa mampu memahami dampak negatif yang ditimbulkan oleh angin topan', 'Dampak yang dapat ditimbulkan dari adanya badai angin topan sebagai berikut ini, kecuali menyebabkan ….', 'jatuhnya korban jiwa', 'kerugian materil karena rumah rusak', 'wilayah terdampak menjadi subur', 'kegiatan sosial masyarakat terganggu', 'C', 'Di dalam wacana menginforma- sikan bahwa dampak angin topan sering merobohkan rumah dan pohon, bahkan bisa menerbangkan apa saja yang ada di dekatnya. Secara implisit bermakna dapat menimbulkan korban jiwa, kerugian materi, dan mengganggu kegiatan masyarakat. Jadi jawaban benar adalah C', 1, 3, 3, '2025-07-19 00:52:00', '2025-07-19 00:52:00'),
(10, 'Siswa mampu menyebutkan contoh fakta ilmiah berupa penyebab terjadinya gempa tektonik', 'Gempa tektonik terjadi karena adanya pergerakan….', 'magma bumi', 'asteroid', 'komet', 'lempeng bumi', 'D', 'Informasi yang tertera di wacana menyebutkan bahwa gempa bumi tektonik terjadi karena pergerakan lempeng bumi. Jadi jawaban yang benar adalah D', 1, 11, 4, '2025-07-19 01:00:03', '2025-07-19 01:00:03'),
(11, 'Siswa mampu mengelompok kan atau mengklasifikas ikan faktor penyebab gempa dan bukan faktor penyebab gempa', 'Gempa bumi dapat diklasifikasikan berdasarkan beberapa faktor berikut ini, kecuali….', 'kekuatannya', 'kedalamannya', 'jenisnya', 'bentuknya', 'D', 'Di dalam wacana terdapat informasi bahwa gempa bumi dapat diklasifikasikan berdasarkan beberapa	faktor,	yaitu kekuatannya, kedalamannya, dan jenisnya. Jadi bentuk tidak termasuk faktor pengklasifikasi gempa bumi. Jawaban yang benar adalah D', 2, 5, 4, '2025-07-19 01:01:30', '2025-07-19 01:01:48'),
(12, 'Siswa mampu menjelaskan gempa bumi yang dangkal lebih merusak daripada gempa bumi yang dalam', 'Gempa bumi yang dangkal dapat lebih merusak daripada gempa bumi yang dalam, karena terjadi di ….', 'dasar laut', 'kedalaman lebih dari 60 km', 'dasar bumi', 'dekat permukaan bumi', 'D', 'Dalam wacana juga disebutkan bahwa gempa bumi dangkal terjadi di dekat permukaan bumi. Jadi jawaban yang benar adalah D', 2, 6, 4, '2025-07-19 01:03:11', '2025-07-19 01:03:11'),
(13, 'Siswa mampu mengenali penyebab banjir yang disebabkan oleh aktivitas manusia', 'Berdasarkan teks wacana di atas, penyebab banjir yang disebabkan oleh faktor manusia adalah….', 'erosi dan sedimentasi', 'curah hujan dan kapasitas sungai', 'pengaruh fisiografi dan air pasang', 'perubahan tata guna lahan dan sampah', 'D', 'Di wacana tertera informasi bahwa banjir dapat terjadi karena alam dan tindakan manusia. Salah satu tindakan manusia adalah perubahan tata guna lahan dan sampah. Jawaban yang benar adalah D', 1, 1, 5, '2025-07-19 01:04:21', '2025-07-19 01:04:21'),
(14, 'Siswa mampu memecahkan masalah banjir melalui langkah pencegahan yang dapat dilakukan', 'Langkah mitigasi yang dapat kita lakukan untuk mencegah terjadinya banjir yang disebabkan oleh faktor manusia adalah….', 'mengubah hutan menjadi suatu permukiman', 'melakukan langkah deforestasi hutan', 'pembuangan sampah pada tempatnya', 'membuat permukiman penduduk di sepanjang aliran sungai', 'C', 'Di wacana tertera informasi bahwa banjir dapat terjadi karena alam dan tindakan manusia. Salah satu tindakan manusia adalah membuang sampah tidak pada tempatnya. Dengan demikian langkah mitigasi yang perlu dilakukan   adalah   membuang\r\nsampah pada tempatnya. Jadi jawaban benar C', 2, 4, 5, '2025-07-19 01:05:31', '2025-07-19 01:05:31'),
(15, 'Siswa mampu menghasilkan penjelasan terkait fenomena sains yang dibaca', 'Berikut ini yang merupakan penjelasan tentang fenomena banjir yang tepat sesuai dengan artikel di atas adalah….', 'banjir merupakan peristiwa bencana yang hanya disebabkan oleh faktor alam', 'banjir merupakan peristiwa bencana yang hanya disebabkan oleh faktor tindakan manusia', 'banjir merupakan peristiwa bencana yang penyebab satu- satunya yaitu sampah', 'banjir merupakan peristiwa bencana yang disebabkan oleh faktor alam dan manusia', 'D', 'Di wacana tertera informasi bahwa banjir dapat terjadi karena alam dan tindakan manusia. Jadi tidak hanya disebabkan oleh salah satunya. Jawaban yang benar adalah D', 2, 6, 5, '2025-07-19 01:07:02', '2025-07-19 01:07:02'),
(16, 'Siswa mampu mengenali faktor penyebab dan bukan faktor penyebab terjadinya longsor oleh aktivitas manusia', 'Berdasarkan teks artikel di atas, berikut ini yang bukan merupakan penyebab longsor hasil dari aktivitas manusia adalah….', 'deforestasi', 'alih fungsi lahan hutan', 'reboisasi', 'penebangan liar', 'C', 'Aktivitas manusia juga dapat menjadi penyebab tanah longsor, seperti deforestasi, alih fungsi lahan hutan. Deforestasi adalah penebangan liar. Jawaban yang benar adalah C', 1, 1, 6, '2025-07-19 19:47:08', '2025-07-19 19:47:08'),
(17, 'Siswa mampu mencegah terjadinya longsor di lingkungan sekitar', 'Langkah mitigasi perlu dilakukan untuk mencegah terjadinya longsor di lingkungan kita, antara lain adalah ….', 'membangun villa di daerah perbukitan', 'menebang pohon di daerah perbukitan', 'melakukan kegiatan deforestasi hutan', 'melakukan kegiatan reboisasi hutan', 'D', 'Tindakan seperti melarang pembakaran hutan, menghentikan penebangan liar, dan melakukan reboisasi adalah langkah-langkah awal yang efektif dalam mencegah bencana tanah longsor. Jawaban yang benar adalah D.', 2, 4, 6, '2025-07-19 19:48:31', '2025-07-19 19:48:31'),
(18, 'Siswa mampu menginterpreta sikan data dan informasi yang disajikan dalam bentuk grafik/diagram', 'Berdasakan grafik di atas, jenis sampah yang menempati posisi kedua terbanyak adalah….', 'sisa makanan', 'kayu/ranting/daun', 'logam', 'plastik', 'D', 'Pada grafik tampak bahwa jenis sampah yang menempati posisi pertama adalah sisa makanan (45,6%), ke-dua plastik (18,8%), ke-tiga kertas/karton (11,3%), dst. Jawaban yang benar D', 3, 8, 7, '2025-07-19 19:50:05', '2025-07-19 19:50:05'),
(19, 'Siswa mampu menginterpreta sikan data dan informasi yang disajikan dalam bentuk grafik', 'Grafik di atas merupakan data statistik terkait jumlah bencana alam yang terjadi di Indonesia dalam kurun waktu tahun 2023 yang dikutip dari laman website Badan Nasional Penanggulangan Bencana (BNPB).\r\nBerdasarkan data grafik di atas, bencana alam yang menempati peringkat ketujuh sebagai bencana alam yang sering terjadi di Indonesia adalah….', 'banjir dan tanah longsor', 'abrasi', 'gempa bumi', 'kekeringan', 'C', 'Dari grafik dapat ditentukan urutan dari bencana yang paling sering terjadi:\r\n1.	Kebakaran hutan\r\n2.	Tanah longsor\r\n3.	Banjir\r\n4.	Puting beliung\r\n5.	Kekeringan\r\n6.	Banjir dan longsor\r\n7.	Gempa bumi\r\n8.	Abrasi\r\nJawaban yang benar C', 3, 8, 12, '2025-07-19 19:58:25', '2025-07-19 19:58:25'),
(20, 'Siswa mampu menginterpreta sikan data dan informasi yang disajikan dalam bentuk grafik', 'Data grafik di atas merupakan data komposisi sampah nasional berdasarkan sumber sampah pada tahun 2023 yang dikutip dari laman website Kementerian Lingkungan Hidup dan Kehutanan.\r\nSumber sampah yang menempati posisi kelima terbanyak adalah….', 'rumah tangga', 'perkantoran', 'pasar tradisional', 'fasilitas publik', 'B', 'Dari grafik tampak bahwa urutan komposisi sampah dari yang paling besar adalah:\r\n1.	Rumah tangga\r\n2.	Pasar tradisional\r\n3.	Pusat perniagaan\r\n4.	Kawasan\r\n5.	Perkantoran\r\n6.	Fasilitas publik. Jawaban yang benar adalah B', 3, 8, 13, '2025-07-19 19:59:38', '2025-07-19 19:59:38'),
(21, 'Siswa mampu menarik kesimpulan yang logis berdasarkan data dan informasi yang tersedia', 'Berdasarkan data grafik tersebut, dapat disimpulkan bahwa jumlah bencana alam yang terjadi di Indonesia ….', 'terus meningkat', 'cenderung naik turun', 'cenderung menurun', 'cenderung tetap/ajeg', 'B', 'Dari grafik tampak bahwa dari tahun ke tahun, jumlah kebencanaan	mengalami peningkatan dan penurunan yang fluktuatif (naik-turun). Jawaban yang benar B', 3, 9, 8, '2025-07-19 20:00:58', '2025-07-19 20:00:58'),
(22, 'Siswa mampu menarik kesimpulan yang logis berdasarkan data dan informasi yang tersedia', 'Berdasarkan grafik di atas, jumlah bencana alam di Indonesia pada kurun waktu tahun 2015 sampai tahun 2020 adalah ....', 'cenderung menurun', 'cenderung meningkat', 'stagnan', 'fluktuatif', 'B', 'Dari grafik tampak bahwa pada kurun waktu 2015 sampai 2020 cenderung meningkat. Jawaban yang benar adalah B', 3, 9, 8, '2025-07-19 20:02:11', '2025-07-19 20:02:11'),
(23, 'Berdasarkan teks dan tabel di atas, berikut ini yang termasuk kegiatan reduce ialah….', 'Berdasarkan teks dan tabel di atas, berikut ini yang termasuk kegiatan reduce ialah….', 'memanfaatkan botol plastik bekas untuk pot tanaman', 'mengganti kantong plastik dengan tas belanja dari kain', 'mengubah sampah plastik untuk dijadikan tas', 'memanfaatkan botol plastik bekas untuk tempat pensil', 'B', 'Reduce yaitu mengurangi sampah, berarti penggunaan tas belanja dari kain dapat mengurangi sampah kantong plastik. Jawaban benar B', 2, 4, 9, '2025-07-19 20:03:36', '2025-07-19 20:03:36'),
(24, 'Siswa mampu memecahkan masalah praktis terkait dengan pengelolaan sampah dengan metode\r\nReuse', 'Berdasarkan teks dan tabel di atas, berikut ini yang merupakan kegiatan reuse ialah….', 'memanfaatkan botol plastik bekas sebagai tempat pensil', 'mengubah sampah plastik menjadi tas yang terbuat dari plastik', 'mengganti kantong plastik dengan tas belanja dari kain', 'mengubah sampah plastik menjadi jas hujan', 'A', 'Reuse, yaitu memanfaatkan kembali barang yang masih bisa digunakan. Berati kita dapat memanfaat botol plastik bekas sebagai tempat pinsil. Jawaban yang benar A', 2, 4, 9, '2025-07-19 20:05:13', '2025-07-19 20:05:13'),
(25, 'Siswa mampu memecahkan masalah praktis terkait dengan pengelolaan sampah dengan metode Recycle', 'Berdasarkan teks dan tabel di atas, berikut ini yang merupakan termasuk kegiatan recycle ialah….', 'memanfaatkan botol plastik bekas sebagai tempat pensil', 'mengganti kantong plastik dengan tas belanja dari kain', 'memanfaatkan botol plastik sebagai pot tanaman', 'mengubah sampah plastik menjadi jas hujan', 'D', 'Recyle, yaitu menggunakan sampah untuk dilakukan daur ulang sehingga menjadi sesuatu yang lebih bernilai. Berarti kita dapat memanfaatkan sampah menjadi benda lain yang bermanfaat, misalnya mengubah sampah plastik menjadi jas hujan\r\natau sepatu atau benda lain. Jawaban benar adalah D', 2, 4, 9, '2025-07-19 20:06:27', '2025-07-19 20:06:27'),
(26, 'Siswa mampu mengenali dampak negatif dalam bidang ekonomi yang ditimbulkan oleh sampah\r\nplastik', 'Berdasarkan teks artikel di atas, dampak negatif dalam bidang ekonomi yang ditimbulkan dari sampah plastik ialah….', 'penghasilan nelayan meningkat karena tersedia banyak ikan di laut', 'manusia dapat memakan ikan sebagai sumber makanan', 'penghasilan nelayan menurun karena banyak ikan mati akibat mikroplastik', 'manusia bisa membuang sampah ke laut dengan bebas', 'C', 'Dampak mikroplastik pada hasil tangkapan ikan menurun karena banyak ikan yang mati, akibatnya pendapatan menurun dan berdampak negatif pada bidang ekonomi. Jawaban yang benar adalah C', 1, 12, 10, '2025-07-19 20:08:05', '2025-07-19 20:08:05'),
(27, 'Siswa mampu mengenali dampak negatif sampah plastik terhadap kehidupan masyarakat', 'Berdasarkan teks artikel di atas, dampak negatif sampah plastik terhadap kehidupan masyarakat ialah….', 'dapat mengonsumsi ikan yang baik untuk kesehatan', 'mengonsumsi ikan yang berbahaya bagi kesehatan', 'bebas memakan ikan yang bersumber dari laut', 'memiliki banyak pilihan terkait ikan yang dapat dikonsumsi', 'B', 'Dampak negatif sampah plastik terhadap kehidupan masyarakat yang disampaikan pada wacana adalah bahaya bagi tubuh manusia dan tentunya terkait dengan kesehatan. Jawaban yang benar adalah B.', 1, 3, 10, '2025-07-19 20:09:46', '2025-07-19 20:09:46'),
(28, 'Siswa mampu memecahkan masalah praktis dengan cara membuang sampah organik pada tempatnya', 'Berdasarkan poster dan wacana di atas, Dewi dan Ibunya sebaiknya membuang sampah sisa sayuran dan buah-buahan pada tempat sampah ….', 'bahan berbahaya', 'anorganik', 'kantong plastik', 'organik', 'D', 'Sisa sayuran dan buah-buahan merupakan sampah yang cepat membusuk atau disebut dengan organik, maka tempat sampah yang dipilih adalah yang berwarna hijau atau tempat sampah organik. Juawaban yang tepat adalah D', 2, 4, 11, '2025-07-19 20:11:13', '2025-07-19 20:11:13'),
(29, 'Siswa mampu memecahkan masalah praktis dengan cara membuang sampah anorganik pada tempatnya', 'Berdasarkan poster dan wacana di atas, Dewi dan Ibunya sebaiknya membuang sampah botol dan kaleng bekas minuman di tempat sampah ….', 'organik', 'bahan berbahaya', 'anorganik', 'drum bekas', 'C', 'Sampah botol dan kaleng bekas minuman, merupakan sampah yang sulit terurai atau disebut anorganik, maka tempat sampah yang cocok adalah yang berwarna kuning atau tempat sampah anorganik. Jawaban yang tepat adalah C.', 2, 4, 11, '2025-07-19 20:12:27', '2025-07-19 20:12:27'),
(30, 'Siswa mampu memecahkan masalah praktis terkait sampah dengan cara membuang sampah B3 pada\r\ntempatnya', 'Berdasarkan poster dan wacana di atas, Dewi dan Ibunya sebaiknya membuang sampah batu baterai di tempat sampah ….', 'organik', 'bahan berbahaya', 'anorganik', 'drum bekas', 'B', 'Sampah batu baterai mengandung zat yang berbahaya, oleh sebabitu tempat sampah yang cocok adalah yang berwarna merah atau tempat sampah bahan berbahaya. Jawaban yang tepat adalah B.', 2, 4, 11, '2025-07-19 20:13:38', '2025-07-19 20:13:38');

-- --------------------------------------------------------

--
-- Table structure for table `teslet`
--

CREATE TABLE `teslet` (
  `id` int NOT NULL,
  `judul` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `keterangan` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teslet`
--

INSERT INTO `teslet` (`id`, `judul`, `gambar`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Gunung Meletus', 'teslet/COgpUNXHMual4RqL2pJbw0lpqHnLS5bfMT3T93pl.jpg', 'Di Indonesia, gunung meletus merupakan salah satu bencana yang sering terjadi. Gunung meletus merupakan salah satu peristiwa alam yang mengakibatkan bencana. Gunung Meletus dapat menyebabkan kerusakan dan korban jiwa. Peristiwa gunung meletus umumnya terjadi pada gunung berapi yang masih aktif. Peristiwa gunung Meletus bermula dari proses terdorongnya endapan magma dalam perut bumi menuju ke luar. Proses tersebut terjadi akibat tekanan gas yang\r\ncukup tinggi. Dalam peristiwa letusan ini, biasanya endapan magma akan terdorong bersamaan dengan batu dan abu. Jarak letusan bisa mencapai puluhan kilometer dan mengubah suhu di sekitarnya menjadi sangat panas. Gunung Meletus adalah bencana yang seringkali tidak dapat dihindari. Namun, hal ini dapat diwaspadai lebih awal oleh penduduk di sekitar wilayah gunung berapi.', '2025-07-18 00:55:44', '2025-07-19 04:08:11'),
(2, 'Tsunami', 'teslet/HhH22vCMNwMNiKAdPKM3yuGU8MJMznyDVv5JKV86.jpg', 'Tsunami merupakan salah satu fenomena alam yang sering terjadi. Terutama di wilayah pesisir yang berada di area patahan gempa. Tsunami adalah peristiwa dimana gelombang laut datang menuju Pantai secara tiba-tiba setelah terjadi aktivitas tektonik. Rangkaian gelombang yang sangat panjang yang disebabkan\r\npergerakan laut yang besar dan tiba-tiba akibat gempa bumi di bawah atau dekat dasar laut. Tsunami juga dapat disebabkan oleh longsor, aktivitas gunung api, serta asteroid dan komet yang menabrak atau meledak di atas laut. Umumnya tsunami terjadi akibat adanya aktivitas seismik di tengah laut. Saat terjadi hal\r\ntersebut maka patahan akan membuat air laut menjadi surut sementara waktu, dan kemudian berbalik menuju Pantai dalam bentuk gelombang besar. Tinggi gelombang dapat mencapai hingga 100 meter dengan kecepatan hingga 700km per jam. Tsunami merupakan fenomena alam yang patut diwaspadai. Oleh sebab itu, jika melihat air laut surut setelah aktivitas tektonik, sebaiknya segera menyelamatkan diri dan waspada.', '2025-07-18 00:56:38', '2025-07-19 04:08:21'),
(3, 'Angin Topan', 'teslet/WsFj75JCexf7r1j8Qtjz4dxidmtlA1aDCMX05YcF.jpg', 'Angin topan adalah angin kencang dengan pusaran angin yang kecepatannya mencapai 120 km/jam atau lebih. Angin topan juga biasa disebut dengan badai besar yang kuat. Angin topan merupakan bencana yang disebabkan oleh faktor alam yang bisa menyebabkan perubahan kondisi alam di permukaan bumi. Bagaimana proses terbentuknya angin topan?. Topan terbentuk di lautan suhu panas. Air yang panas, tentunya akan cepat menguap. Uap air yang berasal dari lautan itu jumlahnya sangat banyak. Uap air kemudian naik dan membentuk awan kumulonimbus. Di dalam gumpalan awan ini, terdapat pusaran angin yang sangat kuat. Pusaran angin akan semakin kencang, sehingga berputar-putar dan terbentuklah topan. Nah, angin topan biasanya terjadi dibarengi dengan hujan yang lebat. Mengapa hal itu bisa terjadi? Topan terbentuk dari Kumpulan awan. Di dalam topan terdapat banyak sekali awan mendung. Awan mendung inilah yang akan menurunkan hujan lebat. Ketika angin topan terjadi, maka langit akan tertutup awan mendung. Angin topan sering merobohkan rumah dan pohon, bahkan bisa menerbangkan apa saja yang ada di dekatnya. Oleh karena itu, saat angin topan terjadi, perlu dilakukan tindakan siaga bencana, seperti berlindung pada bangunan yang kokoh, hindari bangunan yang tinggi, seperti pohon, tiang listrik, pamflet, dan sejenisnya.', '2025-07-18 21:15:36', '2025-07-18 21:15:36'),
(4, 'Gempa Bumi Tektonik', 'teslet/dEdXhYdwI2U70yHny5GDMYTGIUtgVfyK2D2sBk8D.jpg', 'Gempa bumi adalah getaran atau guncangan yang terjadi di permukaan bumi yang disebabkan oleh pelepasan energi dari dalam bumi secara tiba-tiba. Gempa bumi dapat terjadi di mana saja, tetapi lebih sering terjadi di daerah yang dekat dengan patahan lempeng bumi. Gempa bumi dapat diklasifikasikan berdasarkan beberapa faktor, yaitu kekuatannya, kedalamannya, dan jenisnya. Kekuatan gempa bumi diukur dengan skala Richter, yang berkisar antara 0 hingga 9. Gempa bumi dengan kekuatan 7 atau lebih dapat menyebabkan kerusakan yang signifikan. Kedalaman gempa bumi juga dapat mempengaruhi kerusakan yang terjadi. Gempa bumi yang dangkal akan lebih merusak daripada gempa bumi yang dalam. Gempa bumi dangkal terjadi di dekat permukaan bumi, sedangkan gempa bumi dalam terjadi di kedalaman lebih dari 60 kilometer. Jenis gempa bumi juga dapat mempengaruhi kerusakan yang terjadi. Gempa bumi tektonik adalah jenis gempa bumi yang paling umum terjadi. Gempa bumi tektonik terjadi karena pergerakan lempeng bumi. Gempa bumi tektonik dapat menyebabkan kerusakan yang signifikan, terutama di daerah yang dekat dengan pusat gempa.', '2025-07-19 00:52:38', '2025-07-19 00:52:38'),
(5, 'Banjir', 'teslet/i4BMA2fyAL4u3bHezeEOWNLhe1kM18bVzZi4FqvN.jpg', 'Mendengar kata banjir memang sudah tidak asing lagi di telinga kita. Banjir adalah fenomena alam yang bersumber dari curah hujan dengan intensitas tinggi dan durasi lama pada daerah aliran sungai (DAS). Banjir dapat terjadi karena alam dan tindakan manusia. Penyebab alami banjir adalah erosi dan sedimentasi, curah hujan, pengaruh fisiografi/geofisik sungai, kapasitas sungai, drainase lahan, dan pengaruh air pasang. Penyebab banjir karena tindakan manusia adalah perubahan tata guna lahan, pembuangan sampah, kawasan padat penduduk di sepanjang sungai, dan kerusakan bangunan pengendali banjir.\r\nSebagai akibat perubahan tata guna lahan, terjadi erosi sehingga sedimentasi masuk ke sungai dan daya tampung sungai menjadi berkurang. Ketika suatu kawasan hutan diubah menjadi permukiman, aliran permukaan tanah menuju sungai dan menyebabkan peningkatan debit aliran sungai.\r\nPerubahan tata guna lahan merupakan penyebab utama banjir dibandingkan dengan yang lainnya. Apabila suatu hutan yang berada dalam suatu aliran sungai diubah menjadi permukiman, debit puncak sungai akan meningkat antara 6 sampai 20 kali, bergantung pada jenis hutan dan jenis permukiman. Deforestasi, degradasi lingkungan, dan pembangunan kota yang penuh dengan bangunan beton dan jalan-jalan aspal tanpa memperhitungkan drainase, daerah resapan, dan tanpa memperhatikan data intensitas hujan dapat menyebabkan bencana alam banjir. Pembuangan sampah di DAS membuat sungai tersumbat sampah, dan menyebabkan banjir. Banjir menjadi salah satu bencana yang menyebabkan kerusakan besar bagi manusia. Oleh sebab itu, kita harus selalu waspada dan mempersiapkan diri menghadapi bencana ini.', '2025-07-19 00:53:04', '2025-07-19 00:53:04'),
(6, 'Tanah Longsor', 'teslet/XL3quM6IeOAszjgQocyvt4XoSRu2sWACfiF1Cgct.jpg', 'Tanah longsor adalah salah satu bencana alam yang sering terjadi di Indonesia. Bencana ini terjadi akibat pergerakan tanah dari bagian atas yang dapat menimpa atau menimbun benda-benda di bawahnya. Lokasi yang sering terkena tanah longsor adalah daerah pegunungan atau perbukitan, terutama saat musim hujan. Namun, bencana ini juga bisa terjadi di dataran rendah karena faktor-faktor tertentu. Penyebab utama terjadinya tanah longsor adalah curah hujan yang tinggi dan berlangsung dalam waktu lama. Pada musim kemarau, tanah menjadi kering dan retak-retak akan muncul di permukaannya. Saat hujan turun, retakan ini akan terisi air hingga mencapai titik jenuh. Struktur tanah yang tidak mampu menahan banyaknya air akan mulai bergeser ke bawah, mengakibatkan tanah longsor. Selain faktor alam, aktivitas manusia juga dapat menjadi penyebab tanah longsor, seperti deforestasi, alih fungsi lahan hutan. Deforestasi atau penebangan liar mengganggu sirkulasi air dalam tanah. Meskipun begitu, pencegahan dapat dilakukan dengan meningkatkan kesadaran akan lingkungan. Tindakan seperti melarang pembakaran hutan, menghentikan penebangan liar, dan melakukan reboisasi adalah langkah-langkah awal yang efektif dalam mencegah bencana tanah longsor.', '2025-07-19 00:53:37', '2025-07-19 00:53:37'),
(7, 'Data Komposisi Sampah Berdasarkan Jenis Sampah', 'teslet/3eeprHZg7K5UNcv1AvETegytTeNM3YACj7i829Sr.jpg', 'Data grafik di atas merupakan data komposisi sampah nasional berdasarkan jenis sampah pada tahun 2023 yang dikutip dari laman website Kementerian Lingkungan Hidup dan Kehutanan.', '2025-07-19 00:54:04', '2025-07-19 00:54:04'),
(8, 'Grafik Statistik', 'teslet/B0IoqNFx7h6Mrq3GeJ1pYr57mvTRQPweHFfcegyZ.jpg', 'Grafik di atas merupakan data statistik terkait jumlah bencana alam yang terjadi di Indonesia dalam kurun waktu tahun 2014-2023 yang dikutip dari laman website Badan Nasional Penanggulangan Bencana (BNPB).', '2025-07-19 00:56:07', '2025-07-19 00:56:07'),
(9, 'Pengelolaan Sampah dengan 3R', 'teslet/MgCGhmrSej3AEOZ4LTUt51Zpu5nniOcbh4v8i2Q8.jpg', 'Pengelolaan sampah harus meninggalkan pandangan lama, yaitu kumpul-angkut-buang. Muncul pendekatan lain dalam mengatasi masalah lingkungan karena sampah. Prinsip 3R yang terdiri atas reduce, reuse, dan recycle mendorong setiap orang untuk bertanggung jawab dalam mengelola sampah.\r\nReduce,yaitu mengurangi sampah.\r\nReuse, yaitu memanfaatkan kembali barang yang masih bisa digunakan.\r\nRecyle, yaitu menggunakan sampah untuk dilakukan daur ulang sehingga menjadi sesuatu yang lebih bernilai.', '2025-07-19 00:56:38', '2025-07-19 00:56:38'),
(10, 'Sampah Plastik dan Manusia', 'teslet/P1KbPzPSkFpvcbTGdI9XB3tVQ8JUmH4MNFSM3NMM.jpg', 'Sampah plastik yang tidak dikelola dengan baik, misalnya dibuang ke sungai akan mencemari lingkungan. Air sungai tidak bisa dimanfaatkan karena mengandung mikroplastik. Mikroplastik dapat menjadi tempat menempelnya bahan berbahaya lain di dunia. Kemudian, sampah dari sungai akan mengalir ke laut. Laut pun akan tercemar oleh sampah plastik. Biota laut, seperti plankton secara tidak sengaja dapat memakan mikroplastik. Kemudian, plankton akan dimakan ikan. Jika, ikan mengonsumsi mikroplastik dalam jumlah besar, maka dapat menyebabkan kematian pada ikan, hal ini tentu berdampak pada hasil tangkapan para nelayan. Apabila ikan memakan mikroplastik dalam jumlah sedikit dan masih hidup, ikan tersebut kemudian dimakan manusia, tentu hal ini juga menyebabkan bahaya bagi tubuh manusia. Mikroplastik yang masuk ke dalam tubuh dalam jumlah besar dapat membahayakan kesehatan. Plastik yang tidak bisa keluar dari usus akan mengendap di dalam tubuh. Lama kelamaan dapat mengganggu sistem pencernaan', '2025-07-19 00:57:02', '2025-07-19 00:57:02'),
(11, 'Buanglah Sampah Pada Tempatnya', 'teslet/qyw0wLBFaJxdTQwALH34C6Cp6mI9H9vKj7lCR0BS.jpg', 'Dewi dan Ibunya memiliki prinsip untuk menjaga bumi dengan cara membuang sampah pada tempatnya. Mereka memiliki sampah sisa sayuran dan buah-buahan, sampah botol dan kaleng bekas minuman, dan sampah batu baterai. Di depan rumah sudah tersedia 3 jenis tempat sampah.', '2025-07-19 00:57:40', '2025-07-19 00:57:40'),
(12, 'No. 19', 'teslet/3Zn0qXNokMjjD60XSYOLEWesHpCXV7k8PBLsNAKw.jpg', 'Cermatilah data grafik berikut ini untuk menjawab soal no 19!', '2025-07-19 19:55:59', '2025-07-19 19:55:59'),
(13, 'No. 20', 'teslet/44kXf7ktbyyjeYcEDE3AdleKDDj59ZqFq3ubgNmr.jpg', 'Cermatilah data diagram berikut ini untuk menjawab soal no 20!', '2025-07-19 19:56:39', '2025-07-19 19:56:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class` int DEFAULT NULL,
  `school` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `email_verified_at`, `password`, `remember_token`, `name`, `class`, `school`, `level`, `created_at`, `updated_at`) VALUES
(3, 'admin@gmail.com', 'admin', NULL, '$2y$12$CqIIaKV0Yyq9sB4cIqjShOj5evtwnVkDBhUpPvUldcmfE0H6HcuBi', NULL, 'Admin', NULL, NULL, 1, '2025-07-17 23:20:00', '2025-07-17 23:20:00'),
(7, 'siswa@gmail.com', 'siswa', NULL, '$2y$12$5eQ.gxLPXvzW0mHbVQldWeCQjstRHJXktDmDjExXXUodI/WVfwD42', NULL, 'siswa', 5, 'SD N 2 Semarang', 2, '2025-07-19 20:16:16', '2025-07-19 20:16:16'),
(8, 'siswa2@gmail.com', 'siswa2', NULL, '$2y$12$zD79O7MwqNnfSKq1icdz0ejCmlY8jIKOFZkC3GGd2bIVq0i6Mvf6e', NULL, 'siswa2', 5, 'SD N 2 Semarang', 2, '2025-07-19 20:16:57', '2025-07-19 20:16:57'),
(9, 'siswa1@gmail.com', 'siswa1', NULL, '$2y$12$CyzMmtnp/rMUcq6DM1ztROi9O8z4whhiDEQm4QVxVti4N3WfoeFx6', NULL, 'siswa1', 5, 'SD N 2 Semarang', 2, '2025-07-19 20:17:26', '2025-07-19 20:17:26');

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
-- Indexes for table `domain_kognitif`
--
ALTER TABLE `domain_kognitif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `indikator_literasi`
--
ALTER TABLE `indikator_literasi`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `petunjuk`
--
ALTER TABLE `petunjuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teslet` (`teslet`);

--
-- Indexes for table `teslet`
--
ALTER TABLE `teslet`
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
-- AUTO_INCREMENT for table `domain_kognitif`
--
ALTER TABLE `domain_kognitif`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `indikator_literasi`
--
ALTER TABLE `indikator_literasi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `petunjuk`
--
ALTER TABLE `petunjuk`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `teslet`
--
ALTER TABLE `teslet`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
