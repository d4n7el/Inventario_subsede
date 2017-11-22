<div class="row" id="view_actions_table">
	<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/stock/index_exit.php/" accept-charset="utf-8" class="search">
		<div class="flitro col s12 centrar">
			<div class="input-field col s12 m2 hide-on-small-only">
	            <input id="product" type="text" value="<?php echo ($product == "%%") ? "" : $product ?>" class="validate search" name="product" autocomplete="off">
	            <label for="product" class="<?php echo ($product == "%%") ? "" : "active" ?> search">Producto</label>
	        </div>
	        <div class="input-field col s12 m1 hide-on-small-only">
	            <input id="cellar" type="text" class="validate search" value="<?php echo ($cellar == "%%") ? "" : $cellar  ?>" name="cellar" autocomplete="off">
	            <label for="cellar" class="<?php echo ($cellar == "%%") ? "" : "active" ?> search">Bodega</label>
	        </div>
	        
	        <div class="input-field col s12 m1 hide-on-small-only">
	            <input id="lote" type="text" class="validate search" value="<?php echo ($lote == "%%") ? "" : $lote ?>" name="lote" autocomplete="off">
	            <label for="lote" class="<?php echo ($lote == "%%") ? "" : "active" ?> search">Lote</label>
	        </div>
	        <div class="input-field col s12 m1 hide-on-small-only">
	            <input id="destino" type="text" class="validate search" value="<?php echo ($destino == "%%") ? "" : $destino ?>" name="destino" autocomplete="off">
	            <label for="destino" class="<?php echo ($destino == "%%") ? "" : "active" ?> search">Destino</label>
	        </div>
	        <div class="input-field col s12 m2">
	            <input id="fecha_inicial" type="text" class="validate search datepicker" value="<?php echo ($fecha_inicial == "%%") ? "" : $fecha_inicial ?>" name="fecha_inicial" autocomplete="off">
	            <label for="destino" class="<?php echo ($fecha_inicial == "%%") ? "" : "active" ?> search">Inicial</label>
	        </div>
	        <div class="input-field col s12 m2">
	            <input id="fecha_final" type="text" class="validate search datepicker" value="<?php echo ($fecha_final == "%%") ? "" : $fecha_final ?>" name="fecha_final" autocomplete="off">
	            <label for="fecha_final" class="<?php echo ($fecha_final == "%%") ? "" : "active" ?> search">Final</label>
	        </div>
	        <input id="order" type="hidden" class="validate search" value="<?php echo ($order == "%%") ? "" : $order ?>" name="order" autocomplete="off">
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
	<div class="row" id="head_table">
		<div class="col s4 m3 centrar prymary_head_cell">
			<a href="#" class="tabla fondo_blanco" order="name_product ASC">
				<strong>Producto  </strong>
			</a>
		</div>
		<div class="col s4 m2 centrar head_cell hide-on-small-only">
			<a href="#" class="tabla fondo_blanco" order="name_cellar ASC">
				<strong>Bodega  </strong>
			</a>
		</div>
		<div class="col s4 m2 centrar head_cell hide-on-small-only">
			<a href="#" class="tabla fondo_blanco" order="nom_lot ASC">
				<strong>Lote  </strong>
			</a>
		</div>
		<div class="col s2 m2 centrar head_cell hide-on-small-only">
			<a href="#" class="tabla fondo_blanco" order="quantity DESC">
				<strong>Cantidad  </strong>
			</a>
		</div>
		<div class="col s8 m3 centrar head_cell">
			<a href="#" class="fondo_blanco">
				<strong>Opciones  </strong>
			</a>
		</div>
	</div>
</div>
<div class="row" id="view_actions_table_next">
<?php 
	if (count($retorno_exit) > 0) {
		foreach ($retorno_exit as $key => $value) { 
			$category = new Products();
			$fondo = $category->category_color($value['toxicological_category']); 
			echo $value['toxicological'] ?>
			<div class="tabla col s12" id="celda_<?php echo $value['id_exit_product_master'].$value['id_exit_product_detalle'] ?>" >
				<div class="col  s4 m3 primary_cell producto">
					<h6 class="col s12 centrar color_letra_secundario" >
					 <?php echo $value['name_product']; ?></h6>
				</div>
				<div class="col  s4 m2 second_cell bodega hide-on-small-only">
					<h6 class="col s12 centrar color_letra_secundario">
					 <?php echo $value['name_cellar']; ?></h6>
				</div>
				<div class="col  s4 m2 second_cell lote hide-on-small-only">
					<h6 class="col s12 centrar color_letra_secundario">
					<?php echo $value['nom_lot']; ?></h6>
				</div>
				<div class="col  s2 m2 second_cell cantidad_disponible hide-on-small-only">
					<h6 class="col s12 centrar color_letra_secundario" id="cantidad_<?php echo $value['id_exit_product_master'].$value['id_exit_product_detalle'].$value['id_stock'] ?>">
						<?php echo $value['quantity']." ".$value['prefix_measure']; ?>
					</h6>
				</div>
				<div class="col s8 m2 info">	
					<div class="col s4 second_cell">
						<button type="" class="col btn <?php echo $fondo ?> material-icons modal-trigger view_exit_inform" data-target="modal_right" ruta="/php/stock/exit_stock_complete.php" id_exit_master="<?php echo $value['id_exit_product_master'] ?>">visibility</button>
					</div>
					<div class="col s4 second_cell">
							<button type="" class="col btn  material-icons  <?php echo $fondo ?> modal-trigger edit_cant_inform" id_exit_master="<?php echo $value['id_exit_product_master'] ?>" data-target="modal_center" id_exit_detalle="<?php echo $value['id_exit_product_detalle'] ?>" id_element="<?php echo $value['id_stock'] ?>" ruta="../php/stock/edit_exit_stock.php" ruta_update="../php/stock/update_exit_stock.php">create</button>
						</div>
					<?php  
					if ($value['state'] == 1) { ?>
						<div class="col s4 second_cell">
							<button type="" class="col btn  material-icons  <?php echo $fondo ?> modal-trigger delete_exit_inform" id_exit_master="<?php echo $value['id_exit_product_master'] ?>" data-target="modal_center" id_exit_detalle="<?php echo $value['id_exit_product_detalle'] ?>" id_element="<?php echo $value['id_stock'] ?>" ruta="/php/stock/_cancel_exit_stock.php">clear</button>
						</div>
						<?php 
					}
					?>
				</div>
			</div>
			<?php 
		}
	}else{ ?>
		<h5 class="col s12 centrar color_letra_secundario">No se obtuvieron resultados</h5>
	<?php 
	}
?>
</div>
<div class="paginacion col s12">
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php/paginator/index.php'); ?>
</div>