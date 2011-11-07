-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 06. November 2011 um 20:00
-- Server Version: 5.5.9
-- PHP-Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `botm`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `accounts`
--

CREATE TABLE `accounts` (
  `playerID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `password` varchar(20) NOT NULL,
  `studentID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`playerID`),
  KEY `studentID` (`studentID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `accounts`
--

INSERT INTO `accounts` VALUES(1, 'a', 1);
INSERT INTO `accounts` VALUES(2, 'a', 3);
INSERT INTO `accounts` VALUES(3, 'a', 4);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `characters`
--

CREATE TABLE `characters` (
  `name` varchar(20) NOT NULL,
  `gender` binary(1) NOT NULL,
  `gradeLevel` tinyint(2) NOT NULL DEFAULT '-1',
  `inappropriate` binary(1) DEFAULT NULL,
  `cash` mediumint(8) unsigned NOT NULL DEFAULT '20000',
  `maxBattle` tinyint(3) unsigned NOT NULL DEFAULT '3',
  `currBattle` tinyint(3) unsigned NOT NULL DEFAULT '3',
  `maxMotivation` tinyint(3) unsigned NOT NULL DEFAULT '10',
  `currMotivation` tinyint(3) unsigned NOT NULL DEFAULT '10',
  `maxPride` mediumint(8) unsigned NOT NULL DEFAULT '100',
  `currPride` mediumint(8) unsigned NOT NULL DEFAULT '100',
  `numWon` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `numLost` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `skillPoints` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `burnoutTimer` datetime DEFAULT NULL,
  `round` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `studentID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pianoMultiplier` float unsigned NOT NULL DEFAULT '1',
  `pianoSkillLevel` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `violinMultiplier` float unsigned NOT NULL DEFAULT '1',
  `violinSkillLevel` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `athleticsMultiplier` float unsigned NOT NULL DEFAULT '1',
  `athleticsSkillLevel` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `danceMultiplier` float unsigned NOT NULL DEFAULT '1',
  `danceSkillLevel` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `languageMultiplier` float unsigned NOT NULL DEFAULT '1',
  `languageSkillLevel` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `scienceMultiplier` float unsigned NOT NULL DEFAULT '1',
  `scienceSkillLevel` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `mathMultiplier` float unsigned NOT NULL DEFAULT '1',
  `mathSkillLevel` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `historyMultiplier` float unsigned NOT NULL DEFAULT '1',
  `historySkillLevel` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `chineseMultiplier` float unsigned NOT NULL DEFAULT '1',
  `chineseSkillLevel` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `cultureMultiplier` float unsigned NOT NULL DEFAULT '1',
  `cultureSkillLevel` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `chineseEXP` smallint(5) unsigned NOT NULL DEFAULT '0',
  `mathEXP` smallint(5) unsigned NOT NULL DEFAULT '0',
  `languageEXP` smallint(5) unsigned NOT NULL DEFAULT '0',
  `scienceEXP` smallint(5) unsigned NOT NULL DEFAULT '0',
  `historyEXP` smallint(5) unsigned NOT NULL DEFAULT '0',
  `athleticsEXP` smallint(5) unsigned NOT NULL DEFAULT '0',
  `danceEXP` smallint(5) unsigned NOT NULL DEFAULT '0',
  `violinEXP` smallint(5) unsigned NOT NULL DEFAULT '0',
  `pianoEXP` smallint(5) unsigned NOT NULL DEFAULT '0',
  `cultureEXP` smallint(5) unsigned NOT NULL DEFAULT '0',
  `lastAction` int(10) unsigned DEFAULT NULL,
  `battleTimer` int(10) unsigned DEFAULT NULL,
  `motivationTimer` int(10) unsigned DEFAULT NULL,
  `prideTimer` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`studentID`),
  UNIQUE KEY `name_2` (`name`),
  KEY `name` (`name`),
  KEY `inappropriate` (`inappropriate`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `characters`
--

INSERT INTO `characters` VALUES('Sarah', '1', -1, NULL, 13825, 10, 10, 24, 24, 200, 200, 0, 0, 0, NULL, 0, 1, 0.959807, 1, 0.789093, 1, 1.30098, 1, 1.08273, 1, 0.96106, 1, 0.974285, 1, 0.731602, 1, 0.731791, 1, 0.9175, 1, 1, 1, 37, 0, 0, 0, 0, 0, 0, 0, 25, 0, 1320627496, 1315417706, 1315417706, 1315417706);
INSERT INTO `characters` VALUES('Linda', '1', -1, NULL, 20000, 3, 3, 10, 10, 100, 100, 0, 0, 0, NULL, 0, 3, 0.964409, 1, 0.894824, 1, 1.77659, 1, 1.11041, 1, 0.726525, 1, 1.0935, 1, 1.31435, 1, 0.947718, 1, 1.14196, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1313461738, NULL, NULL, NULL);
INSERT INTO `characters` VALUES('Tiffany', '1', -1, NULL, 20000, 3, 3, 10, 10, 100, 100, 0, 0, 0, NULL, 0, 4, 0.733803, 1, 1.21288, 1, 0.81258, 1, 0.666021, 1, 0.880516, 1, 0.830584, 1, 0.815427, 1, 1.21858, 1, 0.785224, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1313707605, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `charEvents`
--

CREATE TABLE `charEvents` (
  `studentID` int(10) unsigned NOT NULL,
  `eventID` int(10) unsigned NOT NULL,
  `timeReady` int(10) unsigned DEFAULT NULL,
  `timesDone` smallint(5) unsigned DEFAULT '1',
  KEY `studentID` (`studentID`),
  KEY `eventID` (`eventID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `charEvents`
--

INSERT INTO `charEvents` VALUES(1, 1, 1315104050, 5);
INSERT INTO `charEvents` VALUES(1, 17, 1315460906, 4);
INSERT INTO `charEvents` VALUES(1, 35, 1314574269, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `charGrades`
--

CREATE TABLE `charGrades` (
  `studentID` int(10) unsigned NOT NULL,
  `gradeID` int(10) unsigned NOT NULL,
  `percent` float NOT NULL DEFAULT '0',
  KEY `studentID` (`studentID`),
  KEY `gradeID` (`gradeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `charGrades`
--

INSERT INTO `charGrades` VALUES(1, 1, 100);
INSERT INTO `charGrades` VALUES(1, 2, 40);
INSERT INTO `charGrades` VALUES(1, 3, 0);
INSERT INTO `charGrades` VALUES(1, 4, 95);
INSERT INTO `charGrades` VALUES(1, 5, 90);
INSERT INTO `charGrades` VALUES(3, 1, 0);
INSERT INTO `charGrades` VALUES(4, 1, 0);
INSERT INTO `charGrades` VALUES(4, 2, 0);
INSERT INTO `charGrades` VALUES(4, 3, 0);
INSERT INTO `charGrades` VALUES(4, 4, 0);
INSERT INTO `charGrades` VALUES(4, 5, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `charSchool`
--

CREATE TABLE `charSchool` (
  `studentID` int(10) unsigned NOT NULL,
  `schoolID` int(10) unsigned NOT NULL,
  KEY `studentID` (`studentID`),
  KEY `schoolID` (`schoolID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `charSchool`
--

INSERT INTO `charSchool` VALUES(1, 6);
INSERT INTO `charSchool` VALUES(3, 6);
INSERT INTO `charSchool` VALUES(4, 6);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `events`
--

CREATE TABLE `events` (
  `eventName` varchar(50) DEFAULT NULL,
  `eventCost` smallint(5) unsigned NOT NULL DEFAULT '0',
  `motivationReq` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `eventDescription` varchar(200) DEFAULT NULL,
  `skillA` varchar(10) DEFAULT NULL,
  `EXPA` tinyint(3) unsigned DEFAULT NULL,
  `skillB` varchar(10) DEFAULT NULL,
  `EXPB` tinyint(3) unsigned DEFAULT NULL,
  `skillC` varchar(10) DEFAULT NULL,
  `EXPC` tinyint(3) unsigned DEFAULT NULL,
  `eventID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` char(1) NOT NULL,
  `category` char(10) NOT NULL,
  `timeLimit` int(10) NOT NULL,
  `eGradeLevel` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`eventID`),
  KEY `eventName` (`eventName`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=110 ;

--
-- Daten für Tabelle `events`
--

INSERT INTO `events` VALUES('Practice Piano with $name', 235, 1, 'How do you get to Carnegie Hall? Practice!', 'Piano', 5, NULL, NULL, NULL, NULL, 1, 'E', '0', 0, -1);
INSERT INTO `events` VALUES('Hire a Chinese-speaking Nanny', 500, 0, 'Because we no speaky Engrish in this house.', 'Chinese', 20, NULL, NULL, NULL, NULL, 2, 'L', '0', -1, 0);
INSERT INTO `events` VALUES('Hire a Chinese-speaking Nanny', 500, 0, 'Because we no speaky Engrish in this house.', 'Chinese', 20, NULL, NULL, NULL, NULL, 3, 'L', '0', -1, 1);
INSERT INTO `events` VALUES('Hire a Chinese-speaking Nanny', 500, 0, 'Because we no speaky Engrish in this house.', 'Chinese', 20, NULL, NULL, NULL, NULL, 4, 'L', '0', -1, 2);
INSERT INTO `events` VALUES('Hire a Chinese-speaking Nanny', 500, 0, 'Because we no speaky Engrish in this house.', 'Chinese', 20, NULL, NULL, NULL, NULL, 5, 'L', '0', -1, 3);
INSERT INTO `events` VALUES('Hire a Chinese-speaking Nanny', 500, 0, 'Because we no speaky Engrish in this house.', 'Chinese', 20, NULL, NULL, NULL, NULL, 6, 'L', '0', -1, 4);
INSERT INTO `events` VALUES('Hire a Chinese-speaking Nanny', 0, 0, 'Because we no speaky Engrish in this house.', 'Chinese', 20, NULL, NULL, NULL, NULL, 7, 'L', '0', -1, 5);
INSERT INTO `events` VALUES('Hire a Chinese-speaking Nanny', 500, 0, 'Because we no speaky Engrish in this house.', 'Chinese', 20, NULL, NULL, NULL, NULL, 8, 'L', '0', -1, 6);
INSERT INTO `events` VALUES('Hire a Chinese-speaking Nanny', 500, 0, 'Because we no speaky Engrish in this house.', 'Chinese', 20, NULL, NULL, NULL, NULL, 15, 'L', '0', -1, -1);
INSERT INTO `events` VALUES('Hire a Chinese-speaking Babysitter', 300, 0, 'No TV, no video games. And make sure Kunom is done before bedtime.', 'Chinese', 5, NULL, NULL, NULL, NULL, 16, 'L', '', 0, NULL);
INSERT INTO `events` VALUES('Hire a Chinese-speaking Babysitter', 300, 0, 'No TV, no video games. And make sure Kunom is done before bedtime.', 'Chinese', 10, NULL, NULL, NULL, NULL, 17, 'L', '', 43200, -1);
INSERT INTO `events` VALUES('Hire a Chinese-speaking Babysitter', 300, 0, 'No TV, no video games. And make sure Kunom is done before bedtime.', 'Chinese', 10, NULL, NULL, NULL, NULL, 18, 'L', '', 43200, 0);
INSERT INTO `events` VALUES('Hire a Chinese-speaking Babysitter', 300, 0, 'No TV, no video games. And make sure Kunom is done before bedtime.', 'Chinese', 10, NULL, NULL, NULL, NULL, 19, 'L', '', 43200, 1);
INSERT INTO `events` VALUES('Hire a Chinese-speaking Babysitter', 300, 0, 'No TV, no video games. And make sure Kunom is done before bedtime.', 'Chinese', 10, NULL, NULL, NULL, NULL, 20, 'L', '', 43200, 2);
INSERT INTO `events` VALUES('Hire a Chinese-speaking Babysitter', 300, 0, 'No TV, no video games. And make sure Kunom is done before bedtime.', 'Chinese', 10, NULL, NULL, NULL, NULL, 21, 'L', '', 43200, 3);
INSERT INTO `events` VALUES('Hire a Chinese-speaking Babysitter', 300, 0, 'No TV, no video games. And make sure Kunom is done before bedtime.', 'Chinese', 10, NULL, NULL, NULL, NULL, 22, 'L', '', 43200, 4);
INSERT INTO `events` VALUES('Hire a Chinese-speaking Babysitter', 300, 0, 'No TV, no video games. And make sure Kunom is done before bedtime.', 'Chinese', 10, NULL, NULL, NULL, NULL, 23, 'L', '', 43200, 5);
INSERT INTO `events` VALUES('Hire a Chinese-speaking Babysitter', 300, 0, 'No TV, no video games. And make sure Kunom is done before bedtime.', 'Chinese', 10, NULL, NULL, NULL, NULL, 24, 'L', '', 43200, 6);
INSERT INTO `events` VALUES('Give $name a Haircut at Home', 0, 3, 'Only three choices: bowlcut, buzzcut, or buzzcut with tail.', 'Culture', 5, NULL, NULL, NULL, NULL, 25, 'L', '', 21600, -1);
INSERT INTO `events` VALUES('Give $name a Haircut at Home', 0, 3, 'Only three choices: bowlcut, buzzcut, or buzzcut with tail.', 'Culture', 5, NULL, NULL, NULL, NULL, 26, 'L', '', 21600, 0);
INSERT INTO `events` VALUES('Give $name a Haircut at Home', 0, 3, 'Only three choices: bowlcut, buzzcut, or buzzcut with tail.', 'Culture', 5, NULL, NULL, NULL, NULL, 27, 'L', '', 21600, 1);
INSERT INTO `events` VALUES('Give $name a Haircut at Home', 0, 3, 'Only three choices: bowlcut, buzzcut, or buzzcut with tail.', 'Culture', 5, NULL, NULL, NULL, NULL, 28, 'L', '', 21600, 2);
INSERT INTO `events` VALUES('Give $name a Haircut at Home', 0, 3, 'Only three choices: bowlcut, buzzcut, or buzzcut with tail.', 'Culture', 5, NULL, NULL, NULL, NULL, 29, 'L', '', 21600, 3);
INSERT INTO `events` VALUES('Give $name a Haircut at Home', 0, 3, 'Only three choices: bowlcut, buzzcut, or buzzcut with tail.', 'Culture', 5, NULL, NULL, NULL, NULL, 30, 'L', '', 21600, 4);
INSERT INTO `events` VALUES('Give $name a Haircut at Home', 0, 3, 'Only three choices: bowlcut, buzzcut, or buzzcut with tail.', 'Culture', 5, NULL, NULL, NULL, NULL, 31, 'L', '', 21600, 5);
INSERT INTO `events` VALUES('Give $name a Haircut at Home', 0, 3, 'Only three choices: bowlcut, buzzcut, or buzzcut with tail.', 'Culture', 5, NULL, NULL, NULL, NULL, 32, 'L', '', 21600, 6);
INSERT INTO `events` VALUES('Give $name a Haircut at Home', 0, 3, 'Only three choices: bowlcut, buzzcut, or buzzcut with tail.', 'Culture', 5, NULL, NULL, NULL, NULL, 33, 'L', '', 21600, 7);
INSERT INTO `events` VALUES('Give $name a Haircut at Home', 0, 3, 'Only three choices: bowlcut, buzzcut, or buzzcut with tail.', 'Culture', 5, NULL, NULL, NULL, NULL, 34, 'L', '', 21600, 8);
INSERT INTO `events` VALUES('Give $name a Whack of the Chopsticks', 0, 1, 'Bad kid! Teach you a lesson!', 'Chinese', 1, NULL, NULL, NULL, NULL, 35, 'L', '', 1800, -1);
INSERT INTO `events` VALUES('Give $name a Whack of the Chopsticks', 0, 1, 'Bad kid! Teach you a lesson!', 'Chinese', 1, NULL, NULL, NULL, NULL, 36, 'L', '', 1800, 0);
INSERT INTO `events` VALUES('Give $name a Whack of the Chopsticks', 0, 1, 'Bad kid! Teach you a lesson!', 'Chinese', 1, NULL, NULL, NULL, NULL, 37, 'L', '', 1800, 1);
INSERT INTO `events` VALUES('Give $name a Whack of the Chopsticks', 0, 1, 'Bad kid! Teach you a lesson!', 'Chinese', 1, NULL, NULL, NULL, NULL, 38, 'L', '', 1800, 2);
INSERT INTO `events` VALUES('Give $name a Whack of the Chopsticks', 0, 1, 'Bad kid! Teach you a lesson!', 'Chinese', 1, NULL, NULL, NULL, NULL, 39, 'L', '', 1800, 3);
INSERT INTO `events` VALUES('Give $name a Whack of the Chopsticks', 0, 1, 'Bad kid! Teach you a lesson!', 'Chinese', 1, NULL, NULL, NULL, NULL, 40, 'L', '', 1800, 4);
INSERT INTO `events` VALUES('Give $name a Whack of the Chopsticks', 0, 1, 'Bad kid! Teach you a lesson!', 'Chinese', 1, NULL, NULL, NULL, NULL, 41, 'L', '', 1800, 5);
INSERT INTO `events` VALUES('Give $name a Whack of the Chopsticks', 0, 1, 'Bad kid! Teach you a lesson!', 'Chinese', 1, NULL, NULL, NULL, NULL, 42, 'L', '', 1800, 6);
INSERT INTO `events` VALUES('Give $name a Whack of the Chopsticks', 0, 1, 'Bad kid! Teach you a lesson!', 'Chinese', 1, NULL, NULL, NULL, NULL, 43, 'L', '', 1800, 7);
INSERT INTO `events` VALUES('Forbid $name from Having a Playdate', 0, 4, 'You want playtime? OK - time to play violin.', 'Culture', 10, NULL, NULL, NULL, NULL, 44, 'L', '', 21600, -1);
INSERT INTO `events` VALUES('Forbid $name from Having a Playdate', 0, 4, 'You want playtime? OK - time to play violin.', 'Culture', 10, NULL, NULL, NULL, NULL, 45, 'L', '', 21600, 0);
INSERT INTO `events` VALUES('Forbid $name from Having a Playdate', 0, 4, 'You want playtime? OK - time to play violin.', 'Culture', 10, NULL, NULL, NULL, NULL, 46, 'L', '', 21600, 1);
INSERT INTO `events` VALUES('Forbid $name from Having a Playdate', 0, 4, 'You want playtime? OK - time to play violin.', 'Culture', 10, NULL, NULL, NULL, NULL, 47, 'L', '', 21600, 2);
INSERT INTO `events` VALUES('Forbid $name from Having a Playdate', 0, 4, 'You want playtime? OK - time to play violin.', 'Culture', 10, NULL, NULL, NULL, NULL, 48, 'L', '', 21600, 3);
INSERT INTO `events` VALUES('Forbid $name from Having a Playdate', 0, 4, 'You want playtime? OK - time to play violin.', 'Culture', 10, NULL, NULL, NULL, NULL, 49, 'L', '', 21600, 4);
INSERT INTO `events` VALUES('Forbid $name from Having a Playdate', 0, 4, 'You want playtime? OK - time to play violin.', 'Culture', 10, NULL, NULL, NULL, NULL, 50, 'L', '', 21600, 5);
INSERT INTO `events` VALUES('Forbid $name from Going to Sleepover', 0, 3, 'You can have sleepovers...when you''re married.', 'Culture', 20, NULL, NULL, NULL, NULL, 51, 'L', '', 21600, 4);
INSERT INTO `events` VALUES('Forbid $name from Going to Sleepover', 0, 3, 'You can have sleepovers...when you''re married.', 'Culture', 20, NULL, NULL, NULL, NULL, 52, 'L', '', 21600, 5);
INSERT INTO `events` VALUES('Forbid $name from Going to Sleepover', 0, 3, 'You can have sleepovers...when you''re married.', 'Culture', 20, NULL, NULL, NULL, NULL, 53, 'L', '', 21600, 6);
INSERT INTO `events` VALUES('Forbid $name from Going to Sleepover', 0, 3, 'You can have sleepovers...when you''re married.', 'Culture', 20, NULL, NULL, NULL, NULL, 54, 'L', '', 21600, 7);
INSERT INTO `events` VALUES('Forbid $name from Going to Sleepover', 0, 3, 'You can have sleepovers...when you''re married.', 'Culture', 20, NULL, NULL, NULL, NULL, 55, 'L', '', 21600, 8);
INSERT INTO `events` VALUES('Forbid $name from Going to Sleepover', 0, 3, 'You can have sleepovers...when you''re married.', 'Culture', 20, NULL, NULL, NULL, NULL, 56, 'L', '', 21600, 9);
INSERT INTO `events` VALUES('Forbid $name from Going to Sleepover', 0, 3, 'You can have sleepovers...when you''re married.', 'Culture', 20, NULL, NULL, NULL, NULL, 57, 'L', '', 21600, 10);
INSERT INTO `events` VALUES('Forbid $name from Going to Sleepover', 0, 3, 'You can have sleepovers...when you''re married.', 'Culture', 20, NULL, NULL, NULL, NULL, 58, 'L', '', 21600, 11);
INSERT INTO `events` VALUES('Forbid $name from Going to Sleepover', 0, 3, 'You can have sleepovers...when you''re married.', 'Culture', 20, NULL, NULL, NULL, NULL, 59, 'L', '', 21600, 12);
INSERT INTO `events` VALUES('Forbid $name from Being in a School Play', 0, 5, '"To be or not to be... Why not A? That is the question."', 'Culture', 20, NULL, NULL, NULL, NULL, 60, 'L', '', 86400, 1);
INSERT INTO `events` VALUES('Forbid $name from Being in a School Play', 0, 5, '"To be or not to be... Why not A? That is the question."', 'Culture', 20, NULL, NULL, NULL, NULL, 61, 'L', '', 86400, 2);
INSERT INTO `events` VALUES('Forbid $name from Being in a School Play', 0, 5, '"To be or not to be... Why not A? That is the question."', 'Culture', 20, NULL, NULL, NULL, NULL, 62, 'L', '', 86400, 3);
INSERT INTO `events` VALUES('Kick $name off the Computer', 0, 1, 'Facebook? Asian face book and study!', 'Culture', 1, NULL, NULL, NULL, NULL, 63, 'L', '', 120, -1);
INSERT INTO `events` VALUES('Kick $name off the Computer', 0, 1, 'Facebook? Asian face book and study!', 'Culture', 1, NULL, NULL, NULL, NULL, 64, 'L', '', 120, 0);
INSERT INTO `events` VALUES('Kick $name off the Computer', 0, 1, 'Facebook? Asian face book and study!', 'Culture', 1, NULL, NULL, NULL, NULL, 65, 'L', '', 120, 1);
INSERT INTO `events` VALUES('Kick $name off the Computer', 0, 1, 'Facebook? Asian face book and study!', 'Culture', 1, NULL, NULL, NULL, NULL, 66, 'L', '', 120, 2);
INSERT INTO `events` VALUES('Kick $name off the Computer', 0, 1, 'Facebook? Asian face book and study!', 'Culture', 1, NULL, NULL, NULL, NULL, 67, 'L', '', 120, 3);
INSERT INTO `events` VALUES('Kick $name off the Computer', 0, 1, 'Facebook? Asian face book and study!', 'Culture', 1, NULL, NULL, NULL, NULL, 68, 'L', '', 120, 4);
INSERT INTO `events` VALUES('Kick $name off the Computer', 0, 1, 'Facebook? Asian face book and study!', 'Culture', 1, NULL, NULL, NULL, NULL, 69, 'L', '', 120, 5);
INSERT INTO `events` VALUES('Kick $name off the Computer', 0, 1, 'Facebook? Asian face book and study!', 'Culture', 1, NULL, NULL, NULL, NULL, 70, 'L', '', 120, 6);
INSERT INTO `events` VALUES('Kick $name off the Computer', 0, 1, 'Facebook? Asian face book and study!', 'Culture', 1, NULL, NULL, NULL, NULL, 71, 'L', '', 120, 7);
INSERT INTO `events` VALUES('Yell at $name for A- on Homework', 0, 5, 'You got an A minus? Good job...minus.', 'Random', 20, NULL, NULL, NULL, NULL, 72, 'L', '', 50400, 6);
INSERT INTO `events` VALUES('Yell at $name for A- on Homework', 0, 5, 'You got an A minus? Good job...minus.', 'Random', 20, NULL, NULL, NULL, NULL, 73, 'L', '', 50400, 7);
INSERT INTO `events` VALUES('Yell at $name for A- on Homework', 0, 5, 'You got an A minus? Good job...minus.', 'Random', 20, NULL, NULL, NULL, NULL, 74, 'L', '', 50400, 8);
INSERT INTO `events` VALUES('Yell at $name for A- on Homework', 0, 5, 'You got an A minus? Good job...minus.', 'Random', 20, NULL, NULL, NULL, NULL, 75, 'L', '', 50400, 9);
INSERT INTO `events` VALUES('Yell at $name for A- on Homework', 0, 5, 'You got an A minus? Good job...minus.', 'Random', 20, NULL, NULL, NULL, NULL, 76, 'L', '', 50400, 10);
INSERT INTO `events` VALUES('Yell at $name for A- on Homework', 0, 5, 'You got an A minus? Good job...minus.', 'Random', 20, NULL, NULL, NULL, NULL, 77, 'L', '', 50400, 11);
INSERT INTO `events` VALUES('Yell at $name for A- on Homework', 0, 5, 'You got an A minus? Good job...minus.', 'Random', 20, NULL, NULL, NULL, NULL, 78, 'L', '', 50400, 12);
INSERT INTO `events` VALUES('Visit Hao "Got into Harvard" in Faraway Town', 300, 0, 'Be more like your cousins Stanford and Yale.', 'Culture', 5, NULL, NULL, NULL, NULL, 79, 'L', '', 18000, 7);
INSERT INTO `events` VALUES('Visit Hao "Got into Harvard" in Faraway Town', 300, 0, 'Be more like your cousins Stanford and Yale.', 'Culture', 5, NULL, NULL, NULL, NULL, 80, 'L', '', 18000, 8);
INSERT INTO `events` VALUES('Visit Hao "Got into Harvard" in Faraway Town', 300, 0, 'Be more like your cousins Stanford and Yale.', 'Culture', 5, NULL, NULL, NULL, NULL, 81, 'L', '', 18000, 9);
INSERT INTO `events` VALUES('Visit Hao "Got into Harvard" in Faraway Town', 300, 0, 'Be more like your cousins Stanford and Yale.', 'Culture', 5, NULL, NULL, NULL, NULL, 82, 'L', '', 18000, 10);
INSERT INTO `events` VALUES('Visit Hao "Got into Harvard" in Faraway Town', 300, 0, 'Be more like your cousins Stanford and Yale.', 'Culture', 5, NULL, NULL, NULL, NULL, 83, 'L', '', 18000, 11);
INSERT INTO `events` VALUES('Visit Hao "Got into Harvard" in Faraway Town', 300, 0, 'Be more like your cousins Stanford and Yale.', 'Culture', 5, NULL, NULL, NULL, NULL, 84, 'L', '', 18000, 12);
INSERT INTO `events` VALUES('Forbid $name from Going to School Dance', 0, 2, 'But you busy! Chinese school is Friday night.', 'Culture', 2, NULL, NULL, NULL, NULL, 85, 'L', '', 300, 7);
INSERT INTO `events` VALUES('Forbid $name from Going to School Dance', 0, 2, 'But you busy! Chinese school is Friday night.', 'Culture', 2, NULL, NULL, NULL, NULL, 86, 'L', '', 300, 8);
INSERT INTO `events` VALUES('Forbid $name from Going to School Dance', 0, 2, 'But you busy! Chinese school is Friday night.', 'Culture', 2, NULL, NULL, NULL, NULL, 87, 'L', '', 300, 9);
INSERT INTO `events` VALUES('Forbid $name from Going to School Dance', 0, 2, 'But you busy! Chinese school is Friday night.', 'Culture', 2, NULL, NULL, NULL, NULL, 88, 'L', '', 300, 10);
INSERT INTO `events` VALUES('Forbid $name from Going to School Dance', 0, 2, 'But you busy! Chinese school is Friday night.', 'Culture', 2, NULL, NULL, NULL, NULL, 89, 'L', '', 300, 11);
INSERT INTO `events` VALUES('Forbid $name from Going to School Dance', 0, 2, 'But you busy! Chinese school is Friday night.', 'Culture', 2, NULL, NULL, NULL, NULL, 90, 'L', '', 300, 12);
INSERT INTO `events` VALUES('Lecture: "Only Date Asians"', 0, 1, 'No, you cannot marry outside the race. Kids will only be 50%!', 'Culture', 1, NULL, NULL, NULL, NULL, 91, 'L', '', 600, 8);
INSERT INTO `events` VALUES('Lecture: "Only Date Asians"', 0, 1, 'No, you cannot marry outside the race. Kids will only be 50%!', 'Culture', 1, NULL, NULL, NULL, NULL, 92, 'L', '', 600, 9);
INSERT INTO `events` VALUES('Lecture: "Only Date Asians"', 0, 1, 'No, you cannot marry outside the race. Kids will only be 50%!', 'Culture', 1, NULL, NULL, NULL, NULL, 93, 'L', '', 600, 10);
INSERT INTO `events` VALUES('Lecture: "Only Date Asians"', 0, 1, 'No, you cannot marry outside the race. Kids will only be 50%!', 'Culture', 1, NULL, NULL, NULL, NULL, 94, 'L', '', 600, 11);
INSERT INTO `events` VALUES('Lecture: "Only Date Asians"', 0, 1, 'No, you cannot marry outside the race. Kids will only be 50%!', 'Culture', 1, NULL, NULL, NULL, NULL, 95, 'L', '', 600, 12);
INSERT INTO `events` VALUES('Lecture: "No Dating Until Done With College"', 0, 1, '16: Too young to date. 26: Why aren''t you married?', 'Culture', 1, NULL, NULL, NULL, NULL, 96, 'L', '', 2100, 8);
INSERT INTO `events` VALUES('Lecture: "No Dating Until Done With College"', 0, 1, '16: Too young to date. 26: Why aren''t you married?', 'Culture', 1, NULL, NULL, NULL, NULL, 97, 'L', '', 2100, 9);
INSERT INTO `events` VALUES('Lecture: "No Dating Until Done With College"', 0, 1, '16: Too young to date. 26: Why aren''t you married?', 'Culture', 1, NULL, NULL, NULL, NULL, 98, 'L', '', 2100, 10);
INSERT INTO `events` VALUES('Lecture: "No Dating Until Done With College"', 0, 1, '16: Too young to date. 26: Why aren''t you married?', 'Culture', 1, NULL, NULL, NULL, NULL, 99, 'L', '', 2100, 11);
INSERT INTO `events` VALUES('Lecture: "No Dating Until Done With College"', 0, 1, '16: Too young to date. 26: Why aren''t you married?', 'Culture', 1, NULL, NULL, NULL, NULL, 100, 'L', '', 2100, 12);
INSERT INTO `events` VALUES('Break Up $name''s Relationship', 0, 5, 'You''re already a huge fatty without getting pregnant too!', 'Random', 20, NULL, NULL, NULL, NULL, 101, 'L', '', 86400, 10);
INSERT INTO `events` VALUES('Break Up $name''s Relationship', 0, 5, 'You''re already a huge fatty without getting pregnant too!', 'Random', 20, NULL, NULL, NULL, NULL, 102, 'L', '', 86400, 11);
INSERT INTO `events` VALUES('Break Up $name''s Relationship', 0, 5, 'You''re already a huge fatty without getting pregnant too!', 'Random', 20, NULL, NULL, NULL, NULL, 103, 'L', '', 86400, 12);
INSERT INTO `events` VALUES('Drill Multiplication Tables with $name', 100, 1, 'Do your times table six times a day seven times a week. How many times is that?', 'Math Grade', 1, 'Math', 1, '', 0, 107, 'A', 'AcademicMa', -1, 1);
INSERT INTO `events` VALUES('Drill Multiplication Tables with $name', 100, 1, 'Do your times table six times a day seven times a week. How many times is that?', 'Math Grade', 1, 'Math', 1, '', 0, 108, 'A', 'AcademicMa', -1, 1);
INSERT INTO `events` VALUES('Drill Multiplication Tables with $name', 100, 1, 'Do your times table six times a day seven times a week. How many times is that?', 'Math Grade', 1, 'Math', 1, '', 0, 109, 'A', 'AcademicMa', -1, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `grades`
--

CREATE TABLE `grades` (
  `subject` varchar(20) NOT NULL,
  `gradeLevel` tinyint(4) NOT NULL DEFAULT '-1',
  `gradeID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`gradeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=71 ;

--
-- Daten für Tabelle `grades`
--

INSERT INTO `grades` VALUES('Math', -1, 1);
INSERT INTO `grades` VALUES('English', -1, 2);
INSERT INTO `grades` VALUES('Science', -1, 3);
INSERT INTO `grades` VALUES('History', -1, 4);
INSERT INTO `grades` VALUES('Chinese', -1, 5);
INSERT INTO `grades` VALUES('Math', 0, 6);
INSERT INTO `grades` VALUES('English', 0, 7);
INSERT INTO `grades` VALUES('Science', 0, 8);
INSERT INTO `grades` VALUES('History', 0, 9);
INSERT INTO `grades` VALUES('Chinese', 0, 10);
INSERT INTO `grades` VALUES('Math', 1, 11);
INSERT INTO `grades` VALUES('Math', 2, 12);
INSERT INTO `grades` VALUES('Math', 3, 13);
INSERT INTO `grades` VALUES('Math', 4, 14);
INSERT INTO `grades` VALUES('Math', 5, 15);
INSERT INTO `grades` VALUES('Math', 6, 16);
INSERT INTO `grades` VALUES('Math', 7, 17);
INSERT INTO `grades` VALUES('Math', 8, 18);
INSERT INTO `grades` VALUES('Math', 9, 19);
INSERT INTO `grades` VALUES('Math', 10, 20);
INSERT INTO `grades` VALUES('Math', 11, 21);
INSERT INTO `grades` VALUES('Math', 12, 22);
INSERT INTO `grades` VALUES('English', 1, 23);
INSERT INTO `grades` VALUES('English', 2, 24);
INSERT INTO `grades` VALUES('English', 3, 25);
INSERT INTO `grades` VALUES('English', 4, 26);
INSERT INTO `grades` VALUES('English', 5, 27);
INSERT INTO `grades` VALUES('English', 6, 28);
INSERT INTO `grades` VALUES('English', 7, 29);
INSERT INTO `grades` VALUES('English', 8, 30);
INSERT INTO `grades` VALUES('English', 9, 31);
INSERT INTO `grades` VALUES('English', 10, 32);
INSERT INTO `grades` VALUES('English', 11, 33);
INSERT INTO `grades` VALUES('English', 12, 34);
INSERT INTO `grades` VALUES('Science', 1, 35);
INSERT INTO `grades` VALUES('Science', 2, 36);
INSERT INTO `grades` VALUES('Science', 3, 37);
INSERT INTO `grades` VALUES('Science', 4, 38);
INSERT INTO `grades` VALUES('Science', 5, 39);
INSERT INTO `grades` VALUES('Science', 6, 40);
INSERT INTO `grades` VALUES('Science', 7, 41);
INSERT INTO `grades` VALUES('Science', 8, 42);
INSERT INTO `grades` VALUES('Science', 9, 43);
INSERT INTO `grades` VALUES('Science', 10, 44);
INSERT INTO `grades` VALUES('Science', 11, 45);
INSERT INTO `grades` VALUES('Science', 12, 46);
INSERT INTO `grades` VALUES('History', 1, 47);
INSERT INTO `grades` VALUES('History', 2, 48);
INSERT INTO `grades` VALUES('History', 3, 49);
INSERT INTO `grades` VALUES('History', 4, 50);
INSERT INTO `grades` VALUES('History', 5, 51);
INSERT INTO `grades` VALUES('History', 6, 52);
INSERT INTO `grades` VALUES('History', 7, 53);
INSERT INTO `grades` VALUES('History', 8, 54);
INSERT INTO `grades` VALUES('History', 9, 55);
INSERT INTO `grades` VALUES('History', 10, 56);
INSERT INTO `grades` VALUES('History', 11, 57);
INSERT INTO `grades` VALUES('History', 12, 58);
INSERT INTO `grades` VALUES('Chinese', 1, 59);
INSERT INTO `grades` VALUES('Chinese', 2, 60);
INSERT INTO `grades` VALUES('Chinese', 3, 61);
INSERT INTO `grades` VALUES('Chinese', 4, 62);
INSERT INTO `grades` VALUES('Chinese', 5, 63);
INSERT INTO `grades` VALUES('Chinese', 6, 64);
INSERT INTO `grades` VALUES('Chinese', 7, 65);
INSERT INTO `grades` VALUES('Chinese', 8, 66);
INSERT INTO `grades` VALUES('Chinese', 9, 67);
INSERT INTO `grades` VALUES('Chinese', 10, 68);
INSERT INTO `grades` VALUES('Chinese', 11, 69);
INSERT INTO `grades` VALUES('Chinese', 12, 70);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `items`
--

CREATE TABLE `items` (
  `itemName` varchar(50) NOT NULL,
  `itemType` varchar(20) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `picture` varchar(50) DEFAULT NULL,
  `bonus` float NOT NULL DEFAULT '1',
  `rank` tinyint(3) unsigned DEFAULT NULL,
  `itemSkill` varchar(10) NOT NULL,
  `itemID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `price` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`itemID`),
  KEY `itemName` (`itemName`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=66 ;

--
-- Daten für Tabelle `items`
--

INSERT INTO `items` VALUES('Abacus', 'Math', 'Abacus lessons are why Asians are better at math.', 'images/abacus.gif', 0, 0, 'Math', 36, 100);
INSERT INTO `items` VALUES('4-function calculator', 'Math', '', 'images/4func_calculator.gif', 0, 0, 'Math', 37, 200);
INSERT INTO `items` VALUES('Scientific caclulator', 'Math', '', 'images/scientific_calculator.gif', 0, 0, 'Math', 38, 300);
INSERT INTO `items` VALUES('Graphing calculator', 'Math', '"""This is birthday present now that you''re starting Geometry."""', 'images/graphing_calculator.gif', 0, 0, 'Math', 39, 1000);
INSERT INTO `items` VALUES('Multiplication table paper', 'Math', '', 'images/times_table.gif', 0, 0, 'Math', 40, 200);
INSERT INTO `items` VALUES('Compass and protractor', 'Math', '', 'images/compass_protractor.gif', 0, 0, 'Math', 41, 300);
INSERT INTO `items` VALUES('Math flash cards', 'Math', 'Not multiple choice', 'images/math_flash_cards.gif', 0, 0, 'Math', 42, 100);
INSERT INTO `items` VALUES('My ABC Book', 'Language', '', 'images/first_ABC_book.gif', 0, 0, 'Language', 43, 250);
INSERT INTO `items` VALUES('Picture Dictionary', 'Language', 'The first step to a perfect SAT score!', 'images/picture_dictionary.gif', 0, 0, 'Language', 44, 250);
INSERT INTO `items` VALUES('To Give a Mouse a Dollar', 'Language', '', 'images/mouse_dollar_book.gif', 0, 0, 'Language', 45, 250);
INSERT INTO `items` VALUES('Kid''s Dictionary', 'Language', 'Are you ready for flashcards yet?', 'images/childrens_dictionary.gif', 0, 0, 'Language', 46, 250);
INSERT INTO `items` VALUES('Mary Potter', 'Language', '', 'images/mary_potter.gif', 0, 0, 'Language', 47, 250);
INSERT INTO `items` VALUES('Nancy Hu', 'Language', 'She solves mysteries and still gets A''s', 'images/nancy_hu.gif', 0, 0, 'Language', 48, 250);
INSERT INTO `items` VALUES('Harbin Boys', 'Language', 'Solving mysteries in mysterious China', 'images/harbin_boys.gif', 0, 0, 'Language', 49, 250);
INSERT INTO `items` VALUES('Webster''s Dictionary', 'Language', 'A Top College Dictionary!', 'images/college_dictionary.gif', 0, 0, 'Language', 50, 250);
INSERT INTO `items` VALUES('Expensive Pen', 'Language', 'It doesn''t fix your handwriting', 'images/fancy_pen.gif', 0, 0, 'Language', 51, 250);
INSERT INTO `items` VALUES('Calligraphy Set', 'Language', 'Fixes your handwriting', 'images/calligraphy_set.gif', 0, 0, 'Language', 52, 250);
INSERT INTO `items` VALUES('101 Fun Science Experiments Book', 'Science', 'To cultivate your budding Einstein!', 'images/science_experiments.gif', 0, 0, 'Science', 53, 100);
INSERT INTO `items` VALUES('Magnet set', 'Science', 'Aren''t you attracted to these?', 'images/magnet_set.gif', 0, 0, 'Science', 54, 200);
INSERT INTO `items` VALUES('Legos', 'Science', '', 'images/legos.gif', 0, 0, 'Science', 55, 300);
INSERT INTO `items` VALUES('Solar car kit', 'Science', 'Do you have an engineer on your hands?', 'images/solar_car.gif', 0, 0, 'Science', 56, 400);
INSERT INTO `items` VALUES('Microscope', 'Science', '', 'images/microscope.gif', 0, 0, 'Science', 57, 500);
INSERT INTO `items` VALUES('Binoculars', 'Science', '', 'images/binoculars.gif', 0, 0, 'Science', 58, 600);
INSERT INTO `items` VALUES('Telescope', 'Science', 'See the stars!', 'images/telescope.gif', 0, 0, 'Science', 59, 700);
INSERT INTO `items` VALUES('Compass', 'Science', 'Learn about the Earth''s magnetic field', 'images/compass.gif', 0, 0, 'Science', 60, 800);
INSERT INTO `items` VALUES('Chemistry Kit', 'Science', 'Adult supervision required', 'images/chemistry_kit.gif', 0, 0, 'Science', 61, 900);
INSERT INTO `items` VALUES('Soccer ball', 'Athletics', '', 'images/soccer_ball.gif', 0, 0, 'Athletics', 62, 400);
INSERT INTO `items` VALUES('Basketball', 'Athletics', '', 'images/basketball.gif', 0, 0, 'Athletics', 63, 400);
INSERT INTO `items` VALUES('Baseball glove', 'Athletics', '', 'images/baseball_glove.gif', 0, 0, 'Athletics', 64, 400);
INSERT INTO `items` VALUES('Tennis racket', 'Athletics', '', 'images/tennis_racket.gif', 0, 0, 'Athletics', 65, 800);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `purchases`
--

CREATE TABLE `purchases` (
  `studentID` int(10) unsigned NOT NULL,
  `itemID` int(10) unsigned NOT NULL,
  KEY `studentID` (`studentID`),
  KEY `itemID` (`itemID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `purchases`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `schools`
--

CREATE TABLE `schools` (
  `schoolName` varchar(35) DEFAULT NULL,
  `schoolType` varchar(13) NOT NULL,
  `schoolID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(200) DEFAULT NULL,
  `friendsReq` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`schoolID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Daten für Tabelle `schools`
--

INSERT INTO `schools` VALUES('92 Street Y Nursery School, NYC', 'Preschool', 1, 'Make all the right playdates with all the right mommies, and maybe you''ll be offered an application to 92Y!', 20);
INSERT INTO `schools` VALUES('Bonsai Tree Bilingual Montessori', 'Preschool', 2, 'Boost your child''s Mandarin skills, and as an added bonus, more thoroughly indoctrinate them in the Chinese style of (rote) learning.', 10);
INSERT INTO `schools` VALUES('Dance Your Name Waldorf School', 'Preschool', 3, 'Someday, your child will just be happy to have this part of their lives behind them. For now, they can master eurhythmy and the other unusual education ideas at Waldorf!', 10);
INSERT INTO `schools` VALUES('Challenger Preschool', 'Preschool', 4, 'Where 5-year-olds with ulcers are a matter-of-course!', 5);
INSERT INTO `schools` VALUES('YMCA Child Care for Preschoolers', 'Preschool', 5, 'Learn the YMCA song before all the other kids, so you can be a Village Person too!', 2);
INSERT INTO `schools` VALUES('Daddy Day Care, Anytown, USA', 'Preschool', 6, 'If it''s good enough for Eddie Murphy, it''s good enough for me', 1);
INSERT INTO `schools` VALUES('Hunter College Elementary, NYC', 'Elementary', 7, '"College" is in the name so it must be better!', 20);
INSERT INTO `schools` VALUES('Chinatown Language Immersion', 'Elementary', 8, 'Random lottery to get into this school, unless your Asian Parent Network is big enough.', 10);
INSERT INTO `schools` VALUES('The Stuffy Private School Lower Div', 'Elementary', 9, 'A premiere "college-prep" school...for your 7-year-old.', 5);
INSERT INTO `schools` VALUES('White Picket Fence Public School', 'Elementary', 10, 'Achieving the American Dream is good enough for you, isn''t it? Isn''t it?', 2);
INSERT INTO `schools` VALUES('DC Public School', 'Elementary', 11, 'Teacher firings? Michelle Rhee debates? Not scared are you?', 1);
INSERT INTO `schools` VALUES('The Dalton School', 'Middle', 12, 'Helicopter parents just like you galore at this Manhattan prep school', 20);
INSERT INTO `schools` VALUES('The Stuffy Middle Private School', 'Middle', 13, 'Uniforms make us almost as good as those private schools mentioned in Forbes', 10);
INSERT INTO `schools` VALUES('Chinatown Language Immersion', 'Middle', 14, 'Random lottery to get into this school, unless your Asian Parent Network is big enough.', 5);
INSERT INTO `schools` VALUES('White Picket Fence Public School', 'Middle', 15, 'Achieving the American Dream is good enough for you, isn''t it? Isn''t it?', 2);
INSERT INTO `schools` VALUES('Ghetto DC Public Middle School', 'Middle', 16, 'All the charm of a medium security prison.', 1);
INSERT INTO `schools` VALUES('Stuyvescent High School', 'High', 17, 'Get a high enough SHSAT score to go here and you too can be an Intel finalist and later, Nobel laureate! I mean, your child can be!', 20);
INSERT INTO `schools` VALUES('LaGuardia School of Music & Arts', 'High', 18, 'For your budding hipster kid. Gee are you sure about this?', 20);
INSERT INTO `schools` VALUES('Phillips Exeter Academy', 'High', 19, 'Phillips Exeter Academy', 20);
INSERT INTO `schools` VALUES('Wannabe Snobby College Prep', 'High', 20, 'College preparatory: because you better be going to college!', 10);
INSERT INTO `schools` VALUES('Suburbia High', 'High', 21, 'Pay for a million-dollar shack in Suburbia just to go to this school', 2);
INSERT INTO `schools` VALUES('Inner City High School, Detroit', 'High', 22, 'Why you always be talkin'' ghetto? Get yo''self a propa'' e-ju-ma-kay-shun, kid!" ', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `specialItems`
--

CREATE TABLE `specialItems` (
  `sItemName` varchar(20) NOT NULL,
  `itemDescription` varchar(200) DEFAULT NULL,
  `itemPic` longblob,
  `sItemID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`sItemID`),
  KEY `sItemName` (`sItemName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `specialItems`
--


--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `characters` (`studentID`);

--
-- Constraints der Tabelle `charEvents`
--
ALTER TABLE `charEvents`
  ADD CONSTRAINT `charEvents_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `characters` (`studentID`),
  ADD CONSTRAINT `charEvents_ibfk_2` FOREIGN KEY (`eventID`) REFERENCES `events` (`eventID`);

--
-- Constraints der Tabelle `charGrades`
--
ALTER TABLE `charGrades`
  ADD CONSTRAINT `charGrades_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `characters` (`studentID`),
  ADD CONSTRAINT `charGrades_ibfk_2` FOREIGN KEY (`gradeID`) REFERENCES `grades` (`gradeID`);

--
-- Constraints der Tabelle `charSchool`
--
ALTER TABLE `charSchool`
  ADD CONSTRAINT `charSchool_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `characters` (`studentID`),
  ADD CONSTRAINT `charSchool_ibfk_2` FOREIGN KEY (`schoolID`) REFERENCES `schools` (`schoolID`);

--
-- Constraints der Tabelle `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `characters` (`studentID`),
  ADD CONSTRAINT `purchases_ibfk_2` FOREIGN KEY (`itemID`) REFERENCES `items` (`itemID`);
