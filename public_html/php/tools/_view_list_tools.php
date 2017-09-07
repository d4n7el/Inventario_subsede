<?php
	foreach ($retorno_herramientas as $key => $value) {?>

		<div class="row" id="update_<?php echo $value['id_herrramienta'] ?>">
			<section>
				<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/tools/update_tools.php" class="update_info" accept-charset="utf-8">
					<input value="<?php echo $value['id_herrramienta'] ?>" name="id_herramientas" type="hidden" readonly="readonly">
					<div class="input-field col 4">
					            <i class="material-icons prefix">account_circle</i>
					            <input id="nombre_herramienta" type="text" class="validate" name="herramienta" autocomplete="off" value ="<?php echo $value['nombre'] ?>" readonly="readonly">
					            <label for="nombre_herramienta" class="active">Nombre de herramienta</label>
					        </div>
					        <div class="input-field col s4">
					            <i class="material-icons prefix">subject</i>
					            <input id="nombre_marca" type="text" class="validate" name="marca" autocomplete="off" value="<?php echo $value['marca'] ?>" readonly="readonly">
					            <label for="nombre_marca" class="active">Marca</label>
					        </div>
					        <div class="input-field col s4 ">
					            <i class="material-icons prefix">subject</i>
					            <input id="nombre_cantidad" type="text" class="validate" name="cantidad" autocomplete="off" value="<?php echo $value['cantidad'] ?>" readonly="readonly">
					            <label for="nombre_cantidad" class="active">Cantidad</label>
					        </div>
					        <div class="input-field col s4 hide oculto">
					            <i class="material-icons prefix">subject</i>
					            <input id="nombre_cant_dis" type="text" class="validate" name="cantidad_disponible" autocomplete="off" value="<?php echo $value['cantidad_disponible'] ?>" readonly="readonly">
					            <label for="nombre_cant_dis" class="active">Cantidad Disponible</label>
					        </div>
			        <div class="input-field col s4 hide oculto">
			        	<?php require($_SERVER['DOCUMENT_ROOT'].'/php/cellars/_view_cellar_select.php'); ?>
			        </div>
			        <div class="action col s12 centrar">
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