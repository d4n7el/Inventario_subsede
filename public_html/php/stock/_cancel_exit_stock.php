<?php 
	$producto = $_REQUEST["a_0"];	$bodega = $_REQUEST["a_1"];	$lote = $_REQUEST["a_2"];
	$cantidad = $_REQUEST["a_3"];	$id_exit_product = $_REQUEST["id_exit_product"];
	$id_exit_product_detalle = $_REQUEST["id_exit_product_detalle"];	$stock = $_REQUEST["stock"];
?>
<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/stock/delete_exit_stock.php" method="get" accept-charset="utf-8" class="create_info">
	<div class="row">
		<h5 class="titulo color_letra_secundario col s6 center"> Producto: <?php echo $producto ?> </h5>
		<h5 class="titulo color_letra_secundario col s6 center"> Bodega: <?php echo $bodega ?> </h5>
		<h5 class="titulo color_letra_secundario col s6 center"> Lote: <?php echo $lote ?> </h5>
		<h5 class="titulo color_letra_secundario col s6 center"> Cantidad: <?php echo $cantidad ?> </h5>
		<input type="hidden" value="<?php echo $id_exit_product ?>" name="id_exit_product" required="" readonly="">
		<input type="hidden" value="<?php echo $id_exit_product_detalle ?>" name="id_exit_product_detalle" required="" readonly="">
		<input type="hidden" value="<?php echo $stock ?>" name="stock" required="" readonly="">
		<div class="input-field col s12 m10 offset-m1">
	        <i class="material-icons prefix">receipt</i>
	        <input id="nota" type="text" class="validate" name="nota" autocomplete="off" required>
	        <label for="nota" class="">Nota de cancelación de salida</label>
	    </div>
	    <div class="action col m12 centrar">
	    	<button class="waves-effect waves-light btn btn-primary">
	    		<i class="material-icons left">near_me</i>Guardar
	    	</button>
	    </div>	
	</div>
</form>