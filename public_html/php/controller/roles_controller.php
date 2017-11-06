<?php 
	class Roles{
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
		public function get_roles(){
			try {
				$sql_consult = $this->db->prepare("SELECT * FROM roles WHERE zone = '$this->zone' " );
				$sql_consult->execute();
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	echo $e->getMessage();
        	}
		}
	}
?>