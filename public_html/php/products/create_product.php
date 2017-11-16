<?php  
	session_start();
	if (isset($_SESSION["id_user_activo"])) {
	$col = (isset($_REQUEST['alterno']) ? "s12" : "s12 m6" );
?>
		<div class="row">
		    <div class="formulario col <?php echo $col ?>">
		    	<h6 class="color_letra_primario center paddin1 fondo_negro">
					Crear productos
				</h6>
		    	<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/products/new_product.php" class="create_info">
					<div class="input-field col s12 m12">
			            <i class="material-icons prefix">account_circle</i>
			            <input id="nombre_producto" type="text" class="validate" name="producto" autocomplete="off" required>
			            <label for="nombre_producto" class="">Nombre del Producto</label>
			        </div>
			        <div class="input-field col s12 m12">
			            <i class="material-icons prefix">fingerprint</i>
			            <input id="code" type="text" class="validate" value="" name="code" autocomplete="off">
			            <label for="code" class="">Codigo Ica</label>
			        </div>
			        <div class="input-field col s12 m12">
			            <i class="material-icons prefix">subject</i>
			            <input id="nombre_descripcion" type="text" class="validate" name="descripcion" autocomplete="off" required>
			            <label for="nombre_descripcion" class="">Descripción</label>
			        </div>
			        	
  					<div class="input-field col s12 m12">
			        	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php/cellars/_view_cellar_select.php'); ?>
			        </div>
			        <div class="col s12 m12 center">
			        	<h6 class="titulo centrar color_letra_secundario">	
							Categoria toxicologica
			        	</h6>
			        	<p class="col s3">
					      <input name="tox" type="radio" id="tox2" value="II" />
					      <label for="tox2">II</label>
					    </p>
					    <p class="col s3">
					      <input name="tox" type="radio" id="tox3" value="III" />
					      <label for="tox3">III</label>
					    </p>
					    <p class="col s3">
					      <input class="with-gap" name="tox" value="IV" type="radio" id="tox4"  />
					      <label for="tox4">IV</label>
					    </p>
					    <p class="col s3">
					      <input name="tox" type="radio" value="No" id="toxn" checked="" />
					      <label for="toxn">Ninguna</label>
					    </p>	
			        </div>
			        <div class="action col m12 centrar">
			        	<button class="waves-effect waves-light btn btn-primary">
			        		<i class="material-icons left">near_me</i>Guardar
			        	</button>
			        </div>	
				</form>
		    </div>
		    <?php 
		    if (!isset($_REQUEST['alterno'])) { ?>
		    	<div class="col <?php echo $col ?> hide-on-small-only" id="view_graphics">
	    			<?php require_once($_SERVER['DOCUMENT_ROOT']."/php/products/graphics_pie.php") ?>
	    		</div>
		    	<?php
		    } ?>
		    
		</div>
		<?php 
	}
	?>
