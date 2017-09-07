<?php  
	session_start();
	if (isset($_SESSION["id_user_activo"])) {
?>
		<div class="row">
		    <div class="formulario col m6 offset-m3">
		    	<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/tools/new_tools.php" class="create_info">
					<div class="input-field col s12 m12">
			            <i class="material-icons prefix">account_circle</i>
			            <input id="nombre_herramienta" type="text" class="validate" name="herramienta" autocomplete="off" required>
			            <label for="nombre_producto" class="">Nombre de herramienta</label>
			        </div>
			        <div class="input-field col s12 m12">
			            <i class="material-icons prefix">subject</i>
			            <input id="nombre_marca" type="text" class="validate" name="marca" autocomplete="off" required>
			            <label for="nombre_marca" class="">Marca</label>
			        </div>
			        <div class="input-field col s12 m12">
			            <i class="material-icons prefix">subject</i>
			            <input id="nombre_cantidad" type="text" class="validate" name="cantidad" autocomplete="off" required>
			            <label for="nombre_cantidad" class="">Cantidad</label>
			        </div>
			        <div class="input-field col s12 m12">
			            <i class="material-icons prefix">subject</i>
			            <input id="nombre_cant_dis" type="text" class="validate" name="cantidad_disponible" autocomplete="off" required>
			            <label for="nombre_cant_dis" class="">Cantidad Disponible</label>
			        </div>
			    
  					<div class="input-field col s12 m12">
			        	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php/cellars/_view_cellar_select.php'); ?>
			        </div>
			        <div class="action col m12">
			        	<button class="waves-effect waves-light btn btn-primary">
			        		<i class="material-icons left">near_me</i>Guardar
			        	</button>
			        </div>	
				</form>
		    </div>
		</div>
		<?php 
	}
	?>
