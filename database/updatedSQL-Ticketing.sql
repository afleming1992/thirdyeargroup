-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 21, 2013 at 09:48 PM
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
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`username`, `password`, `name`, `manager`) VALUES
('admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Administrator', 1);

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
  PRIMARY KEY (`ticketID`),
  UNIQUE KEY `ticketID` (`ticketID`),
  KEY `fk_ticket_ticketsale` (`bookingID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticketID`, `bookingID`, `methodOfSale`, `dateOfTicket`, `status`) VALUES
(3, 1, 'postal', '2013-03-25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_sales`
--

CREATE TABLE IF NOT EXISTS `ticket_sales` (
  `bookingID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `transactionID` bigint(20) unsigned NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address1` varchar(100) DEFAULT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `county` varchar(100) DEFAULT NULL,
  `postcode` varchar(10) DEFAULT NULL,
  `transactionCost` double NOT NULL,
  PRIMARY KEY (`bookingID`),
  UNIQUE KEY `bookingID` (`bookingID`),
  KEY `fk_ticketsale_transaction` (`transactionID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ticket_sales`
--

INSERT INTO `ticket_sales` (`bookingID`, `transactionID`, `name`, `email`, `address1`, `address2`, `city`, `county`, `postcode`, `transactionCost`) VALUES
(1, 1, 'Andrew Fleming', 'ajf9@hw.ac.uk', '176 Redcraigs', NULL, 'Kirkcaldy', 'Fife', 'KY2 6UG', 0);

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
  `type` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`tournamentID`),
  UNIQUE KEY `tournamentID` (`tournamentID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tournament`
--

INSERT INTO `tournament` (`tournamentID`, `name`, `startDate`, `endDate`, `registrationOpen`, `registrationClose`, `type`) VALUES
(2, 'Annual Tournament', '2013-03-25', '2013-04-07', '2013-02-10', '2013-03-31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
  `transactionID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cardNumber` varchar(20) DEFAULT NULL,
  `cscNumber` int(11) DEFAULT NULL,
  `issueNo` double DEFAULT NULL,
  `cardType` varchar(15) DEFAULT NULL,
  `validUntil` date DEFAULT NULL,
  PRIMARY KEY (`transactionID`),
  UNIQUE KEY `transactionID` (`transactionID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transactionID`, `cardNumber`, `cscNumber`, `issueNo`, `cardType`, `validUntil`) VALUES
(1, '202', 202, 1, 'Visa', '2019-02-28');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `umpire`
--

INSERT INTO `umpire` (`umpireID`, `umpireName`, `umpireEmail`, `monMorning`, `monAfternoon`, `tuesMorning`, `tuesAfternoon`, `wedMorning`, `wedAfternoon`, `thursMorning`, `thursAfternoon`, `friMorning`, `friAfternoon`, `satMorning`, `satAfternoon`, `sunMorning`, `sunAfternoon`) VALUES
(1, 'Andrew Fleming', 'ajf9@hw.ac.uk', 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `wattball_players`
--

CREATE TABLE IF NOT EXISTS `wattball_players` (
  `playerID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `teamID` bigint(20) unsigned NOT NULL,
  `playerName` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`playerID`),
  UNIQUE KEY `playerID` (`playerID`),
  KEY `fk_wattballplayers_wattballteam` (`teamID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=89 ;

--
-- Dumping data for table `wattball_players`
--

INSERT INTO `wattball_players` (`playerID`, `teamID`, `playerName`) VALUES
(1, 1, '1\r'),
(2, 1, '2\r'),
(3, 1, '3\r'),
(4, 1, '4\r'),
(5, 1, '5\r'),
(6, 1, '6\r'),
(7, 1, '7\r'),
(8, 1, '8\r'),
(9, 1, '9\r'),
(10, 1, '10\r'),
(11, 1, '11'),
(12, 2, '1\r'),
(13, 2, '2\r'),
(14, 2, '3\r'),
(15, 2, '4\r'),
(16, 2, '5\r'),
(17, 2, '6\r'),
(18, 2, '7\r'),
(19, 2, '8\r'),
(20, 2, '9\r'),
(21, 2, '10\r'),
(22, 2, '11'),
(78, 3, '1\r'),
(79, 3, '2\r'),
(80, 3, '3\r'),
(81, 3, '4\r'),
(82, 3, '5\r'),
(83, 3, '6\r'),
(84, 3, '7\r'),
(85, 3, '8\r'),
(86, 3, '9\r'),
(87, 3, '10\r'),
(88, 3, '11');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `wattball_team`
--

INSERT INTO `wattball_team` (`teamID`, `tournamentID`, `teamName`, `contactName`, `contactNumber`, `NWANumber`, `email`) VALUES
(1, 1, 'Team 1', 'Andrew Fleming', '07981473282', '521521A', 'ajf9@hw.ac.uk'),
(2, 1, 'Team 2', 'Andrew Fleming', '07981473282', '521521A', 'ajf9@hw.ac.uk'),
(3, 1, 'Team 3', 'Jack', '08596252525', '521521A', 'zechtech@hotmail.co.uk');

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
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `fk_ticket_ticketsale` FOREIGN KEY (`bookingID`) REFERENCES `ticket_sales` (`bookingID`);

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
