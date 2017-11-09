<i class="material-icons prefix">hourglass_empty</i>
<select name="unidad_medida">
	<option value="" disabled selected>Unidad de medida</option>
	<?php 
	foreach ($retorno_measure as $key => $value_mesuare) { 
		if (isset($value['id_measure'])) { ?>
			<option <?php  echo $value_mesuare['id_measure'] == $value['id_measure'] ? "selected" : '';?> value="<?php echo $value_mesuare['id_measure']; ?>"><?php echo $value_mesuare['name_measure']; ?></option>
			<?php 
		}else{ ?>
			<option value="<?php echo $value_mesuare['id_measure']; ?>"><?php echo $value_mesuare['name_measure']; ?></option>
			<?php 
		}
	}
	?>
</select>