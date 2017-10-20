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
		public function exit_equipment_master($id_user_receives,$id_user_delivery){

			try {
				$sql_consult = $this->db->prepare('INSERT INTO exit_equipment_master (id_user_receives,id_user_delivery) VALUES (?,?)'  );
				$sql_consult->execute(array($id_user_receives,$id_user_delivery));
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




	}
?>
