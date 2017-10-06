<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/exit_stock_controller.php');
	session_start();
	$update_exit = new ExitProduct();
	$cantidad = $_REQUEST['amount'];
	$id_master = $_REQUEST['master'];
	$id_detalle = $_REQUEST['detalle'];
	$id_user 	= $_SESSION["id_user_activo"];
	$retorno_update_exit = $update_exit->update_exit_stock($cantidad,$id_master,$id_detalle,$id_user);
	$respuesta = array('mensaje' => "Actualizacion correcta", 'status' => 1, "process" => 'update_cant_product', 'cantidad' => $cantidad);
	echo json_encode($respuesta);
?>