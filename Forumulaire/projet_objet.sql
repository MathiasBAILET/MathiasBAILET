-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 06 fév. 2024 à 14:59
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
-- Base de données : `projet_objet`
--

-- --------------------------------------------------------

--
-- Structure de la table `badge`
--

DROP TABLE IF EXISTS `badge`;
CREATE TABLE IF NOT EXISTS `badge` (
  `id_badge` int NOT NULL AUTO_INCREMENT,
  `id_employe` int DEFAULT NULL,
  PRIMARY KEY (`id_badge`),
  KEY `id_employe` (`id_employe`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `badge`
--

INSERT INTO `badge` (`id_badge`, `id_employe`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(13, 14);

-- --------------------------------------------------------

--
-- Structure de la table `employe`
--

DROP TABLE IF EXISTS `employe`;
CREATE TABLE IF NOT EXISTS `employe` (
  `id_employe` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `age` int DEFAULT NULL,
  `id_badge` int DEFAULT NULL,
  PRIMARY KEY (`id_employe`),
  KEY `id_badge` (`id_badge`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `employe`
--

INSERT INTO `employe` (`id_employe`, `nom`, `prenom`, `age`, `id_badge`) VALUES
(1, 'Dupont', 'Jean', 30, 1),
(2, 'Smith', 'Alice', 25, 2),
(3, 'Dubois', 'Pierre', 35, 3),
(4, 'Martin', 'Sophie', 28, 4),
(5, 'Lefebvre', 'Luc', 40, 5),
(6, 'Garcia', 'Maria', 33, 6),
(7, 'Moreau', 'Thomas', 32, 7),
(8, 'Wang', 'Ling', 27, 8),
(9, 'Mueller', 'Hans', 45, 9),
(14, 'Chatain', 'Florian', 18, 14);

-- --------------------------------------------------------

--
-- Structure de la table `pointage`
--

DROP TABLE IF EXISTS `pointage`;
CREATE TABLE IF NOT EXISTS `pointage` (
  `id_pointage` int NOT NULL AUTO_INCREMENT,
  `id_badge` int DEFAULT NULL,
  `date_heure_pointage` datetime DEFAULT NULL,
  PRIMARY KEY (`id_pointage`),
  KEY `id_badge` (`id_badge`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `pointage`
--

INSERT INTO `pointage` (`id_pointage`, `id_badge`, `date_heure_pointage`) VALUES
(1, 1, '2024-01-01 06:06:02'),
(2, 2, '2024-01-03 09:06:02'),
(3, 3, '2024-01-01 07:06:02'),
(4, 4, '2024-01-03 12:06:02'),
(5, 5, '2024-01-04 11:06:02'),
(7, 7, '2024-01-03 11:06:02'),
(8, 8, '2024-01-03 18:06:02'),
(9, 9, '2024-01-31 18:06:02');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `idu` int NOT NULL AUTO_INCREMENT,
  `nom_utilisateur` varchar(50) NOT NULL,
  `mot_de_passe` varchar(100) NOT NULL,
  PRIMARY KEY (`idu`),
  UNIQUE KEY `nom_utilisateur` (`nom_utilisateur`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`idu`, `nom_utilisateur`, `mot_de_passe`) VALUES
(1, 'alice', 'erspoihergioheziuh'),
(2, 'bob', '1234'),
(3, 'charlie', '1234'),
(4, 'dave', '1234'),
(5, 'eve', '1234'),
(6, 'elouan', '1234'),
(10, 'Mathias', '1234'),
(11, 'Florian_chatain', '1234'),
(8, 'Paul', '1234'),
(12, 'Adolf', 'benito'),
(14, 'Ambre', '1234'),
(15, 'lol', '1234'),
(16, '', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
