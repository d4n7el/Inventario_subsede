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
		        	<input id="cantidad_total" type="text" class="validate editar_info" name="cantidad_total" readonly="readonly" autocomplete="off" value="<?php echo $value['total_quantity'] ?>">
		        	<label for="cantidad_total" class="active">Cantidad Total</label>
		        </div>	

		        <div class="input-field col s4">
		        	<i  class="material-icons prefix">business_center</i>
		        	<select name="estado" id="estado">
		        		<option value="0">Inactivo</option>
		        		<option value="1">Activo</option>
		        	</select>
		        	<label for="estado" class="active">Estado</label>
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
	if ($_SESSION["id_user_activo_role"] != 'A1-_1B'  || $_SESSION["id_user_activo_role"] != 'E_1_S1') { ?>
		<div class="row" id="update_<?php echo $value['id_user'] ?>">
			<h5 class="titulo color_letra_danger center col s12">
				<?php $prestamos = ($retorno_outside['count'] > 0) ? $retorno_outside['count'] : 0 ?>	
				<?php echo 'El sistema registra una cantidad de equipos disponibles actualmente de '.$value['quantity_available']. " y una cantidad prestada de ". $prestamos ?>
			</h5>
			<section class="col s6">
				<h6 class="titulo col s12 fondo_negro color_letra_primario center paddin1">		
					Sumar Cantidad disponible al Equipo.
				</h6>
				<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/equipments/update_equipment.php" class="update_info" accept-charset="utf-8">
					<input value="<?php echo $value['id_equipment'] ?>" name="id_equipo" type="hidden" readonly="readonly">
					<input value="1" name="process" type="hidden" readonly="readonly">

			        <div class="input-field col s12">
			        	<i  class="material-icons menos left">remove</i>
			        	<i  class="material-icons mas right">add</i>
						<p class="range-field">
					      	<input type="range" value="0"  name="cantidad_disponible" id="darAlta" min="0" max="100" require class="validate" />
					    </p>
					    
			        </div>
			        <div class="input-field col s12">
			        	<i  class="material-icons prefix">speaker_notes</i>
			        	<input id="nota" type="text" readonly="readonly" class="validate editar_info" name="nota" autocomplete="off" require >
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
		    <section class="col s6">
				<h6 class="titulo col s12 fondo_claro color_letra_primario center paddin1">		
					Restar Cantidad disponible al Equipo.
				</h6>
				<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/equipments/update_equipment.php" class="update_info" accept-charset="utf-8">
					<input value="<?php echo $value['id_equipment'] ?>" name="id_equipo" type="hidden" readonly="readonly">
					<input value="0" name="process" type="hidden" readonly="readonly">
			        <div class="input-field col s12">
			        	<i class="material-icons color_letra_danger menos left">remove</i>
			        	<i class="material-icons color_letra_danger mas right">add</i>
						<p class="range-field">
					      	<input type="range" value="0"  name="cantidad_disponible" id="darBaja" min="0" max="100" required class="validate" />
					    </p>
			        </div>
			        <div class="input-field col s12">
			        	<i  class="material-icons color_letra_danger prefix">speaker_notes</i>
			        	<input id="nota" type="text" class="validate editar_info" name="nota" autocomplete="off" readonly="readonly" required >
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
		<?php 
	} 
} ?>