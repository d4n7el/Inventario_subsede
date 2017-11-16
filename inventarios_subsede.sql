-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:8889
-- Tiempo de generación: 16-11-2017 a las 22:22:50
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
  `description_cellar` varchar(100) NOT NULL,
  `icon_cellar` varchar(50) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cellar`
--

INSERT INTO `cellar` (`id_cellar`, `name_cellar`, `description_cellar`, `icon_cellar`, `date_create`) VALUES
(1, 'Fruver', 'Bodega Frutas y verduras', '../image/fruver.svg', '2017-11-09 14:32:32'),
(2, 'Lacteos', 'Bodega lacteos', '../image/lacteos.svg', '2017-11-09 14:21:44'),
(3, 'Carnicos', 'Bodega carnicos', '../image/carnicos.svg', '2017-11-09 14:50:22'),
(4, 'Agroinsumos', 'Bodega Insumos', '../image/agroInsumos.svg', '2017-11-09 16:51:56'),
(5, 'Equipos', 'Bodega equipos', ' ../image/equipos.svg', '2017-11-09 15:02:52'),
(6, 'Herramientas', 'Bodega Herramientas', '../image/herramientas.svg', '2017-11-09 14:32:20'),
(7, 'AgroIndustria', 'AgroIndustria', '../image/agroIndustria.svg', '2017-11-09 16:52:01'),
(8, 'Pecuario', 'Pecuario', '../image/pecuario.svg', '2017-11-09 14:57:42'),
(10, 'Quimicos', 'quinicos', '../image/quimicos.svg', '2017-11-09 14:46:32');

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
(6, 'Beaker 100 Ml', 'Beaker', 6, 6, 5, 29, 'B', '1', '2017-11-06 16:32:12'),
(7, 'Erlenmeyer 250 ML', 'Erlenmeyer', 20, 20, 5, 29, 'B', '1', '2017-11-06 16:32:44'),
(8, 'Frasco tapa azul 250 Ml', 'Frasco', 20, 20, 5, 29, 'B', '1', '2017-11-06 16:33:12'),
(9, 'Beaker plastico 100 ML', 'Beaker plastico', 6, 5, 5, 29, 'B', '1', '2017-11-06 16:33:39'),
(10, 'Beaker plastico 600 Ml', 'Beaker plastico', 2, 2, 5, 29, 'B', '1', '2017-11-06 16:34:03'),
(11, 'Beaker plastico 1000 Ml', 'Beaker plastico', 1, 1, 5, 29, 'B', '1', '2017-11-06 16:34:42'),
(12, 'Beaker plastico 2000 ML', 'Beaker plastico', 1, 1, 5, 29, 'B', '1', '2017-11-06 16:35:01'),
(13, 'Envudo en V plastico', 'Envudo', 10, 10, 5, 29, 'B', '1', '2017-11-06 16:35:45'),
(14, 'Probeta plastica 100 ML', 'Probeta plastica', 1, 1, 5, 29, 'B', '1', '2017-11-06 16:36:30'),
(15, 'Probeta plastica 500 ML', 'Probeta plastica', 2, 2, 5, 29, 'B', '1', '2017-11-06 16:36:46'),
(16, 'Probeta plastica 1000 ML', 'Probeta plastica', 1, 1, 5, 29, 'B', '1', '2017-11-06 16:37:05'),
(17, 'Pantallas', 'Pantallas', 8, 5, 5, 7, 'A', '0', '2017-11-06 17:19:28'),
(18, 'Decametro', 'Decametro', 2, 0, 5, 7, 'A', '0', '2017-11-06 17:26:33'),
(19, 'cosechadora de frutos', 'cosechadora de frutos', 3, 0, 5, 7, 'A', '0', '2017-11-06 17:26:54'),
(20, 'Tronzadora', 'Tronzadora', 1, 0, 5, 7, 'A', '0', '2017-11-06 17:27:17'),
(21, 'Seguetas', 'Seguetas', 3, 0, 5, 7, 'A', '1', '2017-11-06 17:27:39'),
(22, 'Nivel', 'Nivel', 2, 1, 5, 7, 'A', '1', '2017-11-06 17:27:54'),
(23, 'Martillos', 'Martillos', 6, 5, 5, 7, 'A', '1', '2017-11-06 17:28:19'),
(24, 'LLaves boca fija', 'LLaves boca fija', 23, 23, 5, 7, 'A', '1', '2017-11-06 17:29:15'),
(25, 'Cepillo', '', 1, 1, 5, 7, 'A', '1', '2017-11-06 17:31:24'),
(26, 'destornilladores', '', 17, 17, 5, 7, 'A', '1', '2017-11-06 17:31:33'),
(27, 'Moto sierra', '', 2, 0, 5, 7, 'A', '1', '2017-11-06 17:31:49'),
(28, 'taladro mano', '', 2, 2, 5, 7, 'A', '1', '2017-11-06 17:32:02'),
(29, 'Pulidora', '', 1, 1, 5, 7, 'A', '1', '2017-11-06 17:32:33'),
(30, 'taladro Inalambrico', '', 1, 1, 5, 7, 'A', '1', '2017-11-06 17:32:56'),
(31, 'Hidrolavadora', '', 1, 1, 5, 7, 'A', '1', '2017-11-06 17:33:35'),
(32, 'trajes apicultura', '', 33, 33, 5, 7, 'A', '1', '2017-11-06 17:33:51'),
(33, 'taladro', 'black', 20, 5, 5, 30, 'A', '1', '2017-11-09 18:51:59'),
(34, 'pulidora', '', 30, 20, 5, 30, 'A', '1', '2017-11-09 18:54:24'),
(35, 'llaves', '', 24, 24, 5, 7, 'A', '1', '2017-11-14 19:11:55'),
(36, 'seguetas', '', 3, 3, 5, 7, 'A', '1', '2017-11-14 19:12:08'),
(37, 'fumigadoras', '', 48, 48, 5, 7, 'A', '1', '2017-11-14 19:12:34'),
(38, 'guadañas', '', 4, 4, 5, 7, 'A', '1', '2017-11-14 19:13:09'),
(39, 'destornilladores', '', 9, 9, 5, 7, 'A', '1', '2017-11-14 19:13:53'),
(40, 'caretas', '', 3, 3, 5, 7, 'A', '1', '2017-11-14 19:14:07'),
(41, 'motosierras', '', 3, 3, 5, 7, 'A', '1', '2017-11-14 19:16:33'),
(42, 'pulidoras', '', 3, 3, 5, 7, 'A', '1', '2017-11-14 19:16:51'),
(43, 'taladros', '', 2, 2, 5, 7, 'A', '1', '2017-11-14 19:17:02'),
(44, 'decametro', '', 7, 7, 5, 7, 'A', '1', '2017-11-14 19:17:18'),
(45, 'proteccion de esmeril', '', 1, 1, 5, 7, 'A', '1', '2017-11-14 19:17:57'),
(46, 'equipos de guadañas', '', 2, 2, 5, 7, 'A', '1', '2017-11-14 19:18:45'),
(47, 'soldador', '', 1, 1, 5, 7, 'A', '1', '2017-11-14 19:20:59'),
(48, 'grameras', '', 2, 2, 5, 7, 'A', '1', '2017-11-14 19:22:06');

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
-- Volcado de datos para la tabla `exit_detalle_plant`
--

INSERT INTO `exit_detalle_plant` (`id_detalle`, `id_exit__master`, `proceso`, `id_proceso`, `quantity`, `note`, `state`) VALUES
(23, 13, 'Interno', 4, 1, 'aa', 1),
(24, 14, 'Interno', 2, 14, 'buenos', 1),
(26, 16, 'Externo', 16, 12, 'aaa', 1),
(27, 17, 'Interno', 7, 1, 'bueno', 1),
(28, 17, 'Interno', 6, 1, 'bien', 1),
(29, 18, 'Interno', 5, 1, 'aa', 1),
(30, 19, 'Externo', 13, 20.5, 'a', 1),
(31, 19, 'Externo', 15, 10, 'b', 1),
(32, 19, 'Externo', 14, 13, 'c', 1);

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
(38, 12, 'carlos diaz Soto', 29, 'Interno', '2017-11-06 16:44:53'),
(39, 15, 'oto Herrera Soto', 29, 'Interno', '2017-11-07 02:13:26'),
(40, 12, 'carlos diaz Soto', 30, 'Interno', '2017-11-09 19:02:57'),
(41, 16, 'carlos diaz Soto', 30, 'Interno', '2017-11-09 19:05:47'),
(42, 12, 'carlos diaz Soto', 30, 'Interno', '2017-11-09 19:16:07'),
(43, 0, '', 7, '', '2017-11-10 23:08:19'),
(44, 0, '', 7, '', '2017-11-10 23:08:55'),
(45, 12, 'carlos diaz Soto', 7, 'Interno', '2017-11-10 23:09:47'),
(46, 12, 'carlos diaz Soto', 7, 'Interno', '2017-11-10 23:11:13'),
(47, 12, 'carlos diaz Soto', 7, 'Manizales', '2017-11-10 23:44:35'),
(48, 12, 'carlos diaz Soto', 7, 'Interno', '2017-11-11 22:58:01'),
(49, 12, 'carlos diaz Soto', 7, 'Interno', '2017-11-11 23:03:52'),
(50, 12, 'carlos diaz Soto', 7, 'Manizales', '2017-11-15 01:18:04');

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

--
-- Volcado de datos para la tabla `exit_master_plant`
--

INSERT INTO `exit_master_plant` (`id_exit_master`, `id_user_receives`, `name_user_receives`, `id_user_delivery`, `destination`, `date_create`) VALUES
(13, '12', 'carlos diaz Soto', 29, 'Interno', '2017-11-13 02:41:20'),
(14, '12', 'carlos diaz Soto', 29, 'Manizales', '2017-11-13 02:43:00'),
(15, '12', 'carlos diaz Soto', 29, 'Interno', '2017-11-13 02:44:03'),
(16, '12', 'carlos diaz Soto', 29, 'Interno', '2017-11-13 02:45:10'),
(17, '16', 'carlos diaz Soto', 29, 'Interno', '2017-11-13 02:47:59'),
(18, '12', 'carlos diaz Soto', 29, 'Interno', '2017-11-13 02:48:50'),
(19, '12', 'carlos diaz Soto', 29, 'Interno', '2017-11-13 03:49:51');

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
(1, 1, 19, 14, '', 1),
(2, 3, 23, 1, 'a', 1),
(3, 3, 24, 1, 'a', 1),
(4, 4, 24, 16, 'internas', 1),
(5, 5, 22, 1, '1', 1),
(6, 6, 12, 1, 'bien', 1),
(7, 7, 12, 1, 'bien', 1),
(8, 10, 24, 2, 'aaa', 1),
(9, 11, 23, 1, 'daniel', 1),
(10, 11, 24, 1, 'daniel', 1),
(11, 11, 25, 1, 'daniel', 1),
(12, 12, 25, 10, 'aa', 1),
(13, 13, 25, 1, 'qq', 1),
(14, 14, 25, 1, 'aa', 1),
(15, 15, 25, 1, 'dsa', 1),
(16, 16, 25, 1, 'rew', 1),
(17, 17, 38, 1, 'uhd', 1),
(18, 17, 37, 2, 'IDFOSD', 1),
(19, 17, 36, 2, 'kskssd', 1),
(20, 18, 32, 1, 'rtt', 1),
(21, 18, 33, 1, 'rter', 1),
(22, 18, 34, 2, 'ette', 1);

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
(1, 7, 15, 'oto Herrera Soto', 'Interno', 1, '2017-11-07 02:17:45'),
(2, 7, 12, 'carlos diaz Soto', 'Interno', 1, '2017-11-07 02:27:33'),
(3, 7, 12, 'carlos diaz Soto', 'Manizales', 1, '2017-11-07 15:07:59'),
(4, 7, 12, 'carlos diaz Soto', 'Interno', 1, '2017-11-07 15:11:17'),
(5, 7, 12, 'carlos diaz Soto', 'Interno', 1, '2017-11-07 15:37:50'),
(6, 7, 12, 'carlos diaz Soto', 'Manizales', 1, '2017-11-07 15:41:23'),
(7, 7, 12, 'carlos diaz Soto', 'Manizales', 1, '2017-11-07 15:42:18'),
(8, 7, 12, 'carlos diaz Soto', 'Interno', 1, '2017-11-07 15:47:09'),
(9, 7, 12, 'carlos diaz Soto', 'Interno', 1, '2017-11-07 16:44:45'),
(10, 7, 0, 'carlos diaz Soto', 'Interno', 1, '2017-11-07 16:49:40'),
(11, 7, 12, 'carlos diaz Soto', 'Manizales', 1, '2017-11-10 15:22:24'),
(12, 7, 12, 'carlos diaz Soto', 'Manizales', 1, '2017-11-10 15:25:31'),
(13, 7, 12, 'carlos diaz Soto', 'Interno', 1, '2017-11-10 15:26:44'),
(14, 7, 12, 'carlos diaz Soto', 'Interno', 1, '2017-11-10 15:27:37'),
(15, 7, 12, 'carlos diaz Soto', 'aaa', 1, '2017-11-10 15:30:14'),
(16, 7, 12, 'carlos diaz Soto', 'Interno', 1, '2017-11-10 15:33:00'),
(17, 7, 12, 'carlos diaz Soto', 'ugkj', 1, '2017-11-14 23:04:44'),
(18, 7, 12, 'carlos diaz Soto', 'Manizles', 1, '2017-11-15 18:21:09');

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
(1, 38, 10, 0, 'pruebas', 0, 1, 1),
(2, 38, 7, 0, 'pruebas', 0, 1, 1),
(3, 38, 8, 0, 'pruebas', 0, 1, 1),
(4, 38, 6, 2, 'pruebas', 1, 1, 1),
(5, 39, 7, 0, 'oto', 0, 1, 1),
(6, 40, 17, 3, 'presentación diapositivas', 1, 1, 0),
(7, 41, 31, 0, 'mantenimiento', 0, 1, 1),
(8, 41, 25, 1, 'mantenimiento', 1, 1, 1),
(9, 41, 26, 7, 'mantenimiento', 1, 1, 1),
(10, 41, 27, 2, 'mantenimiento', 1, 1, 0),
(11, 42, 21, 2, 'bhjklñ', 1, 1, 0),
(12, 43, 18, 1, '1', 1, 1, 0),
(13, 44, 18, 1, '1', 1, 1, 0),
(14, 45, 19, 1, '1', 1, 1, 0),
(15, 46, 20, 1, '1', 1, 1, 0),
(16, 46, 19, 1, '1', 1, 1, 0),
(17, 47, 21, 1, 'buenos', 1, 1, 0),
(18, 47, 19, 1, 'buenos', 1, 1, 0),
(19, 48, 23, 1, 'aaa', 1, 1, 0),
(20, 48, 22, 1, 'aaa', 1, 1, 0),
(21, 49, 22, 1, 'jhgfd', 1, 1, 1),
(22, 50, 24, 3, 'aa', 1, 1, 1),
(23, 50, 23, 3, 'bb', 1, 1, 1),
(24, 50, 22, 1, 'cc', 1, 1, 1);

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
-- Volcado de datos para la tabla `exit_tools_detall`
--

INSERT INTO `exit_tools_detall` (`id_exit_detall`, `id_exit`, `id_tool`, `quantity`, `note_received`, `state`, `delivered`, `returned`) VALUES
(1, 1, 10, 0, 'bueno', 0, 1, 1),
(2, 2, 10, 1, 'buena', 1, 1, 1),
(3, 3, 16, 15, 's', 1, 1, 0),
(4, 8, 15, 3, 'sdd', 1, 1, 1),
(5, 8, 17, 1, 'efd', 1, 1, 1),
(6, 9, 16, 1, '1', 1, 1, 0),
(7, 9, 15, 1, '1', 1, 1, 0),
(8, 9, 14, 1, '1', 1, 1, 0),
(9, 9, 13, 11, '1', 1, 1, 1),
(10, 10, 14, 2, 'salen', 1, 1, 0),
(11, 11, 22, 1, 'sds', 1, 1, 0),
(12, 11, 21, 1, 'dfd', 1, 1, 0);

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

--
-- Volcado de datos para la tabla `exit_tools_master`
--

INSERT INTO `exit_tools_master` (`id_exit`, `id_user_receives`, `name_user_receive`, `id_user_delivery`, `destination`, `date_create`) VALUES
(1, 12, 'carlos diaz Soto', 29, 'Interno', '2017-11-06 23:25:38'),
(2, 12, 'carlos diaz Soto', 29, 'Interno', '2017-11-08 03:28:02'),
(3, 12, 'carlos diaz Soto', 30, 'Interno', '2017-11-09 19:41:37'),
(4, 12, 'carlos diaz Soto', 7, 'Interno', '2017-11-09 19:50:45'),
(5, 12, 'carlos diaz Soto', 7, 'Interno', '2017-11-09 19:50:46'),
(6, 12, 'carlos diaz Soto', 7, 'Interno', '2017-11-09 19:50:46'),
(7, 12, 'carlos diaz Soto', 7, 'Interno', '2017-11-09 19:50:47'),
(8, 12, 'carlos diaz Soto', 7, 'Interno', '2017-11-09 19:53:04'),
(9, 12, 'carlos diaz Soto', 7, 'Interno', '2017-11-10 20:24:07'),
(10, 12, 'carlos diaz Soto', 7, 'Armenia', '2017-11-10 20:25:34'),
(11, 16, 'carlos diaz Soto', 7, 'Interno', '2017-11-14 19:07:19');

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

--
-- Volcado de datos para la tabla `expiration_stock`
--

INSERT INTO `expiration_stock` (`id_expiration`, `id_stock`, `date_create`, `amount_due`, `note`, `id_user`) VALUES
(1, 26, '2017-11-15 02:04:24', 2, 'se daño y ya', 7),
(2, 27, '2017-11-15 18:23:38', 2, 'jyfhfhgh', 7);

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

--
-- Volcado de datos para la tabla `integridad_stock_plant`
--

INSERT INTO `integridad_stock_plant` (`id_integridad`, `id_stock_plant`, `quantity`, `old_quantity`, `id_user`, `note`, `date_create`) VALUES
(1, 2, 20, 16, 29, 'fds', '2017-11-08 00:45:39');

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
(1, 1, 14, 12, 7, 'bien', 1, 'Update', '2017-11-07 02:31:36'),
(2, 8, 2, 1, 31, 'bien', 1, 'Update', '2017-11-10 00:45:24');

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
(4, 'Tonelada', 'Tl', 7, '2017-10-19 05:56:31'),
(5, 'Unidad', 'Un', 7, '2017-10-27 15:55:12'),
(6, 'Gramos', 'Gr', 7, '2017-11-01 23:17:17'),
(7, 'cc', 'cc', 7, '2017-11-02 03:10:39'),
(9, 'Litro', 'Lt', 7, '2017-11-02 03:15:58');

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
(20, 'Cocoa alcalina', 'Cocoa alcalina', 'No', '', 29, 2, 2, 'B', '2017-11-07 15:42:18'),
(21, 'Escencia de vainilla', 'Escencia de vainilla', 'No', '', 29, 2, 0, 'B', '2017-11-06 17:01:56'),
(22, 'Esencia de mora', 'Esencia de mora', 'No', '', 29, 2, 0, 'B', '2017-11-06 17:02:23'),
(23, 'Bicarbonato de sodio', 'Bicarbonato de sodio', 'No', '', 29, 2, 0, 'B', '2017-11-06 17:03:41'),
(24, 'Color Mora', 'Color Mora', 'No', '', 29, 2, 0, 'B', '2017-11-06 17:04:04'),
(25, 'Esencia de fresa', 'Esencia de fresa', 'No', '', 29, 2, 0, 'B', '2017-11-06 17:04:31'),
(26, 'Bolsas plasticas', 'bolsas', 'No', '', 29, 7, 0, 'B', '2017-11-06 17:50:47'),
(27, 'Trichotropico', 'alisin * 1 litro', 'IV', '4356', 7, 4, 6, 'A', '2017-11-10 15:33:00'),
(28, 'Ridamil', 'metalixil fungisida', 'III', '3704', 7, 4, 1, 'A', '2017-11-07 02:17:45'),
(29, 'Rutinol', 'ruda', 'III', '4357', 7, 4, 0, 'A', '2017-11-06 22:30:26'),
(30, 'Movento', 'espirotetramat', 'III', '522', 7, 4, 0, 'A', '2017-11-06 22:31:53'),
(31, 'Libersol', 'fertlizante', 'II', '9619', 7, 4, 1, 'A', '2017-11-07 15:37:50'),
(32, 'banano', 'banano', 'No', '', 7, 1, 2, 'A', '2017-11-10 15:22:24'),
(33, 'Savila', 'Savila', 'No', '', 7, 1, 4, 'A', '2017-11-10 15:22:24'),
(34, 'Oxico', 'oxico', 'IV', '123OX', 7, 4, 0, 'A', '2017-11-14 20:31:49'),
(35, 'FUNGINEITOR', 'FUNGINEITOR', 'II', 'fun4tor', 7, 4, 0, 'A', '2017-11-14 20:33:09'),
(36, 'GLIFOSOL', 'GLIFOSOL', 'II', 'glsol', 7, 4, 0, 'A', '2017-11-14 20:34:07'),
(37, 'LIBERSOIL', 'LIBERSOIL', 'II', 'liil43', 7, 4, 0, 'A', '2017-11-14 20:34:56'),
(38, 'ALISIN ', 'ALISIN ', 'III', 'al1in', 7, 4, 1, 'A', '2017-11-15 18:21:09'),
(39, 'AMISTARTOP', 'AMISTARTOP', 'IV', 'am2top', 7, 4, 1, 'A', '2017-11-15 18:21:09'),
(40, 'FIPRONIL', 'FIPRONIL', 'II', 'fi3nil', 7, 4, 1, 'A', '2017-11-15 18:21:09'),
(41, 'PYRINEX', 'PYRINEX', 'II', 'py3ex', 7, 4, 0, 'A', '2017-11-14 20:37:35'),
(42, 'SILVACUR', 'SILVACUR', 'IV', 'si4ur', 7, 4, 1, 'A', '2017-11-14 23:04:44'),
(43, 'CERTUS', 'CERTUS', 'No', 'ce6us', 7, 4, 1, 'A', '2017-11-14 23:04:44'),
(44, 'RHODAX', 'RHODAX', 'II', 'rh6ax', 7, 4, 0, 'A', '2017-11-14 20:40:23'),
(45, 'AGRODINE', 'AGRODINE', 'III', 'ag7ne', 7, 4, 1, 'A', '2017-11-14 23:04:44'),
(46, 'OBERON', 'OBERON', 'II', 'ob8on', 7, 4, 0, 'A', '2017-11-14 20:41:56'),
(47, 'DIPEL', 'DIPEL', 'No', 'di9el', 7, 4, 0, 'A', '2017-11-14 20:43:02'),
(48, 'EUOXIL', 'EUOXIL', 'III', 'eo1il', 7, 4, 0, 'A', '2017-11-14 20:44:21'),
(49, 'NERISECT', 'NERISECT', 'IV', 'ne2ct', 7, 4, 0, 'A', '2017-11-14 20:44:51'),
(50, 'CARLOENDAZILN', 'CARLOENDAZILN', 'No', 'ca3ln', 7, 4, 0, 'A', '2017-11-14 20:45:35'),
(51, 'NATIVO', 'NATIVO', 'II', 'na3vo', 7, 4, 0, 'A', '2017-11-14 20:46:07'),
(52, 'RUTINDL', 'RUTINDL', 'No', 'ru4dl', 7, 4, 0, 'A', '2017-11-14 20:46:32'),
(53, 'ATRANEX', 'ATRANEX', 'III', 'at5ex', 7, 4, 0, 'A', '2017-11-14 20:47:07'),
(54, 'REGIOSL', 'REGIOSL', 'II', 're6sl', 7, 4, 0, 'A', '2017-11-14 20:48:29'),
(55, 'ANTIOQUEÑO', 'ANTIOQUEÑO', 'No', 'an7ño', 7, 4, 0, 'A', '2017-11-14 20:49:00'),
(56, 'OASIS', 'OASIS', 'No', 'oa9is', 7, 4, 0, 'A', '2017-11-14 20:51:23'),
(57, 'EM', 'EM', 'III', 'EM', 7, 4, 0, 'A', '2017-11-14 20:52:03'),
(58, 'ROOTEX', 'ROOTEX', 'No', 'ro1ex', 7, 4, 0, 'A', '2017-11-14 20:52:40'),
(59, 'NITRO K', 'NITRO K', 'II', 'ni2k', 7, 4, 0, 'A', '2017-11-14 20:53:09'),
(60, 'NITRO CALCIO', 'NITRO CALCIO', 'II', 'ni2io', 7, 4, 0, 'A', '2017-11-14 20:53:58'),
(61, 'INSTASOL', 'INSTASOL', 'IV', 'in4ol', 7, 4, 0, 'A', '2017-11-14 20:54:36'),
(62, 'NK', 'NK', 'No', 'NK', 7, 4, 0, 'A', '2017-11-14 20:55:04'),
(63, 'SULFATO DE MAGNESIO', 'SULFATO DE MAGNESIO', 'No', 'sul5sio', 7, 4, 0, 'A', '2017-11-14 20:55:44'),
(64, 'SULFATO DE COBRE PENTAIDRATADO', 'SULFATO DE COBRE PENTAIDRATADO', 'No', 'co7do', 7, 4, 0, 'A', '2017-11-14 20:56:45'),
(65, 'AZUFR', 'AZUFR', 'No', 'az9fr', 7, 4, 0, 'A', '2017-11-14 20:57:11'),
(66, 'MERSTEN', 'MERSTEN', 'II', 'me5en', 7, 4, 0, 'A', '2017-11-14 20:57:58'),
(67, 'NOSUIL', 'NOSUIL', 'III', 'no6il', 7, 4, 0, 'A', '2017-11-14 21:00:51'),
(68, 'AGROCLEAN', 'AGROCLEAN', 'IV', 'ag8an', 7, 4, 0, 'A', '2017-11-14 21:01:57'),
(69, 'BIOTRAMPA', 'BIOTRAMPA', 'II', 'bi1pa', 7, 4, 0, 'A', '2017-11-14 21:03:03');

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
(1, 'E211422X', 'd4n7elfelipe@gmail.com', 1, '2017-11-08 03:57:53'),
(2, 'U996410G', 'd4n7elfelipe@gmail.com', 0, '2017-11-14 20:14:54'),
(3, 'C806980C', 'd4n7elfelipe@gmail.com', 1, '2017-11-16 01:32:50');

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
(12, 20, '12/24', 498, 500, '2017-11-30', '2017-11-06 17:07:50', 'Interno', 7, 29, 1),
(13, 21, '445ie', 79.5, 100, '2017-11-30', '2017-11-06 17:08:33', 'Interno', 6, 29, 1),
(14, 22, '76-89', 67, 80, '2017-11-29', '2017-11-06 17:09:46', 'Interno', 6, 29, 1),
(15, 23, '34iow,we', 90, 100, '2017-11-22', '2017-11-06 17:10:30', 'Inerterno', 6, 29, 1),
(16, 25, '9owñk', 5, 5, '2017-11-30', '2017-11-06 17:11:09', 'Interno', 6, 29, 1),
(17, 26, '12/56', 12, 24, '2019-01-31', '2017-11-06 17:52:01', 'past', 5, 29, 1),
(18, 27, '40/15', 200, 200, '2017-11-28', '2017-11-06 22:35:07', 'Kmit', 0, 7, 1),
(19, 28, '83uiwk-3', 20, 34, '2017-11-21', '2017-11-06 22:36:00', 'hlsio', 6, 7, 1),
(20, 29, '783ikd', 67, 67, '2017-11-21', '2017-11-06 22:37:01', 'hols', 3, 7, 1),
(21, 30, '45/09', 890, 890, '2017-11-26', '2017-11-06 22:47:47', 'last', 6, 7, 1),
(22, 31, '38iek', 31, 32, '2017-12-22', '2017-11-06 22:48:46', 'aaaamas', 5, 7, 1),
(23, 32, 'jks, qsq', 18, 20, '2017-11-27', '2017-11-07 02:21:59', 'Interno', 2, 7, 1),
(24, 33, 'u4ridkwl', 0, 20, '2017-11-30', '2017-11-07 02:25:39', 'onzas', 1, 7, 1),
(25, 27, 'uyeiekjm', 215, 230, '2017-11-30', '2017-11-07 16:41:26', 'lask', 6, 7, 0),
(26, 27, 'lote1', 2, 2, '2017-09-20', '2017-11-14 21:12:53', 'Pereira', 1, 7, 0),
(27, 34, 'lote1', 2, 2, '2017-10-10', '2017-11-14 21:35:43', 'Pereira', 1, 7, 0),
(28, 66, 'lote1', 2, 2, '2017-12-20', '2017-11-14 21:38:22', 'Pereira', 1, 7, 1),
(29, 35, 'lote1', 26, 26, '2017-08-18', '2017-11-14 21:39:25', 'Pereira', 2, 7, 1),
(30, 36, 'lote1', 2, 2, '2017-09-12', '2017-11-14 21:40:05', 'Pereira', 1, 7, 1),
(31, 31, 'lote1', 3, 3, '2017-09-29', '2017-11-14 21:41:01', 'Pereira', 1, 7, 1),
(32, 38, 'lote1', 0, 1, '2017-07-18', '2017-11-14 21:41:39', 'Pereira', 1, 7, 1),
(33, 39, 'lote1', 4, 5, '2017-10-25', '2017-11-14 21:42:26', 'Pereira', 2, 7, 1),
(34, 40, 'lote1', 0, 2, '2018-01-10', '2017-11-14 21:43:23', 'Pereira', 1, 7, 1),
(35, 41, 'lote1', 2, 2, '2019-04-18', '2017-11-14 21:44:24', 'Pereira', 2, 7, 1),
(36, 42, 'lote1', 0, 2, '2018-04-25', '2017-11-14 21:45:49', 'Pereira', 3, 7, 1),
(37, 43, 'lote1', 0, 2, '2018-04-24', '2017-11-14 21:47:02', 'Pereira', 2, 7, 1),
(38, 45, 'lote1', 4, 5, '2018-05-16', '2017-11-14 21:48:47', 'Pereira', 1, 7, 0);

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
(1, 19, 12, 1, 1, '2017-11-07 02:17:45'),
(2, 24, 6, 4, 1, '2017-11-07 15:11:17'),
(3, 22, 1, 5, 1, '2017-11-07 15:37:50'),
(4, 24, 0, 10, 1, '2017-11-07 16:49:40'),
(5, 25, 0, 13, 1, '2017-11-10 15:26:45'),
(6, 25, 0, 14, 1, '2017-11-10 15:27:37'),
(7, 25, 0, 16, 1, '2017-11-10 15:33:00');

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

--
-- Volcado de datos para la tabla `tools`
--

INSERT INTO `tools` (`id_tool`, `name_tool`, `mark`, `total_quantity`, `quantity_available`, `id_cellar`, `id_user_create`, `zone`, `state`, `create_date`) VALUES
(10, 'Machetes', 'Machetes', 23, 23, 6, 29, 'B', '1', '2017-11-06 23:25:20'),
(11, 'Pizon', 'pizon', 10, 10, 6, 29, 'B', '1', '2017-11-08 02:05:49'),
(12, 'martillos', 'martilllos', 23, 3, 6, 29, 'B', '1', '2017-11-08 02:07:27'),
(13, 'Palin', '', 20, 20, 6, 7, 'A', '1', '2017-11-09 04:09:18'),
(14, 'serrucho', '', 10, 6, 6, 30, 'A', '1', '2017-11-09 19:19:32'),
(15, 'machete', 'Gavilan', 15, 14, 6, 30, 'A', '1', '2017-11-09 19:20:06'),
(16, 'lima', 'herrago', 100, 4, 6, 30, 'A', '1', '2017-11-09 19:21:11'),
(17, 'alicate', '', 4, 2, 6, 7, 'A', '1', '2017-11-09 19:45:22'),
(18, 'palines', '', 17, 17, 6, 7, 'A', '1', '2017-11-14 18:46:39'),
(19, 'palas', '', 15, 15, 6, 7, 'A', '1', '2017-11-14 18:49:13'),
(20, 'azadores', '', 35, 35, 6, 7, 'A', '1', '2017-11-14 18:49:37'),
(21, 'barreton', '', 2, 1, 6, 7, 'A', '1', '2017-11-14 18:49:51'),
(22, 'almadanas', '', 2, 1, 6, 7, 'A', '1', '2017-11-14 18:50:03'),
(23, 'picas', '', 9, 9, 6, 7, 'A', '1', '2017-11-14 18:50:21'),
(24, 'paladragas', '', 7, 7, 6, 7, 'A', '1', '2017-11-14 18:51:13'),
(25, 'mangueras', '', 1, 1, 6, 7, 'A', '1', '2017-11-14 18:51:25'),
(26, 'cocos de cafe', '', 12, 12, 6, 7, 'A', '1', '2017-11-14 18:51:42'),
(27, 'sables', '', 7, 7, 6, 7, 'A', '1', '2017-11-14 18:51:54'),
(28, 'relojes', '', 3, 3, 6, 7, 'A', '1', '2017-11-14 18:52:05'),
(29, 'palustres', '', 2, 2, 6, 7, 'A', '1', '2017-11-14 18:53:01'),
(30, 'serruchos', '', 7, 7, 6, 7, 'A', '1', '2017-11-14 18:53:18'),
(31, 'rodillos', '', 2, 2, 6, 7, 'A', '1', '2017-11-14 18:56:11'),
(32, 'seguetas', '', 1, 1, 6, 7, 'A', '1', '2017-11-14 18:56:39'),
(33, 'martillos', '', 3, 3, 6, 7, 'A', '1', '2017-11-14 18:57:36'),
(34, 'alicate diablo', '', 6, 6, 6, 7, 'A', '1', '2017-11-14 19:01:56'),
(35, 'hachas', '', 2, 2, 6, 7, 'A', '1', '2017-11-14 19:02:56'),
(36, 'valdes', '', 22, 22, 6, 7, 'A', '1', '2017-11-14 19:03:07'),
(37, 'podadora', '', 2, 2, 6, 7, 'A', '1', '2017-11-14 19:03:25'),
(38, 'hombre solo', '', 1, 1, 6, 7, 'A', '1', '2017-11-14 19:23:40'),
(39, 'tenasas', '', 2, 2, 6, 7, 'A', '1', '2017-11-14 19:24:05');

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
(7, 'Daniel Felipe', 'Zamora', 'd4n7elfelipe@gmail.com', '123456789', '$2y$10$jXTZG4ZmjR7vRmBwO6/riuurmivu2QX2Exu2L54UFNieKWZZDi0PS', 2, 1, 1),
(29, 'Alejandro', 'rojas', 'alejandrojas@gmail.com', '12345', '$2y$10$iuWHXvTGKc5BOMjJcm3jUed7k.t0aZuY9TkrjKJnhkzqpXQ8moHw6', 2, 2, 1),
(30, 'Julio Cesar', 'guapacha', 'jcguapacha2@misena.edu.co', '1088299682', '$2y$10$FlZdjPR7tYUAev.2SGAss.xcXXg99h0LQh7pCERrIkuFlPDrfo0RO', 7, 3, 1),
(31, 'Stefania ', 'casas', 'ecasas05@misena.edu.co', '1093227968', '$2y$10$MnTN0MgdpvAK6uvS9uQ74.WzizVj5DWv8HBkoNTHNkxT4vomee7pG', 5, 4, 1),
(32, 'Yeison', 'Londoño', 'yeiko1022@gmail.com', '1088347434', '$2y$10$977bWmkHrN9B9FGSE5MxCu78XxhHU6i1xWvkNK26BVTrRuUWafms6', 2, 6, 1),
(33, 'Pedro', 'triviño', 'ped.120_@hotmail.com', '1225092661', '$2y$10$zXkfVJvxpV4.zMcaqwZ8pe6lpoejxuKW3hmnirn0o/baa6GgJiWAS', 6, 7, 1);

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
  MODIFY `id_cellar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `equipments`
