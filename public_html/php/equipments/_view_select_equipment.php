<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/equipments_controller.php');
	$equipment = new Equipments;
	$retorno_equipment = $equipment->get_equipments();
?>
	<i class="material-icons prefix">shopping_basket</i>
	<select class="icons" name="product" id="select_equipment" ruta="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/_partials/_select_quantity.php">
		<option value="" disabled selected id="disabled">Seleccione el equipo</option>
		<?php 
			foreach ($retorno_equipment as $equipment) { ?>
				<option value="<?php echo $equipment['id_equipment']; ?>" disponible="<?php echo $equipment['quantity_available'] ?>" id="<?php echo $equipment['name_equipment']."_".$equipment['id_equipment'] ?>"><?php echo $equipment['name_equipment']; ?></option>
				<?php  	 
			}
		?>	
	</select>