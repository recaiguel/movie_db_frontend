-- MySQL dump 10.13  Distrib 8.4.8, for Linux (x86_64)
--
-- Host: localhost    Database: filmdb
-- ------------------------------------------------------
-- Server version	8.4.8-0ubuntu1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `film_genre`
--

DROP TABLE IF EXISTS `film_genre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `film_genre` (
  `filmeID` int NOT NULL,
  `genreID` int NOT NULL,
  PRIMARY KEY (`filmeID`,`genreID`),
  KEY `genreID` (`genreID`),
  CONSTRAINT `film_genre_ibfk_1` FOREIGN KEY (`genreID`) REFERENCES `genre` (`id`),
  CONSTRAINT `film_genre_ibfk_2` FOREIGN KEY (`filmeID`) REFERENCES `filme` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `film_genre`
--

LOCK TABLES `film_genre` WRITE;
/*!40000 ALTER TABLE `film_genre` DISABLE KEYS */;
INSERT INTO `film_genre` VALUES (1,1),(3,1),(4,1),(6,1),(9,1),(14,1),(16,1),(17,1),(18,1),(1,2),(5,2),(21,2),(2,3),(3,3),(6,3),(14,3),(17,3),(18,3),(1,4),(21,4),(9,5),(16,5),(17,5),(19,5),(20,5),(19,6),(3,8),(4,8),(16,8),(17,8),(19,8),(4,9),(9,9),(16,9),(17,9),(19,9);
/*!40000 ALTER TABLE `film_genre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `film_medien`
--

