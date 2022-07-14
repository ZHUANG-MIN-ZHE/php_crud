-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-07-14 05:46:39
-- 伺服器版本： 10.4.14-MariaDB
-- PHP 版本： 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `php_crud`
--

-- --------------------------------------------------------

--
-- 資料表結構 `account_info`
--

CREATE TABLE `account_info` (
  `帳號` varchar(30) NOT NULL DEFAULT '',
  `姓名` varchar(10) NOT NULL DEFAULT '',
  `性別` varchar(5) NOT NULL DEFAULT '',
  `生日` date NOT NULL DEFAULT '2000-01-01',
  `信箱` varchar(50) NOT NULL DEFAULT '',
  `備註` text DEFAULT '\'\''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `account_info`
--

INSERT INTO `account_info` (`帳號`, `姓名`, `性別`, `生日`, `信箱`, `備註`) VALUES
('admin', 'test01', 'man', '2000-01-19', 'helloworld@gmail.com', 'Hello World!!'),
('test02', 'test02', 'man', '2000-01-19', 'helloworld@gmail.com', 'Hello!!'),
('test03', 'test03', 'woman', '2000-01-19', 'helloworld@gmail.com', 'Hello GUYS!!'),
('test04', 'test04', 'woman', '2000-01-28', 'helloworld@gmail.com', 'Hello DAD!!'),
('test05', 'test05', 'woman', '2000-01-19', 'helloworld@gmail.com', 'Hello MOM!!'),
('test06', 'test06', 'woman', '2000-01-19', 'helloworld@gmail.com', 'Hello BROTHER!!'),
('hello', 'hello', 'man', '2022-07-14', 'hello', 'hello');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `account_info`
--
ALTER TABLE `account_info`
  ADD PRIMARY KEY (`帳號`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
