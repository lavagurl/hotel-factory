-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql-mvc
-- Généré le : lun. 06 juil. 2020 à 13:27
-- Version du serveur :  5.7.30
-- Version de PHP : 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dbs351879`
--

-- --------------------------------------------------------

--
-- Structure de la table `htlfac157896_bed`
--

CREATE TABLE `htlfac157896_bed` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idRoom` int(11) NOT NULL,
  `idHotel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `htlfac157896_client_comment`
--

CREATE TABLE `htlfac157896_client_comment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `idHotel` int(11) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `htlfac157896_comment`
--

CREATE TABLE `htlfac157896_comment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `idHfUser` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `htlfac157896_comment`
--

INSERT INTO `htlfac157896_comment` (`id`, `message`, `idHfUser`, `active`) VALUES
(1, 'C\'est un site merveilleux! J\'adore!', 54, 1),
(4, 'Magique', 53, 0),
(6, 'Ce site est merveilleusement dÃ©corÃ©! ', 55, 1);

-- --------------------------------------------------------

--
-- Structure de la table `htlfac157896_company`
--

CREATE TABLE `htlfac157896_company` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(80) NOT NULL,
  `matricule` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `htlfac157896_company`
--

INSERT INTO `htlfac157896_company` (`id`, `name`, `matricule`) VALUES
(1, 'Demo Hotel Paris', 'dem259875');

-- --------------------------------------------------------

--
-- Structure de la table `htlfac157896_equipment`
--

CREATE TABLE `htlfac157896_equipment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `idTypeEquipment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `htlfac157896_equipment_room`
--

CREATE TABLE `htlfac157896_equipment_room` (
  `id` int(11) NOT NULL,
  `idEquipment` int(11) NOT NULL,
  `idRoom` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `htlfac157896_equipment_user`
--

CREATE TABLE `htlfac157896_equipment_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idEquipment` int(11) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `htlfac157896_faq_answer`
--

CREATE TABLE `htlfac157896_faq_answer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `answer` text NOT NULL,
  `idHfFaqQuestion` int(11) NOT NULL,
  `idHfUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `htlfac157896_faq_question`
--

CREATE TABLE `htlfac157896_faq_question` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` text NOT NULL,
  `idHfUser` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `htlfac157896_faq_question`
--

INSERT INTO `htlfac157896_faq_question` (`id`, `question`, `idHfUser`, `status`) VALUES
(1, 'Comment faire pour accÃ©der Ã  mon profil ?', 50, 0);

-- --------------------------------------------------------

--
-- Structure de la table `htlfac157896_hotel`
--

CREATE TABLE `htlfac157896_hotel` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(80) NOT NULL,
  `address` varchar(120) DEFAULT NULL,
  `zipcode` varchar(5) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `htlfac157896_hotel`
--

INSERT INTO `htlfac157896_hotel` (`id`, `name`, `address`, `zipcode`, `city`, `country`) VALUES
(1, 'Demo Hotel Paris', '4 villa Méridienne', '75014', 'Paris', 'France'),
(2, 'Au petit Paris', '6 rue des popotins', '64587', 'Le Var', 'France'),
(3, 'Soleil des antilles', '5 rue des vacances', '97200', 'Fort de France', 'France');

-- --------------------------------------------------------

--
-- Structure de la table `htlfac157896_reservation`
--

CREATE TABLE `htlfac157896_reservation` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `arrivingDate` date NOT NULL,
  `leavingDate` date NOT NULL,
  `price` float NOT NULL,
  `idUser` int(11) NOT NULL,
  `idHotel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `htlfac157896_role`
--

CREATE TABLE `htlfac157896_role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `caption` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `htlfac157896_role`
--

INSERT INTO `htlfac157896_role` (`id`, `caption`) VALUES
(1, 'admin'),
(2, 'user'),
(3, 'moderator'),
(4, 'inactive'),
(5, 'client');

-- --------------------------------------------------------

--
-- Structure de la table `htlfac157896_room`
--

CREATE TABLE `htlfac157896_room` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  `idHotel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `htlfac157896_room_user`
--

CREATE TABLE `htlfac157896_room_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idRoom` int(11) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `htlfac157896_service`
--

CREATE TABLE `htlfac157896_service` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  `idHotel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `htlfac157896_service_user`
--

CREATE TABLE `htlfac157896_service_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idService` int(11) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `htlfac157896_type_equipment`
--

