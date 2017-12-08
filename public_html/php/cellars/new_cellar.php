<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/cellar_controller.php');
	$name_cellar 	= $_REQUEST['name_cellar'];
	$description 	= $_REQUEST['description'];
	$delegate 		= $_REQUEST['delegate'];
	$icon_cellar 	= $_REQUEST['icon_cellar'];
	
	$cellar 		= new Cellars(); 
	$retorno_cellar = $cellar->insert_cellar($name_cellar,$description,$delegate,$icon_cellar);
	if ($retorno_cellar > 0) {
		$respuesta = array('mensaje' => "registro correcto", 'status' => 1, 'process' => 'create','graphics' => 'php/equipments/graphics_pie.php','closeModal' => 1);
	}else{
		$respuesta = array('mensaje' => $retorno_cellar, 'status' => 1, 'process' => 'create','graphics' => 'php/equipments/graphics_pie.php','closeModal' => 1);
	}
	echo json_encode($respuesta);
?>