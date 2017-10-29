<?php 
	session_start();
	date_default_timezone_set('America/Bogota');
	$fecha = date('Y-m-d');
	$tomorrow = date( "Y-m-d", strtotime( "+1 day", strtotime($fecha)));  
	$yesterday = date( "Y-m-d", strtotime( "-2 day", strtotime($fecha))); 
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/tools_controller.php');
	$exits = new Tools();
	$count_exits = new Tools();
	if (isset($_SESSION["id_user_activo"])) {
		(isset($_REQUEST['pagina']) ? $pagina = $_REQUEST['pagina'] : $pagina = 0);

		$tools = (isset($_REQUEST['tools']) && $_REQUEST['tools'] != "" ? $_REQUEST['tools'] : "%%" );
		$cedula = (isset($_REQUEST['cedula']) && $_REQUEST['cedula'] != "" ? $_REQUEST['cedula'] : "%%" );
		$fecha_final = (isset($_REQUEST['fecha_final']) && $_REQUEST['fecha_final'] != "" ? $_REQUEST['fecha_final'] : $tomorrow );
		$fecha_inicial = (isset($_REQUEST['fecha_inicial']) && $_REQUEST['fecha_inicial'] != "" ? $_REQUEST['fecha_inicial'] : $yesterday);
		$estado = (isset($_REQUEST['estado']) && $_REQUEST['estado'] != "" ? $_REQUEST['estado'] : 	 1);
		$id_exit_tool = (isset($_REQUEST['id_exit_tool']) && $_REQUEST['id_exit_tool'] != "" ? $_REQUEST['id_exit_tool'] : 	 1);
		// NECESARIO PARA LA PAGINACION
		(isset($_REQUEST['pagina']) ? $pagina = $_REQUEST['pagina'] : $pagina = 0);
		$limit = 1;
		$offset = $limit * $pagina;
		$retorno_count_exit = $count_exits->count_tools_exit($tools,$cedula,$fecha_inicial,$fecha_final,$estado);
		$count_rows = $retorno_count_exit['count'];
		$href = '/php/tools/index_exit_tools.php';
		// NECESARIO PARA LA PAGINACION
		$retorno_exit = $exits->get_exit_tools($tools,$cedula,$fecha_inicial,$fecha_final,$estado,$limit,$offset);
		require_once($_SERVER['DOCUMENT_ROOT'].'/php/tools/_view_exit_tools.php');
	}
?>