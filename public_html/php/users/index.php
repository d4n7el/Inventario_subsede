<?php
	session_start();
	if (isset($_SESSION["id_user_activo"])) {	 
		require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/users_controller.php');
		$welcome = new Users();
		(isset($_REQUEST['id_user']) ? $id_user = $_REQUEST['id_user'] : $id_user = "%%");
		
		// NECESARIO PARA LA PAGINACION
		$count_user = new Users();
		(isset($_REQUEST['pagina']) ? $pagina = $_REQUEST['pagina'] : $pagina = 0);
		$limit = 1;
		$offset = $limit * $pagina;
		$retorno_count_user = $count_user->count_user();
		$count_rows = $retorno_count_user['count'];
		$href = '/php/users/index.php';
		// NECESARIO PARA LA PAGINACION
		
		$retorno_user = $welcome->get_user($id_user,$limit,$offset);
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