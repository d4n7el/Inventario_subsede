<form action="<?php $_SERVER['DOCUMENT_ROOT']?>/php/plant/exit_plant.php" class="search_exit_plant">		
	<div class="input-field col s12 m12">
        <i class="material-icons prefix">send</i>
        <input id="search" type="text" class="validate" name="search" value="<?php echo ($search == "%%") ? "" : $search  ?>" autocomplete="off" required>
        <label for="search" class="active">Producto,Lote ó bodega</label>
    </div>
    <input type="submit" class="hide">
</form>
<div class="list_stock_exit col s12">
	<?php  
	if (count($retorno_exit_planta) > 0) {  
		foreach ($retorno_exit_planta as $key => $exit) { 
			$vencimiento = date('Y-m-d', strtotime($exit['expiration_date'])); ?>
			<div class="col s12 m12" id="<?php echo $exit['id_stock']."_".$exit['id_exit_product']."_".$exit['id_exit_product'] ?>">
	          	<div class="card" style="padding-top: 1em">
	          		<div class="input-field col s12 m12 hide cantidad">
			            <input id="cantidad" type="number" class="validate search" name="cantidad" autocomplete="off" min="0" max="<?php echo $exit['quantity'] ?>" required>
			            <label for="cantidad" class="">disponible <?php echo $exit['quantity']; ?></label>
		        	</div>
	           		<div class="card-content white-text">
	           				<h5 class="<?php echo ($fecha < $vencimiento) ? "color_letra_secundario" : "color_letra_danger" ?> center"><?php echo ($fecha < $vencimiento) ? "" : "Vencido" ?></h5>
	              			<p class="<?php echo ($fecha < $vencimiento) ? "color_letra_secundario" : "color_letra_danger" ?> center"><?php echo $exit['name_product'] ?></p>
	              			<p class="<?php echo ($fecha < $vencimiento) ? "color_letra_secundario" : "color_letra_danger" ?> center">Bodega : <?php echo $exit['name_cellar']; ?></p>
	              			<p class="<?php echo ($fecha < $vencimiento) ? "color_letra_secundario" : "color_letra_danger" ?> center">Lote : <?php echo $exit['nom_lot']; ?></p>
	              			<p class="<?php echo ($fecha < $vencimiento) ? "color_letra_secundario" : "color_letra_danger" ?> center">Cantidad : <?php echo $exit['quantity']; ?></p>
	              			<input type="hidden" name="elements[]" value="<?php echo $exit['id_stock'] ?>" readonly>
	              			<input type="hidden" name="id_master[]" value="<?php echo $exit['id_exit_product'] ?>" readonly>
	              			<input type="hidden" name="id_master[]" value="<?php echo $exit['id_stock_plant'] ?>" readonly>
	              			<?php 
	              				if ($fecha < $vencimiento) { ?>
	              					<a class="btn-floating btn-primary halfway-fab waves-effect waves-light  add_exit_plant" divs="<?php echo $exit['id_stock']."_".$exit['id_exit_product']."_".$exit['id_exit_product'] ?>">
	              						<i class="material-icons color_letra_secundario left">add
	              						</i>
	              					</a>
	              					<a class="btn-floating btn-success  halfway-fab waves-effect hide waves-light  delete_exit_plant" divs="<?php echo $exit['id_stock']."_".$exit['id_exit_product']."_".$exit['id_exit_product'] ?>">
	              						<i class="material-icons color_letra_primario left">clear</i>
	              					</a>
	              					<?php 
	              				}
	              			?>
	            	</div>
	          	</div>
	        </div>
	        <?php
		}
	}else{


	} ?>
</div>

