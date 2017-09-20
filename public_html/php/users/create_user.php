<?php  
	session_start();
	if (isset($_SESSION["id_user_activo"])) {
?>
		<div class="row">
		    <div class="formulario col m6 offset-m3">
		    	<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/users/new_user.php" class="create_info">
					<div class="input-field col s12 m12">
			            <i class="material-icons prefix">account_circle</i>
			            <input id="nombre_user" type="text" class="validate" name="nombre" autocomplete="off" required>
			            <label for="nombre_user" class="">Nombre</label>
			        </div>	
			        <div class="input-field col s12 m12">
			            <i class="material-icons prefix">account_circle</i>
			            <input id="apellido_user" type="text" class="validate" name="apellido" autocomplete="off" required>
			            <label for="apellido_user" class="">Apellidos</label>
			        </div>
			        <div class="input-field col s12 m12">
			            <i class="material-icons prefix">credit_card</i>
			            <input id="cedula_user" type="text" class="validate" name="cedula" autocomplete="off" required>
			            <label for="cedula_user" class="">N° de Documento</label>
			        </div>	
			        <div class="input-field col s12 m12">
			            <i class="material-icons prefix">fingerprint</i>
			            <input id="pass_user" type="password" class="validate" name="pass" autocomplete="off" required>
			            <label for="pass_user" class="">Crear Contraseña</label>
			        </div>
					<!-- <div class="input-field col s12 m12">
			            <i class="material-icons prefix">fingerprint</i>
			            <input id="pass_user" type="password" class="validate" name="pass" autocomplete="off" required>
			            <label for="pass_user" class="">Confirmar Contraseña</label>
			        </div> -->
			        <div class="input-field col s12 m12">
			        	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php/roles/_view_roles_select.php'); ?>
			        </div>
			        <div class="input-field col s12 m12">
			        	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php/cellars/_view_cellar_select.php'); ?>
			        </div>
			        		
			        <div class="action col m12">
			        	<button class="waves-effect waves-light btn btn-primary">
			        		<i class="material-icons left">near_me</i>Guardar
			        	</button>
			        </div>	
				</form>
		    </div>
		</div>
		<?php 
	}
	?>
