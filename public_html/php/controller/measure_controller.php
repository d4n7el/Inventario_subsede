<?php 
	class Measures{
		private $bd;
		private $retorno;

		public function __construct(){
			require_once($_SERVER['DOCUMENT_ROOT'].'/php/conexion.php');
			$this->db = Conexion::conect();
			$this->retorno = Array();
		}
		public function insert_measure($medida, $prefijo, $id_user){
			try {
				$sql_consult = $this->db->prepare('INSERT INTO measure (name_measure,prefix_measure,id_user_create) VALUES (?,?,?)'  );
				$sql_consult->execute(array($medida, $prefijo, $id_user));
				$result = $this->db->lastInsertId();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function graphics_pie(){
			try {
				$sql_consult = $this->db->prepare("SELECT measure.name_measure, COUNT(products.id_product) as count FROM measure INNER JOIN products ON measure.id_measure = products.unit_measure GROUP BY measure.name_measure");
				$sql_consult->execute();
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function get_measure(){
			try {
				$sql_consult = $this->db->prepare("SELECT id_measure, name_measure, prefix_measure FROM measure " );
				$sql_consult->execute();
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function update_measure($medida, $prefijo, $id_user, $id_measure){
			try {
				$sql_consult = $this->db->prepare('UPDATE measure SET name_measure = ?, prefix_measure = ?, id_user_create = ? WHERE id_measure = ? ');
	            if ($sql_consult->execute(array($medida, $prefijo, $id_user, $id_measure))) {
	            	return 1;
	            }else{
	            	return 0;
	            }
	            $this->db = null;
            } catch (PDOException $e) {
            	echo $e->getMessage();
        	}
		}
	}
?>
