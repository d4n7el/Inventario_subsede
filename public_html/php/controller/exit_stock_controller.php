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
		public function show_exit_stock($id_exit_product){
			try {
				$sql_consult = $this->db->prepare("SELECT * FROM showexitstock WHERE id_exit_product_master = ?" );
				$sql_consult->execute(array($id_exit_product));
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	echo $e->getMessage();
        	}
		}
		public function get_exit_stock($id_exit_product,$limit = 100,$offset = 0){
			try {
				$sql_consult = $this->db->prepare("SELECT products.name_product, cellar.name_cellar, stock.nom_lot, exit_product_detalle.id_stock,exit_product_detalle.id_exit_product_master,exit_product_detalle.quantity,exit_product_detalle.note, exit_product_master.user_delivery, exit_product_master.user_receives,exit_product_master.destination,exit_product_master.delivery,exit_product_detalle.id_exit_product_detalle,stock.amount FROM exit_product_master INNER JOIN exit_product_detalle ON exit_product_master.id_exit_product = exit_product_detalle.id_exit_product_master INNER JOIN stock ON exit_product_detalle.id_stock = stock.id_stock INNER JOIN products ON stock.id_product = products.id_product INNER JOIN cellar ON products.id_cellar = cellar.id_cellar WHERE products.name_product LIKE '%%' AND cellar.name_cellar LIKE '%%' AND stock.nom_lot LIKE '%%' AND exit_product_master.destination LIKE '%%' AND exit_product_master.id_exit_product LIKE '$id_exit_product' AND exit_product_master.date_create BETWEEN '2017-09-30' AND '2017-10-10' ORDER BY exit_product_master.id_exit_product DESC LIMIT $limit OFFSET $offset" );
				$sql_consult->execute();
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	echo $e->getMessage();
        	}
		}
		public function get_exit_stock_count($id_exit_product){
			try {
				$sql_consult = $this->db->prepare("SELECT COUNT(exit_product_detalle.id_exit_product_detalle) AS count FROM exit_product_master INNER JOIN exit_product_detalle ON exit_product_master.id_exit_product = exit_product_detalle.id_exit_product_master INNER JOIN stock ON exit_product_detalle.id_stock = stock.id_stock INNER JOIN products ON stock.id_product = products.id_product INNER JOIN cellar ON products.id_cellar = cellar.id_cellar WHERE products.name_product LIKE '%%' AND cellar.name_cellar LIKE '%%' AND stock.nom_lot LIKE '%%' AND exit_product_master.destination LIKE '%%' AND exit_product_master.id_exit_product LIKE '$id_exit_product' AND exit_product_master.date_create BETWEEN '2017-09-30' AND '2017-10-05' ORDER BY exit_product_master.id_exit_product ASC" );
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
