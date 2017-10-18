<?php 
	class Stock{
		private $bd;
		private $retorno;

		public function __construct(){
			require_once($_SERVER['DOCUMENT_ROOT'].'/php/conexion.php');
			$this->db = Conexion::conect();
			$this->retorno = Array();
		}
		public function insert_stock($id_product,$nom_lot,$amount,$expiration,$comercializadora){
			try {
				$sql_consult = $this->db->prepare('INSERT INTO stock (id_product,nom_lot,amount,expiration_date,comercializadora) VALUES (?,?,?,?,?)'  );
				$sql_consult->execute(array($id_product,$nom_lot,$amount,$expiration,$comercializadora));
				$result = $this->db->lastInsertId();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	 $e->getMessage();
        	}
		}
		public function get_search_stock($id_stock,$lote,$cellar,$product,$casa,$fecha_inicial,$fecha_final,$vencimiento,$estado,$limit,$offset){
			try {
				$sql = "SELECT * FROM get_stock WHERE id_stock LIKE '$id_stock' AND nom_lot LIKE '$lote' AND name_cellar LIKE'$cellar' AND  name_product LIKE '$product' AND comercializadora LIKE '$casa' AND expiration_date LIKE '$vencimiento' AND creation_date BETWEEN '$fecha_inicial' AND '$fecha_final' AND state LIKE $estado ORDER BY id_stock DESC LIMIT $limit OFFSET $offset" ;
				$sql_consult = $this->db->prepare($sql);
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
				$sql_consult = $this->db->prepare("SELECT products.name_product, COUNT(id_stock) as count FROM products INNER JOIN stock ON products.id_product = stock.id_product GROUP BY products.id_product");
				$sql_consult->execute();
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function count_stock($id_stock,$lote,$cellar,$product,$casa,$vencimiento,$fecha_inicial,$fecha_final,$estado){
			try {
				$sql = "SELECT COUNT(id_stock) as count FROM get_stock WHERE id_stock LIKE '$id_stock' AND nom_lot LIKE '$lote' AND name_cellar LIKE'$cellar' AND  name_product LIKE '$product' AND comercializadora LIKE '$casa' AND expiration_date LIKE '$vencimiento' AND creation_date BETWEEN '$fecha_inicial' AND '$fecha_final' AND state LIKE $estado";
				$sql_consult = $this->db->prepare($sql);
				$sql_consult->execute();
				$result = $sql_consult->fetch();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	echo $e->getMessage();
        	}
		}
		public function get_stock($id_product){
			try {
				$sql_consult = $this->db->prepare("SELECT * FROM stock WHERE id_product = ? AND state = 1 " );
				$sql_consult->execute(array($id_product));
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function update_stock($id_stock,$id_product,$nom_lot,$amount,$expiration,$state,$comercializadora){
			try {
				$sql_consult = $this->db->prepare("UPDATE stock SET id_product = ?, nom_lot = ? , amount = ?, expiration_date = ?,state = ?, comercializadora  = ?  WHERE id_stock = ? ");
	            if ($sql_consult->execute(array($id_product,$nom_lot,$amount,$expiration, $state, $comercializadora,$id_stock))) {
	            	return 1;
	            }else{
	            	return 0;
	            }
	            $this->db = null;
            } catch (PDOException $e) {
            	echo $e->getMessage();
        	}
		}
		


	}
?>
