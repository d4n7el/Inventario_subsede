-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:8889
-- Tiempo de generación: 23-10-2017 a las 05:17:32
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_product_exit_stock` (IN `idUser` INT, IN `idExit_product` INT, IN `idExit_product_detalle` INT, IN `stocks` INT, IN `nota` VARCHAR(50), IN `proceso` VARCHAR(20), OUT `retorno` INT)  BEGIN
  DECLARE cantidad INT;
    SELECT quantity INTO cantidad FROM exit_product_detalle WHERE id_exit_product_detalle = idExit_product_detalle  AND id_exit_product_master = idExit_product AND id_stock = stocks;
  UPDATE exit_product_detalle SET state = 0, quantity = 0  WHERE id_exit_product_detalle = idExit_product_detalle  AND id_exit_product_master = idExit_product AND id_stock = stocks;
   INSERT INTO intergridad_exit_product_detalle (exit_product_detalle,old_quantity,quantity,id_user,note,state,process) VALUES(idExit_product_detalle,cantidad,0,idUser,nota,0,proceso);
   UPDATE stock_plant SET state = 0 WHERE id_exit_product = idExit_product AND id_stock = stocks;
   SET retorno = 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_cant_tools_detalle` (IN `p_cantidad` INT, IN `id_exit_master` INT, IN `p_id_exit_detalle` INT, IN `p_id_user` INT, OUT `retorno` INT)  BEGIN 
  DECLARE v_oldcantidad INT;
    DECLARE v_cantidad_disponible INT;
    DECLARE v_tool INT;
    
    SELECT id_tool INTO v_tool FROM exit_tools_detall WHERE id_exit_detall = p_id_exit_detalle;
    SELECT quantity_available INTO v_cantidad_disponible FROM tools WHERE id_tool = v_tool;
    SELECT quantity INTO v_oldcantidad FROM exit_tools_detall WHERE id_exit_detall = p_id_exit_detalle; 
    IF v_cantidad_disponible > 0 AND v_cantidad_disponible > p_cantidad THEN
        IF v_oldcantidad > p_cantidad THEN
          UPDATE tools SET quantity_available = ( v_oldcantidad - p_cantidad) + quantity_available WHERE id_tool = v_tool;
          SET retorno = 1;
        ELSE 
          UPDATE tools SET quantity_available = quantity_available - ( p_cantidad - v_oldcantidad) WHERE id_tool = v_tool;
          SET retorno = 1;
        END IF;
        IF retorno = 1 THEN
          UPDATE exit_tools_detall SET quantity = p_cantidad WHERE id_exit_detall = p_id_exit_detalle;
        END IF;
    ELSE
    SET retorno = 0;
    END IF;  
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_exit_stock` (IN `cantidad` INT(11), IN `idMaster` INT(11), IN `IdDetalle` INT(11), IN `IdUser` INT(11), OUT `retorno` BOOLEAN)  BEGIN
  DECLARE id_stocks INT(11);
  DECLARE cant_stock INT(11);
  DECLARE tipo varchar(50);
  DECLARE old_cantidad varchar(50);
  SELECT destination INTO tipo FROM exit_product_master WHERE id_exit_product = idMaster;
  SELECT quantity INTO old_cantidad FROM exit_product_detalle WHERE id_exit_product_master = idMaster AND id_exit_product_detalle = IdDetalle;
  SELECT id_stock INTO id_stocks FROM exit_product_detalle WHERE id_exit_product_detalle = IdDetalle;
  SELECT amount INTO cant_stock FROM stock WHERE id_stock = id_stocks;
    IF cant_stock >= cantidad THEN
      UPDATE exit_product_detalle SET quantity = cantidad, state = 1 WHERE id_exit_product_detalle = IdDetalle;
      INSERT INTO intergridad_exit_product_detalle (exit_product_detalle,id_user,note,old_quantity,quantity,process,
state) VALUES (IdDetalle,IdUser,"bien",old_cantidad, cantidad,"Update",1);
      IF tipo LIKE "Int" THEN
      UPDATE stock_plant SET quantity = cantidad, state = 1 WHERE id_exit_product = idMaster AND id_stock = id_stocks ;
      END IF;
        SET retorno = 1;
  ELSE
      SET retorno = 0;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_stock_plant` (IN `id_exit_product` INT, IN `id_stock_plants` INT, IN `stock` INT, IN `cantidad` INT, IN `id_user` INT, IN `note` CHAR(50), OUT `retorno` INT)  BEGIN
  DECLARE oldcantidad INT;
    SELECT quantity INTO oldcantidad FROM stock_plant WHERE id_stock_plant = id_stock_plants LIMIT 1;
  UPDATE stock_plant SET quantity = cantidad WHERE id_exit_product = id_exit_product AND id_stock_plant = id_stock_plants AND  id_stock = stock;
    INSERT INTO integridad_stock_plant (id_stock_plant,quantity,old_quantity,id_user,note) VALUES (id_stock_plants,cantidad,oldcantidad,id_user,note);
