-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 22 Juin 2016 à 05:39
-- Version du serveur :  10.1.9-MariaDB
-- Version de PHP :  5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mariage`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id_categorie` int(11) NOT NULL,
  `libelle_categorie` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `libelle_categorie`) VALUES
(1, 'Music'),
(2, 'Couple'),
(3, 'Reception'),
(4, 'Orchéstre'),
(5, 'Photographie'),
(6, 'Sécurité');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `CIN` int(11) NOT NULL,
  `NomPrenom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Tel` int(11) NOT NULL,
  `Email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Login` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`CIN`, `NomPrenom`, `Tel`, `Email`, `Login`, `Password`, `photo`) VALUES
(55899223, 'kamel benzarti', 53332691, 'cahmed2011@gmail.fr', 'kamelbzrt', 'kamelbzrt', ''),
(65242311, 'ahmed mansour', 25369837, 'ahmedmsr@live.fr', 'ahmedmsr', 'ahmedmsr', ''),
(88859610, 'Fendri amal', 53623200, 'fendriamal@yahoo.fr', 'fendriamal', 'fendriamal', ''),
(88859615, 'Amina ben mrad', 53623236, 'aminabenmrd@yahoo.fr', 'aminabmd', 'aminabmd', '');

-- --------------------------------------------------------

--
-- Structure de la table `proposition`
--

