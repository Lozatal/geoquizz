-- Adminer 4.4.0 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `partie`;
CREATE TABLE `partie` (
  `id` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `nb_photos` int(11) NOT NULL,
  `status` char(1) NOT NULL,
  `score` int(11) NOT NULL,
  `joueur` varchar(255) NOT NULL,
  `id_serie` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `photo`;
CREATE TABLE `photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `position_long` decimal(10,0) NOT NULL,
  `position_lat` decimal(10,0) NOT NULL,
  `url` varchar(255) NOT NULL,
  `id_partie` varchar(255) NOT NULL,
  `id_serie` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `serie`;
CREATE TABLE `serie` (
  `id` varchar(255) NOT NULL,
  `ville` varchar(120) NOT NULL,
  `map_refs` varchar(120) NOT NULL,
  `dist` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `serie2photo`;
CREATE TABLE `serie2photo` (
  `serie_id` varchar(255) NOT NULL,
  `photo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE `utilisateur` (
  `id` varchar(255) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `utilisateur` (`id`, `nom`, `email`, `password`) VALUES
('3ce88eac-827b-4423-b3d2-cce7d6d792c5',	'Gizem',	'gizem_ece@gmail.com',	'$2y$10$/.p410DxQinGW9VwmsJNnO3/o/K8awLGBFCsc8tstYNAr673bfBku'),
('0ac1f055-04b9-4312-bee1-82b3db8c49b9',	'Gizem',	'gizem@gmail.com',	'$2y$10$16kxcCmihfZIHDX.R3SLTecLR/6KZeLPpSUqBdyxo090HtbebJNd6');
