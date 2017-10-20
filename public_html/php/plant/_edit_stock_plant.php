<div class="row">
	<input type="" name="id_planta" value="<?php echo $retorno_planta[0]['id_stock_plant'] ?>">
	<input type="" name="stock" value="<?php echo $retorno_planta[0]['id_stock'] ?>">
	<input type="" name="exit_product" value="<?php echo $retorno_planta[0]['id_exit_product'] ?>">
    <div class="col s4 color_letra_secundario">
    	<h6 class="col s12 center">Producto: <?php echo $retorno_planta[0]['name_product'] ?> </h6>
    </div>
	<div class="col s4 color_letra_secundario">
		<h6 class="col s12 center">Bodega: <?php echo $retorno_planta[0]['name_cellar'] ?></h6>
	</div>
	<div class="col s4 color_letra_secundario">
		<h6 class="col s12 center">Lote: <?php echo $retorno_planta[0]['nom_lot'] ?></h6>
	</div>
	<div class="input-field col s8 offset-s2" style="margin-top: 4em">
        <i class="material-icons prefix">filter_9_plus</i>
        <input id="cantidad" type="number" min="0" max="" class="validate" name="cantidad" autocomplete="off" value="" required>
        <label for="cantidad" class="active">Cantidad disponible: <?php echo $retorno_planta[0]['quantity']." ".$retorno_planta[0]['prefix_measure'] ?> </label>
    </div>
    <div class="input-field col s8 offset-s2">
        <i class="material-icons prefix">assignment</i>
        <input id="nota_update" type="text" class="validate align-center " name="nota_update" autocomplete="off"  required>
        <label for="nota_update" class="active">Nota de actualización</label>
    </div>	
	<div class="action col m12 centrar">
    	<button class="waves-effect waves-light btn btn-primary">
    		<i class="material-icons left">near_me</i>Guardar
    	</button>
	</div>
</div>