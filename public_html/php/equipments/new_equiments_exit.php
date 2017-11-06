<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/equipments_controller.php');
	$equipment_exit= new Equipments();
	$equipment_exit_detall= new Equipments(); 
	$cant_equipment = new Equipments();
	$id_user_delivery= $_SESSION["id_user_activo"];
	$id_user_receives = $_REQUEST['receive_user']; 
	$element = $_REQUEST['id_element'];
	$texto = $_REQUEST['nota'];
	$id_recibe = $_REQUEST['receive_user'];
	$cantidad = $_REQUEST['cantidad'];
	$nom_receive = $_REQUEST['name_receive_user'];
	$retorno = $equipment_exit->exit_equipment_master($id_user_receives,$id_user_delivery,$nom_receive);
	$valores_insert = "";
	$inspecion = array();
	$ids="";
	$paso=true;
	foreach ($element as $llave => $id) {
		$inspecion[$id]= $cantidad[$llave];
		$ids.=" id_equipment = ".$id. " OR ";
	}
	$ids=substr($ids,0,-4);
	$retorno_cant_equipment= $cant_equipment->get_cant_equipment($ids);
	foreach ($retorno_cant_equipment as $llave_consul => $cant_consulta) {
		if ($cant_consulta["quantity_available"] >= $inspecion[$cant_consulta["id_equipment"]] AND $paso=true ) {
			
		}else{
			$paso=false;
		}
	}
	if ($paso==true) {
		foreach ($element as $key => $value) {
			$valores_insert.=" (".$retorno.",".$value.",".$cantidad[$key].",'".$texto[$key]."'),";
		}
		$valores_insert = substr($valores_insert,0,-1);
		$retorno_detall = $equipment_exit_detall->exit_equipment_detall($valores_insert);
		if ($retorno_detall > 0 && $retorno > 0) {
			$respuesta = array('mensaje' => "registro correcto", 'status' => 1, 'process' => 'create');
		}else{
			$respuesta = array('mensaje' => "Error", 'status' => 0);
		}
	}else{
		$respuesta = array('mensaje' => "La cantidad sobrepasa la disponible ", 'status' => 0);
	}
	echo json_encode($respuesta);
 ?>