--
ALTER TABLE `equipments`
  MODIFY `id_equipment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT de la tabla `exit_detalle_plant`
--
ALTER TABLE `exit_detalle_plant`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT de la tabla `exit_equipment_master`
--
ALTER TABLE `exit_equipment_master`
  MODIFY `id_exit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT de la tabla `exit_master_plant`
--
ALTER TABLE `exit_master_plant`
  MODIFY `id_exit_master` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `exit_product_detalle`
--
ALTER TABLE `exit_product_detalle`
  MODIFY `id_exit_product_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `exit_product_master`
--
ALTER TABLE `exit_product_master`
  MODIFY `id_exit_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `exit_teams_detall`
--
ALTER TABLE `exit_teams_detall`
  MODIFY `id_exit_detall` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `exit_tools_detall`
--
ALTER TABLE `exit_tools_detall`
  MODIFY `id_exit_detall` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `exit_tools_master`
--
ALTER TABLE `exit_tools_master`
  MODIFY `id_exit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `expiration_stock`
--
ALTER TABLE `expiration_stock`
  MODIFY `id_expiration` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `integridad_stock_plant`
--
ALTER TABLE `integridad_stock_plant`
  MODIFY `id_integridad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `intergridad_exit_product_detalle`
--
ALTER TABLE `intergridad_exit_product_detalle`
  MODIFY `id_integridad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `measure`
--
ALTER TABLE `measure`
  MODIFY `id_measure` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT de la tabla `recover_password`
--
ALTER TABLE `recover_password`
  MODIFY `id_recover` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `stock`
--
ALTER TABLE `stock`
  MODIFY `id_stock` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT de la tabla `stock_plant`
--
ALTER TABLE `stock_plant`
  MODIFY `id_stock_plant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `tools`
--
ALTER TABLE `tools`
  MODIFY `id_tool` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
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