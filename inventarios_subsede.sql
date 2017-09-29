-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-09-2017 a las 21:02:37
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventarios_subsede`
--
CREATE DATABASE IF NOT EXISTS `inventarios_subsede` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `inventarios_subsede`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cellar`
--

CREATE TABLE `cellar` (
  `id_cellar` int(11) NOT NULL,
  `name_cellar` varchar(50) NOT NULL,
  `description_cellar` varchar(100) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cellar`
--

INSERT INTO `cellar` (`id_cellar`, `name_cellar`, `description_cellar`, `date_create`) VALUES
(1, 'Fruver', 'Bodega Frutas y verduras', '2017-08-06 18:46:02'),
(2, 'Lacteos', 'Bodega lacteos', '2017-08-06 18:46:02'),
(3, 'Carnicos', 'Bodega carnicos', '2017-08-06 18:46:36'),
(4, 'Insumos', 'Bodega Insumos', '2017-08-06 18:46:36'),
(5, 'Equipos', 'Bodega equipos', '2017-08-06 18:47:46'),
(6, 'Herramientas', 'Bodega Herramientas', '2017-08-06 18:47:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipments`
--

CREATE TABLE `equipments` (
  `id_equipment` int(11) NOT NULL,
  `name_equipment` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `mark` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `total_quantity` int(15) NOT NULL,
  `quantity_available` int(15) NOT NULL,
  `id_cellar` int(11) NOT NULL,
  `id_user_create` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `equipments`
--

INSERT INTO `equipments` (`id_equipment`, `name_equipment`, `mark`, `total_quantity`, `quantity_available`, `id_cellar`, `id_user_create`) VALUES
(1, 'pala', 'ola', 2, 2, 6, 7),
(2, 'lazos', 'buenos', 2, 2, 5, 7),
(3, 'llaves', 'yei', 24, 24, 5, 7),
(6, 'prue', 'prue', 1, 2, 6, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exit_equipment_master`
--

CREATE TABLE `exit_equipment_master` (
  `id_exit` int(11) NOT NULL,
  `id_user_receives` int(11) NOT NULL,
  `id_user_delivery` int(11) NOT NULL,
  `delivery` tinyint(1) NOT NULL DEFAULT '1',
  `received` tinyint(1) NOT NULL DEFAULT '0',
  `delivery_note` text COLLATE utf8_spanish_ci NOT NULL,
  `note_received` text COLLATE utf8_spanish_ci NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exit_product_master`
--

CREATE TABLE `exit_product_master` (
  `id_exit_product` int(11) NOT NULL,
  `user_delivery` int(11) NOT NULL,
  `user_receives` int(11) NOT NULL,
  `destination` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `delivery` tinyint(1) NOT NULL DEFAULT '1',
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exit_teams_detall`
--

CREATE TABLE `exit_teams_detall` (
  `id_exit_detall` int(11) NOT NULL,
  `id_exit` int(11) NOT NULL,
  `id_equipment` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `measure`
--

CREATE TABLE `measure` (
  `id_measure` int(11) NOT NULL,
  `name_measure` varchar(20) NOT NULL,
  `prefix_measure` varchar(6) NOT NULL,
  `id_user_create` int(11) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `measure`
--

INSERT INTO `measure` (`id_measure`, `name_measure`, `prefix_measure`, `id_user_create`, `date_create`) VALUES
(1, 'Kilogramo', 'Kg', 7, '2017-08-17 01:55:03'),
(2, 'Libra', 'Lb', 7, '2017-08-17 01:06:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id_product` int(11) NOT NULL,
  `name_product` varchar(100) NOT NULL,
  `description_product` varchar(250) NOT NULL,
  `unit_measure` varchar(20) NOT NULL,
  `id_user_create` int(11) NOT NULL,
  `id_cellar` int(11) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id_product`, `name_product`, `description_product`, `unit_measure`, `id_user_create`, `id_cellar`, `creation_date`) VALUES
(1, 'Carne de res', 'carne roja Medellin', '1', 7, 6, '2017-08-31 03:23:54'),
(5, 'Carne de Cerdo', 'Carne Blanca ', '1', 7, 3, '2017-08-31 03:24:07'),
(7, 'Leche Liquida', 'Bosas de Leche Liquida', '1', 7, 2, '2017-08-17 01:06:51'),
(8, 'Sandia', 'ñleche', '2', 7, 1, '2017-09-29 02:11:50'),
(9, 'Savila', 'Savila', '2', 7, 1, '2017-09-29 03:29:05'),
(10, 'Mango', 'mango', '1', 7, 1, '2017-09-29 03:28:51'),
(11, 'Fresas', 'Fresas', '1', 7, 1, '2017-09-29 03:30:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recover_password`
--

CREATE TABLE `recover_password` (
  `id_recover` int(11) NOT NULL,
  `code_recover` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `email_user` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `recover_password`
--

INSERT INTO `recover_password` (`id_recover`, `code_recover`, `email_user`, `fecha_creacion`) VALUES
(3, 'A20778G', 'd4n7elfelipe@gmail.com', '2017-09-08 02:37:56'),
(4, 'H785905E', 'd4n7elfelipe@gmail.com', '2017-09-28 20:26:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_role` int(11) NOT NULL,
  `name_rol` varchar(20) NOT NULL,
  `description_role` varchar(50) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_role`, `name_rol`, `description_role`, `level`) VALUES
(1, 'Super Usuario', 'hace de todo', 'A_A-a_1'),
(2, 'Bodegero', 'Encargado de bodegas', 'B_1-b_1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock`
--

CREATE TABLE `stock` (
  `id_stock` int(11) NOT NULL,
  `id_cellar` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `nom_lot` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `expiration_date` date NOT NULL,
  `expiration_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comercializadora` varchar(100) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `stock`
--

INSERT INTO `stock` (`id_stock`, `id_cellar`, `id_product`, `nom_lot`, `amount`, `expiration_date`, `expiration_create`, `comercializadora`) VALUES
(9, 1, 8, '4638rew', 100, '2017-09-30', '2017-09-29 03:35:55', 'fresh'),
(10, 1, 10, '547839ire', 45, '2017-10-13', '2017-09-29 03:36:52', 'Mng'),
(11, 1, 9, '3443892ojd', 30, '2017-11-18', '2017-09-29 03:37:27', 'frsh'),
(12, 1, 11, '3948743im', 300, '2017-10-31', '2017-09-29 03:39:53', 'fresh');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tools`
--

CREATE TABLE `tools` (
  `id_tool` int(11) NOT NULL,
  `name_tool` varchar(20) NOT NULL,
  `mark` varchar(15) NOT NULL,
  `total_quantity` int(4) NOT NULL,
  `quantity_available` int(4) NOT NULL,
  `id_cellar` int(11) NOT NULL,
  `id_user_create` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tools`
--

INSERT INTO `tools` (`id_tool`, `name_tool`, `mark`, `total_quantity`, `quantity_available`, `id_cellar`, `id_user_create`) VALUES
(16, 'fd', 'dhdhdhdhdhd', 3, 1, 6, 18),
(17, 'fds', 're', 3, 1, 6, 7),
(18, 'jhgg', 'dff', 45, 2, 2, 18),
(19, 'martillo', 'Acme', 30, 10, 6, 18),
(21, 'cocos de cafe', 'la doce', 4, 4, 6, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `name_user` varchar(50) NOT NULL,
  `last_name_user` varchar(50) NOT NULL,
  `email_user` text NOT NULL,
  `cedula` varchar(50) NOT NULL,
  `pass` text NOT NULL,
  `id_cellar` int(11) NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id_user`, `name_user`, `last_name_user`, `email_user`, `cedula`, `pass`, `id_cellar`, `id_role`) VALUES
(7, 'Daniel Felipe', 'Zamora Ortiz', 'd4n7elfelipe@gmail.com', '123456789', '$2y$10$MbgK/SGQWmmh1uEpHtC3WeySu5VfCYSbF42hyi/IBaS5TMIgiXFGG', 2, 1),
(15, 'Stefania', 'Casas', 'Ecasas05@misena.edu.co', '1093227968', '$2y$10$fi/ObWvWDHI8qOItzyf1..J.WmBk6YnMOVAeATY8NJPotQYZUQJcq', 3, 1),
(16, 'Pedro', 'Triviño', 'pnmontealegre@misena.edu.co', '1225092661', '$2y$10$eYo1Chuil/FLsTMRsBbHDeL3PBqbPX9Kif7XJUJEnqLg2oub6YvdO', 4, 1),
(17, 'Yeison', 'Londoño Tabarez', 'yeiko1022@hotmail.com', '1088347434', '$2y$10$FFTBYqNzlEJC4pVWqM/6MehsSgVQj1jYeOaLtvZwxkKCboD8qy/0K', 4, 1),
(18, 'Julio Cesar', 'Guapacha ', 'jcguapacha2@misena.edu.co', '1088299682', '$2y$10$V//tBsKlFLY8pyF83XJgR.fd7NXWbHw3vs6GM3WN7CYnwrAbAS.h2', 5, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cellar`
--
ALTER TABLE `cellar`
  ADD PRIMARY KEY (`id_cellar`),
  ADD UNIQUE KEY `name_cellar` (`name_cellar`);

--
-- Indices de la tabla `equipments`
--
ALTER TABLE `equipments`
  ADD PRIMARY KEY (`id_equipment`),
  ADD KEY `id_cellar` (`id_cellar`),
  ADD KEY `id_user_create` (`id_user_create`);

--
-- Indices de la tabla `exit_equipment_master`
--
ALTER TABLE `exit_equipment_master`
  ADD PRIMARY KEY (`id_exit`),
  ADD KEY `id_user_receives` (`id_user_receives`);
ALTER TABLE `exit_equipment_master` ADD FULLTEXT KEY `delivery_note` (`delivery_note`);
ALTER TABLE `exit_equipment_master` ADD FULLTEXT KEY `note_received` (`note_received`);

--
-- Indices de la tabla `exit_product_master`
--
ALTER TABLE `exit_product_master`
  ADD PRIMARY KEY (`id_exit_product`);

--
-- Indices de la tabla `exit_teams_detall`
--
ALTER TABLE `exit_teams_detall`
  ADD PRIMARY KEY (`id_exit_detall`),
  ADD KEY `id_exit` (`id_exit`),
  ADD KEY `id_equipment` (`id_equipment`);

--
-- Indices de la tabla `measure`
--
ALTER TABLE `measure`
  ADD PRIMARY KEY (`id_measure`),
  ADD UNIQUE KEY `prefix_measure` (`prefix_measure`),
  ADD UNIQUE KEY `name_measure` (`name_measure`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`),
  ADD UNIQUE KEY `name_product` (`name_product`),
  ADD KEY `id_user_create` (`id_user_create`),
  ADD KEY `id_cellar` (`id_cellar`);
ALTER TABLE `products` ADD FULLTEXT KEY `description_product` (`description_product`);

--
-- Indices de la tabla `recover_password`
--
ALTER TABLE `recover_password`
  ADD PRIMARY KEY (`id_recover`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_role`),
  ADD UNIQUE KEY `name_rol` (`name_rol`),
  ADD UNIQUE KEY `level` (`level`);

--
-- Indices de la tabla `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id_stock`);

--
-- Indices de la tabla `tools`
--
ALTER TABLE `tools`
  ADD PRIMARY KEY (`id_tool`),
  ADD KEY `id_bodega` (`id_cellar`),
  ADD KEY `id_user` (`id_user_create`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `cedula` (`cedula`),
  ADD KEY `id_cellar` (`id_cellar`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cellar`
--
ALTER TABLE `cellar`
  MODIFY `id_cellar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `equipments`
--
ALTER TABLE `equipments`
  MODIFY `id_equipment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `exit_equipment_master`
--
ALTER TABLE `exit_equipment_master`
  MODIFY `id_exit` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `exit_product_master`
--
ALTER TABLE `exit_product_master`
  MODIFY `id_exit_product` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `exit_teams_detall`
--
ALTER TABLE `exit_teams_detall`
  MODIFY `id_exit_detall` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `measure`
--
ALTER TABLE `measure`
  MODIFY `id_measure` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `recover_password`
--
ALTER TABLE `recover_password`
  MODIFY `id_recover` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `stock`
--
ALTER TABLE `stock`
  MODIFY `id_stock` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `tools`
--
ALTER TABLE `tools`
  MODIFY `id_tool` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `equipments`
--
ALTER TABLE `equipments`
  ADD CONSTRAINT `equipments_ibfk_1` FOREIGN KEY (`id_cellar`) REFERENCES `cellar` (`id_cellar`) ON UPDATE CASCADE,
  ADD CONSTRAINT `equipments_ibfk_2` FOREIGN KEY (`id_user_create`) REFERENCES `user` (`id_user`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `exit_equipment_master`
--
ALTER TABLE `exit_equipment_master`
  ADD CONSTRAINT `exit_equipment_master_ibfk_1` FOREIGN KEY (`id_user_receives`) REFERENCES `user` (`id_user`);

--
-- Filtros para la tabla `exit_teams_detall`
--
ALTER TABLE `exit_teams_detall`
  ADD CONSTRAINT `exit_teams_detall_ibfk_1` FOREIGN KEY (`id_exit`) REFERENCES `exit_equipment_master` (`id_exit`),
  ADD CONSTRAINT `exit_teams_detall_ibfk_2` FOREIGN KEY (`id_equipment`) REFERENCES `equipments` (`id_equipment`);

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id_user_create`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`id_cellar`) REFERENCES `cellar` (`id_cellar`);

--
-- Filtros para la tabla `tools`
--
ALTER TABLE `tools`
  ADD CONSTRAINT `tools_ibfk_1` FOREIGN KEY (`id_cellar`) REFERENCES `cellar` (`id_cellar`),
  ADD CONSTRAINT `tools_ibfk_2` FOREIGN KEY (`id_user_create`) REFERENCES `user` (`id_user`);

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_cellar`) REFERENCES `cellar` (`id_cellar`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id_role`);
