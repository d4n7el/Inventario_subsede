<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/tools_controller.php');
	$tools 			= new Tools();
	$id_user 			    = trim($_SESSION["id_user_activo"]); 
	$nombre_herramienta 	= trim($_REQUEST["herramienta"]);
	$nombre_marca 		    = trim($_REQUEST["marca"]);
	$cantidad 				= trim($_REQUEST["cantidad"]);
	$cantidad_disponible 	= trim($_REQUEST["cantidad_disponible"]);
	$bodega  = ($_REQUEST["cellar"]) ?  trim($_REQUEST["cellar"]) : 6;
	if (isset($_REQUEST["herramienta"]) AND isset($_REQUEST["marca"]) AND isset($_REQUEST["cantidad"]) AND isset($_REQUEST["cantidad_disponible"]) AND $cantidad > 0 AND $cantidad_disponible > 0) {
		if ($cantidad >= $cantidad_disponible) {
			$retorno_tools 	= $tools->insert_tools($nombre_herramienta,$nombre_marca,$cantidad,$cantidad_disponible,$bodega, $id_user);
			if ($retorno_tools > 0) {
				$respuesta = array('mensaje' => "registro correcto", 'status' => 1, 'process' => 'create','create','graphics' => 'php/tools/graphics_pie.php','closeModal' => 1 );
			}else{
				$respuesta = array('mensaje' => "error", 'status' => 0 );
			}
		}else{
			$respuesta = array('mensaje' => "Cantidad disponible no puede ser mayor que la cantidad", 'status' => 0 );
		}
	}else{
		$respuesta = array('mensaje' => "Todos los campos son requeridos", 'status' => 0 );
	}
	echo json_encode($respuesta);
?>