<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/password/update_pass.php" class="update_info" accept-charset="utf-8">
	<div class="input-field col s12 m12">
	    <i class="material-icons prefix">fingerprint</i>
	    <input id="pass_user" type="password" class="validate" name="pass" autocomplete="off" required>
	    <label for="pass_user" class="">Crear nueva Contraseña</label>
	</div>
	<div class="input-field col s12 m12">
	    <i class="material-icons prefix">fingerprint</i>
	    <input id="pass_user_confirm" type="password" class="validate" name="pass_confirm" autocomplete="off" required>
	        <label for="pass_user_confirm" class="">Confirmar nueva Contraseña</label>
	</div>
	<?php  
	if (!isset($_SESSION["cod_user_activo"])) { ?>
		<div class="input-field col s12 m12">
		    <i class="material-icons prefix">fingerprint</i>
		    <input id="old_pass_user" type="password" class="validate" name="old_pass" autocomplete="off" required>
		    <label for="old_pass_user" class="">Contraseña actual</label>
		</div>
		<?php  
	} ?>
	 <div class="action col m12 centrar">
    	<button class="waves-effect waves-light btn btn-primary">
    		<i class="material-icons left">near_me</i>Actualizar
    	</button>
    </div>	
</form>