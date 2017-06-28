-- MySQL dump 10.16  Distrib 10.1.24-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: duralex
-- ------------------------------------------------------
-- Server version	10.1.24-MariaDB-1~trusty

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
-- Table structure for table `abogado`
--

DROP TABLE IF EXISTS `abogado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `abogado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rut` varchar(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `Fecha_contratacion` date NOT NULL,
  `especialidad` varchar(255) NOT NULL,
  `valor_hora` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `abogado`
--

LOCK TABLES `abogado` WRITE;
/*!40000 ALTER TABLE `abogado` DISABLE KEYS */;
INSERT INTO `abogado` VALUES (1,'12439856','Maria','Torres','2015-04-04','Familia',2500),(2,'15963652','Consuelo','Villalabeitia','2015-04-01','Ambientalista',30000),(3,'16543284','Florencia','iturrieta','2016-06-09','Civil',28000),(4,'18456938','Marcelo','Pinilla','2016-05-26','Comercial',25000),(5,'17236549','Francisco Javier','Chacon','2016-08-16','Penalista',40000),(6,'18354163','Leopoldo ','Vallejos','2017-03-25','Constitucional',26000);
/*!40000 ALTER TABLE `abogado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `atencion`
--

DROP TABLE IF EXISTS `atencion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `atencion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fechayhora` datetime NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `abogado_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_atencion_usuario_idx` (`usuario_id`),
  KEY `fk_atencion_abogado1_idx` (`abogado_id`),
  CONSTRAINT `fk_atencion_abogado1` FOREIGN KEY (`abogado_id`) REFERENCES `abogado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_atencion_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atencion`
--

LOCK TABLES `atencion` WRITE;
/*!40000 ALTER TABLE `atencion` DISABLE KEYS */;
INSERT INTO `atencion` VALUES (1,'2017-02-05 08:14:37',1,1,2),(2,'2016-11-08 10:07:16',2,2,5),(3,'2017-02-21 11:14:12',3,3,6),(4,'2017-05-16 07:30:26',4,4,5);
/*!40000 ALTER TABLE `atencion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rut` varchar(8) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `fecha_incorporacion` date NOT NULL,
  `tipo_persona` tinyint(1) NOT NULL DEFAULT '0',
  `direccion` varchar(255) NOT NULL,
  `telefonos` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `perfil` tinyint(1) NOT NULL,
  `gestor` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'18456741','Javier','Cisterna','2016-05-21',2,'Las Tranqueras #444','28584898','356a192b7913b04c54574d18c28d46e6395428ab',1,1),(2,'17235461','Juan Pablo','Toledo','2017-02-01',2,'Las Hualtatas #4665','23546578','356a192b7913b04c54574d18c28d46e6395428ab',2,1),(3,'12354655','Javiera','Ulloa','2017-01-11',1,'Eyzaguirre #234','234567834','356a192b7913b04c54574d18c28d46e6395428ab',3,1),(4,'15346572','Catalina','Lopez','2017-02-25',1,'Alto Palena #245','213456987','356a192b7913b04c54574d18c28d46e6395428ab',0,0);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-06-28 19:37:53