CREATE TABLE `proposition` (
  `id_proposition` int(11) NOT NULL,
  `libelle_proposition` varchar(50) NOT NULL,
  `prix_proposition` float NOT NULL,
  `service` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `proposition`
--

INSERT INTO `proposition` (`id_proposition`, `libelle_proposition`, `prix_proposition`, `service`) VALUES
(1, 'Orchestre Donia', 2200, 1),
(2, 'Orchestre lajmi', 2500, 1),
(5, 'Orchestre Iquaa', 3000, 2),
(6, 'Trabelsi SOLO', 2750, 2),
(7, 'Frais', 17.5, 4),
(8, 'Citronade', 3800, 4),
(9, 'Pate', 35000, 5),
(11, 'Gateaux', 28550, 5),
(12, ' Haute couture F. Manaa', 700, 6),
(13, 'L''homme', 550, 6),
(14, 'Narjes Haute Cloture', 2000, 8),
(16, 'Faycel Wedding Dress', 2500, 8),
(17, ' Esthere Maryline', 2200, 8);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id_reservation` int(11) NOT NULL,
  `salle` int(11) DEFAULT NULL,
  `client` int(11) DEFAULT NULL,
  `dateReservation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Prix` double NOT NULL,
  `Confirmation` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `reservation`
--

INSERT INTO `reservation` (`id_reservation`, `salle`, `client`, `dateReservation`, `Prix`, `Confirmation`) VALUES
(1, 4, 65242311, '2016-06-19', 6500, 2),
(2, 1, 88859610, '2016-07-16', 10750, 3);

-- --------------------------------------------------------

--
-- Structure de la table `responsable`
--

CREATE TABLE `responsable` (
  `CIN` int(11) NOT NULL,
  `NomPrenom` varchar(50) NOT NULL,
  `Tel` int(8) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Login` varchar(20) NOT NULL,
  `Password` varchar(15) NOT NULL,
  `photo` varchar(250) NOT NULL,
  `bloc` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `responsable`
--

INSERT INTO `responsable` (`CIN`, `NomPrenom`, `Tel`, `Email`, `Login`, `Password`, `photo`, `bloc`) VALUES
(4441523, 'Ali Jaoua', 58369201, 'alijaoua@yahoo.fr', 'alijaoua', 'alijaoua', '', 0),
(8884680, 'Chebbi Ahmed', 97524287, 'il-pazzo@hotmail.fr', 'ilpazzo513', 'ilpazzo512', '97de0dfb321650c05f844518999fee6f.jpg', 0),
(55580807, 'Mansour Tlili', 58258625, 'mnasourtlili@gmail.com', 'msrtlili', 'msrtlili', '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `saison`
--

CREATE TABLE `saison` (
  `id_salle` int(11) NOT NULL,
  `prix` float NOT NULL,
  `Debut` varchar(10) NOT NULL,
  `Fin` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `saison`
--

INSERT INTO `saison` (`id_salle`, `prix`, `Debut`, `Fin`) VALUES
(1, 8000, '2016-06-01', '2016-08-15'),
(1, 6500, '2016-08-16', '2016-12-28'),
(1, 7000, '2016-12-29', '2017-04-14'),
(3, 7800, '2016-06-07', '2016-07-31'),
(3, 7000, '2016-08-01', '2016-11-30'),
(3, 7750, '2016-12-01', '2017-05-31'),
(4, 4500, '2016-06-04', '2016-08-15'),
(4, 5000, '2016-08-16', '2016-09-30'),
(4, 4350, '2016-10-01', '2017-01-20');

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE `salle` (
  `id_salle` int(11) NOT NULL,
  `nom_salle` varchar(35) NOT NULL,
  `adresse_salle` varchar(100) NOT NULL,
  `type_salle` varchar(30) NOT NULL,
  `surface_salle` float NOT NULL,
  `capacite_salle` int(4) NOT NULL,
  `Responsable` int(11) DEFAULT NULL,
  `photo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `salle`
--

INSERT INTO `salle` (`id_salle`, `nom_salle`, `adresse_salle`, `type_salle`, `surface_salle`, `capacite_salle`, `Responsable`, `photo`) VALUES
(1, 'GreenGungle', 'Tunis,Menzeh 6                                                        ', 'Couverte', 980.5, 550, 8884680, 'b3c26e711f8ce4c34a3f34604f9b73a0.jpg'),
(3, 'Naher El Founoun', '        Route de Téniour, km 3 - 3041 Sfax - Tunisie                                                ', 'Couverte', 2000.7, 500, 4441523, 'cec049ca1220d0235444640b4499bc92.PNG'),
(4, 'Massaya', 'Route de l''afranne, ceinture numéro 10', 'Plein air', 1450.3, 900, 55580807, 'a1f0f7e30ec68c5445f9927d5db9f77b.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

CREATE TABLE `service` (
  `id_service` int(11) NOT NULL,
  `libelle_service` varchar(35) NOT NULL,
  `salle` int(11) DEFAULT NULL,
  `categorie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `service`
--

INSERT INTO `service` (`id_service`, `libelle_service`, `salle`, `categorie`) VALUES
(1, 'Music Orientale', 1, 1),
(2, 'Music Classique', 1, 1),
(3, 'Contrôle des invitations', 1, 6),
(4, 'Jus', 3, 3),
(5, 'Pattiserie', 3, 3),
(6, 'Costume Marié', 4, 2),
(8, 'Robe de mariée', 4, 2);

-- --------------------------------------------------------

--
-- Structure de la table `service_demande`
--

CREATE TABLE `service_demande` (
  `id` int(11) NOT NULL,
  `Libelle` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `reservation` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `service_demande`
--

INSERT INTO `service_demande` (`id`, `Libelle`, `reservation`) VALUES
(12, 'Robe de mariée Narjes Haute Cloture', 1),
(13, 'Music Classique Trabelsi SOLO', 2);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`CIN`);

--
-- Index pour la table `proposition`
--
ALTER TABLE `proposition`
  ADD PRIMARY KEY (`id_proposition`),
  ADD KEY `IDX_C7CDC353E19D9AD2` (`service`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id_reservation`),
  ADD UNIQUE KEY `reservation` (`client`,`dateReservation`,`salle`),
  ADD KEY `IDX_42C849554E977E5C` (`salle`),
  ADD KEY `IDX_42C84955C7440455` (`client`);

--
-- Index pour la table `responsable`
--
ALTER TABLE `responsable`
  ADD PRIMARY KEY (`CIN`);

--
-- Index pour la table `saison`
--
ALTER TABLE `saison`
  ADD PRIMARY KEY (`id_salle`,`Debut`);

--
-- Index pour la table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`id_salle`),
  ADD UNIQUE KEY `UNIQ_4E977E5CD4CE82D0` (`Responsable`);

--
-- Index pour la table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id_service`),
  ADD KEY `IDX_E19D9AD24E977E5C` (`salle`),
  ADD KEY `IDX_E19D9AD2497DD634` (`categorie`);

--
-- Index pour la table `service_demande`
--
ALTER TABLE `service_demande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E910853942C84955` (`reservation`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `CIN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88859616;
--
-- AUTO_INCREMENT pour la table `proposition`
--
ALTER TABLE `proposition`
  MODIFY `id_proposition` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id_reservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `responsable`
--
ALTER TABLE `responsable`
  MODIFY `CIN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55580808;
--
-- AUTO_INCREMENT pour la table `salle`
--
ALTER TABLE `salle`
  MODIFY `id_salle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `service`
--
ALTER TABLE `service`
  MODIFY `id_service` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `service_demande`
--
ALTER TABLE `service_demande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `proposition`
--
ALTER TABLE `proposition`
  ADD CONSTRAINT `FK_C7CDC353E19D9AD2` FOREIGN KEY (`service`) REFERENCES `service` (`id_service`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `FK_42C849554E977E5C` FOREIGN KEY (`salle`) REFERENCES `salle` (`id_salle`),
  ADD CONSTRAINT `FK_42C84955C7440455` FOREIGN KEY (`client`) REFERENCES `client` (`CIN`);

--
-- Contraintes pour la table `salle`
--
ALTER TABLE `salle`
  ADD CONSTRAINT `FK_4E977E5CD4CE82D0` FOREIGN KEY (`Responsable`) REFERENCES `responsable` (`CIN`);

--
-- Contraintes pour la table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `FK_E19D9AD2497DD634` FOREIGN KEY (`categorie`) REFERENCES `categorie` (`id_categorie`),
  ADD CONSTRAINT `FK_E19D9AD24E977E5C` FOREIGN KEY (`salle`) REFERENCES `salle` (`id_salle`);

--
-- Contraintes pour la table `service_demande`
--
ALTER TABLE `service_demande`
  ADD CONSTRAINT `FK_E910853942C84955` FOREIGN KEY (`reservation`) REFERENCES `reservation` (`id_reservation`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
