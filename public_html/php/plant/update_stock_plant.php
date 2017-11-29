<?php  
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/planta_controller.php');
	$planta 			= new Planta();
	$id_user 			= $_SESSION["id_user_activo"];
	$id_exit_product 	= (isset($_REQUEST['exit_product'])) ? $_REQUEST['exit_product']: 0 ;
	$id_stock_plant 	= (isset($_REQUEST['id_proceso'])) ? $_REQUEST['id_proceso']: 0 ;
	$stock 				= $_REQUEST['stock'];
	$note 				= $_REQUEST['nota_update'];
	$cantidad 			= $_REQUEST['cantidad'];
	$proceso 			= $_REQUEST['proceso'];
	$retorno_update 	= $planta->update_stock_plant($id_exit_product,$id_stock_plant,$stock,$cantidad,$id_user,$note,$proceso);
	if ($retorno_update['retorno'] >= 1) {
		$respuesta = array('mensaje' => "Actualización correcta", 'status' => 1, 'process' => 'update_cant_product', 'cantidad' => $cantidad, 'reload' => 'search','closeModal' => 1);
	}else{
		$respuesta = array('mensaje' => $retorno_update['retorno'], 'status' => 0 );
	}
	echo json_encode($respuesta);
?>