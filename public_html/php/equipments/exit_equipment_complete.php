<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/equipments_controller.php');
	$id_equipment_master = $_POST['id_exit_master'];
	$complete_detall = new Equipments();
	$retorno_view = $complete_detall->view_equipment_detall($id_equipment_master);
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/equipments/_exit_equipment_complete.php');
	
 ?>
