<?php 
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/exit_stock_controller.php');
	$id_exit_product = $_REQUEST['id_exit_master'];
	$view_exit_stock = new ExitProduct();
	$retorno_view_exit_stock = $view_exit_stock->show_exit_stock($id_exit_product);
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/stock/_view_exit_stock_complete.php');
?>