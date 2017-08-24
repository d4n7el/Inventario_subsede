<i class="material-icons prefix">hourglass_empty</i>
<select name="unidad_medida">
	<option value="" disabled selected>Selecciona la unidad de medida</option>
	<?php 
	foreach ($retorno_measure as $key => $value) { ?>
		<option value="<?php echo $value['id_measure']; ?>"><?php echo $value['name_measure']; ?></option>
		<?php 
	}
	?>
</select>
<label>Unidad de medida</label>