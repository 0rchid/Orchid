-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 26, 2017 at 04:39 AM
-- Server version: 5.6.35
-- PHP Version: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

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
  `title` text NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user`, `title`, `content`) VALUES
(2, 'andy.craig@ucc.on.ca', '', 'This chicken soup is delicious');

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
(7, 'Andy', 'adc30a397b8fd07f80d7ce85b37107a464e4b067154a36012f042ddb6006144d', '1e5891e63237ba90', 'andy.craig@ucc.on.ca'),
(8, 'Andy_Craig', '673e4e0d19311dbf8fd6d563fda34f85f303ea29dc26b7ad31568527bc3d48b2', '26dde57e14cdb83b', 'andypandy.craig@gmail.com'),
(9, 'test', '02ad384e2c100bd7887ff62b7689d9ef3f87cbc776aefaa158fd2366bb582361', '39e763f644e4829c', 'test@test.com'),
(10, 'cool', 'c2461c058c07037464ce142135dde387e238f50b515e335413585a7ef219d95a', '26d03d9042001032', 'cool@gmail.com'),
(11, 'good', 'fc8b239196db567a81c2cd41e300a9729f8591be24ecfa36a59d7ba44e7233ed', '532742496383494b', 'good@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
