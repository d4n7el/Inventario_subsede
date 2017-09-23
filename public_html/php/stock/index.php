<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/stock_controller.php');
	$stock = new Stock();
	$count_stock = new Stock();

	// NECESARIO PARA LA PAGINACION
	(isset($_REQUEST['pagina']) ? $pagina = $_REQUEST['pagina'] : $pagina = 0);
	$limit = 2;
	$offset = $limit * $pagina;
	$retorno_count_user = $count_stock->count_stock();
	$count_rows = $retorno_count_user['count'];
	$href = '/php/stock/index.php';
	// NECESARIO PARA LA PAGINACION
	$retorno_stock = $stock->get_search_stock($limit,$offset);
	if (count($retorno_stock) > 0) {
		require($_SERVER['DOCUMENT_ROOT'].'/php/stock/_view_list_stock.php');
	}else{
		$respuesta = array('mensaje' => "No se encontraron registros", 'status' => 200 );
	}
?>