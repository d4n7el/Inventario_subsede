<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/tools_controller.php');
	session_start();
	$update_exit = new Tools();
	echo $cantidad = $_REQUEST['cantidad'];
	echo $id_master = $_REQUEST['id_exit_master'];
	echo $id_detalle = $_REQUEST['id_exit_detalle'];
	echo $id_user 	= $_SESSION["id_user_activo"];
	$retorno_update_exit = $update_exit->update_exit_tools($cantidad,$id_master,$id_detalle,$id_user);
	if ($retorno_update_exit['retorno'] == 1) {
		$respuesta = array('mensaje' => "Actualizacion exitosa", 'status' => 1, "process" => 'update_cant_tools', 'cantidad' => $cantidad);
	}else{
		$respuesta = array('mensaje' => "Cantidad no disponible", 'status' => 0);
	}
	echo json_encode($respuesta);
	
?>