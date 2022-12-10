-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 29-09-2022 a las 19:22:19
-- Versión del servidor: 5.7.36
-- Versión de PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ecommerce`
--
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `providers`
--
CREATE DATABASE ecommerce;
use ecommerce;
DROP TABLE IF EXISTS `providers`;
CREATE TABLE IF NOT EXISTS `providers` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  constraint pk_providers PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shippings`
--

DROP TABLE IF EXISTS `shippings`;
CREATE TABLE IF NOT EXISTS `shippings` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  constraint pk_shippings PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `remember_token` varchar(255) NOT NULL,
  constraint pk_users PRIMARY KEY (`id`),
  constraint uq_email UNIQUE KEY(`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  constraint pk_categories PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `shipping_id` int(255) NOT NULL,
  `address` text NOT NULL,
  `reference` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `cell_phone` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  constraint pk_orders PRIMARY KEY (`id`),
  constraint fk_order_user FOREIGN KEY(`user_id`) REFERENCES users(`id`),
  constraint fk_order_shipping FOREIGN KEY(`shipping_id`) REFERENCES shippings(`id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `category_id` int(255) NOT NULL,
  `name` VARCHAR(255)  NULL,
  `description` text NOT NULL,
  `stock` int(255) NOT NULL,
  `price` int(255) NOT NULL,
  `image_path` varchar(255)  NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  constraint pk_product PRIMARY KEY (`id`),
  constraint fk_product_category FOREIGN KEY(`category_id`) REFERENCES categories(`id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order_user`
--

DROP TABLE IF EXISTS `order_user`;
CREATE TABLE IF NOT EXISTS `order_user` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `order_id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `units` int(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  constraint pk_order_user PRIMARY KEY (`id`),
  constraint fk_order FOREIGN KEY(`order_id`) REFERENCES orders(`id`),
  constraint fk_product FOREIGN KEY(`product_id`) REFERENCES products(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `product_provider`;
CREATE TABLE IF NOT EXISTS `product_provider` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `product_id` int(255) NOT NULL,
  `provider_id` int(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  constraint pk_product_provider PRIMARY KEY (`id`),
  constraint fk_provider_product_provider FOREIGN KEY(`provider_id`) REFERENCES providers(`id`),
  constraint fk_product_product_provider FOREIGN KEY(`product_id`) REFERENCES products(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


insert into categories values(null,'FIGMAS-ARTICULADAS',curdate(),curdate());
insert into categories values(null,'HQS', CURRENT_DATE(), CURRENT_DATE());

insert into categories values(null,'CHIBI',curdate(),curdate());
insert into categories values(null,'GASHAPONS',curdate(),curdate());
insert into providers values(null,'GASHAPONS',curdate(),curdate());

insert into products values(null, 1,'Producto de prueba','description',20,20,'',curdate(),curdate());
