<div class="row">
    <div class="col s12" id="vista_ventana">
    	<?php if (isset($_SESSION["cod_user_activo"])) { ?>
    		<div class="col s12 centrar sombra" id="recordatorio">
				<h4 class="<?php echo ($_SESSION["user_zone"] == "A") ? "color_letra_secundario" : 'color_letra_terceario' ?>">
					<i class="material-icons <?php echo ($_SESSION["user_zone"] == "A") ? "color_letra_secundario" : 'color_letra_terceario' ?>">warning</i> ¡Recuerda modificar tu contraseña! 
				</h4>
    		</div>
			<div class="col s6 offset-s3">
				<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php/password/form_new_pass.php'); ?>
			</div>
    		<?php
    		
    	}else{
    		require_once($_SERVER['DOCUMENT_ROOT'].'/php/welcome/notification.php');
    	} ?>
    </div> 
</div>

