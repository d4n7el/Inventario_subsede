<div class="row " id="view_actions_table">
	<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/plant/view_list_exit_plant.php" accept-charset="utf-8" class="search">
		<div class="flitro col s12 centrar sombra_blanca">
			<div class="input-field col s12 m3">
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
	        <div class="input-field col s12 m2">
	            <input id="fecha_inicial" type="text" class="validate search datepicker" value="<?php echo ($fecha_inicial == "%%") ? "" : $fecha_inicial ?>" name="fecha_inicial" autocomplete="off">
	            <label for="fecha_inicial" class="<?php echo ($fecha_inicial == "%%") ? "" : "active" ?> search">Fecha inicial</label>
	        </div>
	        <div class="input-field col s12 m2">
	            <input id="fecha_final" type="text" class="validate search datepicker" value="<?php echo ($fecha_final == "%%") ? "" : $fecha_final ?>" name="fecha_final" autocomplete="off">
	            <label for="fecha_final" class="<?php echo ($fecha_final == "%%") ? "" : "active" ?> search">Fecha final</label>
	        </div>
	        <input id="order" type="hidden" class="validate search" value="<?php echo ($order == "%%") ? "" : $order ?>" name="order" autocomplete="off">
	        <div class=" input-field action col m1 centrar">
	        	<button class="waves-effect waves-light btn-floating btn-primary">
	        		<i class="material-icons left">search</i>
	        	</button>
	        </div>	
		</div>
	</form>
	<div class="row" id="head_table">
		<div class="col s3 centrar prymary_head_cell ">
			<a href="#" class="tabla fondo_blanco" order="name_product ASC">
				<strong>Producto  </strong>
			</a>
		</div>
		<div class="col s1 centrar head_cell ">
			<a href="#" class="tabla fondo_blanco" order="name_cellar ASC">
				<strong>Bodega  </strong>
			</a>
		</div>
		<div class="col s3 centrar head_cell ">
			<a href="#" class="tabla fondo_blanco" order="name_receive ASC">
				<strong>Salida  </strong>
			</a>
		</div>
		<div class="col s2 centrar head_cell ">
			<a href="#" class="tabla fondo_blanco" order="quantity  DESC">
				<strong>Cantidad  </strong>
			</a>
		</div>

		<div class="col s3 centrar head_cell ">
			<a href="#" class="fondo_blanco">
				<strong>Opciones  </strong>
			</a>
		</div>
	</div>
</div>


<div id="view_actions_table_next">
<?php 
	foreach ($retorno_planta as $key => $value) { 
		$category = new Products();
		$fondo = $category->category_color($value['toxicological']);?>
		<div class="row tabla" id="celda_<?php echo $value['id_exit_product_master'].$value['id_exit_product_detalle'] ?>" >
			<div class="col s3 primary_cell producto">
				<h6 class="col s12 centrar <?php echo ($_SESSION["user_zone"] == "A") ? "color_letra_secundario" : 'color_letra_terceario' ?>" >
				 <?php echo $value['name_product']; ?></h6>
			</div>
			<div class="col s1 second_cell bodega">
				<h6 class="col s12 centrar <?php echo ($_SESSION["user_zone"] == "A") ? "color_letra_secundario" : 'color_letra_terceario' ?>">
				 <?php echo $value['name_cellar']; ?></h6>
			</div>
			<div class="col s3 second_cell lote">
				<h6 class="col s12 center <?php echo ($_SESSION["user_zone"] == "A") ? "color_letra_secundario" : 'color_letra_terceario' ?>">
				<?php echo $value['date_create']; ?></h6>
			</div>
			<div class="col s2 second_cell cantidad_disponible">
				<h6 class="col s12 centrar <?php echo ($_SESSION["user_zone"] == "A") ? "color_letra_secundario" : 'color_letra_terceario' ?>" id="cantidad_<?php echo $value['id_exit_product'].$value['id_stock'].$value['id_stock_plant'] ?>">
					<?php echo $value['quantity']." ".$value['prefix_measure']; ?>
				</h6>
			</div>
			<div class="col s1 second_cell">
				<button type="" ruta="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/plant/show_exit_plant_complete.php" class="col s12 btn btn-primary material-icons modal-trigger  view_exit_inform <?php echo $fondo ?>" data-target="modal_right" procceso="<?php echo $value['proceso']  ?>" id_process="<?php echo $value['id_proceso'] ?>" id_exit_master="<?php echo $value['id_exit_master'] ?>" fecha="<?php echo $value['date_create'] ?>">visibility</button>
			</div>
			<?php  
			if ($value['state'] == 1) { ?>
				<div class="col s1 second_cell">
					<button type="" ruta="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/plant/edit_exit_stock_plant.php" class="col s12 btn btn-primary material-icons edit_cant_inform"<?php echo $value['id_proceso'] ?>" data-target="modal_center" id_element="<?php echo $value['id_proceso'] ?>" id_exit_master="<?php echo $value['id_exit_master'] ?>" id_exit_detalle="<?php echo $value['id_detalle'] ?>" cantidad="<?php echo $value['quantity'] ?>" cantidad_disponible="<?php echo $value['amount'] ?>" ruta_update="../php/plant/update_exit_stock_plant.php" >create</button>
				</div>
				<?php
			}
			if ($value['proceso'] == "Externo") { ?>
				<div class="col s1 second_cell">
					<button type="" class="col s12 btn btn-primary material-icons <?php echo ($_SESSION["user_zone"] == "A") ? "color_letra_secundario" : 'color_letra_terceario' ?> modal-trigger view_info_stock" id_exit_product="<?php echo $value['id_exit_product'] ?>" data-target="modal_right" stock="<?php echo $value['id_stock'] ?>" cantidad="<?php echo $value['quantity'] ?>" cantidad_disponible="<?php echo $value['quantity'] ?>" id_plant="<?php echo $value['id_stock_plant']?>">receipt</button>
				</div>
				<?php
			} ?>
		</div>
		<?php
	}
?>
</div>
<div class="paginacion <?php echo ($_SESSION["user_zone"] == "A") ? "fondo_negro" : 'fondo_negro_secundario' ?> col m12">
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php/paginator/index.php'); ?>
</div>