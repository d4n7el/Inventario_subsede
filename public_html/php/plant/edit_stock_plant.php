<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/planta_controller.php');
	$planta = new Planta();
	$id_exit_product = $_REQUEST['id_exit_product'];
	$id_stock_plant = $_REQUEST['id_planta'];
	$stock = $_REQUEST['stock'];
	$retorno_planta = $planta->show_stock_planta($id_exit_product,$id_stock_plant);
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/plant/_edit_stock_plant.php');
?>