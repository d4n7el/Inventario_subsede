<?php
	session_start();
	if (count($retorno_view_exit_tools) > 0) {  ?>
	<div id="area_impresion">
		<div class="row">
			<div class="logo_sena col s12 centrar i1">
				<img src="/image/logo_sena_min.png" alt="">
			</div>
			<div class="col s12 i1">
				<h5 class=" col s12 center color_letra_secundario">Fecha de salida</h5>
				<h5 class="titulo col s12 center color_letra_secundario"><?php echo $retorno_view_exit_tools[0]['date_create']; ?></h5>
			</div>
			<div class="col s4 i3">
				<h5 class=" col s12 center color_letra_secundario">Entregó</h5>
				<h5 class="titulo col s12 center color_letra_secundario"><?php echo $retorno_view_exit_tools[0]['name_user']." ". $retorno_view_exit_tools[0]['last_name_user']; ?></h5>
			</div>
			<div class="col s4 i3">
				<h5 class=" col s12 center color_letra_secundario">Recibió</h5>
				<h5 class="titulo col s12 center color_letra_secundario"><?php echo $retorno_view_exit_tools[0]['name_user_receive']; ?></h5>
			</div>
			<div class="col s4 i3">
				<h5 class=" col s12 center color_letra_secundario">Destino</h5>
				<h5 class="titulo col s12 center color_letra_secundario"><?php echo $retorno_view_exit_tools[0]['destination'] ?></h5>
			</div>
			
		</div>
		<div class="row" id="head_table">
			<div class="col s3 centrar prymary_head_cell i5">
				<a href="#" class="fondo_blanco">
					<strong>Herramienta  </strong>
				</a>
			</div>
			<div class="col s2 centrar head_cell i5">
				<a href="#" class="tabla fondo_blanco">
					<strong>Cantidad  </strong>
				</a>
			</div>
			<div class="col s2 centrar head_cell i5">
				<a href="#" class="tabla fondo_blanco">
					<strong>Entregado </strong>
				</a>
			</div>
			<div class="col s2 centrar head_cell i5">
				<a href="#" class="tabla fondo_blanco">
					<strong>Recibido  </strong>
				</a>
			</div>
			<div class="col s3 centrar head_cell i5">
				<a href="#" class="tabla fondo_blanco">
					<strong>Nota  </strong>
				</a>
			</div>
		</div>
		<?php
		foreach ($retorno_view_exit_tools as $key => $view) { ?>
			<div class="row content_impresion" >
				<div class="col s3 i5">
					<h6 class="titulo  center col s12 <?php echo ($view['state'] == 1)? "color_letra_secundario" : "color_letra_danger" ?>"><?php echo $view['name_tool']; ?></h6>
				</div>
				<div class="col s2 i5">
					<h6 class="titulo second_cell center col s12 <?php echo ($view['state'] == 1)? "color_letra_secundario" : "color_letra_danger" ?>"><?php echo $view['quantity']; ?></h6>
				</div>
				<div class="col s2 i5">
					<h6 class="titulo second_cell center col s12 <?php echo ($view['state'] == 1)? "color_letra_secundario" : "color_letra_danger" ?>"><?php echo ($view['delivered'] == 0 ? "No" : "Si" ); ?></h6>
				</div>
				<div class="col s2 i5 <?php echo ($view['returned'] == 1 AND $_SESSION["id_user_activo_role"] != "A_A-a_1" AND  $_SESSION["id_user_activo_role"] != "B_1-b_1")  || $view['state'] == 0 ? "" : "hide" ?>">
					<h6 class="titulo second_cell center col s12 <?php echo ($view['state'] == 1)? "color_letra_secundario" : "color_letra_danger" ?>" id="<?php echo $view['id_exit_detall'].$view['id_exit'] ?>"><?php echo ($view['returned'] == 0 ? "No" : "Si" ); ?></h6>
				</div>
				<?php 
				if ($view['returned'] == 0 OR $_SESSION["id_user_activo_role"] == "A_A-a_1" || $_SESSION["id_user_activo_role"] == "B_1-b_1" AND $view['state'] != 0 ) { ?>
					<div class="col s2 i5 centrar show">
						<p style="margin-top: 0em">
					      <input type="checkbox" class="state" id="state_<?php echo $view['id_exit_detall'].$view['id_exit'] ?>	" value="<?php echo ($view['returned'] == 0 ? "0" : "1" ); ?>" <?php echo ($view['returned'] == 0 ? "" : "checked" ); ?> ruta="../php/tools/returned_tool.php" master="<?php echo $view['id_exit'] ?>" detalle="<?php echo $view['id_exit_detall']?>" />
					      <label for="state_<?php echo $view['id_exit_detall'].$view['id_exit'] ?>	"></label>
					    </p>
					</div>
					<?php
				} ?>
				<div class="col s3 i5">
					<h6 class="titulo second_cell center col s12 <?php echo ($view['state'] == 1)? "color_letra_secundario" : "color_letra_danger" ?>"><?php echo $view['note_received']; ?></h6>
				</div>
			</div>
			<?php
		}?>	
	</div>
	<div class="row">
		<div class="export">
			<a href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/expor_pdf.php" class="btn btn-success hide" target="_blank" id="new_impresion">Imprimir
				<i class="material-icons left" >print</i>
			</a>
			<button class="btn generar_pdf btn-primary" target="_blank" id="generar_pdf">
				Generar PDF
				<i class="material-icons left" >insert_drive_file</i>
			</button>
		</div>
	</div>
	<?php
	}else{ ?>
		<h5 class="col s12 centrar color_letra_secundario">No se obtuvieron resultados</h5>
	<?php
	}
?>
