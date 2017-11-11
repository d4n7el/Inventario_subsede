<?php 
	foreach ($retorno_user as $key => $value) { 
		$col = (isset($_REQUEST['modal'])) ? "s12 l12" : "s12 l6";
		$readonly = ($_SESSION["id_user_activo"] == $value['id_user'] || $_SESSION["id_user_activo_role"] == "A_A-a_1") ? "" : "readonly" ?>	
		<div class="row" id="update_<?php echo $value['id_user'] ?>">
			<section class="col <?php echo $col ?>" >
				<h6 class="titulo center color_letra_primario fondo_negro paddin1"><?php echo $value['name_cellar']." - ". $value['name_rol'] ?></h6>
				<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/users/update_user.php" class="update_info" accept-charset="utf-8">
					<input value="<?php echo $value['id_user'] ?>" name="id_user" type="hidden" readonly="readonly">
					<div class="input-field col s12">
			            <i class="material-icons prefix">account_circle</i>
			            <input <?php echo $readonly; ?>id="nombre_user" type="text" class="validate editar_info" name="nombre" autocomplete="off" value="<?php echo $value['name_user'] ?>"  readonly="readonly">
			            <label for="nombre_user" class="active">Nombre cliente</label>
			        </div>	
			        <div class="input-field col s12">
			            <i class="material-icons prefix">account_circle</i>
			            <input <?php echo $readonly; ?>id="apellido_user" type="text"  class="validate editar_info" name="apellido" autocomplete="off" value="<?php echo $value['last_name_user'] ?>" readonly="readonly" >
			            <label for="apellido_user" class="active">Apellido cliente</label>
			        </div>
			        <div class="input-field col s12">
			            <i class="material-icons prefix">account_circle</i>
			            <input <?php echo $readonly; ?>id="apellido_user" type="text"  class="validate editar_info" name="email_user" autocomplete="off" value="<?php echo $value['email_user'] ?>" readonly="readonly" >
			            <label for="email_user" class="active">Correo</label>
			        </div>
			        <div class="input-field col s12">
			            <i class="material-icons prefix">credit_card</i>
			            <input <?php echo $readonly; ?>id="cedula_user" type="text" class="validate editar_info" name="cedula" autocomplete="off" value="<?php echo $value['cedula'] ?>" readonly="readonly" >
			            <label for="cedula_user" class="active">Cedula cliente</label>
			        </div>
			        <?php  
			        if ($_SESSION["id_user_activo_role"] == "A_A-a_1") { ?>
				        <div class="input-field col s4">
				        	<?php require($_SERVER['DOCUMENT_ROOT'].'/php/roles/_view_roles_select.php'); ?>
				        </div>
				        <div class="input-field col s4">
				        	<?php require($_SERVER['DOCUMENT_ROOT'].'/php/cellars/_view_cellar_select.php'); ?>
				        </div>
			        	<?php 
					}?>
			        <div class="input-field col s4">
				        	<i class="material-icons prefix">thumbs_up_down</i>
						    <select name="estado">
							      <option value="" disabled selected>Estado</option>
							      <option value="0" <?php echo ($value['state'] == "0") ? "selected"  : "" ?>>Inactivo</option>
							      <option value="1" <?php echo ($value['state'] == "1") ? "selected"  : "" ?>>Activo</option>
						    </select>
						    <label>Estado</label>
						</div>
					<?php 
					if ($_SESSION["id_user_activo"] == $value['id_user'] || $_SESSION["id_user_activo_role"] == "A_A-a_1") { ?>
						<div class="action col s12 centrar">
				        	<button class="waves-effect waves-light btn btn-success hide actualizar_info">
				        		<i class="material-icons left">near_me</i>Guardar
				        	</button>
				        	<button class="waves-effect waves-light btn btn-primary editar_info">
				        		<i class="material-icons left">cached</i>Editar
				        	</button>
				        </div>
						<?php
					}?>
		    	</form>
		    </section>
		    <?php 
		    if ($_SESSION["id_user_activo"] == $value['id_user'] || $_SESSION["id_user_activo_role"] == "A_A-a_1") { ?>
			<div class="col <?php echo $col ?>">
				<h5 class="col s12 centrar titulo center color_letra_primario fondo_negro paddin1">
					Actualizar la contraseña
				</h5>
				<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php/password/form_new_pass.php'); ?>
			</div>
			<?php
		}?>
		</div>
		<?php 
	}

?>