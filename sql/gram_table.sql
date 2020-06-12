-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2020 年 6 月 12 日 03:31
-- サーバのバージョン： 10.4.11-MariaDB
-- PHP のバージョン: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `gsacf_l03_12`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `gram_table`
--

CREATE TABLE `gram_table` (
  `id` int(12) NOT NULL,
  `users_id` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `users_password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `is_admin` int(1) NOT NULL,
  `is_deleted` int(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `last_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `last_name_kana` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `first_name_kana` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `nick_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `users_location` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `cource` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `ki` int(32) NOT NULL,
  `touitsu_ki` int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `gram_table`
--

INSERT INTO `gram_table` (`id`, `users_id`, `users_password`, `is_admin`, `is_deleted`, `created_at`, `updated_at`, `last_name`, `first_name`, `last_name_kana`, `first_name_kana`, `nick_name`, `users_location`, `cource`, `ki`, `touitsu_ki`) VALUES
(1, '1', '1', 1, 0, '2020-06-12 01:09:50', '2020-06-12 01:09:50', 'AAA', '000', 'エー', 'ゼロ', 'アルファ', '東京', 'DEV', 1, 1),
(2, '2', '2', 0, 0, '2020-06-12 01:12:33', '2020-06-12 01:12:33', 'BBB', '111', 'ビー', 'イチ', 'ブラボー', '東京', 'LAB', 1, 8),
(3, '3', '3', 0, 0, '2020-06-12 08:07:03', '2020-06-12 08:07:03', 'ccc', '222', 'シー', 'ニ', 'チャーリー', '福岡', 'DEV', 1, 11),
(4, '4', '4', 0, 0, '2020-06-12 08:08:50', '2020-06-12 08:08:50', 'ddd', '333', 'ディー', 'サン', 'デルタ', '福岡', 'LAB', 1, 14),
(5, '5', '5', 0, 0, '2020-06-12 08:10:08', '2020-06-12 08:10:08', 'eee', '444', 'イー', 'ヨン', 'エコー', '東京', 'DEV', 16, 16),
(6, '6', '6', 0, 0, '2020-06-12 08:11:13', '2020-06-12 08:11:13', 'fff', '555', 'エフ', 'ゴ', 'フォックス', '東京', 'LAB', 9, 16),
(7, '7', '7', 0, 0, '2020-06-12 08:12:10', '2020-06-12 08:12:10', 'ggg', '666', 'ジー', 'ロク', 'ゴルフ', '福岡', 'DEV', 6, 16),
(8, '8', '8', 1, 0, '2020-06-12 08:13:15', '2020-06-12 08:13:15', 'hhh', '777', 'エイチ', 'ナナ', 'ホテル', '福岡', 'LAB', 3, 16),
(10, '999', '999', 0, 0, '2020-06-12 08:53:04', '2020-06-12 08:53:04', '999', '999', '999', '999', '999', '999', '999', 999, 999),
(12, '666', '666', 0, 0, '2020-06-12 10:06:37', '2020-06-12 10:07:58', '666666', '666666', '666666', '666666', '666666', '0', '0', 1, 16),
(13, '111', '111', 0, 0, '2020-06-12 10:13:09', '2020-06-12 10:30:22', '111', '111', '111', '111', '111111', '0', '0', 3, 14);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `gram_table`
--
ALTER TABLE `gram_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `gram_table`
--
ALTER TABLE `gram_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
