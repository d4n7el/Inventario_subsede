<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/tools_controller.php');
	$herramientas = new Tools();
	date_default_timezone_set('America/Bogota');
	$fecha = date('Y-m-d');
	$tomorrow = date( "Y-m-d", strtotime( "+2 day", strtotime($fecha)));  
	$Yesterday = date( "Y-m-d", strtotime( "-30 day", strtotime($fecha)));
	$count_tools = new Tools();
	(isset($_REQUEST['pagina']) ? $pagina = $_REQUEST['pagina'] : $pagina = 0);
	$tools = isset($_REQUEST['tools']) && $_REQUEST['tools'] != "" ? $_REQUEST['tools'] : "%%";
	$marca = isset($_REQUEST['marca']) && $_REQUEST['marca'] != "" ? $_REQUEST['marca'] : "%%";
	$fecha_inicial = isset($_REQUEST['fecha_inicial'])? $_REQUEST['fecha_inicial'] : $Yesterday;
	$fecha_final = isset($_REQUEST['fecha_final'])? $_REQUEST['fecha_final'] : $tomorrow;
	$limit = 40;
	$offset = $limit * $pagina;
	$retorno_count_tools = $count_tools->count_tools();
    $count_rows = $retorno_count_tools['count'];
	$href = '/php/tools/index.php';

	if (!isset($_REQUEST['id_tool'])) {
		$retorno_herramientas = $herramientas->get_tools($tools,$marca,$fecha_inicial,$fecha_final,$limit,$offset);
		include($_SERVER['DOCUMENT_ROOT'].'/php/tools/_view_list_tools.php');
	}else{
		$tools_outside = new Tools();
		$retorno_outside = $tools_outside->outside($_REQUEST['id_tool']);
		$retorno_herramientas = $herramientas->get_tool_id($_REQUEST['id_tool']);
		include($_SERVER['DOCUMENT_ROOT'].'/php/tools/_view_show_tools.php');
	}

?>