<?php 
	class Cellars{
		private $bd;
		private $retorno;

		public function __construct(){
			session_start();
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
		public function index($id_cellar,$bodega,$encargado,$limit,$offset){
			try {
				$_SESSION["exporExcel"]  = array(
					'datos' => array('Bodega','Encargado','Descripcion','Creacion'),
					'sql' =>  "SELECT name_cellar, delegate, description_cellar,date_create FROM cellar WHERE id_cellar LIKE '$id_cellar' AND name_cellar LIKE '$bodega' AND delegate LIKE '$encargado' "
				);
				$sql_consult = $this->db->prepare("SELECT * FROM cellar WHERE id_cellar LIKE ? AND name_cellar LIKE ? AND delegate LIKE ? LIMIT $limit OFFSET $offset" );
				$sql_consult->execute(array($id_cellar,$bodega,$encargado));
				$result = $sql_consult->fetchAll();
				$this->db = null;
				
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function count_cellars($id_cellar,$bodega,$encargado){
			try {
				$sql_consult = $this->db->prepare("SELECT COUNT(id_cellar) as count FROM cellar WHERE id_cellar LIKE ? AND name_cellar LIKE ? AND delegate LIKE ?" );
				$sql_consult->execute(array($id_cellar,$bodega,$encargado));
				$result = $sql_consult->fetch();
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
		public function update_cellar($name_cellar,$description,$delegate,$icon_cellar,$id_cellar){
			try {
				$sql_consult = $this->db->prepare('UPDATE cellar SET name_cellar = ?, description_cellar = ?, delegate = ?, icon_cellar = ? WHERE id_cellar = ? ');
	            if ($sql_consult->execute(array($name_cellar,$description,$delegate,$icon_cellar,$id_cellar))) {
	            	return 1;
	            }else{
	            	return 0;
	            }
	            $this->db = null;
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