<?php $recover = 1 ?>
<div class="recover_password col s12">
	<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/password/recover_password.php" class="" id="recover_access">
		<div class="input-field col s12 m6 offset-m3">
            <i class="material-icons prefix">email</i>
            <input id="recuperar_pass" type="text" class="validate" name="correo" autocomplete="off" required>
            <label for="recuperar_pass" class="active">Ingresa el correo de recuperación</label>
        </div>
        <div class="action col s12 m6 offset-m3 centrar">
        	<button class="waves-effect waves-light btn btn-success" id="recover_access">
        		<i class="material-icons left">near_me</i>Enviar Código
        	</button>
        </div>
    </form>
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/php/password/_view_actions_password.php');?>
</div>

