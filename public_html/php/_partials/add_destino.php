<h6 class="titulo color_letra_primario fondo_negro center paddin1 col s12">
 Destino y destinatario.
 </h6>
<div class="row">
    <div class="destino col s12 m6" style="margin-top: 1em">
        <p class="col s6">
            <input name="destino" type="radio" id="interno" required value="Int" />
            <label for="interno">Interno</label>
        </p>
        <p class="col s6">
            <input name="destino" type="radio" id="Externo" required value="Ext" />
            <label for="Externo">Externo</label>
        </p>
    </div>
    <div class="input-field col s12 m6 hide" id="desc_destino">
        <i class="material-icons prefix">airport_shuttle</i>
        <input id="desc_destino" type="text" class="validate" name="destino" value="" autocomplete="off" max="" required >
        <label for="desc_destino" class="active">Especificacion destino</label>
    </div>
</div>
<div class="row">
	<div class="input-field col s12">
        <i class="material-icons prefix">account_circle</i>
        <input id="receive_user" type="text" class="validate" name="receive_user" autocomplete="off" ruta="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/request/get_user.php" required>
        <label for="receive_user" class="">Cedula de quien recibe</label>
    </div>
    <div class="input-field col s12" id="name_receive_user">
    </div> 
</div>
<div class="action col m12 centrar">
	<button type="" class="btn btn-primary" id="create_destino">
		Crear
		 <i class="material-icons left">send</i>
	</button>
</div>