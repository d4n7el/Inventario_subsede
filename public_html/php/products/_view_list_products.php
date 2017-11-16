<div class="row" id="view_actions_table">
	<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/products/index.php/" accept-charset="utf-8" class="search">
		<div class="flitro col s12 centrar">
			<div class="input-field col s12 m2">
	            <input id="producto" type="text" value="<?php echo ($producto == "%%") ? "" : $producto ?>" class="validate search" name="producto" autocomplete="off">
	            <label for="producto" class="<?php echo ($producto == "%%") ? "" : "active" ?> search">Producto</label>
	        </div>
	        <div class="input-field col s12 m2 hide-on-small-only">
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
	<div class="row" id="head_table">
		<div class="col s5 m3 centrar prymary_head_cell">
			<a href="#" class="tabla fondo_blanco" order="name_product ASC">
				<strong>Producto</strong>
			</a>
		</div>
		<div class="col s4 m2 centrar head_cell ">
			<a href="#" class="tabla fondo_blanco" order="name_cellar ASC">
				<strong>Bodega</strong>
			</a>
		</div>
		<div class="col s1 m1 centrar head_cell hide-on-small-only">
			<a href="#" class="tabla fondo_blanco" order="toxicological ASC">
				<strong>Categoria  </strong>
			</a>
		</div>
		<div class="col s2 m2 centrar head_cell hide-on-small-only">
			<a href="#" class="tabla fondo_blanco" order="nom_lot ASC">
				<strong>Ica  </strong>
			</a>
		</div>
		<div class="col s2 m2 centrar head_cell hide-on-small-only">
			<a href="#" class="tabla fondo_blanco" order="nom_lot ASC">
				<strong>Creación  </strong>
			</a>
		</div>
		<div class="col s3 m2 centrar head_cell">
			<a href="#" class="tabla fondo_blanco" order="quantity DESC">
				<strong>Opciones</strong>
			</a>
	</div>
</div>
</div>
<div id="view_actions_table_next">
	<?php 
	foreach ($retorno_productos as $key => $value) { 
		$category = new Products();
		$fondo = $category->category_color($value['toxicological']);
		?>
		<div class="row tabla " id="celda_<?php echo $value['id_exit_product_master'].$value['id_exit_product_detalle'] ?>" >
			<div class="col s5 m3 primary_cell producto">
				<h6 class="col s12 center color_letra_secundario" >
				 <?php echo $value['name_product']; ?></h6>
			</div>
			<div class="col s4 m2 second_cell bodega">
				<h6 class="col s12 center color_letra_secundario">
				 <?php echo $value['name_cellar']; ?></h6>
			</div>
			<div class="col s1 m1 second_cell hide-on-small-only">
				<h6 class="col s12 center color_letra_secundario">
					<?php echo $value['toxicological']?>
				</h6>
			</div>
			<div class="col s2 m2 second_cell hide-on-small-only">
				<h6 class="col s12 center color_letra_secundario">
					<?php echo $value['code']?>
				</h6>
			</div>
			<div class="col s2 m2 second_cell hide-on-small-only">
				<h6 class="col s12 center color_letra_secundario">
					<?php echo $value['creation_date']?>
				</h6>
			</div>
			<div class="col s3 m1 second_cell">
				<button type="" class="col s12 btn btn-primary material-icons <?php echo $fondo ?> modal-trigger view_info_product" product="<?php echo $value['id_product'] ?>" ruta="../php/products/index.php" data-target="modal_center">visibility</button>
			</div>
		</div>
		<?php  
	}?>
</div>
<div class="paginacion col s12 m12">
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php/paginator/index.php'); ?>
</div>