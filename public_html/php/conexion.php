<?php 
	class Conexion{
		public static function conect(){
			try {
				//$con = new PDO('mysql:host=localhost; dbname=id1713708_inventarios_subsede','id1713708_inventarios_subsede','inventarios_subsede');
				$con = new PDO('mysql:host=localhost; dbname=inventarios_subsede','root','');
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