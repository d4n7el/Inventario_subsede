<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/tools_controller.php');
	$id_exit_tools = $_REQUEST['id_exit'];
	$view_exit_tools = new Tools();
	$retorno_view_exit_tools = $view_exit_tools->show_exit_tools($id_exit_tools);

	require_once($_SERVER['DOCUMENT_ROOT'].'/php/tools/_view_exit_tools_complete.php');
?>