<div class="row">
	<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/stock/index.php/" accept-charset="utf-8" class="search">
		<div class="flitro col s12 centrar sombra_blanca">
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
<div class="row" id="head_table">
	<div class="col s2 centrar prymary_head_cell">
		<a href="#" class="tabla color_letra_primario" order="name_product ASC">
			<strong>Producto</strong>
		</a>
	</div>
	<div class="col s2 centrar head_cell">
		<a href="#" class="tabla color_letra_primario" order="name_cellar ASC">
			<strong>Bodega</strong>
		</a>
	</div>
	<div class="col s3 centrar head_cell">
		<a href="#" class="tabla color_letra_primario" order="nom_lot ASC">
			<strong>Vencimiento  </strong>
		</a>
	</div>
	<div class="col s2 centrar head_cell">
		<a href="#" class="tabla color_letra_primario" order="quantity DESC">
			<strong>Cantidad</strong>
		</a>
	</div>
	<div class="col s2 centrar head_cell">
		<a href="#" class="tabla color_letra_primario" order="quantity DESC">
			<strong>Bodega  </strong>
		</a>
	</div>
	<div class="col s1 centrar head_cell">
		<a href="#" class="color_letra_primario">
			<strong>Opciones  </strong>
		</a>
	</div>
</div>
<?php 
if (count($retorno_stock) > 0) {
	foreach ($retorno_stock as $key => $value) { ?>
		<div class="row tabla " id="celda_<?php echo $value['id_exit_product_master'].$value['id_exit_product_detalle'] ?>" >
			<div class="col s2 primary_cell producto">
				<h6 class="col s12 center color_letra_secundario" >
				 <?php echo $value['name_product']; ?></h6>
			</div>
			<div class="col s2 second_cell bodega">
				<h6 class="col s12 center color_letra_secundario">
				 <?php echo $value['name_cellar']; ?></h6>
			</div>
			<div class="col s3 second_cell lote">
				<h6 class="col s12 center color_letra_secundario">
				<?php echo $value['expiration_date']; ?></h6>
			</div>
			<div class="col s2 second_cell cantidad_disponible">
				<h6 class="col s12 center color_letra_secundario">
					<?php echo $value['amount']?>
				</h6>
			</div>
			<div class="col s2 second_cell cantidad_disponible">
				<h6 class="col s12 center color_letra_secundario">
					<?php echo $value['name_cellar']?>
				</h6>
			</div>
			<div class="col s1 second_cell">
				<button type="" class="col s12 btn btn-primary material-icons color_letra_secundario modal-trigger view_info_stock" stock="<?php echo $value['id_stock'] ?>" data-target="modal_right">visibility</button>
			</div>
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