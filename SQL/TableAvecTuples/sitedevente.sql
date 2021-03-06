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

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`nom`) VALUES
('Chat'),
('Comedie'),
('Drama'),
('Enfant'),
('Guide'),
('Humour'),
('NewRetro'),
('Policier'),
('Tourisme');

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

--
-- Dumping data for table `commande`
--

INSERT INTO `commande` (`idCommande`, `email`, `date`, `montantTotal`) VALUES
(0, 'enzo111001@live.fr', '2022-05-14 17:21:36', 3079),
(1, 'enzo111001@live.fr', '2022-05-15 06:52:40', 9000),
(2, 'enzo111001@live.fr', '2022-05-15 08:14:03', 6019);

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

--
-- Dumping data for table `lignecommande`
--

INSERT INTO `lignecommande` (`idProduit`, `idCommande`, `email`, `qte`) VALUES
(1, 0, 'enzo111001@live.fr', 1),
(1, 2, 'enzo111001@live.fr', 1),
(2, 0, 'enzo111001@live.fr', 1),
(2, 1, 'enzo111001@live.fr', 3),
(2, 2, 'enzo111001@live.fr', 2),
(3, 0, 'enzo111001@live.fr', 2);

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

--
-- Dumping data for table `produits`
--

INSERT INTO `produits` (`id`, `nom`, `prix`, `description`, `photo`, `nomCategorie`) VALUES
(1, 'Savoir bien gerer son temps', 19, 'Un livre est un document ??crit formant unit?? et con??u comme tel, compos?? de pages reli??es les unes aux autres. Il a pour fonction d\'??tre un support de l\'??criture, permettant la diffusion et la conservation de textes de nature vari??e.\r\n\r\nSur le plan mat??riel, un livre est un volume de pages reli??es, pr??sentant un ou des textes sous une page de titre commune. Sa forme induit une organisation lin??aire (pagination, chapitres, etc.). Un livre comporte g??n??ralement des outils favorisant l\'acc??s ?? son contenu : table des mati??res, sommaire, index. Il existe une grande vari??t?? de livres selon le genre, les destinataires, ainsi que selon le mode de fabrication et les formats, ou selon les usages. Sauf exception, tel le livre d\'artiste, un livre est publi?? en plusieurs exemplaires par un ??diteur, comme en t??moignent les ??l??ments d\'identification qu\'il comporte obligatoirement.', 'savoir_bien_gerer_son_temps', 'Guide'),
(2, 'L\'art de la sapologie', 3000, 'Un livre est un document ??crit formant unit?? et con??u comme tel, compos?? de pages reli??es les unes aux autres. Il a pour fonction d\'??tre un support de l\'??criture, permettant la diffusion et la conservation de textes de nature vari??e.\r\n\r\nSur le plan mat??riel, un livre est un volume de pages reli??es, pr??sentant un ou des textes sous une page de titre commune. Sa forme induit une organisation lin??aire (pagination, chapitres, etc.). Un livre comporte g??n??ralement des outils favorisant l\'acc??s ?? son contenu : table des mati??res, sommaire, index. Il existe une grande vari??t?? de livres selon le genre, les destinataires, ainsi que selon le mode de fabrication et les formats, ou selon les usages. Sauf exception, tel le livre d\'artiste, un livre est publi?? en plusieurs exemplaires par un ??diteur, comme en t??moignent les ??l??ments d\'identification qu\'il comporte obligatoirement.', 'sapologie', 'Drama'),
(3, 'Le guide de manipulation sur humain', 30, 'Un livre est un document ??crit formant unit?? et con??u comme tel, compos?? de pages reli??es les unes aux autres. Il a pour fonction d\'??tre un support de l\'??criture, permettant la diffusion et la conservation de textes de nature vari??e.\r\n\r\nSur le plan mat??riel, un livre est un volume de pages reli??es, pr??sentant un ou des textes sous une page de titre commune. Sa forme induit une organisation lin??aire (pagination, chapitres, etc.). Un livre comporte g??n??ralement des outils favorisant l\'acc??s ?? son contenu : table des mati??res, sommaire, index. Il existe une grande vari??t?? de livres selon le genre, les destinataires, ainsi que selon le mode de fabrication et les formats, ou selon les usages. Sauf exception, tel le livre d\'artiste, un livre est publi?? en plusieurs exemplaires par un ??diteur, comme en t??moignent les ??l??ments d\'identification qu\'il comporte obligatoirement.', 'guide', 'Chat'),
(4, 'Comment expliquer ?? ma femme que si le site marche pas c\'est pas ma faute', 15, 'Un livre est un document ??crit formant unit?? et con??u comme tel, compos?? de pages reli??es les unes aux autres. Il a pour fonction d\'??tre un support de l\'??criture, permettant la diffusion et la conservation de textes de nature vari??e.\r\n\r\nSur le plan mat??riel, un livre est un volume de pages reli??es, pr??sentant un ou des textes sous une page de titre commune. Sa forme induit une organisation lin??aire (pagination, chapitres, etc.). Un livre comporte g??n??ralement des outils favorisant l\'acc??s ?? son contenu : table des mati??res, sommaire, index. Il existe une grande vari??t?? de livres selon le genre, les destinataires, ainsi que selon le mode de fabrication et les formats, ou selon les usages. Sauf exception, tel le livre d\'artiste, un livre est publi?? en plusieurs exemplaires par un ??diteur, comme en t??moignent les ??l??ments d\'identification qu\'il comporte obligatoirement.', 'comment', 'Humour');

-- --------------------------------------------------------

--
-- Table structure for table `propose`
--

CREATE TABLE `propose` (
  `idProduit` int(11) NOT NULL,
  `idTag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `propose`
--

INSERT INTO `propose` (`idProduit`, `idTag`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(3, 4),
(1, 5),
(1, 6),
(1, 7),
(2, 8),
(2, 9),
(2, 10),
(2, 11),
(1, 12),
(2, 12),
(2, 14),
(4, 14),
(3, 15),
(3, 16),
(3, 17),
(3, 18),
(3, 19),
(3, 20),
(3, 21),
(4, 22),
(4, 23),
(4, 24),
(4, 25),
(4, 26),
(4, 27),
(4, 28),
(4, 29),
(2, 30);

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id`, `libelle`) VALUES
(1, 'jawad'),
(2, 'el'),
(3, 'Hidraoui'),
(4, 'guide'),
(5, 'temps'),
(6, 'gerer'),
(7, 'devenir'),
(8, 'sapologie'),
(9, 'art'),
(10, 'enzo'),
(11, 'martinez'),
(12, 'savoir'),
(14, 'iut'),
(15, 'maitre'),
(16, 'vous'),
(17, 'manipulation'),
(18, 'humain'),
(19, 'jon'),
(20, 'snow'),
(21, 'chien'),
(22, 'Comment'),
(23, 'expliquer'),
(24, 'femme'),
(25, 'site'),
(26, 'faute'),
(27, 'marche'),
(28, 'cyrille'),
(29, 'nadal'),
(30, 'saper');

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
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`nom`, `prenom`, `mail`, `mdp`) VALUES
('Martinez', 'Enzo', 'enzo111001@live.fr', '123');

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
