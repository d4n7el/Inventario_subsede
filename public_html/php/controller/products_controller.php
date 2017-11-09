<?php 
	class Products{
		private $bd;
		private $retorno;
		private $zone;

		public function __construct(){
			session_start();
			require_once($_SERVER['DOCUMENT_ROOT'].'/php/conexion.php');
			$this->db = Conexion::conect();
			$this->zone = $_SESSION["user_zone"];
			$this->retorno = Array();
		}
		public function insert_product($producto,$descripcion,$id_user,$bodega,$categoria_tox,$code){
			try {
				$sql_consult = $this->db->prepare('INSERT INTO products (name_product,description_product,id_user_create,id_cellar,zone,toxicological_category,code) VALUES (?,?,?,?,?,?,?)');
				$sql_consult->execute(array($producto,$descripcion,$id_user,$bodega,$this->zone,$categoria_tox,$code));
				$result = $this->db->lastInsertId();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function category_color($category){
			switch ($category) {
			    case "II":
			        $fondo =  "category2 color_letra_primario";
			        break;
			    case "III":
			        $fondo =  "category3 color_letra_primario";
			        break;
			    case "IV":
			        $fondo =  "category4 color_letra_primario";
			        break;
			    default:
	       			$fondo =  "btn-primary color_letra_secundario";
			}
			return $fondo;
		}
		public function get_products_cellar($id_cellar){
			try {
				$sql_consult = $this->db->prepare("SELECT * FROM products WHERE id_cellar = ? " );
				$sql_consult->execute(array($id_cellar));
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function graphics_bar_total(){
			try {
				$sql_consult = $this->db->prepare("SELECT num_orders, name_product FROM products ORDER BY num_orders DESC LIMIT 20 ");
				$sql_consult->execute();
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function graphics_pie(){
			try {
				$sql_consult = $this->db->prepare("SELECT cellar.name_cellar, COUNT(id_product) as count FROM products INNER JOIN cellar ON products.id_cellar = cellar.id_cellar WHERE products.zone = '$this->zone'  GROUP BY products.id_cellar");
				$sql_consult->execute();
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function get_products($producto,$bodega,$fecha_inicial,$fecha_final,$limit, $offset){
			try {
				$sql = "SELECT * FROM get_products WHERE name_product LIKE '%$producto%' AND name_cellar LIKE '$bodega' AND DATE(creation_date) BETWEEN '$fecha_inicial' AND '$fecha_final' AND zone = '$this->zone' ORDER BY id_product DESC LIMIT $limit OFFSET $offset ";
				$sql_consult = $this->db->prepare($sql);
				$sql_consult->execute();
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	echo $e->getMessage();
        	}
		}
		public function get_product_id($id_product){
			try {
				$sql = "SELECT * FROM get_products WHERE id_product = ? LIMIT 1 ";
				$sql_consult = $this->db->prepare($sql);
				$sql_consult->execute(array($id_product));
				$result = $sql_consult->fetch();
				$this->db = null;
				return $result;
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function count_products($producto,$bodega,$fecha_inicial,$fecha_final){
			try {
				$sql = "SELECT COUNT(id_product) as count FROM get_products WHERE name_product LIKE '%$producto%' AND name_cellar LIKE '$bodega' AND DATE(creation_date) BETWEEN '$fecha_inicial' AND '$fecha_final' AND zone = '$this->zone' ORDER BY id_product DESC";
				$sql_consult = $this->db->prepare($sql);
				$sql_consult->execute();
				$result = $sql_consult->fetch();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function update_product($producto,$descripcion,$bodega,$id_user,$categoria_tox,$code,$id_producto){
			try {
				$sql_consult = $this->db->prepare('UPDATE products SET name_product = ?, description_product = ?, id_cellar = ?, id_user_create = ?, toxicological_category = ?, code = ? WHERE id_product = ? ');
	            if ($sql_consult->execute(array($producto,$descripcion,$bodega,$id_user,$categoria_tox,$code,$id_producto))) {
	            	return 1;
	            }else{
	            	return 0;
	            }
	            $this->db = null;
            } catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
	}
?>
