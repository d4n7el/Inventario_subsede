<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/planta_controller.php');
	$planta = new Planta();
	$procceso = $_REQUEST['procceso'];
	$id_process = $_REQUEST['id_process'];
	$stock = $_REQUEST['stock'];
	if ($procceso == "Interno") {
		$retorno_planta = $planta->show_stock_planta($id_process,$stock);
	}else{
		$retorno_planta = $planta->show_stock_planta_externo($id_process,$stock);
	}
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/plant/_edit_stock_plant.php');
?>