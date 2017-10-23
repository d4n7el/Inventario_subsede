<div class="row">
	<input type="" name="exit_equipment_detalle" value="<?php echo $retorno[0]['id_exit_detall'] ?>">
	<input type="" name="equipo" value="<?php echo $retorno[0]['id_equipment'] ?>">
	<input type="" name="exit_equipment" value="<?php echo $retorno[0]['id_exit'] ?>">
    <div class="col s4 color_letra_secundario">
    	<h6 class="col s12 center">Equipo: <?php echo $retorno[0]['name_equipment'] ?> </h6>
    </div>
	<div class="col s4 color_letra_secundario">
		<h6 class="col s12 center">Bodega: Equipos</h6>
	</div>
	<div class="input-field col s8 offset-s2" style="margin-top: 4em">
        <i class="material-icons prefix">filter_9_plus</i>
        <input id="cantidad" type="number" min="0" max="<?php echo $retorno[0]['quantity']?>" class="validate" name="cantidad" autocomplete="off" value="" required>
        <label for="cantidad" class="active">Cantidad disponible: <?php echo $retorno[0]['quantity']?> </label>
    </div>
	<div class="action col m12 centrar">
    	<button class="waves-effect waves-light btn btn-primary">
    		<i class="material-icons left">near_me</i>Guardar
    	</button>
	</div>
</div>