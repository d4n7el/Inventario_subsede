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
            	echo $e->getMessage();
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
	}
?>
