<div class="row" id="update_<?php echo $retorno_productos['id_user'] ?>">
	<h6 class="titulo col s12 center <?php echo $fondo ?> paddin1">
		Actualizar Información de <?php echo $retorno_productos['name_product'] ?>
	</h6>
	<section>
		<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/products/update_product.php" class="update_info" accept-charset="utf-8">
			<input value="<?php echo $retorno_productos['id_product'] ?>" name="id_producto" type="hidden" readonly="readonly">
			<div class="input-field col s12 m6">
	            <i class="material-icons prefix">account_circle</i>
	            <input id="nombre_producto" type="text" class="validate editar_info" name="producto" autocomplete="off" value="<?php echo $retorno_productos['name_product'] ?>"  readonly="readonly">
	            <label for="nombre_producto" class="active">Nombre producto</label>
	        </div>
	        <div class="input-field col s12 m6 ">
	        	<?php $value['id_cellar'] = $retorno_productos['id_cellar']; ?>
	        	<?php require($_SERVER['DOCUMENT_ROOT'].'/php/cellars/_view_cellar_select.php'); 
	        	?>
	        </div>
	         <div class="input-field col s12">
	            <i class="material-icons prefix">description</i>
	            <input id="descripcion_producto" type="text" class="validate editar_info" name="descripcion" autocomplete="off" value="<?php echo $retorno_productos['description_product'] ?>"  readonly="readonly">
	            <label for="descripcion_producto" class="active">Descripción producto</label>
	        </div>
	        <div class="col s12 m12 center paddin2">
	        	<h6 class="titulo centrar color_letra_secundario">	
					Categoria toxicologica
	        	</h6>
	        	<p class="col s4">
			      <input name="tox" type="radio" id="tox2" value="II" <?php echo ($retorno_productos['toxicological'] == "II") ? "checked" : "" ?> />
			      <label for="tox2">II</label>
			    </p>
			    <p class="col s4">
			      <input name="tox" type="radio" id="tox3" value="III" <?php echo ($retorno_productos['toxicological'] == "III") ? "checked" : "" ?> />
			      <label for="tox3">III</label>
			    </p>
			    <p class="col s4">
			      <input class="with-gap" name="tox" value="IV" type="radio" id="tox4" <?php echo ($retorno_productos['toxicological'] == "IV") ? "checked" : "" ?>  />
			      <label for="tox4">IV</label>
			    </p>
			    <p class="col s12">
			      <input name="tox" type="radio" value="NULL" id="toxn" <?php echo ($retorno_productos['toxicological'] == "No") ? "checked" : "" ?>  />
			      <label for="toxn">Ninguna</label>
			    </p>	
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