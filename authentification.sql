-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  Dim 25 mars 2018 à 05:57
-- Version du serveur :  10.1.30-MariaDB
-- Version de PHP :  7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `authentification`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `Code` varchar(2) NOT NULL,
  `Description` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`Code`, `Description`) VALUES
('F', 'Feminin'),
('M', 'Masculin');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `Utili_Nom` varchar(20) NOT NULL,
  `Utili_Mot_De_Passe` varchar(45) NOT NULL,
  `Utili_Nom_Personnel` varchar(45) NOT NULL,
  `Categorie_Code` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`Utili_Nom`, `Utili_Mot_De_Passe`, `Utili_Nom_Personnel`, `Categorie_Code`) VALUES
('bob42', '1234', 'bob', 'M'),
('boby69', '987654', 'charlotte', 'M'),
('bobyThePinp', '696969', 'Bob Jr.', 'F'),
('joe', '4567', 'billy joe', 'M'),
('joe1', '789', 'bil', 'M'),
('joe3', '456789', 'bil', 'M'),
('joe4', '123456', 'joejoe', 'M'),
('joe444', '123456', 'joe', 'M');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`Code`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`Utili_Nom`,`Categorie_Code`),
  ADD KEY `fk_Utilisateur_Categorie_idx` (`Categorie_Code`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `fk_Utilisateur_Categorie` FOREIGN KEY (`Categorie_Code`) REFERENCES `categorie` (`Code`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
