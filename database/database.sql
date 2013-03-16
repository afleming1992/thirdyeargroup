-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 08, 2013 at 12:54 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `thirdyeargroup`
--

-- --------------------------------------------------------

--
-- Table structure for table `hurdles_competitors`
--

CREATE TABLE IF NOT EXISTS `hurdles_competitors` (
  `hurdlerID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tournamentId` bigint(20) unsigned NOT NULL,
  `hurdlerName` varchar(200) DEFAULT NULL,
  `hurdlerGender` varchar(1) DEFAULT NULL,
  `hurdlerPerformance` double DEFAULT NULL,
  `contactName` varchar(200) DEFAULT NULL,
  `contactNumber` varchar(11) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `dateOfBirth` date DEFAULT NULL,
  `hurdlerLastName` varchar(100) DEFAULT NULL,
  `streetName` varchar(100) DEFAULT NULL,
  `houseNumber` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `postcode` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`hurdlerID`),
  UNIQUE KEY `hurdlerID` (`hurdlerID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hurdle_heats`
--

CREATE TABLE IF NOT EXISTS `hurdle_heats` (
  `heatID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tournamentID` bigint(20) unsigned NOT NULL,
  `heatTime` time DEFAULT NULL,
  `heatDate` date DEFAULT NULL,
  `stage` int(11) DEFAULT NULL,
  PRIMARY KEY (`heatID`),
  UNIQUE KEY `heatID` (`heatID`),
  KEY `fk_hurdleheat_tournament` (`tournamentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hurdle_laneallocation`
--

CREATE TABLE IF NOT EXISTS `hurdle_laneallocation` (
  `heatID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `laneID` tinyint(4) NOT NULL DEFAULT '0',
  `hurdlerID` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`heatID`,`laneID`),
  UNIQUE KEY `heatID` (`heatID`),
  KEY `fk_hurdlelanealloc_hurdlecompetitor` (`hurdlerID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hurdle_results`
--

CREATE TABLE IF NOT EXISTS `hurdle_results` (
  `resultID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `heatID` bigint(20) unsigned NOT NULL,
  `hurdlerID` bigint(20) unsigned NOT NULL,
  `position` int(11) DEFAULT NULL,
  `time` double DEFAULT NULL,
  PRIMARY KEY (`resultID`),
  UNIQUE KEY `resultID` (`resultID`),
  KEY `fk_hurdleresult_hurdleheat` (`heatID`),
  KEY `fk_hurdlerrsult_hurdlecompetitor` (`hurdlerID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE IF NOT EXISTS `properties` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `concessionPrice` double DEFAULT NULL,
  `adultPrice` double DEFAULT NULL,
  `ticketLimit` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `concessionPrice`, `adultPrice`, `ticketLimit`) VALUES
(1, 3, 5, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `manager` tinyint(1) NOT NULL,
  `email` varchar(30) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`username`, `password`, `name`, `manager`, `email`) VALUES
('admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Administrator', 1, ''),
('andrew', '3d13459c359f2935beba320cee897e92362cb014', 'Andrew Fleming', 0, 'ajf9@hw.ac.uk');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE IF NOT EXISTS `ticket` (
  `ticketID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `bookingID` bigint(20) unsigned NOT NULL,
  `methodOfSale` varchar(100) DEFAULT NULL,
  `dateOfTicket` date DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `type` varchar(30) NOT NULL,
  PRIMARY KEY (`ticketID`),
  UNIQUE KEY `ticketID` (`ticketID`),
  KEY `fk_ticket_ticketsale` (`bookingID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=59 ;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticketID`, `bookingID`, `methodOfSale`, `dateOfTicket`, `status`, `type`) VALUES
(25, 10, 'pickup', '2013-04-01', 'NOT COLLECTED', 'adult'),
(26, 10, 'pickup', '2013-04-01', 'NOT COLLECTED', 'adult'),
(27, 11, 'pickup', '2013-04-01', 'NOT COLLECTED', 'adult'),
(28, 11, 'pickup', '2013-04-01', 'NOT COLLECTED', 'adult'),
(29, 12, 'pickup', '2013-04-01', 'NOT COLLECTED', 'adult'),
(30, 12, 'pickup', '2013-04-01', 'NOT COLLECTED', 'adult'),
(31, 13, 'pickup', '2013-04-01', 'NOT COLLECTED', 'adult'),
(32, 13, 'pickup', '2013-04-01', 'NOT COLLECTED', 'adult'),
(33, 14, 'postal', '2013-04-01', 'NOT POSTED', 'concession'),
(34, 14, 'postal', '2013-04-01', 'NOT POSTED', 'concession'),
(35, 14, 'postal', '2013-04-01', 'NOT POSTED', 'concession'),
(36, 15, 'pickup', '2013-04-01', 'NOT COLLECTED', 'concession'),
(37, 15, 'pickup', '2013-04-01', 'NOT COLLECTED', 'concession'),
(38, 15, 'pickup', '2013-04-01', 'NOT COLLECTED', 'concession'),
(39, 16, 'pickup', '2013-04-01', 'NOT COLLECTED', 'adult'),
(40, 16, 'pickup', '2013-04-01', 'NOT COLLECTED', 'adult'),
(41, 16, 'pickup', '2013-04-01', 'NOT COLLECTED', 'adult'),
(42, 16, 'pickup', '2013-04-01', 'NOT COLLECTED', 'adult'),
(43, 16, 'pickup', '2013-04-01', 'NOT COLLECTED', 'adult'),
(44, 16, 'pickup', '2013-04-01', 'NOT COLLECTED', 'adult'),
(45, 16, 'pickup', '2013-04-01', 'NOT COLLECTED', 'adult'),
(46, 16, 'pickup', '2013-04-01', 'NOT COLLECTED', 'adult'),
(47, 16, 'pickup', '2013-04-01', 'NOT COLLECTED', 'adult'),
(48, 16, 'pickup', '2013-04-01', 'NOT COLLECTED', 'adult'),
(49, 16, 'pickup', '2013-04-01', 'NOT COLLECTED', 'concession'),
(50, 16, 'pickup', '2013-04-01', 'NOT COLLECTED', 'concession'),
(51, 16, 'pickup', '2013-04-01', 'NOT COLLECTED', 'concession'),
(52, 16, 'pickup', '2013-04-01', 'NOT COLLECTED', 'concession'),
(53, 16, 'pickup', '2013-04-01', 'NOT COLLECTED', 'concession'),
(54, 16, 'pickup', '2013-04-01', 'NOT COLLECTED', 'concession'),
(55, 16, 'pickup', '2013-04-01', 'NOT COLLECTED', 'concession'),
(56, 16, 'pickup', '2013-04-01', 'NOT COLLECTED', 'concession'),
(57, 16, 'pickup', '2013-04-01', 'NOT COLLECTED', 'concession'),
(58, 16, 'pickup', '2013-04-01', 'NOT COLLECTED', 'concession');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_sales`
--

CREATE TABLE IF NOT EXISTS `ticket_sales` (
  `bookingID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `transactionID` bigint(20) unsigned NOT NULL,
  `firstName` varchar(30) DEFAULT NULL,
  `surname` varchar(30) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address1` varchar(100) DEFAULT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `county` varchar(100) DEFAULT NULL,
  `postcode` varchar(10) DEFAULT NULL,
  `totalCost` double NOT NULL,
  PRIMARY KEY (`bookingID`),
  UNIQUE KEY `bookingID` (`bookingID`),
  KEY `fk_ticketsale_transaction` (`transactionID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `ticket_sales`
--

INSERT INTO `ticket_sales` (`bookingID`, `transactionID`, `firstName`, `surname`, `email`, `address1`, `address2`, `city`, `county`, `postcode`, `totalCost`) VALUES
(10, 19, 'Andrew', 'Fleming', 'ajf9@hw.ac.uk', '176 Redcraigs', '', 'Kirkcaldy', 'Fife', 'KY2 6UG', 0),
(11, 20, 'Andrew', 'Fleming', 'ajf9@hw.ac.uk', '176 Redcraigs', '', 'Kirkcaldy', 'Fife', 'KY2 6UG', 0),
(12, 21, 'Andrew', 'Fleming', 'ajf9@hw.ac.uk', '176 Redcraigs', '', 'Kirkcaldy', 'Fife', 'KY2 6UG', 0),
(13, 22, 'Andrew', 'Fleming', 'ajf9@hw.ac.uk', '176 Redcraigs', '', 'Kirkcaldy', 'Fife', 'KY2 6UG', 0),
(14, 23, 'Andrew', 'Fleming', 'ajf9@hw.ac.uk', '176 Redcraigs', '', 'Kirkcaldy', 'Fife', 'KY2 6UG', 0),
(15, 24, 'Andrew', 'Fleming', 'ajf9@hw.ac.uk', '176 Redcraigs', '', 'Kirkcaldy', 'Fife', 'KY2 6UG', 9),
(16, 25, 'Andrew', 'Fleming', 'ajf9@hw.ac.uk', '176 Redcraigs', '', 'Kirkcaldy', 'Fife', 'KY2 6UG', 80);

-- --------------------------------------------------------

--
-- Table structure for table `tournament`
--

CREATE TABLE IF NOT EXISTS `tournament` (
  `tournamentID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `registrationOpen` date DEFAULT NULL,
  `registrationClose` date DEFAULT NULL,
  PRIMARY KEY (`tournamentID`),
  UNIQUE KEY `tournamentID` (`tournamentID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tournament`
--

INSERT INTO `tournament` (`tournamentID`, `name`, `startDate`, `endDate`, `registrationOpen`, `registrationClose`) VALUES
(1, 'Annual Tournament', '2013-03-07', '2013-03-14', '2013-01-01', '2013-03-07');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
  `transactionID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nameOnCard` varchar(60) NOT NULL,
  `cardNumber` varchar(20) DEFAULT NULL,
  `cscNumber` int(11) DEFAULT NULL,
  `cardType` varchar(15) DEFAULT NULL,
  `validUntil` date DEFAULT NULL,
  PRIMARY KEY (`transactionID`),
  UNIQUE KEY `transactionID` (`transactionID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transactionID`, `nameOnCard`, `cardNumber`, `cscNumber`, `cardType`, `validUntil`) VALUES
(19, 'MR ANDREW FLEMING', '1234567890123456', 123, 'visa', '2013-11-01'),
(20, 'MR ANDREW FLEMING', '1234567890123456', 123, 'visa', '2013-11-01'),
(21, 'MR ANDREW FLEMING', '1234567890123456', 123, 'visa', '2013-11-01'),
(22, 'MR ANDREW FLEMING', '1234567890123456', 123, 'visa', '2013-11-01'),
(23, 'MR A FLEMING', '1234567890123456', 323, 'visa', '2013-11-01'),
(24, 'MR BRUCE FLEMING', '1234567890123456', 123, 'visa', '2013-12-01'),
(25, 'MR A FLEMING', '1234567890123456', 636, 'visa', '2013-12-01');

-- --------------------------------------------------------

--
-- Table structure for table `umpire`
--

CREATE TABLE IF NOT EXISTS `umpire` (
  `umpireID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `umpireName` varchar(200) DEFAULT NULL,
  `umpireEmail` varchar(200) DEFAULT NULL,
  `monMorning` tinyint(1) DEFAULT NULL,
  `monAfternoon` tinyint(1) DEFAULT NULL,
  `tuesMorning` tinyint(1) DEFAULT NULL,
  `tuesAfternoon` tinyint(1) DEFAULT NULL,
  `wedMorning` tinyint(1) DEFAULT NULL,
  `wedAfternoon` tinyint(1) DEFAULT NULL,
  `thursMorning` tinyint(1) DEFAULT NULL,
  `thursAfternoon` tinyint(1) DEFAULT NULL,
  `friMorning` tinyint(1) DEFAULT NULL,
  `friAfternoon` tinyint(1) DEFAULT NULL,
  `satMorning` tinyint(1) DEFAULT NULL,
  `satAfternoon` tinyint(1) DEFAULT NULL,
  `sunMorning` tinyint(1) DEFAULT NULL,
  `sunAfternoon` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`umpireID`),
  UNIQUE KEY `umpireID` (`umpireID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `umpire`
--

INSERT INTO `umpire` (`umpireID`, `umpireName`, `umpireEmail`, `monMorning`, `monAfternoon`, `tuesMorning`, `tuesAfternoon`, `wedMorning`, `wedAfternoon`, `thursMorning`, `thursAfternoon`, `friMorning`, `friAfternoon`, `satMorning`, `satAfternoon`, `sunMorning`, `sunAfternoon`) VALUES
(1, 'Brian Jackson', 'b.jackson@gmail.com', 1, 1, 1, 1, 1, 1, 0, 0, 1, 1, 0, 0, 1, 1),
(3, 'Susie Costello', 's.costello@hw.ac.uk', 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(4, 'Andrew Fleming', 'ajf9@hw.ac.uk', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `wattball_goals`
--

CREATE TABLE IF NOT EXISTS `wattball_goals` (
  `goalID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `matchID` bigint(20) unsigned NOT NULL,
  `minute` int(11) DEFAULT NULL,
  `playerID` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`goalID`),
  UNIQUE KEY `goalID` (`goalID`),
  KEY `fk_wattballgoals_wattballmatches` (`matchID`),
  KEY `fk_wattballgoals_wattballplayers` (`playerID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `wattball_goals`
--

INSERT INTO `wattball_goals` (`goalID`, `matchID`, `minute`, `playerID`) VALUES
(1, 7, 20, 211),
(2, 7, 20, 229),
(3, 7, 22, 231),
(4, 8, 3, 207);

-- --------------------------------------------------------

--
-- Table structure for table `wattball_matches`
--

CREATE TABLE IF NOT EXISTS `wattball_matches` (
  `matchID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tournamentID` bigint(20) unsigned NOT NULL,
  `matchDate` date DEFAULT NULL,
  `matchTime` varchar(4) DEFAULT NULL,
  `pitch` int(11) DEFAULT NULL,
  `team1` bigint(20) unsigned NOT NULL,
  `team2` bigint(20) unsigned NOT NULL,
  `umpire` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`matchID`),
  UNIQUE KEY `matchID` (`matchID`),
  KEY `fk_wattballmatches_tournament` (`tournamentID`),
  KEY `fk_wattballmatches_team1` (`team1`),
  KEY `fk_wattballmatches_team2` (`team2`),
  KEY `fk_wattballmatches_umpire` (`umpire`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `wattball_matches`
--

INSERT INTO `wattball_matches` (`matchID`, `tournamentID`, `matchDate`, `matchTime`, `pitch`, `team1`, `team2`, `umpire`) VALUES
(7, 1, '2013-03-07', '10am', 1, 46, 47, 3),
(8, 1, '2013-03-07', '2pm', 1, 45, 47, 3),
(9, 1, '2013-03-08', '10am', 1, 45, 46, 1);

-- --------------------------------------------------------

--
-- Table structure for table `wattball_players`
--

CREATE TABLE IF NOT EXISTS `wattball_players` (
  `playerID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `teamID` bigint(20) unsigned NOT NULL,
  `playerName` varchar(200) DEFAULT NULL,
  `numberOfGoals` int(11) DEFAULT NULL,
  PRIMARY KEY (`playerID`),
  UNIQUE KEY `playerID` (`playerID`),
  KEY `fk_wattballplayers_wattballteam` (`teamID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=233 ;

--
-- Dumping data for table `wattball_players`
--

INSERT INTO `wattball_players` (`playerID`, `teamID`, `playerName`, `numberOfGoals`) VALUES
(200, 45, '1\r', 0),
(201, 45, '2\r', 0),
(202, 45, '3\r', 0),
(203, 45, '4\r', 0),
(204, 45, '5\r', 0),
(205, 45, '6\r', 0),
(206, 45, '7\r', 0),
(207, 45, '8\r', 1),
(208, 45, '9\r', 0),
(209, 45, '10\r', 0),
(210, 45, '11', 0),
(211, 46, '1\r', 1),
(212, 46, '2\r', 0),
(213, 46, '3\r', 0),
(214, 46, '4\r', 0),
(215, 46, '5\r', 0),
(216, 46, '6\r', 0),
(217, 46, '7\r', 0),
(218, 46, '8\r', 0),
(219, 46, '9\r', 0),
(220, 46, '10\r', 0),
(221, 46, '11', 0),
(222, 47, '1\r', 0),
(223, 47, '2\r', 0),
(224, 47, '3\r', 0),
(225, 47, '4\r', 0),
(226, 47, '5\r', 0),
(227, 47, '6\r', 0),
(228, 47, '7\r', 0),
(229, 47, '8\r', 1),
(230, 47, '9\r', 0),
(231, 47, '10\r', 1),
(232, 47, '11', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wattball_ranking`
--

CREATE TABLE IF NOT EXISTS `wattball_ranking` (
  `teamID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tournamentID` bigint(20) unsigned NOT NULL,
  `won` int(11) DEFAULT NULL,
  `lost` int(11) DEFAULT NULL,
  `drawn` int(11) DEFAULT NULL,
  `goalsFor` int(11) DEFAULT NULL,
  `goalsAgainst` int(11) DEFAULT NULL,
  `goalDifference` int(11) DEFAULT NULL,
  PRIMARY KEY (`teamID`,`tournamentID`),
  UNIQUE KEY `teamID` (`teamID`),
  KEY `fk_wattballranking_tournament` (`tournamentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `wattball_results`
--

CREATE TABLE IF NOT EXISTS `wattball_results` (
  `resultID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `matchID` bigint(20) unsigned NOT NULL,
  `team1Score` int(11) DEFAULT NULL,
  `team2Score` int(11) DEFAULT NULL,
  `matchReport` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`resultID`),
  UNIQUE KEY `resultID` (`resultID`),
  KEY `fk_wattballresults_wattballmatches` (`matchID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `wattball_results`
--

INSERT INTO `wattball_results` (`resultID`, `matchID`, `team1Score`, `team2Score`, `matchReport`) VALUES
(1, 7, 1, 2, NULL),
(2, 8, 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wattball_team`
--

CREATE TABLE IF NOT EXISTS `wattball_team` (
  `teamID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tournamentID` bigint(20) unsigned NOT NULL,
  `teamName` varchar(200) DEFAULT NULL,
  `contactName` varchar(200) DEFAULT NULL,
  `contactNumber` varchar(11) DEFAULT NULL,
  `NWANumber` varchar(7) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`teamID`),
  UNIQUE KEY `teamID` (`teamID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `wattball_team`
--

INSERT INTO `wattball_team` (`teamID`, `tournamentID`, `teamName`, `contactName`, `contactNumber`, `NWANumber`, `email`) VALUES
(45, 1, 'Andrews Angels', 'Andrew Fleming', '01592264545', '531531A', 'ajf9@hw.ac.uk'),
(46, 1, 'Brittany Browns', 'Britt Brown', '07981473282', '512512A', 'zechtech@hotmail.co.uk'),
(47, 1, 'Green Giants', 'Andrew Fleming', '01592264545', '987987A', 'ajf9@hw.ac.uk');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hurdle_heats`
--
ALTER TABLE `hurdle_heats`
  ADD CONSTRAINT `fk_hurdleheat_tournament` FOREIGN KEY (`tournamentID`) REFERENCES `tournament` (`tournamentID`);

--
-- Constraints for table `hurdle_laneallocation`
--
ALTER TABLE `hurdle_laneallocation`
  ADD CONSTRAINT `fk_hurdlelanealloc_hurdlecompetitor` FOREIGN KEY (`hurdlerID`) REFERENCES `hurdles_competitors` (`hurdlerID`),
  ADD CONSTRAINT `fk_hurdlelanealloc_hurdleheat` FOREIGN KEY (`heatID`) REFERENCES `hurdle_heats` (`heatID`);

--
-- Constraints for table `hurdle_results`
--
ALTER TABLE `hurdle_results`
  ADD CONSTRAINT `fk_hurdleresult_hurdleheat` FOREIGN KEY (`heatID`) REFERENCES `hurdle_heats` (`heatID`),
  ADD CONSTRAINT `fk_hurdlerrsult_hurdlecompetitor` FOREIGN KEY (`hurdlerID`) REFERENCES `hurdles_competitors` (`hurdlerID`);

--
-- Constraints for table `ticket_sales`
--
ALTER TABLE `ticket_sales`
  ADD CONSTRAINT `fk_ticketsale_transaction` FOREIGN KEY (`transactionID`) REFERENCES `transaction` (`transactionID`);

--
-- Constraints for table `wattball_goals`
--
ALTER TABLE `wattball_goals`
  ADD CONSTRAINT `fk_wattballgoals_wattballmatches` FOREIGN KEY (`matchID`) REFERENCES `wattball_matches` (`matchID`),
  ADD CONSTRAINT `fk_wattballgoals_wattballplayers` FOREIGN KEY (`playerID`) REFERENCES `wattball_players` (`playerID`);

--
-- Constraints for table `wattball_matches`
--
ALTER TABLE `wattball_matches`
  ADD CONSTRAINT `fk_wattballmatches_team1` FOREIGN KEY (`team1`) REFERENCES `wattball_team` (`teamID`),
  ADD CONSTRAINT `fk_wattballmatches_team2` FOREIGN KEY (`team2`) REFERENCES `wattball_team` (`teamID`),
  ADD CONSTRAINT `fk_wattballmatches_tournament` FOREIGN KEY (`tournamentID`) REFERENCES `tournament` (`tournamentID`),
  ADD CONSTRAINT `fk_wattballmatches_umpire` FOREIGN KEY (`umpire`) REFERENCES `umpire` (`umpireID`);

--
-- Constraints for table `wattball_players`
--
ALTER TABLE `wattball_players`
  ADD CONSTRAINT `fk_wattballplayers_wattballteam` FOREIGN KEY (`teamID`) REFERENCES `wattball_team` (`teamID`);

--
-- Constraints for table `wattball_ranking`
--
ALTER TABLE `wattball_ranking`
  ADD CONSTRAINT `fk_wattballranking_tournament` FOREIGN KEY (`tournamentID`) REFERENCES `tournament` (`tournamentID`),
  ADD CONSTRAINT `fk_wattballranking_wattballteam` FOREIGN KEY (`teamID`) REFERENCES `wattball_team` (`teamID`);

--
-- Constraints for table `wattball_results`
--
ALTER TABLE `wattball_results`
  ADD CONSTRAINT `fk_wattballresults_wattballmatches` FOREIGN KEY (`matchID`) REFERENCES `wattball_matches` (`matchID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

ALTER table wattball_ranking add matchPoint int(11) default 0;