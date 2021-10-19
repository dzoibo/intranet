-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 19, 2021 at 12:31 AM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `seinova`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id_cat` int(11) NOT NULL AUTO_INCREMENT,
  `nom_cat` varchar(45) DEFAULT NULL,
  `idUtilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id_cat`),
  KEY `fk_Cathégorie_Utilisateur1_idx` (`idUtilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`id_cat`, `nom_cat`, `idUtilisateur`) VALUES
(1, 'Site Web', 1),
(2, 'Programmation', 1),
(3, 'Système d\'Exploitation', 3),
(4, 'Autre Sujet', 1),
(5, 'Jeux', 2);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `idClient` int(11) NOT NULL AUTO_INCREMENT,
  `Nom_client` varchar(45) DEFAULT NULL,
  `Adresse` varchar(45) DEFAULT NULL,
  `Entreprise` varchar(45) DEFAULT NULL,
  `Telephone` varchar(45) DEFAULT NULL,
  `Localisation` varchar(45) DEFAULT NULL,
  `Langue` varchar(30) NOT NULL,
  `Statut_client` varchar(25) DEFAULT NULL,
  `date_client` varchar(25) NOT NULL,
  PRIMARY KEY (`idClient`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`idClient`, `Nom_client`, `Adresse`, `Entreprise`, `Telephone`, `Localisation`, `Langue`, `Statut_client`, `date_client`) VALUES
(1, 'Georges', 'bertrandminala80@gmail.com', 'Tradex', '655824575', 'Odza', '', '', '2021-09-23 00:00:00'),
(2, 'Serge', 'serge@gmail.com', 'Bqkaj', '655897412', 'Nlongkak', '', 'supprimer', '0000-00-00 00:00:00'),
(4, 'minala steve bertrand etoundi', 'etoundiminala47@gmail.com', 'EBM Corporation', 'steve bertrand etoundi minala', 'Vallee nlongkak', 'Français', '', '2021-09-23 00:00:00'),
(5, 'mba mba Miguel', 'mbamiguelro2000@gmail.com', 'EMB DEV', '+237 659158386', 'Nkoabang', 'Français', '', '2021-09-23 00:00:00'),
(6, 'tchomobe', 'tchomobe12@gmail.com', 'Seinova', '2145631213', 'total vaceau', 'Français', 'supprimer', '2021-09-23 00:00:00'),
(7, 'Stivi Link mba', 'etoundiminal@gmail.com', 'camtel', '2145631213', 'manguier carrefour', 'Français', 'supprimer', '2021-09-23 00:00:00'),
(8, 'mba mba miguel', 'mbamiguelro2000@gmail.com', 'Ebm dev', '659715426', 'elig essono', 'Français', 'supprimer', '23/09/2021 Ã 05:51:02'),
(13, ':nom_client', ':adresse', ':entreprise', ':telephone', ':localisation', ':langue', NULL, ':date_client'),
(15, 'Serge baka', 'Tsinga@gmail.com', 'redCamer', '1238900', '4d4d4', 'FranÃ§ais', NULL, '28/09/2021 Ã  02:04:23'),
(16, 'Serge ram', 'serge@gmail.com', 'redclop', '', '682988022', 'FranÃ§ais', NULL, '28/09/2021 Ã  03:00:32'),
(17, 'Tchomobe', 'tchomobe@gmail.com', 'seinova sarl', 'Abc', 'Nlongkak', 'FranÃ§ais', NULL, '11/10/2021 Ã  03:47:59');

-- --------------------------------------------------------

--
-- Table structure for table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `id_cmt` int(11) NOT NULL AUTO_INCREMENT,
  `contenu` varchar(45) DEFAULT NULL,
  `date_commentaire` datetime DEFAULT NULL,
  `id_reponse` int(11) NOT NULL,
  `nom_cmt` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_cmt`),
  KEY `fk_commentaire_reponses1_idx` (`id_reponse`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `conversation`
--

DROP TABLE IF EXISTS `conversation`;
CREATE TABLE IF NOT EXISTS `conversation` (
  `id_conversation` int(4) NOT NULL AUTO_INCREMENT,
  `iduser1` int(4) NOT NULL,
  `iduser2` int(4) NOT NULL,
  `last_message` int(100) NOT NULL,
  `archiver` varchar(4) NOT NULL,
  `epingler` varchar(4) NOT NULL,
  PRIMARY KEY (`id_conversation`),
  KEY `fk_id_message` (`last_message`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `conversation`
--

INSERT INTO `conversation` (`id_conversation`, `iduser1`, `iduser2`, `last_message`, `archiver`, `epingler`) VALUES
(1, 1, 2, 332, 'non', 'non'),
(2, 1, 4, 334, 'non', '1'),
(3, 1, 3, 32, 'non', 'non'),
(4, 2, 3, 284, 'non', '2'),
(18, 2, 4, 311, 'non', 'non'),
(19, 2, 6, 281, 'non', 'non'),
(20, 2, 7, 313, 'non', 'non'),
(21, 1, 45, 315, 'non', 'non');

-- --------------------------------------------------------

--
-- Table structure for table `equipe`
--

DROP TABLE IF EXISTS `equipe`;
CREATE TABLE IF NOT EXISTS `equipe` (
  `idEquipe` int(11) NOT NULL AUTO_INCREMENT,
  `Nom_equipe` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idEquipe`)
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `equipe`
--

INSERT INTO `equipe` (`idEquipe`, `Nom_equipe`) VALUES
(29, 'minalasteve'),
(30, 'Force 1'),
(31, 'Force 1'),
(34, 'Alpha 2'),
(98, 'mbacorporation'),
(105, 'Interfaces'),
(106, 'team force237'),
(107, 'team force237'),
(108, 'team ebm'),
(109, 'tean air 2'),
(110, 'EBm'),
(111, 'DESIGNER'),
(112, 'DESIGNER 237'),
(113, 'DESIGNER 2021'),
(114, 'DESIGNER 2021'),
(115, 'team force 237'),
(116, 'team 237 MMMr'),
(117, 'tean air 2 team'),
(118, 'tean air 2 team'),
(119, 'tean air 2 team'),
(120, 'tean air 237 team'),
(121, 'DESIGNER'),
(122, 'DESIGNER new'),
(123, 'des 1235'),
(124, 'dev junior');

-- --------------------------------------------------------

--
-- Table structure for table `equipe_has_utilisateur`
--

