<?php  
	session_start();
if (isset($_SESSION["id_user_activo"])) { 
	$col = (isset($_REQUEST['alterno']) ? "s12" : "s6" );?>
	<div class="row">
	    <div class="formulario col <?php echo $col ?>">
	    	<h6 class="color_letra_primario center paddin1 fondo_negro">
					Crear Stock
				</h6>
	    	<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/stock/new_stock.php" class="create_info">
					<div class="input-field col s12 m12" id="stock">
		        	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php/cellars/_view_cellar_select.php'); ?>
		        </div>

		        <div class="input-field col s12 m12" id="mostrar_productos">
					
		        </div>
		        <div id="formulario">
					<div class="input-field col s12 m12">
			            <i class="material-icons prefix">dashboard</i>
			            <input id="nombre_lote" type="text" class="validate" name="nombre_lote" autocomplete="off" required>
			            <label for="nombre_lote" class="">Lote</label>
			        </div>

					<div class="input-field col s12 m12">
			            <i class="material-icons prefix">filter_9_plus</i>
			            <input id="cantidad" type="number" min="0" class="validate" name="amount" autocomplete="off" required>
			            <label for="cantidad" class="">Cantidad</label>
			        </div>
					<div class="input-field col s12 m12">
			        	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php/measure/get_measure.php'); ?>
			        </div>
					<div class="input-field col s12 m12">
			            <i class="material-icons prefix">date_range</i>
			            <input id="fecha_vencimiento" type="text" class="datepicker" name="expiration" autocomplete="off" required>
			            <label for="fecha_vencimiento" class="">Fecha_vencimiento</label>
			        </div>			        

					<div class="input-field col s12 m12">
			            <i class="material-icons prefix">home</i>
			            <input id="Comercializadora" type="text" class="validate" name="comercializadora" autocomplete="off" required>
			            <label for="Comercializadora" class="">Casa Comercializadora</label>
			        </div>			        			        
			     
			        <div class="action col m12 centrar">
			        	<button class="waves-effect waves-light btn btn-primary">
			        		<i class="material-icons left">near_me</i>Guardar
			        	</button>
			        </div>	
			
		        </div>
		    </form>	
	    </div>
	    <?php
	    if (!isset($_REQUEST['alterno'])) { ?>
		    <div class="col s6" id="view_graphics">
	    		<?php require_once($_SERVER['DOCUMENT_ROOT']."/php/stock/graphics_pie.php") ?>
	    	</div>
    		<?php
		} ?>
	</div>
	<?php 
}	?>
