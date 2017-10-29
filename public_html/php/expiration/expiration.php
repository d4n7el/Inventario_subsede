<?php 	
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/expiration_controller.php');
	date_default_timezone_set('America/Bogota');
	$fecha = date('Y-m-d');
	$expiration = new Expiration();
	$get_expiration = $expiration->get_expiration($fecha);
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/expiration/_view_expiration.php');
?>
