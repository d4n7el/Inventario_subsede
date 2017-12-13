<?php 
	class Conexion{
		
		public static function conect(){
			global $secret; 
			try {
				$dataBaseUrl = getenv('CLEARDB_DATABASE_URL');
				if ($dataBaseUrl === false) {
					require_once("config.php");
					$url = $secret["db_url"];
					$dataBaseUrl = $url;	
				}
				$aaa = explode("://",$dataBaseUrl)[1];
				$bbb = explode("@",$aaa);
				$ccc = explode(":",$bbb[0]);
				$user = $ccc[0];
				$pass =  $ccc[1];
				$ccc = explode("/",$bbb[1]);
				$host = $ccc[0];
				$DB = explode('?',$ccc[1])[0];
				$con = new PDO("mysql:host=$host; dbname=$DB",$user,$pass);
				$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$con->exec('SET CHARACTER SET UTF8');
			} catch (Exception $e) {
				die("Error".$e->getMessage());
				echo "Linea del error". $e->getLine();
			}
				return $con;
		}
	}
 ?>