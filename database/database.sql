-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 05, 2013 at 11:57 PM
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
('admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Administrator', 1, '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticketID`, `bookingID`, `methodOfSale`, `dateOfTicket`, `status`, `type`) VALUES
(1, 0, 'postal', '2013-03-02', 'Collected', 'adult'),
(2, 0, 'postal', '2013-03-02', 'Collected', 'concession');

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
  PRIMARY KEY (`bookingID`),
  UNIQUE KEY `bookingID` (`bookingID`),
  KEY `fk_ticketsale_transaction` (`transactionID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
(1, 'Annual Tournament', '2013-04-01', '2013-04-07', '2013-01-01', '2013-04-01');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
  `transactionID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nameOnCard` varchar(60) NOT NULL,
  `cardNumber` varchar(20) DEFAULT NULL,
  `cscNumber` int(11) DEFAULT NULL,
  `issueNo` double DEFAULT NULL,
  `cardType` varchar(15) DEFAULT NULL,
  `validUntil` date DEFAULT NULL,
  PRIMARY KEY (`transactionID`),
  UNIQUE KEY `transactionID` (`transactionID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `wattball_matches`
--

INSERT INTO `wattball_matches` (`matchID`, `tournamentID`, `matchDate`, `matchTime`, `pitch`, `team1`, `team2`, `umpire`) VALUES
(1, 1, '2013-02-28', '10am', 1, 41, 42, 3),
(2, 1, '2013-03-01', '10am', 1, 41, 43, 1),
(3, 1, '2013-03-02', '10am', 1, 42, 43, 3);

-- --------------------------------------------------------

--
-- Table structure for table `wattball_players`
--

CREATE TABLE IF NOT EXISTS `wattball_players` (
  `playerID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `teamID` bigint(20) unsigned NOT NULL,
  `playerName` varchar(200) DEFAULT NULL,
  `numberOfGoals` int(11) DEFAULT 0,
  PRIMARY KEY (`playerID`),
  UNIQUE KEY `playerID` (`playerID`),
  KEY `fk_wattballplayers_wattballteam` (`teamID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=200 ;

--
-- Dumping data for table `wattball_players`
--

INSERT INTO `wattball_players` (`playerID`, `teamID`, `playerName`, `numberOfGoals`) VALUES
(156, 41, '1\r', 0),
(157, 41, '2\r', 0),
(158, 41, '3\r', 0),
(159, 41, '4\r', 0),
(160, 41, '5\r', 0),
(161, 41, '6\r', 0),
(162, 41, '7\r', 0),
(163, 41, '8\r', 0),
(164, 41, '9\r', 0),
(165, 41, '10\r', 0),
(166, 41, '11', 0),
(167, 42, '1\r', 0),
(168, 42, '2\r', 0),
(169, 42, '3\r', 0),
(170, 42, '4\r', 0),
(171, 42, '5\r', 0),
(172, 42, '6\r', 0),
(173, 42, '7\r', 0),
(174, 42, '8\r', 0),
(175, 42, '9\r', 0),
(176, 42, '10\r', 0),
(177, 42, '11', 0),
(178, 43, 'fred\r', 0),
(179, 43, 'fred\r', 0),
(180, 43, 'fred\r', 0),
(181, 43, 'fred\r', 0),
(182, 43, 'fred\r', 0),
(183, 43, 'fred\r', 0),
(184, 43, 'fred\r', 0),
(185, 43, 'fred\r', 0),
(186, 43, 'fred\r', 0),
(187, 43, 'fred\r', 0),
(188, 43, 'fred', 0),
(189, 44, '1\r', 0),
(190, 44, '2\r', 0),
(191, 44, '3\r', 0),
(192, 44, '4\r', 0),
(193, 44, '5\r', 0),
(194, 44, '6\r', 0),
(195, 44, '7\r', 0),
(196, 44, '8\r', 0),
(197, 44, '9\r', 0),
(198, 44, '10\r', 0),
(199, 44, '11', 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `wattball_team`
--

INSERT INTO `wattball_team` (`teamID`, `tournamentID`, `teamName`, `contactName`, `contactNumber`, `NWANumber`, `email`) VALUES
(41, 1, 'Green Giants', 'Andrew Fleming', '07981473282', '521521A', 'ajf9@hw.ac.uk'),
(42, 1, 'Brian Warriors', 'Yohann Haution', '01315262422', '521521A', 'n.kennedy@gmail.com'),
(43, 1, 'heriot watt', 'chris cronin', '01315262422', '111111A', 'cjc23@hw.ac.uk'),
(44, 1, 'Potter Boys', 'Andrew Fleming', '07981473282', '521521A', 'zechtech@hotmail.co.uk');

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
