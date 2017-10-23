<?php 
	session_start();
	if(isset($_SESSION["id_user_activo"]))
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/equipments_controller.php');
	$id_master = $_POST['id_exit_master'];
	$id_detall = $_POST['id_exit_detalle'];
	$id_equipment = $_POST['id_element'];
	$infor = new Equipments();
	$retorno = $infor->view_equipment_detall($id_master,$id_detall,$id_equipment);
	if ($id_equipment == $retorno[0]['id_equipment']){
		require_once($_SERVER['DOCUMENT_ROOT'].'/php/equipments/_edit_exit_equipment.php');
	}
 ?>