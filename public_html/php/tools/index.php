<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/tools_controller.php');
	$herramientas = new tools();
	$retorno_herramientas = $herramientas->get_tools();
	
	include($_SERVER['DOCUMENT_ROOT'].'/php/tools/_view_list_tools.php');

?>