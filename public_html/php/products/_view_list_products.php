<div class="row">
	<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/products/index.php/" accept-charset="utf-8" class="search">
		<div class="flitro col s9 centrar sombra_blanca">
			<div class="input-field col s12 m2">
	            <input id="producto" type="text" value="<?php echo ($producto == "%%") ? "" : $producto ?>" class="validate search" name="producto" autocomplete="off">
	            <label for="producto" class="<?php echo ($producto == "%%") ? "" : "active" ?> search">Producto</label>
	        </div>
	        <div class="input-field col s12 m2">
	            <input id="bodega" type="text" class="validate search" value="<?php echo ($bodega == "%%") ? "" : $bodega ?>" name="bodega" autocomplete="off">
	            <label for="bodega" class="<?php echo ($bodega == "%%") ? "" : "active" ?> search">Bodega</label>
	        </div>
	        <div class="input-field col s12 m2">
	            <input id="fecha_inicial" type="text" class="validate search datepicker" value="<?php echo ($fecha_inicial == "%%") ? "" : $fecha_inicial ?>" name="fecha_inicial" autocomplete="off">
	            <label for="fecha_inicial" class="<?php echo ($fecha_inicial == "%%") ? "" : "active" ?> search">Fecha inicial</label>
	        </div>
	        <div class="input-field col s12 m2">
	            <input id="fecha_final" type="text" class="validate search datepicker" value="<?php echo ($fecha_final == "%%") ? "" : $fecha_final ?>" name="fecha_final" autocomplete="off">
	            <label for="fecha_final" class="<?php echo ($fecha_final == "%%") ? "" : "active" ?> search">Fecha final</label>
	        </div>
	        <div class=" input-field action col m1 centrar">
	        	<button class="waves-effect waves-light btn-floating btn-primary">
	        		<i class="material-icons left">search</i>
	        	</button>
	        </div>	
		</div>
	</form>
</div>
<?php 
	foreach ($retorno_productos as $key => $value) { ?>
		<div class="row" id="update_<?php echo $value['id_user'] ?>">
			<section>
				<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/products/update_product.php" class="update_info" accept-charset="utf-8">
					<input value="<?php echo $value['id_product'] ?>" name="id_producto" type="hidden" readonly="readonly">
					<div class="input-field col s4">
			            <i class="material-icons prefix">account_circle</i>
			            <input id="nombre_producto" type="text" class="validate editar_info" name="producto" autocomplete="off" value="<?php echo $value['name_product'] ?>"  readonly="readonly">
			            <label for="nombre_producto" class="active">Nombre producto</label>
			        </div>
			        <div class="input-field col s4">
			            <i class="material-icons prefix">account_circle</i>
			            <input id="descripcion_producto" type="text" class="validate editar_info" name="descripcion" autocomplete="off" value="<?php echo $value['description_product'] ?>"  readonly="readonly">
			            <label for="descripcion_producto" class="active">Descripción producto</label>
			        </div>
			        <div class="input-field col s4 hide oculto">
			        	<?php require($_SERVER['DOCUMENT_ROOT'].'/php/cellars/_view_cellar_select.php'); 
			        	?>
			        </div>
			        <div class="action col s4 centrar">
			        	<button class="waves-effect waves-light btn btn-success hide actualizar_info">
			        		<i class="material-icons left">near_me</i>Guardar
			        	</button>
			        	<button class="waves-effect waves-light btn btn-primary editar_info">
			        		<i class="material-icons left">cached</i>Editar
			        	</button>
			        </div>
		    	</form>
		    </section>
		</div>
		<?php  
	}
?>
<div class="paginacion col m12">
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php/paginator/index.php'); ?>
</div>