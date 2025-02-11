

<?php


class Conexion{



  var $link =null;



	public function conectar(){


	
	
		
		$servername = "localhost";
		$username = "u682869943_roadmap";
		$password = "George957lolwixi";
		$database = "u682869943_roadmap";
		

		try{



			// $link = new PDO("mysql:host=localhost;dbname=perla_negra;charset=utf8","root","",array(PDO::ATTR_PERSISTENT => true));

			$link = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

			return $link;



		}catch(PDOException $e){

			echo "Error de Conexion ".$e->getMessage();

		}

				



	}



}?>