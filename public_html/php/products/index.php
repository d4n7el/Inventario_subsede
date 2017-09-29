<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/products_controller.php');
	$productos = new Products();

	// NECESARIO PARA LA PAGINACION
	$count_products = new Products();
	(isset($_REQUEST['pagina']) ? $pagina = $_REQUEST['pagina'] : $pagina = 0);
	$limit = 2;
	$offset = $limit * $pagina;
	$retorno_count_products = $count_products->count_products();
	$count_rows = $retorno_count_products['count'];
	$href = '/php/products/index.php';
	// NECESARIO PARA LA PAGINACION

	$retorno_productos = $productos->get_products($limit, $offset);
	include($_SERVER['DOCUMENT_ROOT'].'/php/products/_view_list_products.php');
?>