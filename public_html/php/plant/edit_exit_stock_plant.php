<?php 
	session_start();
	if (isset($_SESSION["id_user_activo"])) {
		require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/planta_controller.php');
		$edit_exit = new Planta();
		$id_exit_master = $_REQUEST['id_exit_master'];
		$id_exit_detalle = $_REQUEST['id_exit_detalle'];
		$id_element = $_REQUEST['id_element'];
		$retorno_planta = $edit_exit->exit_stock_planta_id($id_exit_master,$id_exit_detalle);
		if ($retorno_planta[0]['id_proceso'] == $id_element) {
			require_once($_SERVER['DOCUMENT_ROOT'].'/php/plant/_edit_stock_plant.php');
		}
	}
?>