<?php

session_start();
require_once "autoloadAjax.php";





if (isset($_POST['Requerimiento'])) {



        //Este es el requerimiento para Guardar el Q/Años
    if ($_POST['Requerimiento'] == "GuardarQ") {

        $datos = array(
                       "q" => $_POST["Q"],
                       "anios" => $_POST["Anios"],
                       "observaciones" => $_POST["Observaciones"],
                       "id_estado"=>1);

        $dao = new Dao();
        $dao->GuardarAjax("Q", $datos);


}




}

if (isset($_GET['Requerimiento'])) {
    
    if ($_GET['Requerimiento'] == "ConsultaDatatableQ") {

        $dao = new Dao();

        $dao->Campo("id","");
        $dao->Campo("q","");
        $dao->Campo("anios","");
        $dao->Campo("observaciones","");
        $dao->Campo("id_estado","");
        
        $dao->Tabla("Q","");
       
      
        $dao->Where("id_estado", "1", "");

        

        $dao->ConsultarAjax();
    }
    
    
     if ($_GET['Requerimiento'] == "ConsultaDatatableSprint") {

        $dao = new Dao();

        $dao->Campo("s.id","");
        $dao->Campo("s.nombre","");
        $dao->Campo("s.fecha_inicio","");
        $dao->Campo("s.fecha_fin","");
        $dao->Campo("s.id_estado","");
        $dao->Campo("s.id_q","");
        $dao->Campo("q.q","");
        $dao->Campo("q.anios","");
       
        
       
       $dao->TablasInnerAlias("Sprint","s","Q","q");
       
      
        $dao->Where("s.id_estado", "1", "");

        

        $dao->ConsultarAjax();
       // echo json_encode($dao->Consultar2());
    }

    
    if ($_GET['Requerimiento'] == "ConsultaDatatableSwinlane") {

        $dao = new Dao();

        $dao->Campo("id","");
        $dao->Campo("nombre","");
        $dao->Campo("id_estado","");
        
        
        $dao->Tabla("Swinlane","");
       
      
        //$dao->Where("id_estado", "1", "");

        

        $dao->ConsultarAjax();
    }


        $sql = "SELECT 
    p.codigo, 
    p.nombre,
    GROUP_CONCAT(DISTINCT CASE WHEN c.nombre = 'Product Owner' THEN u.nombre_usuario END SEPARATOR ', ') AS `Product Owner`,
    GROUP_CONCAT(DISTINCT CASE WHEN c.nombre = 'Product Manager' THEN u.nombre_usuario END SEPARATOR ', ') AS `Product Manager`,
    GROUP_CONCAT(DISTINCT CASE WHEN c.nombre = 'VP OF Engineering' THEN u.nombre_usuario END SEPARATOR ', ') AS `VP OF Engineering`,
    GROUP_CONCAT(DISTINCT CASE WHEN c.nombre = 'QA Lead' THEN u.nombre_usuario END SEPARATOR ', ') AS `QA Lead`,
    GROUP_CONCAT(DISTINCT CASE WHEN c.nombre = 'Tech Lead' THEN u.nombre_usuario END SEPARATOR ', ') AS `Tech Lead`,
    GROUP_CONCAT(DISTINCT CASE WHEN c.nombre = 'Project Management Office' THEN u.nombre_usuario END SEPARATOR ', ') AS `Project Management Office`
    FROM Proyecto p
    INNER JOIN Asignaciones a ON p.id = a.id_proyecto
    INNER JOIN Cargo c ON c.id = a.id_cargo
    INNER JOIN Usuario u ON u.id = a.id_usuario
    GROUP BY p.codigo, p.nombre
    ORDER BY p.nombre ASC";

   
   

    
}


















