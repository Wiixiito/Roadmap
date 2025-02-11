var pendientes = null;

$(".bodyTotal").off("change", "select#sprint").on("change", "select#sprint", function(e) {
    var pendientes = $('#pendientes');
    pendientes.empty(); // Limpiar el contenido actual antes de agregar nuevo contenido
    
    CargarTareasPendientes();
    $('#procesos').empty(); // Reemplaza 'elementoRelacionadoAProcesdas' con el ID o selector correcto
    CargarTareasProcesdas();
    $('#completados').empty(); // Reemplaza 'elementoRelacionadoAProcesdas' con el ID o selector correcto
    CargarTareasTerminadas();
});




$("body").on('click', "button#guardar", function() {
   // ev.preventDefault(); // evita que se envie el formulario
   
    var nombre = $('.bodyTotal').find('input#nombre').val();

    var descripcion = $('.bodyTotal').find('textarea#descripcion').val();
    var responsable = $('.bodyTotal').find('select#responsable').val();
    var sprint = $('.bodyTotal').find('select#sprintregistro').val(); 
    var fecha_inicio = $('.bodyTotal').find('input#fecha_inicio').val(); 
    var fecha_fin = $('.bodyTotal').find('input#fecha_fin').val(); 

    // Convertir las cadenas de fecha en objetos Date
        var fechaInicio = new Date(fecha_inicio);
        var fechaFin = new Date(fecha_fin);

        // Calcular la diferencia en milisegundos
        var diferenciaMilisegundos = fechaFin - fechaInicio;

        // Convertir la diferencia de milisegundos a días
        var milisegundosPorDia = 1000 * 60 * 60 * 24;
        // Cantidad de dias
        var diferenciaDias = Math.floor(diferenciaMilisegundos / milisegundosPorDia);

        
    
    
   
    if (nombre=="") {
        swal("Tablero Kanban", "El campo nombre es Obligatorio", "error").then((confirma) => {
            $('.bodyTotal').find('input#nombre').focus();
        });
        return;
    }

      if (descripcion=="") {
        swal("Tablero Kanban", "El campo description es Obligatorio", "error").then((confirma) => {
            $('.bodyTotal').find('input#description').focus();
        });
        return;
    }

      if (responsable==0) {
        swal("Tablero Kanban", "El campo responsable es Obligatorio", "error").then((confirma) => {
            $('.bodyTotal').find('select#responsable').focus();
        });
        return;
    }

    if (sprint== 0 ) {
        swal("Tablero Kanban", "Seleccione un Sprint ", "error").then((confirma) => {
            $('.bodyTotal').find('select#sprintregistro').focus();
        });
        return;
    }

     if (fecha_inicio== "" ) {
        swal("Tablero Kanban", "Seleccione una Fecha de inicio ", "error").then((confirma) => {
            $('.bodyTotal').find('input#fecha_inicio').focus();
        });
        return;
    }

     if (fecha_fin== "" ) {
        swal("Tablero Kanban", "Seleccione una Fecha de finalizacion ", "error").then((confirma) => {
            $('.bodyTotal').find('input#fecha_fin').focus();
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
            GuardarTarea(nombre, descripcion , responsable , sprint,fecha_inicio,fecha_fin,diferenciaDias);
            

        } else {
            //limpiar.click();
        }
    });
});

