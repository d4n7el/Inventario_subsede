<?php  
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/expiration_controller.php');
	$expiration = new Expiration();
	$expiration_count = new Expiration();
	date_default_timezone_set('America/Bogota');
	$fecha = date('Y-m-d');
	$tomorrow = date( "Y-m-d", strtotime( "+2 day", strtotime($fecha)));  
	$Yesterday = date( "Y-m-d", strtotime( "-90 day", strtotime($fecha)));
	(isset($_REQUEST['pagina']) ? $pagina = $_REQUEST['pagina'] : $pagina = 0);
	$filter = isset($_REQUEST['filter']) && $_REQUEST['filter'] != "" ? $_REQUEST['filter'] : "";
	$expiration_date = isset($_REQUEST['expiration_date']) && $_REQUEST['expiration_date'] != "" ? $_REQUEST['expiration_date'] : "%%";
	$fecha_inicial = isset($_REQUEST['fecha_inicial'])? $_REQUEST['fecha_inicial'] : $Yesterday;
	$fecha_final = isset($_REQUEST['fecha_final'])? $_REQUEST['fecha_final'] : $tomorrow;
	$limit = 40;
	$offset = $limit * $pagina;
	$retorno_expiration_count = $expiration_count->count_expiration_pag($filter,$fecha_inicial,$fecha_final,$expiration_date);
    $count_rows = $retorno_expiration_count['count'];
	$href = '/php/expiration/index.php';
	$retorno_expitarion = $expiration->index($filter,$fecha_inicial,$fecha_final,$expiration_date,$limit,$offset);
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/expiration/_view_expiration_record.php');
?>