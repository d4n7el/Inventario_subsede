<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/session_controller.php');
$sessions = new Session();
$cedula = addslashes($_REQUEST['cedula']);
$pass = addslashes($_REQUEST['pass']);
$retorno = $sessions->init_session_user($cedula);
if (count($retorno) > 0 ) {
	if (password_verify($pass,$retorno['pass'])) {
		$_SESSION["id_user_activo"] = $retorno['id_user'];
		$_SESSION["cedula_user_activo"] = $retorno['cedula'];
		$_SESSION["name_user_activo"] = $retorno['name_user'];
		$_SESSION["last_name_user_activo"] = $retorno['last_name_user'];
		$respuesta = array('mensaje' => "Bienvenido ".$retorno['name_user'], 'status' => '1', "render" => "" );
	}else{
		$respuesta = array('mensaje' => "Contraseña incorrecta ", 'status' => '0' );
	}
}else{
	$respuesta = array('mensaje' => " Cedula incorrecta ", 'status' => '0' );
}
echo json_encode($respuesta);
 ?>