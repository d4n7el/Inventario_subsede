<?php 
	if (1==1) {
		$data = array(
			'user' => "Subsede_santarosa", 
			'token' => "2y10MbgK/SGQWmmh1uEpHtC3WeySu5VfCYSbF42hyi/IBaS5TMIgiXFGG",
			//'cellar' => "Lacteos",
			//'product' => "Leche",
			//'limit' => 1, 
			//'offset' => 2,
		);
		//url contra la que atacamos
		$request = curl_init("https://pruebasd4n7el.000webhostapp.com/php/request/apiPlanta.php");
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
		var_dump($response);
		if(!$response) {
			echo json_encode($response);
		}else{
			echo json_encode($response);
		}
	}else{
	}
?>
