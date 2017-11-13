<?php 
	session_start();
	if (isset($_SESSION["id_user_activo"])) {
		require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/planta_controller.php');
		$edit_exit = new Planta();
		$id_detalle = $_REQUEST['id_detalle'];
		$proceso = $_REQUEST['proceso'];
		$stock = $_REQUEST['stock'];
		$id_proceso = $_REQUEST['id_proceso'];
		$cantidad = $_REQUEST['cantidad'];
		$nota = $_REQUEST['nota_update'];
	}
	$retorno = $edit_exit->update_exit_stock_plant($id_detalle,$proceso,$stock,$id_proceso,$cantidad,$nota);
	if ($retorno['retorno'] > 0) {
		$respuesta = array('mensaje' => "Actualizacion exitosa", 'status' => 1, 'process' => 'exit_product', 'closeModal' => 1 );
	}else if($retorno['retorno'] == 0) {
		$respuesta = array('mensaje' => "Cantidad no disponoble", 'status' => 0 );
	}else{
		$respuesta = array('mensaje' => "Error", 'status' => 0 );
	}
	
	echo json_encode($respuesta);
?>