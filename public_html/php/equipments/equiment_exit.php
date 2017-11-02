<div class="row">
    <div class="formulario col s12 alternos" id="">
        <button type="" class="waves-effect flujo_alterno waves-light btn btn-success" ruta="../php/equipments/create_equipment.php" data-target="modal_center">Crea un equipo
            <i class="material-icons left">add</i>
        </button>
    </div>

    <form action="#" accept-charset="utf-8">
        <div class="formulario col s5" id="">
            <h5 class="titulo"> Selecciona los campos</h5>  
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

    </form>

    <div class="col s12">   
        <form action=" <?php  $_SERVER['DOCUMENT_ROOT']?>/php/equipments/new_equiments_exit.php" class="create_info"  accept-charset="utf-8">
            <div class="col s5 form_fix_right">
                <div class="input-field col s12 m12">
                    <i class="material-icons prefix">account_circle</i>
                    <input id="receive_user" type="text" class="validate" name="receive_user" autocomplete="off" ruta="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/request/get_user.php" required>
                    <label for="receive_user" class="">Cedula de quien recibe</label>
                </div>

                <div class="input-field col s12 m12" id="name_receive_user">
                </div>  
                <div class="action col s12 centrar" style="padding-bottom: 2em">
                    <button class="waves-effect waves-light btn btn-primary" id="">
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