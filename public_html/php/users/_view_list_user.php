<div class="row" id="view_actions_table">
	<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/users/index.php/" accept-charset="utf-8" class="search">
		<div class="flitro col s12 centrar ">
			<div class="input-field col s4 hide-on-small-only">
	            <i class="material-icons prefix">search</i>
	            <input id="name" type="text" value="<?php echo ($name == "%%") ? "" : $name ?>" class="validate search" name="name" autocomplete="off">
	            <label for="name" class="<?php echo ($name == "%%") ? "" : "active" ?> search">Nombre</label>
	        </div>
	        <div class="input-field col s4 hide-on-small-only">
	            <input id="apellido" type="text" class="validate search" value="<?php echo ($apellido == "%%") ? "" : $apellido ?>" name="apellido" autocomplete="off">
	            <label for="apellido" class="<?php echo ($apellido == "%%") ? "" : "active" ?> search">Apellido</label>
	        </div>
	        <div class="input-field col s4">
	            <input id="cedula" type="text" class="validate search" value="<?php echo ($cedula == "%%") ? "" : $cedula  ?>" name="cedula" autocomplete="off">
	            <label for="cedula" class="<?php echo ($cedula == "%%") ? "" : "active" ?> search">Cedula</label>
	        </div>
	        <div class="input-field col s4 hide-on-small-only">
	            <input id="correo" type="text" class="validate search" value="<?php echo ($correo == "%%") ? "" : $correo ?>" name="correo" autocomplete="off">
	            <label for="correo" class="<?php echo ($correo == "%%") ? "" : "active" ?> search">Correo</label>
	        </div>
	        <input id="estado" type="hidden" class="validate search" value="<?php echo ($estado == "%%") ? "" : $estado ?>" name="estado" autocomplete="off">
	        <p>
      			<input name="group1" value="1" type="radio" id="test1"  <?php echo ($estado == "1") ? "checked"  : "" ?> />
      			<label for="test1">Activo</label>
    		</p>
		    <p>
		      	<input name="group1" value="0" type="radio" id="test2" <?php echo ($estado == "0") ? "checked"  : "" ?> />
		      	<label for="test2">Inactivo</label>
		    </p>
	        <div class=" input-field action col m1 centrar">
	        	<button class="waves-effect waves-light btn-floating btn-primary">
	        		<i class="material-icons left">near_me</i>
	        	</button>
	        </div>	
		</div>
	</form>
	<div class="row" id="head_table">
		<div class="col s4 m2 centrar prymary_head_cell">
			<a href="#" class="tabla fondo_blanco" order="name_product ASC">
				<strong>Nombre</strong>
			</a>
		</div>
		<div class="col s2 m2 centrar head_cell hide-on-small-only">
			<a href="#" class="tabla fondo_blanco" order="name_cellar ASC">
				<strong>Apellido</strong>
			</a>
		</div>
		<div class="col s3 m3 centrar head_cell hide-on-small-only">
			<a href="#" class="tabla fondo_blanco" order="nom_lot ASC">
				<strong>Email  </strong>
			</a>
		</div>
		<div class="col s4 m2 centrar head_cell">
			<a href="#" class="tabla fondo_blanco" order="quantity DESC">
				<strong>Cedula  </strong>
			</a>
		</div>
		<div class="col s2 m2 centrar head_cell hide-on-small-only">
			<a href="#" class="tabla fondo_blanco" order="quantity DESC">
				<strong>Bodega  </strong>
			</a>
		</div>
		<div class="col s4 m1 centrar head_cell">
			<a href="#" class="fondo_blanco">
				<strong>Opciones  </strong>
			</a>
		</div>
	</div>
</div>
<div id="view_actions_table_next">
<?php 
	if (count($retorno_user) > 0) {
		foreach ($retorno_user as $key => $value) { ?>
			<div class="row tabla col s12 " id="celda_<?php echo $value['id_exit_product_master'].$value['id_exit_product_detalle'] ?>" >
				<div class="col s4 m2 primary_cell producto">
					<h6 class="col s12 center color_letra_secundario" >
					 <?php echo $value['name_user']; ?></h6>
				</div>
				<div class="col s2 m2 second_cell bodega hide-on-small-only">
					<h6 class="col s12 center color_letra_secundario">
					 <?php echo $value['last_name_user']; ?></h6>
				</div>
				<div class="col s3 m3 second_cell lote hide-on-small-only">
					<h6 class="col s12 center color_letra_secundario">
					<?php echo $value['email_user']; ?></h6>
				</div>
				<div class="col s4 m2 second_cell cantidad_disponible">
					<h6 class="col s12 center color_letra_secundario">
						<?php echo $value['cedula']?>
					</h6>
				</div>
				<div class="col s2 m2 second_cell cantidad_disponible hide-on-small-only">
					<h6 class="col s12 center color_letra_secundario">
						<?php echo $value['name_cellar']?>
					</h6>
				</div>
				<div class="col s4 m1 second_cell">
					<button type="" class="col s12 btn btn-primary material-icons color_letra_secundario modal-trigger view_info_user" ruta="../php/users/index.php" state="<?php echo $value['state']?>" id_user="<?php echo $_SESSION["id_user_activo"] ?>" data-target="modal_right">visibility</button>
				</div>
			</div>
			<?php 
		}
	}else{ ?>
		<h5 class="col s12 centrar color_letra_secundario">No se obtuvieron resultados</h5>
	<?php 
	}
?>
</div>
<div class="paginacion col s12 m12">
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php/paginator/index.php'); ?>
</div>