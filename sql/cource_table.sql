-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2020 年 6 月 15 日 17:18
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
-- テーブルの構造 `cource_table`
--

CREATE TABLE `cource_table` (
  `cource_id` int(12) NOT NULL,
  `cource_txt` text COLLATE utf8_unicode_ci NOT NULL,
  `cource_gap` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `cource_table`
--

INSERT INTO `cource_table` (`cource_id`, `cource_txt`, `cource_gap`) VALUES
(1, '東京DEV', 0),
(2, '東京LAB', 7),
(3, '福岡DEV', 10),
(4, '福岡LAB', 13);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `cource_table`
--
ALTER TABLE `cource_table`
  ADD PRIMARY KEY (`cource_id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `cource_table`
--
ALTER TABLE `cource_table`
  MODIFY `cource_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
