-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 01 mai 2018 à 21:04
-- Version du serveur :  5.7.19
-- Version de PHP :  7.1.9
CREATE DATABASE IF NOT EXISTS `ppe2`;
USE `ppe2`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ppe2`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

DROP TABLE IF EXISTS `adresse`;
CREATE TABLE IF NOT EXISTS `adresse` (
  `IDAdresse` int(11) NOT NULL AUTO_INCREMENT,
  `IDClient` int(11) NOT NULL,
  `Nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Prenom` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `Societe` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Adresse1` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Adresse2` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CodePostal` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Ville` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Pays` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `TypeAdresse` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`IDAdresse`),
  KEY `produit_ibfk_3` (`IDClient`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `adresse`
--

INSERT INTO `adresse` (`IDAdresse`, `IDClient`, `Nom`, `Prenom`, `Societe`, `Adresse1`, `Adresse2`, `CodePostal`, `Ville`, `Pays`, `TypeAdresse`) VALUES
(1, 18, 'admin', 'admin', 'Société', '4 Rue de la Bonne Humeur', 'Appt 209', '66000', 'Perpignan', 'Barbados', 'Livraison'),
(2, 18, 'admin', 'admin', 'Société', '4 Rue de la bonne humeur', 'Appt 209', '66000', 'Perpignan', 'France', 'Facturation');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `IDCategorie` int(11) NOT NULL AUTO_INCREMENT,
  `IDCategorieFamille` int(11) DEFAULT NULL,
  `Libelle` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `OrdreAffichage` int(11) NOT NULL,
  PRIMARY KEY (`IDCategorie`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`IDCategorie`, `IDCategorieFamille`, `Libelle`, `OrdreAffichage`) VALUES
(1, 1, 'Bonbons', 1),
(2, 2, 'Boissons', 2),
(3, 3, 'Briocherie', 3),
(4, 4, 'Pâtisseries', 4);

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `IDClient` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Pseudo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `MotDePasse` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Civilite` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Prenom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Telephone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Question` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Reponse` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DateCreation` datetime DEFAULT NULL,
  `Grade` int(11) DEFAULT '0',
  PRIMARY KEY (`IDClient`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`IDClient`, `Email`, `Pseudo`, `MotDePasse`, `Civilite`, `Prenom`, `Nom`, `Telephone`, `Question`, `Reponse`, `DateCreation`, `Grade`) VALUES
(18, 'admin@admin.fr', 'admin', '$2y$10$KAjJIZkKyvAg..QtVcc9/e6drTDnhuVr.zV8hFB4OvxTjv6aA6RxO', 'Homme', 'admin', 'admin', '0303030303', NULL, NULL, '2018-05-01 17:16:57', 1);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `IDCommande` int(11) NOT NULL AUTO_INCREMENT,
  `DateCommande` date NOT NULL,
  `HeureCommande` time NOT NULL,
  `EtatCommande` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `TotalTTC` float NOT NULL,
  `TotalHT` float NOT NULL,
  `TotalTVA` float NOT NULL,
  `FraisPortTTC` float NOT NULL,
  `Commentaire` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IDClient` int(11) NOT NULL,
  `IDAdresseFacturation` int(11) NOT NULL,
  `IDAdresseLivraison` int(11) NOT NULL,
  `NumCommande` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `NumFacture` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MethodeReglement` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`IDCommande`),
  UNIQUE KEY `NumCommande` (`NumCommande`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`IDCommande`, `DateCommande`, `HeureCommande`, `EtatCommande`, `TotalTTC`, `TotalHT`, `TotalTVA`, `FraisPortTTC`, `Commentaire`, `IDClient`, `IDAdresseFacturation`, `IDAdresseLivraison`, `NumCommande`, `NumFacture`, `MethodeReglement`) VALUES
(12, '2018-05-01', '23:02:00', 'En attente de préparation...', 131.72, 105.6, 21.12, 5, '', 18, 2, 1, 'LDR-0501-53305', NULL, 'PayPal');

-- --------------------------------------------------------

--
-- Structure de la table `commande_produits`
--

