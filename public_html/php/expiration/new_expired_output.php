<?php  
	$nota = $_REQUEST['nota'];
	$id_stock = $_REQUEST['id_stock'];
	session_start();
	$id_user = $_SESSION["id_user_activo"];
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/expiration_controller.php');
	$expiration = new Expiration();
	$new_expiration = $expiration->new_expiration($id_stock,$nota,$id_user);
	if ($new_expiration['retorno'] == 1) {
		$respuesta = array('mensaje' => "Registro exitoso", 'status' => 1, 'process' => 'new_expired', 'stock' => $id_stock );
	}else{
		$respuesta = array('mensaje' => "Error", 'status' => 0);
	}
	echo json_encode($respuesta);
?>