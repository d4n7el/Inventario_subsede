<?php
	session_start();
	if (isset($_SESSION["id_user_activo"])) {
		$user = true; 
		require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/users_controller.php');
		$welcome = new Users();
		(isset($_REQUEST['id_user']) ? $id_user = $_REQUEST['id_user'] : $id_user = "%%");
		$name = isset($_REQUEST['name']) && $_REQUEST['name'] != "" ? $_REQUEST['name'] : "%%";
		$apellido = isset($_REQUEST['apellido']) && $_REQUEST['apellido'] != "" ? $_REQUEST['apellido'] : "%%";
		$correo = isset($_REQUEST['correo']) && $_REQUEST['correo'] != "" ? $_REQUEST['correo'] : "%%";
		$cedula = isset($_REQUEST['cedula']) && $_REQUEST['cedula'] != "" ? $_REQUEST['cedula'] : "%%";
		$estado = isset($_REQUEST['estado']) && $_REQUEST['estado'] != "" ? $_REQUEST['estado'] : 1;
		
		// NECESARIO PARA LA PAGINACION
		$count_user = new Users();
		(isset($_REQUEST['pagina']) ? $pagina = $_REQUEST['pagina'] : $pagina = 0);
		$limit = 4;
		$offset = $limit * $pagina;
		$retorno_count_user = $count_user->count_user($name,$cedula,$correo,$apellido,$id_user,$estado);
		$count_rows = $retorno_count_user['count'];
		$href = '/php/users/index.php';
		// NECESARIO PARA LA PAGINACION
		
		$retorno_user = $welcome->get_user($name,$cedula,$correo,$apellido,$id_user,$estado,$limit,$offset);
		if ($id_user == "%%") {
			require($_SERVER['DOCUMENT_ROOT'].'/php/users/_view_list_user.php');
		}else{
			require($_SERVER['DOCUMENT_ROOT'].'/php/users/_view_show_user.php');
		}	
		
	} 
?>