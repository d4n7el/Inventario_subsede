<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/users_controller.php');
	$welcome		= new Users();
	$nombre 		= addslashes($_REQUEST['nombre']);
	$apellido		= addslashes($_REQUEST['apellido']);
	$cedula			= addslashes($_REQUEST['cedula']);
	$email 			= addslashes($_REQUEST['email']);
	$pass 			= addslashes($_REQUEST['pass']);
	$cellar 		= addslashes($_REQUEST['cellar']);
	$rol 			= addslashes($_REQUEST['rol']);
	$pass_confirm 	= addslashes($_REQUEST['pass_confirm']);
	if ($pass == $pass_confirm) {
 		$pass = password_hash($pass, PASSWORD_DEFAULT);
 		$retorno = $welcome->insert_user($nombre,$apellido,$email,$cedula,$pass,$cellar,$rol);
 		if ($retorno > 0 ) {
 			$respuesta = array('mensaje' => "registro correcto", 'status' => 1, 'process' => 'create','graphics' => 'php/users/graphics_pie.php' );
 		}else{
 			$respuesta = array('mensaje' => "error", 'status' => 0 );
 		}
 	}else {
 		$respuesta = array('mensaje' => "La contraseñas no coinciden", 'status' => 0 );
  	}
	echo json_encode($respuesta);
?>