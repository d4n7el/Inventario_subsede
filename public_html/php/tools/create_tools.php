<?php  
	session_start();
	if (isset($_SESSION["id_user_activo"]) AND $_SESSION["id_user_activo_role"] != "A1-_1B" AND $_SESSION["id_user_activo_role"] != "E_1_S1") {
		$col = (isset($_REQUEST['alterno']) ? "s12" : "s12 m6" );
?>
		<div class="row">
		    <div class="formulario col <?php echo $col ?>">
		    	<h6 class="color_letra_primario center paddin1 fondo_negro">
					Crear Herramientas
				</h6>
		    	<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/tools/new_tools.php" class="create_info">
					<div class="input-field col s12 m12">
			            <i class="material-icons prefix">account_circle</i>
			            <input id="nombre_herramienta" type="text" class="validate" name="herramienta" autocomplete="off" required>
			            <label for="nombre_producto" class="">Nombre de herramienta</label>
			        </div>
			        <div class="input-field col s12 m12">
			            <i class="material-icons prefix">subject</i>
			            <input id="nombre_marca" type="text" class="validate" name="marca" autocomplete="off">
			            <label for="nombre_marca" class="">Marca</label>
			        </div>
			        <div class="input-field col s12 m12">
			            <i class="material-icons prefix">filter_9_plus</i>
			            <input id="nombre_cantidad" type="number" class="validate" name="cantidad" autocomplete="off" required>
			            <label for="nombre_cantidad" class="">Cantidad</label>
			        </div>
					
					<!-- El siguiente div está oculto hasta nuevo aviso -->
			        <div class="input-field col s12 m12">
			            <i class="material-icons prefix">filter_9_plus</i>
			            <input id="nombre_cant_dis" type="number" class="validate" name="cantidad_disponible" autocomplete="off" required>
			            <label for="nombre_cant_dis" class="">Cantidad Disponible</label>
			        </div>
			    
  					
			        <div class="action col s12 m12 centrar">
			        	<button class="waves-effect waves-light btn btn-primary">
			        		<i class="material-icons left">near_me</i>Guardar
			        	</button>
			        </div>	
				</form>
		    </div>
		    <?php
		    if (!isset($_REQUEST['alterno'])){ ?>
		    <div class="col s6 hide-on-small-only"  id="view_graphics">
	    		<?php require_once($_SERVER['DOCUMENT_ROOT']."/php/tools/graphics_pie.php") ?>
	    	</div> <?php
	    	}?>
	    	
		</div>
		<?php 
	}
	?>
