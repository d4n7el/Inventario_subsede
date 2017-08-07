<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/users_controller.php');
	$welcome = new Users();
	$id_user = $_REQUEST['id_user'];
	$id_user || $id_user = "%%";
	$retorno_user = $welcome->get_user($id_user);
	if (count($retorno_user) > 0) {
		foreach ($retorno_user as $key => $value) {
			require($_SERVER['DOCUMENT_ROOT'].'/php/users/_view_list_user.php');
		}
		
	}else{
		$respuesta = array('mensaje' => "No se encontraron registros", 'status' => 200 );
	}
	
?>