<div class="row">
    <div class="formulario col s12 contenedor_session centrar">
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
	        <div class="action col s6 offset-s3 centrar">
	        	<button class="waves-effect waves-light btn btn-primary">
	        		<i class="material-icons left">near_me</i>Iniciar
	        	</button>
	        </div>
		</form>
    </div>
</div>