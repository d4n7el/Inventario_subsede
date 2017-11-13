<?php session_start() ?>
<div class="row" id="view_actions">
  <div class="alternos col s12 m4 l3">
    <?php 
    if ($_SESSION["id_user_activo_role"] != 'E_1_S1' AND $_SESSION["id_user_activo_role"] != 'A1-_1B') { ?>
      <button type="" class="waves-effect col s12 flujo_alterno waves-light btn btn-success" ruta="../php/products/create_product.php" data-target="modal_center_two">Crea un producto
                  <i class="material-icons color_letra_primario left">add</i>
      </button>
      <button type="" class="waves-effect col s12 flujo_alterno waves-light btn btn-success" ruta="../php/products/create_product.php" data-target="modal_center_two">Crea un Stock
                  <i class="material-icons color_letra_primario left">add</i>
      </button>
      <button type="" class="waves-effect col s12 flujo_alterno waves-light btn btn-success" ruta="../php/measure/create_measure.php" data-target="modal_center_two">Crea Medida
          <i class="material-icons color_letra_primario left">add</i>
      </button>
      <?php  
    }
    ?>
  </div>
  <div class="col s12 m4 l5" id="" style="margin-top: 2em">
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
  <div class="col s4" style="margin-top: 2em">
    <form action="<?php $_SERVER['DOCUMENT_ROOT']?>/php/plant/exit_plant.php" class="search_exit_plant">     
      <div class="input-field col s12">
            <i class="material-icons prefix">send</i>
            <input id="search" type="text" class="validate" name="search" value="<?php echo ($search == "%%") ? "" : $search  ?>" autocomplete="off">
            <label for="search" class="active">Nombre del producto</label>
        </div>
        <input type="submit" class="hide">
    </form>
  </div>
</div>
<div class="list_stock_exit col s12" id="next_view_actions">
	<?php  
	if (count($retorno_exit_planta) > 0) {  
		foreach ($retorno_exit_planta as $key => $exit) { 
			$vencimiento = date('Y-m-d', strtotime($exit['expiration_date']));
            $category = new Products();
            $fondo = $category->category_color($exit['toxicological'])?>
			<div class="col s12 m4 l3" id="<?php echo $exit['id_stock']."_".$exit['id_proceso']."_".$exit['quantity'] ?>" style="padding: 0px;">
          	<div class="card">
          		<div class="input-field col s12 m12 hide cantidad">
                    <input id="cantidad" step="0.01" type="number" class="validate search" name="cantidad[]" autocomplete="off" min="0" max="<?php echo $exit['quantity'] ?>" required>
                    <label for="cantidad" class="">disponible <?php echo $exit['quantity']." ".$exit['prefix_measure']; ?></label>
                </div>
                <div class="input-field col s12 m12 hide cantidad">
                    <input id="nota" type="text" class="validate search" name="nota[]" autocomplete="off">
                    <label for="nota" class="">Nota</label>
                </div>
                <figure class="icon-cellar col s12 centrar">
                    <img src="<?php echo $exit['icon_cellar'] ?>" alt="">
                </figure>
           		<div class="card-content white-text">
     				<h5 class="<?php echo ($fecha < $vencimiento) ? "color_letra_secundario" : "color_letra_danger" ?> center"><?php echo ($fecha < $vencimiento) ? "" : "Vencido" ?></h5>
        			<p class="<?php echo ($fecha < $vencimiento) ? "color_letra_secundario" : "color_letra_danger" ?> center"><?php echo "Producto: ".$exit['name_product'] ?></p>
        			<p class="<?php echo ($fecha < $vencimiento) ? "color_letra_secundario" : "color_letra_danger" ?> center"><?php echo "Bodega: ".$exit['name_cellar'] ?></p>
        			<p class="<?php echo ($fecha < $vencimiento) ? "color_letra_secundario" : "color_letra_danger" ?> center">Lote : <?php echo $exit['nom_lot']; ?></p>
        			<p class="<?php echo ($fecha < $vencimiento) ? "color_letra_secundario" : "color_letra_danger" ?> center">Cantidad : <?php echo $exit['quantity']; ?></p>
        			<p class="<?php echo ($fecha < $vencimiento) ? "color_letra_secundario" : "color_letra_danger" ?> center">Vencimiento : <?php echo $vencimiento; ?></p>
        			<input type="hidden" name="elements[]" value="<?php echo $exit['id_proceso'] ?>" readonly>
        			<input type="hidden" name="proceso[]" value="<?php echo $exit['proceso'] ?>" readonly>
        			<?php 
        			if ($fecha < $vencimiento) { ?>
                        <div class="row btn-fijo">
          					<a class="btn centrar col s12 <?php echo ($exit['toxicological'] == "No") ? "btn-success" : $fondo ?> halfway-fab waves-effect waves-light  add_exit_plant" divs="<?php echo $exit['id_stock']."_".$exit['id_proceso']."_".$exit['quantity'] ?>">
          						<i class="material-icons left color_letra_primario">add</i>
          					</a>
                        </div>
                        <div class="row btn-fijo">
          					<a class="btn centrar col s12 <?php echo ($exit['toxicological'] == "No") ? "btn-success" : $fondo ?>  halfway-fab waves-effect hide waves-light  delete_exit_plant" divs="<?php echo $exit['id_stock']."_".$exit['id_proceso']."_".$exit['quantity'] ?>">
          						<i class="material-icons left color_letra_primario ">clear</i>
          					</a>
                        </div>
        				<?php 
                    } ?>	
            	</div>
          	</div>
         </div>
        <?php
	   }
	}else{ ?>
        <h5 class="titulo col s12 center">no se encontraron resultados </h5>
        <?php
	} ?>
</div>

