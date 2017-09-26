<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/products_controller.php');
$id_cellars = $_REQUEST['id_cellars'];
$cellar = new Products;
$retorno_product = $cellar->get_products_cellar($id_cellars);  ?>
<i class="material-icons prefix">shopping_basket</i>
<?php 
if (isset($exit_product)) { ?>
	<select class="icons" name="product" id="id_cellar">
		<option value="" disabled selected>Seleccione el producto</option>
		<?php 
			foreach ($retorno_product as $product) { ?>
				<option value="<?php echo $product['id_product']; ?>"><?php echo $product['name_product']; ?></option>
				<?php  	 
			}
		?>	
	</select>
	<?php 
}else{ ?>
	<select class="icons" name="product" id="id_cellar_exit">
		<option value="" disabled selected>Seleccione el producto</option>
		<?php 
			foreach ($retorno_product as $product) { ?>
				<option value="<?php echo $product['id_product']; ?>"><?php echo $product['name_product']; ?></option>
				<?php  	 
			}
		?>	
	</select>
	<?php
}
?>



