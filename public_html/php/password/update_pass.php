<?php
session_start();
if (isset($_SESSION["id_user_activo"])) {
	$id_user = $_SESSION["id_user_activo"];
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/password_controller.php');
	$password = new Password();
 	$pass 			= addslashes($_REQUEST['pass']);
 	$pass_confirm 	= addslashes($_REQUEST['pass_confirm']);
 	if ($pass == $pass_confirm) {
 		$pass = password_hash($pass, PASSWORD_DEFAULT);
 		$retorno = $password->update_pass($pass,$id_user);
 		if ($retorno > 0 ) {
 			unset($_SESSION["cod_user_activo"]);
 			$respuesta = array('mensaje' => "Actualización correcta", 'status' => 1 );
 		}else{
 			$respuesta = array('mensaje' => "error", 'status' => 0 );
 		}
		}else {
			$respuesta = array('mensaje' => "Las contraseñas no coinciden", 'status' => 0 );
		}
}else{
	$respuesta = array('mensaje' => "Primero inicia sesion", 'status' => 0 );
} 
echo json_encode($respuesta);
?>