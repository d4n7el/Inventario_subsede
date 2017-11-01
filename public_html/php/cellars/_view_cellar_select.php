<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/cellar_controller.php');
	$cellar = new Cellars();
	(isset($_REQUEST['id_cellar']) ? $id_cellar = $_REQUEST['id_cellar'] : $id_cellar = "%%"); 
	(isset($user) ? $retorno_cellar = $cellar->get_cellar_two($id_cellar) : $retorno_cellar = $cellar->get_cellar($id_cellar)) ?>
	<i class="material-icons prefix">shopping_basket</i>
	<select class="icons" name="cellar" id="id_cellar" required="">
		<option value="" disabled selected>Selecciona la Bodega</option>
		<?php
			$value['id_cellar'] = isset($value['id_cellar']) ? $value['id_cellar'] : 0;
			foreach ($retorno_cellar as $cellar) { 
				if ($_SESSION["cellar_id_user_activo"] == $cellar['id_cellar'] || $_SESSION["id_user_activo_role"] == "A_A-a_1" || $_SESSION["id_user_activo_role"] == "a_A_2_a2") { ?>
					<option <?php  echo $cellar['id_cellar'] == $value['id_cellar'] ? "selected" : '';?> value="<?php echo $cellar['id_cellar']; ?>"><?php echo $cellar['name_cellar']; ?></option>
					<?php
				}
			}
		?>
	</select>