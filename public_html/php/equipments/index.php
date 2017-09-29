<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/equipments_controller.php');
	$equipos = new Equipments();
	// NECESARIO PARA LA PAGINACION
	$count_equipments = new Equipments();
	(isset($_REQUEST['pagina']) ? $pagina = $_REQUEST['pagina'] : $pagina = 0);
	$limit = 2;
	$offset = $limit * $pagina;
	$retorno_count_equipments = $count_equipments->count_equipments();
	$count_rows = $retorno_count_equipments['count'];
	$href = '/php/equipments/index.php';
	// NECESARIO PARA LA PAGINACION
	$retorno_equipos = $equipos->get_equipments_pag($limit,$offset);
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/equipments/_view_list_equipments.php');
?>