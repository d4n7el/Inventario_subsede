<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/measure_controller.php');
	$medida 			= new Measures();
	$retorno_measure 	= $medida->get_measure();
	foreach ($retorno_measure as $key => $value) {
		include($_SERVER['DOCUMENT_ROOT'].'/php/measure/_view_list_measure.php');
	}
?>