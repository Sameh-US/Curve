-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 28 أكتوبر 2024 الساعة 03:46
-- إصدار الخادم: 10.11.9-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u199637790_DBcurve`
--

-- --------------------------------------------------------

--
-- بنية الجدول `login`
--

CREATE TABLE `login` (
  `ID` int(11) NOT NULL,
  `fullName` varchar(128) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `Active` tinyint(1) NOT NULL,
  `reset_token_hash` varchar(64) DEFAULT NULL,
  `reset_token_expires_at` datetime DEFAULT NULL,
  `linkImage` text NOT NULL,
  `power` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `login`
--

INSERT INTO `login` (`ID`, `fullName`, `userName`, `password`, `email`, `Active`, `reset_token_hash`, `reset_token_expires_at`, `linkImage`, `power`) VALUES
(15, 'Sameh Kamal', 'Sameh', '$2y$10$q.edOaCXwj6d1mFzhsM9XeiQ7IvQ0PwhXkP/uyQ1mEtT3mxDsQbcu', 's.u@live.fr', 1, NULL, NULL, '/Image/sameh.png', 'boss'),
(16, 'Team Shaqra', 'guest', '$2y$10$6xabQlPlH/1CrgNvNG3LXeir6WV4AGZRp5D2Q9CuyrfV7HrSIQvJ.', 's@css.lu', 1, NULL, NULL, '/Image/Golden.png', 'guest'),
(17, 'Osama Samara', 'Osama', '$2y$10$zAsjbv4AUr/Nt2RulIgM0OiJZK4JsnnoGv5l4KmLVmf1Hg7Ym.nBi', 'eng.smk87@gmail.com', 1, NULL, NULL, '/Image/Golden.png', 'boss');

-- --------------------------------------------------------

--
-- بنية الجدول `t_details_curve`
--

CREATE TABLE `t_details_curve` (
  `Cr_ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Curve_id` int(11) NOT NULL,
  `Cr_Age` int(11) NOT NULL,
  `Cr_Temp` float NOT NULL,
  `Cr_Min` float NOT NULL,
  `Cr_Max` float NOT NULL,
  `Cr_Coling` float NOT NULL,
  `Cr_Heater` float NOT NULL,
  `Cr_Calc` float NOT NULL,
  `Cr_Fan` int(11) NOT NULL,
  `Curve_Last_Update` datetime NOT NULL,
  `Cr_Order` int(11) NOT NULL,
  `Curve_cycle` int(11) NOT NULL,
  `farm_id` int(11) NOT NULL,
  `Cr_Notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `t_details_curve`
--

