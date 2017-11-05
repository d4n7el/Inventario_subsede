<?php 
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/planta_controller.php');
	$planta = new Planta();
	$id_process = $_REQUEST['id_process'];
	$proccess = $_REQUEST['proccess'];
	if ($proccess == "Interno") {
		$retorno_planta = $planta->show_stock_planta($id_process);
	}else{
		$retorno_planta = $planta->show_stock_planta_externo($id_process);
	}
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/plant/_show_stock_planta.php');
?>