CREATE TABLE `htlfac157896_type_equipment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `htlfac157896_type_equipment`
--

INSERT INTO `htlfac157896_type_equipment` (`id`, `name`, `description`) VALUES
(1, 'Chambre', 'Equipement dans la chambre'),
(2, 'Divertissement', 'Equipement de divertissement'),
(3, 'Salle de bain', 'Equipement dans la salle de bain'),
(4, 'Autres', 'Equipement autres');

-- --------------------------------------------------------

--
-- Structure de la table `htlfac157896_user`
--

CREATE TABLE `htlfac157896_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(80) DEFAULT NULL,
  `password` varchar(80) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `firstname` varchar(30) DEFAULT NULL,
  `birthdate` date NOT NULL,
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idHfRole` int(11) NOT NULL DEFAULT '2',
  `idHfCompany` int(11) DEFAULT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `htlfac157896_user`
--

INSERT INTO `htlfac157896_user` (`id`, `email`, `password`, `name`, `firstname`, `birthdate`, `creationDate`, `idHfRole`, `idHfCompany`, `token`) VALUES
(52, 'quintasmarie@gmail.com', '81ee8dd6ae54f1b8da004f2582ff8361', 'QUINTAS', 'Marie', '1998-02-19', '2020-07-02 21:43:53', 1, NULL, '0'),
(53, 'sarah.oztas96@gmail.com', '552235b7d316b2ffae5d349d52b54c73', 'OZTAS', 'Sarah', '1996-04-04', '2020-07-02 21:46:19', 1, NULL, '0'),
(54, 'elemee@gmail.com', 'ddc7f49bd02999672c1794fff6ec6bdf', 'LEMEE', 'Ewan', '1998-11-21', '2020-07-02 21:48:53', 3, NULL, '0'),
(55, 'jmello@gmail.com', 'dc5c59f6c6fde685900c60d9cc7337a8', 'MELLO', 'Julien', '1988-09-13', '2020-07-02 21:53:17', 3, NULL, '0'),
(56, 'ellendupont@gmail.com', 'aeb9404ad3fcaacb2a00f46de9cd3bef', 'DUPONT', 'Ellen', '1996-12-03', '2020-07-02 22:01:33', 2, NULL, '0'),
(57, 'hstyles@gmail.com', 'd7d91b9bd140737cc1064eb6acade4bf', 'STYLES', 'Harry', '1994-02-01', '2020-07-02 22:06:02', 4, NULL, '0');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `htlfac157896_bed`
--
ALTER TABLE `htlfac157896_bed`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `htlfac157896_client_comment`
--
ALTER TABLE `htlfac157896_client_comment`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `htlfac157896_comment`
--
ALTER TABLE `htlfac157896_comment`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `htlfac157896_company`
--
ALTER TABLE `htlfac157896_company`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `htlfac157896_equipment`
--
ALTER TABLE `htlfac157896_equipment`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `htlfac157896_equipment_room`
--
ALTER TABLE `htlfac157896_equipment_room`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `htlfac157896_equipment_user`
--
ALTER TABLE `htlfac157896_equipment_user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `htlfac157896_faq_answer`
--
ALTER TABLE `htlfac157896_faq_answer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `htlfac157896_faq_question`
--
ALTER TABLE `htlfac157896_faq_question`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `htlfac157896_hotel`
--
ALTER TABLE `htlfac157896_hotel`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `htlfac157896_reservation`
--
ALTER TABLE `htlfac157896_reservation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `htlfac157896_role`
--
ALTER TABLE `htlfac157896_role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `htlfac157896_room`
--
ALTER TABLE `htlfac157896_room`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `htlfac157896_room_user`
--
ALTER TABLE `htlfac157896_room_user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `htlfac157896_service`
--
ALTER TABLE `htlfac157896_service`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `htlfac157896_service_user`
--
ALTER TABLE `htlfac157896_service_user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `htlfac157896_type_equipment`
--
ALTER TABLE `htlfac157896_type_equipment`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `htlfac157896_user`
--
ALTER TABLE `htlfac157896_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `htlfac157896_bed`
--
ALTER TABLE `htlfac157896_bed`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `htlfac157896_client_comment`
--
ALTER TABLE `htlfac157896_client_comment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `htlfac157896_comment`
--
ALTER TABLE `htlfac157896_comment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `htlfac157896_company`
--
ALTER TABLE `htlfac157896_company`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `htlfac157896_equipment`
--
ALTER TABLE `htlfac157896_equipment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `htlfac157896_equipment_room`
--
ALTER TABLE `htlfac157896_equipment_room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `htlfac157896_equipment_user`
--
ALTER TABLE `htlfac157896_equipment_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `htlfac157896_faq_answer`
--
ALTER TABLE `htlfac157896_faq_answer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `htlfac157896_faq_question`
--
ALTER TABLE `htlfac157896_faq_question`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `htlfac157896_hotel`
--
ALTER TABLE `htlfac157896_hotel`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `htlfac157896_reservation`
--
ALTER TABLE `htlfac157896_reservation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `htlfac157896_role`
--
ALTER TABLE `htlfac157896_role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `htlfac157896_room`
--
ALTER TABLE `htlfac157896_room`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `htlfac157896_room_user`
--
ALTER TABLE `htlfac157896_room_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `htlfac157896_service`
--
ALTER TABLE `htlfac157896_service`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `htlfac157896_service_user`
--
ALTER TABLE `htlfac157896_service_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `htlfac157896_type_equipment`
--
ALTER TABLE `htlfac157896_type_equipment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `htlfac157896_user`
--
ALTER TABLE `htlfac157896_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
