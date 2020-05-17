-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2016 at 06:36 PM
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aegeancommunity`
--

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date DEFAULT NULL,
  `Title` varchar(255) NOT NULL,
  `Author` varchar(255) NOT NULL,
  `linkPDF` varchar(255) DEFAULT NULL,
  `FilePDF` blob,
  `Category` varchar(255) NOT NULL,
  `Description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `user_id`, `email`, `StartDate`, `EndDate`, `Title`, `Author`, `linkPDF`, `FilePDF`, `Category`, `Description`) VALUES
(12, 5, 'chainicko@gmail.com', '2016-06-20', '2017-03-14', 'C++', 'Dietel and Dietel', 'cplusplus.com', '', 'Science Article', 'C++ Book Edition 2017 '),
(13, 5, 'chainicko@gmail.com', '2018-03-20', '2019-03-20', 'Python', 'Dietel and Dietel', 'python.com', '', 'Science Article', 'py for Python'),
(14, 5, 'chainicko@gmail.com', '2012-09-12', '2012-09-15', 'Java', 'Nick', 'java.com', '', 'Science Article', 'Grafoume vivlio gia java !!!'),
(15, 5, 'chainicko@gmail.com', '2013-09-12', '2013-09-15', 'Ruby', 'Peppas', 'ruby.com', '', 'Science Article', 'Ruby on Rails !!!!'),
(16, 6, 'kostgiak@gmail.com', '2016-05-21', '2016-05-22', 'Azucar', 'Stratis', 'party.com/pdf', '', 'Other', 'disco disco partizani'),
(18, 5, 'chainicko@gmail.com', '2012-09-12', '2012-09-15', 'new', 'Nick', '', 0x50726f6a6563742e706466, 'Science Article', 'Perigrafiii!!!!!'),
(19, 14, 'francis@president.com', '2016-10-10', '2020-10-10', 'Anything for America', 'Francis J. Underwood', 'https://www.fu2016.com/', '', 'Public Authority', 'America Works'),
(20, 7, 'icsd12200@aegean.icsd.com', '2016-06-05', '2016-06-06', 'Exams', 'Maragkoudakis', 'http://www.icsd.aegean.gr/', '', 'Science Article', 'Web Programming');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `Gender` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `avatar` longblob,
  `Expertise` varchar(255) DEFAULT NULL,
  `Position` varchar(255) DEFAULT NULL,
  `BusinessP1` varchar(255) DEFAULT NULL,
  `BusinessP2` varchar(255) DEFAULT NULL,
  `BusinessP3` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `job` varchar(255) DEFAULT NULL,
  `degree1` varchar(255) DEFAULT NULL,
  `degree2` varchar(255) DEFAULT NULL,
  `degree3` varchar(255) DEFAULT NULL,
  `language1` varchar(255) DEFAULT NULL,
  `language2` varchar(255) DEFAULT NULL,
  `language3` varchar(255) DEFAULT NULL,
  `Rank` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `name`, `surname`, `Gender`, `nationality`, `city`, `avatar`, `Expertise`, `Position`, `BusinessP1`, `BusinessP2`, `BusinessP3`, `company`, `job`, `degree1`, `degree2`, `degree3`, `language1`, `language2`, `language3`, `Rank`) VALUES
