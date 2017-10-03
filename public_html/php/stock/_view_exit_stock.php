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
	<div class="col s1 centrar head_cell">
		<a href="#" class="tabla color_letra_primario">
			<strong>Ver  </strong>
		</a>
	</div>
</div>
<?php 
	if (count($retorno_exit) > 0) {
		foreach ($retorno_exit as $key => $value) { ?>
			<div class="row" id="tabla">
				<div class="col s3 primary_cell">
					<h6 class="col s12 centrar color_letra_secundario" >
					 <?php echo $value['name_product']; ?></h6>
				</div>
				<div class="col s2 second_cell">
					<h6 class="col s12 centrar color_letra_secundario">
					 <?php echo $value['name_cellar']; ?></h6>
				</div>
				<div class="col s3 second_cell">
					<h6 class="col s12 centrar color_letra_secundario">
					<?php echo $value['nom_lot']; ?></h6>
				</div>
				<div class="col s2 second_cell">
					<h6 class="col s12 centrar color_letra_secundario">
					<?php echo $value['quantity']; ?></h6>
				</div>
				<div class="col s1 second_cell">
					<button type="" class="col s12 btn btn-primary material-icons color_letra_secundario modal-trigger view_exit_stock" data-target="modal_right" id_exit_product="<?php echo $value['id_exit_product_master'] ?>">visibility</button>
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