<?php  
session_start();
if (isset($_SESSION["id_user_activo"])) { 
	$user = true;?>
	<div class="row">
	    <div class="formulario col s12 m6">
	    	<h6 class="titulo center fondo_negro color_letra_primario paddin1">
				Nueva Bodega
	    	</h6>
	    	<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/cellars/new_cellar.php" class="create_info">
				<div class="input-field col s12 m12">
					<i class="material-icons prefix">shopping_basket</i>
		            <input id="name_cellar" type="text" class="validate" name="name_cellar" autocomplete="off" required>
		            <label for="name_cellar" class="">Nombre bodega</label>
		        </div>	
		        <div class="input-field col s12 m12">
		            <i class="material-icons prefix">speaker_notes</i>
		            <input id="description" type="text" class="validate" name="description" autocomplete="off" required>
		            <label for="description" class="">Descripción</label>
		        </div>
		        <div class="input-field col s12 m12">
		            <i class="material-icons prefix">account_circle</i>
		            <input id="delegate" type="text" class="validate" name="delegate" autocomplete="off" required>
		            <label for="delegate" class="">Encargado</label>
		        </div>
		        <div class="input-field col s12 m12 hide">
		            <i class="material-icons prefix">account_circle</i>
		            <input id="icon_cellar" type="text" class="validate" name="icon_cellar" autocomplete="off" required>
		        </div>
		        <div class="action col m12 centrar">
		        	<button class="waves-effect waves-light btn btn-primary">
		        		<i class="material-icons left">near_me</i>Guardar
		        	</button>
		        </div>
			</form>
	    </div>
	    <div class="formulario iconos col s6">
	    	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php/_partials/_icons.php'); ?>
	    </div>
	</div>
	<?php 
}
?>
