<?php  
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/planta_controller.php');
	$planta 			= new Planta();
	$id_user 			= $_SESSION["id_user_activo"];
	$id_exit_product 	= $_REQUEST['exit_product'];
	$id_stock_plant 	= $_REQUEST['id_planta'];
	$stock 				= $_REQUEST['stock'];
	$note 				= $_REQUEST['nota_update'];
	$cantidad 			= $_REQUEST['cantidad'];
	$retorno_update 	= $planta->update_stock_plant($id_exit_product,$id_stock_plant,$stock,$cantidad,$id_user,$note);
	if ($retorno_update['retorno'] > 1) {
		$respuesta = array('mensaje' => "Actualización correcta", 'status' => 1, 'process' => 'update_cant_product', 'cantidad' => $cantidad);
	}else{
		$respuesta = array('mensaje' => $retorno_update['retorno'], 'status' => 0 );
	}
	echo json_encode($respuesta);
?>