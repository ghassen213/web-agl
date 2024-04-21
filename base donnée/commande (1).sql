-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 21 avr. 2024 à 17:22
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
-- Base de données : `flowershop`
--

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id_commande` int(11) NOT NULL,
  `nom_produit` varchar(20) NOT NULL,
  `size` int(11) NOT NULL,
  `prix` varchar(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `Delivery` varchar(20) NOT NULL,
  `id_client` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `message` varchar(100) NOT NULL,
  `State` varchar(20) NOT NULL,
  `perso_data` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id_commande`, `nom_produit`, `size`, `prix`, `quantity`, `Delivery`, `id_client`, `date`, `message`, `State`, `perso_data`) VALUES
(1, 'Pomander Bouquet', 0, '31', 2, 'Pick up', 10, '2024-04-21 15:04:33', '', 'In Progress', ''),
(2, 'Tied Bouquet', 0, '21', 2, 'By courier', 10, '2024-04-21 15:07:09', '', 'In Progress', ''),
(3, 'Tied Bouquet', 21, '$50', 2, 'By courier', 10, '2024-04-21 15:07:41', '', 'canceled', ''),
(4, 'Tied Bouquet', 21, '$50', 2, 'By courier', 10, '2024-04-21 15:08:51', '', 'In Progress', ''),
(5, 'Tied Bouquet', 21, '$50', 2, 'By courier', 10, '2024-04-21 15:09:43', '', 'canceled', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_commande`),
  ADD KEY `id_client` (`id_client`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_commande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
