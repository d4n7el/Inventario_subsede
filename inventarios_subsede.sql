-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:8889
-- Tiempo de generación: 08-12-2017 a las 04:55:03
-- Versión del servidor: 5.6.35
-- Versión de PHP: 7.1.8

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
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_equipment_exit` (IN `id_user` INT, IN `id_exit` INT, IN `id_exit_detalle` INT, IN `id_element` INT, IN `nota` INT, IN `process` INT, OUT `retorno` INT)  BEGIN  
  DECLARE old_cantidad INT;
    SELECT quantity INTO old_cantidad FROM exit_teams_detall WHERE id_exit_detall = id_exit_detalle;
  UPDATE exit_teams_detall SET state = 0, quantity = 0, returned = 1 WHERE id_exit_detall = id_exit_detalle;
    UPDATE equipments SET quantity_available = quantity_available + old_cantidad WHERE id_equipment = id_element;
    SET retorno = 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_product_exit_stock` (IN `idUser` INT, IN `idExit_product` INT, IN `idExit_product_detalle` INT, IN `stocks` INT, IN `nota` VARCHAR(50), IN `proceso` VARCHAR(20), OUT `retorno` INT)  BEGIN
  DECLARE cantidad INT;
    SELECT quantity INTO cantidad FROM exit_product_detalle WHERE id_exit_product_detalle = idExit_product_detalle  AND id_exit_product_master = idExit_product AND id_stock = stocks;
  UPDATE exit_product_detalle SET state = 0, quantity = 0  WHERE id_exit_product_detalle = idExit_product_detalle  AND id_exit_product_master = idExit_product AND id_stock = stocks;
   INSERT INTO intergridad_exit_product_detalle (exit_product_detalle,old_quantity,quantity,id_user,note,state,process) VALUES(idExit_product_detalle,cantidad,0,idUser,nota,0,proceso);
   UPDATE stock_plant SET state = 0 WHERE id_exit_product = idExit_product AND id_stock = stocks;
   SET retorno = 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_tools_exit` (IN `id_user` INT, IN `id_exit` INT, IN `id_exit_detalle` INT, IN `id_element` INT, IN `nota` INT, IN `process` INT, OUT `retorno` INT)  BEGIN  
  DECLARE old_cantidad INT;
    SELECT quantity INTO old_cantidad FROM exit_tools_detall WHERE id_exit_detall = id_exit_detalle;
  UPDATE exit_tools_detall SET state = 0, quantity = 0 WHERE id_exit_detall = id_exit_detalle;
    UPDATE tools SET quantity_available = quantity_available + old_cantidad WHERE id_tool = id_element;
    UPDATE exit_tools_detall SET returned = 1  WHERE id_exit_detall = id_exit_detalle;
    SET retorno = 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `new_expiration` (IN `v_id_stock` INT, IN `v_nota` VARCHAR(140), IN `v_id_user` INT, OUT `retorno` INT)  BEGIN
  DECLARE cantidad INT;
    SELECT amount INTO cantidad FROM stock WHERE id_stock = v_id_stock;
  UPDATE stock SET state = 0 WHERE id_stock = v_id_stock;
    UPDATE stock_plant SET state = 0 WHERE id_stock = v_id_stock;
    INSERT INTO expiration_stock (id_stock,amount_due,note,id_user) VALUES (v_id_stock,cantidad,v_nota,v_id_user);
    SET retorno = 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_cant_tools_detalle` (IN `p_cantidad` INT, IN `id_exit_master` INT, IN `p_id_exit_detalle` INT, IN `p_id_user` INT, OUT `retorno` INT)  BEGIN 
  DECLARE v_oldcantidad INT;
    DECLARE v_cantidad_disponible INT;
    DECLARE v_tool INT;
    SELECT id_tool INTO v_tool FROM exit_tools_detall WHERE id_exit_detall = p_id_exit_detalle;
    SELECT quantity_available INTO v_cantidad_disponible FROM tools WHERE id_tool = v_tool;
    SELECT quantity INTO v_oldcantidad FROM exit_tools_detall WHERE id_exit_detall = p_id_exit_detalle; 
    IF v_cantidad_disponible > 0 AND v_cantidad_disponible >= p_cantidad THEN
        IF v_oldcantidad >= p_cantidad THEN
          UPDATE tools SET quantity_available = ( v_oldcantidad - p_cantidad) + quantity_available WHERE id_tool = v_tool;
          SET retorno = 1;
        ELSE 
          UPDATE tools SET quantity_available = quantity_available - ( p_cantidad - v_oldcantidad) WHERE id_tool = v_tool;
          SET retorno = 1;
        END IF;
        IF retorno = 1 THEN
          UPDATE exit_tools_detall SET quantity = p_cantidad, state = 1 WHERE id_exit_detall = p_id_exit_detalle;
        END IF;
    ELSE
    SET retorno = 0;
    END IF;  
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_equipments` (IN `p_equipo` VARCHAR(50), IN `p_marca` VARCHAR(50), IN `p_cantidad_total` INT, IN `p_bodega` INT, IN `p_id_user` INT, IN `p_id_equipo` INT, IN `p_estado` VARCHAR(5), OUT `retorno` INT)  BEGIN
UPDATE equipments SET name_equipment = p_equipo, mark = p_marca, total_quantity = p_cantidad_total, id_cellar = p_bodega, id_user_create = p_id_user, state = p_estado WHERE id_equipment = p_id_equipo;
    SET retorno = 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_exit_stock` (IN `cantidad` FLOAT, IN `idMaster` INT(11), IN `IdDetalle` INT(11), IN `IdUser` INT(11), OUT `retorno` BOOLEAN)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_exit_stock_plant` (IN `v_detalle` INT, IN `v_proceso` VARCHAR(40), IN `v_stock` INT, IN `v_id_proceso` INT, IN `v_cantidad` INT, IN `v_nota` VARCHAR(50), OUT `retorno` INT)  NO SQL
BEGIN
  DECLARE old_quantity INT;
    IF v_proceso LIKE 'Interno' THEN
      SELECT quantity INTO old_quantity FROM stock_plant WHERE id_stock_plant = v_id_proceso;
        SET retorno = 1;
    ELSE
      IF v_proceso LIKE 'Externo' THEN
          SELECT amount INTO old_quantity FROM stock WHERE id_stock = v_id_proceso;
        SET retorno = 1;
        END IF;
    END IF;
  IF retorno = 1 THEN
       IF old_quantity >= v_cantidad AND v_cantidad > 0  THEN
          UPDATE exit_detalle_plant SET quantity = v_cantidad WHERE id_detalle = v_detalle AND proceso = v_proceso;
         ELSE
           SET retorno = 0;
        END IF;
    ELSE
       SET retorno = -1;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_quantity_available` (IN `equipo` INT, IN `disponible` INT, IN `nota` VARCHAR(50), IN `proceso` INT, OUT `retorno` INT)  BEGIN
  DECLARE v_total INT;
    DECLARE v_prestamos INT;
    DECLARE v_available INT;
    SELECT SUM(quantity) INTO v_prestamos FROM exit_teams_detall INNER JOIN exit_equipment_master ON exit_teams_detall.id_exit = exit_equipment_master.id_exit WHERE id_equipment = equipo AND exit_teams_detall.returned = 0;
    SELECT total_quantity INTO v_total FROM equipments WHERE id_equipment = equipo;
    SELECT quantity_available INTO v_available FROM equipments WHERE id_equipment = equipo;
    IF v_prestamos > 0 THEN
      SET v_prestamos = v_prestamos;
    ELSE
      SET v_prestamos = 0;
    END IF;
    IF proceso LIKE 1 THEN
        IF v_total >= v_available + v_prestamos + disponible THEN
            UPDATE equipments SET quantity_available = quantity_available + disponible WHERE id_equipment = equipo;
            SET retorno = 1; 
        ELSE
             SET retorno = -2; 
        END IF;    
    ELSE
        IF v_available > 0  AND (v_available - disponible) >= 0  THEN 
            UPDATE equipments SET quantity_available = (quantity_available - disponible) WHERE id_equipment = equipo;
            SET retorno = 1; 
        ELSE
            SET retorno = -1;
        END IF;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_quantity_available_tool` (IN `herramienta` INT, IN `disponible` INT, IN `nota` VARCHAR(50), IN `proceso` INT, OUT `retorno` INT)  NO SQL
BEGIN
    DECLARE v_total INT;
    DECLARE v_prestamos INT;
    DECLARE v_available INT;
    SELECT SUM(quantity) INTO v_prestamos FROM exit_tools_detall INNER JOIN exit_tools_master ON exit_tools_detall.id_exit = exit_tools_master.id_exit WHERE id_tool = herramienta AND exit_tools_detall.returned = 0;
    SELECT total_quantity INTO v_total FROM tools WHERE id_tool = herramienta;
    SELECT quantity_available INTO v_available FROM tools WHERE id_tool = herramienta;
    IF v_prestamos > 0 THEN
      SET v_prestamos = v_prestamos;
    ELSE
      SET v_prestamos = 0;
    END IF;
    IF proceso LIKE 1 THEN
        IF v_total >= disponible + v_prestamos + v_available THEN
                UPDATE tools SET quantity_available = quantity_available + disponible WHERE id_tool = herramienta;
           SET retorno = 1;
        ELSE
            SET retorno = v_prestamos;
        END IF;
    ELSE
        IF  v_available > 0  AND (v_available - disponible) >= 0 THEN
            UPDATE tools SET quantity_available = quantity_available - disponible WHERE id_tool = herramienta;
            SET retorno = 1;
        ELSE
            SET retorno = -1;
        END IF;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_quantity_equipments` (IN `p_id_exit_detall` INT, IN `p_team` INT, IN `p_id_exit` INT, IN `p_quantity` INT, OUT `retorno` INT)  BEGIN
  DECLARE v_old_quantity INT;
    DECLARE v_equipment INT;
    DECLARE v_quantity_available INT;
    SELECT quantity INTO v_OLD_quantity FROM exit_teams_detall WHERE id_exit_detall = p_id_exit_detall;
    SELECT id_equipment INTO v_equipment FROM exit_teams_detall WHERE id_exit_detall = p_id_exit_detall;
    SELECT quantity_available INTO v_quantity_available FROM equipments WHERE id_equipment = v_equipment;
    IF v_quantity_available > p_quantity THEN
      IF v_OLD_quantity > p_quantity  THEN
          UPDATE equipments SET quantity_available = (v_OLD_quantity - p_quantity) + quantity_available WHERE id_equipment = v_equipment;
            SET retorno = 1;
        ELSE
          UPDATE equipments SET quantity_available = quantity_available - (p_quantity - v_OLD_quantity) WHERE id_equipment = v_equipment;
            SET retorno = 1;
        END IF;
        IF retorno LIKE 1 THEN
          UPDATE exit_teams_detall SET quantity = p_quantity WHERE id_exit_detall = p_id_exit_detall;
            SET retorno = 1;
        ELSE
          SET retorno = 0;
        END IF;
    ELSE
      SET retorno = 0;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_stock_plant` (IN `id_exit_product` INT, IN `id_stock_plants` INT, IN `stock` INT, IN `cantidad` FLOAT, IN `id_user` FLOAT, IN `note` CHAR(50), IN `proceso` VARCHAR(40), OUT `retorno` INT)  BEGIN
  DECLARE oldcantidad INT;
    IF proceso LIKE 'Interno' THEN      
        SELECT quantity INTO oldcantidad FROM stock_plant WHERE id_stock_plant = id_stock_plants LIMIT 1;
        UPDATE stock_plant SET quantity = cantidad WHERE id_exit_product = id_exit_product AND id_stock_plant = id_stock_plants AND  id_stock = stock;
        INSERT INTO integridad_stock_plant (id_stock_plant,quantity,old_quantity,id_user,note) VALUES (id_stock_plants,cantidad,oldcantidad,id_user,note);
    ELSE
        UPDATE stock SET amount = cantidad WHERE id_stock = stock;
    END IF;
SET retorno = 1;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cellar`
--

