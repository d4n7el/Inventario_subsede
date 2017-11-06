<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/stock_controller.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/products_controller.php');
	date_default_timezone_set('America/Bogota');
	$fecha = date('Y-m-d');
	$tomorrow = date( "Y-m-d", strtotime( "+2 day", strtotime($fecha)));  
	$Yesterday = date( "Y-m-d", strtotime( "-5 day", strtotime($fecha)));  
	$stock = new Stock();
	$count_stock = new Stock();
	$id_stock = isset($_REQUEST['id_stock']) && $_REQUEST['id_stock'] != "" ? $_REQUEST['id_stock'] : "%%";
	$lote = isset($_REQUEST['lote']) && $_REQUEST['lote'] != "" ? $_REQUEST['lote'] : "%%";
	$casa = isset($_REQUEST['casa']) && $_REQUEST['casa'] != "" ? $_REQUEST['casa'] : "%%";
	$vencimiento = isset($_REQUEST['vencimiento']) && $_REQUEST['vencimiento'] != "" ? $_REQUEST['vencimiento'] : "%%";
	$bodega = isset($_REQUEST['bodega']) && $_REQUEST['bodega'] != "" ? $_REQUEST['bodega'] : "%%";
	$producto = isset($_REQUEST['producto']) && $_REQUEST['producto'] != "" ? $_REQUEST['producto'] : "%%";
	$fecha_inicial = isset($_REQUEST['fecha_inicial'])? $_REQUEST['fecha_inicial'] : $Yesterday;
	$fecha_final = isset($_REQUEST['fecha_final'])? $_REQUEST['fecha_final'] : $tomorrow;
	$estado = (isset($_REQUEST['estado']) && $_REQUEST['estado'] != "" ? $_REQUEST['estado'] : "1" );
	// NECESARIO PARA LA PAGINACION
	(isset($_REQUEST['pagina']) ? $pagina = $_REQUEST['pagina'] : $pagina = 0);
	$limit = 2;
	$offset = $limit * $pagina;
	$retorno_count_user = $count_stock->count_stock($id_stock,$lote,$bodega,$producto,$casa,$vencimiento,$fecha_inicial,$fecha_final,$estado);
	$count_rows = $retorno_count_user['count'];
	$href = '/php/stock/index.php';
	// NECESARIO PARA LA PAGINACIOn
	if ($id_stock == "%%") {
		$retorno_stock = $stock->get_search_stock($id_stock,$lote,$bodega,$producto,$casa,$fecha_inicial,$fecha_final,$vencimiento,$estado,$limit,$offset);
		require($_SERVER['DOCUMENT_ROOT'].'/php/stock/_view_list_stock.php');
	}else{
		$retorno_stock = $stock->get_search_stock_id($id_stock);
		$category = new Products();
		$fondo = $category->category_color($retorno_stock[0]['toxicological']);
		require($_SERVER['DOCUMENT_ROOT'].'/php/stock/_view_info_stock.php');
	}
	
?>