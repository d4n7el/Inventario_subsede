<div class="row" id="update_<?php echo $retorno_productos['id_user'] ?>">
	<h6 class="titulo col s12 center color_letra_primario fondo_negro paddin1">
		Actualizar Información de <?php echo $retorno_productos['name_product'] ?>
	</h6>
	<section>
		<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/products/update_product.php" class="update_info" accept-charset="utf-8">
			<input value="<?php echo $retorno_productos['id_product'] ?>" name="id_producto" type="hidden" readonly="readonly">
			<div class="input-field col s4">
	            <i class="material-icons prefix">account_circle</i>
	            <input id="nombre_producto" type="text" class="validate editar_info" name="producto" autocomplete="off" value="<?php echo $retorno_productos['name_product'] ?>"  readonly="readonly">
	            <label for="nombre_producto" class="active">Nombre producto</label>
	        </div>
	        <div class="input-field col s4">
	            <i class="material-icons prefix">account_circle</i>
	            <input id="descripcion_producto" type="text" class="validate editar_info" name="descripcion" autocomplete="off" value="<?php echo $retorno_productos['description_product'] ?>"  readonly="readonly">
	            <label for="descripcion_producto" class="active">Descripción producto</label>
	        </div>
	        <div class="input-field col s4 ">
	        	<?php $value['id_cellar'] = $retorno_productos['id_cellar']; ?>
	        	<?php require($_SERVER['DOCUMENT_ROOT'].'/php/cellars/_view_cellar_select.php'); 
	        	?>
	        </div>
	        <div class="action col s12 centrar">
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