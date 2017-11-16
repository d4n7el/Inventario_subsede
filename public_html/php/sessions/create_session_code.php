<div class="row">
	<?php $code = 1 ?>
    <div class="col s12 ">
    	<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/sessions/new_session_code.php" class="create_info">
	        <div class="input-field col s12 m12">
	            <i class="material-icons prefix">credit_card</i>
	            <input id="correo_user" type="text" class="validate align-center " name="email_user" autocomplete="off"  required>
	            <label for="correo_user" class="">Correo usuario</label>
	        </div>	
	        <div class="input-field col s12 m12">
	            <i class="material-icons prefix">fingerprint</i>
	            <input id="cod_user" type="password" class="validate align-center " name="cod_user" autocomplete="off"  required>
	            <label for="cod_user" class="">Ingrese el codigo</label>
	        </div>		
	        <div class="action col s12 m6 offset-m3 centrar">
	        	<button class="waves-effect waves-light btn btn-success">
	        		<i class="material-icons left">near_me</i>Iniciar
	        	</button>
	        </div>
		</form>
		<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php/password/_view_actions_password.php');?>
    </div>
</div>