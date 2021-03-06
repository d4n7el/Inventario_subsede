<?php 
	class Stock{
		private $bd;
		private $retorno;
		private $zone;

		public function __construct(){
			session_start();
			require_once($_SERVER['DOCUMENT_ROOT'].'/php/conexion.php');
			$this->db = Conexion::conect();
			$this->retorno = Array();
			$this->zone = $_SESSION["user_zone"];
		}
		public function insert_stock($id_product,$nom_lot,$amount,$expiration,$comercializadora,$unidad_medida,$id_user){
			try {
				$sql_consult = $this->db->prepare('INSERT INTO stock (id_product,nom_lot,amount,expiration_date,comercializadora,amount_income,unit_measure,id_user_create) VALUES (?,?,?,?,?,?,?,?)'  );
				$sql_consult->execute(array($id_product,$nom_lot,$amount,$expiration,$comercializadora,$amount,$unidad_medida,$id_user));
				$result = $this->db->lastInsertId();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	 $e->getMessage();
        	}
		}
		public function get_search_stock($id_stock,$lote,$cellar,$product,$casa,$fecha_inicial,$fecha_final,$vencimiento,$estado,$limit,$offset){
			try {
				$_SESSION["exporExcel"] = array(
					'datos' => array('Producto','Bodega','Vencimiento','Cantidad','Medida','Lote','Comercializadora'),
					'sql' => "SELECT name_product, name_cellar, expiration_date,amount, name_measure , nom_lot, comercializadora FROM get_stock WHERE id_stock LIKE '$id_stock' AND nom_lot LIKE '$lote' AND name_cellar LIKE'$cellar' AND  name_product LIKE '$product' AND comercializadora LIKE '$casa' AND expiration_date LIKE '$vencimiento' AND expiration_create BETWEEN '$fecha_inicial' AND '$fecha_final' AND state LIKE $estado AND zone = '$this->zone' ORDER BY id_stock"
				);
				$sql = "SELECT * FROM get_stock WHERE id_stock LIKE '$id_stock' AND nom_lot LIKE '$lote' AND name_cellar LIKE'$cellar' AND  name_product LIKE '$product' AND comercializadora LIKE '$casa' AND expiration_date LIKE '$vencimiento' AND expiration_create BETWEEN '$fecha_inicial' AND '$fecha_final' AND state LIKE $estado AND zone = '$this->zone' ORDER BY id_stock DESC LIMIT $limit OFFSET $offset" ;
				$sql_consult = $this->db->prepare($sql);
				$sql_consult->execute();
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function index_exit_stock($search){
			try {
				$sql = "SELECT * FROM get_stock WHERE nom_lot LIKE ? || name_cellar LIKE ? ||  name_product LIKE ? AND state LIKE 1 AND zone = '$this->zone'  ORDER BY id_stock DESC LIMIT 20" ;
				$sql_consult = $this->db->prepare($sql);
				$sql_consult->execute(array("%".$search."%","%".$search."%","%".$search."%"));
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function get_search_stock_id($id_stock){
			try {
				$sql = "SELECT * FROM get_stock WHERE id_stock = '$id_stock'" ;
				$sql_consult = $this->db->prepare($sql);
				$sql_consult->execute();
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function graphics_pie($id_producto){
			try {
				$sql_consult = $this->db->prepare("SELECT products.name_product, SUM(amount) as count, measure.prefix_measure FROM products INNER JOIN stock ON products.id_product = stock.id_product INNER JOIN measure ON stock.unit_measure  = measure.id_measure WHERE products.zone = '$this->zone' GROUP BY products.id_product UNION SELECT planta_stock.prefix_measure, products.name_product, COUNT(id_stock) as count FROM products INNER JOIN planta_stock ON products.id_product = planta_stock.id_product GROUP BY products.id_product");
				$sql_consult->execute(array($id_producto));
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	echo $e->getMessage();
        	}
		}
		public function count_stock($id_stock,$lote,$cellar,$product,$casa,$vencimiento,$fecha_inicial,$fecha_final,$estado){
			try {
				$sql = "SELECT COUNT(id_stock) as count FROM get_stock WHERE id_stock LIKE '$id_stock' AND nom_lot LIKE '$lote' AND name_cellar LIKE'$cellar' AND  name_product LIKE '$product' AND comercializadora LIKE '$casa' AND expiration_date LIKE '$vencimiento' AND creation_date BETWEEN '$fecha_inicial' AND '$fecha_final' AND state LIKE $estado  AND zone = '$this->zone'";
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
				$sql_consult = $this->db->prepare("SELECT * FROM stock INNER JOIN measure ON stock.unit_measure = measure.id_measure WHERE id_product = ? AND state = 1 " );
				$sql_consult->execute(array($id_product));
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function update_stock($id_stock,$id_product,$nom_lot,$amount,$expiration,$state,$comercializadora,$unidad_medida){
			try {
				$sql_consult = $this->db->prepare("UPDATE stock SET id_product = ?, nom_lot = ? , amount = ?, expiration_date = ?,state = ?, comercializadora  = ?, unit_measure = ?  WHERE id_stock = ? ");
	            if ($sql_consult->execute(array($id_product,$nom_lot,$amount,$expiration, $state, $comercializadora,$unidad_medida,$id_stock))) {
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
