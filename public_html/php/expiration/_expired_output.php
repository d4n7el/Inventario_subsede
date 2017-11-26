<div class="row">
	<h6 class="titulo center col s12 color_letra_primario fondo_negro paddin1">
		Registro de productos vencidos
	</h6>
	<h6 class="titulo col s12 center">
		Prodcuto : <?php echo $_REQUEST['datos'][0] ?>,  Lote <?php echo $_REQUEST['datos'][1] ?>
		, Cantidad <?php echo $_REQUEST['datos'][2] ?>,  Vencimiento <?php echo $_REQUEST['datos'][3] ?>
	</h6>
	<section>
		<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/expiration/new_expired_output.php" class="create_info" accept-charset="utf-8">
			<input value="<?php echo $_REQUEST['id_stock'] ?>" name="id_stock" type="hidden" readonly="readonly">
	        <div class="input-field col m8 s12 offset-m2">
	        	<i  class="material-icons prefix">speaker_notes</i>
	        	<input id="nota" type="text" class="validate editar_info" name="nota" autocomplete="off" readonly required >
	        	<label for="nota" class="active">Motivo del Vencimiento</label>
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