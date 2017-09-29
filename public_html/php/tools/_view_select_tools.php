<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/tools_controller.php');
	$tools = new tools;
	$retorno_tools = $tools->get_tools_all();
?>
	<i class="material-icons prefix">shopping_basket</i>
	<select class="icons" name="tools" id="select_equipment" ruta="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/_partials/_select_quantity.php">
		<option value="" disabled selected>Seleccione la herramienta</option>
		<?php 
			foreach ($retorno_tools as $tools) { ?>
				<option value="<?php echo $tools['id_tool']; ?>" disponible="<?php echo $tools['quantity_available'] ?>" id="<?php echo $tools['name_tool']."_".$tools['id_tool'] ?>"><?php echo $tools['name_tool']; ?></option>
				<?php  	 
			}
		?>	
	</select>