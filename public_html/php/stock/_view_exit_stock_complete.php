<?php
	if (count($retorno_view_exit_stock) > 0) {  ?>
		<div class="row">
			<div class="col s12">
				<h5 class=" col s12 centrar color_letra_secundario">Fecha de salida</h5>
				<h5 class="titulo col s12 centrar color_letra_secundario"><?php echo $retorno_view_exit_stock[0]['date_create']; ?></h5>
			</div>
			<div class="col s4">
				<h5 class=" col s12 centrar color_letra_secundario">Entrego</h5>
				<h5 class="titulo col s12 centrar color_letra_secundario"><?php echo $retorno_view_exit_stock[0]['name_user']." ". $retorno_view_exit_stock[0]['last_name_user']; ?></h5>
			</div>
			<div class="col s4">
				<h5 class=" col s12 centrar color_letra_secundario">Recivio</h5>
				<h5 class="titulo col s12 centrar color_letra_secundario"><?php echo $retorno_view_exit_stock[0]['name_receive']; ?></h5>
			</div>
			
			<div class="col s4">
				<h5 class=" col s12 centrar color_letra_secundario">Destino</h5>
				<h5 class="titulo col s12 centrar color_letra_secundario"><?php echo $retorno_view_exit_stock[0]['destination']; ?></h5>
			</div>
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
					<strong>Lote  </strong>
				</a>
			</div>
			<div class="col s2 centrar head_cell">
				<a href="#" class="tabla color_letra_primario">
					<strong>Cantidad  </strong>
				</a>
			</div>
			<div class="col s2 centrar head_cell">
				<a href="#" class="tabla color_letra_primario">
					<strong>Nota  </strong>
				</a>
			</div>
		</div>
		<?php
		foreach ($retorno_view_exit_stock as $key => $view) { ?>
			<div class="row">
				<div class="col s3">
					<h5 class="titulo col s12 centrar color_letra_secundario"><?php echo $view['name_product']; ?></h5>
				</div>
				<div class="col s2">
					<h5 class="titulo col s12 centrar color_letra_secundario"><?php echo $view['name_cellar']; ?></h5>
				</div>
				<div class="col s3">
					<h5 class="titulo col s12 centrar color_letra_secundario"><?php echo $view['nom_lot']; ?></h5>
				</div>
				<div class="col s2">
					<h5 class="titulo col s12 centrar color_letra_secundario"><?php echo $view['quantity']." ". $view['prefix_measure']; ?></h5>
				</div>
				<div class="col s2">
					<h5 class="titulo col s12 centrar color_letra_secundario"><?php echo $view['note']; ?></h5>
				</div>
			</div>
			<?php
		}
	}else{ ?>
		<h5 class="col s12 centrar color_letra_secundario">No se obtuvieron resultados</h5>
	<?php
	}
?>
