<?php 
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/equipments_controller.php');
	$delete_exit = new Equipments();
	$id_user 					= addslashes($_SESSION["id_user_activo"]);
	$id_exit 					= addslashes($_REQUEST["id_exit"]);
	$id_exit_detalle			= addslashes($_REQUEST["id_exit_detalle"]);	
	$id_element 				= addslashes($_REQUEST["id_element"]);
	$nota 						= addslashes($_REQUEST["nota"]);
	$process 					= "delete";
	$retorno_delete = $delete_exit->delete_equipment_exit($id_user,$id_exit,$id_exit_detalle,$id_element,$nota,$process);
	if ($retorno_delete['retorno'] == 1) {
		$respuesta = array('mensaje' => "Eliminado correctamente", 'status' => 1, 'process' => 'exit_product', 'reload' => 'search','closeModal' => 1 );
	}else{
		$respuesta = array('mensaje' => "Error a elminar", 'status' => 0 );
	}
	echo json_encode($respuesta);
?>	 