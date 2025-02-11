$("body").on('click', "button#guardar", function() {
   // ev.preventDefault(); // evita que se envie el formulario
   
    var nombre = $('.bodyTotal').find('input#nombre').val();

    
    
   
    if (nombre=="") {
        swal("Tablero Kanban", "El campo nombre es Obligatorio", "error").then((confirma) => {
            $('.bodyTotal').find('input#nombre').focus();
        });
        return;
    }

    
    swal({
        title: "Tablero Kanban",
        text: "Seguro Que Desea Guardar?",
        icon: "info",
        buttons: true,
        dangerMode: false,
    }).then((confirma) => {
        if (confirma) {
            GuardarResponsable(nombre);
        } else {
            //limpiar.click();
        }
    });
});



function GuardarResponsable(nombre) {
    
    $.ajax({
        async:false,
        method: "POST",
        url: "Ajax/Aj_Responsable.php",
        data: {
            Requerimiento: "GuardarResponsable",
            Nombre: nombre 
        },
        dataType: 'JSON',


    }).done(function(respuesta) {
      
        if (respuesta[0] == true) {
            swal("Tablero Kanban", "Responsable Guardado!", "success").then((confirma) => {
                try{

             $('.bodyTotal').find('input#nombre').val("");
                }catch(error){}
                
               
               
            });
            //limpiar.click();
            return;
        }
        if (respuesta[0] == false) {
            if (respuesta[1] == 1062) {
                swal("George", "La Tarea ya existe... su registro debe de ser único!!", "error").then((confirma) => {
                    limpiar.click()
                });
                return;
            }
            swal("George", "No Se Pudo Guardar La Tarea!, Se cargara la pantalla nuevamente para solucionar el problema.", "error");
            return;
        }
    }).fail(function(jqXHR, textStatus, errorThrown) {
        swal("George", "Ocurrio un error consulte con la administracion..!  " + errorThrown + " Se cargara la pantalla nuevamente para solucionar el problema.", "error");
        console.log(errorThrown);
    });
}