<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/measure_controller.php');
	$medida 			= new Measures();
	$retorno_measure 	= $medida->get_measure();
	include($_SERVER['DOCUMENT_ROOT'].'/php/measure/_view_select_measure.php');
?>