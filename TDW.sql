-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 20 jan. 2023 à 01:57
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
-- Base de données : `guide_cook`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin_site`
--

DROP TABLE IF EXISTS `admin_site`;
CREATE TABLE IF NOT EXISTS `admin_site` (
  `username` varchar(50) NOT NULL,
  `pwd` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `admin_site`
--

INSERT INTO `admin_site` (`username`, `pwd`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `IDCatego` int(11) NOT NULL,
  `IDCatego_nom` varchar(50) NOT NULL,
  PRIMARY KEY (`IDCatego`,`IDCatego_nom`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`IDCatego`, `IDCatego_nom`) VALUES
(1, 'entree'),
(2, 'plat'),
(3, 'dessert'),
(4, 'boisson');

-- --------------------------------------------------------

--
-- Structure de la table `compose`
--

DROP TABLE IF EXISTS `compose`;
CREATE TABLE IF NOT EXISTS `compose` (
  `IDIngredient` varchar(50) NOT NULL,
  `quantite` float DEFAULT NULL,
  `IDRecette` int(11) NOT NULL,
  PRIMARY KEY (`IDIngredient`,`IDRecette`),
  KEY `IDIngredient` (`IDIngredient`,`IDRecette`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `compose`
--

INSERT INTO `compose` (`IDIngredient`, `quantite`, `IDRecette`) VALUES
('eau', 3, 1),
('tomate', 3, 1),
('semoule fine', 5, 1),
('fromage', 3, 1),
('oignon', 2, 3),
('viande bœuf hachee', 0.5, 1),
('Sel', 2, 1),
('oignon', 3, 1),
('berkoukess', 1, 2),
('oignon', 3, 2),
('tomate', 2, 2),
('Sel', 2, 2),
('poivre', 1, 2),
('huile d\'olive', 0.5, 2),
('dyoul', 10, 3),
('huile olive', 0.25, 3),
('blanc de poulet', 0.5, 3),
('Sel', 1, 3),
('fromage', 2, 3),
('branches de persil', 0.2, 3),
('oignon', 1, 4),
('viande bœuf hachee', 1, 4),
('langues de oiseau', 2, 4),
('pomme de terre', 7, 21),
('oignon', 3, 21),
('huile olive', 3, 21),
('farine', 0.2, 21),
('fromage', 3, 21),
('ktayef', 2, 6),
('sucre', 1, 6),
('beurre', 1, 7),
('ammande', 0.5, 7),
('datte', 0.2, 9),
('sucre', 2, 9),
('sucre', 4, 20),
('beurre', 0.5, 20),
('rechta', 2, 14),
('Kouskous', 2, 13),
('oignon', 4, 13),
('oignon', 3, 14),
('huile olive', 6, 13),
('huile olive', 5, 14),
('citron', 5, 15),
('lait', 0.5, 15),
('eau', 4, 18),
('pasteque', 0.5, 18),
('sel', 3, 34),
('banane', 4, 34),
('oeuf', 2, 5),
('sucre', 2, 5),
('œuf', 3, 7),
('vannile', 1, 5),
('caroute', 1, 4),
('courgette', 1, 4),
('huile olive', 0.1, 4),
('beur', 3, 31),
('oignon', 10, 31),
('Oignon', 2, 35),
('farine', 1, 1),
('nv_i', 2, 40),
('Sel', 3, 40),
('oignon', 2, 40),
('oeuf', 4, 42);

-- --------------------------------------------------------

--
-- Structure de la table `cuissance`
--

DROP TABLE IF EXISTS `cuissance`;
CREATE TABLE IF NOT EXISTS `cuissance` (
  `IDCuiss` int(11) NOT NULL AUTO_INCREMENT,
  `Metode` varchar(50) NOT NULL,
  PRIMARY KEY (`IDCuiss`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `cuissance`
--

INSERT INTO `cuissance` (`IDCuiss`, `Metode`) VALUES
(1, 'cuire au four'),
(2, 'frire'),
(3, 'blanchir'),
(4, 'griller'),
(5, 'glacer');

-- --------------------------------------------------------

--
-- Structure de la table `etape_realis`
--

DROP TABLE IF EXISTS `etape_realis`;
CREATE TABLE IF NOT EXISTS `etape_realis` (
  `IDReal` int(11) NOT NULL AUTO_INCREMENT,
  `descript` varchar(255) NOT NULL,
  `NumEtape` int(11) DEFAULT NULL,
  `IDRecette` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDReal`),
  KEY `IDRecette` (`IDRecette`)
) ENGINE=MyISAM AUTO_INCREMENT=106 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `etape_realis`
--

