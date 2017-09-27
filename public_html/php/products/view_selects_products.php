<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/php/controller/products_controller.php');
(isset($_REQUEST['id_cellars']) ? $id_cellars = $_REQUEST['id_cellars'] : $id_cellars = $value['id_cellar'] );
$products = new Products;
$retorno_product = $products->get_products_cellar($id_cellars);  ?>
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
	<select class="icons" name="product" id="id_product_exit">
		<option value="" disabled selected>Seleccione el producto</option>
		<?php 
			foreach ($retorno_product as $product) { ?>
				<option <?php  echo $product['id_product'] == $value['id_product'] ? "selected" : '';?> value="<?php echo $product['id_product']; ?>"><?php echo $product['name_product']; ?></option>
				<?php  	 
			}
		?>	
	</select>
	<?php
}
?>



