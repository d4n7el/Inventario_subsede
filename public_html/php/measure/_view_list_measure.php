<?php 
	foreach ($retorno_measure as $key => $value) { ?>
		<div class="row" id="update_<?php echo $value['id_user'] ?>">
			<section>
				<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/measure/update_measure.php" class="update_info" accept-charset="utf-8">
					<input value="<?php echo $value['id_measure'] ?>" name="id_measure" type="hidden" readonly="readonly">
					<div class="input-field col s4">
			            <i class="material-icons prefix">account_circle</i>
			            <input id="medida" type="text" class="validate editar_info" name="medida" autocomplete="off" value="<?php echo $value['name_measure'] ?>"  readonly="readonly">
			            <label for="medida" class="active">Nombre medida</label>
			        </div>
			        <div class="input-field col s4">
			            <i class="material-icons prefix">account_circle</i>
			            <input id="prefijo" type="text" class="validate editar_info" name="prefijo" autocomplete="off" value="<?php echo $value['prefix_measure'] ?>"  readonly="readonly">
			            <label for="prefijo" class="active">Prefijo</label>
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