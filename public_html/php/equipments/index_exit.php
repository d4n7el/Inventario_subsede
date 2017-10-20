<?php 
	session_start();
	date_default_timezone_set('America/Bogota');
	$fecha = date('Y-m-d');
	$tomorrow = date( "Y-m-d", strtotime( "+1 day", strtotime($fecha)));  
	$yesterday = date( "Y-m-d", strtotime( "-2 day", strtotime($fecha))); 
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/equipments_controller.php');
	$exits = new Equipments();
	$count_exits = new Equipments();
	if (isset($_SESSION["id_user_activo"])) {
		$team = (isset($_REQUEST['team']) && $_REQUEST['team'] != "" ? $_REQUEST['team'] : "%%" );
		$cedula = (isset($_REQUEST['cedula']) && $_REQUEST['cedula'] != "" ? $_REQUEST['cedula'] : "%%" );
		$fecha_final = (isset($_REQUEST['fecha_final']) && $_REQUEST['fecha_final'] != "" ? $_REQUEST['fecha_final'] : $tomorrow );
		$fecha_inicial = (isset($_REQUEST['fecha_inicial']) && $_REQUEST['fecha_inicial'] != "" ? $_REQUEST['fecha_inicial'] : $yesterday );
		(isset($_REQUEST['id_exit_product']) ? $id_exit_product = $_REQUEST['id_exit_product'] : $id_exit_product = "%%");
		// NECESARIO PARA LA PAGINACION
		(isset($_REQUEST['pagina']) ? $pagina = $_REQUEST['pagina'] : $pagina = 0);
		$limit = 2;
		$offset = $limit * $pagina;
		$retorno_count_exit = $count_exits->get_exit_equipments_count($team,$cedula,$fecha_inicial,$fecha_final);
		$count_rows = $retorno_count_exit['count'];
		$href = '/php/equipments/index_exit.php';
		// // NECESARIO PARA LA PAGINACION
		 $retorno_exit = $exits->get_exit_equipments($team,$cedula,$fecha_inicial,$fecha_final,$limit,$offset);
		require_once($_SERVER['DOCUMENT_ROOT'].'/php/equipments/view_exit_equipments.php');
	}
?>