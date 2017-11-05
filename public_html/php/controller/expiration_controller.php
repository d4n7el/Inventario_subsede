<?php 
	class Expiration{
		private $bd;
		private $retorno;
		private $zone;

		public function __construct(){
			session_start();
			require_once($_SERVER['DOCUMENT_ROOT'].'/php/conexion.php');
			$this->zone = ($_SESSION["id_user_activo_role"] == "A_A-a_1") ? "A" : "B";
			$this->db = Conexion::conect();
			$this->retorno = Array();
		}
		public function new_expiration($id_stock,$nota,$id_user){
			try {
				$sql_consult = $this->db->prepare("CALL new_expiration (?,?,?,@retorno)");
				$sql_consult->execute(array($id_stock,$nota,$id_user));
				$sql_consult = $this->db->prepare("SELECT @retorno as retorno");
				$sql_consult->execute();
				$result = $sql_consult->fetch();
				$this->db = null;
				return $result;
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function expiration_count($fecha){
			try {
				$sql = "SELECT COUNT(stock.id_stock) as count FROM stock LEFT JOIN expiration_stock ON stock.id_stock =  expiration_stock.id_stock INNER JOIN products ON stock.id_product = products.id_product WHERE expiration_stock.id_stock is NUll AND stock.expiration_date < '$fecha' AND stock.amount > 0 AND products.zone = '$this->zone'" ;
				$sql_consult = $this->db->prepare($sql);
				$sql_consult->execute();
				$result = $sql_consult->fetch();
				$this->db = null;
				return $result;
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function index($filter,$fecha_inicial,$fecha_final,$expiration_date,$limit,$offset){
			try {
				$sql = "SELECT * FROM index_expiration_record WHERE creation BETWEEN '$fecha_inicial' AND '$fecha_final' AND name_product LIKE '%$filter%' LIMIT $limit OFFSET $offset " ;
				$sql_consult = $this->db->prepare($sql);
				$sql_consult->execute();
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function count_expiration_pag($filter,$fecha_inicial,$fecha_final,$expiration_date){
			try {
				$sql = "SELECT COUNT(nom_lot) as count FROM index_expiration_record WHERE creation BETWEEN '$fecha_inicial' AND '$fecha_final' AND name_product LIKE '%$filter%'" ;
				$sql_consult = $this->db->prepare($sql);
				$sql_consult->execute();
				$result = $sql_consult->fetch();
				$this->db = null;
				return $result;
			} catch (PDOException $e) {
            	echo $e->getMessage();
        	}
		}
		public function get_expiration($fecha){
			try {
				$sql = "SELECT stock.id_stock,stock.unit_measure,stock.unit_measure,stock.expiration_date, stock.nom_lot,stock.amount,products.name_product,cellar.name_cellar  FROM stock LEFT JOIN expiration_stock ON stock.id_stock =  expiration_stock.id_stock INNER JOIN products ON stock.id_product = products.id_product INNER JOIN cellar ON products.id_cellar = cellar.id_cellar WHERE expiration_stock.id_stock is NUll AND stock.expiration_date < '$fecha' AND stock.amount > 0 AND products.zone = '$this->zone'" ;
				$sql_consult = $this->db->prepare($sql);
				$sql_consult->execute();
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
	}
?>
