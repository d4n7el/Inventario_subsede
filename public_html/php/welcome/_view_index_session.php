<div class="row ">
	<div class="col s3 menu">
	    <div class="col s12 targeta_inicio">
			<div class="card transparent ">
				<div class="card-action" >
					<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/users/create_user.php" id="" class="link_page color_letra_primario" titulo="Crear usuario">Crear usuario<i class="material-icons right color_letra_primario">add</i></a>
				</div>
				<div class="card-action" >
					<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/users/index.php" id="" class="link_page color_letra_primario" titulo="Ver usuarios">Ver usuarios<i class="material-icons right color_letra_primario">visibility</i></a>
				</div>
			</div>
	    </div>
	    <div class="col s12 targeta_inicio">
			<div class="card transparent ">
				<div class="card-action" >
					<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/measure/create_measure.php" id="create_user" class="link_page color_letra_primario" titulo="Crear medida">Crear medida<i class="material-icons right color_letra_primario">add</i></a>
				</div>
				<div class="card-action" >
					<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/measure/" class="link_page color_letra_primario" titulo="Ver medidas">Ver medidas<i class="material-icons right color_letra_primario">visibility</i></a>
				</div>
			</div>
	    </div>
	    <div class="col s12 targeta_inicio">
			<div class="card transparent ">
				
				<div class="card-action" >
					<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/products/create_product.php" id="" class="link_page color_letra_primario" titulo="Crear productos">Crear productos<i class="material-icons right color_letra_primario">add</i></a>
				</div>
				<div class="card-action" >
					<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/products" class="link_page color_letra_primario" titulo="Ver productos">Ver productos<i class="material-icons right color_letra_primario">visibility</i></a>
				</div>
				<div class="card-action" >
					<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/stock/stock.php" class="link_page color_letra_primario" titulo="Insertar Stock" >Insertar Stock<i class="material-icons right color_letra_primario">add</i></a>
				</div>

				<div class="card-action" >
					<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/stock/index.php" class="link_page color_letra_primario" titulo="Ver Stock">Ver Stock<i class="material-icons right color_letra_primario">visibility</i></a>
				</div>
				<div class="card-action" >
					<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/products/outlet_products.php" id="" class="link_page color_letra_primario">Salida<i class="material-icons right color_letra_primario">add</i></a>
				</div>
				<div class="card-action" >
					<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/stock/index_exit.php" class="link_page color_letra_primario" titulo="Ver salidas">Ver salidas<i class="material-icons right color_letra_primario">visibility</i></a>
				</div>
			</div>
	    </div>
	    <div class="col s12 targeta_inicio">
			<div class="card transparent ">
				<div class="card-action " >
					<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/equipments/create_equipment.php" id="" class="link_page color_letra_primario" titulo="Crear Equipo">Crear Equipo<i class="material-icons right color_letra_primario">add</i></a>
				</div>
				<div class="card-action" >
					<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/equipments" class="link_page color_letra_primario" titulo="Ver Equipo">Ver Equipo<i class="material-icons right color_letra_primario">visibility</i></a>
				</div>
				<div class="card-action " >
					<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/equipments/equiment_exit.php" id="" class="link_page color_letra_primario" titulo="Salida Equipo">Salida Equipo<i class="material-icons right color_letra_primario">add</i></a>
				</div>

				<div class="card-action">
					<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/equipments/index_exit.php" class="link_page color_letra_primario" titulo="Ver Equipo">Ver Salidas<i class="material-icons right color_letra_primario">visibility</i></a>
				</div>
			</div>
	    </div>
	    <div class="col s12 targeta_inicio">
			<div class="card transparent ">
				<div class="card-action" >
					<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/tools/create_tools.php" id="" class="link_page color_letra_primario" titulo="Ingresar Herramienta">Ingresar Herramienta <i class="material-icons right color_letra_primario">add</i></a>
				</div>
				<div class="card-action" >
					<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/tools" class="link_page color_letra_primario" titulo="Ver Herramientas">Ver Herramientas<i class="material-icons right color_letra_primario">visibility</i></a>
				</div>
				<div class="card-action" >
					<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/tools/outlet_tools.php" id="" class="link_page color_letra_primario" titulo="Salida Herramientas">Salidas<i class="material-icons right color_letra_primario">add</i></a>
				</div>
				<div class="card-action" >
					<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/tools/index_exit_tools.php" class="link_page color_letra_primario" titulo="Ver herramienta">Salida herramienta<i class="material-icons right color_letra_primario">visibility</i></a>
				</div>
			</div>
	    </div>
	    <div class="col s12 targeta_inicio">
			<div class="card transparent ">
				<div class="card-action" >
					<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/plant/" id="" class="link_page color_letra_primario" titulo="Stock planta">Stock planta<i class="material-icons right color_letra_primario">add</i></a>
				</div>
				<div class="card-action" >
					<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/tools" class="link_page color_letra_primario" titulo="Salidas Planta">Salidas Planta<i class="material-icons right color_letra_primario">visibility</i></a>
				</div>
			</div>
	    </div>
    </div>
    <div class="col s9 offset-s3" id="vista_ventana">
    	<?php if (isset($_SESSION["cod_user_activo"])) { ?>
    		<div class="col s12 centrar sombra" id="recordatorio">
				<h4 class="color_letra_secundario">
					<i class="material-icons color_letra_secundario">warning</i> ¡Recuerda modificar tu contraseña! 
				</h4>
    		</div>
			<div class="col s6 offset-s3">
				<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php/password/form_new_pass.php'); ?>
			</div>
    		<?php
    		
    	}else{
    		require_once($_SERVER['DOCUMENT_ROOT'].'/php/welcome/notification.php');
    	} ?>
    </div> 
</div>

