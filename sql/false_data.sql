-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Dim 14 Juin 2015 à 01:36
-- Version du serveur :  5.6.24-0ubuntu2
-- Version de PHP :  5.6.4-4ubuntu6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `shwet`
--

-- --------------------------------------------------------

--
-- Structure de la table `docs`
--

CREATE TABLE IF NOT EXISTS `docs` (
  `id` char(10) COLLATE utf8_bin NOT NULL,
  `uv` char(4) COLLATE utf8_bin NOT NULL,
  `type` char(2) COLLATE utf8_bin NOT NULL,
  `nom` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `docs`
--

INSERT INTO `docs` (`id`, `uv`, `type`, `nom`) VALUES
('AZERTHJKLM', 'LO21', 'PR', 'Un projet, m''voilà'),
('AZERTYUIOP', 'NF17', 'PR', 'Projet de NF17'),
('QSDFGHJKLM', 'LO21', 'TD', 'Un TD de LO21, ça sert à rien'),
('QSDFGYUIOP', 'SR02', 'TP', 'Un tp avec des sémaphore et tout... (ils ont des TPs en SR02?)');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `docs`
--
ALTER TABLE `docs`
 ADD PRIMARY KEY (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
