<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/products_controller.php');
	$productos = new Products();
	date_default_timezone_set('America/Bogota');
	$fecha = date('Y-m-d');
	$tomorrow = date( "Y-m-d", strtotime( "+1 day", strtotime($fecha)));  
	$Yesterday = date( "Y-m-d", strtotime( "-7 day", strtotime($fecha)));  
	// NECESARIO PARA LA PAGINACION
	$count_products = new Products();
	(isset($_REQUEST['pagina']) ? $pagina = $_REQUEST['pagina'] : $pagina = 0);
	$producto = isset($_REQUEST['producto']) && $_REQUEST['producto'] != "" ? $_REQUEST['producto'] : "%%";
	$bodega = isset($_REQUEST['bodega']) && $_REQUEST['bodega'] != "" ? $_REQUEST['bodega'] : "%%";
	$casa = isset($_REQUEST['casa']) && $_REQUEST['casa'] != "" ? $_REQUEST['casa'] : "%%";
	$fecha_inicial = isset($_REQUEST['fecha_inicial'])? $_REQUEST['fecha_inicial'] : $Yesterday;
	$fecha_final = isset($_REQUEST['fecha_final'])? $_REQUEST['fecha_final'] : $tomorrow;
	$limit = 2;
	$offset = $limit * $pagina;
	$retorno_count_products = $count_products->count_products($producto,$bodega,$fecha_inicial,$fecha_final);
	$count_rows = $retorno_count_products['count'];
	$href = '/php/products/index.php';
	// NECESARIO PARA LA PAGINACION
	if (isset($_REQUEST['id_product'])) {
		$retorno_productos = $productos->get_product_id($_REQUEST['id_product']);
		include($_SERVER['DOCUMENT_ROOT'].'/php/products/_view_show_product.php');
	}else{
		$retorno_productos = $productos->get_products($producto,$bodega,$fecha_inicial,$fecha_final,$limit, $offset);
		include($_SERVER['DOCUMENT_ROOT'].'/php/products/_view_list_products.php');
	}
	
?>