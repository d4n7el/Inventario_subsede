<?php  
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/products_controller.php');
	$product_graphics = new Products();
	$product_pie = $product_graphics->graphics_pie();
	$data 	= [];
	$label 	= [];
	foreach ($product_pie as $key => $value) {
		array_push($label, $value['name_product']);
		array_push($data, $value['count']);
	}
	$text = "Grafica Productos / Bodega";
	require_once($_SERVER['DOCUMENT_ROOT']."/php/graphics/pie_graphic.php");
?>