<div class="row">
	<?php $init = 1 ?>
    <div class="col s12 m8 offset-m2 contenedor_session centrar ">
    	<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/sessions/new_session.php" class="create_info">
	        <div class="input-field col s12 m12">
	            <i class="material-icons prefix">credit_card</i>
	            <input id="cedula_user" type="text" class="validate align-center " name="cedula" autocomplete="off"  required>
	            <label for="cedula_user" class="active">Cédula Usuario</label>
	        </div>	
	        <div class="input-field col s12 m12">
	            <i class="material-icons prefix">fingerprint</i>
	            <input id="pass_user" type="password" class="validate align-center " name="pass" autocomplete="off"  required>
	            <label for="pass_user" class="active">Contraseña Usuario</label>
	        </div>		
	        <div class="action col s12 m6 offset-m3 centrar">
	        	<button class="waves-effect waves-light btn btn-success">
	        		<i class="material-icons left">near_me</i>Iniciar
	        	</button>
	        </div>
		</form>
		<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php/password/_view_actions_password.php');  ?>
    </div>
</div>