-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 22 avr. 2026 à 09:32
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `caisseshop`
--

-- --------------------------------------------------------

--
-- Structure de la table `paniers`
--

CREATE TABLE `paniers` (
  `Id` int(11) NOT NULL,
  `Id_produit` int(11) NOT NULL,
  `Id_vente` int(11) NOT NULL,
  `Quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `paniers`
--

INSERT INTO `paniers` (`Id`, `Id_produit`, `Id_vente`, `Quantite`) VALUES
(1, 2, 1, 1),
(2, 2, 2, 1),
(3, 1, 2, 1),
(4, 5, 2, 1),
(5, 6, 2, 1),
(6, 2, 3, 5),
(7, 1, 3, 4),
(8, 6, 3, 4),
(9, 7, 3, 2),
(10, 10, 3, 2),
(11, 7, 4, 3),
(12, 8, 4, 1),
(13, 4, 4, 1),
(14, 3, 4, 3),
(15, 2, 4, 2),
(16, 5, 5, 1),
(17, 6, 5, 1),
(18, 10, 5, 1),
(19, 9, 5, 1),
(20, 7, 5, 1),
(21, 6, 6, 1),
(22, 6, 7, 1),
(23, 6, 8, 1),
(24, 7, 9, 1),
(25, 7, 10, 1),
(26, 7, 11, 1),
(27, 7, 12, 1),
(28, 7, 13, 1),
(29, 6, 14, 1),
(30, 5, 15, 1),
(31, 6, 15, 1),
(32, 2, 15, 1),
(33, 1, 16, 1),
(34, 1, 17, 1),
(35, 2, 17, 1),
(36, 8, 18, 1),
(37, 10, 19, 1),
(38, 11, 20, 1),
(39, 2, 21, 3),
(40, 3, 21, 3),
(41, 6, 21, 2),
(42, 13, 21, 2),
(43, 14, 22, 1);

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `Id` int(11) NOT NULL,
  `Nom_produit` varchar(64) NOT NULL,
  `Description` varchar(1020) NOT NULL,
  `Prix` float NOT NULL,
  `Code_barre` varchar(8) NOT NULL,
  `Stock` int(11) NOT NULL,
  `ImgChemin` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`Id`, `Nom_produit`, `Description`, `Prix`, `Code_barre`, `Stock`, `ImgChemin`) VALUES
(1, 'Pain baguette', 'Pain frais du jour', 1.2, 'REF-0003', 48, 'imgUtilisateur/Baguettes_franaise.jpg'),
(2, 'Lait demi-écrémé', 'Brique de lait 1L', 0.96, '21474836', 25, 'imgUtilisateur/lait.webp'),
(3, 'Oeufs x12', 'Boîte de 12 oeufs', 2.5, '21474836', 17, 'imgUtilisateur/Oeufx12.jpg'),
(4, 'Riz blanc 1kg', 'Riz long grain', 1.8, '21474836', 40, 'imgUtilisateur/rizb blanc.png'),
(5, 'Pâtes spaghetti', 'Paquet 500g', 1.1, '21474836', 34, 'imgUtilisateur/spaghetti.jpg'),
(6, 'Sucre 1kg', 'Sucre blanc en poudre', 1.5, '21474836', 21, 'imgUtilisateur/sucre.webp'),
(7, 'Huile d’olive', 'Bouteille 75cl', 6.9, '21474836', 14, 'imgUtilisateur/Huile d’olive.jpg'),
(8, 'Eau minérale', 'Pack de 6 bouteilles', 2.3, '21474836', 59, 'imgUtilisateur/Eau minérale.jpg'),
(9, 'Jus d’orange', 'Bouteille 1L', 2, '21474836', 22, 'imgUtilisateur/Jus d’orange.webp'),
(10, 'Fromage emmental', 'Fromage râpé 200g', 2.8, '21474836', 17, 'imgUtilisateur/Fromage emmental.webp'),
(13, 'Farine', 'Blé moulu', 1.29, 'REF0234', 10, 'imgUtilisateur/Farine.png'),
(14, 'Déodorant', 'Deo bio', 3, 'REF0232', 22, 'imgUtilisateur/deo.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `Nom` varchar(64) NOT NULL,
  `Prenom` varchar(64) NOT NULL,
  `Email` varchar(128) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`Id`, `Nom`, `Prenom`, `Email`, `Password`) VALUES
(1, 'Abdel', 'Paja', 'abdelpaja@gmail.com', 'azerty'),
(2, 'Utilisateur', '1', 'utilisateur@gmail.com', 'user123');

-- --------------------------------------------------------

--
-- Structure de la table `ventes`
--

CREATE TABLE `ventes` (
  `Id` int(11) NOT NULL,
  `Id_user` int(11) NOT NULL,
  `Total` float NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ventes`
--

INSERT INTO `ventes` (`Id`, `Id_user`, `Total`, `Date`) VALUES
(1, 1, 0.95, '2026-04-06 15:02:15'),
(2, 1, 4.75, '2026-04-06 15:03:54'),
(3, 1, 34.95, '2026-04-06 15:04:30'),
(4, 1, 34.2, '2026-04-06 15:04:47'),
(5, 1, 14.3, '2026-04-07 14:46:19'),
(6, 1, 1.5, '2026-04-07 15:08:59'),
(7, 1, 1.5, '2026-04-07 15:10:33'),
(8, 1, 1.5, '2026-04-07 15:10:56'),
(9, 1, 6.9, '2026-04-07 15:12:29'),
(10, 1, 6.9, '2026-04-07 15:13:19'),
(11, 1, 6.9, '2026-04-07 15:13:55'),
(12, 1, 6.9, '2026-04-07 15:14:27'),
(13, 1, 6.9, '2026-04-07 15:17:14'),
(14, 1, 1.5, '2026-04-07 15:17:20'),
(15, 1, 3.55, '2026-04-07 15:17:27'),
(16, 1, 1.2, '2026-04-07 15:18:38'),
(17, 1, 2.15, '2026-04-07 15:18:43'),
(18, 1, 2.3, '2026-04-07 15:22:42'),
(19, 1, 2.8, '2026-04-07 15:22:52'),
(20, 1, 2, '2026-04-08 17:06:08'),
(21, 1, 15.96, '2026-04-11 13:51:53'),
(22, 1, 3, '2026-04-11 14:09:59');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `paniers`
--
ALTER TABLE `paniers`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `ventes`
--
ALTER TABLE `ventes`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `paniers`
--
ALTER TABLE `paniers`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `ventes`
--
ALTER TABLE `ventes`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
