CREATE DATABASE  IF NOT EXISTS `diu` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;
USE `diu`;
-- MySQL dump 10.13  Distrib 5.7.9, for osx10.9 (x86_64)
--
-- Host: localhost    Database: diu
-- ------------------------------------------------------
-- Server version	5.6.27

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
-- Table structure for table `Asistencia`
--

DROP TABLE IF EXISTS `Asistencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Asistencia` (
  `evento` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  PRIMARY KEY (`evento`,`usuario`),
  KEY `fk_Evento_has_Usuario_Usuario1_idx` (`usuario`),
  KEY `fk_Evento_has_Usuario_Evento1_idx` (`evento`),
  CONSTRAINT `fk_Evento_has_Usuario_Evento1` FOREIGN KEY (`evento`) REFERENCES `Evento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Evento_has_Usuario_Usuario1` FOREIGN KEY (`usuario`) REFERENCES `Usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Asistencia`
--

LOCK TABLES `Asistencia` WRITE;
/*!40000 ALTER TABLE `Asistencia` DISABLE KEYS */;
/*!40000 ALTER TABLE `Asistencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Empresa`
--

DROP TABLE IF EXISTS `Empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Empresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `CIF` varchar(9) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `fax` varchar(45) DEFAULT NULL,
  `descripcion` text NOT NULL,
  `imagen` varchar(45) NOT NULL,
  `representante` int(11) NOT NULL,
  `sala` int(11) DEFAULT NULL,
  `fechaInicio` datetime DEFAULT NULL,
  `fechaFin` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `CIF_UNIQUE` (`CIF`),
  KEY `fk_Empresa_Usuario1_idx` (`representante`),
  KEY `fk_Empresa_Sala1_idx` (`sala`),
  CONSTRAINT `fk_Empresa_Sala1` FOREIGN KEY (`sala`) REFERENCES `Sala` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Empresa_Usuario1` FOREIGN KEY (`representante`) REFERENCES `Usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Empresa`
--

LOCK TABLES `Empresa` WRITE;
/*!40000 ALTER TABLE `Empresa` DISABLE KEYS */;
INSERT INTO `Empresa` VALUES (1,'','OSL UGR','Calle falsa, 123','958282828','958282828','Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer signiferumque eu per. In usu latine equidem dolores. Quo no falli viris intellegam, ut fugit veritus placerat per.','assets/img/oslugr.png',2,NULL,NULL,NULL),(2,'123','Alsa','Calle 123','958123123','958123123','Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer signiferumque eu per. In usu latine equidem dolores. Quo no falli viris intellegam, ut fugit veritus placerat per.','assets/img/oslugr.png',2,NULL,NULL,NULL);
/*!40000 ALTER TABLE `Empresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Evento`
--

DROP TABLE IF EXISTS `Evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Evento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `fechaInicio` datetime NOT NULL,
  `fechaFin` datetime NOT NULL,
  `precio` float NOT NULL,
  `plazas` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `requisitos` text NOT NULL,
  `imagen` varchar(45) NOT NULL,
  `sala` int(11) DEFAULT NULL,
  `empresa` int(11) DEFAULT NULL,
  `usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Evento_Sala1_idx` (`sala`),
  KEY `fk_Evento_Empresa1_idx` (`empresa`),
  KEY `fk_Evento_Usuario1_idx` (`usuario`),
  CONSTRAINT `fk_Evento_Empresa1` FOREIGN KEY (`empresa`) REFERENCES `Empresa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Evento_Sala1` FOREIGN KEY (`sala`) REFERENCES `Sala` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Evento_Usuario1` FOREIGN KEY (`usuario`) REFERENCES `Usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Evento`
--

LOCK TABLES `Evento` WRITE;
/*!40000 ALTER TABLE `Evento` DISABLE KEYS */;
INSERT INTO `Evento` VALUES (1,'Hackathon Navideño','2015-12-27 12:30:00','0000-00-00 00:00:00',0,150,'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum','Portátil','assets/img/hackathon.jpg',NULL,1,NULL);
/*!40000 ALTER TABLE `Evento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Permisos`
--

DROP TABLE IF EXISTS `Permisos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Permisos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Permisos`
--

LOCK TABLES `Permisos` WRITE;
/*!40000 ALTER TABLE `Permisos` DISABLE KEYS */;
INSERT INTO `Permisos` VALUES (1,'Permisos Admin','Gestión Evento Admin, Gestión Empresa Admin, Gestionar Sala, Añadir Permisos'),(2,'Permisos Usuario','Gestión Evento Usuario, Gestión Empresa Usuario, Alquilar Sala, Apuntarse a Evento');
/*!40000 ALTER TABLE `Permisos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Sala`
--

DROP TABLE IF EXISTS `Sala`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Sala` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(45) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `planta` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `capacidad` int(11) NOT NULL,
  `imagen` varchar(45) NOT NULL DEFAULT 'assets/img/sala.jpg',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Sala`
--

LOCK TABLES `Sala` WRITE;
/*!40000 ALTER TABLE `Sala` DISABLE KEYS */;
INSERT INTO `Sala` VALUES (1,'empresa','Alhambra',1,3,500,'assets/img/sala.jpg'),(2,'evento','Contemporánea',2,1,200,'assets/img/sala.jpg'),(3,'evento','Sacromonte',2,2,20,'assets/img/salaSacromonte.jpg'),(4,'evento','Albaicín',2,3,50,'assets/img/salaAlbaicin.jpg');
/*!40000 ALTER TABLE `Sala` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Usuario`
--

DROP TABLE IF EXISTS `Usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(45) NOT NULL,
  `pass` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `sexo` varchar(45) DEFAULT NULL,
  `pais` varchar(45) DEFAULT NULL,
  `localidad` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `codigoPostal` varchar(45) DEFAULT NULL,
  `imagen` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login_UNIQUE` (`login`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Usuario`
--

LOCK TABLES `Usuario` WRITE;
/*!40000 ALTER TABLE `Usuario` DISABLE KEYS */;
INSERT INTO `Usuario` VALUES (1,'admin','c84258e9c39059a89ab77d846ddab909','admin@admin.com','Usuario Administrador','655555555','Hombre','España','Granada','Calle Falsa','18001','assets/img/user.png'),(2,'usuario','f8032d5cae3de20fcec887f395ec9a6a','usuario@usuario.com','Usuario normal','677777777','Hombre','España','Granada','Calle Falsa','18001','assets/img/user.png');
/*!40000 ALTER TABLE `Usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Usuario_Permisos`
--

DROP TABLE IF EXISTS `Usuario_Permisos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Usuario_Permisos` (
  `usuario` int(11) NOT NULL,
  `permiso` int(11) NOT NULL,
  PRIMARY KEY (`usuario`,`permiso`),
  KEY `fk_Usuario_has_Permisos_Permisos1_idx` (`permiso`),
  KEY `fk_Usuario_has_Permisos_Usuario_idx` (`usuario`),
  CONSTRAINT `fk_Usuario_has_Permisos_Permisos1` FOREIGN KEY (`permiso`) REFERENCES `Permisos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuario_has_Permisos_Usuario` FOREIGN KEY (`usuario`) REFERENCES `Usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Usuario_Permisos`
--

LOCK TABLES `Usuario_Permisos` WRITE;
/*!40000 ALTER TABLE `Usuario_Permisos` DISABLE KEYS */;
INSERT INTO `Usuario_Permisos` VALUES (1,1),(2,2);
/*!40000 ALTER TABLE `Usuario_Permisos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-12-05 18:05:53
