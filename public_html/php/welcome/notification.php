<?php 
	date_default_timezone_set('America/Bogota');
	$fecha = date('Y-m-d');
	$dia = date("d");
	$mes = date("F");
?>

<div class="row">
	<div class="contenedor col s12 m4">
		<div class="calendar col s12 m12">
	 		<div class="dia col s12 centrar">
	 			<?php echo $mes ?>
	 		</div>
	 		<div class="hora col s12 centrar">
	 			<?php echo $dia ?>
	 		</div>
		</div>
		<div class="col s12 m12">
	 		<div class="targeta_notificacion col s12 centrar">
	 			<a class="waves-effect col s12 waves-light btn-large view_graphics" href="#modal_right" ruta="../php/products/graphics_bar_total_exit.php" >
	 			 	Vencimientos
	 			 	<i class="material-icons left">visibility</i>
	 			</a>
	 		</div>
		</div>
		<div class="col s12 m12">
	 		<div class="targeta_notificacion col s12 centrar">
	 			<a class="waves-effect  col s12 waves-light btn-large">
	 			 	<i class="material-icons left">visibility</i>
	 				Mal estado
	 			</a>
	 		</div>
		</div>
	</div>
	<div class="contenedor col s12 m4">
		<div class="grafica col s12 m12">
	 		<img src="../image/grafica.png" alt="">
		</div>
		<div class="col s12 m12">
	 		<div class="targeta_notificacion col s12 centrar">
	 			<a class="waves-effect col s12 waves-light btn-large view_graphics" href="#modal_right" ruta="../php/products/graphics_bar_total_exit.php" >
	 			 	Salidas
	 			 	<i class="material-icons left">visibility</i>
	 			</a>
	 		</div>
		</div>
		<div class="col s12 m12">
	 		<div class="targeta_notificacion col s12 centrar">
	 			<a class="waves-effect col s12 waves-light btn-large view_graphics" href="#modal_right" ruta="../php/stock/graphic_acum_exit_date.php" >
	 			 	Acumulado
	 			 	<i class="material-icons left">visibility</i>
	 			</a>
	 		</div>
		</div>
		<div class="col s12 m12">
	 		<div class="targeta_notificacion col s12 centrar">
	 			<a class="waves-effect col s12 waves-light btn-large view_graphics" href="#modal_right" ruta="../php/stock/graphics_bar_exit_income.php" >
	 			 	Salidas
	 			 	<i class="material-icons left">visibility</i>
	 			</a>
	 		</div>
		</div>
	</div>
	<div class="contenedor col s12 m4">
		<div class="grafica col s12 m12">
	 		<img src="../image/grafica-planta.png" alt="">
		</div>
		<div class="col s12 m12">
	 		<div class="targeta_notificacion col s12 centrar">
	 			 <a class="waves-effect col s12 waves-light btn-large">
	 			 	Salidas planta
	 			 	<i class="material-icons left">visibility</i>
	 			</a>
	 		</div>
		</div>
		<div class="col s12 m12">
	 		<div class="targeta_notificacion col s12 centrar">
	 			<a class="waves-effect  col s12 waves-light btn-large">
	 			 	<i class="material-icons left">visibility</i>
	 				Destino Externo
	 			</a>
	 		</div>
		</div>
		<div class="col s12 m12">
	 		<div class="targeta_notificacion col s12 centrar">
	 			<a class="waves-effect  col s12 waves-light btn-large">
	 			 	<i class="material-icons left">visibility</i>
	 				Acumulado salidas
	 			</a>
	 		</div>
		</div>
	</div>
</div>