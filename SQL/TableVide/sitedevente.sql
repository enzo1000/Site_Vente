-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: May 15, 2022 at 08:17 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sitedevente`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE `categorie` (
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Table structure for table `commande`
--

CREATE TABLE `commande` (
  `idCommande` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `montantTotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Table structure for table `lignecommande`
--

CREATE TABLE `lignecommande` (
  `idProduit` int(11) NOT NULL,
  `idCommande` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `qte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Table structure for table `lignepanier`
--

CREATE TABLE `lignepanier` (
  `idProduit` int(11) NOT NULL,
  `idPanier` int(11) NOT NULL,
  `idUtilisateur` varchar(100) NOT NULL,
  `qte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `panier`
--

CREATE TABLE `panier` (
  `idPanier` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idUtilisateur` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `produits`
--

CREATE TABLE `produits` (
  `id` int(11) NOT NULL,
  `nom` varchar(200) NOT NULL,
  `prix` int(11) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `photo` varchar(50) NOT NULL,
  `nomCategorie` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `propose`
--

CREATE TABLE `propose` (
  `idProduit` int(11) NOT NULL,
  `idTag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `mdp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`nom`);

--
-- Indexes for table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`idCommande`,`email`),
  ADD KEY `emailUtilisateur` (`email`);

--
-- Indexes for table `lignecommande`
--
ALTER TABLE `lignecommande`
  ADD PRIMARY KEY (`idProduit`,`idCommande`),
  ADD KEY `idCommande` (`idCommande`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `lignepanier`
--
ALTER TABLE `lignepanier`
  ADD PRIMARY KEY (`idProduit`,`idPanier`,`idUtilisateur`),
  ADD KEY `pk_idPanier` (`idPanier`),
  ADD KEY `idUtilisateur` (`idUtilisateur`);

--
-- Indexes for table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`idPanier`,`idUtilisateur`),
  ADD KEY `pk_idUtilisateur` (`idUtilisateur`);

--
-- Indexes for table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`,`nomCategorie`),
  ADD KEY `pk_nomCategorie` (`nomCategorie`);

--
-- Indexes for table `propose`
--
ALTER TABLE `propose`
  ADD PRIMARY KEY (`idProduit`,`idTag`),
  ADD KEY `pk_idTag` (`idTag`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`mail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `emailUtilisateur` FOREIGN KEY (`email`) REFERENCES `utilisateur` (`mail`);

--
-- Constraints for table `lignecommande`
--
ALTER TABLE `lignecommande`
  ADD CONSTRAINT `email` FOREIGN KEY (`email`) REFERENCES `commande` (`email`),
  ADD CONSTRAINT `idCommande` FOREIGN KEY (`idCommande`) REFERENCES `commande` (`idCommande`),
  ADD CONSTRAINT `idProduit` FOREIGN KEY (`idProduit`) REFERENCES `produits` (`id`);

--
-- Constraints for table `lignepanier`
--
ALTER TABLE `lignepanier`
  ADD CONSTRAINT `idUtilisateur` FOREIGN KEY (`idUtilisateur`) REFERENCES `panier` (`idUtilisateur`),
  ADD CONSTRAINT `pk_idPanier` FOREIGN KEY (`idPanier`) REFERENCES `panier` (`idPanier`),
  ADD CONSTRAINT `pk_idProduitPanier` FOREIGN KEY (`idProduit`) REFERENCES `produits` (`id`);

--
-- Constraints for table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `pk_idUtilisateur` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`mail`);

--
-- Constraints for table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `pk_nomCategorie` FOREIGN KEY (`nomCategorie`) REFERENCES `categorie` (`nom`);

--
-- Constraints for table `propose`
--
ALTER TABLE `propose`
  ADD CONSTRAINT `pk_idProduit` FOREIGN KEY (`idProduit`) REFERENCES `produits` (`id`),
  ADD CONSTRAINT `pk_idTag` FOREIGN KEY (`idTag`) REFERENCES `tag` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
