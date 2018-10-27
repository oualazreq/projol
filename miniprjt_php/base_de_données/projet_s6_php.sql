-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 15 Juin 2015 à 16:12
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `projet_s6_php`
--

-- --------------------------------------------------------

--
-- Structure de la table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `id_ville` varchar(10) NOT NULL,
  `nom_ville` text NOT NULL,
  `pays` text NOT NULL,
  PRIMARY KEY (`id_ville`),
  FULLTEXT KEY `pays` (`pays`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `cities`
--

INSERT INTO `cities` (`id_ville`, `nom_ville`, `pays`) VALUES
('1', 'Casablanca', 'Morocco'),
('10', 'Oujda', 'Morocco'),
('2', 'Paris', 'France'),
('4', 'Cairo', 'Egypt'),
('6', 'Brussels', 'Belgium'),
('8', 'Tunis', 'Tunisia'),
('9', 'Istanbul', 'Turkey');

-- --------------------------------------------------------

--
-- Structure de la table `flight`
--

CREATE TABLE IF NOT EXISTS `flight` (
  `num_vol` int(10) NOT NULL,
  `ville_dep` text NOT NULL,
  `ville_arr` text NOT NULL,
  `heure_dep` time(1) NOT NULL,
  `heure_arr` time(1) NOT NULL,
  `airline` text NOT NULL,
  PRIMARY KEY (`num_vol`),
  KEY `ville_dep` (`ville_dep`(10)),
  KEY `ville_arr` (`ville_arr`(10))
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `flight`
--

INSERT INTO `flight` (`num_vol`, `ville_dep`, `ville_arr`, `heure_dep`, `heure_arr`, `airline`) VALUES
(1, 'Casablanca', 'Paris', '00:16:00.0', '00:19:00.0', 'AIR ARABIA'),
(2, 'Casablanca', 'Oujda', '00:07:00.0', '00:08:00.0', 'ROYAL AIR MAROC'),
(3, 'Oujda', 'Casablanca', '00:23:00.0', '00:23:59.0', 'ROYAL AIR MAROC'),
(4, 'Oujda', 'Paris', '00:16:00.0', '00:19:00.0', 'TRANSAVIA'),
(5, 'Oujda', 'Brussels', '00:19:00.0', '00:21:00.0', 'RYANAIR'),
(6, 'Casablanca', 'Cairo', '00:08:00.0', '00:11:00.0', 'EGYPTAIR'),
(7, 'Casablanca', 'Tunis', '00:12:00.0', '00:13:00.0', 'TUNISAIR'),
(8, 'Cairo', 'Casablanca', '00:22:00.0', '00:23:00.0', 'EGYPTAIR'),
(9, 'Paris', 'Casablanca', '00:06:00.0', '00:07:00.0', 'AIR ARABIA'),
(10, 'Tunis', 'Casablanca', '00:14:00.0', '00:15:00.0', 'TUNISAIR'),
(11, 'Istanbul', 'Casablanca', '00:10:00.0', '00:10:00.0', 'TURKISH AIRLINES'),
(12, 'Casablanca', 'Istanbul', '00:22:00.0', '00:04:00.0', 'TURKISH AIRLINES'),
(13, 'Paris', 'Oujda', '00:18:00.0', '00:19:00.0', 'TRANSAVIA'),
(14, 'Brussels', 'Oujda', '00:11:00.0', '00:13:00.0', 'RYANAIR'),
(15, 'Oujda', 'Casablanca', '00:14:00.0', '00:15:00.0', 'ATLAS BLUE');

-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

CREATE TABLE IF NOT EXISTS `pays` (
  `id_pays` varchar(4) NOT NULL,
  `nom_pays` text NOT NULL,
  PRIMARY KEY (`id_pays`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `pays`
--

INSERT INTO `pays` (`id_pays`, `nom_pays`) VALUES
('1', 'Morocco'),
('2', 'France'),
('3', 'Egypt'),
('4', 'Turkey'),
('5', 'Thailande'),
('6', 'Spain'),
('7', 'China'),
('8', 'India');

-- --------------------------------------------------------

--
-- Structure de la table `tarifs`
--

CREATE TABLE IF NOT EXISTS `tarifs` (
  `tarifeco_adulte` int(11) NOT NULL,
  `tarifeco_enfant` int(11) NOT NULL,
  `num_vol` int(11) NOT NULL,
  `id_tarif` int(11) NOT NULL,
  `tarifb_adulte` int(10) NOT NULL,
  `tarifb_enfant` int(11) NOT NULL,
  PRIMARY KEY (`id_tarif`),
  UNIQUE KEY `id_vol_2` (`num_vol`),
  KEY `id_vol` (`num_vol`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `tarifs`
--

INSERT INTO `tarifs` (`tarifeco_adulte`, `tarifeco_enfant`, `num_vol`, `id_tarif`, `tarifb_adulte`, `tarifb_enfant`) VALUES
(1000, 500, 1, 1, 1800, 900),
(1200, 600, 2, 2, 1900, 950),
(1400, 700, 3, 3, 2100, 1050),
(1600, 800, 4, 4, 2300, 1150),
(3000, 1500, 5, 5, 4700, 2350),
(4200, 1600, 6, 6, 5700, 3850),
(4400, 1600, 7, 7, 6700, 3350),
(5000, 2500, 8, 8, 7000, 3500),
(7400, 3700, 9, 9, 9000, 4500),
(2750, 940, 10, 10, 10000, 5230),
(3890, 1457, 11, 11, 6575, 4560),
(3564, 1745, 12, 12, 8623, 4789),
(779, 455, 13, 13, 10025, 5233),
(3756, 1902, 14, 14, 8472, 3999),
(1395, 475, 15, 15, 2465, 1857);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(10) NOT NULL,
  `confirm` varchar(10) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  PRIMARY KEY (`email`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`nom`, `prenom`, `email`, `password`, `confirm`, `telephone`, `adresse`) VALUES
('farah', 'ali', 'farah@gmail.com', 'azerty', 'azerty', '01258933', '6 rue a  oujda'),
('ff', 'fatima', 'fatimaff@yahoo.fr', 'querty', 'querty', '04897532', '587 rue R casablanca'),
('mm', 'samira', 'samiramm@gmail.com', 'az', 'az', '058966996', '8 rue abgr oujda'),
('test', 'test', 'test', 'test', 'test', '', ''),
('wafaa', 'sara', 'wafaasara@caramail.com', 'pass1', 'pass1', '01111111111111', '1 rue a oujda');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `tarifs`
--
ALTER TABLE `tarifs`
  ADD CONSTRAINT `fk_tarifs_numvol` FOREIGN KEY (`num_vol`) REFERENCES `flight` (`num_vol`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
