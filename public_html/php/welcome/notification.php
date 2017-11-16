<?php 
	date_default_timezone_set('America/Bogota');
	$fecha = date('Y-m-d');
	$dia = date("d");
	$mes = date("F");
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/expiration_controller.php');
	$expiration = new Expiration();
	$count_expiration = $expiration->expiration_count($fecha);
?>
<div class="row">
	<div class="contenedor col s12 m4 l3">
		<div class="calendar col s12 m12">
	 		<div class="dia col s12 centrar fondo_negro centrar">
	 			<h5><?php echo $mes ?></h5>
	 		</div>
	 		<div class="hora col s12 centrar color_letra_secundario">
	 			<?php echo $dia ?>
	 		</div>
		</div>
	</div>
	
	<?php  
	if ($_SESSION["user_zone"] == "A") { ?>	
		<div class="contenedor col s12 m4 l3">
			<div class="icono centrar">
				<i class="material-icons">insert_chart</i>
			</div>
			<div class="col s12 m12">
		 		<div class="targeta_notificacion col s12 centrar">
		 			<a class="waves-effect color_letra_secundario btn-primary col s12 waves-light btn-large view_graphics" href="#modal_right" ruta="../php/products/graphics_bar_total_exit.php" >
		 			 	Salidas
		 			</a>
		 		</div>
			</div>
			<div class="col s12 m12">
		 		<div class="targeta_notificacion col s12 centrar">
		 			<a class="waves-effect color_letra_secundario btn-primary col s12 waves-light btn-large view_graphics" href="#modal_right" ruta="../php/stock/graphic_acum_exit_date.php" >
		 			 	Acumulado / Salidas
		 			</a>
		 		</div>
			</div>
			<div class="col s12 m12">
		 		<div class="targeta_notificacion col s12 centrar">
		 			<a class="waves-effect color_letra_secundario btn-primary col s12 waves-light btn-large view_graphics" href="#modal_right" ruta="../php/stock/graphics_bar_exit_income.php" >
		 			 	Ingresos / Salidas
		 			</a>
		 		</div>
			</div>
		</div>
		<?php
	}?>
	<div class="col s12 m4 l3">
		<div class="icono centrar">
			<i class="material-icons">remove_shopping_cart</i>
		</div>
 		<div class="targeta_notificacion col s12 centrar">
 			<a class="waves-effect color_letra_secundario btn-primary col s12 waves-light btn-large view_expiration" href="#modal_right" ruta="../php/expiration/expiration.php" >
 			 	Vencimientos
 			 	<?php 
 			 	if ($count_expiration['count'] > 0) { ?>
 			 		<a class="btn btn-large btn-floating btn-success pulse color_letra_primario view_expiration view_expiration_count" ruta="../php/expiration/expiration.php"  href="#modal_right"><?php echo $count_expiration['count'] ?></a>
 			 		<?php 
 			 	}?>	
 			</a>
 		</div>
	</div>
	<div class="col s12 m4 l3">
		<div class="icono centrar">
			<i class="material-icons">account_box</i>
		</div>
 		<div class="targeta_notificacion col s12 centrar">
 			<button type="" class="col s12 btn btn-primary btn-large modal-trigger view_info_user" ruta="../php/users/index.php" state="1" id_user="<?php echo $_SESSION["id_user_activo"] ?>" data-target="modal_right"><?php echo $_SESSION["name_user_activo"] ?></button>
 		</div>
	</div>
</div>