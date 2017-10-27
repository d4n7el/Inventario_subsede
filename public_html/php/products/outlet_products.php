<div class="row">
    <div class="formulario col s12 alternos" id="">
        <button type="" class="waves-effect flujo_alterno waves-light btn btn-success" ruta="../php/products/create_product.php" data-target="modal_right">Crea un producto
            <i class="material-icons left">add</i>
        </button>
        <button type="" class="waves-effect flujo_alterno waves-light btn btn-success" ruta="../php/stock/stock.php" data-target="modal_right">Crea un Stock
            <i class="material-icons left">add</i>
        </button>
    </div>
    <form action="#" accept-charset="utf-8" id="add_exit_product">
        <div class="formulario col s5" id="">
            <h5 class="titulo"> Selecciona los campos</h5>	
           	<div class="input-field col s12 m12" id="stock">
            	<?php 
            	$exit_product = true;
            	require_once($_SERVER['DOCUMENT_ROOT'].'/php/cellars/_view_cellar_select.php'); ?>
            </div>

            <div class="input-field col s12 m12" id="mostrar_productos">
    			
            </div>
            <div class="input-field col s12 m12" id="mostrar_lotes">
    			
            </div>
            <div class="input-field col s12 m12" id="cantidad_disponible">
                <i class="material-icons prefix">filter_9_plus</i>
                <input id="cantidad" type="number" class="validate" name="cantidad[]" value="" autocomplete="off" max="" required >
                <label for="cantidad" class="active">Cantidad</label>
            </div>
            <div class="action col s12 centrar">
            	<button class="waves-effect waves-light btn btn-primary" id="">
            		<i class="material-icons left">near_me</i>Agregar a la lista
            	</button>
    	    </div>	
    	</div>
    </form>
	<div class="col s12">	
		<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/stock/new_exit_stock.php" class="create_info"  accept-charset="utf-8">
            <div class="col s5 form_fix_right">   
                <h6 class="titulo color_letra_secundario col s12"> Destino</h6>
                <div class="destino col s12 sombra" style="margin-top: 1em">
                    <p class="col s4">
                        <input name="destino" type="radio" id="interno" required value="Int" />
                        <label for="interno">Interno</label>
                    </p>
                    <p class="col s4">
                        <input name="destino" type="radio" id="Externo" required value="Ext" />
                        <label for="Externo">Externo</label>
                    </p>
                </div>
                <div class="input-field col s12 m12 hide" id="desc_destino">
                    <i class="material-icons prefix">airport_shuttle</i>
                    <input id="desc_destino" type="text" class="validate" name="destino" value="" autocomplete="off" max="" disabled="" required >
                    <label for="desc_destino" class="active">Especificacion destino</label>
                </div>
                <div class="input-field col s12 m12">
                    <i class="material-icons prefix">account_circle</i>
                    <input id="receive_user" type="text" class="validate" name="receive_user" autocomplete="off" ruta="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/request/get_user.php" required>
                    <label for="receive_user" class="">Cedula de quien recibe</label>
                </div>
                <div class="input-field col s12 m12" id="name_receive_user">
                   
                </div>
                <div class="action col s12 centrar">
                    <button class="waves-effect waves-light btn btn-primary" id="add_exit_product">
                        <i class="material-icons left">near_me</i>Registrar salidas
                    </button>
                </div>
            </div>
            <div class="input-field col s12 m12" id="view_add_elements" ruta="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/_partials/_select_quantity.php">
                <p class="col s12 center guia_abajo"><i class="material-icons col s12">expand_more</i><i class="material-icons col s12 second">expand_more</i></p>
            </div>
        </form> 
    </div>
</div>
