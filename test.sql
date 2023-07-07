-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2023-07-08 00:48:09
-- 服务器版本： 5.7.26
-- PHP 版本： 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `test`
--

-- --------------------------------------------------------

--
-- 表的结构 `article`
--

CREATE TABLE `article` (
  `id` bigint(20) UNSIGNED NOT NULL COMMENT 'ID',
  `user` bigint(20) UNSIGNED NOT NULL COMMENT 'User',
  `type` char(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Type',
  `subject` char(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Subject',
  `cost` decimal(10,2) NOT NULL COMMENT 'Cost',
  `count` int(10) UNSIGNED NOT NULL COMMENT 'Maximum number of people',
  `registered` tinyint(3) UNSIGNED NOT NULL COMMENT 'Number of people registered',
  `students_avatar` longtext COLLATE utf8mb4_unicode_ci COMMENT 'students',
  `details` varchar(248) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Details',
  `state` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'State',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `article`
--

INSERT INTO `article` (`id`, `user`, `type`, `subject`, `cost`, `count`, `registered`, `students_avatar`, `details`, `state`, `created_at`, `updated_at`) VALUES
(2, 1, 'high school', 'math', '100.00', 20, 1, '[\"http:\\/\\/127.0.0.1:8000\\/storage\\/article\\/student-avatar\\/DhEhPFlKTmjf6nFpWkZ5v7j3YGTmOMcxpDpFtnzD.png\"]', 'good', 1, '2023-06-29 07:33:25', '2023-06-29 07:33:25'),
(4, 2, 'primary school', 'math', '200.00', 10, 1, '[\"http:\\/\\/127.0.0.1:8000\\/storage\\/article\\/student-avatar\\/r6VWLK4oa2mX8D61bDsq1wnbpTinV2IYtjbLkZfv.jpg\"]', '1111', 1, '2023-07-07 08:44:12', '2023-07-07 08:44:12');

-- --------------------------------------------------------

--
-- 表的结构 `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(248) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(248) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_06_19_142805_update_users_table', 1),
(6, '2023_06_26_130202_create_article_table', 1);

-- --------------------------------------------------------

--
-- 表的结构 `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(248) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(248) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(248) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(248) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nickname` char(200) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `name` varchar(248) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` char(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'http://127.0.0.1:8000/uploads/images/default-avatar.jpg' COMMENT 'avatar',
  `email` varchar(248) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(248) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slogan` char(200) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `nickname`, `name`, `avatar`, `email`, `email_verified_at`, `password`, `slogan`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '', 'LONG SHA', 'http://127.0.0.1:8000/storage/images/avatar/Ek8C6vCb4FElZBCUdI8OyS9C3HofQfV4SodwOrVP.png', '1095921538@qq.com', NULL, '$2y$10$aL6ZBPbaT3k6hSHE/JR8x.d/FwTMnpGTJ.IOUPqHMgo/n.L57auCK', '', NULL, '2023-06-29 07:15:27', '2023-06-29 07:40:06'),
(2, NULL, 'Dave', 'http://127.0.0.1:8000/uploads/images/default-avatar.jpg', 'ls521538@163.com', NULL, '$2y$10$hebJ4QSdrKZHddM5ZegK3e7AByzxmy/jHzKD.PXm0/dqCx5fC0bOe', NULL, NULL, '2023-07-07 07:58:20', '2023-07-07 08:03:59');

--
-- 转储表的索引
--

--
-- 表的索引 `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- 表的索引 `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- 表的索引 `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- 表的索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `article`
--
ALTER TABLE `article`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用表AUTO_INCREMENT `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
