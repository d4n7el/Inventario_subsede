<?php 
	date_default_timezone_set('America/Bogota');
	$fecha = date('Y-m-d');
	$dia = date("d");
	$mes = date("F");
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/stock_controller.php');
	$expiration = new Stock();
	$count_expiration = $expiration->expiration_count($fecha);
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

	 			<a class="waves-effect col s12 waves-light btn-large view_expiration" href="#modal_right" ruta="../php/stock/expiration.php" >
	 			 	Vencimientos
	 			 	<a class="btn btn-large btn-floating pulse cyan color_letra_danger view_expiration" ruta="../php/stock/expiration.php"  href="#modal_right"><?php echo $count_expiration['count'] ?></a>
	 			</a>
	 		</div>
		</div>
		<div class="col s12 m12">
	 		<div class="targeta_notificacion col s12 centrar">
	 			<a class="waves-effect  col s12 waves-light btn-large">
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
	 			</a>
	 		</div>
		</div>
		<div class="col s12 m12">
	 		<div class="targeta_notificacion col s12 centrar">
	 			<a class="waves-effect col s12 waves-light btn-large view_graphics" href="#modal_right" ruta="../php/stock/graphic_acum_exit_date.php" >
	 			 	Acumulado
	 			</a>
	 		</div>
		</div>
		<div class="col s12 m12">
	 		<div class="targeta_notificacion col s12 centrar">
	 			<a class="waves-effect col s12 waves-light btn-large view_graphics" href="#modal_right" ruta="../php/stock/graphics_bar_exit_income.php" >
	 			 	Salidas
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
	 			</a>
	 		</div>
		</div>
		<div class="col s12 m12">
	 		<div class="targeta_notificacion col s12 centrar">
	 			<a class="waves-effect  col s12 waves-light btn-large">
	 				Destino Externo
	 			</a>
	 		</div>
		</div>
		<div class="col s12 m12">
	 		<div class="targeta_notificacion col s12 centrar">
	 			<a class="waves-effect  col s12 waves-light btn-large">
	 				Acumulado salidas
	 			</a>
	 		</div>
		</div>
	</div>
</div>