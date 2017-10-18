<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/session_controller.php');
	$sessions = new Session();
	$update_use_code = new Session();
	$email_user = addslashes($_REQUEST['email_user']);
	$cod_user = addslashes($_REQUEST['cod_user']);
	$retorno = $sessions->init_session_user_code($email_user,$cod_user);
	if (isset($retorno['name_user'])) {
		$_SESSION["cod_user_activo"] = $retorno['code_recover'];
		$_SESSION["id_user_activo"] = $retorno['id_user'];
		$_SESSION["cedula_user_activo"] = $retorno['cedula'];
		$_SESSION["name_user_activo"] = $retorno['name_user'];
		$_SESSION["last_name_user_activo"] = $retorno['last_name_user'];
		$update_use_code->update_use_code($retorno['id_recover']);
		$respuesta = array('mensaje' => "Bienvenido ".$retorno['name_user'], 'status' => '1', "render" => "" );
	}else{
		$respuesta = array('mensaje' => "Correo ó codigo no validos", 'status' => '0' );
	}
	echo json_encode($respuesta);
 ?>