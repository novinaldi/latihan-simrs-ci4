/*
SQLyog Enterprise v12.5.1 (64 bit)
MySQL - 8.0.20 : Database - dbrawatinap
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `kamar` */

DROP TABLE IF EXISTS `kamar`;

CREATE TABLE `kamar` (
  `kamarkode` char(5) NOT NULL,
  `kamarnm` varchar(100) DEFAULT NULL,
  `kamarstt` char(1) DEFAULT '0',
  PRIMARY KEY (`kamarkode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Table structure for table `pasien` */

DROP TABLE IF EXISTS `pasien`;

CREATE TABLE `pasien` (
  `pasienno` char(6) NOT NULL,
  `pasiennoktp` char(16) DEFAULT NULL,
  `pasiennama` varchar(100) DEFAULT NULL,
  `pasienalamat` varchar(100) DEFAULT NULL,
  `pasienjk` char(1) DEFAULT NULL,
  `pasientelp` char(20) DEFAULT NULL,
  PRIMARY KEY (`pasienno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Table structure for table `penyakit` */

DROP TABLE IF EXISTS `penyakit`;

CREATE TABLE `penyakit` (
  `penyakitid` int NOT NULL AUTO_INCREMENT,
  `penyakitnm` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`penyakitid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Table structure for table `rawatinap` */

DROP TABLE IF EXISTS `rawatinap`;

CREATE TABLE `rawatinap` (
  `rawatkode` char(20) NOT NULL,
  `rawattgl` date DEFAULT NULL,
  `rawatpasienno` char(6) DEFAULT NULL,
  `rawatpenyakitid` int DEFAULT NULL,
  `rawatkamarkode` char(5) DEFAULT NULL,
  PRIMARY KEY (`rawatkode`),
  KEY `rawatpasienno` (`rawatpasienno`),
  KEY `rawatpenyakitid` (`rawatpenyakitid`),
  KEY `rawatkamarkode` (`rawatkamarkode`),
  CONSTRAINT `rawatinap_ibfk_1` FOREIGN KEY (`rawatpasienno`) REFERENCES `pasien` (`pasienno`) ON UPDATE CASCADE,
  CONSTRAINT `rawatinap_ibfk_2` FOREIGN KEY (`rawatpenyakitid`) REFERENCES `penyakit` (`penyakitid`) ON UPDATE CASCADE,
  CONSTRAINT `rawatinap_ibfk_3` FOREIGN KEY (`rawatkamarkode`) REFERENCES `kamar` (`kamarkode`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `userid` char(20) NOT NULL,
  `usernama` varchar(100) DEFAULT NULL,
  `userpass` varchar(100) DEFAULT NULL,
  `userfoto` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
