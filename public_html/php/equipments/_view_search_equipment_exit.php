<div class="row" id="view_actions">
	<div class="alternos col s12 m4 l3">
		<?php 
		if ($_SESSION["id_user_activo_role"] != 'E_1_S1' AND $_SESSION["id_user_activo_role"] != 'A1-_1B') { ?>
			<button type="" class="waves-effect col s12 flujo_alterno waves-light btn btn-success" ruta="../php/equipments/create_equipment.php" data-target="modal_center_two">Crear Equipo
			            <i class="material-icons color_letra_primario left">add</i>
			</button>
			<?php  
		}
		?>
	</div>
	<div class="col s12 m4 l5" id="" style="margin-top: 2em">
		<div class="col s12 fondo_negro">
			<h6 class="color_letra_primario">
				¡Información de salida! 
			</h6>
		</div>
		<div class="col s12 destino_salida">
			<h6 class="">
				Destino: 
				<i class="material-icons col s2 right" >airport_shuttle</i> 
			</h6>
		</div>
		<div class="col s12">
			<h6 class="">
				<?php echo "Entrega: ". $_SESSION["name_user_activo"]." ".$_SESSION["last_name_user_activo"] ?>
				<i class="material-icons col s2 right" >account_box</i> 
			</h6>
		</div>
		<div class="col s12 recibe">
			<h6 class="">
				Recibe:
				<i class="material-icons col s2 right" >account_circle</i> 
			</h6>
		</div>
		<div class="alternos col s12 m12 l12 centrar">
			<button type="" class="waves-effect col s6 add_destinatario waves-light btn btn-primary" ruta="../php/_partials/add_destino.php" data-target="modal_center">Añadir destino
				<i class="material-icons color_letra_secundario left">airport_shuttle</i>
			</button>
			<button class="waves-effect waves-light btn btn-primary col s6 " id="view_list_exit" >
				<i class="material-icons left color_letra_secundario">visibility</i>Listado salida ()
			</button>
		</div>
	</div>
	<div class="col s4" style="margin-top: 2em">
		<form action="<?php $_SERVER['DOCUMENT_ROOT']?>/php/equipments/search_equipment_exit.php" class="search_exit_plant">			
			<div class="input-field col s12">
		        <i class="material-icons prefix">send</i>
		        <input id="search" type="text" class="validate" name="search" value="<?php echo ($tool_search == "%%") ? "" : $tool_search  ?>" autocomplete="off">
		        <label for="search" class="active">Nombre del equipo</label>
		    </div>
		    <input type="submit" class="hide">
		</form>
	</div>
</div>
<div class="list_stock_exit col s12" id="next_view_actions">
	<?php  
	if (count($retorno_equipment) > 0) {  
		foreach ($retorno_equipment as $key => $equipo) {  ?>
			<div class="col s12 m4 l3" id="<?php echo $equipo['id_equipment']."_".$equipo['quantity_available'] ?>" style="padding: 0px;">
	          	<div class="card">
	          		<div class="input-field col s12 m12 hide cantidad">
			            <input id="cantidad" type="number" class="validate search" name="cantidad[]" autocomplete="off" min="0" max="<?php echo $equipo['quantity_available'] ?>" required>
			            <label for="cantidad" class="">disponible <?php echo $equipo['quantity_available']; ?></label>
		        	</div>
		        	<div class="input-field col s12 m12 hide cantidad">
			            <input id="nota" type="text" class="validate search" name="nota[]" autocomplete="off" required>
			            <label for="nota" class="">Nota</label>
		        	</div>
		        	<figure class="icon-cellar col s12 centrar">
		        		<img src="../image/equipos.svg" alt="">
		        	</figure>
	           		<div class="card-content white-text">
              			<p class="color_letra_secundario center">Equipo : <?php echo $equipo['name_equipment']; ?></p>
              			<p class="color_letra_secundario center">Total : <?php echo $equipo['total_quantity']; ?></p>
              			<p class="color_letra_secundario center">Disponible : <?php echo $equipo['quantity_available']; ?></p>
              			<input type="hidden" name="id_element[]" value="<?php echo $equipo['id_equipment'] ?>" readonly>
              			<div class="row btn-fijo">
	      					<a class="btn centrar btn-success halfway-fab waves-effect waves-light col s12  add_exit_plant" divs="<?php echo $equipo['id_equipment']."_".$equipo['quantity_available']?>">
	      						<i class="material-icons left color_letra_primario">add</i>
	      					</a>
	      				</div>
      					<div class="row btn-fijo">
	      					<a class="btn centrar btn-success  halfway-fab waves-effect hide waves-light col s12  delete_exit_plant" divs="<?php echo $equipo['id_equipment']."_".$equipo['quantity_available'] ?>">
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

