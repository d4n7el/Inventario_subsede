<?php 
	if (isset($_REQUEST['cedula'])) {
		$cedula = $_REQUEST['cedula'];
		require_once($_SERVER['DOCUMENT_ROOT'].'/php/secret.php');
		$data = array(
			'documento' => $_REQUEST['cedula'], 
			'access_key' => $secret['user_request_users'],
		);
		//url contra la que atacamos
		$request = curl_init("http://app.pruebas.datisoft.com/php/trabajador/consultar_por_documento");
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
?>