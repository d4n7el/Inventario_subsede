<div id="area_impresion">
	<div class="row">
		<div class="logo_sena col s4 centrar">
			<img src="/image/logo_sena_min.png" alt="">
		</div>
		<div class="col s8 i1">
			<h5 class=" col s12 centrar color_letra_secundario">Fecha de salida</h5>
			<h5 class="titulo col s12 centrar color_letra_secundario"><?php echo $retorno_planta[0]['date_create']; ?></h5>
		</div>
		<div class="col s4 i3">
			<h5 class=" col s12 centrar color_letra_secundario">Entregó</h5>
			<h5 class="titulo col s12 centrar color_letra_secundario"><?php echo $retorno_planta[0]['name_user']." ". $retorno_planta[0]['last_name_user']; ?></h5>
		</div>
		<div class="col s4 i3">
			<h5 class=" col s12 centrar color_letra_secundario">Recibió</h5>
			<h5 class="titulo col s12 centrar color_letra_secundario"><?php echo $retorno_planta[0]['name_receive']; ?></h5>
		</div>
		<div class="col s4 i3">
			<h5 class=" col s12 centrar color_letra_secundario">Destino</h5>
			<h5 class="titulo col s12 centrar color_letra_secundario"><?php echo $proccess ?></h5>
		</div>
	</div>
	<div class="row" id="head_table">
		<div class="col s3 centrar prymary_head_cell i5">
			<a href="#" class="color_letra_primario">
				<strong>Producto  </strong>
			</a>
		</div>
		<div class="col s2 centrar head_cell i5">
			<a href="#" class="tabla color_letra_primario">
				<strong>Bodega  </strong>
			</a>
		</div>
		<div class="col s3 centrar head_cell i5">
			<a href="#" class="tabla color_letra_primario">
				<strong>Recibio  </strong>
			</a>
		</div>
		<div class="col s2 centrar head_cell i5">
			<a href="#" class="tabla color_letra_primario">
				<strong>Cantidad  </strong>
			</a>
		</div>

		<div class="col s2 centrar head_cell i5">
			<a href="#" class="tabla color_letra_primario">
				<strong>Lote  </strong>
			</a>
		</div>
	</div>
	<?php 
	foreach ($retorno_planta as $key => $value) { ?>
		<div class="row tabla" id="celda_<?php echo $value['id_exit_product_master'].$value['id_exit_product_detalle'] ?>" >
			<div class="col s3 second_cell center producto i5">
				<h6 class="col s12 centrar <?php echo ($value['state'] == 1)? "color_letra_secundario" : "color_letra_danger" ?>" >
				 <?php echo $value['name_product']; ?></h6>
			</div>
			<div class="col s2 second_cell center bodega i5">
				<h6 class="col s12 centrar <?php echo ($value['state'] == 1)? "color_letra_secundario" : "color_letra_danger" ?>">
				 <?php echo $value['name_cellar']; ?></h6>
			</div>
			<div class="col s3 second_cell center lote i5">
				<h6 class="col s12 center <?php echo ($value['state'] == 1)? "color_letra_secundario" : "color_letra_danger" ?>">
				<?php echo $value['name_receive']; ?></h6>
			</div>
			<div class="col s2 second_cell center cantidad_disponible i5">
				<h6 class="col s12 centrar <?php echo ($value['state'] == 1)? "color_letra_secundario" : "color_letra_danger" ?>" id="cantidad_<?php echo $value['id_exit_product'].$value['id_stock'] ?>">
					<?php echo (isset($value['quantity'])) ? $value['quantity']." ".$value['prefix_measure'] : $value['amount']." ".$value['prefix_measure']; ?>
				</h6>
			</div>
			<div class="col s2 second_cell cantidad_disponible i5">
				<h6 class="col s12 centrar <?php echo ($value['state'] == 1)? "color_letra_secundario" : "color_letra_danger" ?>">
					<?php echo $value['nom_lot'] ?>
				</h6>
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
			<button class="btn generar_pdf btn-primary " target="_blank" id="generar_pdf">
				Generar PDF
				<i class="material-icons left" >insert_drive_file</i>
			</button>
		</div>
	</div><?php
?>