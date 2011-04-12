-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Mar 12 Avril 2011 à 17:55
-- Version du serveur: 5.1.44
-- Version de PHP: 5.2.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `influence_networks`
--

--
-- Contenu de la table `inf_relation_type`
--

INSERT INTO `inf_relation_type` VALUES(1, NULL, 'Friends');
INSERT INTO `inf_relation_type` VALUES(2, NULL, 'Rivals');
INSERT INTO `inf_relation_type` VALUES(3, NULL, 'Colleagues');
INSERT INTO `inf_relation_type` VALUES(4, NULL, 'Commercial relation');
INSERT INTO `inf_relation_type` VALUES(5, NULL, 'Ownership');
INSERT INTO `inf_relation_type` VALUES(6, NULL, 'Classmates');
INSERT INTO `inf_relation_type` VALUES(7, NULL, 'Marriage');
INSERT INTO `inf_relation_type` VALUES(8, NULL, 'Love Affair');
INSERT INTO `inf_relation_type` VALUES(9, NULL, 'Family relationship');
INSERT INTO `inf_relation_type` VALUES(10, NULL, 'Membership');
INSERT INTO `inf_relation_type` VALUES(11, NULL, 'Other relationship');
INSERT INTO `inf_relation_type` VALUES(12, NULL, 'Attendance');

--
-- Contenu de la table `inf_relation_type_property`
--

INSERT INTO `inf_relation_type_property` VALUES(1, 1, 'From', NULL);
INSERT INTO `inf_relation_type_property` VALUES(2, 1, 'Comment', NULL);
INSERT INTO `inf_relation_type_property` VALUES(3, 1, 'Source', NULL);
INSERT INTO `inf_relation_type_property` VALUES(4, 2, 'From', NULL);
INSERT INTO `inf_relation_type_property` VALUES(5, 2, 'Comment', NULL);
INSERT INTO `inf_relation_type_property` VALUES(6, 2, 'Source', NULL);
INSERT INTO `inf_relation_type_property` VALUES(7, 3, 'From', NULL);
INSERT INTO `inf_relation_type_property` VALUES(8, 3, 'To', NULL);
INSERT INTO `inf_relation_type_property` VALUES(9, 3, 'Organization', NULL);
INSERT INTO `inf_relation_type_property` VALUES(10, 3, 'City', NULL);
INSERT INTO `inf_relation_type_property` VALUES(11, 3, 'Comment', NULL);
INSERT INTO `inf_relation_type_property` VALUES(12, 3, 'Source', NULL);
INSERT INTO `inf_relation_type_property` VALUES(13, 4, 'From', NULL);
INSERT INTO `inf_relation_type_property` VALUES(14, 4, 'To', NULL);
INSERT INTO `inf_relation_type_property` VALUES(15, 4, 'Work description', NULL);
INSERT INTO `inf_relation_type_property` VALUES(16, 4, 'Comment', NULL);
INSERT INTO `inf_relation_type_property` VALUES(17, 4, 'Source', NULL);
INSERT INTO `inf_relation_type_property` VALUES(18, 5, 'From', NULL);
INSERT INTO `inf_relation_type_property` VALUES(19, 5, 'To', NULL);
INSERT INTO `inf_relation_type_property` VALUES(20, 5, 'Transaction amount in EUR', NULL);
INSERT INTO `inf_relation_type_property` VALUES(21, 5, 'Comment', NULL);
INSERT INTO `inf_relation_type_property` VALUES(22, 5, 'Source', NULL);
INSERT INTO `inf_relation_type_property` VALUES(23, 6, 'From', NULL);
INSERT INTO `inf_relation_type_property` VALUES(24, 6, 'To', NULL);
INSERT INTO `inf_relation_type_property` VALUES(25, 6, 'Educational Institution', NULL);
INSERT INTO `inf_relation_type_property` VALUES(26, 6, 'City', NULL);
INSERT INTO `inf_relation_type_property` VALUES(27, 6, 'Comment', NULL);
INSERT INTO `inf_relation_type_property` VALUES(28, 6, 'Source', NULL);
INSERT INTO `inf_relation_type_property` VALUES(29, 7, 'From', NULL);
INSERT INTO `inf_relation_type_property` VALUES(30, 7, 'To', NULL);
INSERT INTO `inf_relation_type_property` VALUES(31, 7, 'Wedding venue', NULL);
INSERT INTO `inf_relation_type_property` VALUES(32, 7, 'Comment', NULL);
INSERT INTO `inf_relation_type_property` VALUES(33, 7, 'Source', NULL);
INSERT INTO `inf_relation_type_property` VALUES(34, 8, 'From', NULL);
INSERT INTO `inf_relation_type_property` VALUES(35, 8, 'To', NULL);
INSERT INTO `inf_relation_type_property` VALUES(36, 8, 'Comment', NULL);
INSERT INTO `inf_relation_type_property` VALUES(37, 8, 'Source', NULL);
INSERT INTO `inf_relation_type_property` VALUES(38, 9, 'Relationship degree', NULL);
INSERT INTO `inf_relation_type_property` VALUES(39, 9, 'Comment', NULL);
INSERT INTO `inf_relation_type_property` VALUES(40, 9, 'Source', NULL);
INSERT INTO `inf_relation_type_property` VALUES(41, 10, 'Comment', NULL);
INSERT INTO `inf_relation_type_property` VALUES(42, 10, 'Source', NULL);
INSERT INTO `inf_relation_type_property` VALUES(44, 10, 'From', NULL);
INSERT INTO `inf_relation_type_property` VALUES(45, 10, 'To', NULL);
INSERT INTO `inf_relation_type_property` VALUES(46, 10, 'Organization', NULL);
INSERT INTO `inf_relation_type_property` VALUES(47, 11, 'Comment', NULL);
INSERT INTO `inf_relation_type_property` VALUES(48, 11, 'Source', NULL);
INSERT INTO `inf_relation_type_property` VALUES(49, 12, 'Comment', NULL);
INSERT INTO `inf_relation_type_property` VALUES(50, 12, 'Source', NULL);
INSERT INTO `inf_relation_type_property` VALUES(51, 12, 'Date', NULL);
INSERT INTO `inf_relation_type_property` VALUES(52, 12, 'Event name', NULL);
INSERT INTO `inf_relation_type_property` VALUES(53, 12, 'City', NULL);
