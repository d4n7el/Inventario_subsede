<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/users_controller.php');
	$welcome = new Users();
	$nombre = addslashes($_REQUEST['nombre']);
	$apellido = addslashes($_REQUEST['apellido']);
	$email = addslashes($_REQUEST['email']);
	$cedula = addslashes($_REQUEST['cedula']);
	$pass = addslashes($_REQUEST['pass']);
	$cellar = addslashes($_REQUEST['cellar']);
	$rol = addslashes($_REQUEST['rol']);
	$pass = password_hash($pass, PASSWORD_DEFAULT);
	$retorno = $welcome->insert_user($nombre,$apellido,$email,$cedula,$pass,$cellar,$rol);
	if (count($retorno) > 0 ) {
		$respuesta = array('mensaje' => "registro correcto", 'status' => 1 );
	}else{
		$respuesta = array('mensaje' => "error", 'status' => 0 );
	}
	echo json_encode($respuesta);
?>