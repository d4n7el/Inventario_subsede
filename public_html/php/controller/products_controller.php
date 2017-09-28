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
		public function get_products($limit, $offset){
			try {
				$sql_consult = $this->db->prepare("SELECT * FROM products LIMIT $limit OFFSET $offset" );
				$sql_consult->execute();
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function count_products(){
			try {
				$sql_consult = $this->db->prepare("SELECT COUNT(id_product) AS count FROM products " );
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
