<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/cellar_controller.php');
$cellar = new Cellars();
(isset($_REQUEST['id_cellar']) ? $id_cellar = $_REQUEST['id_cellar'] : $id_cellar = "%%"); 
(isset($user) ? $retorno_cellar = $cellar->get_cellar_two($id_cellar) : $retorno_cellar = $cellar->get_cellar($id_cellar)) ;?>
<i class="material-icons prefix">shopping_basket</i>
<select class="icons" name="cellar" id="id_cellar" <?php echo (isset($cellar_optional)) ? '' : 'required' ?> >
	<option value="" disabled selected>Selecciona la Bodega</option>
	<?php
	$value['id_cellar'] = isset($value['id_cellar']) ? $value['id_cellar'] : 0;
	foreach ($retorno_cellar as $cellar) {
		if (isset($exit_product)) { 
			 ?>
				<option <?php  echo $cellar['id_cellar'] == $value['id_cellar'] ? "selected" : '';?> value="<?php echo $cellar['id_cellar']; ?>"><?php echo $cellar['name_cellar']; ?></option>
				<?php
		}else{?>
			<option <?php  echo $cellar['id_cellar'] == $value['id_cellar'] ? "selected" : '';?> value="<?php echo $cellar['id_cellar']; ?>"><?php echo $cellar['name_cellar']; ?></option>
			<?php
			
		}
	}
	?>
</select>