function GuardarTarea(nombre, descripcion , responsable , sprint , fecha_inicio , fecha_fin,diferenciaDias) {
    var pendientes = $('#pendientes');
    $.ajax({
        async:false,
        method: "POST",
        url: "Ajax/Aj_Tableros.php",
        data: {
            Requerimiento: "GuardarTarea",
            Nombre: nombre ,
            Descripcion : descripcion,
            Responsable : responsable,
            Sprint : sprint,
            Fecha_Desde : fecha_inicio,
            Fecha_Hasta : fecha_fin,
            Cantidad : diferenciaDias
        },
        dataType: 'JSON',


    }).done(function(respuesta) {
            
      
        if (respuesta[0] == true) {
            swal("Tablero Kanban", "Tarea Guardada!", "success").then((confirma) => {
                try{

                
                }catch(error){}
                
                pendientes.empty();
                CargarTareasPendientes();


                $('.bodyTotal').find('input#nombre').val("");
                $('.bodyTotal').find('textarea#descripcion').val("");
                $('.bodyTotal').find('input#fecha_inicio').val("");
                $('.bodyTotal').find('input#fecha_fin').val("");
                

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





function CargarTareasPendientes() {
    var pendientes = $('#pendientes');
    var sprint = $('select#sprint').val();

    $.ajax({
        method: "POST",
        url: "Ajax/Aj_Tableros.php",
        data: {
            Requerimiento: "consultartareaspendiente2",
            Sprint: sprint
        },
        dataType: 'JSON',
    }).done(function (respuesta) {
        console.log(respuesta);



        // Procesar la respuesta y agregar los elementos al contenedor
        $.each(respuesta, function (i, value) {

 //var cargar = '<div id="padre" style="color: black; font-size: 90%;"><b>' + respuesta[i][1] + '</b></br> ' + respuesta[i][2] + '  </br></div> </br>';


            var cargar = '<div id="padre" idConsulta=' + respuesta[i][0] + 
                '  </br>  <b style="color: black; font-size: 90%;"> Tarea : </b> ' + respuesta[i][1] +
                '  </br>  <b style="color: black; font-size: 90%;"> Descripcion : </b>' + respuesta[i][2] +
                '  </br>  <b style="color: black; font-size: 90%;"> Responsable : </b>' + respuesta[i][3] +
                '  </br>  <b style="color: black; font-size: 90%;"> Fecha Inicio : </b>' + respuesta[i][4] +'  <b style="color: black; font-size: 90%;">-  Fecha Fin : </b>' + respuesta[i][5] +
                '  </br>  <b style="color: black; font-size: 90%;"> Cantidad de dias : </b>' + respuesta[i][6] +
                '</b><button id="bt1" idConsulta=' + respuesta[i][0] + ' type="submit" class="btn btn-block btn-xlg bg-pink waves-effect" style="color: white;" >  <b>Procesar Tarea  </b></button> </br> </br>    </div>';
            pendientes.append(cargar);
        });

    }).fail(function (jqXHR, textStatus, errorThrown) {
        swal("Galenos!", "Ocurrio un error consulte con la administracion..!  " + errorThrown + " Se cargara la pantalla nuevamente para solucionar el problema.", "error");
    });
}



  $("body").on('click', '#bt1', function() {
  var id = $(this).attr('idConsulta');
  


   swal({
        title: "Tablero Kanban",
        text: "Seguro Que Desea Pasar a PROCESAR LA TAREA?",
        icon: "info",
        buttons: true,
        dangerMode: false,
    }).then((confirma) => {
        if (confirma) {
            ModificarTarea(id);
        } else {
            limpiar.click();
        }
    });
  
});

function ModificarTarea(id) {
     var procesos = $('#procesos');
    $.ajax({
        async: false,
        method: "POST",
        url: "Ajax/Aj_Tableros.php",
        data: {
            Requerimiento: "ModificarTarea",
            Id: id
        },
        dataType: 'JSON',
    }).done(function(respuesta) {
        console.log(respuesta);
        if (respuesta[0] == true) {
            swal("George", "Tarea Procesada!", "success").then((confirma) => {
                try{
                    procesos.html("");
                   procesos.html('<strong style=" color: white;" >EN PROCESO</strong> ');
                   
                }catch(error){}

                $('#pendientes').empty();
                CargarTareasPendientes();    
                $('#procesos').empty();
                CargarTareasProcesdas();


                //location.reload();
                
               
            });
            
            return;
        }
        if (respuesta[0] == false) {
            if (respuesta[1] == 1062) {
                swal("Pasuca", "La Categoria ya existe... su registro debe de ser único!!", "error").then((confirma) => {
                   
                });
                return;
            }
            swal("Pasuca", "No Se Pudo Guardar La Categoria!, Se cargara la pantalla nuevamente para solucionar el problema.", "error");
            return;
        }
    }).fail(function(jqXHR, textStatus, errorThrown) {
        swal("Pasuca", "Ocurrio un error consulte con la administracion..!  " + errorThrown + " Se cargara la pantalla nuevamente para solucionar el problema.", "error");
    });
}



function CargarTareasProcesdas() {
    var sprint = $('select#sprint').val();
    var procesos = $('#procesos');

    $.ajax({
        method: "POST",
        url: "Ajax/Aj_Tableros.php",
        data: {
            Requerimiento: "consultartareasprocesadas2",
            Sprint: sprint
        },
        dataType: 'JSON',
    }).done(function (respuesta) {
        

       

        // Procesar la respuesta y agregar los elementos al contenedor
        $.each(respuesta, function (i, value) {
            var cargar = '<div id="padre" style="color: black;"> <b>' + respuesta[i][1] + ' </b> <button idConsultaProcesada2=' + respuesta[i][0] + ' class="btn btn-primary waves-effect" id="porcentaje">% Avance</button></br> ' + respuesta[i][2] + ' </br> <b> ' + respuesta[i][3] + ' </b> <button id="bt1p" idConsultaProcesada=' + respuesta[i][0] + ' type="submit" class="btn btn-block btn-xlg bg-cyan waves-effect" style="color: black;"> Completar la tarea </button> </br> </br> </div>';
            procesos.append(cargar);
        });

    }).fail(function (jqXHR, textStatus, errorThrown) {
        swal("Galenos!", "Ocurrio un error consulte con la administracion..!  " + errorThrown + " Se cargara la pantalla nuevamente para solucionar el problema.", "error");
    });
}


  $("body").on('click', '#bt1p', function() {
  var id = $(this).attr('idConsultaProcesada');
 

   swal({
        title: "Tablero Kanban",
        text: "Seguro Que Desea Pasar a Completar LA TAREA?",
        icon: "info",
        buttons: true,
        dangerMode: false,
    }).then((confirma) => {
        if (confirma) {
            TerminarTarea(id);
        } else {
            limpiar.click();
        }
    });
  
});

  function TerminarTarea(id) {
     var completados = $('#completados');
    $.ajax({
        async: false,
        method: "POST",
        url: "Ajax/Aj_Tableros.php",
        data: {
            Requerimiento: "TerminarTarea",
            Id: id
        },
        dataType: 'JSON',
    }).done(function(respuesta) {
        console.log(respuesta);
        if (respuesta[0] == true) {
            swal("George", "Tarea Procesada!", "success").then((confirma) => {
                try{
                    completados.html("");
                    completados.html('<strong style=" color: black;" >COMPLETADOS</strong> ');
                    

                $('#pendientes').empty();
                CargarTareasPendientes();    
                $('#procesos').empty();
                CargarTareasProcesdas();
                $('#completados').empty();
                CargarTareasTerminadas();
                
                }catch(error){}

               
               
               
            });
            
            return;
        }
        if (respuesta[0] == false) {
            if (respuesta[1] == 1062) {
                swal("Pasuca", "La Categoria ya existe... su registro debe de ser único!!", "error").then((confirma) => {
                   
                });
                return;
            }
            swal("Pasuca", "No Se Pudo Guardar La Categoria!, Se cargara la pantalla nuevamente para solucionar el problema.", "error");
            return;
        }
    }).fail(function(jqXHR, textStatus, errorThrown) {
        swal("Pasuca", "Ocurrio un error consulte con la administracion..!  " + errorThrown + " Se cargara la pantalla nuevamente para solucionar el problema.", "error");
    });
}

function CargarTareasTerminadas() {
    var sprint = $('select#sprint').val();
    var completados = $('#completados');

    $.ajax({
        method: "POST",
        url: "Ajax/Aj_Tableros.php",
        data: {
            Requerimiento: "consultartareasterminadas2",
            Sprint: sprint
        },
        dataType: 'JSON',
    }).done(function (respuesta) {
        

      

        // Procesar la respuesta y agregar los elementos al contenedor
        $.each(respuesta, function (i, value) {
            var cargar = '<div id="padre" style="color: black; font-size: 90%;"><b>' + respuesta[i][1] + '</b></br> ' + respuesta[i][2] + '  </br></div> </br>';
            completados.append(cargar);
        });

    }).fail(function (jqXHR, textStatus, errorThrown) {
        swal("Galenos!", "Ocurrio un error consulte con la administracion..!  " + errorThrown + " Se cargara la pantalla nuevamente para solucionar el problema.", "error");
    });
}


    $("body").on('click', '#porcentaje', function() {
  var id = $(this).attr('idConsultaProcesada2');
  alert(id);
  
});