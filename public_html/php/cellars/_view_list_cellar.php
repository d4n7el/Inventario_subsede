<div class="row" id="view_actions_table">
	<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/cellars/index.php/" accept-charset="utf-8" class="search">
		<div class="flitro col s12 centrar">
	        <div class="input-field col s6 ">
	            <input id="bodega" type="text" class="validate search" value="<?php echo ($bodega == "%%") ? "" : $bodega ?>" name="bodega" autocomplete="off">
	            <label for="bodega" class="<?php echo ($bodega == "%%") ? "" : "active" ?> search">Bodega</label>
	        </div>
	        <div class="input-field col s6 ">
	            <input id="encargado" type="text" class="validate search" value="<?php echo ($encargado == "%%") ? "" : $encargado ?>" name="encargado" autocomplete="off">
	            <label for="encargado" class="<?php echo ($encargado == "%%") ? "" : "active" ?> search">Encargado</label>
	        </div>
	        <div class=" input-field action col m1 centrar">
	        	<button class="waves-effect waves-light btn-floating btn-primary">
	        		<i class="material-icons left">search</i>
	        	</button>
	        </div>	
		</div>
	</form>
	<div class="row" id="head_table">
		<div class="col s5 m3 centrar prymary_head_cell">
			<a href="#" class="tabla fondo_blanco" order="name_cellar ASC">
				<strong>Bodega</strong>
			</a>
		</div>
		<div class="col s4 m2 centrar head_cell ">
			<a href="#" class="tabla fondo_blanco" order="delegate ASC">
				<strong>Encargado</strong>
			</a>
		</div>
		<div class="col s3 m3 centrar head_cell hide-on-small-only">
			<a href="#" class="tabla fondo_blanco" order="delegate ASC">
				<strong>Descripcion  </strong>
			</a>
		</div>
		<div class="col s2 m2 centrar head_cell hide-on-small-only">
			<a href="#" class="tabla fondo_blanco">
				<strong>Creación  </strong>
			</a>
		</div>
		<div class="col s3 m2 centrar head_cell">
			<a href="#" class="tabla fondo_blanco"">
				<strong>Opciones</strong>
			</a>
	</div>
</div>
</div>

<div id="view_actions_table_next">
	<a class="btn-floating btn-primary" id="exportExcel" target="_blank" href="<?php $_SERVER['DOCUMENT_ROOT']?>/php/export/">
	<i class="material-icons color_letra_secundario left">file_download</i>
	</a>
	<?php 
	foreach ($retorno_cellars as $key => $value) { ?>
		<div class="row tabla " id="celda_<?php echo $value['id_cellar'].$value['name_cellar'] ?>" >
			<div class="col s5 m3 primary_cell producto">
				<h6 class="col s12 center color_letra_secundario" >
				 <?php echo $value['name_cellar']; ?></h6>
			</div>
			<div class="col s4 m2 second_cell bodega">
				<h6 class="col s12 center color_letra_secundario">
				 <?php echo $value['delegate']; ?></h6>
			</div>
			<div class="col s3 m3 second_cell hide-on-small-only">
				<h6 class="col s12 center color_letra_secundario">
					<?php echo $value['description_cellar']?>
				</h6>
			</div>
			<div class="col s2 m2 second_cell hide-on-small-only">
				<h6 class="col s12 center color_letra_secundario">
					<?php echo $value['date_create']?>
				</h6>
			</div>
			<div class="col s3 m1 second_cell">
				<button type="" class="col s12 btn btn-primary material-icons <?php echo $fondo ?> modal-trigger view_info_cellar" cellar="<?php echo $value['id_cellar'] ?>" ruta="../php/cellars/index.php" data-target="modal_right">visibility</button>
			</div>
		</div>
		<?php  
	}?>
</div>

<div class="paginacion col s12 m12">
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php/paginator/index.php'); ?>
</div>