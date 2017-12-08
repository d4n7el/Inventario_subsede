<div class="row">
	<div class="col s12  menu">		
		<?php
	    if ($_SESSION["id_user_activo_role"] != 'E_1_S1' AND $_SESSION["id_user_activo_role"] != 'A1-_1B' ) { ?>
		    <div class="col s12 targeta_inicio">
				<div class="card transparent ">
					<div class="card-action fondo_negro" >
						<a href="#modal_center_two" id="" ruta="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/users/create_user.php" class="flujo_alterno color_letra_primario" titulo="Crear usuario">Crear usuario<i class="material-icons right color_letra_primario">add</i></a>
					</div>
					<div class="card-action fondo_negro" >
						<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/users/index.php" id="" class="link_page color_letra_primario" titulo="Ver usuarios">Ver usuarios<i class="material-icons right color_letra_primario">visibility</i></a>
					</div>
				</div>
		    </div>
		    <div class="col s12 targeta_inicio">
				<div class="card transparent ">
					<div class="card-action fondo_negro" >
						<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/cellars/create_cellar.php" id="" class="link_page color_letra_primario" titulo="Crear Bodega">Crear Bodega<i class="material-icons right color_letra_primario">add</i></a>
					</div>
					<div class="card-action fondo_negro" >
						<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/users/index.php" id="" class="link_page color_letra_primario" titulo="Ver usuarios">Ver Bodegas<i class="material-icons right color_letra_primario">visibility</i></a>
					</div>
				</div>
		    </div>
	    	<?php
		}
	    if ($_SESSION["id_user_activo_role"] != 'E_1_S1' AND $_SESSION["id_user_activo_role"] != 'A1-_1B') { ?>
		    <div class="col s12 targeta_inicio">
				<div class="card transparent ">
					<div class="card-action fondo_negro" >
						<a href="#modal_center_two" id="" ruta="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/measure/create_measure.php" class="flujo_alterno color_letra_primario" titulo="Crear usuario">Crear Medida<i class="material-icons right color_letra_primario">add</i></a>
					</div>
					<div class="card-action fondo_negro" >
						<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/measure/" class="link_page color_letra_primario" titulo="Ver medidas">Ver medidas<i class="material-icons right color_letra_primario">visibility</i></a>
					</div>
				</div>
		    </div>
		    <?php  
	    }
	    if ($_SESSION["user_zone"] == 'A') { ?>
		    <div class="col s12 targeta_inicio">
				<div class="card transparent ">
					<?php
	    			if ($_SESSION["id_user_activo_role"] != 'E_1_S1' AND $_SESSION["id_user_activo_role"] != 'A1-_1B' ) { ?>
						<div class="card-action fondo_negro" >
							<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/products/create_product.php" id="" class="link_page color_letra_primario" titulo="Crear productos">Crear productos<i class="material-icons right color_letra_primario">add</i></a>
						</div>
						<?php  
	    			}?>
					<div class="card-action fondo_negro" >
						<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/products/index.php" class="link_page color_letra_primario" titulo="Ver productos">Ver productos<i class="material-icons right color_letra_primario">visibility</i></a>
					</div>
					<?php
	    			if ($_SESSION["id_user_activo_role"] != 'E_1_S1' AND $_SESSION["id_user_activo_role"] != 'A1-_1B' ) { ?>
						<div class="card-action fondo_negro" >
							<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/stock/stock.php" class="link_page color_letra_primario" titulo="Insertar Stock" >Insertar Stock<i class="material-icons right color_letra_primario">add</i></a>
						</div>
						<?php  
	    			}?>
					<div class="card-action fondo_negro" >
						<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/stock/index.php" class="link_page color_letra_primario" titulo="Ver Stock">Ver Stock<i class="material-icons right color_letra_primario">visibility</i></a>
					</div>
					<div class="card-action fondo_negro" >
						<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/products/outlet_products.php" id="" titulo="Nueva salida de Productos" class="link_page color_letra_primario">Salida Productos<i class="material-icons right color_letra_primario">add</i></a>
					</div>
					<div class="card-action fondo_negro" >
						<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/stock/index_exit.php" class="link_page color_letra_primario" titulo="Ver salidas de productos">Ver salidas<i class="material-icons right color_letra_primario">visibility</i></a>
					</div>
					<div class="card-action fondo_negro" >
						<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/expiration/index.php" class="link_page color_letra_primario" titulo="Productos vencidos">Productos vencidos<i class="material-icons right color_letra_primario">visibility</i></a>
					</div>
				</div>
		    </div>
			<?php  
	    }
	    if ($_SESSION["user_zone"] == "A" || $_SESSION["user_zone"] == "B") { ?>
		    <div class="col s12 targeta_inicio">
				<div class="card transparent ">
					<?php
	    			if ($_SESSION["id_user_activo_role"] != 'E_1_S1' AND $_SESSION["id_user_activo_role"] != 'A1-_1B' ) { ?>
						<div class="card-action fondo_negro " >
							<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/equipments/create_equipment.php" id="" class="link_page color_letra_primario" titulo="Crear Equipo">Crear Equipo<i class="material-icons right color_letra_primario">add</i></a>
						</div>
						<?php  
	    			}?>
					<div class="card-action fondo_negro" >
						<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/equipments/index.php" class="link_page color_letra_primario" titulo="Ver Equipo">Ver Equipo<i class="material-icons right color_letra_primario">visibility</i></a>
					</div>
					<div class="card-action fondo_negro " >
						<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/equipments/equiment_exit.php" id="" class="link_page color_letra_primario" titulo="Nueva salida equipo">Salida Equipo<i class="material-icons right color_letra_primario">add</i></a>
					</div>

					<div class="card-action fondo_negro">
						<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/equipments/index_exit.php" class="link_page color_letra_primario" titulo="Ver salida equipo">Ver Salidas<i class="material-icons right color_letra_primario">visibility</i></a>
					</div>
				</div>
		    </div>
		    <?php  
	    }
	    if ($_SESSION["user_zone"] == "A" || $_SESSION["user_zone"] == "B") { ?>
		    <div class="col s12 targeta_inicio">
				<div class="card transparent ">
					<?php
	    			if ($_SESSION["id_user_activo_role"] != 'E_1_S1' AND $_SESSION["id_user_activo_role"] != 'A1-_1B' ) { ?>
						<div class="card-action fondo_negro" >
							<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/tools/create_tools.php" id="" class="link_page color_letra_primario" titulo="Ingresar Herramienta">Crear Herramienta <i class="material-icons right color_letra_primario">add</i></a>
						</div>
						<?php  
	   				}?>
					<div class="card-action fondo_negro" >
						<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/tools/index.php" class="link_page color_letra_primario" titulo="Ver Herramientas">Ver Herramientas<i class="material-icons right color_letra_primario">visibility</i></a>
					</div>
					<div class="card-action fondo_negro" >
						<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/tools/outlet_tools.php" id="" class="link_page color_letra_primario" titulo="nueva salida herramientas">Salidas<i class="material-icons right color_letra_primario">add</i></a>
					</div>
					<div class="card-action fondo_negro" >
						<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/tools/index_exit_tools.php" class="link_page color_letra_primario" titulo="Ver salida herramienta">Salida herramienta<i class="material-icons right color_letra_primario">visibility</i></a>
					</div>
				</div>
		    </div>
			<?php  
	    }
	    if ($_SESSION["user_zone"] == "B" ) { ?>
		    <div class="col s12 targeta_inicio">
				<div class="card transparent ">
					<?php
	    			if ($_SESSION["id_user_activo_role"] != 'E_1_S1' AND $_SESSION["id_user_activo_role"] != 'A1-_1B' ) { ?>
						<div class="card-action fondo_negro" >
							<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/products/create_product.php" id="" class="link_page color_letra_primario" titulo="Crear productos">Crear productos<i class="material-icons right color_letra_primario">add</i></a>
						</div>
						<?php  
	   				}?>
					<div class="card-action fondo_negro" >
						<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/products/index.php" class="link_page color_letra_primario" titulo="Ver productos">Ver productos<i class="material-icons right color_letra_primario">visibility</i></a>
					</div>
					<?php
	    			if ($_SESSION["id_user_activo_role"] != 'E_1_S1' AND $_SESSION["id_user_activo_role"] != 'A1-_1B' ) { ?>
						<div class="card-action fondo_negro" >
							<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/stock/stock.php" class="link_page color_letra_primario" titulo="Insertar Stock" >Insertar Stock<i class="material-icons right color_letra_primario">add</i></a>
						</div>
						<?php  
	   				}?>
					<div class="card-action fondo_negro" >
						<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/plant/index.php" id="" class="link_page color_letra_primario" titulo="Ver stock planta">Stock planta<i class="material-icons right color_letra_primario">add</i></a>
					</div>
					<div class="card-action fondo_negro" >
						<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/plant/_view_exit.php" class="link_page color_letra_primario" titulo="Nueva salidas planta">Salidas Planta<i class="material-icons right color_letra_primario">visibility</i></a>
					</div>
					<div class="card-action fondo_negro" >
						<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/plant/view_list_exit_plant.php" class="link_page color_letra_primario" titulo="Nueva salidas planta">Ver Salidas<i class="material-icons right color_letra_primario">visibility</i></a>
					</div>
				</div>
		    </div>
	    	<?php  
	    }?>
    </div>
</div>