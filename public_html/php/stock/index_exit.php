<?php 
	session_start();
	if (isset($_SESSION["id_user_activo"])) {
		require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/exit_stock_controller.php');
		$exits = new ExitProduct();
		$count_exits = new ExitProduct();
		(isset($_REQUEST['id_exit_product']) ? $id_exit_product = $_REQUEST['id_exit_product'] : $id_exit_product = "%%");
		// NECESARIO PARA LA PAGINACION
		(isset($_REQUEST['pagina']) ? $pagina = $_REQUEST['pagina'] : $pagina = 0);
		$limit = 2;
		$offset = $limit * $pagina;
		$retorno_count_exit = $count_exits->get_exit_stock_count($id_exit_product);
		$count_rows = $retorno_count_exit['count'];
		$href = '/php/stock/index_exit.php';
		// NECESARIO PARA LA PAGINACION
		$retorno_exit = $exits->get_exit_stock($id_exit_product,$limit,$offset);
		require_once($_SERVER['DOCUMENT_ROOT'].'/php/stock/_view_exit_stock.php');
	}
?>