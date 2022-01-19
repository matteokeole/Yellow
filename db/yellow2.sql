-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 18 jan. 2022 à 19:31
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `yellow`
--

-- --------------------------------------------------------

--
-- Structure de la table `basket`
--

CREATE TABLE `basket` (
  `basket_id` varchar(250) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `content`
--

CREATE TABLE `content` (
  `product_id` int(11) NOT NULL,
  `basket_id` varchar(250) NOT NULL,
  `content_product_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_admin` int(11) NOT NULL,
  `customer_first_name` varchar(250) NOT NULL,
  `customer_last_name` varchar(250) NOT NULL,
  `customer_email` varchar(250) NOT NULL,
  `customer_phone` varchar(250) NOT NULL,
  `customer_password` varchar(250) NOT NULL,
  `customer_address` varchar(250) NOT NULL,
  `customer_post_code` varchar(250) NOT NULL,
  `customer_city` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `order_content` varchar(250) NOT NULL,
  `order_date` date NOT NULL,
  `order_total` varchar(250) NOT NULL,
  `order_status` int(11) NOT NULL,
  `basket_id` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(250) NOT NULL,
  `product_author` varchar(250) NOT NULL,
  `product_date` date NOT NULL,
  `product_desc` text NOT NULL,
  `product_cover` varchar(250) NOT NULL,
  `product_price` varchar(250) NOT NULL,
  `product_stock` int(11) NOT NULL,
  `product_category` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`basket_id`),
  ADD UNIQUE KEY `basket_customer_AK` (`customer_id`);

--
-- Index pour la table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`product_id`,`basket_id`),
  ADD KEY `content_basket0_FK` (`basket_id`);

--
-- Index pour la table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Index pour la table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `purchase_basket_AK` (`basket_id`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `basket`
--
ALTER TABLE `basket`
  ADD CONSTRAINT `basket_customer_FK` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Contraintes pour la table `content`
--
ALTER TABLE `content`
  ADD CONSTRAINT `content_basket0_FK` FOREIGN KEY (`basket_id`) REFERENCES `basket` (`basket_id`),
  ADD CONSTRAINT `content_product_FK` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Contraintes pour la table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `purchase_basket_FK` FOREIGN KEY (`basket_id`) REFERENCES `basket` (`basket_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
