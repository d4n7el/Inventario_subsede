<?php  
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/measure_controller.php');
	$medida_graphics 			= new Measures();
	$retorno_medida_graphics 	= $medida_graphics->graphics_pie();
	$data 	= [];
	$label 	= [];
	foreach ($retorno_medida_graphics as $key => $value) {
		array_push($label, $value['name_measure']);
		array_push($data, $value['count']);
	}
	$text = "Grafica Unidades de medida / Productos";
	require_once($_SERVER['DOCUMENT_ROOT']."/php/graphics/pie_graphic.php");
?>