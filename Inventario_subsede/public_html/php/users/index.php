<?php
	session_start();
	if (isset($_SESSION["id_user_activo"])) {	 
		require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/users_controller.php');
		$welcome = new Users();
		(isset($_REQUEST['id_user']) ? $id_user = $_REQUEST['id_user'] : $id_user = "%%");
		$retorno_user = $welcome->get_user($id_user);
		if (count($retorno_user) > 0) {
			if ($id_user == "%%") {
				require($_SERVER['DOCUMENT_ROOT'].'/php/users/_view_list_user.php');
			}else{
				require($_SERVER['DOCUMENT_ROOT'].'/php/users/_view_show_user.php');
			}	
		}else{
			$respuesta = array('mensaje' => "No se encontraron registros", 'status' => 200 );
		}
	} 
?>