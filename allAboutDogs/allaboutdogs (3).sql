-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2018 at 07:51 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `allaboutdogs`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `booksId` int(11) NOT NULL AUTO_INCREMENT,
  `catId` int(11) DEFAULT NULL,
  `brandId` int(11) DEFAULT NULL,
  `writerId` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text,
  `images` text,
  PRIMARY KEY (`booksId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`booksId`, `catId`, `brandId`, `writerId`, `title`, `description`, `images`) VALUES
(9, 17, 19, 13, 'The Ultimate Guide to Living with a Happy, Healthy Dog', '<a href="https://www.amazon.com/Member-Family-Ultimate-Living-Healthy/dp/0307409031">See how to buy a book</a>', 'cezar1.jpg'),
(10, 17, 20, 13, 'How to Raise the Perfect Dog', '<a href="https://www.amazon.com/How-Raise-Perfect-Dog-Puppyhood/dp/0307461300/ref=asap_bc?ie=UTF8">See how to buy a book</a>', 'cez.jpg'),
(11, 18, 21, 14, 'The Bedtime Book for Dogs', '<a href="https://www.amazon.com/Bedtime-Book-Dogs-Bruce-Littlefield/dp/B00A19TC68">See how to buy a book</a>', 'badtime.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `brandbooks`
--

CREATE TABLE IF NOT EXISTS `brandbooks` (
  `brandId` int(11) NOT NULL AUTO_INCREMENT,
  `title` text,
  PRIMARY KEY (`brandId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `brandbooks`
--

INSERT INTO `brandbooks` (`brandId`, `title`) VALUES
(19, 'A Member of the Family'),
(20, 'How to Raise the Perfect Dog'),
(21, 'The Bedtime Book for Dogs');

-- --------------------------------------------------------

--
-- Table structure for table `categorybooks`
--

CREATE TABLE IF NOT EXISTS `categorybooks` (
  `catId` int(11) NOT NULL AUTO_INCREMENT,
  `title` text,
  PRIMARY KEY (`catId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `categorybooks`
--

INSERT INTO `categorybooks` (`catId`, `title`) VALUES
(17, 'Education'),
(18, 'Charming story');

-- --------------------------------------------------------

--
-- Table structure for table `comm`
--

CREATE TABLE IF NOT EXISTS `comm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usersId` int(11) DEFAULT NULL,
  `txt` text,
  `realdate` datetime DEFAULT NULL,
  `parentId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `comm`
--

INSERT INTO `comm` (`id`, `usersId`, `txt`, `realdate`, `parentId`) VALUES
(6, 14, 'FIN SAJT', '2018-03-07 08:14:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dogwalker`
--

CREATE TABLE IF NOT EXISTS `dogwalker` (
  `walkerId` int(11) NOT NULL AUTO_INCREMENT,
  `fullName` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `email` text,
  `description` text,
  `images` text,
  PRIMARY KEY (`walkerId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `dogwalker`
--

INSERT INTO `dogwalker` (`walkerId`, `fullName`, `age`, `phone`, `email`, `description`, `images`) VALUES
(4, 'Teodora Jelic', 26, 634455777, 'tea@gmail.com', 'Zdravo, ja sam iz Novog Sada, ali vec godina zivim u Boegradu. Zavrsila sam knjizevnost, master, sada sam na doktorskim. Veliki sam ljubitelj zivotinja. Setnja po satu je 250 dinara. Za grupne senje naplacujem 300 dinara po psu. Za cuvanje pasa ceo dan ili vise dana cena jepo dogovoru.', 'w.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `stories`
--

CREATE TABLE IF NOT EXISTS `stories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(100) DEFAULT NULL,
  `txt` text,
  `date` datetime DEFAULT NULL,
  `img` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `stories`
--

INSERT INTO `stories` (`id`, `author`, `txt`, `date`, `img`) VALUES
(32, 'Dejvi', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer fermentum felis at condimentum porttitor. Sed tortor nisl, varius eu venenatis at, imperdiet nec libero. Etiam vehicula quam vel purus posuere, a volutpat sem facilisis. Quisque nec magna et ante varius sagittis id ut justo. Aliquam lorem arcu, ultrices ut velit a, dictum aliquam nisl. Proin tempor turpis id risus lacinia, id posuere lorem tincidunt. Phasellus luctus lobortis convallis.\r\n\r\nPraesent nec commodo erat. Quisque ut augue pharetra lectus viverra pharetra. Sed vel diam quis risus consequat bibendum. Aliquam eu orci ut orci aliquet tincidunt. Ut mattis fermentum eros a sollicitudin. Nullam a pharetra libero. Quisque nunc felis, venenatis non tempor quis, consectetur nec mauris. Curabitur sed nunc nulla.', '2017-08-21 14:23:48', '1.jpg'),
(33, 'Joan', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer fermentum felis at condimentum porttitor. Sed tortor nisl, varius eu venenatis at, imperdiet nec libero. Etiam vehicula quam vel purus posuere, a volutpat sem facilisis. Quisque nec magna et ante varius sagittis id ut justo. Aliquam lorem arcu, ultrices ut velit a, dictum aliquam nisl. Proin tempor turpis id risus lacinia, id posuere lorem tincidunt. Phasellus luctus lobortis convallis.\r\n\r\nPraesent nec commodo erat. Quisque ut augue pharetra lectus viverra pharetra. Sed vel diam quis risus consequat bibendum. Aliquam eu orci ut orci aliquet tincidunt. Ut mattis fermentum eros a sollicitudin. Nullam a pharetra libero. Quisque nunc felis, venenatis non tempor quis, consectetur nec mauris. Curabitur sed nunc nulla.', '2017-08-21 14:24:23', '2.jpg'),
(34, 'susan', 'Praesent eget ultrices diam. In fermentum lorem at pharetra cursus. Quisque vehicula metus eros, sed aliquet massa rutrum sit amet. Donec vel purus dapibus ex efficitur convallis. Pellentesque sed sapien sapien. Pellentesque non efficitur enim, non accumsan sapien. Mauris pellentesque risus eu placerat aliquam. Sed nec malesuada quam. Ut ultricies mauris in lorem malesuada suscipit ut in nunc.\r\n\r\nSuspendisse porttitor est turpis, ac condimentum est iaculis sit amet. Fusce hendrerit imperdiet eros a auctor. Donec lorem magna, aliquam nec nulla vel, vestibulum ultrices ex. Duis fermentum cursus dolor. Vestibulum eros mauris, laoreet congue nisl sit amet, ultrices ultricies lorem. Proin vitae dolor varius, gravida sapien ut, gravida urna. Aliquam pharetra luctus metus, at blandit dolor congue et.\r\n\r\nNullam lobortis ut eros nec dictum. Aenean dapibus sit amet libero vitae commodo. Phasellus nec urna non orci aliquet mollis. Aenean quis pellentesque lacus. Quisque turpis ipsum, hendrerit et nunc non, mattis commodo nisl. Quisque sed nunc ac ante consequat mattis. In auctor iaculis nulla, nec volutpat elit hendrerit sed. Nulla a accumsan massa. Phasellus faucibus egestas consectetur.', '2017-08-21 14:25:30', '3.jpg'),
(35, 'Ivana', 'Praesent eget ultrices diam. In fermentum lorem at pharetra cursus. Quisque vehicula metus eros, sed aliquet massa rutrum sit amet. Donec vel purus dapibus ex efficitur convallis. Pellentesque sed sapien sapien. Pellentesque non efficitur enim, non accumsan sapien. Mauris pellentesque risus eu placerat aliquam. Sed nec malesuada quam. Ut ultricies mauris in lorem malesuada suscipit ut in nunc.\r\n\r\nSuspendisse porttitor est turpis, ac condimentum est iaculis sit amet. Fusce hendrerit imperdiet eros a auctor. Donec lorem magna, aliquam nec nulla vel, vestibulum ultrices ex. Duis fermentum cursus dolor. Vestibulum eros mauris, laoreet congue nisl sit amet, ultrices ultricies lorem. Proin vitae dolor varius, gravida sapien ut, gravida urna. Aliquam pharetra luctus metus, at blandit dolor congue et.\r\n\r\nNullam lobortis ut eros nec dictum. Aenean dapibus sit amet libero vitae commodo. Phasellus nec urna non orci aliquet mollis. Aenean quis pellentesque lacus. Quisque turpis ipsum, hendrerit et nunc non, mattis commodo nisl. Quisque sed nunc ac ante consequat mattis. In auctor iaculis nulla, nec volutpat elit hendrerit sed. Nulla a accumsan massa. Phasellus faucibus egestas consectetur.', '2017-08-21 14:25:51', 'dogs.jpg'),
(36, 'Nikola', 'Praesent eget ultrices diam. In fermentum lorem at pharetra cursus. Quisque vehicula metus eros, sed aliquet massa rutrum sit amet. Donec vel purus dapibus ex efficitur convallis. Pellentesque sed sapien sapien. Pellentesque non efficitur enim, non accumsan sapien. Mauris pellentesque risus eu placerat aliquam. Sed nec malesuada quam. Ut ultricies mauris in lorem malesuada suscipit ut in nunc.\r\n\r\nSuspendisse porttitor est turpis, ac condimentum est iaculis sit amet. Fusce hendrerit imperdiet eros a auctor. Donec lorem magna, aliquam nec nulla vel, vestibulum ultrices ex. Duis fermentum cursus dolor. Vestibulum eros mauris, laoreet congue nisl sit amet, ultrices ultricies lorem. Proin vitae dolor varius, gravida sapien ut, gravida urna. Aliquam pharetra luctus metus, at blandit dolor congue et.\r\n\r\nNullam lobortis ut eros nec dictum. Aenean dapibus sit amet libero vitae commodo. Phasellus nec urna non orci aliquet mollis. Aenean quis pellentesque lacus. Quisque turpis ipsum, hendrerit et nunc non, mattis commodo nisl. Quisque sed nunc ac ante consequat mattis. In auctor iaculis nulla, nec volutpat elit hendrerit sed. Nulla a accumsan massa. Phasellus faucibus egestas consectetur.', '2017-08-21 14:28:00', '5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `usersId` int(11) NOT NULL AUTO_INCREMENT,
  `fName` varchar(50) DEFAULT NULL,
  `lName` varchar(50) DEFAULT NULL,
  `nName` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `pass` varchar(50) DEFAULT NULL,
  `images` text,
  `role` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`usersId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usersId`, `fName`, `lName`, `nName`, `email`, `pass`, `images`, `role`) VALUES
(3, 'slavisa', 'zdravkovic', 'slavko', 'zdravkovic.slavisa89@gmail.com', '698d51a19d8a121ce581499d7b701668', '2.jpg', 'admin'),
(12, 'jovana', 'jovana', 'jovana96', 'jocynight@gmail.com', 'bcbe3365e6ac95ea2c0343a2395834dd', '3.jpg', NULL),
(13, 'slavisa', 'zdravkovic', 'slavko', 'z345ftr@gmail.com', 'cdaeb1282d614772beb1e74c192bebda', 'logo.jpg', NULL),
(14, 'Dejan', 'Dejanic', 'Dejo', 'd@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'm9.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `writerbooks`
--

CREATE TABLE IF NOT EXISTS `writerbooks` (
  `writerId` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` text,
  PRIMARY KEY (`writerId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `writerbooks`
--

INSERT INTO `writerbooks` (`writerId`, `fullname`) VALUES
(13, 'Cesar Milan'),
(14, 'Bruce Littlefield');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
