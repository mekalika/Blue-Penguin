-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 05. August 2011 um 19:59
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=66 ;

--
-- Daten für Tabelle `accounts`
--

INSERT INTO `accounts` VALUES(14, 'a', 119);
INSERT INTO `accounts` VALUES(15, 'a', 120);
INSERT INTO `accounts` VALUES(16, 'a', 121);
INSERT INTO `accounts` VALUES(59, 'a', 177);
INSERT INTO `accounts` VALUES(60, 'a', 178);
INSERT INTO `accounts` VALUES(61, 'a', 179);
INSERT INTO `accounts` VALUES(62, 'a', 180);
INSERT INTO `accounts` VALUES(63, 'a', 181);
INSERT INTO `accounts` VALUES(64, 'a', 182);
INSERT INTO `accounts` VALUES(65, 'a', 183);

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
  `pianoMultiplier` float NOT NULL DEFAULT '1',
  `pianoSkillLevel` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `violinMultiplier` float NOT NULL DEFAULT '1',
  `violinSkillLevel` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `athleticsMultiplier` float NOT NULL DEFAULT '1',
  `athleticsSkillLevel` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `danceMultiplier` float NOT NULL DEFAULT '1',
  `danceSkillLevel` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `languageMultiplier` float NOT NULL DEFAULT '1',
  `languageSkillLevel` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `scienceMultiplier` float NOT NULL DEFAULT '1',
  `scienceSkillLevel` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `mathMultiplier` float NOT NULL DEFAULT '1',
  `mathSkillLevel` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `historyMultiplier` float NOT NULL DEFAULT '1',
  `historySkillLevel` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `chineseMultiplier` float NOT NULL DEFAULT '1',
  `chineseSkillLevel` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `chineseEXP` smallint(5) unsigned NOT NULL DEFAULT '0',
  `mathEXP` smallint(5) unsigned NOT NULL DEFAULT '0',
  `languageEXP` smallint(5) unsigned NOT NULL DEFAULT '0',
  `scienceEXP` smallint(5) unsigned NOT NULL DEFAULT '0',
  `historyEXP` smallint(5) unsigned NOT NULL DEFAULT '0',
  `athleticsEXP` smallint(5) unsigned NOT NULL DEFAULT '0',
  `danceEXP` smallint(5) unsigned NOT NULL DEFAULT '0',
  `violinEXP` smallint(5) unsigned NOT NULL DEFAULT '0',
  `pianoEXP` smallint(5) unsigned NOT NULL DEFAULT '0',
  `lastAction` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`studentID`),
  UNIQUE KEY `name_2` (`name`),
  KEY `name` (`name`),
  KEY `inappropriate` (`inappropriate`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=184 ;

--
-- Daten für Tabelle `characters`
--

INSERT INTO `characters` VALUES('Sarah', '1', -1, NULL, 19530, 3, 3, 10, 8, 100, 100, 0, 0, 0, NULL, 0, 119, 1.24336, 1, 1.2286, 1, 0.905265, 1, 0.913305, 1, 1.49453, 1, 1.05998, 1, 1.26762, 1, 0.817767, 1, 1.32351, 1, 0, 0, 0, 0, 0, 0, 0, 0, 22, 1312599225);
INSERT INTO `characters` VALUES('Andrew', '0', -1, NULL, 19530, 3, 3, 10, 8, 100, 100, 0, 0, 0, NULL, 0, 120, 0.930013, 1, 1.04268, 1, 1.44523, 1, 1.12676, 1, 1.3171, 1, 0.984446, 1, 1.06264, 1, 1.11101, 1, 0.853535, 1, 0, 0, 0, 0, 0, 0, 0, 0, 22, 1312599225);
INSERT INTO `characters` VALUES('Mai', '1', -1, NULL, 19530, 3, 3, 10, 8, 100, 100, 0, 0, 0, NULL, 0, 121, 0.708288, 1, 1.37747, 1, 1.17255, 1, 0.672108, 1, 0.675036, 1, 1.30769, 1, 0.883496, 1, 0.784929, 1, 1.17204, 1, 0, 0, 0, 0, 0, 0, 0, 0, 22, 1312599225);
INSERT INTO `characters` VALUES('Yik Quin', '0', 7, NULL, 19530, 3, 3, 10, 8, 100, 100, 0, 0, 80, NULL, 0, 177, 0.916095, 1, 1.04745, 1, 1.0156, 1, 0.799471, 1, 1.1108, 1, 1.12435, 1, 1.22965, 1, 1.07472, 1, 1.14189, 1, 0, 0, 0, 0, 0, 0, 0, 0, 22, 1312599225);
INSERT INTO `characters` VALUES('Alan', '0', 7, NULL, 19530, 3, 3, 10, 8, 100, 100, 0, 0, 80, NULL, 0, 178, 1.38711, 1, 0.914191, 1, 0.809026, 1, 1.18117, 1, 0.905505, 1, 0.98108, 1, 1.00737, 1, 1.15053, 1, 0.978157, 1, 0, 0, 0, 0, 0, 0, 0, 0, 22, 1312599225);
INSERT INTO `characters` VALUES('Cutie', '0', 7, NULL, 19530, 3, 3, 10, 8, 100, 100, 0, 0, 80, NULL, 0, 179, 0.70979, 1, 0.707622, 1, 0.66779, 1, 0.802598, 1, 0.707734, 1, 1.45146, 1, 0.855485, 1, 1.08289, 1, 1.12035, 1, 0, 0, 0, 0, 0, 0, 0, 0, 22, 1312599225);
INSERT INTO `characters` VALUES('Melissa', '1', 7, NULL, 19530, 3, 3, 10, 8, 100, 100, 0, 0, 80, NULL, 0, 180, 1.12586, 1, 1.04534, 1, 0.700485, 1, 0.842055, 1, 0.867009, 1, 1.28393, 1, 1.02162, 1, 1.39377, 1, 0.885014, 1, 0, 0, 0, 0, 0, 0, 0, 0, 22, 1312599225);
INSERT INTO `characters` VALUES('alan2', '0', -1, NULL, 19530, 3, 3, 10, 8, 100, 100, 0, 0, 0, NULL, 0, 181, 0.988464, 1, 1.071, 1, 1.11155, 1, 1.12144, 1, 1.33098, 1, 0.987985, 1, 0.852966, 1, 1.0498, 1, 1.05636, 1, 0, 0, 0, 0, 0, 0, 0, 0, 22, 1312599225);
INSERT INTO `characters` VALUES('Joy', '1', -1, NULL, 19530, 3, 3, 10, 8, 100, 100, 0, 0, 0, NULL, 0, 182, 0.969612, 1, 1.06309, 1, 0.826966, 1, 1.72638, 1, 0.935493, 1, 0.735907, 1, 0.739156, 1, 1.4052, 1, 0.758362, 1, 0, 0, 0, 0, 0, 0, 0, 0, 22, 1312599225);
INSERT INTO `characters` VALUES('Joyce', '1', -1, NULL, 19530, 3, 3, 10, 8, 100, 100, 0, 0, 0, NULL, 0, 183, 1.05307, 1, 1.38139, 1, 0.789471, 1, 1.17686, 1, 1.06329, 1, 0.885745, 1, 1.18309, 1, 1.05977, 1, 0.704734, 1, 0, 0, 0, 0, 0, 0, 0, 0, 22, 1312599225);

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


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `events`
--

CREATE TABLE `events` (
  `eventName` varchar(20) NOT NULL,
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
  `category` tinyint(1) unsigned NOT NULL,
  `timeLimit` int(10) unsigned NOT NULL,
  `eGradeLevel` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`eventID`),
  KEY `eventName` (`eventName`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `events`
--

INSERT INTO `events` VALUES('Practice piano', 235, 1, 'How do you get to Carnegie Hall? Practice!', 'Piano', 5, NULL, NULL, NULL, NULL, 1, '', 0, 0, -1);

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
  `itemName` varchar(20) NOT NULL,
  `itemType` varchar(20) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `picture` longblob,
  `bonus` float NOT NULL DEFAULT '1',
  `number` tinyint(3) unsigned DEFAULT NULL,
  `itemSkill` varchar(10) NOT NULL,
  `itemID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`itemID`),
  KEY `itemName` (`itemName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `items`
--


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
INSERT INTO `schools` VALUES('Hunter College Elementary, NYC', 'Elementary', 7, 'Take an IQ test to get into this competitive NYC school; no prob for your budding Einstein, or?', 20);
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
INSERT INTO `schools` VALUES('Wannabe Snobby Private School', 'High', 20, 'Sure they advertise in Newsweek, but that''s only because they''re never in the news otherwise', 10);
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
