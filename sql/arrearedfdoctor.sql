-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2022 at 09:08 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payroll`
--

-- --------------------------------------------------------

--
-- Table structure for table `arrearedfdoctor`
--

CREATE TABLE `arrearedfdoctor` (
  `af_id` int(11) NOT NULL,
  `af_details_trat` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'รายละเอียดการรักษา',
  `af_date_acp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'วันที่เข้ารักษา',
  `af_sercicce_charge` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ค่าบริการทั้งหมด',
  `af_ssp` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ประกันสังคม',
  `af_cash` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ประกันอื่นๆ',
  `af_name_patient` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ชื่อคนไข้',
  `af_HN` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `af_riht` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'สิทธิการรักษา',
  `af_id_bill` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `af_id_doctor` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `af_date_df_doctor` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `af_type_file` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `af_type_doctor` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `af_arreare` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `arrearedfdoctor`
--

INSERT INTO `arrearedfdoctor` (`af_id`, `af_details_trat`, `af_date_acp`, `af_sercicce_charge`, `af_ssp`, `af_cash`, `af_name_patient`, `af_HN`, `af_riht`, `af_id_bill`, `af_id_doctor`, `af_date_df_doctor`, `af_type_file`, `af_type_doctor`, `af_arreare`) VALUES
(2, '1st Visit , fulltime ห้องพิเศษ  ', '01/12/2564 10:38', '650', '', '200', 'นายวรัญญู อารีย์', ' 14062/64', '21', 'II-21-0007689', '09909', '2021-12-01', '1', '1', '0'),
(3, 'การตรวจรักษา กรณี ผู้ป่วยใน ครั้งต่อไป (2nd Visit Fulltime ห้องพิเศษ)  ', '01/12/2564 09:45', '800', '', '900', 'น.ส.วรษา สตานนท์ดร', ' 53002/42', '21', 'II-21-0007697', '09909', '2021-12-01', '1', '1', '0'),
(4, 'ค่าตรวจเมื่อจำหน่าย    ', '01/12/2564 09:45', '300', '', '0', 'น.ส.วรษา สตานนท์ดร', ' 53002/42', '21', 'II-21-0007697', '09909', '2021-12-01', '1', '1', '0'),
(5, '1st Visit , fulltime ห้องพิเศษ  ', '01/12/2564 09:45', '650', '', '200', 'น.ส.วรษา สตานนท์ดร', ' 53002/42', '21', 'II-21-0007698', '09909', '2021-12-01', '1', '1', '0'),
(6, 'การตรวจรักษา กรณี ผู้ป่วยใน ครั้งต่อไป (2nd Visit Fulltime ห้องพิเศษ)  ', '01/12/2564 10:04', '800', '', '200', 'น.ส.พรรณวิภา พิมพ์บุตร', '  9891/61', '60', 'II-21-0007702', '09909', '2021-12-01', '1', '1', '0'),
(7, 'DFวิสัญญี ผ่าตัดคลอด(LTCS)(15 นาที  ', '242861', '200', '', '625', 'น.ส.ณัฐชาภา มหาไม้', ' 10666/60', '60', 'RI-21-0007086', '06037', '2021-12-07', '1', '1', '0'),
(8, 'การตรวจรักษา กรณี ผู้ป่วยใน ครั้งต่อไป (2nd Visit Fulltime ห้องพิเศษ)  ', '01/12/2564 09:45', '2800', '', '900', 'น.ส.วรษา สตานนท์ดร', ' 53002/42', '21', 'II-21-0007698', '09909', '2021-12-01', '1', '1', '0'),
(9, 'การตรวจรักษา กรณี ผู้ป่วยใน ครั้งต่อไป (2nd Visit Fulltime ห้องพิเศษ)  ', '01/12/2564 10:16', '1200', '100', '', 'น.ส.ชมพูนุช วงค์กัญญา', ' 13446/57', '60', 'SWI-21-0006604', '09909', '2021-12-01', '1', '1', '0'),
(10, '1st Visit , fulltime ห้องพิเศษ  ', '01/12/2564 09:41', '650', '200', '', 'น.ส.เสาวณีย์ มูลจา', '  2495/64', '60', 'SWI-21-0006592', '09909', '2021-12-01', '1', '1', '0'),
(11, 'ค่าตรวจเมื่อจำหน่าย    ', '01/12/2564 10:04', '300', '', '160', 'น.ส.พรรณวิภา พิมพ์บุตร', '  9891/61', '60', 'II-21-0007702', '09909', '2021-12-01', '1', '1', '0'),
(12, '1st Visit , fulltime ห้องพิเศษ  ', '01/12/2564 10:04', '650', '', '200', 'น.ส.พรรณวิภา พิมพ์บุตร', '  9891/61', '60', 'II-21-0007702', '09909', '2021-12-01', '1', '1', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arrearedfdoctor`
--
ALTER TABLE `arrearedfdoctor`
  ADD PRIMARY KEY (`af_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arrearedfdoctor`
--
ALTER TABLE `arrearedfdoctor`
  MODIFY `af_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
