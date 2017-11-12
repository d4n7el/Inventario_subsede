<?php 
	date_default_timezone_set('America/Bogota');
	$fecha = date('Y-m-d');
	$tomorrow = date( "Y-m-d", strtotime( "+1 day", strtotime($fecha)));  
	$Yesterday = date( "Y-m-d", strtotime( "-30 day", strtotime($fecha)));   
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/planta_controller.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/products_controller.php');
	$exit_planta = new Planta();
	$search = (isset($_REQUEST['search'])) ? $_REQUEST['search'] : "%%";
	$limit = ($search == "%%") ? "LIMIT 10" : "";
	$retorno_exit_planta = $exit_planta->search_stock_planta($search);
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/plant/_view_list_product_plant.php');
?>