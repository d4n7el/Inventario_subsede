<div class="row">
	<input type="hidden" name="id_exit_detalle" value="<?php echo $id_exit_detalle ?>">
	<input type="hidden" name="id_element" value="<?php echo $id_element ?>">
	<input type="hidden" name="id_exit_master" value="<?php echo $id_exit_master ?>">
    <div class="col s4 color_letra_secundario">
    	<h6 class="col s12 center">Herramienta: <?php echo $retorno_edit_exit[0]['name_tool']?> </h6>
    </div>
    <div class="col s4 color_letra_secundario">
		<h6 class="col s12 center">Bodega: Herramientas</h6>
	</div>
	<div class="input-field col s8 offset-s2" style="margin-top: 4em">
        <i class="material-icons prefix">filter_9_plus</i>
        <input id="cantidad" type="number" min="0" max="<?php echo $id_element[0]['quantity_available']?>" class="validate" name="cantidad" autocomplete="off" value="" required>
        <label for="cantidad" class="active">Cantidad disponible: <?php echo $retorno_edit_exit[0]['quantity_available'] ?> </label>
    </div>
	<div class="action col m12 centrar">
    	<button class="waves-effect waves-light btn btn-primary">
    		<i class="material-icons left">near_me</i>Guardar
    	</button>
	</div>
</div>