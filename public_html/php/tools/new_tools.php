<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/tools_controller.php');
	$tools 			= new Tools();
	$id_user 			    = trim($_SESSION["id_user_activo"]); 
	$nombre_herramienta 	= trim($_REQUEST["herramienta"]);
	$nombre_marca 		    = trim($_REQUEST["marca"]);
	$nombre_cantidad 		= trim($_REQUEST["cantidad"]);
	$nombre_cant_dis 	    = trim($_REQUEST["cantidad_disponible"]);
	$bodega 			    = 6;

	$retorno_tools 	= $tools->insert_tools($nombre_herramienta,$nombre_marca,$nombre_cantidad,$nombre_cant_dis,$bodega, $id_user);
	if ($retorno_tools > 0) {
		$respuesta = array('mensaje' => "registro correcto", 'status' => 1, 'process' => 'create' );
	}else{
		$respuesta = array('mensaje' => "error", 'status' => 0 );
	}
	echo json_encode($respuesta);
?>