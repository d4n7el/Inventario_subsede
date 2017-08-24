<?php 
	class Session{
		private $bd;
		private $retorno;

		public function __construct(){
			require_once($_SERVER['DOCUMENT_ROOT'].'/php/conexion.php');
			$this->db = Conexion::conect();
			$this->retorno = Array();
		}
		public function init_session_user($cedula){
			try {
				$sql_consult = $this->db->prepare("SELECT * FROM user WHERE cedula = ? LIMIT 1");
				$sql_consult->execute(array($cedula));
				$result = $sql_consult->fetch();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
	}
?>