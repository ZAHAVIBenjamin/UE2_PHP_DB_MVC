-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 10 fév. 2026 à 09:00
-- Version du serveur : 11.4.10-MariaDB
-- Version de PHP : 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `roni4736_zahavi_benjamin_ue2`
--

-- --------------------------------------------------------

--
-- Structure de la table `chasseur`
--

CREATE TABLE `chasseur` (
  `numChasseur` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `pseudo` varchar(50) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `newsLetter` tinyint(1) NOT NULL DEFAULT 0,
  `id_role` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `chasseur`
--

INSERT INTO `chasseur` (`numChasseur`, `nom`, `prenom`, `email`, `phone`, `pseudo`, `mdp`, `newsLetter`, `id_role`) VALUES
(1, 'ZAHAVI', 'benjamin', 'Benjamin.zahavi@hotmail.fr', '0626191682', 'sangokussj5', '$2y$10$vRr7OwTzPX7b/v4oB26dZuFj9uM9dRhtURbY1NwbpicDRWgJDeeXS', 1, 2),
(2, 'Brindejonc de tréglodé', 'Karine', 'Karine2a1@gmail.com', '0680824602', 'santa', '$2y$10$TVXxLGAkVkv4bkqzXwiLaeqIhldo6HTCPzqxsFK3zlEGvehD8uX/m', 1, 1),
(3, 'Benfatah', 'Bilal', 'bibi9@gmail.com', '0606060606', 'Bilal.2A', '$2y$10$aOR.U2U77KqmAhoLoqkRL.WiaigR5fW.bvASVONIzYA.1e7RYj6yu', 1, 1),
(5, 'Malerba', 'Sylvain', 'malerba.sylvain2b@gmail.com', '0695891141', 'Sysy', '$2y$10$A97RNToVDxsfBqABk.aHI.ROcS2g1eVv5jlPCKpgnjBgwHURZj0Zi', 0, 1),
(6, 'scb', 'scb', 'scb@scb.fr', '0000000000', 'scb &gt; aca', '$2y$10$ShGKfwB3hcMn.xJYZXBaXewW1N.wnwYYpBqrliNEwSMisoltQ5JJO', 1, 1),
(14, 'allouche', 'pascale', 'pascale.allouche@laposte.net', '06 03 00 36 26', 'palou', '$2y$10$mJKbkjKgSQMUnbQC..T/B.bh/GuVanT2XJPPdaKTs2c8q0/6PUlGa', 1, 1),
(15, 'Gensollen', 'nicolas', 'nicolas.gensollen@aflokkat.com', '0626191564', 'nico', '$2y$10$gCPBJ7eHlYK0UvIJNTkoDeR2IdXt8QGiC9n7xclieMx5A1.Eh88P.', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `etat_de_quete`
--

CREATE TABLE `etat_de_quete` (
  `id_etat` int(11) NOT NULL,
  `nom_etat` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `etat_de_quete`
--

INSERT INTO `etat_de_quete` (`id_etat`, `nom_etat`, `description`) VALUES
(1, 'Dans le panier', 'La quête a été réservée par un chasseur mais pas encore achetée'),
(2, 'Profil', 'La quête appartient au chasseur et attend d être activée'),
(3, 'Quête démarrée', 'Le chasseur est actuellement en train de réaliser la quête'),
(4, 'Quête finie', 'La quête est terminée et le butin a été potentiellement récupéré'),
(6, 'Inconnu', 'État par défaut ou non défini');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id_message` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `texte` text NOT NULL,
  `numChasseur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id_message`, `titre`, `texte`, `numChasseur`) VALUES
(1, 'Probleme avec la quete', 'j&#039;ai un probleme avec la quete j&#039;ai rien compris ', 3),
(2, 'hello', 'bonjur Monsieur \r\nhate de voir la suite de votre jeu et de pouvoir y jouer ', 14),
(3, 'salut ', 'super site !! 20/20', 15);

-- --------------------------------------------------------

--
-- Structure de la table `quete`
--

CREATE TABLE `quete` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `statut` int(11) DEFAULT NULL,
  `composition_tresor` varchar(50) NOT NULL,
  `prix` decimal(15,2) NOT NULL,
  `numChasseur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `quete`
--

INSERT INTO `quete` (`id`, `nom`, `description`, `statut`, `composition_tresor`, `prix`, `numChasseur`) VALUES
(1, 'Machin', 'Une quête mystérieuse', NULL, '150 €', 5.00, NULL),
(2, 'Truc', 'Récupérer l\'objet perdu', NULL, '300 €', 10.00, NULL),
(3, 'Bidul', 'Une épreuve de force', NULL, '450 €', 15.00, NULL),
(4, 'Chouette', 'La quête ultime', NULL, '500 €', 20.00, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `relation_chasseur_quete`
--

CREATE TABLE `relation_chasseur_quete` (
  `numChasseur` int(11) NOT NULL,
  `num_quete` int(11) NOT NULL,
  `id_etat` int(11) NOT NULL,
  `date_mise_en_panier` datetime NOT NULL,
  `date_d_achat` datetime DEFAULT NULL,
  `date_de_commencement_de_la_quete` datetime DEFAULT NULL,
  `date_de_fin_de_la_quete` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `relation_chasseur_quete`
--

INSERT INTO `relation_chasseur_quete` (`numChasseur`, `num_quete`, `id_etat`, `date_mise_en_panier`, `date_d_achat`, `date_de_commencement_de_la_quete`, `date_de_fin_de_la_quete`) VALUES
(3, 3, 3, '2026-02-09 15:01:09', '2026-02-09 15:01:26', '2026-02-09 15:01:53', NULL),
(5, 1, 1, '2026-02-09 15:48:06', NULL, NULL, NULL),
(5, 3, 1, '2026-02-09 15:48:09', NULL, NULL, NULL),
(6, 1, 3, '2026-02-09 16:15:38', '2026-02-09 16:15:47', '2026-02-09 16:16:18', NULL),
(14, 4, 3, '2026-02-09 19:45:48', '2026-02-09 19:46:46', '2026-02-09 19:47:20', NULL),
(15, 1, 2, '2026-02-10 09:23:53', '2026-02-10 09:24:24', NULL, NULL),
(15, 3, 3, '2026-02-10 09:23:55', '2026-02-10 09:24:24', '2026-02-10 09:24:39', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `nomRole` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id_role`, `nomRole`) VALUES
(1, 'chasseur'),
(2, 'administrateur');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `chasseur`
--
ALTER TABLE `chasseur`
  ADD PRIMARY KEY (`numChasseur`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `pseudo` (`pseudo`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD KEY `id_role` (`id_role`);

--
-- Index pour la table `etat_de_quete`
--
ALTER TABLE `etat_de_quete`
  ADD PRIMARY KEY (`id_etat`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id_message`),
  ADD KEY `numChasseur` (`numChasseur`);

--
-- Index pour la table `quete`
--
ALTER TABLE `quete`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom` (`nom`),
  ADD KEY `numChasseur` (`numChasseur`);

--
-- Index pour la table `relation_chasseur_quete`
--
ALTER TABLE `relation_chasseur_quete`
  ADD PRIMARY KEY (`numChasseur`,`num_quete`,`id_etat`),
  ADD KEY `num_quete` (`num_quete`),
  ADD KEY `id_etat` (`id_etat`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `chasseur`
--
ALTER TABLE `chasseur`
  MODIFY `numChasseur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `etat_de_quete`
--
ALTER TABLE `etat_de_quete`
  MODIFY `id_etat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `quete`
--
ALTER TABLE `quete`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `chasseur`
--
ALTER TABLE `chasseur`
  ADD CONSTRAINT `chasseur_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`numChasseur`) REFERENCES `chasseur` (`numChasseur`);

--
-- Contraintes pour la table `quete`
--
ALTER TABLE `quete`
  ADD CONSTRAINT `quete_ibfk_1` FOREIGN KEY (`numChasseur`) REFERENCES `chasseur` (`numChasseur`);

--
-- Contraintes pour la table `relation_chasseur_quete`
--
ALTER TABLE `relation_chasseur_quete`
  ADD CONSTRAINT `relation_chasseur_quete_ibfk_1` FOREIGN KEY (`numChasseur`) REFERENCES `chasseur` (`numChasseur`),
  ADD CONSTRAINT `relation_chasseur_quete_ibfk_2` FOREIGN KEY (`num_quete`) REFERENCES `quete` (`id`),
  ADD CONSTRAINT `relation_chasseur_quete_ibfk_3` FOREIGN KEY (`id_etat`) REFERENCES `etat_de_quete` (`id_etat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
