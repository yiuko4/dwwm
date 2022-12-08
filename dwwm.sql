-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 17 nov. 2022 à 09:46
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `flo&lestortues`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `prix` int(11) NOT NULL,
  `promotion` int(11) DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `id_categorie` int(11) DEFAULT NULL,
  `id_couleur` int(11) DEFAULT NULL,
  `id_taille` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `nom`, `image`, `prix`, `promotion`, `stock`, `id_categorie`, `id_couleur`, `id_taille`) VALUES
(1, 'pull', '11284-900-6A_1.jpg', 30, 0, 1, 1, 3, 3),
(2, 'chemiseimprimee', '11285-213-6A_1.jpg', 18, 12, 1, 2, 4, 2),
(3, 'chemiseimprimee', '11285-900-6A_1.jpg', 50, NULL, 1, 1, 3, 3),
(4, 'Chemisegalonsfantaisies', '11286-004-6A_1.jpg', 29, NULL, 1, 1, 5, 2),
(5, 'Blouseimprimeeafronces', '20730-402-34_1.jpg', 26, NULL, 1, 2, 6, 3),
(6, 'Blouseimprimeeafronces', '20730-620-34_1.jpg', 35, NULL, 1, 2, 7, 4),
(7, 'pull', '11284-900-6A_1.jpg', 30, 28, 10, 2, 3, 2),
(8, 'pull', '11284-900-6A_1.jpg', 30, 21, 10, 2, 3, 1),
(9, 'pull', '11284-900-6A_2.jpg', 43, NULL, 10, 2, 1, 4),
(10, 'pull', '11284-900-6A_3.jpg', 30, 28, 10, 2, 6, 1),
(11, 'pull', '11284-900-6A_3.jpg', 30, NULL, 10, 2, 6, 4),
(12, 'pull', '11284-900-6A_3.jpg', 30, 25, 10, 1, 6, 1);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`) VALUES
(1, 'java'),
(2, 'little miss');

-- --------------------------------------------------------

--
-- Structure de la table `colissimo`
--

DROP TABLE IF EXISTS `colissimo`;
CREATE TABLE IF NOT EXISTS `colissimo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code_postal` int(11) DEFAULT NULL,
  `ville` varchar(100) DEFAULT NULL,
  `adresse` varchar(100) DEFAULT NULL,
  `lieu_dit_bp` varchar(100) DEFAULT NULL,
  `batiment_immeuble` varchar(100) DEFAULT NULL,
  `appartement_etage` varchar(100) DEFAULT NULL,
  `defaut` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=318 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `colissimo`
--

INSERT INTO `colissimo` (`id`, `code_postal`, `ville`, `adresse`, `lieu_dit_bp`, `batiment_immeuble`, `appartement_etage`, `defaut`) VALUES
(17, 58340, 'Cercy-la-Tour', '55 Avenue Louis Coudant', '', '', '', 0),
(2, 58340, 'cercy la tour', '55 avenue louis coudant', NULL, NULL, NULL, NULL),
(10, 58340, NULL, NULL, NULL, NULL, NULL, NULL),
(24, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(25, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `prix_total` int(11) DEFAULT NULL,
  `nb_article` int(11) DEFAULT NULL,
  `id_compte_client` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `date`, `prix_total`, `nb_article`, `id_compte_client`) VALUES
(1, '2022-08-03 16:09:47', 48, 2, 0),
(2, '2022-08-03 16:09:47', 50, 1, 0),
(4, '2022-08-03 16:33:16', 196, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `commande_article`
--

DROP TABLE IF EXISTS `commande_article`;
CREATE TABLE IF NOT EXISTS `commande_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_commande` int(11) DEFAULT NULL,
  `id_article` int(11) DEFAULT NULL,
  `prix_vendu` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commande_article`
--

INSERT INTO `commande_article` (`id`, `id_commande`, `id_article`, `prix_vendu`) VALUES
(1, 1, 1, NULL),
(2, 1, 2, NULL),
(3, 2, 3, NULL),
(4, 3, 1, 30),
(5, 3, 2, 18),
(6, 3, 2, 18);

-- --------------------------------------------------------

--
-- Structure de la table `couleur`
--

