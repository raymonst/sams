# ************************************************************
# Sequel Pro SQL dump
# Version 4135
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.5.42)
# Database: applicants
# Generation Time: 2016-02-21 00:14:26 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table adults
# ------------------------------------------------------------

DROP TABLE IF EXISTS `adults`;

CREATE TABLE `adults` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `householdID` int(11) DEFAULT NULL,
  `firstName` varchar(64) DEFAULT NULL,
  `lastName` varchar(64) DEFAULT NULL,
  `earningsAmount` int(8) DEFAULT NULL,
  `earningsFrequency` varchar(16) DEFAULT NULL,
  `assistanceAmount` int(8) DEFAULT NULL,
  `assistanceFrequency` varchar(16) DEFAULT NULL,
  `pensionAmount` int(8) DEFAULT NULL,
  `pensionFrequency` varchar(16) DEFAULT NULL,
  `annualEarnings` int(8) DEFAULT NULL,
  `annualAssistance` int(8) DEFAULT NULL,
  `annualPension` int(8) DEFAULT NULL,
  `annual` int(8) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table children
# ------------------------------------------------------------

DROP TABLE IF EXISTS `children`;

CREATE TABLE `children` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `householdID` int(11) DEFAULT NULL,
  `firstName` varchar(64) DEFAULT NULL,
  `middleInitial` varchar(1) DEFAULT NULL,
  `lastName` varchar(64) DEFAULT NULL,
  `studentStatus` varchar(8) DEFAULT NULL,
  `fosterStatus` varchar(8) DEFAULT NULL,
  `headstartStatus` varchar(16) DEFAULT NULL,
  `homelessMigrantRunawayStatus` varchar(32) DEFAULT NULL,
  `earningsAmount` int(8) DEFAULT NULL,
  `earningsFrequency` varchar(16) DEFAULT NULL,
  `socialAmount` int(8) DEFAULT NULL,
  `socialFrequency` varchar(16) DEFAULT NULL,
  `otherHouseholdAmount` int(8) DEFAULT NULL,
  `otherHouseholdFrequency` varchar(16) DEFAULT NULL,
  `otherAmount` int(8) DEFAULT NULL,
  `otherFrequency` varchar(16) DEFAULT NULL,
  `annualEarnings` int(8) DEFAULT NULL,
  `annualSocial` int(8) DEFAULT NULL,
  `annualOtherHousehold` int(8) DEFAULT NULL,
  `annualOther` int(8) DEFAULT NULL,
  `annual` int(8) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table household
# ------------------------------------------------------------

DROP TABLE IF EXISTS `household`;

CREATE TABLE `household` (
  `householdID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `householdIncome` int(11) DEFAULT NULL,
  `householdSize` int(3) DEFAULT NULL,
  `assistanceStatus` varchar(16) DEFAULT NULL,
  `assistanceCaseNumber` varchar(64) DEFAULT NULL,
  `contactInfoStreet` varchar(128) DEFAULT NULL,
  `contactInfoApt` varchar(8) DEFAULT NULL,
  `contactInfoCity` varchar(64) DEFAULT NULL,
  `contactInfoState` varchar(2) DEFAULT NULL,
  `contactInfoZIP` varchar(16) DEFAULT NULL,
  `contactInfoPhone` varchar(16) DEFAULT NULL,
  `contactInfoEmail` varchar(128) DEFAULT NULL,
  `contactInfoName` varchar(128) DEFAULT NULL,
  `ssnStatus` varchar(8) DEFAULT '',
  `ssnNumber` int(4) DEFAULT NULL,
  `ethnicity` varchar(512) DEFAULT NULL,
  `race` varchar(256) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`householdID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
