<div class="actions_pass col m12 ">
    <?php 
    if (!isset($init)) { ?>
        <div class="action col s12  centrar">
        	<button class="waves-effect waves-light btn btn-primary link_page_session" ruta="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/sessions/create_session.php">
        		<i class="material-icons left">near_me</i>Iniciar Sesión
        	</button>
        </div>
      <?php 
    } 
    if (!isset($code)) { ?>
        <div class="action col s12  centrar">
        	<button class="waves-effect waves-light btn btn-primary link_page_session" ruta="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/sessions/create_session_code.php">
        		<i class="material-icons left">fiber_pin</i>Iniciar Sesión Codigo
        	</button>
        </div>
        <?php 
    } 
    if (!isset($recover)) { ?>
        <div class="action col s12 centrar">
            <button class="waves-effect waves-light btn btn-primary link_page_session" ruta="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/password/index.php">
                <i class="material-icons left">warning</i>¿Has olvidado tu contraseña?
            </button>
        </div>
        <?php 
    } ?>
</div>	