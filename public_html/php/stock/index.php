<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/stock_controller.php');
	date_default_timezone_set('America/Bogota');
	$fecha = date('Y-m-d');
	$tomorrow = date( "Y-m-d", strtotime( "+1 day", strtotime($fecha)));  
	$Yesterday = date( "Y-m-d", strtotime( "-2 day", strtotime($fecha)));  
	$stock = new Stock();
	$count_stock = new Stock();
	$lote = isset($_REQUEST['lote']) && $_REQUEST['lote'] != "" ? $_REQUEST['lote'] : "%%";
	$casa = isset($_REQUEST['casa']) && $_REQUEST['casa'] != "" ? $_REQUEST['casa'] : "%%";
	$vencimiento = isset($_REQUEST['vencimiento']) && $_REQUEST['vencimiento'] != "" ? $_REQUEST['vencimiento'] : "%%";
	$bodega = isset($_REQUEST['bodega']) && $_REQUEST['bodega'] != "" ? $_REQUEST['bodega'] : "%%";
	$producto = isset($_REQUEST['producto']) && $_REQUEST['producto'] != "" ? $_REQUEST['producto'] : "%%";
	$fecha_inicial = isset($_REQUEST['fecha_inicial'])? $_REQUEST['fecha_inicial'] : $Yesterday;
	$fecha_final = isset($_REQUEST['fecha_final'])? $_REQUEST['fecha_final'] : $tomorrow;
	// NECESARIO PARA LA PAGINACION
	(isset($_REQUEST['pagina']) ? $pagina = $_REQUEST['pagina'] : $pagina = 0);
	$limit = 2;
	$offset = $limit * $pagina;
	$retorno_count_user = $count_stock->count_stock($lote,$bodega,$producto,$casa,$vencimiento,$fecha_inicial,$fecha_final);
	$count_rows = $retorno_count_user['count'];
	$href = '/php/stock/index.php';
	// NECESARIO PARA LA PAGINACION
	$retorno_stock = $stock->get_search_stock($lote,$bodega,$producto,$casa,$fecha_inicial,$fecha_final,$vencimiento,$limit,$offset);
	require($_SERVER['DOCUMENT_ROOT'].'/php/stock/_view_list_stock.php');
?>