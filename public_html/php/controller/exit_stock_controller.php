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
            	echo $e->getMessage();
        	}
		}
		public function insert_exit_product_detalle($value){
			try {
				$sql_consult = $this->db->prepare("INSERT INTO exit_product_detalle (id_stock,id_exit_product_master,quantity,note) VALUES $value");
				$sql_consult->execute();
				$result = $this->db->lastInsertId();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	echo $e->getMessage();
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
		public function update_exit_stock($cantidad,$id_master,$id_detalle,$id_user){
			try {
				$sql_consult = $this->db->prepare("CALL update_exit_stock(?,?,?,?,@retorno)" );
				$sql_consult->execute(array($cantidad,$id_master,$id_detalle,$id_user));
				$this->db = null;
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function show_exit_stock($id_exit_product,$id_exit_product_detalle = "%%"){
			try {
				$sql_consult = $this->db->prepare("SELECT * FROM show_exit_stock WHERE id_exit_product_master = ? AND id_exit_product_detalle LIKE ?" );
				$sql_consult->execute(array($id_exit_product,$id_exit_product_detalle));
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function get_exit_stock($id_exit_product = "%%",$destino = "%%",$product = "%%",$cellar = "%%",$lote = "%%",$fecha_inicial,$fecha_final,$limit = "%%",$offset = "%%"){
			try {
				$sql = "SELECT * FROM show_exit_stock WHERE name_product LIKE '$product' AND name_cellar LIKE '$cellar' AND nom_lot LIKE '$lote' AND destination LIKE '$destino' AND id_exit_product_master LIKE '$id_exit_product' AND date_create BETWEEN '$fecha_inicial' AND '$fecha_final' ORDER BY id_exit_product_master DESC LIMIT $limit OFFSET $offset";
				$sql_consult = $this->db->prepare($sql);
				$sql_consult->execute();
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function get_exit_stock_count($id_exit_product = "%%",$destino = "%%",$product = "%%",$cellar = "%%",$lote = "%%",$fecha_inicial,$fecha_final){
			try {
				$sql_consult = $this->db->prepare("SELECT COUNT(id_stock) as count FROM show_exit_stock WHERE name_product LIKE '$product' AND name_cellar LIKE '$cellar' AND nom_lot LIKE '$lote' AND destination LIKE '$destino' AND id_exit_product_master LIKE '$id_exit_product' AND date_create BETWEEN '$fecha_inicial' AND '$fecha_final'" );
				$sql_consult->execute();
				$result = $sql_consult->fetch();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function insert_stock_planta($value){
			try {
				$sql_consult = $this->db->prepare("INSERT INTO stock_plant (id_product,id_stock,id_exit_product,quantity) VALUES $value" );
				$sql_consult->execute();
				$result = $this->db->lastInsertId();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
	}
?>
