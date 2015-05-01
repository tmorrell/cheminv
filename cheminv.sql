-- MySQL dump 10.13  Distrib 5.1.56, for redhat-linux-gnu (x86_64)
--
-- Host: localhost    Database: ecdb
-- ------------------------------------------------------
-- Server version	5.1.56

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `category_head`
--

DROP TABLE IF EXISTS `category_head`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category_head` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_head`
--

LOCK TABLES `category_head` WRITE;
/*!40000 ALTER TABLE `category_head` DISABLE KEYS */;
INSERT INTO `category_head` VALUES (1,'Bulk Storage'),(2,'Refrigerators'),(3,'Corrosive Cabinets'),(4,'Flammable Cabinets'),(7,'Hoods'),(6,'Benches'),(5,'Chemical Room Storage');
/*!40000 ALTER TABLE `category_head` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_sub`
--

DROP TABLE IF EXISTS `category_sub`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category_sub` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_sub`
--

LOCK TABLES `category_sub` WRITE;
/*!40000 ALTER TABLE `category_sub` DISABLE KEYS */;
INSERT INTO `category_sub` VALUES (101,'Shelf 1'),(103,'Shelf 2'),(105,'Shelf 3'),(201,'Fridge 1'),(202,'Fridge 2'),(203,'Fridge 3'),(606,'Bench 6'),(301,'Cabinet 2'),(303,'Cabinet 6'),(304,'Cabinet 10'),(404,'Cabinet 4'),(401,'Cabinet 1'),(504,'Bin 4'),(302,'Cabinet 3'),(701,'Slide Cleaning'),(613,'Cell Culture'),(213,'Cell Culture'),(112,'Dessicator'),(612,'Bench 12'),(611,'Bench 11'),(610,'Bench 10'),(609,'Bench 9'),(608,'Bench 8'),(607,'Bench 7'),(416,'Cabinet 16'),(415,'Cabinet 15'),(501,'Bin 1'),(413,'Cabinet 13'),(412,'Cabinet 12'),(411,'Cabinet 11'),(502,'Bin 2'),(409,'Cabinet 9'),(408,'Cabinet 8'),(407,'Cabinet 7'),(503,'Bin 3'),(405,'Cabinet 5'),(505,'Bin 5'),(506,'Bin 6'),(601,'Bench 1'),(602,'Bench 2'),(603,'Bench 3'),(604,'Bench 4'),(605,'Bench 5'),(305,'Cabinet 14'),(212,'Fridge 12'),(211,'Fridge 11'),(210,'Fridge 10'),(209,'Fridge 9'),(208,'Fridge 8'),(207,'Fridge 7'),(206,'Fridge 6'),(205,'Fridge 5'),(110,'Shelf 5 T'),(108,'Shelf 4 T'),(106,'Shelf 3 T'),(104,'Shelf 2 T'),(102,'Shelf 1 T'),(111,'Shelf 6'),(109,'Shelf 5'),(107,'Shelf 4'),(204,'Fridge 4');
/*!40000 ALTER TABLE `category_sub` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data`
--

DROP TABLE IF EXISTS `data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `manufacturer` varchar(64) NOT NULL,
  `cas_number` varchar(64) NOT NULL,
  `amount` varchar(11) NOT NULL,
  `quantity` varchar(11) NOT NULL,
  `order_quantity` varchar(11) NOT NULL DEFAULT '0',
  `item_number` varchar(32) NOT NULL,
  `scrap` varchar(3) NOT NULL DEFAULT 'No',
  `width` varchar(11) DEFAULT NULL,
  `height` varchar(11) DEFAULT NULL,
  `depth` varchar(11) DEFAULT NULL,
  `weight` varchar(11) DEFAULT NULL,
  `datasheet` varchar(256) NOT NULL,
  `comment` text NOT NULL,
  `category` varchar(11) NOT NULL,
  `public` varchar(3) NOT NULL DEFAULT 'No',
  `barcode` varchar(45) NOT NULL,
  `barcode2` varchar(256) NOT NULL,
  `barcode3` varchar(256) NOT NULL,
  `barcode4` varchar(256) NOT NULL,
  `barcode5` varchar(256) NOT NULL,
  `barcode6` varchar(45) NOT NULL,
  `barcode7` varchar(45) NOT NULL,
  `price` varchar(11) NOT NULL,
  `volume` varchar(45) NOT NULL,
  `datea` varchar(45) NOT NULL,
  `dateo` varchar(45) NOT NULL,
  `datex` varchar(45) NOT NULL,
  `onorder` varchar(45) NOT NULL,
  `mw` varchar(45) NOT NULL,
  `archived` varchar(11) NOT NULL DEFAULT '0',
  `datearchived` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `Id` (`id`),
  KEY `owner` (`owner`)
) ENGINE=MyISAM AUTO_INCREMENT=759 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `login` varchar(32) NOT NULL,
  `mail` varchar(32) NOT NULL,
  `passwd` varchar(32) NOT NULL,
  `admin` int(11) NOT NULL DEFAULT '0',
  `measurement` int(11) NOT NULL DEFAULT '1',
  `currency` varchar(3) NOT NULL DEFAULT 'USD',
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`member_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1801 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (4,'Haw Yang','Lab','demo','mail@mailen.com','fe01ce2a7fbac8fafaed7c982a04e229',0,1,'USD','2014-03-19 18:41:50');
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members_stats`
--

DROP TABLE IF EXISTS `members_stats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members_stats` (
  `members_stats_id` int(11) NOT NULL AUTO_INCREMENT,
  `members_stats_member` int(11) NOT NULL,
  `members_stats_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`members_stats_id`)
) ENGINE=MyISAM AUTO_INCREMENT=217 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_owner` int(11) NOT NULL,
  `project_name` varchar(64) NOT NULL,
  PRIMARY KEY (`project_id`),
  KEY `project_owner` (`project_owner`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects_data`
--

DROP TABLE IF EXISTS `projects_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects_data` (
  `projects_data_id` int(11) NOT NULL AUTO_INCREMENT,
  `projects_data_owner_id` int(11) NOT NULL,
  `projects_data_project_id` int(11) NOT NULL,
  `projects_data_component_id` int(11) NOT NULL,
  `projects_data_quantity` int(11) NOT NULL,
  PRIMARY KEY (`projects_data_id`),
  KEY `owner_id` (`projects_data_owner_id`),
  KEY `project_id` (`projects_data_project_id`),
  KEY `component_id` (`projects_data_component_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects_data`
--

LOCK TABLES `projects_data` WRITE;
/*!40000 ALTER TABLE `projects_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `projects_data` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-05-01 15:01:42
