<?php
require_once "../autoload.php";


$carpetaAdjunta="../fotos/";
// Contar envían por el plugin
$Imagenes =count(isset($_FILES['imagenes']['name'])?$_FILES['imagenes']['name']:0);
$Descripcion = isset($_POST['descripcion'])?$_POST['descripcion']:null;
$infoImagenesSubidas = array();
for($i = 0; $i < $Imagenes; $i++) {

	// El nombre y nombre temporal del archivo que vamos para adjuntar
	$nombreArchivo=isset($_FILES['imagenes']['name'][$i])?$_FILES['imagenes']['name'][$i]:null;
	$nombreTemporal=isset($_FILES['imagenes']['tmp_name'][$i])?$_FILES['imagenes']['tmp_name'][$i]:null;

	$rutaArchivo=$carpetaAdjunta.$Descripcion.$nombreArchivo;

	$Concat = $Descripcion.$nombreArchivo;

	//$pdo = new PDO("mysql:host=localhost;dbname=leonel;charset=utf8","softworld","phpmyadminlabcsoftworld123");
	$pdo = new PDO("mysql:host=localhost;dbname=u682869943_george;charset=utf8","u682869943_george","George957lolwixi");
	$statement = $pdo->prepare("INSERT INTO foto_slide (id,descripcion,ruta) VALUES
								(NULL,:Descripcion,:ruta);");
	$statement->execute(array("Descripcion" => $Descripcion,"ruta" => $rutaArchivo));

	move_uploaded_file($nombreTemporal,$rutaArchivo);
	$rutaArchivo=substr($rutaArchivo,3);

	$infoImagenesSubidas[$i]=array("caption"=>"$Concat","height"=>"120px","url"=>"vistas/borrar.php","key"=>$Concat);
	$ImagenesSubidas[$i]="<img height='120px' src='$rutaArchivo' class='file-preview-image'>";

	}

$arr = array("file_id"=>0,"overwriteInitial"=>true,"initialPreviewConfig"=>$infoImagenesSubidas,
			 "initialPreview"=>$ImagenesSubidas);
			 
echo json_encode($arr);
?>
