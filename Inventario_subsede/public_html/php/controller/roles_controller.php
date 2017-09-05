<?php 
	class Roles{
		private $bd;
		private $retorno;

		public function __construct(){
			require_once($_SERVER['DOCUMENT_ROOT'].'/php/conexion.php');
			$this->db = Conexion::conect();
			$this->retorno = Array();
		}
		public function get_roles($id_rol){
			try {
				$sql_consult = $this->db->prepare("SELECT * FROM roles WHERE id_role LIKE ? " );
				$sql_consult->execute(array($id_rol));
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
	}
?>