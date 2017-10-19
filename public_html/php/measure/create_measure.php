<?php  
session_start();
if (isset($_SESSION["id_user_activo"])) { ?>
	<div class="row">
	    <div class="formulario col m6">
	    	<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/measure/new_measure.php" class="create_info">
				<div class="input-field col s12 m12">
		            <i class="material-icons prefix">hourglass_empty</i>
		            <input id="nombre_medida" type="text" class="validate" name="medida" autocomplete="off" required>
		            <label for="nombre_medida" class="">Nombre de la Medida</label>
		        </div>
		        <div class="input-field col s12 m12">
		            <i class="material-icons prefix">hourglass_full</i>
		            <input id="nombre_descripcion" type="text" class="validate" name="prefijo" autocomplete="off" required>
		            <label for="prefijo" class="">Prefijo</label>
		        </div>	
		        <div class="action col m12">
		        	<button class="waves-effect waves-light btn btn-primary">
		        		<i class="material-icons left">near_me</i>Guardar
		        	</button>
		        </div>	
			</form>
	    </div>
	    <div class="col s6" id="view_graphics">
    		<?php require_once($_SERVER['DOCUMENT_ROOT']."/php/measure/graphics_pie.php") ?>
    	</div>
	</div>
	<?php 
}
?>
