<?php  
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/planta_controller.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/products_controller.php');
	$planta_exit = new Planta();
	$count_planta_exit = new Planta();
	date_default_timezone_set('America/Bogota');
	$fecha = date('Y-m-d');
	$tomorrow = date( "Y-m-d", strtotime( "+1 day", strtotime($fecha)));  
	$Yesterday = date( "Y-m-d", strtotime( "-30 day", strtotime($fecha)));  
	(isset($_REQUEST['product']) && $_REQUEST['product'] != "") ? $product = $_REQUEST['product'] : $product = "%%" ;
	(isset($_REQUEST['cellar']) && $_REQUEST['cellar'] != "")  ? $cellar = $_REQUEST['cellar'] : $cellar = "%%" ;
	(isset($_REQUEST['nameReceive']) && $_REQUEST['nameReceive'] != "")  ? $nameReceive = $_REQUEST['nameReceive'] : $nameReceive = "%%" ;
	(isset($_REQUEST['limit'])? $limit = $_REQUEST['limit'] : $limit = "%%" );
	(isset($_REQUEST['offset'])? $offset = $_REQUEST['offset'] : $offset = "%%" );
	$fecha_inicial = isset($_REQUEST['fecha_inicial'])? $_REQUEST['fecha_inicial'] : $Yesterday;
	$fecha_final = isset($_REQUEST['fecha_final'])? $_REQUEST['fecha_final'] : $tomorrow;

	// NECESARIO PARA LA PAGINACION
	(isset($_REQUEST['pagina']) ? $pagina = $_REQUEST['pagina'] : $pagina = 0);
	$limit = 40;
	$offset = $limit * $pagina;
	$retorno_count = $count_planta_exit->exit_stock_planta_count($product,$cellar,$nameReceive,$fecha_inicial,$fecha_final);
	$count_rows = $retorno_count['count'];
	echo $count_rows;
	$href = '/php/plant/view_list_exit_plant.php';
	// NECESARIO PARA LA PAGINACION
	$retorno_planta = $planta_exit->exit_stock_planta($product,$cellar,$nameReceive,$fecha_inicial,$fecha_final,$limit,$offset);
	echo count($retorno_planta);
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/plant/_view_exit_stock_plant.php');
?>