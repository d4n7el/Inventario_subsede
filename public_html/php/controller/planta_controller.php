<?php 
	class Planta{
		private $bd;
		private $retorno;

		public function __construct(){
			require_once($_SERVER['DOCUMENT_ROOT'].'/php/conexion.php');
			$this->db = Conexion::conect();
			$this->retorno = Array();
		}
		public function index_stock_planta($group = "%%",$product = "%%",$cellar = "%%",$nameReceive = "%%", $prefix = "%%", $limit = "%%", $offset = "%%"){
			try {
				$groupBy = ($group == "%%") ?  '' : 'GROUP BY '.$group;
				$sum = ($group == "%%") ?  '' : ',SUM(quantity) as acumulado';
				$limit = ($limit == "%%") ?  '' : "LIMIT $limit";
				$offset = ($offset == "%%") ?  '' : 'OFFSET '.$offset;
				$sql =  "SELECT id_stock_plant, quantity, id_stock, name_user, last_name_user, name_receive,prefix_measure, id_exit_product, date_create, name_product, name_cellar,nom_lot, prefix_measure $sum FROM planta_stock WHERE name_product LIKE '$product' AND name_cellar LIKE '$cellar' AND name_receive LIKE '%$nameReceive%' AND prefix_measure LIKE '$prefix' ".$groupBy." ".$limit." ".$offset ;
				$sql_consult = $this->db->prepare($sql);
				$sql_consult->execute();
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function index_stock_planta_count($group = "%%",$product = "%%",$cellar = "%%",$nameReceive = "%%", $prefix = "%%", $limit = "%%", $offset = "%%"){
			try {
				$groupBy = ($group == "%%") ?  '' : 'GROUP BY '.$group;
				$sum = ($group == "%%") ?  '' : ',SUM(quantity) as acumulado';
				$limit = ($limit == "%%") ?  '' : "LIMIT $limit";
				$offset = ($offset == "%%") ?  '' : 'OFFSET '.$offset;
				$sql =  "SELECT COUNT(date_create) as count FROM planta_stock WHERE name_product LIKE '$product' AND name_cellar LIKE '$cellar' AND name_receive LIKE '$nameReceive' AND prefix_measure LIKE '$prefix' ";
				$sql_consult = $this->db->prepare($sql);
				$sql_consult->execute();
				$result = $sql_consult->fetch();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
	}
?>
