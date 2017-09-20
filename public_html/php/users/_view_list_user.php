<?php 
	foreach ($retorno_user as $key => $value) { ?>
		<div class="row" id="update_<?php echo $value['id_user'] ?>">
			<section>
				<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/users/update_user.php" class="update_info" accept-charset="utf-8">
					<input value="<?php echo $value['id_user'] ?>" name="id_user" type="hidden" readonly="readonly">
					<div class="input-field col s4">
			            <i class="material-icons prefix">account_circle</i>
			            <input id="nombre_user" type="text" class="validate editar_info" name="nombre" autocomplete="off" value="<?php echo $value['name_user'] ?>"  readonly="readonly">
			            <label for="nombre_user" class="active">Nombre cliente</label>
			        </div>	
			        <div class="input-field col s4">
			            <i class="material-icons prefix">account_circle</i>
			            <input id="apellido_user" type="text"  class="validate editar_info" name="apellido" autocomplete="off" value="<?php echo $value['last_name_user'] ?>" readonly="readonly" >
			            <label for="apellido_user" class="active">Apellido cliente</label>
			        </div>
			        <div class="input-field col s4 hide oculto">
			            <i class="material-icons prefix">credit_card</i>
			            <input id="cedula_user" type="text" class="validate editar_info" name="cedula" autocomplete="off" value="<?php echo $value['cedula'] ?>" readonly="readonly" >
			            <label for="cedula_user" class="active">Cedula cliente</label>
			        </div>
			        <div class="input-field col s4 hide oculto">
			        	<?php require($_SERVER['DOCUMENT_ROOT'].'/php/roles/_view_roles_select.php'); ?>
			        </div>
			        <div class="input-field col s4 hide oculto">
			        	<?php require($_SERVER['DOCUMENT_ROOT'].'/php/cellars/_view_cellar_select.php'); ?>
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
?>
<div class="paginacion col m12">
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php/paginator/index.php'); ?>
</div>