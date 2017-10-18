<?php  
if (count($retorno_stock) > 0) {
	foreach ($retorno_stock as $key => $value) { ?>
		<div class="row" id="">
			<section>
			         <input id="nombre_producto" type="hidden" class="validate editar_info" name="id_stock" autocomplete="off" value="<?php echo $value['id_stock'] ?>"  readonly="readonly">
			    <h6 class="titulo">	
					<?php echo $value['name_product']." - ". $value['name_cellar']; ?>
			    </h6>

				<div class="input-field col s4">
			           <?php require($_SERVER['DOCUMENT_ROOT'].'/php/products/view_selects_products.php'); ?>
			    </div>

				<div class="input-field col s4">
			           <i class="material-icons prefix">dashboard</i>
			           <input id="lote" type="text" class="validate editar_info" name="nombre_lote" autocomplete="off" value="<?php echo $value['nom_lot'] ?>"  readonly="readonly">
			           <label for="lote" class="active">Lote</label>
			    </div>

				<div class="input-field col s4 m4">
			        <i class="material-icons prefix">filter_9_plus</i>
			        <input id="nombre_producto" type="text" class="validate editar_info" name="amount" autocomplete="off" value="<?php echo $value['amount'] ?>"  readonly="readonly">
			         <label for="nombre_producto" class="active">Cantidad</label>
			    </div>


				<div class="input-field col s4 m4 ">
			        <i class="material-icons prefix">date_range</i>
			        <input id="nombre_producto" type="text" class="validate datepicker editar_info" name="expiration" autocomplete="off" value="<?php echo $value['expiration_date'] ?>"  readonly="readonly">
			        <label for="nombre_producto" class="active">Fecha Vencimiento</label>
			    </div>
			    <div class="input-field col s4">
				    <select name="estado">
					      <option value="" disabled selected>Estado</option>
					      <option value="0" <?php echo ($estado == "0") ? "selected"  : "" ?>>Inactivo</option>
					      <option value="1" <?php echo ($estado == "1") ? "selected"  : "" ?>>Activo</option>
				    </select>
				    <label>Estado</label>
				</div>
				<div class="input-field col s4">
			        <i class="material-icons prefix">home</i>
			        <input id="nombre_producto" type="text" class="validate editar_info" name="comercializadora" autocomplete="off" value="<?php echo $value['comercializadora'] ?>"  readonly="readonly">
			        <label for="nombre_producto" class="active">Comercializadora</label>
			    </div>
			</section>	    
		</div>
		<?php  
	}
}else{ ?>
	<h5 class="col s12 centrar color_letra_secundario">No se obtuvieron resultados</h5>
	<?php  
}
?>