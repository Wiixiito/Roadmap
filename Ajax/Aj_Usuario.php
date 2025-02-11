<?php

session_start();
require_once "autoloadAjax.php";



if (isset($_POST['Requerimiento'])) {

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

ob_start(); // Inicia la captura del buffer de salida

if ($_POST['Requerimiento'] == "GuardarUsuario") {
    $nombreUsuario = htmlspecialchars(trim($_POST["NOM"]));
    $accessToken = $_POST["ACTK"];
    $correo = $_POST["EMAIL"];
    $idCliente = $_POST["IDCLI"];
    $dao = new Dao();
    $idUsuario = null;

    if ($dao->UsuarioRegistrado($nombreUsuario)) {
        $valores = array("accesstoken" => $accessToken, "correo" => $correo);
        $where = "nombre_usuario = '" . $nombreUsuario . "'";
        $dao->ModificarAjax2("Usuario", $valores, $where, $idCliente);

        $usuario = $dao->ObtenerUsuarioPorNombre($nombreUsuario);
        $idUsuario = $usuario['id'];
    } else {
        $datos = array(
            "accesstoken" => $accessToken,
            "idclient" => $idCliente,
            "nombre_usuario" => $nombreUsuario,
            "correo" => $correo,
            "id_estado" => 1
        );
        $idUsuario = $dao->GuardarAjax("Usuario", $datos);
    }

    ob_end_clean(); // Limpia cualquier salida previa del buffer de salida
    header('Content-Type: application/json');
    echo json_encode(array("idUsuario" => $idUsuario));
    die();
}


  
}








if (isset($_GET['Requerimiento'])) {
    
    if ($_GET['Requerimiento'] == "ConsultarMenu") {

        $dao = new Dao();

        $dao->Campo("id","");
        $dao->Campo("nombre","");
        $dao->Campo("id_estado","");
        
        $dao->Tabla("Menu","");
       
      
        $dao->Where("id_estado", "1", "");

        

        $dao->ConsultarAjax();
    }


    if ($_GET['Requerimiento'] == "ConsultarMenuOpciones") {

        $dao = new Dao();

        $dao->Campo("id","");
        $dao->Campo("id_menu","");
        $dao->Campo("nombre","");
        $dao->Campo("id_estado","");
        
        $dao->Tabla("Menu_opciones","");
       
      
        $dao->Where("id_estado", "1", "");

        

        $dao->ConsultarAjax();
    }
    

    
   

    
}


















