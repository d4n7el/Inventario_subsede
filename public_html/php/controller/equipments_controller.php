<?php 
	class Equipments{
		private $bd;
		private $retorno;

		public function __construct(){
			require_once($_SERVER['DOCUMENT_ROOT'].'/php/conexion.php');
			$this->db = Conexion::conect();
			$this->retorno = Array();
		}
		public function insert_equipment($equipo,$marca,$cantidad_total,$cantida_disponible,$bodega,$id_user){
			try {
				$sql_consult = $this->db->prepare('INSERT INTO equipments (name_equipment,mark,total_quantity,quantity_available,id_cellar,id_user_create) VALUES (?,?,?,?,?,?)'  );
				$sql_consult->execute(array($equipo,$marca,$cantidad_total,$cantida_disponible,$bodega,$id_user));
				$result = $this->db->lastInsertId();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function get_equipments(){
			try {
				$sql_consult = $this->db->prepare("SELECT * FROM equipments" );
				$sql_consult->execute();
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function get_equipments_pag($limit,$offset){
			try {
				$sql_consult = $this->db->prepare("SELECT * FROM equipments LIMIT $limit OFFSET $offset" );
				$sql_consult->execute();
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}

		public function get_cant_equipment($ids){
			try {
				$sql_consult = $this->db->prepare("SELECT quantity_available, id_equipment FROM equipments WHERE $ids" );
				$sql_consult->execute();
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function count_equipments(){
			try {
				$sql_consult = $this->db->prepare("SELECT COUNT(id_equipment) AS count FROM equipments " );
				$sql_consult->execute();
				$result = $sql_consult->fetch();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}

		public function search_equipment($equipo,$marca,$fecha_inicial,$fecha_final){
			try {
				$sql="SELECT * FROM search_equipment WHERE name_equipment LIKE '%$equipo%' AND mark LIKE '%$marca%' AND DATE(create_date) BETWEEN '$fecha_inicial' AND '$fecha_final' ORDER BY id_equipment " ;
				$sql_consult = $this->db->prepare($sql);
				$sql_consult->execute();
				$result = $sql_consult->fetch();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function update_equipment($equipo,$marca,$cantidad_total,$cantida_disponible,$bodega,$id_user,$id_equipo){
			try {
				$sql_consult = $this->db->prepare('UPDATE equipments SET name_equipment = ?, mark = ?, total_quantity =?, quantity_available =?, id_cellar = ?, id_user_create = ? WHERE id_equipment = ? ');
	            if ($sql_consult->execute(array($equipo,$marca,$cantidad_total,$cantida_disponible,$bodega,$id_user,$id_equipo))) {
	            	return 1;
	            }else{
	            	return 0;
	            }
	            $this->db = null;
            } catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function exit_equipment_master($id_user_receives,$id_user_delivery,$nom_receive){

			try {
				$sql_consult = $this->db->prepare('INSERT INTO exit_equipment_master (id_user_receives,id_user_delivery,name_user_receive) VALUES (?,?,?)'  );
				$sql_consult->execute(array($id_user_receives,$id_user_delivery,$nom_receive));
				$result = $this->db->lastInsertId();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	 $e->getMessage();
        	}
		}
		public function exit_equipment_detall($valores_insert){

			try {
				$sql_consult = $this->db->prepare("INSERT INTO exit_teams_detall (id_exit,id_equipment,quantity,note) VALUES $valores_insert");
				$sql_consult->execute();
				$result = $this->db->lastInsertId();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	 $e->getMessage();
        	}
		}

		public function get_exit_equipments_count($team,$cedula ,$fecha_inicial,$fecha_final){
			try {
				$sql_consult = $this->db->prepare("SELECT COUNT(id_exit_detall) as count FROM exit_equipment_master INNER JOIN exit_teams_detall ON exit_equipment_master.id_exit = exit_teams_detall.id_exit INNER JOIN equipments ON exit_teams_detall.id_equipment = equipments.id_equipment INNER JOIN user ON exit_equipment_master.id_user_delivery = user.id_user WHERE name_equipment LIKE ?  AND id_user_receives LIKE ? AND date_create BETWEEN '$fecha_inicial' AND '$fecha_final'" );
				$sql_consult->execute(array($team,$cedula));
				$result = $sql_consult->fetch();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}


		public function get_exit_equipments($team,$cedula,$fecha_inicial,$fecha_final,$limit,$offset){
			try {

				$sql = "SELECT exit_equipment_master.date_create, exit_teams_detall.id_exit, user.name_user, equipments.name_equipment, exit_teams_detall.quantity, exit_teams_detall.note, exit_teams_detall.id_exit_detall, exit_teams_detall.id_equipment, exit_equipment_master.name_user_receive FROM exit_equipment_master INNER JOIN exit_teams_detall ON exit_equipment_master.id_exit = exit_teams_detall.id_exit INNER JOIN equipments ON exit_teams_detall.id_equipment = equipments.id_equipment INNER JOIN user ON exit_equipment_master.id_user_delivery = user.id_user WHERE name_equipment LIKE ?  AND id_user_receives LIKE ? AND date_create BETWEEN '$fecha_inicial' AND '$fecha_final' LIMIT $limit OFFSET $offset ";
				$sql_consult = $this->db->prepare($sql);
				$sql_consult->execute(array($team,$cedula));
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
						
			} catch (PDOException $e) {
		           $e->getMessage();
		       }
		}


		public function view_equipment_detall($id_equipment_master, $id_detall = '%%', $id_equipment = '%%' ){
			try {
				$sql = "SELECT exit_equipment_master.date_create, exit_teams_detall.id_exit, user.name_user, equipments.name_equipment, exit_teams_detall.quantity, exit_teams_detall.note, exit_teams_detall.id_exit_detall, exit_teams_detall.id_equipment, exit_equipment_master.name_user_receive FROM exit_equipment_master INNER JOIN exit_teams_detall ON exit_equipment_master.id_exit = exit_teams_detall.id_exit INNER JOIN equipments ON exit_teams_detall.id_equipment = equipments.id_equipment INNER JOIN user ON exit_equipment_master.id_user_delivery = user.id_user WHERE  exit_teams_detall.id_exit = ? AND  exit_teams_detall.id_exit_detall LIKE ?";
				$sql_consult = $this->db->prepare($sql);
				$sql_consult->execute(array($id_equipment_master,$id_detall));
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
						
			} catch (PDOException $e) {
		           $e->getMessage();
		       }
		}



	}
?>
