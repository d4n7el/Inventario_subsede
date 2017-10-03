<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/exit_stock_controller.php');
	$id_exit_product = $_REQUEST['id_exit_product'];
	$view_exit_stock = new ExitProduct();
	$retorno_view_exit_stock = $view_exit_stock->get_exit_stock($id_exit_product);
	var_dump($retorno_view_exit_stock);
?>