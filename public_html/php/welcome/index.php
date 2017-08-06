<?php 
	session_start();
	if (!isset($_SESSION["id_user_activo"])) {
		require_once($_SERVER['DOCUMENT_ROOT'].'/php/sessions/create_session.php'); 
	}else{
		require_once($_SERVER['DOCUMENT_ROOT'].'/php/welcome/layaout.php'); 
		require_once($_SERVER['DOCUMENT_ROOT'].'/php/welcome/_view_index_session.php'); 
	}
?>

