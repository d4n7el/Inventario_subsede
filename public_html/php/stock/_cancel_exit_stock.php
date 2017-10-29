<?php 
	$producto = $_REQUEST["a_0"];	$bodega = $_REQUEST["a_1"];	$lote = $_REQUEST["a_2"];
	$cantidad = $_REQUEST["a_3"];	$id_exit_master = $_REQUEST["id_exit_master"];
	$id_exit_detalle = $_REQUEST["id_exit_detalle"]; $id_element = $_REQUEST["id_element"];
?>
<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/stock/delete_exit_stock.php" class="create_info">
	<div class="row">
		<h6 class="titulo fondo_negro paddin1 color_letra_primario center">
			Cancelación salida de <?php echo $producto ?>
		</h6>
		<h5 class="titulo color_letra_secundario col s6 center"> Producto: <?php echo $producto ?> </h5>
		<h5 class="titulo color_letra_secundario col s6 center"> Bodega: <?php echo $bodega ?> </h5>
		<h5 class="titulo color_letra_secundario col s6 center"> Lote: <?php echo $lote ?> </h5>
		<h5 class="titulo color_letra_secundario col s6 center"> Cantidad: <?php echo $cantidad ?> </h5>
		<input type="hidden" value="<?php echo $id_exit_master ?>" name="id_exit_master" required="" readonly="">
		<input type="hidden" value="<?php echo $id_exit_detalle ?>" name="id_exit_detalle" required="" readonly="">
		<input type="hidden" value="<?php echo $id_element ?>" name="id_element" required="" readonly="">
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