INSERT INTO `etape_realis` (`IDReal`, `descript`, `NumEtape`, `IDRecette`) VALUES
(88, 'Quand la farce ait refroidit, mixez-là quelques petites seconde ( la but qu\'elle soit tartinable et il ne faut surtout pas qu\'elle devient liquide) ', NULL, 1),
(87, 'Retirez du feu, ajoutez le persil ciselé et le fromage, mélanger le tout et laissez refroidir ', NULL, 1),
(86, 'Épluchez les tomates et mixez-les, ajoutez-les au mélange et prolongez la cuisson jusqu\'à ce que le mélange devient homogène et qu\'il n\'y a plus d\'eau de tomates', NULL, 1),
(85, 'Dans une sauteuse, faites chauffer l\'huile d\'olive, ajoutez l\'oignon et le poivron, laissez revenir jusqu\'à ce qu\'ils deviennent tendre, ajoutez la viande hachée, le sel et le poivre, remuez le tout et laissez cuire', NULL, 1),
(83, 'On commence par la farce pour qu\'elle ait le temps de refroidir', NULL, 1),
(84, 'Coupez l\'oignon et le poivron en lamelles', NULL, 1),
(7, 'Cuire les pâtes dans de l\'eau bouillante salée', 1, 2),
(8, 'Égoutter les pâtes et les rincer à l\'eau froides', 2, 2),
(9, 'Faites revenir l\'oignon dans l\'huile, ajoutez la viande, le sel, le poivre et enfin le persil haché. Couvrez et faites cuire à feux doux. Une fois la cuisson terminée, ajoutez un œuf et mélangez. Laissez refroidir, ajoutez le fromage et mélangez,', 1, 3),
(10, 'Faites chauffer un peu d\'huile de friture dans une poêle et faites frire les bourek des deux côtés.', 2, 3),
(74, ' Mettre les épices', NULL, 4),
(75, 'Mettre à cuire sur feu doux pendant 5 minutes en mélangent de temps à autre', NULL, 4),
(73, 'rajouter la carotte, la courgette coupées en morceaux, le céleri, l’ail, l courgette ainsi que les tomates pelées et le concentré de tomates', NULL, 4),
(71, 'Dans une marmite, déposer la viande ajouter l’oignon râpé puis faire revenir avec l’huile d’olive', NULL, 4),
(72, ' Une fois la viande a bien pris une belle couleur dorée,', NULL, 4),
(14, 'Epluchez vos pommes de terre, lavez-les et coupez-les en morceaux. Faites-les cuire soit dans l\'eau salée (démarrage à froid), ou à la vapeur. Vérifiez la cuisson avec la pointe d\'un couteau', 1, 21),
(15, 'Faites chauffer de l\'huile de friture dans une poêle. Une fois l\'huile bien chaude, faites-y dorer les galettes des deux côtés. ', 2, 21),
(16, 'aérez les ktayefs et essayant de bien séparer la pate, puis ajoutez le beurre fondu, et \r\nFrottez délicatement entre vos mains pour faire absorber le gras dans les ktayefs', 1, 6),
(17, 'Cuire pour encore 20 minutes, \nEntre temps préparez le sirop avec le sucre et l\'eau sur feu doux, après ébullition, il faut le laisser bouillir environ 15 à 20 min', 2, 6),
(65, 'Placez Les sur une plaque graissée et farinée, cuire pendant 15 à 20 min à 160°CLaissez refroidir sur une grille à pâtisserie', NULL, 7),
(66, 'Mélangez les amandes, le sucre glace ,le zeste de citron, l\'extrait de vanille et ramassez avec les œufs pour obtenir une pâte maniable et ferme', NULL, 7),
(20, 'Préparer une première pâte avec la semoule, le beurre, le sel, un verre d\'eau et 4 cuillerées a café d\'eau de fleur d\'oranger', 1, 9),
(21, 'Cuisson : laisser cuire au four 5 min à 250°C puis 15 min à 150°C.', 2, 9),
(22, 'ans un grand saladier, mettez la semoule, la farine, la levure boulangère, le sel, l\'eau, et Bien les mélangez\r\nMettez le tout dans un blinder et faites tourner 5 minutes', 1, 20),
(23, 'Laissez reposez une 15 aine de minutes, Pendant ce temps, faites chauffer une petite poêle\r\nFaites cuire les baghrir, et  Une louche à chaque fois, et laissez opérer la magie', 2, 20),
(24, 'Dans un couscoussier, préparez la sauce avec le poulet coupé en morceaux, l\'oignon râpé, sel, poivre, cannelle, huile et le smen', 1, 14),
(25, 'Lorsque le poulet est cuit, le retirer de la sauce. Réservez. Ajoutez dans la sauce les navets et les courgettes coupées en 2 dans le sens de la longueur. Laissez cuire', 2, 14),
(26, 'Dans un couscoussier, préparez la sauce avec le poulet coupé en morceaux, l\'oignon râpé, sel, poivre, cannelle, huile et le smen', 1, 13),
(27, 'lorsque le poulet est cuit, le retirer de la sauce. Réservez.\r\nAjoutez dans la sauce les navets et les courgettes coupées en 2 dans le sens de la longueur. Laissez cuire', 2, 13),
(28, 'Dans un recepient, préparez la sauce avec le poulet coupé en morceaux, l\'oignon râpé, sel, poivre, cannelle, huile et le smen', 1, 12),
(29, 'après 15 min, l\'enlevez , versez la dans un grand saladier, arrosez la avec un peu de la sauce qui est en cours de cuisson', 2, 12),
(30, 'Dans un recepient, préparez la sauce avec le poulet coupé en morceaux, l\'oignon râpé, sel, poivre, cannelle, huile et le smen.\r\nFaites revenir 2 à 3mn. Ajoutez 2 l d\'eau et les pois chiches.\r\npassez à la vapeurfraîche.', 1, 11),
(31, 'Dans un recepient, préparez la sauce avec le poulet coupé en morceaux, l\'oignon râpé, sel, poivre, cannelle, huile et le smen.\r\nFaites revenir 2 à 3mn. Ajoutez 2 l d\'eau et les pois chiches.\r\ndes que la sauce commence a bouillir', 1, 10),
(32, 'Râper le zeste du citron et le mettre dans la cuve du mixeur avec 1/4l d\'eau, le jus du citron, du sucre et le sucre vanillé.\r\nMixer.\r\nFiltrer à l\'aide d\'un tissu fin et propre.', 1, 15),
(33, 'Re-mixer le concentré avec le reste de lait. Goûter et rectifier la quantité de sucre au besoin.\r\nRéserver au frais.', 2, 15),
(34, 'mixer les ingredients le concentré avec le reste d\'eau. Goûter et rectifier la quantité de sucre au besoin.\r\nRéserver au frais.', 1, 18),
(35, 'etape 1', NULL, 33),
(36, 'etape2', NULL, 33),
(37, 'etape3', NULL, 33),
(76, ' Rajouter 1,5 litre d’eau chaude', NULL, 4),
(69, 'D\'abord, preparer ktayef', NULL, 5),
(70, 'ensuite preparer la farce, et decouration', NULL, 5),
(77, ' Fermer la marmite et laisser cuire environ 45 bonnes minutes jusqu’à ce que la viande devient tendre et fondante', NULL, 4),
(80, 'D\'abord, fait 1 et 2 ', NULL, 31),
(81, ' Ensuite', NULL, 31),
(82, 'etape 1.etape2', NULL, 35),
(94, 'etape1:jhhsgxgcdc', NULL, 40),
(93, 'etape2: gfgsxsx', NULL, 40),
(98, 'etape 1', NULL, 42),
(103, 'etape1:aaaaaaa', NULL, 45),
(104, 'etape2: gfgsxsx', NULL, 45);

