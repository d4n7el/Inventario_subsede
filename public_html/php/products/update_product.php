<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/products_controller.php');
	$product 			= new Products();
	$id_user 			= $_SESSION["id_user_activo"]; 
	$id_producto 		= $_REQUEST["id_producto"];
	$producto 			= $_REQUEST["product"];
	$descripcion 		= $_REQUEST["descripcion"];
	$bodega 			= $_REQUEST["cellar"];
	$unidad_medida 		= $_REQUEST["unidad_medida"];
	$retorno_product 	= $product->update_product($producto,$descripcion,$bodega,$id_user,$unidad_medida,$id_producto);
	if (count($retorno_product) > 0) {
		$respuesta = array('mensaje' => "Actualización correcta", 'status' => 1 );
	}else{
		$respuesta = array('mensaje' => "error", 'status' => 0 );
	}
	echo json_encode($respuesta);
?>