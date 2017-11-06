<?php  
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/tools_controller.php');
	$tools = new Tools();
	$tool_search = $_REQUEST['search'];
	$retorno_tools = $tools->index_exit_tools($tool_search);
	include($_SERVER['DOCUMENT_ROOT'].'/php/tools/_view_search_tools_exit.php');
?>