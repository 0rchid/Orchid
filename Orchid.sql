-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 01, 2017 at 05:17 PM
-- Server version: 5.6.35
-- PHP Version: 7.0.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Orchid`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user` text NOT NULL,
  `hashtag` text NOT NULL,
  `content` text NOT NULL,
  `timedate` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user`, `hashtag`, `content`, `timedate`) VALUES
(13, 'andy.craig@ucc.on.ca', '', 'cool', ''),
(15, 'andy.craig@ucc.on.ca', '', 'great', ''),
(16, 'andy.craig@ucc.on.ca', '', 'b8', ''),
(18, 'douglas.byers@ucc.on.ca', '#test', 'should show up', ''),
(19, 'douglas.byers@ucc.on.ca', '', 'kjhaslfdhjkasd', ''),
(20, 'douglas.byers@ucc.on.ca', '#test', 'test2', ''),
(21, 'douglas.byers@ucc.on.ca', '#best', 'best', ''),
(22, 'douglas.byers@ucc.on.ca', '#test', 'gadjshkfghsd', ''),
(23, 'doug', '#test', 'asdfhkjasldf', ''),
(24, 'doug', '#test', 'Test', ''),
(25, 'doug', '#post', '#post', ''),
(26, 'doug', '#hashtag', 'Content', ''),
(27, 'doug', '#test', 'Another test', ''),
(28, 'Doug', '#test', 'Yet another test', ''),
(29, 'Doug', '#kais', 'Kais post', ''),
(31, 'joe', '#joe', 'Some content', ''),
(32, 'Doug', '#time', 'Time test', 'April 29, 2017 at 6:59 pm'),
(33, 'Doug', '#time', 'Time test 2', 'April 29, 2017 at 7:00 pm'),
(35, 'Doug', '#time', 'Time test 3', 'April 29, 2017 at 7:07 pm'),
(36, 'Doug', '#time', 'Time test 4', 'April 29, 2017 at 7:13 pm'),
(37, 'Doug', '#time', 'Final time test', 'April 29, 2017 at 7:21 pm'),
(38, 'Doug', '#time', 'Last last time test', 'April 29, 2017 at 8:04 pm'),
(39, 'Doug', '#hashtag', 'Hashtag search test', 'April 29, 2017 at 8:06 pm'),
(40, 'Doug', '#aws', 'Online AWS test', 'April 29, 2017 at 10:06 pm'),
(41, 'goob', '', 'Omg this is greay', 'April 30, 2017 at 11:17 am'),
(42, 'Doug', '#hackerman', 'Hackerman hacked into dougs account', 'April 30, 2017 at 11:19 am'),
(44, 'erac', '', '\" ', 'May 1, 2017 at 10:53 am'),
(46, 'Maximus', '#maxsucks', 'I am a noob', 'May 1, 2017 at 12:31 pm'),
(48, '@TheRealDougOfficial', '#kaisislife', 'im doug kais is better than me at comp sci signed testemony idk how to spel', 'May 1, 2017 at 1:03 pm'),
(49, 'BobBarker', '#PriceIsWrong', 'hello fools', 'May 1, 2017 at 1:08 pm');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `bio` text NOT NULL,
  `user` text NOT NULL,
  `website` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` char(64) COLLATE utf8_unicode_ci NOT NULL,
  `salt` char(16) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`, `email`) VALUES
(4, 'joe', '2da8829d571c7eb4fe0d16b699f4f85f873b7b042a763afa13449264bb4017ca', '37ef77e53bf3e4f0', 'joe@blow.com'),
(12, 'Doug', 'ae4278856e36fe8175b2178bbd4f97f9a03f34d4ac79041c0368895752368e5d', '7b86f17860d9d680', 'douglas.byers@ucc.on.ca'),
(13, 'awstest', '0f06fab5f0c9b56d7187043f937b043e686473445abd8e11243d073579337a41', '67a133a126ec3859', 'aws@test.com'),
(14, 'goob', '8ec0946177a9cb2a846e23b93b73e4dd3977dab84a5711621849dbe36acad2dc', '7db3054b2f2f806f', 'goob@goob.com'),
(15, 'Skene', 'ef4b9e98144f6e0d63efb45fbc662e9db8ce6bed6b3b874b19e100f5e4566236', '286dde231f7d521', 'skeneacus@gmail.com'),
(16, 'erac', '7351d75f35f388468360a6480c675be03cec4168ea6a7b0eea7701adf8f9e912', '786152b44e85ff5f', 'eric@email.com'),
(17, 'Maximus', '2ed3b3ce2f494410a4f9d923705b1153b364d4c7bca75e8200be97596d676047', '6ac26d2d3c7dd7a2', 'max@gmail.com'),
(18, '@TheRealDougOfficial', 'd60e70f6ed180a27a33f4b11ddb9a2f6941990a95f6479e9160c843ac27cf9d2', '6cbb5bb37ae4b48d', 'Fakemail123@gmail.boi'),
(19, 'BobBarker', 'a2a5b3cd09cf9eef66e0a1358fc6f1298d023bf21e0055f82ed8f3b6fec784e9', '52461116768b5246', 'adam.zufferli@ucc.on.ca');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
