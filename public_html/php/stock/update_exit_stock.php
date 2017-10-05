<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/exit_stock_controller.php');
	session_start();
	$update_exit = new ExitProduct();
	echo 'string';
	echo "--".$cantidad = $_REQUEST['amount'];
	echo "--".$id_master = $_REQUEST['master'];
	echo "--".$id_detalle = $_REQUEST['detalle'];
	echo "--".$id_user 	= $_SESSION["id_user_activo"];
	$retorno_update_exit = $update_exit->update_exit_stock($cantidad,$id_master,$id_detalle,$id_user);
	$respuesta = array('mensaje' => $id_detalle, 'status' => 1, 'process' => 'create' );
	echo json_encode($respuesta);
?>