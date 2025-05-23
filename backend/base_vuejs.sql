-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 23 mai 2025 à 12:36
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `base_vuejs`
--

-- --------------------------------------------------------

--
-- Structure de la table `visiteur`
--

DROP TABLE IF EXISTS `visiteur`;
CREATE TABLE IF NOT EXISTS `visiteur` (
  `num_visiteur` int NOT NULL,
  `nom` varchar(50) NOT NULL,
  `nb_jours` int NOT NULL,
  `tarif_journalier` int NOT NULL,
  PRIMARY KEY (`num_visiteur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `visiteur`
--

INSERT INTO `visiteur` (`num_visiteur`, `nom`, `nb_jours`, `tarif_journalier`) VALUES
(200, 'NOURAH', 20, 10000),
(2569, 'PIERRE', 15, 51200),
(342183853, 'NOURAH', 95, 25000),
(328714047, 'NARGIE', 36, 17000),
(339313301, 'ROYD', 115, 115000),
(328814449, 'SPRICE', 16, 265000),
(35431644, 'AUDI', 11, 2000);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