-- --------------------------------------------------------

--
-- Structure de la table `fete`
--

DROP TABLE IF EXISTS `fete`;
CREATE TABLE IF NOT EXISTS `fete` (
  `IDF` int(11) NOT NULL,
  `IDFete_nom` varchar(50) NOT NULL,
  PRIMARY KEY (`IDF`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `fete`
--

INSERT INTO `fete` (`IDF`, `IDFete_nom`) VALUES
(5, 'Mariage'),
(6, 'Circoncision'),
(2, 'Aid'),
(3, 'Achoura'),
(4, 'Yanayar'),
(1, 'Ramdan');

-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

DROP TABLE IF EXISTS `ingredient`;
CREATE TABLE IF NOT EXISTS `ingredient` (
  `IDin` int(11) NOT NULL AUTO_INCREMENT,
  `IDIng` varchar(50) NOT NULL,
  `unite` varchar(20) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `healty` int(1) DEFAULT NULL,
  `saison_natur` int(11) DEFAULT NULL,
  `calories_kcal` float DEFAULT NULL,
  `glucides_g` float DEFAULT NULL,
  `lipides_g` float DEFAULT NULL,
  `proteines_g` float DEFAULT NULL,
  `vitamines_mg` float DEFAULT NULL,
  PRIMARY KEY (`IDin`,`IDIng`)
) ENGINE=MyISAM AUTO_INCREMENT=107 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `ingredient`
--

INSERT INTO `ingredient` (`IDin`, `IDIng`, `unite`, `type`, `healty`, `saison_natur`, `calories_kcal`, `glucides_g`, `lipides_g`, `proteines_g`, `vitamines_mg`) VALUES
(1, 'cuisse de poulet', '500g', 'viande', 1, 5, 150, 15, 30, NULL, 100),
(2, 'oignon', 'moyen', 'legume', 1, 1, 40, 20, 5, NULL, 22),
(3, 'cannelle', 'bâtonnet de', 'epice', 1, 5, 15, NULL, NULL, NULL, NULL),
(4, 'curcuma', 'cac de', 'epice', 1, 5, NULL, NULL, NULL, NULL, NULL),
(5, 'Sel', 'cuillère moyenne', 'epice', 0, 5, NULL, NULL, NULL, NULL, NULL),
(6, 'poivre', 'cuillère moyenne', 'epice', 1, 5, NULL, NULL, NULL, NULL, NULL),
(7, 'petits pois', 'kilogramme', 'legume', 1, 3, NULL, NULL, NULL, NULL, NULL),
(8, 'viande bœuf hachee', '250g', 'viande', 1, 5, 180, NULL, 45, NULL, 160),
(9, 'beurre', '500g', 'manufacturing', 0, 5, NULL, NULL, NULL, NULL, NULL),
(10, 'fonds artichaut', 'moyen', 'legume', 1, 3, NULL, NULL, NULL, NULL, NULL),
(11, 'œuf', 'd', 'produit animaux', 1, 5, 30, 5, 20, 40, 30),
(12, 'branches de persil', 'bouquet', 'herbe', 1, 5, NULL, NULL, NULL, NULL, NULL),
(13, 'citron', 'd', 'legume', 1, 4, 45, 10, NULL, NULL, 35),
(14, 'fromage', '100 gramme', 'manufacturing', 1, 5, NULL, NULL, NULL, NULL, NULL),
(15, 'semoule fine', 'verre', 'manufacturing', 1, 5, NULL, NULL, NULL, NULL, NULL),
(16, 'farine', '500g', 'manufacturing', 0, 5, NULL, NULL, NULL, NULL, NULL),
(17, 'huile olive ', 'cuillères a soupe', 'vegetarien', 1, 4, 80, NULL, 40, NULL, 50),
(18, 'levure ', 'paquet', 'manufacturing', 0, 5, NULL, NULL, NULL, NULL, NULL),
(19, 'eau ', 'verre', 'liquide', 1, 5, NULL, NULL, NULL, NULL, NULL),
(20, 'poivron rouge', 'moyen', 'legume', 1, 2, 35, NULL, NULL, NULL, 30),
(21, 'tomate', 'moyenne', 'legume', 1, 2, 45, NULL, NULL, NULL, 50),
(22, 'berkoukess', '500g', 'manufacturing', 1, 5, NULL, NULL, NULL, NULL, NULL),
(23, 'dyoul', 'feuille', 'manufacturing', 1, 5, 30, NULL, NULL, NULL, NULL),
(24, 'blanc de poulet', '500g', 'viande', 1, 5, 90, NULL, NULL, NULL, 70),
(25, 'langues de oiseau', '50g', 'manufacturing', NULL, 5, NULL, NULL, NULL, NULL, NULL),
(26, 'caroute', 'moyenne', 'legume', NULL, 3, 75, NULL, NULL, NULL, 40),
(27, 'courgette', 'moyenne', 'legume', NULL, 3, 70, NULL, NULL, NULL, 40),
(28, 'pomme de terre', 'moyenne', 'legume', NULL, 4, 80, 20, 25, NULL, 30),
(29, 'rechta', '100gr', 'manufacturing', NULL, 5, NULL, NULL, NULL, NULL, NULL),
(30, 'sucre', '100gr', 'manufacturing', NULL, 5, NULL, NULL, NULL, NULL, NULL),
(31, 'ktayef', 'paquet', 'manufacturing', NULL, 5, NULL, NULL, NULL, NULL, NULL),
(32, 'ammande', '100gr', 'noisette', NULL, 5, 50, 10, 25, NULL, 60),
(33, 'datte', '100gr', 'fruit', NULL, 2, 65, 40, NULL, NULL, 80),
(34, 'Kouskous', '100gr', 'manufacturing', NULL, 5, NULL, NULL, NULL, NULL, NULL),
(35, 'lait', 'litre', 'manufacturing', NULL, 5, 62, 25, 30, NULL, 30),
(36, 'pasteque', 'petite', 'fruit', NULL, 2, 90, 40, NULL, NULL, 60),
(40, 'miel', NULL, NULL, 1, 4, 65, 70, 40, 20, 55),
(104, 'oeuf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ing_nutri`
--

DROP TABLE IF EXISTS `ing_nutri`;
CREATE TABLE IF NOT EXISTS `ing_nutri` (
  `IDInfo` int(11) NOT NULL,
  `Ingredient` varchar(50) NOT NULL,
  `valeur` float DEFAULT NULL,
  PRIMARY KEY (`IDInfo`,`Ingredient`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `ing_nutri`
--

INSERT INTO `ing_nutri` (`IDInfo`, `Ingredient`, `valeur`) VALUES
(1, 'oignon', 164),
(4, 'oignon', 1.1),
(2, 'oignon', 6.25),
(6, 'oignon', 30),
(1, 'viande bœuf hachee', 170),
(4, 'viande bœuf hachee', 120),
(6, 'viande bœuf hachee', 17),
(5, 'viande bœuf hachee', 12),
(3, 'viande bœuf hachee', 70),
(1, 'huile olive', 90),
(6, 'huile olive', 21),
(5, 'huile olive', 2),
(3, 'huile olive', 18),
(1, 'œuf', 155),
(4, 'œuf', 13),
(2, 'œuf', 0.8),
(3, 'œuf', 11),
(6, 'œuf', 15);

-- --------------------------------------------------------

--
-- Structure de la table `ing_saison`
--

DROP TABLE IF EXISTS `ing_saison`;
CREATE TABLE IF NOT EXISTS `ing_saison` (
  `IDing` varchar(50) COLLATE utf8_bin NOT NULL,
  `IDSaison` int(11) NOT NULL,
  PRIMARY KEY (`IDing`,`IDSaison`),
  KEY `IDing` (`IDing`,`IDSaison`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `ing_saison`
--

INSERT INTO `ing_saison` (`IDing`, `IDSaison`) VALUES
('citron', 4),
('fonds artichaut', 3),
('huile olive ', 4),
('oignon', 1),
('petits pois', 3),
('tomate', 2);

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `IDNews` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) DEFAULT NULL,
  `descript` longtext,
  `imgN` varchar(50) DEFAULT NULL,
  `videoN` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`IDNews`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `news`
--

INSERT INTO `news` (`IDNews`, `titre`, `descript`, `imgN`, `videoN`) VALUES
(1, 'TASTEATLAS AWARDS : la cuisine algerienne elue meilleure en Afrique', 'Riche, conviviale et de savoureuse, la cuisine algerienne attire de plus en plus de gourmets. Connue pour sa diversite de mets et d’epices, mais aussi pour son repertoire gastronomique riche qui se transmettait de generation en generation', 'img/recette_pintest/news/cuisine_dz.jpg', NULL),
(2, 'Classement des plats les plus populaires : que manger en Algerie ?', 'La cuisine algerienne fait une nouvelle fois l objet d un nouveau classement. Mais cette fois-ci concerne les meilleurs plats e deguster en Algerie. En effet, le site specialise TasteAtlas a effectue un classement des meilleurs', 'img/recette_pintest/news/most_plat.jpg', NULL),
(3, 'Makrout El Louz dans le top 5 mondial des gateaux traditionnels', 'La cuisine algérienne reçoit de plus en plus de compliments de la part de passionnés des plats et des gâteaux traditionnels. Surtout de la part des touristes qui ont eu la chance d’y goûter lors d’un séjour sur le territoire national.', 'img/recette_pintest/news/mkrot_best.jpg', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `news_details`
--

DROP TABLE IF EXISTS `news_details`;
CREATE TABLE IF NOT EXISTS `news_details` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDNewsG` int(11) NOT NULL,
  `details` longtext NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `news_details`
--

INSERT INTO `news_details` (`ID`, `IDNewsG`, `details`) VALUES
(35, 1, ' au vote du publicPour rappel, à plusieurs reprises, de nombreux plats algériens ont su se démarquer dans des classements, concernant les meilleurs plats d'),
(34, 1, ' les meilleurs gâteaux traditionnelsEn cette fin d’année, le site spécialisé des voyages et de la cuisine traditionnelle, a établi un nouveau classemenisines dans le monde. Et ce, conformément'),
(13, 2, 'D abord, Pour ceux qui ne connaissent pas Taste Atlas, ce dernier représente un guide de voyage expérientiel de la cuisine traditionnelle à travers le monde. '),
(4, 3, 'En effet, conformément à ce classement, le Makrout El Louz algérien occupe la quatrième place de ce podium, et ce grâce à une note totale de 4.5 / 5. À la tête de ce classement, on retrouve en première position les bonbons de Noël,'),
(5, 3, 'spécialité de la République Tchèque. Suivi par le Roxiakia de Grèce en deuxième place puis par le Alfajor venu tout droit d’Argentine.\r\nSi on prend en considération les pâtisseries et gâteaux arabes figurant dans ce classement'),
(6, 3, 'le Makrout El Louz algérien occupe la première place parmi les mieux notés du monde arabe. Une place qui ne fait que montrer davantage la gourmandise de la cuisine et de la pâtisserie algérienne.'),
(31, 1, 'ens ont su se démarquer dans des classements, concernant les meilleurs plats dsé des voyages et de la cuisine traditionnelle, a établi un nouveau classemenisines dans le monde. Et ce, conformément'),
(32, 1, ' au vote du publicPour rappel, à plusieurs reprises, de nombreux plats algérit. Il s’agit du « TASTEATLAS AWARDS 2022 », qui classe les 95 meilleures cue nouilles, les meilleures soupes ou même'),
(33, 1, ' les meilleurs gâteaux traditionnelsEn cette fin d’année, le site spécialit. Il s’agit du « TASTEATLAS AWARDS 2022 », qui classe les 95 meilleures cue nouilles, les meilleures soupes ou même'),
(36, 1, 'ens ont su se démarquer dans des classements, concernant les meilleurs plats dsé des voyages et de la cuisine traditionnelle, a établi un nouveau classemenisines dans le monde. Et ce, conformément au vote du publicPour rappel, à plusieurs reprises, de nombreux plats algérit. Il s’agit du « TASTEATLAS AWARDS 2022 », qui classe les 95 meilleures cue nouilles, les meilleures soupes ou même les meilleurs gâteaux traditionnelsEn cette fin d’année, le site spécialit. Il s’agit du « TASTEATLAS AWARDS 2022 », qui classe les 95 meilleures cue nouilles, les meilleures soupes ou même les meilleurs gâteaux traditionnelsEn cette fin d’année, le site spécialisé des voyages et de la cuisine traditionnelle, a établi un nouveau classemenisines dans le monde. Et ce, conformément au vote du publicPour rappel, à plusieurs reprises, de nombreux plats algériens ont su se démarquer dans des classements, concernant les meilleurs plats d');

-- --------------------------------------------------------

--
-- Structure de la table `nutriment`
--

DROP TABLE IF EXISTS `nutriment`;
CREATE TABLE IF NOT EXISTS `nutriment` (
  `IDNutri` int(11) NOT NULL,
  `nomNutri` varchar(50) NOT NULL,
  `classe` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IDNutri`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `nutriment`
--

INSERT INTO `nutriment` (`IDNutri`, `nomNutri`, `classe`) VALUES
(1, 'calories', 'Energie'),
(2, 'glucides(g)', 'Macro_nutriments'),
(3, 'lipides(g)', 'Macro_nutriments'),
(4, 'proteines(g) ', 'Macro_nutriments'),
(5, 'mineraux(mg)', 'Micro_nutriments'),
(6, 'vitamines(mg)', 'Micro_nutriments');

-- --------------------------------------------------------

--
-- Structure de la table `option_news`
--

DROP TABLE IF EXISTS `option_news`;
CREATE TABLE IF NOT EXISTS `option_news` (
  `ID_option` varchar(100) NOT NULL,
  `ID_New` int(11) NOT NULL,
  PRIMARY KEY (`ID_option`),
  KEY `ID_New` (`ID_New`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `option_recette`
--

DROP TABLE IF EXISTS `option_recette`;
CREATE TABLE IF NOT EXISTS `option_recette` (
  `IDOption_chemin` varchar(50) NOT NULL,
  `type_option` date NOT NULL,
  `IDRecette` int(11) DEFAULT NULL,
  PRIMARY KEY (`IDOption_chemin`),
  KEY `option_fk0` (`IDRecette`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `parametres`
--

DROP TABLE IF EXISTS `parametres`;
CREATE TABLE IF NOT EXISTS `parametres` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nom_parametre` varchar(50) NOT NULL,
  `valeur` varchar(200) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `parametres`
--

INSERT INTO `parametres` (`ID`, `nom_parametre`, `valeur`) VALUES
(1, 'seuil_calories_healty', '700'),
(2, 'porcent_idee_recette', '70'),
(3, 'diapo1', 'img/recette/koskos.JPG'),
(4, 'diapo2', 'img/recette/tajin_Zitoun.jpg'),
(5, 'diapo3', 'img/recette/tajin_hlow.jpg'),
(6, 'diapo4', 'img/recette_pintest/gateau/mkbez.jpeg');

-- --------------------------------------------------------

--
-- Structure de la table `quantite`
--

DROP TABLE IF EXISTS `quantite`;
CREATE TABLE IF NOT EXISTS `quantite` (
  `IDQuantite` int(11) NOT NULL AUTO_INCREMENT,
  `quantite` varchar(50) NOT NULL,
  PRIMARY KEY (`IDQuantite`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `quantite`
--

INSERT INTO `quantite` (`IDQuantite`, `quantite`) VALUES
(1, '1 cas rase'),
(2, '300g'),
(3, '50g'),
(4, '1');

-- --------------------------------------------------------

--
-- Structure de la table `recette`
--

DROP TABLE IF EXISTS `recette`;
CREATE TABLE IF NOT EXISTS `recette` (
  `IdR` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `img` varchar(100) DEFAULT NULL,
  `Descript` longtext,
  `notation` float DEFAULT NULL,
  `difficulte` float DEFAULT NULL,
  `categorie` varchar(50) DEFAULT NULL,
  `Temp_prepa` float DEFAULT NULL,
  `Temp_repo` float DEFAULT NULL,
  `Temp_cuiss` float DEFAULT NULL,
  `ajouter_par` int(11) DEFAULT NULL,
  `saisonR` int(11) DEFAULT NULL,
  `healthyR` int(1) DEFAULT NULL,
  `videoR` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`IdR`),
  KEY `Recette_fk5` (`categorie`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `recette`
--

INSERT INTO `recette` (`IdR`, `titre`, `img`, `Descript`, `notation`, `difficulte`, `categorie`, `Temp_prepa`, `Temp_repo`, `Temp_cuiss`, `ajouter_par`, `saisonR`, `healthyR`, `videoR`) VALUES
(1, 'Kesra farcie', 'img/recette_pintest/entres/Kesra_farcie.jpg', 'La recette de la galette algerienne farcie,fait a une facon avec un melange de semoules et farine, cette galette accompagne tres bien une bonne soupe ', 17.3172, 2, 'entree', 10, 5, 15, NULL, 5, 1, NULL),
(2, 'Salade aux petits plombs', 'img/recette_pintest/entres/salade_kouskous.jpeg', 'Une salade au petits plombs ou aych ou mhamssa certains l appelent aussi berkoukes en anglais c est (Pearl couscous) ou perles de couscous', 2.25, 1, 'entree', 26, 9, 30, NULL, 5, 1, NULL),
(3, 'Bourak au poulet', 'img/recette_pintest/entres/bourak.jpeg', 'la recette des bourak au poulet  que j ai accompagne avec ma chorba langues d oiseaux, j avais deja partage avec vous une recette de bourak au poulet', 4, 1, 'entree', 29, 3, 10, NULL, 5, 0, NULL),
(4, 'Chorba Algérienne langues Oiseaux', 'img/recette_pintest/entres/chorba_tlitli.jpeg', 'Une recette d une soupe algerienne c est une chorba aux langues d oiseaux, une recette traditionnelle ideal pour l hiver,ca rechauffe bien', 6, 3, 'entree', 17, 5, 10, NULL, 4, 1, NULL),
(5, 'Ktayef el makla', 'img/recette_pintest/gateau/ktyf.jpeg', 'un classique algerienne prepare surtout lors des soirees ramadanesques pour accompagner le the ou le cafe nomme ktayef el makla', 6, 4, 'dessert', 40, 15, 35, NULL, 2, NULL, NULL),
(6, 'Khyeb aux amondes', 'img/recette_pintest/gateau/khybz_amonde.jpeg', 'un classique algerienne prepare surtout lors des soirees ramadanesques pour accompagner le the ou le cafe nomme ktayef el makla', 7, 4, 'dessert', 45, 17, 30, NULL, 2, 0, NULL),
(7, 'mkhbez', 'img/recette_pintest/gateau/mkbez.jpeg', 'un classique algerienne prepare surtout lors des soirees ramadanesques pour accompagner le the ou le cafe nomme ktayef el makla', 6, 3, 'dessert', 38, 10, 40, NULL, 5, NULL, NULL),
(8, 'Makrot', 'img/recette_pintest/gateau/mkrot.jpeg', 'un classique algerienne prepare surtout lors des soirees ramadanesques pour accompagner le the ou le cafe nomme ktayef el makla', 4.5, 3, 'dessert', 42, 15, 27, NULL, 5, 0, NULL),
(9, 'Tajin khochof', 'img/recette_pintest/principale/tajin_khochof.jpg', 'un classique algerienne prepare surtout lors des soirees ramadanesques pour accompagner le the ou le caje nomme ktayef el makla', 4.5, 3, 'plat', 30, 5, 45, NULL, NULL, 1, NULL),
(10, 'Sfiria', 'img/recette_pintest/principale/sfiria.jpeg', 'une classique algerienne prepare surtout lors des soirees ramadanesques pour accompagner le the ou le caje nomme ktayef el makla', 6, 3, 'plat', 20, 5, 40, NULL, NULL, 1, NULL),
(11, 'mdrbel', 'img/recette_pintest/principale/mdrbel.jpeg', 'La recette de la galette algerienne farcie,fait a une facon avec un melange de semoules et farine, cette galette accompagne tres bien une bonne soupe ', 8, 4, 'plat', 25, 5, 43, NULL, NULL, 1, NULL),
(12, 'Kouskous', 'img/recette_pintest/principale/kouskous.jpg', 'voila ma delicieuse kouskous  faite maison avec une tres bonne sauce blanche au gout du navet, je ne vous raconte pas le delice, apres une journee de jeun', 7, 4, 'plat', 60, 5, 20, NULL, 3, 1, NULL),
(13, 'Rechta', 'img/recette_pintest/principale/recheta.jpg', 'voila ma delicieuse rechta faite maison avec une trï¿½s bonne sauce blanche au goï¿½t du navet, je ne vous raconte pas le dï¿½lice, aprï¿½s une journï¿½e de jeun', 6, 4, 'plat', 73, 7, 30, NULL, 4, 1, NULL),
(14, 'Cherbat', 'img/recette_pintest/boisson/cherbat.jpg', 'la recette de Cherbet karess,autrement dit citronnade.Cette boisson est originaire de la ville de Boufarik qui se situe à plus d’une trentaine de kilomètres d’Alger.', 6, 2, 'boisson', 30, 5, 0, NULL, 2, 1, NULL),
(15, 'The ', 'img/recette_pintest/boisson/atay.JPG', 'Le the algerien a la menthe est toujours propose aux invites pour les accueillir et leurs souhaiter la bienvenue, c est  un symbole de convivialite et d hospitalite.', 5.5, 1, 'boisson', 15, 2, 9, NULL, 3, 1, NULL),
(16, 'The a la grenade et gingembre ', 'img/recette_pintest/boisson/romain.JPG', 'Il y a pas meilleur qu une cure detox apres tous les repas de fetes bien gourmands. Aujourd hui je partage avec vous cette delicieuse boisson', 5, 2, 'boisson', 15, 0, 5, NULL, NULL, 1, NULL),
(17, 'Jus de pasteque', 'img/recette_pintest/boisson/jus_dalae.JPG', 'Aspect des fruits de saisonQui est la pasteque , battre la chaleur devient facile si vous restez hydraté, c est la saison pour mangerjus de pasteque Ce jus presente de nombreux avantages pour la sante de la pasteque', 4, 2, 'boisson', 17, 0, 0, NULL, NULL, 1, NULL),
(18, 'Jus Abricot', 'img/recette_pintest/boisson/jus_abricot.jpg', 'Il existe bon nombre de boissons traditionnelles syriennes, certaines que l’on boit toute l’année, d’autres quand le fruit est de saison, et enfin des boissons pour des occasions speciales', 8, 2, 'boisson', 23, 2, 5, NULL, NULL, NULL, NULL),
(19, 'Bghir Algerien', 'img/recette_pintest/gateau/bghrir.JPG', 'Le Baghrir Algerien ou crepes mille trous est un classique de la cuisine Marocaine et du Maghreb, servie pour le petit déjeuner ou le gouter', 6, 3, 'dessert', 25, 5, 6, NULL, NULL, NULL, NULL),
(20, 'Meakoda', 'img/recette_pintest/entres/meakoda.jpg', 'Les maekoudas sont de delicieuses galettes de pommes de terre à l algerienne.trés facile à faire', 6, 2, 'entree', 20, 2, 6, NULL, 2, 1, NULL),
(24, 'Hmiss', 'img/recette_pintest/entres/hmiss.jpg', 'Les hmises sont de delicieuses galettes de pommes de terre a l algerienne. Tres facile a faire', 3, 2, 'entree', 15, NULL, 10, NULL, 2, 1, NULL),
(31, 'Nom1\'test\'', 'img', 'test', 6, NULL, 'dessert', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 'osban', 'img/recette/3osban.jpg', 'un petit plat, deliciex et peut etre accompange d autre plat ', 6.5, 2, 'entree', 10, 2, 15, NULL, 4, 1, NULL),
(45, 'new_recette', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `recette_cuisine`
--

DROP TABLE IF EXISTS `recette_cuisine`;
CREATE TABLE IF NOT EXISTS `recette_cuisine` (
  `IDRecette` int(11) NOT NULL,
  `methode` varchar(100) NOT NULL,
  `bonne` int(1) DEFAULT NULL,
  PRIMARY KEY (`IDRecette`,`methode`),
  KEY `IDRecette` (`IDRecette`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `recette_cuisine`
--

INSERT INTO `recette_cuisine` (`IDRecette`, `methode`, `bonne`) VALUES
(15, 'blanchir', 1),
(18, 'glacer', 1),
(3, 'frire', 0),
(20, 'frire', 0),
(9, 'cuire au four', 1),
(31, 'blanchir', 1),
(7, 'cuire au four', 1),
(5, 'cuire au four', 1),
(35, 'frire', 0),
(40, 'fruire', 0),
(42, 'frire', 0);

-- --------------------------------------------------------

--
-- Structure de la table `recette_fete`
--

DROP TABLE IF EXISTS `recette_fete`;
CREATE TABLE IF NOT EXISTS `recette_fete` (
  `IDRecette` int(11) NOT NULL,
  `IDFete` varchar(50) NOT NULL,
  PRIMARY KEY (`IDRecette`,`IDFete`),
  KEY `IDRecette` (`IDRecette`,`IDFete`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `recette_fete`
--

INSERT INTO `recette_fete` (`IDRecette`, `IDFete`) VALUES
(3, '1'),
(4, '1'),
(6, '2'),
(7, '2'),
(12, '5'),
(13, '5'),
(13, '6'),
(14, '3'),
(14, '4'),
(21, '1');

-- --------------------------------------------------------

--
-- Structure de la table `saison`
--

DROP TABLE IF EXISTS `saison`;
CREATE TABLE IF NOT EXISTS `saison` (
  `IDSaison` int(11) NOT NULL AUTO_INCREMENT,
  `NomSaison` varchar(50) NOT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  PRIMARY KEY (`IDSaison`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `saison`
--

INSERT INTO `saison` (`IDSaison`, `NomSaison`, `date_debut`, `date_fin`) VALUES
(1, 'printemps', '2023-03-21', '2023-05-20'),
(2, 'ete', '2023-05-21', '2023-07-20'),
(3, 'automne', '2022-07-21', '2022-09-20'),
(4, 'hiver', '2022-09-21', '2023-03-20'),
(5, 'tout_annee', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `unite`
--

DROP TABLE IF EXISTS `unite`;
CREATE TABLE IF NOT EXISTS `unite` (
  `Unite` varchar(20) NOT NULL,
  PRIMARY KEY (`Unite`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `unite`
--

INSERT INTO `unite` (`Unite`) VALUES
('gramme'),
('littre');

-- --------------------------------------------------------

--
-- Structure de la table `user_prefer_recette`
--

DROP TABLE IF EXISTS `user_prefer_recette`;
CREATE TABLE IF NOT EXISTS `user_prefer_recette` (
  `IDUser` int(50) NOT NULL,
  `IDRecette` int(11) NOT NULL,
  PRIMARY KEY (`IDUser`,`IDRecette`),
  KEY `IDUser` (`IDUser`,`IDRecette`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user_prefer_recette`
--

INSERT INTO `user_prefer_recette` (`IDUser`, `IDRecette`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 9),
(1, 12),
(2, 1),
(4, 3),
(5, 3);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `IDUser` int(50) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `pwd` varchar(50) NOT NULL,
  `sexe` char(1) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  PRIMARY KEY (`IDUser`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`IDUser`, `nom`, `prenom`, `username`, `pwd`, `sexe`, `mail`, `date_naissance`) VALUES
(1, 'kaouthar', 'Essaheli', 'kawter', '123', 'F', 'jk_essaheli@esi.dz', '2002-05-05'),
(2, 'nom1', 'pre1', 'user1', 'pwd1', 'M', 'a@gmail.com', '1997-05-07');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
