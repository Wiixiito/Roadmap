var Descripcion = 0;

$( document ).ready(function() {
  $("#archivos").fileinput({
    language: 'es',
    uploadUrl: "vistas/uploadslide.php",
    uploadExtraData : function() {
        return {
            descripcion : Descripcion
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



  $("body  ").on('click', 'button#GuardarProducto', function() {
    
    var fila = $('.bodyTotal').find('input#descripcion').val();
    
    Descripcion = fila;

    if (fila=="") {
        swal("Tablero Kanban", "Ingrese una descripcion para la foto ", "error").then((confirma) => {
            $('.bodyTotal').find('input#descripcion').focus();
        });
        return;
    }

    
    swal({
        title: "Tablero Kanban",
        text: "Seguro Que Desea Guardar la foto ?",
        icon: "info",
        buttons: true,
        dangerMode: false,
    }).then((confirma) => {
        if (confirma) {
            $("#archivos").fileinput('upload');
             swal("Tablero Kanban", "Foto Guardado!", "success").then((confirma) => {
               
                
              /* setTimeout(function(){
                    location.reload();
                }, 500); // 3000 milliseconds = 3 seconds*/
               
            });
           
            // Refresh the page after a delay of 3 seconds
                
        } else {
            //limpiar.click();
        }
    });
    



    
    

  
});