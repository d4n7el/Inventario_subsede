<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/users_controller.php');
	$welcome = new Users();
	$nombre = addslashes($_REQUEST['nombre']);
	$apellido = addslashes($_REQUEST['apellido']);
	$cedula = addslashes($_REQUEST['cedula']);
	$pass = addslashes($_REQUEST['pass']);
	$pass = password_hash($pass, PASSWORD_DEFAULT);
	$retorno = $welcome->insert_user($nombre,$apellido,$cedula,$pass);
	if (count($retorno) > 0 ) {
		$respuesta = array('mensaje' => "registro correcto", 'status' => 1 );
	}else{
		$respuesta = array('mensaje' => "error", 'status' => 0);
	}
	echo json_encode($respuesta);
 ?>