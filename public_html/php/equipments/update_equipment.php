<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/equipments_controller.php');
	$equipment 			= new Equipments(); 
	$id_user			= $_SESSION["id_user_activo"];
	$id_equipo 		    = $_REQUEST["id_equipo"];
	$equipo 			= $_REQUEST["equipo"];
	$marca 		        = $_REQUEST["marca"];
	$cantidad_total		= $_REQUEST["cantidad_total"];
	$bodega 			= 5;
	$retorno_equipment 	= $equipment->update_equipment($equipo,$marca,$cantidad_total,$bodega,$id_user,$id_equipo);
	if ($retorno_equipment['retorno'] > 0) {
		$respuesta = array('mensaje' => "Actualizacion Exitosa", 'status' => 1 );
	}else{
		$respuesta = array('mensaje' => "No puedes realizar esta accion", 'status' => 0 );
	}
	echo json_encode($respuesta);
?>