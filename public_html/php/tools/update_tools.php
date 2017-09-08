<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/tools_controller.php');
	$tools 			= new tools();
	$id_user 			= $_SESSION["id_user_activo"]; 
	$id_herramienta 		= $_REQUEST["id_herramientas"];
	$nombre_herramienta 	= $_REQUEST["herramienta"];
	$nombre_marca 		    = $_REQUEST["marca"];
	$nombre_cantidad 		= $_REQUEST["cantidad"];
	$nombre_cant_dis 	    = $_REQUEST["cantidad_disponible"];
	$bodega 			    = $_REQUEST["cellar"];
	$retorno_tools	= $tools->update_tools($nombre_herramienta,$nombre_marca,$nombre_cantidad,$nombre_cant_dis,$bodega, $id_herramienta);
	if ($retorno_tools > 0) {
		$respuesta = array('mensaje' => "Actualización correcta", 'status' => 1 );
	}else{
		$respuesta = array('mensaje' => "error", 'status' => 0 );
	}
	echo json_encode($respuesta);
?>