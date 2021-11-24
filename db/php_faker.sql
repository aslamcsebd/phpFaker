-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2021 at 10:45 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_faker`
--

-- --------------------------------------------------------

--
-- Table structure for table `faker_category`
--

CREATE TABLE `faker_category` (
  `id` bigint(20) NOT NULL,
  `name` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faker_category`
--

INSERT INTO `faker_category` (`id`, `name`, `status`) VALUES
(1, 'Base', 1),
(2, 'Lorem', 1),
(3, 'Person', 1),
(4, 'Address', 1),
(5, 'PhoneNumber', 1),
(6, 'Company', 1),
(7, 'DateTime', 1),
(8, 'Internet', 1),
(9, 'Payment', 1),
(10, 'Color', 1),
(11, 'File', 1),
(12, 'Image', 1),
(13, 'Barcode', 1),
(14, 'Miscellaneous', 1),
(15, 'HtmlLorem', 0);

-- --------------------------------------------------------

--
-- Table structure for table `faker_type`
--

CREATE TABLE `faker_type` (
  `id` bigint(20) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `name` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faker_type`
--

INSERT INTO `faker_type` (`id`, `category_id`, `name`, `status`) VALUES
(1, 1, 'randomNumber', 1),
(2, 1, 'randomFloat', 1),
(3, 1, 'randomLetter', 1),
(4, 2, 'word', 1),
(5, 2, 'sentence', 1),
(6, 2, 'paragraph', 1),
(7, 2, 'text', 1),
(8, 3, 'name', 1),
(9, 4, 'city', 1),
(10, 4, 'state', 1),
(11, 4, 'postcode', 1),
(12, 4, 'address', 1),
(13, 4, 'country', 1),
(14, 4, 'latitude', 1),
(15, 4, 'longitude', 1),
(16, 5, 'phoneNumber', 1),
(17, 6, 'company', 1),
(18, 6, 'jobTitle', 1),
(19, 7, 'unixTime', 1),
(20, 7, 'date', 1),
(21, 7, 'time', 1),
(22, 7, 'amPm', 1),
(23, 7, 'dayOfWeek', 1),
(24, 7, 'monthName', 1),
(25, 7, 'year', 1),
(26, 7, 'timezone', 1),
(27, 8, 'email', 1),
(28, 8, 'userName', 1),
(29, 8, 'password', 1),
(30, 8, 'url', 1),
(31, 8, 'slug', 1),
(32, 8, 'macAddress', 1),
(33, 9, 'creditCardType', 1),
(34, 9, 'creditCardNumber', 1),
(35, 9, 'bankAccountNumber', 1),
(36, 9, 'creditCardExpirationDateString', 1),
(37, 9, 'iban', 1),
(38, 9, 'swiftBicNumber', 1),
(39, 10, 'hexcolor', 1),
(40, 10, 'rgbcolor', 1),
(41, 10, 'rgbCssColor', 1),
(42, 10, 'safeColorName', 1),
(43, 10, 'colorName', 1),
(44, 11, 'fileExtension', 1),
(45, 12, 'imageUrl', 1),
(46, 12, 'image', 1),
(47, 12, 'Uuid', 1),
(48, 13, 'ean13', 1),
(49, 13, 'ean8', 1),
(50, 13, 'isbn13', 1),
(51, 13, 'isbn10', 1),
(52, 14, 'boolean', 1),
(53, 14, 'md5', 1),
(54, 14, 'sha1', 1),
(55, 14, 'sha256', 1),
(56, 14, 'locale', 1),
(57, 14, 'countryCode', 1),
(58, 14, 'languageCode', 1),
(59, 14, 'currencyCode', 1),
(60, 14, 'emoji', 1),
(61, 15, 'randomHtml', 1),
(62, 3, 'ssn', 1),
(63, 2, 'realText', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `faker_category`
--
ALTER TABLE `faker_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faker_type`
--
ALTER TABLE `faker_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `faker_category`
--
ALTER TABLE `faker_category`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `faker_type`
--
ALTER TABLE `faker_type`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
