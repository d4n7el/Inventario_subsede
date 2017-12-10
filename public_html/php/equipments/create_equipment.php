<?php  
	session_start();
	if (isset($_SESSION["id_user_activo"]) AND $_SESSION["id_user_activo_role"] != "A1-_1B" AND $_SESSION["id_user_activo_role"] != "E_1_S1")  {
		$col = (isset($_REQUEST['alterno']) ? "s12" : "m6 s12" );	
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
			        	<?php $cellar_optional = true ?>
			        	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php/cellars/_view_cellar_select.php'); ?>
			        </div>
			        <div class="input-field col s12 m12">
			            <i class="material-icons prefix">subject</i>
			            <input id="marca" type="text" class="validate" name="marca" autocomplete="off">
			            <label for="marca" class="">Marca - Serial</label>
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
			        <div class="action col m12  s12 centrar">
			        	<button class="waves-effect waves-light btn btn-primary">
			        		<i class="material-icons left">near_me</i>Guardar
			        	</button>
			        </div>	
				</form>
		    </div>
		    <?php 
		    if (!isset($_REQUEST['alterno'])){ ?>
		    <div class="col s6 hide-on-small-only" id="view_graphics">
	    		<?php require_once($_SERVER['DOCUMENT_ROOT']."/php/equipments/graphics_pie.php") ?>
	    	</div> <?php
	    	}?>
	    	
		</div>
		<?php 
	}
	else{?>
		<h6 class="center color_letra_primario paddin1 fondo_negro">Usted no esta autorizado a realizar esta operacion</h6>
		<?php 
	}
	?>