INSERT INTO `t_details_curve` (`Cr_ID`, `UserID`, `Curve_id`, `Cr_Age`, `Cr_Temp`, `Cr_Min`, `Cr_Max`, `Cr_Coling`, `Cr_Heater`, `Cr_Calc`, `Cr_Fan`, `Curve_Last_Update`, `Cr_Order`, `Curve_cycle`, `farm_id`, `Cr_Notes`) VALUES
(2293, 17, 113, 1, 35, 2, 6, 6, 0, 1, 1, '2024-10-27 19:25:49', 1, 249, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 19:25:49 . - Count Bard : 23000 -  Count House : 10  - Power Fan : 23000'),
(2294, 17, 113, 3, 34, 4, 12, 6, 0, 2, 1, '2024-10-27 19:25:49', 1, 249, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 19:25:49 . - Count Bard : 23000 -  Count House : 10  - Power Fan : 23000'),
(2295, 17, 113, 6, 33, 6, 18, 6, 0, 3, 1, '2024-10-27 19:25:49', 1, 249, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 19:25:49 . - Count Bard : 23000 -  Count House : 10  - Power Fan : 23000'),
(2296, 17, 113, 9, 32, 10, 30, 6, 0, 4, 1, '2024-10-27 19:25:49', 1, 249, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 19:25:49 . - Count Bard : 23000 -  Count House : 10  - Power Fan : 23000'),
(2297, 17, 113, 12, 31, 15, 55, 6, 0, 5, 1, '2024-10-27 19:25:49', 1, 249, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 19:25:49 . - Count Bard : 23000 -  Count House : 10  - Power Fan : 23000'),
(2298, 17, 113, 15, 30, 25, 75, 6, 0, 6, 1, '2024-10-27 19:25:49', 1, 249, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 19:25:49 . - Count Bard : 23000 -  Count House : 10  - Power Fan : 23000'),
(2299, 17, 113, 18, 29, 35, 100, 6, 0, 7, 2, '2024-10-27 19:25:49', 1, 249, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 19:25:49 . - Count Bard : 23000 -  Count House : 10  - Power Fan : 23000'),
(2300, 17, 113, 21, 28, 45, 100, 6, 0, 8, 2, '2024-10-27 19:25:49', 1, 249, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 19:25:49 . - Count Bard : 23000 -  Count House : 10  - Power Fan : 23000'),
(2301, 17, 113, 24, 27, 60, 101, 6, 0, 0, 0, '2024-10-27 19:25:49', 1, 249, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 19:25:49 . - Count Bard : 23000 -  Count House : 10  - Power Fan : 23000'),
(2302, 17, 113, 27, 27, 80, 102, 6, 0, 0, 0, '2024-10-27 19:25:49', 1, 249, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 19:25:49 . - Count Bard : 23000 -  Count House : 10  - Power Fan : 23000'),
(2303, 17, 114, 1, 35, 6, 18, 6, 0, 1, 1, '2024-10-27 19:32:46', 1, 250, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 19:32:46 . - Count Bard : 30000 -  Count House : 10  - Power Fan : 36000'),
(2304, 17, 114, 3, 34, 11, 40, 6, 0, 2, 1, '2024-10-27 19:32:46', 1, 250, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 19:32:46 . - Count Bard : 30000 -  Count House : 10  - Power Fan : 36000'),
(2305, 17, 114, 6, 33, 16, 60, 6, 0, 3, 1, '2024-10-27 19:32:46', 1, 250, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 19:32:46 . - Count Bard : 30000 -  Count House : 10  - Power Fan : 36000'),
(2306, 17, 114, 9, 32, 24, 101, 6, 0, 4, 1, '2024-10-27 19:32:46', 1, 250, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 19:32:46 . - Count Bard : 30000 -  Count House : 10  - Power Fan : 36000'),
(2307, 17, 114, 12, 31, 34, 102, 6, 0, 5, 1, '2024-10-27 19:32:46', 1, 250, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 19:32:46 . - Count Bard : 30000 -  Count House : 10  - Power Fan : 36000'),
(2308, 17, 114, 15, 30, 43, 102, 6, 0, 6, 1, '2024-10-27 19:32:46', 1, 250, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 19:32:46 . - Count Bard : 30000 -  Count House : 10  - Power Fan : 36000'),
(2309, 17, 114, 18, 29, 51, 103, 6, 0, 7, 2, '2024-10-27 19:32:46', 1, 250, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 19:32:46 . - Count Bard : 30000 -  Count House : 10  - Power Fan : 36000'),
(2310, 17, 114, 21, 28, 62, 103, 6, 0, 8, 2, '2024-10-27 19:32:46', 1, 250, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 19:32:46 . - Count Bard : 30000 -  Count House : 10  - Power Fan : 36000'),
(2311, 17, 114, 24, 27, 101, 104, 6, 0, 0, 0, '2024-10-27 19:32:46', 1, 250, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 19:32:46 . - Count Bard : 30000 -  Count House : 10  - Power Fan : 36000'),
(2312, 17, 114, 27, 27, 101, 105, 6, 0, 0, 0, '2024-10-27 19:32:46', 1, 250, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 19:32:46 . - Count Bard : 30000 -  Count House : 10  - Power Fan : 36000'),
(2313, 17, 115, 1, 34, 8, 101, 5, 0, 0.5, 1, '2024-10-27 19:39:46', 1, 251, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 19:39:46 . - Count Bard : 32000 -  Count House : 10  - Power Fan : 36000'),
(2314, 17, 115, 3, 33, 14, 101, 5, 0, 1.5, 1, '2024-10-27 19:39:46', 1, 251, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 19:39:46 . - Count Bard : 32000 -  Count House : 10  - Power Fan : 36000'),
(2315, 17, 115, 6, 32, 20, 102, 5, 0, 2.5, 1, '2024-10-27 19:39:46', 1, 251, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 19:39:46 . - Count Bard : 32000 -  Count House : 10  - Power Fan : 36000'),
(2316, 17, 115, 9, 31, 30, 102, 5, 0, 3, 1, '2024-10-27 19:39:46', 1, 251, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 19:39:46 . - Count Bard : 32000 -  Count House : 10  - Power Fan : 36000'),
(2317, 17, 115, 12, 30, 43, 103, 5, 0, 3.5, 1, '2024-10-27 19:39:46', 1, 251, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 19:39:46 . - Count Bard : 32000 -  Count House : 10  - Power Fan : 36000'),
(2318, 17, 115, 15, 29, 54, 103, 5, 0, 4, 1, '2024-10-27 19:39:46', 1, 251, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 19:39:46 . - Count Bard : 32000 -  Count House : 10  - Power Fan : 36000'),
(2319, 17, 115, 18, 28, 64, 104, 5, 0, 4.5, 2, '2024-10-27 19:39:46', 1, 251, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 19:39:46 . - Count Bard : 32000 -  Count House : 10  - Power Fan : 36000'),
(2320, 17, 115, 21, 27, 101, 105, 5, 0, 5, 2, '2024-10-27 19:39:46', 1, 251, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 19:39:46 . - Count Bard : 32000 -  Count House : 10  - Power Fan : 36000'),
(2321, 17, 115, 24, 27, 102, 106, 5, 0, 0, 0, '2024-10-27 19:39:46', 1, 251, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 19:39:46 . - Count Bard : 32000 -  Count House : 10  - Power Fan : 36000'),
(2322, 17, 115, 27, 27, 102, 106, 5, 0, 0, 0, '2024-10-27 19:39:46', 1, 251, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 19:39:46 . - Count Bard : 32000 -  Count House : 10  - Power Fan : 36000'),
(2323, 17, 116, 1, 34, 8, 101, 5, 0, 0.5, 1, '2024-10-27 19:45:42', 1, 252, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 19:45:42 . - Count Bard : 33000 -  Count House : 10  - Power Fan : 36000'),
(2324, 17, 116, 3, 33, 14, 101, 5, 0, 1.5, 1, '2024-10-27 19:45:42', 1, 252, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 19:45:42 . - Count Bard : 33000 -  Count House : 10  - Power Fan : 36000'),
(2325, 17, 116, 6, 32, 20, 101, 5, 0, 2.5, 1, '2024-10-27 19:45:42', 1, 252, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 19:45:42 . - Count Bard : 33000 -  Count House : 10  - Power Fan : 36000'),
(2326, 17, 116, 9, 31, 30, 102, 5, 0, 3, 1, '2024-10-27 19:45:42', 1, 252, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 19:45:42 . - Count Bard : 33000 -  Count House : 10  - Power Fan : 36000'),
(2327, 17, 116, 12, 30, 43, 102, 5, 0, 3.5, 1, '2024-10-27 19:45:42', 1, 252, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 19:45:42 . - Count Bard : 33000 -  Count House : 10  - Power Fan : 36000'),
(2328, 17, 116, 15, 29, 54, 102, 5, 0, 4, 1, '2024-10-27 19:45:42', 1, 252, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 19:45:42 . - Count Bard : 33000 -  Count House : 10  - Power Fan : 36000'),
(2329, 17, 116, 18, 28, 64, 103, 5, 0, 4.5, 2, '2024-10-27 19:45:42', 1, 252, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 19:45:42 . - Count Bard : 33000 -  Count House : 10  - Power Fan : 36000'),
(2330, 17, 116, 21, 27, 101, 104, 5, 0, 5, 2, '2024-10-27 19:45:42', 1, 252, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 19:45:42 . - Count Bard : 33000 -  Count House : 10  - Power Fan : 36000'),
(2331, 17, 116, 24, 27, 102, 105, 5, 0, 0, 0, '2024-10-27 19:45:42', 1, 252, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 19:45:42 . - Count Bard : 33000 -  Count House : 10  - Power Fan : 36000'),
(2332, 17, 116, 27, 27, 102, 106, 5, 0, 0, 0, '2024-10-27 19:45:42', 1, 252, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 19:45:42 . - Count Bard : 33000 -  Count House : 10  - Power Fan : 36000'),
(2333, 17, 117, 1, 34, 7, 28, 4, 0, 1, 1, '2024-10-27 20:02:36', 1, 254, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 20:02:36 . - Count Bard : 33000 -  Count House : 10  - Power Fan : 36000'),
(2334, 17, 117, 3, 33, 13, 52, 4, 0, 2, 1, '2024-10-27 20:02:36', 1, 254, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 20:02:36 . - Count Bard : 33000 -  Count House : 10  - Power Fan : 36000'),
(2335, 17, 117, 6, 32, 19, 75, 4, 0, 3, 1, '2024-10-27 20:02:36', 1, 254, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 20:02:36 . - Count Bard : 33000 -  Count House : 10  - Power Fan : 36000'),
(2336, 17, 117, 9, 31, 28, 101, 4, 0, 4, 1, '2024-10-27 20:02:36', 1, 254, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 20:02:36 . - Count Bard : 33000 -  Count House : 10  - Power Fan : 36000'),
(2337, 17, 117, 12, 30, 40, 101, 4, 0, 5, 1, '2024-10-27 20:02:36', 1, 254, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 20:02:36 . - Count Bard : 33000 -  Count House : 10  - Power Fan : 36000'),
(2338, 17, 117, 15, 29, 51, 102, 4, 0, 6, 1, '2024-10-27 20:02:36', 1, 254, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 20:02:36 . - Count Bard : 33000 -  Count House : 10  - Power Fan : 36000'),
(2339, 17, 117, 18, 28, 61, 102, 4, 0, 7, 2, '2024-10-27 20:02:36', 1, 254, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 20:02:36 . - Count Bard : 33000 -  Count House : 10  - Power Fan : 36000'),
(2340, 17, 117, 21, 28, 73, 103, 5, 0, 8, 2, '2024-10-27 20:02:36', 1, 254, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 20:02:36 . - Count Bard : 33000 -  Count House : 10  - Power Fan : 36000'),
(2341, 17, 117, 24, 28, 85, 103, 5, 0, 0, 0, '2024-10-27 20:02:36', 1, 254, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 20:02:36 . - Count Bard : 33000 -  Count House : 10  - Power Fan : 36000'),
(2342, 17, 117, 27, 28, 101, 104, 5, 0, 0, 0, '2024-10-27 20:02:36', 1, 254, 1, 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 20:02:36 . - Count Bard : 33000 -  Count House : 10  - Power Fan : 36000');

-- --------------------------------------------------------

--
-- بنية الجدول `t_farm`
--

CREATE TABLE `t_farm` (
  `farm_id` int(200) NOT NULL,
  `farm_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `t_farm`
--

INSERT INTO `t_farm` (`farm_id`, `farm_name`) VALUES
(1, 'AbdulAziz 1'),
(2, 'AbdulAziz 2');

-- --------------------------------------------------------

--
-- بنية الجدول `t_maincurve`
--

CREATE TABLE `t_maincurve` (
  `User_ID` int(11) NOT NULL,
  `Curve_id` int(11) NOT NULL,
  `Curve_farmID` int(11) NOT NULL,
  `Curve_cycle` int(11) NOT NULL,
  `Curve_countHouse` int(11) NOT NULL,
  `Curve_date` date NOT NULL,
  `Curve_countBard` int(11) NOT NULL,
  `Curve_powerFan` int(11) NOT NULL,
  `Curve_typeCurveID` int(11) NOT NULL,
  `Curve_Last_Update` datetime NOT NULL,
  `Curve_Notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `t_maincurve`
--

INSERT INTO `t_maincurve` (`User_ID`, `Curve_id`, `Curve_farmID`, `Curve_cycle`, `Curve_countHouse`, `Curve_date`, `Curve_countBard`, `Curve_powerFan`, `Curve_typeCurveID`, `Curve_Last_Update`, `Curve_Notes`) VALUES
(17, 113, 1, 249, 10, '2024-02-20', 23000, 23000, 2, '2024-10-27 19:25:49', 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 19:25:49 . - Count Bard : 23000 -  Count House : 10  - Power Fan : 23000'),
(17, 114, 1, 250, 10, '2024-04-06', 30000, 36000, 2, '2024-10-27 19:32:46', 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 19:32:46 . - Count Bard : 30000 -  Count House : 10  - Power Fan : 36000'),
(17, 115, 1, 251, 10, '2024-05-21', 32000, 36000, 2, '2024-10-27 19:39:46', 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 19:39:46 . - Count Bard : 32000 -  Count House : 10  - Power Fan : 36000'),
(17, 116, 1, 252, 10, '2024-07-10', 33000, 36000, 2, '2024-10-27 19:45:42', 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 19:45:42 . - Count Bard : 33000 -  Count House : 10  - Power Fan : 36000'),
(17, 117, 1, 254, 10, '2024-10-07', 33000, 36000, 2, '2024-10-27 20:02:36', 'Create a new curve start a new cycle created by  Osama Samara on 2024-10-27 20:02:36 . - Count Bard : 33000 -  Count House : 10  - Power Fan : 36000');

-- --------------------------------------------------------

--
-- بنية الجدول `t_table`
--

CREATE TABLE `t_table` (
  `table_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `table_Age` int(11) NOT NULL,
  `table_Weight` int(11) NOT NULL,
  `table_Stand` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `t_table`
--

INSERT INTO `t_table` (`table_id`, `type_id`, `table_Age`, `table_Weight`, `table_Stand`) VALUES
(391, 1, 1, 50, 0.08),
(392, 1, 2, 75, 0.111),
(393, 1, 3, 100, 0.141),
(394, 1, 4, 117, 0.162),
(395, 1, 5, 132, 0.185),
(396, 1, 6, 150, 0.208),
(397, 1, 7, 200, 0.258),
(398, 1, 8, 250, 0.305),
(399, 1, 9, 300, 0.35),
(400, 1, 10, 350, 0.393),
(401, 1, 11, 400, 0.435),
(402, 1, 12, 450, 0.475),
(403, 1, 13, 500, 0.514),
(404, 1, 14, 550, 0.552),
(405, 1, 15, 600, 0.589),
(406, 1, 16, 650, 0.625),
(407, 1, 17, 700, 0.661),
(408, 1, 18, 750, 0.696),
(409, 1, 19, 800, 0.731),
(410, 1, 20, 850, 0.765),
(411, 1, 21, 900, 0.798),
(412, 1, 22, 950, 0.831),
(413, 1, 23, 1000, 0.864),
(414, 1, 24, 1100, 0.928),
(415, 1, 25, 1200, 0.991),
(416, 1, 26, 1300, 1.052),
(417, 1, 27, 1400, 1.112),
(418, 1, 28, 1500, 1.172),
(419, 1, 29, 1600, 1.229),
(420, 1, 30, 1700, 1.286),
(1111, 2, 1, 50, 0.08),
(1112, 2, 2, 0, 0),
(1113, 2, 3, 100, 0.141),
(1114, 2, 4, 0, 0),
(1115, 2, 5, 0, 0),
(1116, 2, 6, 150, 0.208),
(1117, 2, 7, 0, 0),
(1118, 2, 8, 0, 0),
(1119, 2, 9, 250, 0.305),
(1120, 2, 10, 0, 0),
(1121, 2, 11, 0, 0),
(1122, 2, 12, 400, 0.435),
(1123, 2, 13, 0, 0),
(1124, 2, 14, 0, 0),
(1125, 2, 15, 550, 0.552),
(1126, 2, 16, 0, 0),
(1127, 2, 17, 0, 0),
(1128, 2, 18, 700, 0.661),
(1129, 2, 19, 0, 0),
(1130, 2, 20, 0, 0),
(1131, 2, 21, 900, 0.798),
(1132, 2, 22, 0, 0),
(1133, 2, 23, 0, 0),
(1134, 2, 24, 1100, 0.928),
(1135, 2, 25, 0, 0),
(1136, 2, 26, 0, 0),
(1137, 2, 27, 1300, 1.052),
(1138, 2, 28, 0, 0),
(1139, 2, 29, 0, 0),
(1140, 2, 30, 0, 0);

-- --------------------------------------------------------

--
-- بنية الجدول `t_type`
--

CREATE TABLE `t_type` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `t_type`
--

INSERT INTO `t_type` (`type_id`, `type_name`) VALUES
(1, 'Ross 308 Stander 2023'),
(2, 'Ross 308 GC Shaqra');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `reset_token_hach` (`reset_token_hash`);

--
-- Indexes for table `t_details_curve`
--
ALTER TABLE `t_details_curve`
  ADD PRIMARY KEY (`Cr_ID`);

--
-- Indexes for table `t_farm`
--
ALTER TABLE `t_farm`
  ADD PRIMARY KEY (`farm_id`);

--
-- Indexes for table `t_maincurve`
--
ALTER TABLE `t_maincurve`
  ADD PRIMARY KEY (`Curve_id`);

--
-- Indexes for table `t_table`
--
ALTER TABLE `t_table`
  ADD PRIMARY KEY (`table_id`);

--
-- Indexes for table `t_type`
--
ALTER TABLE `t_type`
  ADD PRIMARY KEY (`type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `t_details_curve`
--
ALTER TABLE `t_details_curve`
  MODIFY `Cr_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2343;

--
-- AUTO_INCREMENT for table `t_farm`
--
ALTER TABLE `t_farm`
  MODIFY `farm_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `t_maincurve`
--
ALTER TABLE `t_maincurve`
  MODIFY `Curve_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `t_table`
--
ALTER TABLE `t_table`
  MODIFY `table_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1171;

--
-- AUTO_INCREMENT for table `t_type`
--
ALTER TABLE `t_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
