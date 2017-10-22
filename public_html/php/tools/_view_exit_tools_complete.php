<?php
	if (count($retorno_view_exit_tools) > 0) {  ?>
	<div id="area_impresion">
		<div class="row">
			<div class="logo_sena col s4 centrar">
				<img src="/image/logo_sena_min.png" alt="">
			</div>
			<div class="col s8">
				<h5 class=" col s12 center color_letra_secundario">Fecha de salida</h5>
				<h5 class="titulo col s12 center color_letra_secundario"><?php echo $retorno_view_exit_tools[0]['date_create']; ?></h5>
			</div>
			<div class="col s4">
				<h5 class=" col s12 center color_letra_secundario">Entregó</h5>
				<h5 class="titulo col s12 center color_letra_secundario"><?php echo $retorno_view_exit_tools[0]['name_user']." ". $retorno_view_exit_tools[0]['last_name_user']; ?></h5>
			</div>
			<div class="col s4">
				<h5 class=" col s12 center color_letra_secundario">Recibió</h5>
				<h5 class="titulo col s12 center color_letra_secundario"><?php echo $retorno_view_exit_tools[0]['name_user_receive']; ?></h5>
			</div>
			
		</div>
		<div class="row" id="head_table">
			<div class="col s3 centrar prymary_head_cell">
				<a href="#" class="color_letra_primario">
					<strong>Herramienta  </strong>
				</a>
			</div>
			<div class="col s2 centrar head_cell">
				<a href="#" class="tabla color_letra_primario">
					<strong>Cantidad  </strong>
				</a>
			</div>
			<div class="col s2 centrar head_cell">
				<a href="#" class="tabla color_letra_primario">
					<strong>Entregado </strong>
				</a>
			</div>
			<div class="col s2 centrar head_cell">
				<a href="#" class="tabla color_letra_primario">
					<strong>Recibido  </strong>
				</a>
			</div>
			<div class="col s3 centrar head_cell">
				<a href="#" class="tabla color_letra_primario">
					<strong>Nota  </strong>
				</a>
			</div>
		</div>
		<?php
		foreach ($retorno_view_exit_tools as $key => $view) { ?>
			<div class="row content_impresion" >
				<div class="col s3">
					<h6 class="titulo primary_cell center col s12 <?php echo ($view['state'] == 1)? "color_letra_secundario" : "color_letra_danger" ?>"><?php echo $view['name_tool']; ?></h6>
				</div>
				<div class="col s2">
					<h6 class="titulo second_cell center col s12 <?php echo ($view['state'] == 1)? "color_letra_secundario" : "color_letra_danger" ?>"><?php echo $view['quantity']; ?></h6>
				</div>
				<div class="col s2">
					<h6 class="titulo second_cell center col s12 <?php echo ($view['state'] == 1)? "color_letra_secundario" : "color_letra_danger" ?>"><?php echo ($view['delivery'] == 0 ? "No" : "Si" ); ?></h6>
				</div>
				<div class="col s2">
					<h6 class="titulo second_cell center col s12 <?php echo ($view['state'] == 1)? "color_letra_secundario" : "color_letra_danger" ?>"><?php echo ($view['received'] == 0 ? "No" : "Si" ); ?></h6>
				</div>
				<div class="col s3">
					<h6 class="titulo second_cell center col s12 <?php echo ($view['state'] == 1)? "color_letra_secundario" : "color_letra_danger" ?>"><?php echo $view['note_received']; ?></h6>
				</div>

				

			</div>
			<?php
		}?>	
	</div>
	<button type="" class="btn" id="impresion">Imprimir</button>
	<?php
	}else{ ?>
		<h5 class="col s12 centrar color_letra_secundario">No se obtuvieron resultados</h5>
	<?php
	}
?>
