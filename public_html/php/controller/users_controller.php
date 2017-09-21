<?php 
	class Users{
		private $bd;
		private $retorno;

		public function __construct(){
			require_once($_SERVER['DOCUMENT_ROOT'].'/php/conexion.php');
			$this->db = Conexion::conect();
			$this->retorno = Array();
		}
		public function insert_user($nombre,$apellido,$email,$cedula,$pass,$cellar,$rol){
			try {
				$sql_consult = $this->db->prepare('INSERT INTO user (name_user,last_name_user,email_user,cedula,pass,id_cellar,id_role) VALUES (?,?,?,?,?,?,?)'  );
				$sql_consult->execute(array($nombre,$apellido,$email,$cedula,$pass,$cellar,$rol));
				$result = $this->db->lastInsertId();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function get_user($id_user,$limit,$offset){
			try {
				$sql_consult = $this->db->prepare("SELECT * FROM user WHERE id_user LIKE ? LIMIT $limit OFFSET $offset " );
				$sql_consult->execute(array($id_user));
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	echo $e->getMessage();
        	}
		}
		public function count_user(){
			try {
				$sql_consult = $this->db->prepare("SELECT COUNT(id_user) AS count FROM user " );
				$sql_consult->execute();
				$result = $sql_consult->fetch();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	echo $e->getMessage();
        	}
		}
		public function show_user($email){
			try {
				$sql_consult = $this->db->prepare("SELECT * FROM user WHERE email_user LIKE ? LIMIT 1" );
				if ($sql_consult->execute(array($email))) {
					$result = $sql_consult->fetch();
				}else{
					$result = 0;
				}
				
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function edit_user($nombre,$apellido,$cedula,$cellar,$rol,$id_user){
			try {
				$sql_consult = $this->db->prepare('UPDATE user SET name_user = ?, last_name_user = ?, cedula = ?, id_cellar = ?, id_role = ? WHERE id_user = ? ');
	            if ($sql_consult->execute(array($nombre,$apellido,$cedula,$cellar,$rol,$id_user))) {
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
