<?php 
	class Roles{
		private $bd;
		private $retorno;
		private $zone;

		public function __construct(){
			session_start();
			require_once($_SERVER['DOCUMENT_ROOT'].'/php/conexion.php');
			$this->zone = ($_SESSION["id_user_activo_role"] == "A_A-a_1") ? "A" : "B";
			$this->db = Conexion::conect();
			$this->retorno = Array();
		}
		public function get_roles($id_rol){
			try {
				$sql_consult = $this->db->prepare("SELECT * FROM roles WHERE id_role LIKE ? AND zone = '$this->zone' " );
				$sql_consult->execute(array($id_rol));
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	echo $e->getMessage();
        	}
		}
	}
?>