<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/stock_controller.php');
	$stock    			= new Stock();
	$id_user 			= $_SESSION["id_user_activo"];
	$id_product         = $_REQUEST["product"];
	$nom_lot			= $_REQUEST["nombre_lote"];
	$amount 			= $_REQUEST["amount"];
	$expiration 		= $_REQUEST["expiration"];
	$comercializadora 	= $_REQUEST["comercializadora"];
	$retorno_stock 	= $stock->insert_stock($id_product,$nom_lot,$amount,$expiration,$comercializadora);
	if ($retorno_stock > 0) {
		$respuesta = array('mensaje' => "registro correcto", 'status' => 1, 'process' => 'create', 'graphics' => 'php/stock/graphics_pie.php' );
	}else{
		$respuesta = array('mensaje' => "error", 'status' => 0 );
	}
	echo json_encode($respuesta);
?>