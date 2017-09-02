<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/equipments_controller.php');
	$equipos = new Equipments();
	$retorno_equipos = $equipos->get_equipments();
	foreach ($retorno_equipos as $key => $value) {
		include($_SERVER['DOCUMENT_ROOT'].'/php/equipments/_view_list_equipments.php');
	}
?>