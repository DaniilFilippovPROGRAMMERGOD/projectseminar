-- MySQL dump 10.13  Distrib 8.0.5, for Win64 (x86_64)
--
-- Host: localhost    Database: projectseminar
-- ------------------------------------------------------
-- Server version	5.7.38-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8mb4 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `product` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) NOT NULL,
  `quality_control_id` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `category` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `car_manufacturer_ID_fk` (`supplier_id`),
  KEY `car_traffic_police_ID_fk` (`quality_control_id`),
  CONSTRAINT `FK_C` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`ID`),
  CONSTRAINT `FK_D` FOREIGN KEY (`quality_control_id`) REFERENCES `quality_control` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (3,3,4,120,'ab-a'),(4,4,4,370,'cd-b'),(5,5,5,620,'ab-c'),(6,6,6,870,'cd-d'),(7,7,7,1120,'ab-e'),(8,8,8,1370,'cd-f'),(9,9,9,1620,'ab-a'),(10,10,10,1870,'cd-b'),(11,11,11,2120,'ab-c'),(12,1,1,2370,'cd-d'),(13,2,2,2620,'ab-e'),(14,3,3,2870,'cd-f'),(15,4,4,3120,'ab-a'),(16,5,5,3370,'cd-b'),(17,6,6,3620,'ab-c'),(18,7,7,3870,'cd-d'),(19,8,8,4120,'ab-e'),(20,9,9,4370,'cd-f'),(21,10,10,4620,'ab-a'),(22,11,11,4870,'cd-b'),(23,1,1,4754,'ab-c'),(24,2,2,4638,'cd-d'),(25,3,3,4522,'ab-e'),(26,4,4,4406,'cd-f'),(27,5,5,4290,'ab-a'),(28,6,6,4174,'cd-b'),(29,7,7,4058,'ab-c'),(30,8,8,3942,'cd-d'),(31,9,9,3826,'ab-e'),(33,11,11,3710,'cd-f'),(34,1,1,3594,'ab-a'),(35,2,2,3478,'cd-b'),(36,3,3,3362,'ab-c'),(37,4,4,3246,'cd-d'),(38,5,5,3130,'ab-e'),(39,6,6,3014,'cd-f'),(40,7,7,2898,'ab-a'),(41,8,8,2782,'cd-b'),(42,9,9,2666,'ab-c'),(43,10,10,2550,'cd-d'),(44,11,11,2434,'ab-e'),(45,1,1,2318,'cd-f'),(46,2,2,2202,'ab-a'),(47,3,3,2086,'cd-b'),(48,4,4,1970,'ab-c'),(49,5,5,1854,'cd-d'),(50,6,6,1738,'ab-a'),(51,7,7,1622,'cd-b'),(52,8,8,1506,'ab-c'),(53,9,9,1390,'cd-d'),(54,10,10,1274,'ab-a'),(55,11,11,1158,'cd-b'),(56,1,1,1042,'ab-c'),(57,2,2,926,'cd-d'),(58,3,3,810,'ab-a'),(59,4,4,694,'cd-b'),(60,5,5,578,'ab-c'),(61,3,2,462,'cd-d'),(62,3,2,346,'ab-a'),(63,3,2,230,'cd-b'),(66,11,11,114,'ab-c'),(67,10,10,4343,'cd-d'),(71,3,1,2321,'fsd');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_sold`
--

DROP TABLE IF EXISTS `products_sold`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `products_sold` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `shopper_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `cars_sold_car_ID_fk` (`product_id`),
  KEY `cars_sold_dealer_ID_fk` (`shopper_id`),
  CONSTRAINT `FK_A` FOREIGN KEY (`product_id`) REFERENCES `product` (`ID`),
  CONSTRAINT `FK_b` FOREIGN KEY (`shopper_id`) REFERENCES `shopper` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_sold`
--

LOCK TABLES `products_sold` WRITE;
/*!40000 ALTER TABLE `products_sold` DISABLE KEYS */;
INSERT INTO `products_sold` VALUES (1,19,26,100),(2,3,62,1000),(3,39,8,1900),(4,24,46,2800),(5,39,58,3700),(6,16,29,4600),(7,51,29,5500),(8,36,55,6400),(9,59,28,7300),(10,55,21,8200),(11,38,54,4400),(12,10,26,4300),(13,7,55,4200),(14,18,41,4100),(16,47,31,4000),(17,19,4,3900),(18,47,34,3800),(19,13,25,3700),(20,16,8,3600),(21,37,7,3500),(23,12,46,3400),(24,40,8,3300),(25,49,13,3200),(26,52,11,3100),(27,9,48,3000),(28,36,3,2900),(29,37,12,2800),(30,36,51,2700),(31,5,51,2600),(32,51,56,2500),(33,52,57,2400),(34,33,47,2300),(35,59,41,2200),(36,8,5,2100),(37,33,12,2000),(38,48,56,1900),(39,51,57,1800),(40,52,16,1700),(41,31,21,1600),(42,39,58,1500),(43,16,35,1400),(44,41,30,1300),(45,58,41,1200),(46,19,48,1100),(47,24,56,1000),(48,43,20,900),(49,54,31,800),(50,25,46,700),(51,17,16,600),(52,44,30,500),(53,7,33,400),(54,55,34,300),(55,19,54,200),(56,58,23,100),(57,58,7,32),(58,50,57,312),(59,38,26,543),(60,59,52,5234);
/*!40000 ALTER TABLE `products_sold` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quality_control`
--