DROP TABLE IF EXISTS `equipe_has_utilisateur`;
CREATE TABLE IF NOT EXISTS `equipe_has_utilisateur` (
  `Equipe_idEquipe` int(11) NOT NULL,
  `Utilisateur_idUtilisateur` int(11) NOT NULL,
  KEY `fk_Equipe_has_Utilisateur_Utilisateur1_idx` (`Utilisateur_idUtilisateur`),
  KEY `fk_Equipe_has_Utilisateur_Equipe1_idx` (`Equipe_idEquipe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `equipe_has_utilisateur`
--

INSERT INTO `equipe_has_utilisateur` (`Equipe_idEquipe`, `Utilisateur_idUtilisateur`) VALUES
(30, 2),
(98, 3),
(98, 1),
(98, 2),
(98, 45),
(98, 4),
(105, 1),
(105, 2),
(105, 45),
(105, 4),
(31, 26),
(31, 3),
(31, 1),
(31, 2),
(106, 1),
(106, 7),
(106, 2),
(107, 1),
(107, 7),
(107, 2),
(109, 26),
(109, 3),
(110, 26),
(110, 1),
(110, 2),
(111, 3),
(111, 2),
(111, 45),
(112, 1),
(112, 7),
(112, 2),
(112, 45),
(113, 1),
(114, 1),
(114, 7),
(114, 2),
(115, 3),
(115, 1),
(115, 7),
(116, 1),
(116, 7),
(116, 2),
(117, 3),
(117, 1),
(118, 3),
(118, 1),
(119, 3),
(119, 1),
(120, 3),
(120, 1),
(120, 2),
(121, 1),
(121, 7),
(121, 2),
(122, 26),
(122, 3),
(108, 7),
(108, 2),
(108, 45),
(123, 3),
(123, 1),
(123, 2),
(124, 1),
(124, 2),
(124, 6);

-- --------------------------------------------------------

--
-- Table structure for table `evenements`
--

DROP TABLE IF EXISTS `evenements`;
CREATE TABLE IF NOT EXISTS `evenements` (
  `id_eve` int(255) NOT NULL AUTO_INCREMENT,
  `theme` varchar(1000) NOT NULL,
  `type` varchar(1000) NOT NULL,
  `description` text NOT NULL,
  `date_eve` datetime(6) NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `depasser` int(11) NOT NULL DEFAULT '0',
  `supprimer` int(11) NOT NULL DEFAULT '0',
  `idCreateur` int(11) NOT NULL,
  `rapport_eve` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_eve`),
  KEY `fk_evenements_utilisateur1_idx` (`idCreateur`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `evenements`
--

INSERT INTO `evenements` (`id_eve`, `theme`, `type`, `description`, `date_eve`, `date_creation`, `depasser`, `supprimer`, `idCreateur`, `rapport_eve`) VALUES
(4, 'Exposé sur le scrum', 'Réunion', 'chaque équipe devra faire des recherches et exposer leur travail devant tout le monde', '2021-01-06 13:08:39.000000', '2021-01-25 17:47:16', 1, 0, 1, 'Document/Rapport/Rapport_20210831165928.pdf'),
(5, 'Descente en entreprise', 'Excursion', 'Sortie prévue par l\'administration pour édifié le personnel  ', '2021-01-22 08:30:00.000000', '2021-01-25 17:47:16', 1, 0, 1, 'Document/Rapport/Rapport_20210831160728.pdf'),
(59, 'hub', 'jin ', 'ugih', '2021-03-02 20:05:00.000000', '2021-02-21 16:25:19', 1, 0, 1, 'Document/Rapport/Rapport_20210831212126.pdf'),
(60, 'rfqfde', '3fqfq', 'r3f3ff', '2021-07-22 01:18:00.000000', '2021-07-20 21:18:55', 1, 0, 1, NULL),
(61, 'yo negro', 'jhhjk', 'cytujknlm', '2021-08-17 11:30:00.000000', '2021-08-17 06:30:38', 1, 0, 1, NULL),
(62, 'wdcwc', 'wcwcweec', 'wcwc', '2021-09-02 18:25:00.000000', '2021-09-01 09:42:15', 1, 0, 3, NULL),
(63, 'edd', 'ewdw', '1a1', '2021-09-30 14:13:00.000000', '2021-09-23 06:54:27', 0, 1, 3, NULL),
(64, 'Godzieyem', 'reunion', '3de3ed', '2021-09-21 21:37:00.000000', '2021-09-16 07:47:22', 1, 0, 3, NULL),
(65, 'WER3WE', 'WC', 'WECWC', '2021-09-24 21:38:00.000000', '2021-09-08 16:38:48', 1, 0, 2, NULL),
(66, 'entreprise', 'sortie', '', '2021-10-07 22:00:00.000000', '2021-09-08 18:00:51', 1, 0, 2, NULL),
(68, 'Bilan sur le trimestre 3', 'reunion', 'Il s\'agit d\'établir un bilan sur l\'ensemble des marchés  et des difficultés de ce trimestre ', '2021-09-30 10:10:00.000000', '2021-09-23 08:11:51', 1, 0, 2, 'Document/Rapport/Rapport_20211003183724.pdf'),
(70, 'Reunion pour le nouveau projet', 'reunion', 'Cette réunion à pour but de décider  du déroulement du nouveau projet', '2021-10-13 16:30:00.000000', '2021-10-05 12:30:39', 1, 0, 1, NULL),
(71, 'Rencontre avec le nouveau client', 'Reunion', 'Il s\'agit de discuter avec le nouveau client sur son projet', '2021-10-13 17:50:00.000000', '2021-10-11 16:50:13', 1, 0, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `favoris`
--

DROP TABLE IF EXISTS `favoris`;
CREATE TABLE IF NOT EXISTS `favoris` (
  `id_sujet` int(11) NOT NULL,
  `id_auteur` int(11) NOT NULL,
  PRIMARY KEY (`id_sujet`,`id_auteur`),
  KEY `fk_sujet_has_utilisateur_utilisateur1_idx` (`id_auteur`),
  KEY `fk_sujet_has_utilisateur_sujet1_idx` (`id_sujet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `favoris`
--

INSERT INTO `favoris` (`id_sujet`, `id_auteur`) VALUES
(3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `fichier`
--

DROP TABLE IF EXISTS `fichier`;
CREATE TABLE IF NOT EXISTS `fichier` (
  `id_fichier` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) DEFAULT NULL,
  `id_message` int(11) NOT NULL,
  `URL` varchar(100) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `taille` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_fichier`),
  KEY `fk_fichier_Message1_idx` (`id_message`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fichier`
--

INSERT INTO `fichier` (`id_fichier`, `nom`, `id_message`, `URL`, `type`, `taille`) VALUES
(1, 'RAPPORT Soutenance MINALA final.docx', 255, 'Document/file_Doc/RAPPORT Soutenance MINALA final.docx20210408011315.docx', 'document', 1286777),
(2, 'RAPPORT DZOIBO IVAN.3.pdf', 283, 'Document/file_Doc/RAPPORT DZOIBO IVAN.3.pdf20210901191332.pdf', 'pdf', 1780707),
(3, 'RAPPORT DZOIBO IVAN.3.pdf', 284, 'Document/file_Doc/RAPPORT DZOIBO IVAN.3.pdf20210901191749.pdf', 'pdf', 1780707),
(4, 'IMG_20210527_152757.jpg', 285, 'Document//file_Doc/IMG_20210527_152757.jpg20210903091644.jpg', 'image', 3635217),
(5, 'RAPPORT DZOIBO IVAN.3.pdf', 286, 'Document/file_Doc/RAPPORT DZOIBO IVAN.3.pdf20210903092253.pdf', 'pdf', 1780707),
(6, 'IMG_20210522_115640_1.jpg', 287, 'Document/file_Doc/IMG_20210522_115640_1.jpg20210903093023.jpg', 'image', 3572235),
(7, 'ÉPREUVES BTS .pdf', 288, 'Document/file_Doc/ÉPREUVES BTS .pdf20210903093047.pdf', 'pdf', 6893721),
(8, 'IMG_20210522_115655_1.jpg', 289, 'Document/file_Doc/IMG_20210522_115655_1.jpg20210903093224.jpg', 'image', 3792809),
(9, 'IMG_20210527_152757.jpg', 290, 'Document/file_Doc/IMG_20210527_152757.jpg20210903093726.jpg', 'image', 3635217),
(10, 'IMG_20210527_152807.jpg', 291, 'Document/file_Doc/IMG_20210527_152807.jpg20210903093938.jpg', 'image', 3363204),
(11, 'IMG_20210522_115655_1.jpg', 292, 'Document/file_Doc/IMG_20210522_115655_1.jpg20210903094015.jpg', 'image', 3792809),
(12, 'IMG_20210522_115634.jpg', 293, 'Document/file_Doc/IMG_20210522_115634.jpg20210903094147.jpg', 'image', 2874277),
(13, 'IMG_20210527_152804_1.jpg', 294, 'Document//file_Doc/IMG_20210527_152804_1.jpg20210903094602.jpg', 'image', 3339201),
(14, 'lamour-mauvais-phineas-et-ferb.mp4', 295, 'Document/file_Doc/lamour-mauvais-phineas-et-ferb.mp420210903094621.mp4', 'video', 14392108),
(15, 'codeur.jpg', 334, 'document/File_Doc/codeur.jpg20211011145619.jpg', 'image', 30580);

-- --------------------------------------------------------

--
-- Table structure for table `langage`
--

DROP TABLE IF EXISTS `langage`;
CREATE TABLE IF NOT EXISTS `langage` (
  `id_lng` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(45) DEFAULT NULL,
  `Description` varchar(45) DEFAULT NULL,
  `id_cat` int(11) NOT NULL,
  `id_createur` int(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_lng`),
  KEY `fk_Langage_Programmation_Cathégorie1_idx` (`id_cat`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `langage`
--

INSERT INTO `langage` (`id_lng`, `Nom`, `Description`, `id_cat`, `id_createur`) VALUES
(1, 'HTML/CSS', 'Une question sur la réalisation de site web e', 1, 1),
(2, 'Javascript', 'Vos questions concernants Javascript et AJax', 1, 1),
(3, 'PHP', 'Un soucis avec le PHP?Venez demander de l\'aid', 1, 1),
(4, 'Language C', 'Vos questions sur le language C', 2, 1),
(5, 'Language C++', 'Vos questions sur le language c++', 2, 1),
(6, 'Language.Net', 'Pour C#,visual basic et autre poster ici', 2, 1),
(7, 'Autres Langage', 'Vous programmer dans un autre langage?', 2, 1),
(8, 'PYTHON', 'Toutes vos questions sur le langage PYTHON', 2, 1),
(9, 'Base de données', 'Des problèmes pour ranger ou retrouver vos do', 2, 1),
(10, 'Windows', 'Un soucis avec Windows?', 3, 1),
(11, 'MAC OS X', 'Une question à proposde MAC OS? vous étes au ', 3, 1),
(12, 'Linux et free BSD', 'Vous avez un probléme avec linux ou freeBSD', 3, 1),
(13, 'Productivité', 'Avez vous des idées pour améliorer la product', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `liker`
--

DROP TABLE IF EXISTS `liker`;
CREATE TABLE IF NOT EXISTS `liker` (
  `id_reponse_like` int(11) NOT NULL,
  `id_auteur_like` int(11) NOT NULL,
  PRIMARY KEY (`id_reponse_like`,`id_auteur_like`),
  KEY `fk_reponse_has_utilisateur_utilisateur1_idx` (`id_auteur_like`),
  KEY `fk_reponse_has_utilisateur_reponse1_idx` (`id_reponse_like`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `idMessage` int(11) NOT NULL AUTO_INCREMENT,
  `Contenu` varchar(255) DEFAULT NULL,
  `idExpediteur` int(11) NOT NULL,
  `date_envoie` datetime DEFAULT NULL,
  `idRecepteur` int(11) NOT NULL,
  `statut` varchar(11) NOT NULL DEFAULT 'non_lu',
  PRIMARY KEY (`idMessage`),
  KEY `fk_Message_Utilisateur1_idx` (`idExpediteur`),
  KEY `fk_Message_Utilisateur2_idx` (`idRecepteur`)
) ENGINE=InnoDB AUTO_INCREMENT=335 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`idMessage`, `Contenu`, `idExpediteur`, `date_envoie`, `idRecepteur`, `statut`) VALUES
(3, 'Yo odk??', 2, '2021-04-08 00:09:25', 1, 'lu'),
(4, 'Yo', 1, '2021-04-08 00:11:35', 4, 'lu'),
(5, 'ça fait un bail', 2, '2021-04-08 00:12:24', 1, 'lu'),
(6, 'Je t\'assure', 1, '2021-04-08 01:09:51', 2, 'lu'),
(7, 'Vrai vrai', 2, '2021-04-08 00:11:15', 1, 'lu'),
(8, 'Recupère frangin', 1, '2021-04-08 01:13:15', 3, 'lu'),
(9, 'efqevqeq', 3, '2021-04-08 22:21:54', 2, 'lu'),
(10, 'salut\r\n', 2, '2021-04-09 13:12:44', 1, 'lu'),
(11, 'ok\r\n', 2, '2021-04-09 13:22:43', 1, 'lu'),
(12, 'ca bouge pas', 2, '2021-04-11 16:34:39', 1, 'lu'),
(13, 'yo\r\n', 1, '2021-04-11 16:44:02', 2, 'lu'),
(14, 'toooo', 1, '2021-04-11 16:44:12', 2, 'lu'),
(15, 'fatigué', 2, '2021-04-11 17:03:44', 1, 'lu'),
(16, 'fatigue', 2, '2021-04-11 17:03:53', 1, 'lu'),
(17, 'yo', 1, '2021-04-11 17:04:34', 2, 'lu'),
(18, 'hhh', 1, '2021-04-11 17:05:25', 2, 'lu'),
(19, 'fgjhkjlk', 1, '2021-04-11 17:14:42', 2, 'lu'),
(20, 'yo\r\n', 2, '2021-04-11 17:16:15', 1, 'lu'),
(21, 'yooo', 1, '2021-04-11 17:16:33', 2, 'lu'),
(22, 'tanaki', 2, '2021-04-11 17:16:46', 1, 'lu'),
(23, 'video', 2, '2021-04-11 17:17:12', 1, 'lu'),
(24, 'tg4', 1, '2021-04-11 17:25:24', 2, 'lu'),
(25, 'rtgetr', 2, '2021-04-11 17:25:34', 1, 'lu'),
(26, 'efcwecwecec', 2, '2021-04-11 17:25:45', 1, 'lu'),
(27, 'dgh', 2, '2021-04-11 17:26:03', 1, 'lu'),
(28, 'fjv nnb\r\n', 2, '2021-04-11 17:26:24', 1, 'lu'),
(29, 'dtfghjk', 1, '2021-04-11 17:38:36', 2, 'lu'),
(30, 'bon on relance', 1, '2021-04-11 17:59:20', 2, 'lu'),
(31, 'bon on relance', 2, '2021-04-11 17:59:38', 1, 'lu'),
(32, 'hhhh', 1, '2021-04-11 18:19:07', 3, 'lu'),
(34, 'yo', 2, '2021-04-11 18:44:41', 1, 'lu'),
(36, 'yo\r\n', 1, '2021-04-11 18:46:46', 2, 'lu'),
(37, 'yo', 2, '2021-04-11 18:46:57', 1, 'lu'),
(38, 'text alpha', 1, '2021-04-11 18:52:53', 2, 'lu'),
(39, 'text beta', 2, '2021-04-11 18:53:31', 1, 'lu'),
(40, 'text beta', 1, '2021-04-11 18:53:50', 2, 'lu'),
(41, 'text beta', 1, '2021-04-11 18:53:59', 2, 'lu'),
(42, 'text betaalpha', 2, '2021-04-11 18:54:20', 1, 'lu'),
(43, 'text betaalphs', 2, '2021-04-11 18:54:57', 1, 'lu'),
(44, 'ultime tesxxxxxx', 2, '2021-04-11 18:55:18', 1, 'lu'),
(45, 'ultime texr', 2, '2021-04-11 18:55:37', 1, 'lu'),
(46, 'morale ggg', 2, '2021-04-11 18:56:09', 1, 'lu'),
(47, 'mari janne', 1, '2021-04-11 18:56:20', 2, 'lu'),
(48, 'marie janne', 2, '2021-04-11 18:56:39', 1, 'lu'),
(49, 'jeau jacque', 1, '2021-04-11 18:56:53', 2, 'lu'),
(50, 'jiiii', 1, '2021-04-11 19:08:11', 2, 'lu'),
(51, 'yo', 2, '2021-04-11 19:41:13', 1, 'lu'),
(52, 'ultimate test', 1, '2021-04-11 19:42:35', 2, 'lu'),
(53, 'bouboum', 2, '2021-04-11 19:42:53', 1, 'lu'),
(54, 'yep', 1, '2021-04-11 19:43:01', 2, 'lu'),
(55, 'yo', 2, '2021-04-11 19:46:09', 1, 'lu'),
(74, 'yep', 1, '2021-04-11 20:45:23', 2, 'lu'),
(75, 'yo', 2, '2021-04-11 20:45:30', 1, 'lu'),
(76, 'yo', 1, '2021-04-11 20:45:47', 2, 'lu'),
(77, 'yo', 1, '2021-04-11 20:46:08', 2, 'lu'),
(78, 'yea', 2, '2021-04-11 20:46:16', 1, 'lu'),
(79, 'nono', 1, '2021-04-11 20:46:23', 2, 'lu'),
(80, 'im boss men', 2, '2021-04-11 20:46:33', 1, 'lu'),
(81, 'bosss', 2, '2021-04-11 20:47:31', 1, 'lu'),
(82, 'ndem', 1, '2021-04-11 20:47:44', 2, 'lu'),
(83, 'ndwm', 2, '2021-04-11 20:48:00', 1, 'lu'),
(84, 'ndem koi', 1, '2021-04-11 20:48:09', 2, 'lu'),
(85, 'porquoi sa ndem', 2, '2021-04-11 20:48:23', 1, 'lu'),
(86, 'je ne sais pas', 1, '2021-04-11 20:48:37', 2, 'lu'),
(87, 'yo', 2, '2021-04-11 20:49:32', 1, 'lu'),
(88, 'yes\r\n', 1, '2021-04-11 20:49:39', 2, 'lu'),
(89, 'yes', 2, '2021-04-11 20:50:40', 1, 'lu'),
(90, 'mbui\r\n', 2, '2021-04-11 20:51:46', 1, 'lu'),
(91, 'mnnn', 2, '2021-04-11 20:52:18', 1, 'lu'),
(92, 'hgvhjkl', 2, '2021-04-11 20:52:38', 1, 'lu'),
(93, 'gfchjbkml,', 2, '2021-04-11 20:52:41', 1, 'lu'),
(94, 'gdxcfghjk', 2, '2021-04-11 20:52:45', 1, 'lu'),
(95, 'yo', 1, '2021-04-12 03:07:37', 2, 'lu'),
(96, 'c\'est kem?', 1, '2021-04-12 03:08:08', 2, 'lu'),
(97, 'sinon ca bouge pas hein', 1, '2021-04-12 03:08:21', 2, 'lu'),
(98, 'sinon ca bouge pas', 1, '2021-04-12 03:08:56', 2, 'lu'),
(99, 'yoooo', 1, '2021-04-12 03:11:51', 2, 'lu'),
(100, 'nom nom', 1, '2021-04-12 03:12:14', 2, 'lu'),
(101, 'yeah', 1, '2021-04-12 03:14:49', 2, 'lu'),
(102, 'fatigue', 1, '2021-04-12 03:15:14', 2, 'lu'),
(103, 'yo', 1, '2021-04-12 03:47:42', 2, 'lu'),
(104, 'yes', 1, '2021-04-12 03:47:47', 2, 'lu'),
(105, 'ca bouge pas', 1, '2021-04-12 03:47:55', 2, 'lu'),
(106, 'yo', 2, '2021-04-12 03:48:08', 1, 'lu'),
(107, 'yes', 1, '2021-04-12 03:48:16', 2, 'lu'),
(108, 'ca bouge pas', 2, '2021-04-12 03:48:27', 1, 'lu'),
(109, 'non', 2, '2021-04-12 03:49:22', 1, 'lu'),
(110, 'comment', 1, '2021-04-12 03:49:35', 2, 'lu'),
(111, 'je wanda', 2, '2021-04-12 03:49:46', 1, 'lu'),
(112, 'ayarrr', 1, '2021-04-12 03:50:10', 2, 'lu'),
(113, 'non ', 2, '2021-04-12 03:51:34', 1, 'lu'),
(114, 'yeah', 2, '2021-04-12 03:51:44', 1, 'lu'),
(115, 'off off off', 2, '2021-04-12 03:51:51', 1, 'lu'),
(116, 'stop stop stop', 2, '2021-04-12 03:52:01', 1, 'lu'),
(123, 'yo', 2, '2021-04-12 04:00:53', 1, 'lu'),
(124, 'yeah', 2, '2021-04-12 04:12:16', 1, 'lu'),
(125, 'yo', 2, '2021-04-12 04:12:23', 1, 'lu'),
(126, 'mouf', 2, '2021-04-12 04:12:31', 1, 'lu'),
(127, 'blague', 2, '2021-04-12 04:12:41', 1, 'lu'),
(128, 'ndem', 2, '2021-04-12 04:12:53', 1, 'lu'),
(129, 'yo', 1, '2021-04-12 04:16:04', 2, 'lu'),
(130, 'yes', 1, '2021-04-12 04:16:11', 2, 'lu'),
(131, 'lol', 1, '2021-04-12 04:16:18', 2, 'lu'),
(164, 'bad acces', 2, '2021-04-12 13:52:40', 1, 'lu'),
(165, 'bonjour', 3, '2021-04-16 15:46:25', 2, 'lu'),
(166, 'yo\r\n', 1, '2021-07-15 16:39:17', 2, 'lu'),
(167, 'yep', 2, '2021-07-15 16:39:43', 1, 'lu'),
(168, 'odk', 1, '2021-07-15 16:39:58', 2, 'lu'),
(169, 'trankil bro', 2, '2021-07-15 16:40:15', 1, 'lu'),
(170, 'et toi?', 2, '2021-07-15 16:40:24', 1, 'lu'),
(171, 'ca bouge pas', 2, '2021-07-15 16:41:13', 1, 'lu'),
(172, 'bon on se prend demain nor\r\n', 1, '2021-07-15 16:41:34', 2, 'lu'),
(173, 'je suis unpeu cass', 1, '2021-07-15 16:41:44', 2, 'lu'),
(254, 'yo', 1, '2021-08-19 12:33:23', 2, 'lu'),
(255, 'En ech ther as fug zenh vunger askan darsian riguen de la viterndo no grafuen terminadd', 3, '2021-08-19 12:47:41', 2, 'lu'),
(279, 'r3ed2e', 2, '2021-08-19 17:02:51', 4, 'lu'),
(280, 'wcwe', 2, '2021-08-19 17:02:55', 4, 'lu'),
(281, 'yo', 2, '2021-08-20 08:10:05', 6, 'envoyer'),
(282, '2ed2', 2, '2021-09-01 19:13:16', 3, 'envoyer'),
(283, '', 2, '2021-09-01 19:13:32', 3, 'envoyer'),
(284, 'ewe', 2, '2021-09-01 19:17:49', 3, 'envoyer'),
(285, 'dfg', 2, '2021-09-03 09:16:44', 7, 'lu'),
(286, 'jvnk', 2, '2021-09-03 09:22:53', 7, 'lu'),
(287, '', 2, '2021-09-03 09:30:23', 7, 'lu'),
(288, 'fdzghjvb', 2, '2021-09-03 09:30:47', 7, 'lu'),
(289, '', 2, '2021-09-03 09:32:24', 7, 'lu'),
(290, '', 2, '2021-09-03 09:37:26', 7, 'lu'),
(291, '', 2, '2021-09-03 09:39:38', 7, 'lu'),
(292, '', 2, '2021-09-03 09:40:14', 7, 'lu'),
(293, 'jqksx', 2, '2021-09-03 09:41:47', 7, 'lu'),
(294, '', 2, '2021-09-03 09:46:02', 7, 'lu'),
(295, '', 2, '2021-09-03 09:46:21', 7, 'lu'),
(296, '', 2, '2021-09-03 09:46:50', 7, 'lu'),
(297, '', 2, '2021-09-03 09:47:06', 7, 'lu'),
(298, 'gjhjkl', 7, '2021-09-03 10:02:30', 2, 'lu'),
(299, 'jkm', 2, '2021-09-03 10:03:16', 7, 'lu'),
(300, 'gjhkj', 7, '2021-09-06 06:43:48', 2, 'lu'),
(301, 'hbj', 2, '2021-09-15 19:45:46', 4, 'lu'),
(302, 'k', 4, '2021-09-15 19:47:12', 2, 'lu'),
(303, 'xwx', 2, '2021-09-16 14:51:19', 4, 'lu'),
(304, 'erew', 2, '2021-09-16 14:55:28', 4, 'lu'),
(305, 'wefwe', 2, '2021-09-16 14:57:27', 4, 'lu'),
(306, 'etrfw', 2, '2021-09-16 15:00:36', 4, 'lu'),
(307, 'ercew', 2, '2021-09-16 15:02:32', 4, 'lu'),
(311, 'no noo', 4, '2021-09-16 15:02:53', 2, 'non_lu'),
(312, 'yo', 2, '2021-09-23 08:27:53', 7, 'envoyer'),
(313, 'Yo', 2, '2021-09-23 08:29:05', 7, 'envoyer'),
(314, '', 1, '2021-09-29 12:47:06', 2, 'envoyer'),
(315, 'yo', 1, '2021-10-03 16:04:12', 45, 'envoyer'),
(332, 'ombre', 1, '2021-10-03 18:55:47', 2, 'envoyer'),
(333, 'demain\r\n', 4, '2021-10-07 05:02:25', 1, 'lu'),
(334, 'Nouvelle photo', 1, '2021-10-11 14:56:19', 4, 'lu');

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

DROP TABLE IF EXISTS `module`;
CREATE TABLE IF NOT EXISTS `module` (
  `idModule` int(11) NOT NULL AUTO_INCREMENT,
  `Nom_Module` varchar(45) DEFAULT NULL,
  `Date_creation` datetime DEFAULT NULL,
  `Date_Debut` date DEFAULT NULL,
  `Date_Fin` date DEFAULT NULL,
  `Statut` int(11) DEFAULT '0',
  `idProject` int(11) NOT NULL,
  `Description_Module` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idModule`),
  KEY `fk_Module_Project1_idx` (`idProject`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`idModule`, `Nom_Module`, `Date_creation`, `Date_Debut`, `Date_Fin`, `Statut`, `idProject`, `Description_Module`) VALUES
(2, 'Interfaces', '2021-03-28 12:12:35', '2021-03-28', '2021-03-28', 1, 3, 'Réaliser les interfaces'),
(3, 'Back-End', '2021-03-28 12:13:16', '2021-03-28', '2021-04-01', 1, 3, 'Ecrire les différentes fonctions'),
(4, 'Front end', '2021-04-16 04:19:31', NULL, '2021-04-17', 0, 3, 'Realiser les interfaces'),
(6, 'module1', '2021-09-22 04:28:39', '2021-09-22', '2021-10-09', 1, 1, 'ce module'),
(7, 'tache1_module1', '2021-09-22 04:29:59', NULL, '2021-09-24', 0, 1, 'fsfcrczr'),
(8, 'module2', '2021-09-22 04:32:55', '2021-09-22', '2021-10-06', 1, 2, 'ce '),
(9, 'interface connexion237', '2021-09-22 04:49:22', '2021-09-22', '2021-10-02', 1, 4, 'cd'),
(10, 'module2', '2021-09-22 04:49:40', NULL, '2021-09-17', 0, 4, 'cess'),
(11, 'module1', '2021-09-23 10:41:24', '2021-09-23', '2021-09-30', 1, 8, 'ce module consistera'),
(12, 'module1', '2021-09-23 01:30:02', '2021-09-23', '2021-09-26', 2, 11, '\\rzsfvdwvdrfv'),
(13, 'module1', '2021-09-23 02:01:39', NULL, '2021-09-24', 0, 12, 'wetgdrxfgbcrfhb'),
(14, 'module1', '2021-10-11 04:11:34', '2021-10-11', '2021-10-13', 1, 10, 'ce jbsjvdqvjx');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `idNotification` int(11) NOT NULL AUTO_INCREMENT,
  `typeNotification` varchar(45) DEFAULT NULL,
  `contenuNotification` text,
  `dateNotification` datetime DEFAULT CURRENT_TIMESTAMP,
  `id_content` int(10) DEFAULT NULL,
  `id_auteur` int(4) NOT NULL,
  PRIMARY KEY (`idNotification`),
  KEY `id_auteur` (`id_auteur`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`idNotification`, `typeNotification`, `contenuNotification`, `dateNotification`, `id_content`, `id_auteur`) VALUES
(2, 'evenement', 'a modifié un evenement auquel vous êtes  participant ', '2021-09-23 06:54:27', 63, 2),
(3, 'evenement', ' a supprimé un evenement auquel vous êtes  participant \r\n						', '2021-09-23 06:56:44', 63, 2),
(5, 'evenement', ' a créé un nouvel evenement auquel vous êtes  participant \r\n						', '2021-09-23 07:11:51', 68, 2),
(10, 'rapport_eve', ' a importé un rapport à un événement auquel vous avez  participé \r\n						', '2021-09-23 08:11:28', 60, 2),
(11, 'rapport_eve', ' a importé un rapport à un événement auquel vous avez  participé \r\n						', '2021-09-23 08:22:11', 61, 2),
(14, 'rapport_eve', ' a importé un rapport à un événement auquel vous avez  participé \r\n						', '2021-09-23 08:26:15', 62, 2),
(15, 'message', ' : \"Yo\"', '2021-09-23 08:29:05', 313, 2),
(19, 'categorie', 'a créé une nouvelle categorie', '2021-09-23 09:05:34', 5, 2),
(20, 'sujet', 'a posté un nouveau sujet', '2021-09-23 09:10:42', 15, 4),
(32, 'reponse', 'a commenté un sujet sur lequel vous discutez', '2021-09-23 09:41:17', 13, 4),
(34, 'reponse', 'a commenté un sujet que vous avez créé', '2021-09-23 09:43:33', 14, 2),
(36, 'sujet resolu', 'a marqué un sujet sur lequel vous discutez comme résolu', '2021-09-23 09:46:18', 15, 4),
(37, 'message', ': \"\"', '2021-09-29 12:47:06', 314, 1),
(38, 'message', ': \"yo\"', '2021-10-03 16:04:12', 315, 1),
(76, 'evenement', ' a modifié évenement auquel vous etes participant\r\n														', '2021-10-05 12:30:39', 70, 1),
(77, 'message', ': \"demain\r\n\"', '2021-10-07 05:02:25', 333, 4),
(78, 'message', ': \"Nouvelle photo\"', '2021-10-11 14:56:19', 334, 1),
(79, 'sujet', 'a posté un nouveau sujet', '2021-10-11 15:20:16', 16, 1),
(80, 'reponse', 'a commenté un sujet sur lequel vous discutez', '2021-10-11 15:21:34', 15, 1),
(81, 'reponse', 'a commenté un sujet sur lequel vous discutez', '2021-10-11 15:22:11', 16, 1),
(82, 'reponse', 'a commenté un sujet sur lequel vous discutez', '2021-10-11 15:22:43', 17, 1),
(83, 'sujet resolu', 'a marqué un sujet sur lequel vous discutez résolu', '2021-10-11 15:25:14', 16, 1),
(84, 'Projet', 'a crÃ©Ã© le projet log intelligentdhjdkflflfld;', '2021-10-11 03:59:35', 13, 1),
(85, 'Equipe', 'Vous a ajouté à une nouvelle équipe', '2021-10-11 04:00:24', 124, 1),
(86, 'evenement', ' a crée évenement auquel vous etes participant\r\n														', '2021-10-11 16:50:13', 71, 1);

-- --------------------------------------------------------

--
-- Table structure for table `notification_has_user`
--

DROP TABLE IF EXISTS `notification_has_user`;
CREATE TABLE IF NOT EXISTS `notification_has_user` (
  `id_recepteur` int(11) NOT NULL,
  `id_notification` int(11) NOT NULL,
  `Statut` varchar(6) NOT NULL,
  KEY `id_user` (`id_recepteur`,`id_notification`),
  KEY `fk_id_notification` (`id_notification`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notification_has_user`
--

INSERT INTO `notification_has_user` (`id_recepteur`, `id_notification`, `Statut`) VALUES
(1, 2, 'lu'),
(3, 2, 'lu'),
(7, 2, 'lu'),
(1, 3, 'lu'),
(3, 3, 'lu'),
(7, 3, 'lu'),
(1, 5, 'lu'),
(3, 5, 'lu'),
(4, 5, 'non_lu'),
(7, 5, 'lu'),
(3, 11, 'lu'),
(7, 11, 'lu'),
(3, 14, 'lu'),
(4, 14, 'non_lu'),
(7, 14, 'lu'),
(7, 15, 'lu'),
(4, 19, 'non_lu'),
(7, 19, 'lu'),
(45, 19, 'non_lu'),
(1, 19, 'lu'),
(3, 19, 'lu'),
(6, 19, 'non_lu'),
(7, 20, 'lu'),
(45, 20, 'non_lu'),
(1, 20, 'lu'),
(2, 20, 'non_lu'),
(3, 20, 'lu'),
(6, 20, 'non_lu'),
(4, 34, 'non_lu'),
(2, 36, 'non_lu'),
(2, 37, 'non_lu'),
(45, 38, 'non_lu'),
(4, 76, 'non_lu'),
(1, 77, 'lu'),
(4, 78, 'non_lu'),
(4, 79, 'non_lu'),
(7, 79, 'non_lu'),
(45, 79, 'non_lu'),
(2, 79, 'non_lu'),
(3, 79, 'non_lu'),
(6, 79, 'non_lu'),
(1, 85, 'lu'),
(2, 85, 'non_lu'),
(6, 85, 'non_lu'),
(3, 86, 'non_lu'),
(4, 86, 'non_lu');

-- --------------------------------------------------------

--
-- Table structure for table `online`
--

DROP TABLE IF EXISTS `online`;
CREATE TABLE IF NOT EXISTS `online` (
  `idonline` int(11) NOT NULL AUTO_INCREMENT,
  `ip_online` varchar(45) DEFAULT NULL,
  `statut_online` int(11) DEFAULT NULL,
  `user_online` int(11) NOT NULL,
  `date_connexion` datetime DEFAULT NULL,
  `date_deconnexion` datetime DEFAULT NULL,
  PRIMARY KEY (`idonline`),
  KEY `fk_online_Utilisateur1_idx` (`user_online`)
) ENGINE=InnoDB AUTO_INCREMENT=217 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `online`
--

INSERT INTO `online` (`idonline`, `ip_online`, `statut_online`, `user_online`, `date_connexion`, `date_deconnexion`) VALUES
(1, '::1', 0, 1, '2021-03-01 12:37:52', '2021-03-01 12:43:31'),
(2, '::1', 0, 1, '2021-03-01 12:44:11', '2021-03-01 12:44:15'),
(3, '::1', 0, 1, '2021-03-01 12:44:40', '2021-03-01 01:20:00'),
(4, '::1', 0, 1, '2021-03-01 12:52:01', '2021-03-01 01:20:00'),
(5, '::1', 0, 1, '2021-03-01 01:21:05', '2021-03-01 01:21:06'),
(6, '::1', 0, 1, '2021-03-01 01:21:31', '2021-03-03 07:02:30'),
(7, '::1', 0, 1, '2021-03-03 03:20:30', '2021-03-03 07:02:30'),
(8, '::1', 0, 1, '2021-03-03 05:07:43', '2021-03-03 07:02:30'),
(9, '::1', 0, 1, '2021-03-04 03:42:01', '2021-03-04 07:47:01'),
(10, '::1', 0, 1, '2021-03-04 07:45:17', '2021-03-04 07:47:01'),
(11, '::1', 0, 1, '2021-03-05 09:34:34', '2021-03-05 10:15:25'),
(14, '::1', 0, 2, '2021-03-14 05:23:14', '2021-03-14 07:00:46'),
(15, '::1', 0, 6, '2021-03-14 07:01:09', '2021-03-17 08:44:29'),
(17, '::1', 0, 2, '2021-03-15 04:13:31', '2021-03-16 08:52:32'),
(18, '::1', 0, 2, '2021-03-16 08:42:01', '2021-03-16 08:52:32'),
(20, '::1', 0, 2, '2021-03-16 08:43:23', '2021-03-16 09:54:22'),
(21, '::1', 0, 2, '2021-03-16 09:54:37', '2021-03-17 08:37:57'),
(22, '::1', 0, 3, '2021-03-17 08:39:22', '2021-03-17 08:42:05'),
(23, '::1', 0, 6, '2021-03-17 08:43:17', '2021-03-17 08:44:29'),
(24, '::1', 0, 2, '2021-03-17 08:44:37', '2021-03-17 09:15:45'),
(25, '::1', 0, 2, '2021-03-17 09:18:44', '2021-03-17 02:59:55'),
(26, '::1', 0, 2, '2021-03-17 03:00:04', '2021-03-17 04:36:16'),
(27, '::1', 0, 6, '2021-03-17 04:36:23', '2021-03-17 06:39:21'),
(28, '::1', 0, 2, '2021-03-17 06:39:28', '2021-03-17 06:42:22'),
(29, '::1', 0, 6, '2021-03-17 06:42:36', '2021-03-18 07:49:11'),
(30, '::1', 0, 2, '2021-03-17 10:13:55', '2021-03-18 07:52:17'),
(31, '127.0.0.1', 0, 6, '2021-03-17 10:26:48', '2021-03-18 07:49:11'),
(32, '::1', 0, 3, '2021-03-17 11:22:16', '2021-03-18 07:45:55'),
(34, '::1', 0, 6, '2021-03-18 07:46:04', '2021-03-18 07:49:11'),
(35, '::1', 0, 2, '2021-03-18 07:49:18', '2021-03-18 07:52:17'),
(36, '::1', 0, 6, '2021-03-18 07:52:24', '2021-03-18 03:02:50'),
(37, '::1', 0, 26, '2021-03-18 02:37:22', '2021-03-18 02:38:24'),
(38, '::1', 0, 6, '2021-03-18 02:39:13', '2021-03-18 03:02:50'),
(39, '::1', 0, 6, '2021-03-18 09:38:47', '2021-03-18 09:48:34'),
(40, '::1', 0, 2, '2021-03-18 10:17:33', '2021-03-18 10:20:00'),
(41, '::1', 0, 6, '2021-03-18 10:20:18', '2021-03-18 10:20:59'),
(42, '::1', 0, 6, '2021-03-18 10:21:28', '2021-03-19 08:18:22'),
(43, '::1', 0, 6, '2021-03-19 08:33:07', '2021-03-19 08:42:26'),
(44, '::1', 0, 26, '2021-03-19 08:42:34', '2021-03-19 08:42:43'),
(45, '::1', 0, 6, '2021-03-19 08:42:49', '2021-03-19 12:13:05'),
(46, '::1', 0, 26, '2021-03-19 12:02:43', '2021-03-19 12:02:49'),
(47, '::1', 0, 6, '2021-03-19 12:04:22', '2021-03-19 12:13:05'),
(48, '::1', 0, 6, '2021-03-19 12:13:15', '2021-03-19 07:15:10'),
(49, '::1', 0, 6, '2021-03-19 07:48:51', '2021-03-19 08:24:34'),
(50, '::1', 0, 26, '2021-03-19 08:24:42', '2021-03-19 08:25:06'),
(51, '::1', 0, 6, '2021-03-19 08:25:13', '2021-03-19 11:02:23'),
(52, '::1', 0, 6, '2021-03-19 11:02:48', '2021-03-20 09:31:08'),
(53, '::1', 0, 6, '2021-03-20 09:31:39', '2021-03-20 09:39:55'),
(55, '::1', 0, 6, '2021-03-20 09:43:13', '2021-03-20 09:44:21'),
(56, '::1', 0, 2, '2021-03-20 09:44:28', '2021-03-20 09:44:33'),
(57, '::1', 0, 6, '2021-03-20 09:44:38', '2021-03-21 08:38:58'),
(58, '::1', 0, 6, '2021-03-21 06:24:28', '2021-03-21 08:38:58'),
(59, '::1', 0, 6, '2021-03-21 08:12:57', '2021-03-21 08:38:58'),
(60, '::1', 0, 6, '2021-03-21 08:39:05', '2021-03-22 01:44:28'),
(61, '::1', 0, 6, '2021-03-22 09:17:02', '2021-03-22 01:44:28'),
(62, '::1', 0, 6, '2021-03-22 01:42:20', '2021-03-22 01:44:28'),
(63, '::1', 0, 6, '2021-03-22 01:44:33', '2021-03-22 03:22:12'),
(64, '::1', 0, 6, '2021-03-22 09:35:08', '2021-03-22 09:51:25'),
(65, '127.0.0.1', 0, 26, '2021-03-22 09:45:07', '2021-03-22 09:46:21'),
(66, '127.0.0.1', 0, 26, '2021-03-22 09:47:06', '2021-03-22 09:48:51'),
(67, '127.0.0.1', 0, 4, '2021-03-22 09:49:03', '2021-03-22 09:56:27'),
(68, '::1', 0, 6, '2021-03-22 09:52:03', '2021-03-23 10:53:27'),
(69, '127.0.0.1', 0, 29, '2021-03-22 09:56:36', '2021-03-22 09:58:37'),
(70, '::1', 0, 6, '2021-03-23 10:52:34', '2021-03-23 10:53:27'),
(71, '::1', 0, 26, '2021-03-23 10:55:20', '2021-03-24 08:48:44'),
(72, '127.0.0.1', 0, 6, '2021-03-23 10:55:57', '2021-03-24 09:03:54'),
(73, '::1', 0, 2, '2021-03-24 09:02:32', '2021-03-24 09:02:48'),
(74, '::1', 0, 26, '2021-03-24 09:02:52', '2021-03-24 09:02:59'),
(75, '::1', 0, 6, '2021-03-24 09:03:52', '2021-03-24 09:03:54'),
(76, '::1', 0, 2, '2021-03-24 09:04:02', '2021-03-24 10:00:35'),
(77, '::1', 0, 2, '2021-03-24 10:00:55', '2021-03-24 11:38:28'),
(78, '::1', 0, 1, '2021-03-24 05:00:11', '2021-03-24 07:03:21'),
(79, '::1', 0, 1, '2021-03-24 07:03:39', '2021-03-24 07:37:32'),
(80, '::1', 0, 1, '2021-03-24 07:39:31', '2021-03-24 07:47:56'),
(81, '::1', 0, 1, '2021-03-25 01:47:43', '2021-03-25 09:59:19'),
(82, '::1', 0, 1, '2021-03-27 11:25:15', '2021-03-29 11:27:14'),
(83, '::1', 0, 1, '2021-03-29 07:50:54', '2021-03-29 11:27:14'),
(84, '::1', 0, 1, '2021-03-30 04:09:33', '2021-03-30 05:55:30'),
(85, '::1', 0, 1, '2021-03-30 05:55:32', '2021-03-30 08:33:38'),
(86, '::1', 0, 1, '2021-03-30 08:34:23', '2021-03-30 09:55:46'),
(87, '::1', 0, 1, '2021-03-30 10:38:48', '2021-03-30 10:53:45'),
(88, '::1', 0, 1, '2021-03-30 10:53:48', '2021-03-30 11:03:56'),
(89, '::1', 0, 1, '2021-03-30 11:03:58', '2021-03-30 11:05:08'),
(90, '::1', 0, 2, '2021-03-30 11:05:39', '2021-03-30 11:05:55'),
(91, '::1', 0, 1, '2021-03-30 11:05:58', '2021-03-30 11:10:59'),
(92, '::1', 0, 2, '2021-03-30 11:11:03', '2021-03-30 11:12:23'),
(93, '::1', 0, 2, '2021-03-30 11:12:25', '2021-03-30 11:26:59'),
(94, '::1', 0, 2, '2021-03-30 11:27:01', '2021-03-30 11:27:43'),
(95, '::1', 0, 1, '2021-03-30 11:27:46', '2021-03-30 11:27:54'),
(96, '::1', 0, 2, '2021-03-30 11:27:57', '2021-03-30 11:32:03'),
(97, '::1', 0, 1, '2021-03-30 11:32:07', '2021-03-30 11:32:43'),
(98, '::1', 0, 2, '2021-03-30 11:32:46', '2021-03-30 11:36:30'),
(99, '::1', 0, 1, '2021-03-30 11:36:33', '2021-03-30 11:38:57'),
(100, '::1', 0, 2, '2021-03-30 11:39:00', '2021-03-30 11:39:28'),
(101, '::1', 0, 2, '2021-03-30 11:39:30', '2021-03-30 11:39:33'),
(102, '::1', 0, 1, '2021-03-30 11:39:36', '2021-03-30 11:40:20'),
(103, '::1', 0, 2, '2021-03-30 11:40:24', '2021-03-30 11:40:44'),
(104, '::1', 0, 1, '2021-03-30 11:40:47', '2021-03-30 11:40:52'),
(105, '::1', 0, 2, '2021-03-30 11:40:55', '2021-03-30 11:42:16'),
(106, '::1', 0, 2, '2021-03-30 11:42:19', '2021-03-30 11:42:23'),
(107, '::1', 0, 1, '2021-03-30 11:42:26', '2021-03-30 11:42:30'),
(108, '::1', 0, 1, '2021-03-30 11:44:58', '2021-03-30 11:45:17'),
(109, '::1', 0, 1, '2021-03-30 11:46:01', '2021-03-30 11:46:09'),
(110, '::1', 0, 1, '2021-03-30 11:46:55', '2021-03-30 11:47:48'),
(111, '::1', 0, 1, '2021-03-30 11:48:11', '2021-03-30 11:48:16'),
(112, '::1', 0, 1, '2021-03-30 11:48:46', '2021-03-30 11:48:49'),
(113, '::1', 0, 2, '2021-03-30 11:48:52', '2021-03-30 11:49:02'),
(114, '::1', 0, 1, '2021-03-30 11:49:06', '2021-03-30 11:49:09'),
(115, '::1', 0, 2, '2021-03-30 11:49:12', '2021-03-30 11:49:17'),
(116, '::1', 0, 1, '2021-03-30 11:49:20', '2021-03-30 11:49:57'),
(117, '::1', 0, 1, '2021-03-30 11:49:59', '2021-03-30 11:50:01'),
(118, '::1', 0, 2, '2021-03-30 11:50:05', '2021-03-30 11:51:39'),
(119, '::1', 0, 2, '2021-03-30 11:51:42', '2021-03-30 11:55:23'),
(120, '::1', 0, 2, '2021-03-30 11:55:43', '2021-03-30 11:55:46'),
(121, '::1', 0, 1, '2021-03-30 11:55:50', '2021-03-30 11:55:56'),
(122, '::1', 0, 2, '2021-03-30 11:55:59', '2021-03-31 12:49:08'),
(123, '::1', 0, 2, '2021-03-31 12:49:09', '2021-03-31 12:49:37'),
(124, '::1', 0, 2, '2021-03-31 02:50:19', '2021-03-31 02:50:44'),
(125, '::1', 0, 1, '2021-03-31 02:50:47', '2021-03-31 02:53:10'),
(126, '::1', 0, 2, '2021-03-31 02:53:13', '2021-03-31 02:55:45'),
(127, '::1', 0, 1, '2021-03-31 02:55:48', '2021-03-31 02:57:08'),
(128, '::1', 0, 1, '2021-03-31 03:25:24', '2021-03-31 03:28:24'),
(129, '::1', 0, 1, '2021-03-31 04:27:44', '2021-04-01 07:18:17'),
(130, '::1', 0, 1, '2021-04-01 03:57:53', '2021-04-01 07:18:17'),
(131, '::1', 0, 1, '2021-04-01 07:13:45', '2021-04-01 07:18:17'),
(132, '::1', 0, 1, '2021-04-04 02:41:17', '2021-04-05 10:21:39'),
(133, '::1', 0, 1, '2021-04-05 10:21:36', '2021-04-05 10:21:39'),
(134, '::1', 0, 1, '2021-04-05 10:21:41', '2021-04-06 12:23:23'),
(135, '::1', 0, 1, '2021-04-06 12:19:07', '2021-04-06 12:23:23'),
(136, '::1', 0, 1, '2021-04-06 12:23:55', '2021-04-06 12:29:43'),
(137, '::1', 0, 2, '2021-04-06 12:29:46', '2021-04-06 12:36:29'),
(138, '::1', 0, 1, '2021-04-06 12:36:32', '2021-04-06 12:46:30'),
(139, '::1', 0, 3, '2021-04-06 12:46:52', '2021-04-06 12:46:55'),
(140, '::1', 0, 1, '2021-04-06 12:46:58', '2021-04-06 12:52:25'),
(141, '::1', 0, 3, '2021-04-06 12:52:29', '2021-04-06 12:52:32'),
(142, '::1', 0, 2, '2021-04-06 12:52:36', '2021-04-06 03:08:50'),
(143, '::1', 0, 3, '2021-04-06 03:08:55', '2021-04-06 03:09:12'),
(144, '::1', 0, 1, '2021-04-06 03:09:17', '2021-04-06 06:30:07'),
(145, '::1', 0, 1, '2021-04-06 06:30:09', '2021-04-06 06:47:39'),
(146, '::1', 0, 1, '2021-04-06 06:47:41', '2021-04-06 07:17:10'),
(147, '::1', 0, 2, '2021-04-06 07:17:13', '2021-04-06 07:47:59'),
(148, '::1', 0, 1, '2021-04-06 07:48:02', '2021-04-06 07:48:42'),
(149, '::1', 0, 2, '2021-04-06 07:48:45', '2021-04-06 08:04:36'),
(150, '::1', 0, 1, '2021-04-06 08:05:13', '2021-04-06 08:07:53'),
(151, '::1', 0, 2, '2021-04-06 08:07:56', '2021-04-06 08:08:03'),
(152, '::1', 0, 1, '2021-04-06 08:08:06', '2021-04-06 08:10:41'),
(153, '::1', 0, 2, '2021-04-06 08:10:45', '2021-04-06 08:54:56'),
(154, '::1', 0, 1, '2021-04-06 08:28:46', '2021-04-06 10:02:49'),
(155, '::1', 0, 1, '2021-04-07 02:35:48', '2021-04-07 03:20:03'),
(156, '::1', 0, 1, '2021-04-07 05:00:11', '2021-04-09 12:12:56'),
(157, '::1', 0, 2, '2021-04-07 10:24:48', '2021-04-07 10:41:37'),
(158, '::1', 0, 2, '2021-04-07 11:12:10', '2021-04-17 10:45:57'),
(159, '::1', 0, 2, '2021-04-08 06:41:52', '2021-04-17 10:45:57'),
(160, '::1', 0, 1, '2021-04-09 12:12:36', '2021-04-09 12:12:56'),
(161, '::1', 0, 1, '2021-04-09 12:18:50', '2021-04-09 01:40:37'),
(162, '::1', 0, 2, '2021-04-09 12:22:18', '2021-04-17 10:45:57'),
(163, '::1', 0, 1, '2021-04-09 01:40:57', '2021-04-13 10:27:01'),
(164, '::1', 0, 1, '2021-04-13 10:28:22', '2021-04-13 06:21:31'),
(165, '::1', 0, 1, '2021-04-13 06:30:52', '2021-04-13 06:31:39'),
(166, '::1', 0, 1, '2021-04-13 07:33:03', '2021-04-14 05:37:58'),
(167, '::1', 0, 2, '2021-04-14 06:16:48', '2021-04-17 10:45:57'),
(168, '::1', 0, 1, '2021-04-14 05:38:27', '2021-04-15 10:24:34'),
(169, '::1', 0, 1, '2021-04-15 10:24:48', '2021-04-15 10:24:49'),
(170, '::1', 0, 1, '2021-04-15 10:25:14', '2021-04-15 10:25:15'),
(171, '::1', 0, 1, '2021-04-15 10:25:29', '2021-04-15 10:25:31'),
(172, '::1', 0, 1, '2021-04-15 01:39:34', '2021-04-15 01:39:36'),
(173, '::1', 0, 1, '2021-04-15 01:40:59', '2021-04-15 04:47:05'),
(174, '::1', 0, 4, '2021-04-15 04:48:53', '2021-04-16 07:32:55'),
(175, '::1', 0, 1, '2021-04-16 07:33:05', '2021-04-16 09:38:26'),
(176, '::1', 0, 4, '2021-04-16 09:38:44', '2021-04-16 09:44:14'),
(177, '::1', 0, 1, '2021-04-16 09:44:28', '2021-04-16 09:57:44'),
(178, '::1', 0, 1, '2021-04-16 10:04:16', '2021-04-16 03:29:14'),
(179, '::1', 0, 1, '2021-04-16 03:29:58', '2021-04-16 03:33:51'),
(180, '::1', 0, 4, '2021-04-16 03:35:19', '2021-04-16 03:35:49'),
(181, '::1', 0, 4, '2021-04-16 03:36:01', '2021-04-16 03:36:22'),
(182, '::1', 0, 3, '2021-04-16 03:37:23', '2021-04-16 03:44:31'),
(183, '::1', 1, 3, '2021-04-16 03:45:09', NULL),
(184, '::1', 0, 2, '2021-04-20 09:42:22', '2021-04-20 10:13:16'),
(185, '::1', 0, 2, '2021-07-07 12:04:42', '2021-07-16 10:05:56'),
(186, '127.0.0.1', 0, 1, '2021-07-15 04:37:46', '2021-10-03 07:46:05'),
(187, '127.0.0.1', 0, 1, '2021-07-16 07:32:23', '2021-10-03 07:46:05'),
(188, '::1', 1, 2, '2021-07-16 10:06:21', NULL),
(189, '127.0.0.1', 0, 1, '2021-08-20 04:17:16', '2021-10-03 07:46:05'),
(190, '::1', 1, 2, '2021-08-31 12:20:41', NULL),
(191, '127.0.0.1', 1, 7, '2021-09-01 09:40:20', NULL),
(192, '127.0.0.1', 1, 7, '2021-09-03 09:08:14', NULL),
(193, '::1', 1, 2, '2021-09-08 03:27:34', NULL),
(194, '127.0.0.1', 0, 4, '2021-09-21 06:09:47', '2021-09-21 06:11:17'),
(195, '127.0.0.1', 0, 4, '2021-09-23 08:39:24', '2021-10-03 07:43:40'),
(196, '::1', 0, 1, '2021-09-29 11:27:24', '2021-10-03 07:46:05'),
(197, '::1', 0, 1, '2021-10-03 07:32:39', '2021-10-03 07:46:05'),
(198, '127.0.0.1', 0, 4, '2021-10-03 07:43:45', '2021-10-11 09:03:23'),
(199, '::1', 0, 1, '2021-10-03 07:46:17', '2021-10-03 07:47:04'),
(200, '::1', 0, 1, '2021-10-03 07:47:12', '2021-10-03 07:48:09'),
(201, '::1', 0, 1, '2021-10-03 07:48:21', '2021-10-03 07:52:32'),
(202, '::1', 0, 1, '2021-10-03 07:53:10', '2021-10-05 07:44:25'),
(203, '::1', 0, 1, '2021-10-05 07:44:46', '2021-10-11 08:58:32'),
(204, '::1', 0, 1, '2021-10-06 01:43:55', '2021-10-11 08:58:32'),
(205, '::1', 0, 1, '2021-10-06 03:12:56', '2021-10-11 08:58:32'),
(206, '127.0.0.1', 0, 4, '2021-10-07 05:01:56', '2021-10-11 09:03:23'),
(207, '127.0.0.1', 0, 4, '2021-10-07 08:26:54', '2021-10-11 09:03:23'),
(208, '127.0.0.1', 0, 4, '2021-10-11 09:03:25', '2021-10-11 02:52:03'),
(209, '::1', 0, 1, '2021-10-11 09:13:19', '2021-10-11 02:44:10'),
(210, '127.0.0.1', 0, 1, '2021-10-11 02:43:28', '2021-10-11 02:44:10'),
(211, '::1', 0, 4, '2021-10-11 02:44:18', '2021-10-11 02:52:03'),
(212, '::1', 0, 1, '2021-10-11 02:52:33', '2021-10-11 02:52:46'),
(213, '127.0.0.1', 1, 4, '2021-10-11 02:53:05', NULL),
(214, '127.0.0.1', 1, 4, '2021-10-11 04:50:49', NULL),
(215, '127.0.0.1', 1, 4, '2021-10-18 09:21:07', NULL),
(216, '::1', 1, 1, '2021-10-18 10:48:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `participants_module`
--

DROP TABLE IF EXISTS `participants_module`;
CREATE TABLE IF NOT EXISTS `participants_module` (
  `idModule` int(11) NOT NULL,
  `idParticipant` int(11) NOT NULL,
  PRIMARY KEY (`idModule`,`idParticipant`),
  KEY `fk_Module_has_Utilisateur_Utilisateur1_idx` (`idParticipant`),
  KEY `fk_Module_has_Utilisateur_Module1_idx` (`idModule`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `participants_module`
--

INSERT INTO `participants_module` (`idModule`, `idParticipant`) VALUES
(2, 1),
(3, 1),
(4, 1),
(6, 1),
(7, 1),
(11, 1),
(12, 1),
(9, 2),
(10, 2),
(2, 3),
(4, 3),
(10, 3),
(13, 3),
(14, 3),
(3, 7),
(6, 7),
(7, 7),
(11, 7),
(12, 7),
(8, 26),
(13, 26),
(9, 45);

-- --------------------------------------------------------

--
-- Table structure for table `participation`
--

DROP TABLE IF EXISTS `participation`;
CREATE TABLE IF NOT EXISTS `participation` (
  `id_eve` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id_eve`,`id_utilisateur`),
  KEY `fk_Evenement_has_Utilisateur_Utilisateur1_idx` (`id_utilisateur`),
  KEY `fk_Evenement_has_Utilisateur_Evenement1_idx` (`id_eve`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `participation`
--

INSERT INTO `participation` (`id_eve`, `id_utilisateur`) VALUES
(59, 1),
(63, 1),
(68, 1),
(71, 1),
(59, 2),
(63, 2),
(66, 2),
(68, 2),
(59, 3),
(60, 3),
(61, 3),
(62, 3),
(63, 3),
(64, 3),
(66, 3),
(68, 3),
(71, 3),
(59, 4),
(62, 4),
(64, 4),
(65, 4),
(68, 4),
(70, 4),
(71, 4),
(59, 6),
(65, 6),
(5, 7),
(59, 7),
(60, 7),
(61, 7),
(62, 7),
(63, 7);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
CREATE TABLE IF NOT EXISTS `project` (
  `idProject` int(11) NOT NULL AUTO_INCREMENT,
  `intutile` varchar(45) DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `Equipe_idEquipe` int(11) DEFAULT NULL,
  `Utilisateur_idUtilisateur` int(11) NOT NULL,
  `Statut` varchar(20) DEFAULT NULL,
  `id_client` int(11) NOT NULL,
  `date_enreg` varchar(25) NOT NULL,
  PRIMARY KEY (`idProject`),
  KEY `fk_Project_Equipe1_idx` (`Equipe_idEquipe`),
  KEY `fk_Project_Utilisateur1_idx` (`Utilisateur_idUtilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`idProject`, `intutile`, `date_debut`, `date_fin`, `Equipe_idEquipe`, `Utilisateur_idUtilisateur`, `Statut`, `id_client`, `date_enreg`) VALUES
(1, 'projet de seinova', '2021-09-25', '2022-04-21', 108, 2, '', 0, ''),
(2, 'projet2', '2021-09-25', '2022-04-29', 109, 2, '', 2, ''),
(3, 'club danse', '2021-09-25', '2022-01-27', 110, 2, '', 0, ''),
(4, 'academy school', '2021-09-25', '2022-05-20', 111, 2, '', 0, ''),
(5, 'projet intranet2', '2021-09-25', '2022-06-24', 112, 2, '', 0, ''),
(6, 'academy school 2021', '2021-09-26', '2022-04-20', 114, 2, '', 0, ''),
(7, 'Intranet 2021', '2021-09-23', '2022-01-21', 115, 2, '', 1, ''),
(8, 'web school', '2021-09-25', '2022-02-19', 116, 2, '', 0, ''),
(9, 'portail numeric', '2021-09-24', '2022-01-21', 119, 2, '', 5, ''),
(10, 'portail numeric 2', '2021-09-24', '2022-03-26', 120, 2, '', 5, ''),
(11, 'intranet 2021', '2021-09-25', '2022-05-05', 121, 2, '', 6, ''),
(12, 'Intranet 2', '2021-09-25', '2022-07-14', 122, 2, '', 7, ''),
(13, 'log intelligentdhjdkflflfld;', '2021-10-13', '2022-05-05', 124, 1, NULL, 5, '11/10/2021 Ã  03:59:35');

-- --------------------------------------------------------

--
-- Table structure for table `project_client`
--

DROP TABLE IF EXISTS `project_client`;
CREATE TABLE IF NOT EXISTS `project_client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_projet` varchar(255) NOT NULL,
  `Somme` varchar(255) NOT NULL,
  `id_client` int(11) NOT NULL,
  `statut_projet` varchar(255) NOT NULL,
  `etat_projet` varchar(20) NOT NULL,
  `document` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_project_client` (`id_client`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project_client`
--

INSERT INTO `project_client` (`id`, `nom_projet`, `Somme`, `id_client`, `statut_projet`, `etat_projet`, `document`) VALUES
(1, 'projet2', '15.000.000fcfa', 2, '3', 'commence', 'cv.docx'),
(2, 'projet3', '15.000.000fcfa', 2, '0', '', ''),
(4, 'academy school niveau 2', '250.000.000xaf', 2, '0', 'commence', 'Document 5.pdf'),
(5, 'Intranet 2021', '20.000.000xaf', 1, '3', 'commence', ''),
(6, 'academy school 2021', '2000000xaf', 1, '0', 'non commence', ''),
(7, 'dev logistique', '15.000.000fcfa', 5, '1', 'non commence', ''),
(8, 'log intelligent', '150.000.000fcfa', 5, '3', 'commence', ''),
(9, 'projet3', '2.000.000fcfa', 5, '0', 'non commence', ''),
(10, 'portail numeric', '250.000f', 5, '1', 'commence', ''),
(11, 'intranet 2021', '20.000.000xaf', 6, '3', 'commence', ''),
(12, 'projet intranet', '250 000xaf', 6, '4', 'non commence', ''),
(13, 'Intranet 2', '250 000xaf', 7, '3', 'commence', 'Document 5-01 copie.pdf'),
(14, 'qzqzs', '2100', 8, '0', 'non commence', ''),
(15, 'test1', '1234500cxaf', 5, '4', 'non commence', 'Rapport_Bilan sur le trimestre 3.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `project_has_client`
--

DROP TABLE IF EXISTS `project_has_client`;
CREATE TABLE IF NOT EXISTS `project_has_client` (
  `Project_idProject` int(11) NOT NULL,
  `Client_idClient` int(11) NOT NULL,
  PRIMARY KEY (`Project_idProject`,`Client_idClient`) USING BTREE,
  KEY `fk_Project_has_Client_Project1_idx` (`Project_idProject`),
  KEY `fk_Project_has_Client_Client1` (`Client_idClient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rencontre`
--

DROP TABLE IF EXISTS `rencontre`;
CREATE TABLE IF NOT EXISTS `rencontre` (
  `idRencontre` int(11) NOT NULL AUTO_INCREMENT,
  `Date_Rencontre` date DEFAULT NULL,
  `Heure_Rencontre` time DEFAULT NULL,
  `Motif_Rencontre` varchar(45) DEFAULT NULL,
  `Debouche_Rencontre` varchar(255) DEFAULT NULL,
  `id_project_client` int(11) NOT NULL,
  `document` varchar(2000) NOT NULL,
  PRIMARY KEY (`idRencontre`),
  KEY `fk_project_client_renc` (`id_project_client`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rencontre`
--

INSERT INTO `rencontre` (`idRencontre`, `Date_Rencontre`, `Heure_Rencontre`, `Motif_Rencontre`, `Debouche_Rencontre`, `id_project_client`, `document`) VALUES
(1, '2021-09-22', '04:22:42', 'pour un projet de ma societe', 'ceci...', 1, 'cv.docx20210723154714 (1).docx'),
(2, '2021-09-23', '10:45:54', 'pour un projet de ma societe', 'eeeeee', 7, ''),
(3, '2021-09-23', '01:26:41', 'pour un projet de ma societe', 'esfgvsefgvsrdf', 11, ''),
(4, '2021-09-23', '01:27:38', 'pour un projet de ma societe', 'cghngcfbn', 11, '');

-- --------------------------------------------------------

--
-- Table structure for table `rencontre_has_client`
--

DROP TABLE IF EXISTS `rencontre_has_client`;
CREATE TABLE IF NOT EXISTS `rencontre_has_client` (
  `idRencontre` int(11) NOT NULL,
  `idClient` int(11) NOT NULL,
  PRIMARY KEY (`idRencontre`,`idClient`) USING BTREE,
  KEY `fk_rencontre_has_client_rencontre1_idx` (`idRencontre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rencontre_has_client`
--

INSERT INTO `rencontre_has_client` (`idRencontre`, `idClient`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 5),
(3, 2),
(3, 6),
(4, 3),
(4, 5),
(4, 6);

-- --------------------------------------------------------

--
-- Table structure for table `reponses`
--

DROP TABLE IF EXISTS `reponses`;
CREATE TABLE IF NOT EXISTS `reponses` (
  `id_reponse` int(11) NOT NULL AUTO_INCREMENT,
  `contenu_reponse` varchar(255) DEFAULT NULL,
  `date_reponse` datetime DEFAULT NULL,
  `id_auteur` int(11) NOT NULL,
  `id_sujet` int(11) NOT NULL,
  PRIMARY KEY (`id_reponse`),
  KEY `fk_reponses_utilisateur1_idx1` (`id_auteur`),
  KEY `fk_reponses_sujet1_idx` (`id_sujet`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reponses`
--

INSERT INTO `reponses` (`id_reponse`, `contenu_reponse`, `date_reponse`, `id_auteur`, `id_sujet`) VALUES
(1, 'Je t\'assure', '2021-04-08 04:05:27', 1, 1),
(2, 'c\'est du charabia tout ca', '2021-04-12 06:45:17', 2, 4),
(3, 'Verifier son code ', '2021-04-16 15:50:01', 3, 5),
(4, 'er2rf243f234f24f23', '2021-09-15 16:29:32', 2, 5),
(13, 'Essayer de revoir votre configuration', '2021-09-23 09:41:17', 4, 15),
(14, 'Je crois que vous vous étes trompé de sujet', '2021-09-23 09:43:33', 2, 15),
(15, 'utilisation de base de données', '2021-10-11 15:21:34', 1, 16),
(16, 'utilisation de la mémoire vive', '2021-10-11 15:22:11', 1, 16),
(17, '???', '2021-10-11 15:22:43', 1, 16);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
CREATE TABLE IF NOT EXISTS `role_user` (
  `idRole_user` int(11) NOT NULL,
  `read` tinyint(4) DEFAULT NULL,
  `create` tinyint(4) DEFAULT NULL,
  `update` tinyint(4) DEFAULT NULL,
  `delete` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`idRole_user`),
  UNIQUE KEY `idRole_user_UNIQUE` (`idRole_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`idRole_user`, `read`, `create`, `update`, `delete`) VALUES
(0, 0, 0, 0, 0),
(1, 1, 0, 1, 0),
(2, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sujet`
--

DROP TABLE IF EXISTS `sujet`;
CREATE TABLE IF NOT EXISTS `sujet` (
  `id_sujet` int(11) NOT NULL AUTO_INCREMENT,
  `contenu` text,
  `id_auteur` int(11) NOT NULL,
  `date_sujet` datetime DEFAULT NULL,
  `titre` varchar(45) DEFAULT NULL,
  `id_lng` int(11) NOT NULL,
  `statut_sujet` varchar(40) DEFAULT 'non_resolu',
  PRIMARY KEY (`id_sujet`),
  KEY `fk_Preoccupation_Utilisateur1_idx` (`id_auteur`),
  KEY `fk_Sujet_langage1_idx` (`id_lng`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sujet`
--

INSERT INTO `sujet` (`id_sujet`, `contenu`, `id_auteur`, `date_sujet`, `titre`, `id_lng`, `statut_sujet`) VALUES
(1, 'Je trouve ennuyeux et impossible de faire du ', 1, '2021-04-08 04:03:25', 'Comment faire du responsive', 1, 'non_resolu'),
(2, 'Pourquoi tant de sommeil??', 1, '2021-04-08 04:06:12', 'Envie de dormir', 6, 'non_resolu'),
(3, 'Programmer en mangeant, qui l\'a déjà fait?', 1, '2021-04-08 04:07:46', 'J\'ai faim', 8, 'non_resolu'),
(4, 'ewevwtbwtr', 1, '2021-04-09 13:42:04', 'Mon code php', 1, 'non_resolu'),
(5, 'J\'ai une page php qui n\'affiche rien', 2, '2021-04-16 15:48:25', 'erreur de chargement ', 1, 'non_resolu'),
(13, 'ede3d32', 2, '2021-09-15 16:22:48', '3f34d4d', 1, 'non_resolu'),
(14, '3rf234f', 2, '2021-09-15 16:23:06', 'vevev45f', 1, 'resolu'),
(15, 'J\'ai une erreur d\'installation avec mes versions SQl', 4, '2021-09-23 09:10:42', 'Bug SQL', 1, 'resolu'),
(16, 'Je rencontre un probléme avec le js et la gestion de mémoire', 1, '2021-10-11 15:20:16', 'Probléme de mémoire Js ', 1, 'resolu');

-- --------------------------------------------------------

--
-- Table structure for table `tache`
--

DROP TABLE IF EXISTS `tache`;
CREATE TABLE IF NOT EXISTS `tache` (
  `idTache` int(11) NOT NULL AUTO_INCREMENT,
  `Nom_tache` varchar(45) DEFAULT NULL,
  `Date_creation` date DEFAULT NULL,
  `Date_debut` date DEFAULT NULL,
  `Date_fin` date DEFAULT NULL,
  `idModule` int(11) NOT NULL,
  `Statut` int(11) DEFAULT '0',
  `idParticipant` int(11) NOT NULL,
  PRIMARY KEY (`idTache`),
  KEY `fk_Tache_Module1_idx` (`idModule`),
  KEY `fk_Tache_Utilisateur1_idx` (`idParticipant`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tache`
--

INSERT INTO `tache` (`idTache`, `Nom_tache`, `Date_creation`, `Date_debut`, `Date_fin`, `idModule`, `Statut`, `idParticipant`) VALUES
(1, 'Mail1', '2021-03-28', '2021-03-28', '2021-03-28', 2, 2, 1),
(2, 'Back-End', '2021-03-28', '2021-04-01', '2021-03-28', 3, 2, 1),
(3, 'Stivi Linkid', '2021-03-28', '2021-03-28', '2021-04-01', 3, 2, 1),
(4, 'Interfaces', '2021-03-28', '2021-03-28', '2021-03-30', 2, 2, 3),
(5, 'Interface de connexion', '2021-04-16', '2021-04-16', '2021-04-23', 2, 2, 3),
(6, 'Interface de connexion', '2021-04-16', NULL, '2021-04-16', 4, 0, 3),
(7, 'tache1', '2021-09-22', '2021-09-22', '2021-10-07', 6, 1, 1),
(8, 'tache1', '2021-09-22', '2021-09-22', '2021-09-22', 8, 1, 26),
(9, 'tache237', '2021-09-22', '2021-09-22', '2021-09-30', 2, 1, 1),
(10, 'tache1', '2021-09-22', '2021-09-22', '2021-10-07', 9, 1, 2),
(11, 'tache1', '2021-09-23', '2021-09-23', '2021-09-30', 11, 1, 1),
(12, 'tache237', '2021-09-23', '2021-09-23', '2021-10-01', 12, 2, 1),
(13, 'Interface de connexion', '2021-10-11', '2021-10-11', '2021-10-20', 14, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `type_user`
--

DROP TABLE IF EXISTS `type_user`;
CREATE TABLE IF NOT EXISTS `type_user` (
  `idType_user` int(11) NOT NULL,
  `nom_type_user` varchar(45) DEFAULT NULL,
  `Role_user_idRole_user` int(11) NOT NULL,
  PRIMARY KEY (`idType_user`),
  KEY `fk_Type_user_Role_user1_idx` (`Role_user_idRole_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type_user`
--

INSERT INTO `type_user` (`idType_user`, `nom_type_user`, `Role_user_idRole_user`) VALUES
(0, 'supprimer', 0),
(1, 'Utilisateur', 1),
(2, 'Administrateur', 2),
(3, 'Bloqué', 0);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `Nom_utilisateur` varchar(45) DEFAULT NULL,
  `Prenom_utilisateur` varchar(45) DEFAULT NULL,
  `Login` varchar(45) DEFAULT NULL,
  `mail` varchar(30) NOT NULL,
  `MDP` varchar(45) DEFAULT NULL,
  `Role` int(11) NOT NULL,
  `telephone` varchar(14) NOT NULL,
  `localite` varchar(30) NOT NULL,
  `Statut_utilisateur` varchar(45) DEFAULT 'offline',
  `Photo` varchar(45) DEFAULT NULL,
  `Statut_suppression` varchar(20) NOT NULL,
  PRIMARY KEY (`idUtilisateur`),
  UNIQUE KEY `idUtilisateur_UNIQUE` (`idUtilisateur`),
  KEY `fk_Utilisateur_Type_user_idx` (`Role`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `Nom_utilisateur`, `Prenom_utilisateur`, `Login`, `mail`, `MDP`, `Role`, `telephone`, `localite`, `Statut_utilisateur`, `Photo`, `Statut_suppression`) VALUES
(1, 'Etoundi Minala', 'Steve Bertrand', 'steveminala', 'etoundiminala@gmail.com', 'steve2000', 2, '656205031', 'vallee longkak', 'online', 'assets/Images/PP/mini_Etoundi Minala_pp.png', ''),
(2, 'Mba Mba', 'Miguel', 'miguelmba', 'mbamiguel2000@gmail.com', 'mba2000', 2, '659158386', 'manguier', 'online', 'assets/Images/PP/2.png', ''),
(3, 'Dzoibo', 'Ivan', 'ivandzoibo', 'IvanDzoibo1998@gmail.com', 'ivan2000', 2, '698072395', 'acasia', 'online', 'assets/Images/PP/3.png', ''),
(4, 'Victor', 'Victor', 'victorvictor', 'victorminyeck1995@gmail.com', 'victor', 1, '658457512', 'nkolbisol', 'online', 'assets/Images/PP/mini_Victor_pp.png', ''),
(6, 'tchomobe', 'patrick', 'patrick20', 'patricktchomobe@gmail.com', '1988', 2, '699945862', 'santa barbara', 'offline', NULL, ''),
(7, 'fonkou', 'olivier', 'olivier14', 'fonkouolivier@gmail.com', '1992', 1, '677444430', 'mendong', 'offline', NULL, ''),
(26, 'daniel', 'peguy', 'miguelmba', 'peguydonald@gmail.com', '2000', 2, '659158386', 'manguiers', 'offline', NULL, ''),
(29, 'tsafack', 'edouard', 'edouard21', 'edouardtsafack2@gmail.com', '2000', 3, '657822392', 'bastos', 'offline', NULL, ''),
(45, 'miguel', 'peguy', 'miguelmba', 'patricktchomobe@gmail.com', '2001', 1, '655085145', 'messassie', 'offline', NULL, 'supprimer');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categorie`
--
ALTER TABLE `categorie`
  ADD CONSTRAINT `fk_Cathégorie_Utilisateur1` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `fk_commentaire_reponses1` FOREIGN KEY (`id_reponse`) REFERENCES `reponses` (`id_reponse`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `conversation`
--
ALTER TABLE `conversation`
  ADD CONSTRAINT `conversation_ibfk_1` FOREIGN KEY (`last_message`) REFERENCES `message` (`idMessage`);

--
-- Constraints for table `equipe_has_utilisateur`
--
ALTER TABLE `equipe_has_utilisateur`
  ADD CONSTRAINT `fk_Equipe_has_Utilisateur_Equipe1` FOREIGN KEY (`Equipe_idEquipe`) REFERENCES `equipe` (`idEquipe`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Equipe_has_Utilisateur_Utilisateur1` FOREIGN KEY (`Utilisateur_idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `favoris`
--
ALTER TABLE `favoris`
  ADD CONSTRAINT `fk_sujet_has_utilisateur_sujet1` FOREIGN KEY (`id_sujet`) REFERENCES `sujet` (`id_sujet`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sujet_has_utilisateur_utilisateur1` FOREIGN KEY (`id_auteur`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `fichier`
--
ALTER TABLE `fichier`
  ADD CONSTRAINT `fk_fichier_Message1` FOREIGN KEY (`id_message`) REFERENCES `message` (`idMessage`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `langage`
--
ALTER TABLE `langage`
  ADD CONSTRAINT `fk_Langage_Programmation_Cathégorie1` FOREIGN KEY (`id_cat`) REFERENCES `categorie` (`id_cat`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `liker`
--
ALTER TABLE `liker`
  ADD CONSTRAINT `fk_reponse_has_utilisateur_reponse1` FOREIGN KEY (`id_reponse_like`) REFERENCES `reponses` (`id_reponse`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reponse_has_utilisateur_utilisateur1` FOREIGN KEY (`id_auteur_like`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `fk_Message_Utilisateur1` FOREIGN KEY (`idExpediteur`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Message_Utilisateur2` FOREIGN KEY (`idRecepteur`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `module`
--
ALTER TABLE `module`
  ADD CONSTRAINT `fk_Module_Project1` FOREIGN KEY (`idProject`) REFERENCES `project` (`idProject`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`id_auteur`) REFERENCES `utilisateur` (`idUtilisateur`);

--
-- Constraints for table `notification_has_user`
--
ALTER TABLE `notification_has_user`
  ADD CONSTRAINT `fk_num_user` FOREIGN KEY (`id_recepteur`) REFERENCES `utilisateur` (`idUtilisateur`),
  ADD CONSTRAINT `notification_has_user_ibfk_1` FOREIGN KEY (`id_notification`) REFERENCES `notification` (`idNotification`);

--
-- Constraints for table `online`
--
ALTER TABLE `online`
  ADD CONSTRAINT `fk_online_Utilisateur1` FOREIGN KEY (`user_online`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `participants_module`
--
ALTER TABLE `participants_module`
  ADD CONSTRAINT `fk_Module_has_Utilisateur_Module1` FOREIGN KEY (`idModule`) REFERENCES `module` (`idModule`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Module_has_Utilisateur_Utilisateur1` FOREIGN KEY (`idParticipant`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `participation`
--
ALTER TABLE `participation`
  ADD CONSTRAINT `fk_Evenement_has_Utilisateur_Evenement1` FOREIGN KEY (`id_eve`) REFERENCES `evenements` (`id_eve`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Evenement_has_Utilisateur_Utilisateur1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `fk_Project_Equipe1` FOREIGN KEY (`Equipe_idEquipe`) REFERENCES `equipe` (`idEquipe`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Project_Utilisateur1` FOREIGN KEY (`Utilisateur_idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `project_client`
--
ALTER TABLE `project_client`
  ADD CONSTRAINT `fk_project_client` FOREIGN KEY (`id_client`) REFERENCES `client` (`idClient`);

--
-- Constraints for table `project_has_client`
--
ALTER TABLE `project_has_client`
  ADD CONSTRAINT `fk_Project_has_Client_Client1` FOREIGN KEY (`Client_idClient`) REFERENCES `client` (`idClient`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Project_has_Client_Project1` FOREIGN KEY (`Project_idProject`) REFERENCES `project` (`idProject`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rencontre`
--
ALTER TABLE `rencontre`
  ADD CONSTRAINT `fk_project_client_renc` FOREIGN KEY (`id_project_client`) REFERENCES `project_client` (`id`);

--
-- Constraints for table `rencontre_has_client`
--
ALTER TABLE `rencontre_has_client`
  ADD CONSTRAINT `fk_rencontre_has_client_rencontre1` FOREIGN KEY (`idRencontre`) REFERENCES `rencontre` (`idRencontre`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `reponses`
--
ALTER TABLE `reponses`
  ADD CONSTRAINT `fk_reponses_utilisateur1` FOREIGN KEY (`id_auteur`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sujet`
--
ALTER TABLE `sujet`
  ADD CONSTRAINT `fk_Preoccupation_Utilisateur1` FOREIGN KEY (`id_auteur`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Sujet_langage1` FOREIGN KEY (`id_lng`) REFERENCES `langage` (`id_lng`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tache`
--
ALTER TABLE `tache`
  ADD CONSTRAINT `fk_Tache_Module1` FOREIGN KEY (`idModule`) REFERENCES `module` (`idModule`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Tache_Utilisateur1` FOREIGN KEY (`idParticipant`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `type_user`
--
ALTER TABLE `type_user`
  ADD CONSTRAINT `fk_Type_user_Role_user1` FOREIGN KEY (`Role_user_idRole_user`) REFERENCES `role_user` (`idRole_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `fk_Utilisateur_Type_user` FOREIGN KEY (`Role`) REFERENCES `type_user` (`idType_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
