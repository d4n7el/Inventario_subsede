<?php 
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/tools_controller.php');
	$tools_exit = new Tools();
	$tools_exit_detall = new Tools();
	$id_user = $_SESSION["id_user_activo"];
	$id_user_receive = $_REQUEST["receive_user"];
	$name_user_receive = $_REQUEST["name_receive_user"];
	$elements = $_REQUEST["id_element"];
	$quantity = $_REQUEST["cantidaddes"];
	$note_received = $_REQUEST["nota"];
	$insert_values = "";
	$retorno_master = $tools_exit->exit_tools_master($id_user,$id_user_receive,$name_user_receive);
	if ($retorno_master > 0){
		foreach ($quantity as $key => $value) {
			$value;
			$note_received[$key];
			$elements[$key];
			"<br>";
			$insert_values .="(".$retorno_master.",".$value.",'".$note_received[$key]."',".$elements[$key]."),";
		}
		$insert_values = substr($insert_values, 0, -1);
		$retorno_detalle = $tools_exit_detall->exit_tools_detall($insert_values);
	}
 ?>