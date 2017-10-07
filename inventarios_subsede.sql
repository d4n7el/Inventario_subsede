-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:8889
-- Tiempo de generación: 07-10-2017 a las 03:35:41
-- Versión del servidor: 5.6.35
-- Versión de PHP: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `inventarios_subsede`
--
CREATE DATABASE IF NOT EXISTS `inventarios_subsede` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `inventarios_subsede`;
DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_exit_stock` (IN `cantidad` INT(11), IN `idMaster` INT(11), IN `IdDetalle` INT(11), IN `IdUser` INT(11), OUT `retorno` BOOLEAN)  BEGIN
  DECLARE id_stocks INT(11);
  DECLARE cant_stock INT(11);
  DECLARE tipo varchar(50);
  SELECT destination INTO tipo FROM exit_product_master WHERE id_exit_product = idMaster;
  SELECT id_stock INTO id_stocks FROM exit_product_detalle WHERE id_exit_product_detalle = IdDetalle;
  SELECT amount INTO cant_stock FROM stock WHERE id_stock = id_stocks;
    IF cant_stock >= cantidad THEN
      UPDATE exit_product_detalle SET quantity = cantidad WHERE id_exit_product_detalle = IdDetalle;
      UPDATE stock_plant SET quantity = cantidad WHERE id_exit_product = idMaster AND id_stock = id_stocks ;
        SET retorno = 1;
  ELSE
      SET retorno = 0;
    END IF;
END$$

DELIMITER ;

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
  `name_equipment` varchar(100) NOT NULL,
  `mark` varchar(50) NOT NULL,
  `total_quantity` int(15) NOT NULL,
  `quantity_available` int(15) NOT NULL,
  `id_cellar` int(11) NOT NULL,
  `id_user_create` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `equipments`
--

INSERT INTO `equipments` (`id_equipment`, `name_equipment`, `mark`, `total_quantity`, `quantity_available`, `id_cellar`, `id_user_create`) VALUES
(1, 'teve', 'acme', 100, 100, 3, 7);

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
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `exit_equipment_master`
--

INSERT INTO `exit_equipment_master` (`id_exit`, `id_user_receives`, `id_user_delivery`, `delivery`, `received`, `date_create`) VALUES
(1, 12234, 7, 1, 0, '2017-10-05 23:26:19'),
(2, 12234, 7, 1, 0, '2017-10-05 23:28:59'),
(3, 1234, 7, 1, 0, '2017-10-05 23:36:56'),
(4, 1234, 7, 1, 0, '2017-10-05 23:38:02'),
(5, 1234, 7, 1, 0, '2017-10-05 23:41:06'),
(6, 1234, 7, 1, 0, '2017-10-05 23:41:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exit_product_detalle`
--

