-- Adminer 4.3.1 MySQL dump

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
  `score` int(11) DEFAULT NULL,
  `joueur` varchar(255) NOT NULL,
  `id_serie` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `photo`;
CREATE TABLE `photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `position_long` float NOT NULL,
  `position_lat` float NOT NULL,
  `url` varchar(255) NOT NULL,
  `id_serie` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `serie`;
CREATE TABLE `serie` (
  `id` varchar(255) NOT NULL,
  `ville` varchar(120) NOT NULL,
  `serie_lat` varchar(120) NOT NULL,
  `serie_long` varchar(120) NOT NULL,
  `dist` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE `utilisateur` (
  `id` varchar(255) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2018-02-08 15:44:23

