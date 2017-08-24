<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/measure_controller.php');
	$medida 			= new Measures();
	$id_measure			= $_REQUEST["id_measure"];
	$id_user 			= $_SESSION["id_user_activo"]; 
	$unidad_medida 		= $_REQUEST["medida"];
	$prefijo 			= $_REQUEST["prefijo"];
	$retorno_measure 	= $medida->update_measure($unidad_medida, $prefijo, $id_user, $id_measure);
	if (count($retorno_measure) > 0) {
		$respuesta = array('mensaje' => "Registro Actualizado", 'status' => 1 );
	}else{
		$respuesta = array('mensaje' => "error", 'status' => 0 );
	}
	echo json_encode($respuesta);
?>