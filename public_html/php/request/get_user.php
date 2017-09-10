<?php 
	if (isset($_REQUEST['cedula'])) {
		$cedula = $_REQUEST['cedula'];
		require_once($_SERVER['DOCUMENT_ROOT'].'/php/secret.php');
		$data = array(
			'cedula' => $_REQUEST['cedula'], 
			'user' => $secret['user_request_users'],
			'token' => $secret['token_request_users'],
		);
		//url contra la que atacamos
		$request = curl_init("https://dfzamora8.000webhostapp.com/api.php");
		//a true, obtendremos una respuesta de la url, en otro caso, 
		//true si es correcto, false si no lo es
		curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
		//establecemos el verbo http que queremos utilizar para la petición
		curl_setopt($request, CURLOPT_CUSTOMREQUEST, "POST");
		//enviamos el array data
		curl_setopt($request, CURLOPT_POSTFIELDS,http_build_query($data));
		//obtenemos la respuesta
		$response = curl_exec($request);
		// Se cierra el recurso CURL y se liberan los recursos del sistema
		curl_close($request);
		if(!$response) {
			echo json_encode($response);
		}else{
			echo json_encode($response);
		}
	}else{
	}
	curl_close($request);
?>