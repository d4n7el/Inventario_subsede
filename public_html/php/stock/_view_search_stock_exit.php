<div class="row" id="view_actions">
	<div class="alternos col s12 m12 l3">
		<?php 
		if ($_SESSION["id_user_activo_role"] != 'E_1_S1' AND $_SESSION["id_user_activo_role"] != 'A1-_1B') { ?>
			<button type="" class="waves-effect col s6 m4 l12 flujo_alterno waves-light btn btn-success" ruta="../php/products/create_product.php" data-target="modal_center_two">Crea un producto
			            <i class="material-icons color_letra_primario left">add</i>
			</button>
			<button type="" class="waves-effect col s6 m4 l12 flujo_alterno waves-light btn btn-success" ruta="../php/products/create_product.php" data-target="modal_center_two">Crea un Stock
			            <i class="material-icons color_letra_primario left">add</i>
			</button>
			<button type="" class="waves-effect col s12 m4 l12 flujo_alterno waves-light btn btn-success" ruta="../php/measure/create_measure.php" data-target="modal_center_two">Crea Medida
			    <i class="material-icons color_letra_primario left">add</i>
			</button>
			<?php  
		}
		?>
	</div>
	<div class="col s12 m6 l5" id="" style="margin-top: 2em">
		<div class="col s12 fondo_negro">
			<h6 class="color_letra_primario">
				¡Información de salida! 
			</h6>
		</div>
		<div class="col s12 destino_salida">
			<h6 class="">
				Destino: 
				<i class="material-icons col s2 right" >airport_shuttle</i> 
			</h6>
		</div>
		<div class="col s12">
			<h6 class="">
				<?php echo "Entrega: ". $_SESSION["name_user_activo"]." ".$_SESSION["last_name_user_activo"] ?>
				<i class="material-icons col s2 right" >account_box</i> 
			</h6>
		</div>
		<div class="col s12 recibe">
			<h6 class="">
				Recibe:
				<i class="material-icons col s2 right" >account_circle</i> 
			</h6>
		</div>
		<div class="alternos col s12 m12 l12 centrar">
			<button type="" class="waves-effect col s6 add_destinatario waves-light btn btn-primary" ruta="../php/_partials/add_destino.php" data-target="modal_center">Añadir destino
				<i class="material-icons color_letra_secundario left">airport_shuttle</i>
			</button>
			<button class="waves-effect waves-light btn btn-primary col s6 " id="view_list_exit" >
				<i class="material-icons left color_letra_secundario">visibility</i>Listado salida ()
			</button>
		</div>
	</div>
	<div class="col s12  m6 l4" style="margin-top: 2em">
	<form action="<?php $_SERVER['DOCUMENT_ROOT']?>/php/stock/search_stock_exit.php" class="search_exit_plant">			
		<div class="input-field col s12">
	        <i class="material-icons prefix">send</i>
	        <input id="search" type="text" class="validate" name="search" value="<?php echo ($stock_search == "%%") ? "" : $stock_search  ?>" autocomplete="off">
	        <label for="search" class="active">Nombre del producto</label>
	    </div>
	    <input type="submit" class="hide">
	</form>
</div>
</div>

<div class="list_stock_exit col s12" id="next_view_actions">
	<?php  
	if (count($retorno_stock) > 0) {
		$category = new Products();
		foreach ($retorno_stock as $key => $stock_search) {  
			$fondo = $category->category_color($stock_search['toxicological']);
			if ($stock_search['amount'] > 0 AND $stock_search['state'] == 1) { ?>
				<div class="col s12 m4 l3" id="<?php echo $stock_search['id_stock']."_".$stock_search['amount'] ?>" style="padding: 0px;">
		          	<div class="card">
		          		<div class="input-field col s12 m12 hide cantidad">
				            <input id="cantidad" type="number" class="validate search" name="cantidad[]" autocomplete="off" min="0" max="<?php echo $stock_search['amount'] ?>" required>
				            <label for="cantidad" class="">disponible <?php echo $stock_search['amount']; ?></label>
			        	</div>
			        	<div class="input-field col s12 m12 hide cantidad">
				            <input id="nota" type="text" class="validate search" name="nota[]" autocomplete="off"  required>
				            <label for="nota" class="">Nota</label>
			        	</div>
			        	<figure class="icon-cellar col s12 centrar">
			        		<img src="<?php echo $stock_search['icon_cellar'] ?>" alt="">
			        	</figure>
		           		<div class="card-content white-text">
	              			<p class="color_letra_secundario center">Producto : <?php echo $stock_search['name_product']; ?></p>
	              			<p class="color_letra_secundario center">Bodega : <?php echo $stock_search['name_cellar']; ?></p>
	              			<p class="color_letra_secundario center">Lote : <?php echo $stock_search['nom_lot']; ?></p>
	              			<p class="color_letra_secundario center">Disponible : <?php echo $stock_search['amount']; ?></p>

	              			<input type="hidden" name="lote_id[]" value="<?php echo $stock_search['id_stock'] ?>" readonly>
	              			<input type="hidden" name="producto_id[]" value="<?php echo $stock_search['id_product'] ?>" readonly>
	              			<div class="row btn-fijo">
		      					<a class="btn centrar <?php echo ($stock_search['toxicological'] != "No")? $fondo: "btn-success" ?> halfway-fab waves-effect waves-light  add_exit_plant col s12" divs="<?php echo $stock_search['id_stock']."_".$stock_search['amount'] ?>">
		      						<i class="material-icons left color_letra_primario">add</i>
		      					</a>
	      					</div>
	      					<div class="row btn-fijo">
		      					<a class="btn centrar <?php echo ($stock_search['toxicological'] != "No")? $fondo: "btn-success" ?>  halfway-fab waves-effect hide waves-light  delete_exit_plant col s12" divs="<?php echo $stock_search['id_stock']."_".$stock_search['amount'] ?>">
		      						<i class="material-icons left color_letra_primario">clear</i>
		      					</a>
		      				</div>
		            	</div>
		          	</div>
		        </div>
	        	<?php
	        }
		}
	}else{ ?>
		<h4 class="col s12 fondo_claro color_letra_primario center">
			<i class="material-icons  color_letra_primario">warning</i> No se encontraron resultados
		</h4>
		<?php
	} ?>
</div>

