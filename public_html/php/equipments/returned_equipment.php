<?php  
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/equipments_controller.php');
	$equipment 	= new Equipments();
	
	if (isset($_REQUEST['master']) AND isset($_REQUEST['detalle']) AND isset($_REQUEST['state']) ) {
		$master = $_REQUEST['master'];
		$detalle = $_REQUEST['detalle'];
		$state = $_REQUEST['state'];
		$mensaje = ($_REQUEST['state'] == 1) ? "Elemento retornado" : "Elemento no devuelto";
		$returned_equipments = $equipment->returned_equipment($master,$detalle,$state);
		$respuesta = array('mensaje' => $mensaje, 'status' => 1, 'process' => 'returned' );
	}else{
		$respuesta = array('mensaje' => "nada", 'status' => 0 );
	}
	echo json_encode($respuesta);
?>