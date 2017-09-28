<?php 
session_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/stock_controller.php');
$stock = new Stock();
$id_product_exit = $_REQUEST['id_product'];
$retorno_stock = $stock->get_stock($id_product_exit);?>
<i class="material-icons prefix">widgets</i>
<select class="icons" name="lote" id="id_lote" ruta="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/_partials/_select_quantity.php" required>
	<option value="" disabled selected>Seleccione el lote</option><?php
	foreach ($retorno_stock as $stock) { ?>
		<option value="<?php echo $stock['id_stock']; ?>" disponible="<?php echo $stock['amount'] ?>"><?php echo $stock['nom_lot']; ?></option>
		<?php 
	}
?>