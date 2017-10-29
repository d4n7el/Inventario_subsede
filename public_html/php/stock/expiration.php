<?php 	
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/stock_controller.php');
	date_default_timezone_set('America/Bogota');
	$fecha = date('Y-m-d');
	$expiration = new Stock();
	$get_expiration = $expiration->get_expiration($fecha);
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/stock/_view_expiration.php');
?>
