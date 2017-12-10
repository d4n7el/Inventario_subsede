<?php 
	class Export{
		private $bd;
		private $retorno;
		public function __construct(){
			require_once($_SERVER['DOCUMENT_ROOT'].'/php/conexion.php');
			$this->db = Conexion::conect();
			$this->retorno = Array();
			session_start();
		}
		public function get_sql(){
			try {
				$sql_consult = $this->db->prepare($_SESSION["exporExcel"]['sql']);
				$sql_consult->execute();
				$result = $sql_consult->fetchAll(PDO::FETCH_ASSOC);
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
	}
?>