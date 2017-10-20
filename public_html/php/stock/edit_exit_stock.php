<?php 
	session_start();
	if (isset($_SESSION["id_user_activo"])) {
		require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/exit_stock_controller.php');
		$edit_exit = new ExitProduct();
		$id_exit_master = $_REQUEST['id_exit_master'];
		$id_exit_detalle = $_REQUEST['id_exit_detalle'];
		$id_element = $_REQUEST['id_element'];
		$retorno_edit_exit = $edit_exit->show_exit_stock($id_exit_master,$id_exit_detalle);
		if ($id_element == $retorno_edit_exit[0]['id_stock']) {
			require_once($_SERVER['DOCUMENT_ROOT'].'/php/stock/_edit_exit_stock.php');
		}
	}
?>