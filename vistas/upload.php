<?php
require_once "../autoload.php";

function EnviaNotificacion($topic,$titulo,$mensaje){

			/*define( 'API_ACCESS_KEY', 'AIzaSyAvj1Je-YndzrxDAXgQ_L12X7Eo_b0sXvI' );

			 $title = $titulo;
			 $notification = $mensaje;
			 $msg =
			 [
			    'message'   => $notification,
			    'title'   => $title,
			    'pantalla'   => 'recientes'
			 ];
			 $fields =
			 [
			    "to"=> "/topics/".$topic,
			    'data'      => $msg
			 ];

			 $headers =
			 [
			   'Authorization: key=' . API_ACCESS_KEY,
			   'Content-Type: application/json'
			 ];
			 $ch = curl_init();
			 curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
			 curl_setopt( $ch,CURLOPT_POST, true );
			 curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
			 curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
			 curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
			 curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
			 $result = curl_exec($ch );
			 curl_close( $ch );*/
			 //echo $result;
	}

$carpetaAdjunta="../fotos/";
// Contar envían por el plugin
$Imagenes =count(isset($_FILES['imagenes']['name'])?$_FILES['imagenes']['name']:0);
$IdInv = isset($_POST['idinv'])?$_POST['idinv']:null;
$infoImagenesSubidas = array();
for($i = 0; $i < $Imagenes; $i++) {

	// El nombre y nombre temporal del archivo que vamos para adjuntar
	$nombreArchivo=isset($_FILES['imagenes']['name'][$i])?$_FILES['imagenes']['name'][$i]:null;
	$nombreTemporal=isset($_FILES['imagenes']['tmp_name'][$i])?$_FILES['imagenes']['tmp_name'][$i]:null;

	$rutaArchivo=$carpetaAdjunta.$IdInv.$nombreArchivo;

	$Concat = $IdInv.$nombreArchivo;

	//$pdo = new PDO("mysql:host=localhost;dbname=leonel;charset=utf8","softworld","phpmyadminlabcsoftworld123");
	$pdo = new PDO("mysql:host=localhost;dbname=u682869943_george;charset=utf8","u682869943_george","George957lolwixi");
	$statement = $pdo->prepare("INSERT INTO inventario_fotos (id,id_inventario,ruta) VALUES
								(NULL,:idInv,:ruta);");
	$statement->execute(array("idInv" => $IdInv,"ruta" => $rutaArchivo));

	move_uploaded_file($nombreTemporal,$rutaArchivo);
	$rutaArchivo=substr($rutaArchivo,3);

	$infoImagenesSubidas[$i]=array("caption"=>"$Concat","height"=>"120px","url"=>"vistas/borrar.php","key"=>$Concat);
	$ImagenesSubidas[$i]="<img height='120px' src='$rutaArchivo' class='file-preview-image'>";

	}

$arr = array("file_id"=>0,"overwriteInitial"=>true,"initialPreviewConfig"=>$infoImagenesSubidas,
			 "initialPreview"=>$ImagenesSubidas);
			 EnviaNotificacion("todospasuca","Nuevos Productos Agregados","Ingresa para visualizar el nuevo catalogo");
echo json_encode($arr);
?>