CREATE TABLE `exit_product_detalle` (
  `id_exit_product_detalle` int(11) NOT NULL,
  `id_exit_product_master` int(11) NOT NULL,
  `id_stock` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `exit_product_detalle`
--

INSERT INTO `exit_product_detalle` (`id_exit_product_detalle`, `id_exit_product_master`, `id_stock`, `quantity`, `note`) VALUES
(50, 110, 13, 10, ''),
(51, 111, 13, 12, 'Bien'),
(52, 112, 13, 20, ''),
(53, 115, 14, 30, 'Fresco'),
(54, 115, 13, 20, 'Roja'),
(55, 116, 14, 20, ''),
(56, 116, 13, 5, ''),
(57, 117, 14, 12, ''),
(58, 117, 13, 20, ''),
(59, 117, 15, 23, ''),
(60, 118, 13, 120, ''),
(61, 119, 15, 2, ''),
(62, 119, 17, 20, 'Tierra'),
(63, 120, 13, 20, 'fresas frescas'),
(64, 129, 13, 44, 'bien'),
(65, 131, 13, 20, 'bien'),
(66, 132, 13, 20, 'bien'),
(67, 133, 13, 46, 'bien'),
(68, 134, 13, 10, 'Fresquisimas'),
(69, 135, 13, 1, 'freqitas');

--
-- Disparadores `exit_product_detalle`
--
DELIMITER $$
CREATE TRIGGER `update_cant_exit_product_detalle` BEFORE UPDATE ON `exit_product_detalle` FOR EACH ROW BEGIN
  DECLARE cantidad INT;
    DECLARE tipo varchar(50);
    SELECT amount iNTO cantidad FROM stock WHERE id_stock = NEW.id_stock;
    SELECT destination INTO tipo FROM exit_product_master WHERE id_exit_product = NEW.id_exit_product_master;
    IF cantidad >= NEW.quantity THEN
      IF OLD.quantity < new.quantity THEN
          UPDATE stock SET amount = amount - (new.quantity - OLD.quantity) WHERE id_stock = NEW.id_stock;
        ELSE
          UPDATE stock SET amount = amount + (OLD.quantity - NEW.quantity) WHERE id_stock = NEW.id_stock;
        END IF;
        IF tipo LIKE "Int" THEN
          UPDATE stock_plant SET quantity = NEW.quantity WHERE id_stock = NEW.id_stock AND id_exit_product = NEW.id_exit_product_master;
        END IF;
   END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_stock_cant` BEFORE INSERT ON `exit_product_detalle` FOR EACH ROW BEGIN
  DECLARE cantidad INT;
    SELECT amount INTO cantidad FROM stock WHERE id_stock = NEW.id_stock;
    if NEW.quantity <= cantidad AND cantidad > 0 THEN
      UPDATE stock SET amount = amount - NEW.quantity WHERE id_stock = NEW.id_stock;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exit_product_master`
--

CREATE TABLE `exit_product_master` (
  `id_exit_product` int(11) NOT NULL,
  `user_delivery` int(11) NOT NULL,
  `user_receives` int(11) NOT NULL,
  `name_receive` varchar(30) NOT NULL,
  `destination` varchar(50) NOT NULL,
  `delivery` tinyint(1) NOT NULL DEFAULT '1',
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `exit_product_master`
--

INSERT INTO `exit_product_master` (`id_exit_product`, `user_delivery`, `user_receives`, `name_receive`, `destination`, `delivery`, `date_create`) VALUES
(110, 7, 12345, 'Santiago Muñoz', 'Ext', 1, '2017-09-30 23:21:24'),
(111, 7, 1234, 'Santiago', 'Ext', 1, '2017-10-03 01:35:27'),
(112, 7, 1234, 'Santiago', 'Ext', 1, '2017-10-03 18:09:38'),
(113, 7, 1234, 'Santiago', 'Int', 1, '2017-10-03 18:51:24'),
(114, 7, 1234, 'Santiago', 'Int', 1, '2017-10-03 18:51:28'),
(115, 7, 1234, 'Santiago', 'Int', 1, '2017-10-03 19:29:00'),
(116, 7, 1234, 'Santiago', 'Int', 1, '2017-10-04 02:02:36'),
(117, 7, 634343434, 'Jhon  Jairo Cuaervo', 'Int', 1, '2017-10-04 02:12:01'),
(118, 7, 1234, 'Santiago', 'Ext', 1, '2017-10-04 20:16:20'),
(119, 7, 1087556331, 'Johanna Marcela Velez Garcia', 'Ext', 1, '2017-10-06 04:57:49'),
(120, 7, 1087556331, 'Johanna Marcela Velez Garcia', 'Int', 1, '2017-10-06 05:06:39'),
(121, 7, 512332323, 'Johanna Marcela Velez Garcia', 'Int', 1, '2017-10-06 23:32:58'),
(122, 7, 512332323, 'Johanna Marcela Velez Garcia', 'Ext', 1, '2017-10-06 23:33:25'),
(123, 7, 512332323, 'Johanna Marcela Velez Garcia', 'Ext', 1, '2017-10-06 23:37:14'),
(124, 7, 512332323, 'Johanna Marcela Velez Garcia', 'Ext', 1, '2017-10-06 23:37:42'),
(125, 7, 512332323, 'Johanna Marcela Velez Garcia', 'Ext', 1, '2017-10-06 23:38:46'),
(126, 7, 512332323, 'Johanna Marcela Velez Garcia', 'Int', 1, '2017-10-06 23:42:08'),
(127, 7, 512332323, 'Johanna Marcela Velez Garcia', 'Int', 1, '2017-10-06 23:42:40'),
(128, 7, 512332323, 'Johanna Marcela Velez Garcia', 'Int', 1, '2017-10-06 23:45:10'),
(129, 7, 512332323, 'Johanna Marcela Velez Garcia', 'Int', 1, '2017-10-06 23:52:59'),
(130, 7, 512332323, 'Johanna Marcela Velez Garcia', 'Int', 1, '2017-10-07 00:01:13'),
(131, 7, 512332323, 'Johanna Marcela Velez Garcia', 'Int', 1, '2017-10-07 00:02:00'),
(132, 7, 512332323, 'Johanna Marcela Velez Garcia', 'Int', 1, '2017-10-07 00:02:53'),
(133, 7, 512332323, 'Johanna Marcela Velez Garcia', 'Int', 1, '2017-10-07 00:04:03'),
(134, 7, 1234, 'Santiago', 'Int', 1, '2017-10-07 01:28:16'),
(135, 7, 1234, 'Santiago', 'Int', 1, '2017-10-07 01:30:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exit_teams_detall`
--

CREATE TABLE `exit_teams_detall` (
  `id_exit_detall` int(11) NOT NULL,
  `id_exit` int(11) NOT NULL,
  `id_equipment` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `exit_teams_detall`
--

INSERT INTO `exit_teams_detall` (`id_exit_detall`, `id_exit`, `id_equipment`, `quantity`, `note`) VALUES
(1, 1, 1, 3, 'bien'),
(2, 2, 1, 1, 'Biennnnnn'),
(3, 3, 1, 2, 'Bien'),
(4, 4, 1, 2, 'Bien'),
(5, 5, 1, 2, 'Biennnnnnnnnnaa'),
(6, 6, 1, 2, 'Biennnnnnnnnnaa');

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
(1, 'Kilogramo', 'Kg', 7, '2017-10-04 02:03:50'),
(2, 'Libra', 'Lb', 7, '2017-09-30 23:20:13');

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
  `num_orders` int(11) NOT NULL DEFAULT '0',
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id_product`, `name_product`, `description_product`, `unit_measure`, `id_user_create`, `id_cellar`, `num_orders`, `creation_date`) VALUES
(1, 'Savila', 'Savila', '1', 7, 1, 7, '2017-10-04 20:16:20'),
(2, 'Carne roja', 'Carne roja', '1', 7, 3, 3, '2017-10-04 02:12:01'),
(3, 'Leche', 'En polvo', '2', 7, 2, 2, '2017-10-06 04:57:49'),
(4, 'Fresas', 'fresas', '2', 7, 1, 1, '2017-10-06 05:06:39'),
(5, 'Tierra negra', '4738djid20', '1', 7, 4, 1, '2017-10-06 04:57:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recover_password`
--

CREATE TABLE `recover_password` (
  `id_recover` int(11) NOT NULL,
  `code_recover` text NOT NULL,
  `email_user` text NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Estructura Stand-in para la vista `showexitstock`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `showexitstock` (
`name_product` varchar(100)
,`name_cellar` varchar(50)
,`nom_lot` varchar(100)
,`id_stock` int(11)
,`id_exit_product_master` int(11)
,`quantity` int(11)
,`note` text
,`user_receives` int(11)
,`destination` varchar(50)
,`delivery` tinyint(1)
,`name_user` varchar(50)
,`last_name_user` varchar(50)
,`name_receive` varchar(30)
,`date_create` timestamp
,`prefix_measure` varchar(6)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock`
--

CREATE TABLE `stock` (
  `id_stock` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `nom_lot` varchar(100) NOT NULL,
  `amount` int(11) NOT NULL,
  `expiration_date` date NOT NULL,
  `expiration_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comercializadora` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `stock`
--

INSERT INTO `stock` (`id_stock`, `id_product`, `nom_lot`, `amount`, `expiration_date`, `expiration_create`, `comercializadora`) VALUES
(13, 4, '38eo2o1l', 17, '2017-10-31', '2017-09-30 23:21:04', 'sabla'),
(14, 2, '4r230e90ew', 18, '2017-11-30', '2017-10-03 19:28:24', 'rojas'),
(15, 3, '6748309dj', 155, '2017-12-30', '2017-10-04 02:10:19', 'lacts'),
(16, 2, '5430ofj', 180, '2017-10-31', '2017-10-05 23:23:10', 'roja'),
(17, 5, '54893oej', 20, '2018-02-03', '2017-10-06 04:56:09', 'negra');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock_plant`
--

CREATE TABLE `stock_plant` (
  `id_stock_plant` int(11) NOT NULL,
  `id_stock` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `id_exit_product` int(11) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `stock_plant`
--

INSERT INTO `stock_plant` (`id_stock_plant`, `id_stock`, `id_product`, `quantity`, `id_exit_product`, `date_create`) VALUES
(1, 14, 2, 30, 115, '2017-10-03 19:29:00'),
(2, 13, 1, 20, 115, '2017-10-03 19:29:00'),
(3, 14, 2, 20, 116, '2017-10-04 02:02:36'),
(4, 13, 1, 5, 116, '2017-10-04 02:02:36'),
(5, 14, 2, 12, 117, '2017-10-04 02:12:01'),
(6, 13, 1, 20, 117, '2017-10-04 02:12:01'),
(7, 15, 3, 23, 117, '2017-10-04 02:12:01'),
(8, 13, 4, 20, 120, '2017-10-06 05:06:39'),
(9, 13, 4, 1, 135, '2017-10-07 01:30:22');

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
(1, 'pala', 'acme', 234, 234, 6, 7),
(2, 'martillo ', '3456yw', 20, 20, 6, 7);

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

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `viewstockplanta`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `viewstockplanta` (
`id_stock_plant` int(11)
,`quantity` int(11)
,`id_stock` int(11)
,`name_user` varchar(50)
,`last_name_user` varchar(50)
,`name_receive` varchar(30)
,`id_exit_product` int(11)
,`date_create` timestamp
,`name_product` varchar(100)
,`name_cellar` varchar(50)
,`prefix_measure` varchar(6)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `showexitstock`
--
DROP TABLE IF EXISTS `showexitstock`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `showexitstock`  AS  select `products`.`name_product` AS `name_product`,`cellar`.`name_cellar` AS `name_cellar`,`stock`.`nom_lot` AS `nom_lot`,`exit_product_detalle`.`id_stock` AS `id_stock`,`exit_product_detalle`.`id_exit_product_master` AS `id_exit_product_master`,`exit_product_detalle`.`quantity` AS `quantity`,`exit_product_detalle`.`note` AS `note`,`exit_product_master`.`user_receives` AS `user_receives`,`exit_product_master`.`destination` AS `destination`,`exit_product_master`.`delivery` AS `delivery`,`user`.`name_user` AS `name_user`,`user`.`last_name_user` AS `last_name_user`,`exit_product_master`.`name_receive` AS `name_receive`,`exit_product_master`.`date_create` AS `date_create`,`measure`.`prefix_measure` AS `prefix_measure` from ((((((`exit_product_master` join `exit_product_detalle` on((`exit_product_master`.`id_exit_product` = `exit_product_detalle`.`id_exit_product_master`))) join `stock` on((`exit_product_detalle`.`id_stock` = `stock`.`id_stock`))) join `products` on((`stock`.`id_product` = `products`.`id_product`))) join `user` on((`exit_product_master`.`user_delivery` = `user`.`id_user`))) join `measure` on((`products`.`unit_measure` = `measure`.`id_measure`))) join `cellar` on((`products`.`id_cellar` = `cellar`.`id_cellar`))) order by `exit_product_master`.`id_exit_product` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `viewstockplanta`
--
DROP TABLE IF EXISTS `viewstockplanta`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewstockplanta`  AS  select `stock_plant`.`id_stock_plant` AS `id_stock_plant`,`stock_plant`.`quantity` AS `quantity`,`stock_plant`.`id_stock` AS `id_stock`,`user`.`name_user` AS `name_user`,`user`.`last_name_user` AS `last_name_user`,`exit_product_master`.`name_receive` AS `name_receive`,`stock_plant`.`id_exit_product` AS `id_exit_product`,`stock_plant`.`date_create` AS `date_create`,`products`.`name_product` AS `name_product`,`cellar`.`name_cellar` AS `name_cellar`,`measure`.`prefix_measure` AS `prefix_measure` from (((((`stock_plant` join `exit_product_master` on((`stock_plant`.`id_exit_product` = `exit_product_master`.`id_exit_product`))) join `products` on((`stock_plant`.`id_product` = `products`.`id_product`))) join `user` on((`exit_product_master`.`user_delivery` = `user`.`id_user`))) join `cellar` on((`products`.`id_cellar` = `cellar`.`id_cellar`))) join `measure` on((`products`.`unit_measure` = `measure`.`id_measure`))) ;

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
  ADD KEY `id_user_receives` (`id_user_receives`),
  ADD KEY `exit_equipment_master_ibfk_1` (`id_user_delivery`);

--
-- Indices de la tabla `exit_product_detalle`
--
ALTER TABLE `exit_product_detalle`
  ADD PRIMARY KEY (`id_exit_product_detalle`),
  ADD KEY `id_exit_product_master` (`id_exit_product_master`);
ALTER TABLE `exit_product_detalle` ADD FULLTEXT KEY `note` (`note`);

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
ALTER TABLE `exit_teams_detall` ADD FULLTEXT KEY `note` (`note`);

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
  ADD PRIMARY KEY (`id_stock`),
  ADD KEY `stock_ibfk_2` (`id_product`);

--
-- Indices de la tabla `stock_plant`
--
ALTER TABLE `stock_plant`
  ADD PRIMARY KEY (`id_stock_plant`),
  ADD KEY `id_exit_product` (`id_exit_product`);

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
  MODIFY `id_equipment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `exit_equipment_master`
--
ALTER TABLE `exit_equipment_master`
  MODIFY `id_exit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `exit_product_detalle`
--
ALTER TABLE `exit_product_detalle`
  MODIFY `id_exit_product_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT de la tabla `exit_product_master`
--
ALTER TABLE `exit_product_master`
  MODIFY `id_exit_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;
--
-- AUTO_INCREMENT de la tabla `exit_teams_detall`
--
ALTER TABLE `exit_teams_detall`
  MODIFY `id_exit_detall` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `measure`
--
ALTER TABLE `measure`
  MODIFY `id_measure` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `recover_password`
--
ALTER TABLE `recover_password`
  MODIFY `id_recover` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `stock`
--
ALTER TABLE `stock`
  MODIFY `id_stock` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `stock_plant`
--
ALTER TABLE `stock_plant`
  MODIFY `id_stock_plant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `tools`
--
ALTER TABLE `tools`
  MODIFY `id_tool` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
  ADD CONSTRAINT `exit_equipment_master_ibfk_1` FOREIGN KEY (`id_user_delivery`) REFERENCES `user` (`id_user`);

--
-- Filtros para la tabla `exit_product_detalle`
--
ALTER TABLE `exit_product_detalle`
  ADD CONSTRAINT `exit_product_detalle_ibfk_1` FOREIGN KEY (`id_exit_product_master`) REFERENCES `exit_product_master` (`id_exit_product`);

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
-- Filtros para la tabla `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`);

--
-- Filtros para la tabla `stock_plant`
--
ALTER TABLE `stock_plant`
  ADD CONSTRAINT `stock_plant_ibfk_1` FOREIGN KEY (`id_exit_product`) REFERENCES `exit_product_master` (`id_exit_product`);

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
