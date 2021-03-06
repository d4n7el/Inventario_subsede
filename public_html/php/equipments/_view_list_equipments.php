<div class="row" id="view_actions_table">
	<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/equipments/index.php/" accept-charset="utf-8" class="search">
		<div class="flitro col s12 centrar sombra_blanca">
			<div class="input-field col s12 m2">
	            <i class="material-icons prefix">search</i>
	            <input id="equipo" type="text" value="<?php echo ($equipo == "%%") ? "" : $equipo ?>" class="validate search" name="equipo" autocomplete="off">
	            <label for="equipo" class="<?php echo ($equipo == "%%") ? "" : "active" ?> search">Equipo</label>
	        </div>
	        <div class="input-field col s12 m1 hide-on-small-only">
	            <input id="marca" type="text" class="validate search" value="<?php echo ($marca == "%%") ? "" : $marca  ?>" name="marca" autocomplete="off">
	            <label for="marca" class="<?php echo ($marca == "%%") ? "" : "active" ?> search">Marca</label>
	        </div>
	        <div class="input-field col s12 m2">
	            <input id="fecha_inicial" type="text" class="validate search datepicker" value="<?php echo ($fecha_inicial == "%%") ? "" : $fecha_inicial ?>" name="fecha_inicial" autocomplete="off">
	            <label for="destino" class="<?php echo ($fecha_inicial == "%%") ? "" : "active" ?> search">Inicial</label>
	        </div>
	        <div class="input-field col s12 m2">
	            <input id="fecha_final" type="text" class="validate search datepicker" value="<?php echo ($fecha_final == "%%") ? "" : $fecha_final ?>" name="fecha_final" autocomplete="off">
	            <label for="fecha_final" class="<?php echo ($fecha_final == "%%") ? "" : "active" ?> search">Final</label>
	        </div>
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
		<div class="col m2 s4  centrar prymary_head_cell">
			<a href="#" class="tabla fondo_blanco" order="name_product ASC">
				<strong>Producto</strong>
			</a>
		</div>
		<div class="col m2 s4 centrar head_cell hide-on-small-only">
			<a href="#" class="tabla fondo_blanco" order="name_cellar ASC">
				<strong>Marca</strong>
			</a>
		</div>
		<div class="col m2 s4 centrar head_cell hide-on-small-only">
			<a href="#" class="tabla fondo_blanco" order="nom_lot ASC">
				<strong>Cantidad  </strong>
			</a>
		</div>
		<div class="col m2 s4 centrar head_cell">
			<a href="#" class="tabla fondo_blanco" order="nom_lot ASC">
				<strong>Disponible  </strong>
			</a>
		</div>
		<div class="col m2 s4 centrar head_cell hide-on-small-only">
			<a href="#" class="tabla fondo_blanco" order="nom_lot ASC">
				<strong>Bodega </strong>
			</a>
		</div>
		<div class="col m2 s4 centrar head_cell">
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
	foreach ($retorno_equipos as $key => $value) { ?>
		<div class=" tabla col s12 " id="celda_<?php echo $value['id_exit_product_master'].$value['id_exit_product_detalle'] ?>" >
			<div class="col m2 s4 primary_cell producto">
				<h6 class="col s12 center color_letra_secundario" >
				 <?php echo $value['name_equipment']; ?></h6>
			</div>
			<div class="col m2 s4 second_cell bodega hide-on-small-only">
				<h6 class="col s12 center color_letra_secundario">
				 <?php echo $value['mark']; ?></h6>
			</div>
			<div class="col m2 s4 second_cell cantidad_disponible hide-on-small-only">
				<h6 class="col s12 center color_letra_secundario">
					<?php echo $value['total_quantity']?>
				</h6>
			</div>
			<div class="col m2 s5 second_cell cantidad_disponible">
				<h6 class="col s12 center color_letra_secundario">
					<?php echo $value['quantity_available']?>
				</h6>
			</div>
			<div class="col m2 s4 second_cell cantidad_disponible hide-on-small-only">
				<h6 class="col s12 center color_letra_secundario">
					<?php echo $value['name_cellar']?>
				</h6>
			</div>
			<div class="col m1 s3 second_cell">
				<button type="" class="col s12 btn btn-primary material-icons color_letra_secundario modal-trigger view_info_equipment" equipment="<?php echo $value['id_equipment'] ?>" estado="<?php echo $value['state'] ?>" ruta="../php/equipments/index.php" data-target="modal_right">visibility</button>
			</div>
		</div>
		<?php 
	} ?>
</div>
<div class="paginacion col m12 s12">
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php/paginator/index.php'); ?>
</div>