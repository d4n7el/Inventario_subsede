<?php  
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/equipments_controller.php');
	$equipments = new Equipments();
	$search_equipo = $_REQUEST['search'];
	$retorno_equipment = $equipments->index_exit_equipments($search_equipo);
	include($_SERVER['DOCUMENT_ROOT'].'/php/equipments/_view_search_equipment_exit.php');
?>