<i class="material-icons prefix">hourglass_empty</i>
<select name="unidad_medida">
	<option value="" disabled selected>Unidad de medida</option>
	<?php 
	foreach ($retorno_measure as $key => $value_mesuare) { ?>
		<option <?php  echo $value_mesuare['id_measure'] == $value['unit_measure'] ? "selected" : '';?> value="<?php echo $value_mesuare['id_measure']; ?>"><?php echo $value_mesuare['name_measure']; ?></option>
		<?php 
	}
	?>
</select>
<label>Unidad de medida</label>