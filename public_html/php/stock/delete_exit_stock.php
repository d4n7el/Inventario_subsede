<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/exit_stock_controller.php');
	session_start();
	$delete_exit = new ExitProduct();
	$id_user 					= addslashes($_SESSION["id_user_activo"]);
	$id_exit_product 			= addslashes($_REQUEST["id_exit_master"]);
	$id_exit_product_detalle 	= addslashes($_REQUEST["id_exit_detalle"]);	
	$stock 						= addslashes($_REQUEST["id_element"]);
	$nota 						= addslashes($_REQUEST["nota"]);
	$process 					= "delete";
	$retorno_delete = $delete_exit->delete_product_exit_stock($id_user,$id_exit_product,$id_exit_product_detalle,$stock,$nota,$process);
	if ($retorno_delete['retorno'] == 1) {
		$respuesta = array('mensaje' => "Eliminado correctamente", 'status' => 1, 'process' => 'exit_product' );
	}else{
		$respuesta = array('mensaje' => "Error a elminar", 'status' => 1, 'process' => 'exit_product' );
	}
	echo json_encode($respuesta);
?>