<?php 
session_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/stock_controller.php');
$stock = new Stock();
date_default_timezone_set('America/Bogota');
$fecha = date('Y-m-d');
$id_product_exit = $_REQUEST['id_product'];
$retorno_stock = $stock->get_stock($id_product_exit);?>
<i class="material-icons prefix">widgets</i>
<select class="icons" name="lote" id="id_lote" ruta="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/_partials/_select_quantity.php" required>
	<option value="" disabled selected>Seleccione el lote</option><?php
	if (count($retorno_stock) > 0) {
		foreach ($retorno_stock as $stock) { 
			$vencimiento = date('Y-m-d', strtotime($stock['expiration_date'])); 
			if ($vencimiento > $fecha) { ?> 	
				<option value="<?php echo $stock['id_stock']; ?>" disponible="<?php echo $stock['amount'] ?>" class="<?php echo ($vencimiento > $fecha)? "": " color_letra_danger"; ?>"><?php echo $stock['nom_lot']; echo ($vencimiento > $fecha)? "": " Vencido"; ?></option>
				<?php
			}  
		}
	}else{ ?>
		<option value="" disabled selected>No se encontro stock</option>
		<?php 
	}
?>