<?php 
	foreach ($retorno_stock as $key => $value) { ?>
		<div class="row" id="">
				<section>
					<form action="<?php $_SERVER['DOCUMENT_ROOT'] ?>/php/stock/update_stock.php" class="update_info" accept-charset="utf-8">
					         <input id="nombre_producto" type="hidden" class="validate editar_info" name="id_stock" autocomplete="off" value="<?php echo $value['id_stock'] ?>"  readonly="readonly">
					    <h6 class="titulo">	
							<?php echo $value['name_product']." - ". $value['name_cellar']; ?>
					    </h6>

						<div class="input-field col s4 hide oculto">
					           <?php require($_SERVER['DOCUMENT_ROOT'].'/php/products/view_selects_products.php'); ?>
					    </div>

						<div class="input-field col s4">
					           <i class="material-icons prefix">account_circle</i>
					           <input id="nombre_producto" type="text" class="validate editar_info" name="nombre_lote" autocomplete="off" value="<?php echo $value['nom_lot'] ?>"  readonly="readonly">
					           <label for="nombre_producto" class="active">Lote</label>
					    </div>

						<div class="input-field col s4 m2">
					        <i class="material-icons prefix">account_circle</i>
					        <input id="nombre_producto" type="text" class="validate editar_info" name="amount" autocomplete="off" value="<?php echo $value['amount'] ?>"  readonly="readonly">
					         <label for="nombre_producto" class="active">Cantidad</label>
					    </div>


						<div class="input-field col s4 m3">
					        <i class="material-icons prefix">account_circle</i>
					        <input id="nombre_producto" type="text" class="validate editar_info" name="expiration" autocomplete="off" value="<?php echo $value['expiration_date'] ?>"  readonly="readonly">
					        <label for="nombre_producto" class="active">Fecha Vencimiento</label>
					    </div>


						<div class="input-field col s4 m3 hide oculto">
					        <i class="material-icons prefix">account_circle</i>
					        <input id="nombre_producto" type="text" class="validate editar_info" name="expiration_create" autocomplete="off" value="<?php echo $value['expiration_create'] ?>"  readonly="readonly">
					        <label for="nombre_producto" class="active">Fecha Creacion</label>
					    </div>



						<div class="input-field col s4 hide oculto">
					        <i class="material-icons prefix">account_circle</i>
					        <input id="nombre_producto" type="text" class="validate editar_info" name="comercializadora" autocomplete="off" value="<?php echo $value['comercializadora'] ?>"  readonly="readonly">
					        <label for="nombre_producto" class="active">Comercializadora</label>
					    </div>

					    <div class="action col s12 m3 centrar">
					       <button class="waves-effect waves-light btn btn-success hide actualizar_info">
					        <i class="material-icons left">near_me</i>Guardar
					       </button>

					       <button class="waves-effect waves-light btn btn-primary editar_info">
					        <i class="material-icons left">cached</i>Editar
					       </button>
					    </div>
					</form>
				</section>	    

		</div>
		<?php  
	}
?>
<div class="paginacion col m12">
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/php/paginator/index.php'); ?>
</div>