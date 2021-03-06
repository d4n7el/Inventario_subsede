<div class="row" id="view_actions_table">
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
	        <div class=" input-field action col m1 centrar">
	        	<button class="waves-effect waves-light btn-floating btn-primary">
	        		<i class="material-icons left">near_me</i>
	        	</button>
	        </div>	
		</div>
	</form>
	<div class="row" id="head_table">
		<div class="col m3 s3 centrar prymary_head_cell">
			<a href="#" class="fondo_blanco">
				<strong>Equipo </strong>
			</a>
		</div>
		<div class="col m3 s3 centrar prymary_head_cell">
			<a href="#" class="fondo_blanco">
				<strong>Persona </strong>
			</a>
		</div>
		<div class="col m2 centrar head_cell hide-on-small-only">
			<a href="#" class="tabla fondo_blanco">
				<strong>Fecha  </strong>
			</a>
		</div>
		<div class="col m1 centrar head_cell hide-on-small-only">
			<a href="#" class="tabla fondo_blanco">
				<strong>Cantidad  </strong>
			</a>
		</div>
			<div class="col m3 s6 centrar head_cell">
			<a href="#" class="tabla fondo_blanco">
				<strong>Opciones  </strong>
			</a>
		</div>
	</div>
</div>
<div class="row" id="view_actions_table_next">
	<a class="btn-floating btn-primary" id="exportExcel" target="_blank" href="<?php $_SERVER['DOCUMENT_ROOT']?>/php/export/">
		<i class="material-icons color_letra_secundario left">file_download</i>
	</a>
	<?php 
	if (count($retorno_exit) > 0) {
		foreach ($retorno_exit as $key => $value) { ?>
			<div class=" tabla col s12" id="celda_<?php echo $value['id_exit_equipment_master'].$value['exit_teams_detall'] ?>" >
				<div class="col m3 s3 center primary_cell producto">
					<h6 class="col s12 center color_letra_secundario" >
					 <?php echo $value['name_equipment']; ?></h6>
				</div>
				<div class="col m3 s3 center second_cell bodega">
					<h6 class="col s12 center color_letra_secundario">
					 <?php echo $value['name_user_receives']; ?></h6>
				</div>
				<div class="col m2  second_cell lote hide-on-small-only">
					<h6 class="col s12 center color_letra_secundario">
					<?php echo $value['date_create']; ?></h6>
				</div>
				<div class="col m1 second_cell cantidad_disponible hide-on-small-only">
					<h6 class="col s12 center color_letra_secundario" id="cantidad_<?php echo $value['id_exit'].$value['id_exit_detall'].$value['id_equipment'] ?>">
						<?php echo $value['quantity']; ?>
					</h6>
				</div>
				<div class="col m1 s3 second_cell">
					<button type="" class="col s12 btn btn-primary material-icons color_letra_secundario modal-trigger view_exit_inform" id_exit_master="<?php echo $value['id_exit'] ?>" ruta="php/equipments/exit_equipment_complete.php" data-target="modal_right">visibility</button>
				</div>
				<?php
				if ($value['returned'] != 1) { ?>
					<div class="col m1 s3 second_cell">
						<button type="" class="col s12 btn btn-primary material-icons color_letra_secundario modal-trigger edit_cant_inform" id_exit_master="<?php echo $value['id_exit'] ?>" id_exit_detalle="<?php echo $value['id_exit_detall'] ?>" data-target="modal_center" id_element="<?php echo $value['id_equipment'] ?>"  ruta="../php/equipments/edit_exit_equipment.php" ruta_update="../php/equipments/update_exit_equipment.php">create</button>
					</div>
					<div class="col m1 s2 second_cell hide-on-small-only">
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
	}?>
</div>
<div class="paginacion col s12">
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php/paginator/index.php'); ?>
</div>