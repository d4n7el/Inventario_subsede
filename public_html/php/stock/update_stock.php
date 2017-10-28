<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/stock_controller.php');
	$stock    			= new Stock();
	$id_user 			= $_SESSION["id_user_activo"]; 
	$id_stock           = $_REQUEST["id_stock"];
	$id_product         = $_REQUEST["product"];
	$nom_lot			= $_REQUEST["nombre_lote"];
	$amount 			= $_REQUEST["amount"];
	$expiration 		= $_REQUEST["expiration"];
	$state 				= $_REQUEST["estado"];
	$comercializadora 	= $_REQUEST["comercializadora"];
	$unidad_medida 	= $_REQUEST["unidad_medida"];
	$retorno_stock 	= $stock->update_stock($id_stock,$id_product,$nom_lot,$amount,$expiration,$state,$comercializadora,$unidad_medida);
	if ($retorno_stock > 0) {
		$respuesta = array('mensaje' => "registro correcto", 'status' => 1 );
	}else{
		$respuesta = array('mensaje' => "error", 'status' => 0 );
	}
	echo json_encode($respuesta);
?>