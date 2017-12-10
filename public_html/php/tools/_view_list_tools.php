<div class="row" id="view_actions_table">
	<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/tools/index.php/" accept-charset="utf-8" class="search">
		<div class="flitro col s12 centrar">
			<div class="input-field col s12 m2">
	            <i class="material-icons prefix">search</i>
	            <input id="tools" type="text" value="<?php echo ($tools == "%%") ? "" : $tools ?>" class="validate search" name="tools" autocomplete="off">
	            <label for="tools" class="<?php echo ($tools == "%%") ? "" : "active" ?> search">Herramientas</label>
	        </div>
	        <div class="input-field col s12 m2 hide-on-small-only">
	            <input id="marca" type="text" class="validate search" value="<?php echo ($marca == "%%") ? "" : $marca  ?>" name="marca" autocomplete="off">
	            <label for="marca" class="<?php echo ($marca == "%%") ? "" : "active" ?> search">Marca </label>
	        </div>
	           
	        <div class="input-field col s12 m2">
	            <input id="fecha_inicial" type="text" class="validate search datepicker" value="<?php echo ($fecha_inicial == "%%") ? "" : $fecha_inicial ?>" name="fecha_inicial" autocomplete="off">
	            <label for="destino" class="<?php echo ($fecha_inicial == "%%") ? "" : "active" ?> search">Inicial</label>
	        </div>
	        <div class="input-field col s12 m2">
	            <input id="fecha_final" type="text" class="validate search datepicker" value="<?php echo ($fecha_final == "%%") ? "" : $fecha_final ?>" name="fecha_final" autocomplete="off">
	            <label for="fecha_final" class="<?php echo ($fecha_final == "%%") ? "" : "active" ?> search">Final</label>
	        </div>
	        <div class=" input-field action col m1 centrar">
	        	<button class="waves-effect waves-light btn-floating btn-primary">
	        		<i class="material-icons left">near_me</i>
	        	</button>
	        </div>	
		</div>
	</form>
	<div class="row" id="head_table">
		<div class="col s5 m2 centrar prymary_head_cell">
			<a href="#" class="tabla fondo_blanco" order="name_product ASC">
				<strong>Herramienta</strong>
			</a>
		</div>
		<div class="col s2 m2 centrar head_cell hide-on-small-only">
			<a href="#" class="tabla fondo_blanco" order="name_cellar ASC">
				<strong>Marca</strong>
			</a>
		</div>
		<div class="col s4 m2 centrar head_cell">
			<a href="#" class="tabla fondo_blanco" order="nom_lot ASC">
				<strong>cantidad  </strong>
			</a>
		</div>
		<div class="col s2 m2 centrar head_cell hide-on-small-only">
			<a href="#" class="tabla fondo_blanco" order="nom_lot ASC">
				<strong>Disponibles  </strong>
			</a>
		</div>
		<div class="col s2 m2 centrar head_cell hide-on-small-only">
			<a href="#" class="tabla fondo_blanco" order="nom_lot ASC">
				<strong>Bodega  </strong>
			</a>
		</div>
		<div class="col s3 m2 centrar head_cell">
			<a href="#" class="tabla fondo_blanco" order="quantity DESC">
				<strong>Opciones</strong>
			</a>
		</div>
	</div>
</div>

<div class="row" id="view_actions_table_next">
	<a class="btn-floating btn-primary" id="exportExcel" target="_blank" href="<?php $_SERVER['DOCUMENT_ROOT']?>/php/export/">
		<i class="material-icons color_letra_secundario left">file_download</i>
	</a>
	<?php
	foreach ($retorno_herramientas as $key => $value) {?>
		<div class="tabla col s12 " id="celda_<?php echo $value['id_exit_product_master'].$value['id_exit_product_detalle'] ?>" >
			<div class="col s5 m2 primary_cell producto">
				<h6 class="col s12 center color_letra_secundario" >
				 <?php echo $value['name_tool']; ?></h6>
			</div>
			<div class="col s2 m2 second_cell hide-on-small-only bodega">
				<h6 class="col s12 center color_letra_secundario">
				 <?php echo $value['mark']; ?></h6>
			</div>
			<div class="col s4 m2 second_cell cantidad_disponible">
				<h6 class="col s12 center color_letra_secundario">
					<?php echo $value['total_quantity']?>
				</h6>
			</div>
			<div class="col s2 m2 second_cell hide-on-small-only cantidad_disponible">
				<h6 class="col s12 center color_letra_secundario">
					<?php echo $value['quantity_available']?>
				</h6>
			</div>
			<div class="col s2 m2 second_cell hide-on-small-only cantidad_disponible">
				<h6 class="col s12 center color_letra_secundario">
					<?php echo $value['name_cellar']?>
				</h6>
			</div>
			<div class="col s3 m1 second_cell">
				<button type="" class="col s12 btn btn-primary material-icons color_letra_secundario modal-trigger view_info_tool" tool="<?php echo $value['id_tool'] ?>" ruta="../php/tools/index.php" data-target="modal_right">visibility</button>
			</div>
		</div>
		<?php
	}?>
</div>
<div class="paginacion col s12">
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php/paginator/index.php'); ?>
</div>




