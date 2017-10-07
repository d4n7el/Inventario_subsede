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
				$limit = ($limit == "%%") ?  '' : 'LIMIT '.$limit;
				$offset = ($offset == "%%") ?  '' : 'OFFSET '.$offset;
				$sql =  "SELECT id_stock_plant, quantity, id_stock, name_user, last_name_user, name_receive, id_exit_product, date_create, name_product, name_cellar, prefix_measure ? FROM viewstockplanta WHERE name_product LIKE ? AND name_cellar LIKE ? AND name_receive LIKE ? AND prefix_measure LIKE ? ".$groupBy." ".$limit." ".$offset ;
				$sql_consult = $this->db->prepare($sql);
				$sql_consult->execute(array($sum,$product,$cellar,$nameReceive,$prefix));
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
	}
?>
