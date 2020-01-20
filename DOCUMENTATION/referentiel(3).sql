-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 08 mars 2019 à 09:35
-- Version du serveur :  10.1.37-MariaDB
-- Version de PHP :  7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `referentiel`
--

-- --------------------------------------------------------

--
-- Structure de la table `activite`
--

CREATE TABLE `activite` (
  `idActivite` int(11) NOT NULL,
  `libelleActivite` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `activite`
--

INSERT INTO `activite` (`idActivite`, `libelleActivite`) VALUES
(1, 'Participer à la réponse à une affaire : analyser l\'expression d\'un besoin et rédiger un CdCf '),
(2, 'Conception préliminaire : concevoir et choisir une solution technique relative à un mécanisme '),
(3, 'Conception détaillée : pré-industrialiser et définir une solution technique optimisée relative à un mécanisme '),
(4, 'Participer à la vie d\'un bureau d\'études '),
(5, 'Répondre à une affaire'),
(6, 'Concevoir la production'),
(7, 'Initialiser la production'),
(8, 'Gérer la réalisation');

-- --------------------------------------------------------

--
-- Structure de la table `anneeetude`
--

CREATE TABLE `anneeetude` (
  `idAnneeEtude` int(11) NOT NULL,
  `libelleAnneeEtude` varchar(25) DEFAULT NULL,
  `idFiliere` char(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `anneeetude`
--

INSERT INTO `anneeetude` (`idAnneeEtude`, `libelleAnneeEtude`, `idFiliere`) VALUES
(1, 'ST1CPI', '1'),
(2, 'ST2CPI', '1'),
(3, 'ST1CPRP', '2'),
(4, 'ST2CPRP', '2');

-- --------------------------------------------------------

--
-- Structure de la table `annee_scolaire`
--

CREATE TABLE `annee_scolaire` (
  `annee` char(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `annee_scolaire`
--

INSERT INTO `annee_scolaire` (`annee`) VALUES
('2018/2019'),
('2019/2020');

-- --------------------------------------------------------

--
-- Structure de la table `archiveannee`
--

CREATE TABLE `archiveannee` (
  `idUtilisateur` varchar(25) NOT NULL,
  `annee` int(11) NOT NULL,
  `idIndicePerformance` int(11) NOT NULL,
  `valeurIndiceAA` int(11) DEFAULT NULL,
  `valeurIndiceEC` int(11) DEFAULT NULL,
  `valeurIndiceAR` int(11) DEFAULT NULL,
  `valeurIndiceC` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `avoir_note`
--

CREATE TABLE `avoir_note` (
  `valeurAacquerir` tinyint(1) DEFAULT NULL,
  `valeurEnCours_1` tinyint(1) DEFAULT NULL,
  `valeurEnCours_2` tinyint(1) DEFAULT NULL,
  `valeurRenforcer_1` tinyint(1) DEFAULT NULL,
  `valeurRenforcer_2` tinyint(1) DEFAULT NULL,
  `valeurRenforcer_3` tinyint(1) DEFAULT NULL,
  `valeurConfirmee_1` tinyint(1) DEFAULT NULL,
  `valeurConfirmee_2` tinyint(1) DEFAULT NULL,
  `valeurConfirmee_3` tinyint(1) DEFAULT NULL,
  `valeurConfirmee_4` tinyint(1) DEFAULT NULL,
  `idUtilisateur` varchar(25) NOT NULL,
  `annee` char(25) NOT NULL,
  `idIndicateurPerformance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `avoir_note`
--

INSERT INTO `avoir_note` (`valeurAacquerir`, `valeurEnCours_1`, `valeurEnCours_2`, `valeurRenforcer_1`, `valeurRenforcer_2`, `valeurRenforcer_3`, `valeurConfirmee_1`, `valeurConfirmee_2`, `valeurConfirmee_3`, `valeurConfirmee_4`, `idUtilisateur`, `annee`, `idIndicateurPerformance`) VALUES
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 1),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 2),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 3),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 4),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 5),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 6),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 7),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 8),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 9),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 10),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 11),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 12),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 13),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 14),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 15),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 16),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 17),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 18),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 19),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 20),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 21),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 22),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 23),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 24),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 25),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 26),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 27),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 28),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 29),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 30),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 31),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 32),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 33),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 34),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 35),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 36),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 37),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 38),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 39),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 40),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 41),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 42),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 43),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 44),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 45),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 46),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 47),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 48),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 49),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 50),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 51),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 52),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 53),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 54),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 55),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 56),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 57),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 58),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 59),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 60),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 61),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 62),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 63),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 64),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 65),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 66),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 67),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 68),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 69),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 70),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 71),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 72),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 73),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 74),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 75),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 76),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 77),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 78),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 79),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 80),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 81),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 82),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 83),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 84),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 85),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 86),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 87),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 88),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 89),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 90),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 91),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 92),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 93),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 94),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 95),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 96),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 97),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 98),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 99),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 100),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 101),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 102),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 103),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 104),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 105),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 106),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 107),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 108),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 109),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 110),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 111),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 112),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 113),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 114),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 115),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 116),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 117),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 118),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 119),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 120),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 121),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 122),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 123),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 124),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 125),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 126),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 127),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 128),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 129),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 130),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 131),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 132),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 133),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 134),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 135),
(1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 136),
(1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 137),
(1, 1, 0, 1, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 138),
(1, 1, 0, 1, 0, 0, 1, 0, 0, 0, 'eleve', '2018/2019', 139),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 140),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 141),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 142),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 143),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 144),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 145),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 146),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 147),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 148),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 149),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 150),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 151),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 152),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 153),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 154),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 155),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 156),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 157),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 158),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 159),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 160),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 161),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 162),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 163),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 164),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 165),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 166),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 167),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 168),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 169),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 170),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 171),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 172),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 173),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 174),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 175),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 176),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 177),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 178),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 179),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 180),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 181),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 182),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 183),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 184),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 185),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 186),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 187),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 188),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 189),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 190),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 191),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 192),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 193),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 194),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 195),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 196),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 197),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 198),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 199),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 200),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 201),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 202),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 203),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 204),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 205),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 206),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 207),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 208),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 209),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 210),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 211),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 212),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 213),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 214),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 215),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 216),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 217),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 218),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 219),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 220),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 221),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 222),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 223),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 224),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 225),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 226),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 227),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 228),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 229),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 230),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 231),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 232),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 233),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 234),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 235),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 236),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 237),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 238),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 239),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 240),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 241),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 242),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 243),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 244),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 245),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 246),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 247),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 248),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 249),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 250),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 251),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 252),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 253),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 254),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 255),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 256),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 257),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 258),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 259),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 260),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 261),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 262),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 263),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 264),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 265),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 266),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 267),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 268),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 269),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 270),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 271),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 272),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 273),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 274),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 275),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 276),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 277),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 278),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 279),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 280),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 281),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 282),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 283),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 284),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 285),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 286),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 287),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 288),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 289),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 290),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 291),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 292),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 293),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 294),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 295),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 296),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 297),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 298),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 299),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 300),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 301),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 302),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 303),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 304),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 305),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 306),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 307),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 308),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 309),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 310),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 311),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 312),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 313),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 314),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 315),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 316),
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'eleve', '2018/2019', 317);

-- --------------------------------------------------------

--
-- Structure de la table `caracteristiquesssd`
--

CREATE TABLE `caracteristiquesssd` (
  `idCaracteristiquesSSD` int(11) NOT NULL,
  `libelleCaracteristiquesSSD` varchar(1024) DEFAULT NULL,
  `Niveau` int(11) DEFAULT NULL,
  `idSousSavoirDetaille` char(25) DEFAULT NULL,
  `idSavoirDetaille` char(25) DEFAULT NULL,
  `idCompetence` char(25) DEFAULT NULL,
  `idFiliere` char(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `competence`
--

CREATE TABLE `competence` (
  `idCompetence` char(25) NOT NULL,
  `libelleCompetence` varchar(255) DEFAULT NULL,
  `idFiliere` char(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `competence`
--

INSERT INTO `competence` (`idCompetence`, `libelleCompetence`, `idFiliere`) VALUES
('C1', 'S\'intégrer dans un environnement professionnel, assurer une veille technologique et capitaliser l\'expérience.', '1'),
('C1', 'S\'intégrer dans un environnement professionnel, assurer une veille technologique et capitaliser l\'expérience.', '2'),
('C10', 'Définir des processus de réalisation.', '1'),
('C10', 'Définir des processus de réalisation.', '2'),
('C11', 'Participer à un processus collaboratif de conception et de réalisation de produit.', '1'),
('C11', 'Participer à un processus collaboratif de conception et de réalisation de produit.', '2'),
('C12', 'Intégrer l\'éco-conception dans la conception d\'un produit.', '1'),
('C12', 'Intégrer l\'éco-conception dans la conception d\'un produit.', '2'),
('C13', 'Intégrer le prototypage dans la conception et la réalisation d\'un produit.', '1'),
('C13', 'Intégrer le prototypage dans la conception et la réalisation d\'un produit.', '2'),
('C14', 'Elaborer le dossier de définition d\'un produit mécanique (pièces cotées et tolérancées)', '1'),
('C14', 'Planifier une réalisation', '2'),
('C15', 'Lancer et suivre une réalisation', '2'),
('C16', 'Appliquer un plan qualité, un plan sécurité', '2'),
('C2', 'Rechercher une information dans une documentation technique, dans un réseau local ou à distance', '1'),
('C2', 'Rechercher une information dans une documentation technique, en local ou à distance', '2'),
('C3', 'Formuler et transmettre des informations, communiquer sous forme ?crite et orale y compris en anglais', '1'),
('C3', 'Formuler et transmettre des informations, communiquer sous forme écrite et orale y compris en anglais', '2'),
('C4', 'S\'impliquer dans un groupe de projet et argumenter des choix techniques', '1'),
('C4', 'S\'impliquer dans un groupe de projet et argumenter des choix techniques', '2'),
('C5', 'Elaborer ou participer à l\'élaboration d\'un cahier des charges fonctionnel', '1'),
('C5', 'Élaborer ou participer à l?élaboration d?un cahier des charges fonctionnel', '2'),
('C6', 'Recenser et spécifier des technologies et des moyens de réalisation', '1'),
('C6', 'Interpréter un dossier de conception préliminaire', '2'),
('C7', 'Concevoir et définir, à l\'aide d\'un logiciel de CAO et des outils de simulation associés, un système, un outillage ou des pi?ces m?caniques satisfaisant au cahier des charges fonctionnel', '1'),
('C7', 'Participer à un processus collaboratif de conception et de réalisation d?un produit', '2'),
('C8', 'Imaginer et proposer des solutions techniques en réponse à un cahier des charges', '1'),
('C8', 'Recenser et spécifier des technologies et des moyens de réalisation', '2'),
('C9', 'Dimensionner tout ou partie d\'une chaîne d\'énergie en autonomie et/ou en collaboration avec un spécialiste', '1'),
('C9', 'Concevoir et définir, en collaboration ou en autonomie, tout ou partie d\'un ensemble mécanique unitaire', '2'),
('Cb17', 'Définir un plan de surveillance de la production d?une pièce', '2'),
('Cb18', 'Qualifier des moyens de réalisation en mode production', '2');

-- --------------------------------------------------------

--
-- Structure de la table `competencedetaillee`
--

CREATE TABLE `competencedetaillee` (
  `idCompetenceDetaillee` char(25) NOT NULL,
  `libelleCompetenceDetaillee` varchar(1024) DEFAULT NULL,
  `idCompetence` char(25) NOT NULL,
  `idFiliere` char(25) NOT NULL,
  `idDonnee` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `competencedetaillee`
--

INSERT INTO `competencedetaillee` (`idCompetenceDetaillee`, `libelleCompetenceDetaillee`, `idCompetence`, `idFiliere`, `idDonnee`) VALUES
('C1.1', 'Respecter des référentiels internes ou externes.', 'C1', '1', 32),
('C1.1', 'Prendre en compte la politique de l’entreprise', 'C1', '2', 32),
('C1.2', 'Intégrer une action d\'étude dans une démarche «qualité».', 'C1', '1', 1),
('C1.2', 'Contribuer à l’archivage, à la traçabilité des affaires et à la capitalisation des expériences', 'C1', '2', 32),
('C1.3', 'Contribuer à l\'archivage, à la traçabilité de l\'étude et à la capitalisation des expériences dans les bases de données techniques de l\'entreprise, participer à l\'alimentation d\'un système de gestion de données techniques.', 'C1', '1', 1),
('C1.3', 'Participer à l\'alimentation d\'un système de gestion de données techniques', 'C1', '2', 32),
('C1.4', 'Maîtriser le bon usage des outils de communication technique.', 'C1', '1', 1),
('C1.4', 'Contribuer à la veille technologique de l’entreprise', 'C1', '2', 32),
('C1.5', 'élaborer et suivre l\'évolution d\'un dossier technique de produit.', 'C1', '1', 1),
('C10.1', 'Pas de compétence détaillée', 'C10', '1', 24),
('C10.1', 'Extraire la maquette de conception d’un ensemble, la définition numérique des pièces constitutives à réaliser', 'C10', '2', 41),
('C10.2', 'Analyser le dossier de définition détaillée d’un produit', 'C10', '2', 41),
('C10.3', 'Déterminer des groupements d’entités et la succession des procédés de réalisation nécessaires', 'C10', '2', 41),
('C10.4', 'Estimer des performances de procédés', 'C10', '2', 41),
('C10.5', 'Déterminer des stratégies de réalisation', 'C10', '2', 41),
('C10.6', 'Description comp detail test', 'C10', '1', NULL),
('C10.6', 'Déterminer des paramètres de réalisation', 'C10', '2', 41),
('C10.7', 'Déterminer des spécifications de réalisation', 'C10', '2', 41),
('C10.8', 'Simuler une réalisation', 'C10', '2', 41),
('C10.9', 'Définir et choisir une méthode et des moyens de mesurage en tenant compte de contraintes technico-économiques', 'C10', '2', 41),
('C11.1', 'Collaborer au choix d\'un matériau et d’un procédé d’élaboration compatibles avec les fonctions et formes de la pièce.', 'C11', '1', 25),
('C11.1', 'Identifier les étapes d’un processus prévisionnel nécessitant des essais', 'C11', '2', 42),
('C11.2', 'Intégrer les exigences ou propositions d’un spécialiste.', 'C11', '1', 26),
('C11.2', 'Identifier les paramètres influents sur des caractéristiques étudiées', 'C11', '2', 42),
('C11.3', 'Collaborer à la définition/ au choix des moyens de réalisation en réponse à un besoin de conception et de fabrication.', 'C11', '1', 27),
('C11.3', 'Définir un protocole d’essais : objectif, conditions, forme des résultats', 'C11', '2', 42),
('C11.4', 'Configurer des outils de simulation numérique', 'C11', '2', 42),
('C11.5', 'Configurer des moyens réels pour conduire des expérimentations', 'C11', '2', 42),
('C11.6', 'Configurer des moyens de production pour tester un processus', 'C11', '2', 42),
('C11.7', 'Conduire des essais par simulation numérique', 'C11', '2', 42),
('C11.8', 'Mettre en œuvre des moyens réels pour conduire des expérimentations', 'C11', '2', 42),
('C11.9', 'Exploiter des résultats d’essais', 'C11', '2', 42),
('C12.1', 'Pas de compétences détaillées', 'C12', '1', 28),
('C12.1', 'Identifier les tâches à réaliser et leur enchaînement', 'C12', '2', 43),
('C12.2', 'Organiser les flux', 'C12', '2', 43),
('C12.3', 'Définir ou choisir les moyens environnants (transfert, stockage, préparation, contrôle, parachèvement ...)', 'C12', '2', 43),
('C13.1', 'Participer à une boucle itérative de validation d\'une géométrie ou d\'une architecture à partir de la réalisation d\'un prototype.', 'C13', '1', 29),
('C13.1', 'Identifier des améliorations possibles d’un processus de réalisation', 'C13', '2', 44),
('C13.2', 'Valider le comportement du système conçu au regard du cahier des charges fonctionnel.', 'C13', '1', 30),
('C13.2', 'Identifier et hiérarchiser des facteurs influents', 'C13', '2', 44),
('C13.3', 'Appliquer une méthode d’optimisation', 'C13', '2', 44),
('C13.4', 'Identifier des solutions d’amélioration d’un processus de réalisation', 'C13', '2', 44),
('C13.5', 'Estimer et argumenter des résultats d’amélioration et le retour sur investissement', 'C13', '2', 44),
('C14.1', 'Réaliser des mises en plan normées (ensembles, sous ensembles, nomenclatures', 'C14', '1', 31),
('C14.1', 'Identifier les ressources matérielles et humaines mobilisables', 'C14', '2', 45),
('C14.2', 'Réaliser un dessin de définition de pièce, coté, tolérancé.', 'C14', '1', 31),
('C14.2', 'Déterminer la capacité à produire d’une unité de réalisation', 'C14', '2', 45),
('C14.3', 'Intégrer un processus prévisionnel à un contexte de réalisation ou à des processus déjà existants', 'C14', '2', 45),
('C15.1', 'S’assurer de la disponibilité de moyens humains et matériels ainsi que de la matière d’œuvre', 'C15', '2', 46),
('C15.2', 'Effectuer le lancement d’une réalisation', 'C15', '2', 46),
('C15.3', 'Mettre en œuvre un programme de contrôle en cours de réalisation', 'C15', '2', 46),
('C15.4', 'Identifier des non-conformités d’une réalisation, en rendre compte et y remédier', 'C15', '2', 46),
('C15.5', 'Identifier les facteurs influents sur des aléas de réalisation', 'C15', '2', 46),
('C16.1', 'Vérifier l’application d’un système qualité à son secteur de production', 'C16', '2', 47),
('C16.2', 'Exploiter les documents de traçabilité d’une entreprise', 'C16', '2', 47),
('C16.3', 'Participer aux audits internes liés au plan qualité d’une entreprise', 'C16', '2', 47),
('C16.4', 'S’assurer de la mise en œuvre d’actions correctives à son secteur d’activité', 'C16', '2', 47),
('C16.5', 'Participer à l’amélioration continue du plan qualité d’une entreprise', 'C16', '2', 47),
('C16.6', 'Formaliser une évaluation des risques dans le cadre du “Document unique d’évaluation des risques professionnels”', 'C16', '2', 48),
('C16.7', 'Participer à l’élaboration d’un plan de prévention – sécurité', 'C16', '2', 48),
('C16.8', 'Aménager un poste de travail selon une démarche ergonomique', 'C16', '2', 48),
('C2.1', 'Mettre en œuvre une démarche de recherche d’information', 'C2', '1', 2),
('C2.1', 'Mettre en œuvre une démarche de recherche d’information', 'C2', '2', 33),
('C2.2', 'Classer, hiérarchiser des informations', 'C2', '1', 2),
('C2.2', 'Classer, hiérarchiser des informations', 'C2', '2', 33),
('C2.3', 'Synthétiser une information.', 'C2', '1', 2),
('C2.3', 'Synthétiser une information', 'C2', '2', 33),
('C3.1', 'Choisir une stratégie et des supports de communication.', 'C3', '1', 3),
('C3.1', 'Choisir une stratégie et des supports de communication', 'C3', '2', 34),
('C3.2', 'Lire et rédiger un compte-rendu, un document technique en français et en anglais', 'C3', '1', 3),
('C3.2', 'Lire et rédiger un compte-rendu, un document technique en français et en anglais', 'C3', '2', 34),
('C3.3', 'Présenter oralement un rapport en français et en anglais', 'C3', '1', 3),
('C3.3', 'Présenter oralement un rapport en français et en anglais', 'C3', '2', 34),
('C3.4', 'Participer à un échange technique en français et en anglais', 'C3', '1', 3),
('C3.4', 'Participer à un échange technique en français et en anglais', 'C3', '2', 34),
('C4.1', 'Argumenter, au sein d’un groupe projet, les solutions techniques et économiques \r\nproposées en exploitant les outils adaptés. ', 'C4', '1', 4),
('C4.1', 'Identifier son rôle au sein d’un groupe projet par rapport au problème technique à résoudre', 'C4', '2', 35),
('C4.2', 'Travailler en équipe et adopter les postures d\'écoute, de discussion, de prise en compte d\'avis, de participation. ', 'C4', '1', 4),
('C4.2', 'Argumenter les solutions techniques et économiques proposées', 'C4', '2', 35),
('C4.3', 'Rendre compte et participer à la capitalisation des solutions techniques de l\'entreprise. ', 'C4', '1', 4),
('C4.3', 'Travailler en équipe', 'C4', '2', 35),
('C4.4', 'Respecter les objectifs et les règles assignés au groupe projet Respecter la durée d’étude attendue en phase avec le jalonnement d’un projet, recenser les éléments du coût et rendre compte. ', 'C4', '1', 4),
('C4.4', 'Respecter les objectifs et les règles assignés au groupe projet', 'C4', '2', 35),
('C5.1', 'Décoder un besoin et/ou élaborer un cahier des charges initial. ', 'C5', '1', 5),
('C5.1', 'Décoder un besoin', 'C5', '2', 36),
('C5.2', 'Recenser les contraintes d’une étude.', 'C5', '1', 6),
('C5.2', 'Recenser les contraintes liées à un besoin', 'C5', '2', 36),
('C5.3', 'Formuler et synthétiser un cahier des charges fonctionnelFormuler et synthétiser un cahier des charges fonctionnel résultant d’une verbalisation écrite ou orale. ', 'C5', '1', 7),
('C5.3', 'Formuler et synthétiser un cahier des charges fonctionnel', 'C5', '2', 36),
('C5.4', 'Participer à l\'élaboration d\'un devis d\'une affaire.', 'C5', '1', 8),
('C6.1', 'Pas de compétence détaillée', 'C6', '1', 9),
('C6.1', 'Décoder un dossier de conception et les spécifications du cahier des charges', 'C6', '2', 37),
('C6.2', 'Analyser les fonctions assurées par les éléments participant aux assemblages', 'C6', '2', 37),
('C6.3', 'Identifier et justifier les difficultés de réalisation liées aux exigences', 'C6', '2', 37),
('C7.1', 'Élaborer la maquette numérique de conception préliminaire du produit à l’aide d’un modeleur volumique, paramétrable, variationnel. ', 'C7', '1', 10),
('C7.1', 'Proposer des solutions de conception compatibles avec les procédés envisageables', 'C7', '2', 38),
('C7.2', 'Formaliser les spécifications de fonctionnement.', 'C7', '1', 11),
('C7.2', 'Intégrer des spécifications induites par l’optimisation technico-économique du processus de réalisation', 'C7', '2', 38),
('C7.3', 'Générer une maquette numérique robuste de l’ensemble étudié.', 'C7', '1', 12),
('C7.3', 'Vérifier par simulation de procédés la faisabilité d’une solution', 'C7', '2', 38),
('C7.4', 'Utiliser un logiciel de simulation pour optimiser / valider la conception détaillée d\'un mécanisme.', 'C7', '1', 13),
('C7.4', 'Argumenter des modifications par une approche technicoéconomique et/ou environnementale', 'C7', '2', 38),
('C7.5', 'Élaborer la maquette numérique définitive.', 'C7', '1', 14),
('C7.5', 'Collaborer à l’évolution de la maquette numérique d’un produit', 'C7', '2', 38),
('C7.6', 'Générer les représentations graphiques dérivées en mobilisant les fonctionnalités des modeleurs volumiques.', 'C7', '1', 15),
('C8.1', 'Analyser et comparer les solutions techniques associées aux fonctions techniques, argumenter.', 'C8', '1', 16),
('C8.1', 'Proposer et justifier des technologies et des moyens envisageables', 'C8', '2', 39),
('C8.2', 'Concevoir des solutions techniques en mobilisant les méthodes de créativité tout en respectant les contraintes de la propriété industrielle.', 'C8', '1', 17),
('C8.2', 'Hiérarchiser des contraintes de production et en déduire des conséquences sur la relation produit – procédé', 'C8', '2', 39),
('C8.3', 'Rechercher et expliciter un principe de solution.', 'C8', '1', 18),
('C8.3', 'Déterminer les performances nécessaires des moyens de réalisation', 'C8', '2', 39),
('C8.4', 'Proposer ou expliciter sous forme de croquis ou de schéma, commenté, légendé, une solution constructive.', 'C8', '1', 19),
('C8.4', 'Rédiger le cahier des charges des clauses techniques d’un moyen de réalisation', 'C8', '2', 39),
('C8.5', 'Déterminer les données techniques de réalisation nécessaires à l’établissement d’une réponse à une affaire', 'C8', '2', 39),
('C9.1', 'Mobiliser les connaissances de mécanique dans l\'objectif d\'établir des relations d\'entrées-sorties de mécanismes plans ou spatiaux se prêtant à une modélisation simple.', 'C9', '1', 20),
('C9.1', 'Élaborer la maquette numérique de conception d’un ensemble mécanique unitaire', 'C9', '2', 40),
('C9.2', 'Pré dimensionner les éléments de structure et/ou les actionneurs essentiels au  projet.', 'C9', '1', 21),
('C9.2', 'Optimiser les solutions constructives de l’ensemble mécanique unitaire', 'C9', '2', 40),
('C9.3', 'Améliorer par itération une géométrie ou une architecture, par simulation informatique des comportements mécaniques.', 'C9', '1', 22),
('C9.3', 'Vérifier par simulation la faisabilité d’une solution', 'C9', '2', 40),
('C9.4', 'Dimensionner et choisir un composant standard en exploitant une base de données industrielle, mécanique ou électrique.', 'C9', '1', 23),
('C9.4', 'Générer des représentations graphiques dérivées en mobilisant les fonctionnalités des modeleurs volumiques', 'C9', '2', 40),
('C9.5', 'Spécifier les éléments constitutifs d’un ensemble mécanique unitaire', 'C9', '2', 40),
('Cb17.1', 'Identifier le type de contrôle (de réception, de qualification, de suivi, de début de série ...)', 'Cb17', '2', 49),
('Cb17.2', 'Identifier et expliciter des spécifications critiques', 'Cb17', '2', 49),
('Cb17.3', 'Définir un protocole de surveillance', 'Cb17', '2', 49),
('Cb18.1', 'Identifier les paramètres à contrôler pour garantir la qualité d’un produit ou les performances d’un processus', 'Cb18', '2', 50),
('Cb18.2', 'Choisir ou définir des protocoles de contrôle permettant de quantifier la valeur d’un paramètre de contrôle du processus', 'Cb18', '2', 50),
('Cb18.3', 'Mettre en oeuvre un moyen et une procédure de contrôle afin de déterminer les performances d’un processus', 'Cb18', '2', 50),
('Cb18.4', 'Quantifier des résultats obtenus au cours d’une réalisation (qualité du produit, cadence dans le cas d’une série ...)', 'Cb18', '2', 50),
('Cb18.5', 'Corréler des écarts observés avec des causes', 'Cb18', '2', 50),
('Cb18.6', 'Formaliser des actions correctives', 'Cb18', '2', 50),
('Cb18.7', 'Finaliser le dossier de réalisation du produit.', 'Cb18', '2', 50);

-- --------------------------------------------------------

--
-- Structure de la table `contenir`
--

CREATE TABLE `contenir` (
  `idActivite` int(11) NOT NULL,
  `idCompetence` char(25) NOT NULL,
  `idFiliere` char(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `donnee`
--

CREATE TABLE `donnee` (
  `idDonnee` int(11) NOT NULL,
  `libelleDonnee` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `donnee`
--

INSERT INTO `donnee` (`idDonnee`, `libelleDonnee`) VALUES
(1, 'Bureau d’études de conception de produits. Procédures identifiées de conception, de sauvegardes, de validation, d’archivage et de modifications.'),
(2, 'Les catalogues constructeurs, bases de données locales ou à distance. Méthodes de recherche, de tri et de classement.'),
(3, 'Une information à transmettre. Le résultat escompté. L’origine et la destination de l’information. Les standard de communication de l’entreprise'),
(4, 'Les croquis, schémas…d’études préliminaires. \r\nDes bases de données locales et/ou à distances \r\nLa base de données du « savoir-faire » de l’entreprise. \r\nDes catalogues de constructeurs. \r\nLes informations techniques et économiques relatives aux divers coûts : composants, matière, procédés. \r\nUn problème technique ou organisationnel intégré dans une démarche de conception/production. \r\nUn ou des objectifs à atteindre en phase de conception, pré industrialisation, d’industrialisation, de production et de contrôle. \r\nUn groupe d’interlocuteurs identifiés. \r\nLes conditions des échanges : réunion d’information, de travail technique, rapport \r\nd’activité, négociation. \r\nLes moyens logiciels et matériels de présentation écrite et/ou orale.'),
(5, 'Un cahier des charges initial issu de l\'entreprise, ou l\'expression d\'un besoin client. '),
(6, 'Un cahier des charges initial issu de l\'entreprise ou l\'expression d\'un besoin client, les recueils de normes et réglementations, les contraintes liées à la propriété industrielle, les données relatives à la qualité, aux coûts et aux délais. '),
(7, 'En présence du chef de projet, le cahier des charges validé issu de l\'entreprise, les contraintes recensées, et/ou tout ou partie d\'un cahier des charges fonctionnel. '),
(8, 'Cahier des charges fonctionnel ou conception préliminaire d’un produit. '),
(9, 'Besoin et CdCF. Moyens techniques de production de l’entreprise, des sous-traitants, les partenaires potentiels de l’étude. '),
(10, 'Les croquis et schémas d\'étude associés aux solutions constructives retenues pour satisfaire au cahier des charges. Des bibliothèques locales ou à distance de composants standards. '),
(11, 'Les composants standard ou non standard choisis et dimensionnés répondant à la solution technique. '),
(12, 'Un modeleur volumique paramétrable variationnel. Le modèle numérique préliminaire organisé en cohérence avec la méthodologie de conception et les solutions numérisées. Les procédés envisagés en lien avec un spécialiste. '),
(13, 'Le cahier des charges fonctionnel. La maquette numérique en phase de conception détaillée et des outils informatiques de simulation métiers avec leur documentation. Un critère comportemental d\'étude lié à l\'optimisation de tout ou partie du modèle numérique (pièce, sous-ensemble). Les données sur les propriétés mécaniques et physiques des matériaux. '),
(14, 'La maquette numérique de l’étude intégrant les spécifications fonctionnelles et exigences de cycle de vie. Les matériaux et procédés retenus.'),
(15, 'Un modeleur volumique paramétrable variationnel et ses fonctionnalités de rendu réaliste.'),
(16, 'Cahier des charges fonctionnel. Diagrammes SysML. '),
(17, 'Un principe de solution d\'une fonction technique issu ou non de l\'application d\'une méthode de créativité. Moteurs de recherche des sites d\'organismes de protection de la propriété industrielle. Normes et règlements.'),
(18, 'Une ou plusieurs fonction(s) technique(s) issue(s) de l\'analyse d\'un cahier des charges fonctionnel ou de diagrammes SysML. Une méthode de créativité éventuellement en appui avec un logiciel spécifique d\'aide à la recherche de principes de solution. '),
(19, 'La solution technique retenue.'),
(20, 'Cahier des charges fonctionnel. Une proposition de cinématique envisagée – une cinématique existante dans le cas d\'un travail sur un produit existant. '),
(21, 'Cahier des charges fonctionnel. Une architecture de mécanisme ou un mécanisme existant avec une modélisation des liaisons associées. Les résultats de l\'étude cinématique. Le cas échéant, les caractéristiques dimensionnelles des pièces constitutives du mécanisme.  '),
(22, 'Le cahier des charges fonctionnel. La maquette numérique préliminaire et des outils informatiques de simulation métiers avec leur documentation la stratégie d\'optimisation définie avec le chef de projet. '),
(23, 'Cahier des charges fonctionnel. Contraintes mécaniques et autres, auxquelles est soumis le composant. Performances attendues (géométriques – précision-, cinématiques, dynamiques –accélération). '),
(24, 'Maquette numérique. \r\nPlan qualité? de l’entreprise. \r\nLe cahier des charges fonctionnel \r\nDans le cadre d\'une conception, reconception, évolution de produit, un objectif d\'optimisation d\'une solution technique en terme de valeur associée. \r\nBases de données de coûts relatifs aux, composants, matériaux procédés, processus envisagés. \r\nL\'assistance éventuelle d\'un spécialiste \r\nCoûts (composants, matière, procédés). '),
(25, 'Cahier des charges fonctionnel.Maquette numérique de conception détaillée. Bases de données. Logiciel d\'aide au choix de matériau. '),
(26, 'Le cahier des charges fonctionnel du produit. Les éléments économiques : lots, délais, coût prévisionnel. Le modèle numérique de conception préliminaire de la pièce concernée. Les résultats de la simulation du procédé d’obtention de la pièce étudiée à l’aide d’un module métier. Rapport d’analyse d\'un spécialiste d\'un procédé sur la pièce à fabriquer.  '),
(27, 'Le cahier des charges fonctionnel du produit. \r\nLes éléments économiques : lots, délais, coût prévisionnel. \r\nLe modèle numérique de conception préliminaire de la pièce concernée. \r\nLes résultats de la simulation du procédé d’obtention de la pièce étudiée à l’aide d’un module métier. \r\nLes exigences de production. \r\nLe couple matériau/procédé retenu. '),
(28, 'La réglementation en vigueur et la normalisation. Les éléments technico économiques, environnementaux, maintenabilité, etc. retenus par le client. Le coût objectif, les contraintes de qualité et de délais. Outils d\'aide au choix. '),
(29, 'Cahier des charges fonctionnel Maquette numérique de conception. Nomenclature. Choix des  comportements à valider ou des géométries à valider.'),
(30, 'Cahier des charges fonctionnel finalisé du produit. \r\nMaquette numérique de conception. \r\nNomenclature. \r\nChoix des  comportements à valider ou des géométries à valider. \r\nLes  prototypes. '),
(31, 'Le dossier technique numérique résultant de la conception détaillée incluant les spécifications de fonctionnement. \r\nLa maquette numérique de conception détaillée du système ou produit. \r\nLes normes en vigueur \r\nLe choix du couple procédé matériau. '),
(32, 'Le cadre social, économique et environnemental de fonctionnement de l’entreprise\r\nLes stratégies et certifications de l’entreprise\r\nLes procédures de gestion des données de l’entreprise\r\nLes bases de données de l’entreprise\r\nLes sources d’informations externes'),
(33, 'Les catalogues constructeurs, bases de données locales ou à distance\r\nToutes ressources numériques\r\nLe protocole de classement utilisé'),
(34, 'Une information à transmettre\r\nLe résultat escompté\r\nL’origine et la destination de l’information\r\nLes standard de communication de l’entreprise'),
(35, 'Le cahier des charges du projet\r\nLes données de l’entreprise\r\nLe planning du projet\r\nLa composition du groupe projet\r\nLes règles ou consignes de fonctionnement du groupe projet'),
(36, 'Le dossier de réalisation\r\nL’expression du besoin\r\nLes normes et réglementations'),
(37, 'Le dossier de conception préliminaire\r\nLes exigences fonctionnelles de la pièce\r\nLes exigences de production : quantité, délais, coût prévisionnel, moyens envisagés\r\nLes normes et réglementations'),
(38, 'La maquette numérique de conception préliminaire du produit et/ou de la pièce et les exigences fonctionnelles\r\nLes exigences de production : quantité, délais, coût prévisionnel, moyens envisagés\r\nLe matériau, les procédés initialement prévus et les bases de données techniques et économiques attenantes\r\nÉventuellement, les résultats de simulation des procédés\r\nUn contact éventuel avec un spécialiste du métier\r\nLes normes et réglementations'),
(39, 'Le dossier de conception préliminaire\r\nLes exigences de production : quantité, délais, coût prévisionnel\r\nLe(s) couple(s) matériau/procédé retenu(s)\r\nLa liste des moyens techniques disponibles à l’interne et à l’externe (sous-traitants) et  eurs notices techniques\r\nLes bases des données relatives aux matériaux et aux procédés\r\nLa description des processus prévisionnels\r\nLes normes et réglementations'),
(40, 'Les exigences de production : quantité, délais, coût prévisionnel\r\nLa maquette numérique spécifiée de conception préliminaire du produit\r\nL’ensemble des moyens techniques de réalisation disponibles et leurs notices techniques\r\nLes procédés envisagés en lien avec un spécialiste\r\nLa description des processus prévisionnels \r\nLes bases des données relatives aux matériaux et aux procédés retenus ainsi qu’aux composants standard\r\nLes normes et réglementations\r\nLes données capitalisées par l’entreprise'),
(41, 'Le dossier de définition détaillée du produit\r\nLe processus prévisionnel\r\nDes banques de données outils, outillages, procédés, processus\r\nUne description des moyens de réalisation disponibles'),
(42, 'La maquette numérique\r\nLe processus et/ou le procédé envisagé\r\nDes banques de données outils, outillages, procédés\r\nLes moyens matériels nécessaires pour la mise en oeuvre des essais\r\nUne banque de données sur les résultats d’essais antérieurs\r\nÉventuellement, des outils d’aide à la mise en place de plans d\'expériences\r\nLes normes et réglementations'),
(43, 'La définition du contexte de travail\r\nLe processus détaillé\r\nDes banques de données outils, outillages, procédés\r\nLes normes et réglementations'),
(44, 'Le dossier de production du produit\r\nLa documentation technique associée aux moyens de réalisation\r\nLes documents normatifs, procédures et manuels d\'assurance qualité de l\'entreprise\r\nDes outils de veille technologique, des documents présentant des caractéristiques nouvelles, des solutions innovantes ou des possibilités de transferts de technologie.\r\nLes normes et réglementations'),
(45, 'Le dossier de réalisation du produit\r\nLe planning de charge de l’unité\r\nLes données de l’entreprise : soustraitance, heures supplémentaires possibles...\r\nLes fiches de postes de l’entreprise et les compétences associées'),
(46, 'Le dossier de réalisation Le plan de charge de l’unité de réalisation\r\nLes ordres de fabrication\r\nLes documents de traçabilité\r\nLa documentation technique des moyens de réalisation\r\nLes données capitalisées par l’entreprise'),
(47, 'L’organigramme de l’entreprise\r\nLe plan qualité de l’entreprise\r\nL’archivage des documents de traçabilité\r\nLes comptes-rendus des réunions qualité et des audits précédents'),
(48, 'Une situation de travail\r\nDes outils d’analyse (AMDEC, arbre des causes, check-list, arbre des défaillances,  grilles d’observation)\r\nUne analyse de situation de travail\r\nLes critères de choix d’une mesure de prévention\r\nLa charte ou le plan de sécurité de l’entreprise (y compris le document unique actuel)\r\nLa réglementation en vigueur'),
(49, 'Le dossier de production de la pièce\r\nLes normes\r\nLa liste des moyens de contrôle et de mesure disponibles\r\nUne banque de données techniques'),
(50, 'Le dossier de réalisation\r\nLes résultats des essais et tests de qualification du processus\r\nLes procédures de contrôle de l’entreprise \r\nLa liste des moyens de contrôle disponibles\r\nLes limites et les performances des moyens de contrôle mis en oeuvre\r\nLes données capitalisées par l’entreprise\r\nLes documents de traçabilité\r\nLes procédures d’élaboration des dossiers de réalisation de l’entreprise.');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `idUtilisateur` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`idUtilisateur`) VALUES
('eleve');

-- --------------------------------------------------------

--
-- Structure de la table `etudiantannee`
--

CREATE TABLE `etudiantannee` (
  `idUtilisateur` varchar(25) NOT NULL,
  `annee` char(25) NOT NULL,
  `idAnneeEtude` int(11) DEFAULT NULL,
  `idFiliere` char(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etudiantannee`
--

INSERT INTO `etudiantannee` (`idUtilisateur`, `annee`, `idAnneeEtude`, `idFiliere`) VALUES
('eleve', '2018/2019', 1, '1');

-- --------------------------------------------------------

--
-- Structure de la table `filiere`
--

CREATE TABLE `filiere` (
  `idFiliere` char(25) NOT NULL,
  `libelleFiliere` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `filiere`
--

INSERT INTO `filiere` (`idFiliere`, `libelleFiliere`) VALUES
('1', 'CPI'),
('2', 'CPRP');

-- --------------------------------------------------------

--
-- Structure de la table `indicateurperformance`
--

CREATE TABLE `indicateurperformance` (
  `idIndicateurPerformance` int(11) NOT NULL,
  `libelleIndicateurPerformance` varchar(1024) DEFAULT NULL,
  `idCompetenceDetaillee` char(25) DEFAULT NULL,
  `idCompetence` char(25) DEFAULT NULL,
  `idFiliere` char(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `indicateurperformance`
--

INSERT INTO `indicateurperformance` (`idIndicateurPerformance`, `libelleIndicateurPerformance`, `idCompetenceDetaillee`, `idCompetence`, `idFiliere`) VALUES
(1, 'L\'ensemble des référentiels est respecté scrupuleusement.', 'C1.1', 'C1', '1'),
(2, 'Les procédures relatives à la démarche qualité sont identifiées et respectées. ', 'C1.2', 'C1', '1'),
(3, 'Tous les éléments essentiels sont répertoriés et ajoutés à l\'archive de l\'entreprise. ', 'C1.3', 'C1', '1'),
(4, 'Les procédures d\'utilisation du système de gestion de données sont scrupuleusement respectées. ', 'C1.3', 'C1', '1'),
(5, 'La traçabilité respecte les standards de l\'entreprise et du donneur d\'ordre. ', 'C1.3', 'C1', '1'),
(6, 'La communication technique est maîtrisée sur la forme et les outils sont adaptés aux besoins et aux interlocuteurs. ', 'C1.4', 'C1', '1'),
(7, 'Les évolutions techniques de son champ d\'activité sont identifiées et capitalisées.', 'C1.5', 'C1', '1'),
(8, 'L\'information recherchée est réordonnée. ', 'C2.1', 'C2', '1'),
(9, 'La démarche pour l\'obtention de l\'information est pertinente. ', 'C2.1', 'C2', '1'),
(10, 'La démarche et les critères de choix pour l\'obtention de l\'information sont efficients.', 'C2.2', 'C2', '1'),
(11, 'La synthèse proposée résume les points importants.', 'C2.3', 'C2', '1'),
(12, 'L\'objectif, le public visé, le message sont clairement identifiés.', 'C3.1', 'C3', '1'),
(13, 'Les outils de communication choisis sont adaptés au message et aux interlocuteurs et respectent les standard de communication de l\'entreprise.', 'C3.1', 'C3', '1'),
(14, 'Le document technique est décodé de manière univoque.', 'C3.2', 'C3', '1'),
(15, 'Le compte-rendu écrit est lisible et concis.', 'C3.2', 'C3', '1'),
(16, 'L\'expression orale est claire.', 'C3.3', 'C3', '1'),
(17, 'Les messages sont concis et sans ambiguïté.', 'C3.3', 'C3', '1'),
(18, 'Le vocabulaire est pertinent et précis.', 'C3.3', 'C3', '1'),
(19, 'Le vocabulaire technique est pertinent et précis.', 'C3.4', 'C3', '1'),
(20, 'Les échanges techniques avec les interlocuteurs sont compréhensibles.', 'C3.4', 'C3', '1'),
(21, 'Les critères techniques et économiques retenus sont pertinents. ', 'C4.1', 'C4', '1'),
(22, 'L\'argumentation est logique et objective. ', 'C4.1', 'C4', '1'),
(23, 'Les interventions sont pertinentes. ', 'C4.2', 'C4', '1'),
(24, 'La définition du rôle tenu au sein du groupe est pertinente. ', 'C4.2', 'C4', '1'),
(25, 'Les moyens de communication retenus sont pertinents et maîtrisés. ', 'C4.3', 'C4', '1'),
(26, 'Les descriptions techniques sont exactes et précises. ', 'C4.3', 'C4', '1'),
(27, 'Les jalons du projet sont identifiés et respectés. ', 'C4.4', 'C4', '1'),
(28, 'La durée d\'étude est respectée. ', 'C4.4', 'C4', '1'),
(29, 'Les éléments impactant les coûts de l\'étude sont identifiés. ', 'C4.4', 'C4', '1'),
(30, 'Les informations sont concises et claires. ', 'C4.4', 'C4', '1'),
(31, 'Les éléments essentiels du cahier des charges sont correctement extraits. ', 'C5.1', 'C5', '1'),
(32, 'L\'expression du besoin est correctement traduite. ', 'C5.1', 'C5', '1'),
(33, 'Les contraintes techniques sont identifiées. ', 'C5.2', 'C5', '1'),
(34, 'Les contraintes technico-économiques sont hiérarchisées au regard de l\'expression du besoin et du triptyque « qualité/coût/délai ».  ', 'C5.2', 'C5', '1'),
(35, 'Les exigences du cycle de vie sont prises en compte. ', 'C5.2', 'C5', '1'),
(36, 'Les aspects normatifs sont pris en compte. ', 'C5.2', 'C5', '1'),
(37, 'La frontière de l\'étude est correctement définie.', 'C5.3', 'C5', '1'),
(38, 'Les fonctions de services sont identifiées. ', 'C5.3', 'C5', '1'),
(39, 'Les fonctions de services sont caractérisées : critères- niveaux - flexibilités. ', 'C5.3', 'C5', '1'),
(40, 'Les fonctions de service sont classées au regard de la hiérarchisation des contraintes technico-économiques. ', 'C5.3', 'C5', '1'),
(41, 'Les moyens liés à l\'étude sont correctement inventoriés', 'C5.4', 'C5', '1'),
(42, 'Les délais de recherche d\'informations sont respectés. ', 'C5.4', 'C5', '1'),
(43, 'Les prototypes pouvant être liés à l\'étude sont identifiés. ', 'C5.4', 'C5', '1'),
(44, 'Les moyens techniques de production internes et externes sont caractérisés. ', 'C6.1', 'C6', '1'),
(45, 'Les critères choisis sont en adéquation avec le besoin exprimé.', 'C6.1', 'C6', '1'),
(46, 'L\'inventaire des moyens techniques de production est correct', 'C6.1', 'C6', '1'),
(47, 'L\'arbre d\'assemblage est organisé en sous-ensemble(s) fonctionnel(s) et/ou structurel(s) comprenant les solutions constructives à numériser.', 'C7.1', 'C7', '1'),
(48, 'L\'arbre d\'assemblage est organisé en cohérence avec la méthodologie de conception utilisée. ', 'C7.1', 'C7', '1'),
(49, 'Le mode de création est adapté et évolutif selon le niveau de définition de la maquette numérique (volume, surface, filaire). ', 'C7.1', 'C7', '1'),
(50, 'Le positionnement des pièces est correctement contraint dans le respect des mobilités relatives. ', 'C7.1', 'C7', '1'),
(51, 'Les spécifications de bon fonctionnement du composant dans son contexte et/ou recommandés par les constructeurs sont recensées.', 'C7.2', 'C7', '1'),
(52, 'Les spécifications de fonctionnement sont déclinées sur les documents techniques appropriés. ', 'C7.2', 'C7', '1'),
(53, 'La mise en contrainte à chaque niveau de l\'assemblage est univoque et minimale. ', 'C7.3', 'C7', '1'),
(54, 'Le paramétrage géométrique est établi en cohérence avec le principe et les contraintes fonctionnelles de conception et de procédé envisagé. ', 'C7.3', 'C7', '1'),
(55, 'Le choix des paramètres assure la robustesse au sein de la maquette numérique et sa portabilité attendue.', 'C7.3', 'C7', '1'),
(56, 'L\'outil de simulation retenu est adapté à la validation du critère énoncé. ', 'C7.4', 'C7', '1'),
(57, 'Le modèle numérique est isolé et les données nécessaires sont introduites correctement.', 'C7.4', 'C7', '1'),
(58, 'Les résultats de simulation sont analysés et les conséquences sur la conception détaillée mises en ?uvre. ', 'C7.4', 'C7', '1'),
(59, 'Une assistance à la modélisation associée à la simulation est proposée. ', 'C7.4', 'C7', '1'),
(60, 'Les pièces sont modélisées en respectant les règles d\'obtention des formes associées aux procédés retenus. ', 'C7.5', 'C7', '1'),
(61, 'Les matériaux et autres indications de nomenclature sont associés au modèle. ', 'C7.5', 'C7', '1'),
(62, 'Les représentations graphiques dérivées sont complétées et légendées des informations techniques associées en adéquation avec le point de vue du destinataire. ', 'C7.6', 'C7', '1'),
(63, 'Les documents sont conformes aux attentes du client. ', 'C7.6', 'C7', '1'),
(64, 'La décomposition en fonctions techniques est réalisée.', 'C8.1', 'C8', '1'),
(65, 'Les familles de solutions sont adaptées aux fonctions techniques. ', 'C8.1', 'C8', '1'),
(66, 'Les critères de comparaison sont identifiés et pertinents. ', 'C8.1', 'C8', '1'),
(67, 'La méthode de créativité employée est adaptée à la problématique technique.', 'C8.2', 'C8', '1'),
(68, 'La solution choisie est pertinente au regard du principe retenu.', 'C8.2', 'C8', '1'),
(69, 'La recherche des antériorités de brevets existants des solutions proposées a été effectuée. ', 'C8.2', 'C8', '1'),
(70, 'Un rapport synthétique de recherche est fourni. ', 'C8.2', 'C8', '1'),
(71, 'La reformulation du problème comme donnée d\'entrée de la méthode de créativité est correctement énoncée. ', 'C8.3', 'C8', '1'),
(72, 'Au terme de la recherche, les principes retenus sont pertinents vis à vis de la méthode de créativité et sont explicités par une description synthétique. ', 'C8.3', 'C8', '1'),
(73, 'Le choix du type de croquis et/ou schéma est pertinent pour décrire la solution constructive ', 'C8.4', 'C8', '1'),
(74, 'Les schémas et croquis sont lisibles et clairs. ', 'C8.4', 'C8', '1'),
(75, 'Les normes pour les schémas normalisés sont respectées. ', 'C8.4', 'C8', '1'),
(76, 'Les légendes sont pertinentes et précises. ', 'C8.4', 'C8', '1'),
(77, 'Les commentaires sont pertinents et clairs. ', 'C8.4', 'C8', '1'),
(78, 'Les données de l\'étude sont correctement identifiées : les paramètres d\'entrée et de sortie, les données d\'entrée - vitesse de rotation par exemple-, les données de sortie - course ou débattement souhaité, vitesse attendue, accélération tolérable, précisi', 'C9.1', 'C9', '1'),
(79, 'Les relations liant les paramètres d\'entrée et de sortie sont correctement établies, d\'un point de vue géométrique, cinématique ou énergétique (logique de flux). ', 'C9.1', 'C9', '1'),
(80, 'Le rendement est correctement pris en compte dans le cas d\'une approche énergétique. ', 'C9.1', 'C9', '1'),
(81, 'Le degré d\'hyperstatique constaté est pris en compte dans la conception du système. ', 'C9.1', 'C9', '1'),
(82, 'La frontière d\'étude est correctement définie, au regard du problème à résoudre. ', 'C9.2', 'C9', '1'),
(83, 'Les conditions aux limites sont correctement identifiées. ', 'C9.2', 'C9', '1'),
(84, 'Les hypothèses de travail proposées sont justifiées. L\'incidence sur les conditions aux limites est identifiée. ', 'C9.2', 'C9', '1'),
(85, 'Les actions mécaniques nécessaires sont correctement déterminées, par un calcul statique ou dynamique. ', 'C9.2', 'C9', '1'),
(86, 'Les sollicitations mécaniques sont correctement déterminées. ', 'C9.2', 'C9', '1'),
(87, 'Un pré-dimensionnement de la géométrie de certaines pièces, en regard d\'un matériau, est correctement effectué par l\'étude des contraintes et/ou des déformées. ', 'C9.2', 'C9', '1'),
(88, 'La typologie d\'actionneurs est identifiée. ', 'C9.2', 'C9', '1'),
(89, 'Le modèle retenu en collaboration éventuelle avec un spécialiste est adapté au logiciel de simulation. ', 'C9.3', 'C9', '1'),
(90, 'Les données de simulation  sont introduites correctement en cohérence avec l\'étude attendue. ', 'C9.3', 'C9', '1'),
(91, 'Les résultats pertinents sont identifiés et analysés au regard de l\'objectif fonctionnel. ', 'C9.3', 'C9', '1'),
(92, 'Des propositions correctives d\'évolution des paramètres sont faites en accord avec le chef de projet. ', 'C9.3', 'C9', '1'),
(93, 'Les critères de sélection sont hiérarchisés. ', 'C9.4', 'C9', '1'),
(94, 'Les technologies envisageables sont sélectionnées. ', 'C9.4', 'C9', '1'),
(95, 'Les données complémentaires nécessaires sont recueillies. ', 'C9.4', 'C9', '1'),
(96, 'Le modèle d\'étude est déterminé et les hypothèses simplificatrices retenues sont justifiées. ', 'C9.4', 'C9', '1'),
(97, 'L\'utilisation d\'un catalogue, d\'un logiciel, d\'une base de données technique est efficiente. ', 'C9.4', 'C9', '1'),
(98, 'Le dialogue avec un spécialiste est constructif.  ', 'C9.4', 'C9', '1'),
(99, 'Le choix des éléments retenus est justifié. ', 'C9.4', 'C9', '1'),
(100, 'Les procédures qualité de l\'entreprise sont respectées. ', 'C10.1', 'C10', '1'),
(101, 'Les fonctions techniques élémentaires associées à la solution technique  sont répertoriées. ', 'C10.1', 'C10', '1'),
(102, 'Les fonctions techniques élémentaires sont hiérarchisées et/ou classifiées selon un critère de choix technique. ', 'C10.1', 'C10', '1'),
(103, 'Les fonctions techniques élémentaires sont hiérarchisées et/ou classifiées selon un critère de choix économique. ', 'C10.1', 'C10', '1'),
(104, 'Une démarche  d\'optimisation est mobilisée de façon cohérente seule ou en équipe avec un ou des spécialistes. ', 'C10.1', 'C10', '1'),
(105, 'La solution technique est optimisée conformément à l\'objectif défini et intégrée à l\'étude. ', 'C10.1', 'C10', '1'),
(106, 'Les outils d\'optimisation utilisés sont pertinents et bien utilisés (outils de la méthode APTE, grille AMDEC, etc.) ', 'C10.1', 'C10', '1'),
(107, 'Le choix du matériau est correctement justifié.', 'C11.1', 'C11', '1'),
(108, 'Le choix du procédé est correctement justifié.', 'C11.1', 'C11', '1'),
(109, 'Les critères retenus sont justifiés au regard du cahier des charges. ', 'C11.2', 'C11', '1'),
(110, 'Le compromis matériau-géométrie-procédé-coût est justifié.', 'C11.2', 'C11', '1'),
(111, 'Le modèle numérique est correctement modifié.', 'C11.2', 'C11', '1'),
(112, 'Le choix du couple produit/procédé est compatible au regard des contraintes de production. ', 'C11.3', 'C11', '1'),
(113, 'La solution est valide d\'un point de vue économique et/ou environnemental.', 'C11.3', 'C11', '1'),
(114, 'La définition des moyens est en adéquation avec leur aptitude. ', 'C11.3', 'C11', '1'),
(115, 'Les contraintes environnementales, utilisées pour la caractérisation des fonctions de service, existent. ', 'C12.1', 'C12', '1'),
(116, 'La comparaison des solutions retenues, selon une analyse multicritères explicite, existe et est rationnelle. Elle permet d\'optimiser les trois piliers du développement durable. ', 'C12.1', 'C12', '1'),
(117, 'Un choix de composant standard et/ou sous traité optimisant les impacts environnementaux du cycle de vie du produit existe. ', 'C12.1', 'C12', '1'),
(118, 'La définition des pièces et du système en formes et dimensions optimisant les impacts environnementaux du cycle de vie du produit est pertinente.', 'C12.1', 'C12', '1'),
(119, 'Les fonctions, géométries ou comportement à valider sont identifiés et pertinents. ', 'C13.1', 'C13', '1'),
(120, 'Les itérations de prototypage convergent vers l\'amélioration de la réponse aux besoins identifiés. ', 'C13.1', 'C13', '1'),
(121, 'L\'évolution de la géométrie du système en fonction des résultats du prototypage est pertinente.', 'C13.1', 'C13', '1'),
(122, 'Des prototypes physiques permettant de valider ces besoins existent. ', 'C13.1', 'C13', '1'),
(123, 'La démarche de validation (expérimentation) au regard des comportements à valider est pertinente. ', 'C13.2', 'C13', '1'),
(124, 'La démarche de validation est réalisée. ', 'C13.2', 'C13', '1'),
(125, 'L\'interprétation des résultats de la démarche est argumentée et pertinente. ', 'C13.2', 'C13', '1'),
(126, 'Les comportements du prototype sont validés ou invalidés. ', 'C13.2', 'C13', '1'),
(127, 'Le respect de la normalisation et de la lisibilité de la mise en plan d\'un ensemble sont assurés.', 'C14.1', 'C14', '1'),
(128, 'Le respect de la normalisation et de la lisibilité de la mise en plan de définition d\'une pièce sont assurés.', 'C14.1', 'C14', '1'),
(129, 'Le renseignement de la nomenclature associée au dessin d\'ensemble est exhaustif. ', 'C14.1', 'C14', '1'),
(130, 'Les spécifications de fonctionnement sont correctement reportées (jeux, ajustements, ...). ', 'C14.1', 'C14', '1'),
(131, 'Une démarche explicite  de spécification est mobilisée et permet de garantir la traçabilité.', 'C14.2', 'C14', '1'),
(132, 'Les spécifications de fonctionnement (chaînes de cotes, conditions géométriques, états de surface) sont correctement traduites. ', 'C14.2', 'C14', '1'),
(133, 'L\'identification des surfaces ou groupes de surfaces fonctionnelles est exhaustive et chaque surface (ou GSF) est associée à une fonction technique? ', 'C14.2', 'C14', '1'),
(134, 'La spécification des fonctions techniques est exacte et justifiée. ', 'C14.2', 'C14', '1'),
(135, 'Le cartouche est renseigné (tolérances générales, matériaux, indices de révisions, repérage, ...)', 'C14.2', 'C14', '1'),
(136, 'Les contraintes techniques, économiques et environnementales de l\'entreprise sont prises en compte.', 'C1.1', 'C1', '2'),
(137, 'Tous les éléments essentiels sont répertoriés et ajoutés à l\'archive de l\'entreprise.', 'C1.2', 'C1', '2'),
(138, 'La traçabilité respecte les standard de l\'entreprise et du donneur d\'ordre.', 'C1.2', 'C1', '2'),
(139, 'Les procédures d\'utilisation du système de gestion de données sont respectées.', 'C1.3', 'C1', '2'),
(140, 'Les sources d\'information sont identifiées et vérifiées.', 'C1.4', 'C1', '2'),
(141, 'Les évolutions techniques de son champ d\'activité sont identifiées et capitalisées.', 'C1.4', 'C1', '2'),
(142, 'L\'information recherchée est réordonnée.', 'C2.1', 'C2', '2'),
(143, 'La démarche pour l\'obtention de l\'information est pertinente.', 'C2.1', 'C2', '2'),
(144, 'La démarche et les critères de choix pour l\'obtention de l\'information sont efficients.', 'C2.2', 'C2', '2'),
(145, 'La synthèse proposée résume les points importants.', 'C2.3', 'C2', '2'),
(146, 'L\'objectif, le public visé, le message sont clairement identifiés.', 'C3.1', 'C3', '2'),
(147, 'Les outils de communication choisis sont adaptés au message et aux interlocuteurs et respectent les standard de communication de l\'entreprise.', 'C3.1', 'C3', '2'),
(148, 'Le document technique est décodé de manière univoque.', 'C3.2', 'C3', '2'),
(149, 'Le compte-rendu écrit est lisible et concis.', 'C3.2', 'C3', '2'),
(150, 'L\'expression orale est claire.', 'C3.3', 'C3', '2'),
(151, 'Les messages sont concis et sans ambiguïté.', 'C3.3', 'C3', '2'),
(152, 'Le vocabulaire est pertinent et précis.', 'C3.3', 'C3', '2'),
(153, 'Le vocabulaire professionnel est pertinent et précis.', 'C3.4', 'C3', '2'),
(154, 'Les échanges techniques avec les interlocuteurs sont compréhensibles.', 'C3.4', 'C3', '2'),
(155, 'Le rôle à tenir au sein du groupe est correctement identifié.', 'C4.1', 'C4', '2'),
(156, 'La définition de son domaine d\'intervention est comprise.', 'C4.1', 'C4', '2'),
(157, 'Les solutions techniques et économiques proposées sont justifiées.', 'C4.2', 'C4', '2'),
(158, 'Les moyens de communication retenus sont maîtrisés et pertinents.', 'C4.2', 'C4', '2'),
(159, 'L\'implication dans le groupe projet est effective.', 'C4.3', 'C4', '2'),
(160, 'Les arguments des autres membres du groupe sont pris en compte.', 'C4.3', 'C4', '2'),
(161, 'Les postures d\'écoute et de discussion adoptées permettent les échanges.', 'C4.3', 'C4', '2'),
(162, 'Le cahier des charges est respecté.', 'C4.4', 'C4', '2'),
(163, 'Les jalons du projet sont identifiés et respectés.', 'C4.4', 'C4', '2'),
(164, 'Les consignes du chef de projet sont respectées.', 'C4.4', 'C4', '2'),
(165, 'Le besoin est correctement identifié.', 'C5.1', 'C5', '2'),
(166, 'Les fonctions d\'usage sont répertoriées.', 'C5.1', 'C5', '2'),
(167, 'Les exigences sont correctement explicitées et pondérées.', 'C5.1', 'C5', '2'),
(168, 'Les contraintes technico-économiques sont identifiées.', 'C5.2', 'C5', '2'),
(169, 'Les contraintes technico-économiques sont hiérarchisées au regard de l\'expression du besoin.', 'C5.2', 'C5', '2'),
(170, 'La frontière de l\'étude est correctement définie.', 'C5.3', 'C5', '2'),
(171, 'Les fonctions de service sont identifiées et caractérisées.', 'C5.3', 'C5', '2'),
(172, 'Les fonctions de service sont classées au regard de la hiérarchisation des contraintes technico-économiques.', 'C5.3', 'C5', '2'),
(173, 'Le décodage de la morphologie est correctement réalisé et permet d\'établir des relations technico-économiques cohérentes avec des procédés de réalisation ou des familles de procédés de réalisation.', 'C6.1', 'C6', '2'),
(174, 'Le décodage des exigences géométriques et dimensionnelles, microgéométriques est correctement réalisé et permet d\'établir des relations technico-économiques cohérentes avec des procédés ou des familles de procédés.', 'C6.1', 'C6', '2'),
(175, 'Le décodage des exigences mécaniques ou celles liées aux matériaux est correctement réalisé et permet d\'établir des relations technico-économiques cohérentes avec des procédés ou des familles de procédés ou des traitements structuraux.', 'C6.1', 'C6', '2'),
(176, 'L\'identification de la relation des exigences de définition avec les fonctions du produit ainsi qu\'avec les éléments constitutifs de ce produit sont exactes.', 'C6.2', 'C6', '2'),
(177, 'L\'identification des difficultés de réalisation et/ou de contrôle est exhaustive et justifiée.', 'C6.3', 'C6', '2'),
(178, 'Les comportements mécaniques des solutions envisagées sont validés.', 'C7.1', 'C7', '2'),
(179, 'Les propositions de solutions sont compatibles avec les procédés retenus.', 'C7.1', 'C7', '2'),
(180, 'Les propositions de solutions constructives préservent les fonctionnalités du produit.', 'C7.1', 'C7', '2'),
(181, 'La solution est valide d\'un point de vue économique et/ou environnemental.', 'C7.1', 'C7', '2'),
(182, 'Les formes additionnelles optimisent le processus d\'un point de vue technique et économique.', 'C7.2', 'C7', '2'),
(183, 'Les spécifications sur les matériaux optimisent le processus d\'un point de vue technique et économique.', 'C7.2', 'C7', '2'),
(184, 'Les modifications n\'altèrent pas les fonctions du produit.', 'C7.2', 'C7', '2'),
(185, 'Le choix du scénario de simulation est pertinent.', 'C7.3', 'C7', '2'),
(186, 'Les paramètres d\'influence sont identifiés et correctement quantifiés.', 'C7.3', 'C7', '2'),
(187, 'L\'interprétation des résultats de simulation conduit à des propositions pertinentes.', 'C7.3', 'C7', '2'),
(188, 'L\'argumentation technico-économique et environnementale est pertinente.', 'C7.4', 'C7', '2'),
(189, 'Les évolutions de la maquette numérique tiennent compte des contraintes et des recommandations issues du travail collaboratif.', 'C7.5', 'C7', '2'),
(190, 'La maquette numérique est exploitable directement d\'un point de vue réalisation.', 'C7.5', 'C7', '2'),
(191, 'Les propositions sont pertinentes au regard des contraintes technico-économiques.', 'C8.1', 'C8', '2'),
(192, 'La justification est faite à partir de critères pertinents.', 'C8.1', 'C8', '2'),
(193, 'La hiérarchisation est pertinente.', 'C8.2', 'C8', '2'),
(194, 'Le choix du(des) couple(s) produit/procédé est compatible au regard des contraintes de production.', 'C8.2', 'C8', '2'),
(195, 'La caractérisation des performances des moyens de réalisation est correcte.', 'C8.3', 'C8', '2'),
(196, 'La liste des exigences est exhaustive.', 'C8.4', 'C8', '2'),
(197, 'Les exigences techniques sont correctement décrites.', 'C8.4', 'C8', '2'),
(198, 'Les données critiques sont déterminées.', 'C8.5', 'C8', '2'),
(199, 'Les éléments déterminés pour l\'établissement de la réponse à l\'affaire sont justes.', 'C8.5', 'C8', '2'),
(200, 'L\'arbre d\'assemblage est organisé en sous-ensemble(s) fonctionnel(s) et/ou structurel(s) comprenant les solutions constructives à concevoir.', 'C9.1', 'C9', '2'),
(201, 'L\'arbre d\'assemblage est organisé en cohérence avec la méthodologie de conception utilisée.', 'C9.1', 'C9', '2'),
(202, 'Le mode de création est adapté et évolutif selon le niveau de définition de la maquette numérique (volume, surface, filaire).', 'C9.1', 'C9', '2'),
(203, 'Le positionnement des pièces est contraint dans le respect des mobilités relatives.', 'C9.1', 'C9', '2'),
(204, 'La mise en contrainte à chaque niveau de l\'assemblage est univoque et minimale.', 'C9.1', 'C9', '2'),
(205, 'La modification des paramètres conserve la robustesse de la maquette numérique et sa portabilité attendue.', 'C9.1', 'C9', '2'),
(206, 'Les fonctions de l\'ensemble mécanique sont assurées par les solutions constructives adoptées.', 'C9.1', 'C9', '2'),
(207, 'L\'ensemble mécanique permet de respecter les exigences de réalisation ainsi que les contraintes normatives et économiques.', 'C9.1', 'C9', '2'),
(208, 'Dans le cas d\'une collaboration, l\'élaboration de la maquette numérique de conception détaillée n\'altère pas l\'organisation de l\'arbre d\'assemblage.', 'C9.1', 'C9', '2'),
(209, 'Les structures fonctionnelles de l\'ensemble intègrent les contraintes du procédé de réalisation.', 'C9.2', 'C9', '2'),
(210, 'Les fonctions techniques de l\'ensemble sont assurées.', 'C9.2', 'C9', '2'),
(211, 'Les solutions constructives adoptées sont optimisées d\'un point de vue technique et économique quant à la réalisation.', 'C9.2', 'C9', '2'),
(212, 'Les solutions constructives adoptées sont validées par simulation d\'un point de vue des comportements mécaniques.', 'C9.2', 'C9', '2'),
(213, 'L\'argumentation technico-économique et environnementale est pertinente.', 'C9.2', 'C9', '2'),
(214, 'Le choix du scénario de simulation est pertinent.', 'C9.3', 'C9', '2'),
(215, 'Les paramètres d\'influence sont identifiés et correctement quantifiés.', 'C9.3', 'C9', '2'),
(216, 'L\'interprétation des résultats de simulation conduit à des propositions pertinentes.', 'C9.3', 'C9', '2'),
(217, 'Les représentations graphiques dérivées sont complétées et légendées par des informations techniques associées en adéquation avec le point de vue du destinataire.', 'C9.4', 'C9', '2'),
(218, 'Les documents sont conformes aux attentes de l\'utilisateur.', 'C9.4', 'C9', '2'),
(219, 'La liste des spécifications fonctionnelles et/ou d\'aptitude à l\'emploi est exhaustive et l\'expression des tolérances respecte les normes en vigueur.', 'C9.5', 'C9', '2'),
(220, 'La quantification des tolérances est cohérente.', 'C9.5', 'C9', '2'),
(221, 'Le choix des matériaux et traitements des éléments constitutifs de l\'ensemble est pertinent.', 'C9.5', 'C9', '2'),
(222, 'L\'extraction de la définition numérique des pièces constitutives à réaliser permet leur exploitation, sans altération, dans un format supportable par le logiciel de fabrication assistée par ordinateur utilisé.', 'C10.1', 'C10', '2'),
(223, 'Le décodage de la morphologie et du matériau des pièces constitutives du produit permet d\'appréhender les contraintes de réalisation (usinabilité, vibration, déformation, contraintes de génération additive ?).', 'C10.2', 'C10', '2'),
(224, 'Le décodage des spécifications générales, géométriques, microgéométriques et dimensionnelles est correct et permet d\'identifier les spécifications critiques.', 'C10.2', 'C10', '2'),
(225, 'Les groupements d\'entités sont pertinents.', 'C10.3', 'C10', '2'),
(226, 'Le choix des procédés de réalisation est correct.', 'C10.3', 'C10', '2'),
(227, 'L\'enchaînement des procédés est pertinent.', 'C10.3', 'C10', '2'),
(228, 'Les indicateurs de performance retenus sont pertinents.', 'C10.4', 'C10', '2'),
(229, 'L\'estimation est correcte.', 'C10.4', 'C10', '2'),
(230, 'Les stratégies d\'enlèvement et/ou d\'ajout de matière sont pertinentes au regard des données et des contraintes.', 'C10.5', 'C10', '2'),
(231, 'Les stratégies d\'assemblage sont pertinentes au regard des données et des contraintes.', 'C10.5', 'C10', '2'),
(232, 'Les paramètres de génération des entités (volumes, surfaces ?) sont compatibles avec les procédés choisis et les contraintes du dossier de définition.', 'C10.6', 'C10', '2'),
(233, 'Les paramètres d\'assemblage sont compatibles avec les procédés choisis et les contraintes du dossier de définition.', 'C10.6', 'C10', '2'),
(234, 'Les spécifications de réalisation permettent de garantir le respect des spécifications fonctionnelles.', 'C10.7', 'C10', '2'),
(235, 'La simulation permet de valider ou non les choix technologiques et les paramètres de réalisation.', 'C10.8', 'C10', '2'),
(236, 'Le choix du type de contrôle est correct.', 'C10.9', 'C10', '2'),
(237, 'Les moyens et les méthodes de contrôle sont adaptés.', 'C10.9', 'C10', '2'),
(238, 'L\'identification des étapes nécessitant des essais est complète.', 'C11.1', 'C11', '2'),
(239, 'La liste des paramètres d\'influence identifiés est pertinente.', 'C11.2', 'C11', '2'),
(240, 'Les paramètres d\'influence sont hiérarchisés.', 'C11.2', 'C11', '2'),
(241, 'Le protocole d\'essai est correctement défini.', 'C11.3', 'C11', '2'),
(242, 'Les hypothèses de simulation choisies sont adaptées au cas étudié.', 'C11.4', 'C11', '2'),
(243, 'La configuration des outils de simulation est opérationnelle.', 'C11.4', 'C11', '2'),
(244, 'La configuration respecte les règles de protection des risques liées à la sécurité des personnes, des biens et de l\'environnement.', 'C11.5', 'C11', '2'),
(245, 'Les conditions expérimentales choisies sont adaptées au cas étudié.', 'C11.5', 'C11', '2'),
(246, 'La configuration des moyens est opérationnelle.', 'C11.5', 'C11', '2'),
(247, 'La configuration respecte les règles de protection des risques liées à la sécurité des personnes, des biens et de l\'environnement.', 'C11.6', 'C11', '2'),
(248, 'La configuration est conforme aux conditions définies dans le processus.', 'C11.6', 'C11', '2'),
(249, 'La configuration des moyens est opérationnelle.', 'C11.6', 'C11', '2'),
(250, 'Les essais sont mis en oeuvre de façon à garantir la validité et l\'exploitation des résultats.', 'C11.7', 'C11', '2'),
(251, 'La mise en oeuvre respecte les règles de protection des risques liées à la sécurité des personnes, des biens et de l\'environnement.', 'C11.8', 'C11', '2'),
(252, 'Le protocole d\'expérimentation est respecté.', 'C11.8', 'C11', '2'),
(253, 'L\'exploitation des résultats des essais permet de conclure quant à la validité de tout ou partie du processus.', 'C11.9', 'C11', '2'),
(254, 'Des préconisations d\'optimisation éventuelle du processus sont proposées.', 'C11.9', 'C11', '2'),
(255, 'La liste des tâches identifiées est complète.', 'C12.1', 'C12', '2'),
(256, 'L\'enchaînement des tâches est pertinent.', 'C12.1', 'C12', '2'),
(257, 'Les flux physiques de matière et des composants sont clairement identifiés.', 'C12.2', 'C12', '2'),
(258, 'Les flux d\'informations sont clairement identifiés.', 'C12.2', 'C12', '2'),
(259, 'L\'ensemble des flux est optimisé.', 'C12.2', 'C12', '2'),
(260, 'La définition ou le choix des moyens environnants est en adéquation avec les contraintes.', 'C12.3', 'C12', '2'),
(261, 'La définition ou le choix des moyens environnants respecte les normes et réglementations.', 'C12.3', 'C12', '2'),
(262, 'L\'identification des améliorations possibles est pertinente.', 'C13.1', 'C13', '2'),
(263, 'L\'identification des facteurs influents est pertinente.', 'C13.2', 'C13', '2'),
(264, 'La hiérarchisation des facteurs influents est judicieuse.', 'C13.2', 'C13', '2'),
(265, 'La mise en oeuvre de la méthode d\'optimisation est correcte.', 'C13.3', 'C13', '2'),
(266, 'Les améliorations proposées sont pertinentes.', 'C13.4', 'C13', '2'),
(267, 'Les innovations technologiques sont explorées.', 'C13.4', 'C13', '2'),
(268, 'L\'expérience de l\'entreprise est prise en compte.', 'C13.4', 'C13', '2'),
(269, 'Le chiffrage prévisionnel est correct.', 'C13.5', 'C13', '2'),
(270, 'Les améliorations sont argumentées d\'un point de vue technico-économique et environnemental.', 'C13.5', 'C13', '2'),
(271, 'Les ressources matérielles mobilisables sont identifiées.', 'C14.1', 'C14', '2'),
(272, 'Les qualifications professionnelles des ressources humaines mobilisables sont identifiées.', 'C14.1', 'C14', '2'),
(273, 'Les ressources matérielles et humaines sont correctement quantifiées.', 'C14.1', 'C14', '2'),
(274, 'Le choix des indicateurs est pertinent.', 'C14.2', 'C14', '2'),
(275, 'L\'estimation de la capacité à produire de l\'unité de réalisation est réaliste.', 'C14.2', 'C14', '2'),
(276, 'Les propositions de modification du planning sont pertinentes.', 'C14.3', 'C14', '2'),
(277, 'Les impossibilités d\'intégration sont signalées à la hiérarchie.', 'C14.3', 'C14', '2'),
(278, 'L\'ensemble des moyens nécessaires est opérationnel.', 'C15.1', 'C15', '2'),
(279, 'La maintenance de premier niveau des moyens matériels est réalisée.', 'C15.1', 'C15', '2'),
(280, 'La matière d\'oeuvre est disponible.', 'C15.1', 'C15', '2'),
(281, 'Le délai de lancement imposé par le planning est respecté.', 'C15.2', 'C15', '2'),
(282, 'La conformité de la réalisation est évaluée pour validation du lancement.', 'C15.2', 'C15', '2'),
(283, 'Les protocoles de contrôle sont respectés.', 'C15.3', 'C15', '2'),
(284, 'Les documents de suivi sont exploités et archivés.', 'C15.3', 'C15', '2'),
(285, 'Les non-conformités sont identifiées.', 'C15.4', 'C15', '2'),
(286, 'La remédiation proposée est appropriée.', 'C15.4', 'C15', '2'),
(287, 'La mise en oeuvre des actions correctives est garantie.', 'C15.4', 'C15', '2'),
(288, 'L\'identification des facteurs influents sur les aléas de réalisation est pertinente et capitalisée.', 'C15.5', 'C15', '2'),
(289, 'Les documents qualité relatifs à son secteur de production sont identifiés.', 'C16.1', 'C16', '2'),
(290, 'La vérification de l\'application des procédures qualité est effective.', 'C16.1', 'C16', '2'),
(291, 'Les documents de traçabilité de l\'entreprise sont exploités dans le respect du plan qualité.', 'C16.2', 'C16', '2'),
(292, 'Les consignes et les procédures de déroulement des audits internes sont respectées.', 'C16.3', 'C16', '2'),
(293, 'Les actions correctives sont mises en oeuvre.', 'C16.4', 'C16', '2'),
(294, 'Les actions proposées contribuent à l\'amélioration continue de la qualité de son secteur de production.', 'C16.5', 'C16', '2'),
(295, 'Les propositions découlant de l\'application d\'une démarche de résolution de  problèmes sont cohérentes.', 'C16.5', 'C16', '2'),
(296, 'Les risques pour la santé et la sécurité au travail de son secteur de production sont identifiés.', 'C16.6', 'C16', '2'),
(297, 'La gravité et la probabilité des risques de la situation de travail sont correctement évaluées.', 'C16.6', 'C16', '2'),
(298, 'Les solutions retenues sont en adéquation avec les impératifs de production, le système qualité et les conditions de travail.', 'C16.6', 'C16', '2'),
(299, 'Les mesures de prévention mises en ?uvre sont adaptées', 'C16.7', 'C16', '2'),
(300, 'La démarche ergonomique employée est adaptée.', 'C16.8', 'C16', '2'),
(301, 'L\'identification des procédures de santé et sécurité au travail aux postes de travail est pertinente.', 'C16.8', 'C16', '2'),
(302, 'L\'identification du type de contrôle est correcte.', 'Cb17.1', 'Cb17', '2'),
(303, 'La liste des spécifications critiques est complète.', 'Cb17.2', 'Cb17', '2'),
(304, 'Les spécifications sont correctement explicitées.', 'Cb17.2', 'Cb17', '2'),
(305, 'Les modes opératoires du protocole sont cohérents avec les spécifications à surveiller.', 'Cb17.3', 'Cb17', '2'),
(306, 'Les moyens prévus au protocole sont adaptés au contexte technico-économique.', 'Cb17.3', 'Cb17', '2'),
(307, 'La traçabilité des informations est assurée.', 'Cb17.3', 'Cb17', '2'),
(308, 'L\'identification des paramètres critiques est pertinente.', 'Cb18.1', 'Cb18', '2'),
(309, 'Les moyens de contrôle retenus sont capables de fournir des indications de performance de l\'unité de réalisation.', 'Cb18.2', 'Cb18', '2'),
(310, 'Les protocoles choisis sont corrects.', 'Cb18.2', 'Cb18', '2'),
(311, 'Les protocoles de mise en oeuvre du moyen et de la procédure de contrôle sont respectés.', 'Cb18.3', 'Cb18', '2'),
(312, 'Les écarts entre les résultats attendus et ceux observés sur la réalisation sont énumérés et quantifiés.', 'Cb18.4', 'Cb18', '2'),
(313, 'La détermination des causes possibles des écarts est pertinente.', 'Cb18.5', 'Cb18', '2'),
(314, 'La relation entre les causes d\'écart et leurs conséquences sur la réalisation est établie.', 'Cb18.5', 'Cb18', '2'),
(315, 'Des actions de remédiation sont proposées.', 'Cb18.6', 'Cb18', '2'),
(316, 'Les actions de remédiation sont pertinentes.', 'Cb18.6', 'Cb18', '2'),
(317, 'Le dossier de réalisation est complet, exploitable et conforme aux standard de l\'entreprise.', 'Cb18.7', 'Cb18', '2');

-- --------------------------------------------------------

--
-- Structure de la table `indicateurperformancelangue`
--

CREATE TABLE `indicateurperformancelangue` (
  `libelleLangue` varchar(25) DEFAULT NULL,
  `idIndicateurPerformance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `savoir`
--

CREATE TABLE `savoir` (
  `idSavoir` char(25) NOT NULL,
  `libelleSavoir` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `savoirdetaille`
--

CREATE TABLE `savoirdetaille` (
  `idSavoirDetaille` char(25) NOT NULL,
  `titreSavoirDetaille` varchar(500) DEFAULT NULL,
  `libelleSavoirDetaille` varchar(21024) DEFAULT NULL,
  `idCompetence` char(25) NOT NULL,
  `idFiliere` char(25) NOT NULL,
  `idSavoir` char(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `soussavoirdetaille`
--

CREATE TABLE `soussavoirdetaille` (
  `idSousSavoirDetaille` char(25) NOT NULL,
  `titreSousSavoirDetaille` varchar(255) DEFAULT NULL,
  `libelleSousSavoirDetaille` varchar(1024) DEFAULT NULL,
  `idSavoirDetaille` char(25) NOT NULL,
  `idCompetence` char(25) NOT NULL,
  `idFiliere` char(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `tache`
--

CREATE TABLE `tache` (
  `idTache` char(25) NOT NULL,
  `libelleTache` varchar(255) DEFAULT NULL,
  `idActivite` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `idUtilisateur` varchar(25) NOT NULL,
  `mdpUtilisateur` varchar(255) DEFAULT NULL,
  `Nom` varchar(32) DEFAULT NULL,
  `Prenom` varchar(32) DEFAULT NULL,
  `Droit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `mdpUtilisateur`, `Nom`, `Prenom`, `Droit`) VALUES
('admin', 'admin', 'Admin', 'Admin', 1),
('eleve', 'eleve', 'ELEVE', 'Eleve', 10),
('prof ', 'prof', 'PROFESSEUR', 'Prof', 5);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `activite`
--
ALTER TABLE `activite`
  ADD PRIMARY KEY (`idActivite`);

--
-- Index pour la table `anneeetude`
--
ALTER TABLE `anneeetude`
  ADD PRIMARY KEY (`idAnneeEtude`,`idFiliere`),
  ADD KEY `FK_AnneeEtude_idFiliere` (`idFiliere`);

--
-- Index pour la table `annee_scolaire`
--
ALTER TABLE `annee_scolaire`
  ADD PRIMARY KEY (`annee`);

--
-- Index pour la table `archiveannee`
--
ALTER TABLE `archiveannee`
  ADD PRIMARY KEY (`idUtilisateur`,`annee`,`idIndicePerformance`);

--
-- Index pour la table `avoir_note`
--
ALTER TABLE `avoir_note`
  ADD PRIMARY KEY (`idUtilisateur`,`annee`,`idIndicateurPerformance`);

--
-- Index pour la table `caracteristiquesssd`
--
ALTER TABLE `caracteristiquesssd`
  ADD PRIMARY KEY (`idCaracteristiquesSSD`);

--
-- Index pour la table `competence`
--
ALTER TABLE `competence`
  ADD PRIMARY KEY (`idCompetence`,`idFiliere`),
  ADD KEY `FK_Competence_idFiliere` (`idFiliere`);

--
-- Index pour la table `competencedetaillee`
--
ALTER TABLE `competencedetaillee`
  ADD PRIMARY KEY (`idCompetenceDetaillee`,`idCompetence`,`idFiliere`),
  ADD KEY `FK_CompetenceDetaillee_idCompetence` (`idCompetence`),
  ADD KEY `FK_CompetenceDetaillee_idFiliere` (`idFiliere`),
  ADD KEY `FK_CompetenceDetaillee_idDonnee` (`idDonnee`);

--
-- Index pour la table `contenir`
--
ALTER TABLE `contenir`
  ADD PRIMARY KEY (`idActivite`,`idCompetence`,`idFiliere`),
  ADD KEY `FK_Contenir_idCompetence` (`idCompetence`),
  ADD KEY `FK_Contenir_idFiliere` (`idFiliere`);

--
-- Index pour la table `donnee`
--
ALTER TABLE `donnee`
  ADD PRIMARY KEY (`idDonnee`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`idUtilisateur`);

--
-- Index pour la table `etudiantannee`
--
ALTER TABLE `etudiantannee`
  ADD PRIMARY KEY (`idUtilisateur`,`annee`),
  ADD KEY `FK_etudiantannee_annee` (`annee`),
  ADD KEY `FK_etudiantannee_idAnneeEtude` (`idAnneeEtude`),
  ADD KEY `FK_etudiantannee_idFiliere` (`idFiliere`);

--
-- Index pour la table `filiere`
--
ALTER TABLE `filiere`
  ADD PRIMARY KEY (`idFiliere`);

--
-- Index pour la table `indicateurperformance`
--
ALTER TABLE `indicateurperformance`
  ADD PRIMARY KEY (`idIndicateurPerformance`),
  ADD KEY `FK_IndicateurPerfomance_idCompetenceDetaillee` (`idCompetenceDetaillee`,`idFiliere`,`idCompetence`) USING BTREE;

--
-- Index pour la table `indicateurperformancelangue`
--
ALTER TABLE `indicateurperformancelangue`
  ADD PRIMARY KEY (`idIndicateurPerformance`);

--
-- Index pour la table `savoir`
--
ALTER TABLE `savoir`
  ADD PRIMARY KEY (`idSavoir`);

--
-- Index pour la table `savoirdetaille`
--
ALTER TABLE `savoirdetaille`
  ADD PRIMARY KEY (`idSavoirDetaille`,`idCompetence`,`idFiliere`);

--
-- Index pour la table `soussavoirdetaille`
--
ALTER TABLE `soussavoirdetaille`
  ADD PRIMARY KEY (`idSousSavoirDetaille`,`idSavoirDetaille`,`idCompetence`,`idFiliere`);

--
-- Index pour la table `tache`
--
ALTER TABLE `tache`
  ADD PRIMARY KEY (`idTache`),
  ADD KEY `FK_Tache_idActivite` (`idActivite`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`idUtilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `activite`
--
ALTER TABLE `activite`
  MODIFY `idActivite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `caracteristiquesssd`
--
ALTER TABLE `caracteristiquesssd`
  MODIFY `idCaracteristiquesSSD` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `donnee`
--
ALTER TABLE `donnee`
  MODIFY `idDonnee` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT pour la table `indicateurperformance`
--
ALTER TABLE `indicateurperformance`
  MODIFY `idIndicateurPerformance` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=318;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `anneeetude`
--
ALTER TABLE `anneeetude`
  ADD CONSTRAINT `FK_AnneeEtude_idFiliere` FOREIGN KEY (`idFiliere`) REFERENCES `filiere` (`idFiliere`);

--
-- Contraintes pour la table `competence`
--
ALTER TABLE `competence`
  ADD CONSTRAINT `FK_Competence_idFiliere` FOREIGN KEY (`idFiliere`) REFERENCES `filiere` (`idFiliere`);

--
-- Contraintes pour la table `competencedetaillee`
--
ALTER TABLE `competencedetaillee`
  ADD CONSTRAINT `FK_CompetenceDetaillee_idCompetence` FOREIGN KEY (`idCompetence`) REFERENCES `competence` (`idCompetence`),
  ADD CONSTRAINT `FK_CompetenceDetaillee_idDonnee` FOREIGN KEY (`idDonnee`) REFERENCES `donnee` (`idDonnee`),
  ADD CONSTRAINT `FK_CompetenceDetaillee_idFiliere` FOREIGN KEY (`idFiliere`) REFERENCES `filiere` (`idFiliere`);

--
-- Contraintes pour la table `contenir`
--
ALTER TABLE `contenir`
  ADD CONSTRAINT `FK_Contenir_idActivite` FOREIGN KEY (`idActivite`) REFERENCES `activite` (`idActivite`),
  ADD CONSTRAINT `FK_Contenir_idCompetence` FOREIGN KEY (`idCompetence`) REFERENCES `competence` (`idCompetence`),
  ADD CONSTRAINT `FK_Contenir_idFiliere` FOREIGN KEY (`idFiliere`) REFERENCES `filiere` (`idFiliere`);

--
-- Contraintes pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `FK_Etudiant_idUtilisateur` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`);

--
-- Contraintes pour la table `etudiantannee`
--
ALTER TABLE `etudiantannee`
  ADD CONSTRAINT `FK_etudiantannee_annee` FOREIGN KEY (`annee`) REFERENCES `annee_scolaire` (`annee`),
  ADD CONSTRAINT `FK_etudiantannee_idAnneeEtude` FOREIGN KEY (`idAnneeEtude`) REFERENCES `anneeetude` (`idAnneeEtude`),
  ADD CONSTRAINT `FK_etudiantannee_idFiliere` FOREIGN KEY (`idFiliere`) REFERENCES `filiere` (`idFiliere`),
  ADD CONSTRAINT `FK_etudiantannee_idUtilisateur` FOREIGN KEY (`idUtilisateur`) REFERENCES `etudiant` (`idUtilisateur`);

--
-- Contraintes pour la table `indicateurperformancelangue`
--
ALTER TABLE `indicateurperformancelangue`
  ADD CONSTRAINT `FK_IndicateurPerfomanceLangue_idIndicateurPerfomance` FOREIGN KEY (`idIndicateurPerformance`) REFERENCES `indicateurperformance` (`idIndicateurPerformance`);

--
-- Contraintes pour la table `tache`
--
ALTER TABLE `tache`
  ADD CONSTRAINT `FK_Tache_idActivite` FOREIGN KEY (`idActivite`) REFERENCES `activite` (`idActivite`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
