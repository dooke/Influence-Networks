-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Dim 10 Avril 2011 à 18:01
-- Version du serveur: 5.1.44
-- Version de PHP: 5.2.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `influence_networks`
--

-- --------------------------------------------------------

--
-- Content of table `inf_relation_type`
--

INSERT INTO `inf_relation_type` (`id`, `freebase_id`, `label`) VALUES
(1, NULL, 'Friends'),
(2, NULL, 'Rivals'),
(3, NULL, 'Colleagues'),
(4, NULL, 'Commercial relation'),
(5, NULL, 'Ownership'),
(6, NULL, 'Classmates'),
(7, NULL, 'Marriage'),
(8, NULL, 'Love Affair'),
(9, NULL, 'Family relationship');
--
-- Content of table `inf_relation_type_property`
--

INSERT INTO `inf_relation_type_property` (`id`, `type`, `label`, `freebase_id`) VALUES
(1, 1, 'From', NULL),
(2, 1, 'Comment', NULL),
(3, 1, 'Source', NULL),
(4, 2, 'From', NULL),
(5, 2, 'Comment', NULL),
(6, 2, 'Source', NULL),
(7, 3, 'From', NULL),
(8, 3, 'To', NULL),
(9, 3, 'Organization', NULL),
(10, 3, 'City', NULL),
(11, 3, 'Comment', NULL),
(12, 3, 'Source', NULL),
(13, 4, 'From', NULL),
(14, 4, 'To', NULL),
(15, 4, 'Work description', NULL),
(16, 4, 'Comment', NULL),
(17, 4, 'Source', NULL),
(18, 5, 'From', NULL),
(19, 5, 'To', NULL),
(20, 5, 'Transaction amount in EUR', NULL),
(21, 5, 'Comment', NULL),
(22, 5, 'Source', NULL),
(23, 6, 'From', NULL),
(24, 6, 'To', NULL),
(25, 6, 'Educational Institution', NULL),
(26, 6, 'City', NULL),
(27, 6, 'Comment', NULL),
(28, 6, 'Source', NULL),
(29, 7, 'From', NULL),
(30, 7, 'To', NULL),
(31, 7, 'Wedding venue', NULL),
(32, 7, 'Comment', NULL),
(33, 7, 'Source', NULL),
(34, 8, 'From', NULL),
(35, 8, 'To', NULL),
(36, 8, 'Comment', NULL),
(37, 8, 'Source', NULL),
(38, 9, 'Relationship degree', NULL),
(39, 9, 'Comment', NULL),
(40, 9, 'Source', NULL);