(1, 'kostpep', 'kostopep@yahoo.gr', '02d0521799b544e1c1d848a8d31c5260ad61e34d', 'Konstantinos', 'Peppas', 'Male', 'Greece', 'Kriti, Island', 0x6e6f6f62206f6620746865206461792e6a7067, 'Science', 'CEO', 'Chief', '', '', 'Riot', 'Multinational Company', 'University Degree', 'Master', '', 'EN C2', 'FR C2', 'IT B2', 55),
(5, 'chainicko', 'chainicko@gmail.com', '02d0521799b544e1c1d848a8d31c5260ad61e34d', 'Nickolas', 'Chaikalis', 'Male', 'Greece', 'Zakynthos, Island', 0x4d617276696e5468654d61727469616e2e6a7067, 'Science', 'CEO', 'Manager', 'Chief', '', 'Apple', 'Multinational Company', 'University Degree', 'Master', '', 'EN C2', 'FR C2', 'IT C1', 65),
(6, 'giaku', 'kostgiak@gmail.com', '02d0521799b544e1c1d848a8d31c5260ad61e34d', 'Konstantinos', 'Giakoumidakis', 'Male', 'Greece', 'Kriti, Island', 0x736d696c65312e6a7067, 'SocialAdministration', 'CEO', 'Manager', 'Academic', '', 'Facebook', 'Multinational Company', 'University Degree', 'Master', 'PhD', 'EN C2', 'FR C2', 'IT C2', 80),
(7, 'icsd12200', 'icsd12200@aegean.icsd.com', '02d0521799b544e1c1d848a8d31c5260ad61e34d', 'icsd', 'Aegean', 'Female', 'Greece', 'Samos, Island', 0x6c696e75782d70656e6775696e2d6a6564692e6a7067, 'Science', 'Hacker', 'Manager', 'Academic', 'Chief', 'University of the Aegean', 'Civil Servant', 'University Degree', 'Master', 'PhD', 'EN C2', 'FR C2', 'IT C2', 90),
(8, 'ninjaturtule', 'hinick@windowslive.com', '6542fd4dbad370ffc59dcf599c213595de703d17', 'Michelangelo', 'Splinter', 'Male', 'USA', 'New York, Manhattan', 0x4d696368656c616e67656c6f2e6a7067, 'SocialAdministration', 'Senior Securiry Manager', 'Manager', 'Chief', 'Self Employee', 'Mirage Studios', 'Non-Governmental Organization', '', '', '', 'GR C2', ' ', ' ', 35),
(9, 'peppas', 'peppas@kostpep.gr', '6542fd4dbad370ffc59dcf599c213595de703d17', 'Peppas', 'Konstantinos', 'Male', 'Greece', 'Kriti, Rethimno, Island', 0x6d616e616765722e6a7067, 'Arts', 'Coach', 'Manager', '', '', 'Liverpool', 'Multinational Company', 'University Degree', 'Master', 'PhD', 'EN C2', 'GR C2', 'IT C2', 70),
(10, 'Kaja', 'Kaja1@gmail.com', '02d0521799b544e1c1d848a8d31c5260ad61e34d', 'Kaja', 'Kajaswe', 'Female', 'Swedish', 'Stockholm', 0x536b696c6f73206d65204b61736b6f6c206b206769616c69612070696c6f74752e6a7067, 'Humanities', 'CEO', 'Chief', '', '', 'Twitter', 'Multinational Company', 'University Degree', 'Master', 'PhD', 'EN C2', 'FR C2', ' ', 65),
(13, 'Shady', '123@gmail.com', '02d0521799b544e1c1d848a8d31c5260ad61e34d', 'Mike', 'Taylor', 'Male', 'England', 'Nottingham', 0x61706f206b696f2e6a7067, 'Arts', 'Chef', 'Chief', '', '', 'Ratatouille', 'Middle-class Business', '', '', '', 'EN C2', 'FR C1', 'GR B2', 25),
(14, 'Francis', 'francis@president.com', '02d0521799b544e1c1d848a8d31c5260ad61e34d', 'Francis J.', 'Underwood', 'Male', 'USA', 'Gaffney, South Carolina', 0x6672616e6369732e6a7067, 'Science', 'President', 'Manager', 'Academic', 'Chief', 'Democrats', 'Civil Servant', 'University Degree', 'Master', 'PhD', 'GR C2', 'FR C2', 'IT C1', 90),
(15, 'Claire', 'clairevp@gmail.com', '02d0521799b544e1c1d848a8d31c5260ad61e34d', 'Claire', 'Hale Underwood', 'Female', 'USA', 'Dallas, Texas', 0x636c616972652e6a7067, 'Humanities', 'Vice President', 'Manager', '', '', 'Democrats', 'Civil Servant', 'University Degree', 'Master', 'PhD', 'GR C2', 'FR C2', ' ', 65),
(16, 'Unknown', 'unknown@gmail.com', '02d0521799b544e1c1d848a8d31c5260ad61e34d', 'Unknown', 'Unknown', '', 'Unknown', 'Unknown', 0x556e6b6e6f776e2e676966, '', 'Unknown', '', '', '', 'Unknown', '', '', '', '', ' ', ' ', ' ', 0),
(17, 'MrRobot', 'mrrobot@gmail.com', '02d0521799b544e1c1d848a8d31c5260ad61e34d', 'Elliot', 'Anderson', 'Male', 'USA', 'New York', 0x656c6c696f742e6a7067, 'Science', 'Hacker', 'Chief', '', '', 'All Safe', 'Multinational Company', 'University Degree', 'Master', '', 'EN C2', 'FR C2', ' ', 50);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
