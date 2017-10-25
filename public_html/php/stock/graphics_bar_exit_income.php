<?php  
	session_start();
	date_default_timezone_set('America/Bogota');
	$fecha = date('Y-m-d');
	$fecha_final = date( "Y-m-d", strtotime( "+1 day", strtotime($fecha)));  
	$fecha_inicial = date( "Y-m-d", strtotime( "-10 day", strtotime($fecha))); 
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/exit_stock_controller.php');
	$graphics_bar = new ExitProduct();
	$retorno_graphics = $graphics_bar->graphics_bar_acum_exit_income($fecha_inicial, $fecha_final);
	$dataA 	= [];
	$dataB 	= [];
	$label 	= [];
	foreach ($retorno_graphics as $key => $value) {
		array_push($label, $value['name_product']);
		array_push($dataA, $value['ingreso']);
		array_push($dataB, $value['salida']);
	}
	$text = "Acumulado salida de productos";
	require_once($_SERVER['DOCUMENT_ROOT']."/php/graphics/bar_double_graphics.php");
?>