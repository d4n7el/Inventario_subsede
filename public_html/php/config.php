<?php
	if (getenv('CLEARDB_DATABASE_URL')) {
		$secret = array(
		    "email" => getenv('EMAIL'),
		    "pass_email" => getenv('PASS_EMAIL'),
		    "url_get_trabajador_visitante" => getenv('URL_TRABAJOR'),
		    "db_url" => getenv('CLEARDB_DATABASE_URL')
		);
	}else{
		include('secret.php');
	}
?>