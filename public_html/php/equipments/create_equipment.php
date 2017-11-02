<?php  
	session_start();
	if (isset($_SESSION["id_user_activo"])) {
		$col = (isset($_REQUEST['alterno']) ? "s12" : "s6" );	
?>
		<div class="row">
		    <div class="formulario col <?php echo $col ?> ">
		    	<h6 class="color_letra_primario center paddin1 fondo_negro">
					Crear Equipos
				</h6>
		    	<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/equipments/new_equipment.php" class="create_info">
					<div class="input-field col s12 m12">
			            <i class="material-icons prefix">account_circle</i>
			            <input id="nombre_equipo" type="text" class="validate" name="equipo" autocomplete="off" required>
			            <label for="nombre_equipo" class="">Nombre Equipo</label>
			        </div>
			        <div class="input-field col s12 m12">
			            <i class="material-icons prefix">subject</i>
			            <input id="marca" type="text" class="validate" name="marca" autocomplete="off" required>
			            <label for="marca" class="">Marca</label>
			        </div>
			        <div class="input-field col s12 m12">
			        	<i class="material-icons prefix">business_center</i>
			        	<input id="cantidad_total" type="text" class="validate" name="cantidad_total" autocomplete="off" required>
			        	<label for="cantidad_total" class="">Cantidad Total</label>
			        </div>	
			        <div class="input-field col s12 m12">
			            <i class="material-icons prefix">local_grocery_store</i>
			            <input id="cantidad_disponible" type="text" class="validate" name="cantidad" autocomplete="off" required>
			            <label for="cantidad_disponible" class="">Cantidad disponible</label>
			        </div>
			        <div class="action col m12">
			        	<button class="waves-effect waves-light btn btn-primary">
			        		<i class="material-icons left">near_me</i>Guardar
			        	</button>
			        </div>	
				</form>
		    </div>
		    <?php 
		    if (!isset($_REQUEST['alterno'])){ ?>
		    <div class="col s6" id="view_graphics">
	    		<?php require_once($_SERVER['DOCUMENT_ROOT']."/php/equipments/graphics_pie.php") ?>
	    	</div> <?php
	    	}?>
	    	
		</div>
		<?php 
	}
	?>