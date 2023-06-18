-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for pfe_absences
CREATE DATABASE IF NOT EXISTS `pfe_absences` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `pfe_absences`;

-- Dumping structure for table pfe_absences.absence
CREATE TABLE IF NOT EXISTS `absence` (
  `ID_ADMIN` int NOT NULL,
  `ID_SEANCE` int NOT NULL,
  `ETAT` text,
  `STATUT` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `NB_absence` int DEFAULT NULL,
  PRIMARY KEY (`ID_ADMIN`,`ID_SEANCE`),
  KEY `FK_ABSENCE` (`ID_SEANCE`),
  CONSTRAINT `FK_ABSENCE` FOREIGN KEY (`ID_SEANCE`) REFERENCES `seance` (`ID_SEANCE`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_ABSENCE2` FOREIGN KEY (`ID_ADMIN`) REFERENCES `etudiant` (`ID_ADMIN`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pfe_absences.absence: ~0 rows (approximately)
DELETE FROM `absence`;

-- Dumping structure for table pfe_absences.administrateur
CREATE TABLE IF NOT EXISTS `administrateur` (
  `NOM_USER` text,
  `PRENOM_USER` text,
  `DATEN_USER` date DEFAULT NULL,
  `CIN_USER` text,
  `EMAIL_USER` text,
  `PASSWORD_USER` text,
  `ADRESSE_USER` text,
  `TELE_USER` decimal(10,0) DEFAULT NULL,
  `SEXE_USER` text,
  `ADM_ID_USER` int DEFAULT NULL,
  `SERVICE_AD` text,
  `ID_ADMIN` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID_ADMIN`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pfe_absences.administrateur: ~0 rows (approximately)
DELETE FROM `administrateur`;
INSERT INTO `administrateur` (`NOM_USER`, `PRENOM_USER`, `DATEN_USER`, `CIN_USER`, `EMAIL_USER`, `PASSWORD_USER`, `ADRESSE_USER`, `TELE_USER`, `SEXE_USER`, `ADM_ID_USER`, `SERVICE_AD`, `ID_ADMIN`) VALUES
	('sanaa', NULL, NULL, NULL, NULL, 'sanaa123', NULL, NULL, NULL, NULL, NULL, 1);

-- Dumping structure for table pfe_absences.affilier
CREATE TABLE IF NOT EXISTS `affilier` (
  `ID_ADMIN` int NOT NULL,
  `ID_GROUPE` int NOT NULL,
  PRIMARY KEY (`ID_ADMIN`,`ID_GROUPE`),
  KEY `FK_AFFILIER` (`ID_GROUPE`),
  CONSTRAINT `FK_AFFILIER` FOREIGN KEY (`ID_GROUPE`) REFERENCES `groupe` (`ID_GROUPE`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_AFFILIER2` FOREIGN KEY (`ID_ADMIN`) REFERENCES `etudiant` (`ID_ADMIN`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pfe_absences.affilier: ~0 rows (approximately)
DELETE FROM `affilier`;
INSERT INTO `affilier` (`ID_ADMIN`, `ID_GROUPE`) VALUES
	(1, 5),
	(2, 5),
	(3, 5),
	(4, 5),
	(6, 5),
	(7, 5),
	(8, 5),
	(9, 5),
	(10, 5),
	(11, 5),
	(12, 5),
	(13, 5),
	(14, 5),
	(15, 5),
	(46, 5),
	(47, 5),
	(48, 5),
	(49, 5),
	(50, 5);

-- Dumping structure for table pfe_absences.annee
CREATE TABLE IF NOT EXISTS `annee` (
  `ID_ANNEE` int NOT NULL AUTO_INCREMENT,
  `ANNEE_UNIVERSITAIRE` date DEFAULT NULL,
  PRIMARY KEY (`ID_ANNEE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pfe_absences.annee: ~0 rows (approximately)
DELETE FROM `annee`;

-- Dumping structure for table pfe_absences.avoir
CREATE TABLE IF NOT EXISTS `avoir` (
  `ID_ADMIN` int NOT NULL,
  `ID_ROLE` int NOT NULL,
  PRIMARY KEY (`ID_ADMIN`,`ID_ROLE`),
  KEY `FK_AVOIR2` (`ID_ROLE`),
  CONSTRAINT `FK_AVOIR` FOREIGN KEY (`ID_ADMIN`) REFERENCES `utilisateur` (`ID_ADMIN`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_AVOIR2` FOREIGN KEY (`ID_ROLE`) REFERENCES `role` (`ID_ROLE`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pfe_absences.avoir: ~0 rows (approximately)
DELETE FROM `avoir`;

-- Dumping structure for table pfe_absences.departement
CREATE TABLE IF NOT EXISTS `departement` (
  `ID_DEPARTEMENT` int NOT NULL AUTO_INCREMENT,
  `ID_ADMIN` int NOT NULL,
  `ENS_ID_ADMIN` int NOT NULL,
  `NOM_DEPARTEMENT` text,
  PRIMARY KEY (`ID_DEPARTEMENT`),
  KEY `FK_ETRE_CHEF` (`ENS_ID_ADMIN`),
  KEY `FK_ETRE_CHEF2` (`ID_ADMIN`),
  CONSTRAINT `FK_ETRE_CHEF` FOREIGN KEY (`ENS_ID_ADMIN`) REFERENCES `enseignant` (`ID_ADMIN`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_ETRE_CHEF2` FOREIGN KEY (`ID_ADMIN`) REFERENCES `enseignant` (`ID_ADMIN`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pfe_absences.departement: ~0 rows (approximately)
DELETE FROM `departement`;
INSERT INTO `departement` (`ID_DEPARTEMENT`, `ID_ADMIN`, `ENS_ID_ADMIN`, `NOM_DEPARTEMENT`) VALUES
	(1, 2, 1, 'GI'),
	(2, 2, 2, 'TM'),
	(3, 1, 3, 'GIM'),
	(4, 4, 4, 'TIMQ');

-- Dumping structure for table pfe_absences.element
CREATE TABLE IF NOT EXISTS `element` (
  `ID_ELEMENT` int NOT NULL AUTO_INCREMENT,
  `ID_MODULE` int NOT NULL,
  `ID_ADMIN` int NOT NULL,
  `NOM_ELEMENT` text,
  PRIMARY KEY (`ID_ELEMENT`),
  KEY `FK_COMPORTER` (`ID_MODULE`),
  KEY `FK_ENSEIGNER_PAR` (`ID_ADMIN`),
  CONSTRAINT `FK_COMPORTER` FOREIGN KEY (`ID_MODULE`) REFERENCES `module` (`ID_MODULE`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_ENSEIGNER_PAR` FOREIGN KEY (`ID_ADMIN`) REFERENCES `enseignant` (`ID_ADMIN`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pfe_absences.element: ~0 rows (approximately)
DELETE FROM `element`;
INSERT INTO `element` (`ID_ELEMENT`, `ID_MODULE`, `ID_ADMIN`, `NOM_ELEMENT`) VALUES
	(4, 2, 12, 'Programation C'),
	(5, 1, 10, 'Analyse'),
	(6, 1, 13, 'algebre'),
	(7, 4, 3, 'Network'),
	(8, 7, 12, 'Algorithmique'),
	(9, 6, 1, 'mysql');

-- Dumping structure for table pfe_absences.enseignant
CREATE TABLE IF NOT EXISTS `enseignant` (
  `ID_ADMIN` int NOT NULL AUTO_INCREMENT,
  `NOM_USER` text,
  `PRENOM_USER` text,
  `DATEN_USER` date DEFAULT NULL,
  `CIN_USER` text,
  `EMAIL_USER` text,
  `PASSWORD_USER` text,
  `ADRESSE_USER` text,
  `TELE_USER` decimal(10,0) DEFAULT NULL,
  `SEXE_USER` text,
  `TYPE_EN` text,
  PRIMARY KEY (`ID_ADMIN`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pfe_absences.enseignant: ~0 rows (approximately)
DELETE FROM `enseignant`;
INSERT INTO `enseignant` (`ID_ADMIN`, `NOM_USER`, `PRENOM_USER`, `DATEN_USER`, `CIN_USER`, `EMAIL_USER`, `PASSWORD_USER`, `ADRESSE_USER`, `TELE_USER`, `SEXE_USER`, `TYPE_EN`) VALUES
	(1, 'ilham', 'monir', '2023-03-31', 'k128776844444444444', 'ilhamounir@gmail.com', '123', '220 P2006, Marrakech 40000', 65086543, 'femme', 'PROF'),
	(2, 'said', 'ELBDELLAOUI', '2023-04-04', 'k2387655', 'elabdellaoui@gmail.com', '765', '210 P2005, safi 46000', 56788655, 'Homme', 'prof'),
	(3, 'mohamed', 'ESSALIH', '2023-04-04', 'H12345633', 'essalih@gmail.com', '33', 'DD', 65986546, 'Sexe', 'chaf departement'),
	(4, 'othmane', 'alaoui', '2023-04-04', 'H12345633', 'othmane.alaoui.fdili@gmail.com', '32', 'SS', 65799643, 'Sexe', 'prof'),
	(9, 'bakkas', 'jamal', '2023-05-25', 'H123456', 'jbakkas@gmail.com', '33', '220 P2006, Marrakech 40000', 650381845, 'Homme', 'prof'),
	(10, 'bayar', 'abdoullah', '2023-05-09', 'H123456', 'abdou.bayar@gmail.com', '33', '210 P2005, safi 46000', 650381845, 'Homme', 'prof'),
	(11, 'arhid', 'khadija', '2023-05-10', 'H123456', 'arhid.khadija@gmail.com', '33', 'Lot. paranfa, centre commercial - ain diab - 20050 casablanca, Maroc', 650381848, 'Homme', 'prof'),
	(12, 'chekry', 'abderrahmane', '2023-05-24', 'H12345633', 'a.chekry@gmail.com', '33', '220 P2006, Marrakech 40000', 650381845, 'Homme', 'prof'),
	(13, 'maarouf', 'oussama', '2023-05-09', 'H12345633', 'maarouf.orama@gmail.com', '33', '210 P2005, safi 46000', 650381845, 'Homme', 'prof'),
	(14, 'agrima', 'abdellah', '2023-05-12', 'H12345633', 'agrima.abdellah@gmail.com', '33', '220 P2006, Marrakech 40000', 650381845, 'Homme', 'prof'),
	(16, 'mahfoudi', 'abdellah', '2023-05-15', 'H12345633', 'mahfoudi.abdel@gmail.com', '33', '210 P2005, safi 46000', 650381845, 'Homme', 'prof'),
	(17, 'elkouri', 'rachid', '2023-06-05', 'H12345633', 'mahfoudi.abdel@gmail.com', '33', '210 P2005, safi 46000', 650381845, 'Homme', 'prof');

-- Dumping structure for table pfe_absences.etudiant
CREATE TABLE IF NOT EXISTS `etudiant` (
  `ID_ADMIN` int NOT NULL AUTO_INCREMENT,
  `ID_FILIERE_` int DEFAULT NULL,
  `NOM_USER` text,
  `PRENOM_USER` text,
  `DATEN_USER` date DEFAULT NULL,
  `CIN_USER` text,
  `EMAIL_USER` text,
  `PASSWORD_USER` text,
  `ADRESSE_USER` text,
  `TELE_USER` decimal(10,0) DEFAULT NULL,
  `SEXE_USER` text,
  `CNE_ET` text,
  `ADRESS_PARENTIELLE_ET` text,
  `NIVEAU_ET` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `AVERTISEMENT_ET` text,
  `NB_absence` int NOT NULL,
  PRIMARY KEY (`ID_ADMIN`),
  KEY `FK_IDFILI` (`ID_FILIERE_`),
  CONSTRAINT `FK_IDFILI` FOREIGN KEY (`ID_FILIERE_`) REFERENCES `filiere` (`ID_FILIERE_`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pfe_absences.etudiant: ~0 rows (approximately)
DELETE FROM `etudiant`;
INSERT INTO `etudiant` (`ID_ADMIN`, `ID_FILIERE_`, `NOM_USER`, `PRENOM_USER`, `DATEN_USER`, `CIN_USER`, `EMAIL_USER`, `PASSWORD_USER`, `ADRESSE_USER`, `TELE_USER`, `SEXE_USER`, `CNE_ET`, `ADRESS_PARENTIELLE_ET`, `NIVEAU_ET`, `AVERTISEMENT_ET`, `NB_absence`) VALUES
	(1, 1, 'AAROUF', 'Fatima-ezzahra', '0000-00-00', 'H818665', 'fatima.ezzahra@gmail.com', 'motdepasse', 'Adresse 1', 123456789, 'femme', 'K314000', 'Adresse parentielle 1', '2eme Annee', 'Discipline', 12),
	(2, 1, 'AASLI', 'Ahmed', '0000-00-00', 'H874932', 'ahmed@gmail.com', 'motdepasse', 'Adresse 2', 123456789, 'homme', 'H874932', 'Adresse parentielle 2', '2eme Annee', 'Avertissement', 8),
	(3, 1, 'ABDOU', 'Imane', '0000-00-00', 'K314000', 'imane@gmail.com', 'motdepasse', 'Adresse 3', 123456789, 'femme', 'H874932', 'Adresse parentielle 3', '2eme Annee', 'Aucun', 6),
	(4, 1, 'AFRIADE', 'Wafaa', '0000-00-00', 'K314000', 'wafaa@gmail.com', 'motdepasse', 'Adresse 4', 123456789, 'femme', 'H874932', 'Adresse parentielle 4', '2eme Annee', 'Discipline', 13),
	(6, 1, 'AKRAM', 'Nadia', '0000-00-00', 'K314000', 'nadia@gmail.com', 'motdepasse', 'Adresse 6', 123456789, 'femme', 'H874932', 'Adresse parentielle 6', '2eme Annee', 'Discipline', 14),
	(7, 1, 'AKRATE', 'Khadija', '0000-00-00', 'K314000', 'khadija@gmail.com', 'motdepasse', 'Adresse 7', 123456789, 'femme', 'H874932', 'Adresse parentielle 7', '2eme Annee', 'Aucun', 2),
	(8, 1, 'AMAL', 'Aya', '0000-00-00', 'K314000', 'aya@gmail.com', 'motdepasse', 'Adresse 8', 123456789, 'femme', 'H874932', 'Adresse parentielle 8', '2eme Annee', 'Aucun', 0),
	(9, 1, 'ANEFLOUS', 'Amal', '0000-00-00', 'K314000', 'amal@gmail.com', 'motdepasse', 'Adresse 9', 123456789, 'femme', 'H874932', 'Adresse parentielle 9', '2eme Annee', 'Aucun', 0),
	(10, 1, 'ANNAFIS', 'Mohamed', '0000-00-00', 'K314000', 'mohamed@gmail.com', 'motdepasse', 'Adresse 10', 123456789, 'homme', 'H874932', 'Adresse parentielle 10', '2eme Annee', 'Aucun', 0),
	(11, 1, 'AZZIMANI', 'Salma', '0000-00-00', 'K314000', 'salma@gmail.com', 'motdepasse', 'Adresse 11', 123456789, 'femme', 'H874932', 'Adresse parentielle 11', '2eme Annee', 'Aucun', 0),
	(12, 1, 'BAHMAD', 'Ayoub', '0000-00-00', 'K314000', 'ayoub@gmail.com', 'motdepasse', 'Adresse 12', 123456789, 'homme', 'H874932', 'Adresse parentielle 12', '2eme Annee', 'Aucun', 0),
	(13, 1, 'BAMBAH', 'Imane', '0000-00-00', 'K314000', 'imane@gmail.com', 'motdepasse', 'Adresse 13', 123456789, 'femme', 'H874932', 'Adresse parentielle 13', '2eme Annee', 'Aucun', 0),
	(14, 1, 'BARAKATE', 'Bilal', '0000-00-00', 'K314000', 'bilal@gmail.com', 'motdepasse', 'Adresse 14', 123456789, 'homme', 'H874932', 'Adresse parentielle 14', '2eme Annee', 'Aucun', 0),
	(15, 1, 'BARBOUCHE', 'Hajar', '0000-00-00', 'K314000', 'hajar@gmail.com', 'motdepasse', 'Adresse 15', 123456789, 'femme', 'H874932', 'Adresse parentielle 15', '2eme Annee', 'Aucun', 0),
	(46, NULL, 'sana', 'rssaim', '2023-05-17', 'kj8', 'djhfd@gmail.com', '32', '220 P2006, Marrakech 40000', 650381845, 'Homme', 'K123456', '', '2 Annee', 'Aucun', 0),
	(47, NULL, 'sana', 'rssaim', '2023-05-17', 'kj8', 'djhfd@gmail.com', '32', '220 P2006, Marrakech 40000', 650381845, 'Homme', 'K123456', '', '2 Annee', 'Aucun', 0),
	(48, 1, 'el sarghini', 'nora', '2023-05-10', 'H123456', 'djhfd@gmail.com', '32', '220 P2006, Marrakech 40000', 650381845, 'Sexe', 'K123456', '', '2 Annee', 'Aucun', 0),
	(49, 2, 'ayoub', 'sanaa', '2023-05-18', 'H123456', 'djhfd@gmail.com', '32ss', 'Dr El marir toubet', 650381845, 'Sexe', 'K123456', '', '2 Annee', 'Aucun', 0),
	(50, 2, 'ayoub', 'sanaa', '2023-05-18', 'H123456', 'djhfd@gmail.com', '32ss', 'Dr El marir toubet', 650381845, 'Sexe', 'K123456', '', '2 Annee', 'Aucun', 0);

-- Dumping structure for table pfe_absences.filiere
CREATE TABLE IF NOT EXISTS `filiere` (
  `ID_FILIERE_` int NOT NULL AUTO_INCREMENT,
  `ID_DEPARTEMENT` int NOT NULL,
  `NOM_FILIERE_` text,
  PRIMARY KEY (`ID_FILIERE_`),
  KEY `FK_COMPRENDRE` (`ID_DEPARTEMENT`),
  CONSTRAINT `FK_COMPRENDRE` FOREIGN KEY (`ID_DEPARTEMENT`) REFERENCES `departement` (`ID_DEPARTEMENT`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pfe_absences.filiere: ~0 rows (approximately)
DELETE FROM `filiere`;
INSERT INTO `filiere` (`ID_FILIERE_`, `ID_DEPARTEMENT`, `NOM_FILIERE_`) VALUES
	(1, 1, 'ginie_informatique'),
	(2, 2, 'technique de management'),
	(3, 3, 'ginie indistriel et maintenance'),
	(4, 4, 'technique instrumentale et manegement de la qualite'),
	(5, 1, 'Systemes D\'information et Reseaux'),
	(6, 1, 'base de donnee'),
	(7, 1, 'base de donnee');

-- Dumping structure for table pfe_absences.groupe
CREATE TABLE IF NOT EXISTS `groupe` (
  `ID_GROUPE` int NOT NULL AUTO_INCREMENT,
  `ID_FILIERE_` int NOT NULL,
  `NOM_GROUPE` text,
  `TYPE_GROUPE` text,
  PRIMARY KEY (`ID_GROUPE`),
  KEY `FK_APPARTENIR` (`ID_FILIERE_`),
  CONSTRAINT `FK_APPARTENIR` FOREIGN KEY (`ID_FILIERE_`) REFERENCES `filiere` (`ID_FILIERE_`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pfe_absences.groupe: ~0 rows (approximately)
DELETE FROM `groupe`;
INSERT INTO `groupe` (`ID_GROUPE`, `ID_FILIERE_`, `NOM_GROUPE`, `TYPE_GROUPE`) VALUES
	(1, 1, 'group_1_TP', 'TP'),
	(2, 1, 'group_2_TP', 'TP'),
	(3, 1, 'group_3_TP', 'TP'),
	(4, 1, 'group_4_TP', 'TP'),
	(5, 1, 'group_cour', 'cour'),
	(6, 1, 'group_1_TD', 'TD'),
	(7, 1, 'group_2_TD', 'TD');

-- Dumping structure for table pfe_absences.module
CREATE TABLE IF NOT EXISTS `module` (
  `ID_MODULE` int NOT NULL AUTO_INCREMENT,
  `ID_FILIERE_` int NOT NULL,
  `ID_SEMESTRE` int NOT NULL,
  `NOM_MODULE` text,
  PRIMARY KEY (`ID_MODULE`),
  KEY `FK_CONTENIR` (`ID_FILIERE_`),
  KEY `FK_TROUVER` (`ID_SEMESTRE`),
  CONSTRAINT `FK_CONTENIR` FOREIGN KEY (`ID_FILIERE_`) REFERENCES `filiere` (`ID_FILIERE_`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_TROUVER` FOREIGN KEY (`ID_SEMESTRE`) REFERENCES `semestre` (`ID_SEMESTRE`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pfe_absences.module: ~0 rows (approximately)
DELETE FROM `module`;
INSERT INTO `module` (`ID_MODULE`, `ID_FILIERE_`, `ID_SEMESTRE`, `NOM_MODULE`) VALUES
	(1, 1, 1, 'math'),
	(2, 1, 1, 'programation C & Algorithmique'),
	(3, 1, 4, 'Administration d’un environnement Microsoft Windows Server 200X'),
	(4, 1, 4, 'Network Administration on Linux and Windows -'),
	(5, 1, 4, 'STAGE & PFE'),
	(6, 1, 4, 'base de donnee'),
	(7, 1, 1, 'programation');

-- Dumping structure for table pfe_absences.role
CREATE TABLE IF NOT EXISTS `role` (
  `ID_ROLE` int NOT NULL AUTO_INCREMENT,
  `ROLE` text,
  PRIMARY KEY (`ID_ROLE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pfe_absences.role: ~0 rows (approximately)
DELETE FROM `role`;

-- Dumping structure for table pfe_absences.seance
CREATE TABLE IF NOT EXISTS `seance` (
  `ID_SEANCE` int NOT NULL AUTO_INCREMENT,
  `ID_ELEMENT` int NOT NULL,
  `ID_GROUPE` int NOT NULL,
  `ID_ADMIN` int NOT NULL,
  `HEURED_SEANCE` time DEFAULT NULL,
  `HEUREF_SEANCE` time DEFAULT NULL,
  `NUM_SALLE` int DEFAULT NULL,
  `SEMAINE_D` date DEFAULT NULL,
  `SEMAINE_F` date DEFAULT NULL,
  PRIMARY KEY (`ID_SEANCE`),
  KEY `FK_ASSISTER` (`ID_GROUPE`),
  KEY `FK_ENSEIGNER` (`ID_ADMIN`),
  KEY `FK_INCLURE` (`ID_ELEMENT`),
  CONSTRAINT `FK_ASSISTER` FOREIGN KEY (`ID_GROUPE`) REFERENCES `groupe` (`ID_GROUPE`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_ENSEIGNER` FOREIGN KEY (`ID_ADMIN`) REFERENCES `enseignant` (`ID_ADMIN`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_INCLURE` FOREIGN KEY (`ID_ELEMENT`) REFERENCES `element` (`ID_ELEMENT`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pfe_absences.seance: ~0 rows (approximately)
DELETE FROM `seance`;
INSERT INTO `seance` (`ID_SEANCE`, `ID_ELEMENT`, `ID_GROUPE`, `ID_ADMIN`, `HEURED_SEANCE`, `HEUREF_SEANCE`, `NUM_SALLE`, `SEMAINE_D`, `SEMAINE_F`) VALUES
	(24, 6, 5, 13, '00:34:44', '00:34:45', 11, '2023-05-31', '2023-05-31'),
	(29, 4, 5, 12, '20:58:00', '22:59:00', 12, '2023-05-16', '2023-05-18'),
	(30, 8, 5, 12, '16:59:00', '18:59:00', 20, '2023-05-25', '2023-06-03'),
	(31, 9, 5, 1, '10:58:00', '12:58:00', 26, '2023-06-08', '2023-06-09'),
	(32, 6, 4, 14, '23:01:00', '01:01:00', 22, '2023-06-09', '2023-06-17');

-- Dumping structure for table pfe_absences.semestre
CREATE TABLE IF NOT EXISTS `semestre` (
  `ID_SEMESTRE` int NOT NULL AUTO_INCREMENT,
  `NUM_SEMESTRE` int DEFAULT NULL,
  `DATED_SEMESTRE` date DEFAULT NULL,
  `DATEF_SEMESTRE` date DEFAULT NULL,
  PRIMARY KEY (`ID_SEMESTRE`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pfe_absences.semestre: ~0 rows (approximately)
DELETE FROM `semestre`;
INSERT INTO `semestre` (`ID_SEMESTRE`, `NUM_SEMESTRE`, `DATED_SEMESTRE`, `DATEF_SEMESTRE`) VALUES
	(1, 1, '2023-03-31', '2025-03-31'),
	(2, 2, '2023-04-11', '2023-04-11'),
	(3, 3, '2023-05-11', '2023-05-11'),
	(4, 4, '2023-06-11', '2023-06-11'),
	(5, 5, '2023-07-11', '2023-07-11'),
	(6, 6, '2023-08-11', '2023-08-11');

-- Dumping structure for table pfe_absences.travailler
CREATE TABLE IF NOT EXISTS `travailler` (
  `ID_ADMIN` int NOT NULL,
  `ID_DEPARTEMENT` int NOT NULL,
  PRIMARY KEY (`ID_ADMIN`,`ID_DEPARTEMENT`),
  KEY `FK_TRAVAILLER2` (`ID_DEPARTEMENT`),
  CONSTRAINT `FK_TRAVAILLER` FOREIGN KEY (`ID_ADMIN`) REFERENCES `enseignant` (`ID_ADMIN`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_TRAVAILLER2` FOREIGN KEY (`ID_DEPARTEMENT`) REFERENCES `departement` (`ID_DEPARTEMENT`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pfe_absences.travailler: ~0 rows (approximately)
DELETE FROM `travailler`;
INSERT INTO `travailler` (`ID_ADMIN`, `ID_DEPARTEMENT`) VALUES
	(3, 1),
	(10, 1),
	(11, 1),
	(12, 1),
	(13, 1),
	(14, 1),
	(17, 1);

-- Dumping structure for table pfe_absences.utilisateur
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `ID_ADMIN` int NOT NULL AUTO_INCREMENT,
  `NOM_USER` text,
  `PRENOM_USER` text,
  `DATEN_USER` date DEFAULT NULL,
  `CIN_USER` text,
  `EMAIL_USER` text,
  `PASSWORD_USER` text,
  `ADRESSE_USER` text,
  `TELE_USER` decimal(10,0) DEFAULT NULL,
  `SEXE_USER` text,
  PRIMARY KEY (`ID_ADMIN`),
  CONSTRAINT `FK_GERER` FOREIGN KEY (`ID_ADMIN`) REFERENCES `administrateur` (`ID_ADMIN`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pfe_absences.utilisateur: ~0 rows (approximately)
DELETE FROM `utilisateur`;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
