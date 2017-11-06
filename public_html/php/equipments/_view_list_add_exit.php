<div class="col s6 list_add_exit_plant hide ">
	<form action="<?php $_SERVER['DOCUMENT_ROOT']?>/php/equipments/new_equiments_exit.php" class="create_info">
		<div class="listado">
			<h5 class="col s12 fondo_negro color_letra_primario paddin1 titulo center">Listado de salida</h5>
			<div class="input-field col s6">
                    <i class="material-icons prefix">account_circle</i>
                    <input id="receive_user" type="text" class="validate" name="receive_user" autocomplete="off" ruta="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/request/get_user.php" required>
                    <label for="receive_user" class="">Cedula de quien recibe</label>
                </div>

                <div class="input-field col s6" id="name_receive_user">
                </div> 
			<div class="action col m12 centrar">
	        	<button class="waves-effect waves-light btn btn-primary">
	        		<i class="material-icons left">near_me</i>Registrar salida
	        	</button>
	        </div>	
        </div>
	</form>	
</div>