SET retorno = id_stock_plants;
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
(1, 'teve', 'acme', 100, 100, 3, 7),
(2, '654', 'ytr', 10, 10, 5, 7),
(3, 'lazos', 'acme', 20, 20, 5, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exit_equipment_master`
--

CREATE TABLE `exit_equipment_master` (
  `id_exit` int(11) NOT NULL,
  `id_user_receives` int(11) NOT NULL,
  `name_user_receives` varchar(50) NOT NULL,
  `id_user_delivery` int(11) NOT NULL,
  `delivery` tinyint(1) NOT NULL DEFAULT '1',
  `received` tinyint(1) NOT NULL DEFAULT '0',
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `exit_equipment_master`
--

INSERT INTO `exit_equipment_master` (`id_exit`, `id_user_receives`, `name_user_receives`, `id_user_delivery`, `delivery`, `received`, `date_create`) VALUES
(1, 1234, 'Santiago', 7, 1, 0, '2017-10-05 23:26:19'),
(2, 1234, 'Santiago', 7, 1, 0, '2017-10-05 23:28:59'),
(3, 1234, 'Santiago', 7, 1, 0, '2017-10-05 23:36:56'),
(4, 1234, 'Santiago', 7, 1, 0, '2017-10-05 23:38:02'),
(5, 1234, 'Santiago', 7, 1, 0, '2017-10-05 23:41:06'),
(6, 1234, 'Santiago', 7, 1, 0, '2017-10-05 23:41:55'),
(7, 1234, 'Santiago', 7, 1, 0, '2017-10-18 03:27:10'),
(8, 1234, 'Santiago', 7, 1, 0, '2017-10-18 19:45:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exit_product_detalle`
--

CREATE TABLE `exit_product_detalle` (
  `id_exit_product_detalle` int(11) NOT NULL,
  `id_exit_product_master` int(11) NOT NULL,
  `id_stock` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `note` text NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `exit_product_detalle`
--

INSERT INTO `exit_product_detalle` (`id_exit_product_detalle`, `id_exit_product_master`, `id_stock`, `quantity`, `note`, `state`) VALUES
(71, 137, 13, 4, 'Externo', 1),
(72, 138, 14, 4, '', 1),
(73, 138, 13, 1, '', 1),
(74, 139, 16, 3, '', 1),
(75, 140, 13, 3, 'Frescas', 1),
(76, 141, 18, 2, '', 1),
(77, 142, 17, 2, 'ytrew', 1),
(78, 143, 13, 4, 'Frequitos', 1),
(79, 144, 14, 2, 'bien', 1),
(80, 145, 17, 1, '', 1),
(81, 145, 13, 5, '', 1),
(82, 145, 15, 3, '', 1),
(83, 146, 13, 2, 'fresquitas', 1),
(84, 147, 20, 10, 'Sabila', 1),
(85, 148, 13, 10, '', 1),
(86, 149, 16, 0, '', 0),
(87, 149, 13, 10, 'rfuyfyugu', 1),
(88, 150, 22, 4, 'roja', 1),
(89, 150, 21, 2, 'savila', 1),
(90, 151, 22, 2, 'buenos', 1),
(91, 151, 21, 1, 'mas buenos', 1),
(92, 152, 22, 1, 'Biennnn', 1),
(93, 152, 21, 3, 'Biennnn', 1);

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
  DECLARE producto INT;
    SELECT amount INTO cantidad FROM stock WHERE id_stock = NEW.id_stock;
    SELECT id_product INTO producto FROM stock WHERE id_stock = NEW.id_stock;
    if NEW.quantity <= cantidad AND cantidad > 0 THEN
      UPDATE stock SET amount = amount - NEW.quantity WHERE id_stock = NEW.id_stock;
      UPDATE products SET num_orders = num_orders + 1 WHERE id_product = producto;
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
(137, 7, 1234, 'Santiago', 'Ext', 1, '2017-10-09 02:53:14'),
(138, 7, 634343434, 'Jhon Jairo Cuaervo', 'Int', 1, '2017-10-09 02:54:42'),
(139, 7, 1234, 'Santiago', 'Int', 1, '2017-10-09 03:50:44'),
(140, 7, 1234, 'Santiago', 'Int', 1, '2017-10-11 20:41:28'),
(141, 7, 1234, 'Santiago', 'Int', 1, '2017-10-12 02:15:04'),
(142, 7, 1234, 'Santiago', 'Int', 1, '2017-10-12 02:16:36'),
(143, 7, 18595130, 'Jhon  Jairo Cuaervo', 'Int', 1, '2017-10-12 02:28:48'),
(144, 7, 1234, 'Santiago', 'Int', 1, '2017-10-13 02:11:32'),
(145, 7, 98511504, 'Eleuterio Herrera Soto', 'Int', 1, '2017-10-13 15:20:42'),
(146, 7, 512332323, 'Johanna Marcela Velez Garcia', 'Int', 1, '2017-10-15 05:58:14'),
(147, 7, 1234, 'Santiago', 'Ext', 1, '2017-10-17 02:36:57'),
(148, 7, 1234, 'Santiago', 'Int', 1, '2017-10-18 03:22:01'),
(149, 7, 1234, 'Santiago', 'Int', 1, '2017-10-18 19:36:33'),
(150, 7, 1234, 'Santiago', 'Int', 1, '2017-10-18 20:18:44'),
(151, 7, 1234, 'Santiago', 'Int', 1, '2017-10-19 00:22:07'),
(152, 7, 1234, 'Santiago', 'Manizales', 1, '2017-10-19 17:58:12');

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
(6, 6, 1, 2, 'Biennnnnnnnnnaa'),
(7, 7, 2, 1, 'bien'),
(8, 8, 3, 10, 'buenos'),
(9, 8, 1, 3, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exit_tools_detall`
--

CREATE TABLE `exit_tools_detall` (
  `id_exit_detall` int(11) NOT NULL,
  `id_exit` int(11) NOT NULL,
  `id_tool` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `note_received` text NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `exit_tools_detall`
--

INSERT INTO `exit_tools_detall` (`id_exit_detall`, `id_exit`, `id_tool`, `quantity`, `note_received`, `state`) VALUES
(4, 24, 1, 2, 'cual quier nota', 1),
(5, 25, 7, 4, 'sddfd', 1),
(6, 26, 8, 3, 'picas', 1),
(7, 27, 9, 2, 'cualquier cosa', 1),
(8, 28, 8, 2, 'ds', 1),
(9, 29, 2, 3, 'sdfgh', 1),
(10, 29, 7, 5, 'kjhgf', 1),
(11, 30, 2, 11, 'asdf', 1),
(12, 30, 9, 1, 'asd', 1),
(13, 31, 8, 3, 'asas', 1),
(14, 31, 9, 7, 'sa', 1),
(15, 32, 8, 1, 'asdf', 1),
(16, 32, 9, 15, 'asdfg', 1),
(17, 33, 1, 1, 'aa', 1);

--
-- Disparadores `exit_tools_detall`
--
DELIMITER $$
CREATE TRIGGER `update_cant_tool` AFTER INSERT ON `exit_tools_detall` FOR EACH ROW BEGIN
DECLARE v_cantidad_disponible INT;
SELECT quantity_available INTO v_cantidad_disponible FROM tools WHERE id_tool = NEW.id_tool;
IF v_cantidad_disponible > 0 AND v_cantidad_disponible > NEW.quantity THEN 
  UPDATE tools SET quantity_available =    quantity_available - NEW.quantity WHERE id_tool = NEW.id_tool;

END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exit_tools_master`
--

CREATE TABLE `exit_tools_master` (
  `id_exit` int(11) NOT NULL,
  `id_user_receives` int(11) NOT NULL,
  `name_user_receive` varchar(50) NOT NULL,
  `id_user_delivery` int(11) NOT NULL,
  `delivery` tinyint(1) NOT NULL DEFAULT '1',
  `received` tinyint(1) NOT NULL DEFAULT '0',
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `exit_tools_master`
--

INSERT INTO `exit_tools_master` (`id_exit`, `id_user_receives`, `name_user_receive`, `id_user_delivery`, `delivery`, `received`, `date_create`) VALUES
(24, 1234, 'Santiago', 18, 1, 0, '2017-10-17 22:04:29'),
(25, 1234, 'Santiago', 18, 1, 0, '2017-10-18 18:25:30'),
(26, 1234, 'Santiago', 18, 1, 0, '2017-10-18 18:28:19'),
(27, 1234, 'Santiago', 7, 1, 0, '2017-10-18 19:50:13'),
(28, 1234, 'Santiago', 18, 1, 0, '2017-10-22 18:44:39'),
(29, 1234, 'Santiago', 18, 1, 0, '2017-10-22 19:21:54'),
(30, 1234, 'Santiago', 18, 1, 0, '2017-10-22 21:44:50'),
(31, 1234, 'Santiago', 18, 1, 0, '2017-10-22 21:49:58'),
(32, 1234, 'Santiago', 18, 1, 0, '2017-10-22 21:55:02'),
(33, 1234, 'Santiago', 7, 1, 0, '2017-10-23 02:49:00');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `get_products`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `get_products` (
`id_product` int(11)
,`name_product` varchar(100)
,`description_product` varchar(250)
,`unit_measure` varchar(20)
,`id_cellar` int(11)
,`num_orders` int(11)
,`creation_date` timestamp
,`name_cellar` varchar(50)
,`name_measure` varchar(20)
,`prefix_measure` varchar(6)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `get_stock`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `get_stock` (
`id_stock` int(11)
,`state` tinyint(1)
,`nom_lot` varchar(100)
,`amount` int(11)
,`expiration_date` date
,`expiration_create` timestamp
,`comercializadora` varchar(100)
,`id_product` int(11)
,`name_product` varchar(100)
,`unit_measure` varchar(20)
,`id_user_create` int(11)
,`id_cellar` int(11)
,`creation_date` timestamp
,`name_cellar` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `integridad_stock_plant`
--

CREATE TABLE `integridad_stock_plant` (
  `id_integridad` int(11) NOT NULL,
  `id_stock_plant` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `old_quantity` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `note` text NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `integridad_stock_plant`
--

INSERT INTO `integridad_stock_plant` (`id_integridad`, `id_stock_plant`, `quantity`, `old_quantity`, `id_user`, `note`, `date_create`) VALUES
(1, 22, 1, 0, 7, 'kfkd', '2017-10-18 03:39:14'),
(2, 22, 0, 1, 7, 'fds', '2017-10-18 03:40:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `intergridad_exit_product_detalle`
--

CREATE TABLE `intergridad_exit_product_detalle` (
  `id_integridad` int(11) NOT NULL,
  `exit_product_detalle` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `old_quantity` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `note` varchar(50) NOT NULL,
  `state` tinyint(1) NOT NULL,
  `process` varchar(20) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `intergridad_exit_product_detalle`
--

INSERT INTO `intergridad_exit_product_detalle` (`id_integridad`, `exit_product_detalle`, `quantity`, `old_quantity`, `id_user`, `note`, `state`, `process`, `date_create`) VALUES
(10, 83, 0, 4, 7, 'prueba de old', 0, 'delete', '2017-10-16 15:31:50'),
(13, 83, 1, 1, 7, 'bien', 1, 'Update', '2017-10-16 16:04:41'),
(14, 83, 2, 1, 7, 'bien', 1, 'Update', '2017-10-16 16:05:21'),
(15, 84, 0, 10, 7, 'prueba', 0, 'delete', '2017-10-17 03:39:24'),
(16, 84, 10, 0, 7, 'bien', 1, 'Update', '2017-10-17 03:39:40'),
(17, 85, 0, 2, 7, 'no eran', 0, 'delete', '2017-10-18 03:33:44'),
(18, 85, 10, 0, 7, 'bien', 1, 'Update', '2017-10-18 04:04:58'),
(19, 86, 0, 10, 7, 'ytytth', 0, 'delete', '2017-10-18 19:38:22'),
(20, 89, 0, 2, 7, 'ghjk', 0, 'delete', '2017-10-18 20:52:25'),
(21, 89, 9, 0, 7, 'bien', 1, 'Update', '2017-10-18 21:01:08'),
(22, 89, 0, 9, 7, 'gfhjmn', 0, 'delete', '2017-10-18 21:01:50'),
(23, 89, 1, 0, 7, 'bien', 1, 'Update', '2017-10-18 21:02:45'),
(24, 88, 0, 10, 7, 'fgh', 0, 'delete', '2017-10-18 21:05:09'),
(25, 88, 10, 0, 7, 'bien', 1, 'Update', '2017-10-18 21:05:41'),
(26, 89, 2, 1, 7, 'bien', 1, 'Update', '2017-10-18 23:23:51'),
(27, 88, 4, 10, 7, 'bien', 1, 'Update', '2017-10-18 23:24:33'),
(28, 91, 0, 5, 7, 'gfds', 0, 'delete', '2017-10-19 00:23:35'),
(29, 91, 1, 0, 7, 'bien', 1, 'Update', '2017-10-19 00:27:46');

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
(2, 'Libra', 'Lb', 7, '2017-09-30 23:20:13'),
(3, 'Onza', 'Oz', 7, '2017-10-19 05:48:47'),
(4, 'Tonelada', 'Tl', 7, '2017-10-19 05:56:31');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `planta_stock`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `planta_stock` (
`expiration_date` date
,`state` tinyint(1)
,`id_stock_plant` int(11)
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
,`nom_lot` varchar(100)
);

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
(1, 'Savila', 'Savila', '1', 7, 1, 11, '2017-10-19 17:58:12'),
(2, 'Carne roja', 'Carne roja', '1', 7, 3, 8, '2017-10-19 17:58:12'),
(3, 'Leche', 'En polvo', '2', 7, 2, 3, '2017-10-13 15:20:42'),
(4, 'Fresas', 'fresas', '2', 7, 1, 6, '2017-10-18 19:36:34'),
(5, 'Tierra negra', '4738djid20', '1', 7, 4, 2, '2017-10-13 15:20:42'),
(6, 'Sal marina', 'sal', '2', 7, 4, 0, '2017-10-19 06:13:31'),
(7, 'Azucar', 'azucar', '1', 7, 4, 0, '2017-10-19 18:01:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recover_password`
--

CREATE TABLE `recover_password` (
  `id_recover` int(11) NOT NULL,
  `code_recover` text NOT NULL,
  `email_user` text NOT NULL,
  `use_code` tinyint(1) NOT NULL DEFAULT '0',
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `recover_password`
--

INSERT INTO `recover_password` (`id_recover`, `code_recover`, `email_user`, `use_code`, `fecha_creacion`) VALUES
(1, 'F679953I', 'd4n7elfelipe@gmail.com', 1, '2017-10-15 03:58:24');

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
(2, 'Bodegero', 'Encargado de bodegas', 'B_1-b_1'),
(3, 'Aprendiz', 'Estudiante sena', 'E_1_S1');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `show_exit_stock`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `show_exit_stock` (
`name_product` varchar(100)
,`name_cellar` varchar(50)
,`nom_lot` varchar(100)
,`id_stock` int(11)
,`id_exit_product_master` int(11)
,`quantity` int(11)
,`note` text
,`amount` int(11)
,`id_exit_product_detalle` int(11)
,`state` tinyint(1)
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
  `comercializadora` varchar(100) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `stock`
--

INSERT INTO `stock` (`id_stock`, `id_product`, `nom_lot`, `amount`, `expiration_date`, `expiration_create`, `comercializadora`, `state`) VALUES
(21, 1, '4567yugj', 4, '2017-10-31', '2017-10-18 20:15:50', 'casa', 1),
(22, 2, '45768ighio', 13, '2017-10-30', '2017-10-18 20:16:44', 'casas', 1),
(23, 5, '39r8euwkw', 200, '2017-10-27', '2017-10-19 06:16:11', 'negra', 1),
(24, 1, '9i4k302', 100, '2017-10-31', '2017-10-19 06:19:56', 'sab', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock_plant`
--

CREATE TABLE `stock_plant` (
  `id_stock_plant` int(11) NOT NULL,
  `id_stock` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `id_exit_product` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `stock_plant`
--

INSERT INTO `stock_plant` (`id_stock_plant`, `id_stock`, `quantity`, `id_exit_product`, `state`, `date_create`) VALUES
(10, 14, 10, 138, 1, '2017-10-09 02:54:42'),
(11, 13, 1, 138, 1, '2017-10-09 02:54:42'),
(12, 16, 3, 139, 1, '2017-10-09 03:50:44'),
(13, 13, 3, 140, 1, '2017-10-11 20:41:28'),
(14, 18, 2, 141, 1, '2017-10-12 02:15:04'),
(15, 17, 50, 142, 1, '2017-10-12 02:16:36'),
(16, 13, 9, 143, 1, '2017-10-12 02:28:48'),
(17, 14, 2, 144, 1, '2017-10-13 02:11:32'),
(18, 17, 1, 145, 1, '2017-10-13 15:20:42'),
(19, 13, 5, 145, 1, '2017-10-13 15:20:42'),
(20, 15, 2, 145, 1, '2017-10-13 15:20:42'),
(21, 13, 2, 146, 1, '2017-10-15 05:58:14'),
(22, 13, 10, 148, 1, '2017-10-18 03:22:01'),
(23, 16, 0, 149, 1, '2017-10-18 19:36:34'),
(24, 13, 10, 149, 1, '2017-10-18 19:36:34'),
(25, 22, 4, 150, 1, '2017-10-18 20:18:44'),
(27, 22, 2, 151, 1, '2017-10-19 00:22:07'),
(28, 21, 1, 151, 1, '2017-10-19 00:22:07');

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
(1, 'pala', 'acme', 234, 219, 6, 7),
(2, 'martillo', '3456yw', 20, 9, 6, 7),
(7, 'cuchillo', 'cualquiera', 50, 14, 6, 18),
(8, 'pica', 'acme', 45, 9, 6, 18),
(9, 'palustre', 'acme', 50, 5, 6, 7);

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
  `id_role` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id_user`, `name_user`, `last_name_user`, `email_user`, `cedula`, `pass`, `id_cellar`, `id_role`, `state`) VALUES
(7, 'Daniel Felipe', 'Zamora Ortiz', 'd4n7elfelipe@gmail.com', '123456789', '$2y$10$c.ZONfKnPCchZ///GtTbReImBidu501k44vubObAFg/LHE5IViG/W', 2, 1, 1),
(15, 'Stefania', 'Casas', 'Ecasas05@misena.edu.co', '1093227968', '$2y$10$fi/ObWvWDHI8qOItzyf1..J.WmBk6YnMOVAeATY8NJPotQYZUQJcq', 3, 1, 1),
(16, 'Pedro', 'Triviño', 'pnmontealegre@misena.edu.co', '1225092661', '$2y$10$eYo1Chuil/FLsTMRsBbHDeL3PBqbPX9Kif7XJUJEnqLg2oub6YvdO', 4, 1, 1),
(17, 'Yeison', 'Londoño Tabarez', 'yeiko1022@hotmail.com', '1088347434', '$2y$10$FFTBYqNzlEJC4pVWqM/6MehsSgVQj1jYeOaLtvZwxkKCboD8qy/0K', 4, 1, 1),
(18, 'Julio Cesar', 'Guapacha ', 'jcguapacha2@misena.edu.co', '1088299682', '$2y$10$V//tBsKlFLY8pyF83XJgR.fd7NXWbHw3vs6GM3WN7CYnwrAbAS.h2', 5, 1, 1),
(19, 'Juan camilo', 'Ortiz', 'juan@gmail.com', '999999999', '$2y$10$hK8UMSasfKHpZ0sqwM2XM.8hsLsARBwZpDywZFOzhaGaFfwhjMDFa', 4, 3, 1),
(20, 'Sofhia', 'Garzon', 'sofhia@gmail.com', '4444', '$2y$10$SCZ8eU.YXk.n/IeOi5.6sOvhuGn9uhO.KgXAY9fYu9NzO1zzNUCKa', 5, 1, 1),
(21, 'Laura', 'Marin', 'lau@gmail.com', '333', '$2y$10$bY1llUyBaMKVq2ej.D2yp.JvBUGt3zOoeUQYxQCEhdgShrbrZoPEy', 3, 2, 1),
(22, 'Luna', 'Muños', 'luna@gmail.com', '55555', '$2y$10$INEsra7Ta37fLhxF558OVuc8YkKJW9XOYnYf8a145LLQ8pLuqlUty', 4, 3, 1),
(23, 'Miguel', 'zamora', 'migue@gmail.com', '111111', '$2y$10$z0b5GSuxGZv94C6KcZjwPuIy8lrg2Fu2GpHL.8.EAwdyZoDfuuMmG', 4, 1, 1);

-- --------------------------------------------------------

--
-- Estructura para la vista `get_products`
--
DROP TABLE IF EXISTS `get_products`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `get_products`  AS  select `products`.`id_product` AS `id_product`,`products`.`name_product` AS `name_product`,`products`.`description_product` AS `description_product`,`products`.`unit_measure` AS `unit_measure`,`products`.`id_cellar` AS `id_cellar`,`products`.`num_orders` AS `num_orders`,`products`.`creation_date` AS `creation_date`,`cellar`.`name_cellar` AS `name_cellar`,`measure`.`name_measure` AS `name_measure`,`measure`.`prefix_measure` AS `prefix_measure` from ((`products` join `cellar` on((`products`.`id_cellar` = `cellar`.`id_cellar`))) join `measure` on((`products`.`unit_measure` = `measure`.`id_measure`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `get_stock`
--
DROP TABLE IF EXISTS `get_stock`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `get_stock`  AS  select `stock`.`id_stock` AS `id_stock`,`stock`.`state` AS `state`,`stock`.`nom_lot` AS `nom_lot`,`stock`.`amount` AS `amount`,`stock`.`expiration_date` AS `expiration_date`,`stock`.`expiration_create` AS `expiration_create`,`stock`.`comercializadora` AS `comercializadora`,`products`.`id_product` AS `id_product`,`products`.`name_product` AS `name_product`,`products`.`unit_measure` AS `unit_measure`,`products`.`id_user_create` AS `id_user_create`,`products`.`id_cellar` AS `id_cellar`,`products`.`creation_date` AS `creation_date`,`cellar`.`name_cellar` AS `name_cellar` from ((`stock` join `products` on((`stock`.`id_product` = `products`.`id_product`))) join `cellar` on((`products`.`id_cellar` = `cellar`.`id_cellar`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `planta_stock`
--
DROP TABLE IF EXISTS `planta_stock`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `planta_stock`  AS  select `stock`.`expiration_date` AS `expiration_date`,`stock_plant`.`state` AS `state`,`stock_plant`.`id_stock_plant` AS `id_stock_plant`,`stock_plant`.`quantity` AS `quantity`,`stock_plant`.`id_stock` AS `id_stock`,`user`.`name_user` AS `name_user`,`user`.`last_name_user` AS `last_name_user`,`exit_product_master`.`name_receive` AS `name_receive`,`stock_plant`.`id_exit_product` AS `id_exit_product`,`stock_plant`.`date_create` AS `date_create`,`products`.`name_product` AS `name_product`,`cellar`.`name_cellar` AS `name_cellar`,`measure`.`prefix_measure` AS `prefix_measure`,`stock`.`nom_lot` AS `nom_lot` from ((((((`stock_plant` join `exit_product_master` on((`stock_plant`.`id_exit_product` = `exit_product_master`.`id_exit_product`))) join `stock` on((`stock_plant`.`id_stock` = `stock`.`id_stock`))) join `user` on((`exit_product_master`.`user_delivery` = `user`.`id_user`))) join `products` on((`stock`.`id_product` = `products`.`id_product`))) join `cellar` on((`products`.`id_cellar` = `cellar`.`id_cellar`))) join `measure` on((`products`.`unit_measure` = `measure`.`id_measure`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `show_exit_stock`
--
DROP TABLE IF EXISTS `show_exit_stock`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `show_exit_stock`  AS  select `products`.`name_product` AS `name_product`,`cellar`.`name_cellar` AS `name_cellar`,`stock`.`nom_lot` AS `nom_lot`,`exit_product_detalle`.`id_stock` AS `id_stock`,`exit_product_detalle`.`id_exit_product_master` AS `id_exit_product_master`,`exit_product_detalle`.`quantity` AS `quantity`,`exit_product_detalle`.`note` AS `note`,`stock`.`amount` AS `amount`,`exit_product_detalle`.`id_exit_product_detalle` AS `id_exit_product_detalle`,`exit_product_detalle`.`state` AS `state`,`exit_product_master`.`user_receives` AS `user_receives`,`exit_product_master`.`destination` AS `destination`,`exit_product_master`.`delivery` AS `delivery`,`user`.`name_user` AS `name_user`,`user`.`last_name_user` AS `last_name_user`,`exit_product_master`.`name_receive` AS `name_receive`,`exit_product_master`.`date_create` AS `date_create`,`measure`.`prefix_measure` AS `prefix_measure` from ((((((`exit_product_master` join `exit_product_detalle` on((`exit_product_master`.`id_exit_product` = `exit_product_detalle`.`id_exit_product_master`))) join `stock` on((`exit_product_detalle`.`id_stock` = `stock`.`id_stock`))) join `products` on((`stock`.`id_product` = `products`.`id_product`))) join `user` on((`exit_product_master`.`user_delivery` = `user`.`id_user`))) join `measure` on((`products`.`unit_measure` = `measure`.`id_measure`))) join `cellar` on((`products`.`id_cellar` = `cellar`.`id_cellar`))) order by `exit_product_master`.`id_exit_product` ;

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
-- Indices de la tabla `exit_tools_detall`
--
ALTER TABLE `exit_tools_detall`
  ADD PRIMARY KEY (`id_exit_detall`);

--
-- Indices de la tabla `exit_tools_master`
--
ALTER TABLE `exit_tools_master`
  ADD PRIMARY KEY (`id_exit`),
  ADD KEY `id_user_receives` (`id_user_receives`);

--
-- Indices de la tabla `integridad_stock_plant`
--
ALTER TABLE `integridad_stock_plant`
  ADD PRIMARY KEY (`id_integridad`);
ALTER TABLE `integridad_stock_plant` ADD FULLTEXT KEY `note` (`note`);

--
-- Indices de la tabla `intergridad_exit_product_detalle`
--
ALTER TABLE `intergridad_exit_product_detalle`
  ADD PRIMARY KEY (`id_integridad`),
  ADD KEY `exit_product_detalle` (`exit_product_detalle`);

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
  MODIFY `id_equipment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `exit_equipment_master`
--
ALTER TABLE `exit_equipment_master`
  MODIFY `id_exit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `exit_product_detalle`
--
ALTER TABLE `exit_product_detalle`
  MODIFY `id_exit_product_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;
--
-- AUTO_INCREMENT de la tabla `exit_product_master`
--
ALTER TABLE `exit_product_master`
  MODIFY `id_exit_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;
--
-- AUTO_INCREMENT de la tabla `exit_teams_detall`
--
ALTER TABLE `exit_teams_detall`
  MODIFY `id_exit_detall` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `exit_tools_detall`
--
ALTER TABLE `exit_tools_detall`
  MODIFY `id_exit_detall` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `exit_tools_master`
--
ALTER TABLE `exit_tools_master`
  MODIFY `id_exit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT de la tabla `integridad_stock_plant`
--
ALTER TABLE `integridad_stock_plant`
  MODIFY `id_integridad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `intergridad_exit_product_detalle`
--
ALTER TABLE `intergridad_exit_product_detalle`
  MODIFY `id_integridad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT de la tabla `measure`
--
ALTER TABLE `measure`
  MODIFY `id_measure` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `recover_password`
--
ALTER TABLE `recover_password`
  MODIFY `id_recover` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `stock`
--
ALTER TABLE `stock`
  MODIFY `id_stock` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `stock_plant`
--
ALTER TABLE `stock_plant`
  MODIFY `id_stock_plant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT de la tabla `tools`
--
ALTER TABLE `tools`
  MODIFY `id_tool` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
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
-- Filtros para la tabla `intergridad_exit_product_detalle`
--
ALTER TABLE `intergridad_exit_product_detalle`
  ADD CONSTRAINT `intergridad_exit_product_detalle_ibfk_1` FOREIGN KEY (`exit_product_detalle`) REFERENCES `exit_product_detalle` (`id_exit_product_detalle`);

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