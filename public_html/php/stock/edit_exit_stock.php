<?php 
	session_start();
	if (isset($_SESSION["id_user_activo"])) {
		require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/exit_stock_controller.php');
		$edit_exit = new ExitProduct();
		$id_exit_product = $_REQUEST['id_exit_product'];
		$id_exit_product_detalle = $_REQUEST['id_exit_product_detalle'];
		$id_stock = $_REQUEST['id_stock'];
		$retorno_edit_exit = $edit_exit->show_exit_stock($id_exit_product,$id_exit_product_detalle);
		if ($id_stock == $retorno_edit_exit[0]['id_stock']) {
			require_once($_SERVER['DOCUMENT_ROOT'].'/php/stock/_edit_exit_stock.php');
		}
	}
?>