DROP TABLE IF EXISTS `film_medien`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `film_medien` (
  `filmeID` int NOT NULL,
  `medienID` int NOT NULL,
  PRIMARY KEY (`filmeID`,`medienID`),
  KEY `medienID` (`medienID`),
  CONSTRAINT `film_medien_ibfk_1` FOREIGN KEY (`filmeID`) REFERENCES `filme` (`id`),
  CONSTRAINT `film_medien_ibfk_2` FOREIGN KEY (`medienID`) REFERENCES `medien` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `film_medien`
--

LOCK TABLES `film_medien` WRITE;
/*!40000 ALTER TABLE `film_medien` DISABLE KEYS */;
INSERT INTO `film_medien` VALUES (1,1),(3,1),(4,1),(5,1),(6,1),(9,1),(14,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(1,2),(2,2),(3,2),(4,2),(5,2),(6,2),(9,2),(14,2),(16,2),(17,2),(18,2),(19,2),(20,2),(21,2),(2,3),(3,3),(4,3),(5,3),(6,3),(9,3),(14,3),(16,3),(17,3),(18,3),(19,3),(20,3),(21,3),(1,4),(2,4),(3,4),(4,4),(5,4),(6,4),(9,4),(14,4),(16,4),(17,4),(18,4),(19,4),(20,4),(21,4),(1,5),(2,5),(3,5),(4,5),(5,5),(6,5),(5,6),(6,6),(20,6);
/*!40000 ALTER TABLE `film_medien` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `film_produktionsland`
--

DROP TABLE IF EXISTS `film_produktionsland`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `film_produktionsland` (
  `filmeID` int NOT NULL,
  `landID` int NOT NULL,
  PRIMARY KEY (`filmeID`,`landID`),
  KEY `landID` (`landID`),
  CONSTRAINT `film_produktionsland_ibfk_1` FOREIGN KEY (`filmeID`) REFERENCES `filme` (`id`),
  CONSTRAINT `film_produktionsland_ibfk_2` FOREIGN KEY (`landID`) REFERENCES `produktionsland` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `film_produktionsland`
--

LOCK TABLES `film_produktionsland` WRITE;
/*!40000 ALTER TABLE `film_produktionsland` DISABLE KEYS */;
INSERT INTO `film_produktionsland` VALUES (1,2),(2,2),(3,2),(4,2),(5,2),(6,2),(9,2),(14,2),(16,2),(17,2),(18,2),(19,2),(20,2),(21,2),(2,3),(3,3);
/*!40000 ALTER TABLE `film_produktionsland` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `film_regie`
--

DROP TABLE IF EXISTS `film_regie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `film_regie` (
  `filmeID` int NOT NULL,
  `regieID` int NOT NULL,
  PRIMARY KEY (`filmeID`,`regieID`),
  KEY `regieID` (`regieID`),
  CONSTRAINT `film_regie_ibfk_1` FOREIGN KEY (`filmeID`) REFERENCES `filme` (`id`),
  CONSTRAINT `film_regie_ibfk_2` FOREIGN KEY (`regieID`) REFERENCES `regie` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `film_regie`
--

LOCK TABLES `film_regie` WRITE;
/*!40000 ALTER TABLE `film_regie` DISABLE KEYS */;
INSERT INTO `film_regie` VALUES (1,1),(2,3),(3,3),(4,3),(5,7),(5,8),(6,9);
/*!40000 ALTER TABLE `film_regie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `film_schauspieler`
--

DROP TABLE IF EXISTS `film_schauspieler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `film_schauspieler` (
  `filmeID` int NOT NULL,
  `schauspielerID` int NOT NULL,
  `rollen_name` varchar(100) DEFAULT NULL,
  `gage` decimal(15,2) DEFAULT NULL,
  `rollenID` int DEFAULT NULL,
  PRIMARY KEY (`filmeID`,`schauspielerID`),
  KEY `schauspielerID` (`schauspielerID`),
  KEY `rollenID` (`rollenID`),
  CONSTRAINT `film_schauspieler_ibfk_1` FOREIGN KEY (`filmeID`) REFERENCES `filme` (`id`),
  CONSTRAINT `film_schauspieler_ibfk_2` FOREIGN KEY (`schauspielerID`) REFERENCES `schauspieler` (`id`),
  CONSTRAINT `film_schauspieler_ibfk_3` FOREIGN KEY (`rollenID`) REFERENCES `rollen` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `film_schauspieler`
--

LOCK TABLES `film_schauspieler` WRITE;
/*!40000 ALTER TABLE `film_schauspieler` DISABLE KEYS */;
INSERT INTO `film_schauspieler` VALUES (1,1,'Jack Sparrow',10000000.00,1),(1,2,'Hector Barbossa',5000000.00,1),(1,3,'Will Turner',2000000.00,1),(1,4,'Elizabeth Swann',2000000.00,1),(1,5,'Joshamee Gibbs',500000.00,2),(1,6,'Davy Jones',2500000.00,1),(1,7,'Bootstrap Bill',1200000.00,2),(1,8,'Tia Dalma',750000.00,2),(1,9,'James Norrington',600000.00,2),(1,10,'Angelica',3000000.00,1),(2,11,'Joseph Cooper',18000000.00,1),(2,12,'Dr. Amelia Brand',6000000.00,1),(2,13,'Murphy Cooper',5000000.00,1),(2,14,'Professor Brand',1200000.00,2),(3,14,'Stephen Miles',1000000.00,2),(3,15,'Dom Cobb',20000000.00,1),(3,16,'Arthur',5000000.00,1),(3,17,'Ariadne',3500000.00,1),(3,18,'Eames',2500000.00,2),(3,19,'Robert Fischer',1500000.00,2),(4,14,'Alfred Pennyworth',2500000.00,2),(4,19,'Dr. Jonathan Crane / Scarecrow',500000.00,5),(4,20,'Bruce Wayne / Batman',10000000.00,1),(4,21,'Joker',1000000.00,1),(4,22,'James Gordon',3000000.00,1),(4,23,'Rachel Dawes',2000000.00,1),(5,24,'Marlin',250000.00,NULL),(5,25,'Dory',375000.00,NULL),(5,26,'Nemo',50000.00,NULL),(5,27,'Khan',150000.00,NULL),(6,29,'Neo',NULL,NULL),(9,34,'Dominic Toretto',250000.00,1),(16,20,'Bruce Wayne',100000000.00,1);
/*!40000 ALTER TABLE `film_schauspieler` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `film_studio`
--

DROP TABLE IF EXISTS `film_studio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `film_studio` (
  `filmeID` int NOT NULL,
  `studioID` int NOT NULL,
  PRIMARY KEY (`filmeID`,`studioID`),
  KEY `studioID` (`studioID`),
  CONSTRAINT `film_studio_ibfk_1` FOREIGN KEY (`filmeID`) REFERENCES `filme` (`id`),
  CONSTRAINT `film_studio_ibfk_2` FOREIGN KEY (`studioID`) REFERENCES `studio` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `film_studio`
--

LOCK TABLES `film_studio` WRITE;
/*!40000 ALTER TABLE `film_studio` DISABLE KEYS */;
INSERT INTO `film_studio` VALUES (1,1),(5,1),(14,1),(17,1),(2,2),(3,2),(4,2),(6,2),(16,2),(18,2),(21,2),(9,3),(19,4),(20,4);
/*!40000 ALTER TABLE `film_studio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `filme`
--

DROP TABLE IF EXISTS `filme`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `filme` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titel` varchar(100) NOT NULL,
  `erscheinungsjahr` year DEFAULT NULL,
  `laufzeit_min` int DEFAULT NULL,
  `fskID` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fskID` (`fskID`),
  CONSTRAINT `filme_ibfk_1` FOREIGN KEY (`fskID`) REFERENCES `fsk` (`id`),
  CONSTRAINT `filme_chk_1` CHECK ((`laufzeit_min` > 0))
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `filme`
--

LOCK TABLES `filme` WRITE;
/*!40000 ALTER TABLE `filme` DISABLE KEYS */;
INSERT INTO `filme` VALUES (1,'Fluch der Karibik',2003,143,3),(2,'Interstellar',2014,169,3),(3,'Inception',2010,148,3),(4,'The Dark Knight',2008,152,4),(5,'Findet Nemo',2003,100,1),(6,'Matrix',1999,136,4),(9,'The Fast and the Furious',2001,103,4),(14,'Transformers',2007,144,3),(16,'The Dark Knight Rises',2012,264,3),(17,'Batman Begins',2005,140,3),(18,'Man of Steel',2013,143,3),(19,'The Wolf of Wallstreet',2013,180,4),(20,'Titanic',1997,194,3),(21,'The Lord of the Rings - The Fellowship of the Ring',2001,178,3);
/*!40000 ALTER TABLE `filme` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fsk`
--

DROP TABLE IF EXISTS `fsk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fsk` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mindest_alter` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fsk`
--

LOCK TABLES `fsk` WRITE;
/*!40000 ALTER TABLE `fsk` DISABLE KEYS */;
INSERT INTO `fsk` VALUES (1,0),(2,6),(3,12),(4,16),(5,18),(6,21);
/*!40000 ALTER TABLE `fsk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `genre`
--

DROP TABLE IF EXISTS `genre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `genre` (
  `id` int NOT NULL AUTO_INCREMENT,
  `bezeichnung` varchar(100) DEFAULT NULL,
  `beschreibung` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genre`
--

LOCK TABLES `genre` WRITE;
/*!40000 ALTER TABLE `genre` DISABLE KEYS */;
INSERT INTO `genre` VALUES (1,'Action','Filme mit physischer Action, Verfolgungsjagden und Kämpfen.'),(2,'Abenteuer','Reisen, Entdeckungen und Heldenreisen in fernen Ländern.'),(3,'Sci-Fi','Zukunftsszenarien, Technologie und Weltraumthemen.'),(4,'Fantasy','Magie, Fabelwesen und übernatürliche Welten.'),(5,'Drama','Fokus auf tiefgreifende Charakterentwicklung und Konflikte.'),(6,'Komödie','Filme, die primär zur Unterhaltung und zum Lachen dienen.'),(7,'Horror','Zielt darauf ab, beim Zuschauer Angst und Schrecken zu erzeugen.'),(8,'Thriller','Adrenalinbetonte Handlung mit Fokus auf Verbrechen, Gefahr und Nervenkitzel.'),(9,'Krimi','Thematisiert die Aufklärung eines Verbrechens durch die Suche nach Tätern und Motiven.');
/*!40000 ALTER TABLE `genre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medien`
--

DROP TABLE IF EXISTS `medien`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `medien` (
  `id` int NOT NULL AUTO_INCREMENT,
  `bezeichnung` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medien`
--

LOCK TABLES `medien` WRITE;
/*!40000 ALTER TABLE `medien` DISABLE KEYS */;
INSERT INTO `medien` VALUES (1,'DVD'),(2,'Blu-ray'),(3,'4K Ultra HD'),(4,'Streaming'),(5,'Kino'),(6,'VHS');
/*!40000 ALTER TABLE `medien` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produktionsland`
--

DROP TABLE IF EXISTS `produktionsland`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produktionsland` (
  `id` int NOT NULL AUTO_INCREMENT,
  `land` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produktionsland`
--

LOCK TABLES `produktionsland` WRITE;
/*!40000 ALTER TABLE `produktionsland` DISABLE KEYS */;
INSERT INTO `produktionsland` VALUES (1,'Deutschland'),(2,'USA'),(3,'Großbritannien'),(4,'Frankreich'),(5,'Italien'),(6,'Spanien'),(7,'Kanada'),(8,'Japan'),(9,'Südkorea'),(10,'Australien'),(11,'Indien'),(12,'China'),(13,'Brasilien'),(14,'Mexiko'),(15,'Dänemark'),(16,'Schweden'),(17,'Norwegen'),(18,'Österreich'),(19,'Schweiz'),(20,'Niederlande');
/*!40000 ALTER TABLE `produktionsland` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `regie`
--

DROP TABLE IF EXISTS `regie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `regie` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vorname` varchar(100) DEFAULT NULL,
  `nachname` varchar(100) DEFAULT NULL,
  `geburtsdatum` date DEFAULT NULL,
  `geschlecht` varchar(100) DEFAULT NULL,
  `nationalität` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `regie`
--

LOCK TABLES `regie` WRITE;
/*!40000 ALTER TABLE `regie` DISABLE KEYS */;
INSERT INTO `regie` VALUES (1,'Gore','Verbinski','1964-03-16','männlich','USA'),(2,'Steven','Spielberg','1946-12-18','männlich','USA'),(3,'Christopher','Nolan','1970-07-30','männlich','Großbritannien'),(4,'James','Cameron','1954-08-16','männlich','Kanada'),(5,'Quentin','Tarantino','1963-03-27','männlich','USA'),(6,'Greta','Gerwig','1983-08-04','weiblich','USA'),(7,'Andrew','Stanton','1965-12-03','männlich','USA'),(8,'Lee','Unkrich','1967-08-08','männlich','USA'),(9,'Lana','Wachowski','1965-06-21','weiblich','USA');
/*!40000 ALTER TABLE `regie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rollen`
--

DROP TABLE IF EXISTS `rollen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rollen` (
  `id` int NOT NULL AUTO_INCREMENT,
  `rollen_bezeichnung` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rollen`
--

LOCK TABLES `rollen` WRITE;
/*!40000 ALTER TABLE `rollen` DISABLE KEYS */;
INSERT INTO `rollen` VALUES (1,'Hauptrolle'),(2,'Nebenrolle'),(3,'Gastrolle'),(4,'Statist'),(5,'Cameo');
/*!40000 ALTER TABLE `rollen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schauspieler`
--

DROP TABLE IF EXISTS `schauspieler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `schauspieler` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vorname` varchar(100) DEFAULT NULL,
  `nachname` varchar(100) DEFAULT NULL,
  `geburtsdatum` date DEFAULT NULL,
  `geschlecht` varchar(100) DEFAULT NULL,
  `nationalität` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schauspieler`
--

LOCK TABLES `schauspieler` WRITE;
/*!40000 ALTER TABLE `schauspieler` DISABLE KEYS */;
INSERT INTO `schauspieler` VALUES (1,'Johnny','Depp','1963-06-09','männlich','USA'),(2,'Geoffrey','Rush','1951-07-06','männlich','Australien'),(3,'Orlando','Bloom','1977-01-13','männlich','Großbritannien'),(4,'Keira','Knightley','1985-03-26','weiblich','Großbritannien'),(5,'Kevin','McNally','1956-04-27','männlich','Großbritannien'),(6,'Bill','Nighy','1949-12-12','männlich','Großbritannien'),(7,'Stellan','Skarsgård','1951-06-13','männlich','Schweden'),(8,'Naomie','Harris','1976-09-06','weiblich','Großbritannien'),(9,'Jack','Davenport','1973-03-01','männlich','Großbritannien'),(10,'Penélope','Cruz','1974-04-28','weiblich','Spanien'),(11,'Matthew','McConaughey','1969-11-04','männlich','USA'),(12,'Anne','Hathaway','1982-11-12','weiblich','USA'),(13,'Jessica','Chastain','1977-03-24','weiblich','USA'),(14,'Michael','Caine','1933-03-14','männlich','Großbritannien'),(15,'Leonardo','DiCaprio','1974-11-11','männlich','USA'),(16,'Joseph','Gordon-Levitt','1981-02-17','männlich','USA'),(17,'Elliot','Page','1987-02-21','divers','Kanada'),(18,'Tom','Hardy','1977-09-15','männlich','Großbritannien'),(19,'Cillian','Murphy','1976-05-25','männlich','Irland'),(20,'Christian','Bale','1974-01-30','männlich','Großbritannien'),(21,'Heath','Ledger','1979-04-04','männlich','Australien'),(22,'Gary','Oldman','1958-03-21','männlich','Großbritannien'),(23,'Maggie','Gyllenhaal','1977-11-16','weiblich','USA'),(24,'Albert','Brooks','1947-07-22','männlich','USA'),(25,'Ellen','DeGeneres','1958-01-26','weiblich','USA'),(26,'Alexander','Gould','1994-05-04','männlich','USA'),(27,'Willem','Dafoe','1955-07-22','männlich','USA'),(28,'Brad','Pitt','1963-12-18','männlich','USA'),(29,'Keanu','Reeves','1964-09-02','männlich','Kanada'),(30,'Steven','Wolfe','1978-12-31','männlich','USA'),(32,'Dwayne Douglas','Johnson','1972-05-02','männlich','USA'),(33,'Robert','Downey Jr.','1965-04-04','männlich','USA'),(34,'Marc Sinclair','Vincent','1967-07-18','männlich','USA'),(36,'Recai','Gül','1997-01-23','männlich','Deutschland'),(37,'testTEST','testTEST','2026-05-21','männlich','Australien');
/*!40000 ALTER TABLE `schauspieler` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `studio`
--

DROP TABLE IF EXISTS `studio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `studio` (
  `id` int NOT NULL AUTO_INCREMENT,
  `studio_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `studio`
--

LOCK TABLES `studio` WRITE;
/*!40000 ALTER TABLE `studio` DISABLE KEYS */;
INSERT INTO `studio` VALUES (1,'Walt Disney Pictures'),(2,'Warner Bros.'),(3,'Universal Pictures'),(4,'Paramount Pictures'),(5,'20th Century Studios'),(6,'Sony Pictures'),(7,'A24');
/*!40000 ALTER TABLE `studio` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-05-29 15:55:38
