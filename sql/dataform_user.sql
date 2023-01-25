-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2022 at 07:12 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

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
-- Table structure for table `dataform_user`
--

CREATE TABLE `dataform_user` (
  `RECORD` int(255) NOT NULL,
  `CODE_NAME` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TIME1` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TIME2` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `OPD_SOCIAL` double NOT NULL,
  `OPD_GENERA` double NOT NULL,
  `SURGI_SOCI` double NOT NULL,
  `SURGI_GENE` double NOT NULL,
  `DOCTORFEE` int(255) NOT NULL,
  `WORK` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `PT_NAME` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `DUTY` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dataform_user`
--

INSERT INTO `dataform_user` (`RECORD`, `CODE_NAME`, `TIME1`, `TIME2`, `OPD_SOCIAL`, `OPD_GENERA`, `SURGI_SOCI`, `SURGI_GENE`, `DOCTORFEE`, `WORK`, `PT_NAME`, `DUTY`) VALUES
(1, '', '17.00', '07.00', 0, 0, 0, 0, 4550, '', '', '2'),
(2, '', '17.00', '08.00', 0, 0, 0, 0, 4875, '', '', '2'),
(3, '', '17.00', '07.00', 0, 0, 0, 0, 3200, '', '', '2'),
(4, '', '17.00', '20.00', 0, 0, 0, 0, 1300, '', '', '2'),
(5, '', '08.00', '17.00', 0, 0, 0, 0, 3000, '', '', '2'),
(6, '', '08.00', '12.00', 0, 0, 0, 0, 1500, '', '1 ราย', '2'),
(7, '', '12.00', '17.00', 0, 0, 0, 0, 1500, '', '1 ราย', '2'),
(14, '88888', '08.00', '17.00', 1000, 1000, 0, 0, 2500, 'Admit เยี่ยมไข้ หัตถการ', '1 ราย', '2'),
(15, '22222', '08.00', '16.00', 1000, 1000, 0, 0, 3500, 'ตรวจ หัตถการ', '1 ราย', '2'),
(16, '55555', '08.00', '16.00', 1000, 1000, 0, 0, 2500, 'การันตี', '1 ราย', '2'),
(17, '123456', '08.00', '16.00', 222, 222, 0, 0, 9999, 'ตรวจ', '1 ราย', '2'),
(18, '654321', '08.00', '16.00', 0, 0, 0, 0, 9999, 'Admit เยี่ยมไข้ หัตถการ', '1 ราย', '2'),
(24, '', '', '', 0, 0, 0, 0, 0, '', '', ''),
(26, '9999', '', '', 500, 1000, 999, 1000, 0, 'การันตี', '1 ราย', '1'),
(29, '54321', '08.00', '16.00', 9999, 1000, 0, 0, 0, 'ตรวจ', '', '2'),
(31, '', '', '', 0, 0, 0, 0, 0, '', 'ชุติรส,จตุรัส', '1'),
(32, '', '', '', 0, 0, 0, 0, 0, '', 'ประภัสสร,ณัฐธิดา,พรรณผกา,กนกพร,วนิดา,เดข', '1'),
(33, '123456789', '', '', 0, 0, 0, 0, 0, '', '', '1'),
(34, '', '', '', 0, 0, 0, 0, 0, '', 'ประภัสสร,ณัฐธิดา,พรรณผกา,กนกพร,วนิดา,เดข	', '2'),
(35, '00003', '', '', 500, 1000, 0, 0, 0, 'Admit เยี่ยมไข้ หัตถการ', '1 ราย', '1'),
(36, '00003', '08.00', '17.00', 0, 0, 0, 0, 3500, 'วันอาทิตย์', '1 ราย', '2'),
(37, '00003', '08.00', '17.00', 0, 0, 0, 0, 3500, '\"', '1 ราย', '2'),
(38, '00003', '17.00', '08.00', 500, 500, 0, 0, 3500, 'หัตถการ', '1 ราย', '2'),
(39, '00003', '', '', 500, 1000, 0, 0, 0, 'หัตถการ', '1 ราย', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dataform_user`
--
ALTER TABLE `dataform_user`
  ADD PRIMARY KEY (`RECORD`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dataform_user`
--
ALTER TABLE `dataform_user`
  MODIFY `RECORD` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
