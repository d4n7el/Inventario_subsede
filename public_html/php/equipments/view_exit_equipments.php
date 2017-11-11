<div class="row">
	<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/equipments/index_exit.php/" accept-charset="utf-8" class="search">
		<div class="flitro col s12 centrar sombra_blanca">
			<div class="input-field col s12 m2">
	            <i class="material-icons prefix">search</i>
	            <input id="team" type="text" value="<?php echo ($team == "%%") ? "" : $team ?>" class="validate search" name="team" autocomplete="off">
	            <label for="team" class="<?php echo ($team == "%%") ? "" : "active" ?> search">Equipo</label>
	        </div>
	        <div class="input-field col s12 m1">
	            <input id="cedula" type="text" class="validate search" value="<?php echo ($cedula == "%%") ? "" : $cedula  ?>" name="cedula" autocomplete="off">
	            <label for="cedula" class="<?php echo ($cedula == "%%") ? "" : "active" ?> search">Cedula</label>
	        </div>
	        <div class="input-field col s12 m2">
	            <input id="fecha_inicial" type="text" class="validate search datepicker" value="<?php echo ($fecha_inicial == "%%") ? "" : $fecha_inicial ?>" name="fecha_inicial" autocomplete="off">
	            <label for="destino" class="<?php echo ($fecha_inicial == "%%") ? "" : "active" ?> search">Inicial</label>
	        </div>
	        <div class="input-field col s12 m2">
	            <input id="fecha_final" type="text" class="validate search datepicker" value="<?php echo ($fecha_final == "%%") ? "" : $fecha_final ?>" name="fecha_final" autocomplete="off">
	            <label for="fecha_final" class="<?php echo ($fecha_final == "%%") ? "" : "active" ?> search">Final</label>
	        </div>
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
</div>
<div class="row" id="head_table">
	<div class="col s3 centrar prymary_head_cell">
		<a href="#" class="color_letra_primario">
			<strong>Nombre Equipo </strong>
		</a>
	</div>
	<div class="col s3 centrar prymary_head_cell">
		<a href="#" class="color_letra_primario">
			<strong>Nombre Persona </strong>
		</a>
	</div>
	<div class="col s2 centrar head_cell">
		<a href="#" class="tabla color_letra_primario">
			<strong>Fecha  </strong>
		</a>
	</div>
	<div class="col s1 centrar head_cell">
		<a href="#" class="tabla color_letra_primario">
			<strong>Cantidad  </strong>
		</a>
	</div>
		<div class="col s3 centrar head_cell">
		<a href="#" class="tabla color_letra_primario">
			<strong>Opciones  </strong>
		</a>
	</div>
</div>
<?php 
	if (count($retorno_exit) > 0) {
		foreach ($retorno_exit as $key => $value) { ?>
			<div class="row tabla" id="celda_<?php echo $value['id_exit_equipment_master'].$value['exit_teams_detall'] ?>" >
				<div class="col s3 primary_cell producto">
					<h6 class="col s12 centrar color_letra_secundario" >
					 <?php echo $value['name_equipment']; ?></h6>
				</div>
				<div class="col s3 second_cell bodega">
					<h6 class="col s12 centrar color_letra_secundario">
					 <?php echo $value['name_user_receives']; ?></h6>
				</div>
				<div class="col s2 second_cell lote">
					<h6 class="col s12 centrar color_letra_secundario">
					<?php echo $value['date_create']; ?></h6>
				</div>
				<div class="col s1 second_cell cantidad_disponible">
					<h6 class="col s12 centrar color_letra_secundario" id="cantidad_<?php echo $value['id_exit'].$value['id_exit_detall'].$value['id_equipment'] ?>">
						<?php echo $value['quantity']; ?>
					</h6>
				</div>
				<div class="col s1 second_cell">
					<button type="" class="col s12 btn btn-primary material-icons color_letra_secundario modal-trigger view_exit_inform" id_exit_master="<?php echo $value['id_exit'] ?>" ruta="php/equipments/exit_equipment_complete.php" data-target="modal_right">visibility</button>
				</div>
				<?php
				if ($value['returned'] != 1) { ?>
					<div class="col s1 second_cell">
						<button type="" class="col s12 btn btn-primary material-icons color_letra_secundario modal-trigger edit_cant_inform" id_exit_master="<?php echo $value['id_exit'] ?>" id_exit_detalle="<?php echo $value['id_exit_detall'] ?>" data-target="modal_center" id_element="<?php echo $value['id_equipment'] ?>"  ruta="../php/equipments/edit_exit_equipment.php" ruta_update="../php/equipments/update_exit_equipment.php">create</button>
					</div>
					<div class="col s1 second_cell">
					<button type="" class="col s12 btn btn-primary material-icons color_letra_secundario modal-trigger delete_exit_inform" id_element="<?php echo $value['id_equipment'] ?>" id_exit_master="<?php echo $value['id_exit'] ?>" data-target="modal_center" id_exit_detalle="<?php echo $value['id_exit_detall'] ?>" stock="<?php echo $value['id_equipment'] ?>" ruta="../php/equipments/_cancel_exit_equipment.php">clear</button>
					</div>	
					<?php
					}
				?>			
			</div>
			<?php 
		}
	}else{ ?>
		<h5 class="col s12 centrar color_letra_secundario">No se obtuvieron resultados</h5>
	<?php 
	}
?>
<div class="paginacion col m12">
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php/paginator/index.php'); ?>
</div>