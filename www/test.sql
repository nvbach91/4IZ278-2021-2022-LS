-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2022 at 02:04 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `gx`
--

CREATE TABLE `gx` (
  `gx_id` int(25) NOT NULL,
  `name` varchar(255) NOT NULL,
  `size` int(255) NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gx`
--

INSERT INTO `gx` (`gx_id`, `name`, `size`, `image`) VALUES
(1, 'Big Galaxy', 100, 'https://scitechdaily.com/images/Milky-Way-Galaxy-Artists-Conception.jpg'),
(2, 'Small galaxy', 50, 'https://images.newscientist.com/wp-content/uploads/2020/05/22112120/sagdig_opo0431b_web.jpg'),
(3, 'Far far away galaxy', 500, 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c3/NGC_4414_%28NASA-med%29.jpg/1200px-NGC_4414_%28NASA-med%29.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ss`
--

CREATE TABLE `ss` (
  `ss_id` int(25) NOT NULL,
  `name` varchar(255) NOT NULL,
  `3d_gps` varchar(255) NOT NULL,
  `image` varchar(200) NOT NULL,
  `gx_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ss`
--

INSERT INTO `ss` (`ss_id`, `name`, `3d_gps`, `image`, `gx_id`) VALUES
(1, 'Skylab', '1, 2, 3', 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/07/Skylab_%28SL-4%29.jpg/360px-Skylab_%28SL-4%29.jpg', 1),
(2, 'Mir', '4, 5, 6', 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/09/Mir_Space_Station_viewed_from_Endeavour_during_STS-89.jpg/360px-Mir_Space_Station_viewed_from_Endeavour_during_STS-89.jpg', 2),
(3, 'Death Star', '7, 8, 9', 'https://static.wikia.nocookie.net/starwars/images/9/9d/DSI_hdapproach.png/revision/latest?cb=20130221005853', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gx`
--
ALTER TABLE `gx`
  ADD PRIMARY KEY (`gx_id`);

--
-- Indexes for table `ss`
--
ALTER TABLE `ss`
  ADD PRIMARY KEY (`ss_id`),
  ADD KEY `FK_gx` (`gx_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gx`
--
ALTER TABLE `gx`
  MODIFY `gx_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ss`
--
ALTER TABLE `ss`
  MODIFY `ss_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ss`
--
ALTER TABLE `ss`
  ADD CONSTRAINT `FK_gx` FOREIGN KEY (`gx_id`) REFERENCES `gx` (`gx_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
