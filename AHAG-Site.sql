-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  sam. 15 mai 2021 à 21:44
-- Version du serveur :  10.1.38-MariaDB
-- Version de PHP :  7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `AHAG-Site-DB`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `category` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `category`, `title`, `slug`, `file`, `content`, `created_at`, `updated_at`) VALUES
(1, 1, 'Titre Article 1', 'article-1', 'test-60a01b5ca590e477292253.jpg', 'Contenu de l\'article 1', '2021-05-15 21:05:00', NULL),
(2, 2, 'Titre Article 2', 'titre-article-2', 'test2-60a01b7a7440b204350106.jpg', 'Contenu de l\'article 2', '2021-05-15 21:05:30', NULL),
(3, 1, 'Titre Article 3', 'titre-article-3', 'test2-60a01b8d8b58c569218238.jpg', 'Contenu de l\'article 3', '2021-05-15 21:05:49', NULL),
(4, 1, 'Titre Article 4', 'titre-article-4', 'test-60a01ba13afdf166155085.jpg', 'Contenu de l\'article 4', '2021-05-15 21:06:09', NULL),
(5, 2, 'Titre Article 5', 'titre-article-5', 'test-60a01bb60187f390794527.jpg', 'Contenu de l\'article 5', '2021-05-15 21:06:29', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` longtext,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `title`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Catégorie 1', 'categorie-1', 'Description de la catégorie 1', '2021-05-15 21:02:50', NULL),
(2, 'Catégorie 2', 'categorie-2', NULL, '2021-05-15 21:02:56', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `challenge`
--

CREATE TABLE `challenge` (
  `id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `description` longtext NOT NULL,
  `location` varchar(255) NOT NULL,
  `point` int(11) NOT NULL,
  `progession` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `challenge`
--

INSERT INTO `challenge` (`id`, `session_id`, `name`, `slug`, `file`, `description`, `location`, `point`, `progession`, `created_at`, `updated_at`) VALUES
(1, 1, 'Défi 1', 'defi-1', 'ahag-60a01d5de435c914478820.webp', 'Description du défi 1', 'Maison', 10, NULL, '2021-05-15 21:13:33', NULL),
(2, 1, 'Titre Défi 2', 'titre-defi-2', 'ahag-60a01d7aabbbe894164017.webp', 'Description du défi 2', 'Ville', 15, NULL, '2021-05-15 21:14:02', NULL),
(3, 1, 'Titre Défi 3', 'titre-defi-3', 'ahag-60a01d96031e0057697821.webp', 'Description du défi 3', 'Maison', 10, NULL, '2021-05-15 21:14:29', NULL),
(4, 1, 'Titre Défi 4', 'titre-defi-4', 'ahag-60a01dbe61c84817805334.webp', 'Description défi 4', 'Ville', 5, NULL, '2021-05-15 21:15:10', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `article_id`, `author`, `content`, `created_at`) VALUES
(2, 5, 'SuperAdmin', 'Ceci est un commentaire ! Magnifique !', '2021-05-15 21:08:04');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210515172517', '2021-05-15 17:25:20', 572);

-- --------------------------------------------------------

--
-- Structure de la table `group`
--

CREATE TABLE `group` (
  `id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `owner` varchar(50) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `state` longtext NOT NULL COMMENT '(DC2Type:json)',
  `score` int(11) NOT NULL,
  `token` varchar(10) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `group`
--

INSERT INTO `group` (`id`, `session_id`, `name`, `owner`, `slug`, `state`, `score`, `token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Mon super groupe', 'SuperAdmin', 'mon-super-groupe', '[\"Ouvert\"]', 0, 'c8sKfmzmbE', '2021-05-15 20:43:24', NULL),
(2, 1, 'Le super groupe', 'QTN', 'le-super-groupe', '[\"Ouvert\"]', 0, 'AbDBzktpSx', '2021-05-15 20:49:50', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `group_challenge`
--

CREATE TABLE `group_challenge` (
  `group_id` int(11) NOT NULL,
  `challenge_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `reset_password_request`
--

CREATE TABLE `reset_password_request` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `selector` varchar(20) NOT NULL,
  `hashed_token` varchar(100) NOT NULL,
  `requested_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `expires_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `session`
--

CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `state` longtext NOT NULL COMMENT '(DC2Type:json)',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `session`
--

INSERT INTO `session` (`id`, `name`, `slug`, `file`, `description`, `start_date`, `end_date`, `state`, `created_at`, `updated_at`) VALUES
(1, 'Titre Session 1', 'titre-session-1', 'test-60a016307e8c3708291935.jpg', 'Voici la description de la session 1', '2021-05-19 10:00:00', '2021-06-19 17:00:00', '[\"ouvert\"]', '2021-05-15 20:42:56', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `groups_id` int(11) DEFAULT NULL,
  `email` varchar(180) NOT NULL,
  `username` varchar(255) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `roles` longtext NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `gender` varchar(5) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `country` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `dateofbirth` date NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `groups_id`, `email`, `username`, `file`, `roles`, `password`, `lastname`, `firstname`, `gender`, `address`, `city`, `zip`, `country`, `phone`, `dateofbirth`, `remember_token`, `reset_token`, `is_verified`, `created_at`, `updated_at`) VALUES
(1, 1, 'superadmin_ahag@ahag.com', 'SuperAdmin', NULL, '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$0q4m1or8gBGB+umwUV4JcA$Jjd98Zsy7mNoMkFRMa907a4aBwX4J1FygvTpene6JuI', '', '', '', '', 'Aix-en-provence', '13100', 'FR', '', '0000-00-00', NULL, NULL, 0, '2021-05-15 18:24:58', NULL),
(2, 2, 'quentin.mendel1@gmail.com', 'QTN', NULL, '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$UQKvnVHIN0pKEAwp6Feslw$xL5Rf+r4Q0gvCxS2IUXNT6skd+L44V3kzrcsn8+Z65Y', 'MENDEL', 'Quentin', 'Homme', 'Chemin perdu', 'Aix-en-provence', '13530', 'FR', '0666777667', '2001-06-07', NULL, NULL, 0, '2021-05-15 18:48:36', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_23A0E66989D9B62` (`slug`),
  ADD KEY `IDX_23A0E6664C19C1` (`category`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_64C19C12B36786B` (`title`),
  ADD UNIQUE KEY `UNIQ_64C19C1989D9B62` (`slug`);

--
-- Index pour la table `challenge`
--
ALTER TABLE `challenge`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_D7098951989D9B62` (`slug`),
  ADD KEY `IDX_D7098951613FECDF` (`session_id`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9474526C7294869C` (`article_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_6DC044C5989D9B62` (`slug`),
  ADD KEY `IDX_6DC044C5613FECDF` (`session_id`);

--
-- Index pour la table `group_challenge`
--
ALTER TABLE `group_challenge`
  ADD PRIMARY KEY (`group_id`,`challenge_id`),
  ADD KEY `IDX_17BAD5B0FE54D947` (`group_id`),
  ADD KEY `IDX_17BAD5B098A21AC6` (`challenge_id`);

--
-- Index pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7CE748AA76ED395` (`user_id`);

--
-- Index pour la table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_D044D5D4989D9B62` (`slug`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`),
  ADD KEY `IDX_8D93D649F373DCF` (`groups_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `challenge`
--
ALTER TABLE `challenge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `group`
--
ALTER TABLE `group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `FK_23A0E6664C19C1` FOREIGN KEY (`category`) REFERENCES `category` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `challenge`
--
ALTER TABLE `challenge`
  ADD CONSTRAINT `FK_D7098951613FECDF` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`);

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526C7294869C` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`);

--
-- Contraintes pour la table `group`
--
ALTER TABLE `group`
  ADD CONSTRAINT `FK_6DC044C5613FECDF` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`);

--
-- Contraintes pour la table `group_challenge`
--
ALTER TABLE `group_challenge`
  ADD CONSTRAINT `FK_17BAD5B098A21AC6` FOREIGN KEY (`challenge_id`) REFERENCES `challenge` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_17BAD5B0FE54D947` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD CONSTRAINT `FK_7CE748AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D649F373DCF` FOREIGN KEY (`groups_id`) REFERENCES `group` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
