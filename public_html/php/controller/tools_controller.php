<?php 
	class Tools{
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
		public function insert_tools($nombre,$marca,$cantidad,$cantidad_disp,$bodega, $id_user){
			try {
				$sql_consult = $this->db->prepare('INSERT INTO tools (name_tool,mark,total_quantity,quantity_available,id_cellar,id_user_create,zone) VALUES (?,?,?,?,?,?,?)');
				$sql_consult->execute(array($nombre,$marca,$cantidad,$cantidad_disp,$bodega,$id_user,$this->zone));
				$result = $this->db->lastInsertId();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function index_exit_tools($tools){
			try {
				$sql_consult = $this->db->prepare("SELECT * FROM tools  WHERE name_tool LIKE ? AND zone = '$this->zone' AND quantity_available > 0 LIMIT 20" );
				$sql_consult->execute(array("%".$tools."%"));
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;	
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function update_quantity_available_tool($herramienta,$disponible,$nota,$proceso){
			try {
				$sql_consult = $this->db->prepare("CALL update_quantity_available_tool(?,?,?,?,@retorno)");
	            $sql_consult->execute(array($herramienta,$disponible,$nota,$proceso));
	            $sql_consults = $this->db->prepare("SELECT @retorno as retorno");
	            $sql_consults->execute();
	            $result = $sql_consults->fetch();
	            $this->db = null;
	            return $result;
            } catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function outside($id_tool){
			try {
				$sql_consult = $this->db->prepare("SELECT SUM(quantity) AS count FROM exit_tools_detall INNER JOIN exit_tools_master ON exit_tools_detall.id_exit = exit_tools_master.id_exit WHERE id_tool = ? AND exit_tools_detall.returned = 0" );
				$sql_consult->execute(array($id_tool));
				$result = $sql_consult->fetch();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function graphics_pie(){
			try {
				$sql_consult = $this->db->prepare("SELECT name_tool, total_quantity AS count FROM tools WHERE zone = '$this->zone' ORDER BY total_quantity DESC LIMIT 12 ");
				$sql_consult->execute();
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function get_tools($herramientas,$marca,$fecha_inicial,$fecha_final,$limit,$offset){
			try {
				$sql = "SELECT * FROM tools WHERE name_tool LIKE ? AND mark LIKE ? AND DATE(create_date) BETWEEN ? AND ? AND zone = '$this->zone' ORDER BY create_date DESC  LIMIT $limit OFFSET $offset";
				$sql_consult = $this->db->prepare($sql);
				$sql_consult->execute(array($herramientas,$marca,$fecha_inicial,$fecha_final));
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function get_cant_tools($select_cantidades){
			try {
				$sql_consult = $this->db->prepare("SELECT id_tool, quantity_available FROM tools WHERE $select_cantidades");
				$sql_consult->execute();
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function get_tool_id($id_tool){
			try {
				$sql_consult = $this->db->prepare("SELECT * FROM tools WHERE id_tool = ? LIMIT 1" );
				$sql_consult->execute(array($id_tool));
				$result = $sql_consult->fetch();
				$this->db = null;
				return $result;	
			} catch (PDOException $e) {
            	echo $e->getMessage();
        	}
		}
		public function get_tools_all(){
			try {
				$sql_consult = $this->db->prepare("SELECT * FROM tools WHERE zone = '$this->zone'" );
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
		public function update_tools($nombre,$marca,$cantidad,$bodega,$id_herramienta,$id_user){
			try {
				$sql_consult = $this->db->prepare('UPDATE tools SET name_tool = ?, mark = ?,  total_quantity = ?, id_cellar = ?, id_user_create = ?  WHERE id_tool = ? ');
	            if ($sql_consult->execute(array($nombre,$marca,$cantidad,$bodega, $id_user,$id_herramienta))) {
	            	return 1;
	            }else{
	            	return 0;
	            }
	            $this->db = null;
            } catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function returned_tool($master,$detalle,$state){
			try {
				$sql_consult = $this->db->prepare('UPDATE exit_tools_detall SET returned = ? WHERE id_exit_detall = ? AND id_exit = ? ');
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
				$sql_consult = $this->db->prepare("SELECT exit_tools_master.id_exit,exit_tools_master.id_user_receives,exit_tools_detall.returned,exit_tools_master.name_user_receive,exit_tools_master.id_user_delivery,exit_tools_master.date_create,exit_tools_detall.id_exit_detall,exit_tools_detall.id_tool,exit_tools_detall.quantity,exit_tools_detall.note_received,user.name_user,user.last_name_user,tools.name_tool,tools.mark,tools.total_quantity,tools.quantity_available FROM exit_tools_master 
					INNER JOIN exit_tools_detall ON exit_tools_master.id_exit = exit_tools_detall.id_exit 
					INNER JOIN tools ON exit_tools_detall.id_tool = tools.id_tool INNER JOIN user ON exit_tools_master.id_user_delivery = user.id_user WHERE exit_tools_detall.state = ? AND id_user_receives LIKE ? AND name_tool LIKE ? AND exit_tools_master.date_create BETWEEN ? AND ? AND tools.zone = '$this->zone' LIMIT $limit OFFSET $offset "); 
				$sql_consult->execute(array($estado,$cedula,$tool,$fecha_inicial,$fecha_final));
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
					INNER JOIN tools ON exit_tools_detall.id_tool = tools.id_tool INNER JOIN user ON exit_tools_master.id_user_delivery = user.id_user WHERE exit_tools_detall.state = ? AND id_user_receives LIKE ? AND name_tool LIKE ? AND exit_tools_master.date_create BETWEEN ? AND ? AND tools.zone = '$this->zone'");
				$sql_consult->execute(array($estado,$cedula,$tool,$fecha_inicial,$fecha_final));
				$result = $sql_consult->fetch();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();	 
        	}
		}
		public function show_exit_tools($id_exit_master, $id_exit_detall="%%"){
			try {
				$sql = "SELECT exit_tools_detall.delivered, exit_tools_detall.returned, exit_tools_detall.state, exit_tools_master.id_exit,exit_tools_master.id_user_receives,exit_tools_master.name_user_receive,exit_tools_master.id_user_delivery,exit_tools_master.date_create,exit_tools_detall.id_exit_detall,exit_tools_detall.id_tool,exit_tools_detall.quantity,exit_tools_detall.note_received,user.name_user,user.last_name_user,tools.name_tool,tools.mark,tools.total_quantity,tools.quantity_available FROM exit_tools_master 
					INNER JOIN exit_tools_detall ON exit_tools_master.id_exit = exit_tools_detall.id_exit 
					INNER JOIN tools ON exit_tools_detall.id_tool = tools.id_tool INNER JOIN user ON exit_tools_master.id_user_delivery = user.id_user  WHERE exit_tools_detall.id_exit_detall LIKE ? AND exit_tools_master.id_exit LIKE ? AND tools.zone = '$this->zone' ";
				$sql_consult = $this->db->prepare($sql);
				$sql_consult->execute(array($id_exit_detall,$id_exit_master));
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	echo $e->getMessage();
        	}
		}
		public function update_exit_tools($cantidad,$id_master,$id_detalle,$id_user){
			try{
				$sql_consult = $this->db->prepare("CALL update_cant_tools_detalle(?,?,?,?,@retorno)" ); 
				$sql_consult->execute(array($cantidad,$id_master,$id_detalle,$id_user));
				$sql_consult = $this->db->prepare("SELECT @retorno as retorno" );
				$sql_consult->execute();
				$result = $sql_consult->fetch();
				$this->db = null;
				return $result;
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function delete_tools_exit($id_user,$id_exit,$id_exit_detalle,$id_element,$nota,$process){
			try{
				$sql_consult = $this->db->prepare("CALL delete_tools_exit (?,?,?,?,?,?,@retorno)");
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
