<?php 
if (count($retorno_stock) > 0) {
	foreach ($retorno_stock as $key => $value) { ?>
		<div class="row" id="">
			<h6 class="titulo paddin1 <?php echo $fondo ?> center">
				Actualizar Informacion de <?php echo $value['name_product'] ?>
			</h6>
			<section>
				<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/stock/update_stock.php" class="update_info" accept-charset="utf-8">
				         <input id="nombre_producto" type="hidden" class="validate editar_info" name="id_stock" autocomplete="off" value="<?php echo $value['id_stock'] ?>"  readonly="readonly">
				    <h6 class="titulo">	
						<?php echo $value['name_product']." - ". $value['name_cellar']; ?>
				    </h6>

					<div class="input-field col s4 m4">
				           <?php require($_SERVER['DOCUMENT_ROOT'].'/php/products/view_selects_products.php'); ?>
				    </div>

					<div class="input-field col s4 m4">
				           <i class="material-icons prefix">dashboard</i>
				           <input id="lote" type="text" class="validate editar_info" name="nombre_lote" autocomplete="off" value="<?php echo $value['nom_lot'] ?>"  readonly="readonly">
				           <label for="lote" class="active">Lote</label>
				    </div>
					<div class="input-field col s4  m4">
				        <i class="material-icons prefix">filter_9_plus</i>
				        <input id="cantidad" type="text" class="validate editar_info" name="amount" autocomplete="off" value="<?php echo $value['amount'] ?>"  readonly="readonly">
				         <label for="cantidad" class="active">Cantidad</label>
				    </div>
					<div class="input-field col s4">
			        	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php/measure/get_measure.php'); ?>
			        </div>

					<div class="input-field col s4  m4 ">
				        <i class="material-icons prefix">date_range</i>
				        <input id="expiration" type="text" class="validate datepicker editar_info" name="expiration" autocomplete="off" value="<?php echo $value['expiration_date'] ?>"  readonly="readonly">
				        <label for="expiration" class="active">Fecha Vencimiento</label>
				    </div>
				    <div class="input-field col s3 m4">
				    	<i class="material-icons prefix">thumbs_up_down</i>
					    <select name="estado">
						      <option value="" disabled selected>Estado</option>
						      <option value="0" <?php echo ($estado == "0") ? "selected"  : "" ?>>Inactivo</option>
						      <option value="1" <?php echo ($estado == "1") ? "selected"  : "" ?>>Activo</option>
					    </select>
					    <label>Estado</label>
					</div>
					<div class="input-field col s4">
				        <i class="material-icons prefix">home</i>
				        <input id="nombre_producto" type="text" class="validate editar_info" name="comercializadora" autocomplete="off" value="<?php echo $value['comercializadora'] ?>"  readonly="readonly">
				        <label for="nombre_producto" class="active">Comercializadora</label>
				    </div>
				    <?php 
				    	if ( $_SESSION["id_user_activo_role"] != "E_1_S1" || $_SESSION["id_user_activo_role"] != "A1-_1B") { ?>
				    		<div class="action col s12 centrar">
						       <button class="waves-effect waves-light btn btn-success hide actualizar_info">
						        <i class="material-icons left">near_me</i>Guardar
						       </button>

						       <button class="waves-effect waves-light btn btn-primary editar_info">
						        <i class="material-icons left">cached</i>Editar
						       </button>
						    </div>
				    		<?php 
				    	}
				    ?>
				    
				</form>
			</section>	    
		</div>
		<div class="col s6" id="view_graphics">
			<h6 class="titulo paddin1 <?php echo $fondo ?> center">
				Grafica
			</h6>
    		<?php
    		 	require_once($_SERVER['DOCUMENT_ROOT']."/php/stock/graphics_pie.php"); 
    		 ?>
    	</div>
		<?php
	}
}else{ ?>
	<h5 class="col s12 centrar color_letra_secundario">No se obtuvieron resultados</h5>
	<?php  
}
?>