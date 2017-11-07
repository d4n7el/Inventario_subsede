<?php  
	session_start();
	date_default_timezone_set('America/Bogota');
	$fecha = date('Y-m-d');
	$fecha_final = date( "Y-m-d", strtotime( "+1 day", strtotime($fecha)));  
	$fecha_inicial = date( "Y-m-d", strtotime( "-30 day", strtotime($fecha))); 
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/exit_stock_controller.php');
	$graphics_bar = new ExitProduct();
	$retorno_graphics = $graphics_bar->graphics_bar_acum_exit_date($fecha_inicial, $fecha_final);
	$data 	= [];
	$label 	= [];
	foreach ($retorno_graphics as $key => $value) {
		array_push($label, $value['name_product']." ".$value['prefix_measure']);
		array_push($data, $value['count']);
	}
	$text = "Acumulado salida de productos";
	require_once($_SERVER['DOCUMENT_ROOT']."/php/graphics/density.php");
?>