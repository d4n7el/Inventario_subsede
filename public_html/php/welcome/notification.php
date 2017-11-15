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
	<div class="contenedor col s12 m4">
		<div class="calendar col s12 m12">
	 		<div class="dia col s12 centrar">
	 			<?php echo $mes ?>
	 		</div>
	 		<div class="hora col s12 centrar color_letra_secundario">
	 			<?php echo $dia ?>
	 		</div>
		</div>
		<div class="col s12 m12">
	 		<div class="targeta_notificacion col s12 centrar">

	 			<a class="waves-effect color_letra_secundario col s12 waves-light btn-large view_expiration" href="#modal_right" ruta="../php/expiration/expiration.php" >
	 			 	Vencimientos
	 			 	<?php 
	 			 	if ($count_expiration['count'] > 0) { ?>
	 			 		<a class="btn btn-large btn-floating pulse cyan color_letra_danger view_expiration view_expiration_count" ruta="../php/expiration/expiration.php"  href="#modal_right"><?php echo $count_expiration['count'] ?></a>
	 			 		<?php 
	 			 	}?>	
	 			</a>
	 		</div>
		</div>
		<div class="col s12 m12">
	 		<div class="targeta_notificacion col s12 centrar">
	 			<a class="waves-effect color_letra_secundario  col s12 waves-light btn-large">
	 				Mal estado
	 			</a>
	 		</div>
		</div>
	</div>
	<?php  
	if ($_SESSION["user_zone"] == "A") { ?>	
		<div class="contenedor col s12 m4">
			<div class="grafica col s12 m12">
		 		<img src="../image/grafica.png" alt="">
			</div>
			<div class="col s12 m12">
		 		<div class="targeta_notificacion col s12 centrar">
		 			<a class="waves-effect color_letra_secundario col s12 waves-light btn-large view_graphics" href="#modal_right" ruta="../php/products/graphics_bar_total_exit.php" >
		 			 	Salidas
		 			</a>
		 		</div>
			</div>
			<div class="col s12 m12">
		 		<div class="targeta_notificacion col s12 centrar">
		 			<a class="waves-effect color_letra_secundario col s12 waves-light btn-large view_graphics" href="#modal_right" ruta="../php/stock/graphic_acum_exit_date.php" >
		 			 	Acumulado / Salidas
		 			</a>
		 		</div>
			</div>
			<div class="col s12 m12">
		 		<div class="targeta_notificacion col s12 centrar">
		 			<a class="waves-effect color_letra_secundario col s12 waves-light btn-large view_graphics" href="#modal_right" ruta="../php/stock/graphics_bar_exit_income.php" >
		 			 	Ingresos / Salidas
		 			</a>
		 		</div>
			</div>
		</div>
		<?php
	}
	if ($_SESSION["user_zone"] == "B") { ?>	
		<div class="contenedor col s12 m4">
			<div class="grafica col s12 m12">
		 		<img src="../image/grafica-planta.png" alt="">
			</div>
			<div class="col s12 m12">
		 		<div class="targeta_notificacion col s12 centrar">
		 			<a class="waves-effect color_letra_secundario col s12 waves-light btn-large view_graphics" href="#modal_right" ruta="../php/products/graphics_bar_total_exit.php" >
		 			 	Salidas
		 			</a>
		 		</div>
			</div>
			<div class="col s12 m12">
		 		<div class="targeta_notificacion col s12 centrar">
		 			<a class="waves-effect color_letra_secundario col s12 waves-light btn-large view_graphics" href="#modal_right" ruta="../php/stock/graphic_acum_exit_date.php" >
		 			 	Acumulado / Salidas
		 			</a>
		 		</div>
			</div>
			<div class="col s12 m12">
		 		<div class="targeta_notificacion col s12 centrar">
		 			<a class="waves-effect color_letra_secundario col s12 waves-light btn-large view_graphics" href="#modal_right" ruta="../php/stock/graphics_bar_exit_income.php" >
		 			 	Ingresos / Salidas
		 			</a>
		 		</div>
			</div>
		</div>
		<?php
	}?>
</div>