<?php 
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/planta_controller.php');
	$planta = new Planta();
	$id_exit_master = $_REQUEST['id_exit_master'];
	$retorno_planta = $planta->exit_stock_planta_id($id_exit_master);
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/plant/_show_stock_planta.php');
?>