<div class="row">
	aaa
	<h6 class="titulo fondo_negro paddin1 color_letra_primario center">
		Actualización de salida de <?php echo $retorno_edit_exit[0]['name_product'] ?>
	</h6>
	<input type="hidden" name="exit_product_detalle" value="<?php echo $retorno_edit_exit[0]['id_exit_product_detalle'] ?>">
	<input type="hidden" name="stock" value="<?php echo $retorno_edit_exit[0]['id_stock'] ?>">
	<input type="hidden" name="exit_product" value="<?php echo $retorno_edit_exit[0]['id_exit_product_master'] ?>">
    <div class="col s4 color_letra_secundario">
    	<h6 class="col s12 center">Producto: <?php echo $retorno_edit_exit[0]['name_product'] ?> </h6>
    </div>
	<div class="col s4 color_letra_secundario">
		<h6 class="col s12 center">Bodega: <?php echo $retorno_edit_exit[0]['name_cellar'] ?></h6>
	</div>
	<div class="col s4 color_letra_secundario">
		<h6 class="col s12 center">Lote: <?php echo $retorno_edit_exit[0]['nom_lot'] ?></h6>
	</div>
	<div class="input-field col s8 offset-s2" style="margin-top: 4em">
        <i class="material-icons prefix">filter_9_plus</i>
        <input id="cantidad" type="number" min="0" max="<?php echo $retorno_edit_exit[0]['amount']?>" class="validate" name="cantidad" autocomplete="off" value="" required>
        <label for="cantidad" class="active">Cantidad disponible: <?php echo $retorno_edit_exit[0]['amount']." ".$retorno_edit_exit[0]['prefix_measure'] ?> </label>
    </div>
	<div class="action col m12 centrar">
    	<button class="waves-effect waves-light btn btn-primary">
    		<i class="material-icons left">near_me</i>Guardar
    	</button>
	</div>
</div>