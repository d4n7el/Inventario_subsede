<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/equipments_controller.php');
	$graphics_pie = new Equipments();
	$equipments_pie = $graphics_pie->graphics_pie();
	$data 	= [];
	$label 	= [];
	foreach ($equipments_pie as $key => $value) {
		array_push($label, $value['name_equipment']);
		array_push($data, $value['count']);
	}
	$text = "Grafica Equipos / Cantidad";
	require_once($_SERVER['DOCUMENT_ROOT']."/php/graphics/pie_graphic.php");
?>