DROP TABLE IF EXISTS `commande_produits`;
CREATE TABLE IF NOT EXISTS `commande_produits` (
  `IDProduit` int(11) NOT NULL,
  `IDCommande` int(11) NOT NULL,
  `Quantite` int(11) NOT NULL,
  KEY `IDProduit` (`IDProduit`),
  KEY `IDCommande` (`IDCommande`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commande_produits`
--

INSERT INTO `commande_produits` (`IDProduit`, `IDCommande`, `Quantite`) VALUES
(1, 12, 24),
(15, 12, 12);

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `IDContact` smallint(6) NOT NULL AUTO_INCREMENT,
  `IDClient` int(11) DEFAULT NULL,
  `nomDemandeur` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mesDemandeur` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `emailDemandeur` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`IDContact`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `IDImage` int(5) NOT NULL AUTO_INCREMENT,
  `NomImage` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `IDProduit` int(11) NOT NULL,
  `OrdreAffichage` int(5) DEFAULT NULL,
  PRIMARY KEY (`IDImage`),
  KEY `produit_ibfk_2` (`IDProduit`)
) ENGINE=MyISAM AUTO_INCREMENT=82 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`IDImage`, `NomImage`, `IDProduit`, `OrdreAffichage`) VALUES
(46, 'Black Thunder Volt.jpg', 1, 1),
(47, 'CafÃ© Boss.jpg', 2, 2),
(48, 'canette de lait.jpg', 3, 3),
(49, 'canette pouding.jpg', 4, 4),
(50, 'canette thÃ©.jpg', 5, 5),
(51, 'chocoball.jpg', 6, 6),
(52, 'chocoball cachuÃ¨tes.jpg', 7, 7),
(53, 'chocoball fraise.jpg', 8, 8),
(54, 'cookie melon.jpg', 9, 9),
(55, 'dorayaki haricots rouges.jpg', 10, 10),
(56, 'fanta fruits rouges.jpg', 11, 11),
(57, 'Fran double choco.jpg', 12, 12),
(58, 'fausse biÃ¨re.jpg', 13, 13),
(59, 'gÃ¢teau fromage.jpg', 14, 14),
(60, 'gÃ¢teau triple choco.jpg', 15, 15),
(61, 'granola thunder.jpg', 16, 16),
(62, 'Pocky Heartful.jpg', 17, 17),
(63, 'jus.jpg', 18, 18),
(64, 'kitkat macha.jpg', 19, 19),
(65, 'lait sucrÃ©.jpg', 20, 20),
(66, 'moelleux choco.jpg', 21, 21),
(67, 'moelleux fraise.jpg', 22, 22),
(68, 'orangina petillant.jpg', 23, 23),
(69, 'oreo macha.jpg', 24, 24),
(70, 'oreo tiramisu.jpg', 25, 25),
(71, 'pain melon.jpg', 26, 26),
(72, 'pÃ¢te fruit haricots.jpg', 27, 27),
(73, 'pocky melon.jpg', 28, 29),
(74, 'puchitto cola.jpg', 29, 30),
(75, 'ramune-kun soda.jpg', 30, 31),
(76, 'tarte cerise.jpg', 31, 32);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `IDProduit` int(11) NOT NULL AUTO_INCREMENT,
  `IDCategorie` int(11) DEFAULT NULL,
  `Reference` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LibelleProduit` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PrixUnitaireHT` float DEFAULT NULL,
  `OrdreAffichage` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDProduit`),
  KEY `IDCategorie` (`IDCategorie`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`IDProduit`, `IDCategorie`, `Reference`, `LibelleProduit`, `Description`, `PrixUnitaireHT`, `OrdreAffichage`) VALUES
(1, 1, 'BOB1', 'Black Thunder Volt', 'Délicieuse barre chocolatée bourrée de morceaux d\'amandes et de cookies.', 3.5, NULL),
(2, 2, 'BOI1', 'Café Boss', 'Probablement le café le plus populaire de la gamme Boss. Légèrement sucré il se consomme chaud ou froid.', 2.5, NULL),
(3, 2, 'BOI2', 'canette de lait', 'Boisson non gazeuse sans alcool aux ferments lactiques qui lui donnent une couleur et une consistance de lait sucré dilué. Très populaire au Japon, cette boisson est commercialisée depuis 1919 sur l\'archipel.', 2.3, NULL),
(4, 2, 'BOI3', 'canette pouding', 'Pouding en canette. Bien secouer avant de boire !', 2.5, NULL),
(5, 2, 'BOI4', 'canette thé', 'Thé vert japonais en canette de marque Itoen.', 1.8, NULL),
(6, 1, 'BOB2', 'Chocoball', 'Boules de chocolat renfermant du caramel.', 2.5, NULL),
(7, 1, 'BOB3', 'chocoball cacahuetes', 'Boules de chocolat renfermant une cacahuète entière.', 2.5, NULL),
(8, 1, 'BOB4', 'chocoball fraise', 'Boules de chocolat à la fraise à l\'intérieur \"crispy\".', 2.5, NULL),
(9, 3, 'BRI1', 'cookie au melon', 'Paquet de 22 \"melon pan cookies\" présentés sous emballage individuel fraîcheur. 11 biscuits à la crème de melon et 11 biscuits nature.', 1.8, NULL),
(10, 3, 'BRI2', 'Dorayaki Haricots Rouges', 'Dessert japonais très populaire composé de pâte de haricot rouge sucrée enfermée dans deux pancakes. Produit dans la préfecture de Chiba par l\'un des plus grands fabricants de Dorayaki du Japon.', 1.5, NULL),
(11, 2, 'BOI5', 'fanta fruits rouges', 'Boisson gazeuse sans alcool aux goûts fruits rouges.', 1.2, NULL),
(12, 4, 'PAT1', 'fran double chocolat', 'Deux épaisses couches de chocolat crémeux sur un délicieux bâtonnet lui aussi au chocolat (des Fran Triple Chocolat donc..).', 1.2, NULL),
(13, 2, 'BOI6', 'Fausse Bière', 'Une boisson au cola amusante à faire ressemblant à une bière. 4 verres à collectionner.', 1.6, NULL),
(14, 4, 'PAT2', 'Gâteau au fromage', 'Une boîte de 5 mini gâteaux au goût de fromages.', 2.3, NULL),
(15, 4, 'PAT3', 'Gâteaux moelleux fourrés triple choco', 'Une boîte de 5 mini gâteaux fins et fondants de type \"fondant au chocolat\" cuits au four. Les chocolats Bake ne fondent pas dans la main, leur coeur fondant est recouvert d\'une très fine couche de chocolat cuit craquant.', 1.8, NULL),
(16, 3, 'BRI3', 'Granola Thunder', 'Petite barre de chocolat remplie de biscuits très populaire au Japon. Ici aux fruits.', 1.99, NULL),
(17, 2, 'BOI7', 'Pocky Heartful', 'Pocky à la fraise avec de petits morceaux de fraise incrustés dans le chocolat et bâtonnets en forme de coeur. Nom en japonais: \"Pocky Strawberry Tsubutsubu Ichigo Heartful\".', 1.26, NULL),
(18, 2, 'BOI8', 'Jus pomme/pêche', 'Jus au goût pomme/pêche.', 1.7, NULL),
(19, 4, 'PAT4', 'Kitkat thé vert', 'Une gaufrette légère enrobée d’un nappage sucré au thé vert, l’ensemble est à la fois croustillant et fondant. Le nappage au goût de thé vert assez subtil en fait une friandise au goût inédit, typiquement japonaise. ', 1.8, NULL),
(20, 2, 'BOI9', 'Lait sucré', 'Canette de lait sucré.', 1.3, NULL),
(21, 3, 'BRI4', 'Moelleux à la broche chocolat', 'Pâtisserie cuite à la broche. Originaire d\'Allemagne le baumkuchen est devenu l\'une des pâtisseries les plus populaires du Japon où l\'on peut la voir dans de très nombreuses variétés.', 2.2, NULL),
(22, 3, 'BRI5', 'Moelleux à la broche fraise', 'Pâtisserie cuite à la broche. Originaire d\'Allemagne le baumkuchen est devenu l\'une des pâtisseries les plus populaires du Japon où l\'on peut la voir dans de très nombreuses variétés.', 2.2, NULL),
(23, 2, 'BOI10', 'Orangina eau pétillante', 'Le dernier Orangina à débarquer au Japon!!! Boisson pétillante aux saveurs d\'agrumes rafraîchissants et amèrs', 1.8, NULL),
(24, 4, 'PAT5', 'Oreo au thé vert', 'Nouveaux Oreo Crispy super fins au thé vert. Boîte de 24.', 1.4, NULL),
(25, 4, 'PAT6', 'Oreo au Tiramisu', 'Nouveaux Oreo Crispy super fins goût tiramisu. Édition spéciale pour les 30 ans de Oreo au Japon. Boîte de 24.', 1.5, NULL),
(26, 3, 'BRI6', 'Pain au melon', 'Découvrez le melon pan japonais, un pain brioché sucré et moelleux très populaire au Japon. Nous restockons les Melon Pan en moyenne tous les deux jours. Si ce produit n\'est plus en stock revenez d\'ici quelques heures.', 2.2, NULL),
(27, 4, 'PAT7', 'Pâte de fruits haricots rouges', 'Le yōkan est une pâtisserie japonaise sucrée et gélifiée à base de pâte de haricot rouge. Il se mange le plus souvent comme accompagnement du thé. Ici un yōkan incrusté de morceaux de haricots rouges. Un bloc peut se partager entre 3 ou 4 personnes.', 1.9, NULL),
(28, 1, 'BOB5', 'Pocky Melon', 'Pocky géants édition limitée régionale. Ces Pocky ne sont vendus qu\'en quantité limitée sur l\'île d\'Hokkaido dans le nord du Japon.', 1.3, NULL),
(29, 1, 'BOB6', 'Puchitto Cola', 'Retour au Japon des Puchitto soda !', 2.5, NULL),
(30, 2, 'BOI11', 'Ramune-kun (soda)', 'Boisson gazeuse sans alcool, l\'un des soda les plus connu et les plus populaire au Japon.', 1.7, NULL),
(31, 4, 'PAT8', 'Tarte cerise', 'Cinq tartes au sakura présentées dans une très jolie boîte aux couleurs du printemps japonais. En partenariat avec le fabricant, Candysan est la première boutique en ligne à expédier ce produit hors d\'Asie. ', 1.6, NULL);


--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adresse`
--
ALTER TABLE `adresse`
  ADD CONSTRAINT `produit_ibfk_3` FOREIGN KEY (`IDClient`) REFERENCES `clients` (`IDClient`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`IDCategorie`) REFERENCES `categorie` (`IDCategorie`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
