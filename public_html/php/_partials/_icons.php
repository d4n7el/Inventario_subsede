<h6 class="titulo fondo_negro center paddin1 color_letra_primario">seleccione un icono</h6>
<?php 
	$icons = array(
		'invert_colors' => 'invert_colors',
		'lightbulb_outline' => 'lightbulb_outline',
		'account_balance' => 'account_balance' ,
		'account_balance_wallet' => 'account_balance_wallet',
		'add_shopping_cart' => 'add_shopping_cart',
		'bug_report' => 'bug_report',
		'build' => 'build',
		'event_seat' => 'event_seat',
		'extension' => 'extension',
		'favorite' => 'favorite',
		'favorite_border' => 'favorite_border',
		'important_devices' => 'important_devices',
		'https' => 'https',
		'hourglass_empty' => 'hourglass_empty',
		'motorcycle' => 'motorcycle',
		'print' => 'print',
		'rowing' => 'rowing',
		'settings_input_component' => 'settings_input_component',
		'store' => 'store',
		'weekend' => 'weekend',
		'format_paint' => 'format_paint',
		'desktop_windows' => 'desktop_windows',
		'toys' => 'toys',
		'audiotrack' => 'audiotrack',
		'linked_camera' => 'linked_camera',
		'looks_one' => 'looks_one',
		'looks_two' => 'looks_two',
		'looks_3' => 'looks_3',
		'looks_4' => 'looks_4',
		'looks_5' => 'looks_5',
		'looks_6' => 'looks_6',
		'style' => 'style',
		'directions_bike' => 'directions_bike',
		'hotel' => 'hotel',
		'ev_station' => 'ev_station',
		'local_cafe' => 'local_cafe',
		'local_dining' => 'local_dining',
		'local_florist' => 'local_florist',
		'terrain' => 'terrain',
		'power' => 'power',
		'spa' => 'spa',
		'fitness_center' => 'fitness_center',
	); 
	$icons_two = array(
		1 => 'lacteos.svg' ,
		2 => 'pecuario.svg',
		3 => 'quimicos.svg',
		4 => 'fruver.svg',
		5 => 'carnicos.svg',
		6 => 'agroIndustria.svg',
		7 => 'agroInsumos.svg',
		8 => 'equipos.svg',
	); ?>
	<div class="col s6">
		<?php  
		foreach ($icons as $key => $icon) { ?>
			<i class="material-icons icons_select <?php echo (isset($tipoImage) and trim($tipoImage[0]) == 'icon' and $icon == trim($tipoImage[1])) ? 'iconActive' : "" ?> " name_icon="icon <?php echo $icon ?>" ><?php echo $icon ?></i>
			<?php
		} ?>
	</div>
	<div class="col s6">
	<?php  
		foreach ($icons_two as $key => $icon) { ?>
			<div class="col s6 icons_select centrar <?php echo (isset($tipoImage) and trim($tipoImage[0]) == 'image' and $icon == trim($tipoImage[1])) ? 'iconActive' : "" ?>"  name_icon="image <?php echo $icon ?>" style="max-height: 2em; min-height: 2em">
				<img src="<?php $_SERVER['DOCUMENT_ROOT'] ?> /image/<?php echo $icon ?>" style="width: 70%; ">
			</div>
			<?php
		} ?>
	</div>