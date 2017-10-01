<?php 
	class ExitProduct{
		private $bd;
		private $retorno;

		public function __construct(){
			require_once($_SERVER['DOCUMENT_ROOT'].'/php/conexion.php');
			$this->db = Conexion::conect();
			$this->retorno = Array();
		}
		public function insert_exit_product($destino,$recive,$id_user,$name_recive){
			try {
				$sql_consult = $this->db->prepare('INSERT INTO exit_product_master (user_delivery,user_receives,destination,name_receive) VALUES (?,?,?,?)'  );
				$sql_consult->execute(array($id_user,$recive,$destino,$name_recive));
				$result = $this->db->lastInsertId();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function insert_exit_product_detalle($value){
			try {
				$sql_consult = $this->db->prepare("INSERT INTO exit_product_detalle (id_product,id_cellar,id_stock,id_exit_product_master,quantity,note) VALUES $value");
				$sql_consult->execute();
				$result = $this->db->lastInsertId();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function get_cant_stock($ids_cant_stock){
			try {
				$sql_consult = $this->db->prepare("SELECT amount, id_stock FROM stock WHERE $ids_cant_stock" );
				$sql_consult->execute();
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function insert_stock_planta($value){
			echo $value;
			try {
				$sql_consult = $this->db->prepare("INSERT INTO stock_plant (id_product,id_cellar,id_stock,id_exit_product,quantity) VALUES $value" );
				$sql_consult->execute();
				$result = $this->db->lastInsertId();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	echo $e->getMessage();
        	}
		}
	}
?>
