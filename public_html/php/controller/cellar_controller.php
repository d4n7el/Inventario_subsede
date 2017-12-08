<?php 
	class Cellars{
		private $bd;
		private $retorno;

		public function __construct(){
			require_once($_SERVER['DOCUMENT_ROOT'].'/php/conexion.php');
			$this->db = Conexion::conect();
			$this->retorno = Array();
		}
		public function get_cellar($id_cellar){
			try {
				$sql_consult = $this->db->prepare("SELECT * FROM cellar WHERE id_cellar LIKE ? AND NOT `name_cellar` = 'Equipos' AND NOT `name_cellar` = 'Herramientas' " );
				$sql_consult->execute(array($id_cellar));
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function insert_cellar($name_cellar,$description,$delegate,$icon_cellar){
			try {
				$sql_consult = $this->db->prepare('INSERT INTO cellar (name_cellar,delegate,description_cellar,icon_cellar) VALUES (?,?,?,?)'  );
				$sql_consult->execute(array($name_cellar,$description,$delegate,$icon_cellar));
				$result = $this->db->lastInsertId();
				$this->db = null;
				return $result;
			} catch (PDOException $e) {
            	return $e->getMessage();
        	}
		}
		public function get_cellar_two($id_cellar){
			try {
				$sql_consult = $this->db->prepare("SELECT * FROM cellar WHERE id_cellar LIKE ?" );
				$sql_consult->execute(array($id_cellar));
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
	}
?>