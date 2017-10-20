<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/planta_controller.php');
	$planta = new Planta();
	$id_exit_master = $_REQUEST['id_exit_master'];
	$id_element = $_REQUEST['id_element'];
	$retorno_planta = $planta->show_stock_planta($id_exit_master,$id_element);
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/plant/_edit_stock_plant.php');
?>