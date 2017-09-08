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
				$sql_consult = $this->db->prepare("SELECT * FROM user WHERE cedula = ? LIMIT 1");
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
				$sql_consult = $this->db->prepare("SELECT user.name_user, user.last_name_user, user.id_user, user.cedula, user.email_user, recover_password.code_recover FROM recover_password INNER JOIN user ON binary recover_password.email_user  = binary user.email_user WHERE recover_password.email_user  = ? AND recover_password.code_recover = ? LIMIT 1");
				$sql_consult->execute(array($email_user,$cod_user));
				$result = $sql_consult->fetch();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
	}
?>