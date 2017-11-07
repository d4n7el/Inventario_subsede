<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/equipments_controller.php');
	$equipos = new Equipments();
	date_default_timezone_set('America/Bogota');
	$fecha = date('Y-m-d');
	$tomorrow = date( "Y-m-d", strtotime( "+1 day", strtotime($fecha)));  
	$Yesterday = date( "Y-m-d", strtotime( "-30 day", strtotime($fecha)));
	// NECESARIO PARA LA PAGINACION
	$count_equipments = new Equipments();
	(isset($_REQUEST['pagina']) ? $pagina = $_REQUEST['pagina'] : $pagina = 0);
	$equipo = isset($_REQUEST['equipo']) && $_REQUEST['equipo'] != "" ? $_REQUEST['equipo'] : "%%";
	$id_equipment = isset($_REQUEST['id_equipment']) && $_REQUEST['id_equipment'] != "" ? $_REQUEST['id_equipment'] : "%%";
	$marca = isset($_REQUEST['marca']) && $_REQUEST['marca'] != "" ? $_REQUEST['marca'] : "%%";
	$fecha_inicial = isset($_REQUEST['fecha_inicial'])? $_REQUEST['fecha_inicial'] : $Yesterday;
	$fecha_final = isset($_REQUEST['fecha_final'])? $_REQUEST['fecha_final'] : $tomorrow;
	$limit = 30;
	$offset = $limit * $pagina;
	$retorno_count_equipments = $count_equipments->count_equipments($id_equipment,$equipo,$marca,$fecha_inicial,$fecha_final);
	$count_rows = $retorno_count_equipments['count'];
	$href = '/php/equipments/index.php';
	// NECESARIO PARA LA PAGINACION
	$retorno_equipos = $equipos->get_equipments_pag($id_equipment,$equipo,$marca,$fecha_inicial,$fecha_final,$limit,$offset);
	if ($id_equipment == "%%") {
		require_once($_SERVER['DOCUMENT_ROOT'].'/php/equipments/_view_list_equipments.php');
	}else{
		$equipos = new Equipments();
		$retorno_outside = $equipos->outside($id_equipment);
		require_once($_SERVER['DOCUMENT_ROOT'].'/php/equipments/_view_show_equipments.php');
	}
	
?>