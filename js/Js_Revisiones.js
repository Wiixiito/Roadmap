var tablaRevision = null;
var idInvTodo = 0;

$( document ).ready(function() {
  $("#archivos").fileinput({
    language: 'es',
    uploadUrl: "vistas/upload.php",
    uploadExtraData : function() {
        return {
            idinv : idInvTodo
        };
    },
    uploadAsync: false,
    minFileCount: 1,
    maxFileCount: 50,
    showUpload: false,
    showRemove: false,
    maxFilePreviewSize: 26500000,
    maxFileSize: 26500000,
    allowedFileExtensions: ["jpg", "png", "jpeg"],
  });
});



function LlenarTablaRevision() {
    tablaRevision = $('#tablaRevision').DataTable({
        dom: 'Bfrtip',
         responsive: true,
          buttons: [
                {
                extend: 'excel',
                exportOptions: {
                    columns: [0, 1, 2, 6 , 7]
                },
                 filename: 'TablaQaRevision'
            }
        ],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
        "processing": true,
        "serverSide": true,
        lengthMenu: [
            [200, 400, 600],
            [200, 400, 600]
        ],
        "bPaginate": false,
        "bFilter": false,
        "bInfo": false,
        " bFilter ": false,
        " bSort ": false,
        " bInfo ": false,
        " bAutoWidth ": false,
        "bLengthChange": false,
        "order": [],
        "ajax": {
            url: "Ajax/Aj_Revision.php",
            data: {
                Requerimiento: "ConsultarRevisiones"
            },
            type: "POST"
        },
        scrollY: 380,
        scrollX: true,
        autoWidth: true,
        scroller: {
            loadingIndicator: true
        },
        "columnDefs": [{
            "targets": [6,7],
            "orderable": false,
           " className": 'select-checkbox',
           "visible" : false,
        }]
    });
}


LlenarTablaRevision();
// Guardar en la base cuando no esta chequeado el box 

  $("body table#tablaRevision tbody ").on('click', 'div#nochequeado', function() {
  var id = tablaRevision.row($(this).parent().parent()).data()[0];

  
  
  
   swal({
        title: "Tablero Kanban",
        text: "Seguro Que Desea Guardar? ",
        icon: "info",
        buttons: true,
        dangerMode: false,
    }).then((confirma) => {
        if (confirma) {
            ModificarTarea(id);
        } else {
            tablaRevision.clear().draw();
        }
    });



});


