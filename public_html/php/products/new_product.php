<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/products_controller.php');
	$product 			= new Products();
	$id_user 			= $_SESSION["id_user_activo"]; 
	$producto 			= $_REQUEST["producto"];
	$descripcion 		= $_REQUEST["descripcion"];
	$bodega 			= $_REQUEST["cellar"];
	$categoria_tox 		= $_REQUEST["tox"];
	$code 				= $_REQUEST["code"];
	$retorno_product 	= $product->insert_product($producto,$descripcion,$id_user,$bodega,$categoria_tox,$code);
	if ($retorno_product > 0) {
		$respuesta = array('mensaje' => "registro correcto", 'status' => 1, 'process' => 'create','graphics' => 'php/products/graphics_pie.php' );
	}else{
		$respuesta = array('mensaje' => "error", 'status' => 0 );
	}
	echo json_encode($respuesta);
?>