<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/cellar_controller.php');
	$cellar = new Cellars();
	(isset($_REQUEST['id_cellar']) ? $id_cellar = $_REQUEST['id_cellar'] : $id_cellar = "%%");
	$retorno_cellar = $cellar->get_cellar($id_cellar);  ?>
	<i class="material-icons prefix">shopping_basket</i>
	<select class="icons" name="cellar" id="id_cellar">
		<option value="" disabled selected>Selecciona la Bodega</option>
		<?php
			foreach ($retorno_cellar as $cellar) { 
				if (isset($value['id_cellar'])) { ?>
					<option <?php  echo $cellar['id_cellar'] == $value['id_cellar'] ? "selected" : '';?> value="<?php echo $cellar['id_cellar']; ?>"><?php echo $cellar['name_cellar']; ?></option>
					<?php
				}else{ ?>
					<option value="<?php echo $cellar['id_cellar']; ?>"><?php echo $cellar['name_cellar']; ?></option>
				<?php
				} 
			}
		?>
	</select>