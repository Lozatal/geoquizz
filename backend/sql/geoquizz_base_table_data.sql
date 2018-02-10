-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 10 fév. 2018 à 09:44
-- Version du serveur :  5.7.19
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `geoquizz`
--
CREATE DATABASE IF NOT EXISTS `geoquizz` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `geoquizz`;

-- --------------------------------------------------------

--
-- Structure de la table `partie`
--

DROP TABLE IF EXISTS `partie`;
CREATE TABLE IF NOT EXISTS `partie` (
  `id` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `nb_photos` int(11) NOT NULL,
  `status` char(1) NOT NULL,
  `score` int(11) DEFAULT NULL,
  `joueur` varchar(255) NOT NULL,
  `id_serie` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `partie`
--

INSERT INTO `partie` (`id`, `token`, `nb_photos`, `status`, `score`, `joueur`, `id_serie`) VALUES
('02037c1c-764b-4e38-a355-2320926f1487', 'b3c2fcad4afafd22ae337ba76f3cc0a1b417a769fb34e182a1f6c3fb6aebae3a', 5, '1', 6, 'Player666', 'd54e1566-580c-45f8-a0bc-4908c17c6753'),
('25111664-3f0b-4578-a20e-e3acd59031f2', '994614724d62a751bebe92cc8b2a805143a6115218a0e6b48a17cfd4e45f5d75', 3, '1', 5, 'Daniel', '8d83f7ba-8da6-49af-a6b4-6aff7c12027c'),
('519e9593-d7e5-4b19-af7f-f413b757fb24', '4864cf93b0b96866de8e7745210af569a18ba29f987c5b1ac768ca8262e999e4', 5, '1', 24, 'Player666', '732340e5-c6c5-4686-b024-a402ce24a1f9'),
('61f73406-f2ca-473a-b15e-f923c32c8ec3', '9ca796b1fd6546b7f3e6fd38f4278ccc3b8766576f1417561004c01cd4bbaba3', 2, '1', 23, 'Daniel', '732340e5-c6c5-4686-b024-a402ce24a1f9'),
('767bae93-fda2-42e0-bdf2-d8d596bea1eb', '3b6eee9eb421aa69b62308a5607149d165d52f3982519d53cef974837ff3f68a', 2, '1', 12, 'Valentin', 'd54e1566-580c-45f8-a0bc-4908c17c6753'),
('99477f09-ecc2-4904-83fd-08932822590b', 'e3d12c332aa331af8db95bfd4f66a889e21268faea0abdf74c2d9bc22e2b3904', 4, '1', 10, 'Daniel', '8d83f7ba-8da6-49af-a6b4-6aff7c12027c'),
('9b7d7679-9644-44f6-8afb-2593379e28f0', '7336e18ffbb47e2c31ba9d84734deee958d8d0067fe79dbf30482ee1a5bf6ad2', 5, '1', 44, 'Daniel', 'd54e1566-580c-45f8-a0bc-4908c17c6753'),
('9c61e88c-88cc-44bf-b587-30affd710f6f', '43c76b7c8ec62b43e2cb08ae320ad100383af4b2042a4349f844431b216cf9d2', 5, '1', 60, 'Player666', '8d83f7ba-8da6-49af-a6b4-6aff7c12027c'),
('9d1895d0-336e-4545-84ac-46fb29943fd7', 'fb2e388c0147bdb81d72b5a502b9242979e561e442c0b4a13dc171c14ac7acf0', 4, '1', 25, 'Valentin', '8d83f7ba-8da6-49af-a6b4-6aff7c12027c'),
('a95c96a0-ec04-46cf-95d3-3efe42d5fc0f', '18d6deff1b700ed2f6f90cded67cbc9a16dacd5e816ca285d6e90d67b310a91b', 5, '1', 33, 'Player666', '8d83f7ba-8da6-49af-a6b4-6aff7c12027c'),
('d3cf83d2-1813-46fe-9f54-f76f47f43b0c', '76049a98bdbc67389ca5136ddd436244908e92d764b94dd16474f6bc2448c6e1', 3, '1', 40, 'Valentin', '732340e5-c6c5-4686-b024-a402ce24a1f9');

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

DROP TABLE IF EXISTS `photo`;
CREATE TABLE IF NOT EXISTS `photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `position_long` decimal(10,6) NOT NULL,
  `position_lat` decimal(10,6) NOT NULL,
  `url` varchar(255) NOT NULL,
  `id_serie` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `photo`
--

INSERT INTO `photo` (`id`, `description`, `position_long`, `position_lat`, `url`, `id_serie`) VALUES
(21, 'Place Stanislas', '6.183241', '48.693600', 'https://www.tourisme-lorraine.fr/sitlorimg/1920/0/aHR0cHM6Ly93d3cuc2l0bG9yLmZyL3Bob3Rvcy83MzcvcGxhY2VzdGFuaXNsYXNkZW51aXQuanBn.jpg', '732340e5-c6c5-4686-b024-a402ce24a1f9'),
(22, 'Auchan Laxou', '6.125484', '48.691765', 'https://static4.pagesjaunes.fr/media/ugc/auchan_05430400_113217357', '732340e5-c6c5-4686-b024-a402ce24a1f9'),
(23, 'Burger King', '6.182586', '48.690392', 'https://www.groupe-bertrand.com/wp-content/uploads/2016/01/BK.jpg', '732340e5-c6c5-4686-b024-a402ce24a1f9'),
(24, 'Cathédrale', '6.186120', '48.691223', 'https://files1.structurae.de/files/photos/5256/2017-07-25/dsc01766.jpg', '732340e5-c6c5-4686-b024-a402ce24a1f9'),
(25, 'Hopital central', '6.191491', '48.684715', 'https://media-exp2.licdn.com/mpr/mpr/AAEAAQAAAAAAAA02AAAAJGE0OGVkYjJmLTM3N2UtNGI3ZS1iNDE4LWI4ZDhjZWMzOWM0Yg.jpg', '732340e5-c6c5-4686-b024-a402ce24a1f9'),
(26, 'Zocolo', '-99.133331', '19.426332', 'https://c1.staticflickr.com/3/2304/2105552839_795ced3da4_b.jpg', '8d83f7ba-8da6-49af-a6b4-6aff7c12027c'),
(27, 'Templo mayor', '-99.125496', '19.434332', 'https://media-cdn.tripadvisor.com/media/photo-s/03/1c/a0/06/museo-del-templo-mayor.jpg', '8d83f7ba-8da6-49af-a6b4-6aff7c12027c'),
(28, 'Bosque de Chapultepec', '-99.183296', '19.416700', 'http://d2yspv744gxsd1.cloudfront.net/wp-content/uploads/2017/11/09191519/chapultepec.jpg', '8d83f7ba-8da6-49af-a6b4-6aff7c12027c'),
(29, 'metropolitan cathedral', '-99.126503', '19.433998', 'https://upload.wikimedia.org/wikipedia/commons/c/c6/Catedral_de_M%C3%A9xico.jpg', '8d83f7ba-8da6-49af-a6b4-6aff7c12027c'),
(30, 'Palacio de Bellas Artes', '-99.141235', '19.435301', 'https://thumbs.dreamstime.com/b/le-mus%C3%A9e-de-palais-de-beaux-arts-%C3%A0-mexico-mexique-51937120.jpg', '8d83f7ba-8da6-49af-a6b4-6aff7c12027c'),
(31, 'Dongdaemun market', '127.009506', '37.566936', 'https://i2.wp.com/www.habkorea.net/wp-content/uploads/2017/06/Dongdaemun-DDP.jpg?resize=970%2C645&ssl=1', 'd54e1566-580c-45f8-a0bc-4908c17c6753'),
(32, 'Hongik university', '126.920830', '37.553997', 'https://media-cdn.tripadvisor.com/media/daodao/photo-s/03/3c/41/04/caption.jpg', 'd54e1566-580c-45f8-a0bc-4908c17c6753'),
(33, 'Lotte world', '127.098030', '37.511234', 'https://cdn.cnn.com/cnnnext/dam/assets/170419134321-lotte-world-tower-exterior-super-169.jpg', 'd54e1566-580c-45f8-a0bc-4908c17c6753'),
(34, 'Gyeongbokgung', '126.973000', '37.573830', 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Gyeongbokgung-GeunJeongJeon.jpg/1200px-Gyeongbokgung-GeunJeongJeon.jpg', 'd54e1566-580c-45f8-a0bc-4908c17c6753'),
(35, 'Namsan tower', '126.986130', '37.550854', 'https://i2.wp.com/www.tommyooi.com/wp-content/uploads/2015/12/N-Seoul-Tower.jpeg', 'd54e1566-580c-45f8-a0bc-4908c17c6753'),
(36, 'Tour Eiffel', '2.294524', '48.858471', 'https://www.parisinfo.com/var/otcp/sites/images/media/1.-photos/02.-sites-culturels-630-x-405/tour-eiffel-trocadero-630x405-c-thinkstock/37221-1-fre-FR/Tour-Eiffel-Trocadero-630x405-C-Thinkstock.jpg', 'e6294cd7-149c-4287-ab8e-28230385d63e'),
(37, 'Pyramide du Louvre', '2.335866', '48.861084', 'https://www.parisinfo.com/var/otcp/sites/images/node_43/node_51/node_230/le-louvre-pyramide-cour-napol%C3%A9on-nuit-%7C-630x405-%7C-%C2%A9-thinkstock/37520-1-fre-FR/Le-Louvre-pyramide-cour-Napol%C3%A9on-nuit-%7C-630x405-%7C-%C2%A9-Thinkstock.jpg', 'e6294cd7-149c-4287-ab8e-28230385d63e'),
(38, 'Les invalides', '2.312589', '48.855232', 'https://www.parisinfo.com/var/otcp/sites/images/media/1.-photos/02.-sites-culturels-630-x-405/hotel-des-invalides-esplanade-630x405-c-thinkstock/35967-1-fre-FR/Hotel-des-Invalides-esplanade-630x405-C-Thinkstock.jpg', 'e6294cd7-149c-4287-ab8e-28230385d63e'),
(39, 'Arc de triomphe', '2.295031', '48.873878', 'https://www.parisinfo.com/var/otcp/sites/images/media/1.-photos/02.-sites-culturels-630-x-405/arc-de-triomphe-ciel-bleu-630x405-c-thinkstock/35684-1-fre-FR/Arc-de-Triomphe-ciel-bleu-630x405-C-Thinkstock.jpg', 'e6294cd7-149c-4287-ab8e-28230385d63e'),
(40, 'Place du trocadéro', '2.288699', '48.861992', 'http://l7.alamy.com/zooms/ec79479519c24dfd973e7386c5b953b0/jardin-de-trocadero-place-du-trocadro-et-du-11-novembre-la-defense-ehcmg8.jpg', 'e6294cd7-149c-4287-ab8e-28230385d63e'),
(41, 'Ecole militaire', '48.854642', '2.306292', 'http://www.guide-tourisme-france.com/IMAGES/IMG3050.jpg', 'e6294cd7-149c-4287-ab8e-28230385d63e'),
(42, 'Sacré Coeur', '48.886709', '2.343103', 'https://images.musement.com/default/0001/19/montmartre-sacre-c%C5%93ur-art-quarter-guided-visit_header-18093.jpeg?w=520&dpr=1', 'e6294cd7-149c-4287-ab8e-28230385d63e'),
(43, 'Hôpital Georges-Pompidou', '48.838862', '2.274020', 'https://www.lenouveaudetective.com/wp-content/uploads/2016/01/hopital-georges-pompidou.jpg', 'e6294cd7-149c-4287-ab8e-28230385d63e'),
(44, 'Catacombes', '48.833834', '2.332422', 'http://cdn-europe1.new2.ladmedia.fr/var/europe1/storage/images/europe1/culture/les-catacombes-de-paris-se-modernisent-3217340/38592797-2-fre-FR/Les-Catacombes-de-Paris-se-modernisent.jpg', 'e6294cd7-149c-4287-ab8e-28230385d63e'),
(45, 'Grande Mosquée', '48.841842', '2.355162', 'https://top-halal.fr/wp-contenu/uploads/2015/07/La-Mosqu%C3%A9e-de-Paris5.jpg', 'e6294cd7-149c-4287-ab8e-28230385d63e'),
(46, 'Notre-Dame de Paris', '48.852969', '2.349894', 'https://cdn.pariscityvision.com/media/wysiwyg/notre-dame-paris.jpg', 'e6294cd7-149c-4287-ab8e-28230385d63e'),
(47, 'Bastille', '48.853085', '2.369252', 'http://monumentsdeparis.net/content/monumentsparis/place-de-la-bastille.jpg', 'e6294cd7-149c-4287-ab8e-28230385d63e'),
(48, 'Panthéon', '48.846234', '2.346396', 'https://www.parisinfo.com/var/otcp/sites/images/media/1.-photos/02.-sites-culturels-630-x-405/pantheon-vue-generale-630x405-c-thinkstock/36266-1-fre-FR/Pantheon-vue-generale-630x405-C-Thinkstock.jpg', 'e6294cd7-149c-4287-ab8e-28230385d63e');

-- --------------------------------------------------------

--
-- Structure de la table `serie`
--

DROP TABLE IF EXISTS `serie`;
CREATE TABLE IF NOT EXISTS `serie` (
  `id` varchar(255) NOT NULL,
  `ville` varchar(120) NOT NULL,
  `serie_lat` varchar(120) NOT NULL,
  `serie_long` varchar(120) NOT NULL,
  `dist` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `serie`
--

INSERT INTO `serie` (`id`, `ville`, `serie_lat`, `serie_long`, `dist`) VALUES
('621a1b93-3217-496a-a5b6-baa61e5ab740', 'France', '48.866667', '2.333333', '60'),
('732340e5-c6c5-4686-b024-a402ce24a1f9', 'Nancy', '48.6833', '6.2', '60'),
('8d83f7ba-8da6-49af-a6b4-6aff7c12027c', 'Mexico', '19.432608', '-99.133209', '60'),
('d54e1566-580c-45f8-a0bc-4908c17c6753', 'Seoul', '37.532600', '127.024612', '60'),
('e6294cd7-149c-4287-ab8e-28230385d63e', 'Paris', '48.866667', '2.333333', '60');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` varchar(255) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `email`, `password`) VALUES
('14aebaee-dbd0-410f-bfb2-8987b1d0e91f', 'demonstration', 'demonstration@yopmail.com', '$2y$10$H31cU0CRT10LcaRU2jaz2ekrTRhya4uBmm4Ou8I4PESxBDEX0H/p2');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
