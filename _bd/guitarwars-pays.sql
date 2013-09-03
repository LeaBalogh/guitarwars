-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mar 03 Septembre 2013 à 13:04
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `gw1`
--

-- --------------------------------------------------------

--
-- Structure de la table `score`
--

CREATE TABLE IF NOT EXISTS `score` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nom` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `screenshot` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `valider` tinyint(1) NOT NULL,
  `pays` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `nom` (`nom`),
  KEY `pays` (`pays`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Contenu de la table `score`
--

INSERT INTO `score` (`id`, `date`, `nom`, `score`, `screenshot`, `valider`, `pays`) VALUES
(1, '2012-05-22 10:37:34', 'Jean Némarre', 127650, NULL, 0, 1),
(2, '2012-05-22 17:27:54', 'Laure Dinateur', 98430, NULL, 0, 2),
(6, '2012-05-23 10:09:50', 'Ella Danloss', 64930, NULL, 0, 2),
(8, '2012-05-16 10:07:28', 'BIFFJ', 314340, 'biffsscore.gif', 1, 5),
(10, '2012-05-16 10:09:16', 'Jacob Scorcherson', 389740, 'jacobsscore.gif', 1, 6);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
