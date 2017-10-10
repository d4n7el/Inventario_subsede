<?php  
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/planta_controller.php');
	$planta = new Planta();
	$id_exit_product = $_REQUEST['exit_product'];
	$id_stock_plant = $_REQUEST['id_planta'];
	$stock = $_REQUEST['stock'];
	$cantidad = $_REQUEST['cantidad'];
	$retorno_update = $planta->edit_stock_plant($id_exit_product,$id_stock_plant,$stock,$cantidad);
	if ($retorno_update == 1) {
		$respuesta = array('mensaje' => "Actualización correcta", 'status' => 1, 'process' => 'update_cant_product', 'cantidad' => $cantidad);
	}else{
		$respuesta = array('mensaje' => $id_exit_product."-".$id_stock_plant."-".$stock,$cantidad, 'status' => 0 );
	}
	echo json_encode($respuesta);
?>