-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 10 oct. 2020 à 20:18
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `todolist`
--

-- --------------------------------------------------------

--
-- Structure de la table `list`
--

DROP TABLE IF EXISTS `list`;
CREATE TABLE IF NOT EXISTS `list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `id_guest` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `list`
--

INSERT INTO `list` (`id`, `id_utilisateur`, `nom`, `id_guest`) VALUES
(3, 1, 'test7', 1),
(5, 1, 'test78', 1),
(7, 1, 'courses', 1),
(8, 1, 'courses', 5),
(9, 5, 'test7', 5),
(10, 5, 'test7', 1);

-- --------------------------------------------------------

--
-- Structure de la table `todo`
--

DROP TABLE IF EXISTS `todo`;
CREATE TABLE IF NOT EXISTS `todo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `statut` enum('oui','non') NOT NULL,
  `create_at` datetime NOT NULL,
  `finished_at` datetime DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `assign_to` varchar(255) DEFAULT NULL,
  `idlist` int(11) NOT NULL,
  `id_guest` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_list` (`idlist`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `todo`
--

INSERT INTO `todo` (`id`, `id_utilisateur`, `nom`, `statut`, `create_at`, `finished_at`, `description`, `assign_to`, `idlist`, `id_guest`) VALUES
(1, 1, 'tache test', 'non', '2020-10-10 21:38:00', NULL, 'ceci est une description', 'coco', 1, 1),
(2, 1, 'tache test', 'oui', '2020-10-10 21:38:00', '2020-10-10 21:47:00', 'ceci est une description', 'coco', 2, 7),
(3, 1, 'pain', 'non', '2020-10-10 22:00:00', NULL, 'pain de campagne', 'user', 7, 1),
(4, 1, 'pain', 'oui', '2020-10-10 22:00:00', '2020-10-10 22:11:00', 'pain de campagne', 'user', 8, 5),
(5, 5, 'Faire CSS', 'non', '2020-10-10 22:12:00', NULL, 'ceci est une description', 'coco', 7, 1),
(7, 5, 'tache test', 'non', '2020-10-10 22:16:00', NULL, 'ceci est une description', 'coco', 7, 1),
(8, 5, 'tache test', 'non', '2020-10-10 22:16:00', NULL, 'ceci est une description', 'coco', 8, 5);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `password`) VALUES
(1, 'coco', '$2y$12$WuLcUQkdlPg9kstHeITW9eQR0u/l/iZSk9/h9MACQAvlROoNMnP7i'),
(5, 'user', '$2y$12$WVyTptafvWM5lFmOJ.QOs.vsMui48DX5SulwqcqedX4XiHLS4M3ai'),
(6, 'new_user', '$2y$12$ti60QQ2YpV3uneLLvESOWuq924DkKquO7uuwQy2cAC1FH13LVjac.'),
(7, 'user2', '$2y$12$2Uq59kAtrqiV5EMJWWH6MOnqFw4aaMJHQguTw8TnkJ1M7VBxobqs.'),
(8, 'newuser', '$2y$12$w9pPM0.m495Qqt9PkCUuKu6/j08A9UuAqPJZiU0jmL78DVMOV4yBq'),
(11, 'user7', '$2y$12$QvXSiRZEfYg4ssngkPYjDuxdyTrwaNn4XysgBMcQSs1e4hEwi5sQ2');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
