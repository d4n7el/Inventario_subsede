<div class="row" id="update_<?php echo $retorno_herramientas['id_tool'] ?>">
	<section>
		<h6 class="col s12 center fondo_negro paddin1 color_letra_primario">
			Actualizacion de <?php echo $retorno_herramientas['name_tool'] ?>
		</h6>
		<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/tools/update_tools.php" class="update_info" accept-charset="utf-8">
			<input value="<?php echo $retorno_herramientas['id_tool'] ?>" name="id_herramientas" type="hidden" readonly="readonly">
			<div class="input-field col s4">
	            <i class="material-icons prefix">account_circle</i>
	            <input id="nombre_herramienta" type="text" class="validate" name="herramienta" autocomplete="off" value ="<?php echo $retorno_herramientas['name_tool'] ?>" readonly="readonly">
	            <label for="nombre_herramienta" class="active">Herramienta</label>
	        </div>
	        <div class="input-field col s12 m4">
	        	<?php $value['id_cellar'] = $retorno_herramientas['id_cellar'] ?>
	        	<?php $cellar_optional = true ?>
	        	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php/cellars/_view_cellar_select.php'); ?>
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
    	<h5 class="titulo col s12 color_letra_danger center">	
    		<?php $prestamos = ($retorno_outside['count'] > 0) ? $retorno_outside['count'] : 0 ?>	
			<?php echo 'El sistema registra una cantidad de equipos disponibles actualmente de '.$retorno_herramientas['quantity_available']. " y una cantidad prestada de ".$prestamos ; ?>
		</h5>
		<section class="col s6">
			<h6 class="titulo col s12 fondo_negro color_letra_primario center paddin1">
				Sumar Cantidad disponible a <?php echo $retorno_herramientas['name_tool'] ?>.
			</h6>
			<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/tools/update_tools.php" class="update_info" accept-charset="utf-8">
				<input value="<?php echo $retorno_herramientas['id_tool'] ?>" name="id_herramientas" type="hidden" readonly="readonly">
				<input value="1" name="process" type="hidden" readonly="readonly">
		        <div class="input-field col s12">
		        	<i  class="material-icons left">remove</i>
		        	<i  class="material-icons right">add</i>
					<p class="range-field">
				      	<input type="range" value="0"  name="cantidad_disponible" id="darAlta" min="0" max="100" require class="validate" />
				    </p>
			    </div>
		        <div class="input-field col s12">
		        	<i  class="material-icons prefix">speaker_notes</i>
		        	<input id="nota" readonly="" type="text" class="validate editar_info" name="nota" autocomplete="off" required >
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
			restar Cantidad disponible a <?php echo $retorno_herramientas['name_tool'] ?>.
			</h6>
			<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/tools/update_tools.php" class="update_info" accept-charset="utf-8">
				<input value="<?php echo $retorno_herramientas['id_tool'] ?>" name="id_herramientas" type="hidden" readonly="readonly">
				<input value="0" name="process" type="hidden" readonly="readonly">
		        <div class="input-field col s12">
		        	<i  class="material-icons color_letra_danger left">remove</i>
		        	<i  class="material-icons color_letra_danger right">add</i>
					<p class="range-field">
				      	<input type="range" value="0"  name="cantidad_disponible" id="darBaja" min="0" max="100" required class="validate" />
				    </p>
		        </div>
		        <div class="input-field col s12">
		        	<i  class="material-icons color_letra_danger prefix">speaker_notes</i>
		        	<input id="nota" readonly="" type="text" class="validate editar_info" name="nota" autocomplete="off" required >
		        	<label for="nota" class="active">Nota actualización</label>
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