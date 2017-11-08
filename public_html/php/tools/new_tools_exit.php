<?php 
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/tools_controller.php');
	$tools_exit = new Tools();
	$tools_exit_detall = new Tools();
	$tools_select_quantity = new Tools();
	$id_user = $_SESSION["id_user_activo"];
	$id_user_receive = $_REQUEST["receive_user"];
	$name_user_receive = $_REQUEST["name_receive_user"];
	$elements = $_REQUEST["id_element"];
	$quantity = $_REQUEST["cantidad"];
	$note_received = $_REQUEST["nota"];
	$insert_values = "";
	$inspecion = array();
	$paso = 1;
	$select_cantidades = "";
	foreach ($elements as $key => $value) {
		$inspecion[$value]= $quantity[$key];
		$select_cantidades.= "id_tool = ".$value." OR ";
	}
	$select_cantidades=substr($select_cantidades,0,-4);
	$retorno_quantity_tools = $tools_select_quantity->get_cant_tools($select_cantidades);
	foreach ($retorno_quantity_tools as $key => $value) {
		$paso =  ($value['quantity_available'] >= $inspecion[$value['id_tool']] AND $paso == 1 )? 1: 0;
	}
	if ($paso == 1) {
		$retorno_master = $tools_exit->exit_tools_master($id_user,$id_user_receive,$name_user_receive);
		if ($retorno_master > 0){
			foreach ($quantity as $key => $value) {
				$insert_values .="(".$retorno_master.",".$value.",'".$note_received[$key]."',".$elements[$key]."),";
			}
			$insert_values = substr($insert_values, 0, -1);
			$retorno_detalle = $tools_exit_detall->exit_tools_detall($insert_values);
			if ($retorno_detalle > 0){
				$respuesta = array('mensaje' => "registro exitoso", 'status' => 1, "process" => 'exit_product','closeModal' => 1 );
			}else{
				$respuesta = array('mensaje' => "error", 'status' => 0 );
			}
		}
	}else{
		$respuesta = array('mensaje' => "Algunas cantidades superan las disponibles", 'status' => 0 );
	}
	echo json_encode($respuesta);
 ?>