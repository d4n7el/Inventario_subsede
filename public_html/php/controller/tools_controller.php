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
				$sql_consult = $this->db->prepare('INSERT INTO tools (nombre,marca,cantidad,cantidad_disponible,id_bodega,id_user_create) VALUES (?,?,?,?,?,?)'  );
				$sql_consult->execute(array($nombre,$marca,$cantidad,$cantidad_disp,$bodega,$id_user));
				$result = $this->db->lastInsertId();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function get_tools(){
			try {
				$sql_consult = $this->db->prepare("SELECT * FROM tools " );
				$sql_consult->execute();
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function update_tools($nombre,$marca,$cantidad,$cantidad_disp,$bodega,$id_herramienta,$id_user){
			try {
				$sql_consult = $this->db->prepare('UPDATE tools SET nombre = ?, marca = ?,  cantidad = ?, cantidad_disponible = ? , id_bodega = ?, id_user_create = ?  WHERE id_herrramienta = ? ');
	            if ($sql_consult->execute(array($nombre,$marca,$cantidad,$cantidad_disp,$bodega,$id_herramienta, $id_user))) {
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
