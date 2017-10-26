<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/tools_controller.php');
	$graphics_pie 	= new Tools();
	$tools_pie 		= $graphics_pie->graphics_pie();
	$data 			= [];
	$label 			= [];
	foreach ($tools_pie as $key => $value) {
		array_push($label, $value['name_tool']);
		array_push($data, $value['count']);
	}
	$text = "Grafica Herramientas / Cantidad";
	require_once($_SERVER['DOCUMENT_ROOT']."/php/graphics/pie_graphic.php");
?>