<div class="row">
	<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/users/index.php/" accept-charset="utf-8" class="search">
		<div class="flitro col s9 centrar sombra_blanca">
			<div class="input-field col s4">
	            <i class="material-icons prefix">search</i>
	            <input id="name" type="text" value="<?php echo ($name == "%%") ? "" : $name ?>" class="validate search" name="name" autocomplete="off">
	            <label for="name" class="<?php echo ($name == "%%") ? "" : "active" ?> search">Nombre</label>
	        </div>
	        <div class="input-field col s4">
	            <input id="apellido" type="text" class="validate search" value="<?php echo ($apellido == "%%") ? "" : $apellido ?>" name="apellido" autocomplete="off">
	            <label for="apellido" class="<?php echo ($apellido == "%%") ? "" : "active" ?> search">Apellido</label>
	        </div>
	        <div class="input-field col s4">
	            <input id="cedula" type="text" class="validate search" value="<?php echo ($cedula == "%%") ? "" : $cedula  ?>" name="cedula" autocomplete="off">
	            <label for="cedula" class="<?php echo ($cedula == "%%") ? "" : "active" ?> search">Cedula</label>
	        </div>
	        <div class="input-field col s4">
	            <input id="correo" type="text" class="validate search" value="<?php echo ($correo == "%%") ? "" : $correo ?>" name="correo" autocomplete="off">
	            <label for="correo" class="<?php echo ($correo == "%%") ? "" : "active" ?> search">Correo</label>
	        </div>
	        <input id="estado" type="hidden" class="validate search" value="<?php echo ($estado == "%%") ? "" : $estado ?>" name="estado" autocomplete="off">
	        <p>
      			<input name="group1" value="1" type="radio" id="test1"  <?php echo ($estado == "1") ? "checked"  : "" ?> />
      			<label for="test1">Activo</label>
    		</p>
		    <p>
		      	<input name="group1" value="0" type="radio" id="test2" <?php echo ($estado == "0") ? "checked"  : "" ?> />
		      	<label for="test2">Inactivo</label>
		    </p>
	        <div class=" input-field action col m1 centrar">
	        	<button class="waves-effect waves-light btn-floating btn-primary">
	        		<i class="material-icons left">near_me</i>
	        	</button>
	        </div>	
		</div>
	</form>
</div>
<?php 
	if (count($retorno_user) > 0) {
		foreach ($retorno_user as $key => $value) { ?>
			<div class="row" id="update_<?php echo $value['id_user'] ?>">
				<section>
					<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/users/update_user.php" class="update_info" accept-charset="utf-8">
						<input value="<?php echo $value['id_user'] ?>" name="id_user" type="hidden" readonly="readonly">
						<div class="input-field col s4">
				            <i class="material-icons prefix">account_circle</i>
				            <input id="nombre_user" type="text" class="validate editar_info" name="nombre" autocomplete="off" value="<?php echo $value['name_user'] ?>"  readonly="readonly">
				            <label for="nombre_user" class="active">Nombre del Usuario</label>
				        </div>	
				        <div class="input-field col s4">
				            <i class="material-icons prefix">account_circle</i>
				            <input id="apellido_user" type="text"  class="validate editar_info" name="apellido" autocomplete="off" value="<?php echo $value['last_name_user'] ?>" readonly="readonly" >
				            <label for="apellido_user" class="active">Apellidos del Usuario</label>
				        </div>
				        <div class="input-field col s4 hide oculto">
				            <i class="material-icons prefix">credit_card</i>
				            <input id="cedula_user" type="text" class="validate editar_info" name="cedula" autocomplete="off" value="<?php echo $value['cedula'] ?>" readonly="readonly" >
				            <label for="cedula_user" class="active">Cédula del Usuario</label>
				        </div>
				        <div class="input-field col s4 hide oculto">
				            <i class="material-icons prefix">email</i>
				            <input id="email_user" type="email" class="validate" name="email" autocomplete="off" required value="<?php echo $value['email_user'] ?>">
				            <label for="email_user" class="active">Correo Electrónico</label>
				        </div>
				        <div class="input-field col s4 hide oculto">
				        	<i class="material-icons prefix">thumbs_up_down</i>
						    <select name="estado">
							      <option value="" disabled selected>Estado</option>
							      <option value="0" <?php echo ($estado == "0") ? "selected"  : "" ?>>Inactivo</option>
							      <option value="1" <?php echo ($estado == "1") ? "selected"  : "" ?>>Activo</option>
						    </select>
						    <label>Estado</label>
						</div>
				        <div class="input-field col s4 hide oculto">
				        	<?php require($_SERVER['DOCUMENT_ROOT'].'/php/roles/_view_roles_select.php'); ?>
				        </div>
				        <div class="input-field col s4 hide oculto">
				        	<?php 
				        		require($_SERVER['DOCUMENT_ROOT'].'/php/cellars/_view_cellar_select.php'); 
				        	?>
				        </div>
				        <div class="action col s4 centrar">
				        	<button class="waves-effect waves-light btn btn-success hide actualizar_info">
				        		<i class="material-icons left">near_me</i>Guardar
				        	</button>
				        	<button class="waves-effect waves-light btn btn-primary editar_info">
				        		<i class="material-icons left">cached</i>Editar
				        	</button>
				        </div>
			    	</form>
			    </section>
			</div>
			<?php 
		}
	}else{ ?>
		<h5 class="col s12 centrar color_letra_secundario">No se obtuvieron resultados</h5>
		<?php 
	}
?>
<div class="paginacion col m12">
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php/paginator/index.php'); ?>
</div>