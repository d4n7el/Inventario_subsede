<div class="row">
	<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/expiration/index.php/" accept-charset="utf-8" class="search">
		<div class="flitro col s12 centrar sombra_blanca">
			<div class="input-field col s12 m3">
	            <i class="material-icons prefix">search</i>
	            <input id="filter" type="text" value="<?php echo ($filter == "%%") ? "" : $filter ?>" class="validate search" name="filter" autocomplete="off">
	            <label for="filter" class="<?php echo ($filter == "") ? "" : "active" ?> search">Producto</label>
	        </div>  
	        <div class="input-field col s12 m2">
	            <input id="expiration_date" type="text" class="validate search datepicker" value="<?php echo ($expiration_date == "%%") ? "" : $expiration_date ?>" name="expiration_date" autocomplete="off">
	            <label for="expiration_date" class="<?php echo ($expiration_date == "%%") ? "" : "active" ?> search">Vencimiento</label>
	        </div>
	        <div class="input-field col s12 m2">
	            <input id="fecha_inicial" type="text" class="validate search datepicker" value="<?php echo ($fecha_inicial == "%%") ? "" : $fecha_inicial ?>" name="fecha_inicial" autocomplete="off">
	            <label for="fecha_inicial" class="<?php echo ($fecha_inicial == "%%") ? "" : "active" ?> search">Inicial</label>
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
</div>

<div class="row" id="head_table">
	<div class="col s2 centrar prymary_head_cell">
		<a href="#" class="tabla color_letra_primario" order="name_product ASC">
			<strong>Descripcion</strong>
		</a>
	</div>
	<div class="col s2 centrar head_cell">
		<a href="#" class="tabla color_letra_primario" order="nom_lot ASC">
			<strong>cantidad  </strong>
		</a>
	</div>
	<div class="col s2 centrar head_cell">
		<a href="#" class="tabla color_letra_primario" order="nom_lot ASC">
			<strong>Vencimiento  </strong>
		</a>
	</div>
	
	<div class="col s2 centrar head_cell">
		<a href="#" class="tabla color_letra_primario" order="quantity DESC">
			<strong>Usuario</strong>
		</a>
	</div>
	<div class="col s4 centrar head_cell">
		<a href="#" class="tabla color_letra_primario" order="nom_lot ASC">
			<strong>Nota  </strong>
		</a>
	</div>
</div>
<?php
if (count($retorno_expitarion) > 0 ) { 
	foreach ($retorno_expitarion as $key => $value) { ?>
		<div class="row tabla " id="celda_<?php echo $value['id_exit_product_master'].$value['id_exit_product_detalle'] ?>" >
			<div class="col s2 primary_cell producto">
				<h6 class="col s12 center color_letra_secundario" >
				 <?php echo $value['name_product']." - ".$value['nom_lot']; ?></h6>
			</div>
			<div class="col s2 second_cell bodega">
				<h6 class="col s12 center color_letra_secundario">
				 <?php echo $value['amount_due']; ?></h6>
			</div>
			<div class="col s2 second_cell cantidad_disponible">
				<h6 class="col s12 center color_letra_secundario">
					<?php echo $value['expiration_date']?>
				</h6>
			</div>
			<div class="col s2 second_cell cantidad_disponible">
				<h6 class="col s12 center color_letra_secundario">
					<?php echo $value['name_user']?>
				</h6>
			</div>
			<div class="col s4 second_cell cantidad_disponible">
				<h6 class="col s12 center color_letra_secundario">
					<?php echo $value['note']?>
				</h6>
			</div>
		</div>
		<?php
	}
}else{ ?>
	<h6 class="titulo center fondo_negro paddin1 color_letra_primario">
		No se obtuvieron resultados
	</h6>
	<?php
}?>
<div class="paginacion col m12">
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php/paginator/index.php'); ?>
</div>