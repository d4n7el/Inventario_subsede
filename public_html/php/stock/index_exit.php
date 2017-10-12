<?php 
	session_start();
	date_default_timezone_set('America/Bogota');
	$fecha = date('Y-m-d');
	$tomorrow = date( "Y-m-d", strtotime( "+1 day", strtotime($fecha)));  
	$yesterday = date( "Y-m-d", strtotime( "-2 day", strtotime($fecha))); 
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/exit_stock_controller.php');
	$exits = new ExitProduct();
	$count_exits = new ExitProduct();
	if (isset($_SESSION["id_user_activo"])) {
		$destino = (isset($_REQUEST['destino']) && $_REQUEST['destino'] != "" ? $_REQUEST['destino'] : "%%" );
		$product = (isset($_REQUEST['product']) && $_REQUEST['product'] != "" ? $_REQUEST['product'] : "%%" );
		$cellar = (isset($_REQUEST['cellar']) && $_REQUEST['cellar'] != "" ? $_REQUEST['cellar'] : "%%" );
		$lote = (isset($_REQUEST['lote']) && $_REQUEST['lote'] != "" ? $_REQUEST['lote'] : "%%" );
		$fecha_final = (isset($_REQUEST['fecha_final']) && $_REQUEST['fecha_final'] != "" ? $_REQUEST['fecha_final'] : $tomorrow );
		$fecha_inicial = (isset($_REQUEST['fecha_inicial']) && $_REQUEST['fecha_inicial'] != "" ? $_REQUEST['fecha_inicial'] : $yesterday );
		
		(isset($_REQUEST['id_exit_product']) ? $id_exit_product = $_REQUEST['id_exit_product'] : $id_exit_product = "%%");
		// NECESARIO PARA LA PAGINACION
		(isset($_REQUEST['pagina']) ? $pagina = $_REQUEST['pagina'] : $pagina = 0);
		$limit = 1;
		$offset = $limit * $pagina;
		$retorno_count_exit = $count_exits->get_exit_stock_count($id_exit_product,$destino,$product,$cellar,$lote,$fecha_inicial,$fecha_final);
		$count_rows = $retorno_count_exit['count'];
		$href = '/php/stock/index_exit.php';
		// NECESARIO PARA LA PAGINACION
		$retorno_exit = $exits->get_exit_stock($id_exit_product,$destino,$product,$cellar,$lote,$fecha_inicial,$fecha_final,$limit,$offset);
		require_once($_SERVER['DOCUMENT_ROOT'].'/php/stock/_view_exit_stock.php');
	}
?>