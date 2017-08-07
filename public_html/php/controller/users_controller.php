<?php 
	class Users{
		private $bd;
		private $retorno;

		public function __construct(){
			require_once($_SERVER['DOCUMENT_ROOT'].'/php/conexion.php');
			$this->db = Conexion::conect();
			$this->retorno = Array();
		}
		public function insert_user($nombre,$apellido,$cedula,$pass,$cellar,$rol){
			try {
				$sql_consult = $this->db->prepare('INSERT INTO user (name_user,last_name_user,cedula,pass,id_cellar,id_role) VALUES (?,?,?,?,?,?)'  );
				$sql_consult->execute(array($nombre,$apellido,$cedula,$pass,$cellar,$rol));
				$result = $this->db->lastInsertId();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function get_user($id_user){
			try {
				$sql_consult = $this->db->prepare("SELECT * FROM user WHERE id_user LIKE ? " );
				$sql_consult->execute(array($id_user));
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function edit_user($nombre,$apellido,$cedula,$id_user){
			try {
				$sql_consult = $this->db->prepare('UPDATE user SET name_user = ?, last_name_user = ?, cedula = ? WHERE id_user = ? ');
	            if ($sql_consult->execute(array($nombre,$apellido,$cedula,$id_user))) {
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
