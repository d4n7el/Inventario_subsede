<div class="row">
	<div class="alternos col s12">
		<button type="" class="waves-effect col s3 flujo_alterno waves-light btn btn-success" ruta="../php/products/create_product.php" data-target="modal_center_two">Crea un producto
		            <i class="material-icons left">add</i>
		</button>
		<button type="" class="waves-effect col s3 flujo_alterno waves-light btn btn-success" ruta="../php/products/create_product.php" data-target="modal_center_two">Crea un Stock
		            <i class="material-icons left">add</i>
		</button>
		<button class="waves-effect waves-light btn btn-primary col s3 " id="view_list_exit" data-target="modal_right" >
				<i class="material-icons left color_letra_secundario">visibility</i>Listado salida ()
		</button>
	</div>
</div>
<div class="row ">
	<form action="<?php $_SERVER['DOCUMENT_ROOT']?>/php/stock/search_stock_exit.php" class="search_exit_plant">			
		<div class="input-field col s12 m6 paddin2">
	        <i class="material-icons prefix">send</i>
	        <input id="search" type="text" class="validate" name="search" value="<?php echo ($stock_search == "%%") ? "" : $stock_search  ?>" autocomplete="off" required>
	        <label for="search" class="active">Nombre del equipo</label>
	    </div>
	    <input type="submit" class="hide">
	</form>
</div>
<div class="list_stock_exit col s12">
	<?php  
	if (count($retorno_stock) > 0) {
		$category = new Products();
		foreach ($retorno_stock as $key => $stock_search) {  
			$fondo = $category->category_color($stock_search['toxicological']);?>
			<div class="col s12 m12 l4" id="<?php echo $stock_search['id_stock']."_".$stock_search['amount'] ?>" style="padding: 0px;">
	          	<div class="card">
	          		<div class="input-field col s12 m12 hide cantidad">
			            <input id="cantidad" type="number" class="validate search" name="cantidad[]" autocomplete="off" min="0" max="<?php echo $stock_search['amount'] ?>" required>
			            <label for="cantidad" class="">disponible <?php echo $stock_search['amount']; ?></label>
		        	</div>
		        	<div class="input-field col s12 m12 hide cantidad">
			            <input id="nota" type="text" class="validate search" name="nota[]" autocomplete="off"  required>
			            <label for="nota" class="">Nota</label>
		        	</div>
	           		<div class="card-content white-text">
              			<p class="color_letra_secundario center">Equipo : <?php echo $stock_search['name_product']; ?></p>
              			<p class="color_letra_secundario center">Bodega : <?php echo $stock_search['name_cellar']; ?></p>
              			<p class="color_letra_secundario center">Lote : <?php echo $stock_search['nom_lot']; ?></p>
              			<p class="color_letra_secundario center">Disponible : <?php echo $stock_search['amount']; ?></p>

              			<input type="hidden" name="lote_id[]" value="<?php echo $stock_search['id_stock'] ?>" readonly>
              			<input type="hidden" name="producto_id[]" value="<?php echo $stock_search['id_product'] ?>" readonly>
      					<a class="btn centrar <?php echo ($stock_search['toxicological'] != "No")? $fondo: "btn-success" ?> halfway-fab waves-effect waves-light  add_exit_plant" divs="<?php echo $stock_search['id_stock']."_".$stock_search['amount'] ?>">
      						Añadir a salida
      					</a>
      					<a class="btn centrar <?php echo ($stock_search['toxicological'] != "No")? $fondo: "btn-success" ?>  halfway-fab waves-effect hide waves-light  delete_exit_plant" divs="<?php echo $stock_search['id_stock']."_".$stock_search['amount'] ?>">
      						Elimiinar de salida
      					</a>
	            	</div>
	          	</div>
	        </div>
	        <?php
		}
	}else{ ?>
		<h6 class="col s12 paddin1 center color_letra_secundario"> 
			No se encontraron resultados
		</h6>
		<?php
	} ?>
</div>

