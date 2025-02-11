<?php 
$carpetaAdjunta="../fotos/";

if($_SERVER['REQUEST_METHOD']=="DELETE"){

			parse_str(file_get_contents("php://input"),$datosDELETE);

			$key= $datosDELETE['key'];

			//$pdo = new PDO("mysql:host=localhost;dbname=leonel;charset=utf8","softworld","phpmyadminlabcsoftworld123");
			//$pdo = new PDO("mysql:host=localhost;dbname=susana;charset=utf8","softworld","phpmyadminlabcsoftworld123");
			$pdo = new PDO("mysql:host=localhost;dbname=paola;charset=utf8","root","");
			$statement = $pdo->prepare("DELETE FROM inventario_fotos WHERE ruta=:ruta");
			$statement->execute(array("ruta" => $carpetaAdjunta.$key));

			unlink($carpetaAdjunta.$key);
			
			echo 0;
}

?>
