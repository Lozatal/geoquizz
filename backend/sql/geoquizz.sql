-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 06, 2018 at 03:13 PM
-- Server version: 5.7.21-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `geoquizz`
--

-- --------------------------------------------------------

--
-- Table structure for table `partie`
--

CREATE TABLE `partie` (
  `id` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `nb_photos` int(11) NOT NULL,
  `status` char(1) NOT NULL,
  `score` int(11) NULL,
  `joueur` varchar(255) NOT NULL,
  `id_serie` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE `photo` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `position_long` decimal(10,0) NOT NULL,
  `position_lat` decimal(10,0) NOT NULL,
  `url` varchar(255) NOT NULL,
  `id_serie` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `serie`
--

CREATE TABLE `serie` (
  `id` varchar(255) NOT NULL,
  `ville` varchar(120) NOT NULL,
  `map_refs` varchar(120) NOT NULL,
  `dist` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` varchar(255) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `email`, `password`) VALUES
('3ce88eac-827b-4423-b3d2-cce7d6d792c5', 'Gizem', 'gizem_ece@gmail.com', '$2y$10$/.p410DxQinGW9VwmsJNnO3/o/K8awLGBFCsc8tstYNAr673bfBku'),
('0ac1f055-04b9-4312-bee1-82b3db8c49b9', 'Gizem', 'gizem@gmail.com', '$2y$10$16kxcCmihfZIHDX.R3SLTecLR/6KZeLPpSUqBdyxo090HtbebJNd6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `partie`
--
ALTER TABLE `partie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `serie`
--
ALTER TABLE `serie`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `photo`
--
ALTER TABLE `photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
