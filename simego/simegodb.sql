-- MySQL dump 10.13  Distrib 5.7.23, for Linux (x86_64)
--
-- Host: localhost    Database: simegodb
-- ------------------------------------------------------
-- Server version	5.7.23-0ubuntu0.18.04.1

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
-- Table structure for table `animal`
--

DROP TABLE IF EXISTS `animal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `animal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sexo` varchar(1) CHARACTER SET latin1 NOT NULL,
  `idpai` int(11) DEFAULT NULL,
  `idmae` int(11) DEFAULT NULL,
  `origem` varchar(1) CHARACTER SET latin1 DEFAULT NULL,
  `data_entrada` date DEFAULT NULL,
  `datahora` datetime DEFAULT CURRENT_TIMESTAMP,
  `brinco` varchar(6) CHARACTER SET latin1 DEFAULT NULL,
  `data_exclusao` datetime DEFAULT NULL,
  `idraca` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_animal_raca1_idx` (`idraca`),
  CONSTRAINT `fk_animal_raca1` FOREIGN KEY (`idraca`) REFERENCES `raca` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `animal`
--

LOCK TABLES `animal` WRITE;
/*!40000 ALTER TABLE `animal` DISABLE KEYS */;
INSERT INTO `animal` VALUES (18,'M',NULL,NULL,NULL,NULL,'2018-08-18 05:00:29','181001',NULL,1),(19,'F',NULL,NULL,NULL,NULL,'2018-08-18 05:44:00','180002',NULL,1),(20,'M',18,19,NULL,NULL,'2018-08-18 07:05:04','181003',NULL,1),(21,'F',NULL,NULL,NULL,NULL,'2018-08-18 07:13:19','182004','2018-08-18 07:17:46',3),(22,'M',NULL,NULL,NULL,NULL,'2018-08-18 07:14:11','183004',NULL,3),(23,'F',NULL,NULL,NULL,NULL,'2018-08-18 07:14:33','184005',NULL,3),(24,'M',22,23,NULL,NULL,'2018-08-18 07:14:48','185006',NULL,1),(25,'F',NULL,NULL,NULL,NULL,'2018-08-18 07:15:06','187006','2018-08-18 07:18:33',1),(26,'M',NULL,NULL,NULL,NULL,'2018-08-18 07:15:22','188007',NULL,1),(27,'F',NULL,NULL,NULL,NULL,'2018-08-18 07:15:52','189008',NULL,1),(28,'M',22,19,NULL,NULL,'2018-08-18 07:16:13','181010',NULL,3),(29,'F',NULL,NULL,NULL,NULL,'2018-08-18 07:16:33','181111',NULL,1),(30,'F',22,23,NULL,NULL,'2018-08-18 07:18:03','181212',NULL,3),(31,'F',NULL,NULL,NULL,NULL,'2018-08-18 07:18:43','181313',NULL,1),(32,'M',24,29,NULL,NULL,'2018-08-18 07:40:19','181025',NULL,3),(33,'F',18,30,NULL,NULL,'2018-08-18 07:41:07','180026',NULL,1);
/*!40000 ALTER TABLE `animal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cobertura`
--

DROP TABLE IF EXISTS `cobertura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cobertura` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` date NOT NULL,
  `datahora` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `consanguinidade` decimal(5,4) DEFAULT NULL,
  `idmacho` int(11) NOT NULL,
  `idfemea` int(11) NOT NULL,
  `data_exclusao` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cobertura_animal_idx` (`idmacho`),
  KEY `fk_cobertura_animal1_idx` (`idfemea`),
  CONSTRAINT `fk_cobertura_animal` FOREIGN KEY (`idmacho`) REFERENCES `animal` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cobertura_animal1` FOREIGN KEY (`idfemea`) REFERENCES `animal` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cobertura`
--

LOCK TABLES `cobertura` WRITE;
/*!40000 ALTER TABLE `cobertura` DISABLE KEYS */;
INSERT INTO `cobertura` VALUES (1,'2018-08-18','2018-08-18 05:51:48',0.2500,18,19,'2018-08-18 05:56:28'),(2,'2018-08-18','2018-08-18 05:52:12',0.0000,18,19,'2018-08-18 06:41:13'),(3,'2018-08-17','2018-08-18 07:08:40',0.0000,18,19,'2018-08-18 07:36:10'),(4,'2018-08-18','2018-08-18 07:30:24',0.0000,24,30,'2018-08-18 07:36:07'),(5,'2018-08-18','2018-08-18 07:36:25',0.2500,24,30,NULL),(6,'2018-08-18','2018-08-18 07:37:38',0.1250,28,30,NULL),(7,'2018-08-17','2018-08-18 07:41:34',0.0625,32,33,NULL),(8,'2018-08-18','2018-08-18 07:41:52',0.0000,18,19,NULL),(9,'2018-08-18','2018-08-18 08:46:08',0.0000,18,19,'2018-08-18 08:47:42');
/*!40000 ALTER TABLE `cobertura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `raca`
--

DROP TABLE IF EXISTS `raca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `raca` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(30) CHARACTER SET latin1 NOT NULL,
  `data_exclusao` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `raca`
--

LOCK TABLES `raca` WRITE;
/*!40000 ALTER TABLE `raca` DISABLE KEYS */;
INSERT INTO `raca` VALUES (1,'Corriedale',NULL),(2,'asd','2018-08-18 04:25:11'),(3,'Morada Nova',NULL);
/*!40000 ALTER TABLE `raca` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `senha` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-08-18  8:50:45
