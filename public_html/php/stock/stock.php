<?php  
	session_start();
	if (isset($_SESSION["id_user_activo"])) {
?>
		<div class="row">
		    <div class="formulario col m6 offset-m3">
		    	<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/stock/new_stock.php" class="create_info">
  					<div class="input-field col s12 m12" id="stock">
			        	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php/cellars/_view_cellar_select.php'); ?>
			        </div>

			        <div id="mostrar_productos">
						
			        </div>

			        <div id="formulario">
					<div class="input-field col s12 m12">
			            <i class="material-icons prefix">account_circle</i>
			            <input id="nombre_lote" type="text" class="validate" name="nombre_lote" autocomplete="off" required>
			            <label for="nombre_lote" class="">Lote</label>
			        </div>

					<div class="input-field col s12 m12">
			            <i class="material-icons prefix">account_circle</i>
			            <input id="cantidad" type="text" class="validate" name="amount" autocomplete="off" required>
			            <label for="cantidad" class="">Cantidad</label>
			        </div>


					<div class="input-field col s12 m12">
			            <i class="material-icons prefix">account_circle</i>
			            <input id="fecha_vencimiento" type="text" class="datepicker" name="expiration" autocomplete="off" required>
			            <label for="fecha_vencimiento" class="">Fecha_vencimiento</label>
			        </div>			        



					<div class="input-field col s12 m12">
			            <i class="material-icons prefix">account_circle</i>
			            <input id="fecha_creacion" type="text" class="datepicker" name="expiration_create" autocomplete="off" required>
			            <label for="fecha_creacion" class="">Fecha Creacion</label>
			        </div>


					<div class="input-field col s12 m12">
			            <i class="material-icons prefix">account_circle</i>
			            <input id="Comercializadora" type="text" class="validate" name="comercializadora" autocomplete="off" required>
			            <label for="Comercializadora" class="">Casa Comercializadora</label>
			        </div>			        			        

			        
			        <div class="action col m12">
			        	<button class="waves-effect waves-light btn btn-primary">
			        		<i class="material-icons left">near_me</i>Guardar
			        	</button>
			        </div>	
				</form>	
			        </div>
				</form>
		    </div>
		</div>
		<?php 
	}
	?>
