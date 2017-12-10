<?php  
session_start();
if (isset($_SESSION["id_user_activo"])) { 
	$user = true;?>
	<div class="row">
	    <div class="formulario col s12 m12">
	    	<h6 class="titulo center fondo_negro color_letra_primario paddin1">
				Nueva Bodega
	    	</h6>
	    	<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/cellars/update_cellar.php" class="update_info">
	    		<input type="hidden" readonly="" value="<?php echo $retorno_cellars[0]['id_cellar'] ?>" name="id_cellar">
				<div class="input-field col s12 m12">
					<i class="material-icons prefix">shopping_basket</i>
		            <input id="name_cellar" value="<?php echo $retorno_cellars[0]['name_cellar'] ?>" type="text" class="validate" name="name_cellar" autocomplete="off" required>
		            <label for="name_cellar" class="active">Nombre bodega</label>
		        </div>	
		        <div class="input-field col s12 m12">
		            <i class="material-icons prefix">speaker_notes</i>
		            <input id="description" value="<?php echo $retorno_cellars[0]['description_cellar'] ?>" type="text" class="validate" name="description" autocomplete="off" required>
		            <label for="description" class="active">Descripción</label>
		        </div>
		        <div class="input-field col s12 m12">
		            <i class="material-icons prefix">account_circle</i>
		            <input id="delegate" value="<?php echo $retorno_cellars[0]['delegate'] ?>" type="text" class="validate" name="delegate" autocomplete="off" required>
		            <label for="delegate" class="active">Encargado</label>
		        </div>
		        <div class="input-field col s12 m12 hide">
		            <i class="material-icons prefix">account_circle</i>
		            <input id="icon_cellar" value="<?php echo $retorno_cellars[0]['date_create'] ?>" type="text" class="validate" name="icon_cellar" autocomplete="off" required>
		        </div>
		        <div class="action col m12 centrar">
		        	<button class="waves-effect waves-light btn btn-primary">
		        		<i class="material-icons left">near_me</i>Guardar
		        	</button>
		        </div>
			</form>
	    </div>
	    <div class="formulario iconos col s12">
	    	<?php $tipoImage = explode(" ",$retorno_cellars[0]['icon_cellar']);  ?>
	    	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php/_partials/_icons.php'); ?>
	    </div>
	</div>
	<?php 
}
?>