CREATE TABLE `cellar` (
  `id_cellar` int(11) NOT NULL,
  `name_cellar` varchar(50) NOT NULL,
  `delegate` varchar(50) DEFAULT NULL,
  `description_cellar` varchar(100) NOT NULL,
  `icon_cellar` varchar(50) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cellar`
--

INSERT INTO `cellar` (`id_cellar`, `name_cellar`, `delegate`, `description_cellar`, `icon_cellar`, `date_create`) VALUES
(1, 'Fruver', NULL, 'Bodega Frutas y verduras', 'icon extension', '2017-12-08 03:36:38'),
(2, 'Lacteos', NULL, 'Bodega lacteos', 'image fruver.svg', '2017-12-08 03:17:30'),
(3, 'Carnicos', NULL, 'Bodega carnicos', 'image fruver.svg', '2017-12-08 03:17:27'),
(4, 'Agroinsumos', NULL, 'Bodega Insumos', 'image fruver.svg', '2017-12-08 03:17:24'),
(5, 'Equipos', NULL, 'Bodega equipos', 'image fruver.svg', '2017-12-08 03:17:21'),
(6, 'Herramientas', NULL, 'Bodega Herramientas', 'image fruver.svg', '2017-12-08 03:17:18'),
(7, 'AgroIndustria', NULL, 'AgroIndustria', 'image fruver.svg', '2017-12-08 03:17:16'),
(8, 'Pecuario', NULL, 'Pecuario', 'image fruver.svg', '2017-12-08 03:17:14'),
(10, 'Quimicos', NULL, 'quinicos', 'image fruver.svg', '2017-12-08 03:17:11'),
(12, 'aaa', 'vvv', 'aaa', 'icon extension', '2017-12-08 02:51:35'),
(13, 'Frutas', 'Frutas verduras', 'Julian david', 'image fruver.svg', '2017-12-08 03:16:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipments`
--

CREATE TABLE `equipments` (
  `id_equipment` int(11) NOT NULL,
  `name_equipment` varchar(100) NOT NULL,
  `mark` varchar(50) DEFAULT NULL,
  `total_quantity` int(15) NOT NULL,
  `quantity_available` int(15) NOT NULL,
  `id_cellar` int(11) NOT NULL,
  `id_user_create` int(11) NOT NULL,
  `zone` set('A','B') NOT NULL DEFAULT 'A',
  `state` set('0','1') NOT NULL DEFAULT '1',
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `equipments`
--

INSERT INTO `equipments` (`id_equipment`, `name_equipment`, `mark`, `total_quantity`, `quantity_available`, `id_cellar`, `id_user_create`, `zone`, `state`, `create_date`) VALUES
(1, 'Computador compumax', 'sr345678', 1, 1, 1, 7, 'A', '1', '2017-12-07 15:18:01'),
(2, 'Video beam', 'sony', 1, 1, 5, 7, 'A', '1', '2017-12-07 15:27:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exit_detalle_plant`
--

CREATE TABLE `exit_detalle_plant` (
  `id_detalle` int(11) NOT NULL,
  `id_exit__master` int(11) NOT NULL,
  `proceso` varchar(20) NOT NULL,
  `id_proceso` int(11) NOT NULL,
  `quantity` float NOT NULL,
  `note` varchar(60) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Disparadores `exit_detalle_plant`
--
DELIMITER $$
CREATE TRIGGER `after_insert_update_quantity_stock_stock_plant` AFTER INSERT ON `exit_detalle_plant` FOR EACH ROW BEGIN
  IF NEW.proceso LIKE 'Interno' THEN
      UPDATE stock_plant SET quantity = quantity - NEW.quantity WHERE id_stock_plant = NEW.id_proceso;
        
    ELSE
      IF NEW.proceso LIKE 'Externo' THEN
          UPDATE stock SET amount = amount - NEW.quantity WHERE id_stock = NEW.id_proceso;
         END IF;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_updte_update_quantity_stock_stock_plant` AFTER UPDATE ON `exit_detalle_plant` FOR EACH ROW BEGIN
IF NEW.proceso LIKE 'Interno' THEN 
  IF NEW.quantity > OLD.quantity THEN 
        UPDATE stock_plant SET quantity = quantity - (NEW.quantity - OLD.quantity) WHERE id_stock_plant = NEW.id_proceso;
    ELSE
      IF NEW.quantity < OLD.quantity  THEN
          UPDATE stock_plant SET quantity = quantity + (OLD.quantity - NEW.quantity)  WHERE id_stock_plant = NEW.id_proceso;
        END IF;
    END IF;
ELSE
  IF NEW.proceso LIKE 'Externo' THEN 
      IF NEW.quantity > OLD.quantity THEN 
          UPDATE stock SET amount = amount - (NEW.quantity - OLD.quantity) WHERE id_stock = NEW.id_proceso;
        ELSE
          IF NEW.quantity < OLD.quantity THEN
              UPDATE stock SET amount = amount + (OLD.quantity - NEW.quantity) WHERE id_stock = NEW.id_proceso;
            END IF;
        END IF;
    END IF;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exit_equipment_master`
--

CREATE TABLE `exit_equipment_master` (
  `id_exit` int(11) NOT NULL,
  `id_user_receives` int(11) NOT NULL,
  `name_user_receives` varchar(50) NOT NULL,
  `id_user_delivery` int(11) NOT NULL,
  `destination` varchar(50) NOT NULL DEFAULT 'Interno',
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `exit_equipment_master`
--

INSERT INTO `exit_equipment_master` (`id_exit`, `id_user_receives`, `name_user_receives`, `id_user_delivery`, `destination`, `date_create`) VALUES
(1, 18595130, 'John Jairo Cuervo Rubio', 7, 'Interno', '2017-12-07 15:28:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exit_master_plant`
--

CREATE TABLE `exit_master_plant` (
  `id_exit_master` int(11) NOT NULL,
  `id_user_receives` varchar(11) NOT NULL,
  `name_user_receives` varchar(50) NOT NULL,
  `id_user_delivery` int(11) NOT NULL,
  `destination` varchar(40) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exit_product_detalle`
--

CREATE TABLE `exit_product_detalle` (
  `id_exit_product_detalle` int(11) NOT NULL,
  `id_exit_product_master` int(11) NOT NULL,
  `id_stock` int(11) NOT NULL,
  `quantity` float NOT NULL,
  `note` text NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `exit_product_detalle`
--

INSERT INTO `exit_product_detalle` (`id_exit_product_detalle`, `id_exit_product_master`, `id_stock`, `quantity`, `note`, `state`) VALUES
(1, 1, 1, 0, 'salen bien', 0),
(2, 1, 2, 1, 'salen bien', 1);

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
(1, 7, 18595130, 'John Jairo Cuervo Rubio', 'Interno', 1, '2017-12-07 15:20:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exit_teams_detall`
--

CREATE TABLE `exit_teams_detall` (
  `id_exit_detall` int(11) NOT NULL,
  `id_exit` int(11) NOT NULL,
  `id_equipment` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `note` text NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `delivered` int(11) NOT NULL DEFAULT '1',
  `returned` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `exit_teams_detall`
--

INSERT INTO `exit_teams_detall` (`id_exit_detall`, `id_exit`, `id_equipment`, `quantity`, `note`, `state`, `delivered`, `returned`) VALUES
(1, 1, 1, 1, 'bien', 1, 1, 1),
(2, 1, 2, 1, 'bien', 1, 1, 1);

--
-- Disparadores `exit_teams_detall`
--
DELIMITER $$
CREATE TRIGGER `returned_equipment` AFTER UPDATE ON `exit_teams_detall` FOR EACH ROW BEGIN
DECLARE v_disponible INT;
SELECT quantity_available INTO v_disponible FROM equipments WHERE id_equipment = NEW.id_equipment;
IF NEW.returned != OLD.returned THEN
  IF NEW.returned = 0 THEN
      UPDATE equipments SET quantity_available =    quantity_available -      NEW.quantity WHERE id_equipment = NEW.id_equipment;
    ELSE
      UPDATE equipments SET quantity_available =    quantity_available +      NEW.quantity WHERE id_equipment = NEW.id_equipment;
    END IF;
 END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_quantity_equipment` AFTER INSERT ON `exit_teams_detall` FOR EACH ROW BEGIN
DECLARE v_disponible INT;
SELECT quantity_available INTO v_disponible FROM equipments WHERE id_equipment = NEW.id_equipment;
IF v_disponible > 0 AND v_disponible >= NEW.quantity THEN 
  UPDATE equipments SET quantity_available =    quantity_available - NEW.quantity WHERE id_equipment = NEW.id_equipment;
END IF;
END
$$
DELIMITER ;

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
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `delivered` int(11) NOT NULL DEFAULT '1',
  `returned` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Disparadores `exit_tools_detall`
--
DELIMITER $$
CREATE TRIGGER `returned_tool` AFTER UPDATE ON `exit_tools_detall` FOR EACH ROW BEGIN
DECLARE v_disponible INT;
SELECT quantity_available INTO v_disponible FROM tools WHERE id_tool = NEW.id_tool;
IF NEW.returned != OLD.returned THEN
  IF NEW.returned = 0 THEN
      UPDATE tools SET quantity_available =    quantity_available -       NEW.quantity WHERE id_tool = NEW.id_tool;
    ELSE
      UPDATE tools SET quantity_available =    quantity_available +       NEW.quantity WHERE id_tool = NEW.id_tool;
    END IF;
END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_quantity_tool` BEFORE INSERT ON `exit_tools_detall` FOR EACH ROW BEGIN
DECLARE v_disponible INT;
SELECT quantity_available INTO v_disponible FROM tools WHERE id_tool = NEW.id_tool;
IF v_disponible > 0 AND v_disponible >= NEW.quantity THEN 
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
  `destination` varchar(50) NOT NULL DEFAULT 'Interno',
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expiration_stock`
--

CREATE TABLE `expiration_stock` (
  `id_expiration` int(11) NOT NULL,
  `id_stock` int(11) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `amount_due` int(11) NOT NULL,
  `note` varchar(150) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `get_products`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `get_products` (
`code` varchar(30)
,`toxicological` varchar(5)
,`zone` set('A','B')
,`id_product` int(11)
,`name_product` varchar(100)
,`description_product` varchar(250)
,`id_cellar` int(11)
,`num_orders` int(11)
,`creation_date` timestamp
,`name_cellar` varchar(50)
,`icon_cellar` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `get_stock`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `get_stock` (
`icon_cellar` varchar(50)
,`id_measure` int(11)
,`code` varchar(30)
,`toxicological` varchar(5)
,`name_receive` varchar(101)
,`zone` set('A','B')
,`id_stock` int(11)
,`state` tinyint(1)
,`nom_lot` varchar(100)
,`amount` float
,`expiration_date` date
,`expiration_create` timestamp
,`comercializadora` varchar(100)
,`id_product` int(11)
,`name_product` varchar(100)
,`prefix_measure` varchar(6)
,`name_measure` varchar(20)
,`id_user_create` int(11)
,`id_cellar` int(11)
,`creation_date` timestamp
,`name_cellar` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `index_expiration_record`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `index_expiration_record` (
`zone` set('A','B')
,`note` varchar(150)
,`amount_due` int(11)
,`creation` date
,`expiration_date` date
,`name_user` varchar(50)
,`name_product` varchar(100)
,`nom_lot` varchar(100)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `index_stock_plant`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `index_stock_plant` (
`proceso` varchar(7)
,`icon_cellar` varchar(50)
,`state` tinyint(4)
,`quantity` float
,`name_receive` varchar(101)
,`prefix_measure` varchar(6)
,`id_proceso` int(11)
,`date_create` timestamp
,`name_product` varchar(100)
,`name_cellar` varchar(50)
,`nom_lot` varchar(100)
,`expiration_date` date
,`id_stock` int(11)
,`code` varchar(30)
,`toxicological` varchar(5)
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
(1, 1, 0, 1, 7, 'cancelado pedido', 0, 'delete', '2017-12-07 15:24:22');

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
(1, 'Kilogramo', 'Kg', 7, '2017-12-07 14:58:22');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `planta_stock`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `planta_stock` (
`icon_cellar` varchar(50)
,`code` varchar(30)
,`toxicological` varchar(5)
,`id_product` int(11)
,`zone` set('A','B')
,`expiration_date` date
,`state` tinyint(1)
,`id_stock_plant` int(11)
,`quantity` float
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
  `toxicological_category` varchar(5) DEFAULT NULL,
  `code` varchar(30) DEFAULT NULL,
  `id_user_create` int(11) NOT NULL,
  `id_cellar` int(11) NOT NULL,
  `num_orders` int(11) NOT NULL DEFAULT '0',
  `zone` set('A','B') NOT NULL DEFAULT 'A',
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id_product`, `name_product`, `description_product`, `toxicological_category`, `code`, `id_user_create`, `id_cellar`, `num_orders`, `zone`, `creation_date`) VALUES
(1, 'Bicarbonato de sodio', 'Bicarbonato de sodio', 'No', '', 7, 1, 1, 'A', '2017-12-07 15:20:26'),
(2, 'Bicarbonato de sodio', 'Bicarbonato de sodio a', 'No', '', 7, 2, 1, 'A', '2017-12-07 15:20:26');

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_role` int(11) NOT NULL,
  `name_rol` varchar(20) NOT NULL,
  `description_role` varchar(50) NOT NULL,
  `level` varchar(10) NOT NULL,
  `zone` set('A','B') NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_role`, `name_rol`, `description_role`, `level`, `zone`) VALUES
(1, 'Administrador', 'hace de todo', 'A_A-a_1', 'A'),
(2, 'Administrador Planta', 'Super planta', 'a_A_2_a2', 'B'),
(3, 'Bodeguero', 'Encargado de bodegas', 'B_1-b_1', 'A'),
(4, 'Aprendiz', 'Estudiante sena', 'E_1_S1', 'A'),
(6, 'Bodeguero Planta', 'Bodeguero sona B', 'b_2_b2_', 'B'),
(7, 'Aprendiz Planta', 'Aprendiz Planta', 'A1-_1B', 'B');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `show_exit_stock`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `show_exit_stock` (
`zone` set('A','B')
,`toxicological_category` varchar(5)
,`icon_cellar` varchar(50)
,`name_product` varchar(100)
,`name_cellar` varchar(50)
,`nom_lot` varchar(100)
,`id_stock` int(11)
,`id_exit_product_master` int(11)
,`quantity` float
,`note` text
,`amount` float
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
  `amount` float NOT NULL,
  `amount_income` float NOT NULL,
  `expiration_date` date NOT NULL,
  `expiration_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comercializadora` varchar(100) NOT NULL,
  `unit_measure` int(11) NOT NULL DEFAULT '1',
  `id_user_create` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `stock`
--

INSERT INTO `stock` (`id_stock`, `id_product`, `nom_lot`, `amount`, `amount_income`, `expiration_date`, `expiration_create`, `comercializadora`, `unit_measure`, `id_user_create`, `state`) VALUES
(1, 1, '3erf67', 3, 3, '2018-12-14', '2017-12-07 15:01:16', 'La granja', 1, 7, 1),
(2, 2, 'e45r56', 20, 1, '2018-01-12', '2017-12-07 15:02:16', 'La granja', 1, 7, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock_plant`
--

CREATE TABLE `stock_plant` (
  `id_stock_plant` int(11) NOT NULL,
  `id_stock` int(11) NOT NULL,
  `quantity` float NOT NULL,
  `id_exit_product` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `stock_plant`
--

INSERT INTO `stock_plant` (`id_stock_plant`, `id_stock`, `quantity`, `id_exit_product`, `state`, `date_create`) VALUES
(1, 1, 1, 1, 0, '2017-12-07 15:20:27'),
(2, 2, 1, 1, 1, '2017-12-07 15:20:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tools`
--

CREATE TABLE `tools` (
  `id_tool` int(11) NOT NULL,
  `name_tool` varchar(20) NOT NULL,
  `mark` varchar(15) DEFAULT NULL,
  `total_quantity` int(11) NOT NULL,
  `quantity_available` int(4) NOT NULL,
  `id_cellar` int(11) NOT NULL,
  `id_user_create` int(11) NOT NULL,
  `zone` set('A','B') NOT NULL DEFAULT 'A',
  `state` set('0','1') NOT NULL DEFAULT '1',
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(7, 'Administrador', 'Subsede', 'd4n7elfelipe@gmail.com', '123456789', '$2y$10$m.1vUfQV5jIf3qx6jSIE.O1ZdJB8pwiCz88W2/maYIVQY9nkCNdc.', 4, 1, 1),
(29, 'Administrador', 'Planta', 'inventariosubsede@gmail.com', '12345678', '$2y$10$.PRsKEc0nscvJQnB8MmOPuEWvPzOp6Vn8.Qa7AnMEGoZ673GmDSbm', 2, 2, 1);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_exit_plant`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_exit_plant` (
`id_detalle` int(11)
,`id_exit_master` int(11)
,`prefix_measure` varchar(6)
,`id_user_receives` varchar(11)
,`name_user_receives` varchar(50)
,`id_user_delivery` int(11)
,`destination` varchar(40)
,`date_create` timestamp
,`proceso` varchar(20)
,`id_proceso` int(11)
,`quantity` float
,`note` varchar(60)
,`state` tinyint(4)
,`id_stock` int(11)
,`nom_lot` varchar(100)
,`amount` float
,`name_product` varchar(100)
,`toxicological` varchar(5)
,`code` varchar(30)
,`name_cellar` varchar(50)
,`name_user` varchar(50)
,`last_name_user` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `get_products`
--
DROP TABLE IF EXISTS `get_products`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `get_products`  AS  select `products`.`code` AS `code`,`products`.`toxicological_category` AS `toxicological`,`products`.`zone` AS `zone`,`products`.`id_product` AS `id_product`,`products`.`name_product` AS `name_product`,`products`.`description_product` AS `description_product`,`products`.`id_cellar` AS `id_cellar`,`products`.`num_orders` AS `num_orders`,`products`.`creation_date` AS `creation_date`,`cellar`.`name_cellar` AS `name_cellar`,`cellar`.`icon_cellar` AS `icon_cellar` from (`products` join `cellar` on((`products`.`id_cellar` = `cellar`.`id_cellar`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `get_stock`
--
DROP TABLE IF EXISTS `get_stock`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `get_stock`  AS  select `cellar`.`icon_cellar` AS `icon_cellar`,`measure`.`id_measure` AS `id_measure`,`products`.`code` AS `code`,`products`.`toxicological_category` AS `toxicological`,concat(`user`.`name_user`,' ',`user`.`last_name_user`) AS `name_receive`,`products`.`zone` AS `zone`,`stock`.`id_stock` AS `id_stock`,`stock`.`state` AS `state`,`stock`.`nom_lot` AS `nom_lot`,`stock`.`amount` AS `amount`,`stock`.`expiration_date` AS `expiration_date`,`stock`.`expiration_create` AS `expiration_create`,`stock`.`comercializadora` AS `comercializadora`,`products`.`id_product` AS `id_product`,`products`.`name_product` AS `name_product`,`measure`.`prefix_measure` AS `prefix_measure`,`measure`.`name_measure` AS `name_measure`,`products`.`id_user_create` AS `id_user_create`,`products`.`id_cellar` AS `id_cellar`,`stock`.`expiration_create` AS `creation_date`,`cellar`.`name_cellar` AS `name_cellar` from ((((`stock` join `products` on((`stock`.`id_product` = `products`.`id_product`))) join `cellar` on((`products`.`id_cellar` = `cellar`.`id_cellar`))) join `measure` on((`stock`.`unit_measure` = `measure`.`id_measure`))) join `user` on((`stock`.`id_user_create` = `user`.`id_user`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `index_expiration_record`
--
DROP TABLE IF EXISTS `index_expiration_record`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `index_expiration_record`  AS  select `products`.`zone` AS `zone`,`expiration_stock`.`note` AS `note`,`expiration_stock`.`amount_due` AS `amount_due`,cast(`expiration_stock`.`date_create` as date) AS `creation`,`stock`.`expiration_date` AS `expiration_date`,`user`.`name_user` AS `name_user`,`products`.`name_product` AS `name_product`,`stock`.`nom_lot` AS `nom_lot` from (((`expiration_stock` join `user` on((`expiration_stock`.`id_user` = `user`.`id_user`))) join `stock` on((`expiration_stock`.`id_stock` = `stock`.`id_stock`))) join `products` on((`stock`.`id_product` = `products`.`id_product`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `index_stock_plant`
--
DROP TABLE IF EXISTS `index_stock_plant`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `index_stock_plant`  AS  select concat('Interno') AS `proceso`,`planta_stock`.`icon_cellar` AS `icon_cellar`,`planta_stock`.`state` AS `state`,`planta_stock`.`quantity` AS `quantity`,`planta_stock`.`name_user` AS `name_receive`,`planta_stock`.`prefix_measure` AS `prefix_measure`,`planta_stock`.`id_stock_plant` AS `id_proceso`,`planta_stock`.`date_create` AS `date_create`,`planta_stock`.`name_product` AS `name_product`,`planta_stock`.`name_cellar` AS `name_cellar`,`planta_stock`.`nom_lot` AS `nom_lot`,`planta_stock`.`expiration_date` AS `expiration_date`,`planta_stock`.`id_stock` AS `id_stock`,`planta_stock`.`code` AS `code`,`planta_stock`.`toxicological` AS `toxicological` from `planta_stock` union select concat('Externo') AS `proccess`,`get_stock`.`icon_cellar` AS `icon_cellar`,`get_stock`.`state` AS `state`,`get_stock`.`amount` AS `amount`,`get_stock`.`name_receive` AS `name_receive`,`get_stock`.`prefix_measure` AS `prefix_measure`,`get_stock`.`id_stock` AS `id_stock`,`get_stock`.`creation_date` AS `creation_date`,`get_stock`.`name_product` AS `name_product`,`get_stock`.`name_cellar` AS `name_cellar`,`get_stock`.`nom_lot` AS `nom_lot`,`get_stock`.`expiration_date` AS `expiration_date`,`get_stock`.`id_stock` AS `id_stock`,`get_stock`.`code` AS `code`,`get_stock`.`toxicological` AS `toxicological` from `get_stock` where (`get_stock`.`zone` = 'B') ;

-- --------------------------------------------------------

--
-- Estructura para la vista `planta_stock`
--
DROP TABLE IF EXISTS `planta_stock`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `planta_stock`  AS  select `cellar`.`icon_cellar` AS `icon_cellar`,`products`.`code` AS `code`,`products`.`toxicological_category` AS `toxicological`,`products`.`id_product` AS `id_product`,`products`.`zone` AS `zone`,`stock`.`expiration_date` AS `expiration_date`,`stock_plant`.`state` AS `state`,`stock_plant`.`id_stock_plant` AS `id_stock_plant`,`stock_plant`.`quantity` AS `quantity`,`stock_plant`.`id_stock` AS `id_stock`,`user`.`name_user` AS `name_user`,`user`.`last_name_user` AS `last_name_user`,`exit_product_master`.`name_receive` AS `name_receive`,`stock_plant`.`id_exit_product` AS `id_exit_product`,`stock_plant`.`date_create` AS `date_create`,`products`.`name_product` AS `name_product`,`cellar`.`name_cellar` AS `name_cellar`,`measure`.`prefix_measure` AS `prefix_measure`,`stock`.`nom_lot` AS `nom_lot` from ((((((`stock_plant` join `exit_product_master` on((`stock_plant`.`id_exit_product` = `exit_product_master`.`id_exit_product`))) join `stock` on((`stock_plant`.`id_stock` = `stock`.`id_stock`))) join `user` on((`exit_product_master`.`user_delivery` = `user`.`id_user`))) join `products` on((`stock`.`id_product` = `products`.`id_product`))) join `cellar` on((`products`.`id_cellar` = `cellar`.`id_cellar`))) join `measure` on((`stock`.`unit_measure` = `measure`.`id_measure`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `show_exit_stock`
--
DROP TABLE IF EXISTS `show_exit_stock`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `show_exit_stock`  AS  select `products`.`zone` AS `zone`,`products`.`toxicological_category` AS `toxicological_category`,`cellar`.`icon_cellar` AS `icon_cellar`,`products`.`name_product` AS `name_product`,`cellar`.`name_cellar` AS `name_cellar`,`stock`.`nom_lot` AS `nom_lot`,`exit_product_detalle`.`id_stock` AS `id_stock`,`exit_product_detalle`.`id_exit_product_master` AS `id_exit_product_master`,`exit_product_detalle`.`quantity` AS `quantity`,`exit_product_detalle`.`note` AS `note`,`stock`.`amount` AS `amount`,`exit_product_detalle`.`id_exit_product_detalle` AS `id_exit_product_detalle`,`exit_product_detalle`.`state` AS `state`,`exit_product_master`.`user_receives` AS `user_receives`,`exit_product_master`.`destination` AS `destination`,`exit_product_master`.`delivery` AS `delivery`,`user`.`name_user` AS `name_user`,`user`.`last_name_user` AS `last_name_user`,`exit_product_master`.`name_receive` AS `name_receive`,`exit_product_master`.`date_create` AS `date_create`,`measure`.`prefix_measure` AS `prefix_measure` from ((((((`exit_product_master` join `exit_product_detalle` on((`exit_product_master`.`id_exit_product` = `exit_product_detalle`.`id_exit_product_master`))) join `stock` on((`exit_product_detalle`.`id_stock` = `stock`.`id_stock`))) join `products` on((`stock`.`id_product` = `products`.`id_product`))) join `user` on((`exit_product_master`.`user_delivery` = `user`.`id_user`))) join `measure` on((`stock`.`unit_measure` = `measure`.`id_measure`))) join `cellar` on((`products`.`id_cellar` = `cellar`.`id_cellar`))) order by `exit_product_master`.`id_exit_product` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_exit_plant`
--
DROP TABLE IF EXISTS `view_exit_plant`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_exit_plant`  AS  select `exit_detalle_plant`.`id_detalle` AS `id_detalle`,`exit_master_plant`.`id_exit_master` AS `id_exit_master`,`measure`.`prefix_measure` AS `prefix_measure`,`exit_master_plant`.`id_user_receives` AS `id_user_receives`,`exit_master_plant`.`name_user_receives` AS `name_user_receives`,`exit_master_plant`.`id_user_delivery` AS `id_user_delivery`,`exit_master_plant`.`destination` AS `destination`,`exit_master_plant`.`date_create` AS `date_create`,`exit_detalle_plant`.`proceso` AS `proceso`,`exit_detalle_plant`.`id_proceso` AS `id_proceso`,`exit_detalle_plant`.`quantity` AS `quantity`,`exit_detalle_plant`.`note` AS `note`,`exit_detalle_plant`.`state` AS `state`,`stock`.`id_stock` AS `id_stock`,`stock`.`nom_lot` AS `nom_lot`,`stock`.`amount` AS `amount`,`products`.`name_product` AS `name_product`,`products`.`toxicological_category` AS `toxicological`,`products`.`code` AS `code`,`cellar`.`name_cellar` AS `name_cellar`,`user`.`name_user` AS `name_user`,`user`.`last_name_user` AS `last_name_user` from ((((((`exit_master_plant` join `exit_detalle_plant` on((`exit_master_plant`.`id_exit_master` = `exit_detalle_plant`.`id_exit__master`))) join `stock` on((`exit_detalle_plant`.`id_proceso` = `stock`.`id_stock`))) join `products` on((`stock`.`id_product` = `products`.`id_product`))) join `cellar` on((`products`.`id_cellar` = `cellar`.`id_cellar`))) join `measure` on((`stock`.`unit_measure` = `measure`.`id_measure`))) join `user` on((`exit_master_plant`.`id_user_delivery` = `user`.`id_user`))) where (`exit_detalle_plant`.`proceso` = 'Externo') union select `exit_detalle_plant`.`id_detalle` AS `id_detalle`,`exit_master_plant`.`id_exit_master` AS `id_exit_master`,`measure`.`prefix_measure` AS `prefix_measure`,`exit_master_plant`.`id_user_receives` AS `id_user_receives`,`exit_master_plant`.`name_user_receives` AS `name_user_receives`,`exit_master_plant`.`id_user_delivery` AS `id_user_delivery`,`exit_master_plant`.`destination` AS `destination`,`exit_master_plant`.`date_create` AS `date_create`,`exit_detalle_plant`.`proceso` AS `proceso`,`exit_detalle_plant`.`id_proceso` AS `id_proceso`,`exit_detalle_plant`.`quantity` AS `quantity`,`exit_detalle_plant`.`note` AS `note`,`exit_detalle_plant`.`state` AS `state`,`stock_plant`.`id_stock` AS `id_stock`,`stock`.`nom_lot` AS `nom_lot`,`stock_plant`.`quantity` AS `quantity`,`products`.`name_product` AS `name_product`,`products`.`toxicological_category` AS `toxicological_category`,`products`.`code` AS `code`,`cellar`.`name_cellar` AS `name_cellar`,`user`.`name_user` AS `name_user`,`user`.`last_name_user` AS `last_name_user` from (((((((`exit_master_plant` join `exit_detalle_plant` on((`exit_master_plant`.`id_exit_master` = `exit_detalle_plant`.`id_exit__master`))) join `stock_plant` on((`exit_detalle_plant`.`id_proceso` = `stock_plant`.`id_stock_plant`))) join `stock` on((`stock_plant`.`id_stock` = `stock`.`id_stock`))) join `products` on((`stock`.`id_product` = `products`.`id_product`))) join `cellar` on((`products`.`id_cellar` = `cellar`.`id_cellar`))) join `measure` on((`stock`.`unit_measure` = `measure`.`id_measure`))) join `user` on((`exit_master_plant`.`id_user_delivery` = `user`.`id_user`))) ;

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
-- Indices de la tabla `exit_detalle_plant`
--
ALTER TABLE `exit_detalle_plant`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_exit__master` (`id_exit__master`);

--
-- Indices de la tabla `exit_equipment_master`
--
ALTER TABLE `exit_equipment_master`
  ADD PRIMARY KEY (`id_exit`),
  ADD KEY `id_user_receives` (`id_user_receives`),
  ADD KEY `exit_equipment_master_ibfk_1` (`id_user_delivery`);

--
-- Indices de la tabla `exit_master_plant`
--
ALTER TABLE `exit_master_plant`
  ADD PRIMARY KEY (`id_exit_master`);

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
-- Indices de la tabla `expiration_stock`
--
ALTER TABLE `expiration_stock`
  ADD PRIMARY KEY (`id_expiration`),
  ADD UNIQUE KEY `id_stock` (`id_stock`);

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
  MODIFY `id_cellar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `equipments`
--
ALTER TABLE `equipments`
  MODIFY `id_equipment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `exit_detalle_plant`
--
ALTER TABLE `exit_detalle_plant`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `exit_equipment_master`
--
ALTER TABLE `exit_equipment_master`
  MODIFY `id_exit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `exit_master_plant`
--
ALTER TABLE `exit_master_plant`
  MODIFY `id_exit_master` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `exit_product_detalle`
--
ALTER TABLE `exit_product_detalle`
  MODIFY `id_exit_product_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `exit_product_master`
--
ALTER TABLE `exit_product_master`
  MODIFY `id_exit_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `exit_teams_detall`
--
ALTER TABLE `exit_teams_detall`
  MODIFY `id_exit_detall` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `exit_tools_detall`
--
ALTER TABLE `exit_tools_detall`
  MODIFY `id_exit_detall` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `exit_tools_master`
--
ALTER TABLE `exit_tools_master`
  MODIFY `id_exit` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `expiration_stock`
--
ALTER TABLE `expiration_stock`
  MODIFY `id_expiration` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `integridad_stock_plant`
--
ALTER TABLE `integridad_stock_plant`
  MODIFY `id_integridad` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `intergridad_exit_product_detalle`
--
ALTER TABLE `intergridad_exit_product_detalle`
  MODIFY `id_integridad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `measure`
--
ALTER TABLE `measure`
  MODIFY `id_measure` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `recover_password`
--
ALTER TABLE `recover_password`
  MODIFY `id_recover` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `stock`
--
ALTER TABLE `stock`
  MODIFY `id_stock` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `stock_plant`
--
ALTER TABLE `stock_plant`
  MODIFY `id_stock_plant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tools`
--
ALTER TABLE `tools`
  MODIFY `id_tool` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
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
-- Filtros para la tabla `exit_detalle_plant`
--
ALTER TABLE `exit_detalle_plant`
  ADD CONSTRAINT `exit_detalle_plant_ibfk_1` FOREIGN KEY (`id_exit__master`) REFERENCES `exit_master_plant` (`id_exit_master`);

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