<div class="row">
    <div class="col s12" id="vista_ventana">
    	<?php if (isset($_SESSION["cod_user_activo"])) { ?>
    		<div class="col s12 centrar color_letra_secundario sombra" id="recordatorio">
				<h5 class="col s12">
					<i class="material-icons">warning</i> ¡Recuerda modificar tu contraseña! 
				</h5>
    		</div>
			<div class="col s12 m6 offset-m3">
				<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php/password/form_new_pass.php'); ?>
			</div>
    		<?php	
    	}else{
    		require_once($_SERVER['DOCUMENT_ROOT'].'/php/welcome/notification.php');
    	} ?>
    </div> 
</div>

