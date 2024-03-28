-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 28 mars 2024 à 13:08
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
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `nom` varchar(30) NOT NULL,
  `catégorie` varchar(20) NOT NULL,
  `prix` int(11) NOT NULL,
  `img_src` varchar(40) NOT NULL,
  `Availability` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`nom`, `catégorie`, `prix`, `img_src`, `Availability`) VALUES
('Autumn Jewels Bouquet', 'valentine', 60, 'images/valentin/flower7.png', 'on stock'),
('Blush Bouquet', 'valentine', 60, 'images/valentin/flower4.png', 'on stock'),
('Butterflies Bouquet', 'mariage', 60, 'images/mariage/flower6.png', 'on stock'),
('Cascade Bouquet', 'anniversaire', 60, 'images/anniversaire/flower4.png', 'on stock'),
('Cheers and Love Bouquet', 'valentine', 60, 'images/valentin/flower1.png', 'on stock'),
('Classic Bouquet', 'anniversaire', 60, 'images/anniversaire/flower1.png', 'on stock'),
('Composite Bouquet', 'mariage', 60, 'images/mariage/flower1.png', 'on stock'),
('Daisy Flowers', 'anniversaire', 45, 'images/04jar.png', 'on stock'),
('Floral Fancies Bouquet', 'valentine', 60, 'images/valentin/flower2.png', 'on stock'),
('Floral Orchestra Bouquet', 'mariage', 60, 'images/mariage/flower5.png', 'on stock'),
('Graces Bouquet', 'mariage', 60, 'images/mariage/flower3.png', 'on stock'),
('Inspiration Bouquet', 'mariage', 60, 'images/mariage/flower4.png', 'on stock'),
('Pomander Bouquet', 'anniversaire', 60, 'images/anniversaire/flower2.png', 'on stock'),
('Posy Bouquet', 'anniversaire', 60, 'images/anniversaire/flower3.png', 'out of stock'),
('Romance Rose Bouquet', 'valentine', 60, 'images/valentin/flower5.png', 'on stock'),
('Rose Flower', 'anniversaire', 50, 'images/rfjar.png', 'on stock'),
('Rose Garden Bouquet', 'valentine', 60, 'images/valentin/flower6.png', 'on stock'),
('Round Bouquet', 'anniversaire', 45, 'images/anniversaire/flower6.png', 'on stock'),
('Tied Bouquet', 'anniversaire', 50, 'images/anniversaire/flower5.png', 'on stock'),
('Tulip Bouquet', 'mariage', 60, 'images/mariage/flower2.png', 'on stock'),
('Turkish rose', 'valentine', 50, 'images/trjar.png', 'on stock');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`nom`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
