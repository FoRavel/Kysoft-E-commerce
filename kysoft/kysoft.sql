-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 30 Mars 2017 à 15:16
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `kysoft`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `NO_CATEGORIE` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_CATEGORIE` varchar(50) NOT NULL,
  PRIMARY KEY (`NO_CATEGORIE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `marque`
--

CREATE TABLE IF NOT EXISTS `marque` (
  `NO_MARQUE` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_MARQUE` varchar(50) NOT NULL,
  PRIMARY KEY (`NO_MARQUE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE IF NOT EXISTS `produit` (
  `REF_PRODUIT` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_PRODUIT` varchar(50) NOT NULL,
  `PRIX_UNITAIRE_HT` int(11) NOT NULL,
  `DESCRIPTION` text NOT NULL,
  `NO_MARQUE` int(11) NOT NULL,
  PRIMARY KEY (`REF_PRODUIT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `sous_categorie`
--

CREATE TABLE IF NOT EXISTS `sous_categorie` (
  `NO_SOUS_CATEGORIE` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_SOUS_CATEGORIE` varchar(50) NOT NULL,
  `NO_CATEGORIE` int(11) NOT NULL,
  PRIMARY KEY (`NO_SOUS_CATEGORIE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `LOGIN_UTILISATEUR` varchar(50) NOT NULL,
  `MOT_DE_PASSE` varchar(50) NOT NULL,
  PRIMARY KEY (`LOGIN_UTILISATEUR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
