<?php 
	class Planta{
		private $bd;
		private $retorno;
		private $zone;

		public function __construct(){
			require_once($_SERVER['DOCUMENT_ROOT'].'/php/conexion.php');
			$this->db = Conexion::conect();
			$this->retorno = Array();
			$this->zone = $_SESSION["user_zone"];
		}
		public function index_stock_planta($group,$product,$cellar,$nameReceive, $prefix,$fecha_inicial,$fecha_final,$order, $limit, $offset){
			try {
				$orderBy = ($order == "%%") ?  'ORDER BY date_create DESC' : 'ORDER BY '.$order;
				$groupBy = ($group == "%%") ?  '' : 'GROUP BY '.$group;
				$sum = ($group == "%%") ?  '' : ',SUM(quantity) as acumulado';
				$limit = ($limit == "%%") ?  '' : "LIMIT $limit";
				$offset = ($offset == "%%") ?  '' : 'OFFSET '.$offset;
				$sql =  "SELECT proceso,state, quantity, id_proceso, name_receive,prefix_measure, DATE(date_create) as date_create, name_product,expiration_date, name_cellar,nom_lot, prefix_measure,toxicological,code $sum, id_stock FROM index_stock_plant WHERE name_product LIKE '$product' AND name_cellar LIKE '$cellar' AND name_receive LIKE '%$nameReceive%' AND prefix_measure LIKE '$prefix' AND date_create BETWEEN '$fecha_inicial' AND '$fecha_final' ".$groupBy." $orderBy ".$limit." ".$offset ;
				$sql_consult = $this->db->prepare($sql);
				$sql_consult->execute();
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	echo $e->getMessage();
        	}
		}
		public function index_stock_planta_count($group,$product,$cellar,$nameReceive,$prefix,$fecha_inicial,$fecha_final){
			try {
				$groupBy = ($group == "%%") ?  '' : 'GROUP BY '.$group;
				$sum = ($group == "%%") ?  '' : ',SUM(quantity) as acumulado';
				$sql =  "SELECT COUNT(quantity) as count FROM index_stock_plant WHERE name_product LIKE '$product' AND name_cellar LIKE '$cellar' AND name_receive LIKE '%$nameReceive%' AND prefix_measure LIKE '$prefix' AND date_create BETWEEN '$fecha_inicial' AND '$fecha_final' ";
				$sql_consult = $this->db->prepare($sql);
				$sql_consult->execute();
				$result = $sql_consult->fetch();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	echo $e->getMessage();
        	}
		}
		public function show_stock_planta($id_stock_plant,$id_stock ="%%"){
			try {
				$sql =  "SELECT * FROM planta_stock WHERE id_stock_plant = ? AND id_stock LIKE ? ORDER BY id_exit_product DESC";
				$sql_consult = $this->db->prepare($sql);
				$sql_consult->execute(array($id_stock_plant,$id_stock));
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function show_stock_planta_externo($fecha){
			try {
				$sql =  "SELECT * FROM get_stock WHERE DATE(expiration_create) = ? AND zone = '$this->zone'";
				$sql_consult = $this->db->prepare($sql);
				$sql_consult->execute(array($fecha));
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	echo $e->getMessage();
        	}
		}
		public function search_stock_planta($search){
			try {
				$search = ($search != "%%") ? "%".$search."%" : $search;
				$sql =  "SELECT * FROM index_stock_plant WHERE state = 1  AND quantity > 0 AND name_cellar LIKE ? OR state = 1  AND quantity > 0 AND name_product LIKE ? OR state = 1  AND quantity > 0 AND nom_lot LIKE ?";
				$sql_consult = $this->db->prepare($sql);
				$sql_consult->execute(array($search,$search,$search));
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function update_stock_plant($id_exit_product,$id_stock_plant,$stock,$cantidad,$id_user,$note,$proceso){
			try {
				$sql_consult = $this->db->prepare('CALL update_stock_plant (?,?,?,?,?,?,?,@retorno) ');
	            if ($sql_consult->execute(array($id_exit_product,$id_stock_plant,$stock,$cantidad,$id_user,$note,$proceso))) {
	            	$sql_consult = $this->db->prepare("SELECT @retorno as retorno" );
					$sql_consult->execute();
					$result = $sql_consult->fetch();
					$this->db = null;
	            	return $result;
	            }
            } catch (PDOException $e) {
            	echo $e->getMessage();
        	}
		}
	}
?>
