<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/equipments_controller.php');
	$equipment 			= new Equipments(); 
	$id_user			= $_SESSION["id_user_activo"];
	$id_equipo 		    = $_REQUEST["id_equipo"];
	$equipo 			= $_REQUEST["id_equipo"];
	$marca 		        = $_REQUEST["marca"];
	$cantidad_total		= $_REQUEST["cantidad_total"];
	$disponible 		= $_REQUEST["cantidad_disponible"];
	$nota 				= $_REQUEST["nota"];
	$bodega 			= 5;
	//B_1-b_1
	if (!isset($_REQUEST["cantidad_disponible"]) && !isset($_REQUEST["nota"] )) {
		$retorno_equipment 	= $equipment->update_equipment($equipo,$marca,$cantidad_total,$bodega,$id_user,$id_equipo);
		if ($retorno_equipment['retorno'] > 0) {
			$respuesta = array('mensaje' => "Actualizacion Exitosa", 'status' => 1 );
		}else{
			$respuesta = array('mensaje' => "No puedes realizar esta accion", 'status' => 0 );
		}
	}elseif (isset($_REQUEST["cantidad_disponible"]) && isset($_REQUEST["nota"])) {
		$retorno_equipment 	= $equipment->update_equipment_available($equipo,$disponible,$nota);
		if ($retorno_equipment['retorno'] == 1) {
			$respuesta = array('mensaje' => $retorno_equipment['retorno'] , 'status' => 1 );
		}elseif ($retorno_equipment['retorno'] == -1){
			$respuesta = array('mensaje' => "La cantidad disponible debe ser mayor a la cantidad prestada actual" , 'status' => 0 );
		}elseif ($retorno_equipment['retorno'] == 0) {
			$respuesta = array('mensaje' => "La cantidad deisponible no puede superar el total" , 'status' => 0 );
		}
	}
	echo json_encode($respuesta);
?>