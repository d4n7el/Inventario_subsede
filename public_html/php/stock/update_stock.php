<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/stock_controller.php');
	$stock    			= new Stock();
	$id_user 			= $_SESSION["id_user_activo"]; 
	$id_stock           = $_REQUEST["id_stock"];
	$id_cellar          = $_REQUEST["cellar"];
	$id_product         = $_REQUEST["product"];
	$nom_lot			= $_REQUEST["nombre_lote"];
	$amount 			= $_REQUEST["amount"];
	$expiration 		= $_REQUEST["expiration"];
	$expiration_create 	= $_REQUEST["expiration_create"];
	$comercializadora 	= $_REQUEST["comercializadora"];
	$retorno_stock 	= $stock->update_stock($id_stock, $id_cellar,$id_product,$nom_lot,$amount,$expiration,$expiration_create,$comercializadora);


	if ($retorno_stock > 0) {
		$respuesta = array('mensaje' => "registro correcto", 'status' => 1 );
	}else{
		$respuesta = array('mensaje' => "error", 'status' => 0 );
	}
	echo json_encode($respuesta);
?>