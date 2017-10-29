<div class="row" id="update_<?php echo $retorno_herramientas['id_tool'] ?>">
	<section>
		<h6 class="col s12 center fondo_negro paddin1 color_letra_primario">
			Actualizacion de <?php echo $retorno_herramientas['name_tool'] ?>
		</h6>
		<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/tools/update_tools.php" class="update_info" accept-charset="utf-8">
			<input value="<?php echo $retorno_herramientas['id_tool'] ?>" name="id_herramientas" type="hidden" readonly="readonly">
			<div class="input-field col 4">
	            <i class="material-icons prefix">account_circle</i>
	            <input id="nombre_herramienta" type="text" class="validate" name="herramienta" autocomplete="off" value ="<?php echo $retorno_herramientas['name_tool'] ?>" readonly="readonly">
	            <label for="nombre_herramienta" class="active">Herramienta</label>
	        </div>
	        <div class="input-field col s4">
	            <i class="material-icons prefix">subject</i>
	            <input id="nombre_marca" type="text" class="validate" name="marca" autocomplete="off" value="<?php echo $retorno_herramientas['mark'] ?>" readonly="readonly">
	            <label for="nombre_marca" class="active">Marca</label>
	        </div>
	        <div class="input-field col s3">
	            <i class="material-icons prefix">filter_9_plus</i>
	            <input id="nombre_cantidad" type="text" class="validate" name="cantidad" autocomplete="off" value="<?php echo $retorno_herramientas['total_quantity'] ?>" readonly="readonly">
	            <label for="nombre_cantidad" class="active">Cantidad</label>
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
    <div class="row">
		<h6 class="titulo col s12 fondo_negro color_letra_primario center paddin1">		
			Sumar Cantidad disponible a <?php echo $retorno_herramientas['name_tool'] ?>.
		</h6>
		<h5 class="titulo col s12 color_letra_danger center">		
			<?php echo 'El sistema registra una cantidad de equipos disponibles actualmente de '.$retorno_herramientas['quantity_available']. " y una cantidad prestada de ".$retorno_outside['count'] ; ?>
		</h5>
		<section>
			<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/tools/update_tools.php" class="update_info" accept-charset="utf-8">
				<input value="<?php echo $retorno_herramientas['id_tool'] ?>" name="id_herramientas" type="hidden" readonly="readonly">
				<input value="1" name="process" type="hidden" readonly="readonly">
		        <div class="input-field col s5">
		        	<i  class="material-icons prefix">business_center</i>
		        	<input id="cantidad_disponible" type="number" class="validate editar_info" name="cantidad_disponible" autocomplete="off" min="0" value="" require>
		        	<label for="cantidad_disponible" class="active">Sumar a cantidad disponible</label>
		        </div>
		        <div class="input-field col s7">
		        	<i  class="material-icons prefix">speaker_notes</i>
		        	<input id="nota" type="text" class="validate editar_info" name="nota" autocomplete="off" required >
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
	<div class="row">
		<h6 class="titulo col s12 fondo_negro color_letra_primario center paddin1">		
			restar Cantidad disponible a <?php echo $retorno_herramientas['name_tool'] ?>.
		</h6>
		<section>
			<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/tools/update_tools.php" class="update_info" accept-charset="utf-8">
				<input value="<?php echo $retorno_herramientas['id_tool'] ?>" name="id_herramientas" type="hidden" readonly="readonly">
				<input value="0" name="process" type="hidden" readonly="readonly">
		        <div class="input-field col s5">
		        	<i  class="material-icons prefix">business_center</i>
		        	<input id="cantidad_disponible" type="number" class="validate editar_info" name="cantidad_disponible" autocomplete="off" min="0" value="" require>
		        	<label for="cantidad_disponible" class="active">Restar a cantidad disponible</label>
		        </div>
		        <div class="input-field col s7">
		        	<i  class="material-icons prefix">speaker_notes</i>
		        	<input id="nota" type="text" class="validate editar_info" name="nota" autocomplete="off" required >
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
</div>