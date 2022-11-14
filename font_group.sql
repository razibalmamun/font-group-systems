-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 14, 2022 at 01:08 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `font_group`
--

-- --------------------------------------------------------

--
-- Table structure for table `fonts`
--

CREATE TABLE `fonts` (
  `id` int(11) NOT NULL,
  `font_file_name` varchar(50) DEFAULT NULL,
  `font_original_file_name` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fonts`
--

INSERT INTO `fonts` (`id`, `font_file_name`, `font_original_file_name`, `created_at`) VALUES
(33, 'arial.ttf', 'arial.ttf', '2022-11-13 05:01:47'),
(34, 'Corbel-Italic.ttf', 'Corbel Italic.ttf', '2022-11-13 05:01:50'),
(35, 'times-new-roman-bold-italic.ttf', 'times new roman bold italic.ttf', '2022-11-13 05:01:53'),
(36, 'times-new-roman-italic.ttf', 'times new roman italic.ttf', '2022-11-13 05:02:01'),
(37, 'times-new-roman.ttf', 'times new roman.ttf', '2022-11-13 05:02:12'),
(38, 'Algerian-Regular.ttf', 'Algerian Regular.ttf', '2022-11-13 05:24:43');

-- --------------------------------------------------------

--
-- Table structure for table `font_groups`
--

CREATE TABLE `font_groups` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `font_groups`
--

INSERT INTO `font_groups` (`id`, `title`, `created_at`) VALUES
(1, 'Example 1', '2022-11-14 01:04:44'),
(2, 'Example 2', '2022-11-14 01:05:33');

-- --------------------------------------------------------

--
-- Table structure for table `font_group_items`
--

CREATE TABLE `font_group_items` (
  `id` int(11) NOT NULL,
  `font_group_id` int(11) DEFAULT '0',
  `font_id` int(11) DEFAULT '0',
  `font_name` varchar(100) DEFAULT NULL,
  `font_size` varchar(20) DEFAULT NULL,
  `font_price` decimal(10,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `font_group_items`
--

INSERT INTO `font_group_items` (`id`, `font_group_id`, `font_id`, `font_name`, `font_size`, `font_price`) VALUES
(1, 1, 38, 'Algerian', '12', '5.0000'),
(2, 1, 34, 'Carbel Italic', '13', '5.0000'),
(3, 2, 36, 'Times new roman', '14', '7.0000'),
(4, 2, 33, 'Arial', '8', '1.0000'),
(5, 2, 34, 'Corbel Italic', '9', '2.0000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fonts`
--
ALTER TABLE `fonts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `font_groups`
--
ALTER TABLE `font_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `font_group_items`
--
ALTER TABLE `font_group_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `font_group_id` (`font_group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fonts`
--
ALTER TABLE `fonts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `font_groups`
--
ALTER TABLE `font_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `font_group_items`
--
ALTER TABLE `font_group_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `font_group_items`
--
ALTER TABLE `font_group_items`
  ADD CONSTRAINT `FK_font_group_items_font_groups` FOREIGN KEY (`font_group_id`) REFERENCES `font_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
