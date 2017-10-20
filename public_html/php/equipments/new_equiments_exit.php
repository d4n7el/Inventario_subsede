<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/equipments_controller.php');
	$equipment_exit= new Equipments();
	$equipment_exit_detall= new Equipments(); 
	session_start();
	$id_user_delivery= $_SESSION["id_user_activo"];
	$id_user_receives = $_REQUEST['receive_user']; 
	$element = $_REQUEST['id_element'];
	$texto = $_REQUEST['nota'];
	$id_recibe = $_REQUEST['receive_user'];
	$cantidad = $_REQUEST['cantidaddes'];
	$nom_receive = $_REQUEST['name_receive_user']
	$retorno = $equipment_exit->exit_equipment_master($id_user_receives,$id_user_delivery,$nom_receive);
	$valores_insert = "";

	foreach ($element as $key => $value) {
		$valores_insert.=" (".$retorno.",".$value.",".$cantidad[$key].",'".$texto[$key]."'),";
	}
	$valores_insert = substr($valores_insert,0,-1);
	$retorno_detall = $equipment_exit_detall->exit_equipment_detall($valores_insert);
	if ($retorno_detall > 0 && $retorno > 0) {
		$respuesta = array('mensaje' => "registro correcto", 'status' => 1, 'process' => 'create');
	}else{
		$respuesta = array('mensaje' => "Error correcto", 'status' => 0);
	}
	echo json_encode($respuesta);
 ?>