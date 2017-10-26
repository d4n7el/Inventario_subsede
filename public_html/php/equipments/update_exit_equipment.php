<?php 
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/equipments_controller.php');
	$id_exit_detall = $_REQUEST['exit_equipment_detalle'];
	$team = $_REQUEST['equipo'];
	$id_exit = $_REQUEST['exit_equipment'];
	$quantity = $_REQUEST['cantidad'];
	$update_equipment = new Equipments();
	$retorno_update= $update_equipment->update_cant_equipmet($id_exit_detall, $team, $id_exit, $quantity);
	if ( $retorno_update['retorno'] == 1) {
		$respuesta = array('mensaje' => "Actualizacion exitosa", 'status' => 1, "process" => 'update_cant_product', 'cantidad' => $quantity);
	}else{
		$respuesta = array('mensaje' => "Error", 'status' => 0);
	}
	echo json_encode($respuesta);
?>