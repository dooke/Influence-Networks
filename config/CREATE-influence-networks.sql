-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Ven 29 Avril 2011 à 22:52
-- Version du serveur: 5.1.44
-- Version de PHP: 5.2.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `influence_networks`
--

-- --------------------------------------------------------
-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Mar 16 Août 2011 à 13:14
-- Version du serveur: 5.1.44
-- Version de PHP: 5.2.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `influence_networks`
--

-- --------------------------------------------------------

--
-- Structure de la table `inf_api_query`
--

CREATE TABLE `inf_api_query` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `IP` varchar(15) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `method` varchar(6) NOT NULL,
  `query` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IP` (`IP`,`date`,`method`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

-- --------------------------------------------------------

--
-- Structure de la table `inf_node`
--

CREATE TABLE `inf_node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `freebase_id` varchar(45) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6549 ;

-- --------------------------------------------------------

--
-- Structure de la table `inf_relation`
--

CREATE TABLE `inf_relation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `node_left` int(11) NOT NULL COMMENT ':= SUJET',
  `node_right` int(11) NOT NULL COMMENT ':= OBJET',
  `creator` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT ':=PREDICAT',
  `trust_level` float DEFAULT NULL,
  `locked` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=731 ;

-- --------------------------------------------------------

--
-- Structure de la table `inf_relation_trust_level`
--

CREATE TABLE `inf_relation_trust_level` (
  `relation_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `trust_level` float DEFAULT NULL,
  PRIMARY KEY (`user_id`,`relation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `inf_relation_type`
--

CREATE TABLE `inf_relation_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `freebase_id` varchar(45) DEFAULT NULL,
  `label` varchar(45) DEFAULT NULL,
  `direction` enum('ltr','rtl','tw') NOT NULL DEFAULT 'tw' COMMENT ':= ''left-to-right''|''right-to-left''|''two-ways''',
  `hint` varchar(255) NOT NULL COMMENT ':= "%1 is or was the owner of %2"',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Structure de la table `inf_relation_type_property`
--

CREATE TABLE `inf_relation_type_property` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `freebase_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=56 ;

-- --------------------------------------------------------

--
-- Structure de la table `inf_relation_value`
--

CREATE TABLE `inf_relation_value` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `property` int(11) NOT NULL,
  `relation` int(11) NOT NULL,
  `value` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2844 ;

-- --------------------------------------------------------

--
-- Structure de la table `inf_user`
--

CREATE TABLE `inf_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(245) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `trust_level` float DEFAULT NULL,
  `pending` tinyint(4) NOT NULL DEFAULT '1',
  `confirmation_code` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=996 ;

-- --------------------------------------------------------