function ModificarTarea(id) {
     
    $.ajax({
        async: true,
        method: "POST",
        url: "Ajax/Aj_Revision.php",
        data: {
            Requerimiento: "ModificarTarea",
            Id: id
        },
        dataType: 'JSON',
    }).done(function(respuesta) {
        console.log(respuesta);
        if (respuesta[0] == true) {
            swal("George", "Tarea Procesada!", "success").then((confirma) => {
               

                tablaRevision.clear().draw();



               
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


 // MOdificar en la base para quitar el checkbox 

  $("body table#tablaRevision tbody ").on('click', 'div#chequeado', function() {
  var id = tablaRevision.row($(this).parent().parent()).data()[0];

  
  
  
   swal({
        title: "Tablero Kanban",
        text: "Seguro Que Desea Eliminar esta verificacion? ",
        icon: "info",
        buttons: true,
        dangerMode: false,
    }).then((confirma) => {
        if (confirma) {
            EliminarTarea(id);
        } else {
            tablaRevision.clear().draw();
        }
    });



});


  function EliminarTarea(id) {
     
    $.ajax({
        async: true,
        method: "POST",
        url: "Ajax/Aj_Revision.php",
        data: {
            Requerimiento: "EliminarTarea",
            Id: id
        },
        dataType: 'JSON',
    }).done(function(respuesta) {
        console.log(respuesta);
        if (respuesta[0] == true) {
            swal("George", "Tarea Procesada!", "success").then((confirma) => {
               

                tablaRevision.clear().draw();



               
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





/// abrir el modal y Cargar la descripcion y ocultarla si ya tiene

  $("body table#tablaRevision tbody ").on('click', 'button#ModificarDesc', function() {
  
    var descripcion = tablaRevision.row($(this).parent().parent()).data()[6];
    var id = tablaRevision.row($(this).parent().parent()).data()[0];
    $('.bodyTotal').find('p#obser').text(descripcion);
    $('.bodyTotal').find('p#idobser').text(id);

   //alert(descripcion);

   if(descripcion === ""){
     //alert("Esta vacio");
      $('.bodyTotal').find('input#ingredesc').show();
   }else{
     // alert("hay texto");
      $('.bodyTotal').find('input#ingredesc').hide();
   }

 


});

  // Guardar la descripcion desde el modal


$("body  ").on('click', 'button#guardardescripcion', function() {
   var id = $('.bodyTotal').find('p#idobser').text();
    var observacion = $('.bodyTotal').find('p#obser').text();
    var observa = $('.bodyTotal').find('input#ingredesc').val();

   if(observacion ===""){
         swal({
        title: "Tablero Kanban",
        text: "Seguro Que Desea Guardar Esta Observacion ? ",
        icon: "info",
        buttons: true,
        dangerMode: false,
    }).then((confirma) => {
        if (confirma) {
            ModificarObserva(id,observa);
        } else {
            tablaRevision.clear().draw();
        }
    });
   }else{
        
   }



  




});

function ModificarObserva(id , observa) {
     
    $.ajax({
        async: true,
        method: "POST",
        url: "Ajax/Aj_Revision.php",
        data: {
            Requerimiento: "ModificarObserva",
            Observaciones :observa,
            Id: id
        },
        dataType: 'JSON',
    }).done(function(respuesta) {
       // console.log(respuesta);
        //alert(observa);
        //alert(id);
        if (respuesta[0] == true) {
            var fila = JSON.parse(respuesta[1]);
            
            //console.log(respuesta);//retorna el JSON QUE CREA LA DESCRIPCION
            swal("George", "Tarea Procesada!", "success").then((confirma) => {
               

                tablaRevision.clear().draw();



               
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


/// abrir el modal y cargar la foto 

  $("body table#tablaRevision tbody ").on('click', 'button#fotos', function() {
   var id = tablaRevision.row($(this).parent().parent()).data()[0];
   $('.bodyTotal').find('p#idfoto').text(id);

   $('.bodyTotal').find('div#FileInput').empty();
    var divSubir = '<input id="archivos'+id+'" name="imagenes[]" type="file" multiple=true class="file-loading">';
    $('.bodyTotal').find('div#FileInput').append(divSubir);
    $("#archivos"+id).fileinput({
        language: 'es',
        uploadUrl: "vistas/upload.php",
        uploadExtraData : function() {
            return {
                idinv : id
            };
        },
        uploadAsync: false,
        minFileCount: 1,
        maxFileCount: 50,
        showUpload: false,
        showRemove: false,
        maxFilePreviewSize: 26500000,
        maxFileSize: 26500000,
        allowedFileExtensions: ["jpg", "png", "jpeg"],
        initialPreview: Fotos(id),
        initialPreviewConfig: Caption(id)
    }).on("filebatchselected", function(event,files){
        $("#archivos"+id).fileinput("upload");
    });


});

  //Guardar la foto 

  $("body  ").on('click', 'button#GuardarProducto', function() {
    
    var fila = $('.bodyTotal').find('p#idfoto').text();
    idInvTodo = fila;
    $("#archivos").fileinput('upload');

    // $('.bodyTotal').find('div#FileInput').empty();
    // $("#archivos").fileinput('clear').fileinput('destroy');

  
});

  //Consultarla desde el modal 
  function Fotos(idInv) {
    var campos = new Array();
    $.ajax({
        async:false,
        method: "POST",
        url: "Ajax/Aj_Revision.php",
        data: {
            Requerimiento: "ConsultarRutasIdInv",
            IdInv: idInv
        },
        dataType: 'JSON',
    }).done(function(respuesta) {
        $.each(respuesta, function(i, value) {
            campos.push("<img src='pasuca/"+respuesta[i][0]+"' height='100px' class='file-preview-image'>");
        });
    }).fail(function(jqXHR, textStatus, errorThrown) {
        swal("Galenos!", "Ocurrio un error consulte con la administracion..!  " + errorThrown + " Se cargara la pantalla nuevamente para solucionar el problema.", "error");
        //location.reload();
    });
    return campos;
}

function Caption(idInv) {
    var campos = new Array();
    $.ajax({
        async:false,
        method: "POST",
        url: "Ajax/Aj_Revision.php",
        data: {
            Requerimiento: "ConsultarRutasIdInv",
            IdInv: idInv
        },
        dataType: 'JSON',
    }).done(function(respuesta) {
        $.each(respuesta, function(i, value) {
            var cap = respuesta[i][0];

            campos.push({
                caption: cap.substring(9),
                height: "120px",
                url: "vistas/borrar.php",
                key: cap.substring(9)
            });
        });
    }).fail(function(jqXHR, textStatus, errorThrown) {
        swal("Galenos!", "Ocurrio un error consulte con la administracion..!  " + errorThrown + " Se cargara la pantalla nuevamente para solucionar el problema.", "error");
        //location.reload();
    });
    return campos;
}

 