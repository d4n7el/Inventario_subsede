<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/equipments_controller.php');
	$equipment 			= new Equipments(); 
	$equipo 			= $_REQUEST["equipo"];
	$marca 				= $_REQUEST["marca"];
	$cantidad_total		= $_REQUEST["cantidad_total"];
	$cantidad 			= $_REQUEST["cantidad"];
	$bodega 			= $_REQUEST["cellar"];
	$retorno_equipment 	= $equipment->insert_equipment($equipo,$marca,$cantidad_total,$cantidad,$bodega);
	if ($retorno_equipment > 0) {
		$respuesta = array('mensaje' => "registro correcto", 'status' => 1 );
	}else{
		$respuesta = array('mensaje' => "error", 'status' => 0 );
	}
	echo json_encode($respuesta);
?>