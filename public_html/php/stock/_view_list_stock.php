<div class="row">
	<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/stock/index.php/" accept-charset="utf-8" class="search">
		<div class="flitro col s9 centrar sombra_blanca">
			<div class="input-field col s12 m2">
	            <input id="lote" type="text" value="<?php echo ($lote == "%%") ? "" : $lote ?>" class="validate search" name="lote" autocomplete="off">
	            <label for="lote" class="<?php echo ($lote == "%%") ? "" : "active" ?> search">Lote</label>
	        </div>
	        <div class="input-field col s12 m2">
	            <input id="bodega" type="text" value="<?php echo ($bodega == "%%") ? "" : $bodega ?>" class="validate search" name="bodega" autocomplete="off">
	            <label for="bodega" class="<?php echo ($bodega == "%%") ? "" : "active" ?> search">Bodega</label>
	        </div>
	        <div class="input-field col s12 m2">
	            <input id="producto" type="text" value="<?php echo ($producto == "%%") ? "" : $producto ?>" class="validate search" name="bodega" autocomplete="off">
	            <label for="producto" class="<?php echo ($producto == "%%") ? "" : "active" ?> search">Producto</label>
	        </div>
	        <div class="input-field col s12 m3">
	            <input id="casa" type="text" class="validate search" value="<?php echo ($casa == "%%") ? "" : $casa  ?>" name="casa" autocomplete="off">
	            <label for="casa" class="<?php echo ($casa == "%%") ? "" : "active" ?> search">Comercializadora</label>
	        </div>
	        <div class="input-field col s12 m2">
	            <input id="vencimiento" type="text" class="validate search datepicker" value="<?php echo ($vencimiento == "%%") ? "" : $vencimiento ?>" name="vencimiento" autocomplete="off">
	            <label for="vencimiento" class="<?php echo ($vencimiento == "%%") ? "" : "active" ?> search">Vencimiento</label>
	        </div>
	        <div class="input-field col s12 m2">
	            <input id="fecha_inicial" type="text" class="validate search datepicker" value="<?php echo ($fecha_inicial == "%%") ? "" : $fecha_inicial ?>" name="fecha_inicial" autocomplete="off">
	            <label for="fecha_inicial" class="<?php echo ($fecha_inicial == "%%") ? "" : "active" ?> search">Fecha inicial</label>
	        </div>
	        <div class="input-field col s12 m2">
	            <input id="fecha_final" type="text" class="validate search datepicker" value="<?php echo ($fecha_final == "%%") ? "" : $fecha_final ?>" name="fecha_final" autocomplete="off">
	            <label for="fecha_final" class="<?php echo ($fecha_final == "%%") ? "" : "active" ?> search">Fecha final</label>
	        </div>
	        <input id="estado" type="hidden" class="validate search" value="<?php echo ($estado == "%%") ? "" : $estado ?>" name="estado" autocomplete="off">
	        <p>
      			<input name="group1" value="1" type="radio" id="test1"  <?php echo ($estado == "1") ? "checked"  : "" ?> />
      			<label for="test1">Activo</label>
    		</p>
		    <p>
		      	<input name="group1" value="0" type="radio" id="test2" <?php echo ($estado == "0") ? "checked"  : "" ?> />
		      	<label for="test2">Inactivo</label>
		    </p>
	        <div class=" input-field action col m1 centrar">
	        	<button class="waves-effect waves-light btn-floating btn-primary">
	        		<i class="material-icons left">search</i>
	        	</button>
	        </div>	
		</div>
	</form>
</div>
<?php 
if (count($retorno_stock) > 0) {
	foreach ($retorno_stock as $key => $value) { ?>
		<div class="row" id="">
			<section>
				<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/stock/update_stock.php" class="update_info" accept-charset="utf-8">
				         <input id="nombre_producto" type="hidden" class="validate editar_info" name="id_stock" autocomplete="off" value="<?php echo $value['id_stock'] ?>"  readonly="readonly">
				    <h6 class="titulo">	
						<?php echo $value['name_product']." - ". $value['name_cellar']; ?>
				    </h6>

					<div class="input-field col s4 hide oculto">
				           <?php require($_SERVER['DOCUMENT_ROOT'].'/php/products/view_selects_products.php'); ?>
				    </div>

					<div class="input-field col s4">
				           <i class="material-icons prefix">dashboard</i>
				           <input id="lote" type="text" class="validate editar_info" name="nombre_lote" autocomplete="off" value="<?php echo $value['nom_lot'] ?>"  readonly="readonly">
				           <label for="lote" class="active">Lote</label>
				    </div>

					<div class="input-field col s4 m2">
				        <i class="material-icons prefix">filter_9_plus</i>
				        <input id="nombre_producto" type="text" class="validate editar_info" name="amount" autocomplete="off" value="<?php echo $value['amount'] ?>"  readonly="readonly">
				         <label for="nombre_producto" class="active">Cantidad</label>
				    </div>


					<div class="input-field col s4 m3 ">
				        <i class="material-icons prefix">date_range</i>
				        <input id="nombre_producto" type="text" class="validate datepicker editar_info" name="expiration" autocomplete="off" value="<?php echo $value['expiration_date'] ?>"  readonly="readonly">
				        <label for="nombre_producto" class="active">Fecha Vencimiento</label>
				    </div>
				    <div class="input-field col s3 hide oculto">
					    <select name="estado">
						      <option value="" disabled selected>Estado</option>
						      <option value="0" <?php echo ($estado == "0") ? "selected"  : "" ?>>Inactivo</option>
						      <option value="1" <?php echo ($estado == "1") ? "selected"  : "" ?>>Activo</option>
					    </select>
					    <label>Estado</label>
					</div>
					<div class="input-field col s4 hide oculto">
				        <i class="material-icons prefix">home</i>
				        <input id="nombre_producto" type="text" class="validate editar_info" name="comercializadora" autocomplete="off" value="<?php echo $value['comercializadora'] ?>"  readonly="readonly">
				        <label for="nombre_producto" class="active">Comercializadora</label>
				    </div>
				    <div class="action col s12 m3 centrar">
				       <button class="waves-effect waves-light btn btn-success hide actualizar_info">
				        <i class="material-icons left">near_me</i>Guardar
				       </button>

				       <button class="waves-effect waves-light btn btn-primary editar_info">
				        <i class="material-icons left">cached</i>Editar
				       </button>
				    </div>
				</form>
			</section>	    
		</div>
		<?php  
	}
}else{ ?>
	<h5 class="col s12 centrar color_letra_secundario">No se obtuvieron resultados</h5>
	<?php  
}
?>
<div class="paginacion col m12">
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php/paginator/index.php'); ?>
</div>