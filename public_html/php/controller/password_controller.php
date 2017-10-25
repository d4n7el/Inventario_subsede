<?php 
	class Password{
		private $bd;
		private $retorno;

		public function __construct(){
			require_once($_SERVER['DOCUMENT_ROOT'].'/php/conexion.php');
			$this->db = Conexion::conect();
			$this->retorno = Array();
		}
		public function generate_code(){
			try {
				$DesdeLetra = "a";
				$HastaLetra = "z";
				$primer_letra = chr(rand(ord($DesdeLetra), ord($HastaLetra)));
				$segunda_letra = chr(rand(ord($DesdeLetra), ord($HastaLetra)));
				$code = rand(10000,1000000);
				$result = strtoupper($segunda_letra)."".$code."".strtoupper($primer_letra);
				return $result;
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function insert_code($email_user,$code_new){
			try {
				$sql_consult = $this->db->prepare('INSERT INTO recover_password (email_user,code_recover) VALUES (?,?)'  );
				$sql_consult->execute(array($email_user,$code_new));
				$result = $this->db->lastInsertId();
				$this->db = null;
				return $result;
				
			} catch (PDOException $e) {
            	$e->getMessage();
        	}
		}
		public function update_pass($pass,$id_user){
			try {
				$sql_consult = $this->db->prepare('UPDATE user SET pass = ? WHERE id_user = ? ');
	            if ($sql_consult->execute(array($pass,$id_user))) {
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
