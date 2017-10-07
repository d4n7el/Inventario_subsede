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
		public function get_search_stock($limit,$offset){
			try {
				$sql_consult = $this->db->prepare("SELECT * FROM stock INNER JOIN products ON stock.id_product = products.id_product INNER JOIN cellar ON products.id_cellar = cellar.id_cellar ORDER BY stock.expiration_create LIMIT $limit OFFSET $offset" );
				$sql_consult->execute();
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function get_stock($id_product){
			try {
				$sql_consult = $this->db->prepare("SELECT * FROM stock WHERE id_product = ? " );
				$sql_consult->execute(array($id_product));
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function update_stock($id_stock,$id_product,$nom_lot,$amount,$expiration,$expiration_create,$comercializadora){
			try {
				$sql_consult = $this->db->prepare('UPDATE stock SET id_product = ?, nom_lot = ? , amount = ?, expiration_date = ?, expiration_create = ?, comercializadora  = ?  WHERE id_stock = ? ');
	            if ($sql_consult->execute(array($id_product,$nom_lot,$amount,$expiration, $expiration_create, $comercializadora,$id_stock))) {
	            	return 1;
	            }else{
	            	return 0;
	            }
	            $this->db = null;
            } catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function count_stock(){
			try {
				$sql_consult = $this->db->prepare("SELECT COUNT(id_stock) AS count FROM stock " );
				$sql_consult->execute();
				$result = $sql_consult->fetch();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	echo $e->getMessage();
        	}
		}


	}
?>
