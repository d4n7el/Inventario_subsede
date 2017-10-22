<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/tools_controller.php');
	$id_exit_master = $_REQUEST['id_exit_master'];
	$view_exit_tools = new Tools();
	$retorno_view_exit_tools = $view_exit_tools->show_exit_tools($id_exit_master);

	require_once($_SERVER['DOCUMENT_ROOT'].'/php/tools/_view_exit_tools_complete.php');
?>