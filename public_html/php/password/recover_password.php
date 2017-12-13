<?php
	global $secret; 
	if (isset($_REQUEST['recover']) AND $_REQUEST['recover'] == true) {
	//Librerías para el envío de mail
	include_once($_SERVER['DOCUMENT_ROOT'].'/php/mailer/PHPMailer/class.phpmailer.php');
	include_once($_SERVER['DOCUMENT_ROOT'].'/php/mailer/PHPMailer/class.smtp.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/password_controller.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/users_controller.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/config.php');
	$code = new Password();
	$insert_code = new Password();
	$user = new Users();
	$code_new = $code->generate_code();
	$return_user = $user->show_user($_REQUEST['correo']);
	//Recibir todos los parámetros del formulario
	//Este bloque es importante
	//https://myaccount.google.com/lesssecureapps
	if ($return_user != 0) {
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->Host = "smtp.gmail.com";
		$mail->Port = 587;
		$mail->SMTPSecure = "tls";
		//Nuestra cuenta
		$mail->Username = $secret['email'];
		$mail->Password = $secret['pass_email']; //Su password
		$html = '
			<div class="contenido" style="color: rgba(40,61,73,1); width: 80%; margin-left: 10%; margin-top: 2em">
				<h2 >Inventario Subsede (Recupera tu contraseña) </h2>
				<h2 >Hola '.$return_user['name_user'].' </h2>
				<p> <span style="font-size: 1.5em;"> √ </span>Con el codigo que te enviamos podras acceder al sistema, no olvides modificar tu contraseña.</p>
				<p> <span style="font-size: 1.5em;"> √ </span> Solo podras utilizar este codigo durante la siguiente hora y una unica vez.</p>
				<div style="text-align: center; background-color: rgba(40,61,73,1); color: white; padding: 1em; border-radius: 120px 0px 120px 0px; margin-top: 4em">
					<span>Codigo</span>
					<h3>'.$code_new.'</h3>
				</div>
			</div>';
		//Agregar destinatario
		$count = 0;
		$mail->setFrom($secret['email']);
		$mail->Sender= $secret['email']; 
		$mail->AddBCC($_REQUEST['correo'],$return_user['name_user']);
		$mail->FromName = "Recuperar contraseña";
		$mail->Subject = "Recuperar contraseña";
		$mail->MsgHTML($html);
		$mail->IsHTML(true);
		$mail->CharSet = 'UTF-8';
		if($mail->Send()) {
			$retorno_insert_code = $insert_code->insert_code($return_user['email_user'],$code_new);
			if ($retorno_insert_code > 0) {
				$respuesta = ['mensaje' => 'Se envio el codigo a '.$_REQUEST['correo'], 'status' => 1, 'duracion' => 2000, 'redirecTo' => "../php/sessions/create_session_code.php"];
			}
		}else{
	   		
		}	
		//$mail->ClearAllRecipients(); 
		//Para adjuntar archivo
		//$mail->AddAttachment($archivo['tmp_name'], $archivo['name']);
		//Avisar si fue enviado o no y dirigir al index
	}else{
		$respuesta = ['mensaje' => 'Correo no registrado', 'status' => 0];
	}
	echo json_encode($respuesta);
}
?>