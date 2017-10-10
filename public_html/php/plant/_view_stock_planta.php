<div class="row ">
	<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/plant/" accept-charset="utf-8" class="search">
		<div class="flitro col s9 centrar sombra_blanca">
			<div class="input-field col s12 m3">
	            <i class="material-icons prefix">search</i>
	            <input id="product" type="text" value="<?php echo ($product == "%%") ? "" : $product ?>" class="validate search" name="product" autocomplete="off">
	            <label for="product" class="<?php echo ($product == "%%") ? "" : "active" ?> search">Producto</label>
	        </div>
	        <div class="input-field col s12 m2">
	            <input id="cellar" type="text" class="validate search" value="<?php echo ($cellar == "%%") ? "" : $cellar  ?>" name="cellar" autocomplete="off">
	            <label for="cellar" class="<?php echo ($cellar == "%%") ? "" : "active" ?> search">Bodega</label>
	        </div>
	        <div class="input-field col s12 m3">
	            <input id="nameReceive" type="text" class="validate search" value="<?php echo ($nameReceive == "%%") ? "" : $nameReceive ?>" name="nameReceive" autocomplete="off">
	            <label for="nameReceive" class="<?php echo ($nameReceive == "%%") ? "" : "active" ?> search">Quien recibe</label>
	        </div>

	        <div class="input-field col s12 m2">
	            <input id="prefix" type="text" class="validate search" value="<?php echo ($prefix == "%%") ? "" : $prefix ?>" name="prefix" autocomplete="off">
	            <label for="prefix" class="<?php echo ($prefix == "%%") ? "" : "active" ?> search">Prefijo Medida</label>
	        </div>
	        <div class=" input-field action col m1 centrar">
	        	<button class="waves-effect waves-light btn-floating btn-primary">
	        		<i class="material-icons left">near_me</i>
	        	</button>
	        </div>	
		</div>
	</form>
</div>
<div class="row" id="head_table">
	<div class="col s3 centrar prymary_head_cell">
		<a href="#" class="color_letra_primario">
			<strong>Producto  </strong>
		</a>
	</div>
	<div class="col s2 centrar head_cell">
		<a href="#" class="tabla color_letra_primario">
			<strong>Bodega  </strong>
		</a>
	</div>
	<div class="col s3 centrar head_cell">
		<a href="#" class="tabla color_letra_primario">
			<strong>Recibio  </strong>
		</a>
	</div>
	<div class="col s2 centrar head_cell">
		<a href="#" class="tabla color_letra_primario">
			<strong>Cantidad  </strong>
		</a>
	</div>

	<div class="col s2 centrar head_cell">
		<a href="#" class="tabla color_letra_primario">
			<strong>Opciones  </strong>
		</a>
	</div>
</div>
<?php 
	foreach ($retorno_planta as $key => $value) { ?>
		<div class="row tabla" id="celda_<?php echo $value['id_exit_product_master'].$value['id_exit_product_detalle'] ?>" >
			<div class="col s3 primary_cell producto">
				<h6 class="col s12 centrar color_letra_secundario" >
				 <?php echo $value['name_product']; ?></h6>
			</div>
			<div class="col s2 second_cell bodega">
				<h6 class="col s12 centrar color_letra_secundario">
				 <?php echo $value['name_cellar']; ?></h6>
			</div>
			<div class="col s3 second_cell lote">
				<h6 class="col s12 center color_letra_secundario">
				<?php echo $value['name_receive']; ?></h6>
			</div>
			<div class="col s2 second_cell cantidad_disponible">
				<h6 class="col s12 centrar color_letra_secundario" id="cantidad_<?php echo $value['id_exit_product'].$value['id_stock'].$value['id_stock_plant'] ?>">
					<?php echo $value['quantity']." ".$value['prefix_measure']; ?>
				</h6>
			</div>
			<div class="col s1 second_cell">
				<button type="" ruta="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/plant/show_stock_plant.php" class="col s12 btn btn-primary material-icons color_letra_secundario modal-trigger view_plant_stock" data-target="modal_right" id_exit_product="<?php echo $value['id_exit_product'] ?>">visibility</button>
			</div>
			<div class="col s1 second_cell">
					<button type="" ruta="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/plant/edit_stock_plant.php" class="col s12 btn btn-primary material-icons color_letra_secundario modal-trigger edit_stock_plant" id_exit_product="<?php echo $value['id_exit_product'] ?>" data-target="modal_center" stock="<?php echo $value['id_stock'] ?>" cantidad="<?php echo $value['quantity'] ?>" cantidad_disponible="<?php echo $value['quantity'] ?>" id_plant="<?php echo $value['id_stock_plant']?>">create</button>
				</div>
		</div>
		<?php
	}
?>
<div class="paginacion col m12">
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php/paginator/index.php'); ?>
</div>