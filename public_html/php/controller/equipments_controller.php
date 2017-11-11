
<?php 
	class Equipments{
		private $bd;
		private $retorno;
		private $zone;

		public function __construct(){
			session_start();
			require_once($_SERVER['DOCUMENT_ROOT'].'/php/conexion.php');
			$this->zone = $_SESSION["user_zone"];
			$this->db = Conexion::conect();
			$this->retorno = Array();
		}
		public function insert_equipment($equipo,$marca,$cantidad_total,$cantida_disponible,$bodega,$id_user){
			try {
				$sql_consult = $this->db->prepare('INSERT INTO equipments (name_equipment,mark,total_quantity,quantity_available,id_cellar,id_user_create,zone) VALUES (?,?,?,?,?,?,?)'  );
				$sql_consult->execute(array($equipo,$marca,$cantidad_total,$cantida_disponible,$bodega,$id_user,$this->zone));
				$result = $this->db->lastInsertId();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function graphics_pie(){
			try {
				$sql_consult = $this->db->prepare("SELECT name_equipment, total_quantity AS count FROM equipments WHERE zone = '$this->zone' ORDER BY total_quantity DESC LIMIT 13 ");
				$sql_consult->execute();
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function get_equipments(){
			try {
				$sql_consult = $this->db->prepare("SELECT * FROM equipments WHERE zone = '$this->zone' " );
				$sql_consult->execute();
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function outside($id_equipment){
			try {
				$sql_consult = $this->db->prepare("SELECT SUM(quantity) AS count FROM exit_teams_detall INNER JOIN exit_equipment_master ON exit_teams_detall.id_exit = exit_equipment_master.id_exit WHERE id_equipment = ? AND exit_teams_detall.returned = 0" );
				$sql_consult->execute(array($id_equipment));
				$result = $sql_consult->fetch();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function update_equipment_available($equipo,$disponible,$nota,$proceso){
			try {
				$sql_consult = $this->db->prepare("CALL update_quantity_available(?,?,?,?,@retorno)");
	            $sql_consult->execute(array($equipo,$disponible,$nota,$proceso));
	            $sql_consults = $this->db->prepare("SELECT @retorno as retorno");
	            $sql_consults->execute();
	            $result = $sql_consults->fetch();
	            $this->db = null;
	            return $result;
            } catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function get_equipments_pag($id_equipment,$equipo,$marca,$fecha_inicial,$fecha_final,$limit,$offset){
			try {
				$sql_consult = $this->db->prepare("SELECT * FROM equipments  WHERE id_equipment LIKE ? AND name_equipment LIKE ? AND mark LIKE ? AND DATE(create_date) BETWEEN ? AND ? AND zone = '$this->zone' ORDER BY id_equipment LIMIT $limit OFFSET $offset " );

				$sql_consult->execute(array($id_equipment,$equipo,$marca,$fecha_inicial,$fecha_final));
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	echo $e->getMessage();
        	}
		}
		public function index_exit_equipments($equipo){
			try {
				$sql_consult = $this->db->prepare("SELECT * FROM equipments  WHERE name_equipment LIKE ? AND zone = '$this->zone' AND quantity_available > 0 LIMIT 20" );
				$sql_consult->execute(array("%".$equipo."%"));
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
		public function count_equipments($id_equipment,$equipo,$marca,$fecha_inicial,$fecha_final){
			try {
				$sql_consult = $this->db->prepare("SELECT COUNT(id_equipment) AS count FROM equipments WHERE id_equipment LIKE ? AND name_equipment LIKE ? AND mark LIKE ? AND DATE(create_date) BETWEEN ? AND ? AND zone = '$this->zone'" );
				$sql_consult->execute(array($id_equipment,$equipo,$marca,$fecha_inicial,$fecha_final));
				$result = $sql_consult->fetch();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}

		public function update_equipment($equipo,$marca,$cantidad_total,$bodega,$id_user,$id_equipo){
			try {
				$sql_consult = $this->db->prepare("CALL update_equipments(?,?,?,?,?,?,@retorno)");
	            	$sql_consult->execute(array($equipo,$marca,$cantidad_total,$bodega,$id_user,$id_equipo));
	            	$sql_consults = $this->db->prepare("SELECT @retorno as retorno");
		            $sql_consults->execute();
		            $result = $sql_consults->fetch();
	            	return $result;
	            	$this->db = null;
            } catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function exit_equipment_master($id_user_receives,$id_user_delivery,$nom_receive,$estado){
			try {
				$sql_consult = $this->db->prepare('INSERT INTO exit_equipment_master (id_user_receives,id_user_delivery,name_user_receives,destination) VALUES (?,?,?,?)'  );
				$sql_consult->execute(array($id_user_receives,$id_user_delivery,$nom_receive,$estado));
				$result = $this->db->lastInsertId();
				$this->db = null;
				return $result;
			} catch (PDOException $e) {
            	 return $e->getMessage();
        	}
		}
		public function exit_equipment_detall($valores_insert){
			try {
				$sql = "INSERT INTO exit_teams_detall (id_exit,id_equipment,quantity,note) VALUES $valores_insert";
				$sql_consult = $this->db->prepare($sql);
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
				$sql_consult = $this->db->prepare("SELECT COUNT(id_exit_detall) as count FROM exit_equipment_master INNER JOIN exit_teams_detall ON exit_equipment_master.id_exit = exit_teams_detall.id_exit INNER JOIN equipments ON exit_teams_detall.id_equipment = equipments.id_equipment INNER JOIN user ON exit_equipment_master.id_user_delivery = user.id_user WHERE name_equipment LIKE ?  AND id_user_receives LIKE ? AND date_create BETWEEN '$fecha_inicial' AND '$fecha_final' AND equipments.zone = '$this->zone' " );
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

				$sql = "SELECT exit_equipment_master.date_create, exit_teams_detall.id_exit, user.name_user, equipments.name_equipment, exit_teams_detall.quantity, exit_teams_detall.note, exit_teams_detall.id_exit_detall, exit_teams_detall.id_equipment,exit_teams_detall.returned, exit_equipment_master.name_user_receives FROM exit_equipment_master INNER JOIN exit_teams_detall ON exit_equipment_master.id_exit = exit_teams_detall.id_exit INNER JOIN equipments ON exit_teams_detall.id_equipment = equipments.id_equipment INNER JOIN user ON exit_equipment_master.id_user_delivery = user.id_user WHERE name_equipment LIKE ?  AND id_user_receives LIKE ? AND date_create BETWEEN '$fecha_inicial' AND '$fecha_final' AND equipments.zone = '$this->zone' ORDER BY exit_equipment_master.id_exit DESC LIMIT $limit OFFSET $offset ";

				$sql_consult = $this->db->prepare($sql);
				$sql_consult->execute(array($team,$cedula));
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
						
			} catch (PDOException $e) {
		         $e->getMessage();
		       }
		}
		public function returned_equipment($master,$detalle,$state){
			try {
				$sql_consult = $this->db->prepare('UPDATE exit_teams_detall SET returned = ? WHERE id_exit_detall = ? AND id_exit = ? ');
	            if ($sql_consult->execute(array($state,$detalle,$master))) {
	            	return 1;
	            }else{
	            	return 0;
	            }
	            $this->db = null;
            } catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function view_equipment_detall($id_equipment_master, $id_detall = '%%', $id_equipment = '%%' ){
			try {
				$sql = "SELECT exit_equipment_master.destination,exit_equipment_master.date_create, equipments.quantity_available,exit_teams_detall.id_exit,exit_teams_detall.state, user.name_user, user.last_name_user, equipments.name_equipment, exit_teams_detall.quantity, exit_teams_detall.note, exit_teams_detall.id_exit_detall, exit_teams_detall.id_equipment, exit_equipment_master.name_user_receives,exit_teams_detall.delivered, exit_teams_detall.returned FROM exit_equipment_master INNER JOIN exit_teams_detall ON exit_equipment_master.id_exit = exit_teams_detall.id_exit INNER JOIN equipments ON exit_teams_detall.id_equipment = equipments.id_equipment INNER JOIN user ON exit_equipment_master.id_user_delivery = user.id_user WHERE  exit_teams_detall.id_exit = ? AND  exit_teams_detall.id_exit_detall LIKE ?";
				$sql_consult = $this->db->prepare($sql);
				$sql_consult->execute(array($id_equipment_master,$id_detall));
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
						
			} catch (PDOException $e) {
		           $e->getMessage();
		       }
		}
		public function update_cant_equipmet($id_exit_detall, $team, $id_exit, $quantity){
			try {
				$sql_consult = $this->db->prepare("CALL update_quantity_equipments(?,?,?,?,@retorno)");
	            $sql_consult->execute(array($id_exit_detall, $team, $id_exit, $quantity));
	            $sql_consults = $this->db->prepare("SELECT @retorno as retorno");
	            $sql_consults->execute();
	            $result = $sql_consults->fetch();
	            $this->db = null;
	            return $result;
            } catch (PDOException $e) {
            	echo $e->getMessage();
        	}
		}

		public function delete_equipment_exit($id_user,$id_exit,$id_exit_detalle,$id_element,$nota,$process){
			try{
				$sql_consult = $this->db->prepare("CALL delete_equipment_exit (?,?,?,?,?,?,@retorno)");
				$sql_consult->execute(array($id_user,$id_exit,$id_exit_detalle,$id_element,$nota,$process));
				$sql_consult = $this->db->prepare("SELECT @retorno as retorno" );
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
