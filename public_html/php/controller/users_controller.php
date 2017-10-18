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
		public function get_user($name,$cedula,$correo,$apellido,$id_user,$estado,$limit,$offset){
			try {
				$sql = "SELECT * FROM user WHERE id_user LIKE '$id_user' AND name_user LIKE '$name' AND cedula LIKE '$cedula' AND email_user LIKE '$correo' AND last_name_user LIKE '$apellido' AND state LIKE '$estado' ORDER BY id_user DESC LIMIT $limit OFFSET $offset ";
				$sql_consult = $this->db->prepare($sql);
				$sql_consult->execute(array($id_user,$name,$cedula,$correo,$apellido));
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function graphics_pie(){
			try {
				$sql_consult = $this->db->prepare("SELECT cellar.name_cellar, COUNT(id_user) as count FROM user INNER JOIN cellar ON user.id_cellar = cellar.id_cellar GROUP BY user.id_cellar");
				$sql_consult->execute();
				$result = $sql_consult->fetchAll();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function count_user($name,$cedula,$correo,$apellido,$id_user,$estado){
			try {
				$sql = "SELECT COUNT(id_user) AS count FROM user  WHERE id_user LIKE '$id_user' AND name_user LIKE '$name' AND cedula LIKE '$cedula' AND email_user LIKE '$correo' AND last_name_user LIKE '$apellido' AND state LIKE '$estado' ";
				$sql_consult = $this->db->prepare($sql);
				$sql_consult->execute();
				$result = $sql_consult->fetch();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
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
		public function edit_user($nombre,$apellido,$cedula,$cellar,$rol,$email,$estado,$id_user){
			try {
				$sql_consult = $this->db->prepare('UPDATE user SET name_user = ?, last_name_user = ?, cedula = ?, id_cellar = ?, id_role = ?, email_user = ?, state = ? WHERE id_user = ? ');
	            if ($sql_consult->execute(array($nombre,$apellido,$cedula,$cellar,$rol,$email,$estado,$id_user))) {
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
