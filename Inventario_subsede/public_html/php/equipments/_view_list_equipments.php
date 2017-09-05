<div class="row" id="update_<?php echo $value['id_user'] ?>">
	<section>
		<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/equipments/update_equipment.php" class="update_info" accept-charset="utf-8">
			<input value="<?php echo $value['id_equipment'] ?>" name="id_equipo" type="hidden" readonly="readonly">
			<div class="input-field col s4">
	            <i class="material-icons prefix">account_circle</i>
	            <input id="nombre_equipo" type="text" class="validate editar_info" name="equipo" autocomplete="off" value="<?php echo $value['name_equipment'] ?>"  readonly="readonly">
	            <label for="nombre_producto" class="active">Nombre equipo</label>
	        </div>
	        <div class="input-field col s4">
	            <i class="material-icons prefix">account_circle</i>
	            <input id="marca" type="text" class="validate editar_info" name="marca" autocomplete="off" value="<?php echo $value['mark'] ?>"  readonly="readonly">
	            <label for="marca" class="active">Marca Equipo</label>
	        </div>
	        <div class="input-field col s4 hide oculto">
	        	<i  class="material-icons prefix">business_center</i>
	        	<input id="cantidad_total" type="text" class="validate editar_info" name="cantidad_total" autocomplete="off" value="<?php echo $value['total_quantity'] ?>">
	        	<label for="cantidad_total" class="active">Cantidad Total</label>
	        </div>
	        <div class="input-field col s4 hide oculto">
	            <i class="material-icons prefix">account_circle</i>
	            <input id="cantida_disponible" type="text" class="validate editar_info" name="cantidad_disponible" autocomplete="off" value="<?php echo $value['quantity_available'] ?>"  readonly="readonly">
	            <label for="cantida_disponible" class="active">Cantidad Disponible</label>
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