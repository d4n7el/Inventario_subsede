<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/equipments_controller.php');
	$equipment 			= new Equipments(); 
	$id_equipo 		    = $_REQUEST["id_equipo"];
	$equipo 			= $_REQUEST["equipo"];
	$marca 		        = $_REQUEST["marca"];
	$cantidad_total		= $_REQUEST["cantidad_total"];
	$cantidad 			= $_REQUEST["cantidad_disponible"];
	$bodega 			= $_REQUEST["cellar"];
	$retorno_equipment 	= $equipment->update_equipment($equipo,$marca,$cantidad_total,$cantidad,$bodega,$id_equipo);
	if (count($retorno_equipment) > 0) {
		$respuesta = array('mensaje' => "Actualización correcta", 'status' => 1 );
	}else{
		$respuesta = array('mensaje' => "error", 'status' => 0 );
	}
	echo json_encode($respuesta);
?>