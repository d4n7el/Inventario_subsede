<div class="row">
	<div class="alternos col s12">
		<button type="" class="waves-effect col s4 flujo_alterno waves-light btn btn-success" ruta="../php/equipments/create_equipment.php" data-target="modal_center">Crea un equipo
		            <i class="material-icons left">add</i>
		</button>
		<button class="waves-effect waves-light btn btn-primary col s4 offset-s1" id="view_list_exit" data-target="modal_right" >
				<i class="material-icons left color_letra_secundario">visibility</i>Productos salida ()
		</button>
	</div>
</div>
<div class="row ">
	<form action="<?php $_SERVER['DOCUMENT_ROOT']?>/php/tools/search_tool_exit.php" class="search_exit_plant">			
		<div class="input-field col s12 m6 paddin2">
	        <i class="material-icons prefix">send</i>
	        <input id="search" type="text" class="validate" name="search" value="<?php echo ($tool_search == "%%") ? "" : $tool_search  ?>" autocomplete="off" required>
	        <label for="search" class="active">Nombre del equipo</label>
	    </div>
	    <input type="submit" class="hide">
	</form>
</div>
<div class="list_stock_exit col s12">
	<?php  
	if (count($retorno_tools) > 0) {  
		foreach ($retorno_tools as $key => $tool) {  ?>
			<div class="col s12 m12 l4" id="<?php echo $tool['id_tool']."_".$tool['quantity_available'] ?>" style="padding: 0px;">
	          	<div class="card">
	          		<div class="input-field col s12 m12 hide cantidad">
			            <input id="cantidad" type="number" class="validate search" name="cantidad[]" autocomplete="off" min="0" max="<?php echo $equipo['quantity_available'] ?>" required>
			            <label for="cantidad" class="">disponible <?php echo $tool['quantity_available']; ?></label>
		        	</div>
		        	<div class="input-field col s12 m12 hide cantidad">
			            <input id="nota" type="text" class="validate search" name="nota[]" autocomplete="off"  required>
			            <label for="nota" class="">Nota</label>
		        	</div>
	           		<div class="card-content white-text">
              			<p class="color_letra_secundario center">Equipo : <?php echo $tool['name_tool']; ?></p>
              			<p class="color_letra_secundario center">Total : <?php echo $tool['total_quantity']; ?></p>
              			<p class="color_letra_secundario center">Disponible : <?php echo $tool['quantity_available']; ?></p>
              			<input type="hidden" name="id_element[]" value="<?php echo $tool['id_tool'] ?>" readonly>
              			<div class="row btn-fijo">
	      					<a class="btn centrar btn-success halfway-fab waves-effect waves-light col s12 add_exit_plant" divs="<?php echo $tool['id_tool']."_".$tool['quantity_available'] ?>">
	      						<i class="material-icons left color_letra_primario">add</i>
	      					</a>
      					</div>
      					<div class="row btn-fijo">
	      					<a class="btn centrar btn-success  halfway-fab waves-effect hide waves-light col s12 delete_exit_plant" divs="<?php echo $tool['id_tool']."_".$tool['quantity_available'] ?>">
	      						<i class="material-icons left color_letra_primario">clear</i>
	      					</a>
      					</div>
	            	</div>
	          	</div>
	        </div>
	        <?php
		}
	}else{


	} ?>
</div>

