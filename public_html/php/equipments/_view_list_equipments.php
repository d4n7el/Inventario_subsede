<div class="row">
	<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/equipments/index.php/" accept-charset="utf-8" class="search">
		<div class="flitro col s9 centrar sombra_blanca">
			<div class="input-field col s12 m2">
	            <i class="material-icons prefix">search</i>
	            <input id="equipo" type="text" value="<?php echo ($equipo == "%%") ? "" : $equipo ?>" class="validate search" name="equipo" autocomplete="off">
	            <label for="equipo" class="<?php echo ($equipo == "%%") ? "" : "active" ?> search">Equipo</label>
	        </div>
	        <div class="input-field col s12 m1">
	            <input id="marca" type="text" class="validate search" value="<?php echo ($marca == "%%") ? "" : $marca  ?>" name="marca" autocomplete="off">
	            <label for="marca" class="<?php echo ($marca == "%%") ? "" : "active" ?> search">Marca</label>
	        </div>
	        <div class="input-field col s12 m2">
	            <input id="fecha_inicial" type="text" class="validate search datepicker" value="<?php echo ($fecha_inicial == "%%") ? "" : $fecha_inicial ?>" name="fecha_inicial" autocomplete="off">
	            <label for="destino" class="<?php echo ($fecha_inicial == "%%") ? "" : "active" ?> search">Inicial</label>
	        </div>
	        <div class="input-field col s12 m2">
	            <input id="fecha_final" type="text" class="validate search datepicker" value="<?php echo ($fecha_final == "%%") ? "" : $fecha_final ?>" name="fecha_final" autocomplete="off">
	            <label for="fecha_final" class="<?php echo ($fecha_final == "%%") ? "" : "active" ?> search">Final</label>
	        </div>
	        <div class=" input-field action col m1 centrar">
	        	<button class="waves-effect waves-light btn-floating btn-primary">
	        		<i class="material-icons left">search</i>
	        	</button>
	        </div>	
		</div>
	</form>
</div>


<?php 
foreach ($retorno_equipos as $key => $value) { ?>
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
		            <i class="material-icons prefix">subject</i>
		            <input id="marca" type="text" class="validate editar_info" name="marca" autocomplete="off" value="<?php echo $value['mark'] ?>"  readonly="readonly">
		            <label for="marca" class="active">Marca Equipo</label>
		        </div>
		        <div class="input-field col s4 hide oculto">
		        	<i  class="material-icons prefix">business_center</i>
		        	<input id="cantidad_total" type="text" class="validate editar_info" name="cantidad_total" autocomplete="off" value="<?php echo $value['total_quantity'] ?>">
		        	<label for="cantidad_total" class="active">Cantidad Total</label>
		        </div>
		        <div class="input-field col s4 hide oculto">
		            <i class="material-icons prefix">local_grocery_store</i>
		            <input id="cantida_disponible" type="text" class="validate editar_info" name="cantidad_disponible" autocomplete="off" value="<?php echo $value['quantity_available'] ?>"  readonly="readonly">
		            <label for="cantida_disponible" class="active">Cantidad Disponible</label>
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
} ?>
<div class="paginacion col m12">
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php/paginator/index.php'); ?>
</div>