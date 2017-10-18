<div class="row">
	<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/equipments/index_exit.php/" accept-charset="utf-8" class="search">
		<div class="flitro col s9 centrar sombra_blanca">
			<div class="input-field col s12 m2">
	            <i class="material-icons prefix">search</i>
	            <input id="product" type="text" value="<?php echo ($team == "%%") ? "" : $team ?>" class="validate search" name="team" autocomplete="off">
	            <label for="product" class="<?php echo ($team == "%%") ? "" : "active" ?> search">Equipo</label>
	        </div>
	        <div class="input-field col s12 m1">
	            <input id="cellar" type="text" class="validate search" value="<?php echo ($brand == "%%") ? "" : $brand  ?>" name="brand" autocomplete="off">
	            <label for="cellar" class="<?php echo ($brand == "%%") ? "" : "active" ?> search">Cedula</label>
	        </div>
	        <div class="input-field col s12 m1">
	            <input id="lote" type="text" class="validate search" value="<?php echo ($lote == "%%") ? "" : $lote ?>" name="amount" autocomplete="off">
	            <label for="lote" class="<?php echo ($lote == "%%") ? "" : "active" ?> search">Total</label>
	        </div>
	        <div class="input-field col s12 m1">
	            <input id="destino" type="text" class="validate search" value="<?php echo ($destino == "%%") ? "" : $destino ?>" name="quantity" autocomplete="off">
	            <label for="destino" class="<?php echo ($destino == "%%") ? "" : "active" ?> search">Cantidad Disponible</label>
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
			<strong>Equipo  </strong>
		</a>
	</div>
	<div class="col s2 centrar head_cell">
		<a href="#" class="tabla color_letra_primario">
			<strong>Cedula Recibe  </strong>
		</a>
	</div>
	<div class="col s3 centrar head_cell">
		<a href="#" class="tabla color_letra_primario">
			<strong>Total Cantidad  </strong>
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
	if (count($retorno_exit) > 0) {
		foreach ($retorno_exit as $key => $value) { ?>
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
					<h6 class="col s12 centrar color_letra_secundario">
					<?php echo $value['nom_lot']; ?></h6>
				</div>
				<div class="col s2 second_cell cantidad_disponible">
					<h6 class="col s12 centrar color_letra_secundario" id="cantidad_<?php echo $value['id_exit_product_master'].$value['id_exit_product_detalle'].$value['id_stock'] ?>">
						<?php echo $value['quantity']; ?>
					</h6>
				</div>
				<div class="col s1 second_cell">
					<button type="" class="col s12 btn btn-primary material-icons color_letra_secundario modal-trigger view_exit_stock" data-target="modal_right" id_exit_product="<?php echo $value['id_exit_product_master'] ?>">visibility</button>
				</div>
				<div class="col s1 second_cell">
					<button type="" class="col s12 btn btn-primary material-icons color_letra_secundario modal-trigger edit_view_exit_stock" id_exit_product="<?php echo $value['id_exit_product_master'] ?>" data-target="modal_center" id_exit_product_detalle="<?php echo $value['id_exit_product_detalle'] ?>" stock="<?php echo $value['id_stock'] ?>">create</button>
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