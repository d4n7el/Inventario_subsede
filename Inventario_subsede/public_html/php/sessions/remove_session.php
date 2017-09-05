<?php 
	session_start();
	if (isset($_REQUEST['cerrarSesion'])) {
		session_destroy();
	}
	header("Location: ../../../index.php");
?>