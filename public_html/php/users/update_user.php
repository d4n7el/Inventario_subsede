<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/users_controller.php');
	$welcome 		= new Users();
	$nombre 		= addslashes($_REQUEST['nombre']);
	$apellido 		= addslashes($_REQUEST['apellido']);
	$cedula 		= addslashes($_REQUEST['cedula']);
	$id_user 		= addslashes($_REQUEST['id_user']);
	
	$estado 			= addslashes($_REQUEST['estado']);
	$cellar 		= (addslashes($_REQUEST['cellar']) ? $_REQUEST['cellar'] : $_SESSION["cellar_id_user_activo"]);
	$rol 			= (addslashes($_REQUEST['rol']) ? $_REQUEST['rol'] : $_SESSION["id_user_activo_id_role"] );
	$email 			= (addslashes($_REQUEST['email_user']) ? $_REQUEST['email_user'] : $_SESSION["email_user_activo"] );
	$retorno 		= $welcome->edit_user($nombre,$apellido,$cedula,$cellar,$rol,$email,$estado,$id_user);
	if (count($retorno) > 0 ) {
		$respuesta = array('mensaje' => "Actualización correcta", 'status' => 1 );
	}else{
		$respuesta = array('mensaje' => "error", 'status' => 0);
	}
	echo json_encode($respuesta);
?>