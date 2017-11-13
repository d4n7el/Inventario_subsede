<div class="row" id="head_table">
	<h6 class="titulo fondo_negro center color_letra_primario paddin1">
		Stoks vencidos sin salida registrada
	</h6>
	<div class="col s3 centrar head_cell">
		<a href="#" class="tabla color_letra_secundario" order="name_cellar ASC">
			<strong>Producto</strong>
		</a>
	</div>
	<div class="col s2 centrar head_cell">
		<a href="#" class="tabla color_letra_secundario" order="nom_lot ASC">
			<strong>Lote  </strong>
		</a>
	</div>
	<div class="col s2 centrar head_cell">
		<a href="#" class="tabla color_letra_secundario" order="nom_lot ASC">
			<strong>Cantidad  </strong>
		</a>
	</div>
	<div class="col s3 centrar head_cell">
		<a href="#" class="tabla color_letra_secundario" order="nom_lot ASC">
			<strong>Fecha  </strong>
		</a>
	</div>
	<div class="col s2 centrar head_cell">
		<a href="#" class="tabla color_letra_secundario" order="quantity DESC">
			<strong>Opciones</strong>
		</a>
	</div>
</div>
<?php
	if (count($get_expiration) > 0) {	
		foreach ($get_expiration as $key => $value) {?>
			<div class="row tabla " id="celda_stock<?php echo $value['id_stock'] ?>" >
				<div class="col s3 primary_cell producto">
					<h6 class="col s12 center color_letra_secundario" >
					 <?php echo $value['name_product']; ?></h6>
				</div>
				<div class="col s2 second_cell cantidad_disponible">
					<h6 class="col s12 center color_letra_secundario">
						<?php echo $value['nom_lot']?>
					</h6>
				</div>
				<div class="col s2 second_cell cantidad_disponible">
					<h6 class="col s12 center color_letra_secundario">
						<?php echo $value['amount']." ".$value['name_measure'] ?>
					</h6>
				</div>
				<div class="col s3 second_cell cantidad_disponible">
					<h6 class="col s12 center color_letra_secundario">
						<?php echo $value['expiration_date']?>
					</h6>
				</div>
				<?php  
				if ($_SESSION["id_user_activo_role"] == "A_A-a_1" || $_SESSION["id_user_activo_role"] == 'a_A_2_a2') { ?>
					
					<div class="col s2 second_cell">
						<button type="" class="col s12 btn btn-primary material-icons color_letra_danger modal-trigger expired_output" stock="<?php echo $value['id_stock'] ?>" id="stock_<?php echo $value['id_stock'] ?>" data-target="modal_center">warning</button>
					</div>
					<?php
				} ?>
			</div>
			<?php
		}
	}else{ ?>
		<h6 class="titulo fondo_negro center color_letra_primario paddin1">
			No hay productos vencidos sin registro de salida
		</h6>
		<?php
	}
?>