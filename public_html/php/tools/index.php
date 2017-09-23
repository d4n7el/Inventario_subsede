<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/tools_controller.php');
	$herramientas = new tools();
	
		$count_tools = new tools();
		(isset($_REQUEST['pagina']) ? $pagina = $_REQUEST['pagina'] : $pagina = 0);
		$limit = 2;
		$offset = $limit * $pagina;
		$retorno_count_tools = $count_tools->count_tools();
	    $count_rows = $retorno_count_tools['count'];
		$href = '/php/tools/index.php';

	$retorno_herramientas = $herramientas->get_tools($limit,$offset);
	include($_SERVER['DOCUMENT_ROOT'].'/php/tools/_view_list_tools.php');

?>