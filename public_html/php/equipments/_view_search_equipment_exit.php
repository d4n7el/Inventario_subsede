<div class="row">
	<div class="alternos col s12">
		<button type="" class="waves-effect col s4 flujo_alterno waves-light btn btn-success" ruta="../php/tools/create_tools.php" data-target="modal_center">Crea un equipo
		            <i class="material-icons left">add</i>
		</button>
		<button class="waves-effect waves-light btn btn-primary col s4 offset-s1" id="view_list_exit" data-target="modal_right" >
				<i class="material-icons left">visibility</i>Productos salida ()
		</button>
	</div>
</div>
<form action="<?php $_SERVER['DOCUMENT_ROOT']?>/php/equipments/search_equipment_exit.php" class="search_exit_plant">			
	<div class="input-field col s12 m6 paddin1">
        <i class="material-icons prefix">send</i>
        <input id="search" type="text" class="validate" name="search" value="<?php echo ($search_equipo == "%%") ? "" : $search_equipo  ?>" autocomplete="off" required>
        <label for="search" class="active">Nombre del equipo</label>
    </div>
    <input type="submit" class="hide">
</form>
<div class="list_stock_exit col s12">
	<?php  
	if (count($retorno_equipment) > 0) {  
		foreach ($retorno_equipment as $key => $equipo) {  ?>
			<div class="col s12 m12 l4" id="<?php echo $equipo['id_equipment']."_".$equipo['quantity_available'] ?>" style="padding: 0px;">
	          	<div class="card">
	          		<div class="input-field col s12 m12 hide cantidad">
			            <input id="cantidad" type="number" class="validate search" name="cantidad[]" autocomplete="off" min="0" max="<?php echo $equipo['quantity_available'] ?>" required>
			            <label for="cantidad" class="">disponible <?php echo $equipo['quantity_available']; ?></label>
		        	</div>
		        	<div class="input-field col s12 m12 hide cantidad">
			            <input id="nota" type="text" class="validate search" name="nota[]" autocomplete="off" required>
			            <label for="nota" class="">Nota</label>
		        	</div>
	           		<div class="card-content white-text">
              			<p class="color_letra_secundario center">Equipo : <?php echo $equipo['name_equipment']; ?></p>
              			<p class="color_letra_secundario center">Total : <?php echo $equipo['total_quantity']; ?></p>
              			<p class="color_letra_secundario center">Disponible : <?php echo $equipo['quantity_available']; ?></p>
              			<input type="hidden" name="id_element[]" value="<?php echo $equipo['id_equipment'] ?>" readonly>
      					<a class="btn centrar btn-success halfway-fab waves-effect waves-light  add_exit_plant" divs="<?php echo $equipo['id_equipment']."_".$equipo['quantity_available']?>">
      						Añadir a salida
      					</a>
      					<a class="btn centrar btn-success  halfway-fab waves-effect hide waves-light  delete_exit_plant" divs="<?php echo $equipo['id_equipment']."_".$equipo['quantity_available'] ?>">
      						Elimiinar de salida
      					</a>
	            	</div>
	          	</div>
	        </div>
	        <?php
		}
	}else{


	} ?>
</div>

