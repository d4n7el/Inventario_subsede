<?php
	if (count($retorno_view_exit_stock) > 0) {  	?>
	<div id="area_impresion">
		<div class="row">
			<div class="logo_sena col s12 centrar">
				<img src="/image/logo_sena_min.png" alt="">
			</div>
			<div class="col s12 i1">
				<h5 class=" col s12 center color_letra_secundario">Fecha de salida</h5>
				<h5 class="titulo col s12 center color_letra_secundario"><?php echo $retorno_view_exit_stock[0]['date_create']; ?></h5>
			</div>
			<div class="col s4 i3">
				<h5 class=" col s12 center color_letra_secundario">Entregó</h5>
				<h5 class="titulo col s12 center color_letra_secundario"><?php echo $retorno_view_exit_stock[0]['name_user']." ". $retorno_view_exit_stock[0]['last_name_user']; ?></h5>
			</div>
			<div class="col s4 i3">
				<h5 class=" col s12 center color_letra_secundario">Recibió</h5>
				<h5 class="titulo col s12 center color_letra_secundario"><?php echo $retorno_view_exit_stock[0]['name_receive']; ?></h5>
			</div>
			
			<div class="col s4 i3">
				<h5 class=" col s12 center color_letra_secundario">Destino</h5>
				<h5 class="titulo col s12 center color_letra_secundario"><?php echo $retorno_view_exit_stock[0]['destination']; ?></h5>
			</div>
		</div>
		<div class="row" id="head_table">
			<div class="col s3 m3 centrar prymary_head_cell i5">
				<a href="#" class="fondo_blanco">
					<strong>Producto  </strong>
				</a>
			</div>
			<div class="col s3 m2 centrar head_cell i5 hide-on-small-only">
				<a href="#" class="tabla fondo_blanco">
					<strong>Bodega  </strong>
				</a>
			</div>
			<div class="col s3 m3 centrar head_cell i5">
				<a href="#" class="tabla fondo_blanco">
					<strong>Lote  </strong>
				</a>
			</div>
			<div class="col s3 m2 centrar head_cell i5">
				<a href="#" class="tabla fondo_blanco">
					<strong>Cantidad  </strong>
				</a>
			</div>
			<div class="col s3 m2 centrar head_cell i5">
				<a href="#" class="tabla fondo_blanco">
					<strong>Nota  </strong>
				</a>
			</div>
		</div>
		<?php
		foreach ($retorno_view_exit_stock as $key => $view) { ?>
			<div class="row content_impresion" >
				<div class="col s3 m3 i5">
					<h6 class="titulo  center col s12 <?php echo ($view['state'] == 1)? "color_letra_secundario" : "color_letra_danger" ?>"><?php echo $view['name_product']; ?></h6>
				</div>
				<div class="col s3 m2 i5 hide-on-small-only">
					<h6 class="titulo second_cell center col s12 <?php echo ($view['state'] == 1)? "color_letra_secundario" : "color_letra_danger" ?>"><?php echo $view['name_cellar']; ?></h6>
				</div>
				<div class="col s3 m3 i5">
					<h6 class="titulo second_cell center col s12 <?php echo ($view['state'] == 1)? "color_letra_secundario" : "color_letra_danger" ?>"><?php echo $view['nom_lot']; ?></h6>
				</div>
				<div class="col s3 m2 i5">
					<h6 class="titulo second_cell center col s12 <?php echo ($view['state'] == 1)? "color_letra_secundario" : "color_letra_danger" ?>"><?php echo $view['quantity']." ". $view['prefix_measure']; ?></h6>
				</div>
				<div class="col s3 m2 i5">
					<h6 class="titulo second_cell center col s12 <?php echo ($view['state'] == 1)? "color_letra_secundario" : "color_letra_danger" ?>"><?php echo $view['note']; ?></h6>
				</div>
			</div>
			<?php
		}?>	
	</div>
	<div class="row">
		<div class="export">
			<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/expor_pdf.php" class="btn btn-success hide" target="_blank" id="new_impresion">Imprimir
				<i class="material-icons left" >print</i>
			</a>
			<button class="btn generar_pdf btn-primary" target="_blank" id="generar_pdf">
				Generar PDF
				<i class="material-icons left" >insert_drive_file</i>
			</button>
		</div>
	</div>
	<?php
	}else{ ?>
		<h5 class="col s12 centrar color_letra_secundario">No se obtuvieron resultados</h5>
	<?php
	}	
?>
