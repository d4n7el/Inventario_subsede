<?php 
	class Products{
		private $bd;
		private $retorno;

		public function __construct(){
			require_once($_SERVER['DOCUMENT_ROOT'].'/php/conexion.php');
			$this->db = Conexion::conect();
			$this->retorno = Array();
		}
		public function insert_product($producto,$descripcion,$unidad_medida,$id_user,$bodega){
			try {
				$sql_consult = $this->db->prepare('INSERT INTO products (name_product,description_product,unit_measure,id_user_create,id_cellar) VALUES (?,?,?,?,?)'  );
				$sql_consult->execute(array($producto,$descripcion,$unidad_medida,$id_user,$bodega));
				$result = $this->db->lastInsertId();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
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
		public function graphics_pie(){
			try {
				$sql_consult = $this->db->prepare("SELECT cellar.name_cellar, COUNT(id_product) as count FROM products INNER JOIN cellar ON products.id_cellar = cellar.id_cellar GROUP BY products.id_cellar");
				$sql_consult->execute();
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function get_products($producto,$bodega,$measure,$fecha_inicial,$fecha_final,$limit, $offset){
			try {
				$sql = "SELECT * FROM get_products WHERE name_product LIKE '%$producto%' AND name_cellar LIKE '$bodega' AND prefix_measure LIKE '$measure' AND DATE(creation_date) BETWEEN '$fecha_inicial' AND '$fecha_final' ORDER BY id_product DESC LIMIT $limit OFFSET $offset";
				$sql_consult = $this->db->prepare($sql);
				$sql_consult->execute();
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function count_products($producto,$bodega,$measure,$fecha_inicial,$fecha_final){
			try {
				$sql = "SELECT COUNT(id_product) as count FROM get_products WHERE name_product LIKE '%$producto%' AND name_cellar LIKE '$bodega' AND prefix_measure LIKE '$measure' AND DATE(creation_date) BETWEEN '$fecha_inicial' AND '$fecha_final' ORDER BY id_product DESC";
				$sql_consult = $this->db->prepare($sql);
				$sql_consult->execute();
				$result = $sql_consult->fetch();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function update_product($producto,$descripcion,$bodega,$id_user,$unidad_medida,$id_producto){
			try {
				$sql_consult = $this->db->prepare('UPDATE products SET name_product = ?, description_product = ?, id_cellar = ?, id_user_create = ?, unit_measure = ? WHERE id_product = ? ');
	            if ($sql_consult->execute(array($producto,$descripcion,$bodega,$id_user,$unidad_medida,$id_producto))) {
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
