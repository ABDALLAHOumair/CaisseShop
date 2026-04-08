-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 08 avr. 2026 à 11:55
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

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
(1, 1, 1, 3),
(2, 2, 1, 5),
(3, 5, 1, 5),
(4, 6, 1, 4),
(5, 8, 1, 2),
(6, 1, 2, 1),
(7, 2, 2, 1),
(8, 3, 2, 1),
(9, 4, 2, 1),
(10, 8, 2, 1),
(11, 7, 2, 1),
(12, 6, 2, 1),
(13, 1, 3, 3),
(14, 2, 3, 2),
(15, 1, 4, 3),
(16, 1, 5, 1),
(17, 2, 6, 2),
(18, 1, 7, 2),
(19, 6, 7, 2),
(20, 8, 7, 4),
(21, 4, 7, 1),
(22, 3, 7, 1);

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
  `Stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`Id`, `Nom_produit`, `Description`, `Prix`, `Code_barre`, `Stock`) VALUES
(1, 'Pain baguette', 'Pain frais du jour', 1.2, 'REF-002', 40),
(2, 'Lait demi-écrémé', 'Brique de lait 1L', 0.95, 'REF-2220', 25),
(3, 'Oeufs x12', 'Boîte de 12 oeufs', 2.5, '21474836', 18),
(4, 'Riz blanc 1kg', 'Riz long grain', 1.8, '21474836', 38),
(5, 'Pâtes spaghetti', 'Paquet 500g', 1.1, '21474836', 35),
(6, 'Sucre 1kg', 'Sucre blanc en poudre', 1.5, '21474836', 22),
(7, 'Huile d’olive', 'Bouteille 75cl', 6.9, '21474836', 14),
(8, 'Eau minérale', 'Pack de 6 bouteilles', 2.3, '21474836', 55),
(9, 'Jus d’orange', 'Bouteille 1L', 2, '21474836', 22),
(10, 'Fromage emmental', 'Fromage râpé 200g', 2.8, '21474836', 18);

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
(1, 'Abdel', 'Paja', 'abdelpaja@gmail.com', 'azerty');

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
(1, 1, 12.5, '2026-04-03 07:44:41'),
(2, 1, 17.15, '2026-04-08 04:21:01'),
(3, 1, 5.5, '2026-04-08 04:29:40'),
(4, 1, 3.6, '2026-04-08 04:29:43'),
(5, 1, 1.2, '2026-04-08 04:29:46'),
(6, 1, 1.9, '2026-04-08 04:30:11'),
(7, 1, 18.9, '2026-04-08 04:32:40');

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
  ADD PRIMARY KEY (`Id`),
  ADD KEY `vente_user` (`Id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `paniers`
--
ALTER TABLE `paniers`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `ventes`
--
ALTER TABLE `ventes`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ventes`
--
ALTER TABLE `ventes`
  ADD CONSTRAINT `vente_user` FOREIGN KEY (`Id_user`) REFERENCES `users` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