DROP TABLE IF EXISTS `quality_control`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `quality_control` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `region` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `license_from` datetime NOT NULL,
  `belivable` float NOT NULL,
  `country` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `traffic_police_state_id_uindex` (`region`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quality_control`
--

LOCK TABLES `quality_control` WRITE;
/*!40000 ALTER TABLE `quality_control` DISABLE KEYS */;
INSERT INTO `quality_control` VALUES (1,'ef','2014-05-04 11:30:43',0.1,'russia'),(2,'we','2014-05-04 11:30:44',0.2,'usa'),(3,'ew','2014-05-04 11:30:45',0.3,'canada'),(4,'rr','2014-05-04 11:30:46',0.4,'italia'),(5,'df','2014-05-04 11:30:47',0.5,'france'),(6,'gd','2014-05-04 11:30:48',0.6,'germany'),(7,'sd','2014-05-04 11:30:49',0.7,'greece'),(8,'effsd','2014-05-04 11:30:50',0.8,'romania'),(9,'wef','2014-05-04 11:30:51',0.9,'latvia'),(10,'dd','2014-05-04 11:30:52',1,'china'),(11,'gdf','2014-05-04 11:30:53',0.14,'indonesia');
/*!40000 ALTER TABLE `quality_control` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shopper`
--

DROP TABLE IF EXISTS `shopper`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `shopper` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `city` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `belivable` float NOT NULL DEFAULT '0',
  `money` int(11) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shopper`
--

LOCK TABLES `shopper` WRITE;
/*!40000 ALTER TABLE `shopper` DISABLE KEYS */;
INSERT INTO `shopper` VALUES (2,'a',0.08,4400,1),(3,'b',0.21,5753,0),(4,'c',0.34,7106,0),(5,'d',0.47,8459,1),(6,'e',0.6,9812,0),(7,'f',0.73,11165,1),(8,'a',0.86,12518,1),(9,'b',0.99,13871,0),(10,'c',0.112,15224,0),(11,'d',0.125,16577,0),(12,'e',0.138,17930,0),(13,'f',0.151,19283,0),(14,'a',0.164,20636,0),(15,'b',0.177,21989,0),(16,'c',0.19,23342,0),(17,'d',0.203,24695,0),(18,'e',0.216,26048,0),(19,'f',0.229,27401,0),(20,'a',0.242,28754,0),(21,'b',0.255,30107,1),(22,'c',0.268,31460,1),(23,'d',0.281,32813,1),(24,'e',0.294,34166,1),(25,'f',0.307,35519,1),(26,'a',0.32,36872,1),(27,'b',0.333,38225,1),(28,'c',0.346,39578,1),(29,'d',0.359,40931,1),(30,'e',0.372,42284,1),(31,'f',0.385,43637,1),(32,'a',0.398,44990,1),(33,'b',0.411,46343,1),(34,'c',0.424,47696,1),(35,'d',0.437,49049,1),(36,'e',0.45,50402,1),(37,'f',0.463,51755,1),(38,'a',0.476,53108,1),(39,'b',0.489,54461,1),(40,'c',0.502,55814,1),(41,'d',0.515,57167,1),(42,'e',0.528,58520,1),(43,'f',0.541,59873,1),(44,'a',0.554,61226,1),(45,'b',0.567,62579,0),(46,'c',0.58,63932,0),(47,'d',0.593,65285,0),(48,'a',0.606,66638,0),(49,'b',0.619,67991,0),(50,'c',0.632,69344,0),(51,'d',0.645,70697,0),(52,'a',0.658,72050,0),(53,'b',0.671,73403,0),(54,'c',0.684,74756,0),(55,'d',0.697,76109,0),(56,'a',0.71,77462,0),(57,'b',0.723,78815,0),(58,'c',0.736,80168,0),(59,'d',0.749,81521,0),(60,'a',0.762,82874,0),(61,'b',0.775,84227,0),(62,'c',0.788,85580,0),(63,'d',0.801,86933,0);
/*!40000 ALTER TABLE `shopper` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `supplier` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `license_from` datetime NOT NULL,
  `region` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `belivable` float DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `manufacturer_name_uindex` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier`
--

LOCK TABLES `supplier` WRITE;
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;
INSERT INTO `supplier` VALUES (1,'ab','2002-08-04 23:59:59','russia',0.234),(2,'cewqd','2001-08-04 23:59:59','usa',0.245),(3,'aeqwb','2002-08-04 23:59:59','canada',0.256),(4,'cdewq','2003-08-04 23:59:59','italia',0.267),(5,'dfeqw','2004-08-04 23:59:59','france',0.278),(6,'dsa','2005-08-04 23:59:59','germany',0.289),(7,'daeqws','2006-08-04 23:59:59','greece',0.3),(8,'ffffas','2007-08-04 23:59:59','romania',0.311),(9,'ewq','2008-08-04 23:59:59','latvia',0.322),(10,'eqw','2009-08-04 23:59:59','china',0.333),(11,'ewqdr','2010-08-04 23:59:59','indonesia',0.344);
/*!40000 ALTER TABLE `supplier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_id_uindex` (`id`),
  UNIQUE KEY `users_login_uindex` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'danya','$2y$10$su5yrjAneBVXHgP46OLsN.wkror38wTnZdu.XWi14cErgzkFohJuW');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-18  2:53:26
