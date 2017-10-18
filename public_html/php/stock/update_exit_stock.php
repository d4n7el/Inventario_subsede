<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/exit_stock_controller.php');
	session_start();
	$update_exit = new ExitProduct();
	$cantidad = $_REQUEST['cantidad'];
	$id_master = $_REQUEST['exit_product'];
	$id_detalle = $_REQUEST['exit_product_detalle'];
	$id_user 	= $_SESSION["id_user_activo"];
	$retorno_update_exit = $update_exit->update_exit_stock($cantidad,$id_master,$id_detalle,$id_user);
	if ($retorno_update_exit['retorno'] == 1) {
		$respuesta = array('mensaje' => "Actualizacion exitosa", 'status' => 1, "process" => 'update_cant_product', 'cantidad' => $cantidad);
	}else{
		$respuesta = array('mensaje' => "Cantidad no disponible", 'status' => 0);
	}
	echo json_encode($respuesta);
?>