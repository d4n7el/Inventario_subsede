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
				$sql_consult = $this->db->prepare("SELECT * FROM user INNER JOIN roles ON user.id_role = roles.id_role INNER JOIN cellar ON user.id_cellar = cellar.id_cellar WHERE cedula = ? AND state = 1 LIMIT 1");
				$sql_consult->execute(array($cedula));
				$result = $sql_consult->fetch();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function init_session_user_code($email_user,$cod_user){
			try {
				$sql_consult = $this->db->prepare("SELECT * FROM recover_password INNER JOIN user ON binary recover_password.email_user  = binary user.email_user INNER JOIN roles ON user.id_role = roles.id_role INNER JOIN cellar ON user.id_cellar = cellar.id_cellar WHERE recover_password.email_user  = ? AND recover_password.code_recover = ? AND use_code = 0 LIMIT 1");
				$sql_consult->execute(array($email_user,$cod_user));
				$result = $sql_consult->fetch();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function update_use_code($id_recover){
			try {
				$sql_consult = $this->db->prepare('UPDATE recover_password SET use_code = 1 WHERE id_recover = ? ');
	            if ($sql_consult->execute(array($id_recover))) {
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