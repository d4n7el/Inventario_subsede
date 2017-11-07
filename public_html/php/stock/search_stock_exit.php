<?php  
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/stock_controller.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/products_controller.php');
	$stock = new Stock();
	$stock_search = $_REQUEST['search'];
	$retorno_stock = $stock->index_exit_stock($stock_search);
	include($_SERVER['DOCUMENT_ROOT'].'/php/stock/_view_search_stock_exit.php');
?>