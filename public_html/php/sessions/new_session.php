<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/session_controller.php');
$sessions = new Session();
$cedula = addslashes($_REQUEST['cedula']);
$pass = addslashes($_REQUEST['pass']);
$retorno = $sessions->init_session_user($cedula);
if (isset($retorno['id_user'])) {
	if (password_verify($pass,$retorno['pass'])) {
		$_SESSION["id_user_activo"] = $retorno['id_user'];
		$_SESSION["id_user_activo_role"] = $retorno['level'];
		$_SESSION["id_user_activo_id_role"] = $retorno['id_role'];
		$_SESSION["id_user_activo_role_name"] = $retorno['name_rol'];
		$_SESSION["id_user_pass"] = $retorno['pass'];
		$_SESSION["cedula_user_activo"] = $retorno['cedula'];
		$_SESSION["cellar_id_user_activo"] = $retorno['id_cellar'];
		$_SESSION["cellar_name_user_activo"] = $retorno['name_cellar'];
		$_SESSION["email_user_activo"] = $retorno['email_user'];
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