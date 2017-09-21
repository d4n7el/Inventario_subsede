<?php 
	$cantidad = $_REQUEST['cantidad'];
	$count_number = 1; ?>
	<i class="material-icons prefix">filter_9_plus</i>
	<select> 
		<option value="" disabled selected>Cantidad</option> <?php 
		while ($count_number <= $cantidad) { ?>
			<option value="<?php echo $count_number; ?>"><?php echo $count_number; ?></option>
		    <?php
		    $count_number++;
		} ?>
	</select>

      
      
 