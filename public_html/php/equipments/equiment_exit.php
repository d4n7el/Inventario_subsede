<div class="row">
    <div class="formulario col s5" id="">
       	<div class="input-field col s12 m12">
            <?php require_once($_SERVER['DOCUMENT_ROOT'].'/php/equipments/_view_select_equipment.php');?>
        </div>
        <div class="input-field col s12 m12" id="cantidad_disponible">
       		
        </div>
        <div class="action col s12 centrar">
        	<button class="waves-effect waves-light btn btn-primary" id="add_exit">
        		<i class="material-icons left">near_me</i>Agregar
        	</button>
	    </div>	
	</div>
	<div class="col s7">	
		<form action=" <?php  $_SERVER['DOCUMENT_ROOT']?>/php/equipments/new_equiments_exit.php" class="create_info">
			<div class="action col s12 centrar" style="padding-bottom: 2em">
	        	<button class="waves-effect waves-light btn btn-primary" id="">
	        		<i class="material-icons left">near_me</i>Registrar salidas
	        	</button>
		    </div>	
            <div class="input-field col s12 m12">
                <i class="material-icons prefix">account_circle</i>
                <input id="receive_user" type="text" class="validate" name="receive_user" autocomplete="off" ruta="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/request/get_user.php" required>
                <label for="receive_user" class="">Cedula de quien recibe</label>
            </div>
            <div class="input-field col s12 m12" id="name_receive_user">
                
            </div>	
			<div class="input-field col s12 m12" id="view_add_elements" ruta="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/_partials/_select_quantity.php">
		       		
		    </div>
	    </form>
    </div>
</div>