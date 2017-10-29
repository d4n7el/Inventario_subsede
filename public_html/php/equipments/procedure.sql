CREATE PROCEDURE delete_equipment_exit(IN id_user INT, IN id_exit INT, IN id_exit_detalle INT, IN id_element INT, IN nota INT, OUT retorno INT)
BEGIN  
  DECLARE old_cantidad INT;
    SELECT quantity INTO old_cantidad FROM exit_team_detall WHERE id_exit_detall = id_exit_detalle;
  UPDATE exit_team_detall SET state = 0, quantity = 0 WHERE id_exit_detall = id_exit_detalle;
    UPDATE equipments SET quantity_available = quantity_available + old_cantidad WHERE id_equipment = id_element;
    SET retorno = 1;
END;