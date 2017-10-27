BEGIN
    DECLARE v_old_total INT;
    DECLARE v_old_disponible INT;
    DECLARE v_prestados INT;
    SELECT total_quantity INTO v_old_total FROM equipments WHERE id_equipment = p_id_equipo;
    SELECT quantity_available INTO v_old_disponible FROM equipments WHERE id_equipment = p_id_equipo;
    SET v_prestados = v_old_total - v_old_disponible;
    IF v_prestados <= p_cantidad_total THEN
        IF v_old_total >= p_cantidad_total THEN
            UPDATE equipments SET quantity_available = quantity_available - (v_old_total - p_cantidad_total) WHERE id_equipment = p_id_equipo;
            SET retorno = 1;
        ELSE
            UPDATE equipments SET quantity_available = quantity_available + (p_cantidad_total - v_old_total ) WHERE id_equipment = p_id_equipo;
            SET retorno = 1;
        END IF;
    ELSE
        SET retorno = 0;
    END IF;  
    IF retorno > 0 THEN 
        UPDATE equipments SET name_equipment = p_equipo, mark = p_marca, total_quantity = p_cantidad_total, id_cellar = p_bodega, id_user_create = p_id_user WHERE id_equipment = p_id_equipo;
    END IF; 
END