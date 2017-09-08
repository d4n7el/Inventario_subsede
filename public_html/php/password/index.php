<div class="recover_password col s12">
	<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/password/recover_password.php" class=" col s6 offset-s3" id="recover_access">
		<div class="input-field col s12">
            <i class="material-icons prefix">email</i>
            <input id="recuperar_pass" type="text" class="validate" name="correo" autocomplete="off" required>
            <label for="recuperar_pass" class="">Ingresa el correo de recuperacion</label>
        </div>
        <div class="action col s6 offset-s3 centrar">
        	<button class="waves-effect waves-light btn btn-primary" id="recover_access">
        		<i class="material-icons left">near_me</i>Enviar Codigo
        	</button>
        </div>
    </form>
</div>
