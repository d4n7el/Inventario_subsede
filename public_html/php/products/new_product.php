<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/products_controller.php');
	$product 			= new Products();
	$id_user 			= $_SESSION["id_user_activo"]; 
	$producto 			= $_REQUEST["producto"];
	$descripcion 		= $_REQUEST["descripcion"];
	$unidad_medida 		= $_REQUEST["unidad_medida"];
	$bodega 			= $_REQUEST["cellar"];
	$retorno_product 	= $product->insert_product($producto,$descripcion,$unidad_medida,$id_user,$bodega);
	if ($retorno_product > 0) {
		$respuesta = array('mensaje' => "registro correcto", 'status' => 1 );
	}else{
		$respuesta = array('mensaje' => "error", 'status' => 0 );
	}
	echo json_encode($respuesta);
?>