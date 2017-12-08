<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/equipments_controller.php');
	$equipment 			= new Equipments(); 
	$id_user			= $_SESSION["id_user_activo"];
	$equipo 			= trim($_REQUEST["equipo"]);
	$marca 				= trim($_REQUEST["marca"]);
	$cantidad_total		= trim($_REQUEST["cantidad_total"]);
	$cantidad 			= trim($_REQUEST["cantidad"]);
	$bodega  = ($_REQUEST["cellar"]) ?  trim($_REQUEST["cellar"]) : 5;
	if (isset($equipo) AND isset($marca) AND isset($cantidad_total) AND isset($cantidad) AND $cantidad > 0 AND $cantidad_total > 0 ) {
		if ($cantidad_total >= $cantidad ) {
			$retorno_equipment 	= $equipment->insert_equipment($equipo,$marca,$cantidad_total,$cantidad,$bodega,$id_user);
			if ($retorno_equipment > 0) {
				$respuesta = array('mensaje' => "registro correcto", 'status' => 1, 'process' => 'create','graphics' => 'php/equipments/graphics_pie.php','closeModal' => 1);
			}else{
				$respuesta = array('mensaje' => "error", 'status' => 0 );
			}
		}else{
			$respuesta = array('mensaje' => "Disponible no puede superar total", 'status' => 0);
		}
	}else{
		$respuesta = array('mensaje' => "Todos los campos son requeridos", 'status' => 0);
	}
	echo json_encode($respuesta);
?>