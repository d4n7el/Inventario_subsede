<div class="row">
	<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/products/index.php/" accept-charset="utf-8" class="search">
		<div class="flitro col s12 centrar sombra_blanca">
			<div class="input-field col s12 m2">
	            <input id="producto" type="text" value="<?php echo ($producto == "%%") ? "" : $producto ?>" class="validate search" name="producto" autocomplete="off">
	            <label for="producto" class="<?php echo ($producto == "%%") ? "" : "active" ?> search">Producto</label>
	        </div>
	        <div class="input-field col s12 m2">
	            <input id="bodega" type="text" class="validate search" value="<?php echo ($bodega == "%%") ? "" : $bodega ?>" name="bodega" autocomplete="off">
	            <label for="bodega" class="<?php echo ($bodega == "%%") ? "" : "active" ?> search">Bodega</label>
	        </div>
	        <div class="input-field col s12 m2">
	            <input id="fecha_inicial" type="text" class="validate search datepicker" value="<?php echo ($fecha_inicial == "%%") ? "" : $fecha_inicial ?>" name="fecha_inicial" autocomplete="off">
	            <label for="fecha_inicial" class="<?php echo ($fecha_inicial == "%%") ? "" : "active" ?> search">Fecha inicial</label>
	        </div>
	        <div class="input-field col s12 m2">
	            <input id="fecha_final" type="text" class="validate search datepicker" value="<?php echo ($fecha_final == "%%") ? "" : $fecha_final ?>" name="fecha_final" autocomplete="off">
	            <label for="fecha_final" class="<?php echo ($fecha_final == "%%") ? "" : "active" ?> search">Fecha final</label>
	        </div>
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
			<strong>creación  </strong>
		</a>
	</div>
	<div class="col s2 centrar head_cell">
		<a href="#" class="tabla color_letra_primario" order="nom_lot ASC">
			<strong>Ica  </strong>
		</a>
	</div>
	<div class="col s3 centrar head_cell">
		<a href="#" class="tabla color_letra_primario" order="quantity DESC">
			<strong>Opciones</strong>
		</a>
	</div>
</div>
<?php 
	foreach ($retorno_productos as $key => $value) { ?>
		<div class="row tabla " id="celda_<?php echo $value['id_exit_product_master'].$value['id_exit_product_detalle'] ?>" >
			<div class="col s2 primary_cell producto">
				<h6 class="col s12 center color_letra_secundario" >
				 <?php echo $value['name_product']; ?></h6>
			</div>
			<div class="col s2 second_cell bodega">
				<h6 class="col s12 center color_letra_secundario">
				 <?php echo $value['name_cellar']; ?></h6>
			</div>
			<div class="col s3 second_cell cantidad_disponible">
				<h6 class="col s12 center color_letra_secundario">
					<?php echo $value['creation_date']?>
				</h6>
			</div>
			<div class="col s2 second_cell cantidad_disponible">
				<h6 class="col s12 center color_letra_secundario">
					Ica cod
				</h6>
			</div>
			<div class="col s1 second_cell">
				<button type="" class="col s12 btn btn-primary material-icons color_letra_secundario modal-trigger view_info_product" product="<?php echo $value['id_product'] ?>" ruta="../php/products/index.php" data-target="modal_center">visibility</button>
			</div>
		</div>
		<?php  
	}
?>
<div class="paginacion col m12">
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php/paginator/index.php'); ?>
</div>