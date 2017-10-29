<div class="row">
	<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/equipments/index.php/" accept-charset="utf-8" class="search">
		<div class="flitro col s9 centrar sombra_blanca">
			<div class="input-field col s12 m2">
	            <i class="material-icons prefix">search</i>
	            <input id="equipo" type="text" value="<?php echo ($equipo == "%%") ? "" : $equipo ?>" class="validate search" name="equipo" autocomplete="off">
	            <label for="equipo" class="<?php echo ($equipo == "%%") ? "" : "active" ?> search">Equipo</label>
	        </div>
	        <div class="input-field col s12 m1">
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
	        <div class=" input-field action col m1 centrar">
	        	<button class="waves-effect waves-light btn-floating btn-primary">
	        		<i class="material-icons left">search</i>
	        	</button>
	        </div>	
		</div>
	</form>
</div>
<div class="row" id="head_table">
	<div class="col s2 centrar prymary_head_cell">
		<a href="#" class="tabla color_letra_primario" order="name_product ASC">
			<strong>Producto</strong>
		</a>
	</div>
	<div class="col s2 centrar head_cell">
		<a href="#" class="tabla color_letra_primario" order="name_cellar ASC">
			<strong>Bodega</strong>
		</a>
	</div>
	<div class="col s2 centrar head_cell">
		<a href="#" class="tabla color_letra_primario" order="nom_lot ASC">
			<strong>Cantidad  </strong>
		</a>
	</div>
	<div class="col s2 centrar head_cell">
		<a href="#" class="tabla color_letra_primario" order="nom_lot ASC">
			<strong>Disponible  </strong>
		</a>
	</div>
	<div class="col s2 centrar head_cell">
		<a href="#" class="tabla color_letra_primario" order="nom_lot ASC">
			<strong>Creacion </strong>
		</a>
	</div>
	<div class="col s2 centrar head_cell">
		<a href="#" class="tabla color_letra_primario" order="quantity DESC">
			<strong>Opciones</strong>
		</a>
	</div>
</div>
<?php 
foreach ($retorno_equipos as $key => $value) { ?>
	<div class="row tabla " id="celda_<?php echo $value['id_exit_product_master'].$value['id_exit_product_detalle'] ?>" >
		<div class="col s2 primary_cell producto">
			<h6 class="col s12 center color_letra_secundario" >
			 <?php echo $value['name_equipment']; ?></h6>
		</div>
		<div class="col s2 second_cell bodega">
			<h6 class="col s12 center color_letra_secundario">
			 <?php echo $value['mark']; ?></h6>
		</div>
		<div class="col s2 second_cell cantidad_disponible">
			<h6 class="col s12 center color_letra_secundario">
				<?php echo $value['total_quantity']?>
			</h6>
		</div>
		<div class="col s2 second_cell cantidad_disponible">
			<h6 class="col s12 center color_letra_secundario">
				<?php echo $value['quantity_available']?>
			</h6>
		</div>
		<div class="col s2 second_cell cantidad_disponible">
			<h6 class="col s12 center color_letra_secundario">
				<?php echo $value['create_date']?>
			</h6>
		</div>
		<div class="col s1 second_cell">
			<button type="" class="col s12 btn btn-primary material-icons color_letra_secundario modal-trigger view_info_equipment" equipment="<?php echo $value['id_equipment'] ?>" ruta="../php/equipments/index.php" data-target="modal_right">visibility</button>
		</div>
	</div>
	<?php 
} ?>
<div class="paginacion col m12">
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php/paginator/index.php'); ?>
</div>