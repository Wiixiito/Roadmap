<?php

session_start();
require_once "autoloadAjax.php";



if (isset($_POST['Requerimiento'])) {



        
  if ($_POST['Requerimiento'] == "GuardarSwinlane") {
    // Datos recibidos desde Flutter
    $nombre = $_POST["Nombre"];
    $estado = $_POST["Estado"];
    $datos = array(
        "nombre" => $nombre,
        "id_estado" => $estado
      
    );

    $dao = new Dao();

    // Verificar si el swinlane se encuentra registrado
    if ($dao->SwinlaneRegistrado($nombre)) {
        // Retornar mensaje de error si ya existe
        echo json_encode([
            "success" => false,
            "message" => "El Registro ya existe en el sistema."
        ]);
        exit;
    }

    // Guardar el nuevo sprint si no está registrado
    $resultado = $dao->GuardarAjax("Swinlane", $datos);

    if ($resultado) {
        echo json_encode([
            "success" => true,
            "message" => "Guardado exitoso."
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Error al guardar."
        ]);
    }
}
 
     //Este es el requerimiento para modificar los Sprint 
        
    
    
  if ($_POST['Requerimiento'] == "ModificarSprint") {
    if (!isset($_POST["ID"], $_POST["FechaI"], $_POST["FechaF"], $_POST["Nombre"], $_POST["Anios"])) {
        ob_clean();
        echo json_encode(["success" => false, "message" => "Faltan parámetros en la solicitud"]);
        exit;
    }

    $id = intval($_POST["ID"]);
    $nombre = htmlspecialchars(trim($_POST["Nombre"]));
    $fecha_inicio = $_POST["FechaI"];
    $fecha_fin = $_POST["FechaF"];
    $anio = intval($_POST["Anios"]);

    $datos = array(
        "nombre" => $nombre,
        "fecha_inicio" => $fecha_inicio,
        "fecha_fin" => $fecha_fin,
        "anios" => $anio,
        "id_estado" => 1
    );

    $where = "id = $id";
    $dao = new Dao();
    $resultado = $dao->ModificarAjax("Sprint", $datos, $where, "id");

    ob_clean(); // Limpia cualquier salida previa

    if ($resultado) {
        echo json_encode(["success" => true, "message" => "SGuardado exitoso"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al modificar"]);
    }
    exit; // Asegura que PHP no envíe más contenido
}


  
}
