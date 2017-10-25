<?php  
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/products_controller.php');
	$graphics_bar = new Products();
	$retorno_graphics = $graphics_bar->graphics_bar_total();
	$data 	= [];
	$label 	= [];
	foreach ($retorno_graphics as $key => $value) {
		array_push($label, $value['name_product']);
		array_push($data, $value['num_orders']);
	}
	$text = "Ordenes salidas de productos";
	require_once($_SERVER['DOCUMENT_ROOT']."/php/graphics/density.php");
?>