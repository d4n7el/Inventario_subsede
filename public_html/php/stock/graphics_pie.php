<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/stock_controller.php');
	$stock_graphics = new Stock();
	$stock_pie = $stock_graphics->graphics_pie();
	$data 	= [];
	$label 	= [];
	foreach ($stock_pie as $key => $value) {
		array_push($label, $value['name_product']);
		array_push($data, $value['count']);
	}
	$text = "Grafica Productos / Stock";
	require_once($_SERVER['DOCUMENT_ROOT']."/php/graphics/pie_graphic.php");
?>