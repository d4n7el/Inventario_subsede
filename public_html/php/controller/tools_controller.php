<?php 
	class Tools{
		private $bd;
		private $retorno;

		public function __construct(){
			require_once($_SERVER['DOCUMENT_ROOT'].'/php/conexion.php');
			$this->db = Conexion::conect();
			$this->retorno = Array();
		}
		public function insert_tools($nombre,$marca,$cantidad,$cantidad_disp,$bodega, $id_user){
			try {
				$sql_consult = $this->db->prepare('INSERT INTO tools (name_tool,mark,total_quantity,quantity_available,id_cellar,id_user_create) VALUES (?,?,?,?,?,?)');
				$sql_consult->execute(array($nombre,$marca,$cantidad,$cantidad_disp,$bodega,$id_user));
				$result = $this->db->lastInsertId();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function get_tools($limit,$offset){
			try {
				$sql_consult = $this->db->prepare("SELECT * FROM tools WHERE id_cellar = 6 LIMIT $limit OFFSET $offset" );
				$sql_consult->execute();
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function get_tools_all(){
			try {
				$sql_consult = $this->db->prepare("SELECT * FROM tools WHERE id_cellar = 6" );
				$sql_consult->execute();
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function count_tools(){
			try {
				$sql_consult = $this->db->prepare("SELECT COUNT(id_tool) AS count FROM tools WHERE id_cellar = 6" );
				$sql_consult->execute();
				$result = $sql_consult->fetch();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function update_tools($nombre,$marca,$cantidad,$cantidad_disp,$bodega,$id_herramienta,$id_user){
			try {
				$sql_consult = $this->db->prepare('UPDATE tools SET name_tool = ?, mark = ?,  total_quantity = ?, quantity_available = ? , id_cellar = ?, id_user_create = ?  WHERE id_tool = ? ');
	            if ($sql_consult->execute(array($nombre,$marca,$cantidad,$cantidad_disp,$bodega, $id_user,$id_herramienta))) {
	            	return 1;
	            }else{
	            	return 0;
	            }
	            $this->db = null;
            } catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function exit_tools_master($id_user,$id_user_receive,$name_user_receive){
			try {
				$sql_consult = $this->db->prepare('INSERT INTO exit_tools_master(id_user_receives,name_user_receive,id_user_delivery) VALUES (?,?,?)');
				$sql_consult->execute(array($id_user_receive,$name_user_receive,$id_user));
				$result = $this->db->lastInsertId();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function exit_tools_detall($insert_values){
			try {
				$sql_consult = $this->db->prepare("INSERT INTO exit_tools_detall (id_exit,quantity,note_received,id_tool) VALUES $insert_values");
				$sql_consult->execute();
				$result = $this->db->lastInsertId();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function get_exit_tools($tool,$cedula,$fecha_inicial,$fecha_final,$estado,$limit,$offset){
			try {
				$sql_consult = $this->db->prepare("SELECT exit_tools_master.id_exit,exit_tools_master.id_user_receives,exit_tools_master.name_user_receive,exit_tools_master.id_user_delivery,exit_tools_master.date_create,exit_tools_detall.id_exit_detall,exit_tools_detall.id_tool,exit_tools_detall.quantity,exit_tools_detall.note_received,user.name_user,user.last_name_user,tools.name_tool,tools.mark,tools.total_quantity,tools.quantity_available FROM exit_tools_master 
					INNER JOIN exit_tools_detall ON exit_tools_master.id_exit = exit_tools_detall.id_exit 
					INNER JOIN tools ON exit_tools_detall.id_tool = tools.id_tool INNER JOIN user ON exit_tools_master.id_user_delivery = user.id_user LIMIT $limit OFFSET $offset ");
				$sql_consult->execute();
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function count_tools_exit($tool,$cedula,$fecha_inicial,$fecha_final,$estado){
			try {
				$sql_consult = $this->db->prepare("SELECT Count(exit_tools_detall.id_exit) AS count FROM exit_tools_master 
					INNER JOIN exit_tools_detall ON exit_tools_master.id_exit = exit_tools_detall.id_exit 
					INNER JOIN tools ON exit_tools_detall.id_tool = tools.id_tool INNER JOIN user ON exit_tools_master.id_user_delivery = user.id_user" );
				$sql_consult->execute();
				$result = $sql_consult->fetch();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();	 
        	}
		}
		public function show_exit_tools($id_exit,$id_exit_detall = "%%"){
			try {
				$sql_consult = $this->db->prepare("SELECT * FROM show_exit_tools WHERE id_exit_product_master = ? AND id_exit_detall LIKE ? " );
				$sql_consult->execute(array($id_exit,$id_exit_detall));
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
	}
?>
