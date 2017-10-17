<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/users_controller.php');
	$welcome 		= new Users();
	$nombre 		= addslashes($_REQUEST['nombre']);
	$apellido 		= addslashes($_REQUEST['apellido']);
	$cedula 		= addslashes($_REQUEST['cedula']);
	$id_user 		= addslashes($_REQUEST['id_user']);
	$email 			= addslashes($_REQUEST['email']);
	$estado 			= addslashes($_REQUEST['estado']);
	$cellar 		= addslashes($_REQUEST['cellar']);
	$rol 			= addslashes($_REQUEST['rol']);
	$retorno 		= $welcome->edit_user($nombre,$apellido,$cedula,$cellar,$rol,$email,$estado,$id_user);
	if (count($retorno) > 0 ) {
		$respuesta = array('mensaje' => "Actualización correcta", 'status' => 1 );
	}else{
		$respuesta = array('mensaje' => "error", 'status' => 0);
	}
	echo json_encode($respuesta);
?>