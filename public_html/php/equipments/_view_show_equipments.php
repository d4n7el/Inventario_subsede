<?php
foreach ($retorno_equipos as $key => $value) { ?>
	<div class="row" id="update_<?php echo $value['id_user'] ?>">
		<h6 class="titulo fondo_negro color_letra_primario center paddin1">		
			Editar Informacion Equipo.
		</h6>
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
		        <div class="input-field col s4">
		        	<i  class="material-icons prefix">business_center</i>
		        	<input id="cantidad_total" type="text" class="validate editar_info" name="cantidad_total" autocomplete="off" value="<?php echo $value['total_quantity'] ?>">
		        	<label for="cantidad_total" class="active">Cantidad Total</label>
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

	<?php if ($_SESSION["id_user_activo_role"] == 'A_A-a_1'  || $_SESSION["id_user_activo_role"] == 'B_1-b_1') { ?>
	<div class="row" id="update_<?php echo $value['id_user'] ?>">
		<h6 class="titulo col s12 fondo_negro color_letra_primario center paddin1">		
			Sumar Cantidad disponible al Equipo.
		</h6>
		<h5 class="titulo color_letra_danger center">		
			<?php echo 'El sistema registra una cantidad de equipos disponibles actualmente de '.$value['quantity_available']. " y una cantidad prestada de ".$retorno_outside['count'] ; ?>
		</h5>
		<section>
			<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/equipments/update_equipment.php" class="update_info" accept-charset="utf-8">
				<input value="<?php echo $value['id_equipment'] ?>" name="id_equipo" type="hidden" readonly="readonly">
				<input value="1" name="process" type="hidden" readonly="readonly">
		        <div class="input-field col s5">
		        	<i  class="material-icons prefix">business_center</i>
		        	<input id="cantidad_disponible" type="number" class="validate editar_info" name="cantidad_disponible" autocomplete="off" min="0" value="" require>
		        	<label for="cantidad_disponible" class="active">Sumar a cantidad disponible</label>
		        </div>
		        <div class="input-field col s7">
		        	<i  class="material-icons prefix">speaker_notes</i>
		        	<input id="nota" type="text" class="validate editar_info" name="nota" autocomplete="off" require >
		        	<label for="nota" class="active">Nota actuaización</label>
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
	
	<div class="row" id="update_<?php echo $value['id_user'] ?>">
		<h6 class="titulo col s12 fondo_negro color_letra_primario center paddin1">		
			Restar Cantidad disponible al Equipo.
		</h6>
		<section>
			<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/equipments/update_equipment.php" class="update_info" accept-charset="utf-8">
				<input value="<?php echo $value['id_equipment'] ?>" name="id_equipo" type="hidden" readonly="readonly">
				<input value="0" name="process" type="hidden" readonly="readonly">
		        <div class="input-field col s5">
		        	<i  class="material-icons prefix">business_center</i>
		        	<input id="cantidad_disponible" type="number" class="validate editar_info" name="cantidad_disponible" autocomplete="off" min="0" value="" require>
		        	<label for="cantidad_disponible" class="active">Restar a cantidad disponible</label>
		        </div>
		        <div class="input-field col s7">
		        	<i  class="material-icons prefix">speaker_notes</i>
		        	<input id="nota" type="text" class="validate editar_info" name="nota" autocomplete="off" require >
		        	<label for="nota" class="active">Nota actuaización</label>
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
	<?php } ?>
	<?php 
} ?>