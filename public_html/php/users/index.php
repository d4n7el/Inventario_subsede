<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/users_controller.php');
	$welcome = new Users();
	$id_user = $_REQUEST['id_user'];
	$retorno = $welcome->get_user($id_user);
	if (count($retorno) > 0) {
		$respuesta = array('mensaje' => $retorno, 'status' => 200, 'render' => 'ver_usuarios');
	}else{
		$respuesta = array('mensaje' => "No se encontraron registros", 'status' => 200 );
	}
	echo json_encode($respuesta);
?>