<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/tools_controller.php');
	$tools 					= new tools();
	$id_user 				= $_SESSION["id_user_activo"]; 
	$id_herramienta 		= $_REQUEST["id_herramientas"];
	$herramienta 			= $_REQUEST["herramienta"];
	$marca 		    		= $_REQUEST["marca"];
	$cantidad 				= $_REQUEST["cantidad"];
	$disponible 			= $_REQUEST["cantidad_disponible"];
	$nota 					= $_REQUEST["nota"];
	$proceso 				= $_REQUEST["process"];
	$bodega 			    = 6;
	if (!isset($_REQUEST["cantidad_disponible"]) AND !isset($_REQUEST["nota"]) AND !isset($_REQUEST["process"]) AND isset($_REQUEST["id_herramientas"]) ) {
		$retorno_tools	= $tools->update_tools($herramienta,$marca,$cantidad,$bodega, $id_herramienta,$id_user);
		if ($retorno_tools > 0) {
			$respuesta = array('mensaje' => "Actualización correcta", 'status' => 1, 'closeModal' => 1 );
		}else{
			$respuesta = array('mensaje' => "error", 'status' => 0 );
		}
	}elseif(isset($_REQUEST["cantidad_disponible"]) AND isset($_REQUEST["nota"]) AND isset($_REQUEST["process"]) AND $_REQUEST["nota"] != "" AND $_REQUEST["cantidad_disponible"] > 0){
		$retorno_tool = $tools->update_quantity_available_tool($id_herramienta,$disponible,$nota,$proceso);
		if ($retorno_tool['retorno'] == 1) {
			$respuesta = array('mensaje' =>  "Actualización correcta" , 'status' => 1, 'closeModal' => 1 );
		}elseif ($retorno_tool['retorno'] == -1){
			$respuesta = array('mensaje' => "La cantidad disponible debe ser mayor a la cantidad prestada actual" , 'status' => 0 );
		}elseif ($retorno_tool['retorno'] == 0) {
			$respuesta = array('mensaje' => "La cantidad deisponible no puede superar el total" , 'status' => 0 );
		}
	}else{
		$respuesta = array('mensaje' => "Todos son campos son requeridos" , 'status' => 0 );
	}
	echo json_encode($respuesta);
?>