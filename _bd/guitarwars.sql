--
-- Base de données: `guitarwars`
--

-- --------------------------------------------------------

--
-- Structure de la table `score`
--

CREATE TABLE IF NOT EXISTS `score` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nom` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `screenshot` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `valider` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `nom` (`nom`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=38 ;

--
-- Contenu de la table `score`
--

INSERT INTO `score` (`id`, `date`, `nom`, `score`, `screenshot`, `valider`) VALUES
(1, '2012-05-22 12:37:34', 'Jean Némarre', 127650, NULL, 0),
(2, '2012-05-22 19:27:54', 'Laure Dinateur', 98430, NULL, 0),
(3, '2012-05-23 07:06:35', 'Sandra Samegratte', 345900, NULL, 0),
(4, '2012-05-23 07:12:53', 'Yves Remor', 282470, NULL, 0),
(5, '2012-05-23 07:13:34', 'Ali Gator', 368420, NULL, 0),
(6, '2012-05-23 12:09:50', 'Ella Danloss', 64930, NULL, 0),
(7, '2012-05-16 12:06:17', 'Belitac', 282470, 'belitasscore.gif', 1),
(8, '2012-05-16 12:07:28', 'BIFFJ', 314340, 'biffsscore.gif', 1),
(10, '2012-05-16 12:09:16', 'Jacob Scorcherson', 389740, 'jacobsscore.gif', 1),
(11, '2012-05-16 12:10:25', 'Jean-Paul Jones', 243260, 'jeanpaulsscore.gif', 1);