<?php 
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/planta_controller.php');
	$planta = new Planta();
	$id_exit_product = $_REQUEST['id_exit_product'];
	$retorno_planta = $planta->show_stock_planta($id_exit_product);
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/plant/_show_stock_planta.php');
?>