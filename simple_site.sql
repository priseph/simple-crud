-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2018 at 04:52 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simple_site`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `post` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `name`, `email`, `post`, `comment`, `created`) VALUES
(1, 'prince ekpenyong', 'donchizy@gmail.com', '39', '', '2018-10-18 13:51:32'),
(2, 'prince ekpenyong', 'donchizy@gmail.com', '39', '', '2018-10-18 13:59:52'),
(3, 'prince ekpenyong', 'donchizy@gmail.com', '39', 'this is the comment section', '2018-10-18 14:04:12'),
(4, 'Alibaba', 'the@email.com', '\r\nNotice:  Trying to get property \'id\' of non-object in C:\\xampp\\htdocs\\upwork\\simple-site\\view-post.php on line 120\r\n', 'this is alibaba comment', '2018-10-18 15:18:54'),
(5, 'ali2', 'ali3@gmail.com', '\r\nNotice:  Trying to get property \'id\' of non-object in C:\\xampp\\htdocs\\upwork\\simple-site\\view-post.php on line 120\r\n', 'this na alibaba the second', '2018-10-18 15:21:39'),
(6, 'emy', 'emy@jane.me', '39', 'this is it', '2018-10-18 15:32:40');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `type_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `name`, `description`, `image`, `type_id`, `created`, `modified`) VALUES
(39, 'WHY CHOOSE US', 'cos we are fun to be with', '7ab1eabf52b12e5c37051447a73c4ead6b111488-about_2.jpg', 1, '2018-10-18 12:52:29', '2018-10-18 10:52:29');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Photo', '2018-10-18 00:35:07', '2018-10-18 16:34:33'),
(2, 'Video', '2018-10-18 00:35:07', '2018-10-18 16:34:33'),
(3, 'Text', '2018-10-18 00:35:07', '2018-10-18 16:34:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
