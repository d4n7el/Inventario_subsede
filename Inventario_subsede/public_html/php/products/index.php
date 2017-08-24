<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/products_controller.php');
	$productos = new Products();
	$retorno_productos = $productos->get_products();
	foreach ($retorno_productos as $key => $value) {
		include($_SERVER['DOCUMENT_ROOT'].'/php/products/_view_list_products.php');
	}
?>