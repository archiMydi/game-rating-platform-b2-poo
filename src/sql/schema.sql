-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 45.140.165.82
-- Généré le : mar. 13 fév. 2024 à 15:05
-- Version du serveur : 10.11.3-MariaDB-1
-- Version de PHP : 7.3.29-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `s3377_jadenn`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `criterion`
--

CREATE TABLE `criterion` (
  `id` int(11) NOT NULL,
  `name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `criterion`
--

INSERT INTO `criterion` (`id`, `name`) VALUES
(1, 'gameplay'),
(2, 'graphics'),
(3, 'music');

-- --------------------------------------------------------

--
-- Structure de la table `gallery`
--

CREATE TABLE `gallery` (
  `game_id` int(11) NOT NULL,
  `url` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `game`
--

CREATE TABLE `game` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `visuel` text DEFAULT NULL,
  `infos` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `game`
--

INSERT INTO `game` (`id`, `name`, `visuel`, `infos`) VALUES
(1, 'Elden Ring', NULL, 'Jeu d\'aventure développé par FROM SOFTWARE'),
(2, 'Super Mario Galaxy', NULL, 'Jeu de plateforme édité par Nintendo'),
(3, 'Minecraft', NULL, 'Jeu indépendant de craft et de survie'),
(4, 'Persona 5', NULL, 'Jeu de rôle développé par Atlus'),
(5, 'Fortnite', NULL, 'Jeu de Battle Royal édité par Epic Game'),
(6, 'Life is strange', NULL, 'Jeu de Point & Click édité par Dontnod'),
(7, 'Xenoblade Chronicles', NULL, 'Jeu de rôle développé par Monolith Soft'),
(8, 'Doom', NULL, 'Jeu de tir à la première personne édité par Id Software'),
(9, 'The evil within', NULL, 'Jeu de survival horror édité par Bethesda'),
(10, 'Five nights at Freddy\'s', NULL, 'Jeu indépendant de survie');

-- --------------------------------------------------------

--
-- Structure de la table `rating`
--

CREATE TABLE `rating` (
  `criterion_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `value` tinyint(4) NOT NULL
) ;

--
-- Déchargement des données de la table `rating`
--

INSERT INTO `rating` (`criterion_id`, `game_id`, `user_id`, `value`) VALUES
(1, 1, 1, 5),
(1, 3, 1, 5),
(1, 4, 1, 3),
(1, 5, 1, 4),
(1, 7, 1, 2),
(1, 8, 1, 4),
(1, 9, 1, 4),
(1, 10, 1, 4),
(1, 1, 2, 5),
(1, 2, 2, 5),
(1, 3, 2, 4),
(1, 6, 2, 3),
(1, 8, 2, 5),
(1, 9, 2, 5),
(1, 2, 3, 5),
(1, 4, 3, 4),
(1, 5, 3, 5),
(1, 6, 3, 2),
(1, 7, 3, 4),
(1, 10, 3, 3),
(1, 1, 4, 5),
(1, 2, 4, 5),
(1, 3, 4, 3),
(1, 4, 4, 5),
(1, 5, 4, 5),
(1, 6, 4, 1),
(1, 7, 4, 3),
(1, 8, 4, 5),
(1, 9, 4, 5),
(1, 10, 4, 2),
(2, 1, 1, 5),
(2, 3, 1, 3),
(2, 4, 1, 3),
(2, 5, 1, 4),
(2, 7, 1, 4),
(2, 8, 1, 3),
(2, 9, 1, 4),
(2, 10, 1, 2),
(2, 1, 2, 5),
(2, 2, 2, 4),
(2, 3, 2, 2),
(2, 6, 2, 2),
(2, 8, 2, 2),
(2, 9, 2, 4),
(2, 2, 3, 5),
(2, 4, 3, 4),
(2, 5, 3, 3),
(2, 6, 3, 3),
(2, 7, 3, 5),
(2, 10, 3, 2),
(2, 1, 4, 5),
(2, 2, 4, 4),
(2, 3, 4, 3),
(2, 4, 4, 4),
(2, 5, 4, 5),
(2, 6, 4, 2),
(2, 7, 4, 3),
(2, 8, 4, 3),
(2, 9, 4, 5),
(2, 10, 4, 3),
(3, 1, 1, 5),
(3, 3, 1, 5),
(3, 4, 1, 5),
(3, 5, 1, 2),
(3, 7, 1, 4),
(3, 8, 1, 1),
(3, 9, 1, 3),
(3, 10, 1, 4),
(3, 1, 2, 4),
(3, 2, 2, 5),
(3, 3, 2, 4),
(3, 6, 2, 5),
(3, 8, 2, 5),
(3, 9, 2, 5),
(3, 2, 3, 5),
(3, 4, 3, 5),
(3, 5, 3, 1),
(3, 6, 3, 3),
(3, 7, 3, 5),
(3, 10, 3, 1),
(3, 1, 4, 5),
(3, 2, 4, 5),
(3, 3, 4, 5),
(3, 4, 4, 4),
(3, 5, 4, 3),
(3, 6, 4, 4),
(3, 7, 4, 5),
(3, 8, 4, 3),
(3, 9, 4, 5),
(3, 10, 4, 2);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `avatar` text DEFAULT NULL,
  `jeu_fav` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `pseudo`, `password`, `email`, `description`, `avatar`, `jeu_fav`) VALUES
(1, 'enzo', 'password', 'enzo.guillemet@my-digital-school.org', NULL, NULL, NULL),
(2, 'julie', 'password', 'julie.cariou@my-digital-school.org', NULL, NULL, NULL),
(3, 'antoine', 'password', 'antoine.pouyollon@my-digital-school.org', NULL, NULL, NULL),
(4, 'archibald', 'password', 'archibald.venzal@my-digital-school.org', NULL, NULL, NULL),

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_game_id_category` (`game_id`);

--
-- Index pour la table `criterion`
--
ALTER TABLE `criterion`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `gallery`
--
ALTER TABLE `gallery`
  ADD KEY `fk_game_id_gallery` (`game_id`);

--
-- Index pour la table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Index pour la table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`criterion_id`,`user_id`,`game_id`),
  ADD KEY `fk_game_id_rating` (`game_id`),
  ADD KEY `fk_user_id_rating` (`user_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pseudo` (`pseudo`),
  ADD KEY `fk_jeu_fav_user` (`jeu_fav`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `criterion`
--
ALTER TABLE `criterion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `game`
--
ALTER TABLE `game`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `fk_game_id_category` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `gallery`
--
ALTER TABLE `gallery`
  ADD CONSTRAINT `fk_game_id_gallery` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `fk_criterion_id_rating` FOREIGN KEY (`criterion_id`) REFERENCES `criterion` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_game_id_rating` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user_id_rating` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_jeu_fav_user` FOREIGN KEY (`jeu_fav`) REFERENCES `game` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
