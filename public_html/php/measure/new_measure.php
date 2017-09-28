<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/measure_controller.php');
	$medida 			= new Measures();
	$id_user 			= $_SESSION["id_user_activo"]; 
	$unidad_medida 		= $_REQUEST["medida"];
	$prefijo 			= $_REQUEST["prefijo"];
	$retorno_measure 	= $medida->insert_measure($unidad_medida, $prefijo, $id_user);
	if (count($retorno_measure) > 0) {
		$respuesta = array('mensaje' => "registro correcto", 'status' => 1, 'process' => 'create');
	}else{
		$respuesta = array('mensaje' => "error", 'status' => 0 );
	}
	echo json_encode($respuesta);
?>