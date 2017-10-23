<?php  
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/planta_controller.php');
	$planta = new Planta();
	$count_planta = new Planta();
	date_default_timezone_set('America/Bogota');
	$fecha = date('Y-m-d');
	$tomorrow = date( "Y-m-d", strtotime( "+1 day", strtotime($fecha)));  
	$Yesterday = date( "Y-m-d", strtotime( "-2 day", strtotime($fecha)));  
	(isset($_REQUEST['product']) && $_REQUEST['product'] != "") ? $product = $_REQUEST['product'] : $product = "%%" ;
	(isset($_REQUEST['group'])? $group = $_REQUEST['group'] : $group = "%%" );
	(isset($_REQUEST['cellar']) && $_REQUEST['cellar'] != "")  ? $cellar = $_REQUEST['cellar'] : $cellar = "%%" ;
	(isset($_REQUEST['nameReceive']) && $_REQUEST['nameReceive'] != "")  ? $nameReceive = $_REQUEST['nameReceive'] : $nameReceive = "%%" ;
	(isset($_REQUEST['prefix']) && $_REQUEST['prefix'] != "")  ? $prefix = $_REQUEST['prefix'] : $prefix = "%%" ;
	(isset($_REQUEST['limit'])? $limit = $_REQUEST['limit'] : $limit = "%%" );
	(isset($_REQUEST['offset'])? $offset = $_REQUEST['offset'] : $offset = "%%" );
	$fecha_inicial = isset($_REQUEST['fecha_inicial'])? $_REQUEST['fecha_inicial'] : $Yesterday;
	$fecha_final = isset($_REQUEST['fecha_final'])? $_REQUEST['fecha_final'] : $tomorrow;
	$order = (isset($_REQUEST['order']) && $_REQUEST['order'] != "" ? $_REQUEST['order'] : "%%" );

	// NECESARIO PARA LA PAGINACION
	(isset($_REQUEST['pagina']) ? $pagina = $_REQUEST['pagina'] : $pagina = 0);
	$limit = 1;
	$offset = $limit * $pagina;
	$retorno_count = $count_planta->index_stock_planta_count($group,$product,$cellar,$nameReceive,$prefix,$fecha_inicial,$fecha_final);
	$count_rows = $retorno_count['count'];
	$href = '/php/plant/index.php';
	// NECESARIO PARA LA PAGINACION
	$retorno_planta = $planta->index_stock_planta($group,$product,$cellar,$nameReceive,$prefix,$fecha_inicial,$fecha_final,$order,$limit,$offset);
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/plant/_view_stock_planta.php');
?>