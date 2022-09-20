-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 20 sep. 2022 à 08:16
-- Version du serveur :  8.0.21
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `p_5`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_post` int NOT NULL,
  `id_utilisateur` int NOT NULL,
  `contenu` text NOT NULL,
  `date` date NOT NULL,
  `valider` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id`, `id_post`, `id_utilisateur`, `contenu`, `date`, `valider`) VALUES
(48, 24, 1, 'testcomenn', '2022-09-20', 1),
(43, 5, 1, 'com article 5', '2022-09-13', 1),
(44, 8, 1, 'article 8', '2022-09-13', 1),
(42, 2, 1, 'COmmentaire article 2', '2022-09-13', 1),
(37, 1, 1, 'eeeee', '2022-09-06', 1),
(46, 2, 17, 'COMMENTAITRER TEST2', '2022-09-20', 1),
(36, 1, 1, 'azer', '2022-09-06', 1),
(49, 25, 1, 'dzqdzq', '2022-09-20', 0);

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `chapo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `contenu` text NOT NULL,
  `id_utilisateur` int NOT NULL,
  `date_maj` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `titre`, `image`, `chapo`, `contenu`, `id_utilisateur`, `date_maj`) VALUES
(1, 'Article 1', 'Image-01-300x300.jpg', 'Le chapô de l\'article', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2022-03-07 23:00:00'),
(2, 'article 2', '136defb907fd26d350e352a7a75f0279.jpg', 'Le chapô de l\'article 2', 'mod Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec pretium gravida condimentum. Mauris et odio pulvinar nulla viverra consectetur. Mauris laoreet lorem nec diam tristique, sit amet elementum nunc eleifend. Integer efficitur cursus posuere. Quisque mi purus, pulvinar vitae hendrerit eu, efficitur sit amet nibh. Vivamus enim justo, sodales in pellentesque eget, imperdiet at lectus. Curabitur condimentum nulla in urna rutrum, eu feugiat tortor accumsan. Maecenas eget congue augue. Integer ut varius lorem. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Mauris rhoncus neque sed elit lacinia sollicitudin. Fusce ornare turpis eget posuere pretium.', 1, '2022-03-18 23:00:00'),
(3, 'article 3', 'Image-01-300x300.jpg', 'Le chapô de l\'article 3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec pretium gravida condimentum. Mauris et odio pulvinar nulla viverra consectetur. Mauris laoreet lorem nec diam tristique, sit amet elementum nunc eleifend. Integer efficitur cursus posuere. Quisque mi purus, pulvinar vitae hendrerit eu, efficitur sit amet nibh. Vivamus enim justo, sodales in pellentesque eget, imperdiet at lectus. Curabitur condimentum nulla in urna rutrum, eu feugiat tortor accumsan. Maecenas eget congue augue. Integer ut varius lorem. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Mauris rhoncus neque sed elit lacinia sollicitudin. Fusce ornare turpis eget posuere pretium.', 1, '2022-03-15 23:00:00'),
(5, 'article 5', 'Image-01-300x300.jpg', 'Le chapô de l\'article 5', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec pretium gravida condimentum. Mauris et odio pulvinar nulla viverra consectetur. Mauris laoreet lorem nec diam tristique, sit amet elementum nunc eleifend. Integer efficitur cursus posuere. Quisque mi purus, pulvinar vitae hendrerit eu, efficitur sit amet nibh. Vivamus enim justo, sodales in pellentesque eget, imperdiet at lectus. Curabitur condimentum nulla in urna rutrum, eu feugiat tortor accumsan. Maecenas eget congue augue. Integer ut varius lorem. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Mauris rhoncus neque sed elit lacinia sollicitudin. Fusce ornare turpis eget posuere pretium.', 1, '2022-03-13 23:00:00'),
(23, 'article test', '3c54c7c1422c686b9823020b46c9c0fd.jpg', 'chapo de la\'(rticle', 'content', 1, '2022-09-20 07:43:28'),
(24, 'titre test', '90a05b10de7ef2ca59ef4f7314435532.jpg', 'chap', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2022-09-20 07:44:02'),
(8, 'article 8', 'Image-01-300x300.jpg', 'Le chapô de l\'article 8', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec pretium gravida condimentum. Mauris et odio pulvinar nulla viverra consectetur. Mauris laoreet lorem nec diam tristique, sit amet elementum nunc eleifend. Integer efficitur cursus posuere. Quisque mi purus, pulvinar vitae hendrerit eu, efficitur sit amet nibh. Vivamus enim justo, sodales in pellentesque eget, imperdiet at lectus. Curabitur condimentum nulla in urna rutrum, eu feugiat tortor accumsan. Maecenas eget congue augue. Integer ut varius lorem. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Mauris rhoncus neque sed elit lacinia sollicitudin. Fusce ornare turpis eget posuere pretium.', 1, '2022-03-01 23:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `role` int NOT NULL,
  `token` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `email`, `mdp`, `role`, `token`) VALUES
(1, 'nom', 'prenom', 'test@email.fr', '$2y$10$hRczz.eEB81l4pm857FRbeSJO87tsjkXf9d.jF9DsUQwGRJDkzKla', 1, 'FHP0mHyVB4RStG7bDrJR/g3Jum1jys7Q+n8E/Mmc3jE='),
(2, 'test', 'tespré', 'email@email.com', '$2y$10$2r5o5Bqc79bcwwy5v6VSnu9FH6FbdjE/xeiBW14tAIUC6BtY1JnSe', 0, '2z/r+YXu2aazk6VR0r6NVoStW4uNW7BomE2k0SQg9h0='),
(17, 'nomtest', 'pretest', 'test@2email.fr', '$2y$10$bGChEbB.4NNtTjQmgQEvoeTJE5WdH5J6ewWgoyLOGLbHbkLos2tUm', 0, 'SD3ObRPhk5okpd8cI2Z5gbApyYc91hmpe0m7lne1baY=');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