DROP TABLE IF EXISTS `couleur`;
CREATE TABLE IF NOT EXISTS `couleur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `hex` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `couleur`
--

INSERT INTO `couleur` (`id`, `nom`, `hex`) VALUES
(1, 'vert', '008000'),
(2, 'marron', '582900'),
(3, 'noir', '000000'),
(4, 'terracota', 'c89c7d'),
(5, 'ivoir', 'FFFFF0'),
(6, 'rose', 'FFC0CB'),
(7, 'bleu', '0000FF');

-- --------------------------------------------------------

--
-- Structure de la table `historique_commande`
--

DROP TABLE IF EXISTS `historique_commande`;
CREATE TABLE IF NOT EXISTS `historique_commande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_commande` int(11) DEFAULT NULL,
  `id_compte_client` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `historique_commande`
--

INSERT INTO `historique_commande` (`id`, `id_commande`, `id_compte_client`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, NULL, 3);

-- --------------------------------------------------------

--
-- Structure de la table `mondial_relay`
--

DROP TABLE IF EXISTS `mondial_relay`;
CREATE TABLE IF NOT EXISTS `mondial_relay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_enseigne` varchar(100) DEFAULT NULL,
  `code_postal` int(11) DEFAULT NULL,
  `ville` varchar(100) DEFAULT NULL,
  `adresse` varchar(100) DEFAULT NULL,
  `defaut` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `mondial_relay`
--

INSERT INTO `mondial_relay` (`id`, `nom_enseigne`, `code_postal`, `ville`, `adresse`, `defaut`) VALUES
(17, 'STATION AGIP', 58300, 'ST LEGER LES VIGNES', '4 ROUTE NATIONALE null', 1),
(2, '%nom_enseigne%', 58340, '%vile%', '%adresse%', NULL),
(3, NULL, NULL, NULL, NULL, NULL),
(0, NULL, NULL, NULL, NULL, NULL),
(24, 'MAISON DE LA PRESSE', 58340, 'CERCY LA TOUR', '73 AVENUE LOUIS  COUDANT null', 1),
(25, NULL, NULL, NULL, NULL, NULL),
(26, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `panier_article`
--

DROP TABLE IF EXISTS `panier_article`;
CREATE TABLE IF NOT EXISTS `panier_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_panier` int(11) DEFAULT NULL,
  `id_article` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=119 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `panier_article`
--

INSERT INTO `panier_article` (`id`, `id_panier`, `id_article`) VALUES
(92, 24, 3),
(86, 21, 3),
(116, 17, 3),
(84, 21, 2),
(63, NULL, 2),
(85, 21, 4),
(93, 24, 2);

-- --------------------------------------------------------

--
-- Structure de la table `taille`
--

DROP TABLE IF EXISTS `taille`;
CREATE TABLE IF NOT EXISTS `taille` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `taille`
--

INSERT INTO `taille` (`id`, `nom`) VALUES
(1, 'S'),
(2, 'M'),
(3, 'L'),
(4, 'XL');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `telephone` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `est_valide` tinyint(1) NOT NULL,
  `clef` int(11) NOT NULL,
  `role` varchar(100) DEFAULT NULL,
  `id_colissimo` int(11) DEFAULT NULL,
  `id_mondial_relay` int(11) DEFAULT NULL,
  `id_panier` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `mail`, `telephone`, `password`, `est_valide`, `clef`, `role`, `id_colissimo`, `id_mondial_relay`, `id_panier`) VALUES
(21, 'antoine', 'cibick', 'antoine.cbck4@gmail.com', '613273190', '$2y$10$k1j/Rn4JL6rdF7k2FIbD/eg2DEmRavRqCroF6rTW70LtMvbG5BMPa', 1, 1470, NULL, 21, 21, 21),
(18, 'afa', 'dfez', 'ezfze', '8252', 'zefezrgr', 1, 14, 'utilisateur', NULL, NULL, NULL),
(19, 'afa', 'dfez', 'ezfze', '8252', 'zefezrgr', 1, 14, 'Sutilisateur', NULL, NULL, NULL),
(20, 'afa', 'dfez', 'ezfze', '8252', 'zefezrgr', 1, 14, 'utilisateur', NULL, NULL, NULL),
(17, 'Antoine', 'Cibick', 'acibick58@gmail.com', '61327310', '$2y$10$/wl5.qC/bLwEUBaynKPU9Ok82AKX6BCHQONFsHr6RfYbw2cYm0uyO', 1, 3741, 'administrateur', 17, 17, 17),
(22, 'fzef', 'zge', 'azert', '51', '$2y$10$TMCSTpu38G/WhOjvUNEgze.BATxthxvZf5Y2EzlOnrQUwxsOp9Eny', 1, 8611, NULL, 22, 22, 22),
(24, 'a', 'a', 'a', '670116250', '$2y$10$KYAY2Is1qkiYfry5jYzWveeZbUSUMzYUpLdgN/89SVXzdoj1dm/ba', 1, 7353, NULL, 24, 24, 24),
(26, 'a', 'aa', 'aa', '0', '$2y$10$P/1uvLmF1zIQwufxHqsw/uiwSmPxx5PyItUPXOSQ4P3Hlnv42ocVO', 0, 5335, NULL, 26, 26, 26);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
