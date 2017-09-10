<div class="row">
    <div class="formulario col m6 offset-m3">
    	<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/tools/new_tools.php" class="create_info">
			<div class="input-field col s12 m12">
	            <i class="material-icons prefix">account_circle</i>
	            <input id="receive_user" type="text" class="validate" name="receive_user" autocomplete="off" ruta="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/request/get_user.php" required>
	            <label for="receive_user" class="">Nombre de quien recibe</label>
	        </div>
	        <div class="input-field col s12 m12" id="name_receive_user">
	            
	        </div>
	    </form>
	</div>
</div>
