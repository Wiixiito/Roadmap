<?php
class Con_Contadores
{
    public function TotalPendientes(){

        $dao = new Dao();
        
        $dao->Contar();
        
        $dao->Tabla("tarea","");
        $dao->Where("id_estado","3","and");
         $dao->Where("usuario_registro",$_SESSION['id'],"");
        


        $respuesta =$dao->Consultar();

        foreach ($respuesta as $row => $item){
            echo $item[0];
        }
    }

    public function TotalProgreso(){

        $dao = new Dao();
        
        $dao->Contar();
        
        $dao->Tabla("tarea","");
        $dao->Where("id_estado","4","and");
         $dao->Where("usuario_registro",$_SESSION['id'],"");
        


        $respuesta =$dao->Consultar();

        foreach ($respuesta as $row => $item){
            echo $item[0];
        }
    }

    public function TotalCompletadas(){

        $dao = new Dao();
        
        $dao->Contar();
        
        $dao->Tabla("tarea","");
        $dao->Where("id_estado","5","and");
         $dao->Where("usuario_registro",$_SESSION['id'],"");
        


        $respuesta =$dao->Consultar();

        foreach ($respuesta as $row => $item){
            echo $item[0];
        }
    }

 

     public function sprintcombo(){

        $dao = new Dao();

        $dao->Campo("id","");
        $dao->Campo("nombre","");
       
        
        
        

        $dao->Tabla("sprint","");
        


        $respuesta =$dao->Consultar();

        foreach ($respuesta as $row => $item){
            
            echo ' <option nombre="'.$item['nombre'].'" value='.$item['id'].'>'.$item['nombre'].'</option>';


        }

    }
 
   public function responsablecombo(){

        $dao = new Dao();

        $dao->Campo("id","");
        $dao->Campo("nombre","");
       
        
        
        

        $dao->Tabla("responsable","");
        


        $respuesta =$dao->Consultar();

        foreach ($respuesta as $row => $item){
            
            echo ' <option nombre="'.$item['nombre'].'" value='.$item['id'].'>'.$item['nombre'].'</option>';


        }

    }


    

}
