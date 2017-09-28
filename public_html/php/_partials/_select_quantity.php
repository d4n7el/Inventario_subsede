<?php 
	(isset($_REQUEST['cantidad_disponible']) ? $cantidad_disponible = $_REQUEST['cantidad_disponible'] : $cantidad_disponible = 0);
	(isset($_REQUEST['cantidad']) ? $cantidad = $_REQUEST['cantidad'] : $cantidad = 0);
	$count_number = 1; ?>
	<i class="material-icons prefix">filter_9_plus</i>
	<select name="cantidaddes" id="cantidades" required="">
		<option value="" disabled selected>Cantidad</option> <?php 
		while ($count_number <= $cantidad_disponible) { ?>
			<option <?php  echo $count_number == $cantidad ? "selected" : '';?> value="<?php echo $count_number; ?>"><?php echo $count_number; ?></option>
		    <?php
		    $count_number++;
		} ?>
	</select>

      
      
 