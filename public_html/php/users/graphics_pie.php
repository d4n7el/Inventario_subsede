<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/users_controller.php');
	$user_graphics = new Users();
	$user_pie = $user_graphics->graphics_pie();
	$data 	= [];
	$label 	= [];
	foreach ($user_pie as $key => $value) {
		array_push($label, $value['name_cellar']);
		array_push($data, $value['count']);
	}
	$text = "Grafica Usuarios / Bodega";
	require_once($_SERVER['DOCUMENT_ROOT']."/php/graphics/pie_graphic.php");
?>